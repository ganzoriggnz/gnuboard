<?php
include_once('./_common.php');

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$mission_skin_url.'/style.css">', 0);

$mission_skin_path = get_skin_path('mission', 'NB-Basic');
$mission_skin_url  = get_skin_url('mission', 'NB-Basic');
$skin_file = $mission_skin_path.'/mission.skin.php';


if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}
?>

<?php
    include_once('./_tail.php');
?>
