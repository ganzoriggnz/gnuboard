<?php
if (!defined('_GNUBOARD_')) exit;

if($gr_id == 'attendance'){
	if( $member['mb_6'] != $bo_table){
		$write_href = '';
	} 
	else{
		$wr_cnt = sql_fetch(" select count(wr_id) as cnt from {$write_table} where wr_is_comment=0 and mb_id = '{$member['mb_id']}' ");
		if ($wr_cnt['cnt']) {
			$write_href = '';
		}
	}
}

// 데모
na_list_demo($demo);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);

$boset['list_skin'] = ($boset['list_skin']) ? $boset['list_skin'] : 'basic';
$list_skin_url = $board_skin_url . '/list/' . $boset['list_skin'];
$list_skin_path = $board_skin_path . '/list/' . $boset['list_skin'];

// 스킨설정
$is_skin_setup = (($is_admin == 'super' || IS_DEMO) && is_file($board_skin_path . '/setup.skin.php')) ? true : false;

// 리스트 헤드

@include_once($list_skin_path . '/list.head.skin.php');
// 인기글
add_javascript('<script src="'.G5_JS_URL.'/jquery.rumiTab.js"></script>', 0);
// 인기글
?>

<style>
	#bo_btn_top {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0.5rem 0;
	}
	@media only screen and (max-width: 600px) {
		#bo_search {
			padding: 0 0.6rem 1rem 0.4rem;
		}
		.adminbtn {
			padding: 0 0.1rem;
		}
	}
</style>

