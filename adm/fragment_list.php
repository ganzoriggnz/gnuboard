<?php
//<- 오류 모두 표시 
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "200400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$startlimit;
$endlimit;

$sqlAdmin='select fr_start, fr_end FROM `g5_fragment_admin_limit` ORDER BY fr_id DESC limit 1';
// echo $sqlAdmin;
$result=sql_query($sqlAdmin);
for($i=0; $row=sql_fetch_array($result); $i++) {
   // echo $row['fr_start'];
    $startlimit=$row['fr_start'];
    $endlimit=$row['fr_end'];
   // echo $startlimit;
}

if ($w == '')
{
    //$mb['mb_open'] = 1;
    //$mb['mb_level'] = $config['cf_register_level'];   
     
}
else if ($w == 'u')
{
	$sql = " update {$g5['fragment_table']}
            set fr_start = '{$_POST['fr_start']}',
            fr_end = '{$_POST['fr_end']}'";            	
	sql_query($sql);
	goto_url($PHP_SELF, false);
}

$g5['title'] .= '파편조각관리 ';
include_once('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:00px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';
?>

<div class="local_desc01 local_desc">
    <p>
        Санамсаргүйгээр fragment онооны хязгаар тоо
		<br><strong><?php echo $startlimit; ?> - <?php echo $endlimit; ?></strong> хооронд санамсаргүй оноо өгнө.
    </p>
</div>

<form name="fmb_lev_conf" id="fmb_lev_conf" method="post" onsubmit=""  enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<div class="tbl_head01 tbl_wrap">
    <table style="width:300px;">
    <caption>table title caption name </caption>
    <thead> 
		<tr>
			<th scope="col">Тайлбар</th>
			<th scope="col">Оноо</th>
		</tr>
    </thead>
    <tbody>		
		<tr>
			<td class="td_category">Start</td>
			<td>
            <input type='text' name='fr_start' value='<?php echo $startlimit; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>			
			</td>
		</tr>
        <tr>
			<td class="td_category">End</td>
			<td>
            <input type='text' name='fr_end' value='<?php echo $endlimit; ?>' class='frm_input'  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>			
			</td>
		</tr>		
    </tbody>
    </table>
</div>
<?php echo $frm_submit;?>
</form>
<?php
include_once('./admin.tail.php');
?>