<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_list_skin_url.'/style.css">', 0);

$cnt=0;
$alert_nick;
$altcnt=0;
?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="mb-4">

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5 class="text-center"><?php echo $g5['title'] ?></h5>
		</div>
	</div>

	<div id="topHeight"></div>

	<div id="memo_info" class="f-de font-weight-normal mb-2 px-3">
		전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>

	<!-- <ul class="na-table d-table w-100 f-de" style="margin-top: 10px;"> -->
	<div class="tbl_head02 tbl_wrap">
        <table>
			<thead>
				<tr>
					<th scope="col">업소명</th>
					<th scope="col">원가권 쿠폰 개수</th>
					<th scope="col">무료권 쿠폰 개수</th>
					<th scope="col">쿠폰 받은사람</th>
				</tr>
			</thead>
        <tbody>
	<?php
	$result = "SELECT a.*, c.mb_level FROM {$g5['coupon_table']} a INNER JOIN $at_table b ON a.mb_id = b.mb_id INNER JOIN {$g5['member_table']} c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}' AND c.mb_level = '27'"; 
	$result1=sql_query($result);
	while ($row = sql_fetch_array($result1)) {
	?>
		<tr>	
			<td class="td_left">
					<?php echo "[".$row['co_entity']."]";?> 
					
			</td> 
			<td class="td_left">
			   <a data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_sale_num']-$row['co_sent_snum']) == '0' || $co_send_date > $now) { echo 'style="font-weight: bold;"'; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;"';}  ?>>
			   		<?php echo "원가권 ".number_format($row['co_sale_num']-$row['co_sent_snum'])."개";?>
				</a>
			</td> 
            <td class="td_left">
				<a data-type = "F" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_free_num']-$row['co_sent_fnum']) == '0' || $co_send_date > $now){ echo 'style="font-weight: bold;"'; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;"';} ?>>
			   		<?php echo "무료권 ".number_format($row['co_free_num']-$row['co_sent_fnum'])."개";?>
				</a>
			</td>
			<td class="td_left">
				<ul id="userlist">	
				<?php $sql = "SELECT a.*, b.* FROM {$g5['coupon_table']} a RIGHT OUTER JOIN {$g5['coupon_sent_table']} b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime ='{$co_end_datetime}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
				$sql1 = sql_query($sql);
				while ($row1 = sql_fetch_array($sql1)){
					$alert_nick[$altcnt]['alt_nick'] = $row1['cos_nick']; 
					if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') 
                        { echo '<li><a data-toggle="modal"
                            data-target="#couponDelete"  
                            href="#couponDelete" 
                            class="coupon-delete" 
                            data-type ='.$row1['cos_type']." 
                            data-code = ".$row1['cos_code']." 
                            data-no = ".$row1['cos_no']." 
                            data-co-no = ".$row1['co_no']." 
                            data-link = ".$bo_table.'>';
                            if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];
                            if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; 
                            echo '</a></li>';
                         } else if($row1['cos_accept'] == 'Y' && $row1['cos_alt_quantity'] == '0') { 
                            echo '<li><a href="#" style="color:blue;" data-type ='.$row1['cos_type']." 
                            data-code = ". $row1['cos_code']." data-no = ".$row1['cos_no']." 
                            data-co-no = "; ?><?php echo $row1['co_no']." data-link = ". $bo_table.'>';
                            if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];
                            if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></a></li><?php 
                        }                             
						else if($row1['cos_alt_quantity'] > 0) { 
							echo '<li><a data-toggle="modal" data-target="#couponAlert'.$altcnt.'" href="#couponAlert'.$altcnt.'" 
							data-class="coupon-alert" style="color:red;" data-link = '.$bo_table.'>';
							$sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row1['cos_nick']}'"; 
							$row4 = sql_fetch($sql4);  
							$res = "SELECT * FROM {$g5['coupon_alert_table']} WHERE alt_created_datetime = '{$row4['maxdate']}' ";
							$res1 = sql_fetch($res);
							if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'].'('.$res1['cos_alt_quantity'].')';
							if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick'].'('.$res1['cos_alt_quantity'].')'; ?></a>

							<div class="modal fade" id="couponAlert<?php echo $altcnt; ?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
								<div class="modal-dialog" role="document">
									<div class="modal-content" style="width: 650px; height: 400px;">
										<div class="modal-header" style="border-bottom: none;">
											<h5 class="modal-title" style="margin-left: 250px;">경고 횟수 변경 및 기록</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div> 	
										<div class="modal-body" style="padding: 5px 0px;">
											<?php 
												$sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row1['cos_nick']}'"; 
												$row4 = sql_fetch($sql4);  
												$res = "SELECT * FROM {$g5['coupon_alert_table']} WHERE alt_created_datetime = '{$row4['maxdate']}' ";
												$res1 = sql_fetch($res);
											?> 
											<div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
											<div style="margin-left: 30px; margin-top: 5px;"><?php echo "현재 경고횟수 : ".$res1['cos_alt_quantity'];?>
											<form id="fcouponalert<?php echo $altcnt; ?>" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
												<input type="hidden" name="cos_nick" id="cos_nick" value="<?php echo $row1['cos_nick'];?>">
												<input type="hidden" name="cos_entity" id="cos_entity" value="<?php echo $row1['cos_entity'];?>">
												<input type="hidden" name="cos_link" id="cos_link" value="<?php echo $bo_table; ?>">
												<div style="margin-left:30px; margin-top: 30px;">
													<p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
													<input type="number" name="cos_alt_quantity" id="cos_alt_quantity" class="form-control" style="background: #EFEFEF; width: 60px; height: 30px; display: inline-block; text-align: center; margin-left: 30px; padding-left:25px; font-size: 12px;" value = "<?php echo $res1['cos_alt_quantity']; ?>"/>		
													<input type="submit" name="change" id="change" value="확인" class="btn btn-primary" style="width: 80px; height: 30px;"/>
												</div>
											</form>
											<div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
											<div style="margin: 10px 10px 10px 0px;">
												<table class="alert-table">
													<thead class="alert-thead">
														<tr class="alert-tr">
															<th class="col-xs-3 alert-th">시간</th>
															<th class="col-xs-2 alert-th">업소명</th>
															<th class="col-xs-3 alert-th">경고내용</th>
															<th class="col-xs-2 alert-th">최종적용 아이디</th>
															<th class="col-xs-2 alert-th">누적횟수</th>
														</tr>
													</thead>
													<tbody class="alert-tbody">
													<?php $sql = "SELECT * FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$res1['cos_nick']}' ORDER BY alt_created_datetime";
													$res = sql_query($sql);
													for($i=0; $row = sql_fetch_array($res); $i++) { ?>
														<tr class="alert-tr">
															<td class="col-xs-3 alert-td"><?php echo $row['alt_created_datetime']; ?></td>
															<td class="col-xs-2 alert-td"><?php echo $row['cos_entity']; ?></td>
															<td class="col-xs-3 alert-td"><?php echo $row['alt_reason']; ?></td>
															<td class="col-xs-2 alert-td"><?php echo $row['alt_created_by']; ?></td>
															<td class="col-xs-2 alert-td"><?php echo $row['cos_alt_quantity']; ?></td>
														</tr>
													<?php
													} ?>
													</tbody>
												</table>
											</div>					
										</div>
									</div>
								</div>
							</div>        
						</li> 
						<?php } 					                               
					$altcnt++;
				}
                    ?> 
                </ul>
			</td>
		</tr>
		<?php $cnt++; } 
        if ($cnt == 0) { 
            echo '<tr><td colspan="4" class="empty_table">자료가 없습니다.</td></tr>';
        } ?>
	    </tbody>
	</table>
    </div>
	
	
	<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 300px;">				
					<div class="modal-header" style="border-bottom: none;">
						<h5 class="modal-title" style="margin-left: 140px;">쿠폰주기</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body">
						<form id="fcouponsend" name="fcouponsend" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
							<input type="hidden" name="co_no" id="co_no" value="">
							<input type="hidden" name="mb_id" id="mb_id" value="">
							<input type="hidden" name="cos_type" id="cos_type" value="">
							<input type="hidden" name="cos_link" id="cos_link" value="">
							<div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
							<div style="margin-left: 30px; margin-top: 5px;"><?php echo "업소명 :";?>
								<input type="text" name="cos_entity" id="cos_entity" value="" style="border:none; outline: none; width: 100px;">							
							</div>
							<div style="margin-left:120px; margin-top: 20px;">받는사람 닉네임</div>		
							<div style="margin-left:30px; margin-top:10px;">
								<input type="text" name="cos_nick" id="mb_nick" class="form-control" style="background: #dcdcdc; display:inline; width: 160px;"/>		
								<input type="button" name="check_id" id="check_id" value="닉네임 확인" class="btn" style="background: #6495ED; display:inline; width: 100px;"/>
							</div>
							<div id="result" style="margin-left:30px; margin-top: 10px;" >
							</div>
						</form>			
					</div>
					<div class="modal-footer" style="border-top: none;">
						<div style="margin-left: 140px; margin: 0px auto 10px auto; text-align: center;">
							<button type="button" id="btn_send" accesskey="s" class="btn btn-primary" style="width: 150px;">보내기</button>
						</div>
					</div>				
			</div>
		</div>
	</div>
	<div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 220px;">
				<form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-header" style="border-bottom: none;">
						<h5 class="modal-title" style="margin-left: 130px;">쿠폰회수</h5>
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
						<div style="margin-left:100px;">쿠폰을 회수하시겠습니까?</div>					
					</div>
					<div class="modal-footer" style="border-top: none;">
						<div style="margin-left: 140px; margin: 0px auto 10px auto; text-align: center;">
							<button type="submit" accesskey="s" class="btn btn-primary" style="width: 150px; font-size: 14px;">확인</button>
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

	$('#btn_send').click(function(){
		debugger;
            if($('#hasNick').val() != '정상적인 닉네임입니다.'){ 
                alert("닉네임을 입력하시고 확인후 쿠폰 지원할 수 있습니다!");
                $('#mb_nick').focus();
            }  
       /*      if($('#hasNick').length = 0 && $('#hasNick').val() != '정상적인 닉네임입니다.'){ 
                alert("Please insert correct nick name!");
                $('#mb_nick').focus();
            }  */
            if ($('#hasNick').val() == '정상적인 닉네임입니다.'){
                $('#fcouponsend').submit(); 
            }                  
        });   

	function fcoupondelete_submit(f) {
		return true;                                                                 
	}  

	function fcouponalert_submit(f){
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

	});
	</script>

</div>

