<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/* 리스트형 게시판 목록 */

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $list_skin_url . '/list.css">', 0);

// 목록 헤드
$head_color = ($boset['head_color']) ? $boset['head_color'] : 'primary';
if ($boset['head_skin']) {
    add_stylesheet('<link rel="stylesheet" href="' . NA_URL . '/skin/head/' . $boset['head_skin'] . '.css">', 0);
    $head_class = 'list-head';
} else {
    $head_class = 'na-table-head border-' . $head_color;
}

// 글 이동
$is_list_link = false;
switch ($boset['target']) {
    case '1':
        $target = ' target="_blank"';
        break;
    case '2':
        $is_list_link = true;
        break;
    case '3':
        $target = ' target="_blank"';
        $is_list_link = true;
        break;
    default:
        $target = '';
        break;
}

// 글 수
if ($gr_id == 'attendance') {
    //shuffle($list);
    $sortBy = array();
	foreach ($list as $key => $item) {
		$sortBy[$key] = $item['lvl_27'];
	}
	array_multisort($sortBy, SORT_DESC, $list);

	$listWith27 = array();
	$listWithout27 = array();
    $listWith27_hasCoupon = array();
	$listWith27_noCoupon = array();
    $listWithout27_hasCoupon = array();
	$listWithout27_noCoupon = array();
	foreach ($list as $key => $item) {
		if ($item['lvl_27']) {
			array_push($listWith27, $item);
		} else {
			array_push($listWithout27, $item);
		}
	}

    $sortByCoupon27 = array();
	foreach ($listWith27 as $key => $item) {
		$sortByCoupon27[$key] = $item['has_coupon'];
	}  
	array_multisort($sortByCoupon27, SORT_DESC, $listWith27);

    $sortByCoupon26 = array();
	foreach ($listWithout27 as $key => $item) {
		$sortByCoupon26[$key] = $item['has_coupon'];
	}  
	array_multisort($sortByCoupon26, SORT_DESC, $listWithout27);

    foreach ($listWith27 as $key => $item) {
		if ($item['has_coupon']) {
			array_push($listWith27_hasCoupon, $item);
		} else {
			array_push($listWith27_noCoupon, $item);
		}
	}

    foreach ($listWithout27 as $key => $item) {
		if ($item['has_coupon']) {
			array_push($listWithout27_hasCoupon, $item);
		} else {
			array_push($listWithout27_noCoupon, $item);
		}
	}

    $hascoupon_cnt1=count($listWith27_hasCoupon);
    $hascoupon_cnt2=count($listWithout27_hasCoupon);
    $hascoupon_cnt=intval($hascoupon_cnt1+$hascoupon_cnt2);
	shuffle($listWith27_hasCoupon);
	shuffle($listWith27_noCoupon);
    shuffle($listWithout27_hasCoupon);
	shuffle($listWithout27_noCoupon);

	$list = array_merge($listWith27_hasCoupon, $listWithout27_hasCoupon,$listWith27_noCoupon,$listWithout27_noCoupon);
    $list_cnt = count($list);
} else {
    $list_cnt = count($list);
}
?>

<style>
    @media only screen and (max-width: 667px) {
        .member_photo {
            display: none;
        }

        .datetime {
            color: black;
            padding-top: 4px;
        }

        .datetime,
        .username {
            font-size: 10px;
        }

        .eye {
            font-size: 10px;
            display: flex;
            align-items: center;
            width: 40px;
            justify-content: flex-start;
        }

        .eye i {
            padding-top: 3px;
        }

        .eye p {
            padding-top: 4px;
            margin-left: 3px;
        }
    }
</style>

