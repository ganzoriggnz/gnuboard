<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 이미지 영역 및 썸네일 크기 설정
$wset['thumb_w'] = ($wset['thumb_w'] == "") ? 400 : (int)$wset['thumb_w'];
$wset['thumb_h'] = ($wset['thumb_h'] == "") ? 225 : (int)$wset['thumb_h'];

if($wset['thumb_w'] && $wset['thumb_h']) {
	$img_height = ($wset['thumb_h'] / $wset['thumb_w']) * 100;
} else {
	$img_height = ($wset['thumb_d']) ? $wset['thumb_d'] : '56.25';
}

// 추출하기
$wset['sideview'] = 1; // 이름 레이어 출력


$list = na_board_rows($wset);

//shuffle($list);
$list_cnt = count($list);

// 랭킹
$rank = na_rank_start($wset['rows'], $wset['page']);

// 새글
$cap_new = ($wset['new']) ? $wset['new'] : 'primary';

// 보드명, 분류명
$is_bo_name = ($wset['bo_name'] == '') ? false : true;
$bo_name = ((int)$wset['bo_name'] > 0) ? $wset['bo_name'] : 0;

// 글 이동
$is_link = false;
switch($wset['target']) {
	case '1' : $target = ' target="_blank"'; break;
	case '2' : $is_link = true; break;
	case '3' : $target = ' target="_blank"'; $is_link = true; break;
	default	 : $target = ''; break;
}

//shuffle($list);

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 아이콘 체크
	$wr_icon = $wr_tack = $wr_cap = '';
	if ($list[$i]['icon_secret']) {
		$is_lock = true;
		$wr_icon = '<span class="na-icon na-secret"></span>';
	}

	if ($wset['rank']) {
		$wr_tack = '<span class="label-tack rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span>';
		$rank++;
	}

	if($list[$i]['icon_new']) {
		$wr_cap = '<span class="label-cap en bg-'.$cap_new.'">New</span>';
	}

	// 보드명, 분류명
	if($is_bo_name) {
		$ca_name = '';
		if(isset($list[$i]['bo_subject']) && $list[$i]['bo_subject']) {
			$ca_name = ($bo_name) ? cut_str($list[$i]['bo_subject'], $bo_name, '') : $list[$i]['bo_subject'];
		} else if($list[$i]['ca_name']) {
			$ca_name = ($bo_name) ? cut_str($list[$i]['ca_name'], $bo_name, '') : $list[$i]['ca_name'];
		}

		if($ca_name) {
			$list[$i]['subject'] = $ca_name.' <span class="na-bar"></span> '.$list[$i]['subject'];
		}
	}

	// 링크 이동
	if($is_link && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	// 이미지 추출
	$img = na_wr_img($list[$i]['bo_table'], $list[$i]);

	// 썸네일 생성
	$thumb = ($wset['thumb_w']) ? na_thumb($img, $wset['thumb_w'], $wset['thumb_h']) : $img;
	$zurag = "anma";
?>

<li class="col px-2 pb-4" style="width: 230px; height: 300px;">
    <div style="background-image:url('<?php echo G5_IMG_URL?>/main_bgpicture.png'); background-size: 100% 100%;">
        <div>
            <div class="img-wrap mb-2">
                <div class="img-item"
                    style="<?php echo get_cate_pic($list[$i]['mb_2'])?> background-repeat: no-repeat; background-size: 100% 100%;">
                    <a href="<?php echo $list[$i]['href'] ?>" <?php echo $target ?>> 
                        <?php echo $wr_tack ?>
                        <?php echo $wr_cap ?> <!-- <?php if($thumb) { ?>
                        <img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
                        <?php } ?> -->
                        <?php echo $list[$i]['mb_2'];?>
                    </a>
                </div>
            </div>
            <div class="na-title"
                style="display: flex; justify-content: center; flex-direction: column; align-items: center; height: 80px;">
                <a href="<?php echo $list[$i]['href'] ?>" class="na-subject"
                    style="font-size: 16px; color: #E73D2F; font-weight: bold; overflow: hidden;" <?php echo $target ?>>
                    <?php echo $wr_icon ?>
                    <?php echo $list[$i]['mb_name'] ?>
                </a>
                <p style="font-weight: bold; overflow: hidden;"><?php
		echo $list[$i]['mb_addr2'] ?></p>
                <div style="display: flex; align-items: center; line-height: 1.5;">
                    <p><?php echo $list[$i]['mb_hp'] ?></p>
                </div>
            </div>

        </div>
        <style>
        .gal_btns {
            background-color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
            align-items: center;
            justify-content: center;
            text-align: center;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 35px;
            padding-top: 6px;
            border: 1px solid black;
        }
        </style>
        <div
            style="display: flex; align-items: center; justify-content: space-evenly; background-image: url('<?php echo G5_IMG_URL?>/main_780.png'); width: 100%; height: 52px;">
            <div style="text-align: center;">
                <a type="button" class="gal_btns"
                    onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>&wr_id=<?php echo $list[$i]['wr_id']?>'"
                    style=""><img src="<?php echo G5_IMG_URL?>/baseline-ballot_main-24px.png">
                    정보</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a type="button" class="gal_btns"
                    onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>'">
                    <img src="<?php echo G5_IMG_URL?>/chat_icon_main.png"> 후기</a>
            </div>
        </div>
    </div>
    <div class="clearfix f-sm font-weight-normal">
        <span class="float-right ml-2">
            <span class="sr-only">등록자</span>
            <span class="sv_wrap">
                <span class="sv">
                    <a href="<?php echo G5_BBS_URL ?>/memo_form.php?me_recv_mb_id=user1"
                        onclick="win_memo(this.href); return false;">쪽지보내기</a>
                    <a href="<?php echo G5_BBS_URL ?>/profile.php?mb_id=user1"
                        onclick="win_profile(this.href); return false;">자기소개</a>
                    <a href="<?php echo G5_BBS_URL ?>/new.php?mb_id=user1" class="link_new_page"
                        onclick="check_goto_new(this.href, event);">전체게시물</a>
                </span>
                <noscript class="sv_nojs"><span class="sv">
                        <a href="<?php echo G5_BBS_URL ?>/memo_form.php?me_recv_mb_id=user1"
                            onclick="win_memo(this.href); return false;">쪽지보내기</a>
                        <a href="<?php echo G5_BBS_URL ?>/profile.php?mb_id=user1"
                            onclick="win_profile(this.href); return false;">자기소개</a>
                        <a href="<?php echo G5_BBS_URL ?>/new.php?mb_id=user1" class="link_new_page"
                            onclick="check_goto_new(this.href, event);">전체게시물</a>
                    </span>
                </noscript>
            </span>
        </span>

    </div>
</li>

<?php } ?>

<?php if(!$list_cnt) { ?>
<li class="w-100 f-de text-muted text-center px-2 py-5">
    글이 없습니다.
</li>
<?php } ?>