<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블

$cos_no = $_POST['cos_no'];
$co_no = $_POST['co_no'];
$cos_code = $_POST['cos_code'];
$cos_accepted_datetime = G5_TIME_YMDHIS;

$sql = "UPDATE $g5[coupon_sent_table] 
           SET cos_accept = 'Y',
               cos_accepted_datetime = '{$cos_accepted_datetime}' 
         WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

sql_query($sql);

goto_url(G5_HTTP_BBS_URL.'/coupon_accept.php'); 
?>