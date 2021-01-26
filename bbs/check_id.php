<?php
include_once('./_common.php');

if (!$is_member) die('');

if(isset($_POST['check_id']))
{
    $mb_nick = $_POST['mb_nick'];
    $sql = " select mb_nick from {$g5['member_table']} where mb_nick = '{$mb_nick}'";
    $row = sql_fetch($sql);
    if($row['mb_nick']){ ?>
<<<<<<< HEAD
        <input type="text" id="hasNick" value="정상적인 닉네임입니다." style="width:140px;"/>
    <?php  
    } else { ?>
        <input type="text" id="hasNick" value="" style="width:140px;"/>
=======
        <input type="text" id="hasNick" value="정상적인 닉네임입니다." class="form-control" style="width:160px;"/>
    <?php  
    } else { ?>
        <input type="text" id="hasNick" value="" class="form-control" style="width:160px;"/>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    <?php
    }
}

?>