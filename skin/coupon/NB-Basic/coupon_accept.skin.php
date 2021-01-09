<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$coupon_accept_skin_url.'/style.css">', 0);

?>

<style>
    table th, td {border: 0.5px solid black; padding: 10px 85px;}
    
</style>

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
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                <i class="fa fa-cubes">
                                쿠폰지원
                                </i>
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <i class="fa fa-handshake">
                                쿠폰관리
                                </i>
                                </span>
                            </a>
                        </li>
                         <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                         <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li>
                        <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/myreview.php">
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
<div style="margin-top: 60px; font-size: 12px;">
<table> 
    <thead>
        <tr style="background-color: #e3e2e3;">
            <th>발행업소</th>
            <th>쿠폰명</th>
            <th>쿠폰번호</th>
            <th>당첨시간</th>
            <th>학인시간</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div style="margin-top: 100px;">
    <ul>
        <li>쿠폰을 받은 사람은 7일이내 사용하기를 누르지 않으면<span style="color: blue">자동으로 회수됩니다.</span></li>
        <li>사용하기 클릭 후 7일 이내에 해당 게시판에서 후기를 작성하지 않으면 경고를 받게 됩니다.</li>
    </ul>
</div>

</div>

    
 