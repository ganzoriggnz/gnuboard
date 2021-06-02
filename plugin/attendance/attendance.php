<?php


include_once("./_setup.php");
$G5_TIME_YMD = G5_TIME_YMD;
$g5['title'] = "출석체크";

if (!sql_query("select count(*) as cnt from {$g5['attendance_table']}", false)) { // attendance 테이블이 없다면 생성
    $sql_table = "create table {$g5['attendance_table']} (            
		    id int(11) NOT NULL auto_increment,
		    mb_id varchar(50) NOT NULL default '',
            rank varchar(2) NOT NULL default '',
		    subject varchar(255) NOT NULL default '',
		    day int(11) NOT NULL default '0',
		    sumday int(11) NOT NULL default '0',
		    reset int(11) NOT NULL default '0',
		    reset2 int(11) NOT NULL default '0',
		    reset3 int(11) NOT NULL default '0',
		    reset4 int(11) NOT NULL default '0',
		    reset5 int(11) NOT NULL default '0',
		    reset6 int(11) NOT NULL default '0',
		    point int(11) NOT NULL default '0',
		    datetime datetime NOT NULL default '0000-00-00 00:00:00',
		    PRIMARY KEY  (id),
		    KEY id (mb_id,day,datetime)
        )";
    sql_query($sql_table, false);
}

if (!$is_member) {
    alert("로그인 후 이용하세요.");
}

include_once(G5_THEME_PATH . "/head.sub.php");

include_once("./head.php");

$colspan = "7";

/*---------------------------------------
    ## 달력 ## 
-----------------------------------------*/

$datetime = $d;

if (!$datetime) {

    $datetime = $G5_TIME_YMD;
}

// 현재 시각 지정.
//$datetime = "2008-12-01";
//$datetime = $g5['time_ymd'];


// 현재 시각에서 월을 구한다.
$DateT1 = date("Y-m", strtotime($datetime));

// 현재 월의 1일의 요일 값을 구한다.
$DateT2 = date("w", strtotime($DateT1 . "-01"));

// 현재 월의 1일에서 요일 값을 뺀다.
$DateT3 = date("Y-m-d", strtotime($DateT1 . "-01") - (86400 * $DateT2));


// 현재 월의 1일에서 31일을 더한다.
$DateN1 = date("Y-m-d", strtotime($DateT1 . "-01") + (86400 * 31));

// 다음 달의 월을 구한다.
$DateN2 = date("Y-m", strtotime($DateN1));

// 다음 달 1일을 구한다.
$DateN3 = date("Y-m-d", strtotime($DateN2 . "-01"));

// 다음 달 1일에서 1일을 뺀다. 그럼 이번 달 마지막일
$DateN4 = date("d", strtotime($DateN3) - (86400 * 1));

// 6 뺀다. 현재 달 마지막 일 요일을 구해서.
$DateN5 = 6 - date("w", strtotime($DateT1 . "-" . $DateN4));


// 현재 월의 1일에서 1일을 뺀다.
$DateP1 = date("Y-m-d", strtotime($DateT1 . "-01") - (86400 * 1));

/*---------------------------------
    ## 리스트 ##
---------------------------------*/

// 날짜가 있다면.
if ($d) {

    $sql_common = "substring(datetime,1,10) = '$datetime'";
} else {
    // 오늘

    $sql_common = "substring(datetime,1,10) = '$G5_TIME_YMD'";
}
?>
<link rel="stylesheet" href="<?php echo $G5_URL ?>/plugin/attendance/attendance.css" />

