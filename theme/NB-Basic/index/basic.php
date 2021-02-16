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
        <div class="col-md-9<?php echo ($is_left_side) ? ' order-md-2' : ''; ?> na-col flex80d"  style=""  >

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

            include_once($search_skin_path . '/search2.skin.php');
            
            ?>    
            <h3 class="h3 f-lg en"><img src="<?php echo G5_URL?>/img/img-flag5-on.png">
                쿠폰 지원업소
                <a href="<?php echo G5_URL?>/bbs/coupon_gallery.php">
                    <span class="float-right">
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> --> 쿠폰 지원업소 전체보기
                    </span>

                </a>
            </h3>
            <hr class="hr" />
            <div class="px-3 px-sm-0 my-3">
                <?php echo na_widget('basic-wr-coupon', 'coupon', 'bo_list=video ca_list=게임 rows=8'); ?>
            </div>

            <br>
            <h3 class="h3 f-lg en"><img src="<?php echo G5_URL?>/img/img-flag5-on.png">

                신규 제휴 업소
                <a href="<?php echo G5_URL?>/bbs/new_gallery.php">
                    <span class="float-right">
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> --> 신규제휴업소 전체보기
                    </span>
                </a>
            </h3>
            <hr class="hr" />
            <div class="px-3 px-sm-0 my-3">
                <?php echo na_widget('basic-wr-gallery', 'gallery-1', 'bo_list=video ca_list=게임 rows=8'); ?>
            </div>
               
        </div>
    </div>

</div>
<!-- 사이드 영역 -->
</div>
</div>
