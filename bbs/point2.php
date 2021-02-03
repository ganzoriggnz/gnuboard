<?php
include_once('./_common.php');

include_once('./_head.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if ($is_guest)
    alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$g5['title'] = get_text($member['mb_nick']).' 님의 포인트 내역';
include_once(G5_PATH.'/head.sub.php');

$list = array();

$sql_common = " from {$g5['point2_table']} where mb_id = '".escape_trim($member['mb_id'])."' ";
$sql_order = " order by po_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$point_skin_path = get_skin_path('member', $config['cf_member_skin']);
$point_skin_url  = get_skin_url('member', $config['cf_member_skin']);

$skin_file = $point_skin_path.'/point2.skin.php';

// if(is_file($skin_file)) {
    include($skin_file);
// } else {
//     echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
// }

include_once('./_tail.php');
?>