	<?php

use function PHPSTORM_META\map;

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


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


/////////////////////////////////////////////////////////////////////////////
?>

<!-- // hulan nemsen admin bichsen bichvert gichuunii zasah erh olgoh -->

<?php if($is_admin == 'super' && $gr_id == "attendance") { ?>
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
	<?php } ?>		
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
		<h1 id="bo_v_title"<?php if ($view['wr_1']) { echo " style='color:".$view['wr_1']."' "; } ?>>
            <?php echo $view_subject; // 글제목 출력 ?> &nbsp;&nbsp;&nbsp;

			<!-- hulan nemsen 삭제요청 ///////////////////////////////////-->
			<?php
        if ($board['bo_2']) {
            if ( $member['mb_level'] == 26 || $member['mb_level'] == 27) {
                echo '<button id="board_singo" class="btn btn_b03"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i>삭제요청</button>';
			}
			else{
				echo '<button id="board_singo" class="btn btn_b03"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i>신고</button>';
			}
        }
        ?>
		<!-- /////////////////////////////////////////////////////////// -->
        </h1>

    </header>

	<section id="bo_v_info" class="f-sm font-weight-normal mb-4">
		<div class="clearfix bg-light border-top text-muted px-3 py-2">
	        <h3 class="sr-only">작성자 정보</h3>
			<ul class="d-flex align-items-center">
				<li class="pr-2">
					<span class="sr-only">작성자</span>
					<!-- hulan nemsen level mark -->
					<?php echo na_name_photo($view['mb_id'], $view['name']); ?>
					<?php if (G5_IS_MOBILE) {
						$phone=get_member($view['mb_id'],"mb_hp");						
						echo  '<a href="tel:'.$phone['mb_hp'].'" style="border:1px solid #e5e5e5;" class="btn" ><img src="'.G5_IMG_URL.'/solid/phone.svg" style="height:10px; " title=""> 전화걸기</a>
					<a href="sms:'.$phone['mb_hp'].'" style="border:1px solid #e5e5e5;" class="btn" ><img src="'.G5_IMG_URL.'/solid/sms.svg" style="height:14px; " title=""> SMS</a>    ';} ?>
				</li>
				<?php if ($is_ip_view) { ?>
					<li class="pr-2">
						<span class="sr-only">아이피</span>
						<span class="f-xs text-muted"><?php echo $ip ?></span>
					</li>
				<?php } ?>
				<li class="flex-grow-1 text-right">
					<span class="sr-only">작성일</span>
					<time class="f-xs" datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['wr_datetime'])) ?>"><?php echo date("Y.m.d H:i", strtotime($view['wr_datetime'])) ?></time>
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
				
				<li id="bo_v_btn" class="flex-grow-1 text-right">
					<!-- 게시물 상단 버튼 시작 { -->
					<?php ob_start(); ?>
					<div class="btn-group" role="group">
						<a href="<?php echo $list_href ?>" class="btn btn_b01 nofocus py-1" title="목록" role="button">
							<i class="fa fa-list fa-md" aria-hidden="true"></i>
							<span class="sr-only">목록</span>
						</a>
						<?php if ($reply_href) { ?>
							<a href="<?php echo $reply_href ?>" class="btn btn_b01 nofocus py-1" title="답변" role="button">
								<i class="fa fa-reply fa-md" aria-hidden="true"></i>
								<span class="sr-only">답변</span>
							</a>
						<?php } ?>
						<?php if ($write_href) { ?>
							<a href="<?php echo $write_href ?>" class="btn btn_b01 nofocus py-1" title="글쓰기" role="button">
								<i class="fa fa-pencil fa-md" aria-hidden="true"></i>
								<span class="sr-only">글쓰기</span>
							</a>
						<?php } ?>
						<?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
							<button type="button" class="btn btn_b01 nofocus dropdown-toggle dropdown-toggle-split py-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" title="게시물 옵션">
								<span class="sr-only">게시물 옵션</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right p-0 border-0 bg-transparent text-right">
								<div class="btn-group-vertical">
								<?php if ($update_href) { ?>
									<a href="<?php echo $update_href ?>" class="btn btn-primary py-2" role="button">
										<i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>
										글수정
									</a>
								<?php } ?>
								<!-- hulan nemsen level 24.25 can not delete post  -->
								<?php if ($delete_href && $member['mb_level'] != 24 && $member['mb_level'] != 25) { ?>
									<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;" class="btn btn-primary py-2" role="button">
										<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
										글삭제
									</a>
								<?php } ?>
								<?php if ($copy_href) { ?>
									<a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;" class="btn btn-primary py-2" role="button">
										<i class="fa fa-files-o fa-fw" aria-hidden="true"></i>
										글복사		
									</a>
								<?php } ?>
								<?php if ($move_href) { ?>
									<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;" class="btn btn-primary py-2" role="button">
										<i class="fa fa-arrows fa-fw" aria-hidden="true"></i>
										글이동
									</a>
								<?php } ?>
								<?php if ($search_href) { ?>
									<a href="<?php echo $search_href ?>" class="btn btn-primary py-2" role="button">
										<i class="fa fa-search fa-fw" aria-hidden="true"></i>
										글검색
									</a>
								<?php } ?>
								</div> 
							</div>
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
	
		<?php 
		if($board['bo_use_good'] || $board['bo_use_nogood'] || $scrap_href || $board['bo_use_sns']) { ?>
			<div id="bo_v_btn_group" class="clearfix text-center py-4 px-3 en">
				<div class="btn-group btn-group-lg" role="group">
					<?php if ($member['mb_level'] >= $board['bo_use_good']) { // 추천 ?>
						<button type="button" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'good', 'wr_good');" class="btn btn-basic" title="추천">
							<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
							<span class="sr-only">추천</span>
							<b id="wr_good" class="orangered"><?php echo number_format($view['wr_good']) ?></b>
						</button>
					<?php } ?>

					<?php if ($member['mb_level'] >= $board['bo_use_nogood']) { // 비추천 ?>
						<button type="button" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'nogood', 'wr_nogood');" class="btn btn-basic" title="비추천">
							<i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
							<span class="sr-only">비추천</span>
							<b id="wr_nogood"><?php echo number_format($view['wr_nogood']) ?></b>
						</button>
					<?php } ?>
					<?php if ($scrap_href) { // 스크랩 ?>
						<button type="button" class="btn btn-basic" onclick="win_scrap('<?php echo $scrap_href ?>');" title="스크랩">
							<i class="fa fa-bookmark" aria-hidden="true"></i>
							<span class="sr-only">스크랩</span>
						</button>
                    <?php } ?>
                    

					<?php if($board['bo_use_sns']) { // SNS 공유 ?>
						<button type="button" class="btn btn-basic" data-toggle="modal" data-target="#bo_snsModal" title="SNS 공유">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
							<span class="sr-only">SNS 공유</span>
						</button>
					<?php } ?>
					<!--  hulan zassan level 24,25is board .group admin, and admin or group admin board admin can blind  -->
					<?php if (IS_NA_BBS && $boset['na_shingo'] && ($is_admin ||$member['mb_id'] == $board['bo_admin'] || $member['mb_id'] == $group['gr_admin'])) { // 블라인드 ?>
					<button type="button" class="btn btn-basic" onclick="na_shingo('<?php echo $bo_table ?>', '<?php echo $wr_id ?>');" title="블라인드">
							<i class="fa fa-ban" aria-hidden="true"></i>
							<span class="sr-only">블라인드</span>
						</button>
                        <?php } ?>
                        
                        
				</div>
			</div>
		<?php } ?>

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
							<a href="<?php echo $view['file'][$i]['href'] ?>" class="view_file_download" title="<?php echo $view['file'][$i]['content'] ?>">
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
function board_move(href) {
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

$(function() {
	<?php if ($board['bo_download_point'] < 0) { ?>
	$("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
	<?php } ?>
	$("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_con").viewimageresize();

    // 링크 타켓
	$(".view-content a").each(function () {
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
            'url': g5_bbs_url+'/ajax.singo.php',
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