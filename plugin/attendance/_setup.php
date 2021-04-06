<?php
// $G5_PATH = "../../";
// include_once("$G5_PATH/common.php");
//include_once("../../common.php");
include_once("./_common.php");

// 변수 선언
$G5_SERVER_TIME = G5_SERVER_TIME;
$G5_TIME_YMD = G5_TIME_YMD;
$G5_TIME_YMDHIS = G5_TIME_YMDHIS;
$G5_URL = G5_URL;
$G5_BBS_URL = G5_BBS_URL;
$G5_ATTENDANCE_URL = G5_ATTENDANCE_URL;

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['attendance_table'] = $g5['table_prefix'] . "attendance";    // 출석부 테이블


/*------------------------------------------
        환경설정 시작
------------------------------------------*/

// 출석시작 시간
$attendance['start_time'] = "00:00:00"; // 시:분:초


// 출석종료 시간
$attendance['end_time'] = "23:59:59"; // 시:분:초


// 개근
$attendance['day'] = "7"; // 지정한 날짜마다

// 개근
$attendance['monthly'] = "30"; // 지정한 매월마다

// 개근
$attendance['year1'] = "365"; // 지정한 년도마다

// 개근
$attendance['year2'] = "500"; // 지정한 년도마다

// 개근
/* $attendance['year3'] = "700"; // 지정한 년도마다 */

// 개근
$attendance['year'] = "1000"; // 지정한 년도마다


// 개근시 포인트
$attendance['day_point'] = "50"; // 지정한 날짜마다 포인트 지급

// 개근시 포인트
$attendance['monthly_point'] = "500"; // 지정한 매월마다 포인트 지급

// 개근시 포인트
$attendance['year1_point'] = "10000"; // 지정한 년도마다 포인트 지급

// 개근시 포인트
$attendance['year2_point'] = "20000"; // 지정한 년도마다 포인트 지급

// 개근시 포인트
/* $attendance['year3_point'] = "70000"; // 지정한 년도마다 포인트 지급 */

// 개근시 포인트
$attendance['year_point'] = "50000"; // 지정한 년도마다 포인트 지급


// 일일 출석 포인트
$attendance['today_point'] = "10"; //하루 출석 포인트 지급


// 1등 포인트
$attendance['first_point'] = "0";
$attendance['second_point'] = "0";
$attendance['third_point'] = "0";


/*------------------------------------------
        환경설정 끝
------------------------------------------*/
?>