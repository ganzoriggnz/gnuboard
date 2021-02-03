<?php
include_once('./_common.php');

if (!$is_member) die('');

if(isset($_POST['id']))
{
    $mb_id = $_POST['id'];
    $now = G5_TIME_YMDHIS;
    $date= date_create($now);
    $start_date = date_format($date, 'Y-m-d 00:00:00');
    $end_date = date_format($date, 'Y-m-d 23:59:59');

    $sql1 = " INSERT INTO {$g5['mission_table']} 
                SET mb_id = '{$mb_id}',
                    m_datetime = '{$now}'";
    sql_query($sql1);

    insert_point($mb_id, 300, "일일미션 포인트", "@mission", $member['mb_nick'], G5_TIME_YMD);

}

goto_url(G5_HTTP_BBS_URL.'/mission.php');

?>