<?php

use function PHPSTORM_META\map;

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$bo_table = $_REQUEST['bo_table'];
$phone=get_member($view['mb_id'],"mb_hp");

$linkcount = strlen($bo_table) - 2;
$str_table =substr($bo_table, 0, $linkcount);
$re = $str_table."re"; 
$at = $str_table."at";
$atwr_id;
// hulan nemsen 글 보기 페이지에서 글쓰기 버튼을 숨기고 싶으면
// 지정된 회원만 글쓰기 권한부여. 게시판 설정 여분필드 1번 값 사용
if($gr_id == 'attendance'){
	if ($board['bo_1']) {
		$arr_mbids = explode(',', trim($board['bo_1']));
		if(!$is_admin && !in_array($member['mb_id'], $arr_mbids)) {
			$write_href = '';
			$reply_href = '';
			}
		else if (!$is_admin && in_array($member['mb_id'], $arr_mbids)) // admin bish ene sambart bichih erhtei hun bol end bichver bichsen esehiig shalgah
			$wr_cnt = sql_fetch(" select count(wr_id) as cnt from {$write_table} where wr_is_comment=0 and mb_id = '{$member['mb_id']}' ");
			if ($wr_cnt['cnt']) {
				$write_href = '';
				$reply_href = '';
		   }
	} else if(!$board['bo_1']){
		$write_href = '';
		$reply_href = '';
	}
	}
	else if ($gr_id == 'review' && ($member['mb_level'] == 26 || $member['mb_level'] == 27))
	{
		$write_href = '';
		$reply_href = '';
	} 
	/////////////////////////////////////////////////////////////////////////////////



// SyntaxHighLighter
if(isset($boset['na_code']) && $boset['na_code'])
	na_script('code');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

// SEO 이미지
$view['seo_img'] = na_wr_img($bo_table, $view);

// SEO 등과 공용사용
$view_subject = get_text($view['wr_subject']);

