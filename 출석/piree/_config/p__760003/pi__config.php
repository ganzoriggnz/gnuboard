<?php

/*
===========================================================

	프로젝트 이름 : Piree WON Program

	만든사람 : 피리

	홈페이지 : http://www.piree.co.kr

	작성날짜 : 2014년 01월 20일 월요일 오후 22시 00분, 날씨 눈오고 추웠다

	저 작 권 : Copyright ⓒ 2014 투스포츠 (원병철) All right reserved
							그누보드 외에 추가된 소스는~
							만든사람의 허락없이 무단으로 사용할수 없습니다.
							사용하고자 할 경우 만든사람의 허락을 받아야 합니다.
							http://www.piree.co.kr 에 문의해 주세요.

===========================================================
 피리 > 피리 출석체크 FREE G5 > 출석체크 CONFIG 화일
===========================================================


*/


	#########################################################
	# 시작 => 접근__유효__확인
	#########################################################

	//=======================================================
	// 개별_페이지__접근_불가
	IF (!defined('_GNUBOARD_'))										EXIT;

	#########################################################
	# 끝 => 접근__유효__확인
	#########################################################



###########################################################
# 시작 => 기본_설정_첨부__하기
###########################################################


	//=======================================================
	// 시작 => 기본_설정_첨부__하기
	IF ($is_get__piree_config == 1)
	{

		//=====================================================
		// 설정_디렉토리_이름
		$piree_prog_plus_dir_s = "p__".PIREE_PROG_FREE_MENU_N;


		//=====================================================
		// 설정_정보_화일__경로
		$piree_index_config_path = PIREE_CONFIG_PATH."/".$piree_prog_plus_dir_s."/pi__config.php";


		//=====================================================
		// 레벨__설정_정보_화일__경로
		include_once ($piree_index_config_path);

	}
	// 끝 => 기본_설정_첨부__하기
	//=======================================================


###########################################################
# 끝 => 기본_설정_첨부__하기
###########################################################










###########################################################
# 시작 => 설정
###########################################################


	//=======================================================
	// 프로그램_번호
	$g_program_n = 760003;


	//=======================================================
	// 프로그램_코드
	$g_program_c = "PIREE Attend Check FREE G5";


	//=======================================================
	// 프로그램_이름
	$g_program_s = "출석체크 FREE G5";


	//=======================================================
	// 버젼
	$g_program_version_s = "0.1";


	//=======================================================
	// 무료_유료__여부
	$is_paid = 0;


	//=======================================================
	// 프로그램_메모
	$prog_memo_s = "( 유료 ) 그누보드 G5용 출석체크 하는 프로그램 입니다.";


###########################################################
# 끝 => 설정
###########################################################










###########################################################
# 시작 => 테이블__이름
###########################################################


	//=======================================================
	// 출석체크__기록__테이블
	$piree_table['attend_list'] = G5_TABLE_PREFIX.'_piree_'.$g_program_n.'_attend_list';


###########################################################
# 끝 => 테이블__이름
###########################################################










