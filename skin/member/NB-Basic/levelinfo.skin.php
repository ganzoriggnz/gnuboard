<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
        <div class="px-3 px-sm-0">
            <div class="">
                <div id="user_cate_list" class="sly-wrap ">
                    <ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/userinfo.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img"
                                        style="height :13px;">&nbsp
                                    회원정보

                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img"
                                        style="height :13px;">&nbsp
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
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img"
                                        style="height :13px;">&nbsp
                                    파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img"
                                        style="height :14px;">&nbsp
                                    스크랩
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/cubes.svg" class="svg-img"
                                        style="height :14px;">&nbsp
                                    쿠폰지원

                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img"
                                        style="height :14px;">&nbsp
                                    쿠폰관리
                                </span>
                            </a>
                        </li>
                        <li class="active">
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
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/reply.svg" class="svg-img"
                                        style="height :14px;">&nbsp
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
    <div>
        <style>
            table > thead tr > th {
                text-align:center !important;
            }
            table > tbody> tr > td {
                text-align:center !important;
            }
            table > tbody> tr > td {
                text-align:center !important;
                padding: 5px 0;
            }
            .tbl {
                width:100%;
                margin-top:25px;
                border: 1px solid #dee2e6;
            }
            .tbl tr {
                border: 1px solid #dee2e6;
            }
            .tbl th {
                    padding: .75rem;
                    vertical-align: top;
                }
            .tbl thead tr {
                background: #F5F5F5;
            }
        </style>

        <table class="tbl">
            <thead>
                <tr class="active">
                    <th>현재레벨</th>
                    <th>가입일</th>
                    <th>후기 작성개수</th>
                    <th>게시글 작성개수</th>
                    <th>댓글 작성개수</th>
                </tr>
            </thead>
            <tbody>
                <tr class="active">
                    <td><p style="font-weight: normal; height:20px;" ><?php 
                            echo get_level($member['mb_id']).' '.get_level_name($member['mb_level']).' Lv.'.$member['mb_level']; ?> </td>
                    <td><?php echo floor((time() - strtotime($member['mb_datetime']))/86400).' 일'; ?></td>
                    <td><?php echo $cnt_review.'개'?></td>
                    <td><?php echo $cnt_other.'개'?></td>
                    <td><?php echo $cnt_comment.'개'?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>