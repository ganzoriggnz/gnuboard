<?php
include_once('./_common.php');

if (!$is_member)
alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$sql = " delete from {$g5['scrap_table']} where mb_id = '{$member['mb_id']}' and ms_id = '$ms_id' ";
sql_query($sql);

$sql = " update `{$g5['member_table']}` set mb_scrap_cnt = '".get_scrap_totals($member['mb_id'])."' where mb_id = '{$member['mb_id']}' ";
sql_query($sql);

if($reload && isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']){
	goto_url($_SERVER['HTTP_REFERER']);
} else {
	exit;
	goto_url('./scrap.php?page='.$page);
}
?>