<div id="bo_v">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr height="<?php echo $config['cf_home_height'] ?>">
            <td align="center" colspan="<?php echo $colspan ?>"></td>
        </tr>
        <tr>
            <td>
                <!-- 출석 달력 시작 //-->
                <div id="att_layer">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; border:1px solid #e4e4e4;">
                        <tr>
                            <td colspan="7" align="center">
                                <table border="0" width="100%">
                                    <tr>
                                        <td class="att_top1">
                                            <img src="<?php echo G5_ATTENDANCE_URL ?>/img/icon_clock.gif" align="absmiddle"> <span id="time_view" class="time_col">0</span>
                                        </td>
                                        <!-- <td width="50" height="90" rowspan="2"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/att.gif" align="absmiddle"></td> -->
                                        <td class="att_top2">
                                            <img src="<?php echo G5_ATTENDANCE_URL ?>/img/exclamation.gif" align="absmiddle"> 출석부 이용안내 </br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="att_top3">
                                            <div id="box">
                                                <li class="top"><a href="?d=<?php echo $DateP1 ?>&mode=<?php echo $mode ?>" class="dot"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/btn_prev.gif" align="absmiddle"></a></li>
                                                <li class="day"><span class="w"><?php echo $DateT1 ?></span></li>
                                                <li class="top1"><a href="?d=<?php echo $DateN3 ?>&mode=<?php echo $mode ?>" class="dot"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/btn_next.gif" align="absmiddle"></a></li>
                                            </div>
                                        </td>
                                        <?php if (G5_IS_MOBILE) { ?>
                                    <tr style="font-size: 12px;">
                                        <td width="" style='padding-left:10px;'>
                                            <img src="<?php echo G5_ATTENDANCE_URL ?>/img/exclamation.gif" align="absmiddle"> 출석부 이용안내 <br>
                                            출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time'])) ?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time'])) ?><br />
                                            출석파운드 : <?php echo number_format($attendance['today_point']) ?> 파운드<br />
                                            개근 파운드 :
                                            <?php echo $attendance['day'] ?>일 파운드 : <?php echo number_format($attendance['day_point']) ?> 파운드,
                                            <?php echo $attendance['monthly'] ?>일 파운드 : <?php echo number_format($attendance['monthly_point']) ?> 파운드,
                                            <?php echo $attendance['year1'] ?>일 파운드 : <?php echo number_format($attendance['year1_point']) ?> 파운드,
                                            <?php echo $attendance['year2'] ?>일 파운드 : <?php echo number_format($attendance['year2_point']) ?> 파운드,
                                            <?php echo $attendance['year'] ?>일 파운드 : <?php echo number_format($attendance['year_point']) ?>파운드
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <td class="att_top4">
                                        <div class="show_exc"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/exclamation.gif" align="absmiddle"> 출석부 이용안내 <br> </div>
                                        출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time'])) ?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time'])) ?><br>
                                        출석파운드 : <?php echo number_format($attendance['today_point']) ?> 파운드
                                        • 개근상 : <?php echo $attendance['day'] ?>일 : <?php echo number_format($attendance['day_point']) ?> 파운드,&nbsp;&nbsp; <?php echo $attendance['monthly'] ?>일 : <?php echo number_format($attendance['monthly_point']) ?> 파운드,&nbsp;&nbsp;<?php echo $attendance['year1'] ?>일 : <?php echo number_format($attendance['year1_point']) ?> 파운드,
                                        &nbsp;&nbsp;<?php echo $attendance['year2'] ?>일 : <?php echo number_format($attendance['year2_point']) ?> 파운드,&nbsp;&nbsp;<?php echo $attendance['year'] ?>일 : <?php echo number_format($attendance['year_point']) ?> 파운드
                                        <br> &nbsp;
                                    </td>
                                <?php } ?>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="7" height="1" bgcolor="#e4e4e4"></td>
        </tr>
        <tr height='30'>
            <?php if (G5_IS_MOBILE) { ?>
                <td align="center" class="title_sun"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/su.gif" align="absmiddle"> 일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/mo.gif" align="absmiddle"> 월</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/tu.gif" align="absmiddle"> 화</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/we.gif" align="absmiddle"> 수</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/th.gif" align="absmiddle"> 목</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/fr.gif" align="absmiddle"> 금</td>
                <td align="center" class="title_sat"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/sa.gif" align="absmiddle"> 토</td>
            <?php } else { ?>
                <td align="center" class="title_sun"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/su.gif" align="absmiddle"> 일요일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/mo.gif" align="absmiddle"> 월요일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/tu.gif" align="absmiddle"> 화요일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/we.gif" align="absmiddle"> 수요일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/th.gif" align="absmiddle"> 목요일</td>
                <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/fr.gif" align="absmiddle"> 금요일</td>
                <td align="center" class="title_sat"><img src="<?php echo G5_ATTENDANCE_URL ?>/img/sa.gif" align="absmiddle"> 토요일</td>
            <?php } ?>
        </tr>
        <tr height='50'>
            <?php
            // 7셀만 출력. 다음 셀로 자동 변경.
            $mod = "7";

            // 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
            for ($i = 0; $i < ($DateN4 + $DateT2 + $DateN5); $i++) {

                // 6일 뺀 날짜부터 돌린다.
                $DateT4 = date("Y-m-d", strtotime($DateT3) + (86400 * $i));

                // 해당 날짜의 요일을 구한다.
                $DateT5 = date("w", strtotime($DateT3) + (86400 * $i));

                if ($i && $i % $mod == '0') {

                    echo "</tr>\n<tr height='50'>\n";
                }

                // 일요일 제외
                if ($DateT5 != '0') {

                    $DateLine = "border-left:1px solid #e4e4e4;";
                } else {

                    $DateLine = "";
                }
                //출석 했을때 이미지 출력
                $sql = " select id from {$g5['attendance_table']} where mb_id = '$member[mb_id]' and substring(datetime,1,10) = '$DateT4' ";
                $check = sql_fetch($sql);

                // 출석
                if ($G5_TIME_YMD == $DateT4) {
                    if ($check['id']) {

                        echo "<td class=\"attendance\" style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";
                    } else {

                        echo "<td class=\"\"style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";
                    }
                } else {
                    if ($check['id']) {

                        echo "<td class=\"attendance_off\" style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";
                    } else {

                        echo "<td class=\"\"style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";
                    }
                }

                // 현재 월과 돌린 월이 일치할 때만.
                if ($DateT1 == substr($DateT4, 0, 7)) {

                    // 찍은 날짜면
                    if ($datetime == $DateT4) {

                        // 0은 일요일.
                        if ($DateT5 == '0') {

                            // 빨강색
                            $DateClassName = "sun_2";
                        }
                        // 6은 토요일
                        else if ($DateT5 == '6') {

                            // 파랑색
                            $DateClassName = "sat_2";
                        } else {

                            // 기타
                            $DateClassName = "day_2";
                        }
                    }

                    // 오늘 날짜면
                    else if ($G5_TIME_YMD == $DateT4) {

                        // 0은 일요일.
                        if ($DateT5 == '0') {

                            // 빨강색
                            $DateClassName = "sun_2";
                        }
                        // 6은 토요일
                        else if ($DateT5 == '6') {

                            // 파랑색
                            $DateClassName = "sat_2";
                        } else {

                            // 기타
                            $DateClassName = "day_2";
                        }
                    } else {

                        // 0은 일요일.
                        if ($DateT5 == '0') {

                            // 빨강색
                            $DateClassName = "sun_1";
                        }
                        // 6은 토요일
                        else if ($DateT5 == '6') {

                            // 파랑색
                            $DateClassName = "sat_1";
                        } else {

                            // 기타
                            $DateClassName = "day_1";
                        }
                    }

                    echo "<div style='height:20px;'>";
                    echo "<a href=\"javascript:dateGo('" . $DateT4 . "')\">";
                    echo "<span class='" . $DateClassName . "'>";
                    echo substr($DateT4, 8, 2);
                    echo "</span>";
                    echo "</a>";
                    echo "</div>";
                } else {

                    // 다른 달
                    echo "<span class='" . $DateClassName . "'>";
                    echo "&nbsp;";
                    echo "</span>";
                }

                echo "</td>\n";
            }

            // 나머지 셀을 채운다.
            $cnt = $i % $mod;
            if ($cnt) {

                for ($i = $cnt; $i < $mod; $i++) {

                    echo "<td>&nbsp;</td>\n";
                }
            }
            ?>
        </tr>
    </table>
