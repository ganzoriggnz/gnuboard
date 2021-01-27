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
				<li class="me-li">
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
<?php 
$sql_date = "SELECT mb_4 FROM {$g5['member_table']} WHERE mb_id = '{$member['mb_id']}' AND mb_level IN ('26', '27')";
$res_date = sql_fetch($sql_date);
$now = G5_TIME_YMD;
if($res_date['mb_4'] > '0000:00:00 00:00:00')
$end_time = strtotime($res_date['mb_4']);
$now_time = strtotime($now);
if($end_time >= $now_time){
    $diff = $end_time - $now_time;
    $diff_days = floor($diff / 86400);
}
else if($end_time < $now_time){
    $diff_days = '0';
}

?>

    <!-- //////////////////////////////////////////////////// -->
    <ul class="sub-ul mb-3">
    <?php 

    if($member['mb_level'] == '26' || $member['mb_level'] == '27') { 
        ?> 
            <li class="me-li pt-3 pb-3 pr-2" style="font-weight: bold;">
                <div class="text-left" style="display: inline;">제휴마감
                </div>
                <div class="text-center" style="color: #0000FF; display: inline;">D - <?php echo $diff_days ?>일
                </div>
                <div class="text-right" style="display: inline;"><a href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=partnership" 
                class="cat_1_bg <?php echo ($_GET['bo_table'] == "partnership") ? "activesubs" : "" ?>" style="display: inline; width: 70px;">연장신청 </a>
                </div>
            </li>            
        <?php
          } else { echo '<li  class="me-li pt-3 pb-3 text-center" style="font-weight: bold;">업소리스트</li>';
          }
        for ($i=0; $i < count($menu[0]['s']); $i++) {
            $me = $menu[0]['s'][$i];
            ?>
            <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
                <?php if(isset($me['s'])) { //Is Sub Menu ?>
                <?php } ?>
                <div style="<?php if( strstr($me['href'], $member['mb_6'])) echo "font-weight: bold; color: red; "; ?>">
                    <?php echo $me['text'];?>

                    <a class="cat_1_bg <?php if( strstr($menu[1]['s'][$i]['href'], $bo_table)) echo"activesubs" ?>"
                       href="<?php echo $menu[1]['s'][$i]['href']; ?>"
                       target="_self">
                        후기
                    </a>
                    <a class="cat_2_bg  <?php if( strstr($me['href'], $bo_table)) echo"activesubs" ?>"
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
            <?php if($me['text']=="실장업무게시판")
                              {if($member['mb_level']==26 || $member['mb_level']==27)
                                 { ?>
                                <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                                    href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > 
                                  <?php echo $me['text'];?>
                                  </a>
                        <?php } }else { ?>
                            <a class="border-0" style="font-size: 13px; <?php echo ($me['active']) ? 'color: red; border-color: red' : ''?>"
                              href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL?>/img/<?php echo $me['icon'] ?>.png" > 
                                  <?php echo $me['text'];?>
                                  </a>
                            <?php }?>
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

<script>      
        $('a.cat_2_bg').click(function() {                  
        $(this).removeClass('cat_2_bg').addClass('cat_2_bg_a');
        });
    
        $('a.cat_1_bg').click(function() {                  
        $(this).removeClass('cat_1_bg').addClass('cat_1_bg_a');
        });
</script>