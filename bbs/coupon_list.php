<?php 

include_once('./_common.php');

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = '쿠폰지원 목록';
include_once(G5_PATH.'/head.sub.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['couponsent_table'] = $g5['table_prefix'] . "couponsent";    // 쿠폰 테이블

$co_created = date('Y-m-d H:i:s');
$currentmonth = substr($co_created, 5, 2);
$co_start = date_create($co_created);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');

if($currentmonth == '01')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '02')
$s_end_date = date_format($co_start, 'Y-m-28 23:59:59');
else if($currentmonth == '03')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '04')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '05')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '06')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '07')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '08')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '09')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '10')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '11')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '12')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');

$result = "SELECT * FROM $g5[coupon_table] WHERE co_begin_date='$s_begin_date' AND co_end_date='$s_end_date'";
$now = date('Ymd', time());
$year = substr($now, 0, 4);
$month = substr($now, 4, 2);

$sql1 = "select COUNT(*) as cnt from $g5[coupon_table] where mb_id = '{$member['mb_id']}' AND co_begin_date='$s_begin_date' AND co_end_date='$s_end_date'";
$row1 = sql_fetch($sql1);
$total_count = $row1['cnt']; 

$coupon_list_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_list_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_list_skin_path.'/coupon_list.skin.php';

$couponsent_action_url = G5_BBS_URL.'/couponsent_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once(G5_PATH.'/tail.sub.php');
?>