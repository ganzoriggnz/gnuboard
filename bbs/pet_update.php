<?php
include_once('./_common.php');

if (!$is_member) die('');

if(isset($_POST['id']))
{
    $date = G5_TIME_YMDHIS;
    $id = $_POST['id'];
    if($id == 'cat1'){ 
        $sql1 = "INSERT INTO {$g5['pet_table']} 
                SET p_but1_datetime = '{$date}',
                    mb_id = '{$member['mb_id']}'";
        sql_query($sql1);

    } else if($id == 'cat2'){ 
        $sql2 = "INSERT INTO {$g5['pet_table']} 
                     SET p_but2_datetime = '{$date}'
                         mb_id = '{$member['mb_id']}'";
        sql_query($sql2);
    
    } else if($id == 'cat3'){ 
        $sql3 = "INSERT INTO {$g5['pet_table']} 
                    SET p_but3_datetime = '{$date}'
                        mb_id = '{$member['mb_id']}'";
        sql_query($sql3);   
    }
}

?>