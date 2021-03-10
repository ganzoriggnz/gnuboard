<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<style>
    .d-flex {
        font-size: 12px;
    }
    #user_cate_ul li a {
       padding: 2px; 5px; 2px; 5px;
    }
</style>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
        <div class="px-3 px-sm-0">
            <div class="d-flex">
                <div id="user_cate_list" class="sly-wrap flex-grow-1">
                    <ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
                    <li >
                            <a  href= "<?php echo G5_BBS_URL ?>/userinfo.php" >
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img" style="height :13px;" >&nbsp
                                회원정보
                             
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a  href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img" style="height :13px;" >&nbsp
                                내 글
                                </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a  href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li> -->
                        </ul>
                        <ul id="user_cate_ul" class="sly-list d-flex border-left-0">
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img" style="height :13px;" >&nbsp
                                파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a>
                        </li>
                        <li >
                            <a  href= "<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img" style="height :14px;" >&nbsp
                                스크랩
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/cubes.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰지원
                               
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($member['mb_level'] < 23) { ?>
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰관리
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li>
                            <a  href="<?php echo G5_BBS_URL ?>/myreview.php">
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

    <section id="bo_list" class="mb-4">
        <div id="scrap_info" class="font-weight-normal px-3 pb-2 pt-4">
            전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
        </div>

        <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


        <!-- 목록 헤드 -->
        <div class="d-block  w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>
        <table cellspacing="0" class="w-100 px-3 mr-3" cellpadding="0" width="100%"  style="border:1px solid #d3d3d3;font-size: 12px; padding:5px;" id="level-up">
		<thead class="bg-light">  
			<tr style="border:1px solid #d3d3d3;font-size: 12px; text-align: center; " >
				<th class="cl_tr">게시판</th>
				<th class="cl_tl">제목</th>
				<th class="cl_tr">일시</th>
			</tr>
		</thead>
		<tbody>

        <?php

        
        for ($i = 0; $i < count($list);   $i++) { ?>
        <tr style="border:1px solid #d3d3d3;font-size: 10px; text-align: center; " >
				<th class="cl_tr"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']."&wr_id=".$list[$i]['wr_id']?>" style="color: #6c757d;">
                                <?php echo $list[$i]['bo_subject'];?>
                        </a></th>
				<th class="cl_tl" style="text-align: left;"> 
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table']."&wr_id=".$list[$i]['wr_id'] ?>" style="color: #6c757d;">                                                             
                                <?php                                
                                echo substr($list[$i]['wr_subject'],0,35) ; ?>
                            </a></th>
				<th class="cl_tr" style="color: #6c757d;"> <?php echo $list[$i]['wr_datetime']; ?></th>
            </tr>
            <?php  }
            ?>
        </body>
        </table>
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