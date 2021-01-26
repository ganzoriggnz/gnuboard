<?php
$po_point = $wr_1 * (-1); //차감 포인트 
$mb_point = $member['mb_point'] - $wr_1;  //포인트 합계

if($mb_point <= 0) {
	alert('답변 체택 포인트로 사용하실 포인트가 모자라 질문을 등록하실수 없습니다.\n(체택 포인트 : '.$wr_1.', 부족한 포인트 : '.($mb_point).')');
}
?>