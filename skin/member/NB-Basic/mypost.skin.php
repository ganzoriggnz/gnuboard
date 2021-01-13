<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
        <div class="px-3 px-sm-0">
            <div class="d-flex">
                <div id="user_cate_list" class="sly-wrap flex-grow-1">
                    <ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/userinfo.php">
                                <span>
                                    <i class="fa fa-user">
                                        회원정보
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                    <i class="fa fa-pencil-alt">
                                        내 글
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                    <i class="fa fa-book">
                                        파편조각 :
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                    <i class="fa fa-gem">
                                        파운드 : <b><?php echo number_format($member['mb_point']); ?></b>
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                    <i class="fa fa-paperclip">
                                        스크랩
                                    </i>
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                    <i class="fa fa-cubes">
                                        쿠폰지원
                                    </i>
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($member['mb_level'] < 23) { ?>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                    <i class="fa fa-handshake">
                                        쿠폰관리
                                    </i>
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                            <li>

                                <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/myreview.php">
                                    <span>
                                        <i class="fa fa-pencil-alt">
                                            후기보기
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <hr />
                </div>
            </div>
        </div>
    </nav>
    <!-- 스크랩 목록 시작 { -->

    <section id="bo_list" class="mb-4">
        <div id="scrap_info" class="font-weight-normal px-3 pb-2 pt-4">
            전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
        </div>

        <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


        <!-- 목록 헤드 -->
        <div class="d-block d-md-none w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>

        <div class="na-table d-none d-md-table w-100 mb-0">
            <div class="na-table-head border-primary d-md-table-row bg-light">
                <div class="d-md-table-cell nw-4 px-md-1">그룹</div>
                <div class="d-md-table-cell nw-6 px-md-1 pr-md-1">게시판</div>
                <div class="d-md-table-cell nw-20 pl-2 px-md-1 pr-md-1">제목</div>
                <div class="d-md-table-cell nw-6 pr-md-1">작성자</div>
                <div class="d-md-table-cell nw-4 pr-md-1">일시</div>
            </div>
        </div>


        <!-- hulan nemsen -->
        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
            <?php $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
        }
        else {
            $result = sql_query("select bo_table from {$g5['board_table']} ");
        }
            while ($row = sql_fetch_array($result)) {
                $bo_table = $row['bo_table'];
            
                if ($member['mb_level'] == 26 || $member['mb_level'] == 27){
                $res = sql_fetch("select * from " . $g5['write_prefix'] . $bo_table . " where mb_id='{$member['mb_id']}'");
                if ($res) {
                    $wr_id = $res['wr_id'];
                    $nowbo_table = $bo_table;
                        $result1 = sql_fetch("select bo_subject from {$g5['board_table']} where bo_table='{$bo_table}'");
                    }
                }
                else{
                    $sql = sql_query("select * from " . $g5['write_prefix'] . $bo_table . " where mb_id='{$member['mb_id']}'");
                for($i =0; $res = sql_fetch_array($sql); $i++){
                    $wr_id = $res[$i]['wr_id'];
                    $result1[$i] = sql_fetch("select bo_subject from {$g5['board_table']} where bo_table='{$bo_table}'");
                    
                }
                }
                if ($result1) {
                    
                        $bo_subject = $result1['bo_subject'];
                        if($is_admin){
                            $bo_subject = $result1[$i]['bo_subject'];
                        }
                    }
                
            } ?>
            <ul class="na-table d-md-table w-100">
                <?php
                for ($i = 0; $i < count($list); $i++) { ?>

                    <li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
                        <div class="d-none d-md-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
                            <?php echo "출근부"; ?>
                        </div>
                        <div class="d-none d-md-table-cell nw-6 text-left f-sm font-weight-normal py-md-2 px-md-1">
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $nowbo_table ?>" style="color: #6c757d;">
                                <?php if($is_admin){ echo 
                            $list[$i]['bo_subject'] ;
                        } else echo  $bo_subject; ?></a>
                        </div>
                        <div class="float-right float-md-none d-md-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $nowbo_table ?><?php echo "&wr_id=", $wr_id ?>" style="color: #6c757d;">
                                <?php echo $list[$i]['as_subject']; ?>
                            </a>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <?php echo get_level($member['mb_id']), $member['mb_nick']; ?>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-4 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <span class="sr-only">등록일</span>
                            <?php echo $list[$i]['as_datetime']; ?>
                        </div>
                        <div class="clearfix d-block d-md-none"></div>
                    </li>
            <?php  }
            ?>

            </ul>
            <?php if ($i == 0) { ?>
                <div class="f-de font-weight-normal px-3 py-5 text-muted text-center border-bottom">자료가 없습니다.</div>
            <?php } ?>
            <div class="font-weight-normal px-3 mt-4">
                <ul class="pagination justify-content-center en mb-0">
                    <?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page="); ?>
                </ul>
            </div>
    </section>
</div>