<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $qa_skin_url . '/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('qa');

// 목록 헤드
$head_color = ($wset['head_color']) ? $wset['head_color'] : 'primary';
if ($wset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="' . NA_URL . '/skin/head/' . $wset['head_skin'] . '.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = 'na-table-head border-' . $head_color;
}

?>

<?php
// 분류
$is_category = false;
if ($category_option) {
	$is_category = true;

	na_script('sly');

	$cn = $ca_select = 0;
	$ca_count = (isset($categories) && is_array($categories)) ? count($categories) : 0;
	$ca_start = ($sca) ? '' : ' class="active"';
	$category_option = '<div' . $ca_start . '><a href="' . $category_href . '">전체</a></div>';
	for ($i = 0; $i < $ca_count; $i++) {
		$category = trim($categories[$i]);
		if ($category == '')
			continue;

		$cn++; // 카운트 증가
		$ca_active = $ca_msg = '';
		if ($category == $sca) { // 현재 선택된 분류라면
			$ca_active = ' class="active"';
			$ca_msg = '<span class="sr-only">현재 분류</span>';
			$ca_select = $cn; // 현재 위치 표시
		}
		$category_option .= '<div' . $ca_active . '><a href="' . $category_href . '?sca=' . urlencode($category) . '">' . $ca_msg . $category . '</a></div>';
	}
?>

	<!-- 분류 시작 { -->
	<nav id="user_category">
		<h3 class="sr-only"><?php echo $qaconfig['qa_title'] ?> 분류 목록</h3>
		<div class="category_btns">
			<?php echo $category_option ?>
		</div>
	</nav>
	<!-- } 분류 끝 -->
<?php } ?>

<!-- 검색창 시작 { -->
<div id="bo_search" class="collapse<?php echo ($wset['search_open'] || $stx) ? ' show' : ''; ?>">
	<form id="fsearch" name="fsearch" method="get">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<label for="stx" class="sr-only">검색어</label>
		<div class="input-group">
			<input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" id="qa_stx" required class="form-control" maxlength="15" placeholder="검색어를 입력해주세요.">
			<div class="input-group-append">
				<button type="submit" class="btn btn-primary" title="검색하기">
					<i class="fa fa-search" aria-hidden="true"></i>
					<span class="sr-only">검색하기</span>
				</button>
			</div>
		</div>
	</form>
</div>
<!-- } 검색창 끝 -->

