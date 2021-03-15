<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단고정 문제로 모바일헤드도 메뉴에 포함시킴...ㅠㅠ
add_stylesheet('<link rel="stylesheet" href="'.$nt_menu_url.'/menu.css">', 0);

// 2차 서브메뉴 너비 : 메뉴나눔에서 사용
$is_sub_w = 170;

// 전체메뉴 줄나눔
$is_col_all = 6;

?>
<style>
#nt_menu .me-sw {
    width: <?php echo $is_sub_w ?>px;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
}
</style>
<div id="nt_menu_wrap">

    <!-- Mobile Header -->
    <header id="header_mo" class="d-block d-md-none">
        <div class="px-sm-4"
            style="background-image:url('<?php echo G5_URL?>/img/mpath_6382.png'), url('<?php echo G5_URL?>/img/mgrid_12.png'); max-height: 44px;">
            <!-- <h3 class="clearfix text-center f-mo font-weight-bold en"> -->
            <a href="<?php echo NT_HOME_URL ?>" class="float-left">
                <!-- <i class="fa fa-home text-white" aria-hidden="true"></i> -->
                <img src="<?php echo G5_URL?>/img/group_306.png">
                <span class="sr-only">메뉴</span>
            </a>
            <a href="javascript:;" onclick="sidebar_open('sidebar-menu');" class="float-right">
                <!-- <?php echo $tset['logo_text'] ?>  -->
                <img src="<?php echo G5_URL?>/img/group_305.png">
            </a>
            <div style="display: flex;">
                <img style="margin-top: 5px; margin-right: auto; margin-left: auto;" id="logo_img3"
                    src="<?php echo $tset['logo_img3'] ?>" alt="<?php echo get_text($config['cf_title']) ?>">
            </div>
            <!-- <a data-toggle="collapse" href="#search_mo" aria-expanded="false" aria-controls="search_mo" class="float-right">
						<i class="fa fa-search text-white" aria-hidden="true"></i>
						<span class="sr-only">검색</span>
					</a> -->
            <!-- Mobile Logo -->
            <!-- </h3> -->
        </div>

        <!-- Mobile Search -->
        <div id="search_mo" class="collapse">
            <div class="mb-0 p-3 px-sm-4 d-block d-lg-none bg-light border-bottom">
                <form name="mosearch" method="get" action="<?php echo G5_BBS_URL ?>/search.php"
                    onsubmit="return tsearch_submit(this);" class="mb-0">
                    <input type="hidden" name="sfl" value="wr_subject||wr_content">
                    <input type="hidden" name="sop" value="and">
                    <div class="input-group">
                        <input id="mo_top_search" type="text" name="stx" class="form-control" value="<?php echo $stx ?>"
                            placeholder="검색어">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="me-icon order-1 me-li<?php echo ($is_index) ? ' on' : ' on'; ?>">
					<a href="<?php echo NT_HOME_URL ?>"  class="me-a f-md" title="메인화면">
						<i class="fa fa-home" aria-hidden="true"></i>
						<img src="http://localhost/gnuboard/img/baseline-home-24px.png" >
					</a>
				</div>
				<div class="me-icon order-3 me-li on">
					<a href="javascript:;" onclick="sidebar_open('sidebar-menu'); return false;" class="me-a f-md" title="마이메뉴">
						<i class="fa fa-toggle-on" aria-hidden="true"></i>
						<img src="http://localhost/gnuboard/img/baseline-menu-24px.png" >
					</a>
				</div> -->
    </header>

    <nav id="nt_menu" class="d-none d-md-block font-weight-normal">
        <h3 class="sr-only">메인 메뉴</h3>
        <div class="nt-container">
            <div class="d-flex" style="min-width: 1500px;">
                <div class="flex-grow-1 order-2 me-list">
                    <ul class="row m-0 me-ul nav-slide">
                        <?php for ($i=0; $i < $menu_cnt; $i++) {
						$me = $menu[$i];
					?>
                        <li class="nav-item dropdown col p-0 me-li<?php echo ($me['on']) ? ' on' : ''; ?> right_border">
                            <a data-toggle="dropdown"
                                class="me-a f-md en nav-link <?php echo count($me['s'])>1 ? ' dropdown-toggle' : ''; ?>"
                                href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
                                <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me['icon'], 3, strlen($me['icon'])) ?>.svg"
                                    style="height :14px; margin-left: 3.3px;">
                                <?php echo $me['text'];?>
                            </a>
                            <?php if(isset($me['s'])) { //Is Sub Menu ?>
                            <!-- <div class="sub-slide sub-1div"> -->
                            <ul class="dropdown-menu sub-1dul"
                                style="justify-content: flex-start; position: absolute; white-space: nowrap; background-color: #fff; padding: 0px 10px; -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175)">
                                <?php for($j=0; $j < count($me['s']); $j++) {
										
											$me1 = $me['s'][$j];
									?>
                                <!-- <?php if($me1['line']) { //구분라인 ?>
											<li class="dropdown-item sub-1line" ><a class="me-sh sub-1da"><?php echo $me1['line'];?></a></li>
										<?php } ?>										 -->
                                <?php if($me1['text']=="실장업무게시판")
												{if($member['mb_level']==26 || $member['mb_level']==27 || $is_admin)
													{ ?>
                                <li class="dropdown-submenu sub-1dli<?php echo ($me1['on']) ? ' on' : ''; ?>"
                                    style="flex:1;">
                                    <a href="<?php if($member['mb_level']==27 || $is_admin)  echo $me1['href'];?>"
                                        <?php if($member['mb_level']==26)  echo 'onclick=levelalert();'?>
                                        data-toggle="dropdown"
                                        class="dropdown-item <?php echo count($me1['s'])>1 ? ' dropdown-toggle' : ''?> me-sh sub-1da<?php echo (isset($me1['s'])) ? ' sub-icon' : '';?>"
                                        target="<?php echo $me1['target'];?>">
                                        <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me1['icon'], 3, strlen($me1['icon'])) ?>.svg"
                                            style="height :14px;">
                                        <?php echo $me1['text'];?>
                                    </a>
                                    <?php if($member['mb_level']==26) { ?>
                                    <script>
                                    function levelalert() {
                                        alert("비제휴업소는 입장 불가능합니다.");
                                    }
                                    </script>
                                    <?php } ?>

                                    <?php if(isset($me1['s'])) { // Is Sub Menu ?>
                                    <!-- <div class="sub-slide sub-2div"> -->
                                    <ul class="sub-2dul me-sw pull-left">
                                        <?php
														$me_sw2 = 0; //나눔 체크
														for($k=0; $k < count($me1['s']); $k++) {
															$me2 = $me1['s'][$k];
													?>
                                        <?php if($me2['sp']) { //나눔 ?>
                                    </ul>
                                    <ul class="dropdown-menu sub-2dul me-sw pull-left">
                                        <?php $me_sw2++; } // 나눔 카운트 ?>

                                        <?php if($me2['line']) { //구분라인 ?>
                                        <li class="sub-2line "><a
                                                class="dropdown-item me-sh sub-2da"><?php echo $me2['line'];?></a></li>
                                        <?php } ?>

                                        <li class="sub-2dli<?php echo ($me2['on']) ? ' on' : ''; ?>">
                                            <a href="<?php echo $me2['href'] ?>" class="dropdown-item me-sh sub-2da"
                                                target="<?php echo $me2['target'] ?>">
                                                <!-- <i class="fa <?php echo $me2['icon'] ?> fa-fw" aria-hidden="true"></i> -->
                                                <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me2['icon'], 3, strlen($me2['icon'])) ?>.svg"
                                                    style="height :14px;">
                                                <?php echo $me2['text'];?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php $me_sw2 = ($me_sw2) ? ($is_sub_w * ($me_sw2 + 1)) : 0; //서브메뉴 너비 ?>
                                    <div class="clearfix"
                                        <?php echo ($me_sw2) ? ' style="width:'.$me_sw2.'px;"' : '';?>></div>
                                    <!-- </div> -->
                                    <?php } ?>
                                </li>
                                <?php } }else { ?>
                                <li class="dropdown-submenu sub-1dli<?php echo ($me1['on']) ? ' on' : ''; ?>"
                                    style="flex:1;">
                                    <a href="<?php echo $me1['href'];?>" data-toggle="dropdown"
                                        class="dropdown-item <?php echo count($me1['s'])>1 ? ' dropdown-toggle' : ''?> me-sh sub-1da<?php echo (isset($me1['s'])) ? ' sub-icon' : '';?>"
                                        target="<?php echo $me1['target'];?>">
                                        <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me1['icon'], 3, strlen($me1['icon'])) ?>.svg"
                                            style="height :14px;">
                                        <?php echo $me1['text'];?>
                                    </a>


                                    <?php if(isset($me1['s'])) { // Is Sub Menu ?>
                                    <!-- <div class="sub-slide sub-2div"> -->
                                    <ul class="sub-2dul me-sw pull-left">
                                        <?php
														$me_sw2 = 0; //나눔 체크
														for($k=0; $k < count($me1['s']); $k++) {
															$me2 = $me1['s'][$k];
													?>
                                        <?php if($me2['sp']) { //나눔 ?>
                                    </ul>
                                    <ul class="dropdown-menu sub-2dul me-sw pull-left">
                                        <?php $me_sw2++; } // 나눔 카운트 ?>

                                        <?php if($me2['line']) { //구분라인 ?>
                                        <li class="sub-2line "><a
                                                class="dropdown-item me-sh sub-2da"><?php echo $me2['line'];?></a></li>
                                        <?php } ?>

                                        <li class="sub-2dli<?php echo ($me2['on']) ? ' on' : ''; ?>">
                                            <a href="<?php echo $me2['href'] ?>" class="dropdown-item me-sh sub-2da"
                                                target="<?php echo $me2['target'] ?>">
                                                <!-- <i class="fa <?php echo $me2['icon'] ?> fa-fw" aria-hidden="true"></i> -->
                                                <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me2['icon'], 3, strlen($me2['icon'])) ?>.svg"
                                                    style="height :14px;">
                                                <?php echo $me2['text'];?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php $me_sw2 = ($me_sw2) ? ($is_sub_w * ($me_sw2 + 1)) : 0; //서브메뉴 너비 ?>
                                    <div class="clearfix"
                                        <?php echo ($me_sw2) ? ' style="width:'.$me_sw2.'px;"' : '';?>></div>
                                    <!-- </div> -->
                                    <?php } ?>
                                </li>


                                <?php }?>

                                <?php } //for ?>
                            </ul>
                            <!-- </div> -->
                            <?php } ?>
                        </li>
                        <?php } //for ?>

                        <?php if(!$menu_cnt) { ?>
                        <li class="flex-grow-1 order-2 me-li">
                            <a class="me-a f-md" href="javascript:;">테마설정 > 메뉴설정에서 메뉴를 등록해 주세요.</a>
                        </li>
                        <?php } ?>
                        <div
                            style="display: flex; flex-direction: row; justify-content: space-between; width: <?php echo $is_member ? '27.3691%;' : '9.12103' ?>">
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" title="채팅방"
                                    onclick="window.open('/bbs/chat.php','채팅방참여','width=520,height=520,scrollbars=yes,top=10,left=100'); ">
                                    <img src="<?php echo G5_URL?>/img/solid/comment.svg" style="height: 14px;"> 
                                </a>
                            </li>
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="<?php echo G5_BBS_URL ?>/logout.php" target="_self" title="로그아웃">
                                    <!--<i class="fa fa-wikipedia-w" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/baseline-input-24px.png">
                                </a>
                            </li>
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="https://facebook.com" target="_blank" title="페이스 북">
                                    <!--<i class="fa fa-twitter" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/solid/facebook-logo.svg" style="height: 14px;">
                                </a>
                            </li>
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="https://twitter.com" target="_blank" title="트위터">
                                    <!--<i class="fa fa-twitter" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/twitter.png">
                                </a>
                            </li>


                            <?php if($is_member) { ?>
                            <!-- <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="javascript:;"
                                    onclick="sidebar_open('sidebar-menu'); return false;" target="_self" title="마이페이지">
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <img src="<?php echo G5_URL?>/img/baseline-person-24px.png">
                                </a>
                            </li> -->
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="<?php echo G5_URL?>/bbs/member_list.php" target="_self"
                                    title="회원검색">
                                    <!--<i class="fa fa-search" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/icon_search.png">
                                </a>
                            </li>
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en" href="<?php echo G5_URL?>/bbs/noti.php" target="_self"
                                    title="알림확인">
                                    <!--<i class="fa fa-bell" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/baseline-notifications-24px.png">
                                    <?php if(IS_NA_NOTI) { // 알림 ?>
                                    <?php if ($member['as_noti']) { ?><b
                                        style="color: red"><?php echo number_format($member['as_noti']) ?></b><?php } ?>
                                    <?php } ?>
                                </a>

                            </li>
                            <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en win_memo" href="<?php echo G5_BBS_URL?>/memo.php" target="_blank"
                                    role="button" title="쪽지">
                                    <!--<i class="fa fa-envelope" aria-hidden="true"></i>-->
                                    <img src="<?php echo G5_URL?>/img/baseline-email-24px.png">
                                    <!-- maild irsen too -------------------------------------------------------sadf as df -->
                                    <?php if ($member['mb_memo_cnt']) { ?><b
                                        style="color: red"><?php echo number_format($member['mb_memo_cnt']);?></b><?php } ?>
                                    <!-- maild irsen too -------------------------------------------------------sadf as df -->
                                </a>

                            </li>
                            <!-- <li class="col p-0 me-li me-icon right_border">
                                <a class="me-a f-md en win_memo"
                                    href="<?php echo G5_BBS_URL?>/memo_friend.php?kind=friends" target="_blank"
                                    title="친구등록">
                                    <i class="fa fa-app-store" aria-hidden="true"></i>
                                    <img src="<?php echo G5_URL?>/img/baseline-person-add-24px.png">
                                </a>
                            </li> -->
                           
                        </div>
                        <?php } ?>
                    </ul>
                </div>
                <div class="me-icon order-1 me-li<?php echo ($is_index) ? ' on' : ' on'; ?>" style="width:43px;">
                    <a href="<?php echo NT_HOME_URL ?>" class="me-a f-md" title="메인화면">
                        <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                        <img src="<?php echo G5_URL?>/img/house.png">
                    </a>
                </div>
                <div class="me-icon order-3 me-li on" style="width:43px;">
                    <a href="javascript:;" onclick="sidebar_open('sidebar-menu'); return false;" class="me-a f-md"
                        title="마이메뉴">
                        <!-- <i class="fa fa-toggle-on" aria-hidden="true"></i> -->
                        <img src="<?php echo G5_URL?>/img/menu.png">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 전체 메뉴 -->
    <nav id="nt_menu_all" class="d-none d-md-block f-de font-weight-normal bg-white">
        <h3 class="sr-only">전체 메뉴</h3>
        <div id="menu_all" class="collapse">
            <div class="nt-container pt-4 px-3 px-sm-4 px-xl-0">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6">
                    <?php
					$az = 0;
					for ($i=0; $i < $menu_cnt; $i++) {

						$me = $menu[$i];

						// 줄나눔
						if($az && $az%$is_col_all == 0) {
							echo '</tr><tr>'.PHP_EOL;
						}
				?>
                    <div class="col">
                        <a class="d-block py-2 text-center border-bottom border-primary<?php echo ($me['on']) ? ' text-primary' : '';?>"
                            href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
                            <h5>
                                <i class="fa <?php echo $me['icon'] ?>" aria-hidden="true"></i>
                                <strong><?php echo $me['text'];?></strong>
                            </h5>
                        </a>
                        <?php if(isset($me['s'])) { //Is Sub Menu ?>
                        <ul class="p-3">
                            <?php for($j=0; $j < count($me['s']); $j++) {
									$me1 = $me['s'][$j];
							?>

                            <?php if($me1['line']) { //구분라인 ?>
                            <li class="sub-line text-black-50 pb-1 pt-2"><?php echo $me1['line'];?></li>
                            <?php } ?>

                            <li class="pb-1 sub-li">
                                <a href="<?php echo $me1['href'];?>"
                                    class="sub-a<?php echo ($me1['on']) ? ' on text-primary' : '';?>"
                                    target="<?php echo $me1['target'];?>">
                                    <img src="<?php echo G5_URL?>/img/solid/<?php echo substr($me1['icon'], 3, strlen($me1['icon'])) ?>.svg"
                                        style="height :14px;" aria-hidden="true">
                                    <!-- <i class="fa <?php echo $me1['icon'] ?> fa-fw" aria-hidden="true"></i> -->
                                    <?php echo $me1['text'];?>
                                </a>
                            </li>
                            <?php } //for ?>
                        </ul>
                        <?php } ?>
                    </div>
                    <?php $az++; } //for ?>
                </div>

                <div class="text-center">
                    <a href="javascript:;" class="btn border-0" data-toggle="collapse" data-target="#menu_all"
                        title="닫기">
                        <i class="fa fa-chevron-up fa-lg text-primary" aria-hidden="true"></i>
                        <span class="sr-only">전체메뉴 닫기</span>
                    </a>
                </div>
            </div>
        </div>
    </nav><!-- #nt_menu_all -->