</div>
<!-- 출석 달력 끝 //-->
</td>
</tr>
<script type="text/javascript">
    function dateGo(day) {

        document.location.href = "?d=" + day;

    }
</script>
<tr>
    <td height="10"></td>
</tr>
<tr>
    <td align="center" colspan="<?php echo $colspan ?>"></td>
</tr>
<tr>
    <td style="height:32px; border:0px solid">
        <form id="fattendance" name="fattendance" action="<?php echo G5_PLUGIN_URL ?>/attendance/attendance_write_update.php" method="post" enctype="multipart/form-data" style="margin:0px;">
            <div id="msg_content" class="msg-content">
                <div class="msg-cell">
                    <textarea id="subject" name="subject" class="form-attendance input-sm" rows="4" required="" maxlength="65536"></textarea>
                </div>
                <div tabindex="14" class="msg-cell msg-submit" onclick="att_submit();">
                    출석하기
                </div>
            </div>
        </form>

        <script type="text/javascript">
            value = new Array();
            value[0] = "성공이 끝은 아니다. - 윈스턴 처칠";
            value[1] = "내가 있는 곳이 낙원이라. - 볼테르";
            value[2] = "시간은 우리를 변화시키지 않는다. 시간은 단지 우리를 펼쳐 보일 뿐이다. - 막스 프리쉬";
            value[3] = "큰 희망이 큰 사람을 만든다. - 토마스 풀러";
            value[4] = "희망은 백일몽이다. - 아리스토텔레스";
            value[5] = "사람은 실패가 아니라 성공하기 위해 태어난다. - 헨리 데이비드 소로우";
            value[6] = "노력 없이 쓰인 글은 대개 감흥 없이 읽힌다. - 사무엘 존슨";
            value[7] = "기회는 자기 소개서를 보내지 않는다. - 작자 미상";
            value[8] = "시간은 너무 없고 할 일도 너무 없다. - 오스카 레반트";
            value[9] = "가장 현명한 사람은 자신만의 방향을 따른다. - 에우리피데스";
            value[10] = "경험을 현명하게 사용한다면, 어떤 일도 시간 낭비는 아니다. - 오귀스트 르네 로댕";
            value[11] = "인간은 오직 사고(思考)의 산물일 뿐이다. 생각하는 대로 되는 법. - 마하트마 간디";
            value[12] = "유머가 아예 없다면 인생을 불가능으로 바꾼다. - 꼴레뜨";
            value[13] = "성공만큼 큰 실패는 없다. - 제럴드 내크먼";
            value[14] = "성공한 사람이 될 수 있는데 왜 평범한 이에 머무르려 하는가? - 베르톨트 브레히트";
            value[15] = "지성을 다하는 것이 곧 천도(天道)다(지성이면 감천이다). - 맹자";
            value[16] = "인간의 감정은 누군가를 만날 때와 헤어질 때 가장 순수하며 가장 빛난다. - 장 폴 리히터";
            value[17] = "잘 있거라! 우리가 언제 다시 만날지는 아무도 모른다. - 윌리엄 셰익스피어";
            value[18] = "나만이 내 인생을 바꿀 수 있다. 아무도 날 대신해 해줄 수 없다. - 캐롤 버넷";
            value[19] = "여가시간을 가지려면 시간을 잘 써라. - 벤자민 프랭클린";
            value[20] = "희망만이 인생의 유일한 사랑이다. - 앙리 프레데릭 아미엘";
            value[21] = "일 분 전만큼 먼 시간은 없다. - 짐 비숍";
            value[22] = "미래를 결정짓고 싶다면 과거를 공부하라. - 공자";
            value[23] = "덜 약속하고 더 해주어라. - 톰 피터스";
            value[24] = "젊은이들에게 관대하라. - 유베날리스";
            value[25] = "인생은 위험의 연속이다. - 다이앤 프롤로브";
            value[26] = "희망은 어떤 상황에서도 필요하다. - 사무엘 존슨";
            value[27] = "삶이 있는 한 희망은 있다. - 키케로";
            value[28] = "우리의 목적은 성공이 아니라 봉사라야 한다. - 작자 미상";
            value[29] = "운은 계획에서 비롯된다. - 브랜치 리키";
            value[30] = "이별의 아픔 속에서만 사랑의 깊이를 알게 된다. - 조지 앨리엇";
            value[31] = "긍정적 사고만큼 나를 우울하게 만드는 일은 없다. - 폴 퍼셀";
            value[32] = "지금 적극적으로 실행되는 괜찮은 계획이 다음 주의 완벽한 계획보다 낫다. - 조지 S. 패튼";
            value[33] = "티끌 모아 태산 / 천리 길도 한 걸음부터 - 공자";
            value[34] = "웃음 없는 하루는 낭비한 하루다. - 찰리 채플린";
            value[35] = "시간은 환상이다. 점심시간은 두 배로 그렇다. - 더글러스 애덤스";
            value[36] = "운은 계획에서 비롯된다. - 브랜치 리키";
            value[37] = "열정없이 사느니 차라리 죽는게 낫다. - 커트 코베인";
            value[38] = "우리는 오늘은 이러고 있지만, 내일은 어떻게 될지 누가 알아요? - 윌리엄 셰익스피어";
            value[39] = "그 어떤 것에서라도 내적인 도움과 위안을 찾을 수 있다면 그것을 잡아라. - 마하트마 간디";
            value[40] = "그 여정이 바로 보상이다. - 스티브 잡스";
            value[41] = "인생은 겸손에 대한 오랜 수업이다. - 제임스 M. 배리";
            value[42] = "인생은 집을 향한 여행이다. - 허먼 멜빌";
            value[43] = "시작이 반이다. - 아리스토텔레스";
            value[44] = "성공의 8할은 일단 출석하는 것이다. - 우디 알렌";
            value[45] = "성경은 게으름뱅이에게 빵을 약속하지 않는다. - 작자 미상";
            value[46] = "실패하는 것은 곧 성공으로 한 발짝 더 나아가는 것이다. - 메리 케이 애쉬";
            value[47] = "인생은 밀림 속의 동물원이다. - 피터 드 브리스";
            value[48] = "무엇을 잘 하는 것은 시간낭비일 때가 많다. - 로버트 바이른";
            value[49] = "지속적인 긍정적 사고는 능력을 배가시킨다. - 콜린 파월";
            value[50] = "낭비한 시간에 대한 후회는 더 큰 시간 낭비이다. - 메이슨 쿨리";

            rand = Math.floor(value.length * Math.random());
            randText = value[rand];
            document.getElementById("subject").value = randText; //$('#wr_text').html(randText);    
        </script>

        <script type="text/javascript">
            function att_submit() {
                var ChkSubject = $('#subject').val();
                if (!ChkSubject || ChkSubject == '출석인사를 입력해 주세요.') {

                    alert("출석인사를 입력하세요.");
                    return false;

                } else {
                    $('#fattendance').submit();
                }
            }
        </script>
    </td>
