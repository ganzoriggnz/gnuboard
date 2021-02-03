<?php 

include_once('./_common.php');

//dbconfig파일에 $g5['content_table'] 배열변수가 있는지 체크
if( !isset($g5['member_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->내용 관리를 먼저 확인해 주세요.');
}

if (!$is_member)
alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

// 내용

/* if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/coupon_accept.php');
    return;
} */

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5['title'] = '쿠폰지원 목록';

$co_created_datetime = G5_TIME_YMDHIS;
$currentmonth = substr($co_created_datetime, 5, 2);
$co_start = date_create($co_created_datetime);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');

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

$sql_acc = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='N'";
$now = G5_TIME_YMDHIS;
$res_acc = sql_query($sql_acc);
while($row_acc = sql_fetch_array($res_acc)){
    $date = date($row_acc['cos_created_datetime']);
    $finish_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));
    if($now >= $finish_date){
        $sql_ac = "DELETE FROM {$g5['coupon_sent_table']} WHERE cos_nick = '{$row_acc['cos_nick']}' AND cos_no = '{$row_acc['cos_no']}'";
        sql_query($sql_ac);

        if($row_acc['cos_type'] == 'S'){
            $sql1 = " UPDATE {$g5['coupon_table']}
                    SET co_sent_snum = co_sent_snum - 1
                    WHERE co_no = '{$row_acc['co_no']}' "; 
            sql_query($sql1);
        } else if($row_acc['cos_type'] == 'F') {
            $sql1 = " UPDATE {$g5['coupon_table']}
                    SET co_sent_fnum = co_sent_fnum - 1
                    WHERE co_no = '{$row_acc['co_no']}' "; 
            sql_query($sql1);
        }
    }
}

$coupon_accept_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_accept_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_accept_skin_path.'/coupon_accept.skin.php';

$coupon_accept_action_url = G5_BBS_URL.'/coupon_accept_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

$sql_customer = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_nick='{$member['mb_nick']}'";

    include_once('./_tail.php');
?>