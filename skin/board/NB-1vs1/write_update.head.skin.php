<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 게시판 하루 글등록수 제한하기
 // 하루 글제한수 $post_limit = 1;
 if($board['bo_9'] && $w != 'u' && !$is_admin && $member['mb_level'] != 26 && $member['mb_level'] != 27 && $bo_table != "greeting" && $bo_table != "twitter") { //글수정이 아니면 작동
	// 오늘 체크
	$sql_today = na_sql_term('today', 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)
	if($is_member) { // 회원이면 mb_id로 체크
	 $row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = '0' $sql_today "); 
	} else { // 비회원이면 ip로 체크
	 $row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '0' $sql_today "); 
	}
	if($row['cnt'] >= $board['bo_9']) {
	 alert('본 게시판은 하루에 글을 '.$board['bo_9'].'개까지만 등록할 수 있습니다.'); 
	}
   }
//////////////////////////////////////////////////////////////////////////////

// 회원만 이용
if ($is_guest) {
	alert('로그인 후 이용할 수 있습니다.', G5_BBS_URL.'/login.php?&url='.urlencode(get_pretty_url($bo_table)));
}

// 간단쓰기 제목처리
if($w == '' && $is_subject) {
	$wr_subject = na_cut_text($wr_content, 40); // 글내용 40자 자르기
}

?>