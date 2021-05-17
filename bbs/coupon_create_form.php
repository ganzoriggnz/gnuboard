<?php 
include_once('./_common.php');

if (!$is_member)
   alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$mb_id = trim($member['mb_id']);
$co_entity = $member['mb_name'];
$bo_table = $member['mb_6'];
$co_sale_num = $_POST['co_sale_num']; 
$co_free_num = $_POST['co_free_num'];
$co_created_datetime = G5_TIME_YMDHIS;
$currentyear = substr($co_created_datetime, 0, 4);
$currentmonth = substr($co_created_datetime, 5, 2);
$co_start = date_create($co_created_datetime);
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
                    co_created_datetime = '{$co_created_datetime}', 
                    co_begin_datetime = '{$co_begin_datetime}',
                    co_end_datetime = '{$co_end_datetime}' ";
    sql_query($sql);

} else if($w == 'u'){
    $sql = " UPDATE {$g5['coupon_table']}
                SET co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_updated_datetime =  '{$co_created_datetime}'
              WHERE mb_id = '{$mb_id}' AND co_begin_datetime='{$co_begin_datetime}' AND co_end_datetime='{$co_end_datetime}' "; 
    sql_query($sql);   
}  

goto_url(G5_HTTP_BBS_URL.'/coupon_create.php');
    
?>