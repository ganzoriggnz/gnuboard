<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_list_skin_url.'/style.css">', 0);
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

	<ul class="na-table d-table w-100 f-de" style="margin-top: 10px;">
	<?php
	 $result = "SELECT a.* FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}'"; 
	$result1=sql_query($result);
	for ($i=0; $row = sql_fetch_array($result1); $i++) {
	?>
		<li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">	
			<div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1">
					<?php echo "[".$row['co_entity']."]";?> 
					
			</div> 
			<div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1">
			   <a data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;" data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>">
			   		<?php echo "원가권 ".number_format($row['co_sale_num']-$row['co_sent_snum'])."개";?>
				</a>
            </div> 
            <div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1">
				<a data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;" data-type = "F" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>">
			   		<?php echo "무료권 ".number_format($row['co_free_num']-$row['co_sent_fnum'])."개";?>
				</a>
            </div>
			<div class="float-left float-md-none d-table-cell nw-30 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<?php echo "쿠폰 받은사람 :"; ?> 
				<ul id="userlist">
				<?php $sql = "SELECT a.*, b.* FROM $g5[coupon_table] a RIGHT OUTER JOIN $g5[coupon_sent_table] b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime ='{$s_end_date}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
				$sql1 = sql_query($sql);
				for($k=0; $row1 = sql_fetch_array($sql1); $k++){
				?>
					<?php if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') { echo '<li>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></li> <?php } ?>
					<?php if($row1['cos_accept'] == 'Y') { echo '<li><a data-toggle="modal" href="#couponDelete" class="coupon-delete" style="color:blue;" data-type ='?><?php echo $row1['cos_type']." data-code = " ?><?php echo $row1['cos_code']." data-no = ";?><?php echo $row1['cos_no']." data-co-no = "; ?><?php echo $row1['co_no']." data-link = ";?><?php echo $bo_table.'>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></a></li><?php } ?>
					<?php if($row1['cos_alt_quantity'] > 0) { echo '<li><a data-toggle="modal" href="#couponAlert" class="coupon-alert" style="color:red;" data-entity ='?><?php echo $row1['cos_entity']." data-nick = " ?><?php echo $row1['cos_nick']." data-link = ";?><?php echo $bo_table.'>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')';?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')'; ?></a></li> <?php } ?>					 
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
	
	<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 250px; font-weight: bold;">
				<form id="fcouponsend" name="fcouponsend" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="return fcouponsend_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-header">
						<h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body">
						<input type="hidden" name="co_no" id="co_no" value="">
						<input type="hidden" name="mb_id" id="mb_id" value="">
						<input type="hidden" name="cos_type" id="cos_type" value="">
						<input type="hidden" name="cos_link" id="cos_link" value="">
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
						<div style="margin-left: 140px; margin: 0 auto; text-align: center;">
							<button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px;">보내기</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 200px; font-weight: bold;">
				<form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-header">
						<h5 class="modal-title" style="margin-left: 90px; font-weight: bold;">경고 횟수 변경 및 기록</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body" style="padding: 40px 0px; font-size: 14px;">
						<input type="hidden" name="co_no" id="co_no" value="">
						<input type="hidden" name="cos_no" id="cos_no" value="">
						<input type="hidden" name="cos_type" id="cos_type" value="">
						<input type="hidden" name="cos_link" id="cos_link" value="">
						<input type="hidden" name="cos_code" id="cos_code" value="">
						<div style="margin-left:100px;">쿠폰을 회수하시겠습니까? </div>					
					</div>
					<div class="modal-footer">
						<div style="margin-left: 140px; margin: 0 auto; text-align: center;">
							<button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px; font-size: 14px;">확인</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="couponAlert" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 605px; height: 400px; font-weight: bold;">
					<div class="modal-header">
						<h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰회수</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body" style="padding: 5px 0px; font-size: 14px;">
						<?php 
							$sql = "SELECT MAX(alt_created_datetime) as maxdate FROM `g5_coupon_alert`"; 
							$row = sql_fetch($sql);  
							$sql1 = "SELECT * FROM `g5_coupon_alert` WHERE alt_created_datetime = '{$row['maxdate']}' ";
							$row1 = sql_fetch($sql1);
							echo $row1['cos_entity'];
						?> 
						<div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
						<div style="margin-left: 30px;"><?php echo "현재 경고횟수 : ".$row1['cos_alt_quantity'];?>
						<form id="fcouponalert" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
							<input type="hidden" name="cos_nick" id="cos_nick" value="">
							<input type="hidden" name="cos_entity" id="cos_entity" value="">
							<input type="hidden" name="cos_link" id="cos_link" value="">
							<div style="margin-left:30px; margin-top: 30px;">
								<p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
								<input type="number" name="cos_alt_quantity" id="cos_alt_quantity" style="background: #EFEFEF; width: 40px;" value = "<?php echo $row1['cos_alt_quantity']; ?>"/>		
								<input type="submit" name="change" id="change" value="확인" style="background: #FFF2CC; width: 80px;"/>
							</div>
						</form>
						<div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
						<div style="margin: 10px 10px 10px 0px;">
							<table>
								<thead>
									<tr>
										<th>시간</th>
										<th>업소명</th>
										<th>경고내용</th>
										<th>최종적용 아이디</th>
										<th>누적횟수</th>
									</tr>
								</thead>
								<tbody>
								<?php $sql = "SELECT * FROM `g5_coupon_alert` WHERE cos_nick = '{$row1['cos_nick']}' ORDER BY alt_created_datetime";
								$res = sql_query($sql);
								for($i=0; $row = sql_fetch_array($res); $i++) { ?>
									<tr>
										<td><?php echo $row['alt_created_datetime']; ?></td>
										<td><?php echo $row['cos_entity']; ?></td>
										<td><?php echo $row['alt_reason']; ?></td>
										<td><?php echo $row['alt_created_by']; ?></td>
										<td><?php echo $row['cos_alt_quantity']; ?></td>
									</tr>
								<?php
								} ?>
								</tbody>
							</table>
						</div>					
					</div>
					<div class="modal-footer">
						<div style="margin-left: 140px; margin: 0 auto; text-align: center;">
							<button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px; font-size: 14px;">확인</button>
						</div>
					</div>
			</div>
		</div>
	</div>
	
	<script>
	$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
	});

	function fcouponsend_submit(f) {
		if(!f.cos_nick && $('#hasNick').length > 0 && $('#hasNick').val() == ''){ 
			alert("Please insert correct nick name!");
			f.cos_nick.focus();
			return false;
		}         
		return true;                                    
	}  

	function fcoupondelete_submit(f) {
	var agree=confirm("Are you sure to delete?");
		if(agree)
			return true;
		else 
			return false;                                                                   
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
			var cos_type = $(this).data('type');
			var cos_entity = $(this).data('entity');
			var co_no = $(this).data('no');
			var mb_id = $(this).data('mb-id');
			var cos_link = $(this).data('link');
			$('.modal-body #cos_type').val(cos_type);
			$('.modal-body #cos_entity').val(cos_entity);
			$('.modal-body #co_no').val(co_no);
			$('.modal-body #mb_id').val(mb_id);
			$('.modal-body #cos_link').val(cos_link);
		}); 

		$('body').on('click', '.coupon-delete', function() {
			var co_no = $(this).data('co-no');	
			var cos_no = $(this).data('no');
			var cos_type = $(this).data('type');
			var cos_code = $(this).data('code');
			var cos_link = $(this).data('link');
			$('.modal-body #co_no').val(co_no);
			$('.modal-body #cos_no').val(cos_no);
			$('.modal-body #cos_type').val(cos_type);		
			$('.modal-body #cos_code').val(cos_code);
			$('.modal-body #cos_link').val(cos_link);
		}); 

		$('body').on('click', '.coupon-alert', function() {
			var cos_entity = $(this).data('entity');
			var cos_nick = $(this).data('nick');
			var cos_link = $(this).data('link');
			$('.modal-body #cos_entity').val(cos_entity);
			$('.modal-body #cos_nick').val(cos_nick);
			$('.modal-body #cos_link').val(cos_link);
		}); 	
	});
	</script>

</div>

