<?php
include_once('./_common.php');
if (!$is_member) die('');

if(isset($_POST['mb_id']))
{
    $mb_id = $_POST['mb_id'];
    $mb_nick2 = $_POST['mb_nick2'];
    $sql = "update g5_member set   mb_nick2 = '{$mb_nick2}' where mb_id = '{$mb_id}' ";
    echo $sql;
    sql_query($sql);    
}

//alert("success");
?>