<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 회원만 이용
if ($is_guest) {
	alert('로그인 후 이용할 수 있습니다.', G5_BBS_URL.'/login.php?&url='.urlencode(get_pretty_url($bo_table)));
}

// 신고 글 수정 불가
if($w == "u") {
	if(!$is_admin && IS_NA_BBS) {
		if($boset['na_shingo'] && $write['as_type'] == "-1") {
			alert("신고된 글은 수정할 수 없습니다.");
		}
	}
}

?>