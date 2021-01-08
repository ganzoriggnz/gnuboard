<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
	#userlist {
	display: inline;
	list-style: none;
	}

	#userlist li {
	display: inline;
	}

	#userlist li:after {
	content: ", ";
	}

	#userlist li:last-child:after {
	content: "";
	}
</style>
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
		전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
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
	 $result = "SELECT a.* FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_date='{$s_begin_date}' AND a.co_end_date='{$s_end_date}'"; 
	$result1=sql_query($result);
	for ($i=0; $row = sql_fetch_array($result1); $i++) {
	?>
		<li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">	
			<div class="d-none d-table-cell nw-3 f-sm font-weight-normal py-md-2 px-md-1">
					<?php echo "[".$row['co_entity']."]";?> 
					
			</div> 
			<div class="d-none d-table-cell nw-3 f-sm font-weight-normal py-md-2 px-md-1">
			   <a data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;" data-id="<?php echo "S,".$row['co_entity'].",".$row['co_no']; ?>">
			   		<?php echo "원가권 ".$row['co_sale_num']."개";?>
				</a>
            </div> 
            <div class="d-none d-table-cell nw-3 f-sm font-weight-normal py-md-2 px-md-1">
				<a data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;" data-id="<?php echo "F,".$row['co_entity'].",".$row['co_no']; ?>">
			   		<?php echo "무료권 ".$row['co_free_num']."개";?>
				</a>
            </div>
			<div class="float-left float-md-none d-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<!-- <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="win-del" title="삭제">
					<i class="fa fa-trash-o text-muted fa-lg" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a> --> 
				<?php echo "쿠폰 받은사람 :"; ?> 
				<ul id="userlist">
				<?php $sql = "SELECT a.*, b.* FROM $g5[coupon_table] a RIGHT OUTER JOIN $g5[couponsent_table] b ON a.co_no = b.co_no WHERE a.co_begin_date='{$s_begin_date}' AND a.co_end_date ='{$s_end_date}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
				$sql1 = sql_query($sql);
				for($k=0; $row1 = sql_fetch_array($sql1); $k++){
				?>
					<li><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></li>
				<?php
				}
				?> 
				</ul>
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
	<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 250px; font-weight: bold;">
				<form id="fcouponapply" name="fcouponapply" action="<?php echo $couponsent_action_url; ?>" onsubmit="return fcouponapply_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-header">
						<h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body">
						<input type="hidden" name="co_no" id="co_no" value="">
						<input type="hidden" name="cos_type" id="cos_type" value="">
						<div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
						<div style="margin-left: 30px;"><?php echo "업소명 :";?>
							<input type="text" name="cos_entity" id="cos_entity" value="" style="border:none; outline: none; width: 100px; font-size: 12px; font-weight: bold;">							
						</div>
						<div style="margin-left:120px;">받는사람 닉네임</div>		
						<div style="margin-left:30px; margin-top:10px;">
							<input type="text" name="cos_nick" id="mb_nick" style="background: #00FFFF; display:inline; width: 160px;"/>		
							<input type="button" name="check_id" id="check_id" value="닉네임 확인" style="background: #6495ED; display:inline; width: 100px;"/>
						</div>
						<div id="result" style="margin-left:30px; margin-top: 10px;" >
						</div>			
					</div>
					<div class="modal-footer">
						<div style="margin-left: 140px; margin: 0 auto; text-align: center; width: 150px;">
							<button type="submit" accesskey="s" class="btn" style="background: #00FF00;">보내기</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});

function fcouponapply_submit(f) {

		if($('#hasNick').length > 0 && $('#hasNick').val() == '' && !f.cos_nick){ 
			alert("Please insert correct nick name!");
			f.cos_nick.focus();
			return false;
		}         
		/* f.action = '<?php echo $couponsent_action_url; ?>'; */
		return true;                                    
}  

$(document).ready(function(){
	$('#check_id').click(function(e){
		e.preventDefault();
		var mb_nick = $('#mb_nick').val();
		$.ajax({
			type: 'POST',
			url: 'check_id.php',
			data: {
				'check_id': 1,
				'mb_nick': mb_nick,
			},
			dataType: 'text',
			success: function(response) {
				$('#result').html(response);
			}
		});
	});

	$('body').on('click', '.coupon-modal', function() {
		var names = [];
		names = $(this).data('id');
		var nameArr = names.split(',');
		var cos_type = nameArr[0];
		var cos_entity = nameArr[1];
		var co_no = nameArr[2];
		$('.modal-body #cos_type').val(cos_type);
		$('.modal-body #cos_entity').val(cos_entity);
		$('.modal-body #co_no').val(co_no);
	}); 

});
</script>

</div>

