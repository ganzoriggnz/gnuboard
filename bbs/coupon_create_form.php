<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

$sql = "select * from $g5[coupon_table] where mb_id = '{$member['mb_id']}'";
$row = sql_fetch($sql);
if($row['co_no'])
    $w = 'u';
else 
    $w = '';



$co_mb_id = trim($member['mb_id']);
$co_entity = $member['mb_name'];

if($w == ''){ 
    $sql = " insert into $g5[coupon_table]
                set mb_id = '{$co_mb_id}',
                    co_entity = '{$co_entity}',
                    co_sale = '{$_POST['co_sale']}',
                    co_free = '{$_POST['co_free']}',
                    co_created_date = '".G5_TIME_YMDHIS."' "; 
    sql_query($sql);

} else if($w == 'u'){
    $sql = " update $g5[coupon_table]
                set co_sale = '{$_POST['co_sale']}',
                    co_free = '{$_POST['co_free']}',
                    co_updated_date = '".G5_TIME_YMDHIS."' 
                where mb_id = '{$co_mb_id}'"; 
    sql_query($sql);   
}

goto_url(G5_HTTP_BBS_URL.'/coupon_create.php');
    
?>