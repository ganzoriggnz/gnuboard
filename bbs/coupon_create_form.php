<?php 
include_once('./_common.php');
    $co_mb_id = trim($member['mb_id']);
    $co_entity =trim($member['mb_name']);
    $co_sale = trim($POST['co_sale']);
    $co_free = trim($POST['co_free']);

    $g5['connect_db'] = $connect_db;
    $sql = "insert into `g5_coupon`
                set co_mb_id = '{$co_mb_id}',
                    co_entity = '{$co_entity}',
                    co_sale = '{$co_sale}',
                    co_free = '{$co_free}',
                    co_s_date ='".G5_TIME_YMDHIS."'";
    sql_query($sql);
    goto_url(G5_HTTP_BBS_URL.'/coupon_create.php');
?>