<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

$sql = "select * from $g5[coupon_table] where mb_id = '{$member['mb_id']}'";
$row1 = sql_fetch($sql);
/* if($row['co_no'])
    $w = 'u';
else 
    $w = ''; */



/* $co_mb_id = trim($member['mb_id']);
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
} */

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
        
function searchDB($coupon){
    $rs = sql_query("SELECT count(*) AS cnt FROM `g5_coupon` WHERE co_code = '$coupon'");
    $row = sql_fetch($rs);
    $cnt = $row['cnt'];
    if($cnt > 0){
        return '1';
    } else {
        return '0';
    }
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
$co_sale_num = $_POST['co_sale_num']; 
$co_free_num = $_POST['co_free_num'];
$co_created = date('Y-m-d H:i:s');
$currentmonth = substr($co_created, 5, 2);
$nmonth = 1;
$final = endCycle($co_created, $nmonth);
$co_start = date_create($co_created);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');
$nextmonth = substr($final, 5, 2);
$final = date_create($final);
$co_begin_date = date_format($co_start, 'Y-m-01 00:00:00');
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


function searchCoupon($mb_id, $s_begin_date, $s_end_date){
    $rs = sql_query("SELECT COUNT(*) AS cnt FROM `g5_coupon` WHERE mb_id = '$mb_id' AND co_begin_date = '$s_begin_date' AND co_end_date = '$s_end_date'");
    $row = sql_fetch($rs);
    $cnt = $row['cnt'];
    if($cnt > 0){
        return '1';
    } else {
        return '0';
    }
}

function checkfreeCoupon($coupon, $mb_id, $co_entity, $co_free_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date){
    /* $dbres1 = searchCoupon($mb_id, $s_begin_date, $s_end_date);
    if($dbres1 == '1'){
        $sql1 = " DELETE FROM `g5_coupon` WHERE mb_id = '$mb_id' AND co_begin_date = '$s_begin_date' AND co_end_date = '$s_end_date'";
        sql_query($sql1);
    } */
    $sql1 = " DELETE FROM `g5_coupon` WHERE mb_id = '$mb_id' AND co_begin_date = '$s_begin_date' AND co_end_date = '$s_end_date'";
    sql_query($sql1);
    $dbres = searchDB($coupon);
    if($dbres == '1'){ //coupon found in db
        $val = '0';
        $coupon = generateCode(); //generate a new coupon
        checkfreeCoupon($coupon, $mb_id, $co_entity, $co_free_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date); //repeat the process
    } 
    else { // coupon is unique
            $sql = "INSERT INTO `g5_coupon`
            set co_code = '{$coupon}',
                mb_id = '{$mb_id}',
                co_entity = '{$co_entity}',
                co_free_num = '{$_POST['co_free_num']}',
                co_status = 'N',
                co_created = '{$co_created}',
                co_begin_date = '{$co_begin_date}',
                co_end_date = '{$co_end_date}' ";
            sql_query($sql);

        $val = '1';
    }

    return $val;
}

function checksaleCoupon($coupon, $mb_id, $co_entity, $co_sale_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date){
    $sql1 = " DELETE FROM `g5_coupon` WHERE mb_id = '$mb_id' AND co_begin_date = '$s_begin_date' AND co_end_date = '$s_end_date'";
    sql_query($sql1);

    $dbres = searchDB($coupon);
    if($dbres == '1'){ //coupon found in db
        $val = '0';
        $coupon = generateCode(); //generate a new coupon
        checksaleCoupon($coupon, $mb_id, $co_entity, $co_sale_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date); //repeat the process
    } 
    else { // coupon is unique
            $sql = "INSERT INTO `g5_coupon`
            set co_code = '{$coupon}',
                mb_id = '{$mb_id}',
                co_entity = '{$co_entity}',
                co_sale_num = '{$_POST['co_sale_num']}',
                co_status = 'N',
                co_created = '{$co_created}',
                co_begin_date = '{$co_begin_date}',
                co_end_date = '{$co_end_date}' ";
            sql_query($sql);

        $val = '1';
    }

    return $val;
}

for ($i = 1; $i <= $co_free_num; $i++) {
    
    $coupon = generateCode();

    do {

        $result = checkfreeCoupon($coupon, $mb_id, $co_entity, $co_free_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date);

    } while ($result != '1');

}

for ($i = 1; $i <= $co_sale_num; $i++) {

    $coupon = generateCode();

    do {

        $result = checksaleCoupon($coupon, $mb_id, $co_entity, $co_sale_num, $co_created, $co_begin_date, $co_end_date, $s_begin_date, $s_end_date);

    } while ($result != '1');

}

goto_url(G5_HTTP_BBS_URL.'/coupon_create.php');
    
?>