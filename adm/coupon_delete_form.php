<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블

$cos_no = $_POST['cos_no'];
$co_no = $_POST['co_no'];
$cos_code = $_POST['cos_code'];
$cos_link = $_POST['cos_link'];
$cos_type = $_POST['cos_type'];

$sql = "DELETE FROM $g5[coupon_sent_table] 
         WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

sql_query($sql);

if($cos_type == 'S'){
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_snum = co_sent_snum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_fnum = co_sent_fnum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}

goto_url(G5_ADMIN_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>