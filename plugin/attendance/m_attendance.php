<?php
include_once("../../common.php");
include_once("./_setup.php");

$G5_TIME_YMD = G5_TIME_YMD;
$g5['title'] = "출석체크";

    if (!sql_query("select count(*) as cnt from $g5[attendance_table]",false)) { // attendance 테이블이 없다면 생성
        $sql_table = "create table $g5[attendance_table] (            
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
    /* alert("로그인 후 이용하세요."); */
    alert("로그인 후 이용하세요.", G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));
}

include_once(G5_THEME_PATH."/head.sub.php");

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
$DateT2 = date("w", strtotime($DateT1."-01"));

// 현재 월의 1일에서 요일 값을 뺀다.
$DateT3 = date("Y-m-d", strtotime($DateT1."-01") - (86400 * $DateT2));


// 현재 월의 1일에서 31일을 더한다.
$DateN1 = date("Y-m-d", strtotime($DateT1."-01") + (86400 * 31));

// 다음 달의 월을 구한다.
$DateN2 = date("Y-m", strtotime($DateN1));

// 다음 달 1일을 구한다.
$DateN3 = date("Y-m-d", strtotime($DateN2."-01"));

// 다음 달 1일에서 1일을 뺀다. 그럼 이번 달 마지막일
$DateN4 = date("d", strtotime($DateN3) - (86400 * 1));

// 6 뺀다. 현재 달 마지막 일 요일을 구해서.
$DateN5 = 6 - date("w", strtotime($DateT1."-".$DateN4));


// 현재 월의 1일에서 1일을 뺀다.
$DateP1 = date("Y-m-d", strtotime($DateT1."-01") - (86400 * 1));

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
<tr height="<?php echo $config['cf_home_height']?>"><td align="center" colspan="<?php echo $colspan?>"></td></tr>
<tr><td>
<!-- 출석 달력 시작 //-->
<div id="att_layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; border:1px solid #e4e4e4;">
<tr>
    <td colspan="7" align="center">
<table border="0" width="100%">
    <tr>
        <td  align="center" style="padding-top:10px;">
		  <img src="<?php echo G5_ATTENDANCE_URL?>/img/icon_clock.gif" align="absmiddle"> <span id="time_view" class="time_col">0</span>
		</td>
    </tr>
    <tr>
        <td  align="center">
			<div id="box">
				<li class="top"><a href="?d=<?php echo $DateP1?>&mode=<?php echo $mode?>" class="dot"><img src="<?php echo G5_ATTENDANCE_URL?>/img/btn_prev.gif" align="absmiddle"></a></li>
				<li class="day"><span class="w"><?php echo $DateT1?></span></li>
				<li class="top"><a href="?d=<?php echo $DateN3?>&mode=<?php echo $mode?>" class="dot"><img src="<?php echo G5_ATTENDANCE_URL?>/img/btn_next.gif" align="absmiddle"></a></li>
			</div>		    
		</td>
        </tr>
    <tr style="font-size: 12px;">
        <td width=""  style='padding-left:10px;'>
        <img src="<?php echo G5_ATTENDANCE_URL?>/img/exclamation.gif" align="absmiddle"> 출석부 이용안내 <br>
		    출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time']))?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time']))?><br/>
            출석파운드 : <?php echo number_format($attendance['today_point'])?> 파운드<br />
            등수 파운드 : 1등 <?php echo number_format($attendance['first_point'])?> 파운드, 2등 <?php echo number_format($attendance['second_point'])?> 파운드, 3등 <?php echo number_format($attendance['third_point'])?> 파운드<br />
            개근 파운드 : 
            <?php echo $attendance['day']?>일 파운드 : <?php echo number_format($attendance['day_point'])?> 파운드, 
            <?php echo $attendance['monthly']?>일 파운드 : <?php echo number_format($attendance['monthly_point'])?> 파운드, 
            <?php echo $attendance['year1']?>일 파운드 : <?php echo number_format($attendance['year1_point'])?> 파운드, 
            <?php echo $attendance['year2']?>일 파운드 : <?php echo number_format($attendance['year2_point'])?> 파운드, 
            <?php echo $attendance['year3']?>일 파운드 : <?php echo number_format($attendance['year3_point'])?> 파운드, 
            <?php echo $attendance['year']?>일 파운드 : <?php echo number_format($attendance['year_point'])?>파운드
		</td>
    </tr>