if ($gr_id=='review') {
	$atwr_id = sql_fetch(" select wr_id from {$g5['write_prefix']}{$at} where mb_id = (select mb_id from g5_member where mb_name = '{$view['wr_7']}' limit 1) limit 1 ");
}
/////////////////////////////////////////////////////////////////////////////
?>

	<!-- // hulan nemsen admin bichsen bichvert gichuunii zasah erh olgoh -->

	<!-- <?php if($is_admin == 'super' && $gr_id == "attendance") { ?>
	<div class="tbl_frm01 tbl_wrap">
		<table>
			<tbody>
			<form name="update_id" action="<?php echo $board_skin_url; ?>/update_writer.php" method="post" style="padding:0; margin:0;">
			<input type="hidden" name="bo_table" value="<?php echo $g5['write_prefix'] . $bo_table; ?>">
			<input type="hidden" name="REQUEST_URI" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
			<tr>
				<th scope="row">아이디 변경</th>
				<td><input type="text" name="mb_id" style="width:120px;" class="frm_input" value="<?php echo $view['mb_id']; ?>"></td>
				<th style="text-align:center;"><div class="btn_list"><input type="submit" value=" 저장 " class="btn_list"></div></th>
			</tr>
			</form>
			</tbody>
		</table>
	</div>
	<?php } ?>		 -->
	<!-- ////////////////////////////////////////////////////////////	 -->

	<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

	<!-- 게시물 읽기 시작 { -->
	<article id="bo_v" class="mb-4">

	    <header class="font-weight-normal mb-2 px-3 px-sm-0">
	        <?php if ($category_name) { ?>
	        <div class="f-sm text-muted">
	            <span class="sr-only">분류</span>
	            <!-- <?php echo $view['ca_name'] ?> -->
	        </div>
	        <?php } ?>
	        <!-- <h1 id="bo_v_title"> hulan tailbar bolgood doodohoor uurchilsen -->
	        <h3 id="bo_v_title"
	            <?php if ($view['wr_1'] && !G5_IS_MOBILE) { echo " style='color:".$view['wr_1']."' "; } else {echo " style='color:".$view['wr_1']."; padding-left:0px; margin-left: 0px;' ";} ?>>
	            <?php echo $view_subject; // 글제목 출력 ?>

	            <!-- hulan nemsen 삭제요청 ///////////////////////////////////-->
	            <?php
        if ($board['bo_2']) {
            if ($member['mb_level'] == 26 || $member['mb_level'] == 27) {
                echo '<button id="board_singo" class="btn btn_b03" style="float:right;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>삭제요청</button>';
			}
			else{
				echo '<button id="board_singo" class="btn btn_b03" style="float:right;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>신고</button>';
			}
        }
        ?>
	            <!-- /////////////////////////////////////////////////////////// -->
	        </h3>

	    </header>
	    <?php if (G5_IS_MOBILE && $gr_id == "attendance") { ?>
	    <section id="bo_v_info" class="f-sm font-weight-normal px-3" style="margin-bottom: 0px !important;">
	        <div class="clearfix bg-light border-top text-muted py-2">
	            <h3 class="sr-only">작성자 정보</h3>
	            <ul class="d-flex-start align-items-center">
	                <li>
	                    <span class="sr-only">작성자</span>
	                    <!-- hulan nemsen level mark -->
	                    <?php if ($view['wr_2']) echo '<i class="fa fa-mobile" aria-hidden="true"></i>'; echo na_name_photo($view['mb_id'], $view['name']); ?>

	                </li>
	                <?php if ($is_ip_view) { ?>
	                <li class="pr-2" style="float: left; display:inline;">
	                    <span class="sr-only">아이피</span>
	                    <span class="text-muted"><?php echo $ip ?></span>
	                </li>
	                <?php } ?>
	                <li class="flex-grow-1" style="float:left; display:inline;">
	                    <span class="sr-only">작성일</span>
	                    <time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['wr_last'])) ?>">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<?php echo empty($view['wr_last']) ? ' 작성일: '.date("Y.m.d H:i", strtotime($view['wr_datetime'])) : ' 수정일: '.date("Y.m.d H:i", strtotime($view['wr_last'])) ?>
						</time>
	                </li>
	                <li style="float:left; margin-left: 10px; display:inline;">
	                    <span class="sr-only">조회</span>
	                    <i class="fa fa-eye" aria-hidden="true"></i>
	                    <?php echo number_format($view['wr_hit']) ?>
	                </li>
	                <?php if($view['wr_comment']) { ?>
	                <li style="float:left; margin-left: 5px; display:inline;">
	                    <span class="sr-only">댓글</span>
	                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
	                    <b class="orangered"><?php echo number_format($view['wr_comment']) ?></b>
	                </li>
	                <?php } ?>
	            </ul>
	        </div>
	        <div class="clearfix f-sm text-muted pt-2 pr-2">
	            <h3 class="sr-only">컨텐츠 정보</h3>
				<ul class="d-flex-start align-items-center mr-2">
					<li id="bo_v_btn" class="flex-grow-1">
	                    <!-- 게시물 상단 버튼 시작 { -->
	                    <?php ob_start(); ?>
	                    <div style="float:left">
							<?php 
							$now = G5_TIME_YMDHIS; 
							$finish_date = date('Y-m-d', strtotime('+3 days', strtotime($member['mb_4']))); 
							if ($update_href) { 
								if(($member['mb_level'] == '26') 
								|| $is_admin 
								|| ($member['mb_level'] != '26' && $member['mb_level'] != '27' && $gr_id !="attendance") 
								|| ($member['mb_level'] == '27' && $gr_id =="attendance")){?>
							<a href="<?php echo $update_href ?>" class="btn-vw mb-2" role="button">
								<i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>
								글수정
							</a>
							<?php } } ?>
							<?php if($member['mb_level'] != '24' && $member['mb_level'] != '25' && (($gr_id=='attendance' && $member['mb_level'] != 26 && $member['mb_level'] != 27) || $gr_id=='community' || $gr_id=='review' || $gr_id=='library')) { 
							if ($delete_href) {  ?>
							<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
								글삭제
							</a>
							<?php } ?>
							<!-- <?php  if ($copy_href) { ?>
							<a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-files-o fa-fw" aria-hidden="true"></i>
								글복사
							</a>
							<?php } ?> -->
							<?php if ($move_href) { ?>
							<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-arrows fa-fw" aria-hidden="true"></i>
								글이동
							</a>
							<?php } }?>
							<!-- <?php if ($view['mb_id'] == $member['mb_id']) { ?>
							<a href="<?php echo $search_href ?>" class="btn-vw mb-2" title="검색목록" role="button" style="width:80px;">
								<i class="fa fa-search fa-fw" aria-hidden="true"></i>
								검색목록
							</a>
							<?php } ?>							 -->
	                        <a href="<?php echo $list_href ?>" class="btn-vw mb-2" title="목록" role="button">
	                            <i class="fa fa-list fa-fw" aria-hidden="true"></i>
	                            목록
	                        </a>
	                        <!-- <?php if ($reply_href) { ?>
	                        <a href="<?php echo $reply_href ?>" class="btn-vw mb-2" title="답변" role="button">
	                            <i class="fa fa-reply fa-fw" aria-hidden="true"></i>
	                            답변
	                        </a>
	                        <?php } ?> -->
	                        <?php if ($write_href) { ?>
	                        <a href="<?php echo $write_href ?>" class="btn-vw mb-2" title="글쓰기" role="button">
	                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
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
				</ul>
	        </div>
			<div class="clearfix f-sm text-muted pr-2">
				<!-- start    mobile   -->
				<ul class="d-flex-start align-items-center" style="display: flex;flex-direction: row; flex-wrap: wrap">
	                <li style="display: inline; margin-right:1px;" class="mb-1">
						<a href="<?php echo 'tel:'.$phone['mb_hp'] ?>"
	                        style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
							class="btn">
							전화하기
						</a>
	                </li>
	                <li style="display: inline; margin-right:1px;" class="mb-1">
						<a href="<?php echo 'sms:'.$phone['mb_hp'] ?>" 
	                        style="display: inline; color:#ffffff;font-size: 12px; padding:5px; background-color: #595959;"
	                        class="btn">
							문자하기
						</a>
					</li>
					<li style="display: inline; margin-right:1px;" class="mb-1">
						<a href="#viewcomment"	
							style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
							class="btn">
							댓글가기
						</a>
	                </li>
				    <?php if ($gr_id=='attendance') { ?>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#" 
								onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
								class="btn">
								후기가기
							</a>
						</li>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#"
								onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
								class="btn"> 
								후기작성
							</a>
						</li>
	                <?php } ?>
	                <?php if ($gr_id=='review') { ?>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#"
								onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
								class="btn" 
								title="업소정보" 
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;">
									업소정보
							</a>
						</li>
	                <?php } ?>
				</ul>
				 <!-- end   / -->
			</div>
	    </section>
	    <?php } else if(G5_IS_MOBILE && $gr_id != "attendance") { ?>
	    <section id="bo_v_info" class="f-sm font-weight-normal mb-4 px-3">
	        <div class="clearfix bg-light border-top text-muted py-2">
	            <h3 class="sr-only">작성자 정보</h3>
	            <ul class="d-flex-start align-items-center">
	                <li class="pr-2">
	                    <span class="sr-only">작성자</span>
	                    <!-- hulan nemsen level mark -->
	                    <?php if ($view['wr_2']) echo '<i class="fa fa-mobile" aria-hidden="true"></i>'; echo na_name_photo($view['mb_id'], $view['name']); ?>

	                </li>
	                <?php if ($is_ip_view) { ?>
	                <li class="pr-2" style="float: left; display:inline;">
	                    <span class="sr-only">아이피</span>
	                    <span class="text-muted"><?php echo $ip ?></span>
	                </li>
	                <?php } ?>
	                <li class="flex-grow-1 text-right" style="float: left; display:inline;">
	                    <span class="sr-only">작성일</span>
	                    <time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['wr_last'])) ?>">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<?php echo empty($view['wr_last']) ? ' 작성일: '.date("Y.m.d H:i", strtotime($view['wr_datetime'])) : ' 수정일: '.date("Y.m.d H:i", strtotime($view['wr_last'])) ?>
						</time>
	                </li>
	                <li style="float:left; margin-left: 10px; display:inline;">
	                    <span class="sr-only">조회</span>
	                    <i class="fa fa-eye" aria-hidden="true"></i>
	                    <?php echo number_format($view['wr_hit']) ?>
	                </li>
	                <?php if($view['wr_comment']) { ?>
	                <li style="float:left; margin-left: 5px; display:inline;">
	                    <span class="sr-only">댓글</span>
	                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
	                    <b class="orangered"><?php echo number_format($view['wr_comment']) ?></b>
	                </li>
	                <?php } ?>
	            </ul>
	        </div>
	        <div class="clearfix f-sm text-muted pt-2 pr-2">
	            <h3 class="sr-only">컨텐츠 정보</h3>
				<ul class="d-flex-start align-items-end">
					<li id="bo_v_btn" class="flex-grow-1">
	                    <!-- 게시물 상단 버튼 시작 { -->
	                    <?php ob_start(); ?>
	                    <div style="float:right">
							<!-- <?php $now = G5_TIME_YMDHIS; $finish_date = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($member['mb_4']))); if ($update_href) { if(($member['mb_level'] == '26' && $finish_date >= $now && $gr_id =="attendance") || $is_admin || ($member['mb_level'] != '26' && $member['mb_level'] != '27' && $gr_id !="attendance") || ($member['mb_level'] == '27' && $gr_id =="attendance")){?>
							<a href="<?php echo $update_href ?>" class="btn-vw mb-2" role="button">
								<i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>
								글수정
							</a>
							<?php } } ?> -->
							<?php if( $view['mb_id'] == $member['mb_id'] || $member['mb_level'] == '30' || $member['mb_level'] != '24' && $member['mb_level'] != '25' && (($gr_id=='attendance' && $member['mb_level'] != 26 && $member['mb_level'] != 27) || $gr_id=='community' || $gr_id=='review' || $gr_id=='library')) { 
							if ($delete_href) {  ?>
							<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
								글삭제
							</a>
							<?php } ?>
							<!-- <?php if ($copy_href) { ?>
							<a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-files-o fa-fw" aria-hidden="true"></i>
								글복사
							</a>
							<?php } ?> -->
							<?php if ($move_href) { ?>
							<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw mb-2" role="button">
								<i class="fa fa-arrows fa-fw" aria-hidden="true"></i>
								글이동
							</a>
							<?php } }?>
							<!-- <?php if ($search_href) { ?>
							<a href="<?php echo $search_href ?>" class="btn-vw mb-2" title="검색목록" role="button" style="width:80px;">
								<i class="fa fa-search fa-fw" aria-hidden="true"></i>
								검색목록
							</a>
							<?php } ?>	 -->
	                        <a href="<?php echo $list_href ?>" class="btn-vw mb-2" title="목록" role="button">
	                            <i class="fa fa-list fa-fw" aria-hidden="true"></i>
	                            목록
	                        </a>
	                        
	                        <?php if ($write_href && ($bo_table != "free" && $bo_table != "event" || ($bo_table == "free" && $member['mb_level'] != 26 && $member['mb_level'] != 27) || ($bo_table == "event" && ($member['mb_level'] == 24 || $member['mb_level'] == 25 ||  $is_admin == 'super' )))) { ?>
	                        <a href="<?php echo $write_href ?>" class="btn-vw mb-2" title="글쓰기" role="button">
	                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
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
				</ul>			
	        </div>
			<div class="clearfix f-sm text-muted pr-2">
	            <ul class="d-flex-start align-items-center">
					<!-- <li style="display: inline;"><a href="#viewcomment"		
								style="border:1px solid #e5e5e5; font-size: 10px;" class="btn"><i class="fa fa-arrow-down" aria-hidden="true"></i> 댓글바로가기</a>
					</li> -->
					<?php if ($bo_table !='free') { ?>
					<li style="display: inline; margin-right:1px;" class="mb-1">
						<a href="#viewcomment"	
							style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
							class="btn">
							<i class="fa fa-arrow-down" aria-hidden="true"></i>
							댓글가기
						</a>
	                </li>
					<?php } ?>
					<?php if ($gr_id=='review') { ?>
					<!-- <li style="display: inline;">
						<a href="#"						
						onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
						style="border:1px solid #e5e5e5; font-size: 10px;" class="btn"><i class="fa fa-list-alt" aria-hidden="true"></i> 업소정보</a>
					</li> -->
					<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#"
								onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
								class="btn" 
								title="업소정보" 
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;">
								<i class="fa fa-list-alt" aria-hidden="true"></i>
								업소정보
							</a>
						</li>
					<?php } ?> 
	            </ul>
			</div>
	    </section>

	    <?php } else { ?>
	    <section id="bo_v_info" class="f-sm font-weight-normal mb-4">
	        <div class="clearfix bg-light border-top text-muted px-3 py-2">
	            <h3 class="sr-only">작성자 정보</h3>
	            <ul class="d-flex align-items-center">
	                <li class="pr-2">
	                    <span class="sr-only">작성자</span>
	                    <!-- hulan nemsen level mark -->
						<?php if($view['wr_4']=='Y'){?>
							<span class="profile_img"><img class="member_photo" src="/img/no_profile.gif" width="22" height="22" style="border-radius:50%;" alt="" title=""></span> 익명
						<?php } else {?>
							<?php if ($view['wr_2']) echo '<i class="fa fa-mobile" aria-hidden="true"></i>'; echo na_name_photo($view['mb_id'], $view['name']); ?>
						<?php }?>
	                </li>
	                <?php if ($is_ip_view) { ?>
	                <li class="pr-2">
	                    <span class="sr-only">아이피</span>
	                    <span class="text-muted"><?php echo $ip ?></span>
	                </li>
	                <?php } ?>
					<?php if ((int)$view['wr_10']) {?>
	                <li class="pr-2">
	                    <span class="sr-only">럭키포인트</span>
						<i class="fa fa-gift" aria-hidden="true"></i> 축하드립니다~ 열심히 활동한 결과 <b class="orangered"><?php echo number_format($view['wr_10']) ?>파운드</b>를 획득 하셨습니다.</b>
	                </li>
					<?php } ?>
	                <li class="flex-grow-1 text-right">
	                    <span class="sr-only">작성일</span>
	                    <time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['wr_last'])) ?>">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<?php echo empty($view['wr_last']) ? ' 작성일: '.date("Y.m.d H:i", strtotime($view['wr_datetime'])) : ' 수정일: '.date("Y.m.d H:i", strtotime($view['wr_last'])) ?>
						</time>
	                </li>
	            </ul>
	        </div>

	        <div class="clearfix f-sm text-muted pl-3 pt-2 pr-2">
	            <h3 class="sr-only">컨텐츠 정보</h3>
	            <ul class="d-flex align-items-center">
	                <li class="pr-3">
	                    <span class="sr-only">조회</span>
	                    <i class="fa fa-eye" aria-hidden="true"></i>
	                    <?php echo number_format($view['wr_hit']) ?>
	                </li>
	                <?php if($view['wr_comment']) { ?>
	                <li class="pr-3">
	                    <span class="sr-only">댓글</span>
	                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
	                    <b class="orangered"><?php echo number_format($view['wr_comment']) ?></b>
	                </li>
	                <?php } ?>
	                <li class="pr-3">
	                    <span class="sr-only">조회</span>

	                    <a type="button"  href="#viewcomment"
	                        class="btn btn-basic" title="댓글바로가기">
	                        <i class="fa fa-arrow-down" aria-hidden="true"></i> 댓글바로가기
	                    </a>
	                </li>
	                <!-- ----------------start new button ------------------ viewcomment -->
	                <?php if ($gr_id=='attendance') { ?>
	                <li class="pr-3">
	                    <a type="button"
	                        onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
	                        class="btn btn-basic" title="후기바로가기" >
	                        <i class="fa fa-list-alt" aria-hidden="true"></i> 후기바로가기
	                    </a>
	                </li>

					<li class="pr-3"><a href="#" type="button"
					onclick="location.href='<?php echo 'tel:'.$phone['mb_hp'] ?>'"
					 class="btn btn-basic"><i class="fa fa-phone" aria-hidden="true"></i>  <?php if(G5_IS_MOBILE) echo " 전화걸기"; else echo $phone['mb_hp']; ?></a>
	                </li>
					<li class="pr-3"><a href="#" type="button"
					onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
					 class="btn btn-basic"><i class="fa fa-pencil" aria-hidden="true"></i> 업소후기작성</a>
	                </li>
	                <?php } ?>
	                <?php if ($gr_id=='review') { ?>
	                <li class="pr-3">
	                    <a type="button"
	                        onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
	                        class="btn btn-basic" title="업소정보" >
	                        <i class="fa fa-list-alt" aria-hidden="true"></i> 업소정보
	                    </a>
	                </li>
	                <?php } ?>
	                <!-- ---------------------------------- -->
	                <li id="bo_v_btn" class="flex-grow-1 text-right">
	                    <!-- 게시물 상단 버튼 시작 { -->
	                    <?php ob_start(); ?>
	                    <div class="btn-group" role="group">
							<?php $now = G5_TIME_YMDHIS;
							$finish_date = date('Y-m-d', strtotime('+3 days', strtotime($member['mb_4']))); 
							if ($update_href) { 
								if(($member['mb_level'] == '26') 
								|| $is_admin 
								|| ($member['mb_level'] != '26' && $member['mb_level'] != '27' && $gr_id !="attendance") 
								|| ($member['mb_level'] == '27' && $gr_id =="attendance")){?>
							<a href="<?php echo $update_href ?>" class="btn-vw py-2" role="button">
								<i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>
								글수정
							</a>
							<?php } } ?>
							<!-- hulan nemsen level 24.25 can not delete post  -->
							<?php if($view['mb_id'] == $member['mb_id'] || $member['mb_level'] == '30' || $member['mb_level'] != '24' && $member['mb_level'] != '25' && (($gr_id=='attendance' && $member['mb_level'] != 26 && $member['mb_level'] != 27) || $gr_id=='community' || $gr_id=='review' || $gr_id=='library')) { 
							if ($delete_href) {  ?>
							<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;"
								class="btn-vw py-2" role="button">
								<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
								글삭제
							</a>
							<?php } ?>
							<!-- <?php if ($copy_href && strpos($bo_table,'_at') === false) { ?>
							<a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw py-2" role="button">
								<i class="fa fa-files-o fa-fw" aria-hidden="true"></i>
								글복사
							</a>
							<?php } ?> -->
							<?php if ($move_href) { ?>
							<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;"
								class="btn-vw py-2" role="button">
								<i class="fa fa-arrows fa-fw" aria-hidden="true"></i>
								글이동
							</a>
							<?php } }?>
							<!-- <?php if ($view['mb_id'] == $member['mb_id']) { ?>
							<a href="<?php echo $search_href ?>" class="btn-vw py-2" role="button">
								<i class="fa fa-search fa-fw" aria-hidden="true"></i>
								검색목록
							</a>
							<?php } ?> -->

	                        <a href="<?php echo $list_href ?>" class="btn-vw py-2" title="목록" role="button">
	                            <i class="fa fa-list fa-md" aria-hidden="true"></i>
	                            목록
	                        </a>
	                        <!-- <?php if ($reply_href) { ?>
	                        <a href="<?php echo $reply_href ?>" class="btn-vw py-2" title="답변" role="button">
	                            <i class="fa fa-reply fa-md" aria-hidden="true"></i>
	                            답변
	                        </a>
	                        <?php } ?> -->
	                        <?php if ($write_href && ($bo_table != "free" && $bo_table != "event" || ($bo_table == "free" && $member['mb_level'] != 26 && $member['mb_level'] != 27) || ($bo_table == "event" && ($member['mb_level'] == 24 || $member['mb_level'] == 25 ||  $is_admin == 'super' )))) { ?>
	                        <a href="<?php echo $write_href ?>" class="btn-vw py-2" title="글쓰기" role="button">
	                            <i class="fa fa-pencil fa-md" aria-hidden="true"></i>
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
	            </ul>
	        </div>
	    </section>
	    <?php } ?>

	    <section id="bo_v_atc">
	        <h3 class="sr-only">본문</h3>
	        <!-- 본문 내용 시작 { -->
	        <div id="bo_v_con" class="mb-4 px-3">
	            <!-- hulan nemsen 블라인드 처리 된 글 관리자에서 보이고 회원 페이지에서 삭제 처럼 안보이게 처리  -->
	            <?php if(IS_NA_BBS && $is_admin && $view['as_type'] == "-1") { // 블라인드처리 ?>
	            <div class="alert alert-danger text-center" role="alert">
	                블라인드 처리된 게시물입니다.
	            </div>
	            <?php } ?>

	            <?php
				// 첨부 동영상 출력 - 이미지출력보다 위에 있어야 함
				if($boset['na_video_attach'])
					echo na_video_attach();

				// 링크 동영상 출력
				if($boset['na_video_link'])
					echo na_video_link($view['link']);

				// 상단 이미지 출력
				if(!isset($view['as_img']) || !$view['as_img']) {
					$v_img_count = count($view['file']);
					if($v_img_count) {
						echo "<div id=\"bo_v_img\">\n";
						for ($i=0; $i<=$v_img_count; $i++) {
							echo get_file_thumbnail($view['file'][$i]);
						}
						echo "</div>\n";
					}
				}
			?>
	            <div class="view-content">
	                <?php echo get_view_thumbnail(na_view($view)); // 글내용 출력 ?>
	            </div>
				<?php  if($gr_id=="attendance") {?>
				<div class="view-content text-center">
	               <img src="<?php echo G5_IMG_URL; ?>/messagebanner.png"/>
	            </div>
				<?php  } ?>
	            <?php 
				// 하단 이미지 출력
				if(isset($view['as_img']) && $view['as_img'] == "1") {
					$v_img_count = count($view['file']);
					if($v_img_count) {
						echo "<div id=\"bo_v_img\">\n";
						for ($i=0; $i<=$v_img_count; $i++) {
							echo get_file_thumbnail($view['file'][$i]);
						}
						echo "</div>\n";
					}
				}
			?>
	        </div>
	        <!-- } 본문 내용 끝 -->
			<div id="bo_v_btn_group" class="clearfix text-center py-4 px-3 en">
	        <?php 
				if($board['bo_use_good'] || $board['bo_use_nogood'] || $scrap_href || $board['bo_use_sns']) { ?>
	       
	            <div class="btn-group btn-group-lg" role="group">
	                <?php if ($member['mb_level'] >= $board['bo_use_good'] && $gr_id!="attendance" && $bo_table!="job" && $bo_table!="greeting" && $bo_table!="notice" && $bo_table!="event") { // 추천 ?>
	                <button type="button"
	                    onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'good', 'wr_good');"
	                    class="btn btn-basic" title="추천"  <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>
	                    <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>>
	                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
	                    <span class="sr-only">추천</span>
	                    <b id="wr_good" class="orangered"><?php echo number_format($view['wr_good']) ?></b>
	                </button>
	                <?php } ?>

	                <!-- <?php if ($member['mb_level'] >= $board['bo_use_nogood']) { // 비추천 ?>
	                <button type="button"
	                    onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'nogood', 'wr_nogood');"
	                    class="btn btn-basic" title="비추천"
	                    <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>>
	                    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
	                    <span class="sr-only">비추천</span>
	                    <b id="wr_nogood"><?php echo number_format($view['wr_nogood']) ?></b>
	                </button>
	                <?php } ?> -->					

	                <?php if ($scrap_href) { // 스크랩 ?>
	                <button type="button" class="btn btn-basic" onclick="win_scrap('<?php echo $scrap_href ?>');"
	                    title="스크랩" <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>>
	                    <i class="fa fa-bookmark" aria-hidden="true"> </i>
	                    <span  <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?> >스크랩</span>
	                </button>
	                <?php } ?>

	                <?php if($board['bo_use_sns']) { // SNS 공유 ?>
	                <button type="button" class="btn btn-basic" data-toggle="modal" data-target="#bo_snsModal"
	                    title="SNS 공유"  <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>>
	                    <i class="fa fa-share-alt" aria-hidden="true"></i>
	                    <span class="sr-only">SNS 공유</span>
	                </button>
	                <?php } ?>
	                <!--  hulan zassan level 24,25is board .group admin, and admin or group admin board admin can blind  -->
	                <?php if (IS_NA_BBS && $boset['na_shingo'] && ($is_admin || in_array($member['mb_id'], explode(",", $board['bo_admin'])) || in_array($member['mb_id'], explode(",", $group['gr_admin'])))) { // 블라인드 ?>
	                <button type="button" class="btn btn-basic"  <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo '';} ?>
	                    onclick="na_shingo('<?php echo $bo_table ?>', '<?php echo $wr_id ?>');" title="블라인드">
	                    <i class="fa fa-ban" aria-hidden="true"></i> 
	                    <span <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?>>블라인드</span>
	                </button>
	                <?php } ?>
	            </div>				
	        <?php } ?>
			<?php if(G5_IS_MOBILE &&  $gr_id == "attendance") :?>
				<div class="clearfix f-sm text-muted pr-2 mt-3">
				<!-- start    mobile   -->
					<ul class="d-flex-start align-items-center" style="display: flex;flex-direction: row; flex-wrap: wrap">
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="<?php echo 'tel:'.$phone['mb_hp'] ?>"
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
								class="btn">
								전화하기
							</a>
						</li>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="<?php echo 'sms:'.$phone['mb_hp'] ?>" 
								style="display: inline; color:#ffffff;font-size: 12px; padding:5px; background-color: #595959;"
								class="btn">
								문자하기
							</a>
						</li>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#viewcomment"	
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
								class="btn">
								댓글가기
							</a>
						</li>
						<?php if ($gr_id=='attendance') { ?>
							<li style="display: inline; margin-right:1px;" class="mb-1">
								<a href="#" 
									onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
									style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
									class="btn">
									후기가기
								</a>
							</li>
							<li style="display: inline; margin-right:1px;" class="mb-1">
								<a href="#"
									onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
									style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
									class="btn"> 
									후기작성
								</a>
							</li>
						<?php } ?>
						<?php if ($gr_id=='review') { ?>
							<li style="display: inline; margin-right:1px;" class="mb-1">
								<a href="#"
									onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
									class="btn" 
									title="업소정보" 
									style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;">
										업소정보
								</a>
							</li>
						<?php } ?>
					</ul>
				 <!-- end   / -->
				</div>
			<?php elseif(G5_IS_MOBILE && $gr_id != "attendance"): ?>
				<div class="clearfix f-sm text-muted pr-2 mt-3">
					<ul class="d-flex-start align-items-start" style="display: flex;flex-direction: row; flex-wrap: wrap">
						<!-- <li style="display: inline;"><a href="#viewcomment"		
									style="border:1px solid #e5e5e5; font-size: 10px;" class="btn"><i class="fa fa-arrow-down" aria-hidden="true"></i> 댓글바로가기</a>
						</li> -->
						<?php if ($bo_table !='free') { ?>
						<li style="display: inline; margin-right:1px;" class="mb-1">
							<a href="#viewcomment"	
								style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;" 
								class="btn">
								<i class="fa fa-arrow-down" aria-hidden="true"></i>
								댓글가기
							</a>
						</li>
						<?php } ?>
						<?php if ($gr_id=='review') { ?>
						<!-- <li style="display: inline;">
							<a href="#"						
							onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
							style="border:1px solid #e5e5e5; font-size: 10px;" class="btn"><i class="fa fa-list-alt" aria-hidden="true"></i> 업소정보</a>
						</li> -->
						<li style="display: inline; margin-right:1px;" class="mb-1">
								<a href="#"
									onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $at;?>&wr_id=<?php echo $atwr_id['wr_id'];?>'"
									class="btn" 
									title="업소정보" 
									style="display: inline; color:#ffffff; font-size: 12px; padding:5px; background-color: #595959;">
									<i class="fa fa-list-alt" aria-hidden="true"></i>
									업소정보
								</a>
							</li>
						<?php } ?> 
					</ul>
				</div>
			<?php else: ?>
			<div class="btn-group btn-group-lg" role="group" <?php if(G5_IS_MOBILE) { echo 'style="padding: 0.5rem 0.5rem !important"';} ?>>
				<button type="button" class="btn btn-basic" onclick="location.href='#bo_v'" 
	                    title="본문상단" <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px; padding: 0.5rem 0.5rem !important"';} else { echo '';} ?>>
	                    <i class="fa fa-arrow-up" aria-hidden="true"> </i>
	                    <span <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?>> 본문상단</span>
	                </button>
					<?php if ($gr_id=="attendance") { // 스크랩 ?>
	                
					<button type="button" class="btn btn-basic" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
	                    title="후기바로가기" <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px; padding: 0.5rem 0.5rem !important"';} else { echo '';} ?>>
	                    <i class="fa fa-list-alt" aria-hidden="true"> </i>
	                    <span <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?>>후기바로가기</span>
	                </button>
					<button type="button" class="btn btn-basic"
					onclick="location.href='<?php echo 'tel:'.$phone['mb_hp'] ?>'"
	                    title="연락처 " <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px; padding: 0.5rem 0.5rem !important"';} else { echo '';} ?>>
	                    <i class="fa fa-phone" aria-hidden="true"> </i>
	                    <span <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?>><?php if(G5_IS_MOBILE) echo " 전화걸기"; else echo $phone['mb_hp']; ?> </span>
	                </button>
					<button type="button" class="btn btn-basic" onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=<?php echo $re;?>&nameid=<?php echo $view['mb_id'];?>'"
	                    title="업소후기작성" <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px; padding: 0.5rem 0.5rem !important"';} else { echo '';} ?>>
	                    <i class="fa fa-pencil" aria-hidden="true"> </i>
	                    <span <?php if(G5_IS_MOBILE) { echo 'style="font-size: 10px;"';} else { echo 'style="font-size: 12px;"';} ?>>업소후기작성</span>
	                </button>
	                <?php } ?>
				</div>
			</div>
			<?php endif;?>
	        <?php if($view['as_tag']) { // 태그 ?>
	        <div class="f-de p-3">
	            <span class="sr-only">태그</span>
	            <?php echo na_get_tag($view['as_tag']) ?>
	        </div>
	        <?php } ?>
	    </section>

	    <section id="bo_v_data">
	        <h3 class="sr-only">관련자료</h3>
	        <ul class="na-table d-table w-100 text-muted f-de font-weight-normal">
	            <?php if ($is_signature && $signature) { ?>
	            <!-- 회원서명 시작 { -->
	            <li class="d-table-row border-top border-bottom">
	                <div class="d-none d-sm-table-cell text-center px-3 py-2 nw-6">
	                    서명
	                </div>
	                <div class="d-table-cell px-3 py-2">
	                    <div class="d-flex my-1">
	                        <div class="px-0">
	                            <i class="fa fa-user-o" aria-hidden="true"></i>
	                        </div>
	                        <div class="pl-3 flex-grow-1 text-break-all">
	                            <?php echo $signature ?>
	                        </div>
	                    </div>
	                </div>
	            </li>
	            <!-- } 회원서명 끝 -->
	            <?php } ?>
	            <?php if(isset($view['link'][1]) && $view['link'][1]) { ?>
	            <!-- 관련링크 시작 { -->
	            <li class="d-table-row border-top border-bottom">
	                <div class="d-none d-sm-table-cell text-center px-3 py-2 nw-6">
	                    링크
	                </div>
	                <div class="d-table-cell px-3 py-2">
	                    <?php
				//링크
				$cnt = 0;
				for ($i=1; $i<=count($view['link']); $i++) {
					if ($view['link'][$i]) {
						$cnt++;
					?>
	                    <div class="d-flex my-1">
	                        <div class="px-0">
	                            <i class="fa fa-link" aria-hidden="true"></i>
	                        </div>
	                        <div class="pl-3 flex-grow-1 text-break-all">
	                            <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
	                                <?php echo get_text($view['link'][$i]) ?>
	                                <?php if($view['link_hit'][$i]) { ?>
	                                <span class="count-plus orangered"><?php echo $view['link_hit'][$i] ?></span>
	                                <span class="sr-only">회 연결</span>
	                                <?php } ?>
	                            </a>
	                        </div>
	                    </div>
	                    <?php
					}
				}
				?>
	                </div>
	            </li>
	            <!-- } 관련링크 끝 -->
	    <?php } ?>

	    <?php
		$cnt = 0;
		if ($view['file']['count']) {
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
					$cnt++;
			}
		}
		?>
	            <?php if($cnt) { ?>
	            <!-- 첨부파일 시작 { -->
	            <li class="d-table-row border-top border-bottom">
	                <div class="d-none d-sm-table-cell text-center px-3 py-2 nw-6">
	                    첨부
	                </div>
	                <div class="d-table-cell px-3 py-2">
	                    <?php
				//가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
				?>
	                    <div class="d-flex my-1">
	                        <div class="px-0">
	                            <i class="fa fa-download" aria-hidden="true"></i>
	                        </div>
	                        <div class="pl-3 pr-2 flex-grow-1 text-break-all">
	                            <a href="<?php echo $view['file'][$i]['href'] ?>" class="view_file_download"
	                                title="<?php echo $view['file'][$i]['content'] ?>">
	                                <?php echo $view['file'][$i]['source'] ?>
	                                <span class="sr-only">파일크기</span>
	                                (<?php echo $view['file'][$i]['size'] ?>)
	                                <?php if($view['file'][$i]['download']) { ?>
	                                <span class="count-plus orangered"><?php echo $view['file'][$i]['download'] ?></span>
	                                <span class="sr-only">회 다운로드</span>
	                                <?php } ?>
	                            </a>
	                        </div>
	                        <div class="px-0 text-nowrap">
	                            <span class="sr-only">등록일</span>
	                            <?php echo date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])) ?>
	                        </div>
	                    </div>
	                    <?php
					}
				}
				?>
	                </div>
	            </li>
	            <!-- } 첨부파일 끝 -->
	            <?php } ?>

	            <?php if ($prev_href) { ?>
	            <!-- 이전글 시작 { -->
	            <li class="d-table-row border-top border-bottom">
	                <div class="d-none d-sm-table-cell text-center px-3 py-2 nw-6">
	                    이전
	                </div>
	                <div class="d-table-cell px-3 py-2">
	                    <div class="d-flex my-1">
	                        <div class="px-0">
	                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
	                        </div>
	                        <div class="pl-3 pr-2 flex-grow-1 text-break-all">
	                            <a href="<?php echo $prev_href ?>">
	                                <?php echo $prev_wr_subject;?>
	                            </a>
	                        </div>
	                        <div class="px-0 text-nowrap font-weight-normal">
	                            <span class="sr-only">작성일</span>
	                            <?php echo date("Y.m.d H:i", strtotime($prev_wr_date)) ?>
	                        </div>
	                    </div>
	                </div>
	            </li>
	            <!-- } 이전글 끝 -->
	            <?php } ?>

	            <?php if ($next_href) { ?>
	            <!-- 다음글 시작 { -->
	            <li class="d-table-row border-top border-bottom">
	                <div class="d-none d-sm-table-cell text-center px-3 py-2 nw-6">
	                    다음
	                </div>
	                <div class="d-table-cell px-3 py-2">
	                    <div class="d-flex my-1">
	                        <div class="px-0">
	                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
	                        </div>
	                        <div class="px-3 flex-grow-1 text-break-all">
	                            <a href="<?php echo $next_href ?>">
	                                <?php echo $next_wr_subject;?>
	                            </a>
	                        </div>
	                        <div class="px-0 text-nowrap font-weight-normal">
	                            <span class="sr-only">작성일</span>
	                            <?php echo date("Y.m.d H:i", strtotime($next_wr_date)) ?>
	                        </div>
	                    </div>
	                </div>
	            </li>
	            <!-- } 다음글 끝 -->
	            <?php } ?>
	        </ul>
	    </section>

	    <?php
    // 코멘트 입출력
	$is_ajax_comment = false;
	if(isset($boset['na_crows']) && $boset['na_crows']) {
		// 페이징 댓글
	    include_once(NA_PATH.'/bbs/comment_view.php');
	} else {
		// 일반 댓글
		include_once(G5_BBS_PATH.'/view_comment.php');
	}
	?>

	    <!-- 게시물 하단 버튼 시작 { -->
	    <div class="clearfix pt-2 border-top text-right" style="margin-top:-1px;">
	        <?php echo $link_buttons; // 버튼 출력 ?>
	    </div>
	    <!-- } 게시물 하단 버튼 끝 -->
	</article>
	<!-- } 게시판 읽기 끝 -->

	<script>
