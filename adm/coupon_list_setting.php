<?php
$sub_menu = "700500";
include_once('./_common.php');
if( isset($_POST['id'])){ 
    $bo_table = $_POST['id'];
    $linkcount = strlen($bo_table) - 2;
    $str_table =substr($bo_table, 0, $linkcount);
    $at_table = $str_table."at";
}

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

$sql="SELECT * FROM {$g5['coupon_setting_table']} WHERE bo_table='$at_table' AND bo_created_datetime BETWEEN '$co_begin_datetime' AND '$co_end_datetime' LIMIT 1";
$row=sql_fetch($sql);
 
$colspan = 3;
?>

<form name="fcouponsetting" onsubmit="" method="post" autocomplete="off">
    <input type="hidden" name="w" value="u">
    <input type="hidden" name="bo_table" value="<?php echo $row['bo_table']; ?>" />
    <div class="tbl_head01 tbl_wrap grid_9">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col">원가권 </th>
                    <th scope="col">무료권 </th>
                    <th scope="col">쿠폰지원 업소 갯수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($row['bo_no']){ ?>
                <tr>
                    <td class="td_center"><input type="number" name="bo_sale" class="frm_input text-center" value="<?php echo $row['bo_sale']; ?>"/></td>
                    <td class="td_center"><input type="number" name="bo_free" class="frm_input text-center" value="<?php echo $row['bo_free']; ?>"/></td>
                    <td class="td_center"><input type="number" name="bo_total" class="frm_input text-center" value="<?php echo $row['bo_total']; ?>"/></td>
                </tr>

                <?php
                }
                elseif (!$row['bo_no'])
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_list\">자료가 없습니다.</td></tr>";
                ?>
            </tbody>
        </table>
        <?php
        if ($row['bo_no']){ ?>
        <div style="float: right; margin-top: 20px;padding: 5px 0;">
            <input type="submit" value="저장" class="btn btn_01"/>
        </div>
        <?php } ?>
    </div>
</form>

