<?php
include_once("./_setup.php");


// 비회원
if (!$is_member) {

    /* alert("로그인 후 이용하세요."); */
    alert("로그인 후 이용하세요.", G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

}


// 출석 시간 체크
if (date("H:i:s") < $attendance['start_time'] || date("H:i:s") > $attendance['end_time']) {

    alert("출석 시간이 아닙니다.");

}

// 총출석일수
$sql = " select sumday from {$g5['attendance_table']} where mb_id = '{$member['mb_id']}' order by datetime desc ";
$row = sql_fetch($sql);
// 총출석일
$sumday = $row['sumday'] + 1;

// 오늘 출석했나?
$sql = " select * from $g5[attendance_table] where mb_id = '$member[mb_id]' and substring(datetime,1,10) = '".G5_TIME_YMD."' ";
$check = sql_fetch($sql);

// 출석했다면.
if ($check['mb_id']) {

    alert("이미 출석 하였습니다.");

}


// 1일 뺀다.
$day = date("Y-m-d", $G5_SERVER_TIME - (1 * 86400));

// 어제 출석했나?
$sql = " select * from $g5[attendance_table] where mb_id = '$member[mb_id]' and substring(datetime,1,10) = '$day' ";
$row = sql_fetch($sql);

	
$sql_point = $attendance['today_point'];	
$sql_day_point = $attendance['day_point'];	
$sql_monthly_point = $attendance['monthly_point'];	
$sql_year1_point = $attendance['year1_point'];	
$sql_year2_point = $attendance['year2_point'];	
/* $sql_year3_point = $attendance['year3_point']; */	
$sql_year_point = $attendance['year_point'];	
$sql_day_cnt = $attendance['day'];	
$sql_monthly_cnt = $attendance['monthly'];	
$sql_year1_cnt = $attendance['year1'];	
$sql_year2_cnt = $attendance['year2'];	
/* $sql_year3_cnt = $attendance['year3']; */	
$sql_year_cnt = $attendance['year'];

// 일일 포인트
$sql_point = $sql_point;

// 어제 출석했다면
if ($row['mb_id']) {
    // 전체 개근에 오늘 합산
    $sql_day = $row['day'] + 1;

    // 지난 개근체크에 오늘 합산
    $sql_reset = $row['reset'] + 1;
    $sql_reset2 = $row['reset2'] + 1;
    $sql_reset3 = $row['reset3'] + 1;
    $sql_reset4 = $row['reset4'] + 1;	
    /* $sql_reset5 = $row['reset5'] + 1; */	
    $sql_reset6 = $row['reset6'] + 1;
    
    if ($row['reset'] == $sql_day_cnt) { // 7일 개근	
        $sql_reset  = "0"; 	
        $sql_point  = $sql_point + $sql_day_point;	
    }	
		
	if ($row['reset2'] == $sql_monthly_cnt) { // 30일 개근	
        $sql_reset2 = "0"; 	
        $sql_point  = $sql_point + $sql_monthly_point;	
    }	
    if ($row['reset3'] == $sql_year1_cnt) {  // 365일 개근	
        $sql_reset3 = "0"; 	
        $sql_point  = $sql_point + $sql_year1_point;	
    }	
    if ($row['reset4'] == $sql_year2_cnt) {  // 500일 개근	
        $sql_reset4 = "0"; 	
        $sql_point  = $sql_point + $sql_year2_point;	
    }	
    /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근	
        $sql_reset5 = "0"; 	
        $sql_point  = $sql_point + $sql_year3_point;	
    } */	
    if ($row['reset6'] == $sql_year_cnt) {  // 1000일 개근	
        $sql_reset6 = "0"; 	
        $sql_day = "1";	
        $sql_point  = $sql_point + $sql_year_point;	
    }

    // if ($sql_reset3 == $sql_year1_cnt) {  // 500일 개근
    //     $sql_reset3 = "0"; 
    //     $sql_point  = $sql_point + $sql_year_point;
    // }

    // if ($sql_reset3 == $sql_year2_cnt) {  // 700일 개근
    //     $sql_reset3 = "0"; 
    //     $sql_point  = $sql_point + $sql_year_point;
    // }

    // if ($sql_reset3 == $sql_year3_cnt) {  // 1000일 개근
    //     $sql_reset3 = "0"; 
    //     $sql_point  = $sql_point + $sql_year_point;
    // }
} else { // 출석하지 않았다면
    // 전체 개근 설정
    $sql_day = "1";

    // 리셋
    $sql_reset  = "1";
    $sql_reset2 = "1";
    $sql_reset3 = "1";
    $sql_reset4 = "1";	
    $sql_reset5 = "0";	
    $sql_reset6 = "1";
}


// 첫출근
$sql = " select count(*) as cnt, rank from $g5[attendance_table] where substring(datetime,1,10) = '".G5_TIME_YMD."' ";
$first = sql_fetch($sql);

// 아무도 없다면..
$rank = "";
if (!$first['cnt']) { // 1등 포인트 
    $sql_point = $attendance['first_point'] + $sql_point;
    $rank = 1;
} elseif ($first['cnt'] == 1) { // 2등 포인트 
    $sql_point = $attendance['second_point'] + $sql_point;
    $rank = 2;
} elseif ($first['cnt'] == 2) { // 3등 포인트 
    $sql_point = $attendance['third_point'] + $sql_point;
    $rank = 3;
} else {
    $rank = $first['cnt'];
}


// 기록
$sql = " insert into $g5[attendance_table]
            set mb_id = '$member[mb_id]',
                subject = '".$_POST['subject']."',
                day = '$sql_day',
                sumday = '$sumday',
                reset = '$sql_reset',
                reset2 = '$sql_reset2',
                reset3 = '$sql_reset3',
                reset4 = '$sql_reset4',	
                reset5 = '$sql_reset5',	
                reset6 = '$sql_reset6',
                point = '$sql_point',
				rank = '$rank',			
                datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);


// 출석 포인트 지급
insert_point($member['mb_id'], (int)($sql_point * 1), "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);


// 완료
alert("출석 체크 완료", "./m_attendance.php");
?>