<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// hulan nemsen
// 지정된 회원만 글쓰기 권한부여. 게시판 설정 여분필드 1번 값 사용
// if ($board['bo_1']) {
//   $arr_mbids = explode(',', trim($board['bo_1']));
//   if(!$is_admin && !in_array($member['mb_id'], $arr_mbids)) {
//       alert('권한이 없습니다.');
//   }
// }
/////////////////////////////hulan///////////////////////

// 게시판 하루 글등록수 제한하기
 // 하루 글제한수 $post_limit = 1;
 if($w != 'u' && !$is_admin && $member['mb_level'] != 26) { //글수정이 아니면 작동
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

  // hulan nemsen////////////////////////////////////////////////////////////
  if($w != 'u' && $gr_id == "review") { //글수정이 아니고, review 그룹이면 작동
  
	// 게시판 하루 글등록수 제한하기
   $post_limit = 2; // 하루 글제한수
   if(!$is_admin && $member['mb_level'] != 26 && $w != 'u' ) { //관리자가 아니고 26레벨 아니고 글수정이 아니면 작동
   // 오늘 체크
   $sql_today = na_sql_term('today', 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)
   if($is_member) { // 회원이면 mb_id로 체크
   $row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = '0' $sql_today "); 
   } else { // 비회원이면 ip로 체크
   $row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '0' $sql_today "); 
   }
   if($row['cnt'] >= $post_limit) {
   alert('본 게시판은 하루에 글을 '.$post_limit.'개까지만 등록할 수 있습니다.'); 
   }
   }
  }
  ///////////////////////////////////////////////////////////////////

// 간단쓰기 제목처리
if($w == '' && $is_subject) {
	$wr_subject = na_cut_text($wr_content, 40); // 글내용 40자 자르기
}
$config['cf_delay_sec'] = 600;   // 원글 쓰기 간격 
?>