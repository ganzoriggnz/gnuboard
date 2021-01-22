<?php 
$sub_menu = "700100";
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');

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

$sql = " INSERT INTO {$g5['coupon_sent_table']}
            SET co_no = '{$_POST['co_no']}',
                cos_code = '{$coupon}',
                cos_entity = '{$_POST['cos_entity']}',
                cos_nick = '{$_POST['cos_nick']}',
                cos_type = '{$_POST['cos_type']}',
                cos_created_datetime = '{$cos_created_datetime}' ";
sql_query($sql);

if($cos_type == 'S'){
    $sql1 = " UPDATE {$g5['coupon_table']}
            SET co_sent_snum = co_sent_snum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
    $sql1 = " UPDATE {$g5['coupon_table']}
            SET co_sent_fnum = co_sent_fnum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}

$sql_cus = "SELECT * FROM {$g5['member_table']} WHERE mb_nick = '{$_POST['cos_nick']}'";
$res_cus = sql_fetch($sql_cus);
$cus_id = $res_cus['mb_id'];
$cus_nick = $res_cus['mb_nick'];
if($cos_type == 'F'){ $coupon_type = '무료'; } else { $coupon_type = '원가'; }

$res = "SELECT * FROM {$g5['coupon_msg_table']} ORDER BY msg_no DESC LIMIT 1";
$row = sql_fetch($res); 

$me_memo = $coupon_type."쿠폰에 당첨되셨습니다." . "\r\n" . "아이디 : " . $cus_id . "\r\n" . "닉네임 : " . $cus_nick . "\r\n" . $row['msg_customer_text'];

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

$me_memo1 = "[쿠폰] ".$coupon_type."쿠폰 당첨자 보내드립니다." . "\r\n" . "아이디 : " . $cus_id . "\r\n" . "닉네임 : " . $cus_nick . "\r\n" . "쿠폰번호 : " . $coupon . "\r\n" . $row['msg_entity_text'];

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

goto_url(G5_ADMIN_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>