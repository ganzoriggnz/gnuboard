<?php 
include_once('./_common.php');

$cos_no = $_POST['cos_no'];
$co_no = $_POST['co_no'];
$cos_code = $_POST['cos_code'];
$cos_link = $_POST['cos_link'];
$cos_type = $_POST['cos_type'];

$sql = "DELETE FROM {$g5['coupon_sent_table']} 
         WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

sql_query($sql);

if($cos_type == 'S'){
    $sql1 = " UPDATE {$g5['coupon_table']}
            SET co_sent_snum = co_sent_snum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
    $sql1 = " UPDATE {$g5['coupon_table']}
            SET co_sent_fnum = co_sent_fnum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}

goto_url(G5_HTTP_BBS_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>