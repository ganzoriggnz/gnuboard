<?php
$sub_menu = '200500';
include_once('./_common.php');

$count = count($_POST['m_level']);

if(!$count) {
    alert('파운드를 지급받는 대상을 하나 이상 선택하세요.');
}

$g5['title'] = '파운드 지급 결과';
include_once('./admin.head.php');

$whendate = $_POST['po_whendate'];
$po_point = $_POST['po_point'];
$po_content = $_POST['po_content'];
$expire = preg_replace('/[^0-9]/', '', $_POST['po_expire_term']);

if ($whendate) {
    $sql_whendate .= " and date_format(mb_today_login,'%Y%m%d') >= ".date("Ymd",(time()-86400*$whendate))." ";
}

$level=array();
$level[1]=$_POST['m_level'][0];
$level[2]=$_POST['m_level'][1];
$level[3]=$_POST['m_level'][2];
$level[4]=$_POST['m_level'][3];
$level[5]=$_POST['m_level'][4];
$level[6]=$_POST['m_level'][5];
$level[7]=$_POST['m_level'][6];
$level[8]=$_POST['m_level'][7];
$level[9]=$_POST['m_level'][8];
$level[10]=$_POST['m_level'][9];
$level[11]=$_POST['m_level'][10];
$level[12]=$_POST['m_level'][11];
$level[13]=$_POST['m_level'][12];
$level[14]=$_POST['m_level'][13];
$level[15]=$_POST['m_level'][14];
$level[16]=$_POST['m_level'][15];
$level[17]=$_POST['m_level'][16];
$level[18]=$_POST['m_level'][17];
$level[19]=$_POST['m_level'][18];
$level[20]=$_POST['m_level'][19];
$level[21]=$_POST['m_level'][20];
$level[22]=$_POST['m_level'][21];
$level[23]=$_POST['m_level'][22];
$level[24]=$_POST['m_level'][23];
$level[25]=$_POST['m_level'][24];
$level[26]=$_POST['m_level'][25];
$level[27]=$_POST['m_level'][26];
$level[28]=$_POST['m_level'][27];
$level[29]=$_POST['m_level'][28];
$level[30]=$_POST['m_level'][29];
$first=1;
$sql_who="and mb_level in (";
for ($i=1; $i<31; $i++) {
    if ($level[$i]) {
        if (!$first) $sql_who.=",";
        else $first=0;
        $sql_who.="'".$i."'";
    }
}
$sql_who.=")";

$sql=" select mb_id from {$g5['member_table']} where 1 $sql_who and mb_leave_date = '' and mb_intercept_date = '' {$sql_whendate} ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    insert_point($row['mb_id'], $po_point, $po_content, '@passive', $row['mb_id'], $member['mb_id'].'-'.uniqid(''), $expire);
    $send_cnt = $i + 1;
}
?>

<div class="local_desc01 local_desc">
    <p>총 (<strong><?php echo $send_cnt+0; ?></strong>) 명에게 파운드 <strong><?php echo $po_point ?></strong> 을 지급하였습니다.</p>
</div>

<?php
include_once ('./admin.tail.php');
?>