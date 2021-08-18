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
                        <!-- <li>
                            <a  href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li> -->
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
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰관리
                                </span>
                            </a>
                        </li>
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
        <div class="coupon_noti">쿠폰지원 개수는 매월 1일부터 5일까지 수정 가능합니다. <br/>그외 날짜에 수정을 원하시면 관리자에게 쪽지로 문의 바랍니다. 
        </div>
        <div class="coupon_noti">
            원가권 <span style="color: blue; "><?php echo $row_set['bo_sale'];?>장</span>, 무료권 <span style="color: blue; "><?php echo $row_set['bo_free']; ?>장</span> 이상 지원시 <span style="color: blue; "><?php echo $row_set['bo_total']; ?>개</span> 업소 선착순으로 업소정보 프로필과 배너 상단 고정랜덤에 적용됩니다. <br />
            자리가 없을 시 쿠폰지원 할 수 없으며 자리가 빠지면 그때 선착순으로 쿠폰지원을 하실 수 있습니다.
        </div>
    <div class="coupon_info">
        <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>" onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
                <input type="hidden" name="co_entity" value="<?php echo $member['mb_name']; ?>">
                <input type="hidden" id="co_sale" value="<?php echo $row_set['bo_sale']; ?>">
                <input type="hidden" id="co_free" value="<?php echo $row_set['bo_free']; ?>">
                <input type="hidden" id="co_total" value="<?php echo $row_set['bo_total']; ?>"> <!-- baiguullagin too -->
                <input type="hidden" id="co_cnt" value="<?php echo $row_cnt['cnt']; ?>">
                <input type="hidden" id="co_created" value="<?php echo $co_created_datetime; ?>">
                <input type="hidden" id="co_insert" value="<?php echo $co_insert_date; ?>">
                <input type="hidden" id="co_no" value="<?php echo $row['co_no']; ?>">
                
            <table class="coupon-table">
                <thead>
                    <tr class="coupon-create-tr">
                        <th class="coupon-create-th"></th>
                        <th class="coupon-create-th"> 쿠폰 지원 개수</th>
                        <th class="coupon-create-th">이번달 쿠폰 지원 개수</th>
                        <th class="coupon-create-th">이번달 잔여 쿠폰 개수</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="coupon-create-tr">
                        <td class="coupon_label col-form-label">원가권 :</td>
                        <td class="coupon-create-td"><input type="number" name="co_sale_num" id="co_sale_num" value="<?php echo $row['co_sale_num']; ?>" placeholder="" class="form-control coupon_input text-center"></td>

                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center;"><?php echo $row['co_sent_snum']; ?></td>
                        <td class="coupon-create-td"><?php echo $diff_s; ?></td>
                    </tr>

                    <tr class="coupon-create-tr">
                        <td class="coupon_label col-form-label">무료권 :</td>
                        <td class="coupon-create-td" > <input type="number" name="co_free_num" id="co_free_num" value="<?php echo $row['co_free_num']; ?>" placeholder="" class="form-control coupon_input text-center"></td>

                        <td class="coupon-create-td" style="border-right: 1px solid #ced4da; text-align: center; padding-top: 10px;"><?php echo $row['co_sent_fnum']; ?></td>
                        <td class="coupon-create-td" style="text-align: center; padding-top: 10px;"><?php echo $diff_f; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="p-20">
                <div class="coupon_label"></div>
                <button type="submit" id="btn_submit" accesskey="s" class="miss_but_1">저장</button>
            </div>
            <div class="popup-time-coupon-count" style="display:none;">
                <h1>쿠폰</h1>
                <label>쿠폰지원은 매월 1일부터 5일까지만 수정 가능합니다. 그 외 날짜 쿠폰지원은 관리자에게 문의 바랍니다.</label>
                <div class="btns1">
                    <a href="#" class="btn1">닫기</a>
                </div>
            </div>
            <!-- <div class="popup_box2">
                <label>관리자가 설정한 원가권, 무료권 갯수 이하이므로 등록을 하실 수 없습니다.</label>
                <div class="btns1">
                    <a href="#" class="btn1">확인</a>
                </div>
            </div>-->
            <!-- админаас тогтоосон байгууллагын тоо дүүрсэн тул одоогоор бүртгэх боломжгүй батлах -->
            <div class="popup-company-count-full" style="display:none;">  
                <label>관리자가 설정한 업소 갯수가 모두 등록이 완료되어 현재 등록을 할 수 없습니다.</label>
                <div class="btns1">
                    <a href="#" class="btn1">확인</a>
                </div>
            </div> 
            <!-- админаас тогтоосон үндсэн үнийн болон үнэгүй эрхийн тоо-с доош байгаа тул бүртгэх боломжгүй батлах -->
            <div class="popup_box4" style="display:none;">
                <label>관리자가 설정한 원가권, 무료권 갯수 이하이므로 등록을 하실 수 없습니다.</label>
                <div class="btns1">
                    <a href="#" class="btn1">확인</a>
                </div>
            </div>
        </form>
    </div>
    <script>

    function fcouponcreate_submit(f) {
        var sale_cnt = $('#co_sale').val();
        var free_cnt = $('#co_free').val();
        var total_cnt = $('#co_total').val();
        var sale_num_cnt = $('#co_sale_num').val();
        var free_num_cnt = $('#co_free_num').val();
        var co_cnt = $('#co_cnt').val();
        var co_created = $('#co_created').val();
        var co_insert = $('#co_insert').val();
        var co_no = $('#co_no').val();
        
        if(co_created > co_insert){ //огноо
            $('.popup-time-coupon-count').css("display", "block");
            $('.btn1').click(function(){
                $('.popup-time-coupon-count').css("display", "none");
            });
            return false;
        }
        else if((co_cnt+1) > total_cnt && co_no=='') {
            $('.popup-company-count-full').css("display", "block");
            $('.btn1').click(function(){
                $('.popup-company-count-full').css("display", "none");
            });
            return false;
        } 
        else if(sale_num_cnt < sale_cnt && free_num_cnt < free_cnt){
                $('.popup_box4').css("display", "block");
                $('.btn1').click(function(){
                    $('.popup_box4').css("display", "none");
            });
            return true;
        }           
                  // else if(sale_cnt > sale_num_cnt){ //үнэтэй
        //     $('.popup_box2').css("display", "block");
        //     $('.btn1').click(function(){
        //         $('.popup_box2').css("display", "none");
        //     });
        //     $('#co_sale_num').focus();
        //     return false;
        // }
        // else if(free_cnt > free_num_cnt){ //үнэгүй
        //     $('.popup_box2').css("display", "block");
        //     $('.btn1').click(function(){
        //         $('.popup_box2').css("display", "none");
        //     });
        //     $('#co_free_num').focus();
        //     return false;
        // }                                    
    }
    </script>
    </section>
</div> 
