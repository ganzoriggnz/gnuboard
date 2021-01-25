<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section id="anc_na_bbs">
	<h2 class="h2_frm">게시판 플러그인 설정</h2>

	<div class="tbl_frm01 tbl_wrap">
		<table>
		<colgroup>
			<col class="grid_4">
			<col>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row">
				버전
			</th>
			<td colspan="3">
				<?php @include_once(NA_PATH.'/extend/bbs/version.php') ?>
			</td>
		</tr>
		<tr>
			<th scope="row">
				플러그인 사용
			</th>
			<td colspan="3">
				<?php echo help('태그 기능, 신고 기능 등 게시판 기능을 확장합니다.') ?>
				<label>
					<input type="checkbox" name="na[bbs]" value="1"<?php echo get_checked('1', $nariya['bbs'])?>> 사용
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">
				DB 업그레이드
			</th>
			<td colspan="3">
				<?php echo help('게시판 기능 확장을 위한 DB 업그레이드를 실행합니다. ※ 최초 사용 설정시 반드시 실행해 줘야 합니다.') ?>
				<button type="button" class="btn btn_03" onclick="na_upgrade('<?php echo NA_URL ?>/extend/bbs/db.php');">DB 업그레이드</button>
			</td>
		</tr>
		<tr>
			<th scope="row">
				태그모음 스킨
			</th>
			<td colspan="3">
				<?php echo help('/'.NA_DIR.'/skin/tag 폴더') ?>
				<select name="na[tag_skin]">
					<?php 
					unset($skins);
					$skins = na_dir_list(NA_PATH.'/skin/tag');
					for ($i=0; $i<count($skins); $i++) { 
					?>
						<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($nariya['tag_skin'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row">
				신고모음 스킨
			</th>
			<td colspan="3">
				<?php echo help('/'.NA_DIR.'/skin/shingo 폴더') ?>
				<select name="na[shingo_skin]">
					<?php 
					unset($skins);
					$skins = na_dir_list(NA_PATH.'/skin/shingo');
					for ($i=0; $i<count($skins); $i++) { 
					?>
						<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($nariya['shigo_skin'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</section>
