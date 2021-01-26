<?php
$sub_menu = "700200";
include_once('./_common.php');
<<<<<<< HEAD
=======
auth_check($auth[$sub_menu], 'r');
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b

if(isset($_POST['cos_no'])){
   $cos_no = $_POST['cos_no'];
}

<<<<<<< HEAD
$sql = "SELECT * FROM `g5_coupon_sent` WHERE cos_no = '$cos_no'";
=======
$sql = "SELECT * FROM {$g5['coupon_sent']} WHERE cos_no = '$cos_no'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
$res = sql_fetch($sql);

$response = '<input type="hidden" name="w" id="w" value="d">
             <input type="hidden" name="co_no" id="co_no" value="'.$res['co_no'].'">
             <input type="hidden" name="cos_no" id="cos_no" value="'.$cos_no.'">
             <input type="hidden" name="cos_type" id="cos_type" value="'.$res['cos_type'].'">
             <input type="hidden" name="cos_code" id="cos_code" value="'.$res['cos_code'].'">
             <div style="margin-left:100px;">쿠폰을 회수하시겠습니까?</div>';

echo $response;
?>