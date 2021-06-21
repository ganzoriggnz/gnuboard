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
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

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
                SET wr_id = '{$row1['wr_id']}',
                    mb_id = '{$mb_id}',
                    bo_table = '{$bo_table}',
                    co_entity = '{$co_entity}',
                    co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_created_datetime = '{$now}', 
                    co_begin_datetime = '{$co_begin_datetime}',
                    co_end_datetime = '{$co_end_datetime}' ";
    sql_query($sql);

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