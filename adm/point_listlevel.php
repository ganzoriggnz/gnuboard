<?php
$sub_menu = '200500';
include_once('./_common.php');

// 전체회원수
$sql = " select count(*) as cnt from {$g5['member_table']} ";
$row = sql_fetch($sql);
$tot_cnt = $row['cnt'];

// 탈퇴회원수
$sql = " select count(*) as cnt from {$g5['member_table']} where mb_leave_date <> '' ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt from {$g5['member_table']} where mb_intercept_date <> '' ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$g5['title'] = '전체회원 포인트 지급';
include_once('./admin.head.php');
?>

<div class="local_ov01 local_ov">
    전체회원 <?php echo number_format($tot_cnt) ?>명 중, 차단 <?php echo number_format($intercept_count) ?>명, 탈퇴 <?php echo number_format($leave_count) ?></a>명 (차단, 탈퇴 회원은 지급되지 않습니다.)
</div>

<form name="memo_form" action="./point_listlevel_update.php" onsubmit="return memolist_submit(this);" method="post">
<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">받는사람 권한</th>
        <td>
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"> 전체선택
            <?php for ($i=0; $i<30; $i++) { ?>
            <input type="checkbox" name="m_level[<?php echo $i ?>]" value="1" id="m_level[]" style="margin-left:12px"> <?php echo $i+1; ?>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <th scope="row">파운드 내용</th>
        <td><input type="text" name="po_content" id="po_content" required class="required frm_input" size="80"></td>
    </tr>
	<tr>
        <th scope="row">파운드</th>
        <td><input type="text" name="po_point" id="po_point" required class="required frm_input"></td>
    </tr>
    <?php if($config['cf_point_term'] > 0) { ?>
    <tr>
        <th scope="row"><label for="po_expire_term">파운드 유효기간</label></th>
        <td><input type="text" name="po_expire_term" value="<?php echo $po_expire_term; ?>" id="po_expire_term" class="frm_input" size="5"> 일 (미입력시 환경설정 > 기본환경설정 > 파운드 유효기간에 입력된 값으로 처리)</td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row">최종접속일 제한</th>
        <td><input type="text" name="po_whendate" id="po_whendate" class="frm_input" size="5"> 일 (365 입력시 최근 1년 이내에 로그인 기록이 있는 회원만 지급, 미입력시 제한없음)</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" class="btn_submit" accesskey="s" value="파운드지급하기">
</div>

<script>
function all_checked(sw) {
    var f = document.memo_form;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].id == "m_level[]")
            f.elements[i].checked = sw;
    }
}

function memolist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].id == "m_level[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert("파운드를 지급받는 대상을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}

$(document).on("keyup", "input[name^=po_point], input[name^=po_whendate], input[name^=po_expire_term]", function() {
    var val= $(this).val();

    if(val.replace(/[0-9]/g, "").length > 0) {
        alert("숫자만 입력해 주십시오.");
        $(this).val('');
    }
});
</script>

<?php
include_once ('./admin.tail.php');
?>