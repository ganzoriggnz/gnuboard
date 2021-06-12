<?php
include_once('./_common.php');

if (!$is_admin) die('');

if(isset($_POST['mb_6']))
{
    $mb_6 = $_POST['mb_6'];
    $sql = "select bo_subject, bo_category_list from {$g5['board_table']} where bo_table = '$mb_6'";
    $row = sql_fetch($sql);
    $categories = explode("|", $row['bo_category_list']); ?> 
    <option>분류를 선택하세요</option>
    <?php
    for ($i = 0; $i < count($categories); $i++) {
        $category = trim($categories[$i]);
        if (!$category) continue;
        ?>
       <option value="<?php echo $categories[$i]; ?>"> <?php echo  $row['bo_subject'] . "  -  " . $categories[$i]; ?></option>
<?php
    }
} 
?>