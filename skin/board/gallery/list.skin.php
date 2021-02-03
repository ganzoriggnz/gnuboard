<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
?>


<!-- 게시판 목록 시작 { -->
<div id="bo_gall" >

    <?php if ($is_category) { ?>
        <nav id="bo_cate">
            <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
            <ul id="bo_cate_ul">
                <?php echo $category_option ?>
            </ul>
        </nav>
        <nav id="bo_subcate">
            <h2><?php echo $board['bo_subject'] ?> subcategory</h2>
            <ul id="bo_subcate_ul pb-5">
                <?php echo $subcategory_option ?>
            </ul>
        </nav>
        <nav id="bo_subcate">
            <h2><?php echo $board['bo_subject'] ?> subcategory</h2>
            <ul id="bo_subcate_ul">
                <?php include_once($search_skin_path . '/search2.skin.php'); 
               ?>
            </ul>
        </nav>
    <?php }

    $search_table = array();
    $table_index = 0;
    $write_pages = "";
    $text_stx = "";
    $srows = 0;

    //-------------------------------------------------------------------------
    $wset['thumb_w'] = ($wset['thumb_w'] == "") ? 400 : (int)$wset['thumb_w'];
    $wset['thumb_h'] = ($wset['thumb_h'] == "") ? 225 : (int)$wset['thumb_h'];

    if ($wset['thumb_w'] && $wset['thumb_h']) {
        $img_height = ($wset['thumb_h'] / $wset['thumb_w']) * 100;
    } else {
        $img_height = ($wset['thumb_d']) ? $wset['thumb_d'] : '56.25';
    }

    $wsetss=$sca;
    $subcat=$subsca;
    $searchd=$searchd;
    $list = na_post_rows($wsetss,$subcat,$searchd); //
    $list_cnt = count($list);
    //-------------------------------------------------------------------------

    $group_select = '<label for="gr_id" class="sound_only">게시판 그룹선택</label><select name="gr_id" id="gr_id" class="select"><option value="">전체 분류';
    $sql = " select gr_id, gr_subject from {$g5['group_table']} order by gr_id ";
    $result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++)
        $group_select .= "<option value=\"" . $row['gr_id'] . "\"" . get_selected($_GET['gr_id'], $row['gr_id']) . ">" . $row['gr_subject'] . "</option>";
    $group_select .= '</select>';

    if (!$sfl) $sfl = 'wr_subject';
    if (!$sop) $sop = 'or';
    ?>

    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="sw" value="">

        <div id="bo_btn_top">

            <ul class="btn_bo_user">
                <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
                <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
                <?php if ($is_admin == 'super' || $is_auth) {  ?>
                    <li>
                        <button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
                        <?php if ($is_checkbox) { ?>
                            <ul class="more_opt is_list_btn">
                                <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
                                <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
                                <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
                            </ul>
                        <?php } ?>
                    </li>
                <?php }  ?>
            </ul>
        </div>
        <!-- <?php if ($is_checkbox) { ?>
            <div id="gall_allchk" class="all_chk chk_box">
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                <label for="chkall">
                    <span></span>
                    <b class="sound_only">현재 페이지 게시물 </b> 전체선택
                </label>
            </div>
        <?php } ?> -->

        <ul id="gall_ul" class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4 row-cols-xl-5 mx-n2">
            <?php
            for ($i = 0; $i < $list_cnt; $i++) {
                $classes = array();
                $classes[] = 'col px-2 pb-4';
                $classes[] = 'col-gn-' . $bo_gallery_cols;
                if ($i && ($i % $bo_gallery_cols == 0)) {
                    $classes[] = 'box_clear';
                }
                if ($wr_id && $wr_id == $list[$i]['wr_id']) {
                    $classes[] = 'gall_now';
                }
            ?>
                <li class="col px-2 pb-4">
                    <div class="gall_box" style="background-image:url('<?php echo G5_IMG_URL ?>/main_bgpicture.png')" style="width: 100%; height: 148px;">
                        
                    <!-- <?php if ($is_checkbox) { ?>
                                <div class="gall_chk chk_box">
                                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                                    <label for="chk_wr_id_<?php echo $i ?>">
                                        <b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                                    </label>
                                </div>
                            <?php } ?> -->
                            <span class="sound_only">
                                <?php
                                if ($wr_id == $list[$i]['wr_id'])
                                    echo "<span class=\"bo_current\">열람중</span>";
                                else
                                    echo $list[$i]['num'];
                                ?>
                            </span>
                        <div class="gall_con">
                            <div class="gall_img">
                                <a href="#">
                                    <?php
                                    if ($list[$i]['is_notice']) { // 공지사항  
                                    ?>
                                        <span class="is_notice">공지</span>
                                    <?php } else {
                                        $picname = '';
                                        if ($list[$i]['mb_2'] == "안마") {
                                            $picname = "anma";
                                        } else if ($list[$i]['mb_2'] == "오피") {
                                            $picname = "office";
                                        } else if ($list[$i]['mb_2'] == "건마") {
                                            $picname = "gonma";
                                        } else if ($list[$i]['mb_2'] == "립카페") {
                                            $picname = "gibcafe";
                                        } else if ($list[$i]['mb_2'] == "휴게텔") {
                                            $picname = "hyugetel";
                                        }
                                        $imagee = '<img src="' . G5_IMG_URL . '/' . $picname . '.png">';
                                        echo $imagee;
                                    }
                                    ?>
                                </a>
                            </div>


                            <div class="gall_text_href" style="display: flex; justify-content: center; flex-direction: column; align-items: center; width: 100%; height: 80px;">
                                <!-- <?php if ($is_category && $list[$i]['ca_name']) { ?>
                        <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                        <?php } ?> -->
                                <a href="<?php echo $list[$i]['href'] ?>" class="bo_tit" style="font-size: 16px; color: #E73D2F; font-weight: bold; text-align:center;">
                                    <?php // echo $list[$i]['icon_reply']; 
                                    ?>
                                    <!-- 갤러리 댓글기능 사용시 주석을 제거하세요. -->

                                    <div class="na-title" style="display: flex; justify-content: center; flex-direction: column; align-items: center; height: 80px;">
                                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>&wr_id=<?php echo $list[$i]['wr_id']?>" class="na-subject" style="font-size: 16px; color: #E73D2F; font-weight: bold; overflow: hidden;" <?php echo $target ?>>
                                            <?php echo $wr_icon ?>
                                            <?php echo $list[$i]['mb_name'] ?>
                                        </a>
                                        <p style="font-weight: bold; overflow: hidden;"><?php
                                         echo $list[$i]['mb_addr2'] ?></p>
                                        <div style="display: flex; align-items: center; line-height: 1.5;">
                                            <p><?php echo $list[$i]['mb_hp'] ?></p>
                                        </div>
                                    </div>

                                    <?php
                                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                                    if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
                                    if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                                    //if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
                                    //if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                                    if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                                    ?>
                                    <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cnt_cmt"><?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span><?php } ?>
                                </a>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-evenly; background-image: url('<?php echo G5_IMG_URL ?>/main_780.png'); width: 100%; height: 52px;">
                            <div>
                            
                            <button type="button" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>&wr_id=<?php echo $list[$i]['wr_id']?>'" style="background-color: rgb(255, 255, 255, 0.05); font-size: 10px; font-weight: light; display: flex; flex-direction: column;align-items: center; justify-content: center; width: 43px; height: 35px; margin-left: 44px; padding: 2px 2px;"><img src="<?php echo G5_IMG_URL?>/baseline-ballot_main-24px.png"><!-- <i class="fa fa-calendar"></i> --> 정보</button>
                            </div>
                            <div>
                            <button type="button" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']?>'" style="background-color: rgb(255, 255, 255, 0.05); font-size: 10px; font-weight: light; display: flex;flex-direction: column; align-items: center; justify-content: center; width: 43px; height: 35px; margin-right: 44px; padding: 2px 2px;"><img src="<?php echo G5_IMG_URL?>/chat_icon_main.png"><!-- <i class="fa fa-comments"></i> --> 후기</button>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if (count($list) == 0) {
                echo "<li class=\"empty_list\">게시물이 없습니다.</li>";
            } ?>
        </ul>

        <?php echo $write_pages; ?>

        <?php if ($list_href || $is_checkbox || $write_href) { ?>
            <div class="bo_fx">
                <?php if ($list_href || $write_href) { ?>
                    <ul class="btn_bo_user">
                        <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
                        <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
                        <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
                    </ul>
                <?php } ?>
            </div>
        <?php } ?>
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sop" value="and">
                <label for="sfl" class="sound_only">검색대상</label>
                <select name="sfl" id="sfl">
                    <?php echo get_board_sfl_select_options($sfl); ?>
                </select>
                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <div class="sch_bar">
                    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
                    <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </div>
                <button type="button" class="bo_sch_cls"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function() {
            $('.bo_sch_wrap').hide();
        });
    </script>
    <!-- } 게시판 검색 끝 -->
