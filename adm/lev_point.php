<?php
//<- 오류 모두 표시 
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "200600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('등급수정은 최고관리자만 가능합니다.');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['lev_point_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['lev_point_table']} (   
        lev_no int(11) NOT NULL AUTO_INCREMENT,         
        lev_name varchar(20) NOT NULL DEFAULT '',
        lev_point int(11) NOT NULL DEFAULT '0',
        lev_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        lev_updated_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (lev_no), 
        INDEX (lev_name)
    )";

    sql_query($sql_table, false);
} 


$g5['title'] = '자동 등업시 지금할 파운드 값 입력';
include_once('./admin.head.php');

?>

<div class="local_desc01 local_desc">
    <p>
        회원 자동등업시 지급할 파운드 값을 설정할 수 있는 페이지입니다.
    </p>
</div>

<form name="flev_point" id="flev_point" method="post" action="./lev_point_update.php" onsubmit="return flev_point_submit(this);" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="u">
<input type="hidden" name="token" value="" id="token">

<div class="tbl_head01 tbl_wrap">
    <table style="width:800px;">
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">파운드 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col">회원등급</th>
                <th scope="col">등급</th>
                <th scope="col">파운드</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $q = "SELECT * FROM {$g5['lev_point_table']}";
            $result = sql_query($q);
            for ($i=0; $row=sql_fetch_array($result); $i++) { ?>
            <tr>
                <td class="td_chk">
                    <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['lev_name']) ?></label>
                    <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                </td>
                <td class="td_category">
                    <?php echo $row['lev_no'];?>
                </td>
                <td>
                    <input type='text' name="lev_name[<?php echo $i;?>]" value="<?php echo $row['lev_name'];?>" class='frm_input'>
                </td>
                <td>
                    <input type='number' name="lev_point[<?php echo $i;?>]" value="<?php echo $row['lev_point'];?>" class='frm_input text-right'>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn_02 btn">
</div>

</form>
<script>
    function flev_point_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }
        return true;
    }
</script>
<?php
include_once('./admin.tail.php');
?>