<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="d-flex">
				<div id="user_cate_list" class="sly-wrap flex-grow-1">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
						<li>
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
                        <li class="active">
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

<section id="bo_list" class="mb-4"> 
	<div id="point_info" class="font-weight-normal px-3 pb-2 pt-4">
		전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


	<!-- 목록 헤드 -->
	<div class="d-block d-md-none w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>

	<div class="na-table d-none d-md-table w-100 mb-0 text-md-center bg-light">
		<div class="na-table-head border-primary d-md-table-row bg-light">	
			<div class="d-md-table-cell nw-6 px-md-1 text-md-center">일시</div>
			<div class="d-md-table-cell nw-20 pl-2 px-md-1 pr-md-1 text-md-center">내용</div>
			<div class="d-md-table-cell nw-6 pr-md-1 text-md-center">만료일</div>
			<div class="d-md-table-cell nw-6 pr-md-1 text-md-center">지급파운드</div>
			<div class="d-md-table-cell nw-6 pr-md-1 text-md-center">사용파운드</div>
		</div>
	</div>

	<ul class="na-table d-md-table w-100">

		<?php
		$sum_point1 = $sum_point2 = $sum_point3 = 0;

		$result = sql_query(" select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ");
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$point1 = $point2 = 0;
			$point_use_class = '';
			if ($row['po_point'] > 0) {
				$point1 = '+' .number_format($row['po_point']);
				$sum_point1 += $row['po_point'];
			} else {
				$point2 = number_format($row['po_point']);
				$sum_point2 += $row['po_point'];
				$point_use_class = ' bg-light';
			}

			$po_content = $row['po_content'];

			$expr = '';
			if($row['po_expired'] == 1)
				$expr = ' class="orangered"';
		?>
	
		<li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
			<div class="d-none d-md-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1">
				<?php echo $row['po_datetime']; ?>
			</div>
			<div class="float-right float-md-none d-md-table-cell nw-20 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
			<?php if ($row['po_expired'] == 1) { ?>
					<span<?php echo $expr ?>>만료 <?php echo substr(str_replace('-', '', $row['po_expire_date']), 2) ?></span>
					<span class="na-bar"></span>
				<?php } else if($row['po_expire_date'] != '9999-12-31') { ?>
					<span<?php echo $expr ?>><?php echo $row['po_expire_date'] ?></span>
					<span class="na-bar"></span>
				<?php } ?>
				<?php echo $po_content ?>
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 px-md-2 pr-md-1">
				<?php echo $point1 ?>
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
				<?php echo '<span class="orangered">'.$point2.'</span>'; ?>
			</div>
			<!-- <div class="clearfix d-block d-md-none"></div> -->
		</li>
		<?php
		}
		$sum_point3 = $sum_point1 + $sum_point2;
		if ($i == 0)
			echo '<li class="list-group-item border-left-0 border-right-0 f-de font-weight-normal py-5 text-muted text-center">자료가 없습니다.</li>';
		else {
			if ($sum_point1 > 0)
				$sum_point1 = "+" . number_format($sum_point1);
			$sum_point2 = number_format($sum_point2);
		}
		?>
		<li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom  bg-light">
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
			</div>	
			<div class="float-left float-md-none d-md-table-cell nw-20 nw-md-auto text-center f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<b class="float-left">
				  파운드 소계
				</b>
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto f-sm font-weight-normal py-md-2 pr-md-1">
			</div>			
			<strong class="float-right en">
				<?php if($sum_point1) { ?>
					<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
						<?php echo $sum_point1 ?>
					</div>
				<?php } ?>
				<?php if($sum_point2) { ?>
					<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
						<?php echo $sum_point2 ?>
					</div>
				<?php } ?>
			</strong>		
		</li>
		<li class="d-md-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom  bg-light">
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-20 nw-md-auto text-center f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
				<b class="float-left">
					보유포인트
				</b>
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
			</div>
			<div class="float-left float-md-none d-md-table-cell nw-6 nw-md-auto text-md-right f-sm font-weight-normal py-md-2 pr-md-1">
				<?php echo $sum_point3 ?>
			</div>
		</li>
	</ul>
	<div class="font-weight-normal px-3 mt-4">
		<ul class="pagination justify-content-center en mb-0">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
		</ul>
	</div>
</section>  