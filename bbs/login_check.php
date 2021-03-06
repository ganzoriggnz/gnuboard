<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

//소셜 로그인추가 체크

$is_social_login = false;
$is_social_password_check = false;

// 소셜 로그인이 맞는지 체크하고 해당 값이 맞는지 체크합니다.
if(function_exists('social_is_login_check')){
    $is_social_login = social_is_login_check();

    //패스워드를 체크할건지 결정합니다.
    //소셜로그인일때는 체크하지 않고, 계정을 연결할때는 체크합니다.
    $is_social_password_check = social_is_login_password_check($mb_id);
}

//소셜 로그인이 맞다면 패스워드를 체크하지 않습니다.
// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.
if (!$is_social_password_check && (!$mb['mb_id'] || !login_password_check($mb, $mb_password, $mb['mb_password'])) ) {

    run_event('password_is_wrong', 'login', $mb);

    alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.\\n비밀번호는 대소문자를 구분합니다.');
}

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
}

// 메일인증 설정이 되어 있다면
if ( is_use_email_certify() && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    $ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
}

run_event('login_session_before', $mb, $is_social_login);

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . get_real_client_ip() . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
$now = G5_TIME_YMDHIS;
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);
    $get_ip = array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point', mb_today_login = '$now', mb_login_ip = '{$get_ip}' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);

    $sql_date = "SELECT mb_4 FROM {$g5['member_table']} WHERE mb_id = '{$mb['mb_id']}' AND mb_level IN ('26', '27')";
    $res_date = sql_fetch($sql_date);   
    if($res_date['mb_4'] != ''){
        $end_time = strtotime($res_date['mb_4']);
        $now_time = strtotime($now);
        if($end_time >= $now_time){
            $diff = $end_time - $now_time;
            $diff_days = ceil($diff / 86400);
        }
        else if($end_time < $now_time){
            $diff_days = '0';
            $sql_d = " UPDATE {$g5['member_table']} 
                            SET mb_level = '26'
                            WHERE mb_id = '{$mb['mb_id']}' AND mb_level='27'";
            sql_query($sql_d);
        }
    }
}

$now = G5_TIME_YMDHIS;
$first_day_pre = date('Y-m-d 00:00:00', strtotime("first day of -1 month")); 
$last_day_pre = date('Y-m-d 23:59:59', strtotime("last day of -1 month"));

$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_insert_date1 = date_format($co_start, 'Y-m-01 00:00:00');
$co_insert_date2 = date_format($co_start, 'Y-m-06 23:59:59');
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');

$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

$sql_cou1 = " SELECT COUNT(*) as cou_cnt FROM {$g5['coupon_table']} WHERE co_begin_datetime = '{$co_begin_datetime}' AND co_end_datetime='{$co_end_datetime}'";
$row_cou1 = sql_fetch($sql_cou1);
$cou_cnt = $row_cou1['cou_cnt'];
if($cou_cnt == 0 && $now > $co_insert_date1 && $now < $co_insert_date2){
    $sql_cou = " SELECT * FROM {$g5['coupon_table']} WHERE co_begin_datetime = '{$first_day_pre}' AND co_end_datetime='{$last_day_pre}'";
    $result=sql_query($sql_cou);
	while ($row = sql_fetch_array($result)) {
    $sql_ins = " INSERT INTO {$g5['coupon_table']} 
                        SET wr_id = '{$row['wr_id']}', 
                            mb_id = '{$row['mb_id']}', 
                            bo_table = '{$row['bo_table']}', 
                            co_entity = '{$row['co_entity']}',
                            co_sale_num = '{$row['co_sale_num']}',
                            co_free_num = '{$row['co_free_num']}',
                            co_sent_snum = '0',
                            co_sent_fnum = '0',
                            co_created_datetime = '{$now}',                          
                            co_begin_datetime = '{$co_begin_datetime}',
                            co_end_datetime = '{$co_end_datetime}'";
                sql_query($sql_ins);
    }
}

// 3.26
// 아이디 쿠키에 한달간 저장
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

$sql_m = "SELECT mb_level FROM {$g5['member_table']} WHERE mb_id = '{$mb['mb_id']}'";
$res_m = sql_fetch($sql_m);
$mb_level = $res_m['mb_level'];

if($mb_level > 25 && $mb_level < 28){
    $url = G5_BBS_URL.'/userinfo.php';}
else { $url = G5_URL;} 

    // url 체크
    check_url_host($url, '', G5_URL, true);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    $post_check_keys = array('mb_id', 'mb_password', 'x', 'y', 'url');

    //소셜 로그인 추가
    if($is_social_login){
        $post_check_keys[] = 'provider';
    }

    $post_check_keys = run_replace('login_check_post_check_keys', $post_check_keys, $link, $is_social_login);

    foreach($_POST as $key=>$value) {
        if ($key && !in_array($key, $post_check_keys)) {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }


//소셜 로그인 추가
if(function_exists('social_login_success_after')){
    // 로그인 성공시 소셜 데이터를 기존의 데이터와 비교하여 바뀐 부분이 있으면 업데이트 합니다.
    $link = social_login_success_after($mb, $link);
    social_login_session_clear(1);
}

run_event('member_login_check', $mb, $link, $is_social_login);
 
goto_url($link);
?>
