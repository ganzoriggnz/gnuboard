<?php
$sub_menu = "700200";
include_once('./_common.php');


auth_check($auth[$sub_menu], 'r');
$g5['title'] = "후기미작성자";
include_once('./admin.head.php');

?>

<!-- 밑에 add_stylesheet 함수를 사용하지 않는이유은 가끔 홈페이지 개발시 오류로 add_stylesheet 함수가 먹지 않는 현상으로 인해 사용하지 않습니다. -->
<link href="<?php echo G5_ADMIN_URL;?>/css/style.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/daygrid/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/timegrid/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/list/main.css" rel="stylesheet" />
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/ko.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/interaction/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/daygrid/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/timegrid/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/list/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/wz.js/bootstrapmodal.min.js"></script>
<link href="<?php echo G5_ADMIN_URL;?>/css/wzappend.css" rel="stylesheet" />

<script type="text/javascript">

debugger;
document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'ko';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        defaultDate: '<?php echo G5_TIME_YMD?>',
        locale: initialLocaleCode,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: 'load.php',
            error: function() {
                $('#script-warning').show();
            }
		},
		eventClick: function(info){
			var eventObj = info.event;
			var id = eventObj.id;
			if(id == '100'){
				$('#couponDelete .modal-body p').html(event.title);
				$('#couponDelete').modal();
			} else if (id == '300') {
				$('#couponAlert .modal-body p').html(event.title);
				$('#couponAlert').modal();
			}
			
			/* $('#couponDelete .modal-body p').html(event.title);
			$('#couponDelete').modal(); */
		},
        loading: function(bool) {
            $('#loading').toggle(bool);
		}
		
    });
    calendar.render();
});

</script>

<?php 

if($w == 'd'){
	$cos_no = $_POST['cos_no'];
	$co_no = $_POST['co_no'];
	$cos_code = $_POST['cos_code'];
	$cos_type = $_POST['cos_type'];

	$sql = "DELETE FROM $g5[coupon_sent_table] 
			WHERE cos_code = '{$cos_code}' AND cos_no = '{$cos_no}'";

	sql_query($sql);

	if($cos_type == 'S'){
		$sql1 = " UPDATE $g5[coupon_table]
				SET co_sent_snum = co_sent_snum - 1
				WHERE co_no = '{$_POST['co_no']}' "; 
		sql_query($sql1);
	} else if($cos_type == 'F') {
		$sql1 = " UPDATE $g5[coupon_table]
				SET co_sent_fnum = co_sent_fnum - 1
				WHERE co_no = '{$_POST['co_no']}' "; 
		sql_query($sql1);
	}
	goto_url($PHP_SELF, false);
}
else if($w == 'u'){
	$cos_nick = $_POST['cos_nick'];
	$cos_entity = $_POST['cos_entity'];
	$cos_alt_quantity = $_POST['cos_alt_quantity'];
	$alt_created_datetime = G5_TIME_YMDHIS;

	$sql = "INSERT INTO $g5[coupon_alert_table] 
				SET cos_no = '0',
					cos_nick = '{$cos_nick}',
					cos_entity = '-',
					cos_alt_quantity = '{$cos_alt_quantity}',
					alt_reason = '경고횟수 변경',
					alt_created_by = '{$member['mb_nick']}',
					alt_created_datetime = '{$alt_created_datetime}' ";

	sql_query($sql);

	$sql1 = "UPDATE $g5[coupon_sent_table] 
				SET cos_alt_quantity = '{$cos_alt_quantity}'
				WHERE cos_accept='Y' AND cos_nick = '{$cos_nick}' AND cos_entity = '{$cos_entity}'";

	sql_query($sql1);
	goto_url($PHP_SELF, false);
}
?>
	<div id="calendar"></div>
	<div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width: 350px; height: 200px; font-weight: bold;">
				<form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-header">
						<h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰회수</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body" style="padding: 40px 0px; font-size: 14px;">
						<input type="hidden" name="w" id="w" value="d">
						<input type="hidden" name="co_no" id="co_no" value="">
						<input type="hidden" name="cos_no" id="cos_no" value="">
						<input type="hidden" name="cos_type" id="cos_type" value="">
						<input type="hidden" name="cos_code" id="cos_code" value="">
						<p></p>
						<div style="margin-left:100px;">쿠폰을 회수하시겠습니까?</div>					
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
			<div class="modal-content" style="width: 650px; height: 400px; font-weight: bold;">
				<div class="modal-header">
					<h5 class="modal-title" style="margin-left: 250px; font-weight: bold;">경고 횟수 변경 및 기록</h5>
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
					?> 
					<div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
					<div style="margin-left: 30px;"><?php echo "현재 경고횟수 : ".$row1['cos_alt_quantity'];?>
					<form id="fcouponalert" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="w" id="w" value="u">
						<input type="hidden" name="cos_nick" id="cos_nick" value="">
						<input type="hidden" name="cos_entity" id="cos_entity" value="">
						<p></p>
						<div style="margin-left:30px; margin-top: 30px;">
							<p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
							<input type="number" name="cos_alt_quantity" id="cos_alt_quantity" style="background: #EFEFEF; width: 40px;" value = "<?php echo $row1['cos_alt_quantity']; ?>"/>		
							<input type="submit" name="change" id="change" value="확인" style="background: #FFF2CC; width: 80px;"/>
						</div>
					</form>
					<div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
					<div style="margin: 10px 10px 10px 0px;">
						<table style="width: 550px;">
							<thead>
								<tr>
								<tr style=" background:  #f8f8f8; border: 1px solid #000; font-size: 10px;">
									<th style= "width: 25%; border: 1px solid #000; text-align: center;">시간</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">업소명</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">경고내용</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">최종적용 아이디</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">누적횟수</th>
								</tr>
							</thead>
							<tbody style="background: #fff;">
							<?php $sql = "SELECT * FROM `g5_coupon_alert` WHERE cos_nick = '{$row1['cos_nick']}' ORDER BY alt_created_datetime";
							$res = sql_query($sql);
							for($i=0; $row = sql_fetch_array($res); $i++) { ?>
								<tr style="border: 1px solid #000;font-size: 8px;">
									<td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_created_datetime']; ?></td>
									<td style="border: 1px solid #000; text-align: center;"><?php echo $row['cos_entity']; ?></td>
									<td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_reason']; ?></td>
									<td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_created_by']; ?></td>
									<td style="border: 1px solid #000; text-align: center;"><?php echo $row['cos_alt_quantity']; ?></td>
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
	</script>
<?php
include_once('./admin.tail.php');
?>