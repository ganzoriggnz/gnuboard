<?php

/*
===========================================================

	프로젝트 이름 : Piree WON Program

	만든사람 : 피리

	홈페이지 : http://www.piree.co.kr

	작성날짜 : 2014년 01월 23일 목요일 오전 10시 38분, 날씨 추워~ B급으로 추워~

	저 작 권 : Copyright ⓒ 2014 투스포츠 (원병철) All right reserved
							그누보드 외에 추가된 소스는~
							만든사람의 허락없이 무단으로 사용할수 없습니다.
							사용하고자 할 경우 만든사람의 허락을 받아야 합니다.
							http://www.piree.co.kr 에 문의해 주세요.

===========================================================
 피리 > 피리 출석체크 PLUS G5 > 스킨
===========================================================


*/


	#########################################################
	# 시작 => 선처리
	#########################################################

	//=======================================================
	// 개별_페이지__접근_불가
	IF (!defined("_GNUBOARD_"))										EXIT; 

	#########################################################
	# 끝 => 선처리
	#########################################################


?>


<link rel="stylesheet" href="<?php echo $attend_config["skin_pc_u"] ?>/style.css">


<!-- 시작 => 내가__몸통이다 -->

<section>

		<div class="attend_board_out">

			<div class="attend_board_left">
				<strong><?php echo $cal_date_Y ?></strong>년 
				<strong><?php echo $cal_date_m ?></strong>월 
				<strong><?php echo $cal_date_d ?></strong>일 &nbsp; 
				<strong><?php echo $cal_yoil_s ?></strong>
			</div>

			<div class="attend_board_center"></div>

			<div class="attend_board_right">
				<span class="font_999">출석시간</span> 
				<strong><?php echo $attend_start_time ?></strong> 부터 
				<strong><?php echo $attend_close_time ?> 까지</strong>
			
			</div>

			<div class="attend_board_hr"></div>


			<div class="attend_board_left">
				음력 
				<strong><?php echo $cal_lunar_date_Y ?></strong>년 
				<strong><?php echo $cal_lunar_date_m ?></strong>월 
				<strong><?php echo $cal_lunar_date_d ?></strong>일 &nbsp; 
				<strong><?php echo $cal_cha_gapja_s ?></strong> &nbsp; 
				<strong><?php echo $cal_is_24_jeolki ?></strong>
			</div>

			<div class="attend_board_center"></div>

			<div class="attend_board_right">
				<span class="font_999">출석 포인트</span> 
				<strong><?php echo $attend_config["attend_point"] ?></strong> 점
			</div>

			<div class="attend_board_hr"></div>


			<div class="attend_board_left">
				오늘 
				<strong><?php echo $cal_attend_t ?></strong> 명이 출석체크 하였습니다
			</div>

			<div class="attend_board_center"></div>

			<div class="attend_board_right">
				<span class="font_999">1등 포인트</span> 
				<strong><?php echo $attend_config["rank_1_point"] ?></strong> 점
			</div>

			<div class="attend_board_hr"></div>


			<div class="attend_board_left">
			</div>

			<div class="attend_board_center"></div>

			<div class="attend_board_right">
				<span class="font_999">개근 포인트</span> 
				<strong><?php echo $attend_config["attend_point"] ?></strong> 일 연속 출석체크시 
				<strong><?php echo $attend_config["regular_point"] ?></strong> 점
			</div>

			<div class="attend_board_hr"></div>

		</div>

</section>




		<div class="clear:both; space_10px;"></div>

		<div class="clear:both; space_10px;"></div>




<section>

		<h2>출석체크 하기</h2>

		<div class="tbl_head01 tbl_wrap">
				<table>
				<caption style="height:20px;">출석체크 하기</caption>
				<thead>
				<tr>
						<th scope="col">등수</th>
						<th scope="col">회원</th>
						<th scope="col">출석시간</th>
						<th scope="col">한마디</th>
						<th scope="col">연속</th>
				</tr>
				</thead>
				<tbody>

