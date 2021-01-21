<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 신고 댓글 수정 불가
if($w == "cu") {
	if(!$is_admin && IS_NA_BBS) {
		if($boset['na_shingo'] && $write['as_type'] == "-1") {
			if($boset['na_crows']) {
				die('신고된 댓글은 수정할 수 없습니다.');
			} else {
				alert("신고된 댓글은 수정할 수 없습니다.");
			}
		}
	}

	
}

// 댓글 작성 하루 개수 제한  
 // 댓글 작성 개수  $comment_limit = 2;hulan nemsen///////////////////
 if($w != 'cu' && !$is_admin && $member['mb_level'] != 26 && $member['mb_level'] != 27) { //글수정이 아니면 작동
	// 오늘 체크
	$sql_today = na_sql_term('today', 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)
	if($is_member) { // 회원이면 mb_id로 체크
	 $row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = '1' $sql_today "); 
	} else { // 비회원이면 ip로 체크
	 $row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '1' $sql_today "); 
	}
	if($row['cnt'] >= $board['bo_10']) {   //  bo_10 tuhain sambart bichih commentiin limit
	 alert('본 게시판은 하루에 댓글을 '.$board['bo_10'].'개까지만 등록할 수 있습니다.'); 
	}
   }
////////////////////////////////ene hurtel //////////////////////

/////////////////hulan///////////////////////////////
// 그룹 지정 댓글쓰기 횟수 제한
$set_id = "review"; // 그룹 ID 지정  
$gr_limit = "10"; // 그룹 제한 글 수  review groupiin buh sambart comment oruulah limit
$ress = sql_query( " select bo_table from $g5[board_table] where gr_id = '{$set_id}' " );
for ( $i = 1; $bo = sql_fetch_array( $ress ); ) {
 $tmp_wr_table = $g5[ 'write_prefix' ] . $bo[ 'bo_table' ]; // 지정 그룹 게시판 테이블
 // 회원 글 가져오기
 $result = sql_query( " select * from $tmp_wr_table where mb_id='$member[mb_id]' and wr_is_comment ='1' " );
 for ( $i == 0; $row = sql_fetch_array( $result ); $i++ ) {
  $wr_sum = $i;
  //echo $i."--".$member[mb_id]; // 확인
 }
}
if ( $w != 'cu'  && !$is_admin && $member['mb_level'] != 26 && $member['mb_level'] != 27 ) {
 if ( !$is_admin && $wr_sum >= $gr_limit && $gr_id == $set_id ) {
  alert( "후기 게시판에는 {$gr_limit}회 만 댓글 쓸 수 있습니다. 변경내용이 있다면 기존글을 수정하십시오." );
 }
}
////////////////////////////////////////////////

include_once(G5_EXTEND_PATH.'/check_period.php');

?>