<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 신고 글 수정 불가
if($w == "u") {
	if(!$is_admin && IS_NA_BBS) {
		if($boset['na_shingo'] && $write['as_type'] == "-1") {
			alert("신고된 글은 수정할 수 없습니다.");
		}
	}
}

// 원글 등록자만 챕터등록 가능
if($w == "r" && $write['mb_id'] && $write['mb_id'] != $member['mb_id']) {
	alert('원글 작성자만 챕터등록이 가능합니다.');
}

?>