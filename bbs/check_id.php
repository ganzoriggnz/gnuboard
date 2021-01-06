<?php
include_once('./_common.php');

if (!$is_member) die('');

if(isset($_POST['check_id']))
{
    $userid = $_POST['userid'];
    $sql = " select mb_id from {$g5['member_table']} where mb_id = '{$userid}'";
    $row = sql_fetch($sql);
    if($row['mb_id']){ ?>
        <input type="text" class="form-control" value="정상적인 닉네임입니다."/>
    <?php  
    } else { ?>
        <input type="text" class="form-control" value=""/>
    <?php
    }
}

?>