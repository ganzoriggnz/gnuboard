<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" style="background:white;" class="mb-4">

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5><?php echo $g5['title'] ?></h5>
		</div>
	</div>

	<div id="topHeight"></div>

	<?php 
	if(G5_IS_MOBILE)
	{ ?>
	<nav id="memo_cate" class="sly-tab font-weight-normal mt-3 mb-2">
		<div id="noti_cate_list" class="sly-wrap px-1">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li style="width:25%" class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
				<li style="width:25%" class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
				<!-- <li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li> -->
			</ul>
		</div>
		<hr/>
	</nav>
		<?php } else {?>
			<nav id="memo_cate" class="sly-tab font-weight-normal mt-3 mb-2">
		<div id="noti_cate_list" class="sly-wrap px-3">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
				<li class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
				<li class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
				<!-- <li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li> -->
			</ul>
		</div>
		<hr/>
	</nav>

		<?php } ?>

	<div id="memo_info" class="f-de font-weight-normal mb-2 px-3">
		전체 <?php echo $kind_title ?>쪽지 <b><?php echo $total_count ?></b>통 / <?php echo $page ?>페이지
		<button type="button" class="btn btn-danger btn-sm pull-right" style="font-size:12px;padding-bottom:0px;margin-top:-3px;" onclick="memo_all_delete();">선택삭제</button>
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>

	<?php if($config['cf_memo_del']){ ?>	
		<div class="na-table border-bottom">
			<div class="f-de px-3 py-2 py-md-2 bg-light">
				<span style="padding-right:10px;"><input type="checkbox" id="check_all"></span>
				쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.
			</div>
		</div>
	<?php } ?>

	<ul class="na-table d-table w-100 f-de">
	<?php
	$list_cnt = count($list);
	for ($i=0; $i < $list_cnt; $i++) {
		$readed = (substr($list[$i]['me_read_datetime'],0,1) == 0) ? '' : 'read';
		$memo_preview = utf8_strcut(strip_tags($list[$i]['me_memo']), 28, '..');
	?>
		<li class="d-table-row border-bottom">
			<div class="d-table-cell text-center nw-3 py-2 py-md-2">
				<input type="checkbox" name="check_id[]" value="<?php echo $list[$i]['me_id'];?>">
			</div>
			<div class="d-table-cell text-center nw-6 py-2 py-md-2">
				<?php echo ($readed) ? '<span class="text-muted">읽음</span>' : '<span class="orangered">읽기 전</span>';?>
			</div>
			<div class="d-table-cell py-2 py-md-2">
				<a href="<?php echo $list[$i]['view_href']; ?>" class="ellipsis">
					<?php echo $memo_preview; ?>
				</a>
				<div class="clearfix f-sm text-black-50">
					<div class="float-left">
						<?php echo $list[$i]['send_datetime']; ?>
					</div>
					<div class="float-right">
					<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
			&nbsp;
				<a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="win-del" title="삭제">
					<i class="fa fa-trash-o text-muted fa-lg" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a>
				&nbsp;
					</div>
					<!-- <div class="float-right">
						<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
					</div> -->
				</div>
			</div>
			<!-- <div class="d-table-cell text-right nw-15 py-2 py-md-2">
			<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
			&nbsp;
				<a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="win-del" title="삭제">
					<i class="fa fa-trash-o text-muted fa-lg" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a>
				&nbsp;
			</div> -->
		</li>
    <?php } ?>
	</ul>
	<?php if ($i == 0) { ?>
		<div class="f-de px-3 py-5 text-center text-muted border-bottom">
			자료가 없습니다.
		</div>
	<?php } ?>

	<div class="font-weight-normal px-3 mt-4">
		<ul class="pagination justify-content-center en mb-0">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./memo.php?kind=$kind".$qstr."&amp;page=") ?>
		</ul>
	</div>

</div>
<script>
$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});

$(document).ready(function(){
	$('#check_all').change(function(){
		var check_state = $(this).prop('checked');
		$('input[name="check_id[]"]').each(function(i){
			$(this).prop('checked',check_state);
		});
	});
});

function memo_all_delete(){
	if($('input[name="check_id[]"]:checked').length < 1){
		alert('삭제할 쪽지를 선택해주세요.');
		return false;
	}

	if(confirm('한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?')){
		var me_ids = $('input[name="check_id[]"]:checked').map(function(){return $(this).val();}).get();
		location.href='./memo_delete_all.php?me_ids='+me_ids+'&token=<?php echo $token;?>&kind=<?php echo $kind;?>';
	}
}
</script>
<!-- } 쪽지 목록 끝 -->