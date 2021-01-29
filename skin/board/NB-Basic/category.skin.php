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
    
}
</style>
<nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
	<div class="px-3 px-sm-0">
		<div class="d-flex">
			<div id="bo_cate_list" class="flex-grow-1">
				<ul id="bo_cate_ul" class="border-left-0 text-nowrap">
					<?php echo $category_option ?>
				</ul>
			</div>
		</div>
	</div>
	<hr style="margin-top:1px;"/> 
</nav>
