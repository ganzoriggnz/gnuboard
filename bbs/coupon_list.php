<?php 

include_once('./_common.php');

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = '쿠폰지원 목록';
include_once(G5_PATH.'/head.sub.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

$list = array();
$result = "select * from $g5[coupon_table] where mb_id = '{$member['mb_id']}'";

$sql1 = "select COUNT(*) as cnt from $g5[coupon_table] where mb_id = '{$member['mb_id']}'";
$row1 = sql_fetch($sql1);
$total_count = $row1['cnt']; 

$coupon_list_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_list_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_list_skin_path.'/coupon_list.skin.php';

$coupon_action_url = G5_BBS_URL.'/coupon_list_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once(G5_PATH.'/tail.sub.php');
?>