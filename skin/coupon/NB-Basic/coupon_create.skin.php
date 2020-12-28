<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/style.css">', 0);
/* add_stylesheet('<link rel="stylesheet" href="'.$coupon_create_skin_url.'/jquery-ui.min.css">', 0); */
if($member['mb_id']){
    global $g5;
    $sql = " select * from {$g5['member_table']} where mb_id = '{$member['mb_id']}'";
    $row = sql_fetch($sql); 
    $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
    
    /* for($i=0; $row=sql_fetch_array($result); $i++)
    {
      $bo_table = $row['bo_table'];

      $result1 = sql_query("select * from ".$g5['write_prefix'].$bo_table. " where mb_id = '{$member['mb_id']}'");
      if($result1){
        $row1 = sql_fetch($result1);
        echo $row1['wr_datetime'];
      }
      
    } */
}

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
        <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_action_url ?>"  method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
            <input type="hidden" name="mb_name" value="<?php echo $member['mb_name'] ?>">

            <div class="p-20">
                <div class="coupon_label">원가권 :</div>
                <input type="number" name="co_sale" value="" placeholder="Please, insert quantity of sale coupon" class="coupon_input">
            </div>
            <div class="p-20">
                <div class="coupon_label">무료권 :</div>
                <input type="number" name="co_free" value="" placeholder="Please, insert quantity of free coupon" class="coupon_input">
            </div>
            <div class="p-20">
                <div class="coupon_label"></div>
                <button type="submit" id="btn_submit" class="btn btn-primary coupon_btn">저장</button>
            </div>
        </form>
        
        <script>

        /* function fcouponcreate_submit(f) {
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
                return true;
        } 
 */
        $(function () {
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
                    Yes: function () {
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

        confirmDialog('Confirm', '수정은 매월 1일부터 3일까지만 가능합니다.', function () {
            form.submit();
        });
    });
});
        </script>
    </div>
 
  

