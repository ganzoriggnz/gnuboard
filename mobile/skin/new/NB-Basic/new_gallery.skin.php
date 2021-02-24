<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$xs = ($wset['xs']) ? $wset['xs'] : 2;
$sm = ($wset['sm']) ? $wset['sm'] : 3;
$md = ($wset['md']) ? $wset['md'] : 4;
$lg = ($wset['lg']) ? $wset['lg'] : 4;
$xl = ($wset['xl']) ? $wset['xl'] : 5;

?>
<style>
/*     hr.hr::before { 
	right:0 !important; 
}

	hr.hr::after { 
	width:15.8rem !important;
    right: 0 !important
} */
</style>
<h3 class="h3 f-lg en"><img src="<?php echo G5_URL?>/img/img-flag5-on.png">
    신규제휴
    <a href="<?php echo G5_URL?>/bbs/board.php?bo_table=gallery">
        <span class="float-right">
            <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> --> 프리미엄 제휴업소 전체보기
        </span>
    </a>
</h3>
<hr class="hr" />
<div class="px-3 px-sm-0 my-3">
    <?php echo na_widget('basic-wr-gallery-new', 'gallery-1', 'bo_list=video ca_list=게임 rows=8'); ?>
</div>