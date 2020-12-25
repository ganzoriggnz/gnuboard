<?php
include_once('../../../../common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/* 로그인 위젯 */

//필요한 전역변수 선언
global $config, $member, $is_member, $urlencode, $is_admin, $g5;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

?>

<div class="f-de font-weight-normal">

	<?php if($is_member) { //Login ?>

		<div class="d-flex align-items-center mb-3" style="color: #AEAEAE;">
			<div class="pr-3">
				<img src="<?php echo na_member_photo($member['mb_id']) ?>" class="rounded-circle">
			</div>
			<div class="flex-grow-1 pt-2">
				<h5 class="hide-photo mb-2">
					<b style="letter-spacing:-1px;"><?php echo str_replace('sv_member', 'sv_member en', $member['sideview']); ?></b>
				</h5>
				<?php echo ($member['mb_grade']) ? $member['mb_grade'] : $member['mb_level'].'등급' ;  ?> <br>
				
				<!-- hulan nemsen 출근부 수정 -->

				<?php if( $member['mb_level'] == 27)
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
							<i class="far fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i>			
							<a href="./bbs/write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" > 업소정보 수정</a>
					<?php break;}
							 else{?>    
								<i class="far fa-edit" style="margin-right: 2px; border-color: #BFAF88"; ></i>			
								<a href="./write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page=" style="color: #BFAF88;" > 업소정보 수정</a>
					<?php break;}
								}	
					}	 
				}
				?>
				<!-- ////////////////////////////////////////// -->

				<?php if( $member['mb_level'] > 17 && $member['mb_level'] < 23  )
				{
					echo "칭호 설정";

				} ?> 
				
				<?php if ($is_admin == 'super' || $member['is_auth']) { ?>
					<span class="na-bar"></span>
					<a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" style="color: #AEAEAE;">
						관리자
					</a>
				<?php } ?>
			</div>
		</div>
		
		<div class="btn-group w-100" role="group" aria-label="Member Menu">
			<a class="btn btn-primary text-white" data-toggle="collapse" href="#mymenu_outlogin" role="button" aria-expanded="false" aria-controls="mymenu_outlogin">
				마이메뉴
			</a>
			<?php if(IS_NA_NOTI) { // 알림 ?>
				<a href="<?php echo G5_BBS_URL ?>/noti.php" class="btn btn-primary text-white" role="button">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<?php if ($member['as_noti']) { ?><b><?php echo number_format($member['as_noti']) ?></b><?php } ?>
				</a>
			<?php } ?>
			<a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="btn btn-primary text-white win_memo" role="button">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<?php if ($member['mb_memo_cnt']) { ?><b><?php echo number_format($member['mb_memo_cnt']);?></b><?php } ?>
			</a>
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
		<form id="basic_outlogin" name="basic_outlogin" method="post" action="<?php echo G5_HTTPS_BBS_URL ?>/login_check.php" autocomplete="off" style="display: flex; flex-direction: column;">
        <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
        <div style="display: flex; align-items: stretch; height: 100%;">
            <div>
			    <div class="form-group">
				<label for="outlogin_mb_id" class="sr-only">아이디<strong class="sr-only"> 필수</strong></label>
				<div class="input-group">
					<input type="text" name="mb_id" id="outlogin_mb_id" class="form-control" style="background-color: #3B3B45; border-color: #505059; width: 143px;" placeholder="아이디">
					<div class="input-group-append">
						<span class="input-group-text" style="background-color: #1C1C26; border-color: #505059; width:30px;"><img src="http://210.114.18.63/img/portrait.png" ></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="outlogin_mb_password" class="sr-only">비밀번호<strong class="sr-only"> 필수</strong></label>
				<div class="input-group">
					<input type="password" name="mb_password" id="outlogin_mb_password" class="form-control" style="background-color: #3B3B45; border-color: #505059; width: 143px;" placeholder="비밀번호">
					<div class="input-group-append">
						<span class="input-group-text" style="background-color: #1C1C26; border-color: #505059; width: 30px;"><img src="http://210.114.18.63/img/combined_shape.png" ></span>
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
					<span class="na-bar"></span>
					<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost" style="color: #AEAEAE;">
						정보찾기
					</a>
				</div>
			</div>
		</form>

        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include(get_social_skin_path().'/social_outlogin.skin.1.php');
        ?>

	<?php } //End ?>
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
</div>