<?php if(strpos($bo_table,'_at') !== false){?>
document.oncontextmenu = function (e) {
	return false;
}
document.ondragstart = function (e) {
	return false;
}
document.onselectstart = function (e) {
	return false;
}
$(document).bind('keydown',function(e){
	if ( e.keyCode == 123 /* F12 */) {
		e.preventDefault();
		e.returnValue = false;
	}
});
<?php }?>

function board_move(href) {
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

$(function() {
    <?php if ($board['bo_download_point'] < 0) { ?>
    $("a.view_file_download").click(function() {
        if (!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg =
            "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if (confirm(msg)) {
            var href = $(this).attr("href") + "&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
    <?php } ?>
    $("a.view_image").click(function() {
        window.open(this.href, "large_image",
            "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no"
        );
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_con").viewimageresize();

    // 링크 타켓
    $(".view-content a").each(function() {
        $(this).attr("target", "_blank");
    });
});
	</script>
	<!-- } 게시글 읽기 끝 -->
	<script>
// hulan nemsen bo_2t utga bh ym bol shingo function ashiglana gesen ug
<?php
if ($board['bo_2']) {
    if ( $is_member) {
?>
$(function() {
    $("#board_singo").click(function() {
        if (!confirm('이 게시물을 신고 하시겠습니까?\n\n신고는 취소가 불가합니다.\n\n주의) 허위 신고시 신고자의 서비스 이용이 제한됩니다.')) {
            return false;
        }
        $.ajax({
            'url': g5_bbs_url + '/ajax.singo.php',
            'dataType': 'json',
            'type': 'POST',
            'async': false,
            'data': {
                'bo_table': '<?php echo $bo_table ?>',
                'wr_id': '<?php echo $wr_id ?>'
            },
            'success': function(data) {
                if (data.msg) {
                    alert(data.msg);
                    return false;
                }
            }
        });
    });
});
<?php
  }
}
?>
	</script>
	<?php if($board['bo_use_sns']) { ?>
	<!-- SNS 공유창 시작 { -->
	<div class="modal fade" id="bo_snsModal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <ul class="list-group">
	                <li class="list-group-item bg-primary text-white border-0 rounded-0">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true" class="text-white">&times;</span>
	                    </button>
	                    <h5><i class="fa fa-share-alt" aria-hidden="true"></i> SNS 공유</h5>
	                </li>
	                <li class="list-group-item border-0 rounded-0">
	                    <div id="bo_v_sns_icon" class="m-auto">
	                        <?php echo na_sns_share_icon(get_pretty_url($bo_table, $wr_id), $view_subject, $view['seo_img']); ?>
	                    </div>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>
	<!-- } SNS 공유창 끝 -->
	<?php } ?>