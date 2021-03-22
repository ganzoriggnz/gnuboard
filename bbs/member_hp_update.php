<?php
include_once('./_common.php');
include_once(G5_LIB_PATH."/register.lib.php");

$mb_hp = hyphen_hp_number($_POST['new_hp']);
if($mb_hp) {
    $result = exist_mb_hp($mb_hp, $mb_id);
    if ($result)
        alert($result);
}

if($_POST['new_hp']!='')
{
    $new_hp = $_POST['new_hp'];
   
    $sql= "update g5_member set mb_10 = '{$new_hp}' where mb_id ='{$member['mb_id']}'";            
    sql_query($sql);

    $tmp_row1 = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id1 = $tmp_row1['max_me_id'] + 1;

    $sql1 = " insert into {$g5['memo_table']} 
    ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values 
    ( 'admin', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$member['mb_nick']} 님 {$member['mb_hp']} 전화 번호를 {$new_hp} 전화번호로 성공적으로 변경되었습니다', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql1);
    if( $me_id1 = sql_insert_id() ){
        // 보내는 회원 쪽지 INSERT
        $sql1 = " insert into {$g5['memo_table']} 
        ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values 
        ( 'admin', '{$member['mb_id']}', '".G5_TIME_YMDHIS."',  '{$member['mb_nick']} 님 {$member['mb_hp']} 전화 번호를 {$new_hp} 전화번호로 성공적으로 변경되었습니다', '0000-00-00 00:00:00', '$me_id1', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql1);		
    }

    $sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read("admin")."' where mb_id = 'admin' ";
    sql_query($sql);

}

goto_url(G5_HTTP_BBS_URL.'/member_hp_change.php');
?>