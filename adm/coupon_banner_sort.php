<?php 
$sub_menu = "700400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start, $currentyear, $currentmonth);

$sql_common = " from {$g5['coupon_table']} a INNER JOIN {$g5['member_table']} b ON a.mb_id=b.mb_id INNER JOIN {$g5['board_table']} c ON a.bo_table=c.bo_table";

$sql_search = " where (b.mb_level='26' or b.mb_level='27') and ((a.co_sale_num > '0' or a.co_free_num > '0') and  a.co_begin_datetime = '{$co_begin_datetime}' and a.co_end_datetime = '{$co_end_datetime}')";

$output = ''; 
$k=0; 
$order = $_POST["order"];  
if($order == 'desc')  
{  
     $order = 'asc';  
}  
else  
{  
     $order = 'desc';  
}  

$sql_order = 'order by '.$_POST["column_name"].' '.$_POST["order"];

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows=100;
$total_page  = ceil($total_count / $rows); 
if ($page < 1) $page = 1; 
$from_record = ($page - 1) * $rows; 

$sql = " select a.mb_id, a.co_entity, a.co_sale_num as sale, a.co_free_num as free, a.wr_id, a.bo_table, b.mb_nick, b.mb_level, b.mb_homepage, b.mb_point, b.mb_7, c.bo_subject, c.bo_order
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows}";
$result = sql_query($sql);

$output .= '  
<table>
    <thead>
        <tr>  
            <th>no</th>  
            <th><a class="column_sort" id="mb_id" data-order="'.$order.'" href="#" style="text-decoration: none;">아이디</a></th>  
            <th><a class="column_sort" id="mb_nick" data-order="'.$order.'" href="#" style="text-decoration: none;">닉네임</a></th> 
            <th><a class="column_sort" id="co_entity" data-order="'.$order.'" href="#" style="text-decoration: none;">업소명</a></th>  
            <th><a class="column_sort" id="mb_level" data-order="'.$order.'" href="#" style="text-decoration: none;">레벨</a></th>  
            <th><a class="column_sort" id="bo_order" data-order="'.$order.'" href="#" style="text-decoration: none;">분류</a></th>  
            <th><a class="column_sort" id="sale" data-order="'.$order.'" href="#" style="text-decoration: none;">쿠폰</a></th>  
            <th>출근부 글</th>  
        </tr> 
    </thead>
    <tbody> 
';  
while($row = sql_fetch_array($result))  
{  
    $mb_nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);

    $link1 = $link2 = '';
    if (!preg_match("/^\@/", $row['bo_table']) && $row['bo_table']) {
        $link1 = '<a href="'.get_pretty_url($row['bo_table'], $row['wr_id']).'" target="_blank" style="color: blue; text-decoration: underline;">';
        $link2 = '</a>';
    }
    //$bg = 'bg'.($i%2);
     $output .= '  
        <tr>  
            <td class="td_center">'.($k+=1).'</td>
            <td class="td_left">'.$row['mb_id'].'</td>
            <td class="td_left sv_use"><div>'.$mb_nick.'</div></td>
            <td class="td_left">'.get_text($row['co_entity']).'</td>      
            <td class="td_center">'.$row['mb_level'].'</td>
            <td class="td_left">'.$row['bo_subject'].'-'.$row['mb_7'].'</td>
            <td class="td_center">원가권 '.$row['sale'].' 무료권 '.$row['free'].'</td>
            <td class="td_center">'.$link1.'바로가기'.$link2.'</td>
        </tr>  
        ';  
}  
$output .= '</tbody></table>';  
echo $output;  
?>