<div id="bo_list">

	<form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
		<input type="hidden" name="stx" value="<?php echo $stx; ?>">
		<input type="hidden" name="sca" value="<?php echo $sca; ?>">
		<input type="hidden" name="page" value="<?php echo $page; ?>">

		<!-- 게시판 페이지 정보 및 버튼 시작 { -->
		<div id="bo_btn_top" class="clearfix pt-2 pl-3 pr-2 mb-2 f-de font-weight-normal px-sm-0">
			<div class="d-flex align-items-center">
				<div id="bo_list_total" class="flex-grow-1">
					<!-- Total <b><?php echo number_format($total_count) ?></b> / <?php echo $page ?> Page -->
				</div>
				<div class="btn-group" role="group">
					<?php if ($admin_href && G5_BZY_CHECK) { ?>
						<a href="<?php echo $admin_href ?>" class="py-1 btn btn_admin nofocus" title="관리자" role="button">
							<i class="fa fa-cog fa-spin fa-md" aria-hidden="true"></i>
							<span class="sr-only">관리자</span>
						</a>
					<?php } ?>
					<?php if ($admin_href || IS_DEMO) { ?>
						<?php if (is_file($qa_skin_path . '/setup.skin.php')) { ?>
							<a href="<?php echo na_setup_href('qa') ?>" title="스킨 설정" class="py-1 btn btn_b01 btn-setup nofocus" rolo="button">
								<i class="fa fa-cogs fa-md" aria-hidden="true"></i></a>
							<span class="sr-only">스킨 설정</span>
							</a>
						<?php } ?>
					<?php } ?>
					<?php if ($is_checkbox) { ?>
						<button type="submit" name="btn_submit" value="선택삭제" title="선택 삭제" onclick="document.pressed=this.value" class="py-1 btn btn_b01 nofocus">
							<i class="fa fa-trash-o fa-md" aria-hidden="true"></i>
							<span class="sr-only">선택 삭제</span>
						</button>
					<?php } ?>
					<button type="button" class="py-1 btn btn_b01 nofocus" title="검색" data-toggle="collapse" data-target="#bo_search" aria-expanded="false" aria-controls="bo_search">
						<i class="fa fa-search fa-md" aria-hidden="true"></i>
						<span class="sr-only">검색</span>
					</button>
					<?php if ($write_href) { ?>
						<div>
							<button type="button" class="btn btn-primary writebtn" onclick="location.href='<?php echo $write_href ?>'">
								<img src="<?php echo G5_URL ?>/img/solid/pencil-alt.svg" style="height: 10px;"> 글쓰기
							</button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- } 게시판 페이지 정보 및 버튼 끝 -->

		<!-- 목록 헤드 -->
		<div class="d-block d-md-none w-100 mb-0 bg-<?php echo $head_color ?>" style="height:1px;"></div>

		<div class="mb-0 na-table d-none d-md-table w-100">
			<div class="<?php echo $head_class ?> d-md-table-row">
				<div class="d-md-table-cell nw-5 px-md-1">번호</div>
				<div class="d-md-table-cell pr-md-1">
					<?php if ($is_checkbox) { ?>
						<label class="float-left mb-0">
							<span class="sr-only">목록 전체 선택</span>
							<input type="checkbox" id="all_chk">
						</label>
					<?php } ?>
					제목
				</div>
				<div class="pl-2 d-md-table-cell nw-20 pr-md-1">이름</div>
				<div class="d-md-table-cell nw-5 pr-md-1">상태</div>
				<div class="d-md-table-cell nw-8 pr-md-1">날짜</div>
			</div>
		</div>

		<ul class="na-table d-md-table w-100" style="font-size: 12px;">
			<?php
			$list_cnt = count($list);
			for ($i = 0; $i < $list_cnt; $i++) {

				// 전체 보기에서 분류 출력하기
				if (!$sca && $is_category && $list[$i]['category']) {
					$list[$i]['subject'] = $list[$i]['category'] . ' <span class="na-bar"></span> ' . $list[$i]['subject'];
				}
			?>
				<li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom<?php echo $li_css; ?>">
					<div class="d-none d-md-table-cell nw-5 f-sm font-weight-normal py-md-2 px-md-1">
						<?php echo $list[$i]['num'] ?>
					</div>
					<div class="text-left d-md-table-cell py-md-2 pr-md-01">
						<div class="na-title float-md-left">
							<div class="na-item">
								<?php if ($is_checkbox) { ?>
									<input type="checkbox" class="mb-0 mr-2" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>">
								<?php } ?>
								<a href="<?php echo $list[$i]['view_href'] ?>" class="na-subject">
									<?php echo $wr_icon ?>
									<?php echo $list[$i]['subject'] ?>
								</a>
								<?php
								if ($list[$i]['icon_file'])
									echo '<span class="na-ticon na-file"></span>' . PHP_EOL;
								?>
							</div>
						</div>
					</div>
					<div class="float-right pl-2 text-left float-md-none d-md-table-cell nw-20 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-01">
						<span class="sr-only">등록자</span>
						<?php echo na_name_photo($list[$i]['mb_id'], get_sideview($list[$i]['mb_id'], $list[$i]['qa_name'], $list[$i]['qa_email'], '')) ?>
					</div>
					<div class="float-left float-md-none d-md-table-cell nw-5 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
						<?php echo ($list[$i]['qa_status']) ? '<span class="orangered">완료</span>' : '대기'; ?>
					</div>
					<div class="float-left float-md-none d-md-table-cell nw-8 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
						<span class="sr-only">등록일</span>
						<?php echo na_date($list[$i]['qa_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
					</div>
					<div class="clearfix d-block d-md-none"></div>
				</li>
			<?php }	?>
		</ul>

		<?php if (!$list_cnt) { ?>
			<div class="px-3 py-5 text-center f-de font-weight-normal text-muted border-bottom">게시물이 없습니다.</div>
		<?php } ?>

		<!-- 페이지 -->
		<div class="mt-4 mb-4">
			<ul class="pagination justify-content-center en">
				<?php echo preg_replace('/(\.php)(&amp;|&)/i', '$1?', na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php' . $qstr . '&amp;page=')); ?>
			</ul>
		</div>
		<!-- 페이지 -->

	</form>
</div>

<div class="h30"></div>

<?php if ($is_checkbox) { ?>
	<noscript>
		<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
	<script>
		$(function() {
			$('#all_chk').click(function() {
				$('[name="chk_qa_id[]"]').attr('checked', this.checked);
			});
		});

		function fqalist_submit(f) {
			var chk_count = 0;

			for (var i = 0; i < f.length; i++) {
				if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
					chk_count++;
			}

			if (!chk_count) {
				alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
				return false;
			}

			if (document.pressed == "선택삭제") {
				if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
					return false;
			}

			return true;
		}
	</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->