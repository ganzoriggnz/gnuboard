<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');
//include_once($board_skin_path.'/config.php');
//필요한 전역변수 선언
global $config, $member, $is_member, $urlencode, $is_admin, $g5;



					$g5['connect_db'];
					$result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
					
					while ( $row=sql_fetch_array($result))
					{
						$bo_table = $row['bo_table'];
						echo $row['bo_table'];
						
						$res = sql_fetch("select * from ".$g5['write_prefix'].$bo_table." ");
						
						for($i=0;  $res; $i++)
				
						 {   
							echo $res[$i];
						 }
							
							
					}	 
				
			

 ?>