<?php

	//=======================================================
	// 시작 => 출석체크_목록__유무
	IF ($attend_view_n > 0)
	{

		#######################################################
		# 시작 => 출석체크_목록__있으면
		#######################################################

		//=====================================================
		// 시작 => 반복문__돌리기
		FOR ($i=0; $i<count($attend_list_arr); $i++)
		{

			//===================================================
			// 배열_변수
			$attend_lists = $attend_list_arr[$i];


			//===================================================
			// 시작 => 출석체크_순서__있으면
			IF ($attend_lists["seq_n"] > 0)
			{

				###################################################
				# 시작 => 출석체크_순서__있으면
				###################################################

				//=================================================
				// 작성자_사이드뷰
				$attend_member = get_sideview($attend_lists['mb_id'], $attend_lists["mb_nick"], '', '');

?>
				<tr>
						<td style="td_center_50"><nobr><?php echo $attend_lists["seq_n"] ?></nobr></td>
						<td class="td_left_100"><strong><?php echo $attend_member ?></strong></td>
						<td class="td_center_80"><?php echo $attend_lists["regi_time_s"] ?></td>
						<td><div class="td_left_430"><?php echo $attend_lists["cont_s"] ?></div></td>
						<td class="td_center_50"><?php echo $attend_lists["conti_n"] ?> 일</td>
				</tr>

<?

			}
			// 끝 => 출석체크_순서__있으면
			//===================================================

		}
		// 끝 => 반복문__돌리기
		//=====================================================


		//=====================================================
		// 시작 => 페이지__있으면
		IF ($page_n > 1)
		{
?>
				<tr>
					<td colspan="5">
						<p style="text-align:center"><?php echo get_paging($config['cf_write_pages'], $page_n, $total_page_n, "?page_n="); ?></p>
					</td>
				</tr>

<?php
		}
		// 끝 => 페이지__있으면
		//=====================================================

		#######################################################
		# 끝 => 출석체크_목록__있으면
		#######################################################

	}
	ELSE
	{

		#######################################################
		# 시작 => 출석체크_목록__없으면
		#######################################################

?>
				<tr>
					<td colspan="5">
						<p style="text-align:center"><strong>아직 출석체크하신 분이 없습니다.</strong></p>
					</td>
				</tr>

<?php

		#######################################################
		# 끝 => 출석체크_목록__없으면
		#######################################################

	}
	// 끝 => 출석체크_목록__유무
	//=======================================================

?>

				</tbody>
				</table>
		</div>


		<div class="clear:both; space_10px;"></div>

		<div class="clear:both; space_10px;"></div>


<?

	//=======================================================
	// 시작 => 출석_가능__여부
	IF ($is_use__attend == 1)
	{

		#######################################################
		# 시작 => 출석__시간

?>
		<form name="attend_check_form" id="attend_check_form" action="<?php echo $attend_config["prog_u"]; ?>attend.regist.php" method="post" onsubmit="return input__attend_check(this);">

		<div class="attend_check_do_out">

			<div class="attend_check_do_hr"></div>

			<div class="attend_check_do_body">
				한마디 
				<input type="text" name="cont_s" id="cont_s" value="" class="frm_input required" size="70"></span>
				<input type="submit" class="btn_submit" value=" 출석하기 ">
			</div>

			<div class="attend_check_do_hr"></div>

			<div class="attend_check_do_body">
				⊙ 한마디 남기시고 "출석하기" 버튼을 눌러 주세요!!
			</div>

		</div>

		</form>


	<script>
	function input__attend_check(gform)
	{

		//=====================================================
		// 시작 => 한마디_입력__안되었으면
		if (!document.getElementById("cont_s").value || document.getElementById("cont_s").value == "")
		{

			// 에러
			alert ("한마디 입력해 주세요.");
			document.getElementById("cont_s").focus();
			return false;

		}
		// 시작 => 한마디_입력__안되었으면
		//=====================================================


		//=====================================================
		// 통과~
		return true;

	}
	</script>
<?php

	}
	ELSE
	{

		#######################################################
		# 시작 => 출석__시간__아님

?>
		<div style="width:708px; padding:16px 0 16px 20px; background:#ecf5e5;">

			<div>
				<strong>지금은 출석 시간이 아닙니다.</strong>
			</div>

		</div>

<?php

	}
	// 끝 => 출석_가능__여부
	//=======================================================

?>


</section>

<!-- 끝 => 내가__몸통이다 -->