<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
$g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블

function generateCode() {
    $len = 4;
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';

    srand((double)microtime()*1000000);

    $i = 0;
    $coupon = '';

    while ($i < $len) {
        $num = rand() % strlen($chars);
        $tmp = substr($chars, $num, 1);
        $coupon .= $tmp;
        $i++;
    }

    $coupon = preg_replace('/([0-9A-Z]{4})/', '\1', $coupon);

    return $coupon;
}

$cos_created_datetime = G5_TIME_YMDHIS;
$cos_link = $_POST['cos_link'];
$cos_type = $_POST['cos_type'];

$coupon = generateCode(); 

$sql = " INSERT INTO {$g5[coupon_sent_table]}
            SET co_no = '{$_POST['co_no']}',
                cos_code = '{$coupon}',
                cos_entity = '{$_POST['cos_entity']}',
                cos_nick = '{$_POST['cos_nick']}',
                cos_type = '{$_POST['cos_type']}',
                cos_created_datetime = '{$cos_created_datetime}' ";
sql_query($sql);

if($cos_type == 'S'){
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_snum = co_sent_snum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
} else if($cos_type == 'F') {
    $sql1 = " UPDATE $g5[coupon_table]
            SET co_sent_fnum = co_sent_fnum + 1
            WHERE co_no = '{$_POST['co_no']}' "; 
    sql_query($sql1);
}


goto_url(G5_HTTP_BBS_URL.'/coupon_list.php?bo_table='.$cos_link); 
?>