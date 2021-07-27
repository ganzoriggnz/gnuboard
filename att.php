<?php
// header("Location: https://bamje1.com/error.php");
// // echo "error";
// exit();  
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "select distinct(mb_id) mb_id from g5_attendance where `datetime` != '2021-07-17 00:00:00' or `datetime` != '2021-07-18 00:00:00' or `datetime` != '2021-07-19 00:00:00' or `datetime` != '2021-07-20 00:00:00' or `datetime` != '2021-07-21 00:00:00' or `datetime` != '2021-07-22 00:00:00';";

$dates = array(
    0 => '2021-07-17 00:00:00', 
    1 => '2021-07-18 00:00:00', 
    2 => '2021-07-19 00:00:00',
    3 => '2021-07-20 00:00:00',
    4 => '2021-07-21 00:00:00',
    5 => '2021-07-22 00:00:00',
);
$now = G5_TIME_YMDHIS;

$datas = sql_query($sql);
// var_dump($datas);die;
while ($row = sql_fetch_array($datas)) {
    for ($i=0; $i < 6; $i++) { 
        $c = 1;
        $s = "select * from {$g5['attendance_table']} where mb_id = '{$row['mb_id']}' order by day desc limit 1;";
        $one = sql_fetch($s);
        $day = $one['day'] + $c;
        $sql_ins = " INSERT INTO {$g5['attendance_table']} 
            SET `mb_id` = '{$row['mb_id']}', 
                `rank` = '{$row['rank']}', 
                `subject` = '{$row['subject']}',
                `day` = '{$day}',
                `reset` = '{$row['reset']}',
                `reset2` = '{$row['reset2']}',
                `reset3` = '{$row['reset3']}',
                `reset4` = '{$row['reset4']}',
                `reset5` = '{$row['reset5']}',
                `reset6` = '{$row['reset6']}',
                `point` = '10',
                `datetime` = '{$dates[$i]}'";
        sql_query($sql_ins);
        $c += 1;
    }
}
include_once(G5_PATH.'/head.php');
?>
