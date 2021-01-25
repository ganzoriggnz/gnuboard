<?php
$sub_menu = "300210";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['singo_table']} ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "bo_id";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$mb = array();
if ($sfl == 'mb_id' && $stx)
    $mb = get_member($stx);

$g5['title'] = '게시물신고관리';
include_once ('./admin.head.php');

$colspan = 10;

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
    <a href="./board_singo.php?sfl=bo_status&amp;stx=0" class="ov_listall">처리중보기</a>
    <a href="./board_singo.php?sfl=bo_status&amp;stx=1" class="ov_listall">처리완료보기</a>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="bo_table"<?php echo get_selected($_GET['sfl'], "bo_table"); ?>>TABLE</option>
    <option value="bo_mb_id"<?php echo get_selected($_GET['sfl'], "bo_mb_id"); ?>>신고자아이디</option>
    <option value="bo_mb_name"<?php echo get_selected($_GET['sfl'], "bo_mb_name"); ?>>신고자닉네임</option>
    <option value="bo_object_id"<?php echo get_selected($_GET['sfl'], "bo_object_id"); ?>>신고대상아이디</option>
    <option value="bo_object_name"<?php echo get_selected($_GET['sfl'], "bo_object_name"); ?>>신고대상닉네임</option>
    <option value="bo_ip"<?php echo get_selected($_GET['sfl'], "bo_ip"); ?>>아이피</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>

<form name="fsingolist" id="fsingolist" method="post" action="./board_singo_update.php" onsubmit="return fsingolist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">포인트 내역 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">TABLE</th>
        <th scope="col">게시물번호</th>
        <th scope="col">게시물링크</th>
        <th scope="col">신고자아이디</th>
        <th scope="col">신고자닉네임</th>
        <th scope="col">신고대상아이디</th>
        <th scope="col">신고대상닉네임</th>
        <th scope="col">신고자아이피</th>
        <th scope="col">신고날짜</th>
        <th scope="col">상태</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        
        if ($row['bo_status'])
            $singo_status = '처리완료';
        else
            $singo_status = '<font color="red">처리중</font>';
    ?>
    
    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="bo_id[<?php echo $i ?>]" value="<?php echo $row['bo_id'] ?>" id="bo_id_<?php echo $i ?>">
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left" style="width:80px"><?php echo $row['bo_table'] ?></td>
        <td class="td_left" style="width:80px"><?php echo $row['bo_wr_id'] ?>번</td>
        <td class="td_left" style="width:500px"><a href="<?php echo $row['bo_link'] ?>" target="_blank"><?php echo $row['bo_link'] ?></a></td>
        <td class="td_left" style="width:100px"><?php echo $row['bo_mb_id'] ?></td>
        <td class="td_left" style="width:100px"><?php echo $row['bo_mb_name'] ?></td>
        <td class="td_left" style="width:100px"><?php echo $row['bo_object_id'] ?></td>
        <td class="td_left" style="width:100px"><?php echo $row['bo_object_name'] ?></td>
        <td class="td_left" style="width:100px"><?php echo $row['bo_ip'] ?></td>
        <td style="width:140px;text-align:center"><?php echo $row['bo_singo_date'] ?></td>
        <td style="width:60px;text-align:center"><?php echo $singo_status ?></td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택처리" onclick="document.pressed=this.value" class="btn btn_02">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
function fsingolist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
