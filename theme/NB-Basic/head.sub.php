<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

// 배열 선언
$pset = array();
$tset = array();
$tlayout = array();

// 페이지 세팅용
$phref = ($is_admin == 'super') ? $phref : ''; //관리자는 임의지정 가능
$pset = na_pid($phref);

// 페이지 아이디 부여
$page_id = $pset['pid'];

// 커뮤니티 테마 설정
$tset = na_theme('bbs', $pset['pid']);

// 홈경로
define('NT_HOME_URL', G5_URL);

// 반응형 설정
$default_css = '';
$body_class = 'responsive';
if (!G5_IS_MOBILE && $tset['no_res']) {
    define('_RESPONSIVE_', false);
    $default_css = '-no';
    $body_class = 'no-responsive';
} else {
    define('_RESPONSIVE_', true);
}

// 스타일
$body_class .= ($tset['style']) ? ' is-square' : ' is-round';
$body_class .= ($tset['line']) ? ' is-line' : '';

// 폰트셋
if (G5_IS_MOBILE) {
    $fontset = ($tset['font']) ? 'mobile/' . $tset['font'] : 'mobile/Default-15px';
} else {
    $fontset = ($tset['font']) ? $tset['font'] : 'Dotum-12px';
}

// 컬러셋
$colorset = ($tset['color']) ? $tset['color'] : 'Basic';

// CSS
$default_stylesheet = '<link rel="stylesheet" href="' . NA_URL . '/css/nariya.css" type="text/css">' . PHP_EOL;
$default_stylesheet .= '<link rel="stylesheet" href="' . G5_THEME_URL . '/css/theme.css?ver='.G5_JS_VER.'" type="text/css">' . PHP_EOL;
$default_stylesheet .= '<link rel="stylesheet" href="' . G5_THEME_URL . '/css/font/' . $fontset . '.css" type="text/css">' . PHP_EOL;
$default_stylesheet .= '<link rel="stylesheet" href="' . G5_THEME_URL . '/css/color/' . $colorset . '.css" type="text/css">';
add_stylesheet($default_stylesheet, -100);
unset($default_stylesheet);

//------------------------------------------------------------------------------------

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
} else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | " . $config['cf_title'];
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/' . G5_ADMIN_DIR . '/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko" class="<?php echo (G5_IS_MOBILE) ? 'is-mobile' : 'is-pc'; ?>">

<head>
    <meta charset="utf-8">
    <meta name="title" content="밤의제국 사이트 - .." />
    <meta name="publisher" content="밤의제국-달림정보커뮤니티 밤의제국" />
    <meta name="author" content="밤의제국-달림정보커뮤니티 밤의제국" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta name="keywords" content="밤의제국-업소정보 | bamje.com, 오피, 강남오피, 선릉오피, 강북오피, 강동오피, 강서오피, 분당오피, 송탄오피, 수원오피, 의정부오피, 안산오피, 일산오피, 
부천오피, 서산오피, 대전오피, 천안오피, 청주오피, 구미오피, 대구오피, 부산오피, 광주오피, 울산오피, 창원오피, 포항오피, 군산오피, 익산오피, 제주오피, 강원오피, 전주오피, 
오피 · 건마 · 유흥업소 · 립카페 · 핸플 · 패티쉬 · 휴게텔 · 키스방 · 안마 /추천 최신정보, bamje 밤의제국-달림정보포탈 밤의제국오피" />
    <meta name="description" content="밤의제국,달림정보포탈 밤제, 밤의제국커뮤니티, 오피, bamje, 유흥주점(풀싸롱,퍼블릭룸,룸싸롱,노래주점), 휴게텔, 건마, 안마, 핸플, 키스방, 립카페, 패티쉬, 유흥업소, 출장오피, 
