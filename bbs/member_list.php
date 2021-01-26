<?php
include_once('./_common.php');

include_once('./_head.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);


if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = get_text($member['mb_nick']).' 님의 포인트 내역';
include_once(G5_PATH.'/head.sub.php');


$mypost_skin_path = get_skin_path('member', $config['cf_member_skin']);
$mypost_skin_url  = get_skin_url('member', $config['cf_member_skin']);
$skin_file = $mypost_skin_path.'/member_list.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('./_tail.php');
?>