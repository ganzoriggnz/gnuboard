<<<<<<< HEAD
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " update $write_table
            set wr_1 = '$wr_1',
                 wr_password = '".get_encrypt_string($wr_1)."'
          where wr_id = '$wr_id' ";
sql_query($sql);
=======
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " update $write_table
            set wr_1 = '$wr_1',
                 wr_password = '".get_encrypt_string($wr_1)."'
          where wr_id = '$wr_id' ";
sql_query($sql);
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
?>