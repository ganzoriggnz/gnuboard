<?php
$sub_menu = "700200";
include_once('./_common.php');


auth_check($auth[$sub_menu], 'r');
$g5['title'] = "후기미작성자";
include_once('./admin.head.php');

?>

<?php
include_once('./admin.tail.php');
?>