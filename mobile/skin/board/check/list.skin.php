<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">', 0);
add_stylesheet('<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Noto+Sans+KR:wght@300;400;700&display=swap" rel="stylesheet">', 0);
add_stylesheet('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">', 0);
add_javascript('<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>', 0);
add_javascript('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>', 0);
add_stylesheet('<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">', 0);
add_javascript('<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

/*************************************************/
// 달력
$today  = date('Y-m-d'); // 오늘
$date   = !preg_match('/^[\d]{4}\-[\d]{2}\-[\d]{2}$/', $_GET['date']) ? $today : $_GET['date'];
$d      = explode('-', $date);
$_y     = $d[0];
$_m     = $d[1];
$_d     = $d[2];
$_days  = date('t', strtotime("{$_y}-{$_m}-01")); // Number of days in the given month

// qstr 재정의
$qstr = preg_replace('#(&amp;)?date=[^\&]*#', '', $qstr);
$qstr = ($qstr ? $qstr.'&amp;' : '').'date='.$date;

// 날짜 이동 정의
$timestamp = strtotime($date);
$prev_m = date('Y-m-d', strtotime("-1 month", $timestamp)); // 이전달
$prev_d = date('Y-m-d', strtotime("-1 day", $timestamp)); // 이전일
$next_d = date('Y-m-d', strtotime("+1 day", $timestamp)); // 다음일
$next_m = date('Y-m-d', strtotime("+1 month", $timestamp)); // 다음달

// 날짜 이동 링크
//$goto_prev_m    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.$qstr);
//$goto_prev_d    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.$qstr);
//$goto_today     = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.$qstr);
//$goto_next_d    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.$qstr);
//$goto_next_m    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.$qstr);
// 날짜 이동 링크 (검색 이후 이동시 검색 쿼리 제거)
$goto_prev_m    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.'date='.$prev_m);
$goto_prev_d    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.'date='.$prev_d);
$goto_today     = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.'date='.$today);
$goto_next_d    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.'date='.$next_d);
$goto_next_m    = short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.'date='.$next_m);

// list.php
include_once($board_skin_path."/list.php");
/*************************************************/

// 나의 출석 (월간)
$myc = array();
if ($is_member) {
    $foo = "select distinct(left(wr_datetime,10)) as wr_date from {$write_table} 
            where mb_id='{$member['mb_id']}' and wr_is_comment=0 and wr_reply='' and left(wr_datetime,7)='{$_y}-{$_m}' 
            order by wr_date ";
    $bar = sql_query($foo);
    for ($i=0; $tmp=sql_fetch_array($bar); $i++) {
        $myc[] = $tmp['wr_date'];
    }
}

$wr_disabled = $is_member ? '' : 'disabled';
$cm_disabled = $is_member ? '' : 'disabled';
$bo_1 = $board['bo_1'] ? explode('|', $board['bo_1']) : array(); // 자동 가입인사 문구
$bo_2 = $board['bo_2'] ? explode('|', $board['bo_2']) : array(); // 자동 환영댓글 문구

$member_profile_img = get_member_profile_img($member['mb_id']);
preg_match('% src="([^"]+)"%i', $member_profile_img, $matches);
$member_profile_src = $matches[1];

$avatar = array();
$imgdir = 'avatar';
if (is_dir($board_skin_path.'/'.$imgdir)) {
    if ($handle = opendir($board_skin_path.'/'.$imgdir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file == "." || $file == "..") continue;
            if (!preg_match('%^.*\.(gif|png|jpg|jpeg)$%i', $file)) continue;
            $avatar[] = $board_skin_url.'/'.$imgdir.'/'.$file;
        }
        closedir($handle);
    }
}
$imgtxt = $board_skin_path.'/avatar.txt';
$imgarr = file_exists($imgtxt) ? file($imgtxt) : array();
foreach ($imgarr as $img) {
    $img = trim($img);
    if ($img && substr($img, 0, 1) != '#') {
        $avatar[] = $img;
    }
}
?>

