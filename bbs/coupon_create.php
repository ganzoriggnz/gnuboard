<?php
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['couponsent_table'] = $g5['table_prefix'] . "couponsent";    // 쿠폰 테이블

if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[coupon_table]",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE $g5[coupon_table] (   
        co_no int(11) NOT NULL AUTO_INCREMENT,         
        mb_id varchar(20) NOT NULL DEFAULT '',
        co_entity varchar(20) NOT NULL DEFAULT '',
        co_sale_num int(11) NOT NULL DEFAULT '0',
        co_free_num int(11) NOT NULL DEFAULT '0',
        co_created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_updated datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_begin_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_end_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (co_no)
    )";

   sql_query($sql_table, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[couponsent_table]",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE $g5[couponsent_table] (
        cos_no int(11) NOT NULL AUTO_INCREMENT,
        co_no int(11) NOT NULL,   
        cos_code varchar(4) NOT NULL, 
        cos_entity varchar(20) NOT NULL DEFAULT '',        
        cos_nick varchar(20) NOT NULL DEFAULT '',
        cos_type varchar(1) NOT NULL DEFAULT '',
        cos_accept varchar(1) NOT NULL DEFAULT '',
        cos_post varchar(1) NOT NULL DEFAULT '',
        cos_created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        UNIQUE (cos_code),
        PRIMARY KEY (cos_no),
        FOREIGN KEY (co_no) 
            REFERENCES $g5[coupon_table](co_no) 
            ON DELETE CASCADE
    )";

   sql_query($sql_table, false);
}   



function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }

$mb_id = trim($member['mb_id']);
$co_entity = $member['mb_name'];
$co_created = G5_TIME_YMDHIS;
$currentmonth = substr($co_created, 5, 2);
$nmonth = 1;
$final = endCycle($co_created, $nmonth);
$co_start = date_create($co_created);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');
$nextmonth = substr($final, 5, 2);
$final = date_create($final);
$co_begin_date = date_format($final, 'Y-m-01 00:00:00');

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
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '02')
$co_end_date = date_format($final, 'Y-m-28 23:59:59');
else if($nextmonth == '03')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '04')
$co_end_date = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '05')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '06')
$co_end_date = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '07')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '08')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '09')
$co_end_date = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '10')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');
else if($nextmonth == '11')
$co_end_date = date_format($final, 'Y-m-30 23:59:59');
else if($nextmonth == '12')
$co_end_date = date_format($final, 'Y-m-31 23:59:59');

$sql = "SELECT * FROM $g5[coupon_table] WHERE mb_id = '{$member['mb_id']}' AND co_begin_date='$co_begin_date' AND co_end_date='$co_end_date'";
$row = sql_fetch($sql);
if($row['co_code']){ 
    $sdate = $row['co_created'];
    $fdate = date_create_from_format('Y-m-d H:i:s', $sdate);
   $fdate= date_format($fdate, 'Y-m-31 H:i:s');   
}  

$sql1 = "SELECT * FROM $g5[coupon_table] WHERE mb_id = '{$member['mb_id']}' AND co_begin_date='$s_begin_date' AND co_end_date='$s_end_date'";
$row1 = sql_fetch($sql1);
$co_sale_num = number_format($row1['co_sale_num']);
$co_free_num = number_format($row1['co_free_num']);
$co_no = $row1['co_no'];

$sql2 = "SELECT COUNT(cos_no) as cnt FROM $g5[couponsent_table] WHERE co_no = '{$co_no}' AND cos_type = 'S' ";
$row2 = sql_fetch($sql2);
$s2= number_format($row2['cnt']);
$sql3 = "SELECT COUNT(cos_no) as cnt FROM $g5[couponsent_table] WHERE co_no = '{$co_no}' AND cos_type = 'F' ";
$row3 = sql_fetch($sql3);
$f2 = number_format($row3['cnt']);

$diff_s = $co_sale_num - $s2;
$diff_f = $co_free_num - $f2;

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