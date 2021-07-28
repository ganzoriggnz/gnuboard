<?php

include_once("./_setup.php");

// 비회원
if (!$is_member) {

    /* alert("로그인 후 이용하세요."); */
    alert("로그인 후 이용하세요.", G5_BBS_URL . "/login.php?url=" . urlencode("{$_SERVER['REQUEST_URI']}"));
}

// Нөхөж олгох хэсэг(Эхлэл)
if($member['mb_level'] == 30){
    $d =  $_POST['subject']; //"2021-07-17";
    
    $sqlmember = "select distinct(m.mb_id) mb_id from g5_member m inner join g5_attendance a on m.mb_id = a.mb_id;";
    // 23
    //  where substring(`datetime`,1,10) = '{$d}'
    $m = sql_query($sqlmember);
    while ($row = sql_fetch_array($m)) {
        attendanceUpdate23toNow($row['mb_id'], $d, $attendance);
    }

    var_dump("aa");die;
}

function attendanceUpdate17to21($mb_id, $getday , $attendance){
    // тухайн өдрийн аттендайнс ороогүй байвал оруулна. 
    $daydif = "select * from g5_attendance where substring(`datetime`,1,10) = '{$getday}' and mb_id='{$mb_id}'";
    $ll = sql_query($daydif);
    if (!sql_fetch_array($ll)) {
        // var_dump($mb_id);die;
         // 1일 뺀다.
        $day = date("Y-m-d", strtotime($getday) - (1 * 86400));
        // 어제 출석했나?
        $sql = " select * from g5_attendance where mb_id = '{$mb_id}' and substring(`datetime`,1,10) = '$day' order by sumday desc limit 1;";
        // var_dump($sql);die;
        // if (!sql_fetch($sql)) {
        $row = sql_fetch($sql);
        // var_dump($row);die;

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
        // var_dump($row);die;

        // 일일 포인트
        $sql_point = $sql_point;
        // 어제 출석했다면
        if ($row['mb_id']) {

            // 전체 개근에 오늘 합산
            $sql_day = $row['day'] + 1;
            $sumday = $row['sumday'] + 1;

            // 지난 개근체크에 오늘 합산
            $sql_reset = $row['reset'] + 1;
            $sql_reset2 = $row['reset2'] + 1;
            $sql_reset3 = $row['reset3'] + 1;
            $sql_reset4 = $row['reset4'] + 1;
            /* $sql_reset5 = $row['reset5'] + 1; */
            $sql_reset6 = $row['reset6'] + 1;


            if ($sql_reset == $sql_day_cnt) { // 7일 개근
                /* $sql_reset  = "0"; */
                $sql_point  = $sql_point + $sql_day_point;
            }

            if ($sql_reset2 == $sql_monthly_cnt) { // 30일 개근
                /* $sql_reset2 = "0"; */
                $sql_point  = $sql_point + $sql_monthly_point;
            }

            if ($sql_reset3 == $sql_year1_cnt) {  // 365일 개근
                /*  $sql_reset3 = "0"; */
                $sql_point  = $sql_point + $sql_year1_point;
            }

            if ($sql_reset4 == $sql_year2_cnt) {  // 500일 개근
                /* $sql_reset4 = "0"; */
                $sql_point  = $sql_point + $sql_year2_point;
            }

            /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근
                $sql_reset5 = "0"; 
                $sql_point  = $sql_point + $sql_year3_point;
            } */

            if ($sql_reset6 == $sql_year_cnt) {  // 1000일 개근
                $sql_reset  = "0";
                $sql_reset2 = "0";
                $sql_reset3 = "0";
                $sql_reset4 = "0";
                $sql_reset6 = "0";
                $sql_point  = $sql_point + $sql_year_point;
            }
            if ($sql_day > $sql_year_cnt) {  // 1000일 개근
                $sql_day = "1";
            }
        } else { // 출석하지 않았다면
            // 전체 개근 설정
            $sql_day = "1";
            $sumday = "1";

            // 리셋
            $sql_reset  = "1";
            $sql_reset2 = "1";
            $sql_reset3 = "1";
            $sql_reset4 = "1";
            $sql_reset5 = "0";
            $sql_reset6 = "1";
        }


        // 첫출근
        $sql = " select count(*) as cnt, `rank` from g5_attendance where substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
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

        $fullday = $getday." 00:00:00";
        // 기록
        $sql = " insert into g5_attendance
                    set mb_id = '$mb_id',
                        subject = '성공만큼 큰 실패는 없다. - 제럴드 내크먼',
                        day = '$sql_day',
                        sumday = '$sumday',
                        reset = '$sql_reset',
                        reset2 = '$sql_reset2',
                        reset3 = '$sql_reset3',
                        reset4 = '$sql_reset4',
                        reset5 = '$sql_reset5',
                        reset6 = '$sql_reset6',
                        point = '$sql_point',
                        `rank` = '$rank',			
                        `datetime` = '" . $fullday . "' ";
        $va = sql_query($sql);
   
    }
}
function attendanceUpdate22($mb_id, $getday , $attendance){
    // тухайн өдрийн аттендайнс ороогүй байвал оруулна. 
    $daydif = "select * from g5_attendance where substring(`datetime`,1,10) = '{$getday}' and mb_id='{$mb_id}'";
    $ll = sql_query($daydif);
    if (!sql_fetch_array($ll)) {
        // var_dump($mb_id);die;
         // 1일 뺀다.
        $day = date("Y-m-d", strtotime($getday) - (1 * 86400));
        // 어제 출석했나?
        $sql = " select * from g5_attendance where mb_id = '{$mb_id}' and substring(`datetime`,1,10) = '$day' order by sumday desc limit 1;";
        // var_dump($sql);die;
        // if (!sql_fetch($sql)) {
        $row = sql_fetch($sql);
        // var_dump($row);die;

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
        // var_dump($row);die;

        // 일일 포인트
        $sql_point = $sql_point;
        // 어제 출석했다면
        if ($row['mb_id']) {

            // 전체 개근에 오늘 합산
            $sql_day = $row['day'] + 1;
            $sumday = $row['sumday'] + 1;

            // 지난 개근체크에 오늘 합산
            $sql_reset = $row['reset'] + 1;
            $sql_reset2 = $row['reset2'] + 1;
            $sql_reset3 = $row['reset3'] + 1;
            $sql_reset4 = $row['reset4'] + 1;
            /* $sql_reset5 = $row['reset5'] + 1; */
            $sql_reset6 = $row['reset6'] + 1;


            if ($sql_reset == $sql_day_cnt) { // 7일 개근
                /* $sql_reset  = "0"; */
                $sql_point  = $sql_point + $sql_day_point;
            }

            if ($sql_reset2 == $sql_monthly_cnt) { // 30일 개근
                /* $sql_reset2 = "0"; */
                $sql_point  = $sql_point + $sql_monthly_point;
            }

            if ($sql_reset3 == $sql_year1_cnt) {  // 365일 개근
                /*  $sql_reset3 = "0"; */
                $sql_point  = $sql_point + $sql_year1_point;
            }

            if ($sql_reset4 == $sql_year2_cnt) {  // 500일 개근
                /* $sql_reset4 = "0"; */
                $sql_point  = $sql_point + $sql_year2_point;
            }

            /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근
                $sql_reset5 = "0"; 
                $sql_point  = $sql_point + $sql_year3_point;
            } */

            if ($sql_reset6 == $sql_year_cnt) {  // 1000일 개근
                $sql_reset  = "0";
                $sql_reset2 = "0";
                $sql_reset3 = "0";
                $sql_reset4 = "0";
                $sql_reset6 = "0";
                $sql_point  = $sql_point + $sql_year_point;
            }
            if ($sql_day > $sql_year_cnt) {  // 1000일 개근
                $sql_day = "1";
            }
        } else { // 출석하지 않았다면
            // 전체 개근 설정
            $sql_day = "1";
            $sumday = "1";

            // 리셋
            $sql_reset  = "1";
            $sql_reset2 = "1";
            $sql_reset3 = "1";
            $sql_reset4 = "1";
            $sql_reset5 = "0";
            $sql_reset6 = "1";
        }


        // 첫출근
        $sql = " select count(*) as cnt, `rank` from g5_attendance where substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
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

        $fullday = $getday." 00:00:00";
        // 기록
        $sql = " insert into g5_attendance
                    set mb_id = '$mb_id',
                        subject = '성공만큼 큰 실패는 없다. - 제럴드 내크먼',
                        day = '$sql_day',
                        sumday = '$sumday',
                        reset = '$sql_reset',
                        reset2 = '$sql_reset2',
                        reset3 = '$sql_reset3',
                        reset4 = '$sql_reset4',
                        reset5 = '$sql_reset5',
                        reset6 = '$sql_reset6',
                        point = '$sql_point',
                        `rank` = '$rank',			
                        `datetime` = '" . $fullday . "' ";
        $va = sql_query($sql);
    }else{
                // var_dump($mb_id);die;
         // 1일 뺀다.
         $day = date("Y-m-d", strtotime($getday) - (1 * 86400));
         // 어제 출석했나?
         $sql = " select * from g5_attendance where mb_id = '{$mb_id}' and substring(`datetime`,1,10) = '$day' order by sumday desc limit 1;";
         // var_dump($sql);die;
         // if (!sql_fetch($sql)) {
         $row = sql_fetch($sql);
         // var_dump($row);die;
 
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
         // var_dump($row);die;
 
         // 일일 포인트
         $sql_point = $sql_point;
         // 어제 출석했다면
        if ($row['mb_id']) {
 
             // 전체 개근에 오늘 합산
             $sql_day = $row['day'] + 1;
             $sumday = $row['sumday'] + 1;
 
             // 지난 개근체크에 오늘 합산
             $sql_reset = $row['reset'] + 1;
             $sql_reset2 = $row['reset2'] + 1;
             $sql_reset3 = $row['reset3'] + 1;
             $sql_reset4 = $row['reset4'] + 1;
             /* $sql_reset5 = $row['reset5'] + 1; */
             $sql_reset6 = $row['reset6'] + 1;
 
 
             if ($sql_reset == $sql_day_cnt) { // 7일 개근
                 /* $sql_reset  = "0"; */
                 $sql_point  = $sql_point + $sql_day_point;
             }
 
             if ($sql_reset2 == $sql_monthly_cnt) { // 30일 개근
                 /* $sql_reset2 = "0"; */
                 $sql_point  = $sql_point + $sql_monthly_point;
             }
 
             if ($sql_reset3 == $sql_year1_cnt) {  // 365일 개근
                 /*  $sql_reset3 = "0"; */
                 $sql_point  = $sql_point + $sql_year1_point;
             }
 
             if ($sql_reset4 == $sql_year2_cnt) {  // 500일 개근
                 /* $sql_reset4 = "0"; */
                 $sql_point  = $sql_point + $sql_year2_point;
             }
 
             /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근
                 $sql_reset5 = "0"; 
                 $sql_point  = $sql_point + $sql_year3_point;
             } */
 
             if ($sql_reset6 == $sql_year_cnt) {  // 1000일 개근
                 $sql_reset  = "0";
                 $sql_reset2 = "0";
                 $sql_reset3 = "0";
                 $sql_reset4 = "0";
                 $sql_reset6 = "0";
                 $sql_point  = $sql_point + $sql_year_point;
             }
             if ($sql_day > $sql_year_cnt) {  // 1000일 개근
                 $sql_day = "1";
             }
        } else { // 출석하지 않았다면
             // 전체 개근 설정
             $sql_day = "1";
             $sumday = "1";
 
             // 리셋
             $sql_reset  = "1";
             $sql_reset2 = "1";
             $sql_reset3 = "1";
             $sql_reset4 = "1";
             $sql_reset5 = "0";
             $sql_reset6 = "1";
        }
 
 
         // 첫출근
         $sql = " select count(*) as cnt, `rank` from g5_attendance where substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
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
 
         $fullday = $getday." 00:00:00";
         // 기록
         $sql = " update g5_attendance
                     set subject = '성공만큼 큰 실패는 없다. - 제럴드 내크먼',
                         day = '$sql_day',
                         sumday = '$sumday',
                         reset = '$sql_reset',
                         reset2 = '$sql_reset2',
                         reset3 = '$sql_reset3',
                         reset4 = '$sql_reset4',
                         reset5 = '$sql_reset5',
                         reset6 = '$sql_reset6',
                         point = '$sql_point',
                         `rank` = '$rank',			
                         where mb_id='{$mb_id}' and substring(`datetime`,1,10) = '{$getday}' ";
         $va = sql_query($sql);
    }
}
function attendanceUpdate23toNow($mb_id, $getday , $attendance){
    // тухайн өдрийн аттендайнс ороогүй байвал оруулна. 

    // 1일 뺀다.
    $day = date("Y-m-d", strtotime($getday) - (1 * 86400));
    // 어제 출석했나?
    $sql = " select * from g5_attendance where mb_id = '{$mb_id}' and substring(`datetime`,1,10) = '$day' order by sumday desc limit 1;";
    // var_dump($sql);die;
    // if (!sql_fetch($sql)) {
    $row = sql_fetch($sql);
    // var_dump($row);die;

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
    // var_dump($row);die;

    // 일일 포인트
    $sql_point = $sql_point;
    // 어제 출석했다면
    if ($row['mb_id']) {

        // 전체 개근에 오늘 합산
        $sql_day = $row['day'] + 1;
        $sumday = $row['sumday'] + 1;

        // 지난 개근체크에 오늘 합산
        $sql_reset = $row['reset'] + 1;
        $sql_reset2 = $row['reset2'] + 1;
        $sql_reset3 = $row['reset3'] + 1;
        $sql_reset4 = $row['reset4'] + 1;
        /* $sql_reset5 = $row['reset5'] + 1; */
        $sql_reset6 = $row['reset6'] + 1;


        if ($sql_reset == $sql_day_cnt) { // 7일 개근
            /* $sql_reset  = "0"; */
            $sql_point  = $sql_point + $sql_day_point;
        }

        if ($sql_reset2 == $sql_monthly_cnt) { // 30일 개근
            /* $sql_reset2 = "0"; */
            $sql_point  = $sql_point + $sql_monthly_point;
        }

        if ($sql_reset3 == $sql_year1_cnt) {  // 365일 개근
            /*  $sql_reset3 = "0"; */
            $sql_point  = $sql_point + $sql_year1_point;
        }

        if ($sql_reset4 == $sql_year2_cnt) {  // 500일 개근
            /* $sql_reset4 = "0"; */
            $sql_point  = $sql_point + $sql_year2_point;
        }

        /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근
            $sql_reset5 = "0"; 
            $sql_point  = $sql_point + $sql_year3_point;
        } */

        if ($sql_reset6 == $sql_year_cnt) {  // 1000일 개근
            $sql_reset  = "0";
            $sql_reset2 = "0";
            $sql_reset3 = "0";
            $sql_reset4 = "0";
            $sql_reset6 = "0";
            $sql_point  = $sql_point + $sql_year_point;
        }
        if ($sql_day > $sql_year_cnt) {  // 1000일 개근
            $sql_day = "1";
        }
    } else { // 출석하지 않았다면
        // 전체 개근 설정
        $sql_day = "1";
        $sumday = "1";

        // 리셋
        $sql_reset  = "1";
        $sql_reset2 = "1";
        $sql_reset3 = "1";
        $sql_reset4 = "1";
        $sql_reset5 = "0";
        $sql_reset6 = "1";
    }


    // 첫출근
    $sql = " select count(*) as cnt, `rank` from g5_attendance where substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
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

    $fullday = $getday." 00:00:00";
    // 기록
    $sql = " update g5_attendance
                set subject = '성공만큼 큰 실패는 없다. - 제럴드 내크먼',
                    day = '$sql_day',
                    sumday = '$sumday',
                    reset = '$sql_reset',
                    reset2 = '$sql_reset2',
                    reset3 = '$sql_reset3',
                    reset4 = '$sql_reset4',
                    reset5 = '$sql_reset5',
                    reset6 = '$sql_reset6',
                    point = '$sql_point',
                    `rank` = '$rank'			
                    where mb_id='{$mb_id}' and substring(`datetime`,1,10) = '{$getday}' ";

    $va = sql_query($sql);
}
// Нөхөж олгох хэсэг(Төгсгөл)