</tr>
<tr>
    <td height="10"></td>
</tr>
<?php if (G5_IS_MOBILE) { ?>
    <tr>
        <td width="100%">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" valign="top" class="board_list" style="font-size:10px;">
                <tr height="34">
                    <td width="50" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>등수</td>
                    <td width="100" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>출석시간</td>
                    <td width="110" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>닉네임</td>
                    <td width="60" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>접속중</td>
                    <td width="60" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>파운드</td>
                    <td width="60" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>개근</td>
                </tr>
                <?php
                // 출석 테이블 연결
                $sql = " select * from {$g5['attendance_table']} where $sql_common order by datetime asc, day desc ";
                $result = sql_query($sql);
                for ($i = 0; $data = sql_fetch_array($result); $i++) {

                    // 접속자테이블 연결
                    $sql = " select mb_id from {$g5['login_table']} where mb_id = '$data[mb_id]' ";
                    $ing = sql_fetch($sql);

                    // 접속상태
                    if ($ing['mb_id']) {

                        $on = "접속중";
                    } else {

                        $on = "미접속";
                    }

                    // 회원 테이블 연결
                    $check = get_member($data['mb_id']);

                    // 닉네임
                    $name = get_sideview($check['mb_id'], $check['mb_nick'], $check['mb_email'], $check['mb_homepage']);

                    // 랭킹
                    $rank = $i + 1;

                    $list = $i % 2 ? 0 : 1;

                ?>
                    <tr height="30" class="bg<?php echo $list ?>">
                        <td align="center"><?php echo $rank ?> 등</td>
                        <td align="center"><?php echo substr($data['datetime'], 10, 16); ?></td>
                        <td align="left"><?php echo $name ?></td>
                        <td align="center"><?php echo $on ?></td>
                        <td align="right" style="padding:0 5 0 0px;"><?php echo number_format($data['point']); ?> 파운드</td>
                        <td align="center"><?php echo $data['day'] ?> 일째</td>
                    </tr>
                    <tr>
                        <td bgcolor="#EEEEEE" colspan="<?php echo $colspan ?>" height="1"></td>
                    </tr>
                <?php } ?>
                <?php if (!$i) { ?>
                    <tr>
                        <td height="100" colspan="<?php echo $colspan ?>" align="center">출석한 사람이 없습니다.<br><br>출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time'])) ?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time'])) ?></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $colspan ?>" height="1" bgcolor="#eeeeee"></td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30"></td>
    </tr>
    </table>
    </div>

