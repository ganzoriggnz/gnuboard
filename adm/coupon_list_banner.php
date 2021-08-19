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

$sql_search = " where (b.mb_level='26' or b.mb_level='27') and (a.co_begin_datetime = '{$co_begin_datetime}' and a.co_end_datetime = '{$co_end_datetime}')";

$sql_order = " order by c.bo_order asc";

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
//$list_num = $total_count - ($page - 1) * $rows;

$sql = " select a.mb_id, a.co_entity, a.co_sale_num as sale, a.co_free_num as free, a.wr_id, a.bo_table, b.mb_nick, b.mb_level, b.mb_homepage, b.mb_point, b.mb_7, c.bo_subject, c.bo_order
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows}";
            var_dump($sql);die;

$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = "쿠폰배너 업소 리스트";
include_once('./admin.head.php');

$colspan = 8;

?>

<div class="tbl_head01 tbl_wrap" id="coupon_banner">
    <table>
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col"><a class="column_sort" id="mb_id" data-order="desc" href="#" style="text-decoration: none;">아이디</a></th>
                <th scope="col"><a class="column_sort" id="mb_nick" data-order="desc" href="#" style="text-decoration: none;">닉네임</a></th>
                <th scope="col"><a class="column_sort" id="co_entity" data-order="desc" href="#" style="text-decoration: none;">업소명</a></th>
                <th scope="col"><a class="column_sort" id="mb_level" data-order="desc" href="#" style="text-decoration: none;">레벨</a></th>
                <th scope="col"><a class="column_sort" id="bo_order" data-order="desc" href="#" style="text-decoration: none;">분류 &#9660</a></th>
                <th scope="col"><a class="column_sort" id="co_sale_num" data-order="desc" href="#" style="text-decoration: none;">쿠폰</a></th>
                <th scope="col">출근부 글</th>
            </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
    
            $mb_nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);

            $link1 = $link2 = '';
            if (!preg_match("/^\@/", $row['bo_table']) && $row['bo_table']) {
                $link1 = '<a href="'.get_pretty_url($row['bo_table'], $row['wr_id']).'" target="_blank" style="color: blue; text-decoration: underline;">';
                $link2 = '</a>';
            }
            //$bg = 'bg'.($i%2);
        ?>
            <tr>
                <td class="td_center"><?php echo number_format($i+1+($page - 1) * $rows) ?></td>
                <td class="td_left"><?php echo $row['mb_id']; ?></td>
                <td class="td_left sv_use"><div><?php echo $mb_nick; ?></div></td>
                <td class="td_left"><?php echo get_text($row['co_entity']); ?></td>      
                <td class="td_center"><?php echo $row['mb_level']; ?></td>
                <td class="td_left"><?php echo $row['bo_subject'].'-'.$row['mb_7'];?></td>
                <td class="td_center"><?php echo '원가권 '.$row['sale'].' 무료권 '.$row['free']; ?></td>
                <td class="td_center"><?php echo $link1; ?><?php echo '바로가기'; ?><?php echo $link2; ?></td>
            </tr>    
        <?php    
        }
        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
    </table>
</div>
<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = '';  
           if(order == 'desc')  
           {  
                arrow = '&nbsp;&#9650';  
           }  
           else  
           {  
                arrow = '&nbsp;&#9660';  
           }  
           $.ajax({  
                url:"coupon_banner_sort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#coupon_banner').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });  
 </script>  

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once ('./admin.tail.php');
?>


