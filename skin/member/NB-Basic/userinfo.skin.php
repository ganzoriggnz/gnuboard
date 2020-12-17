<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
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
                            <a class="py2 px-3" href= "#">
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
                            <a class="py2 px-3" href= "#">
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
                            <a class="py2 px-3" href= "#">
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
    <section class="xm">
    <dl class="dl-horizontal">
        <dt><em>*</em> 기본정보</dt><dd style="font-weight:bold;"> <!-- <img src="//opssfriend.com/img/class/man/25.gif" alt="25">&nbsp; --><?php echo $row['mb_nick']." ".$row['mb_id']?></dd>
        <dt>프로필 사진</dt>
                <dd>
                    <a href="//opssfriend.com/bbs/myphoto.php" target="_blank" class="win_memo" title="사진등록">
                        <div class="photo pull-left">
                            <i class="fa fa-user"></i>				</div>
                    </a>
                </dd> 
                <?php if( $member['mb_level'] == 26)
				{ ?>     
                <dt>출근부</dt><dd><span style="font-size:15px; font-weight:900">
                <?php
					$g5['connect_db'];
					$result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
					while ( $row=sql_fetch_array($result))
					{
						$bo_table = $row['bo_table'];
						
						$res = sql_fetch("select wr_id from ".$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}'");
						
						if($res){ 
							//  odoogiin huudas undsen nuur huudas bnuu 
						     if(defined('_INDEX_')) {?>    
							<!-- <i class="far fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i> -->			
							<a href="./bbs/write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" ><font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font></a>
					<?php break;}
							 else{?>    
								<!-- <i class="far fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i> -->			
								<a href="./write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" ><font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font></a>
					<?php break;}
								}	
					}	 
				}
				?></span></dd>
            
            <dt>쿠폰</dt><dd><a href="//opssfriend.com/plugin/member_info/coupon.php"><i class="fa fa-paperclip"></i> <span class="hidden-xs">쿠폰</span></a></dd>
            <dt>지역-업종</dt><dd>태릉-휴게텔</dd><dt>제휴기간</dt><dd>2017-04-12 ~ 2020-12-19 - [ <a href="//opssfriend.com/bbs/board.php?bo_table=cus_0010" target="_blank"><font color="red"><b>3일 남음</b></font></a> ]</dd><dt>제휴 연장 안내</dt><dd><p>제휴기간이 조만간 마감될 예정이니 운영자쪽지 혹은</p>
        <p>제휴문의 게시판에 연장신청 해 주시기 바랍니다.</p>
        <p>계좌정보는 연장신청 접수 후 쪽지로 발송됩니다.</p>
        <p>연장신청 시 입금자명을 반드시 기재해 주시기 바라며,</p>
        <p>신청시 기재된 입금자명과 실제 입금자가 상이한 경우</p>
        <p>확인에 어려움이 따르므로 가능한 동일한 이름으로 입금 부탁드리겠습니다.</p>
        <p>입금확인이 되지 않거나, 입금 후 입금자명을 보내주지 않으실 경우</p>
        <p>운영정책상 연장마감일 이후 자정을 기준으로 순차적으로 비제휴로 전환됩니다.</p>
        <p><br></p>
        <p><b>※ 입금계좌는 수시로 변동될 수 있으므로 반드시 입금전 쪽지로 문의주시기 바랍니다.</b></p>
        <p><br></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </dd><dt>연락처</dt><dd>01042535226<br>(프로필과 배너에 출력되니 항상 최신번호로 유지해주세요) &nbsp;&nbsp;&nbsp;<a onclick="window.open('//opssfriend.com/bbs/member_hp_change.php?mb_id=juho3141','전화번호 변경요청','width=300,height=300,scrollbars=no,padding=0, margin=0, top=300,left=800');" style="color:#000;background-color:#efefef; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none">
                            <i class="fa fa-address-book-o"></i><span>&nbsp;전화번호 변경요청</span></a>&nbsp;&nbsp;&nbsp;<font color="red"><b>※ 전화번호는 운영자가 확인 후 변경처리됩니다.</b></font></dd> 
        <dt>가입일</dt><dd>2017-04-12 17:05:41</dd>
        <dt>최근 로그인</dt><dd>2020-12-16 00:19:17</dd>
            
        <dt>서명</dt><dd style="color:#ccc">…</dd>
    </dl>
    </section>

