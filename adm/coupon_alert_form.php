<?php 
$sub_menu = "700100";
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');

$cos_nick = $_POST['cos_nick'];
$cos_entity = $_POST['cos_entity'];
$cos_link = $_POST['cos_link'];
$cos_alt_quantity = $_POST['cos_alt_quantity'];
$alt_created_datetime = G5_TIME_YMDHIS;

$sql = "INSERT INTO {$g5['coupon_alert_table']} 
            SET cos_no = '0',
                cos_nick = '{$cos_nick}',
                cos_entity = '-',
                cos_alt_quantity = '{$cos_alt_quantity}',
                alt_reason = '경고횟수 변경',
                alt_created_by = '{$member['mb_nick']}',
                alt_created_datetime = '{$alt_created_datetime}' ";

sql_query($sql);

$sql1 = "UPDATE {$g5['coupon_sent_table']} 
            SET cos_alt_quantity = '{$cos_alt_quantity}'
            WHERE cos_accept='Y' AND cos_nick = '{$cos_nick}' AND cos_entity = '{$cos_entity}'";

sql_query($sql1);

echo $cos_link;
goto_url(G5_ADMIN_URL.'/coupon_list.php?bo_table='.$cos_link); 

?>