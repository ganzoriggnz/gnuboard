<?php

/*
===========================================================

	프로젝트 이름 : Piree WON Program

	만든사람 : 피리

	홈페이지 : http://www.piree.co.kr

	작성날짜 : 2014년 01월 21일 화요일 오후 21시 16분, 날씨 쌀쌀하다

	저 작 권 : Copyright ⓒ 2014 투스포츠 (원병철) All right reserved
							그누보드 외에 추가된 소스는~
							만든사람의 허락없이 무단으로 사용할수 없습니다.
							사용하고자 할 경우 만든사람의 허락을 받아야 합니다.
							http://www.piree.co.kr 에 문의해 주세요.

===========================================================
 관리자 > 피리 > 피리 출석체크 FREE G5 > 처음
===========================================================


*/


	#########################################################
	# 시작 => 선_처리__메뉴_지정__관리자_확인
	#########################################################

	//=======================================================
	// 메뉴_번호__지정____출석체크
	$sub_menu = "760003";


	//=======================================================
	// 기본처리_화일__첨부
	include_once ("./_common.php");


	//=======================================================
	// 시작 => 회원_아니면
	IF (!$is_member)
	{
		// 경고창
		alert('회원만 이용하실 수 있습니다.', G5_URL);
	}
	// 끝 => 회원_아니면
	//=======================================================


	//=======================================================
	// 관리자_확인
	auth_check($auth[$sub_menu], "r");

	#########################################################
	# 끝 => 선_처리
	#########################################################



	#########################################################
	# 시작 => 레벨__설정_정보_화일__첨부
	#########################################################

	//=======================================================
	// 기본_설정_첨부__여부
	// 0 - 안해
	// 1 - 하자
	$is_get__piree_config = 1;


	//=======================================================
	// 출석체크__설정_정보__가져오기
	$is_get__attend_config = 1;


	//=======================================================
	// 설정_화면__여부
	$is_piree_program_config = 1;


	//=======================================================
	// 레벨__설정_정보_화일__경로
	$piree_dir_path = PIREE_CONFIG_PATH ."/p__".$sub_menu."/pi__config.php";


	//=======================================================
	// 레벨__설정_정보_화일__경로
	include_once ($piree_dir_path);

	#########################################################
	# 끝 => 레벨__설정_정보_화일__첨부
	#########################################################



	#########################################################
	# 시작 => 마무리__페이지_ECHO_관련
	#########################################################

	//=======================================================
	// 타이틀
	$g5["title"] = "피리 출석체크 FREE G5";


	//=======================================================
	// HEAD_첨부
	include_once ("../admin.head.php");

	#########################################################
	# 끝 => 마무리__페이지_ECHO_관련
	#########################################################


?>

<section>
		<h2>출석체크 정보 수정하기</h2>

		<form name="level_list" id="level_list" action="./pi__config.update.php" onsubmit="return attend_check_submit(this);" method="post">

		<div class="tbl_head01 tbl_wrap">
				<table>
				<caption>피리 피리 출석체크 FREE G5</caption>
				<thead>
				<tr>
					<th scope="col">PC 스킨</th>
					<th scope="col">모바일 스킨</th>
					<th scope="col">시작 시간</th>
					<th scope="col">마감 시간</th>
					<th scope="col">출석 포인트</th>
					<th scope="col">개근 날짜</th>
					<th scope="col">개근 포인트</th>
					<th scope="col">1등 포인트</th>
				</tr>
				</thead>
				<tbody>

				<tr>
						<td align="center">
							<select id="skin_pc_label" name="skin_pc_c">
