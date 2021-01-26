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

?>

<li class="col px-2 pb-4" style="width: 222px; height: 280px;">
    <div style="background-image:url('<?php echo G5_IMG_URL?>/main_bgpicture.png')" style="height: 148px;">
        <div>
            <div class="img-wrap bg-light mb-2">
				<?php if($list[$i]['mb_2'] == "안마" ){?>
                <div class="img-item" style="background-image:url('<?php echo G5_IMG_URL?>/anma5.png')" style="height: 148px;">
					<a href="<?php echo $list[$i]['href'] ?>"<?php echo $target ?>>
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
							<?php } ?>
					</a>
				</div>
				<?php }?>
				<?php if($list[$i]['mb_2'] == "오피" ){?>
                <div class="img-item" style="background-image:url('<?php echo G5_IMG_URL?>/office.png')" style="height: 148px;">
					<a href="<?php echo $list[$i]['href'] ?>"<?php echo $target ?>>
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
							<?php } ?>
					</a>
				</div>
				<?php }?>
				<?php if($list[$i]['mb_2'] == "휴게텔" ){?>
                <div class="img-item" style="background-image:url('<?php echo G5_IMG_URL?>/hyugetel.png')" style="height: 148px;">
					<a href="<?php echo $list[$i]['href'] ?>"<?php echo $target ?>>
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
							<?php } ?>
					</a>
				</div>
				<?php }?>
				<?php if($list[$i]['mb_2'] == "건마" ){?>
                <div class="img-item" style="background-image:url('<?php echo G5_IMG_URL?>/gonma.png')" style="height: 148px;">
					<a href="<?php echo $list[$i]['href'] ?>"<?php echo $target ?>>
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
							<?php } ?>
					</a>
				</div>
				<?php }?>
				<?php if($list[$i]['mb_2'] == "립카페" ){?>
                <div class="img-item" style="background-image:url('<?php echo G5_IMG_URL?>/gibcafe.png')" style="height: 148px;">
					<a href="<?php echo $list[$i]['href'] ?>"<?php echo $target ?>>
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="Image <?php echo $list[$i]['wr_id'] ?>" class="na-round">
							<?php } ?>
					</a>
				</div>
				<?php }?>
            </div>
            <div class="na-title" style="display: flex; justify-content: center; flex-direction: column; align-items: center; height: 80px;">
			<a href="<?php echo $list[$i]['href'] ?>" class="na-subject" style="font-size: 16px; color: #E73D2F; font-weight: bold; overflow: hidden;" <?php echo $target ?>>
					<?php echo $wr_icon ?>
					<?php echo $list[$i]['mb_name'] ?>
				</a> 
                <p style="font-weight: bold; overflow: hidden;"><?php
	    // global $g5;
	    // $link = $g5['connect_db'];
	    // $error=G5_DISPLAY_SQL_ERROR;
	    // $sql="select * from {$g5['member_table']} where mb_id = '{$list[$i]['mb_id']}'";
	    // $zzzzz = sql_query($sql);
        //     if($zzzzz->num_rows > 0){
		// 		$publisher = $zzzzz->fetch_array(MYSQLI_ASSOC); echo $publisher['mb_addr1'].'</p><div style="display: flex; align-items: center; line-height: 1.5;">
		// 		<p>'.$publisher['mb_hp'].'</p> </div></div>  ';

		// 	}
		// else {echo "false";}
		echo $list[$i]['mb_addr2'] ?></p><div style="display: flex; align-items: center; line-height: 1.5;">
	 		<p><?php echo $list[$i]['mb_hp'] ?></p> </div></div>

        </div>
        <div style="display: flex; align-items: center; justify-content: space-evenly; background-image: url('<?php echo G5_IMG_URL?>/main_780.png'); width: 100%; height: 52px;">
            <div>
                <button type="button" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>&wr_id=<?php echo $list[$i]['wr_id']?>'" style="background-color: rgb(255, 255, 255, 0.05); font-size: 10px; font-weight: light; display: flex; flex-direction: column;align-items: center; justify-content: center; width: 43px; height: 35px; margin-left: 44px; padding: 2px 2px;"><img src="<?php echo G5_IMG_URL?>/baseline-ballot_main-24px.png"><!-- <i class="fa fa-calendar"></i> --> 정보</button>
            </div>
            <div>
                <button type="button" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>'" style="background-color: rgb(255, 255, 255, 0.05); font-size: 10px; font-weight: light; display: flex;flex-direction: column; align-items: center; justify-content: center; width: 43px; height: 35px; margin-right: 44px; padding: 2px 2px;"><img src="<?php echo G5_IMG_URL?>/chat_icon_main.png"><!-- <i class="fa fa-comments"></i> --> 후기</button>
            </div>
        </div>
    </div>
    <div class="clearfix f-sm font-weight-normal">
        <span class="float-right ml-2">
            <span class="sr-only">등록자</span>
            <span class="sv_wrap">
                <span class="sv">
                    <a href="<?php echo G5_BBS_URL ?>/memo_form.php?me_recv_mb_id=user1" onclick="win_memo(this.href); return false;">쪽지보내기</a>
                    <a href="<?php echo G5_BBS_URL ?>/profile.php?mb_id=user1" onclick="win_profile(this.href); return false;">자기소개</a>
                    <a href="<?php echo G5_BBS_URL ?>/new.php?mb_id=user1" class="link_new_page" onclick="check_goto_new(this.href, event);">전체게시물</a>
                </span>
                <noscript class="sv_nojs"><span class="sv">
                    <a href="<?php echo G5_BBS_URL ?>/memo_form.php?me_recv_mb_id=user1" onclick="win_memo(this.href); return false;">쪽지보내기</a>
                    <a href="<?php echo G5_BBS_URL ?>/profile.php?mb_id=user1" onclick="win_profile(this.href); return false;">자기소개</a>
                    <a href="<?php echo G5_BBS_URL ?>/new.php?mb_id=user1" class="link_new_page" onclick="check_goto_new(this.href, event);">전체게시물</a>
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
