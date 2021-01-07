<?php 
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

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
$co_created = G5_TIME_YMDHIS;
$currentmonth = substr($co_created, 5, 2);
$nmonth = 1;
$final = endCycle($co_created, $nmonth);
$co_start = date_create($co_created);
$s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');
$nextmonth = substr($final, 5, 2);
$final = date_create($final);
$co_begin_date = date_format($final, 'Y-m-01 00:00:00');

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

$sql = "SELECT COUNT(co_no) as cnt FROM $g5[coupon_table] WHERE mb_id = '{$mb_id}' AND co_begin_date='{$co_begin_date}' AND co_end_date='{$co_end_date}'";
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
                    co_created = '{$co_created}', 
                    co_begin_date = '{$co_begin_date}',
                    co_end_date = '{$co_end_date}' ";
    sql_query($sql);

} else if($w == 'u'){
    $sql = " UPDATE $g5[coupon_table]
                SET co_sale_num = '{$_POST['co_sale_num']}',
                    co_free_num = '{$_POST['co_free_num']}',
                    co_updated =  '{$co_created}'
              WHERE mb_id = '{$mb_id}' AND co_begin_date='{$co_begin_date}' AND co_end_date='{$co_end_date}' "; 
    sql_query($sql);   
}  

goto_url(G5_HTTP_BBS_URL.'/coupon_create.php');
    
?>