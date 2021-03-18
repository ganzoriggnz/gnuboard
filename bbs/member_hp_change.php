<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = " ▶  전화번호 변경요청";
$mb_id=  $_POST['mb_id'];

$skin_file = $member_skin_path.'/phone_change_request.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('./_tail.php');
?>