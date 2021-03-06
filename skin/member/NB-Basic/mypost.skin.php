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
                        <li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img" style="height :13px;" >&nbsp
                                내 글
                                </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li> -->
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
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰관리
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/level_info.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/medal.svg" class="svg-img" style="height :14px;" >&nbsp
                                레벨정보
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] < 24) { ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/giftbox.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gift.svg" class="svg-img" style="height :14px;" >&nbsp
                                선물함
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li > 
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
    <!-- 스크랩 목록 시작 { -->
    <style>
        .w-10 {width: 10% !important;}
        .w-15 {width: 15% !important;}
        .w-45 {width: 45% !important;}
    </style>
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
        <ul class="na-table d-md-table w-100">
			<?php 
			while ($my_row = sql_fetch_array($result)){
				$sql = " select gr_id, bo_subject from {$g5['board_table']} where bo_table='{$my_row['bo_table']}' ";
				$board_row = sql_fetch($sql);
				
				$sql = " select gr_subject from {$g5['group_table']} where gr_id='{$board_row['gr_id']}' ";
				$group_row = sql_fetch($sql);	
			?>
				<li class="d-md-table-row px-3 py-2 p-md-0 text-muted border-bottom">
					<div class="d-none d-md-table-cell w-10 f-sm font-weight-normal py-md-2 px-md-1 text-center">
						<?=$group_row['gr_subject'];?>
					</div>
					<div class="d-none d-md-table-cell w-15 text-center f-sm font-weight-normal py-md-2 px-md-1">
						<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$my_row['bo_table'];?>" style="color: #6c757d;">
							<?=$board_row['bo_subject'];?>
						</a>
					</div>
					<div class="float-right float-md-none d-md-table-cell w-45 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
						<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$my_row['bo_table']."&wr_id=".$my_row['wr_id'] ?>" style="color: #6c757d;">
							<?=($my_row['wr_is_comment']=='1') ? '[댓글] '.$my_row['wr_content'] : $my_row['wr_subject']; ?>
						</a>
					</div>
					<div class="float-left float-md-none d-md-table-cell w-15 nw-md-auto f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
						<?php echo   na_name_photo($member['mb_id'], get_sideview($member['mb_id'], $member['mb_nick'], $member['mb_homepage'])) ?>
					</div>
					<div class="float-left float-md-none d-md-table-cell w-15 nw-md-auto f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
						<span class="sr-only">등록일</span>
						<?php echo $my_row['wr_datetime']; ?>
					</div>
					<div class="clearfix d-block d-md-none"></div>
				</li>
			<?php  }?>
            </ul>
            <?php if ( ! $result->num_rows) { ?>
                <div class="f-de font-weight-normal px-3 py-5 text-muted text-center border-bottom">자료가 없습니다.</div>
            <?php } ?>
            <div class="font-weight-normal px-3 mt-4">
                <ul class="pagination justify-content-center en mb-0">
                    <?php echo na_paging($cur_page, $page, $total_page, "?$qstr&amp;page="); ?>
                </ul>
            </div>
    </section>
</div>