// 출석 시간 체크
// if (date("H:i:s") < $attendance['start_time'] || date("H:i:s") > $attendance['end_time']) {

//     alert("출석 시간이 아닙니다.");
// }

// // 총출석일수
// $sql = " select sumday from {$g5['attendance_table']} where mb_id = '{$member['mb_id']}' order by `datetime` desc ";
// $row = sql_fetch($sql);
// // 총출석일
// $sumday = $row['sumday'] + 1;

// // 오늘 출석했나?
// $sql = " select * from {$g5['attendance_table']} where mb_id = '$member[mb_id]' and substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
// $check = sql_fetch($sql);

// // 출석했다면.
// if ($check['mb_id']) {

//     alert("이미 출석 하였습니다.");
// }


// // 1일 뺀다.
// $day = date("Y-m-d", $G5_SERVER_TIME - (1 * 86400));

// // 어제 출석했나?
// $sql = " select * from {$g5['attendance_table']} where mb_id = '$member[mb_id]' and substring(`datetime`,1,10) = '$day' ";
// $row = sql_fetch($sql);
// // var_dump($sql);die;
// $sql_point = $attendance['today_point'];
// $sql_day_point = $attendance['day_point'];
// $sql_monthly_point = $attendance['monthly_point'];
// $sql_year1_point = $attendance['year1_point'];
// $sql_year2_point = $attendance['year2_point'];
// /* $sql_year3_point = $attendance['year3_point']; */
// $sql_year_point = $attendance['year_point'];

