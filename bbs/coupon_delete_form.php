<?php 
include_once('./_common.php');

<<<<<<< HEAD
// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블

=======
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
$cos_no = $_POST['cos_no'];
$co_no = $_POST['co_no'];
$cos_code = $_POST['cos_code'];
$cos_link = $_POST['cos_link'];
$cos_type = $_POST['cos_type'];

<<<<<<< HEAD
$sql = "DELETE FROM $g5[coupon_sent_table] 
=======
$sql = "DELETE FROM {$g5['coupon_sent_table']} 
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
         WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

sql_query($sql);

if($cos_type == 'S'){
<<<<<<< HEAD
    $sql1 = " UPDATE $g5[coupon_table]
=======
    $sql1 = " UPDATE {$g5['coupon_table']}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
            SET co_sent_snum = co_sent_snum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
<<<<<<< HEAD
    $sql1 = " UPDATE $g5[coupon_table]
=======
    $sql1 = " UPDATE {$g5['coupon_table']}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
            SET co_sent_fnum = co_sent_fnum - 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}

goto_url(G5_HTTP_BBS_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>