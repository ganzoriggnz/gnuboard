<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_accept_skin_url.'/style.css">', 0);
?>

<div id="bo_v">
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
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
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
                        <li class="active">
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
                        <?php }?>
                    </ul>
                    <hr/>
				</div>
			</div>
		</div>
    </nav>
    <div style="margin-top: 30px; margin-left: 20px; font-size: 12px;">
        <table> 
            <thead>
                <tr style="background-color: #e3e2e3;">
                    <th>발행업소</th>
                    <th>쿠폰명</th>
                    <th>쿠폰번호</th>
                    <th>당첨시간</th>
                    <th>확인시간</th>
                </tr>
            </thead>
            <tbody>
            <?php $sql = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_nick='{$member['mb_nick']}'";
                $res = sql_query($sql);
                for($i=0; $row = sql_fetch_array($res); $i++){ ?>
                <tr id="<?php echo $i; ?>">
                    <td><?php echo "[".$row['cos_entity']."]";?></td>
                    <td><?php 
                        if($row['cos_type'] == 'S') {echo "원가권"; }  
                        else if($row['cos_type'] == 'F') {echo "무료권"; }?>
                    </td>
                    <td id="changeText"><?php if($row['cos_accept'] == 'N') { echo "(사용하기 누를때 나옴)"; } else { echo $row['cos_code']; } ?></td>
                    <td><?php echo "당첨 ".$row['cos_created_datetime'];?></br><?php if($row['cos_accept'] == 'Y') echo "사용 ".$row['cos_accepted_datetime']; ?></td>
                    <td>
                        <form id="<?php echo "fcouponaccept".$i; ?>" action="<?php echo $coupon_accept_action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="cos_no" value="<?php echo $row['cos_no']; ?>"/>
                            <input type="hidden" name="co_no" value="<?php echo $row['co_no']; ?>"/>
                            <input type="hidden" name="cos_code" value="<?php echo $row['cos_code']; ?>"/>
                            <button type="button" id="<?php echo $i; ?>" <?php echo ($row['cos_accept'] == 'Y') ? ' disabled="disabled" class="disabled" value="사용완료"' : 'class="accept_btn" value="쿠폰사용하기"'?>><?php echo ($row['cos_accept'] == 'Y') ? "사용완료" : "쿠폰사용하기"; ?></button>
                        </form> 
                    </td>
                </tr>
                <?php
                }
            ?>   
            </tbody>
        </table>
        <div class="popup_box">
            <h1>쿠폰사용</h1>
            <label>쿠폰사용후 7일이내 후기 미 작성시 모든</br>이벤트에서 한달간 제외됩니다.</label>
            <div class="btns">
                <a href="#" class="btn">확인</a>
            </div>
        </div>
        <div style="margin-top: 100px; padding-bottom: 20px; line-height: 2;">
            <ul style="list-style: disc; margin-left: 40px; font-size: 14px;">
                <li>쿠폰을 받은 사람은 7일이내 사용하기를 누르지 않으면 <span style="color: blue">자동으로 회수됩니다.</span></li>
                <li>사용하기 클릭 후 7일 이내에 해당 게시판에서 후기를 작성하지 않으면 경고를 받게 됩니다.</li>
            </ul>
        </div>
        <script>
           $(document).ready(function(){
                $('button').click(function(){
                    var formId = "#fcouponaccept" + this.id;
                    $('.popup_box').css("display", "block");
                    $('.btn').click(function(){
                        $('.popup_box').css("display", "none");
                        $(formId).submit();
                    });
                });                                  
            })            
                                        
        </script>
    </div>
</div>

    
 