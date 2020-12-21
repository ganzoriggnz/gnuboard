<?php
$sub_menu = "200910";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";

// 총회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$g5['title'] = '전체쪽지보내기';
include_once('./admin.head.php');
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">차단 </span><span class="ov_num"> <?php echo number_format($intercept_count) ?>명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">탈퇴 </span><span class="ov_num"> <?php echo number_format($leave_count) ?>명 </span></span>
    <span style="margin-left:8px;font-size:12px">차단,탈퇴된 회원은 발송되지 않습니다.</span>
</div>

<form name="fmemoform" id="fmemoform" action="./memo_update.php" onsubmit="return fmemoform_submit(this);" method="post">
    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <tbody>
            <tr>
                <th scope="col" style="width:145px;padding:8px 0">받는사람 권한</th>
                <th style="text-align:left;font-weight:normal">
                    <div class="flmz___2xjT">
                        <input type="checkbox" id="all_check" onclick="check_alls(this.form)">
                        <label for="all_check">전체선택</label>
                        <?php for ($i=1; $i<=30; $i++) { ?>
                        <input type="checkbox" name="mb_level[]" id="mb_level_<?php echo $i ?>" value="<?php echo $i ?>">
                        <label for="mb_level_<?php echo $i ?>"><?php echo $i ?></label>
                        <?php } ?>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="col" style="width:145px">쪽지내용</th>
                <th style="text-align:left">
                    <textarea name="me_memo" id="me_memo"></textarea>
                </th>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <input type="submit" name="act_button" value="발송하기" onclick="document.pressed=this.value" class="btn btn_01">
    </div>
</form>

<script>
function check_alls(f)
{
    var chk = document.getElementsByName("mb_level[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.all_check.checked;
}

function fmemoform_submit(f)
{
    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>