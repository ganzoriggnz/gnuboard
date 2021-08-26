<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 정리
na_script('sly');

$cn = $ca_select = 0;
$ca_count = (isset($categories) && is_array($categories)) ? count($categories) : 0;
$ca_start = ($sca) ? '' : ' class="active"';
$category_option = '<div'.$ca_start.'><a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'">전체</a></div>';
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
	$category_option .= '<div'.$ca_active.'><a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&sca='.$category.'">'.$ca_msg.$category.'</a></div>';
}

?>
<style>
#bo_cate .category-list {
	display: grid;
	grid-template-columns: repeat(8, 1fr);
	grid-gap: 0.2rem;
}

#bo_cate .category-list div {
	width: 100%;
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}

#bo_cate .category-list div a {
	padding: 0.5rem 0;
	border: 1px solid #e5e5e5;
	border-radius: 5px;
	width: 100%;
}

.category-list .active, .category-list div a:focus, .category-list div a:hover {
	font-weight: bold;
}
@media only screen and (max-width: 600px) {
	#bo_cate .category-list {
		padding: 0 0.6rem 1rem 0.4rem;
		width: 100%;
		display: grid;
		grid-template-columns: repeat(5, 1fr);
	}
	#bo_cate .category-list div a {
		font-size: 10px;
	}
}
</style>
<nav id="bo_cate">
	<h3 class="sr-only"><?php echo $board['bo_subject'] ?> 분류 목록</h3>

	<div class="category-list <?php echo G5_IS_MOBILE ? ' pb-1 ' : '' ?>">
		<?php echo $category_option ?>
	</div>
</nav>

