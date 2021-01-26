<?php
include_once("_common.php");
 $q=$_GET["q"];


$query5 = "select * from g5_write_shop  where wr_9 = '$q'  ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	

	$wr_1 = $row['wr_1'];
 
}

$query5 = "select wr_3 from g5_write_basket  where wr_9 = '$q' and mb_id = '$member[mb_id]'  and wr_10 = '구매대기'";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	
	$count = $row['wr_3'];
 
}

$count = $count +1;
$total = $count * $wr_1;
 sql_query(" update g5_write_basket set wr_3 = '$count', wr_1 = '$total' where wr_9 = '$q'  and mb_id = '$member[mb_id]' and wr_10 = '구매대기' "); 
				

?>

   <?php include_once($board_skin_path.'/shop/ajax_in.php');?>