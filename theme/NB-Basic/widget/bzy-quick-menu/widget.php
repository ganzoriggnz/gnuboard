<?php
if (!defined('_GNUBOARD_')) exit;

//필요한 전역변수 선언
global $config, $member, $is_member, $urlencode, $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0); ?>

<div class="f-de font-weight-normal" style="margin-right: 58px; border-radius: 5px; padding: 10px 0 0 10px;">
    <!-- <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-bottom: 5px;">
        <i class="fa fa-star" aria-hidden="true" style="margin-right: 3px;"></i>
        <h4>Quick Menu Services</h4>
    </div> -->
    <div id="links_list" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
        <div style="padding: 0px 14px;">
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-keyboard_voice-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href= "<?php echo G5_URL?>/bbs/board.php?bo_table=notice" style="color: #BFAF88;">공지사항</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-import_contacts-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_URL?>/bbs/content.php?co_id=company" style="color: #BFAF88;">사이트안내</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-portrait-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_URL?>/bbs/member_list.php" style="color: #BFAF88;">회원검색</a>
            </div>
        </div>
        <div style="padding: 0px 14px;">
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-card_giftcard-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=shop" style="color: #BFAF88;">아이템 샵</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-wc-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_URL?>/bbs/board.php?bo_table=event" style="color: #BFAF88;">이벤트</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-chat-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_URL?>/bbs/board.php?bo_table=partnership" style="color: #BFAF88;">제휴문의</a>
            </div>
        </div>
        <div style="padding: 0px 14px;">
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-adb-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_BBS_URL ?>/pet.php" style="color: #BFAF88;">펫 기르기</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-ballot-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_BBS_URL ?>/mission.php" style="color: #BFAF88;">일일미션</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center;">
                <!-- <i class="fa fa-angle-right" style="margin-right: 3px;"></i> -->
                <img src="<?php echo G5_URL?>/img/baseline-forum-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_URL?>/bbs/board.php?bo_table=free" style="color: #BFAF88;">자유게시판</a>
            </div>
        </div>
        <!-- <div style="padding: 0px 14px;">
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <img src="<?php echo G5_URL?>/img/baseline-swap_horizontal_circle-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_BBS_URL?>/point.php" style="color: #BFAF88;">파운드페니로전환</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 9px;">
                <img src="<?php echo G5_URL?>/img/baseline-swap_horizontal_circle-24px.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="<?php echo G5_BBS_URL?>/point2.php" style="color: #BFAF88;">파편조각페니로전환</a>
            </div>
            <div id="link" style="display: flex; flex-direction: row; align-items: center;">
                <img src="<?php echo G5_URL?>/img/baseline-monetization_on-24.png" style="margin-right: 5px; border-color: #707070;" >
                <a href="#" style="color: #BFAF88;">페니구매</a>
            </div>
        </div> -->
    </div>
</div>