// $sql_day_cnt = $attendance['day'];
// $sql_monthly_cnt = $attendance['monthly'];
// $sql_year1_cnt = $attendance['year1'];
// $sql_year2_cnt = $attendance['year2'];
// /* $sql_year3_cnt = $attendance['year3']; */
// $sql_year_cnt = $attendance['year'];

// // 일일 포인트
// $sql_point = $sql_point;

// // 어제 출석했다면
// if ($row['mb_id']) {
//     // 전체 개근에 오늘 합산
//     $sql_day = $row['day'] + 1;

//     // 지난 개근체크에 오늘 합산
//     $sql_reset = $row['reset'] + 1;
//     $sql_reset2 = $row['reset2'] + 1;
//     $sql_reset3 = $row['reset3'] + 1;
//     $sql_reset4 = $row['reset4'] + 1;
//     /* $sql_reset5 = $row['reset5'] + 1; */
//     $sql_reset6 = $row['reset6'] + 1;


//     if ($sql_reset == $sql_day_cnt) { // 7일 개근
//         /* $sql_reset  = "0"; */
//         $sql_point  = $sql_point + $sql_day_point;
//     }

//     if ($sql_reset2 == $sql_monthly_cnt) { // 30일 개근
//         /* $sql_reset2 = "0"; */
//         $sql_point  = $sql_point + $sql_monthly_point;
//     }

