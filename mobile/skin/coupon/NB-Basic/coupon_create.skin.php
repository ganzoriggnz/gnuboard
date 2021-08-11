<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/style.css">', 0);

?>
<style>
.d-flex {
    font-size: 12px;
}

#user_cate_ul li a {
    padding: 2px;
    5px;
    2px;
    5px;
}
</style>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
        <?php
    $couponcreate = "actived";
    include G5_THEME_MOBILE_PATH2."/skin/member/NB-Basic/infotab.php";
    ?>
    </nav>
    <div class="couponbg">
        <div class="coupon_noti" style="font-size:12px;">쿠폰지원 개수는 매월 1일부터 5일까지 수정 가능합니다. <br/>그외 날짜에 수정을 원하시면 관리자에게 쪽지로 문의 바랍니다. 
        </div>
        <div class="coupon_noti" style="margin-top:20px; font-size:12px;">
            원가권 <span style="color: blue; "><?php echo $row_set['bo_sale'];?>장</span>, 무료권 <span style="color: blue; "><?php echo $row_set['bo_free']; ?>장</span> 이상 지원시 <span style="color: blue; "><?php echo $row_set['bo_total']; ?>개</span> 업소 선착순으로 업소정보 프로필과  <br /> 배너 상단 고정랜덤에 적용됩니다.
            자리가 없을 시 쿠폰지원 할 수 없으며 자리가 빠지면 그때 선착순으로  <br /> 쿠폰지원을 하실 수 있습니다.
        </div>

        <div class="coupon_info">
            <h6>이번달 쿠폰 지원 개수</h6>
            <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>"
                onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data"
                autocomplete="off">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
                <input type="hidden" name="co_entity" value="<?php echo $member['mb_name'] ?>">
                <input type="hidden" id="co_sale" value="<?php echo $row_set['bo_sale'] ?>">
                <input type="hidden" id="co_free" value="<?php echo $row_set['bo_free'] ?>">
                <input type="hidden" id="co_total" value="<?php echo $row_set['bo_total'] ?>">
                <input type="hidden" id="co_cnt" value="<?php echo $row_cnt['cnt'] ?>">

                <div class="p-20">
                    <div class="coupon_label col-form-label">원가권 :</div>
                    <input type="number" name="co_sale_num" id="co_sale_num" value="<?php echo $row['co_sale_num']; ?>" placeholder=""
                        class="form-control coupon_input"
                        <?php if($co_created_datetime > $co_insert_date) { echo 'disabled="disabled"';}  else {echo '';}?>>
                </div>
                <div class="p-20">
                    <div class="coupon_label col-form-label">무료권 :</div>
                    <input type="number" name="co_free_num" id="co_free_num" value="<?php echo $row['co_free_num']; ?>" placeholder=""
                        class="form-control coupon_input"
                        <?php if($co_created_datetime > $co_insert_date) { echo 'disabled="disabled"';}  else { echo '';}?>>
                </div>
                <div class="p-20">
                    <div class="coupon_label"></div>
                    <button type="submit" id="btn_submit" accesskey="s"
                        <?php if($co_created_datetime > $co_insert_date) { echo 'class="miss_but_3" disabled="disabled"';}  else { echo 'class="miss_but_1"';}?>>저장</button>
                </div>
                <div class="popup_box1">
                    <h1>쿠폰</h1>
                    <label>수정은 매월 1일부터 3일까지만 가능합니다.</label>
                    <div class="btns1">
                        <a href="#" class="btn1">확인</a>
                    </div>
                </div>
                <div class="popup_box2">
                    <label>관리자가 설정한 원가권, 무료권 갯수 이하이므로 등록을 하실 수 없습니다.</label>
                    <div class="btns1">
                        <a href="#" class="btn1">확인</a>
                    </div>
                </div>
                <div class="popup_box3" style="display:none;">
                    <label>관리자가 설정한 업소 갯수가 모두 등록이 완료되어 현재 등록을 할 수 없습니다.</label>
                    <div class="btns1">
                        <a href="#" class="btn1">확인</a>
                    </div>
                </div>
            </form>

            <script>
            function fcouponcreate_submit(f) {
                var sale_cnt = $('#co_sale').val();
                var free_cnt = $('#co_free').val();
                var total_cnt = $('#co_total').val();
                var sale_num_cnt = $('#co_sale_num').val();
                var free_num_cnt = $('#co_free_num').val();
                var co_cnt = $('#co_cnt').val();

                /* if (f.co_sale_num=='') {
                    alert("Please insert quantity of sale coupon!");
                    f.co_sale_num.focus();
                    return false;
                }

                if (f.co_free_num=='') {
                    alert("Please insert quantity of free coupon!");
                    f.co_free_num.focus();
                    return false;
                } */

                if(sale_cnt > sale_num_cnt  || free_cnt > free_num_cnt){
                    $('.popup_box2').css("display", "block");
                    $('.btn1').click(function(){
                        $('.popup_box2').css("display", "none");
                    });
                }
                if(co_cnt > total_cnt) {
                    $('.popup_box3').css("display", "block");
                    $('.btn1').click(function(){
                        $('.popup_box3').css("display", "none");
                    });
                }            
                if(total_cnt >= co_cnt && sale_num_cnt >= sale_cnt && free_num_cnt >= free_cnt)
                    return true;
                else 
                    return false; 
            }
            </script>
        </div>
        <div class="coupon_current">
            <table class="coupon-table">
                <thead>
                    <tr class="coupon-create-tr">
                        <th class="coupon-create-th">이번달 쿠폰 지원 개수</th>
                        <th class="coupon-create-th">이번달 잔여 쿠폰 개수</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="coupon-create-tr">
                        <td class="coupon-create-td"><?php echo $row['co_sent_snum']; ?></td>
                        <td class="coupon-create-td"><?php echo $diff_s; ?></td>
                    </tr>
                    <tr class="coupon-create-tr-bottom">
                        <td class="coupon-create-td"><?php echo $row['co_sent_fnum']; ?></td>
                        <td class="coupon-create-td"><?php echo $diff_f; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>