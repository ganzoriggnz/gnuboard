<<<<<<< HEAD
<?php
include_once "_common.php";

if($is_admin=='super') {
    $g5_write = explode(G5_TABLE_PREFIX."write_",$_POST['bo_table']);
   
    $sql = " select bo_use_name from ".$g5['board_table']." where bo_table = '".$g5_write[1]."' ";
    $result_usename = sql_query($sql);
    $result_usename2 = sql_fetch_array($result_usename);
    $bo_usename = $result_usename2['bo_use_name'];
   
    $sql = " select mb_name, mb_nick, mb_email, mb_homepage from ".$g5['member_table']." where mb_id = '".$_POST['mb_id']."' ";
    $row = sql_fetch($sql);
   
    if ($bo_use_name=="1") { $row_name = $row['mb_name']; }
    else { $row_name = $row['mb_nick']; }
   
    $sql = " update ".$_POST['bo_table']." set wr_name = '". $row_name ."', wr_email = '". $row['mb_email'] ."', wr_homepage = '". $row['mb_homepage'] ."', mb_id = '". $_POST['mb_id'] ."' where wr_id = '". $_POST['wr_id'] ."' ";
    sql_query($sql);
}
?>
<script>
  location.href="<?php echo $_POST['REQUEST_URI']?>" ;
=======
<?php
include_once "_common.php";

if($is_admin=='super') {
    $g5_write = explode(G5_TABLE_PREFIX."write_",$_POST['bo_table']);
   
    $sql = " select bo_use_name from ".$g5['board_table']." where bo_table = '".$g5_write[1]."' ";
    $result_usename = sql_query($sql);
    $result_usename2 = sql_fetch_array($result_usename);
    $bo_usename = $result_usename2['bo_use_name'];
   
    $sql = " select mb_name, mb_nick, mb_email, mb_homepage from ".$g5['member_table']." where mb_id = '".$_POST['mb_id']."' ";
    $row = sql_fetch($sql);
   
    if ($bo_use_name=="1") { $row_name = $row['mb_name']; }
    else { $row_name = $row['mb_nick']; }
   
    $sql = " update ".$_POST['bo_table']." set wr_name = '". $row_name ."', wr_email = '". $row['mb_email'] ."', wr_homepage = '". $row['mb_homepage'] ."', mb_id = '". $_POST['mb_id'] ."' where wr_id = '". $_POST['wr_id'] ."' ";
    sql_query($sql);

    $date = G5_TIME_YMDHIS;
    $newdate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($date)));
    $sql1 = " UPDATE {$g5['member_table']}
                SET 
                mb_3 = '{$date}',
                mb_4 = '{$newdate}'
               WHERE  mb_id = '". $_POST['mb_id'] ."'";
    sql_query($sql1);
}
?>
<script>
  location.href="<?php echo $_POST['REQUEST_URI']?>" ;
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
</script>