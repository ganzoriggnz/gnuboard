<?php
include_once('./_common.php');

if (!$is_member) die('');

$now = G5_TIME_YMDHIS;
$id = $_POST['id'];
$p_date = date_create($now);
$p_begin_date = date_format($p_date, 'Y-m-d 00:00:00');
$p_end_date = date_format($p_date, 'Y-m-d 23:59:59');    
$res = "SELECT * FROM {$g5['pet_table']} WHERE mb_id = '{$member['mb_id']}' AND  p_but1_datetime >= '{$p_begin_date}' AND '{$p_end_date}' >=  p_but2_datetime AND '{$p_end_date}' >=  p_but3_datetime";
$row = sql_fetch($res); 

if(!$row['p_no']){
    $sql1 = "INSERT INTO {$g5['pet_table']} 
            SET p_but1_datetime = '{$now}',
                mb_id = '{$member['mb_id']}'";
    sql_query($sql1);   
}
else if($row['p_no']){
    if($id == 'cat2' && $row['p_but2_datetime'] == '0000-00-00 00:00:00'){ 
        $sql2 = "UPDATE {$g5['pet_table']} 
                    SET p_but2_datetime = '{$now}'
                    WHERE p_no = '{$row['p_no']}'";
        sql_query($sql2);
    
    } else if($id == 'cat3' && $row['p_but3_datetime'] == '0000-00-00 00:00:00'){ 
        $sql3 = "UPDATE {$g5['pet_table']} 
                    SET p_but3_datetime = '{$now}'
                    WHERE p_no = '{$row['p_no']}'";
        sql_query($sql3);  
       insert_point($member['mb_id'], 50, "펫 기르기 파운드", "@pet", $member['mb_nick'], G5_TIME_YMD); 
    }
 } 
     
goto_url(G5_HTTP_BBS_URL.'/pet.php');

?>