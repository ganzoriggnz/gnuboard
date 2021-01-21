<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once('./_common.php');

$g5['title'] = '현재접속자';

$list = array();

$sql = " select a.mb_id, b.mb_nick, b.mb_name, b.mb_email, b.mb_homepage, b.mb_open, b.mb_point, a.lo_ip, a.lo_location, a.lo_url
            from {$g5['login_table']} a left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
            where a.mb_id <> '{$config['cf_admin']}'
            order by a.lo_datetime desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
			$row['lo_url'] = get_text($row['lo_url']);
			$list[$i] = $row;
			if ($row['mb_id']) {
				$list[$i]['name'] = get_sideview($row['mb_id'], cut_str($row['mb_nick'], $config['cf_cut_name']), $row['mb_email'], $row['mb_homepage']);
			} else {
				if ($is_admin)
					$list[$i]['name'] = $row['lo_ip'];
				else
					$list[$i]['name'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['lo_ip']);
			}

		$list[$i]['num'] = sprintf('%03d',$i+1);

		$wset = na_skin_config('connect');

		$head_color = ($wset['head_color']) ? $wset['head_color'] : 'primary';
		if($wset['head_skin']) {
			add_stylesheet('<link rel="stylesheet" href="'.NA_URL.'/skin/head/'.$wset['head_skin'].'.css">', 0);
			$head_class = 'list-head';
		} else {
			$head_class = 'na-table-head border-'.$head_color;
		}
	}

?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="mb-4">

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5><?php echo $g5['title'] ?></h5>
		</div>
	</div>

	<div id="topHeight"></div>

	<nav id="memo_cate" class="sly-tab font-weight-normal mt-3 mb-2">
		<div id="noti_cate_list" class="sly-wrap px-3">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
				<li class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
				<li class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
				<li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li>
			</ul>
		</div>
		<hr/>
	</nav>

	<div id="memo_info" class="f-de font-weight-normal mb-2 px-3">
		전체 <?php echo $kind_title ?>쪽지 <b><?php echo $total_count ?></b>통 / <?php echo $page ?>페이지
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


<!-- sa fasdf a   list online current  -->

	<section id="connect_list" class="mb-4">

		<h2 class="sr-only">현재 접속자 목록</h2>

			<div class="na-table d-table w-100 mb-0">
				<div class="<?php echo $head_class ?> d-table-row">
					<div class="d-table-cell nw-6">번호</div>
					<div class="d-table-cell text-left text-sm-center">
						<?php if($is_admin == 'super' ||IS_DEMO) { ?>
							<?php if(is_file($connect_skin_path.'/setup.skin.php')) { ?>
								<a class="btn_b01 btn-setup float-right mr-3" href="<?php echo na_setup_href('connect') ?>" title="스킨 설정">
									<i class="fa fa-cogs fa-md" aria-hidden="true"></i>
									<span class="sr-only">스킨 설정</span>
								</a>
							<?php } ?>
						<?php } ?>
						접속자 위치
					</div>
				</div>
			</div>

		<ul class="na-table d-table w-100">
				<?php
				for ($i=0; $i < count($list); $i++) {
					//$location = conv_content($list[$i]['lo_location'], 0);
					$location = $list[$i]['lo_location'];
					// 최고관리자에게만 허용
					// 이 조건문은 가능한 변경하지 마십시오.
					if ($list[$i]['lo_url'] && $is_admin == 'super') 
						$display_location = "<a href=\"".$list[$i]['lo_url']."\">".$location."</a>";
					else 
						$display_location = $location;
				?>
					<li class="d-table-row border-bottom">
						<div class="d-table-cell text-center nw-6 py-2 py-md-2 f-sm">
							<span class="sr-only">번호</span>
							<?php echo $list[$i]['num'] ?>
						</div>
						<div class="d-table-cell py-2 py-md-2 pr-3">
							<div class="float-sm-left nw-10 nw-auto f-sm">
								<span class="sr-only">접속자</span>
								<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
							</div>

							<div class="na-title">
								<div class="na-item">
									<div class="na-subject">
										<?php echo $display_location ?>
									</div>
								</div>
							</div>

						</div>
					</li>
				<?php } ?>		
		</ul>
	</section>

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
</script>