<?php
include_once('./_common.php');

include_once('./_head.php');

if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = get_text($member['mb_nick']).' 님의 포인트 내역';
include_once(G5_PATH.'/head.sub.php');



$pet_skin_path = get_skin_path('pet', 'NB-Basic');
$pet_skin_url  = get_skin_url('pet', 'NB-Basic');
$skin_file = $pet_skin_path.'/pet.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once(G5_PATH.'./_tail.php');
?>