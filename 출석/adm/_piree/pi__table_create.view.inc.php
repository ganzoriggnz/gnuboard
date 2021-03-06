<?php

/*
===========================================================

	프로젝트 이름 : Piree WON Program PLUS G5 (유료)	

	만든사람 : 피리

	홈페이지 : http://www.piree.co.kr

	작성날짜 : 2014년 01월 10일 금요일 오전 05시 00분, 날씨 너무 추워

	저 작 권 : Copyright ⓒ 2014 투스포츠 (원병철) All right reserved
							그누보드 외에 추가된 소스는~
							만든사람의 허락없이 무단으로 사용할수 없습니다.
							사용하고자 할 경우 만든사람의 허락을 받아야 합니다.
							http://www.piree.co.kr 에 문의해 주세요.

===========================================================
 관리자 > 피리 > 테이블 생성
===========================================================


*/


	#########################################################
	# 시작 => 선처리
	#########################################################

	//=======================================================
	// 개별_페이지__접근_불가
	IF (!defined('_GNUBOARD_'))					EXIT;

	#########################################################
	# 끝 => 선처리
	#########################################################


?>

<section>
		<h2>피리 서비스 테이블 생성하기</h2>


		<div class="tbl_head01 tbl_wrap">
				<table>
				<caption>설치된 웹 프로그램</caption>
				<thead>
				<tr>
					<th scope="col">프로그램 번호</th>
					<th scope="col">테이블 생성하기</th>
					<th scope="col">프로그램 이름</th>
				</tr>
				</thead>
				<tbody>

				<tr>
					<td></td>
					<td><a href="./pi__make_calendar.php" class="btn_list02">달력 (정보) 입력하기</a></td>
					<td><strong>달력 (정보) 입력하기</strong></td>
				</tr>

<?php

		//=====================================================
		// 시작 => 설치된_프로그램__유무
		IF ($piree_menu_arr > 0)
		{

			#####################################################
			# 시작 => 설치된_프로그램__있으면
			#####################################################

			//===================================================
			// 시작 => 반복문__돌리기
			WHILE (list($key, $val) = each($piree_menu_arr))
			{

				//=================================================
				// 사용여부
				$menu_n = $key;


				//=================================================
				// 이름
				$menu_s = $val['name'];


				//=================================================
				// URL
				$url_s = $val['url'];

?>
				<tr>
					<td align="center"><strong><?php echo $menu_n ?></strong></td>
					<td><a href="<?php echo $url_s ?>install_form.php" class="btn_list02">테이블 생성하기</a></td>
					<td><strong><?php echo $menu_s ?></strong></td>
				</tr>

<?php
			}
			// 끝 => 반복문__돌리기
			//===================================================

			#####################################################
			# 끝 => 설치된_프로그램__있으면
			#####################################################

		}
		ELSE
		{

			#####################################################
			# 시작 => 설치된_프로그램__없으면
			#####################################################

?>
				<tr>
					<td colspan="3">
						<strong>현재 테이블 정보가 없습니다.</strong>
					</td>
				</tr>

<?php

			#####################################################
			# 끝 => 설치된_프로그램__없으면
			#####################################################

		}
		// 끝 => 설치된_프로그램__유무
		//=====================================================

?>

				</tbody>
				</table>


		<div style="padding:5px 0 5px 0; line-height:1.9em;">
			⊙ 테이블을 생성하시려면 [ 테이블 생성하기 ] 버튼을 눌러 주세요.
		</div>

		</div>

</section>