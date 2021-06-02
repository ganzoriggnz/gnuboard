<?php
include_once('../../../../common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


/* 로그인 위젯 */

//필요한 전역변수 선언
global $config, $member, $is_member, $urlencode, $is_admin, $g5;

function insert_nickname($wer)
{
	alert("dddd : ".$wer);
}

?>
<style>
.svg-img path .clipboard-list{
	fill:#fff;
}

.popup_box2{
	position: absolute;
	
	transform: translate(-50%, -50%);
	border-radius: 5px;
	width: 320px;
	background: #f2f2f2;
	text-align: center;
	align-items: center;
	padding: 30px;
	border: 1px solid #b3b3b3;
	box-shadow: 0px 5px 10px rgba(0,0,0,.2);
	z-index: 9999;
	display: none;
  }
  .popup_box2 i{
	font-size: 12px;
	color: #eb9447;
	border: 5px solid #eb9447;
	padding: 20px 10px;
	border-radius: 50%;
	margin: -10px 0 20px 0;
  }
  .popup_box2 h1{
	font-size: 14px;
	font-weight: bold;
	color: #000;
	margin-bottom: 30px;
  }
  .popup_box2 label{
	font-size: 14px;
	color: #000;
	line-height: 2;
  }
  .popup_box2 .btsnick{
	  margin: 40px 0 0 0;
	}
  .btsnick .btn {
	  background: #f2f2f2;
	  color: #000;
	  font-size: 12px;
	  border-radius: 5px;
	  border: 1px solid #808080;
	  padding: 6px 30px;
	}
  .btsnick .btn:hover{
	transition: .2s;
	background:#fff;
  }
</style>

<div class="f-de font-weight-normal">

	<?php if($is_member) { //Login ?>

		<div class="d-flex align-items-center mb-3" style="color: #AEAEAE;">
			<div class="pr-3">                           
			 <?php if ($member['mb_level'] >= $config['cf_icon_level'] && $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height']) {  ?>
                            <a href="#" onclick="window.open('<?php echo G5_URL ?>/bbs/my_photo.php','전화번호 변경요청','width=350,height=350,scrollbars=no,padding=0, margin=0, top=300,left=800');"
                            >
                           	<img src="<?php echo na_member_photo($member['mb_id']) ?>" class="rounded-circle">
                            </a>
                            <?php } else {?>
                           	<img src="<?php echo na_member_photo($member['mb_id']) ?>" class="rounded-circle">
                            <?php } ?>
			
			</div>
			<div class="flex-grow-1 pt-2">
				<h5 class="hide-photo mb-2">
					<b style="letter-spacing:-1px;"><?php echo str_replace('sv_member', 'sv_member en', $member['sideview']); ?></b>
				</h5><span><?php echo get_level($member['mb_id']);?></span>
				<span style="font-size:14px; color:#e4c980;"><?php echo ($member['mb_grade']) ? $member['mb_grade'] : $member['mb_level'].'등급' ;  ?></span><br>
				
				<!-- hulan nemsen 출근부 수정 -->
				<?php $now = G5_TIME_YMDHIS;
					  $finish_date = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($member['mb_4'])));  ?>
				<?php if( $member['mb_level'] == 27 || ($member['mb_level'] == '26' && $finish_date >= $now))
				{ 

					$g5['connect_db'];
					$result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
					while ( $row=sql_fetch_array($result))
					{
						$bo_table = $row['bo_table'];
						
						$res = sql_fetch("select wr_id from ".$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}'");
						
						if($res){ 
							//  odoogiin huudas undsen nuur huudas bnuu 
						     if(defined('_INDEX_')) {?>    
							<i class="fa fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i>			
							<a href="./bbs/write.php?w=u&fr=widget&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" > 업소정보 수정</a>
					<?php break;}
							 else{?>    
								<i class="fa fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i>			
								<a href="./write.php?w=u&fr=widget&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" > 업소정보 수정</a>
					<?php break;}
								}	
					}	 
				}
				?>
				<!-- ////////////////////////////////////////// -->

				<?php if( $member['mb_level'] > 17 && $member['mb_level'] < 23  )
				{?> 
					<button type="button" id="nickbtn" style="color: #BFAF88; background-color: Transparent;
							background-repeat:no-repeat;
							border: none; " >칭호 설정</button>
						<div class="popup_box2">						
						<h1>칭호 설정</h1>
						<label>칭호 입력(4글자까지 가능)</label><br>
						<input type="hidden" name="mb_id" id="mb_id" value="<?php echo $member['mb_id'];?> ">
						<input type="text" name="mb_nick2" id="mb_nick2" maxlength="4" value="<?php echo $member['mb_nick2'];?>">
						<div class="btsnick">
							<a href="#" class="btn">확인</a>
						</div>						
						</div>
						<script>
						$(document).ready(function(){
							
								$('#nickbtn').click(function(){
									// var formId = "#fcouponaccept" + this.id;
									
									$('.popup_box2').css("display", "block");
									
									$('.btn').click(function(){
										
										$('.popup_box2').css("display", "none");
										
										var mb_id = $('#mb_id').val();
										var mb_nick2 = $('#mb_nick2').val();
										$.ajax({
											type: 'POST',
											url: 'insert_nick.php',
											data: {
												'mb_id': mb_id,
												'mb_nick2': mb_nick2,
											},
											dataType: 'text',
											// success: function(response) {}
										});
										

									});
								});                                  
							})
														
						</script>



					<?php } ?> 
				
				<?php if(($is_admin == 'super' || $member['is_auth']) && G5_BZY_CHECK) { ?>
					<span class="na-bar"></span>
					<a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" style="color: #AEAEAE;">
						관리자
					</a>
				<?php } ?>
			</div>
		</div>
		
		<div class="btn-group w-100" role="group" aria-label="Member Menu">
			<a class="btn btn-primary text-white" href="<?php echo G5_BBS_URL ?>/userinfo.php" role="button" aria-expanded="false" aria-controls="mymenu_outlogin">
				마이메뉴
			</a>
			<!-- <?php if(IS_NA_NOTI) { // 알림 ?>
				<a href="<?php echo G5_BBS_URL ?>/noti.php" class="btn btn-primary text-white" role="button">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<?php if ($member['as_noti']) { ?><b><?php echo number_format($member['as_noti']) ?></b><?php } ?>
				</a>
			<?php } ?> -->

				
				<a href="<?php echo G5_ATTENDANCE_URL ?>/attendance.php" class="btn btn-primary text-white" role="button">
					<!-- <i class="fas fa-calendar-check"></i></font></a> -->					
					<img src="<?php echo G5_URL?>/img/solid/calendar-check.svg" alt="calendar-check" style="height:14px;"/></a>
				
				<a href="<?php echo G5_BBS_URL ?>/mission.php" class="btn btn-primary text-white" role="button"> 
				<!-- <i class="fas fa-clipboard-list"></i></font></a> -->
				<img src="<?php echo G5_URL?>/img/solid/clipboard-list.svg" alt="clipboard-list" class="svg-img" style="height :14px;"/></a> 
					
			<!-- <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="btn btn-primary text-white win_memo" role="button">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<?php if ($member['mb_memo_cnt']) { ?><b><?php echo number_format($member['mb_memo_cnt']);?></b><?php } ?>
			</a> -->
			<a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn btn-primary text-white" role="button">
				로그아웃
			</a>
		</div>

		<div class="collapse" id="mymenu_outlogin">
			<div class="clearfix bg-light border px-3 pt-3 pb-1">
				<?php
				// 멤버쉽 플러그인
				if(IS_NA_XP) {
					$per = (int)(($member['as_exp'] / $member['as_max']) * 100);
				?>
					<div class="clearfix">
						<span class="float-left">레벨 <?php echo $member['as_level'] ?></span>
						<span class="float-right">
							<a href="<?php echo G5_BBS_URL ?>/exp.php" target="_blank" class="win_point">
								Exp <?php echo number_format($member['as_exp']) ?>(<?php echo $per ?>%)
							</a>
						</span>
					</div>
					<div class="progress mb-2" title="레벨업까지 <?php echo number_format($member['as_max'] - $member['as_exp']);?> 경험치 필요">
						<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $per ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $per ?>%">
							<span class="sr-only"><?php echo $per ?>%</span>
						</div>
					</div>
				<?php } ?>

				<ul class="row mx-n1">
					<?php if($config['cf_use_point']) { ?>
						<li class="col-12 px-1">
							<a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" class="btn btn-block btn-basic win_point f-sm mb-2">
								포인트 <b class="orangered"><?php echo number_format($member['mb_point']);?></b>
							</a>
						</li>
					<?php } ?>
					<?php if(IS_NA_NOTI) { // 알림 ?>
						<li class="col-6 px-1">
							<a href="<?php echo G5_BBS_URL ?>/noti.php" class="btn btn-block btn-basic f-sm mb-2">
								알림<?php if ($member['as_noti']) { ?> <b class="orangered"><?php echo number_format($member['as_noti']) ?></b><?php } ?>
							</a>
						</li>
					<?php } ?>
					<li class="col-6 px-1">
						<a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="btn btn-block btn-basic win_memo f-sm mb-2">
							쪽지<?php if ($member['mb_memo_cnt']) { ?> <span class="orangered"><?php echo number_format($member['mb_memo_cnt']);?></span><?php } ?>
						</a>
					</li>
					<li class="col-6 px-1">
						<a href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank" class="btn btn-block btn-basic win_scrap f-sm mb-2">
							스크랩
						</a>
					</li>
					<?php if ($is_admin == 'super' || $member['is_auth']) { ?>
						<li class="col-6 px-1">
							<a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" class="btn btn-block btn-basic f-sm mb-2">
								관리자
							</a>
						</li>
					<?php } ?>
					<li class="col-6 px-1">
						<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" class="btn btn-block btn-basic f-sm mb-2">
							정보수정
						</a>
					</li>
					<li class="col-6 px-1">
						<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php" class="btn btn-block btn-basic f-sm mb-2">
							회원탈퇴
						</a>
					</li>
				</ul>
			</div>
		</div>

	<?php } else { //Logout ?>
		<form id="basic_outlogin" name="basic_outlogin" method="post" action="<?php echo G5_HTTPS_BBS_URL ?>/login_check.php" style="display: flex; flex-direction: column;">
        <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
        <div style="display: flex; align-items: stretch; height: 100%;">
            <div>
			    <div class="form-group">
					<label for="outlogin_mb_id" class="sr-only">아이디<strong class="sr-only"> 필수</strong></label>
					<div class="input-group">
						<input type="text" name="mb_id" id="outlogin_mb_id" class="form-control" style="background-color: #3B3B45; border-color: #505059; width: 143px;" placeholder="아이디">
						<div class="input-group-append">
							<span class="input-group-text" style="background-color: #1C1C26; border-color: #505059; width:30px;"><img src="<?php echo G5_URL."/img/portrait.png" ?>" alt="portrait"></span>
						</div>
					</div>
				</div>
				<div class="form-group">
						<label for="outlogin_mb_password" class="sr-only">비밀번호<strong class="sr-only"> 필수</strong></label>
						<div class="input-group">
							<input type="password" name="mb_password" id="outlogin_mb_password" class="form-control" style="background-color: #3B3B45; border-color: #505059; width: 143px;" placeholder="비밀번호" autocomplete="off">	
							<div class="input-group-append">
								<span class="input-group-text" style="background-color: #1C1C26; border-color: #505059; width: 30px;"><img src="<?php echo G5_URL."/img/combined_shape.png" ?>" alt="combined-shape"></span>
							</div>
						</div>
				</div>
			</div>
			<div class="form-group" style="margin-left: 9px;">
				<button type="submit" class="btn btn-block p-3 en" style="background-color: #4B4B4D; height: 100%;padding: 0px 0px 0px 5px !important;text-align: center;width: 62px !important;color: #fff;">
                    <!-- <i class="fa fa-sign-in" aria-hidden="true" style="margin-bottom: 5px;"></i> -->
                    <h6>로그인</h6>
				</button>
            </div>
        </div>

			<div style="display: flex; justify-content: space-between;">
				<div class="float-left" >
					<div class="form-group mb-0">
						<div class="custom-control">
						  <input type="checkbox" name="auto_login" class="custom-control-input remember-me" id="outlogin_remember_me">
						  <label class="custom-control-label float-left" for="outlogin_remember_me" style="color: #AEAEAE;">자동로그인</label>
						</div>
					</div>
				</div>
				<div class="float-right">
					<a href="<?php echo G5_BBS_URL ?>/register.php" style="color: #AEAEAE;">
						회원가입
					</a>
					<!-- <span class="na-bar"></span>
					<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost" style="color: #AEAEAE;">
						정보찾기
					</a> -->
				</div>
			</div>
			<script>
				var element1 = document.getElementById("outlogin_mb_id");
				var element2 = document.getElementById("outlogin_mb_password");
				element1.addEventListener("focus", handler);
				element1.addEventListener("blur", handler);
				element2.addEventListener("focus", handler);
				element2.addEventListener("blur", handler);

				function handler(evt) {
					if (evt.type == "focus")
						evt.target.style.backgroundColor = "#fff";
					else if (evt.type == "blur") {
						evt.target.style.backgroundColor = "#3B3B45;";
					}
				}
			</script>
		</form>

        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include(get_social_skin_path().'/social_outlogin.skin.1.php');
        ?>

	<?php } //End ?>
	
</div>
