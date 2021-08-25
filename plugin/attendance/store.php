<?php
include_once('./_common.php');
if (!stripos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])) exit;

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

//사용가능한 원가권 쿠폰이 있는 업소들만
if($_POST['coupon_type']=="sale"){
	$sql = "SELECT a.*, c.mb_level FROM {$g5['coupon_table']} a INNER JOIN {$_POST['at_table']} b ON a.mb_id = b.mb_id INNER JOIN {$g5['member_table']} c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}' AND (a.co_sale_num - a.co_sent_snum) > '0' AND b.wr_is_comment = '0' AND (c.mb_level = '26' OR c.mb_level = '27')";		
}

//사용가능한 무료권 쿠폰이 있는 업소들만
if($_POST['coupon_type']=="free"){
	$sql = "SELECT a.*, c.mb_level FROM {$g5['coupon_table']} a INNER JOIN {$_POST['at_table']} b ON a.mb_id = b.mb_id INNER JOIN {$g5['member_table']} c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}' AND(a.	co_free_num - a.co_sent_fnum) > '0' AND b.wr_is_comment = '0' AND (c.mb_level = '26' OR c.mb_level = '27')";
}

$result =  sql_query($sql); 
$value = array(); 
for ($i=0; $row=sql_fetch_array($result); $i++) {
	array_push($value, $row);
}
echo json_encode($value);