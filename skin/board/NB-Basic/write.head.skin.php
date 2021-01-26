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
// 지정된 회원만 글쓰기 권한부여. 게시판 설정 여분필드 1번 값 사용
// if ($board['bo_1']) {
//     $arr_mbids = explode(',', trim($board['bo_1']));
//     if(!$is_admin && !in_array($member['mb_id'], $arr_mbids)) {
//         alert('권한이 없습니다.');
//     }
// }
?>