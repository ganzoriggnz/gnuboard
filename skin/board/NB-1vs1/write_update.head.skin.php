<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 회원만 이용
if ($is_guest) {
	alert('로그인 후 이용할 수 있습니다.', G5_BBS_URL.'/login.php?&url='.urlencode(get_pretty_url($bo_table)));
}

// 간단쓰기 제목처리
if($w == '' && $is_subject) {
	$wr_subject = na_cut_text($wr_content, 40); // 글내용 40자 자르기
}

?>