출장안마, 출장건마,강남오피, 선릉오피, 강북오피, 강동오피, 강서오피, 분당오피, 송탄오피, 수원오피, 의정부오피, 안산오피, 일산오피, 부천오피, 서산오피, 대전오피, 천안오피, 
청주오피, 구미오피, 대구오피, 부산오피, 광주오피, 울산오피, 창원오피, 포항오피, 군산오피, 익산오피, 제주오피, 강원오피, 전주오피 · bamje-달림정보포탈 밤의제국오피" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=1,user-scalable=yes" />
    <?php
    if (G5_IS_MOBILE) {
        echo '<meta name="HandheldFriendly" content="true"/>' . PHP_EOL;
        echo '<meta http-equiv="ScreenOrientation" content="autoRotate:disabled"/>' . PHP_EOL;
        echo '<meta name="bzyfuzy" content="Mobile"/>' . PHP_EOL;
    } else {
        echo '<meta name="format-detection" content="telephone=no"/>' . PHP_EOL;
        echo '<meta name="bzyfuzy" content="Desktop"/>' . PHP_EOL;
        echo '<meta http-equiv="imagetoolbar" content="no"/>' . PHP_EOL;
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge"/>' . PHP_EOL;
        echo '<meta http-equiv="ScreenOrientation" content="autoRotate:disabled"/>' . PHP_EOL;
    }

    /* if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL; */
    ?>
    <meta name="google-site-verification" content="google84c593a17dec3cae" />
    <meta property="og:locale" content="ko_KR">
    <meta property="og:title" content="밤의제국 사이트 - .." />
    <meta property="og:site_name" content="밤의제국 사이트" />
    <meta property="og:author" content="밤의제국-달림정보커뮤니티 밤의제국" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/theme/NB-Basic/img/logo2.png" />
    <meta property="og:description" content="..밤의제국bamje.com-국내최다 업소정보 사이트" />
    <meta property="og:url" content="<?php echo G5_URL ?>" />
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="image_src" href="/theme/NB-Basic/img/logo2.png">
    <link rel="canonical" href="<?php echo G5_URL ?>">
    <title><?php echo $g5_head_title; ?></title>
    <link rel="stylesheet" href="<?php echo NA_URL ?>/app/bs4/css/bootstrap<?php echo $default_css ?>.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo G5_JS_URL ?>/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="icon" sizes="192x192" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png" />
    <script>
        // 자바스크립트에서 사용하는 전역변수 선언
        var g5_url = "<?php echo G5_URL ?>";
        var g5_bbs_url = "<?php echo G5_BBS_URL ?>";
        var g5_is_member = "<?php echo isset($is_member) ? $is_member : ''; ?>";
        var g5_is_admin = "<?php echo isset($is_admin) ? $is_admin : ''; ?>";
        var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
        var g5_bo_table = "<?php echo isset($bo_table) ? $bo_table : ''; ?>";
        var g5_sca = "<?php echo isset($sca) ? $sca : ''; ?>";
        var g5_editor = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor']) ? $config['cf_editor'] : ''; ?>";
        var g5_plugin_url = "<?php echo G5_PLUGIN_URL ?>";
        var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
    </script>
    <script src="<?php echo NA_URL ?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo NA_URL ?>/js/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_JS_URL ?>/placeholders.min.js"></script>
    <script src="<?php echo NA_URL ?>/app/bs4/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo NA_URL ?>/js/nariya.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_THEME_URL; ?>/js/theme.js?ver=<?php echo G5_JS_VER; ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <?php
    if (G5_IS_MOBILE)
        add_javascript('<script src="' . G5_JS_URL . '/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지

    if (!defined('G5_IS_ADMIN'))
        echo $config['cf_add_script'];
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZGDK6RNY63%22%3E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZGDK6RNY63');

</script>
</head>
<body<?php echo (isset($g5['body_script']) && $g5['body_script']) ? $g5['body_script'] . ' ' : ''; ?> class="<?php echo $body_class ?>">
    <?php
    if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
        $sr_admin_msg = '';
        if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
        else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
        else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

        echo '<div class="sr-only"><div id="hd_login_msg">' . $sr_admin_msg . get_text($member['mb_nick']) . '님 로그인 중 ';
        echo '<a href="' . G5_BBS_URL . '/logout.php">로그아웃</a></div></div>';
    }

    $is_wing = true;
    $is_index = false;
    ?>