</div><!-- #nt_menu_wrap -->

<script>
/* $(document).ready(function() {
	// 메뉴
	$('#nt_menu .nav-slide').nariya_menu();
}); */

$(function() {
    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();

        //method 1: remove show from sibilings and their children under your first parent

        /* 		if (!$(this).next().hasClass('show')) {

        		        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        		     }  */


        //method 2: remove show from all siblings of all your parents
        $(this).parents('.dropdown-submenu').siblings().find('.show').removeClass("show");

        $(this).siblings().toggleClass("show");


        //collapse all after nav is closed
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

    });
});

$('.nav-item .dropdown-submenu > a:not(a[href="#"])').on('click', function() {
    self.location = $(this).attr('href');
});
</script>
<!-- <?php if($tset['sticky']) { ?> -->
<script>
// 메뉴 상단 고정
function sticky_menu(e) {

    e.preventDefault();

    var scroll_n = window.scrollY || document.documentElement.scrollTop;
    var sticky_h = $("#nt_sticky").height();
    var menu_h = $("#nt_menu_wrap").height();

    if (scroll_n > (sticky_h - menu_h)) {
        $("#nt_menu_wrap").addClass("me-sticky");
        $("#nt_sticky").css('height', sticky_h + 'px');
    } else {
        $("#nt_sticky").css('height', 'auto');
        $("#nt_menu_wrap").removeClass("me-sticky");
    }
}
$(window).on('load', function() {
    $(window).scroll(sticky_menu);
    $(window).resize(sticky_menu);
});
</script>
<?php } ?>