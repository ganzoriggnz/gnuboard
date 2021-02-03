<?php
include_once('./_common.php');

include_once('./_head.php');

if ($is_guest)
    alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$g5['title'] = get_text($member['mb_nick']).' 님의 포인트 내역';
include_once(G5_PATH.'/head.sub.php');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['pet_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['pet_table']} (   
        p_no int(11) NOT NULL AUTO_INCREMENT,
        mb_id varchar(20) NOT NULL DEFAULT '',        
        p_but1_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        p_but2_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        p_but3_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (p_no),
        INDEX (mb_id)
    )";

   sql_query($sql_table, false);
}

$now = G5_TIME_YMDHIS;
$p_date = date_create($now);
$p_begin_date = date_format($p_date, 'Y-m-d 00:00:00');
$p_end_date = date_format($p_date, 'Y-m-d 23:59:59');

$res = "SELECT * FROM {$g5['pet_table']} WHERE mb_id = '{$member['mb_id']}' AND  p_but1_datetime > '{$p_begin_date}' AND '{$p_end_date}' >=  p_but1_datetime AND '{$p_end_date}' >=  p_but2_datetime AND '{$p_end_date}' >=  p_but3_datetime";
$row = sql_fetch($res);
$pet_skin_path = get_skin_path('pet', 'NB-Basic');
$pet_skin_url  = get_skin_url('pet', 'NB-Basic');
$skin_file = $pet_skin_path.'/pet.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('./_tail.php');
?>