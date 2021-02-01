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

		.notice{width:100%; height:16px; overflow:hidden;}
		.rolling{position:relative; width:100%; height:auto;}
		.rolling li{width:100%; height:16px; line-height:50px;}

		.rolling_stop{display:block; height:20px; color:#000; }
		.rolling_start{display:block;  height:20px; color:#000;}
	</style>
<!-- Page Title -->
<div id="nt_title" class="font-weight-normal">
	<div class="nt-container px-3 px-sm-4 px-xl-0">	
		<div class="d-flex pb-2">
			<div class="notice">
				<ul class="rolling">
				<?php for ($i=0; $i<$tood;$i++ ) {		
				?>
				<li>
				<?php echo $list[$i]?>
				</li>
				<?php }?>
				</ul>
			</div>
			<!-- <a href="#" class="rolling_stop">Pause</a>
<a href="#" class="rolling_start">Play</a> -->
		</div>

	</div>
</div>

<script>
$(document).ready(function(){
	var height =  $(".notice").height();
	var num = $(".rolling li").length;
	var max = height * num;
	var move = 0;
	function noticeRolling(){
		move += height;
		$(".rolling").animate({"top":-move},600,function(){
			if( move >= max ){
				$(this).css("top",0);
				move = 0;
			};
		});
	};
	noticeRollingOff = setInterval(noticeRolling,3000);
	$(".rolling").append($(".rolling li").first().clone());

	$(".rolling_stop").click(function(){
		clearInterval(noticeRollingOff);
	});
	$(".rolling_start").click(function(){
		noticeRollingOff = setInterval(noticeRolling,9000);
	});
});		
</script>
