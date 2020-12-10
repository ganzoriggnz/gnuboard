<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 좌측 사이드 사용
$is_left_side = false;

// WING
if ($nt_wing_path)
    @include_once($nt_wing_path . '/wing.php');
?>

<div class="nt-container pb-4 pt-0 pt-sm-4">
    <div class="row na-row" style="/* width: 1318px; */display: flex; justify-content: space-between;">
        <div class="col-md-3<?php echo ($is_left_side) ? ' order-md-1' : ''; ?> na-col d-md-block d-none">
            <?php
            // layout/side에서 가져옴
            list($nt_side_url, $nt_side_path) = na_layout_content('side', 'side-basic'); // side-basic 폴더
            @include_once($nt_side_path . '/side.php')
            ?>
        </div>

        <!-- 메인 영역 -->
        <div class="col-md-9<?php echo ($is_left_side) ? ' order-md-2' : ''; ?> na-col" style="flex: 0 0 80%;">
            <!---->
            <!--			<div class="mb-4">-->
            <!--				--><?php //echo na_widget('basic-title', 'title-1', 'xl=27%', 'auto=0'); //타이틀
                                    ?>
            <!--			</div>-->
            <!---->
            <!--			<div class="row na-row">-->
            <!--				<div class="col-md-4 na-col">-->
            <!---->
            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'tlist-1', 'bo_list=video ca_list=게임 rank=red');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->
            <!---->
            <!--				</div>-->
            <!--				<div class="col-md-4 na-col">-->
            <!---->
            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'tlist-2', 'bo_list=video ca_list=게임 rank=green');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->
            <!---->
            <!--				</div>-->
            <!--				<div class="col-md-4 na-col">-->
            <!---->
            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'tlist-3', 'bo_list=video ca_list=게임 rank=blue');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->
            <!---->
            <!--				</div>-->
            <!--			</div>-->
            <!---->
            <!-- 위젯 시작 { -->

            <?php include_once('./_common.php');

            $g5['title'] = '전체검색 결과';
            include_once('./_head.php');

            $search_table = array();
            $table_index = 0;
            $write_pages = "";
            $text_stx = "";
            $srows = 0;



            $group_select = '<label for="gr_id" class="sound_only">게시판 그룹선택</label><select name="gr_id" id="gr_id" class="select"><option value="">전체 분류';
            $sql = " select gr_id, gr_subject from {$g5['group_table']} order by gr_id ";
            $result = sql_query($sql);
            for ($i = 0; $row = sql_fetch_array($result); $i++)
                $group_select .= "<option value=\"" . $row['gr_id'] . "\"" . get_selected($_GET['gr_id'], $row['gr_id']) . ">" . $row['gr_subject'] . "</option>";
            $group_select .= '</select>';

            if (!$sfl) $sfl = 'wr_subject';
            if (!$sop) $sop = 'or';

            include_once($search_skin_path . '/search.skin.php');
            ?>

            <h3 class="h3 f-lg en"><img src="http://210.114.18.63/img/img-flag5-on.png">
                쿠폰 지원업소
                <a href="http://210.114.18.63/bbs/board.php?bo_table=gallery">
                    <span class="float-right">
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> --> 쿠폰 지원업소 전체보기
                    </span>

                </a>
            </h3>
            <hr class="hr" />
            <div class="px-3 px-sm-0 my-3">
                <?php echo na_widget('basic-wr-gallery', 'gallery-1', 'bo_list=video ca_list=게임 rows=8'); ?>
            </div>

            <h3 class="h3 f-lg en"><img src="http://210.114.18.63/img/img-flag5-on.png">

                신규 제휴 업소
                <a href="http://210.114.18.63/bbs/board.php?bo_table=gallery">
                    <span class="float-right">
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> --> 신규 제휴업소 Best50 보기
                    </span>
                </a>
            </h3>
            <hr class="hr" />
            <div class="px-3 px-sm-0 my-3">
                <?php echo na_widget('basic-wr-gallery', 'gallery-1', 'bo_list=video ca_list=게임 rows=8'); ?>
            </div>

            <!-- hulan nemsen -->

                <div style="position: fixed; bottom:0px; right:14px; z-index:9999">
		<a onclick="window.open('/bbs/chat.php','채팅방참여','width=500,height=550,scrollbars=yes,top=10,left=100'); ">
		<img src="http://210.114.18.63/img/chat.png" title=""></a>

            </div>



            <!---->
            <!---->
            <!--			<hr class="hr"/>-->
            <!--			<div class="px-3 px-sm-0 my-3">-->
            <!--				--><?php //echo na_widget('basic-wr-gallery', 'gallery-1', 'bo_list=video ca_list=게임 rows=8');
                                    ?>
            <!--			</div>-->
            <!-- } 위젯 끝-->


            <!--			<div class="row na-row">-->
            <!--				<div class="col-md-4 na-col">-->

            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'blist-1', 'bo_list=video ca_list=게임');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->

            <!--				</div>-->
            <!--				<div class="col-md-4 na-col">-->

            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'blist-2', 'bo_list=video ca_list=게임');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->

            <!--				</div>-->
            <!--				<div class="col-md-4 na-col">-->

            <!-- 위젯 시작 { -->
            <!--					<h3 class="h3 f-lg en">-->
            <!--						<a href="--><?php //echo get_pretty_url('video');
                                                    ?>
            <!--">-->
            <!--							<span class="float-right more-plus"></span>-->
            <!--							게시판-->
            <!--						</a>-->
            <!--					</h3>-->
            <!--					<hr class="hr"/>-->
            <!--					<div class="mt-3 mb-4">-->
            <!--						--><?php //echo na_widget('basic-wr-list', 'blist-3', 'bo_list=video ca_list=게임');
                                            ?>
            <!--					</div>-->
            <!-- } 위젯 끝-->

        </div>
    </div>

    <!-- 위젯 시작 { -->
    <!--			<h3 class="h3 f-lg en">-->
    <!--				<a href="--><?php //echo get_pretty_url('video');
                                    ?>
    <!--">-->
    <!--					<span class="float-right more-plus"></span>-->
    <!--					배너-->
    <!--				</a>-->
    <!--			</h3>-->
    <!--			<hr class="hr"/>-->
    <!--			<div class="px-3 px-sm-0 mt-3 mb-4">-->
    <!--				--><?php //echo na_widget('basic-banner', 'banner-1');
                            ?>
    <!--			</div>-->
    <!-- } 위젯 끝-->

</div>
<!-- 사이드 영역 -->
</div>
</div>
