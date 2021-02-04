<?php
include_once("_common.php");

 $q=$_GET["q"];

$query5 = "select * from g5_write_shop  where wr_id = '$q'  ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	$wr_subject = $row['wr_subject']; 
	$wr_1 = $row['wr_1'];
	$wr_2 = $row['wr_2']; 
	$wr_8 = $row['wr_8']; 
	$wr_9 = $row['wr_9']; 
}

$query5 = "select wr_3 from g5_write_basket  where mb_id = '$member[mb_id]' and wr_10 = '구매대기' and wr_9 = '$wr_9' ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {	
	$cnt2 = $row['wr_3']; 
}

$wr_3 = $cnt2 + 1;
$wr_1 = $wr_3 * $wr_1;

if($cnt2 == "") {
$table = "g5_write_basket";
$bo_table = "basket";
 $wr_num = get_next_num($table);

    $sql = " insert into $table
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '구매대기',
                     wr_option = '$html,$secret,$mail',
                     wr_subject = '$wr_subject',
                     wr_content = '필요한 내용을 넣으세요',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '{$member['mb_id']}',
                     wr_password = '$wr_password',
                     wr_name =  '{$member['mb_name']}',
                     wr_email =  '{$member['mb_main']}',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '구매대기' ";

    sql_query($sql);

    $wr_id = mysql_insert_id();


    // 부모 아이디에 UPDATE
    sql_query(" update $table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 새글 INSERT
    sql_query(" insert into g5_board_new ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

    // 게시글 1 증가
    sql_query("update g5_board set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");
}
if($cnt2 != "") { sql_query(" update g5_write_basket set wr_3 = '$wr_3' where wr_9 = '$wr_9' and wr_10 = '구매대기' "); 
				  sql_query(" update g5_write_basket set wr_1 = '$wr_1' where wr_9 = '$wr_9' and wr_10 = '구매대기' "); 
				}


?>
<?php include_once($board_skin_path.'/shop/ajax_in.php');?>