<!-- .fwSRA6OHQMjc4Com {{ -->
<div class="fwSRA6OHQMjc4Com">
<div id="calendar" class="m-10px">
    <?php
        echo '<div class="flipover">';
        echo '<h3>';
        echo ' <strong class="y_title"><b>'.$_y.'</b><span>년</span></strong> ';
        echo ' <strong class="m_title"><b>'.$_m.'</b><span>월</span></strong> ';
        echo '</h3>';
        echo '<div class="row mx-n1 goto-btn">';
        echo '<div class="col-auto px-1"><a class="btn btn-outline-secondary btn-sm prev_m" data-goto="'.$prev_m.'" href="'.$goto_prev_m.'">이전달</a></div>';
        echo '<div class="col-auto px-1"><a class="btn btn-outline-secondary btn-sm prev_d" data-goto="'.$prev_d.'" href="'.$goto_prev_d.'">이전일</a></div>';
        echo '<div class="col px-1 text-center">';
        if ($today != $date) {
            echo '<a class="btn btn-outline-secondary btn-sm today'.($date == $today ? 'active' : '').'" data-goto="'.$today.'" href="'.$goto_today.'">오늘</a>';
        }
        echo '</div>';
        echo '<div class="col-auto px-1"><a class="btn btn-outline-secondary btn-sm next_d" data-goto="'.$next_d.'" href="'.$goto_next_d.'">다음일</a></div>';
        echo '<div class="col-auto px-1"><a class="btn btn-outline-secondary btn-sm next_m" data-goto="'.$next_m.'" href="'.$goto_next_m.'">다음달</a></div>';
        echo '</div>';
        echo '</div>';

        echo '<hr class="my-2">';

        // 달력
        echo '<div class="calendar text-center">';
        echo '<div class="swiper-container">';
        echo '<div class="swiper-wrapper">';
        $_qstr = preg_replace('#(&amp;)?date=[^\&]*#', '', $qstr);
        for ($i=1; $i<=$_days; $i++) {
            $_i = sprintf('%02d', $i);
            $_date = $_y.'-'.$_m.'-'.$_i;
            $_r = date('w', strtotime($_date));
            switch ($_r) {
                case 0: $_yoil = '일'; $_cc = 'sun'; break;
                case 1: $_yoil = '월'; $_cc = 'mon'; break;
                case 2: $_yoil = '화'; $_cc = 'tue'; break;
                case 3: $_yoil = '수'; $_cc = 'wed'; break;
                case 4: $_yoil = '목'; $_cc = 'thu'; break;
                case 5: $_yoil = '금'; $_cc = 'fri'; break;
                case 6: $_yoil = '토'; $_cc = 'sat'; break;
                default: $_yoil = ''; $_cc = '';
            }
            $_href = $today < $_date
                ? ''
                : short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;'.($_qstr ? $_qstr.'&amp;' : '').'date='.$_date);
            $_to = $_date == $today ? 'to' : '';
            $_on = $_date == $date  ? 'on' : '';
            $_cc .= empty($_href) ? ' dim' : '';
            $_my = in_array($_date, $myc) ? 'myc' : ''; // 내 출석

            echo ' <span class="dts '.$_cc.' '.$_my.' swiper-slide w-auto"> ';
            if ($_href) {
                echo '<a href="'.$_href.'" class="day '.$_on.' '.$_to.'" data-date="'.$_date.'">'.$_i.'</a><em>'.$_yoil.'</em>';
                if ($_my) echo '<b>내 출석</b>';
            } else {
                echo '<i class="day '.$_on.' '.$_to.'" data-date="'.$_date.'">'.$_i.'</i><em>'.$_yoil.'</em>';
            }
            echo ' </span> ';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    ?>
</div>

<?php if ($date == $today) { ?>
<div class="prompt card mb-3 bg-light m-10px">
    <div class="card-body">
        <h3 class="sr-only"><?php echo $board['bo_subject']; ?> 작성</h3>
        <form name="flistwrite" id="flistwrite" action="<?php echo https_url(G5_BBS_DIR)."/write_update.php"; ?>" method="post" onsubmit="return flistwrite_submit(this);">
        <input type="hidden" name="w" value="">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="is_list" value="1">
        <input type="hidden" name="wr_subject" id="wr_subject" <?php echo $wr_disabled; ?> required value="<?php echo $member['mb_nick']; ?>님의 출석체크">
        <input type="hidden" name="wr_link1" value="">
        <div class="row mx-n1">
            <div class="col-auto px-1">
                <div class="pull-left rounded-circle overflow-hidden avatar" <?php if (count($avatar) > 0) { ?> data-toggle="dropdown" data-boundary="viewport" data-display="static" data-flip="false" aria-haspopup="true" aria-expanded="false"<?php } ?> id="avatar"><?php echo $member_profile_img; ?></div>
                <?php
                    echo '<div class="dropdown-menu p-1 clearfix">';
                    echo '<span class="avatar float-left m-1"><img src="'.$member_profile_src.'" alt=""></span>';
                    foreach ($avatar as $src) {
                        echo '<span class="avatar float-left m-1"><img src="'.$src.'" alt="" onerror="this.style.display=\'none\'"></span>';
                    }
                    echo '</div>';
                ?>
            </div>
            <div class="col px-1">
                <textarea name="wr_content" id="wr_content" class="form-control d-block" placeholder="출석체크" <?php echo $wr_disabled; ?> required></textarea>
                <button type="submit" class="btn btn-primary d-block mt-1 btn-sm" id="list_write_submit" <?php echo $wr_disabled; ?> accesskey="s">출석</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php } ?>

<form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="date" value="<?php echo $date ?>">
<input type="hidden" name="sw" value="">

<?php if ($rss_href || $write_href) { ?>
<ul class="<?php echo isset($view) ? 'view_is_list btn_top' : 'btn_top top btn_bo_user';?>">
    <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
    <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b03 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
    <?php if ($is_admin == 'super' || $is_auth) {  ?>
    <li>
        <button type="button" class="btn_more_opt btn_b03 btn is_list_btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
        <?php if ($is_checkbox) { ?>    
        <ul class="more_opt is_list_btn">
            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
            <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
            <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
        </ul>
        <?php } ?>
    </li>
    <?php } ?>
    <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="fix_btn write_btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
</ul>
<?php } ?>
<!-- 게시판 목록 시작 -->
<div id="bo_list">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>


    <ul class="roll m-10px">
        <?php
        // 삭제 토큰
        set_session('ss_delete_token', $del_token = uniqid(time()));

        for ($i=0; $i<count($list); $i++) {
            // 작성자 회원 아이콘
            $mb_icon = $list[$i]['mb_id'] 
                ? '<img src="'.G5_DATA_URL.'/member/'.$mb_dir.'/'.get_mb_icon_name($list[$i]['mb_id']).'.gif" alt="">' 
                : '<img src="'.G5_IMG_URL.'/no_profile.gif" alt="" width="22" height="22">';

            // 작성자 회원 프로필 이미지
            $mb_pf_img = get_member_profile_img($list[$i]['mb_id']);
            preg_match('% src="([^"]+)"%i', $mb_pf_img, $matches);
            $mb_pf_src = $matches[1];
            // 글 작성시 선택한 아바타가 있다면?
            $mb_pf_img = $list[$i]['wr_link1'] 
                ? '<img src="'.$list[$i]['wr_link1'].'" onerror="this.src=\''.$mb_pf_src.'\'">' 
                : $mb_pf_img;

            // 등수
            $list[$i]['icon_ranking'] = $list[$i]['is_notice'] || $list[$i]['num'] > 3 
                ? '' 
                : '<strong class="rank'.$list[$i]['num'].'"><b>'.$list[$i]['num'].'</b>등</strong>';

            // 공지 (해당 날짜)
            if ($list[$i]['is_notice']) {
                $list[$i]['icon_ranking'] = '<strong class="rank">공지</strong>';
            }

            // 수정, 삭제 링크
            $update_href = $delete_href = '';
            // 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
            if (($member['mb_id'] && ($member['mb_id'] === $list[$i]['mb_id'])) || $is_admin) {
                $update_href = short_url_clean(G5_BBS_URL.'/write.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$list[$i]['wr_id'].'&amp;page='.$page.'&amp;'.$qstr);
                $delete_href = G5_BBS_URL.'/delete.php?bo_table='.$bo_table.'&amp;wr_id='.$list[$i]['wr_id'].'&amp;token='.$del_token.'&amp;page='.$page.'&amp;'.urldecode($qstr);
            }
            else if (!$list[$i]['mb_id']) { // 회원이 쓴 글이 아니라면
                $update_href = G5_BBS_URL.'/password.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.'&amp;'.$qstr;
                $delete_href = G5_BBS_URL.'/password.php?w=d&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.'&amp;'.$qstr;
            }
        ?>

        <li class="roll-item p-3">
            <div class="row flex-nowrap">
                <div class="col-auto">
                    <div class="avatar rounded-circle"><?php echo $mb_pf_img; ?></div>
                </div>
                <div class="col">
                    <div class="">
                        <span class="wr_ranking"><?php if (trim($list[$i]['icon_ranking'])) echo $list[$i]['icon_ranking']; ?></span>
                        <span><?php echo $list[$i]['name'] ?></span>
                    </div>
                    <div class="wr_con">
                        <span class="ca_name"><?php if ($is_category && $list[$i]['ca_name']) { ?><?php echo ''.$list[$i]['ca_name'].''; ?><?php } ?></span>
                        <span class="wr_secret"><?php if (trim($list[$i]['icon_secret'])) echo '<i class="fa fa-lock" aria-hidden="true"></i><span class="sound_only"> 비밀글</span>'; ?></span>
                        <span class="wr_subject"><?php echo $list[$i]['subject'] ?></span>
                        <span class="wr_content"><?php echo cut_str(preg_replace("%[\r\n]+%", " ", strip_tags($list[$i]['wr_content'])), 255) ?></span>
                        <?php
                            //if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count'].']'; }
                            //if ($list[$i]['file']['count']) { echo '['.$list[$i]['file']['count'].']'; }

                            //if (isset($list[$i]['icon_file'])) echo ($list[$i]['icon_file']);
                            //if (isset($list[$i]['icon_link'])) echo ($list[$i]['icon_link']);
                            //if (isset($list[$i]['icon_new'])) echo ($list[$i]['icon_new']);
                            //if (isset($list[$i]['icon_hot'])) echo ($list[$i]['icon_hot']);
                            if (trim($list[$i]['icon_new'])) echo ' <span><i class="xi xi-new" aria-hidden="true"></i><span class="sound_only">새글</span></span> ';
                            if (trim($list[$i]['icon_hot'])) echo ' <span><i class="xi xi-heart" aria-hidden="true"></i><span class="sound_only">인기글</span></span> ';
                        ?>
                    </div>
                    <div class="wr_datetime"><?php echo date('Y.m.d. &\nb\sp; H:i', strtotime($list[$i]['wr_datetime'])); ?><?php if ($delete_href) { ?><span class="wr_del pull-right"><a href="<?php echo $delete_href; ?>" onclick="del(this.href); return false;" class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i><span class="sound_only"> 삭제</span></a></span><?php } ?></div>
                    <div class="wr_chk">
                        <?php if ($is_checkbox && false) { ?>
                        <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>

        <?php 
        } 
        ?>
    </ul>
</div>

</form>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

<div id="bo_list_total">
    <span>전체 <?php echo number_format($total_count) ?>건</span>
    <?php echo $page ?> 페이지
</div>

<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <?php echo get_board_sfl_select_options($sfl); ?>
    </select>
    <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력하세요" required id="stx" class="sch_input" size="15" maxlength="20">
    <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i> <span class="sound_only">검색</span></button>
    </form>
</fieldset>


<script>
    var calendar = new Swiper('#calendar .swiper-container', {
        slidesPerView: 'auto',
        freeMode: true,
        grabCursor: true,
        centeredSlides: true,
    });
    var focus = $('#calendar .calendar .swiper-slide .day.on').parent().index() || 0;
    calendar.slideTo(focus, 100);
</script>

<script>
$(document).on('click', '#avatar + .dropdown-menu .avatar', function (e) {
    var $this = $(this),
        $that = $('#avatar img'),
        $form = $that.closest('form'),
        _src = $this.find('img').attr('src');

    $that.attr('src', _src);
    $form.find('[name="wr_link1"]').val($this.index() > 0 ? _src : '');
    $form.find('[name="wr_content"]').focus();
});
</script>

<script>
function flistwrite_submit(f)
{
    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    f.wr_content.value = f.wr_content.value.replace(pattern, "");
    if (!f.wr_content.value)
    {
        alert("출석체크를 입력하여 주십시오.");
        return false;
    }

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (typeof(f.bo_table) == "undefined") {
        return;
    }
    var bo_table = f.bo_table.value;
    var token = get_write_token(bo_table);
    var $f = $(f);
    if(typeof f.token === "undefined")
        $f.prepend('<input type="hidden" name="token" value="">');
    $f.find("input[name=token]").val(token);

    document.getElementById("list_write_submit").disabled = "disabled";
    return true;
}

function flistcomment_submit(f)
{
    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    f.wr_content.value = f.wr_content.value.replace(pattern, "");
    if (!f.wr_content.value)
    {
        alert("환영댓글을 입력하여 주십시오.");
        return false;
    }

    set_comment_token(f);
    document.getElementById("list_comment_submit").disabled = "disabled";
    return true;
}
</script>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- 게시판 목록 끝 -->
</div>
<!-- }} .fwSRA6OHQMjc4Com -->
