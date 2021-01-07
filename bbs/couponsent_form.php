<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['couponsent_table'] = $g5['table_prefix'] . "couponsent";    // 쿠폰 테이블8

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

$cos_created = G5_TIME_YMDHIS;

$coupon = generateCode(); 

$sql = " INSERT INTO $g5[couponsent_table]
            SET co_no = '{$_POST['co_no']}',
                cos_code = '{$coupon}',
                cos_entity = '{$_POST['cos_entity']}',
                cos_nick = '{$_POST['cos_nick']}',
                cos_type = '{$_POST['cos_type']}',
                cos_created = '{$cos_created}' ";
sql_query($sql);
 
goto_url(G5_HTTP_BBS_URL.'/coupon_list.php');
?>