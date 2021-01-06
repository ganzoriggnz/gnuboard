<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="mb-4">

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5><?php echo $g5['title'] ?></h5>
		</div>
	</div>

	<div id="topHeight"></div>

	<div id="memo_info" class="f-de font-weight-normal mb-2 px-3">
		전체 <?php echo $kind_title ?>쪽지 <b><?php echo $total_count ?></b>통 / <?php echo $page ?>페이지
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>

	<?php if($config['cf_memo_del']){ ?>	
		<div class="na-table border-bottom">
			<div class="f-de px-3 py-2 py-md-2 bg-light">
				<!-- 쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다. -->
			</div>
		</div>
	<?php } ?>

	<ul class="na-table d-table w-100 f-de">
	<?php
    $result = " select * from `g5_coupon` where mb_id = '{$member['mb_id']}'";
    $row = sql_fetch($result);
	//for ($i=0; $row = sql_fetch($result); $i++) {
        /* $list[$i] = $row; */
	?>
		<li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
			<div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
					<?php echo $row['co_entity'] ?> 
			</div>
			<div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
                <?php echo "원가권 "?><a href="#"><?php echo $row['co_sale'];?></a><?php echo "개";?>
            </div>
            <div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
                <?php echo "무료권 "?><a href="#"><?php echo $row['co_sale'];?></a><?php echo "개";?>
            </div>
			<div class="float-left float-md-none d-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<!-- <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="win-del" title="삭제">
					<i class="fa fa-trash-o text-muted fa-lg" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a> -->
                <?php echo "쿠폰 받은사람 : "; ?>
			</div>
		</li>
   
	</ul>
	<?php if ($i == 0) { ?>
		<div class="f-de px-3 py-5 text-center text-muted border-bottom">
			자료가 없습니다.
		</div>
	<?php } ?>

	<div class="font-weight-normal px-3 mt-4">
		<ul class="pagination justify-content-center en mb-0">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./memo.php?kind=$kind".$qstr."&amp;page=") ?>
		</ul>
	</div>

</div>
<script>
$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});
</script>
<!-- } 쪽지 목록 끝 -->