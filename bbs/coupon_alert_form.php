<?php 
include_once('./_common.php');
if (!$is_member)
alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$cos_id = $_POST['cos_id'];
$cos_nick = $_POST['cos_nick'];
$cos_entity = $_POST['cos_entity'];
$cos_link = $_POST['cos_link'];
$cos_alt_quantity = $_POST['cos_alt_quantity'];
$alt_created_datetime = G5_TIME_YMDHIS;

$sql = "INSERT INTO {$g5['coupon_alert_table']} 
            SET cos_no = '0',
                cos_id = '{$cos_id}',
                cos_nick = '{$cos_nick}',
                mb_id = '-',
                cos_entity = '-',
                cos_alt_quantity = '{$cos_alt_quantity}',
                alt_reason = '경고횟수 변경',
                alt_created_by = '{$member['mb_nick']}',
                alt_created_datetime = '{$alt_created_datetime}' ";

sql_query($sql);

/* $sql1 = "UPDATE {$g5['coupon_sent_table']} 
            SET cos_alt_quantity = '{$cos_alt_quantity}'
            WHERE cos_accept='Y' AND cos_id = '{$cos_id}' AND cos_entity = '{$cos_entity}'";

sql_query($sql1); */

goto_url(G5_HTTP_BBS_URL.'/coupon_list.php?bo_table='.$cos_link); 

?>