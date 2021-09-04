<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_title_url.'/title.css">', 0);
$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = short_url_clean(G5_BBS_URL.'/write.php?bo_table='.$bo_table);
}

// 답변 링크
$reply_href = '';
if ($member['mb_level'] >= $board['bo_reply_level']) {
    $reply_href = short_url_clean(G5_BBS_URL.'/write.php?w=r&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr);
}

// 수정, 삭제 링크
$update_href = $delete_href = '';
// 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
if (($member['mb_id'] && ($member['mb_id'] === $write['mb_id'])) || $is_admin) {
    $update_href = short_url_clean(G5_BBS_URL.'/write.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr);
    set_session('ss_delete_token', $token = uniqid(time()));
    $delete_href = G5_BBS_URL.'/delete.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;token='.$token.'&amp;page='.$page.urldecode($qstr);
}
else if (!$write['mb_id']) { // 회원이 쓴 글이 아니라면
    $update_href = G5_BBS_URL.'/password.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $delete_href = G5_BBS_URL.'/password.php?w=d&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

// 최고, 그룹관리자라면 글 복사, 이동 가능
$copy_href = $move_href = '';
if ($write['wr_reply'] == '' && ($is_admin == 'super' || $is_admin == 'group' || $member['mb_level'] > 23)) {
    $copy_href = G5_BBS_URL.'/move.php?sw=copy&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $move_href = G5_BBS_URL.'/move.php?sw=move&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}
?>

<!-- Page Title -->
<div id="nt_title" class="font-weight-normal" <?php if(!G5_IS_MOBILE){ echo 'style="margin-bottom: 8px;"'; } else {echo 'style="margin-bottom: 5px;"' ;}?> >

	<?php if(G5_IS_MOBILE) { ?>
		<div class="nt-container px-xl-0">	
			<div class="d-flex pb-1 pl-0">
				<div class="align-self-start d-sm-block">
					<nav aria-label="breadcrumb" class="f-sm">
						<ol class="breadcrumb bg-transparent p-0 m-0" style="display:flex; flex-wrap: nowrap">
							<?php
								// 페이지 설명글 없으면 현재 위치 출력
								$tnav_cnt = 0;
								$tnav_txt = $tset['page_desc'];
								if(!$tnav_txt) {
									$tnav_cnt = count($tnav);
									if(!$tnav_cnt) {
										$tnav_txt = $page_title;
									}
								}
							?>
							<?php if($tnav_txt) { ?>
								<li class="breadcrumb-item active mb-0 mr-3" aria-current="page">
									<a href="#"><?php echo $tnav_txt ?></a>
								</li>
							<?php } ?>
							<!-- <li>
								<div class="clearfix f-sm text-muted pt-2 pr-2">
									<h3 class="sr-only">컨텐츠 정보</h3>
									<ul class="d-flex-start align-items-center mr-2"> -->
										<li id="bo_v_btn" style="width:70%;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: flex-end;align-items: center;">
											<!-- 게시물 상단 버튼 시작 { -->
											<?php ob_start(); ?>
											<div>
												<?php 
												$now = G5_TIME_YMDHIS; 
												$finish_date = date('Y-m-d', strtotime('+3 days', strtotime($member['mb_4']))); 
												if ($update_href) { 
													if(($member['mb_level'] == '26') 
													|| $is_admin 
													|| ($member['mb_level'] != '26' && $member['mb_level'] != '27' && $gr_id !="attendance") 
													|| ($member['mb_level'] == '27' && $gr_id =="attendance")){?>
												<a href="<?php echo $update_href ?>" class="btn-vw mb-2" style="color:#ffffff;width:60px;" role="button">
													글수정
												</a>
												<?php } } ?>
												<?php if($member['mb_level'] != '24' && $member['mb_level'] != '25' && (($gr_id=='attendance' && $member['mb_level'] != 26 && $member['mb_level'] != 27) || $gr_id=='community' || $gr_id=='review' || $gr_id=='library')) { 
												if ($delete_href) {  ?>
												<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;"
													class="btn-vw mb-2" style="color:#ffffff;width:60px;" role="button">
													글삭제
												</a>
												<?php } ?>
												<?php if ($move_href) { ?>
												<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;"
													class="btn-vw mb-2" style="color:#ffffff;width:60px;" role="button">
													글이동
												</a>
												<?php } }?>
												<a href="<?php echo $list_href ?>" class="btn-vw mb-2" style="color:#ffffff;width:60px;" title="목록" role="button">
													목록
												</a>

												<?php if ($write_href) { ?>
												<a href="<?php echo $write_href ?>" class="btn-vw mb-2" style="color:#ffffff;width:60px;" title="글쓰기" role="button">
													글쓰기
												</a>
												<?php } ?>
											</div>
											<?php
										$link_buttons = ob_get_contents();
										ob_end_flush();
										?>
											<!-- } 게시물 상단 버튼 끝 -->
										</li>
									<!-- </ul>
								</div>
							</li> -->
							<!-- <?php if($tnav_cnt) { ?>
								<li class="breadcrumb-item mb-0">
									<a href="<?php echo NT_HOME_URL ?>"><i class="fa fa-home"></i></a>
								</li>
								<?php for($i=0; $i < $tnav_cnt; $i++) { ?>
									<li class="breadcrumb-item mb-0<?php echo (($i + 1) == $tnav_cnt) ? ' active" aria-current="page' : ''; ?>">
										<a href="<?php echo $tnav[$i]['href'] ?>" target="<?php echo $tnav[$i]['target'] ?>" <?php if($i == '0') {echo 'style="font-weight: bold"';}  ?>><?php echo $tnav[$i]['text'] ?></a>
									</li>
								<?php } ?>
							<?php } ?> -->
						</ol>
					</nav>
				</div>
			</div>
		</div>						
	<?php } else { ?>
		<div class="nt-container px-3 px-sm-4 px-xl-0">	
			<div class="d-flex pb-1">
				<div class="align-self-center page-title en text-nowrap">
					<?php if($tset['page_icon']) { ?>
						<i class="fa <?php echo $tset['page_icon'] ?>" aria-hidden="true"></i>
					<?php } ?>
					<strong><?php echo $page_title;?></strong>
				</div>
				<div class="align-self-end ml-auto d-sm-block">
					<nav aria-label="breadcrumb" class="f-sm">
						<ol class="breadcrumb bg-transparent p-0 m-0">
							<?php
								// 페이지 설명글 없으면 현재 위치 출력
								$tnav_cnt = 0;
								$tnav_txt = $tset['page_desc'];
								if(!$tnav_txt) {
									$tnav_cnt = count($tnav);
									if(!$tnav_cnt) {
										$tnav_txt = $page_title;
									}
								}
							?>
							<?php if($tnav_txt) { ?>
								<li class="breadcrumb-item active mb-0" aria-current="page">
									<a href="#"><?php echo $tnav_txt ?></a>
								</li>
							<?php } ?>
							<?php if($tnav_cnt) { ?>
								<li class="breadcrumb-item mb-0">
									<a href="<?php echo NT_HOME_URL ?>"><i class="fa fa-home"></i></a>
								</li>
								<?php for($i=0; $i < $tnav_cnt; $i++) { ?>
									<li class="breadcrumb-item mb-0<?php echo (($i + 1) == $tnav_cnt) ? ' active" aria-current="page' : ''; ?>">
										<a href="<?php echo $tnav[$i]['href'] ?>" target="<?php echo $tnav[$i]['target'] ?>" <?php if($i == '0') {echo 'style="font-weight: bold"';}  ?>><?php echo $tnav[$i]['text'] ?></a>
									</li>
								<?php } ?>
							<?php } ?>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
