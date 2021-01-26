<<<<<<< HEAD
<?php
define('G5_CAPTCHA', true);
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
header('Content-Type: text/plain; charset=utf-8');

if($member['mb_id'] && $mb_point >= 0) {
	//Æ÷ÀÎÆ® Å×ÀÌºí Ãß°¡ 
	$sql = " insert into $g5[point_table] 
			set mb_id = '".$member['mb_id']."', 
			po_datetime = '".G5_TIME_YMDHIS."', 
			po_content = '$wr_id-Áö½ÄÀÎ µî·Ï Æ÷ÀÎÆ® Â÷°¨',
			po_point = '$mb_point', 
			po_mb_point = '$mb_point',  
			po_rel_table = '$bo_table', 
			po_rel_id = '$wr_id',
			po_rel_action = 'Áö½ÄÀÎ µî·Ï' 
		"; 
	sql_query($sql); 

	//¸â¹ö Å×ÀÌºí Æ÷ÀÎÆ® ¾÷µ¥ÀÌÆ®  
	sql_query(" update $g5[member_table] set mb_point = '$mb_point' where mb_id = '$member[mb_id]' ");
}
=======
<?php
define('G5_CAPTCHA', true);
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
header('Content-Type: text/plain; charset=utf-8');

if($member['mb_id'] && $mb_point >= 0) {
	//Æ÷ÀÎÆ® Å×ÀÌºí Ãß°¡ 
	$sql = " insert into $g5[point_table] 
			set mb_id = '".$member['mb_id']."', 
			po_datetime = '".G5_TIME_YMDHIS."', 
			po_content = '$wr_id-Áö½ÄÀÎ µî·Ï Æ÷ÀÎÆ® Â÷°¨',
			po_point = '$mb_point', 
			po_mb_point = '$mb_point',  
			po_rel_table = '$bo_table', 
			po_rel_id = '$wr_id',
			po_rel_action = 'Áö½ÄÀÎ µî·Ï' 
		"; 
	sql_query($sql); 

	//¸â¹ö Å×ÀÌºí Æ÷ÀÎÆ® ¾÷µ¥ÀÌÆ®  
	sql_query(" update $g5[member_table] set mb_point = '$mb_point' where mb_id = '$member[mb_id]' ");
}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
?>