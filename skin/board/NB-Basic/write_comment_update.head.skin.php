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
 if($board['bo_10'] && $w != 'cu') { //글수정이 아니면 작동
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
if($gr_id == "review"){	
	$gr_limit = "10"; // 그룹 제한 글 수
		$wr_sum = comment_today_count("review",$member['mb_id']);
		if ( $w != 'u' ) {
			if ( !$is_admin && $wr_sum >= $gr_limit && $member['mb_level'] != 26 && $member['mb_level'] != 27 ) {
			 alert( "후기 댓글은 하루에 {$gr_limit}회 만 등록할 수 있습니다. " );
			}
		   }
	}
	else if($gr_id == "attendance"){
		$gr_limit = "5"; // 그룹 제한 글 수
		$wr_sum = comment_today_count("attendance",$member['mb_id']);
		if ( $w != 'u' ) {
			if ( !$is_admin && $wr_sum >= $gr_limit && $member['mb_level'] != 26 && $member['mb_level'] != 27) {
			 alert( "업소정보에 댓글 하루에 {$gr_limit}회 만 등록할 수 있습니다. " );
			}
		   }
		}

include_once(G5_EXTEND_PATH.'/check_period.php');

?>