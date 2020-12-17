<?php
include_once('./_common.php');

//dbconfig파일에 $g5['content_table'] 배열변수가 있는지 체크
if( !isset($g5['member_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->내용 관리를 먼저 확인해 주세요.');
}

// 내용

/* if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/userinfo.php');
    return;
} */

include_once('./_head.php');
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_skin_url.'/style.css">', 0);

$coupon_create_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_create_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_create_skin_path.'/coupon_create.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}
?>

<?php
    include_once('./_tail.php');
?>