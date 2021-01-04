<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/style.css">', 0);

?>

    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="d-flex">
				<div id="user_cate_list" class="sly-wrap flex-grow-1">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
						<li>
                            <a class="py2 px-3" href= <?php echo G5_BBS_URL.'/userinfo.php' ?> >
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
                            <a class="py2 px-3" href= "#">
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
                        <li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL.'/coupon_create.php' ?>">
                                <span>
                                <i class="fa fa-cubes">
                                쿠폰지원
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "#">
                                <span>
                                <i class="fa fa-handshake">
                                쿠폰관리
                                </i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                <i class="fa fa-pencil-alt">
                                후기보기
                                </i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <hr/>
				</div>
			</div>
		</div>
    </nav>
    <div class="coupon_noti">
        <ul>
            <li>매월 1~3일까지 수정 가능합니다.</li>
            <li>매월 4일부터 수정이 불가합니다.</li>
            <li>매월 1일 모든 쿠폰은 0으로 리셋됩니다.</li>
        </ul>
    </div>
    <div class="coupon_info">
        <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>" onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
            <input type="hidden" name="co_entity" value="<?php echo $member['mb_name'] ?>">

            <div class="p-20">
                <div class="coupon_label">원가권 :</div>
                <input type="number" name="co_sale" value="<?php echo $row['co_sale']; ?>" placeholder="Please, insert quantity of sale coupon" class="coupon_input" <?php echo ($now >= $fdate && $row['co_no']) ? ' disabled="disabled"' : '' ?>>
            </div>
            <div class="p-20">
                <div class="coupon_label">무료권 :</div>
                <input type="number" name="co_free" value="<?php echo $row['co_free']; ?>" placeholder="Please, insert quantity of free coupon" class="coupon_input" <?php echo ($now >= $fdate && $row['co_no']) ? ' disabled="disabled"' : '' ?>>
            </div>
            <div class="p-20">
                <div class="coupon_label"></div>
                <button type="submit" id="btn_submit" accesskey="s" class="btn btn-primary coupon_btn" <?php echo ($now >= $fdate && $row['co_no']) ? ' disabled="disabled"' : '' ?>>저장</button>
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
                if (!f.co_sale) {
                    alert("Please insert quantity of sale coupon!");
                    f.co_sale.focus();
                    return false;
                }

                if (!f.co_free) {
                    alert("Please insert quantity of free coupon!");
                    f.co_free.focus();
                    return false;
                }

                var agree=confirm("수정은 매월 1일부터 3일까지만 가능합니다.");
                if(agree)
                    return true;
                else 
                    return false;            
                            
        }
 
       /*  $(function () {
    'use strict';

    function confirmDialog(title, message, success) {
        var confirmdialog = $('<div></div>').appendTo('body')
            .html('<div><h6>' + message + '</h6></div>')
            .dialog({
                modal: true,
                title: title,
                zIndex: 10000,
                autoOpen: false,
                width: 'auto',
                resizable: false,
                buttons: {
                    확인: function () {
                        success();
                        $(this).dialog("close");
                    },
                    No: function () {
                        $(this).dialog("close");
                    }
                },
                close: function() {
                    $(this).remove();
                }
            });

        return confirmdialog.dialog("open");
    }

    $('form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        confirmDialog('Confirm', 'Are you sure?', function () {
            form.submit();
        });
    });
}); */
        </script>
    </div>
 
  