<?php } else { ?>
    <tr>
        <td width="100%">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" valign="top" class="board_list">
                <tr height="34">
                    <td width="50" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>등수</td>
                    <td width="100" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>출석시간</td>
                    <td width="170" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>닉네임</td>
                    <td class="show_at" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>출석인사</td>
                    <td width="60" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>접속중</td>
                    <td width="100" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>파운드</td>
                    <td width="60" align="center" bgcolor="#2c2c2c" style='color:#ffffff;font-weight:none;'>개근</td>
                </tr>
                <?php
                // 출석 테이블 연결
                $sql = " select * from {$g5['attendance_table']} where $sql_common order by datetime asc, day desc ";
                $result = sql_query($sql);
                for ($i = 0; $data = sql_fetch_array($result); $i++) {

                    // 접속자테이블 연결
                    $sql = " select mb_id from {$g5['login_table']} where mb_id = '$data[mb_id]' ";
                    $ing = sql_fetch($sql);

                    // 접속상태
                    if ($ing['mb_id']) {

                        $on = "접속중";
                    } else {

                        $on = "미접속";
                    }

                    // 회원 테이블 연결
                    $check = get_member($data['mb_id']);

                    // 닉네임
                    $name = get_sideview($check['mb_id'], $check['mb_nick'], $check['mb_email'], $check['mb_homepage']);

                    // 랭킹
                    $rank = $i + 1;

                    $list = $i % 2 ? 0 : 1;

                ?>
                    <tr height="30" class="bg<?php echo $list ?>">
                        <td align="center"><?php echo $rank ?> 등</td>
                        <td align="center"><?php echo substr($data['datetime'], 10, 16); ?></td>
                        <td align="left"><?php echo na_name_photo($check['mb_id'], $name) ?></td>
                        <td class="show_at" style="padding:0 0 0 20px;"><?php echo get_text($data['subject']) ?></td>
                        <td align="center"><?php echo $on ?></td>
                        <!-- <td align="right" style="padding:0 5 0 0px;"><?php echo number_format($data['point']); ?> 파운드</td> -->
                        <td align="right" style="padding:0 5 0 0px;"><?php if (number_format($data['point']) > 10) {
                                                                            echo '10 + ' . (number_format($data['point']) - 10) . ' 파운드';
                                                                        } else {
                                                                            echo number_format($data['point']) . '파운드';
                                                                        } ?></td>
                        <td align="center"><?php echo $data['day'] . '일째'; ?> </td>
                    </tr>
                    <tr>
                        <td bgcolor="#EEEEEE" colspan="<?php echo $colspan ?>" height="1"></td>
                    </tr>
                <?php } ?>
                <?php if (!$i) { ?>
                    <tr>
                        <td height="100" colspan="<?php echo $colspan ?>" align="center">출석한 사람이 없습니다.<br><br>출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time'])) ?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time'])) ?></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $colspan ?>" height="1" bgcolor="#eeeeee"></td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30"></td>
    </tr>
    </table>
    </div>
