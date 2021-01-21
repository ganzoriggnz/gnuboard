<?php 
$sub_menu = "700100";
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

$mb_id = $_POST['mb_id'];
$co_entity = $_POST['co_entity'];
$co_sale_num = $_POST['co_sale_num']; 
$co_free_num = $_POST['co_free_num'];
$cos_link = $_POST['cos_link'];
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

$sql = "SELECT COUNT(co_no) as cnt FROM $g5[coupon_table] WHERE mb_id = '{$mb_id}' AND co_begin_datetime='{$s_begin_date}' AND co_end_datetime='{$s_end_date}'";
$row = sql_fetch($sql);
$cnt = $row['cnt'];
if($cnt > 0)
    $w = 'u';
else 
    $w = ''; 

if($w == ''){    
    $sql = " INSERT INTO $g5[coupon_table]
                SET mb_id = '{$mb_id}',
                    co_entity = '{$co_entity}',
                    co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_created_datetime = '{$co_created_datetime}', 
                    co_begin_datetime = '{$co_begin_datetime}',
                    co_end_datetime = '{$co_end_datetime}' ";
    sql_query($sql);

} else if($w == 'u'){
    $sql = " UPDATE $g5[coupon_table]
                SET co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_updated_datetime =  '{$co_created_datetime}'
              WHERE mb_id = '{$mb_id}' AND co_begin_datetime='{$s_begin_date}' AND co_end_datetime='{$s_end_date}' "; 
    sql_query($sql);   
}  

goto_url(G5_ADMIN_URL.'/coupon_list.php?bo_table='.$cos_link);
    
?>