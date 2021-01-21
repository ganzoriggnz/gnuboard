<?php

$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if(isset($_POST['mb_id'])){
    $mb_id = $_POST['mb_id'];
 }

global $config;
global $g5;
global $bo_table, $sca, $is_admin, $member;

$sql = "SELECT  mb_id, mb_name, mb_nick, mb_email, mb_homepage from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$row = sql_fetch($sql);

$name = $row['mb_name'];
$nb_nick = $row['mb_nick'];
$mb_email = $row['mb_email'];
$mb_homepage = $row['mb_homepage'];

$email = get_string_encrypt($email);
$homepage = set_http(clean_xss_tags($homepage));

$name     = get_text($name, 0, true);
$email    = get_text($email);
$homepage = get_text($homepage);

$tmp_name = "";
$en_mb_id = $mb_id;

$str = "<span class=\"sv_wrap\">\n";
$str .= $tmp_name."\n";

$str2 = "<span class=\"sv\">\n";

if($is_admin == "super" && $mb_id) {
    $str2 .= "<a href=\"".G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id."\" target=\"_blank\">회원정보변경</a>\n";
    $str2 .= "<a href=\"".G5_ADMIN_URL."/entity_extend_right.php"\">제휴연장</a>\n";
    $str2 .= "<a href=\"".G5_ADMIN_URL."/coupon_list.php"\" target=\"_blank\">쿠폰관리</a>\n";
    $str2 .= "<a href=\"".G5_BBS_URL."/memo_form.php?me_recv_mb_id=".$mb_id."\" onclick=\"win_memo(this.href); return false;\">쪽지보내기</a>\n";
}
$str2 .= "</span>\n";
$str .= $str2;
$str .= "\n<noscript class=\"sv_nojs\">".$str2."</noscript>";

$str .= "</span>";

echo $str;

/* $mb_nick = get_entityview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']); */

?>