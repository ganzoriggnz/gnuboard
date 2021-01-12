<?php 

include_once('./_common.php');

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = '쿠폰지원 목록';
include_once(G5_PATH.'/head.sub.php');

$bo_table = $_REQUEST['bo_table'];

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블
$g5['coupon_alert_table'] = $g5['table_prefix'] . "coupon_alert";    // 쿠폰 alert 테이블
$g5['write_prefix']        = "g5_write_";
$g5['bo_table'] = $g5['write_prefix'] . $bo_table;

$co_created_datetime = G5_TIME_YMDHIS;
$currentmonth = substr($co_created_datetime, 5, 2);
$co_start = date_create($co_created_datetime);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');

if($currentmonth == '01')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '02')
$s_end_date = date_format($co_start, 'Y-m-28 23:59:59');
else if($currentmonth == '03')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '04')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '05')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '06')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '07')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '08')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '09')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '10')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '11')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '12')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');

$result1 = "SELECT co_begin_datetime FROM $g5[coupon_table] WHERE co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
$sql = sql_fetch($result1);
$date = $sql['co_begin_datetime'];
$year = substr($date, 0, 4);
$month = substr($date, 5, 2);

$result = "SELECT COUNT(a.co_no) as cnt FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}'"; 
$row=sql_fetch($result);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();

$sql = "SELECT * FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 순차적인 번호 (순번)
    $num = $total_count - ($page - 1) * $rows - $i;
}

$at_table = $g5['write_table'].$bo_table;
$linkcount = strlen($bo_table) - 2;
$str_table =substr($bo_table, 0, $linkcount);
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
    $sql4 = "SELECT * FROM $g5[coupon_alert_table] WHERE cos_nick = '{$row2['wr_name']}' AND cos_entity = '{$row2['wr_7']}'";
    $res4 = sql_fetch($sql4); 
    /* if(!$row2['wr_id']){
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
            echo $sql5;
            sql_query($sql5);          
    } */
    if($row2['wr_id'] && !$res4['alt_no']){
        if($row2['wr_datetime'] > $res3['cos_post_datetime']){
            $sql5 = "INSERT INTO $g5[coupon_alert_table] 
                        SET cos_nick = '{$row2['wr_name']}',
                            cos_entity = '{$row2['wr_7']}',
                            cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                            alt_reason = '후기미작성7일',
                            alt_created_by = '-',
                            alt_created_datetime = '{$res3['cos_post_datetime']}' ";

            sql_query($sql5);

            $sql6 = "UPDATE $g5[coupon_sent_table] 
                        SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                        WHERE cos_accept='Y' AND cos_nick = '{$row2['wr_name']}' AND cos_entity = '{$row2['wr_7']}'";

            sql_query($sql6);  
        }                 
    }
} 

$coupon_list_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_list_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_list_skin_path.'/coupon_list.skin.php';

$coupon_sent_action_url = G5_BBS_URL.'/coupon_sent_form.php';
$coupon_delete_action_url = G5_BBS_URL.'/coupon_delete_form.php';
$coupon_alert_action_url = G5_BBS_URL.'/coupon_alert_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once(G5_PATH.'/tail.sub.php');
?>