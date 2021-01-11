<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블
$g5['coupon_alert_table'] = $g5['table_prefix'] . "coupon_alert";    // 쿠폰 sent 테이블

function generateCode() {
    $len = 4;
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';

    srand((double)microtime()*1000000);

    $i = 0;
    $coupon = '';

    while ($i < $len) {
        $num = rand() % strlen($chars);
        $tmp = substr($chars, $num, 1);
        $coupon .= $tmp;
        $i++;
    }

    $coupon = preg_replace('/([0-9A-Z]{4})/', '\1', $coupon);

    return $coupon;
}

$cos_created_datetime = G5_TIME_YMDHIS;
$cos_link = $_POST['cos_link'];
$cos_type = $_POST['cos_type'];
$mb_id = $_POST['mb_id'];

$coupon = generateCode(); 

$sql = " INSERT INTO $g5[coupon_sent_table]
            SET co_no = '{$_POST['co_no']}',
                cos_code = '{$coupon}',
                cos_entity = '{$_POST['cos_entity']}',
                cos_nick = '{$_POST['cos_nick']}',
                cos_type = '{$_POST['cos_type']}',
                cos_created_datetime = '{$cos_created_datetime}' ";
sql_query($sql);

if($cos_type == 'S'){
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_snum = co_sent_snum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_fnum = co_sent_fnum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}

$sql_cus = "SELECT * FROM {$g5['member_table']} WHERE mb_nick = '{$_POST['cos_nick']}'";
$res_cus = sql_fetch($sql_cus);
$cus_id = $res_cus['mb_id'];
$cus_nick = $res_cus['mb_nick'];
if($cos_type == 'F'){ $coupon_type = '무료'; } else { $coupon_type = '원가'; }

$me_memo = $coupon_type."쿠폰에 당첨되셨습니다." . "\r\n" . "아이디 : " . $cus_id . "\r\n" . "닉네임 : " . $cus_nick . "\r\n" . "축하합니다. 쿠폰 번호는 쿠폰관리에서 보시면 됩니다.";

$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id = $tmp_row['max_me_id'] + 1;

    // 받는 회원 쪽지 INSERT
    $sql = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values ( '$cus_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql);

    if( $me_id = sql_insert_id() ){

        // 보내는 회원 쪽지 INSERT
        $sql = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values ( '$cus_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00', '$me_id', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql);

    }

    // 실시간 쪽지 알림 기능
    $sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read($cus_id)."' where mb_id = '$cus_id' ";
    sql_query($sql);


$sql_ent = "SELECT * FROM {$g5['member_table']} WHERE mb_id = '$mb_id'";
$res_ent = sql_fetch($sql_ent);
$ent_id = $res_ent['mb_id'];
$ent_nick = $res_ent['mb_nick'];

$me_memo1 = "[쿠폰] ".$coupon_type."쿠폰 당첨자 보내드립니다." . "\r\n" . "아이디 : " . $cus_id . "\r\n" . "닉네임 : " . $cus_nick . "\r\n" . "쿠폰번호 : " . $coupon . "\r\n" . "업소방문시 쿠폰번호/닉네임 획인해주시고 할인적용 해주시면 됩니다. ";

$tmp_row1 = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id1 = $tmp_row1['max_me_id'] + 1;

    // 받는 회원 쪽지 INSERT
    $sql1 = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values ( '$ent_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$me_memo1}', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql1);

    if( $me_id1 = sql_insert_id() ){

        // 보내는 회원 쪽지 INSERT
        $sql1 = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values ( '$ent_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$me_memo1}', '0000-00-00 00:00:00', '$me_id1', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql1);
		
    }

    // 실시간 쪽지 알림 기능
    $sql1 = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read($ent_id)."' where mb_id = '$ent_id' ";
    sql_query($sql1);


 /* function alert1(){ */   
   /*  $at_table = $g5['write_table'].$cos_link;
    $linkcount = strlen($cos_link) - 2;
    $str_table =substr($cos_link, 0, $linkcount);
    $re_table = "g5_write_".$str_table."re";

    $sql1 = "SELECT a.cos_nick FROM $g5[coupon_sent_table] a INNER JOIN $re_table b ON a.cos_entity = b.wr_7 WHERE cos_accept = 'Y'";
    $res1 = sql_query($sql1);
    $nicks = array();
    while($row = sql_fetch_array($res1)){
        $nicks[] = $row['cos_nick'];
    }
    $sep_nicks = '"' . implode('", "', $nicks) . '"';

    $rs = "SELECT wr_name FROM $re_table WHERE wr_comment = 0";

    $sql2 = "SELECT wr_id, wr_name, wr_7, wr_datetime FROM $re_table WHERE wr_name IN ($sep_nicks) AND wr_comment = 0"; 
    $res2 = sql_query($sql2);
    while($row2 = sql_fetch_array($res2)){
        $sql3 = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_accept='Y' AND cos_nick = '{$row2['wr_name']}' AND cos_entity = '{$row2['wr_7']}'";
        $res3 = sql_fetch($sql3);
        if(!$row2['wr_id']){
            $sql4 = "INSERT INTO $g5[coupon_alert_table] 
                            SET cos_nick = '{$res3['cos_nick']}',
                                cos_entity = '{$res3['cos_entity']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$res3['cos_post_datetime']}' ";
                sql_query($sql4);

                $sql5 = "UPDATE $g5[coupon_sent_table] 
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['wr_name']}' AND cos_entity = '{$row2['wr_7']}'";
                sql_query($sql5);          
        }
        else if($row2['wr_id']){
            if($row2['wr_datetime'] > $res3['cos_post_datetime']){
                $sql4 = "INSERT INTO $g5[coupon_alert_table] 
                            SET cos_nick = '{$row2['wr_name']}',
                                cos_entity = '{$row2['wr_7']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$res3['cos_post_datetime']}' ";

                sql_query($sql4);

                $sql5 = "UPDATE $g5[coupon_sent_table] 
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['wr_name']}' AND cos_entity = '{$row2['wr_7']}'";

                sql_query($sql5);  
            }                 
        }
    } */
/* }

$status=TRUE;

do { 

   alert1(); 
   sleep(3600);   

} while($status==TRUE);  */  

goto_url(G5_HTTP_BBS_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>