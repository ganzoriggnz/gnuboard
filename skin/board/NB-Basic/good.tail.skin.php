<?php
if (!defined("_GNUBOARD_")) exit;
 

$mb = sql_fetch(" select mb_id, wr_7 from {$g5['write_prefix']}{$bo_table} where wr_id = '{$wr_id}' ");

if($member['mb_name'] == $mb['wr_7'] ){
    $insert_point = 30; //지급포인트
    //추천 받은 사람 포인트 지급
    insert_point($mb['mb_id'], $insert_point, "{$board['bo_subject']} {$wr_id} - {$member['mb_nick']} 님에게 좋아요 받음", $bo_table, $wr_id, '추천');
    //추천한 사람 포인트 지급
    //insert_point($member['mb_id'], $insert_point, $bo_table, $wr_id, $write['mb_id']); 
   
}
?>