<?php
$sub_menu = "300210";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert($_POST['act_button'].' 하실 항목을 하나 이상 체크하세요.');

if ($_POST['act_button'] == "선택삭제") {
    for ($i=0; $i<$count; $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        
        // 포인트 내역삭제
        $sql = " delete from {$g5['singo_table']} where bo_id = '{$_POST['bo_id'][$k]}' ";
        sql_query($sql);
    }
} else if ($_POST['act_button'] == "선택처리") {
    for ($i=0; $i<$count; $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        
        // 포인트 내역삭제
        $sql = " update {$g5['singo_table']} set bo_status = '1' where bo_id = '{$_POST['bo_id'][$k]}' ";
        sql_query($sql);
    }
}

goto_url('./board_singo.php?'.$qstr);
?>