//     if ($sql_reset3 == $sql_year1_cnt) {  // 365일 개근
//         /*  $sql_reset3 = "0"; */
//         $sql_point  = $sql_point + $sql_year1_point;
//     }

//     if ($sql_reset4 == $sql_year2_cnt) {  // 500일 개근
//         /* $sql_reset4 = "0"; */
//         $sql_point  = $sql_point + $sql_year2_point;
//     }

//     /* if ($row['reset5'] == $sql_year3_cnt) {  // 700일 개근
//         $sql_reset5 = "0"; 
//         $sql_point  = $sql_point + $sql_year3_point;
//     } */

//     if ($sql_reset6 == $sql_year_cnt) {  // 1000일 개근
//         $sql_reset  = "0";
//         $sql_reset2 = "0";
//         $sql_reset3 = "0";
//         $sql_reset4 = "0";
//         $sql_reset6 = "0";
//         $sql_point  = $sql_point + $sql_year_point;
//     }
//     if ($sql_day > $sql_year_cnt) {  // 1000일 개근
//         $sql_day = "1";
//     }
// } else { // 출석하지 않았다면
//     // 전체 개근 설정
//     $sql_day = "1";

//     // 리셋
//     $sql_reset  = "1";
//     $sql_reset2 = "1";
//     $sql_reset3 = "1";
//     $sql_reset4 = "1";
//     $sql_reset5 = "0";
//     $sql_reset6 = "1";
// }


