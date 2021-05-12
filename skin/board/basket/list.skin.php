<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

$imgmaxwidth = 800;
$imgmaxheight = 550;

$imgminwidth = 174;
$imgminheight = 130;
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

$listddd = array();
$msg;

if ($_GET['delete'] != '') {
    $q = $_GET["delete"];
    $query5 = " delete from g5_write_basket  where wr_id = '$q'  and mb_id = '$member[mb_id]' and wr_10 = '구매대기' ";
    sql_query($query5);
    goto_url(G5_URL . "/bbs/board.php?bo_table=basket");
}

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

$query5 = "select SUM(wr_3) as cnt, SUM(wr_1) as sumnd, SUM(wr_2) as hurgelt   from g5_write_basket  where mb_id = '$member[mb_id]' and wr_10 = '구매대기' ";
$result5 = sql_query($query5);
while ($row  = sql_fetch_array($result5)) {
    $ordercnt = $row['cnt'];
    $ordercnts = $row['sumnd'];
    $hurgeltcnt = $row['hurgelt'];
}

$w = 0;
$query5e = "select * from g5_write_basket where mb_id = '$member[mb_id]' and wr_10 = '구매대기' ";
$result5e = sql_query($query5e);
while ($roww  = sql_fetch_array($result5e)) {
    $listddd[$w] = $roww;
    $w++;
}

if ($_POST['sw'] == 'buy') {
    $myid = $member['mb_id'];
    $total_price = $ordercnts + $hurgeltcnt;
    $mypoint = $member['mb_point'] - $total_price;
    $use_point;

    if ($member['mb_point'] >= $total_price) {
        for ($i = 0; $i < count($listddd); $i++) {
            $query5 = "select * from g5_write_shop  where  wr_id = '" . $listddd[$i]['wr_8'] . "'";
            $result5 = sql_query($query5);
            while ($row  = sql_fetch_array($result5)) {
                $ddddd = $row['wr_4'];
            }
            $too = $listddd[$i]['wr_3'] + $ddddd;
            sql_query(" update g5_write_shop set wr_4 = '$too' where wr_id = '" . $listddd[$i]['wr_8'] . "'");
            sql_query(" update g5_member set mb_point = '$mypoint' where mb_id = '$myid' ");
            sql_query(" update g5_write_basket set wr_10 = '결제확인' where  wr_id = '" . $listddd[$i]['wr_id'] . "' and mb_id = '$member[mb_id]'");
        }
        $msg = "<script type='text/javascript'>alert('감사합니다.  $total_price 파운드 결제가 완료 되었습니다. 파운드가 $mypoint 남았습니다');opener.location.reload(); self.close();</script> ";
        $use_point = -$total_price;
        $sql = " insert into g5_point
                set  po_point = '$use_point',
                            po_content = '상품 결제. " . $ordercnt . "수량. " . number_format($total_price) . "   파운드 결제가 완료 되었습니다. 파운드가 " . number_format($mypoint) . " t 남았습니다' ,
                            po_expire_date = '" . G5_TIME_YMDHIS . "',
                            po_datetime = '" . G5_TIME_YMDHIS . "',
                            mb_id = '$myid' ";
        sql_query($sql);
    } else {
        alert("파운드가 모자랍니다");
    }
    goto_url(G5_URL . "/bbs/board.php?bo_table=basket");
}

?>

<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">

<div class="bo_v">
    <h2 id="container_title"><?php echo $board['bo_subject'] ?> <span class="sound_only"> 목록</span></h2>
    <strong> 파운드 : <?php echo number_format($member['mb_point']) ?></strong>
    &nbsp;&nbsp;&nbsp;
    <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btnd">RSS</a></li><?php } ?>
            <li><a href="./board.php?bo_table=shop" class="btnd"><img src="<?php echo $board_skin_url ?>/img/shopping-cart.png" height=15px> 구매현황<?php if ($ordercnt) echo " (" . $ordercnt . ")"; ?> </a></li>
        </ul>
    <?php } ?>
    <div class="na-table d-none d-md-table w-100 mb-0 text-md-center bg-light">
        <div class="na-table-head border-primary d-md-table-row bg-light">
            <div class="d-md-table-cell nw-2 px-md-1 text-md-center">번호</div>
            <div class="d-md-table-cell nw-6 px-md-1 text-md-center">PIC</div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center">상품</div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center">수량</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">구매액</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">배송료</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">배송형태</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">신청일</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">상태</div>
            <div class="d-md-table-cell nw-2 pr-md-1 text-md-center"> </div>
        </div>
    </div>
    <ul class="na-table d-md-table w-100" style="background-color: #fff;">
        <?php
        $k = 1;
        for ($i = 0; $i < count($listddd); $i++) {
            if ($listddd[$i]['mb_id'] == $member['mb_id']) {
                $thumb = get_list_thumbnail("shop", $listddd[$i]['wr_8'], $imgmaxwidth, $imgmaxheight); ?>
                <li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
                    <div class="d-md-table-cell nw-2 px-md-1 text-md-center"><?php echo $k; ?></div>
                    <div class="d-md-table-cell nw-6 px-md-1 text-md-center"><?php $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="80px" height="">';
                                                                                echo $img_content; ?></div>
                    <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"><?php echo $listddd[$i]['wr_subject'] ?></div>
                    <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"><?php echo $listddd[$i]['wr_3'] ?></div>
                    <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo number_format($listddd[$i]['wr_1']) ?>원</div>
                    <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo number_format($listddd[$i]['wr_2']) ?>원 </div>
                    <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php if ($wr_8 == 1) echo "개별배송료";
                                                                                else echo "묶음배송"; ?></div>
                    <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo $listddd[$i]['wr_last'] ?></div>
                    <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo $listddd[$i]['wr_10'] ?></div>
                    <div class="d-md-table-cell nw-2 pr-md-1 text-md-center"><a href="./board.php?bo_table=basket&delete=<?php echo $listddd[$i]['wr_id'] ?>"><img src="<?php echo $board_skin_url ?>/img/btn_close.gif" height=15px></a></div>
                </li>
        <?php $k++;
            }
        } ?>
    </ul>
    <div class="na-table d-none d-md-table w-100 mb-0 text-md-center bg-light">
        <div class="na-table-head border-primary d-md-table-row bg-light">
            <div class="d-md-table-cell nw-6 px-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 px-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"><?php echo number_format($ordercnt); ?></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo number_format($ordercnts); ?> 파운드</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo number_format($hurgeltcnt); ?> 파운드</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"> </div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
        </div>
        <div class="na-table-head border-primary d-md-table-row bg-light">
            <div class="d-md-table-cell nw-6 px-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 px-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo number_format($ordercnts + $hurgeltcnt); ?> 파운드</div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"> </div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
            <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"></div>
        </div>
    </div>
</div>
<ul class="btn_bo_user">
    <form name="fboardlist" id="fboardlist" action="./board.php?bo_table=basket" method="POST">
        <input type="hidden" name="sw" value="buy">
        <button type="submit" class="btnd"><i class="fa fa-credit-card"></i> 결제하기</button>
    </form>
</ul>
<?php
if ($msg) echo $msg;
?>