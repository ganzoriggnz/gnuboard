<?php
$sub_menu = "200610";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['board_lev_point_table']}",false)) { // 게시판 회원 등급별 point 추가지급 설정 테이블이 없다면 생성
	$sql_table = "CREATE TABLE {$g5['board_lev_point_table']} (   
		bo_table varchar(20) NOT NULL,
		level int(11) NOT NULL DEFAULT '0',
		point_min int(11) NOT NULL DEFAULT '0',
		point_max int(11) NOT NULL DEFAULT '0',
		percent int(11) NOT NULL DEFAULT '0',
		PRIMARY KEY (`bo_table`,`level`)
	)";
	sql_query($sql_table, false);
}

$level = $_GET['level'] ? $_GET['level'] : 2; //기본 등급은 2
$list = array ();
$startlimit;
$endlimit;
$k=0;
$sqlAdmin=" select bo_subject,bo_table, bo_5,bo_6,bo_7,bo_8 FROM `g5_board` where (bo_table like '%\_re%' or bo_table like '%\_at%')
or bo_table='notice'
or bo_table='greeting'
or bo_table='free'
or bo_table='woman'
or bo_table='event'
or bo_table='suggestions'
or bo_table='movie'
or bo_table='tv'
or bo_table='ucc'
or bo_table='request'
order by gr_id, bo_table asc";
//  echo $sqlAdmin;
$result=sql_query($sqlAdmin);

while($row=sql_fetch_array($result)) {

    $list[$k] = $row;
	$list[$k]['level_point'] = array();


	for($i=1; $i<=30; $i++){
		$row2 = sql_fetch("select point_min, point_max, percent from {$g5['board_lev_point_table']} where bo_table='".$row['bo_table']."' and level='{$i}' ");
		if( ! $row2){
			sql_query(" insert into {$g5['board_lev_point_table']} set bo_table='".$row['bo_table']."', level='{$i}' ");
			$list[$k]['level_point'][$i]['point_min'] = 0;
			$list[$k]['level_point'][$i]['point_max'] = 0;
			$list[$k]['level_point'][$i]['percent'] = 0;
		} else {
			$list[$k]['level_point'][$i] = $row2;
		}
	}

    $k++;
}

if ($w == '')
{
    //$mb['mb_open'] = 1;
    //$mb['mb_level'] = $config['cf_register_level'];   
     
}
else if ($w == 'u')
{
    for($i=0; $i<count($list); $i++) {
        if ($_POST['checkall'] == 'all'){
            $sql = " update {$g5['board_lev_point_table']} set 
            point_min = '{$_POST['point_min_all']}',         
            point_max = '{$_POST['point_max_all']}',          
            percent = '{$_POST['percent_all']}'
			where level = '{$level}' ";
			sql_query($sql);
			break;
        } else {
			$sql = " update {$g5['board_lev_point_table']} set 
			point_min = '{$_POST['point_min'][$i]}',         
			point_max = '{$_POST['point_max'][$i]}',          
			percent = '{$_POST['percent'][$i]}'
			where bo_table = '{$_POST['bo_table'][$i]}'
			and level = '{$level}' "; 
			sql_query($sql);
		}
    }
	goto_url($PHP_SELF, false);
}

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="display:inline;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';

$g5['title'] .= '럭키포인트설정 '.$frm_submit ;
include_once('./admin.head.php');

?>

<div class="local_desc01 local_desc">
    <p>
    게시글/댓글 작성시 <strong>회원등급</strong> 별로
		<strong>최소값 - 최대값 </strong>까지 랜덤으로 </br><strong>럭키 포인트</strong>를 획득합니다.
    </p>
</div>

<form name="fmb_lev_conf" id="fmb_lev_conf" method="post" onsubmit=""  enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<div style="margin-bottom:10px;">
	<select name="sfl" onchange="location.href='/adm/lucky_point.php?level='+this.value" style="width:150px;height:30px;">
		<?php for($i=1; $i<=30; $i++){?>
		<option value="<?=$i;?>" <?php echo ($_GET['level']==$i || ( ! $_GET['level'] && $i==2) ) ? 'selected' : '';?>><?=$i;?>등급</option>
		<?php }?>
	</select>
	<?php echo $frm_submit;?>
</div>
<div class="tbl_head01 tbl_wrap">
    <table style="width:900px;">
    <thead> 
		<tr>
			<th scope="col" width="250">게시판명</th>
			<th scope="col">최소값</th>
			<th scope="col">최대값</th>
            <th scope="col">확률 (%)</th>
		</tr>
    </thead>
    <tbody>		
    <tr>
		<td class="td_category">
			<input type="checkbox" id="checkall" name="checkall" value="all"><label for="checkall" > 전체게시판</label> 
		</td>
		<td>
			<input type='text' name='point_min_all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
		</td>
		<td>
			<input type='text' name='point_max_all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
		</td>
		<td>
			<input type='text' name='percent_all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
		</td>
		</tr>
        <?php for($i=0; $i<count($list); $i++) { ?>
        <tr>
			<td class="td_category">
				<input type='hidden' name='bo_table[<?php echo $i?>]'  value='<?php echo $list[$i]['bo_table']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
				<?php
				$bo_subject = trim($list[$i]['bo_subject']);
				if(strpos($list[$i]['bo_table'],'_at') !== false) $bo_subject .= ' 정보';
				if(strpos($list[$i]['bo_table'],'_re') !== false) $bo_subject .= ' 후기';
				?>
				<input type='text' name="name"  value='<?php echo $bo_subject; ?>' class='frm_input'  disabled style="text-align:center;">
			</td>
			<td>
				<input type='text' name='point_min[<?php echo $i?>]' value='<?php echo $list[$i]['level_point'][$level]['point_min']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
			</td>
			<td>
				<input type='text' name='point_max[<?php echo $i?>]' value='<?php echo $list[$i]['level_point'][$level]['point_max']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
			</td>
			<td>
				<input type='text' name='percent[<?php echo $i?>]' value='<?php echo $list[$i]['level_point'][$level]['percent']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
			</td>
		</tr>
        <?php } ?>
    </tbody>
    </table>
</div>
<?php echo $frm_submit;?>
</form>
<?php
include_once('./admin.tail.php');
?>