<?php } ?>

<?php
$strYear = date("Y", G5_SERVER_TIME);
$strMonth = date("m", G5_SERVER_TIME) - 1;
$strDay = date("d", G5_SERVER_TIME);
$strHour = date("H", G5_SERVER_TIME);
$strMin = date("i", G5_SERVER_TIME);
$strSec = date("s", G5_SERVER_TIME);
?>

<script type="text/javascript">
    var strYear = "<?php echo $strYear ?>";
    var strMonth = "<?php echo $strMonth ?>";
    var strDay = "<?php echo $strDay ?>";
    var strHour = "<?php echo $strHour ?>";
    var strMin = "<?php echo $strMin ?>";
    var strSec = "<?php echo $strSec ?>";
    var cnt = 0;

    function startTime() {

        var date = new Date(strYear, strMonth, strDay, strHour, strMin, strSec);

        date.setSeconds(date.getSeconds() + cnt);

        var Year = date.getFullYear(); //메서드는 주어진 날짜의 현지 시간 기준 연도를 반환합니다
        var Month = date.getMonth() + 1;
        var Day = date.getDate();
        var Hour = date.getHours();
        var Min = date.getMinutes();
        var Sec = date.getSeconds();

        if (Month < 10) {

            var Month = "0" + date.getMonth();

        } else {

            var Month = "" + date.getMonth();

        }

        if (Day < 10) {

            var Day = "0" + date.getDate();

        } else {

            var Day = "" + date.getDate();

        }

        if (Min < 10) {

            var Min = "0" + date.getMinutes();

        } else {

            var Min = "" + date.getMinutes();

        }

        if (Sec < 10) {

            var Sec = "0" + date.getSeconds();

        } else {

            var Sec = date.getSeconds();

        }

        var time_view = Hour + "시 " + Min + "분 " + Sec + "초";

        document.getElementById("time_view").innerHTML = time_view;

        cnt++;

        setTimeout("startTime();", 1000); // 1 sek iin daraa startTime() function ajillah

    }

    startTime();
</script>
<?php
include_once("./tail.php");
include_once(G5_THEME_PATH . "/tail.sub.php");
?>