</table>
</td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height='30'>
    <td align="center" class="title_sun"><img src="<?php echo G5_ATTENDANCE_URL?>/img/su.gif" align="absmiddle"> 일</td>
    <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL?>/img/mo.gif" align="absmiddle"> 월</td>
    <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL?>/img/tu.gif" align="absmiddle"> 화</td>
    <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL?>/img/we.gif" align="absmiddle"> 수</td>
    <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL?>/img/th.gif" align="absmiddle"> 목</td>
    <td align="center" class="title_day"><img src="<?php echo G5_ATTENDANCE_URL?>/img/fr.gif" align="absmiddle"> 금</td>
    <td align="center" class="title_sat"><img src="<?php echo G5_ATTENDANCE_URL?>/img/sa.gif" align="absmiddle"> 토</td>
</tr>
<tr height='50'>
<?php
// 7셀만 출력. 다음 셀로 자동 변경.
$mod = "7";

// 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
for ($i=0; $i<($DateN4 + $DateT2 + $DateN5); $i++) {

    // 6일 뺀 날짜부터 돌린다.
    $DateT4 = date("Y-m-d", strtotime($DateT3) + (86400 * $i));

    // 해당 날짜의 요일을 구한다.
    $DateT5 = date("w", strtotime($DateT3) + (86400 * $i));

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr height='50'>\n";

    }

    // 일요일 제외
    if ($DateT5 != '0') {

        $DateLine = "border-left:1px solid #e4e4e4;";

    } else {

        $DateLine = "";

    }
	//출석 했을때 이미지 출력
        $sql = " select id from $g5[attendance_table] where mb_id = '$member[mb_id]' and substring(datetime,1,10) = '$DateT4' ";
        $check = sql_fetch($sql);

        // 출석
		if ($G5_TIME_YMD == $DateT4) {
        if ($check['id']) {
				
				echo "<td class=\"m_attendance\" style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";

        } else {
    
            echo "<td class=\"\"style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";

        }
		}else{
		if ($check['id']) {
				
				echo "<td class=\"m_attendance_off\" style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";

        } else {
    
            echo "<td class=\"\"style='" . $DateLine . " border-top:1px solid #e4e4e4;'>";

        }

		}

    // 현재 월과 돌린 월이 일치할 때만.
    if ($DateT1 == substr($DateT4,0,7)) {

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
        echo "<a href=\"javascript:dateGo('".$DateT4."')\">";
        echo "<span class='" . $DateClassName . "'>";
        echo substr($DateT4,8,2);
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
$cnt = $i%$mod;
if ($cnt) {

    for ($i=$cnt; $i<$mod; $i++) {

        echo "<td>&nbsp;</td>\n";

    }

}
?>
</tr>
</table>
</div>
<!-- 출석 달력 끝 //-->
</td></tr>
<script type="text/javascript">
function dateGo(day)
{

    document.location.href = "?d="+day;

}
</script>
<tr><td height="10"></td></tr>
<tr><td align="center" colspan="<?php echo $colspan?>"></td></tr>
<tr>
    <td style="height:32px; border:0px solid">
<form id="fattendance" name="fattendance" method="post" action = "<?php echo G5_PLUGIN_URL ?>/attendance/m_attendance_write_update.php" enctype="multipart/form-data" style="margin:0px;">
<!-- <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
    <input type="text" id="subject" name="subject" class="input" style="height: 30px;" value="출석인사를 입력해 주세요." onmouseover="if(!this.value || this.value == '출석인사를 입력해 주세요.')this.value='';" >
    <input type="image" style="height: 30px;"  src="<?php echo G5_IMG_URL ?>/attendance_ok.gif" border="0"  align="absmiddle">
</td></tr></table> -->
    <div id="msg_content" class="msg-content">
        <div class="msg-cell">
            <textarea id="subject" name="subject" class="form-attendance input-sm" rows="4" required="" maxlength="65536"></textarea>
        </div>
        <div tabindex="14" class="msg-cell msg-submit" onclick="att_submit();">출석하기
        </div>
    </div>
</form>
<script type="text/javascript">
value=new Array();
value[0]="불타는 하루를 밤의제국(밤제)과 함께~"
value[1]="달림정보 포탈 사이트 밤의제국(밤제) bamje1.com"
value[2]="밤의제국 트위터 https://twitter.com/bamje4"
value[3]="밤의제국 바로가기 bamje.com 검색"
value[4]="밤의제국 접속주소 bamje1.com 다음접속 주소는 bamje2.com 입니다."
rand = Math.floor( value.length * Math.random());
randText = value[rand];
document.getElementById("subject").value = randText;//$('#wr_text').html(randText);    
</script>   

<script type="text/javascript"> 


    function att_submit()
    { 
        var ChkSubject = $('#subject').val();
        if (!ChkSubject || ChkSubject == '출석인사를 입력해 주세요.') { 

            alert("출석인사를 입력하세요."); 
            return false; 

        } 
        else {
            $('#fattendance').submit();
        } 
    }  

</script>
    </td>
</tr>
<tr><td height="10"></td></tr>
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
$sql = " select * from $g5[attendance_table] where $sql_common order by datetime asc, day desc ";
$result = sql_query($sql);
for ($i=0; $data=sql_fetch_array($result); $i++) {

    // 접속자테이블 연결
    $sql = " select mb_id from $g5[login_table] where mb_id = '$data[mb_id]' ";
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

    $list = $i%2 ? 0 : 1;
	 
?>
<tr height="30" class="bg<?php echo $list?>">
    <td align="center"><?php echo $rank?> 등</td>
    <td align="center"><?php echo substr($data['datetime'],10,16);?></td>
    <td align="left"><?php echo $name?></td>
    <td align="center"><?php echo $on?></td>
    <td align="right" style="padding:0 5 0 0px;"><?php echo number_format($data['point']);?> 파운드</td>
    <td align="center"><?php echo $data['day']?> 일째</td>
</tr>
<tr><td bgcolor="#EEEEEE" colspan="<?php echo $colspan?>" height="1"></td></tr>
<?php } ?>
<?php if (!$i) { ?>
<tr><td height="100" colspan="<?php echo $colspan?>" align="center">출석한 사람이 없습니다.<br><br>출석시간 : <?php echo date("A H시 i분 s초", strtotime($attendance['start_time']))?> ~ <?php echo date("A H시 i분 s초", strtotime($attendance['end_time']))?></td></tr>
<tr><td colspan="<?php echo $colspan?>" height="1" bgcolor="#eeeeee"></td></tr>
<?php } ?>
</table></td>
</tr>
<tr><td height="30"></td></tr>
</table>
</div>
<?php
$strYear = date("Y", G5_SERVER_TIME);
$strMonth = date("m", G5_SERVER_TIME) - 1;
$strDay = date("d", G5_SERVER_TIME);
$strHour = date("H", G5_SERVER_TIME);
$strMin = date("i", G5_SERVER_TIME);
$strSec = date("s", G5_SERVER_TIME);
?>

<script type="text/javascript">
var strYear = "<?php echo $strYear?>";
var strMonth = "<?php echo $strMonth?>";
var strDay = "<?php echo $strDay?>";
var strHour = "<?php echo $strHour?>";
var strMin = "<?php echo $strMin?>";
var strSec = "<?php echo $strSec?>";
var cnt = 0;

function startTime()
{

    var date = new Date(strYear, strMonth, strDay, strHour, strMin, strSec);

    date.setSeconds(date.getSeconds() + cnt);

    var Year = date.getFullYear();
    var Month = date.getMonth() + 1;
    var Day = date.getDate();
    var Hour = date.getHours();
    var Min = date.getMinutes();
    var Sec = date.getSeconds();

    if (Month < 10) {

        var Month = "0"+date.getMonth();

    } else {

        var Month = ""+date.getMonth();

    }

    if (Day < 10) {

        var Day = "0"+date.getDate();

    } else {

        var Day = ""+date.getDate();

    }

    if (Min < 10) {

        var Min = "0"+date.getMinutes();

    } else {

        var Min = ""+date.getMinutes();

    }

    if (Sec < 10) {

        var Sec = "0"+date.getSeconds();

    } else {

        var Sec = date.getSeconds();

    }

    var time_view = Hour + "시 " + Min + "분 " + Sec + "초";

    document.getElementById("time_view").innerHTML = time_view;

    cnt++;

    setTimeout("startTime();", 1000);

}

startTime();
</script>
<?php
include_once("./tail.php");
include_once(G5_THEME_PATH."/tail.sub.php");
?>