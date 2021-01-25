<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 원글 등록자만 챕터등록 가능
if($w == "r" && $wr['mb_id'] && $wr['mb_id'] != $member['mb_id']) {
	alert('원글 작성자만 챕터등록이 가능합니다.');
}

?>