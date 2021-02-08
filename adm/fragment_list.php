<?php
//<- 오류 모두 표시 
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "200400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$list = array ();
$startlimit;
$endlimit;
$k=0;
$sqlAdmin='select bo_subject,bo_table, bo_5,bo_6,bo_7,bo_8 FROM `g5_board`';
//  echo $sqlAdmin;
$result=sql_query($sqlAdmin);
while($row=sql_fetch_array($result)) {
    $list[$k] = $row;
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
            $sql = " update {$g5['board_table']}
            set 
            bo_5 = '{$_POST['bo_5all']}',
            bo_6 = '{$_POST['bo_6all']}',         
            bo_7 = '{$_POST['bo_7all']}',          
            bo_8 = '{$_POST['bo_8all']}'          
            where bo_table = '{$_POST['bo_table'][$i]}'
            "; 
        }
        else{$sql = " update {$g5['board_table']}
        set 
        bo_5 = '{$_POST['bo_5'][$i]}',
        bo_6 = '{$_POST['bo_6'][$i]}',         
        bo_7 = '{$_POST['bo_7'][$i]}',          
        bo_8 = '{$_POST['bo_8'][$i]}'          
        where bo_table = '{$_POST['bo_table'][$i]}'
        "; } 	
	sql_query($sql);
    }
	goto_url($PHP_SELF, false);
}

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:00px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';

$g5['title'] .= '파편조각관리 '.$frm_submit ;
include_once('./admin.head.php');

?>

<div class="local_desc01 local_desc">
    <p>
    게시글/댓글 작성시
		<strong>최소값 - 최대값 </strong>까지 랜덤으로 </br>신비한 파편조각 확률 획득합니다  .
    </p>
</div>

<form name="fmb_lev_conf" id="fmb_lev_conf" method="post" onsubmit=""  enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<?php echo $frm_submit;?>
<div class="tbl_head01 tbl_wrap">
    <table style="width:900px;">
    <caption>table title caption name </caption>
    <thead> 
		<tr>
			<th scope="col">게시판명</th>
			<th scope="col">최소값</th>
			<th scope="col">최대값</th>
            <th scope="col">게시글</th>
			<th scope="col">댓글</th>
		</tr>
    </thead>
    <tbody>		
    <tr>
            <td class="td_category">
            <input type="checkbox" id="checkall" name="checkall" value="all"><label for="checkall" > 전체게시판</label> 
            </td>
			<td>
            <input type='text' name='bo_5all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
			<td>
            <input type='text' name='bo_6all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
            <td>
            <input type='text' name='bo_7all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
			<td>
            <input type='text' name='bo_8all' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
        </td>
        
		</tr>
        <?php for($i=0; $i<count($list); $i++) { ?>
        <tr>
            <td class="td_category">
            <input type='hidden' name='bo_table[<?php echo $i?>]'  value='<?php echo $list[$i]['bo_table']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;">
            <input type='text' name="name"  value='<?php echo $list[$i]['bo_subject']; ?>' class='frm_input'  disabled style="text-align:center;"></td>
			<td>
            <input type='text' name='bo_5[<?php echo $i?>]' value='<?php echo $list[$i]['bo_5']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
			<td>
            <input type='text' name='bo_6[<?php echo $i?>]' value='<?php echo $list[$i]['bo_6']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
            <td>
            <input type='text' name='bo_7[<?php echo $i?>]' value='<?php echo $list[$i]['bo_7']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
			<td>
            <input type='text' name='bo_8[<?php echo $i?>]' value='<?php echo $list[$i]['bo_8']; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center;"></td>
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