<section id="bo_list" class="mb-4 <?php echo G5_IS_MOBILE ? ' mt-1 ' : '' ?>">
    <!-- 목록 헤드 -->
    <div class="d-block d-md-none w-100 mb-0 bg-<?php echo $head_color ?>" style="height:1px;"></div>

    <div class="mb-0 na-table d-none d-md-table w-100">
        <div class="<?php echo $head_class ?> d-md-table-row">
            <?php if ($gr_id != 'attendance') { ?>
                <div class="d-md-table-cell nw-5 px-md-1">번호</div>
            <?php } ?>
            <div class="d-md-table-cell pr-md-1">
                <?php if ($is_checkbox) { ?>
                    <label class="float-left mb-0">
                        <input type="checkbox" onclick="if (this.checked) all_checked(true); else all_checked(false);">
                    </label>
                <?php } ?>
                제목
            </div>
            <div class="pl-2 text-center d-md-table-cell nw-14 pr-md-1">이름</div>
            <?php if ($gr_id != 'attendance') { ?>
                <div class="d-md-table-cell nw-6 pr-md-1"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a>
                </div>
                <div class="d-md-table-cell nw-4 pr-md-1"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></div>
            <?php } ?>
        </div>
    </div>
    <?php if($gr_id =='attendance') { ?>
        <div class="<?php if($hascoupon_cnt >'0') echo 'coupon_border'; else echo ''; ?> <?php echo G5_IS_MOBILE ? 'mx-3' : 'w-100' ?>">
        <ul class="na-table d-md-table w-100">
        <?php
        if($hascoupon_cnt > '0'){
            for ($i = 0; $i < $hascoupon_cnt; $i++) {
                // hulan nemsen member table.회원 정보 가져오기
                $mb = get_member($list[$i]['mb_id']);
                $title = $board['bo_subject'] . '(게시판명) | 밤의제국 - bamje.com | ' . $list[$i]['subject'];
                //아이콘 체크
                $wr_icon = '';
                $is_lock = false;
                if ($list[$i]['icon_secret']) {
                    $wr_icon = '<span class="na-icon na-secret"></span>';
                    $is_lock = true;
                } else if ($list[$i]['icon_hot']) {
                    $wr_icon = '<span class="na-icon na-hot"></span>';
                } else if ($list[$i]['icon_new']) {
                    $wr_icon = '<span class="na-icon na-new"></span>';
                }
    
                // 링크 이동
                if ($is_list_link && $list[$i]['wr_link1']) {
                    $list[$i]['href'] = $list[$i]['link_href'][1];
                }
    
                // 전체 보기에서 분류 출력하기 //hulan nemsen 후기, 출근부에 분류 안 보이게
                if ($board['gr_id'] !== "review" && $board['gr_id'] !== "attendance") {
                    if (!$sca && $is_category && $list[$i]['ca_name']) {
                        $list[$i]['subject'] = "<span style='color: #000;'></span>" . $list[$i]['subject'];
                    }
                }
    
                // 공지, 현재글 스타일 체크
                $li_css = '';
                if ($list[$i]['is_notice']) { // 공지사항
                    $li_css = ' bg-light';
                    //$list[$i]['num'] = '<span class="na-notice" ></span><span class="sr-only"></span>';
                    $list[$i]['num2'] = '<span class="na-notice d-md-none" ></span><span class="sr-only"></span>';
                    $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
                }
                if ($list[$i]['is_eventcheck']) { // 공지사항
                    $li_css = ' bg-light';
                    $list[$i]['num'] = '<span class="na-event" ></span><span class="sr-only"></span>';
                    $list[$i]['num2'] = '<span class="na-event d-md-none" ></span><span class="sr-only"></span>';
                    $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
                }
                if ($list[$i]['is_best']) { // 공지사항
                    $li_css = ' bg-light';
                    $list[$i]['num'] = '<span class="na-best" ></span><span class="sr-only"></span>';
                    $list[$i]['num2'] = '<span class="na-best d-md-none" ></span><span class="sr-only"></span>';
                    $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
                } 
                /* if ($list[$i]['is_coupon']) {
                    $li_css = ' bg-light';
                    $list[$i]['num'] = '<span class="na-coupon" ></span><span class="sr-only"></span>';
                    $list[$i]['num2'] = '<span class="na-coupon d-md-none" ></span><span class="sr-only"></span>';
                    $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
                } */
                else if ($wr_id == $list[$i]['wr_id']) {
                    $li_css = ' bg-light';
                    $list[$i]['num'] = '<span class="na-text text-primary">열람</span>';
                    $list[$i]['num2'] = '<span class="na-text text-primary d-md-none">열람</span>';
                    $list[$i]['subject'] = '<b class="text-primary">' . $list[$i]['subject'] . '</b>';
                } else {
                    $list[$i]['num'] = '<span class="sr-only">번호</span>' . $list[$i]['num'];
                }
                
                if (!strstr($list[$i]['wr_option'], "secret") || $is_admin || ($list[$i]['mb_id'] == $member['mb_id'] && strstr($list[$i]['wr_option'], "secret") && $board['bo_table'] == 'twitter')) { ?>
                    <li class="p-0 d-md-table-row <?php echo G5_IS_MOBILE ? '' : 'px-3' ;?> py-2 p-md-0 text-md-center text-muted border-bottom<?php echo $li_css; ?>">
                        <div class="<?php echo G5_IS_MOBILE ? 'text-left' : 'text-center'; ?> d-md-table-cell pr-md-1 py-md-2">
                            <div class="na-title float-md-left">
                                <div class="na-item">
                                    <?php if($gr_id == 'attendance' && $list[$i]['has_coupon'])  echo '<img src="'.G5_URL.'/nariya/img/coupon2.png" class="title_icon icon_img" alt="쿠폰후기">'; ?>
                                    <!-- <?php if ($list[$i]['wr_2']) echo '<i class="fa fa-mobile" aria-hidden="true"></i>&nbsp; ';
                                            echo $list[$i]['num2'] ?> -->
                                    <?php if ($is_checkbox) { ?>
                                        <input type="checkbox" class="mb-0 mr-2" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                                    <?php } ?>
                                    <a href="<?php echo $list[$i]['href'] ?>" class="na-subject" <?php echo $target ?> title="<?php echo strip_tags($title); ?>" 
                                    <?php if (strstr($list[$i]['wr_option'], "secret") && $is_admin) { echo "style='color:#bababa;text-decoration: line-through' ". PHP_EOL;}
                                           if ($list[$i]['wr_1']) { echo " style='color:" . $list[$i]['wr_1'] . "' ". PHP_EOL;} ?> >
                                        <?php
                                        if ($list[$i]['icon_reply'])
                                            echo '<span class="na-hicon na-reply" ></span>' . PHP_EOL;
                                        echo $wr_icon;
                                        ?>
                                        <!-- hulan nemsen 후기, 출근부 업소명 출력부분 -->
                                        <?php
                                        if ($board['gr_id'] == "review") { ?>
                                            <span style="color: #000;" class="font-weight-bold">
                                                <?php echo "[" . $list[$i]['wr_7'] . "]" ?>
                                            </span>
                                        <?php echo $list[$i]['subject'];
                                        } elseif ($board['gr_id'] == "attendance") { ?>
                                            <span style="color: #000;" class="font-weight-bold">
                                                <?php echo "[" . $mb['mb_name'] . "]" ?>
                                            </span>
                                        <?php echo $list[$i]['subject'];
                                        } elseif (($board['gr_id'] == "community" && $bo_table == "free") || ($board['gr_id'] == "library" && $bo_table == "ucc") || ($board['gr_id'] == "service" && $bo_table == "job")) { ?>
                                            <span style="color: #000;">
                                                <?php echo "[" . $list[$i]['ca_name'] . "]" ?>
                                            </span>
                                        <?php echo $list[$i]['subject'];
                                        } else {
                                            echo  $list[$i]['subject'];
                                        } ?>
    
                                    </a>
                                    <?php
                                    if (isset($list[$i]['icon_file']))
                                        echo '<span class="na-ticon na-file"></span>' . PHP_EOL;
                                    ?>
                                    <?php if ($list[$i]['wr_comment']) { ?>
                                        <div class="na-info">
                                            <span class="sr-only">댓글</span>
                                            <span class="count-plus orangered">
                                                <?php echo $list[$i]['wr_comment'] ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="float-right text-left float-md-none d-md-table-cell nw-15 nw-md-auto f-sm">
                            <div class="na_member_pho" style="width:180px !important;">
                                <span class="sr-only">등록자</span>
                                <?php
                                $mbid = get_member($list[$i]['mb_id']);
                                $name = get_sideview($mbid['mb_id'], $mbid['mb_nick'], $mbid['mb_homepage']);
                                /* echo $list[$i]['wr_2']; */
                                echo na_name_photo($list[$i]['mb_id'], $name)
                                ?>
                            </div>
                        </div>
                        <?php if ($gr_id != 'attendance') { ?>
                            <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm">
                                <span class="sr-only">등록일</span>
                                <p class="datetime"><?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
                                </p>
                            </div>
                            <div class="float-left float-md-none d-md-table-cell nw-4 nw-md-auto f-sm">
                                <span class="sr-only">조회</span>
                                <div class="eye">
                                    <i class="fa fa-eye d-md-none" aria-hidden="true"></i>
                                    <?php echo "<p>" . $list[$i]['wr_hit'] . "</p>" ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <?php if ($is_good) { ?>
                        <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <i class="fa fa-thumbs-o-up d-md-none" aria-hidden="true"></i>
                            <span class="sr-only">추천</span>
                            <small><?php echo $list[$i]['wr_good'] ?></small>
                        </div>
                    <?php } ?>
                    <?php if ($is_nogood) { ?>
                        <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <i class="fa fa-thumbs-o-down d-md-none" aria-hidden="true"></i>
                            <span class="sr-only">비추천</span>
                            <small><?php echo $list[$i]['wr_nogood'] ?></small>
                        </div>
                    <?php } ?> -->
                        <div class="clearfix d-block d-md-none"></div>
                    </li>
                <?php } ?>
            <?php } 
        } ?>
        
            </ul></div><ul class="na-table d-md-table w-100">
        <?php for ($i = ($hascoupon_cnt >'0'?$hascoupon_cnt :'0'); $i < $list_cnt; $i++) {
            // hulan nemsen member table.회원 정보 가져오기
            $mb = get_member($list[$i]['mb_id']);
            $title = $board['bo_subject'] . '(게시판명) | 밤의제국 - bamje.com | ' . $list[$i]['subject'];
            //아이콘 체크
            $wr_icon = '';
            $is_lock = false;
            if ($list[$i]['icon_secret']) {
                $wr_icon = '<span class="na-icon na-secret"></span>';
                $is_lock = true;
            } else if ($list[$i]['icon_hot']) {
                $wr_icon = '<span class="na-icon na-hot"></span>';
            } else if ($list[$i]['icon_new']) {
                $wr_icon = '<span class="na-icon na-new"></span>';
            }
            // var_dump($list[$i]['href']);die;
            // 링크 이동
            if ($is_list_link && $list[$i]['wr_link1']) {
                $list[$i]['href'] = $list[$i]['link_href'][1];
            }
            if($mbid['mb_id'] && !$sca){
                $list[$i]['href'] .= "&sca=".$list[$i]['ca_name'];
            }
            // 전체 보기에서 분류 출력하기 //hulan nemsen 후기, 출근부에 분류 안 보이게
            if ($board['gr_id'] !== "review" && $board['gr_id'] !== "attendance") {
                if (!$sca && $is_category && $list[$i]['ca_name']) {
                    $list[$i]['subject'] = "<span style='color: #000;'></span>" . $list[$i]['subject'];
                }
            }

            // 공지, 현재글 스타일 체크
            $li_css = '';
            if ($list[$i]['is_notice']) { // 공지사항
                $li_css = ' bg-light';
                //$list[$i]['num'] = '<span class="na-notice" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-notice d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            }
            if ($list[$i]['is_eventcheck']) { // 공지사항
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-event" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-event d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            }
            if ($list[$i]['is_best']) { // 공지사항
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-best" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-best d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            } 
            /* if ($list[$i]['is_coupon']) {
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-coupon" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-coupon d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            } */
            else if ($wr_id == $list[$i]['wr_id']) {
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-text text-primary">열람</span>';
                $list[$i]['num2'] = '<span class="na-text text-primary d-md-none">열람</span>';
                $list[$i]['subject'] = '<b class="text-primary">' . $list[$i]['subject'] . '</b>';
            } else {
                $list[$i]['num'] = '<span class="sr-only">번호</span>' . $list[$i]['num'];
            }
            
            if (!strstr($list[$i]['wr_option'], "secret") || $is_admin || ($list[$i]['mb_id'] == $member['mb_id'] && strstr($list[$i]['wr_option'], "secret") && $board['bo_table'] == 'twitter')) { ?>
                <li class="p-0 d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom<?php echo $li_css; ?>">
                    <div class="<?php echo G5_IS_MOBILE ? 'text-left' : 'text-center'; ?> d-md-table-cell pr-md-1 py-md-2">
                        <div class="na-title float-md-left">
                            <div class="na-item">
                                <?php if($gr_id == 'attendance' && $list[$i]['has_coupon'])  echo '<img src="'.G5_URL.'/nariya/img/coupon2.png" class="title_icon icon_img" alt="쿠폰후기">'; ?>
                                    <?php if ($is_checkbox) : ?>
                                        <input type="checkbox" class="mb-0 mr-2" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                                    <?php endif; ?>
                                    <a href="<?php echo $list[$i]['href']?>" class="na-subject" <?php echo $target ?> title="<?php echo strip_tags($title); ?>" 
                                    <?php 
                                        if (strstr($list[$i]['wr_option'], "secret") && $is_admin) { echo "style='color:#bababa;text-decoration: line-through' ". PHP_EOL;}
                                        if ($list[$i]['wr_1']) { echo " style='color:" . $list[$i]['wr_1'] . "' ". PHP_EOL;} ?> >
                                    <?php 
                                        if ($list[$i]['icon_reply'])
                                            echo '<span class="na-hicon na-reply" ></span>' . PHP_EOL;
                                        echo $wr_icon;?>
                                    <!-- hulan nemsen 후기, 출근부 업소명 출력부분 -->
                                    <?php
                                    if ($board['gr_id'] == "review") { ?>
                                        <span style="color: #000;" class="font-weight-bold">
                                            <?php echo "[" . $list[$i]['wr_7'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } elseif ($board['gr_id'] == "attendance") { ?>
                                        <span style="color: #000;" class="font-weight-bold">
                                            <?php echo "[" . $mb['mb_name'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } elseif (($board['gr_id'] == "community" && $bo_table == "free") || ($board['gr_id'] == "library" && $bo_table == "ucc") || ($board['gr_id'] == "service" && $bo_table == "job")) { ?>
                                        <span style="color: #000;">
                                            <?php echo "[" . $list[$i]['ca_name'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } else {
                                        echo  $list[$i]['subject'];
                                    } ?>

                                </a>
                                <?php
                                if (isset($list[$i]['icon_file']))
                                    echo '<span class="na-ticon na-file"></span>' . PHP_EOL;
                                ?>
                                <?php if ($list[$i]['wr_comment']) { ?>
                                    <div class="na-info">
                                        <span class="sr-only">댓글</span>
                                        <span class="count-plus orangered">
                                            <?php echo $list[$i]['wr_comment'] ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="float-right text-left float-md-none d-md-table-cell nw-15 nw-md-auto f-sm">
                        <div class="na_member_pho"  style="width:180px !important;">
                            <span class="sr-only">등록자</span>
                            <?php
                            $mbid = get_member($list[$i]['mb_id']);
                            $name = get_sideview($mbid['mb_id'], $mbid['mb_nick'], $mbid['mb_homepage']);
                            /* echo $list[$i]['wr_2']; */
                            echo na_name_photo($list[$i]['mb_id'], $name)
                            ?>
                        </div>
                    </div>
                    <?php if ($gr_id != 'attendance') { ?>
                        <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm">
                            <span class="sr-only">등록일</span>
                            <p class="datetime"><?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
                            </p>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-4 nw-md-auto f-sm">
                            <span class="sr-only">조회</span>
                            <div class="eye">
                                <i class="fa fa-eye d-md-none" aria-hidden="true"></i>
                                <?php echo "<p>" . $list[$i]['wr_hit'] . "</p>" ?>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <?php if ($is_good) { ?>
                    <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                        <i class="fa fa-thumbs-o-up d-md-none" aria-hidden="true"></i>
                        <span class="sr-only">추천</span>
                        <small><?php echo $list[$i]['wr_good'] ?></small>
                    </div>
                <?php } ?>
                <?php if ($is_nogood) { ?>
                    <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                        <i class="fa fa-thumbs-o-down d-md-none" aria-hidden="true"></i>
                        <span class="sr-only">비추천</span>
                        <small><?php echo $list[$i]['wr_nogood'] ?></small>
                    </div>
                <?php } ?> -->
                    <div class="clearfix d-block d-md-none"></div>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <?php if (!$list_cnt) { ?>
        <div class="px-3 py-5 text-center f-de font-weight-normal text-muted border-bottom">게시물이 없습니다.</div>
    <?php }     
    } else {?>

       <ul class="na-table d-md-table w-100">
        <?php $count = $list_cnt+1; for ($i = 0; $i < $list_cnt; $i++) {
            // hulan nemsen member table.회원 정보 가져오기
            $mb = get_member($list[$i]['mb_id']);
            $title = $board['bo_subject'] . '(게시판명) | 밤의제국 - bamje.com | ' . $list[$i]['subject'];
            //아이콘 체크
            $wr_icon = '';
            $is_lock = false;
            if ($list[$i]['icon_secret']) {
                $wr_icon = '<span class="na-icon na-secret"></span>';
                $is_lock = true;
            } else if ($list[$i]['icon_hot']) {
                $wr_icon = '<span class="na-icon na-hot"></span>';
            } else if ($list[$i]['icon_new']) {
                $wr_icon = '<span class="na-icon na-new"></span>';
            }

            // 링크 이동
            if ($is_list_link && $list[$i]['wr_link1']) {
                $list[$i]['href'] = $list[$i]['link_href'][1];
            }

            // 전체 보기에서 분류 출력하기 //hulan nemsen 후기, 출근부에 분류 안 보이게
            if ($board['gr_id'] !== "review" && $board['gr_id'] !== "attendance") {
                if (!$sca && $is_category && $list[$i]['ca_name']) {
                    $list[$i]['subject'] = "<span style='color: #000;'></span>" . $list[$i]['subject'];
                }
            }

            // 공지, 현재글 스타일 체크
            $li_css = '';
            if ($list[$i]['is_notice']) { // 공지사항
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-notice" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-notice d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            }
            if ($list[$i]['is_eventcheck']) { // 공지사항
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-event" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-event d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            }
            if ($list[$i]['is_best']) { // 공지사항
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-best" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-best d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = '<strong>' . $list[$i]['subject'] . '</strong>';
            } 
            if ($list[$i]['is_coupon']) {
                //$li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-coupon" ></span><span class="sr-only"></span>';
                $list[$i]['num2'] = '<span class="na-coupon d-md-none" ></span><span class="sr-only"></span>';
                $list[$i]['subject'] = $list[$i]['subject'];
            }
            else if ($wr_id == $list[$i]['wr_id']) {
                $li_css = ' bg-light';
                $list[$i]['num'] = '<span class="na-text text-primary">열람</span>';
                $list[$i]['num2'] = '<span class="na-text text-primary d-md-none">열람</span>';
                $list[$i]['subject'] = '<b class="text-primary">' . $list[$i]['subject'] . '</b>';
            } else {
                $list[$i]['num'] = '<span class="sr-only" style="margin-left:15px;">번호</span><span>' . ($list[$i]['num']).'</span>';
            }
            
            if (!strstr($list[$i]['wr_option'], "secret") || $is_admin || ($list[$i]['mb_id'] == $member['mb_id'] && strstr($list[$i]['wr_option'], "secret") && $board['bo_table'] == 'twitter')) { ?>
                <li class="p-0 d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom<?php echo $li_css; ?>">
                    <div class="<?php echo G5_IS_MOBILE ? 'text-left' : 'text-center'; ?> d-md-table-cell pr-md-1 py-md-2">
                        <div class="na-title float-md-left">
                            <div class="na-item">
                            <div class="d-md-table-cell nw-5 font-weight-normal <?php if($list[$i]['is_coupon'] && !G5_IS_MOBILE) echo ''; else echo 'd-none'; ?>">
                            <?php echo $list[$i]['num']; ?>
                            </div>
                                <?php if ($is_checkbox) { ?>
                                    <input type="checkbox" class="mb-0 mr-2" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                                <?php } ?>
                                <a href="<?php echo $list[$i]['href'] ?>" class="na-subject" <?php echo $target ?> title="<?php echo strip_tags($title); ?>" 
                                <?php if (strstr($list[$i]['wr_option'], "secret") && $is_admin) { echo "style='color:#bababa;text-decoration: line-through' ". PHP_EOL;}
                                       if ($list[$i]['wr_1']) { echo " style='color:" . $list[$i]['wr_1'] . "' ". PHP_EOL;} ?> >
                                    <?php
                                    if ($list[$i]['icon_reply'])
                                        echo '<span class="na-hicon na-reply" ></span>' . PHP_EOL;
                                    echo $wr_icon;
                                    ?>
                                    <!-- hulan nemsen 후기, 출근부 업소명 출력부분 -->
                                    <?php
                                    if ($board['gr_id'] == "review") { ?>
                                        <span style="color: #000;" class="font-weight-bold">
                                            <?php echo "[" . $list[$i]['wr_7'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } elseif ($board['gr_id'] == "attendance") { ?>
                                        <span style="color: #000;" class="font-weight-bold">
                                            <?php echo "[" . $mb['mb_name'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } elseif (($board['gr_id'] == "community" && $bo_table == "free") || ($board['gr_id'] == "library" && $bo_table == "ucc") || ($board['gr_id'] == "service" && $bo_table == "job")) { ?>
                                        <span style="color: #000;">
                                            <?php echo "[" . $list[$i]['ca_name'] . "]" ?>
                                        </span>
                                    <?php echo $list[$i]['subject'];
                                    } else {
                                        echo  $list[$i]['subject'];
                                    } ?>

                                </a>
                                <?php
                                if (isset($list[$i]['icon_file']))
                                    echo '<span class="na-ticon na-file"></span>' . PHP_EOL;
                                ?>
                                <?php if ($list[$i]['wr_comment']) { ?>
                                    <div class="na-info">
                                        <span class="sr-only">댓글</span>
                                        <span class="count-plus orangered">
                                            <?php echo $list[$i]['wr_comment'] ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="float-right text-left float-md-none d-md-table-cell nw-15 nw-md-auto f-sm">
                        <div class="na_member_pho"  style="width:180px !important;">
                            <span class="sr-only">등록자</span>
                            <?php
                            $mbid = get_member($list[$i]['mb_id']);
                            $name = get_sideview($mbid['mb_id'], $mbid['mb_nick'], $mbid['mb_homepage']);
                            /* echo $list[$i]['wr_2']; */
							if($list[$i]['wr_4']=='Y'){
								echo '<span class="profile_img"><img class="member_photo" src="/img/no_profile.gif" width="22" height="22" style="border-radius:50%;" alt="" title=""></span> 익명';
							} else {
	                            echo na_name_photo($list[$i]['mb_id'], $name);
							}
                            ?>
                        </div>
                    </div>
                    <?php if ($gr_id != 'attendance') { ?>
                        <?php if(G5_IS_MOBILE) { ?>
                        <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm">
                            <span class="sr-only">등록일</span>
                            <?php if($list[$i]['is_coupon']) echo '<img src="'.G5_URL.'/nariya/img/coupon_review.png" class="title_icon" alt="쿠폰후기">'; ?>
                        </div>
                       <?php } ?>
                        
                        <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm">
                            <span class="sr-only">등록일</span>
                            <p class="datetime"><?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
                            </p>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-4 nw-md-auto f-sm">
                            <span class="sr-only">조회</span>
                            <div class="eye">
                                <i class="fa fa-eye d-md-none" aria-hidden="true"></i>
                                <?php echo "<p>" . $list[$i]['wr_hit'] . "</p>" ?>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <?php if ($is_good) { ?>
                    <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                        <i class="fa fa-thumbs-o-up d-md-none" aria-hidden="true"></i>
                        <span class="sr-only">추천</span>
                        <small><?php echo $list[$i]['wr_good'] ?></small>
                    </div>
                <?php } ?>
                <?php if ($is_nogood) { ?>
                    <div class="float-left float-md-none d-md-table-cell nw-3 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                        <i class="fa fa-thumbs-o-down d-md-none" aria-hidden="true"></i>
                        <span class="sr-only">비추천</span>
                        <small><?php echo $list[$i]['wr_nogood'] ?></small>
                    </div>
                <?php } ?> -->
                    <div class="clearfix d-block d-md-none"></div>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <?php if (!$list_cnt) { ?>
        <div class="px-3 py-5 text-center f-de font-weight-normal text-muted border-bottom">게시물이 없습니다.</div>
    <?php }

    } ?>
     
</section>