###########################################################
# 시작 => 함수
###########################################################


	#########################################################
	# 시작 => 출석_시간_중인지__확인하기
	#########################################################
	function chk__attend_time()
	{

		//=====================================================
		// 외부변수
		global $attend_config;


		//=====================================================
		// 출석_가능__여부
		// 0 - 불가
		// 2 - 가능
		$is_use__attend = 0;


		//=====================================================
		// 지금_시간__분_초
		$now_Hi = date("Hi");


		//=====================================================
		// 시작 => 출석_시간__이전이면
		IF ((int)$now_Hi > (($attend_config["start_time_H"]*100)+$attend_config["start_time_i"]-1))
		{

			//===================================================
			// 출석_가능__여부
			// 1이상 - 가능
			$is_use__attend++;

		}
		// 끝 => 출석_시간__이전이면
		//=====================================================


		//=====================================================
		// 시작 => 출석_마감__이후이면
		IF (((int)$now_Hi-1) < (($attend_config["close_time_H"]*100)+$attend_config["close_time_i"]))
		{

			//===================================================
			// 출석_가능__여부
			// 1이상 - 가능
			$is_use__attend++;

		}
		// 끝 => 출석_마감__이후이면
		//=====================================================


		//=====================================================
		// 넘겨줄_결과
		$chk_time = $is_use__attend == 2 ? 1 : 0;


		//=====================================================
		// 넘겨줄_결과
		return $chk_time;

	}
	#########################################################
	# 끝 => 출석_시간_중인지__확인하기
	#########################################################



	#########################################################
	# 시작 => 신청_변경_기록__남기기
	#########################################################
	function save__level_log($req_mb_id, $level_new_n, $config_use_auto_n, $active_s)
	{

		//=====================================================
		// 외부변수
		global $piree_table;


		//=====================================================
		// 에러
		$in_errors = 0;


		//=====================================================
		// 시작 => 검증
		IF (!$req_mb_id	 || $req_mb_id	 == "")								 $in_errors++;
		IF (!$level_new_n || $level_new_n <	1)									$in_errors++;


		//=====================================================
		// 결과
		$result = false;


		//=====================================================
		// 시작 => 에러__없으면
		IF ($in_errors == 0)
		{

			//===================================================
			// 대상자__회원_정보__가져오기
			$req_member = get_member($req_mb_id);


			//===================================================
			// 운영자_정보__가져오기
			$admin_member = get_member($_SESSION['ss_mb_id']);


			//===================================================
			// 신청__저장하는__쿼리문
			$sql	= "INSERT INTO `".$piree_table['level_log']."` SET ";
			$sql .= "req_mem_mn=".$req_member["mb_no"].", ";
			$sql .= "req_mb_id='".$req_mb_id."', ";
			$sql .= "req_mb_nick='".$req_member["mb_nick"]."', ";
			$sql .= "admin_mem_mn=".$admin_member["mb_no"].", ";
			$sql .= "admin_mb_id='".$_SESSION['ss_mb_id']."', ";
			$sql .= "admin_mb_nick='".$admin_member["mb_nick"]."', ";
			$sql .= "level_now_n=".$req_member["mb_level"].", ";
			$sql .= "level_new_n=".$level_new_n.", ";
			$sql .= "is_auto_n=".$config_use_auto_n.", ";
			$sql .= "active_s='".$active_s."', ";
			$sql .= "requ_time_n=".G5_SERVER_TIME;


			//===================================================
			// 시작 => 즉시변경_이면__변경_일시_지금으로_처리
			IF ($config_use_auto_n == 1)
			{

				//=================================================
				// 신청__저장하는__쿼리문
				$sql .= ", chng_time_n=".G5_SERVER_TIME;

			}
			// 끝 => 즉시변경_이면__변경_일시_지금으로_처리
			//===================================================


			//===================================================
			// 시작 => 수정하기
			IF (sql_query($sql))
			{
				// 결과
				$result = true;
			}
			// 끝 => 수정하기
			//===================================================

		}
		// 끝 => 에러__없으면
		//=====================================================


		//=====================================================
		// 결과_넘겨주기
		return $result;

	}
	#########################################################
	# 끝 => 신청_변경_기록__남기기
	#########################################################


###########################################################
# 끝 => 함수
###########################################################










