<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/style.css">', 0);

?>

<div id="bo_v" style="height: 320px;">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="d-flex">
				<div id="user_cate_list" class="sly-wrap flex-grow-1">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
						<li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/userinfo.php">
                                <span>
                                <i class="fa fa-user">
                                회원정보
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <i class="fa fa-pencil-alt">
                                내 글
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <i class="fa fa-book">
                                파편조각 :
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                <i class="fa fa-gem">
                                파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                <i class="fa fa-paperclip">
                                스크랩
                                </i>
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                <i class="fa fa-cubes">
                                쿠폰지원
                                </i>
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($member['mb_level'] < 23) { ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <i class="fa fa-handshake">
                                쿠폰관리
                                </i>
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                <i class="fa fa-pencil-alt">
                                후기보기
                                </i>
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
        <div class="coupon_noti">이번달 잔여 쿠폰개수는 매월 1일 초기화 됩니다.<br>이번달 잔여 쿠폰개수는 수정할 수 없습니다.<br>다음달 쿠폰지원개수는 말일까지 수정 가능합니다.
    </div>
      
        <div class="coupon_info" style="float-left">
            <h6>다음달 쿠폰 지원 개수</h6>
            <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>" onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
                <input type="hidden" name="co_entity" value="<?php echo $member['mb_name'] ?>">

                <div class="p-20">
                    <div class="coupon_label col-form-label">원가권 :</div>
                    <input type="number" name="co_sale_num" value="<?php echo $row['co_sale_num']; ?>" placeholder="" class="form-control coupon_input">
                </div>
                <div class="p-20">
                    <div class="coupon_label col-form-label">무료권 :</div>
                    <input type="number" name="co_free_num" value="<?php echo $row['co_free_num']; ?>" placeholder="" class="form-control coupon_input">
                </div>
                <div class="p-20">
                    <div class="coupon_label"></div>
                    <button type="submit" id="btn_submit" accesskey="s" class="btn btn-primary coupon_btn">저장</button>
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
                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center;"><?php echo $row1['co_sent_snum']; ?></td>
                        <td class="coupon-create-td"><?php echo $diff_s; ?></td>
                    </tr>
                    <tr class="coupon-create-tr-bottom" style="border-bottom: none;">
                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center; padding-top: 10px;"><?php echo $row1['co_sent_fnum']; ?></td>
                        <td class="coupon-create-td" style="text-align: center; padding-top: 10px;"><?php echo $diff_f; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>  
        </section>
</div> 
  
