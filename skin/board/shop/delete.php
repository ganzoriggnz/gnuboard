<?php
include_once("_common.php");
 $q=$_GET["q"];


 sql_query(" delete from g5_write_basket  where wr_9 = '$q'  and mb_id = '$member[mb_id]' and wr_10 = '구매대기' "); 
				
$i = 0;
$query5 = "select * from g5_write_basket  where mb_id = '$member[mb_id]'  and wr_10 = '구매대기' ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	
	$product[$i] = $row['wr_subject']; 
	$amount[$i] = $row['wr_3'];
	$price[$i] = $row['wr_1'];
	$delivery[$i] = $row['wr_2']; 
	$date[$i] = $row['wr_datetime']; 
	$id[$i] = $row['wr_9']; 
	$i++;
}
?>

   <?php include_once($board_skin_path.'/shop/ajax_in.php');?>
