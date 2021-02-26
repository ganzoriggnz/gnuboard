<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 좌측 사이드 사용
$is_left_side = false;

// WING
if ($nt_wing_path)
    @include_once($nt_wing_path . '/wing.php');
?>
<style>
    #bo_cate {margin-bottom: 20px;}
#bo_cate h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
#bo_cate ul {zoom:1}
#bo_cate ul:after {display:block;visibility:hidden;clear:both;content:"";}
#bo_cate li {display:inline-block;padding:2px;  }
#bo_cate a {background-image:url('http://210.114.18.63/img/cat_btn_1.png'); border-radius: 2px; font-size:12px; color:#D5BD79; width:95px; height:39px; display: flex; align-items:center; justify-content:center; margin-left: 3px;}
#bo_cate a:focus, #bo_cate a:hover, #bo_cate a:active {background-image:url('http://210.114.18.63/img/cat_btn_clicked1.png'); text-decoration:none; color:#FFF}
#bo_cate #bo_cate_on {z-index:2; background-image:url('http://210.114.18.63/img/cat_btn_clicked1.png'); font-size:12px; font-weight: bold; color:#FFF; width:95px; height:39px; display:flex; align-items:center; justify-content: center;}
</style>
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

            $sql_bo="select bo_category_list from {$g5['board_table']} where bo_table='gallery'";
            $res_bo = sql_fetch($sql_bo);


            $wsetss=$sca;
            $searchd=$searchd;
            $list = na_post_rows($wsetss,$subcat,$searchd); //

            $catecount = count(na_post_rows($wsetss));
            $list_cnt = count($list);

            $wsetrr=$sca;
            
            $stx = get_text(stripslashes($stx));

            // // 분류 사용 여부
            $is_category = false;
            $category_option = '';

            
            $is_category = true;
            $bo_table = 'gallery';
            $category_href = get_pretty_url($bo_table);

            $category_option .= '<li><a href="'.$category_href.'"'; 
            if ($sca==''){
                $category_option .= ' id="bo_cate_on"';
                $category_option .= '>전체('.$catecount.')</a></li>';
            } else 
            $category_option .= '>전체</a></li>'; 
            
            $categories = explode('|', $res_bo['bo_category_list']); // 구분자가 , 로 되어 있음
            
            for ($i=0; $i<count($categories); $i++) {
            
                $category = trim($categories[$i]);
                if ($category=='') continue;       
                $category_option .= '<li><a href="'.(get_pretty_url($bo_table,'','sca='.urlencode($category))).'"';         
                $category_msg = '';
                if ($category==$sca) { // 현재 선택된 카테고리라면
                    $category_option .= ' id="bo_cate_on"';
                    $category_msg = '<span class="sound_only">열린 분류 </span>';
                    $category_option .= '>'.$category_msg.$category.'('.$catecount.')</a></li>';
                }
                else
                $category_option .= '>'.$category_msg.$category.'</a></li>';
            }    
         
            ?>    

            <nav id="bo_cate">
                <ul id="bo_cate_ul">
                    <?php echo $category_option ?>
                </ul>
            </nav>
            <?php include_once($search_skin_path . '/search2.skin.php'); ?>
            <h3 class="h3 f-lg en"><img src="<?php echo G5_URL?>/img/img-flag5-on.png">
                쿠폰 지원업소
                <a href="<?php echo G5_URL?>/bbs/coupon_gallery.php">
                    <span class="float-right">
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> 쿠폰 지원업소 전체보기 -->
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
                        <!-- <i class="fa fa-heartbeat" style="color:#FF007F"></i> 신규제휴업소 전체보기 -->
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
