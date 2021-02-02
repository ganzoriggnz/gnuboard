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
#bo_cate ul {zoom:1}
#bo_cate ul:after {display:block;visibility:hidden;clear:both;content:"";}
#bo_cate li {display:inline-block;padding:0px;  }
#bo_cate a {border-radius: 2px; font-size:12px; color:#000; width:100%; height:39px; display: flex; align-items:center; justify-content:center; margin-left: 0px;}
#bo_cate a:focus, #bo_cate a:hover, #bo_cate a:active { text-decoration:none; color:#000;font-weight: bold; background-color: #fff }
#bo_cate #bo_cate_on {z-index:2; font-size:12px; font-weight: bold; color:#000; width:95px; height:39px; display:flex; align-items:center; justify-content: center;}

</style>
<nav id="bo_cate" class="sly-tab font-weight-normal mb-2">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>
		<div class="bo_cate pl-2">
			<div class="bo_cate">
				<ul class="bo_cate_ul">
					<?php echo $category_option ?>
				</ul>
			</div>
		</div>
</nav>
