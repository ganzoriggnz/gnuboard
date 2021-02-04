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
                <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/userinfo.php" >
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img" style="height :13px;" >&nbsp
                                회원정보
                             
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img" style="height :13px;" >&nbsp
                                내 글
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li>
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img" style="height :13px;" >&nbsp
                                파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a>
                        </li>
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img" style="height :14px;" >&nbsp
                                스크랩
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/cubes.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰지원
                               
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($member['mb_level'] < 23) { ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰관리
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li class="active"> 
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/reply.svg" class="svg-img" style="height :14px;" >&nbsp
                                후기보기
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
<!-- 후기 목록 시작 { -->

<section id="bo_list" class="mb-4">
    <!-- <div id="scrap_info" class="font-weight-normal px-3 pb-2 pt-4">
		전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
    </div> -->
    <br>
    <br>
    <!-- hulan nemsen  -->
    <?php
    $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
    while ($row = sql_fetch_array($result)) {
        $bo_table = $row['bo_table'];
           
        $res = sql_fetch("select wr_id from " . $g5['write_prefix'] . $bo_table . " where mb_id='{$member['mb_id']}'");
        if ($res) {
            $scount = strlen($bo_table) - 2;
            $bo_table =  substr($bo_table, 0, $scount);?>
            <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table."re"?>">
            <font color="black"><b>후기게시판 바로가기</b></font>
        </a>
       <?php }
    }

    ?>
   
  

    <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


    <!-- 목록 헤드 -->
    <div class="d-block d-md-none w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>

    <div class="na-table d-none d-md-table w-100 mb-0">
        <div class="na-table-head border-primary d-md-table-row bg-light">
            <div class="d-md-table-cell nw-4 px-md-1">번호</div>
            <!-- <div class="d-md-table-cell nw-6 px-md-1 pr-md-1">게시판</div> -->
            <div class="d-md-table-cell nw-20 pl-2 px-md-1 pr-md-1">제목</div>
            <div class="d-md-table-cell nw-6 pr-md-1">작성자</div>
            <div class="d-md-table-cell nw-4 pr-md-1">일시</div>
        </div>
    </div>

    <ul class="na-table d-md-table w-100">
        <?php 
        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='review'");
        
        while ($row = sql_fetch_array($result)) {
            $bo_table = $row['bo_table'];
                $res = sql_query("select * from " . $g5['write_prefix'] . $bo_table . " where wr_7 ='{$member['mb_name']}'");
                while ($res1 = sql_fetch_array( $res)) {?>
                        
                    <li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
                        <div class="d-none d-md-table-cell nw-4 f-sm font-weight-normal py-md-2 px-md-1">
                            <?php echo $res1['wr_id'] ?>
                        </div>
                        <div class="float-right float-md-none d-md-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
                            <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table?><?php echo "&wr_id=",$res1['wr_id']?>" style="color: #6c757d;">
                                <?php echo $res1['wr_subject']; ?>
                            </a>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <span class="sr-only">작성자</span>
                            <?php echo get_level($res1['mb_id']), $res1['wr_name'] ?>
                        </div>
                        <div class="float-left float-md-none d-md-table-cell nw-4 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
                            <?php echo $res1['wr_datetime']; ?>
                        </div>
                        <div class="clearfix d-block d-md-none"></div>
                    </li>
               <?php  }
            
        } ?>

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