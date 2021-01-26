<<<<<<< HEAD
<?php
$sub_menu = "600200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$g5['title'] = "Quick links contoller";
include_once('./admin.head.php');

$colspan = 15;
$link = $g5['connect_db'];
$error=G5_DISPLAY_SQL_ERROR;
$result = sql_query("SELECT * FROM BZY_LINKS", $error, $link);

print_r($result);
?>


<select>
<option>test</option>
</select>

<?php
include_once('./admin.tail.php');
=======
<?php
$sub_menu = "600200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$g5['title'] = "Quick links contoller";
include_once('./admin.head.php');

$colspan = 15;
$link = $g5['connect_db'];
$error=G5_DISPLAY_SQL_ERROR;
$result = sql_query("SELECT * FROM BZY_LINKS", $error, $link);

print_r($result);
?>


<select>
<option>test</option>
</select>

<?php
include_once('./admin.tail.php');
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
?>