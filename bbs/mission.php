<?php
include_once('./_common.php');

if (!$is_member)
    alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$mission_skin_url.'/style.css">', 0);

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['read_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['read_table']} (   
        r_no int(11) NOT NULL AUTO_INCREMENT,
        mb_id varchar(20) NOT NULL DEFAULT '',
        gr_id varchar(20) NOT NULL DEFAULT '', 
        r_board varchar(30) NOT NULL DEFAULT '',
        r_hit int(11) NOT NULL DEFAULT '0',       
        r_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (r_no),
        INDEX (mb_id)
    )";
   sql_query($sql_table, false);
}

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['mission_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table1 = "CREATE TABLE {$g5['mission_table']} (   
        m_no int(11) NOT NULL AUTO_INCREMENT,
        mb_id varchar(20) NOT NULL DEFAULT '',       
        m_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (m_no),
        INDEX (mb_id)
    )";
   sql_query($sql_table1, false);
}

$bo_table = "free";
$tmp_table = $g5['write_prefix'].$bo_table;
$now = G5_TIME_YMDHIS;
$date= date_create($now);
$start_date = date_format($date, 'Y-m-d 00:00:00');
/* $end_date = date_format($date, 'Y-m-d 23:59:59'); */
$end_date = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($date)));

$q = "SELECT COUNT(*) as cnt FROM {$tmp_table} WHERE mb_id='{$member['mb_id']}' AND wr_is_comment = '0' AND wr_datetime BETWEEN '{$start_date}' AND '{$end_date}'";
$row = sql_fetch($q);
$cnt = $row['cnt'];

$q1 = "SELECT COUNT(*) as cnt FROM {$tmp_table} WHERE mb_id='{$member['mb_id']}' AND wr_is_comment = '1' AND wr_datetime BETWEEN '{$start_date}' AND '{$end_date}'";
$row1 = sql_fetch($q1);
$cnt1 = $row1['cnt'];

$q_at = "SELECT COUNT(*) as cnt FROM {$g5['attendance_table']} WHERE mb_id='{$member['mb_id']}' AND `datetime` BETWEEN '{$start_date}' and '{$end_date}'";
$row_at = sql_fetch($q_at);
$cnt_at = $row_at['cnt'];

$res = "SELECT * FROM {$g5['pet_table']} WHERE mb_id = '{$member['mb_id']}' AND  p_but1_datetime > '{$start_date}' AND '{$end_date}' >=  p_but1_datetime AND '{$end_date}' >=  p_but2_datetime AND '{$end_date}' >=  p_but3_datetime";
$row2 = sql_fetch($res);

$q_att = "SELECT COUNT(*) as cnt_att FROM {$g5['read_table']} WHERE mb_id = '{$member['mb_id']}' AND gr_id = 'attendance' AND r_datetime BETWEEN '{$start_date}' and '{$end_date}'";
$row_att = sql_fetch($q_att);
$cnt_att = $row_att['cnt_att'];

$q_rev = "SELECT COUNT(*) as cnt_rev FROM {$g5['read_table']} WHERE mb_id = '{$member['mb_id']}' AND gr_id = 'review' AND r_datetime BETWEEN '{$start_date}' and '{$end_date}'";
$row_rev = sql_fetch($q_rev);
$cnt_rev = $row_rev['cnt_rev'];



$mission_skin_path = get_skin_path('mission', 'NB-Basic');
$mission_skin_url  = get_skin_url('mission', 'NB-Basic');
$skin_file = $mission_skin_path.'/mission.skin.php';


if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}
?>

<?php
    include_once('./_tail.php');
?>
