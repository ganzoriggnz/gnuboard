<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);



?>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="">
				<div id="user_cate_list" class="sly-wrap ">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
						<li class="active">
                            <a  href= "<?php echo G5_BBS_URL ?>/userinfo.php" >
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img" style="height :13px;" >&nbsp
                                회원정보
                             
                                </span>
                            </a>
                        </li>
                        <li>
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
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img" style="height :13px;" >&nbsp
                                파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a  href= "<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img" style="height :14px;" >&nbsp
                                스크랩
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li>
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
                        <li>
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
        <dl class="dl-horizontal text-left">
        <!-- user  기본정보   mb_nick  -->
        <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="reg_mb_nick">
        기본정보       
        </label>
        <div class="col-sm-3 col-form-info">
        <?php echo $row['mb_nick']." (".$row['mb_id'].")"?>
        </div>
        </div>
        <!-- 프로필 사진 user icon  -->
        <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="reg_mb_nick">
        프로필 사진     
        </label>
        <div class="col-sm-3 col-form-info">
        <a href="#" target="_blank" class="win_memo" title="사진등록">
                            <div class="photo pull-left">
                                <i class="fa fa-user"></i>				
                            </div>
                        </a>       
        </div>
        </div>
        <!-- user 출근부  -->
        <?php if( $member['mb_level'] == 27)
                    { ?>
                   <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="reg_mb_nick">출근부</label>
                    <div class="col-sm-3 col-form-info">
                    <?php
                        $g5['connect_db'];
                        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
                        while ( $row=sql_fetch_array($result))
                        {
                            $bo_table = $row['bo_table'];                            
                            $res = sql_fetch("select wr_id from ".$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}'");                            
                            if($res){ ?>
                                <?php if(defined('_INDEX_')) {?>    		
                                <a href="./bbs/write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" ><font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font></a>
                                <?php break;}
                                else{?>    		
                                <a href="./write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" ><font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font></a>
                                <?php break;} ?>                              
                            <?php }
                            } ?>	
                            </div>
                        </div>
                        <!-- user  가입일   mb_datetime  -->
            

 <!-- user  쿠폰   coupon_create  -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">
    쿠폰       
    </label>
    <div class="col-sm-3 col-form-info">
    <a href="<?php echo G5_BBS_URL ?>/coupon_create.php"><font color="blue"><b><i class="fa fa-paperclip"></i> <span class="hidden-xs">쿠폰</span></b></font></a>
    </div>
</div>
<?php } ?>

<?php if( $member['mb_level'] == 26 || $member['mb_level'] == 27)
                    { ?>
         <!-- user  지역-업종   mb_nick  -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">
    지역-업종       
    </label>
    <div class="col-sm-3 col-form-info">
    <?php echo $str_arr[0]." - ".$type; ?>
    </div>
</div>


 <!-- user  제휴기간   date  -->
 <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="reg_mb_nick">
        제휴기간      
        </label>
        <div class="col-sm-3 col-form-info">
        <?php echo $start_date." ~ ".$end_date.' - [';?><span style="color: blue;"><?php echo $diff_days.'일 남음';?></span>]
        </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">
    연락처      
    </label>
    <div class="col-sm- col-form-info">
    <?php if($member['mb_hp']) { echo $member['mb_hp'].'<br>'; }?>(프로필과 배너에 출력되니 항상 최신번호로 유지해주세요)
					<a onclick="window.open('<?php echo G5_URL ?>/bbs/member_hp_change.php?mb_id=<?php echo $member['mb_id'] ?>','전화번호 변경요청','width=300,height=300,scrollbars=no,padding=0, margin=0, top=300,left=800');" 
					style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none" >
						<font style="vertical-align: inherit;">전화번호 변경요청</font></a><i style='color: red;'>※ 전화번호는 운영자가 확인 후 변경처리됩니다.</i>
								
    </div>
</div>

<?php } ?>
        <!-- user  가입일   mb_datetime  -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">가입일</label>
    <div class="col-sm-3 col-form-info">
    <?php echo $entity_date;?>
    </div>
</div>

        <!-- user  최근 로그인   mb_today_login  -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">최근 로그인</label>
    <div class="col-sm-3 col-form-info">
    <?php echo $today_login;?>
    </div>
</div>

        <!-- user 서명     -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="reg_mb_nick">서명</label>
    <div class="col-sm-3 col-form-info">
    …</div>
</div>
        </dl>
    </section>
</div>
