<?php 
include_once('./_common.php');

$cos_no = $_POST['cos_no'];
$co_no = $_POST['co_no'];
$cos_code = $_POST['cos_code'];
$cos_accepted_datetime = G5_TIME_YMDHIS;
$cos_post_datetime = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($cos_accepted_datetime)));

$sql = "UPDATE {$g5['coupon_sent_table']} 
           SET cos_accept = 'Y',
               cos_accepted_datetime = '{$cos_accepted_datetime}',
               cos_post_datetime = '{$cos_post_datetime}'
         WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

sql_query($sql);

goto_url(G5_HTTP_BBS_URL.'/coupon_accept.php'); 
?>