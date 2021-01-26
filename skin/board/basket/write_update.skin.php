<?php
    sql_query(" update g5_write_basket set ca_name = '$wr_10' where wr_id = '$wr_id' ");
	if($wr_10 == "결제확인") sql_query(" update g5_write_shop set ca_name = '$wr_10' where wr_id = '$wr_id' ");
	?>