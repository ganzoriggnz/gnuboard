<?php 
$sub_menu = "700100";
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');

$co_no = $_POST['co_no'];
$mb_id = $_POST['mb_id'];
$bo_table = $_POST['mb_6'];
$co_entity = $_POST['co_entity'];
$cos_link = $_POST['cos_link'];
$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');

if($currentmonth == '01')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '02')
$co_end_datetime = 
    ($currentyear % 4 ? date_format($co_start, 'Y-m-28 23:59:59') : 
    ($currentyear % 100 ? date_format($co_start, 'Y-m-29 23:59:59') : 
    ($currentyear % 400 ? date_format($co_start, 'Y-m-28 23:59:59') : 
    date_format($co_start, 'Y-m-29 23:59:59'))));
else if($currentmonth == '03')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '04')
$co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '05')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '06')
$co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '07')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '08')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '09')
$co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '10')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
else if($currentmonth == '11')
$co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
else if($currentmonth == '12')
$co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');

$at_table = $g5['write_prefix'].$bo_table;

$sql1 = "SELECT wr_id FROM $at_table WHERE mb_id = '{$mb_id}' AND wr_is_comment = '0'";
$row1 = sql_fetch($sql1);

$sql = "SELECT COUNT(co_no) as cnt FROM {$g5['coupon_table']} WHERE mb_id = '{$mb_id}' AND co_begin_datetime='{$co_begin_datetime}' AND co_end_datetime='{$co_end_datetime}'";
$row = sql_fetch($sql);
$cnt = $row['cnt'];
if($cnt > 0)
    $w = 'u';
else 
    $w = ''; 

if($w == ''){    
    $sql = " INSERT INTO {$g5['coupon_table']}
                SET wr_id = '{$row1['wr_id'],
                    mb_id = '{$mb_id}',
                    bo_table = '{$bo_table}',
                    co_entity = '{$co_entity}',
                    co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_created_datetime = '{$now}', 
                    co_begin_datetime = '{$co_begin_datetime}',
                    co_end_datetime = '{$co_end_datetime}' ";
    sql_query($sql);
    echo $sql;

} else if($w == 'u'){
    $sql = " UPDATE {$g5['coupon_table']}
                SET co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_updated_datetime =  '{$now}'
              WHERE co_no = '{$co_no}' AND co_begin_datetime='{$co_begin_datetime}' AND co_end_datetime='{$co_end_datetime}' "; 
    sql_query($sql);   
}  

goto_url(G5_ADMIN_URL.'/coupon_list.php?bo_table='.$cos_link);
    
?>