</div>

<?php if ($is_checkbox) { ?>
    <noscript>
        <p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
    </noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
    <script>
        function all_checked(sw) {
            var f = document.fboardlist;

            for (var i = 0; i < f.length; i++) {
                if (f.elements[i].name == "chk_wr_id[]")
                    f.elements[i].checked = sw;
            }
        }

        function fboardlist_submit(f) {
            var chk_count = 0;

            for (var i = 0; i < f.length; i++) {
                if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                    chk_count++;
            }

            if (!chk_count) {
                alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
                return false;
            }

            if (document.pressed == "선택복사") {
                select_copy("copy");
                return;
            }

            if (document.pressed == "선택이동") {
                select_copy("move");
                return;
            }

            if (document.pressed == "선택삭제") {
                if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
                    return false;

                f.removeAttribute("target");
                f.action = g5_bbs_url + "/board_list_update.php";
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
            f.action = g5_bbs_url + "/move.php";
            f.submit();
        }

        // 게시판 리스트 관리자 옵션
        jQuery(function($) {
            $(".btn_more_opt.is_list_btn").on("click", function(e) {
                e.stopPropagation();
                $(".more_opt.is_list_btn").toggle();
            });
            $(document).on("click", function(e) {
                if (!$(e.target).closest('.is_list_btn').length) {
                    $(".more_opt.is_list_btn").hide();
                }
            });
        });
    </script>
<?php } ?>
<!-- } 게시판 목록 끝 -->