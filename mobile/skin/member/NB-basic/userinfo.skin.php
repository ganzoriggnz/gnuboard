<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="d-flex">
				<div id="user_cate_list" class="sly-wrap flex-grow-1">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0">
						<li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/userinfo.php" >
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
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <i class="fa fa-book">
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </i>
                                </span>
                            </a>
                        </li>
                        </ul>
						<ul id="user_cate_ul" class="sly-list d-flex">
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
                        <?php } ?>
                    </ul>
                    <hr/>
				</div>
			</div>
		</div>
    </nav>
    <section class="xm">
       <table cellspacing="0" class=" px-3 mr-3" cellpadding="0" width="100%"  style="font-size: 12px; padding:5px;" id="level-up">
		<thead>  
			<tr style="font-size: 12px; " >
				<th class="cl_tr"><label class="col-form-label" for="reg_mb_nick">기본정보</label></th>
				<th class="cl_tr"><?php echo $row['mb_nick']." ".$row['mb_id']?></th>
			</tr>
		</thead>
		<tbody>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">보유파운드</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                        <a href="#" target="_blank" class="win_memo" title="사진등록">
                            <div class="photo pull-left"><i class="fa fa-user"></i></div></a></td>	
        </tr>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">출근부</label></td>
				<td class="cl_tr" style="text-align: left;"> 
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
                            </td>	
        </tr>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">쿠폰</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <a href="<?php echo G5_BBS_URL ?>/coupon_create.php"><font color="blue"><b><i class="fa fa-paperclip"></i> <span class="hidden-xs">쿠폰</span></b></font></a>
                </td>	
        </tr>
        <?php if( $member['mb_level'] == 27 || $member['mb_level'] == 27)
                    { ?>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">지역-업종</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <?php echo $str_arr[0]." - ".$type; ?> </td>	
        </tr>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">제휴기간</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <?php echo $start_date." ~ ".$end_date.' - [';?><span style="color: blue;"><?php echo $diff_days.'일 남음';?></span>] </td>	
        </tr>
        <?php } ?>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">연락처</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <?php if($row['mb_hp']) {echo $row['mb_hp'].'<br>'; }?>(프로필과 배너에 출력되니 항상 최신번호로 유지해주세요)</td>	
        </tr>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">가입일</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <?php echo $entity_date;?></td>	
        </tr>
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">최근 로그인</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                <?php echo $today_login;?></td>	
        </tr>

         <!-- user 서명     -->
        <tr style=" font-size: 12px">
				<td class="cl_tr"><label class="col-form-label" for="reg_mb_nick">서명</label></td>
				<td class="cl_tr" style="text-align: left;"> 
                …</td>
        </tr>
        </tbody>
        </table>
    </section>
</div>
