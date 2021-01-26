<?php
//<- 오류 모두 표시 
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "300900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$area1 = '';
$area2 = '';
$area3 = '';

$sqlAdmin='select * FROM `g5_fragment_admin_limit` ORDER BY fr_id DESC limit 1';
// echo $sqlAdmin;
$result=sql_query($sqlAdmin);
for($i=0; $row=sql_fetch_array($result); $i++) {
    $area1 = $row['fr_8'];
    $area2 = $row['fr_9'];
    $area3 = $row['fr_10'];
}
if ($w == 'u')
{
	$sql = " update {$g5['fragment_table']}
            set fr_8 = '{$_POST['fr_8']}',
            fr_9 = '{$_POST['fr_9']}',
            fr_10 = '{$_POST['fr_10']}'";            	
	sql_query($sql);
	goto_url($PHP_SELF, false);
}

$g5['title'] .= '상단공지내용관리';
include_once('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:00px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';
?>

<div class="local_desc01 local_desc">
    <p>
    슬라인드 문구 3개까지 설정값을 입력하세요.
    </p>
</div>
<form name="fmb_lev_conf" id="fmb_lev_conf" method="post" onsubmit=""  enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<div class="tbl_head01 tbl_wrap">
    <table style="width:800px;">
    <caption>table title caption name </caption>
    <thead> 
		<tr>
			<th scope="col">설명</th>
			<th scope="col">설정 값</th>
		</tr>
    </thead>
    <tbody>
		<tr>
			<td class="td_category">1-상단공지 </td>
			<td>
            
            <input type='text' name='fr_8'  value='<?php echo $area1; ?>' class='frm_input'>			
			</td>
		</tr>
        <tr>
			<td class="td_category">2-상단공지 </td>
			<td>
            <input type='text' name='fr_9' value='<?php echo $area2; ?>' class='frm_input'>			
			</td>
        </tr>
        <tr>
			<td class="td_category">3-상단공지</td>
			<td>
            <input type='text' name='fr_10' value='<?php echo $area3; ?>' class='frm_input'>			
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