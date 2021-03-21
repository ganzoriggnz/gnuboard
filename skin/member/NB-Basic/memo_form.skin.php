<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// day limit 
$daylimit=10;

// check 0
$check=0;

//  zuwshuurugdsun levels
$nolimit_levels = array('1'=>'24','2'=>'25','3'=>'27','4'=>'30');
//  2-22 and 26 level tai bh ym bol  day  = 10
// 24,25,27, admin,  no limit
for($i=0; $i<count($nolimit_levels);$i++){
	if ($nolimit_levels[$i] == $member['mb_level'])
		{
			$daylimit=99999999;
		}
}
// member day count limit select
$sql = "select count(*) as cnt from {$g5['memo_table']} where me_send_mb_id = '{$member['mb_id']}' and me_type = 'send' and DATE(me_send_datetime) = '".G5_TIME_YMD."'";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
if($daylimit > $total_count){
		$check = 1;
	}
?>
<div id="memo_write" style="background:white;" class="mb-4">  

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5>
				<?php echo $g5['title'];  
					if ($check==0){echo '<p style="color: red;">  '.$member['mb_level'].' 레벨 회원이 하루에 쪽지 보내기 '.$daylimit.'개 이상 불가능합니다.</p>';} 
					?> 
			</h5>
		</div>
	</div>

	<div id="topHeight"></div>
	<?php if(G5_IS_MOBILE)
	{ ?>
	<nav id="memo_cate" class="sly-tab font-weight-normal mt-3 mb-2">
		<div id="noti_cate_list" class="sly-wrap px-1">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li style="width:25%" class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
				<!-- <li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li> -->
			</ul>
		</div>
		<hr/>
	</nav>
		<?php } else {?>
	<nav id="memo_cate" class="sly-tab font-weight-normal mt-3">
		<div id="noti_cate_list" class="sly-wrap px-3">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
				<li class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
				<li class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
				<!-- <li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li> -->
			</ul>
		</div>
	</nav><?php } ?>
	
	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>

	<?php if ($config['cf_memo_send_point']) { ?>
		<div class="na-table border-bottom">
			<div class="f-de px-3 py-2 py-md-2 bg-light">
				쪽지 보낼때 회원당 <b><?php echo number_format($config['cf_memo_send_point']); ?></b> 포인트를 차감합니다.
			</div>
		</div>
	<?php } ?>
	
	<form name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
	<ul class="list-group f-de mb-4">
		<li class="list-group-item border-top-0 border-left-0 border-right-0">
			<div class="form-group row mx-n2">
				<label class="col-sm-2 col-form-label px-2" for="me_recv_mb_id">받는 회원<strong class="sr-only"> 필수</strong></label>
				<div class="col-sm-10 px-2">
					<input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" <?php  if ($check==0){echo "disabled";} ?> id="me_recv_mb_id" required class="form-control">
					<p class="form-text f-de text-muted mb-0 pb-0">
						여러 회원에게 보낼때는 회원아이디를 컴마(,)로 구분해 주세요.
					</p>
				</div>
			</div>

			<div class="form-group row mx-n2">
				<label class="col-sm-2 col-form-label px-2" for="me_memo">쪽지 내용<strong class="sr-only"> 필수</strong></label>
				<div class="col-sm-10 px-2">
					<textarea name="me_memo" id="me_memo" rows="5" <?php  if ($check==0){echo "disabled";} ?> required class="form-control"><?php echo $content ?></textarea>
				</div>

				
			</div>

			<div class="form-group row mb-0 mx-n2">
				<label class="col-sm-2 col-form-label px-2">자동등록방지<strong class="sr-only"> 필수</strong></label>
				<div class="col-sm-10 px-2">
					<?php echo captcha_html(); ?>
				</div>
			</div>
		</li>
	</ul>

	<p class="text-center">
		<button type="submit" id="btn_submit" <?php  if ($check==0){echo "disabled";} ?> class="btn btn-primary">쪽지 보내기</button>
	</p>
	</form>
</div>

<script>
function fmemoform_submit(f) {

    <?php echo chk_captcha_js();  ?>

    return true;
}
$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});
</script>