<!-- 게시판 목록 시작 { -->
<div id="bo_list_wrap">
<!-- 인기글 { -->
	<?php if ($bo_table != "pointrank" && $bo_table != "penyrank" && $bo_table != "levelrank" && $bo_table != "boardadmlist" 
	&& $bo_table != "mypage" && $gr_id!="attendance" && $bo_table != "greeting" && $bo_table != "notice" && $bo_table != "twitter"
	&& $bo_table != "facebook" && $bo_table != "twitter" && $bo_table != "ucc" && $bo_table != "work_abroad") {
	if(!G5_IS_MOBILE) include_once('hit_latest.php'); }?>
	<br>
	<?php
	// 게시판 카테고리
		if ($is_category)
		include_once($board_skin_path . '/category.skin.php');
	?>
	<!-- 검색창 시작 { -->
	<div id="bo_search" class="collapse<?php echo ($boset['search_open'] || $stx) ? ' show' : ''; ?> mt-3">
		<form id="fsearch" name="fsearch" method="get" class="m-auto">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<div class="form-row mx-n1">
				<div class="col-6 col-sm-3 px-1">
					<label for="sfl" class="sr-only">검색대상</label>
					<select name="sfl" class="custom-select">
						<?php echo get_board_sfl_select_options($sfl); ?>
					</select>
				</div>
				<div class="col-6 col-sm-3 px-1">
					<select name="sop" class="custom-select">
						<option value="and" <?php echo get_selected($sop, "and") ?>>그리고</option>
						<option value="or" <?php echo get_selected($sop, "or") ?>>또는</option>
					</select>
				</div>
				<div class="col-12 col-sm-6 pt-2 pt-sm-0 px-1">
					<label for="stx" class="sr-only">검색어</label>
					<div class="input-group">
						<input type="text" id="bo_stx" name="stx" value="<?php echo stripslashes($stx) ?>" required class="form-control" placeholder="검색어를 입력해 주세요.">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary" title="검색하기">
								<i class="fa fa-search" aria-hidden="true"></i>
								<span class="sr-only">검색하기</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<!-- } 검색창 끝 -->

	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">
		<?php if ($bo_table != "pointrank" && $bo_table != "penyrank" && $bo_table != "levelrank" && $bo_table != "boardadmlist" && $bo_table != "mypage")
		{ ?>

			<!-- 게시판 페이지 정보 및 버튼 시작 { -->
			<div id="bo_btn_top">
				<?php if(!G5_IS_MOBILE) {?>
				<div id="bo_list_total" class="float-left">					
					<?php $row = sql_fetch("select * from {$g5['member_table']} where mb_id='{$board['bo_admin']}'"); ?>
					<?php $row1 = sql_fetch("select * from {$g5['member_table']} where mb_id='{$group['gr_admin']}'"); ?>
					<?php echo "&nbsp; 방장 : " ?>
						<!-- 계급마크 출력-->
					<?php echo get_level($row['mb_id'])."  ", $row['mb_nick'], "  ",  get_level($row1['mb_id'])."  ", $row1['mb_nick'], "&nbsp;&nbsp;" ," / " ,"&nbsp;&nbsp;"?>
					<?php echo "[글 작성 ", $board['bo_write_point'], " 파운드 /  댓글 작성 ", $board['bo_comment_point'], " 파운드 획득]" ?>					
				</div>
				<?php } ?>
				<div role="group" class="float-right">
					<?php if ($admin_href) { ?>
						<a href="<?php echo $admin_href ?>" class="btn btn_admin nofocus py-1" title="관리자" role="button">
							<i class="fa fa-cog fa-spin fa-md" aria-hidden="true"></i>
							<span class="sr-only">관리자</span>
						</a>
					<?php } ?>
					<?php if ($rss_href) { ?>
						<a href="<?php echo $rss_href ?>" class="btn btn_b01 nofocus py-1" title="RSS">
							<i class="fa fa-rss fa-md" aria-hidden="true"></i>
							<span class="sr-only">RSS</span>
						</a>
					<?php } ?>
					<button type="button" class="btn btn_b01 nofocus py-1" title="게시판 검색" data-toggle="collapse" data-target="#bo_search" aria-expanded="false" aria-controls="bo_search">
						<i class="fa fa-search fa-md" aria-hidden="true"></i>
						<span class="sr-only">게시판 검색</span>
					</button>
					<div class="btn-group ">
					<?php if($board['gr_id'] == "review" && ($board['bo_admin'] == $member['mb_id'] || $group['gr_admin'] == $member['mb_id'] || $is_admin == 'super')) { ?> 
						<div> <a href="<?php echo G5_BBS_URL ?>/coupon_list.php?bo_table=<?php echo $board['bo_table'];?>" target="_blank" class="btn btn-primary win_coupon adminbtn" role="button">
						쿠폰지원내역 
						</a>	</div>
						&nbsp;&nbsp;
					<?php } ?>		
					<?php if ($write_href) { ?>						
						<div>
							<button type="button" class="btn btn-primary adminbtn" onclick="location.href='<?php echo $write_href ?>'">
								<img src="<?php echo G5_URL?>/img/solid/pencil-alt.svg" style="height: 10px;">&nbsp;글쓰기
							</button>
						</div>
					<?php } ?>
					</div>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn_b01 nofocus dropdown-toggle dropdown-toggle-empty dropdown-toggle-split py-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" title="게시물 정렬">
							<?php
							switch ($sst) {
								case 'wr_datetime':
									$sst_icon = 'history';
									$sst_txt = '날짜순 정렬';
									break;
								case 'wr_hit':
									$sst_icon = 'eye';
									$sst_txt = '조회순 정렬';
									break;
							if($board !='partnership'){
								case 'wr_good':
									$sst_icon = 'thumbs-o-up';
									$sst_txt = '추천순 정렬';
									break;
								case 'wr_nogood':
									$sst_icon = 'thumbs-o-down';
									$sst_txt = '비추천순 정렬';
									break;
								}
								default:
									$sst_icon = 'sort-numeric-desc';
									$sst_txt = '게시물 정렬';
									break;
							}
							?>
							<i class="fa fa-<?php echo $sst_icon ?> fa-md" aria-hidden="true"></i>
							<span class="sr-only"><?php echo $sst_txt ?></span>
						</button>
						<div class="dropdown-menu dropdown-menu-right p-0 border-0 bg-transparent text-right">
							<div class="btn-group-vertical bg-white border rounded py-1">
								<?php echo str_replace('>', ' class="btn px-3 py-1 text-left" role="button">', subject_sort_link('wr_datetime', $qstr2, 1)) ?>
								날짜순
								</a>
								<?php echo str_replace('>', ' class="btn px-3 py-1 text-left" role="button">', subject_sort_link('wr_hit', $qstr2, 1)) ?>
								조회순
								</a>
								<?php if ($is_good && $board !='partnership') { ?>
									<?php echo str_replace('>', ' class="btn px-3 py-1 text-left" role="button">', subject_sort_link('wr_good', $qstr2, 1)) ?>
									추천순
									</a>
								<?php } ?>
								<?php if ($is_nogood && $board !='partnership') { ?>
									<?php echo str_replace('>', ' class="btn px-3 py-1 text-left" role="button">', subject_sort_link('wr_nogood', $qstr2, 1)) ?>
									비추천순
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if ($is_admin == 'super' || $is_auth || IS_DEMO) {  ?>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn_b01 nofocus dropdown-toggle dropdown-toggle-split py-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" title="게시판 리스트 옵션">
								<span class="sr-only">게시판 리스트 옵션</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right p-0 border-0 bg-transparent text-right">
								<div class="btn-group-vertical">
									<?php if ($is_skin_setup) { ?>
										<a href="<?php echo na_setup_href('board', $bo_table) ?>" class="btn btn-primary btn-setup py-2" role="button">
											<i class="fa fa-cogs fa-fw" aria-hidden="true"></i> 스킨설정
										</a>
									<?php } ?>
									<?php if ($is_checkbox) { ?>
										<a href="javascript:;" class="btn btn-primary py-2" role="button">
											<label class="p-0 m-0" for="allCheck">
												<i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i>
												전체선택
											</label>
											<div class="sr-only">
												<input type="checkbox" id="allCheck" onclick="if (this.checked) all_checked(true); else all_checked(false);">
											</div>
										</a>
										<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-primary py-2">
											<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
											선택삭제
										</button>
										<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-primary py-2">
											<i class="fa fa-files-o fa-fw" aria-hidden="true"></i>
											선택복사
										</button>
										<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-primary py-2">
											<i class="fa fa-arrows fa-fw" aria-hidden="true"></i>
											선택이동
										</button>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php }  ?>
				</div>
			</div>
			<!-- hulan nemsen doorh neg mur -->
		<?php	} ?>

		<!-- } 게시판 페이지 정보 및 버튼 끝 -->


		<!-- 게시물 목록 시작 { -->
		<?php

		if ($bo_table != "pointrank" && $bo_table != "penyrank" && $bo_table != "levelrank" && $bo_table != "boardadmlist" && $bo_table != "mypage")  //  hulan nemsen 1 mur 
			// 목록스킨
			if (is_file($list_skin_path . '/list.skin.php')) {

				include_once($list_skin_path . '/list.skin.php');
			} else {
				echo '<div class="alert alert-warning text-center" role="alert">' . $boset['list_skin'] . ' 목록 스킨이 존재하지 않습니다.</div>' . PHP_EOL;
			}
		?>
		<!-- } 게시물 목록 끝 -->

		<?php if ($bo_table != "pointrank" && $bo_table != "penyrank" && $bo_table != "levelrank" && $bo_table != "boardadmlist" && $bo_table != "mypage") { ?>
			<!--  hulan nemsen 1 mur -->
			<!-- 페이지 시작 { -->
			<div>
				<ul class="pagination justify-content-center en mb-0">
					<?php if ($prev_part_href) { ?>
						<li class="page-item"><a class="page-link" href="<?php echo $prev_part_href; ?>">Prev</a></li>
					<?php } ?>
					<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, get_pretty_url($bo_table, '', $qstr . '&amp;page=')); ?>
					<?php if ($next_part_href) { ?>
						<li class="page-item"><a class="page-link" href="<?php echo $next_part_href; ?>">Next</a></li>
					<?php } ?>
				</ul>
			</div>

			<!-- } 페이지 끝 -->
		<?php } ?>
	</form>
</div>

<?php if ($is_checkbox) { ?>
	<noscript>
		<p align="center">자바스크립트를 사용하지 않는 경우 별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>	

	<script>
		function all_checked(sw) {
			var f = document.fboardlist;

			for (var i = 0; i < f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]")
					f.elements[i].checked = sw;
			}
		}

		function fboardlist_submit(f) {
			var chk_count = 0;

			for (var i = 0; i < f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
					chk_count++;
			}

			if (!chk_count) {
				alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
				return false;
			}

			if (document.pressed == "선택복사") {
				select_copy("copy");
				return;
			}

			if (document.pressed == "선택이동") {
				select_copy("move");
				return;
			}

			if (document.pressed == "선택삭제") {
				if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
					return false;

				f.removeAttribute("target");
				f.action = g5_bbs_url + "/board_list_update.php";
			}

			return true;
		}



		// 선택한 게시물 복사 및 이동
		function select_copy(sw) {
			var f = document.fboardlist;

			if (sw == "copy")
				str = "복사";
			else
				str = "이동";

			var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

			f.sw.value = sw;
			f.target = "move";
			f.action = g5_bbs_url + "/move.php";
			f.submit();
		}
	</script>


<?php } ?>
<!-- } 게시판 목록 끝 -->

<!--hulan nemsen  -->
<?php if ($bo_table == "pointrank") {
	include_once($board_skin_path . '/pointrank.php');
} ?>
<!-- /////////////////////////////// -->

<!--hulan nemsen  -->
<?php if ($bo_table == "penyrank") {
	include_once($board_skin_path . '/penyrank.php');
} ?>
<!-- /////////////////////////////// --> 

<!--hulan nemsen  -->
<?php if ($bo_table == "levelrank") {
	include_once($board_skin_path . '/levelrank.php');
} ?>
<!-- /////////////////////////////// -->

<?php if ($bo_table == "boardadmlist") {
	include_once($board_skin_path . '/boardadmlist.php');
} ?>