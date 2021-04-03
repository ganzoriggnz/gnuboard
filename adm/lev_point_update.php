<?php
$sub_menu = "200600";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$lev_name = (isset($_POST['lev_name']) && is_array($_POST['lev_name'])) ? $_POST['lev_name'] : array();

if ($_POST['act_button'] == "선택수정" && $w == "u") {

    for ($i=0; $i<count($_POST['chk']); $i++) {

        $k = $_POST['chk'][$i];

        $sql = "UPDATE {$g5['lev_point_table']}
                SET lev_name = '{$_POST['lev_name'][$k]}',
                    lev_point = '{$_POST['lev_point'][$k]}',
                    lev_updated_datetime = '{$_POST['lev_point'][$k]}'
                WHERE lev_name  = '{$_POST['lev_name'][$k]}'";
        //echo $sql;     
        sql_query($sql);
    }
} 

//run_event('admin_lev_point_update', $act_button, $chk, $lev_name, '');

goto_url('./lev_point.php');
?>