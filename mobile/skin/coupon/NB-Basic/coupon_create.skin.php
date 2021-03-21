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
    $activedd = "actived";
    include G5_THEME_MOBILE_PATH2."/skin/member/NB-Basic/infotab.php";
    ?>
    </nav>
    <div class="couponbg">
        <ul class="coupon_noti">
            <li>이번달 쿠폰개수는 1일 -5일 까지 수정 가능합니다.</li>
            <li>이번달 잔여 쿠폰개수는 수정할 수 없습니다.</li>
        </ul>

        <div class="coupon_info">
            <h6>이번달 쿠폰 지원 개수</h6>
            <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>"
                onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data"
                autocomplete="off">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
                <input type="hidden" name="co_entity" value="<?php echo $member['mb_name'] ?>">

                <div class="p-20">
                    <div class="coupon_label col-form-label">원가권 :</div>
                    <input type="number" name="co_sale_num" value="<?php echo $row['co_sale_num']; ?>" placeholder=""
                        class="form-control coupon_input"
                        <?php if($co_created_datetime > $co_insert_date) { echo 'disabled="disabled"';}  else {echo '';}?>>
                </div>
                <div class="p-20">
                    <div class="coupon_label col-form-label">무료권 :</div>
                    <input type="number" name="co_free_num" value="<?php echo $row['co_free_num']; ?>" placeholder=""
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
            </form>

            <script>
            function fcouponcreate_submit(f) {
                if (!f.co_sale_num) {
                    alert("Please insert quantity of sale coupon!");
                    f.co_sale_num.focus();
                    return false;
                }

                if (!f.co_free_num) {
                    alert("Please insert quantity of free coupon!");
                    f.co_free_num.focus();
                    return false;
                }

                var agree = confirm("쿠폰 개수를 저장하시겠습니까?");
                if (agree)
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