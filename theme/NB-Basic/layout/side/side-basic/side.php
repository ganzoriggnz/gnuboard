<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_side_url.'/side.css">', 10);
?>

<?php if($is_index) { // 인덱스에서만 출력 ?>
	<!-- 로그인 시작 -->

	<!-- 로그인 끝 -->
<?php } else { // 페이지에서는 메뉴 출력 ?>


	<?php
	$mes = array();
	for ($i=0; $i < $menu_cnt; $i++) {
		// 주메뉴 이하 사이트이고 서브메뉴가 있으면...
		if($menu[$i]['on']) {
			$mes = $menu[$i];
			break;
		}
    }



	// 선택메뉴가 있다면...
	if(!empty($mes)) {
    ?>



		<div id="nt_side_menu" class="font-weight-normal mb-4">
			<div class="bg-primary text-white text-center p-4 py-sm-5 en">
				<h4>
					<i class="fa <?php echo $mes['icon'] ?>" aria-hidden="true"></i>
					<?php echo $mes['text'];?>
				</h4>
			</div>
			<?php if(isset($mes['s'])) { ?>
				<ul class="me-ul border border-top-0">
				<?php for ($i=0; $i < count($mes['s']); $i++) {
					$me = $mes['s'][$i];
				?>
				<li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
					<?php if(isset($me['s'])) { //Is Sub Menu ?>
						<i class="fa fa-caret-down tree-toggle me-i"></i>
					<?php } ?>
					<a class="me-a" href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
						<i class="fa <?php echo $me['icon'] ?> fa-fw" aria-hidden="true"></i>
						<?php echo $me['text'];?>
					</a>

					<?php if(isset($me['s'])) { //Is Sub Menu ?>
						<ul class="me-ul1 tree <?php echo ($me['on']) ? 'on' : 'off'; ?>">
						<?php for($j=0; $j < count($me['s']); $j++) {
								$me1 = $me['s'][$j];
						?>
							<?php if($me1['line']) { //구분라인 ?>
								<li class="me-line1"><a class="me-a1"><?php echo $me1['line'];?></a></li>
							<?php } ?>

							<li class="me-li1<?php echo ($me1['on']) ? ' active' : ''; ?>">
								<a class="me-a1" href="<?php echo $me1['href'];?>" target="<?php echo $me1['target'];?>">
									<i class="fa <?php echo $me1['icon'] ?> fa-fw" aria-hidden="true"></i>
									<?php echo $me1['text'];?>
								</a>
							</li>
						<?php } //for ?>
						</ul>
					<?php } //is_sub ?>
				</li>
				<?php } //for ?>
				</ul>
			<?php } //is_sub ?>
		</div>
		<script>
		$(document).ready(function () {
			$(document).on('click', '#nt_side_menu .tree-toggle', function () {
				$(this).parent().children('ul.tree').toggle(200);
			});
		});
		</script> 
	<?php } ?>
<?php } ?>

<!-- hulan nemsen  -->
<div class="side_cate">
    <a href="<?php echo G5_URL?>/bbs/board.php?bo_table=gallery">
        <img src="<?php echo G5_URL?>/img/side_top_img.png"></a>
