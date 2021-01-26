<<<<<<< HEAD
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 정리
na_script('sly');

$cn = $ca_select = 0;
$ca_count = (isset($categories) && is_array($categories)) ? count($categories) : 0;
$ca_start = ($sca) ? '' : ' class="active"';
$category_option = '<li'.$ca_start.'><a class="py-2 px-3" href="'.get_pretty_url($bo_table).'">전체</a></li>';
for ($i=0; $i<$ca_count; $i++) {
	$category = trim($categories[$i]);
	if ($category=='')
		continue;

	$cn++; // 카운트 증가
	$ca_active = $ca_msg = '';
	if($category==$sca) { // 현재 선택된 분류라면
		$ca_active = ' class="active"';
		$ca_msg = '<span class="sr-only">현재 분류</span>';
		$ca_select = $cn; // 현재 위치 표시
	}
	$category_option .= '<li'.$ca_active.'><a class="py-2 px-3" href="'.(get_pretty_url($bo_table,'','sca='.urlencode($category))).'">'.$ca_msg.$category.'</a></li>';
}

?>
<style>

#bo_cate_list ul {
    width: 1200px;
    position: relative;
}
#bo_cate_list ul:before, ul:after {
    text-align: center;
    display: block;
    border: 1px solid black;
    width: 100%;
}

    
#bo_cate_list li {
    text-align: right;
    width: 10%;
	float: left;
	margin-bottom: -2px;
    /* border: 1px solid black; */
    
}
/* #bo_cate_list li:nth-child(even) {
    margin-left: -0.1px;
} */
</style>
<nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
	<div class="px-3 px-sm-0">
		<div class="d-flex" style="width:1200px;">
			<div id="bo_cate_list" class="flex-grow-1">
				<ul id="bo_cate_ul" class="border-left-0 text-nowrap">
					<?php echo $category_option ?>
				</ul>
			</div>
		</div>
	</div>
	<hr style="margin-top:1px;"/> 
</nav>
<!-- <nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
	<div class="px-3 px-sm-0">
		<div class="d-flex" style="width:1200px;">
			<div id="bo_cate_list" class="sly-wrap flex-grow-1">
				<ul id="bo_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
					<?php echo $category_option ?>
				</ul>
			</div>
			<div>
				<a href="javascript:;" class="sly-btn sly-prev ca-prev py-2 px-3">
					<i class="fa fa-angle-left" aria-hidden="true"></i>
					<span class="sr-only">이전 분류</span>
				</a>
			</div>
			<div>
				<a href="javascript:;" class="sly-btn sly-next ca-next py-2 px-3">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
					<span class="sr-only">다음 분류</span>
				</a>
			</div> 
		</div>
	</div>
	<hr/>
	<script>
		$(document).ready(function() {
			$('#bo_cate .sly-wrap').sly({
				horizontal: 1,
				itemNav: 'basic',
				smart: 1,
				mouseDragging: 1,
				touchDragging: 1,
				releaseSwing: 1,
				startAt: <?php echo $ca_select ?>,
				speed: 300,
				prevPage: '#bo_cate .ca-prev',
				nextPage: '#bo_cate .ca-next'
			});

			// Sly Tab
			var cate_id = 'bo_cate';
			var cate_size = na_sly_size(cate_id);

			na_sly(cate_id, cate_size);

			$(window).resize(function(e) {
				na_sly(cate_id, cate_size);
			});
		});
	</script>
</nav> -->
=======
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 정리
na_script('sly');

$cn = $ca_select = 0;
$ca_count = (isset($categories) && is_array($categories)) ? count($categories) : 0;
$ca_start = ($sca) ? '' : ' class="active"';
$category_option = '<li'.$ca_start.'><a class="py-2 px-3" href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'">전체</a></li>';
for ($i=0; $i<$ca_count; $i++) {
	$category = trim($categories[$i]);
	if ($category=='')
		continue;

	$cn++; // 카운트 증가
	$ca_active = $ca_msg = '';
	if($category==$sca) { // 현재 선택된 분류라면
		$ca_active = ' class="active"';
		$ca_msg = '<span class="sr-only">현재 분류</span>';
		$ca_select = $cn; // 현재 위치 표시
	}
	$category_option .= '<li'.$ca_active.'><a class="py-2 px-3" href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&sca='.$category.'">'.$ca_msg.$category.'</a></li>';
}

?>
<style>

#bo_cate_list ul {
    width: 1200px;
    position: relative;
}
#bo_cate_list ul:before, ul:after {
    text-align: center;
    display: block;
    border: 1px solid black;
    width: 100%;
}

    
#bo_cate_list li {
    text-align: right;
    width: 10%;
	float: left;
	margin-bottom: -2px;
    /* border: 1px solid black; */
    
}
/* #bo_cate_list li:nth-child(even) {
    margin-left: -0.1px;
} */
</style>
<nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
	<div class="px-3 px-sm-0">
		<div class="d-flex" style="width:1200px;">
			<div id="bo_cate_list" class="flex-grow-1">
				<ul id="bo_cate_ul" class="border-left-0 text-nowrap">
					<?php echo $category_option ?>
				</ul>
			</div>
		</div>
	</div>
	<hr style="margin-top:1px;"/> 
</nav>
<!-- <nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
	<div class="px-3 px-sm-0">
		<div class="d-flex" style="width:1200px;">
			<div id="bo_cate_list" class="sly-wrap flex-grow-1">
				<ul id="bo_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
					<?php echo $category_option ?>
				</ul>
			</div>
			<div>
				<a href="javascript:;" class="sly-btn sly-prev ca-prev py-2 px-3">
					<i class="fa fa-angle-left" aria-hidden="true"></i>
					<span class="sr-only">이전 분류</span>
				</a>
			</div>
			<div>
				<a href="javascript:;" class="sly-btn sly-next ca-next py-2 px-3">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
					<span class="sr-only">다음 분류</span>
				</a>
			</div> 
		</div>
	</div>
	<hr/>
	<script>
		$(document).ready(function() {
			$('#bo_cate .sly-wrap').sly({
				horizontal: 1,
				itemNav: 'basic',
				smart: 1,
				mouseDragging: 1,
				touchDragging: 1,
				releaseSwing: 1,
				startAt: <?php echo $ca_select ?>,
				speed: 300,
				prevPage: '#bo_cate .ca-prev',
				nextPage: '#bo_cate .ca-next'
			});

			// Sly Tab
			var cate_id = 'bo_cate';
			var cate_size = na_sly_size(cate_id);

			na_sly(cate_id, cate_size);

			$(window).resize(function(e) {
				na_sly(cate_id, cate_size);
			});
		});
	</script>
</nav> -->
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
