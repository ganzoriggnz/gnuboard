<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// hulan nemsen 왕궁게시판 접근 가능

if($bo_table == 'Palace')
{
    if (!$is_admin &&  $member['mb_level'] > 22 )
    alert('권한이 없이 접근할 수 없습니다.', G5_URL);
}
?>
