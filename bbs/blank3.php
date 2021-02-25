<?php
include_once('./_common.php');

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


$blank_skin_path = get_skin_path('member', $config['cf_member_skin']);
$blank_skin_url  = get_skin_url('member', $config['cf_member_skin']);
$skin_file = $blank_skin_path.'/blank3.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once('./_tail.php');
?>