</div>
    <br>

    <!-- //////////////////////////////////////////////////// -->
    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 10px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[0]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[0]['s']); $i++) {
            $me = $menu[0]['s'][$i];
            ?>
            <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
                <?php if(isset($me['s'])) { //Is Sub Menu ?>
                <?php } ?>
                <div>
                    <?php echo $me['text'];?>

                    <!-- <a class="cat_1_bg <?php echo ($menu[1]['s'][$i]['active']) ? ' active' : ''?>"
                       href="<?php echo $menu[1]['s'][$i]['href']; ?>"
                       target="_<?php echo $me['me_target']; ?>">
                        후기
                    </a>
                    <a class="cat_2_bg <?php echo ($me['active']) ? ' active' : ''?>"
                       href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>">정보
                    </a> -->
                    <a class="cat_1_bg"
                       href="<?php echo $menu[1]['s'][$i]['href']; ?>"
                       target="_self">
                        후기
                    </a>
                    <a class="cat_2_bg"
                       href="<?php echo $me['href']; ?>" target="_self">정보
                    </a>
                </div>
            </li>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 18px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[2]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[2]['s']); $i++) {
            $me = $menu[2]['s'][$i];
            ?>
                <?php if ($i%2==0) { ?>
            <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
                <?php } ?>
                <?php if(isset($me['s'])) { //Is Sub Menu ?>
                <?php } ?>
                <div class="col-6 m-0 px-0">
                    <!-- <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                       href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                    </a> -->
                    <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                       href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                    </a>
                </div>
                <?php if ($i%2==1) { ?>
            </li>
            <?php } ?>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 18px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[3]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[3]['s']); $i++) {
            $me = $menu[3]['s'][$i];
            ?>
            <?php if ($i%2==0) { ?>
                <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php } ?>
            <?php if(isset($me['s'])) { //Is Sub Menu ?>
            <?php } ?>
            <div class="col-6 m-0 px-0">
                        <!-- <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                              href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                        </a> -->
                        <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                              href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                        </a>
            </div>
            <?php if ($i%2==1) { ?>
                </li>
            <?php } ?>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 18px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[4]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[4]['s']); $i++) {
            $me = $menu[4]['s'][$i];
            ?>
            <?php if ($i%2==0) { ?>
                <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php } ?>
            <?php if(isset($me['s'])) { //Is Sub Menu ?>
            <?php } ?>
            <div class="col-6 m-0 px-0">
                        <!-- <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                              href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                        </a> -->
                        <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                              href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                        </a>
            </div>
            <?php if ($i%2==1) { ?>
                </li>
            <?php } ?>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 18px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[5]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[5]['s']); $i++) {
            $me = $menu[5]['s'][$i];
            ?>
            <?php if ($i%2==0) { ?>
                <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php } ?>
            <?php if(isset($me['s'])) { //Is Sub Menu ?>
            <?php } ?>
            <div class="col-6 m-0 px-0">
                <!-- <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                   href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                </a> -->
                <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                   href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                </a>
            </div>
            <?php if ($i%2==1) { ?>
                </li>
            <?php } ?>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="sub-ul mb-3">
        <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 18px; padding-bottom: 2px;">
        <img src="<?php echo G5_URL?>/img/img-flag5-on.png"> <?php echo $menu[6]['text']?>
        </li>
        <?php for ($i=0; $i < count($menu[6]['s']); $i++) {
            $me = $menu[6]['s'][$i];
            ?>
            <?php if ($i%2==0) { ?>
                <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php } ?>
            <?php if(isset($me['s'])) { //Is Sub Menu ?>
            <?php } ?>
            <div class="col-6 m-0 px-0">
                <!-- <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                   href="<?php echo $me['href']; ?>" target="_<?php echo $me['me_target']; ?>"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                </a> -->
                <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                   href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > <?php echo $me['text'];?>
                </a>
            </div>
            <?php if ($i%2==1) { ?>
                </li>
            <?php } ?>
        <?php } //for ?>
        <?php if(!$menu_cnt) { ?>
            <li class="me-li">
                <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
            </li>
        <?php } ?>
    </ul>

<!-- 위젯 시작 -->
    <!--<h3 class="h3 f-lg en sdf">-->
    <!--	<a href="--><?php //echo get_pretty_url('video'); ?><!--">-->
    <!--		<span class="float-right more-plus"></span>-->
    <!--		공지글-->
    <!--	</a>-->
    <!--</h3>-->
    <!--<hr class="hr"/>-->
    <!--<div class="mt-3 mb-4">-->
    <!--	--><?php //echo na_widget('basic-wr-list', 'notice', 'bo_list=video ca_list=게임'); ?>
    <!--</div>-->
<!-- 위젯 끝-->

<!-- 위젯 시작 -->
    <!--<h3 class="h3 f-lg en">-->
    <!--	동영상-->
    <!--</h3>-->
    <!--<hr class="hr"/>-->
    <!--<div class="px-3 px-sm-0 mt-3 mb-4">-->
    <!--	--><?php //echo na_widget('basic-youtube', 'youtube-1'); ?>
    <!--</div>-->

<!-- 위젯 끝-->

<!-- 위젯 시작 -->
    <!--<h3 class="h3 f-lg en mb-1">-->
    <!--	<a href="--><?php //echo G5_BBS_URL ?><!--/new.php?view=w">-->
    <!--		<span class="float-right more-plus"></span>-->
    <!--		최근글-->
    <!--	</a>-->
    <!--</h3>-->
    <!--<hr class="hr"/>-->
    <!--<div class="mt-3 mb-4">-->
    <!--	--><?php //echo na_widget('basic-wr-list', 'new-wr', 'bo_list=video ca_list=게임'); ?>
    <!--</div>-->
<!-- 위젯 끝-->

<!-- 위젯 시작 -->
    <!--<h3 class="h3 f-lg en mb-1">-->
    <!--	<a href="--><?php //echo G5_BBS_URL ?><!--/new.php?view=c">-->
    <!--		<span class="float-right more-plus"></span>-->
    <!--		새댓글-->
    <!--	</a>-->
    <!--</h3>-->
    <!--<hr class="hr"/>-->
    <!--<div class="mt-3 mb-4">-->
    <!--	--><?php //echo na_widget('basic-wr-comment-list', 'new-co', 'bo_list=video ca_list=게임'); ?>
    <!--</div>-->
<!-- 위젯 끝-->
    <!-- hulan nemsen  -->

        <?php if ($member['mb_level'] == 27) { ?>
        <tbody><tr>
			<td style="width:50%; padding:10px;">

				<li class="gnb_2da active">
				<a href="<?php echo G5_URL?>/bbs/board.php?bo_table=work_board">
				<i class="fa fa-heartbeat"></i>
				실장 업무 게시판</a>
            </li>
        	</td>
		    </tr>
		</tbody>
        <?php } ?>
        <script>      
                $('a.cat_2_bg').click(function() {                  
                $(this).removeClass('cat_2_bg').addClass('cat_2_bg_a');
                });
            
                $('a.cat_1_bg').click(function() {                  
                $(this).removeClass('cat_1_bg').addClass('cat_1_bg_a');
                });
        </script>
