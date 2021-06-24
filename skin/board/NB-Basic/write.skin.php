<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// <!-- hulan nemsen 제목 색상 변경 -->
add_stylesheet('<link rel="stylesheet" href="' . G5_PLUGIN_URL . '/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.css" rel="stylesheet" />', 50);
add_stylesheet('<link rel="stylesheet" href="' . G5_PLUGIN_URL . '/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/style.css" rel="stylesheet" />', 51);
//  /////////////////////////////////////////////////////////////// -->

// hulan nemsen 공지글 레벨 게시판에 따라 /////////////////////////////////////////
if ($bo_table == "free" || $gr_id == "review" || $bo_table == "event") {
    if (($is_admin || $board['bo_admin'] == $member['mb_id'] || $group['gr_admin'] == $member['mb_id']) && $w != 'r') {
        $is_notice = true;
        $is_eventcheck = true;
        $is_best = true;
        if ($w == 'u') {
            // 답변 수정시 공지 체크 없음
            if ($write['wr_reply']) {
                $is_notice = false;
                $is_eventcheck = false;
                $is_best = false;
            } else {
                if (in_array((int)$wr_id, $notice_array)) {
                    $notice_checked = 'checked';
                }
                if (in_array((int)$wr_id, $event_array)) {
                    $event_checked = 'checked';
                }
                if (in_array((int)$wr_id, $best_array)) {
                    $best_checked = 'checked';
                }
                if (in_array((int)$wr_id, $coupon_array)) {
                    $coupon_checked = 'checked';
                }
            }
        }
    }
}
$is_select = "";
if ($notice_checked == 'checked')
    $is_select = "selected";
if ($event_checked == 'checked')
    $is_select = "selected";
if ($coupon_checked == 'checked')
    $is_select = "selected";

// ////////////////////////////////////////////////////////

/////////////////////////////hulan///////////////////////
// hulan nemsen 게시판 하루 글등록수 제한하기 
// 하루 글제한수 $post_limit = 1;
if ($board['bo_9'] && $w != 'u' && !$is_admin && $member['mb_level'] != 26 && $member['mb_level'] != 27 && $bo_table != "greeting" && $bo_table != "twitter") { //글수정이 아니면 작동
    // 오늘 체크
    $sql_today = na_sql_term('today', 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)
    if ($is_member) { // 회원이면 mb_id로 체크
        $row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = '0' $sql_today ");
    } else { // 비회원이면 ip로 체크
        $row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '0' $sql_today ");
    }
    if ($row['cnt'] >= $board['bo_9']) {
        alert('본 게시판은 하루에 글을 ' . $board['bo_9'] . '개까지만 등록할 수 있습니다.');
    }
}
//////////////////////////////////////////////////////////////////////////////

if ($gr_id == "review") {
    $gr_limit = "1"; // 그룹 제한 글 수
    $wr_sum = post_today_count("review", $member['mb_id']);
    if ($w != 'u') {
        if (!$is_admin && $wr_sum >= $gr_limit && $member['mb_level'] != 26 && $member['mb_level'] != 27) {
            alert("후기글은 하루에 {$gr_limit}회 만 등록할 수 있습니다. ");
        }
    }
}


///////////////////////////////////////////////////////////////////

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css" media="screen">', 0);


// hulan nemsen 여성회원 아님 글 쓰기 불가///////////////////////////////////////////////

if ($bo_table == "woman") {
    if ($member['mb_id'] && !$is_admin) {
        $res = sql_fetch("select mb_1 from " . $g5['member_table'] . " where mb_id = '" . $member['mb_id'] . "' ");
        if ($res['mb_1'] != '여') {
            alert("여성회원만 원글 쓰기 가능합니다!!");
        }
    }
}


// nurka nemsen  Write only one post

if ($bo_table == "greeting") {
    if ($member['mb_id'] && !$is_admin) {
        $res = sql_fetch("select mb_id from " . $g5['write_prefix'] . $bo_table . " where mb_id = '" . $member['mb_id'] . "' and wr_is_comment = '0'");
        if ($res['mb_id'] != '') {
            alert("가입인사를 한번만 할 수 있습니다!");
        }
    }
}

if ($bo_table == "twitter") {
    if ($member['mb_id'] && !$is_admin) {
        $res = sql_fetch("select mb_id from " . $g5['write_prefix'] . $bo_table . " where mb_id = '" . $member['mb_id'] . "' and wr_is_comment = '0'");
        if ($res['mb_id'] != '') {
            alert("트위터인증 게시판은 한번만 글 작성할 수 있습니다.");
        }
    }
}

// Clip Modal
na_script('clip');



// 임시 저장된 글 기능 : AutoSave Modal
if ($is_member)
    na_script('autosave');

?>

<!-- <style>
	ul.my-table {
  display: table;
  width: 100%;
  text-align: center;
}

