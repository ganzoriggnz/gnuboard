<?php
include_once('./_common.php');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['coupon_table']} (   
        co_no int(11) NOT NULL AUTO_INCREMENT,         
        mb_id varchar(20) NOT NULL DEFAULT '',
        co_entity varchar(20) NOT NULL DEFAULT '',
        co_sale_num int(11) NOT NULL DEFAULT '0',
        co_free_num int(11) NOT NULL DEFAULT '0',
        co_sent_snum int(11) NOT NULL DEFAULT '0',
        co_sent_fnum int(11) NOT NULL DEFAULT '0',
        co_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_updated_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_begin_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_end_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (co_no), 
        INDEX (mb_id, co_entity)
    )";

   sql_query($sql_table, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_sent_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table1 = "CREATE TABLE {$g5['coupon_sent_table']} (
        cos_no int(11) NOT NULL AUTO_INCREMENT,
        co_no int(11) NOT NULL,   
        cos_code varchar(4) NOT NULL, 
        cos_entity varchar(20) NOT NULL DEFAULT '',        
        cos_nick varchar(20) NOT NULL DEFAULT '',
        cos_type varchar(1) NOT NULL DEFAULT '',
        cos_accept varchar(1) NOT NULL DEFAULT 'N',
        cos_alt_quantity int(11) NOT NULL DEFAULT '0',
        cos_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        cos_accepted_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        cos_post_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        UNIQUE (cos_code),
        PRIMARY KEY (cos_no),
        INDEX (cos_code, cos_entity, cos_nick),
        FOREIGN KEY (co_no) 
            REFERENCES $g5[coupon_table](co_no) 
            ON DELETE CASCADE
    )";

   sql_query($sql_table1, false);
}  

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_alert_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table2 = "CREATE TABLE {$g5['coupon_alert_table']} (
        alt_no int(11) NOT NULL AUTO_INCREMENT, 
        cos_no int(11) NOT NULL DEFAULT '0',
        cos_nick varchar(20) NOT NULL DEFAULT '',
        cos_entity varchar(20) NOT NULL DEFAULT '',             
        cos_alt_quantity int(11) NOT NULL DEFAULT '0',
        alt_reason varchar(20) NOT NULL DEFAULT '',
        alt_created_by varchar(20) NOT NULL DEFAULT '',
        alt_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (alt_no),
        INDEX (cos_nick, cos_entity)
    )";

   sql_query($sql_table2, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_msg_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table3 = "CREATE TABLE {$g5['coupon_msg_table']} (
        msg_no int(11) NOT NULL AUTO_INCREMENT, 
        msg_customer_text text(255) NOT NULL DEFAULT '',  
        msg_entity_text text(255) NOT NULL DEFAULT '',           
        msg_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (msg_no),
        INDEX (msg_created_datetime)
    )";

   sql_query($sql_table3, false);
}   

$mb_id = trim($member['mb_id']);
$co_entity = $member['mb_name'];
$co_created_datetime = G5_TIME_YMDHIS;
$currentmonth = substr($co_created_datetime, 5, 2);
$co_start = date_create($co_created_datetime);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');

$date = date('Y-m-01');
$newdate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($date)));
$final = date_create($newdate);
$nextmonth = substr($newdate, 5, 2);
$co_begin_datetime = $newdate;

if($currentmonth == '01')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '02')
$s_end_date = date_format($co_start, 'Y-m-28 23:59:59');
else if($currentmonth == '03')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '04')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '05')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '06')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '07')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '08')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '09')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '10')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '11')
$s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '12')
$s_end_date = date_format($co_start, 'Y-m-31 23:59:59');

if($nextmonth == '01')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '02')
$co_end_datetime = date_format($final, 'Y-m-28 23:59:59');
else if($nextmonth == '03')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '04')
$co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '05')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '06')
$co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '07')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '08')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '09')
$co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '10')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '11')
$co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '12')
$co_end_datetime = date_format($final, 'Y-m-31 23:59:59');

$sql = " SELECT * FROM {$g5['coupon_table']} WHERE mb_id = '{$mb_id}' AND co_begin_datetime ='{$co_begin_datetime}' AND co_end_datetime ='{$co_end_datetime}'";
$row = sql_fetch($sql); 

$sql1 = "SELECT * FROM {$g5['coupon_table']} WHERE mb_id = '{$member['mb_id']}' AND co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
$row1 = sql_fetch($sql1);

$diff_s = number_format($row1['co_sale_num'] - $row1['co_sent_snum']);
$diff_f = number_format($row1['co_free_num'] - $row1['co_sent_fnum']);

//dbconfig파일에 $g5['content_table'] 배열변수가 있는지 체크
if( !isset($g5['member_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->내용 관리를 먼저 확인해 주세요.');
}

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

// 내용

/* if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/coupon_create.php');
    return;
} */

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$coupon_create_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_create_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_create_skin_path.'/coupon_create.skin.php';

$coupon_action_url = G5_BBS_URL.'/coupon_create_form.php'; 

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once('./_tail.php');
?>