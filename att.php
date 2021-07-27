<?php
// header("Location: https://bamje1.com/error.php");
// // echo "error";
// exit();  
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-22 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}

$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-17 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}
$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-18 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}

$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-19 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}
$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-20 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}
$sql = "select distinct(mb_id) mb_id from g5_attendance where day=0 and sumday=0 and reset=0 and reset2=0 and reset3=0 and reset4=0 and reset5=0 and reset6=0 and `datetime`='2021-07-21 00:00:00';";

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
while ($row = sql_fetch_array($datas)) {
    $sql_fetch = sql_fetch("select po_mb_point from g5_point where mb_id='{$row['mb_id']}' order by `po_mb_point` desc limit 1;");
    $p = $sql_fetch['po_mb_point']+10;
    $sql_ins = " INSERT INTO {$g5['point_table']} 
        SET `mb_id` = '{$row['mb_id']}', 
            `po_datetime` = '{$now}', 
            `po_content` = '서버점검 보상',
            `po_point` = '10',
            `po_use_point` = '10',
            `po_expired` = '0',
            `po_expire_date` = '9999-12-31',
            `po_mb_point` = '{$p}',
            `po_rel_table` = '@attendance',
            `po_rel_action` = '서버점검 보상'";
    sql_query($sql_ins);
}

include_once(G5_PATH.'/head.php');
?>
