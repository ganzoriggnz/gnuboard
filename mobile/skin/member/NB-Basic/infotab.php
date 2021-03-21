<style>
#tabletab tr td {
    border: 1px solid #BABABA !important;
}

#tabletab tr td a span {
    padding: 0px !important;
    margin: 0px !important;
}

#tabletab tr td a span,
img {
    height: 13px !important;
    font-size: 13px !important;
}

#tabletab tr td a.actived {
    font-weight: bold !important;
    background: #fff !important;
}

#tabletab tr td a {
    padding: 5px 10px !important;
    margin: 0px !important;
}

#tabletab tr td {
    text-align: center;
}
</style>
<nav id="user_cate" class="sly-tab font-weight-normal mb-2">
    <div class="px-3 px-sm-0">
        <div class="d-flex">
            <div id="user_cate_list" class="sly-wrap flex-grow-1">
                <table class="tabletab" id="tabletab">
                    <tr>
                        <td><a class="<?php echo $activedd; ?>" href=" <?php echo G5_BBS_URL ?>/userinfo.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img">&nbsp
                                    회원정보
                                </span>
                            </a></td>
                        <td> <a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img">&nbsp
                                    내 글
                                </span>
                            </a></td>
                        <!-- <td> <a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/point2.php">
                                    <span>
                                        <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img"
                                            >&nbsp
                                        파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                    </span>
                                </a></td> -->
                        <?php if ($member['mb_level'] == 27) { ?>
                        <td> <a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/cubes.svg" class="svg-img">&nbsp
                                    쿠폰지원
                                </span>
                            </a> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><a href="<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img">&nbsp
                                    파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a></td>
                        <td><a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img">&nbsp
                                    스크랩
                                </span>
                            </a></td>
                        <?php if ($member['mb_level'] < 23 ) { ?>
                        <td><a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img">&nbsp
                                    쿠폰관리
                                </span>
                            </a></td>
                        <?php } ?>
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <td><a class="<?php echo $activedd; ?>" href="<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/reply.svg" class="svg-img">&nbsp
                                    후기보기
                                </span>
                            </a> </td>
                        <?php } ?>
                    </tr>
                </table>

                <!-- 

                    <ul id="user_cate_ul" class="sly-list d-flex border-left-0">
                        <li class="active">
                            <a href="<?php echo G5_BBS_URL ?>/userinfo.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img"
                                        >&nbsp
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
                <!-- </ul>
                    <ul id="user_cate_ul" class="sly-list d-flex border-left-0">
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
                        <?php if ($member['mb_level'] < 23) { ?>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                    <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img"
                                        style="height :14px;">&nbsp
                                    쿠폰관리
                                </span>
                            </a>
                        </li>
                        <?php } ?> -->
                <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                <!-- <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
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
                    </ul>  -->
                <hr />
            </div>
        </div>
    </div>
</nav>