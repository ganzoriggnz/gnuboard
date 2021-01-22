<?php
$sub_menu = "700200";
include_once('./_common.php');


auth_check($auth[$sub_menu], 'r');
$g5['title'] = "후기미작성자";
include_once('./admin.head.php');

?>

<!-- 밑에 add_stylesheet 함수를 사용하지 않는이유은 가끔 홈페이지 개발시 오류로 add_stylesheet 함수가 먹지 않는 현상으로 인해 사용하지 않습니다. -->
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
            url: 'coupon_load.php',
            error: function() {
                $('#script-warning').show();
            }
		},
		eventClick: function(info){
			var eventObj = info.event;
			var id = eventObj.id;
			var cos_nick  = eventObj.title;
			var cos_nick1  = eventObj.extendedProps.cos_nick1;
			var cos_no  = eventObj.extendedProps.cos_no;
			if(id == '100'){
				$.ajax({
					url: 'coupon_delete.php',
					type: 'POST',
					data: {cos_no: cos_no},
					success: function(response){ 
					$('#couponDelete .modal-body #fcoupondelete').html(response);
					$('#couponDelete').modal(); 
					}
				});
			} else if (id == '300') {
				$.ajax({
					url: 'coupon_alert.php',
					type: 'POST',
					data: {cos_nick1: cos_nick1},
					success: function(response){ 
			
					$('#couponAlert .modal-body').html(response);
					$('#couponAlert').modal(); 
					}
				});
			}
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

	$sql = "DELETE FROM {$g5['coupon_sent_table']} 
			WHERE cos_no = '{$cos_no}'";

	sql_query($sql);

	if($cos_type == 'S'){
		$sql1 = " UPDATE {$g5['coupon_table']}
				SET co_sent_snum = co_sent_snum - 1
				WHERE co_no = '{$_POST['co_no']}' "; 
		sql_query($sql1);
	} else if($cos_type == 'F') {
		$sql1 = " UPDATE {$g5['coupon_table']}
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

	$sql = "INSERT INTO {$g5['coupon_alert_table']} 
				SET cos_no = '0',
					cos_nick = '{$cos_nick}',
					cos_entity = '-',
					cos_alt_quantity = '{$cos_alt_quantity}',
					alt_reason = '경고횟수 변경',
					alt_created_by = '{$member['mb_nick']}',
					alt_created_datetime = '{$alt_created_datetime}' ";

	sql_query($sql);

	$sql1 = "UPDATE {$g5['coupon_sent_table']} 
				SET cos_alt_quantity = '{$cos_alt_quantity}'
				WHERE cos_accept='Y' AND cos_nick = '{$cos_nick}' AND cos_entity = '{$cos_entity}'";

	sql_query($sql1);
	goto_url($PHP_SELF, false);
}
?>
	<div id="calendar">
		<div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="top: 40%; left: 0%;">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="width: 350px; height: 250px;">
				   <form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
						<div class="modal-header" style="border-bottom: none; margin-top: 20px;">
							<h3 class="modal-title" style="margin-left: 140px; font-size: 14px; font-weight: bold;">쿠폰회수</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div> 	
						<div class="modal-body" style="padding: 40px 0px; font-size: 14px;">	
						</div>
						<div class="modal-footer" style="border-top: none;">
							<div style="margin-left: 140px; margin: 0px auto 20px auto; text-align: center; border-top: none;">
								<button type="submit" accesskey="s" class="btn btn_01" style="width: 150px; font-size: 14px;">확인</button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<div class="modal fade" id="couponAlert" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="width: 650px; height: 400px;">
					<div class="modal-header" style="border-bottom: none; margin-top: 20px;">
						<h3 class="modal-title" style="margin-left: 250px; font-weight: bold; font-size:14px;">경고 횟수 변경 및 기록</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div> 	
					<div class="modal-body" style="padding: 5px 0px; font-size: 14px;">				
					</div>
				</div>
			</div>
		</div>
	</div>	
<?php
include_once('./admin.tail.php');
?>