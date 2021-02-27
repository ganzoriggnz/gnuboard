<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_title_url.'/title.css">', 0);

$list = array();
$sql = " select * from {$g5['fragment_table']}";
$result = sql_fetch($sql);
$tood=0;
if($result['fr_8'] !=''){
	$list[$tood] = $result['fr_8'];
	$tood++;
	// print($result['fr_8']."(8)<br>");
}
if($result['fr_9'] !=''){
	$list[$tood] = $result['fr_9'];
	$tood++;
	// print($result['fr_9']."(9)<br>");
}	
if($result['fr_10'] !=''){
	$list[$tood] = $result['fr_10'];
	$tood++;
	// print($result['fr_10']."(10)<br>");
}
// print($tood-1);
$too = rand(0,$tood-1);
// print($too);
?>
<style>

@media (min-width: 481px) {
		.notice{width:48%; height:16px; overflow:hidden;}
		.rolling{position:relative; width:100%; height:16px;}
		.rolling li{width:100%; height:16px; line-height:50px;}
}
@media (max-width: 480px) {
	.notice{width:48%; height:16px; overflow:hidden;}
	.rolling{position:relative; width:100%; height:16px;}
	.rolling li{width:100%; height:16px; line-height:50px;}
}

		.notice{width:48%; height:16px; overflow:hidden;}
		.rolling{position:relative; width:100%; height:16px;}
		.rolling li{width:100%; height:16px; line-height:50px;}

		.rolling_stop{display:block; height:20px; color:#000; }
		.rolling_start{display:block;  height:20px; color:#000;}
	</style>
<!-- Page Title -->

<div id="nt_title" class="font-weight-normal">
	<div class="nt-container px-3 px-sm-4 px-xl-0">	
		<div class="d-flex pb-2" style="justify-content: left;" >
			<?php if (!G5_IS_MOBILE) { ?>
			<img src="<?php echo G5_URL?>/img/baseline-notifications-24px.png" title="" style="height:16px;width:10px; padding-top:5px;" >&nbsp;
			<div class="notice" style="width: 100%;">
				<ul class="rolling">
				<?php for ($i=0; $i<$tood;$i++ ) {		
				?>
				<li style="color:#e4c980;"><?php echo $list[$i]?></li>
				<?php }?>
			</div>
			<?php } ?>
			<!-- <a href="#" class="rolling_stop">Pause</a>
<a href="#" class="rolling_start">Play</a> -->

<!-- start------------------------------------- -->
<?php
$sql_date = "SELECT mb_4 FROM {$g5['member_table']} WHERE mb_id = '{$member['mb_id']}' AND mb_level IN ('26', '27')";
$res_date = sql_fetch($sql_date);
$now = G5_TIME_YMDHIS;
if($res_date['mb_4'] != ''){
	$end_time = strtotime($res_date['mb_4']);
	$now_time = strtotime($now);
	if($end_time >= $now_time){
		$diff = $end_time - $now_time;
		$diff_days = ceil($diff / 86400);
	}
	else if($end_time < $now_time){
		$diff_days = '0';
		$sql_d = " UPDATE {$g5['member_table']} 
						SET mb_level = '26'
						WHERE mb_id = '{$mb['mb_id']}' AND mb_level='27'";
		sql_query($sql_d);
	}
}
if($member['mb_level'] == '26' || $member['mb_level'] == '27') { 
        ?>
        <div class="d-md-block d-none" style="width:20%; padding:0px ">
			<div  class="d-flex" style="padding:0px ">
            <p>제휴마감 <span style="color: #3333ff;">D-<?php echo $diff_days ?>일</span></p>
            <a class="cat_1_bg <?php if( strstr($menu[1]['s'][$i]['href'], $bo_table)) echo"activesubs" ?>"
                href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=partnership" target="_self">
                연장신청
            </a>
			</div>
        </div>
    
<!-- end --------------------->

		</div>
	</div>
</div>
<?php } ?>
<script>
$(document).ready(function(){
	var height =  $(".notice").height();
	var num = $(".rolling li").length;
	var max = height * num;
	var move = 0;
	function noticeRolling(){
		move += height;
		$(".rolling").animate({"top":-move},1000,function(){
			if( move > max ){
				$(this).css("top",0);
				move = 0;
			};
		});
	};
	noticeRollingOff = setInterval(noticeRolling,2000);
	$(".rolling").append($(".rolling li").first().clone());

	// $(".rolling_stop").click(function(){
	// 	clearInterval(noticeRollingOff);
	// });
	// $(".rolling_start").click(function(){
	// 	noticeRollingOff = setInterval(noticeRolling,9000);
	// });
});		
</script>