// // 첫출근
// $sql = " select count(*) as cnt, `rank` from {$g5['attendance_table']} where substring(`datetime`,1,10) = '" . G5_TIME_YMD . "' ";
// $first = sql_fetch($sql);

// // 아무도 없다면..
// $rank = "";
// if (!$first['cnt']) { // 1등 포인트 
//     $sql_point = $attendance['first_point'] + $sql_point;
//     $rank = 1;
// } elseif ($first['cnt'] == 1) { // 2등 포인트 
//     $sql_point = $attendance['second_point'] + $sql_point;
//     $rank = 2;
// } elseif ($first['cnt'] == 2) { // 3등 포인트 
//     $sql_point = $attendance['third_point'] + $sql_point;
//     $rank = 3;
// } else {
//     $rank = $first['cnt'];
// }


// // 기록
// $sql = " insert into {$g5['attendance_table']}
//             set mb_id = '$member[mb_id]',
//                 subject = '" . $_POST['subject'] . "',
//                 day = '$sql_day',
//                 sumday = '$sumday',
//                 reset = '$sql_reset',
//                 reset2 = '$sql_reset2',
//                 reset3 = '$sql_reset3',
//                 reset4 = '$sql_reset4',
//                 reset5 = '$sql_reset5',
//                 reset6 = '$sql_reset6',
//                 point = '$sql_point',
// 				`rank` = '$rank',			
//                 `datetime` = '" . G5_TIME_YMDHIS . "' ";
// sql_query($sql);


// 출석 포인트 지급
// // 7 хоног бол 50 пойнт
// $last_7 = " select count(*) cnt from {$g5['attendance_table']} where datetime >= DATE(NOW()) - INTERVAL 7 DAY and mb_id='{$member['mb_id']}'";
// $last7_day = sql_fetch($last_7);
// if((int)$last7_day['cnt'] == 7)
//     insert_point($member['mb_id'], 50, "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);
// else if((int)$last7_day['cnt'] == 30)
//     insert_point($member['mb_id'], 500, "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);
// else if((int)$last7_day['cnt'] == 365)
//     insert_point($member['mb_id'], 10000, "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);
// else if((int)$last7_day['cnt'] == 500)
//     insert_point($member['mb_id'], 20000, "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);
// else if((int)$last7_day['cnt'] == 1000)
//     insert_point($member['mb_id'], 50000, "출석 파운드", "@attendance", $member['mb_nick'], G5_TIME_YMD);
// 완료
alert("출석 체크 완료", "./attendance.php");