ul.my-table > li {
  display: table-cell;
}
</style> -->
<script src="<?php echo $board_skin_url ?>/iColorPicker.js" type="text/javascript"></script>
<section id="bo_w" class="mb-4 f-de font-weight-normal">
    <h2 class="sr-only"><?php echo $g5['title'] ?></h2>


    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">

        <?php
        $option = '';
        $option_hidden = '';
        if ($is_notice || $is_html || $is_secret || $is_mail) {
            $option_start = PHP_EOL . '<div class="custom-control custom-checkbox custom-control-inline">' . PHP_EOL;
            $option_end = PHP_EOL . '</div>' . PHP_EOL;

            if ($is_html) {
                if ($is_dhtml_editor) {
                    $option_hidden .= '<input type="hidden" value="html1" name="html">';
                } else {
                    $option .= $option_start;
                    $option .= '<input type="checkbox" name="html" value="' . $html_value . '" id="html" onclick="html_auto_br(this);" class="custom-control-input" ' . $html_checked . '>';
                    $option .= '<label class="custom-control-label" for="html"><span>HTML</span></label>';
                    $option .= $option_end;
                }
            }

            if ($is_notice) {
                $option .= $option_start;
                $option .= '<input type="checkbox" name="notice" value="1" id="notice" class="custom-control-input" ' . $notice_checked . '>';
                $option .= '<label class="custom-control-label" for="notice"><span>공지</span></label>';
                $option .= $option_end;
            }

            if ($is_eventcheck) {
                $option .= $option_start;
                $option .= '<input type="checkbox" name="event" value="1" id="event" class="custom-control-input" ' . $event_checked . '>';
                $option .= '<label class="custom-control-label" for="event"><span>이벤트</span></label>';
                $option .= $option_end;
            }
            if ($is_best) {
                $option .= $option_start;
                $option .= '<input type="checkbox" name="best" value="1" id="best" class="custom-control-input" ' . $best_checked . '>';
                $option .= '<label class="custom-control-label" for="best"><span>베스트</span></label>';
                $option .= $option_end;
            }
            if ($is_coupon) {
                $option .= $option_start;
                $option .= '<input type="checkbox" name="coupon" value="1" id="coupon" class="custom-control-input" ' . $coupon_checked . '>';
                $option .= '<label class="custom-control-label" for="coupon"><span>쿠폰</span></label>';
                $option .= $option_end;
            }

            if ($is_secret) {
                if ($is_admin || $is_secret == 1) {
                    $option .= $option_start;
                    $option .= '<input type="checkbox" name="secret" value="secret" id="secret" class="custom-control-input" ' . $secret_checked . '>';
                    $option .= '<label class="custom-control-label" for="secret"><span>비밀</span></label>';
                    $option .= $option_end;
                } else {
                    $option_hidden .= '<input type="hidden" name="secret" value="secret">';
                }
            }

            // 게시판 플러그인 사용시
            // if (IS_NA_BBS && $is_notice) {
            // 	$as_type_checked = ($write['as_type'] == "1") ? ' checked' : '';
            // 	$option .= $option_start;
            // 	$option .= '<input type="checkbox" name="as_type" value="1" id="as_type" class="custom-control-input" ' . $as_type_checked . '>';
            // 	$option .= '<label class="custom-control-label" for="as_type"><span>메인</span></label>';
            // 	$option .= $option_end;
            // }

            if ($is_mail) {
                $option .= $option_start;
                $option .= '<input type="checkbox" name="mail" value="mail" id="mail" class="custom-control-input" ' . $recv_email_checked . '>';
                $option .= '<label class="custom-control-label" for="mail"><span>답변메일받기</span></label>';
                $option .= $option_end;
            }
        }

        echo $option_hidden;
        ?>
        <?php if (G5_IS_MOBILE) { ?>
            <ul class="mb-3 list-group">
                <li class=" list-group item border-top-0">
                    <div class="na-table d-table w-100">
                        <div class="d-table-row">
                            <div class="pl-3 text-left d-table-cell nw-8">
                                <h5 class="font-weight-bold en">
                                    <?php echo str_replace($board['bo_subject'], '', $g5['title']) ?></h5>
                            </div>
                            <div class="pb-3 pr-3 text-left d-table-cell nw-auto">
                                <?php if ($is_member) { ?>
                                    <button type="button" id="btn_autosave" data-toggle="modal" data-target="#saveModal" class="btn btn-basic" title="임시저장 글 열기" style="background-color: #e6dcc1; float:right; width: 200px;">
                                        <p style="font-size: 10px;">임시저장 글 열기<i class="fa fa-repeat" aria-hidden="true"></i>
                                            <span class="sr-only">임시저장글</span>
                                            (<span id="autosave_count" class="orangered"><?php echo $autosave_count; ?></span>)
                                        </p>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php if ($is_name) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="wr_name">이름<strong class="sr-only">필수</strong></label>
                            <div class="col-md-4">
                                <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="form-control required" maxlength="20">
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($is_password) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="wr_password">비밀번호<strong class="sr-only">필수</strong></label>
                            <div class="col-md-4">
                                <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="form-control <?php echo $password_required ?>" maxlength="20">
                            </div>
                        </div>
                    </li>
                <?php } ?>
                <!-- hulan nemsen bichver zasah hesegt utasnii dugaar oruulah  level26 hesegt -->

                <?php if ($gr_id == 'attendance' && $w == 'u' && !$is_admin) {
                    if ($is_category) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="$write['ca_name']">* 지역</label>
                                <div class="col-md-8 col-form-label" style="font-weight: 100;">
                                    <?php echo $write['ca_name'] . " &emsp; (지역과 업소명은 제휴신청때 작성된 정보가 자동입력됩니다. 변경시 제휴문의에 글 남기시거나 관리자에게 쪽지주세요.)" ?>
                                    <input type='hidden' name='ca_name' value='<?php echo $write['ca_name'] ?>'>
                                </div>
                            </div>
                        </li>
                    <?php }  ?>

                    <?php if ($is_address) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="$write['wr_3']">* 세부 지역</label>
                                <div class="col-md-8 col-form-label" style="font-weight: 100;">
                                    <?php echo $member['mb_addr2'] ?>&emsp;
                                    <a href="<?php echo G5_URL ?>/bbs/member_confirm.php?url=register_form.php" target="_blank" style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none">
                                        <i class="fa fa-map"></i><span>세부지역 변경</span></a>
                                    <?php echo "&emsp;  ※ 배너에 출력되는 주소 / 수정은 개인정보수정에서 가능 ( ex:서울 강남역 2번출구 )" ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($is_phone) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="wr_2">* 전화 번호</label>
                                <div class="col-md-7 col-form-label" style="font-weight: 100;">
                                    <?php echo $member['mb_hp'] ?>&emsp;
                                    <a onclick="window.open('<?php echo G5_URL ?>/bbs/member_hp_change.php?mb_id=<?php echo $member['mb_id'] ?>','전화번호 변경요청','width=450,height=300,scrollbars=no,padding=0, margin=0, top=300,left=800');" style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none; cursor: pointer;">
                                        <font style="vertical-align: inherit;">전화번호 변경요청</font>
                                    </a>
                                    <?php echo " &emsp;※ 전화번호는 운영자가 확인 후 변경처리됩니다." ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($is_comname) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="wr_4">* 업소명</label>
                                <div class="col-md-7">
                                    <?php echo $member['mb_name'] ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                <?php }
                ?>
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <?php if ($is_email) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="wr_email">E-mail</label>
                            <div class="col-md-7">
                                <input type="text" name="wr_email" id="wr_email" value="<?php echo $email ?>" class="form-control email" maxlength="100">
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($is_homepage) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="wr_homepage">홈페이지</label>
                            <div class="col-md-7">
                                <input type="text" name="wr_homepage" id="wr_homepage" value="<?php echo $homepage ?>" class="form-control">
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if (
                    $is_admin ||
                    (
                        (
                            ($gr_id == 'attendance'  &&  $w != 'u' && $member['mb_7'] != $bo_table) ||
                            (
                                ($member['mb_7'] && $member['mb_6'] == $bo_table) &&
                                $w != 'u'))) || ($bo_table == "free" || $bo_table == "event" || $bo_table == "ucc" || $board['gr_id'] == "review" || $bo_table == "woman" || $bo_table == "work_board")
                ) { ?>
                    <?php if ($is_category) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label">분류<strong class="sr-only">필수</strong></label>
                                <div class="col-md-4">
                                    <select name="ca_name" id="ca_name" required class="custom-select" <?php if ($member['mb_7'] && $member['mb_6'] == $bo_table) echo "readonly" ?>>
                                        <option value="">선택하세요</option>
                                        <?php echo $category_option;
                                        if ($is_admin) {
                                            echo "
                                <option value='공지' $is_select>공지</option>
                                <option value='이벤트진행' $is_select>이벤트진행</option>
                                <option value='이벤트결과' $is_select>이벤트결과</option>
                                ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>

                <!-- hulan nemsen review board write post 출근부 게시판에 글 있는 업소명 후기 선택에 보이기 -->
               <!--  <?php if ($board['gr_id'] == "review" && ($w == '' || $w == 'u')) {
                    $scount = strlen($bo_table) - 2;     
                    $bo_tablef =  substr($bo_table, 0, $scount);
                    $hwrite_table = $g5['write_prefix'] . $bo_tablef . "at";
                    $sql = sql_query("select mb_name from  {$hwrite_table} a, {$g5['member_table']} b where a.mb_id = b.mb_id and a.wr_is_comment = 0 order by mb_name ASC", false);
                ?>
                    
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="wr_5">매니저 명</label>
                            <div class="col-md-7">
                                <input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" required class="form-control required">
                            </div>
                        </div>
                    </li>


                <?php } ?> -->
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->


                <?php if ($option) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-sm-10">
                                <p class="float-left pt-1 pb-0 form-control-plaintext">
                                    <?php echo $option ?>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                <script>
                    // notice
                </script>


                <?php if ($member['mb_level'] >= 13) { ?>
                    <li class="list-group-item">

                        <div class="mb-0 form-group row">

                            <div class="na-table d-table w-100">
                                <div class="d-table-row">
                                    <div class="text-left d-table-cell nw-8">
                                        <label class="col-md-2 col-form-label" for="wr_1">제목컬러<strong class="sound_only">필수</strong></label>
                                    </div>
                                    <div class="text-left d-table-cell nw-auto">
                                        <input id="color1" class="iColorPicker" type="text" name="wr_1" style="width:60px;color:#fff; text-align:center;" onChange="wr_subject.style.color=this.style.backgroundColor;" value="<?php if ($write['wr_1']) {
                                                                                                                                                                                                                                    echo $write['wr_1'];
                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                    echo "#222";
                                                                                                                                                                                                                                } ?>" />
                                    </div>
                                </div>
                            </div>
                            <!-- <input type="hidden" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input required" size="30" maxlength="255"> -->

                        </div>
                    </li>
                <?php } ?>
                <li class="list-group-item">
                    <div class="mb-0 form-group row">
                        <label class="col-md-2 col-form-label" for="wr_subject">제목<strong class="sr-only">필수</strong></label>
                        <div style="display: flex; align-items: center;" class="col-md-10">
                            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control required" maxlength="255">
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <span class="sr-only">내용<strong>필수</strong></span>
                    <?php if ($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <p id="char_count_desc" class="f-sm text-muted">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자
                            이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>

                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출
                    ?>

                    <?php if ($is_dhtml_editor) { ?>
                        <style>
                            #wr_content {
                                display: none;
                            }
                        </style>
                    <?php } else { ?>
                        <script>
                            $("#wr_content").hide().addClass("form-control").show();
                        </script>
                    <?php } ?>

                    <div class="text-center en">
                        <div class="btn-group btn-group-lg" role="group">
                            <!-- <button type="button" class="btn btn-basic" title="이모티콘" onclick="na_clip('emo', '<?php echo $is_dhtml_editor ?>');">
							<i class="far fa-smile" aria-hidden="true"></i>
							<span class="sr-only">이모티콘</span>
						</button> -->
                            <!-- <button type="button" class="btn btn-basic" title="폰트어썸 아이콘" onclick="na_clip('fa', '<?php echo $is_dhtml_editor ?>');">
							<i class="fab fa-font-awesome" aria-hidden="true"></i>
							<span class="sr-only">폰트어썸 아이콘</span>
						</button>
						<button type="button" class="btn btn-basic" title="동영상" onclick="na_clip('video', '<?php echo $is_dhtml_editor ?>');">
							<i class="fab fa-youtube" aria-hidden="true"></i>
							<span class="sr-only">동영상</span>
						</button> -->
                            <!-- <button type="button" class="btn btn-basic" title="지도" onclick="na_clip('map', '<?php echo $is_dhtml_editor ?>');">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							<span class="sr-only">지도</span>
						</button> -->
                            <!--<?php if ($is_member) { // 임시 저장된 글 기능
                                ?>
							<button type="button" id="btn_autosave" data-toggle="modal" data-target="#saveModal" class="btn btn-basic" title="임시 저장된 글 목록 열기">
								<i class="fa fa-repeat" aria-hidden="true"></i>
								<span class="sr-only">임시저장글</span>
								<span id="autosave_count" class="orangered"><?php echo $autosave_count; ?></span>
							</button>
						<?php } ?>-->
                        </div>
                    </div>
                </li>

                <?php if (isset($boset['na_tag']) && $boset['na_tag']) { //태그
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="as_tag">태그</label>
                            <div class="col-md-10">
                                <input type="text" name="as_tag" id="as_tag" value="<?php echo $write['as_tag']; ?>" class="form-control" placeholder="콤마(,)로 구분하여 복수 태그 등록 가능">
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php //관련링크
                if ($is_link) {
                    $link_holder = (isset($boset['na_video_link']) && $boset['na_video_link']) ? '유튜브 등 동영상 공유주소 등록시 자동 출력' : 'https://...';
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">관련 링크</label>
                            <div class="col-md-10">
                                <?php for ($i = 1; $i <= G5_LINK_COUNT; $i++) { ?>
                                    <div class="<?php echo ($i > 1) ? 'mt-2' : 'mt-0'; ?>">
                                        <input type="text" name="wr_link<?php echo $i ?>" value="<?php echo $write['wr_link' . $i]; ?>" id="wr_link<?php echo $i ?>" class="form-control" placeholder="<?php echo $link_holder ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($is_file && (int)$board['bo_upload_count'] > 0) { // 첨부파일
                ?>
                    <li class="list-group-item">
                        <?php
                        na_script('fileinput');

                        // 칼럼
                        $file_col = ($is_file_content) ? 'col-sm-6' : 'col';

                        $file_script = "";
                        $file_length = -1;
                        // 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
                        if ($w == "u") {
                            for ($i = 0; $i < $file['count']; $i++) {
                                if ($file[$i]['source']) {
                                    $file_script .= "add_file('";
                                    if ($is_file_content) {
                                        $file_script .= '<div class="' . $file_col . ' mt-2 px-2"><input type="text" name="bf_content[]" value="' . addslashes(get_text($file[$i]['bf_content'])) . '" class="form-control" placeholder="파일 내용 입력"></div>';
                                    }

                                    $file_script .= '<div class="px-2 mt-2 col-12 f-de"><div class="custom-control custom-checkbox">';
                                    $file_script .= '<input type="checkbox" name="bf_file_del[' . $i . ']" value="1" id="bf_file_del' . $i . '" class="custom-control-input">';
                                    $file_script .= '<label class="custom-control-label" for="bf_file_del' . $i . '"><span>' . $file[$i]['source'] . '(' . $file[$i]['size'] . ') 파일 삭제 - <a href="' . $file[$i]['href'] . '">열기</a></span></label>';
                                    $file_script .= '</div></div>';
                                    $file_script .= "');\n";
                                } else {
                                    $file_script .= "add_file('');\n";
                                }
                            }
                            $file_length = $file['count'] - 1;
                        }

                        if ($file_length < 0) {
                            $file_script .= "add_file('');\n";
                            $file_length = 0;
                        }
                        ?>
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">첨부 파일</label>
                            <div class="col-md-10">
                                <button type="button" onclick="add_file();" class="btn btn-basic">
                                    <span class="text-muted"><i class="fa fa-plus"></i> 파일 추가</span>
                                </button>
                                <button type="button" onclick="del_file();" class="btn btn-basic">
                                    <span class="text-muted"><i class="fa fa-times"></i> 파일 삭제</span>
                                </button>

                                <table id="variableFiles" class="w-100"></table>

                                <script>
                                    var flen = 0;

                                    function add_file(delete_code) {

                                        var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
                                        if (upload_count && flen >= upload_count) {
                                            alert("이 게시판은 " + upload_count + "개 까지만 파일 업로드가 가능합니다.");
                                            return;
                                        }

                                        var objTbl;
                                        var objNum;
                                        var objRow;
                                        var objCell;
                                        var objContent;
                                        if (document.getElementById)
                                            objTbl = document.getElementById("variableFiles");
                                        else
                                            objTbl = document.all["variableFiles"];

                                        objNum = objTbl.rows.length;
                                        objRow = objTbl.insertRow(objNum);
                                        objCell = objRow.insertCell(0);

                                        objContent = '<div class="row mx-n2">';
                                        objContent +=
                                            '<div class="<?php echo $file_col ?> mt-2 px-2"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text" for="fwriteFile' +
                                            objNum + '">파일 ' + objNum + '</label></div>';
                                        objContent +=
                                            '<div class="custom-file"><input type="file" name="bf_file[]" class="custom-file-input" title="파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" id="fwriteFile' +
                                            objNum + '">';
                                        objContent +=
                                            '<label class="custom-file-label" for="imgboxFile" data-browse="선택"></label></div></div></div>';
                                        if (delete_code) {
                                            objContent += delete_code;
                                        } else {
                                            <?php if ($is_file_content) { ?>
                                                objContent +=
                                                    '<div class="<?php echo $file_col ?> mt-2 px-2"><input type="text" name="bf_content[]" class="form-control" placeholder="파일 내용 입력"></div>';
                                            <?php } ?>
                                            ;
                                        }
                                        objContent += "</div>";

                                        objCell.innerHTML = objContent;

                                        bsCustomFileInput.init();

                                        flen++;
                                    }

                                    <?php echo $file_script; //수정시에 필요한 스크립트
                                    ?>

                                    function del_file() {
                                        // file_length 이하로는 필드가 삭제되지 않아야 합니다.
                                        var file_length = <?php echo (int)$file_length; ?>;
                                        var objTbl = document.getElementById("variableFiles");
                                        if (objTbl.rows.length - 1 > file_length) {
                                            objTbl.deleteRow(objTbl.rows.length - 1);
                                            flen--;
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </li>
                    <?php if (IS_NA_BBS) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label">첨부 사진</label>
                                <div class="col-sm-10">
                                    <p class="float-left pt-1 pb-0 form-control-plaintext">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img" name="as_img" value="0" <?php echo (!$write['as_img']) ? ' checked' : ''; ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img"><span>상단 위치</span></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img1" name="as_img" value="1" <?php echo get_checked('1', $write['as_img']) ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img1"><span>하단 위치</span></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img2" name="as_img" value="2" <?php echo get_checked('2', $write['as_img']) ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img2"><span>본문 삽입</span></label>
                                    </div>
                                    </p>
                                    <p class="pb-0 form-control-plaintext f-de text-muted">
                                        본문 삽입시 {이미지:0}, {이미지:1} 형태로 글내용에 입력시 지정 첨부사진이 출력됩니다.
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>

                <?php if ($captcha_html) { //자동등록방지
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">자동등록방지</label>
                            <div class="col-md-10 f-small">
                                <?php echo $captcha_html; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <ul class="mb-3 list-group">
                <li class="list-group-item border-top-0">
                    <div class="mb-0 form-group row">
                        <label class="col-md-2 col-form-label" for="wr_password"><?php echo str_replace($board['bo_subject'], '', $g5['title']) ?></label>
                        <!-- <h5 class="font-weight-bold en"><?php echo str_replace($board['bo_subject'], '', $g5['title']) ?></h5> -->
                        <div class="col-md-10">
                            <?php if ($is_member) { // 임시 저장된 글 기능
                            ?>
                                <button type="button" id="btn_autosave" data-toggle="modal" data-target="#saveModal" class="btn btn-basic" title="" style="background-color: #e6dcc1; float:right; width: 150px;">
                                    <h6>임시저장 글 열기<i class="fa fa-repeat" aria-hidden="true"></i>
                                        <span class="sr-only">임시저장글</span>
                                        (<span id="autosave_count" class="orangered"><?php echo $autosave_count; ?></span>)
                                    </h6>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </li>
                <!--  <?php if ($is_name) { ?>
            <li class="list-group-item">
                <div class="mb-0 form-group row">
                    <label class="col-md-2 col-form-label" for="wr_name">이름<strong class="sr-only">필수</strong></label>
                    <div class="col-md-4">
                        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required
                            class="form-control required" maxlength="20">
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php if ($is_password) { ?>
            <li class="list-group-item">
                <div class="mb-0 form-group row">
                    <label class="col-md-2 col-form-label" for="wr_password">비밀번호<strong
                            class="sr-only">필수</strong></label>
                    <div class="col-md-4">
                        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?>
                            class="form-control <?php echo $password_required ?>" maxlength="20">
                    </div>
                </div>
            </li>
            <?php } ?> -->
                <!-- hulan nemsen bichver zasah hesegt utasnii dugaar oruulah  level26 hesegt -->

                <?php if ($gr_id == 'attendance' && $w == 'u' && !$is_admin) {
                    if ($is_category) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="$write['ca_name']">* 지역</label>
                                <div class="col-md-8 col-form-label" style="font-weight: 100;">
                                    <?php echo $write['ca_name'] . " &emsp; (지역과 업소명은 제휴신청때 작성된 정보가 자동입력됩니다. 변경시 제휴문의에 글 남기시거나 관리자에게 쪽지주세요.)" ?>
                                    <input type='hidden' name='ca_name' value='<?php echo $write['ca_name'] ?>'>
                                </div>
                            </div>
                        </li>
                    <?php }  ?>

                    <?php if ($is_address) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="$write['wr_3']">* 세부 지역</label>
                                <div class="col-md-8 col-form-label" style="font-weight: 100;">
                                    <?php echo $member['mb_addr2'] ?>&emsp;
                                    <a href="<?php echo G5_URL ?>/bbs/member_confirm.php?url=register_form.php" target="_blank" style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none">
                                        <i class="fa fa-map"></i><span>세부지역 변경</span></a>
                                    <?php echo "&emsp;  ※ 배너에 출력되는 주소 / 수정은 개인정보수정에서 가능 ( ex:서울 강남역 2번출구 )" ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($is_phone) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="wr_2">* 전화 번호</label>
                                <div class="col-md-7 col-form-label" style="font-weight: 100;">
                                    <?php echo $member['mb_hp'] ?>&emsp;
                                    <a onclick="window.open('<?php echo G5_URL ?>/bbs/member_hp_change.php?mb_id=<?php echo $member['mb_id'] ?>','전화번호 변경요청','width=500,height=300,scrollbars=no,padding=0, margin=0, top=300,left=800');" style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none; cursor: pointer;">
                                        <font style="vertical-align: inherit;">전화번호 변경요청</font>
                                    </a>
                                    <?php echo " &emsp;※ 전화번호는 운영자가 확인 후 변경처리됩니다." ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($is_comname) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="wr_4">* 업소명</label>
                                <div class="col-md-7">
                                    <?php echo $member['mb_name'] ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                <?php }
                ?>
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- <?php if ($is_email) { ?>
            <li class="list-group-item">
                <div class="mb-0 form-group row">
                    <label class="col-md-2 col-form-label" for="wr_email">E-mail</label>
                    <div class="col-md-7">
                        <input type="text" name="wr_email" id="wr_email" value="<?php echo $email ?>"
                            class="form-control email" maxlength="100">
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php if ($is_homepage) { ?>
            <li class="list-group-item">
                <div class="mb-0 form-group row">
                    <label class="col-md-2 col-form-label" for="wr_homepage">홈페이지</label>
                    <div class="col-md-7">
                        <input type="text" name="wr_homepage" id="wr_homepage" value="<?php echo $homepage ?>"
                            class="form-control">
                    </div>
                </div>
            </li>
            <?php } ?> -->

                <?php if (
                    $is_admin ||
                    (
                        (
                            ($gr_id == 'attendance'  &&  $w != 'u' && $member['mb_7'] != $bo_table) ||
                            (
                                ($member['mb_7'] && $member['mb_6'] == $bo_table) &&
                                $w != 'u'))) || ($bo_table == "free" || $bo_table == "event" || $bo_table == "ucc" || $bo_table == "woman" || $bo_table == "job" || $bo_table == "work_board" || $board['gr_id'] == "review")
                ) { ?>
                    <?php if ($is_category) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label">분류<strong class="sr-only">필수</strong></label>
                                <div class="col-md-4">
                                    <select name="ca_name" id="ca_name" required class="custom-select" <?php if ($member['mb_7'] && $member['mb_6'] == $bo_table) echo "disabled" ?>>
                                        <option value="">선택하세요</option>
                                        <?php echo $category_option;

                                        if ($is_admin) {


                                            echo "
                                <option value='공지' $is_select>공지</option>
                                <option value='이벤트진행'  $is_select>이벤트진행</option>
                                <option value='이벤트결과' $is_select>이벤트결과</option>
                                ";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>

                <!-- hulan nemsen review board write post 출근부 게시판에 글 있는 업소명 후기 선택에 보이기 -->
                <?php if ($board['gr_id'] == "review") {
                    $scount = strlen($bo_table) - 2;      // temdegt tooloh
                    $bo_tablef =  substr($bo_table, 0, $scount);
                    $hwrite_table = $g5['write_prefix'] . $bo_tablef . "at";
                    $sql = sql_query("select mb_name from  {$hwrite_table} a, {$g5['member_table']} b where a.mb_id = b.mb_id and a.wr_is_comment = 0 order by mb_name ASC", false);
                ?>
                    <?php if ($is_category) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label">업소명<strong class="sr-only">필수</strong></label>
                                <div class="col-md-4">
                                <?php if($w == '') { ?> 
                                <select name="wr_7" id="wr_7" required class="custom-select">
                                        <option value="">선택하세요</option>
                                        <?php while ($res = sql_fetch_array($sql)) { ?>
                                            <!-- <option value="<?php echo $write['wr_4']; ?>"><?php echo $res['mb_name']; ?></option>  -->

                                            <option value=<?php echo $res['mb_name']; ?> <?php if ($write['wr_4'] == $res['mb_name'] || $nameddd == $res['mb_name']) echo " selected "; ?>>
                                                <?php echo $res['mb_name']; ?></option>
                                        <?php }
                                        if ($is_admin) {
                                            echo "
                                <option value='공지' $is_select>공지</option>
                                <option value='이벤트진행' $is_select>이벤트진행</option>
                                <option value='이벤트결과' $is_select>이벤트결과</option>
                                ";
                                        }
                                        ?>
                                    </select>
                                <?php } else { ?>
                                        <input type="text" name="wr_7" value="<?php echo $write['wr_7'] ?>" readonly required class="form-control required">
                                <?php } ?>
                                    
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <!-- <?php if ($board['gr_id'] != "review") { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label" for="wr_5">매니저 명</label>
                                <div class="col-md-7">
                                    <input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" required class="form-control required">
                                </div>
                            </div>
                        </li>
                    <?php } ?> -->

                <?php } ?>
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

                <?php if ($option) { ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-sm-10">
                                <p class="float-left pt-1 pb-0 form-control-plaintext">
                                    <?php echo $option ?>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($member['mb_level'] >= 13) { ?>
                    <li class="list-group-item">

                        <div class="mb-0 form-group row">

                            <label class="col-md-2 col-form-label" for="wr_1">제목컬러<strong class="sound_only">필수</strong></label>
                            <div class="col-md-10">
                                <input id="color1" class="iColorPicker" type="text" name="wr_1" style="width:55px;color:#fff; text-align:center;" 
                                onChange="wr_subject.style.color=this.style.backgroundColor;" value="<?php if ($write['wr_1']) {
                                        echo $write['wr_1'];
                                    } else {
                                        echo "#222";
                                    } ?>" />
                            </div>
                            <!-- <input type="hidden" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input required" size="30" maxlength="255"> -->
                        </div>
                    </li>
                <?php } ?>
                <li class="list-group-item">
                    <div class="mb-0 form-group row">
                        <label class="col-md-2 col-form-label" for="wr_subject">제목<strong class="sr-only">필수</strong></label>
                        <div style="display: flex; align-items: center;" class="col-md-10">
                            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control required" maxlength="255">
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <span class="sr-only">내용<strong>필수</strong></span>
                    <?php if ($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <p id="char_count_desc" class="f-sm text-muted">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자
                            이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>

                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출
                    ?>

                    <?php if ($is_dhtml_editor) { ?>
                        <style>
                            #wr_content {
                                display: none;
                            }
                        </style>
                    <?php } else { ?>
                        <script>
                            $("#wr_content").hide().addClass("form-control").show();
                        </script>
                    <?php } ?>

                    <div class="text-center en">
                        <div class="btn-group btn-group-lg" role="group">
                            <!-- <button type="button" class="btn btn-basic" title="이모티콘" onclick="na_clip('emo', '<?php echo $is_dhtml_editor ?>');">
							<i class="far fa-smile" aria-hidden="true"></i>
							<span class="sr-only">이모티콘</span>
						</button> -->
                            <!-- <button type="button" class="btn btn-basic" title="폰트어썸 아이콘" onclick="na_clip('fa', '<?php echo $is_dhtml_editor ?>');">
							<i class="fab fa-font-awesome" aria-hidden="true"></i>
							<span class="sr-only">폰트어썸 아이콘</span>
						</button>
						<button type="button" class="btn btn-basic" title="동영상" onclick="na_clip('video', '<?php echo $is_dhtml_editor ?>');">
							<i class="fab fa-youtube" aria-hidden="true"></i>
							<span class="sr-only">동영상</span>
						</button> -->
                            <!-- <button type="button" class="btn btn-basic" title="지도" onclick="na_clip('map', '<?php echo $is_dhtml_editor ?>');">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							<span class="sr-only">지도</span>
						</button> -->
                            <!--<?php if ($is_member) { // 임시 저장된 글 기능
                                ?>
							<button type="button" id="btn_autosave" data-toggle="modal" data-target="#saveModal" class="btn btn-basic" title="임시 저장된 글 목록 열기">
								<i class="fa fa-repeat" aria-hidden="true"></i>
								<span class="sr-only">임시저장글</span>
								<span id="autosave_count" class="orangered"><?php echo $autosave_count; ?></span>
							</button>
						<?php } ?>-->
                        </div>
                    </div>
                </li>

                <?php if (isset($boset['na_tag']) && $boset['na_tag']) { //태그
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label" for="as_tag">태그</label>
                            <div class="col-md-10">
                                <input type="text" name="as_tag" id="as_tag" value="<?php echo $write['as_tag']; ?>" class="form-control" placeholder="콤마(,)로 구분하여 복수 태그 등록 가능">
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php //관련링크
                if ($is_link) {
                    $link_holder = (isset($boset['na_video_link']) && $boset['na_video_link']) ? '유튜브 등 동영상 공유주소 등록시 자동 출력' : 'https://...';
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">관련 링크</label>
                            <div class="col-md-10">
                                <?php for ($i = 1; $i <= G5_LINK_COUNT; $i++) { ?>
                                    <div class="<?php echo ($i > 1) ? 'mt-2' : 'mt-0'; ?>">
                                        <input type="text" name="wr_link<?php echo $i ?>" value="<?php echo $write['wr_link' . $i]; ?>" id="wr_link<?php echo $i ?>" class="form-control" placeholder="<?php echo $link_holder ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($is_file && (int)$board['bo_upload_count'] > 0) { // 첨부파일
                ?>
                    <li class="list-group-item">
                        <?php
                        na_script('fileinput');

                        // 칼럼
                        $file_col = ($is_file_content) ? 'col-sm-6' : 'col';

                        $file_script = "";
                        $file_length = -1;
                        // 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
                        if ($w == "u") {
                            for ($i = 0; $i < $file['count']; $i++) {
                                if ($file[$i]['source']) {
                                    $file_script .= "add_file('";
                                    if ($is_file_content) {
                                        $file_script .= '<div class="' . $file_col . ' mt-2 px-2"><input type="text" name="bf_content[]" value="' . addslashes(get_text($file[$i]['bf_content'])) . '" class="form-control" placeholder="파일 내용 입력"></div>';
                                    }

                                    $file_script .= '<div class="px-2 mt-2 col-12 f-de"><div class="custom-control custom-checkbox">';
                                    $file_script .= '<input type="checkbox" name="bf_file_del[' . $i . ']" value="1" id="bf_file_del' . $i . '" class="custom-control-input">';
                                    $file_script .= '<label class="custom-control-label" for="bf_file_del' . $i . '"><span>' . $file[$i]['source'] . '(' . $file[$i]['size'] . ') 파일 삭제 - <a href="' . $file[$i]['href'] . '">열기</a></span></label>';
                                    $file_script .= '</div></div>';
                                    $file_script .= "');\n";
                                } else {
                                    $file_script .= "add_file('');\n";
                                }
                            }
                            $file_length = $file['count'] - 1;
                        }

                        if ($file_length < 0) {
                            $file_script .= "add_file('');\n";
                            $file_length = 0;
                        }
                        ?>
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">첨부 파일</label>
                            <div class="col-md-10">
                                <button type="button" onclick="add_file();" class="btn btn-basic">
                                    <span class="text-muted"><i class="fa fa-plus"></i> 파일 추가</span>
                                </button>
                                <button type="button" onclick="del_file();" class="btn btn-basic">
                                    <span class="text-muted"><i class="fa fa-times"></i> 파일 삭제</span>
                                </button>

                                <table id="variableFiles" class="w-100"></table>

                                <script>
                                    var flen = 0;

                                    function add_file(delete_code) {

                                        var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
                                        if (upload_count && flen >= upload_count) {
                                            alert("이 게시판은 " + upload_count + "개 까지만 파일 업로드가 가능합니다.");
                                            return;
                                        }

                                        var objTbl;
                                        var objNum;
                                        var objRow;
                                        var objCell;
                                        var objContent;
                                        if (document.getElementById)
                                            objTbl = document.getElementById("variableFiles");
                                        else
                                            objTbl = document.all["variableFiles"];

                                        objNum = objTbl.rows.length;
                                        objRow = objTbl.insertRow(objNum);
                                        objCell = objRow.insertCell(0);

                                        objContent = '<div class="row mx-n2">';
                                        objContent +=
                                            '<div class="<?php echo $file_col ?> mt-2 px-2"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text" for="fwriteFile' +
                                            objNum + '">파일 ' + objNum + '</label></div>';
                                        objContent +=
                                            '<div class="custom-file"><input type="file" name="bf_file[]" class="custom-file-input" title="파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" id="fwriteFile' +
                                            objNum + '">';
                                        objContent +=
                                            '<label class="custom-file-label" for="imgboxFile" data-browse="선택"></label></div></div></div>';
                                        if (delete_code) {
                                            objContent += delete_code;
                                        } else {
                                            <?php if ($is_file_content) { ?>
                                                objContent +=
                                                    '<div class="<?php echo $file_col ?> mt-2 px-2"><input type="text" name="bf_content[]" class="form-control" placeholder="파일 내용 입력"></div>';
                                            <?php } ?>
                                            ;
                                        }
                                        objContent += "</div>";

                                        objCell.innerHTML = objContent;

                                        bsCustomFileInput.init();

                                        flen++;
                                    }

                                    <?php echo $file_script; //수정시에 필요한 스크립트
                                    ?>

                                    function del_file() {
                                        // file_length 이하로는 필드가 삭제되지 않아야 합니다.
                                        var file_length = <?php echo (int)$file_length; ?>;
                                        var objTbl = document.getElementById("variableFiles");
                                        if (objTbl.rows.length - 1 > file_length) {
                                            objTbl.deleteRow(objTbl.rows.length - 1);
                                            flen--;
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </li>
                    <?php if (IS_NA_BBS) { ?>
                        <li class="list-group-item">
                            <div class="mb-0 form-group row">
                                <label class="col-md-2 col-form-label">첨부 사진</label>
                                <div class="col-sm-10">
                                    <p class="float-left pt-1 pb-0 form-control-plaintext">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img" name="as_img" value="0" <?php echo (!$write['as_img']) ? ' checked' : ''; ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img"><span>상단 위치</span></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img1" name="as_img" value="1" <?php echo get_checked('1', $write['as_img']) ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img1"><span>하단 위치</span></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="as_img2" name="as_img" value="2" <?php echo get_checked('2', $write['as_img']) ?> class="custom-control-input">
                                        <label class="custom-control-label" for="as_img2"><span>본문 삽입</span></label>
                                    </div>
                                    </p>
                                    <p class="pb-0 form-control-plaintext f-de text-muted">
                                        본문 삽입시 {이미지:0}, {이미지:1} 형태로 글내용에 입력시 지정 첨부사진이 출력됩니다.
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>

                <?php if ($captcha_html) { //자동등록방지
                ?>
                    <li class="list-group-item">
                        <div class="mb-0 form-group row">
                            <label class="col-md-2 col-form-label">자동등록방지</label>
                            <div class="col-md-10 f-small">
                                <?php echo $captcha_html; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <div style="margin: 0 auto; text-align: center;">
            <!-- <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-basic btn-lg en"
                style="width: 150px;">취소</a> -->
            <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-primary btn-lg en" style="width: 150px;">취소</a>
            <button type="submit" id="btn_submit" accesskey="s" class="btn btn-primary btn-lg en" style="margin-left: 20px; width: 140px;">작성완료</button>
        </div>
        <!-- <div class="px-3 px-sm-0">
			<div class="row mx-n2">
				<div class="order-2 px-2 col-6">
					<button type="submit" id="btn_submit" accesskey="s" class="btn btn-primary btn-lg btn-block en">작성완료</button>
				</div>
				<div class="order-1 px-2 col-6">
					<a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-basic btn-lg btn-block en">취소</a>
				</div>
			</div>
		</div> -->
    </form>
</section>

<script>
    <?php if ($gr_id == 'attendance') { ?>
        $(document).ready(function() {
            $('iframe.cheditor-editarea').on('load', function() {
                $('iframe.cheditor-editarea').contents().find('body').css('text-align', 'center').children().css('text-align', 'center');
                $('iframe.cheditor-editarea').contents().find('body').trigger('click');
            })
        });
    <?php } ?>

    <?php if ($write_min || $write_max) { ?>
        // 글자수 제한
        var char_min = parseInt(<?php echo $write_min; ?>); // 최소
        var char_max = parseInt(<?php echo $write_max; ?>); // 최대
        check_byte("wr_content", "char_count");

        $(function() {
            $("#wr_content").on("keyup", function() {
                check_byte("wr_content", "char_count");
            });
        });
    <?php } ?>

    function html_auto_br(obj) {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        } else
            obj.value = "";
    }

    function fwrite_submit(f) {

        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함
        ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url + "/ajax.filter.php",
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
            alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
                    return false;
                } else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함
        ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
</script>

<!-- 제목 색상 변경 hulan nemsen -->
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo G5_PLUGIN_URL; ?>/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.js">
</script>
<script>
    $(function() {
        $('#colorselector_2').colorselector({
            callback: function(value, color, title) {
                $("#wr_1").val(color);
            }
        });
    });

    $(document).ready(function() {
        $('#notice').click(function() {
            if ($(this).is(':checked')) {
                $("#ca_name").val("공지");
            } else {
                $("#ca_name").val(null);
            }
        });
        $('#event').click(function() {
            if ($(this).is(':checked')) {
                $("#ca_name").val("이벤트진행");
            } else {
                $("#ca_name").val(null);
            }
        });

    });

    // $("input:checkbox").on('click', function() {
    // 	var $noticed = "input:checkbox[name='notice']";
    // 	var $eventd = "input:checkbox[name='event']";
    // 	var $bestd = "input:checkbox[name='best']";

    // 	if ($noticed.is(":checked")) {

    // 		$eventd.prop("checked", false);
    // 		$bestd.prop("checked", false);
    // 		$noticed.prop("checked", true);

    //   } else {
    //     $noticed.prop("checked", false);
    //   }
    // }
    // );


    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    // editor.execute( 'alignment', { value: 'center' } );

    /* $(function(){
        $( "div" ).click(function() {
        $('div[name=justifyLeft]').css("background-position", "-48px 0px");
        $('div[name=justifyCenter]').css("background-position", "0px -115px");
        });
        
    }); */
</script>
<!-- ///////////////////////////////////// -->