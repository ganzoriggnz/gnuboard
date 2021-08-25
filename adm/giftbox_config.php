<?php
$sub_menu = "700600";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = '선물상자 설정';
include_once(G5_ADMIN_PATH.'/admin.head.php');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['giftbox_config_table']}",false)) { // 선물상자 설정 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['giftbox_config_table']} (   
        point_min_1 int(11) NOT NULL DEFAULT '0',
        point_max_1 int(11) NOT NULL DEFAULT '0',
		point_percent_1 int(11) NOT NULL DEFAULT '0',
        point_min_2 int(11) NOT NULL DEFAULT '0',
        point_max_2 int(11) NOT NULL DEFAULT '0',
		point_percent_2 int(11) NOT NULL DEFAULT '0',
        point_min_3 int(11) NOT NULL DEFAULT '0',
        point_max_3 int(11) NOT NULL DEFAULT '0',
		point_percent_3 int(11) NOT NULL DEFAULT '0',
        point_min_4 int(11) NOT NULL DEFAULT '0',
        point_max_4 int(11) NOT NULL DEFAULT '0',
		point_percent_4 int(11) NOT NULL DEFAULT '0',
        point_min_5 int(11) NOT NULL DEFAULT '0',
        point_max_5 int(11) NOT NULL DEFAULT '0',
		point_percent_5 int(11) NOT NULL DEFAULT '0',
        sale_limit int(11) NOT NULL DEFAULT '0',
        sale_percent int(11) NOT NULL DEFAULT '0',
        free_limit int(11) NOT NULL DEFAULT '0',
        free_percent int(11) NOT NULL DEFAULT '0'
    )";
   sql_query($sql_table, false);
}

$result = sql_fetch(" select * from {$g5['giftbox_config_table']} limit 1");

if( ! $result){
	sql_query(" insert into {$g5['giftbox_config_table']} set point_min_1='0' ");
	$result = sql_fetch(" select * from {$g5['giftbox_config_table']} limit 1");
}

if (!isset($result['sorry_point'])) {
    sql_query(" ALTER TABLE `{$g5['giftbox_config_table']}` ADD `sorry_point` int(11) NOT NULL DEFAULT '0' AFTER `free_percent` ", true);
}

?>
<style>
.frm_input{ width: 80px; height:30px;padding-left:5px;}
.mb-1{margin-bottom:10px;}
.ml-1{margin-left:10px;}
</style>
<div class="local_desc01 local_desc">
    <p>
        출석체크시 선물상자에서 랜덤포인트 및 쿠폰을 지급합니다.
    </p>
</div>

<form name="fconfig" method="post" action="./giftbox_config_update.php">
	<div class="tbl_frm01 tbl_wrap">
		<table>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
			<tr>
				<th scope="row">랜덤포인트</th>
				<td>
					<div class="mb-1">
						<span>1.</span><input type="number" name="point_min_1" class="frm_input ml-1" value="<?=$result['point_min_1'];?>" placeholder="최소"> ~ <input type="number" name="point_max_1" class="frm_input" value="<?=$result['point_max_1'];?>" placeholder="최대">
						<input type="number" name="point_percent_1" class="frm_input ml-1" value="<?=$result['point_percent_1'];?>" placeholder="확률"> %
					</div>
					<div class="mb-1">
						<span>2.</span><input type="number" name="point_min_2" class="frm_input ml-1" value="<?=$result['point_min_2'];?>" placeholder="최소"> ~ <input type="number" name="point_max_2" class="frm_input" value="<?=$result['point_max_2'];?>" placeholder="최대">
						<input type="number" name="point_percent_2" class="frm_input ml-1" value="<?=$result['point_percent_2'];?>" placeholder="확률"> %
					</div>
					<div class="mb-1">
						<span>3.</span><input type="number" name="point_min_3" class="frm_input ml-1" value="<?=$result['point_min_3'];?>" placeholder="최소"> ~ <input type="number" name="point_max_3" class="frm_input" value="<?=$result['point_max_3'];?>" placeholder="최대">
						<input type="number" name="point_percent_3" class="frm_input ml-1" value="<?=$result['point_percent_3'];?>" placeholder="확률"> %
					</div>
					<div class="mb-1">
						<span>4.</span><input type="number" name="point_min_4" class="frm_input ml-1" value="<?=$result['point_min_4'];?>" placeholder="최소"> ~ <input type="number" name="point_max_4" class="frm_input" value="<?=$result['point_max_4'];?>" placeholder="최대">
						<input type="number" name="point_percent_4" class="frm_input ml-1" value="<?=$result['point_percent_4'];?>" placeholder="확률"> %
					</div>
					<div class="mb-1">
						<span>5.</span><input type="number" name="point_min_5" class="frm_input ml-1" value="<?=$result['point_min_5'];?>" placeholder="최소"> ~ <input type="number" name="point_max_5" class="frm_input" value="<?=$result['point_max_5'];?>" placeholder="최대">
						<input type="number" name="point_percent_5" class="frm_input ml-1" value="<?=$result['point_percent_5'];?>" placeholder="확률"> %
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row">원가권</th>
				<td>
					<span>매월</span><input type="number" name="sale_limit" class="frm_input ml-1" value="<?=$result['sale_limit'];?>"> 장
					<input type="number" name="sale_percent" class="frm_input ml-1" value="<?=$result['sale_percent'];?>"> %
				</td>
			</tr>
			<tr>
				<th scope="row">무료권</th>
				<td>
					<span>매월</span><input type="number" name="free_limit" class="frm_input ml-1" value="<?=$result['free_limit'];?>" placeholder="수량"> 장
					<input type="number" name="free_percent" class="frm_input ml-1" value="<?=$result['free_percent'];?>" placeholder="확률"> %
				</td>
			</tr>
			<tr>
				<th scope="row">꽝 포인트</th>
				<td>
					<input type="number" name="sorry_point" class="frm_input" value="<?=$result['sorry_point'];?>" placeholder="꽝포인트"> 입력하면 꽝없이 기본 포인트를 지급합니다. 미입력시 꽝이 표시됩니다.
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="btn_fixed_top">
		<input type="submit" value="확인" class="btn_submit btn" accesskey="s">
	</div>
</form>
<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>