###########################################################
# 시작 => 출석체크__설정_정보__가져오기
###########################################################


	#########################################################
	# 시작 => 피리_프로그램_정보__가져오는__함수
	#########################################################
	function get__prog_info__760003($prog_n)
	{

		//=====================================================
		// 외부변수
		global $piree_table, $is_piree_program_config;


		//=====================================================
		// 넘겨줄__배열_변수
		$prog_info = array();


		//=====================================================
		// 시작 => 피리_프로그램_번호__있으면
		IF ($prog_n > 0)
		{

			//===================================================
			// 피리_프로그램_정보__가져오기
			$sql = "SELECT * FROM `".$piree_table['program']."` WHERE prog_n=".$prog_n;
			$row = sql_fetch($sql, false);


			//===================================================
			// 시작 => 칼럼__없으면
			IF (!isset($row['prog_n']))
			{

				//=================================================
				// 외부_상수_변수
				global $is_admin;


				//=================================================
				// 시작 => 운영자_일반회원__여부
				IF ($is_admin)
				{

					#################################################
					# 시작 => 운영자__이면

					//===============================================
					// 시작 => 설정_화면__아니면
					IF ($is_piree_program_config != 1)
					{

							// 이동할_페이지
							$move_url = G5_ADMIN_URL.'/p'.PIREE_PROG_FREE_MENU_N.'/';

							// 에러_알림
							alert ("선택하신 프로그램이 설치되지 않았거나 DB정보가 없습니다. 760003", $move_url);

					}
					// 끝 => 설정_화면__아니면
					//===============================================

				}
				ELSE
				{

					#################################################
					# 시작 => 일반회원__이면

					// 에러_알림
					alert ("선택하신 프로그램이 설치되지 않았거나 DB정보가 없습니다. 760003", G5_URL);

				}
				// 끝 => 운영자_일반회원__여부
				//=================================================

			}
			// 끝 => 칼럼__없으면
			//===================================================


			//===================================================
			// 시작 => 피리_프로그램_번호__맞으면
			IF ($prog_n == $row["prog_n"])
			{

				//=================================================
				// 피리_프로그램_정보__배열
				$prog_info = $row;

			}
			// 끝 => 피리_프로그램_번호__맞으면
			//===================================================

		}
		// 끝 => 피리_프로그램_번호__있으면
		//=====================================================


		//=====================================================
		// 피리_프로그램_정보
		return $prog_info;

	}
	#########################################################
	# 끝 => 피리_프로그램_정보__가져오는__함수
	#########################################################



	#########################################################
	# 시작 => 출석체크__설정_정보__가져오는__함수
	#########################################################
	function get__attend_config()
	{

		//=====================================================
		// 외부변수
		global $g_program_n, $piree_table;


		//=====================================================
		// 프로그램_번호
		$attend_config["g_program_n"] = $g_program_n;


		//=====================================================
		// 시작 => 피리_프로그램__테이블__유무
		IF (isset($piree_table['program']) && $is_get__piree_config == 1)
		{

			//===================================================
			// 피리_프로그램_정보__가져오기
			$row = get__prog_info($g_program_n);

		}
		ELSE
		{

			//===================================================
			// 피리_프로그램_정보__가져오기
			$row = get__prog_info__760003($g_program_n);

		}
		// 끝 => 피리_프로그램__테이블__유무
		//=====================================================


		//=====================================================
		// 프로그램__디렉토리
		$attend_config["prog_dir"] = "p".$g_program_n."__attend_check";


		//=====================================================
		// 프로그램__경로
		$attend_config["prog_u"] = PIREE_URL . "/".$attend_config["prog_dir"]."/";
		$attend_config["prog_p"] = PIREE_PATH . "/".$attend_config["prog_dir"]."/";


		//=====================================================
		// 시작 => 프로그램_번호__맞으면
		IF ($g_program_n == $row["prog_n"])
		{

			//===================================================
			// 시작 => 스킨_PC__이면
			IF ($row["skin_pc_c"] != "")
			{

				//=================================================
				// 스킨_PC
				$attend_config["skin_pc_c"] = $row["skin_pc_c"];
				$attend_config["skin_pc_u"] = PIREE_SKIN_PC_URL . "/".$attend_config["prog_dir"]."/".$row["skin_pc_c"];
				$attend_config["skin_pc_p"] = PIREE_SKIN_PC_PATH . "/".$attend_config["prog_dir"]."/".$row["skin_pc_c"];

			}
			// 끝 => 스킨_PC__이면
			//===================================================


			//===================================================
			// 시작 => 스킨_모바일__이면
			IF ($row["skin_mobile_c"] != "")
			{

				// 스킨_모바일
				$attend_config["skin_mobile_c"] = $row["skin_mobile_c"];
				$attend_config["skin_mobile_u"] = PIREE_SKIN_MOBILE_URL . "/".$attend_config["prog_dir"]."/".$row["skin_mobile_c"];
				$attend_config["skin_mobile_p"] = PIREE_SKIN_MOBILE_PATH . "/".$attend_config["prog_dir"]."/".$row["skin_mobile_c"];

			}
			// 끝 => 스킨_모바일__이면
			//===================================================


			//===================================================
			// 시작 => 출석체크__시작_시간_시각__이면
			IF ($row["pp_cf_1_c"] == "start_time_H")
			{

				// 출석체크__시작_시간_시각
				$attend_config["start_time_H"] = $row["pp_cf_1_n"];

			}
			// 끝 => 출석체크__시작_시간_시각__이면
			//===================================================


			//===================================================
			// 시작 => 출석체크__시작_시간_분__이면
			IF ($row["pp_cf_2_c"] == "start_time_i")
			{

				// 출석체크__시작_시간_분
				$attend_config["start_time_i"] = $row["pp_cf_2_n"];

			}
			// 끝 => 출석체크__시작_시간_분__이면
			//===================================================


			//===================================================
			// 시작 => 출석체크__마감_시간_시각__이면
			IF ($row["pp_cf_3_c"] == "close_time_H")
			{

				// 출석체크__마감_시간_시각
				$attend_config["close_time_H"] = $row["pp_cf_3_n"];

			}
			// 끝 => 출석체크__마감_시간_시각__이면
			//===================================================


			//===================================================
			// 시작 => 출석체크__마감_시간_분__이면
			IF ($row["pp_cf_4_c"] == "close_time_i")
			{

				// 출석체크__마감_시간_분
				$attend_config["close_time_i"] = $row["pp_cf_4_n"];

			}
			// 끝 => 출석체크__마감_시간_분__이면
			//===================================================


			//===================================================
			// 시작 => 출석체크__포인트__이면
			IF ($row["pp_cf_5_c"] == "attend_point")
			{

				// 출석체크__포인트
				$attend_config["attend_point"] = $row["pp_cf_5_n"];

			}
			// 끝 => 출석체크__포인트__이면
			//===================================================


			//===================================================
			// 시작 => 개근_날짜__이면
			IF ($row["pp_cf_6_c"] == "regular_day_n")
			{

				// 개근_날짜
				$attend_config["regular_day_n"] = $row["pp_cf_6_n"];

			}
			// 끝 => 개근_날짜__이면
			//===================================================


			//===================================================
			// 시작 => 개근_포인트__이면
			IF ($row["pp_cf_7_c"] == "regular_point")
			{

				// 개근_포인트
				$attend_config["regular_point"] = $row["pp_cf_7_n"];

			}
			// 끝 => 개근_포인트__이면
			//===================================================


			//===================================================
			// 시작 => 1등_포인트__이면
			IF ($row["pp_cf_11_c"] == "rank_1_point")
			{

				// 1등_포인트
				$attend_config["rank_1_point"] = $row["pp_cf_11_n"];

			}
			// 끝 => 1등_포인트__이면
			//===================================================

		}
		// 끝 => 프로그램_번호__맞으면
		//=====================================================


		//=====================================================
		// 출석체크___설정
		// 넘겨줄_변수
		return $attend_config;

	}
	#########################################################
	# 끝 => 출석체크__설정_정보__가져오는__함수
	#########################################################



	#########################################################
	# 시작 => 출석체크__설정_정보__가져오기
	#########################################################

	//=======================================================
	// 출석체크___사용여부
	// 0 - 안함
	// 1 - 사용함
	$is_use_attend = 0;


	//=======================================================
	// 시작 => 출석체크__설정_정보__가져오기__이면
	IF ($is_get__attend_config == 1)
	{

		//=====================================================
		// 출석체크__정보__가져오기
		$attend_config = get__attend_config();


		//=====================================================
		// 시작 => 프로그램_번호__있으면
		IF ($g_program_n == $attend_config["g_program_n"])
		{

			//===================================================
			// 출석체크___사용여부
			// 1 - 사용함
			$is_use_attend = 1;

		}
		// 끝 => 프로그램_번호__있으면
		//=====================================================

	}
	// 끝 => 출석체크__설정_정보__가져오기__이면
	//=======================================================

	#########################################################
	# 끝 => 출석체크__설정_정보__가져오기
	#########################################################


###########################################################
# 끝 => 출석체크__설정_정보__가져오기
###########################################################


?>