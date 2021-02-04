<?php
include_once("./_common.php");

if($check == "") echo "<script type='text/javascript'>alert('잘못된 경로입니다');</script>";

$check = $_GET['check'];
$total_price = $_GET['total_price'];
$myid = $_GET['myid'];
if($check == "결제하기") {
 $query5 = "select * from g5_member  where mb_id = '$myid'";
 $result5 = sql_query($query5);
 while($row  = sql_fetch_array($result5)) {
   $mypoint = $row['mb_point'];
 }

echo '<meta charset="utf-8">';

 $mypoint = $mypoint - $total_price;

 if($mypoint < 0) echo "<script type='text/javascript'>alert('파운드가 모자랍니다');opener.location.reload(); self.close();</script>";
 else { 
	 sql_query(" update g5_member set mb_point = '$mypoint' where mb_id = '$myid' ");
	 sql_query(" update g5_write_basket set wr_10 = '결제확인' where  mb_id = '$myid' ");
	echo "<script type='text/javascript'>alert('감사합니다.  $total_price 파운드 결제가 완료 되었습니다. 파운드가 $mypoint 남았습니다');opener.location.reload(); self.close();</script> ";
	$check_reload = 1;

$use_point = -$total_price;
 $sql = " insert into g5_point
                set  po_point = '$use_point',
							po_content = '상품 결제',
							po_datetime = '".G5_TIME_YMDHIS."',
							mb_id = '$myid' ";            
            sql_query($sql);
 }
}
 ?>
