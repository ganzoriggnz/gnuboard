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
<!-- Page Title -->
<div id="nt_title" class="font-weight-normal">
	<div class="nt-container px-3 px-sm-4 px-xl-0">	
	<div class="d-flex pb-2">
			<marquee behavior="slide" direction="left" scrolldelay="0"  scrollamount="10"><?php echo $list[$too]?></marquee>
		</div>
	</div>
</div>
