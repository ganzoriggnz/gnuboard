<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// hulan nemsen 왕궁게시판 접근 가능

if($bo_table == 'Palace')
{
    if (!$is_admin &&  $member['mb_level'] > 22 )
    alert('권한이 없이 접근할 수 없습니다.', G5_URL);
}
?>
<!-- hulan nemsen level 17s deesh hereglegchiin urd image oruulah -->
<?php
function get_level($mb_id = '') {
    global $g5;
    
        $result = sql_fetch(" SELECT `mb_level` FROM `{$g5['member_table']}` WHERE `mb_id` = '{$mb_id}' ");
        if ($result['mb_level'] > 17) {
    return '<img src='.G5_URL.'/img/'.$result['mb_level'].'.png>';
    }
    
}
?>
<!-- ////////////////////////////////////////////////////////////////// -->
 

 

 

