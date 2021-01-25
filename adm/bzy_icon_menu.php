<?php
$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$g5['title'] = "Icon menu";
include_once('./admin.head.php');

$colspan = 15;

include_once('./admin.tail.php');
?>