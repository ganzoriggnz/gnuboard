<?php
// header("Location: https://bamje1.com/error.php");
// // echo "error";
// exit();  
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "SELECT distinct(m.mb_id) mb_id FROM nariya1.g5_member m left join g5_point p on m.mb_id=p.mb_id where m.mb_level != 26 and m.mb_level != 27 and m.mb_level != 30;";

$now = G5_TIME_YMDHIS;
$datas = sql_query($sql);
// var_dump($datas);die;
while ($row = sql_fetch_array($datas)) {
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = 1000,
            `po_use_point` = '0',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '1000',
            `po_rel_table` = '',
            `po_rel_id` = '',
            `po_rel_action` = '';";
    sql_query($sql_ins);
}


include_once(G5_PATH.'/head.php');
?>
