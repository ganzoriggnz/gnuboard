<?php 
include_once('./_common.php');

if (!$is_member) alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$g5['title'] = '선물함';
include_once('./_head.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "SELECT * FROM {$g5['giftbox_table']} WHERE mb_id='$member[mb_id]' order by id desc";
$result = sql_query($sql);

$giftbox_skin_path = get_skin_path('giftbox', 'NB-Basic');
$giftbox_skin_url  = get_skin_url('giftbox', 'NB-Basic');
$skin_file = $giftbox_skin_path.'/giftbox.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('./_tail.php');
?>