<?php 

if($wr_2 == "" || $wr_2 == 0) { sql_query(" update g5_write_shop set wr_2 = '0' where wr_9 = '$wr_9'  "); $wr_2 = 0; }
sql_query(" update g5_write_basket set wr_2 = '$wr_2', wr_8 = '$wr_8' where wr_9 = '$wr_9' and wr_10 = '구매대기'  "); 
if($wr_good != "") sql_query(" update g5_write_shop set wr_good = '$wr_good' where wr_id = '$wr_id'  "); 
?>