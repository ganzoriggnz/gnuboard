<?php
//<- 오류 모두 표시 
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "200150";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
	alert('등급수정은 최고관리자만 가능합니다.');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['lev_point_config_table']}",false)) { // 회원 등급별 point 추가지급 설정 테이블이 없다면 생성
	$sql_table = "CREATE TABLE {$g5['lev_point_config_table']} (   
		levc_no int(11) NOT NULL DEFAULT '0',
		levc_write_min int(11) NOT NULL DEFAULT '0',
		levc_write_max int(11) NOT NULL DEFAULT '0',
		levc_comment_min int(11) NOT NULL DEFAULT '0',
		levc_comment_max int(11) NOT NULL DEFAULT '0'
	)";
	sql_query($sql_table, false);
	
	for($i=1; $i<=30; $i++){
		$sql = " insert into {$g5['lev_point_config_table']} set levc_no = '{$i}' ";
		sql_query($sql);
	}
}

$result = sql_query(" select * from {$g5['lev_point_config_table']}");

$levc_point = array();
for ($i=1; $row=sql_fetch_array($result); $i++) {
	$levc_point[$i] = $row;
}

if (!isset($config['lev_cf_1'])) {
    sql_query(" ALTER TABLE `{$g5['config_table']}`
                    ADD `lev_cf_1` VARCHAR(255) NOT NULL DEFAULT '비회원' AFTER `cf_30`,
                    ADD `lev_cf_2` VARCHAR(255) NOT NULL AFTER `lev_cf_1`,
                    ADD `lev_cf_3` VARCHAR(255) NOT NULL AFTER `lev_cf_2`,
                    ADD `lev_cf_4` VARCHAR(255) NOT NULL AFTER `lev_cf_3`,
                    ADD `lev_cf_5` VARCHAR(255) NOT NULL AFTER `lev_cf_4`,
                    ADD `lev_cf_6` VARCHAR(255) NOT NULL AFTER `lev_cf_5`,
                    ADD `lev_cf_7` VARCHAR(255) NOT NULL AFTER `lev_cf_6`,
                    ADD `lev_cf_8` VARCHAR(255) NOT NULL AFTER `lev_cf_7`,
                    ADD `lev_cf_9` VARCHAR(255) NOT NULL AFTER `lev_cf_8`,
                    ADD `lev_cf_10` VARCHAR(255) NOT NULL AFTER `lev_cf_9`,
                    ADD `lev_cf_11` VARCHAR(255) NOT NULL AFTER `lev_cf_10`,
                    ADD `lev_cf_12` VARCHAR(255) NOT NULL AFTER `lev_cf_11`,
                    ADD `lev_cf_13` VARCHAR(255) NOT NULL AFTER `lev_cf_12`,
                    ADD `lev_cf_14` VARCHAR(255) NOT NULL AFTER `lev_cf_13`,
                    ADD `lev_cf_15` VARCHAR(255) NOT NULL AFTER `lev_cf_14`,
                    ADD `lev_cf_16` VARCHAR(255) NOT NULL AFTER `lev_cf_15`,
                    ADD `lev_cf_17` VARCHAR(255) NOT NULL AFTER `lev_cf_16`,
                    ADD `lev_cf_18` VARCHAR(255) NOT NULL AFTER `lev_cf_17`,
                    ADD `lev_cf_19` VARCHAR(255) NOT NULL AFTER `lev_cf_18`,
                    ADD `lev_cf_20` VARCHAR(255) NOT NULL AFTER `lev_cf_19`,
                    ADD `lev_cf_21` VARCHAR(255) NOT NULL AFTER `lev_cf_20`,
                    ADD `lev_cf_22` VARCHAR(255) NOT NULL AFTER `lev_cf_21`,
                    ADD `lev_cf_23` VARCHAR(255) NOT NULL AFTER `lev_cf_22`,
                    ADD `lev_cf_24` VARCHAR(255) NOT NULL AFTER `lev_cf_23`,
                    ADD `lev_cf_25` VARCHAR(255) NOT NULL AFTER `lev_cf_24`,
                    ADD `lev_cf_26` VARCHAR(255) NOT NULL AFTER `lev_cf_25`,
                    ADD `lev_cf_27` VARCHAR(255) NOT NULL AFTER `lev_cf_26`,
                    ADD `lev_cf_28` VARCHAR(255) NOT NULL AFTER `lev_cf_27`,
                    ADD `lev_cf_29` VARCHAR(255) NOT NULL AFTER `lev_cf_28`,
                    ADD `lev_cf_30` VARCHAR(255) NOT NULL DEFAULT '최고관리자' AFTER `lev_cf_29` ", true);
}

if ($w == '')
{
    //$mb['mb_open'] = 1;
    //$mb['mb_level'] = $config['cf_register_level'];
}
else if ($w == 'u')
{
	check_admin_token();

	$sql = " update {$g5['config_table']}
            set cf_register_level = '{$_POST['cf_register_level']}',
                lev_cf_2 = '{$_POST['lev_cf_2']}',
                lev_cf_3 = '{$_POST['lev_cf_3']}',
                lev_cf_4 = '{$_POST['lev_cf_4']}',
                lev_cf_5 = '{$_POST['lev_cf_5']}',
                lev_cf_6 = '{$_POST['lev_cf_6']}',
                lev_cf_7 = '{$_POST['lev_cf_7']}',
                lev_cf_8 = '{$_POST['lev_cf_8']}',
                lev_cf_9 = '{$_POST['lev_cf_9']}',
                lev_cf_10 = '{$_POST['lev_cf_10']}',
                lev_cf_11 = '{$_POST['lev_cf_11']}',
                lev_cf_12 = '{$_POST['lev_cf_12']}',
                lev_cf_13 = '{$_POST['lev_cf_13']}',
                lev_cf_14 = '{$_POST['lev_cf_14']}',
                lev_cf_15 = '{$_POST['lev_cf_15']}',
                lev_cf_16 = '{$_POST['lev_cf_16']}',
                lev_cf_17 = '{$_POST['lev_cf_17']}',
                lev_cf_18 = '{$_POST['lev_cf_18']}',
                lev_cf_19 = '{$_POST['lev_cf_19']}',
                lev_cf_20 = '{$_POST['lev_cf_20']}',
                lev_cf_21 = '{$_POST['lev_cf_21']}',
                lev_cf_22 = '{$_POST['lev_cf_22']}',
                lev_cf_23 = '{$_POST['lev_cf_23']}',
                lev_cf_24 = '{$_POST['lev_cf_24']}',
                lev_cf_25 = '{$_POST['lev_cf_25']}',
                lev_cf_26 = '{$_POST['lev_cf_26']}',
                lev_cf_27 = '{$_POST['lev_cf_27']}',
                lev_cf_28 = '{$_POST['lev_cf_28']}',
                lev_cf_29 = '{$_POST['lev_cf_29']}' ";
	sql_query($sql);

	for($i=1; $i<=30; $i++){
		$sql = " update {$g5['lev_point_config_table']} set 
			levc_write_min = '".$_POST['levc_write_min_'.$i]."',
			levc_write_max = '".$_POST['levc_write_max_'.$i]."',
			levc_comment_min = '".$_POST['levc_comment_min_'.$i]."',
			levc_comment_max = '".$_POST['levc_comment_max_'.$i]."'
			where levc_no = '{$i}'";
		sql_query($sql);
	}
	goto_url($PHP_SELF, false);
}

$g5['title'] .= '회원등급설정 ';
include_once('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:800px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="'.G5_URL.'/">메인으로</a>
</div>';

$colspan = 2;
?>
<style>
.td_numsmall{ width : 60px;}
.frm_input.point{ width : 40% !important;}
</style>
<div class="local_desc01 local_desc">
    <p>
        회원권한을 한글로 표기하여 관리 할수있는 페이지입니다.
		<br><strong>그누보드5 , 영카드5</strong> 에서 사용 가능합니다.
    </p>
</div>

<form name="fmb_lev_conf" id="fmb_lev_conf" method="post" onsubmit="return fmb_lev_conf_submit(this);"  enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<input type="hidden" name="token" value="" id="token">

<div class="tbl_head01 tbl_wrap">
    <table style="width:800px;">
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
		<tr>
			<th scope="col">회원등급</th>
			<th scope="col">등급</th>
			<th scope="col" width="120px;">쓰기P (최소~최대)</th>
			<th scope="col" width="120px;">댓글P (최소~최대)</th>
		</tr>
    </thead>
    <tbody>
		<?php for ($i=1; $i<=30; $i++) { ?>
		<tr>
			<td class="td_category"><?=$i?></td>
			<td>
			<?php
				if($i==30 || $i==1)	echo $config["lev_cf_".$i];
				else{
					echo "<input type='text' name='lev_cf_{$i}' value='".$config["lev_cf_".$i]."' class='frm_input'>";
				}
			?>
			</td>
			<?php if($i==30 || $i==1){?>
			<td>-</td>
			<td>-</td>
			<?php } else {?>
			<td>
				<input type='text' name='levc_write_min_<?=$i;?>' value='<?=$levc_point[$i]['levc_write_min'];?>' class='frm_input point' autocomplete="off"> ~ <input type='text' name='levc_write_max_<?=$i;?>' value='<?=$levc_point[$i]['levc_write_max'];?>' class='frm_input point' autocomplete="off">
			</td>
			<td>
				<input type='text' name='levc_comment_min_<?=$i;?>' value='<?=$levc_point[$i]['levc_comment_min'];?>' class='frm_input point' autocomplete="off"> ~ <input type='text' name='levc_comment_max_<?=$i;?>' value='<?=$levc_point[$i]['levc_comment_max'];?>' class='frm_input point' autocomplete="off">
			</td>
			<?php }?>
		</tr>
		<?php } ?>
		<tr>
            <td class="td_category"><label for="cf_register_level">회원가입시 권한</label></td>
            <td><?php echo get_member_level_select('cf_register_level', 1, 29, $config['cf_register_level']) ?></td>
			<td colspan="4">&nbsp;</td>
        </tr>
    </tbody>
    </table>
</div>

<?php echo $frm_submit;?>

</form>
<script>
function fmb_lev_conf_submit(){
	if (confirm("등급설정 변경은 개발자에게 문의후 하시는게 좋습니다\n\n등급을 수정하시겠습니까?")){
		return true;
	}
	else{return false;}
}
</script>
<?php
include_once('./admin.tail.php');
?>