<?php

							//===========================================
							// PC__스킨_목록__가져오기
							$skins = get_skin_dir($attend_config["prog_dir"], PIREE_SKIN_PC_PATH);


							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<count($skins); $i++)
							{
								// 선택_여부
								$selected = $attend_config["skin_pc_c"] == $skins[$i] ? " selected" : "";
?>
								<option value="<?php echo $skins[$i]; ?>"<?=$selected ?>><?php echo $skins[$i]; ?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select>
						</td>

						<td align="center">
							<select id="skin_mobile_label" name="skin_mobile_c">
<?php

							//===========================================
							// 모바일__스킨_목록__가져오기
							$skins = get_skin_dir($attend_config["prog_dir"], PIREE_SKIN_MOBILE_PATH);


							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<count($skins); $i++)
							{
								// 선택_여부
								$selected = $attend_config["skin_mobile_c"] == $skins[$i] ? " selected" : "";
?>
								<option value="<?php echo $skins[$i]; ?>"<?=$selected ?>><?php echo $skins[$i]; ?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select>
						</td>

						<td align="center">
							<label for="start_time_H_label" class="sound_only">시작 시간 시각</label>
							<select name="start_time_H" id="start_time_H_label" class="frm_input">
<?php

							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<24; $i++)
							{
								// 시간__다듬기
								$time_s = $i<13 ? "오전 ".$i : "오후 ".$i;
?>
								<option value="<?=$i?>"<?php	if ($i == $attend_config["start_time_H"]) echo " selected";	?>><?=$time_s?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select> 시
							&nbsp; 
							<label for="start_time_i_label" class="sound_only">시작 시간 분</label>
							<select name="start_time_i" id="start_time_i_label" class="frm_input">
<?php

							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<60; $i++)
							{
?>
								<option value="<?=$i?>"<?php	if ($i == $attend_config["start_time_i"]) echo " selected";	?>><?=$i?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select> 분
						</td>

						<td align="center">
							<label for="close_time_H_label" class="sound_only">마감 시간 시각</label>
							<select name="close_time_H" id="close_time_H_label" class="frm_input">
<?php

							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<24; $i++)
							{
								// 시간__다듬기
								$time_s = $i<13 ? "오전 ".$i : "오후 ".$i;
?>
								<option value="<?=$i?>"<?php	if ($i == $attend_config["close_time_H"]) echo " selected";	?>><?=$time_s?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select> 시
							&nbsp; 
							<select name="close_time_i" id="close_time_i_label" class="frm_input">
<?php

							//===========================================
							// 시작 => 반복문__돌리기
							for ($i=0; $i<60; $i++)
							{
?>
								<option value="<?=$i?>"<?php	if ($i == $attend_config["close_time_i"]) echo " selected";	?>><?=$i?></option>
<?php
							}
							// 끝 => 반복문__돌리기
							//===========================================

?>
							</select> 분
						</td>

						<td align="center">
							<label for="attend_point_label" class="sound_only">출석 포인트</label>
							<input type="text" name="attend_point" value="<?php echo $attend_config["attend_point"]; ?>" id="attend_point_label" class="frm_input" size="10"> 점
						</td>

						<td align="center">
							<label for="regular_day_n_label" class="sound_only">개근 날짜</label>
							<input type="text" name="regular_day_n" value="<?php echo $attend_config["regular_day_n"]; ?>" id="regular_day_n_label" class="frm_input" size="10"> 점
						</td>

						<td align="center">
							<label for="regular_point_label" class="sound_only">개근 포인트</label>
							<input type="text" name="regular_point" value="<?php echo $attend_config["regular_point"]; ?>" id="regular_point_label" class="frm_input" size="10"> 점
						</td>

						<td align="center">
							<label for="rank_1_point_label" class="sound_only">1등 포인트</label>
							<input type="text" name="rank_1_point" value="<?php echo $attend_config["rank_1_point"]; ?>" id="rank_1_point_label" class="frm_input" size="10"> 점
						</td>

				</tr>

				</tbody>
				</table>
		</div>


		<br />


		<div class="btn_confirm">
			<input type="submit" class="btn_submit" value=" 수 정 합 니 다 ">
		</div>

		</form>

</section>


<script>

function attend_check_submit(gform)
{

		var start_time_H = parseInt(document.getElementById("start_time_H_label").value);
		var close_time_H = parseInt(document.getElementById("close_time_H_label").value);

		if (start_time_H >= close_time_H)
		{
			alert("출석체크 [ 마감 시간 ] 은 [ 시작 시간] 보다 더 늦어야 합니다.");
			document.getElementById("close_time_H_label").focus();
			return false;
		}

		return true;

}
</script>


<?php

	//=======================================================
	// ADMIN_TAIL__첨부
	include_once ('../admin.tail.php');

?>