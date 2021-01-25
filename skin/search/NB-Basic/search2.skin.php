<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('search');

$head_color = ($wset['head_color']) ? $wset['head_color'] : 'primary';

?>
<div id="sch_res_detail pt-2" class="mb-4">
	<div class="alert bg-light border p-2 p-sm-3 mb-3 mx-3 mx-sm-0">
		<form name="fsearch" onsubmit="return fsearch_submit(this);" action="<?php echo G5_BBS_URL."/board.php"?>" method="get" class="m-auto" style="max-width:600px;">
		<input type="hidden" name="bo_table" value="gallery">
		<input type="hidden" name="sca" value="<?php echo $searchd ?>">
		<input type="hidden" name="subsca" value="<?php echo $searchd ?>">

		<legend class="sound_only">상세검색</legend>
		<div class="form-row mx-n1">
			<div class="col-12 pt-2 pt-sm-0 px-1">				
				<div class="input-group">
					<input type="text" id="searchd" name="searchd" value="<?php if($searchd) echo $searchd; ?>" required class="form-control"
					 placeholder="지역 이나 업종 또는 업소명을 입력하세요.">
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
		<script>
		function fsearch_submit(f) {
			return true;
		}
		</script>
	</div>
</div>