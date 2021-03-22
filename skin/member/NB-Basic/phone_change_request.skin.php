<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');


include_once('./_head.sub.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);


@include_once(G5_THEME_PATH.'/common.php');

?>

<div id="find_info" class="f-de">
    <div id="topNav" class="bg-primary text-white">
        <div class="p-3">
            <button type="button" class="close" aria-label="Close" onclick="window.close();">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            <h5><?php echo $g5['title']?></h5>
        </div>
    </div>

    <form name="fmember" id="fmember" method="post" action="<?php echo G5_BBS_URL ?>/member_hp_update.php">
        <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']?>" id="mb_id">
        <div class=" tbl_wrap" style="margin-top:10px">
            <table style="width:100%;margin:0 auto; font-size:13px;border:1px solid #707070">
                <tr>
                    <td style="background-color:#f0f0f0;padding:5px">신청자</td>
                    <td><?php echo $member['mb_nick']?>( <?php echo $member['mb_id']?> )</td>
                </tr>
                <tr>
                    <td style="background-color:#f0f0f0;padding:5px">업소명</td>
                    <td><?php echo $member['mb_name']?></td>
                </tr>
                <tr>
                    <td style="background-color:#f0f0f0;padding:5px">이전 전화번호</td>
                    <td><?php echo $member['mb_hp']?></td>
                </tr>
                <tr>
                    <td style="background-color:#f0f0f0;padding:5px">변경 전화번호</td>
                    <td><input type="tel" name="new_hp" id="new_hp" value="<?php echo $member['mb_10']?>"
                            style="width:120px;height:25px; text-align:left; margin-right:25px; border:1px solid #b5b5b5"
                            size="14" maxlength="14" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"></td>
                </tr>
            </table>
            <br />
            <div style="text-align:center">
                <input type="submit" id="change" value="전화번호 변경요청" class="btn btn-primary en">
                <button type="button" class="btn btn-primary en" onclick="window.close();">창닫기</button>
            </div>

            <!-- <?php if($_POST['new_hp']!='')
 echo '<br/><div style="text-align:center">전화번호 변경요청 완료되었습니다</div>'; 

 
?> -->
        </div>
    </form>
</div>

<script src="<?php echo NA_URL ?>/js/jquery-3.5.1.min.js"></script>
<script>
$('#change').click(function() {
    if (confirm("이전 전화 번호를 변경하시겠습니까?")) {
        $('#fmember').submit();
    }
});
</script>