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
    $result = " SELECT * FROM $g5[coupon_table] WHERE co_begin_date='$s_begin_date' AND co_end_date='$s_end_date' AND co_status='N'";
	//$row = sql_fetch($result);
	$result1=sql_query($result);
	for ($i=0; $row = sql_fetch_array($result1); $i++) {
	?>
		<li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
			<div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
					<?php echo $row['co_entity'] ?> 
			</div> 
			<!-- <div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
               <a data-toggle="modal" href="#couponModal" style="color:blue;">
			   		<?php echo "원가권 ".$row['co_sale']."개";?>
				</a>
            </div> -->
            <div class="d-none d-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
				<a data-toggle="modal" href="#couponModal" style="color:blue;">
			   		<?php echo "무료권 ".$row['co_free']."개";?>
				</a>
            </div>
			<div class="float-left float-md-none d-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<!-- <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="win-del" title="삭제">
					<i class="fa fa-trash-o text-muted fa-lg" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a> -->
                <?php echo "쿠폰 받은사람 :";?>
			</div>
		</li>
    <?php } ?>
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
	<div class="modal fade" id="couponModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" style="justify-content:center;">쿠폰주기</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					<div class="col-md-6"><?php echo $year."년 ".$month."월" ?></div>
					</div>
					<div class="row">
					<div class="col-md-6"><?php echo "업소명 : [".$row['co_entity']."]" ?></div>
					</div>
					<div class="form-group">
						<div class="col-md-2"></div>
						<div class="col-md-6">
							<input type="text" name="userid" id="userid" class="form-control"/>		
							<input type="button" class="btn btn-primary"  name="check_id" id="check_id" value="닉네임 확인" class="form-control"/>
						</div>
						<!-- <div class="col-md-3">
						 	<input type="button" class="btn btn-primary"  name="check_id" id="check_id" value="닉네임 확인" class="form-control"/>
						</div> -->
					</div>
					<div class="form-group">
						<div class="col-md-2"></div>
						<div class="col-md-4" id="result">
						</div>
					</div>
					<div>
						<form id="fcouponapply" name="fcouponapply" action="<?php echo $coupon1_action_url ?>" onsubmit="return fcouponapply_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
						
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<button type="submit" class="btn btn-primary">보내기</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});

$(document).ready(function(){
	$('#check_id').click(function(e){
		e.preventDefault();
		var userid = $('#userid').val();
		$.ajax({
			type: 'POST',
			url: 'check_id.php',
			data: {
				'check_id': 1,
				'userid': userid,
			},
			dataType: 'text',
			success: function(response) {
				$('#result').html(response);
			}
		});
	});
});
</script>
<!-- } 쪽지 목록 끝 -->