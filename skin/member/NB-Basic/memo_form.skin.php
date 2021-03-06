<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// day limit 
$daylimit=10;

// check 0
$check=0;

if($member['mb_level'] > 23) 
$daylimit=99999999;
// member day count limit select
$sql = "select count(*) as cnt from {$g5['memo_table']} where me_send_mb_id = '{$member['mb_id']}' and me_type = 'send' and DATE(me_send_datetime) = '".G5_TIME_YMD."'";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
if($daylimit > $total_count){
		$check = 1;
	}
?>
<link href="/plugin/multi-select/multiple-select.min.css" rel="stylesheet">
<script src="/plugin/multi-select/multiple-select.min.js"></script>
<style>
.multiple-select{width:100%;}
.multiple-select .multiple span{padding-left:5px;}
</style>
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
	<input type="hidden" id="mb_lvl" value=<?php echo $member['mb_level']; ?>> 
	<ul class="list-group f-de mb-4">
		<li class="list-group-item border-top-0 border-left-0 border-right-0">
			<?php if($is_admin){?>
			<div class="form-group row mx-n2">
				<label class="col-sm-2 col-form-label px-2" for="multi_level">전체 선택</label>
				<div class="col-sm-10 px-2">
					<select multiple="multiple" class="multiple-select" id="multi_level" name="multi_level[]">
						<?php for($i=2; $i < 24; $i++){?>
						<option value="<?=$i;?>">lv.<?=$i;?></option>
						<?php }?>
						<optgroup label="lv.26">
							<option value="26|오피">오피</option>
							<option value="26|휴게텔">휴게텔</option>
							<option value="26|건마">건마</option>
							<option value="26|술집">술집</option>
							<option value="26|안마">안마</option>
							<option value="26|출장">출장</option>
							<option value="26|키스방">키스방</option>
							<option value="26|립카페">립카페</option>
							<option value="26|핸플 패티쉬">핸플 패티쉬</option>
							<option value="26|패티쉬">패티쉬</option>
							<option value="26|기타">기타</option>
						</optgroup>
						<optgroup label="lv.27">
							<option value="27|오피">오피</option>
							<option value="27|휴게텔">휴게텔</option>
							<option value="27|건마">건마</option>
							<option value="27|술집">술집</option>
							<option value="27|안마">안마</option>
							<option value="27|출장">출장</option>
							<option value="27|키스방">키스방</option>
							<option value="27|립카페">립카페</option>
							<option value="27|핸플 패티쉬">핸플 패티쉬</option>
							<option value="27|패티쉬">패티쉬</option>
							<option value="27|기타">기타</option>
						</optgroup>
					</select>
				</div>
			</div>
			<?php }?>
			<div class="form-group row mx-n2">
				<label class="col-sm-2 col-form-label px-2" for="me_recv_mb_id">받는 회원<strong class="sr-only"> 필수</strong></label>
				<div class="col-sm-10 px-2">
					<input type="text" name="me_recv_mb_id" <?php if($member['mb_level'] < 24){ echo 'onkeyup="commaDown('.$total_count.')"';} else { echo ''; } ?> value="<?php echo $me_recv_mb_id ?>" <?php  if ($check==0){echo "disabled";} ?> id="me_recv_mb_id" <?php echo ( ! $is_admin) ? "required" : "";?> class="form-control">
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
<div class="popup_box">
	<label>3레벨 이상만 쪽지 <br />보내기가 가능합니다.<br />
(사이트안내 게시판 참고 바랍니다.)</label>
	<div class="btns">
		<a href="#" class="btn">확인</a>
	</div>
</div>

<script>

function commaDown(count){
	var max = 0;
	if(count <= 10)
	max = 10- count;
	var area = document.getElementById('me_recv_mb_id');	
	var txt = area.value;
	var commas = txt.split(",").length;

	if(commas > max) {
	var lastComma = txt.lastIndexOf(",");
	area.value = txt.substring(0, lastComma);
	commas--;
	alert("하루에 쪽지 보내기 10개 이상 불가능합니다.");
	}
	if (txt == '') {
	commas = 0;
	}
}

function fmemoform_submit(f) {
	<?php echo chk_captcha_js();  ?>	
	var mb_lvl = $('#mb_lvl').val();
	if(mb_lvl < 3){
		$('.popup_box').css("display", "block");
            $('.btn').click(function(){
                $('.popup_box').css("display", "none");
            });
            return false;
	} else {
		
    	return true;
	}
    
}

$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});

$(function() {
	$('.multiple-select').multipleSelect({
      multiple: true,
      multipleWidth: 110,
	minimumCountSelected: 5,
		formatSelectAll () {
			return '전체선택'
		},
		formatAllSelected () {
			return '전체선택됨'
		},
		formatCountSelected (count, total) {
			return '전체 ' + total + '개중 ' + count + '개 선택됨'
		}
	});
});
</script>
