<<<<<<< HEAD
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
delete_cache_latest($bo_table);
goto_url($board_skin_url.'/view.php?bo_table='.$bo_table.'&amp;wr_id='.$write['wr_parent'].'&amp;page='.$page. $qstr);
exit;
=======
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
delete_cache_latest($bo_table);
goto_url($board_skin_url.'/view.php?bo_table='.$bo_table.'&amp;wr_id='.$write['wr_parent'].'&amp;page='.$page. $qstr);
exit;
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
?>