<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

@include_once(G5_THEME_PATH.'/common.php');


$mb_id='';
$point='';
$wer=2;
$penychangelimit = get_penylimit();

if ($w == '') {}
else if ($w == 'u')
{	
	if($_POST['niittoo']<$penychangelimit || $_POST['niittoo']>$member['mb_point2']){
		alert("보유 파편조각 10만 파편조각 이상 있어야 전환이 가능합니다. 현재 보유 파편조각 ".number_format($member['mb_point2'])." 입니다. ");
	}
	else {
		$mb_id=$member['mb_id'];
		$point=$_POST['niittoo'];
		insert_use_fragment($mb_id, $point,$member['mb_peny'],$wer);

		alert(number_format($point)." 파편조각 ".number_format($point)." 페니로 전환되었습니다.");

		goto_url($PHP_SELF, false);
	}	
}


$frm_submit = '<div class="col-sm-4">
<input type="submit" value="전환" class="btn_submit" accesskey="s" action="" onSubmit=""  style="height: 30px; width: 50px;" > 
<label class="col-form-label" for="reg_mb_nick">페니 : '.number_format($member['mb_peny']).'</label>
</div>';
?>
<style>
.d-flex {
    font-size: 12px;
}

#user_cate_ul li a {
    padding: 2px 5px 2px 5px;
}
</style>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
        <?php
    $point2 = "actived";
    include 'infotab.php';?>
    </nav>

    <section id="bo_list" class="mb-4">
        <form name="fwrite" id="fwrite" onsubmit="return fwrite_submit(this);" method="post"
            enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
            <input type="hidden" name="w" value="u">
            <?php 
if ($member['mb_level']>=12 && $member['mb_level']<=22)
{
	echo '<div id="" class="font-weight-normal px-3 pt-3 ">
	<div class="form-group row">
							<label class="col-form-label" for="reg_mb_nick">1 파편조각 100 페니 (1:100)</label>
							<div class="col-sm-4">
								<input type="hidden" name="mb_nick_default" value="">
								<input type="number" min="'.$penychangelimit.'" name="niittoo" value="" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="text-align:center;" placeholder="10만 파편조각 이상 전환 가능합니다." id="niittoo" required="" class="form-control nospace required" maxlength="20">
							</div>
							'.$frm_submit.'
			</div>
		</div>';}
		else {
			echo '<div id="" class="font-weight-normal px-3 pt-3 ">
			<div class="form-group row">
									<label class="col-form-label" for="reg_mb_nick">1 파편조각 100 페니 (1:100)</label>
									<div class="col-sm-4">
										<input type="hidden" name="mb_nick_default" value="">
										<input type="number" min="'.$penychangelimit.'" disabled="disabled" name="niittoo" value="레벨 남작이상 파편조각페니로 전환이 가능합니다." onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="text-align:center;" placeholder="레벨 남작이상 파편조각페니로 전환이 가능합니다." id="niittoo" required="" class="form-control nospace required" maxlength="20">
									</div>								
					</div>
				</div>';
		}
	?>
            <div id="point_info" class="font-weight-normal px-3 pb-2">
                전체 <?php echo number_format($total_count) ?>건 / <?php echo $page ?>페이지
            </div>

            <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


            <!-- 목록 헤드 -->
            <div class="d-block d-md-none w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>
            <table cellspacing="0" class="w-100 px-3 mr-3" cellpadding="0" width="100%"
                style="border:1px solid #d3d3d3;font-size: 12px; padding:5px;" id="level-up">
                <thead class="bg-light">
                    <tr style="border:1px solid #d3d3d3;font-size: 12px; text-align: center; ">
                        <th class="cl_tr">일시</th>
                        <th class="cl_tr">내용</th>
                        <th class="cl_tl">지급파편조각</th>
                        <th class="cl_tr">사용파편조각</th>
                    </tr>
                </thead>
                <tbody>
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
                    <tr style="border:1px solid #d3d3d3; font-size: 10px">
                        <td class="cl_td"><?php echo $row['po_datetime']; ?></td>
                        <td class="cl_td" style="text-align: left;"><?php echo substr($po_content,0,45)  ?></td>
                        <td class="cl_td_r" style="text-align: right;"><?php echo $point1 ?> &nbsp; </td>
                        <td class="cl_td_r" style="text-align: right;">
                            <?php echo '<span class="orangered">'.$point2.'</span>'; ?> &nbsp; &nbsp; </td>
                    </tr>
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

                    <tr class="bg-light" style="border:1px solid #d3d3d3; font-size: 10px">
                        <td class="cl_td"></td>
                        <td class="cl_td" style="text-align: left;">파편조각 소계</td>
                        <td class="cl_td_l" style="text-align: right;"><?php echo $sum_point1 ?></td>
                        <td class="cl_td_r" style="text-align: right;"><?php echo $sum_point2 ?> &nbsp; &nbsp; </td>
                    </tr>
                    <tr class="bg-light" style="border:1px solid #d3d3d3; font-size: 10px">
                        <td class="cl_td"></td>
                        <td class="cl_td" style="text-align: left;">보유파편조각</td>
                        <td class="cl_td_l"></td>
                        <td class="cl_td_r" style="text-align: right;"><?php echo $sum_point3 ?> &nbsp; &nbsp; </td>
                    </tr>
                </tbody>
            </table>


            <div class="font-weight-normal px-3 mt-4">
                <ul class="pagination justify-content-center en mb-0">
                    <?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
                </ul>
            </div>
        </form>
    </section>
</div>