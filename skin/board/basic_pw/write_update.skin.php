<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " update $write_table
            set wr_1 = '$wr_1',
                 wr_password = '".get_encrypt_string($wr_1)."'
          where wr_id = '$wr_id' ";
sql_query($sql);
?>