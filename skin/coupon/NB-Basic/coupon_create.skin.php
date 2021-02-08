<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/style.css">', 0);

?>

<div id="bo_v" style="backgroun-color: #fff">
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
                        <li >
                            <a  href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img" style="height :13px;" >&nbsp
                                내 글
                                </span>
                            </a>
                        </li>
                        <li>
                            <a  href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li>
                        <li >
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
                        <li class="active">
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
                        <li > 
                            <a  href="<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/reply.svg" class="svg-img" style="height :14px;" >&nbsp
                                후기보기
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <hr/>
				</div>
			</div>
		</div>
    </nav>
    <section class="xm">
    <div class="couponbg" >
        <div class="coupon_noti">이번달 쿠폰개수는 1일 -5일 까지 수정 가능합니다.<br>이번달 잔여 쿠폰개수는 수정할 수 없습니다.
    </div>
      
        <div class="coupon_info" style="float-left">
            <h6>이번달 쿠폰 지원 개수</h6>
            <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>" onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
                <input type="hidden" name="co_entity" value="<?php echo $member['mb_name'] ?>">

                <div class="p-20">
                    <div class="coupon_label col-form-label">원가권 :</div>
                    <input type="number" name="co_sale_num" value="<?php echo $row['co_sale_num']; ?>" placeholder="" class="form-control coupon_input" <?php if($co_created_datetime > $co_insert_date) { echo 'disabled="disabled"';}  else {echo '';}?>>
                </div>
                <div class="p-20">
                    <div class="coupon_label col-form-label">무료권 :</div>
                    <input type="number" name="co_free_num" value="<?php echo $row['co_free_num']; ?>" placeholder="" class="form-control coupon_input" <?php if($co_created_datetime > $co_insert_date) { echo 'disabled="disabled"';}  else { echo '';}?>>
                </div>
                <div class="p-20">
                    <div class="coupon_label"></div>
                    <button type="submit" id="btn_submit" accesskey="s" <?php if($co_created_datetime > $co_insert_date) { echo 'class="miss_but_3" disabled="disabled"';}  else { echo 'class="miss_but_1"';}?>>저장</button>
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

                    var agree=confirm("쿠폰 개수를 저장하시겠습니까?");
                    if(agree)
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
                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center;"><?php echo $row['co_sent_snum']; ?></td>
                        <td class="coupon-create-td"><?php echo $diff_s; ?></td>
                    </tr>
                    <tr class="coupon-create-tr-bottom" style="border-bottom: none;">
                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center; padding-top: 10px;"><?php echo $row['co_sent_fnum']; ?></td>
                        <td class="coupon-create-td" style="text-align: center; padding-top: 10px;"><?php echo $diff_f; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>  
        </section>
</div> 
  

