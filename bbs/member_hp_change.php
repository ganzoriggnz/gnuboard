<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = " ▶  전화번호 변경요청";
$mb_id=  $_POST['mb_id'];
$phone_skin_path = get_skin_path('member', $config['cf_member_skin']);
$point_skin_url  = get_skin_url('member', $config['cf_member_skin']);

$skin_file = $phone_skin_path.'/phone_change_request.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}
$new_hp=$member['mb_10'];

if($_POST['new_hp']!='')
{
    $new_hp = $_POST['new_hp'];
   
    $sql= "update g5_member set mb_10 = '{$new_hp}' where mb_id ='{$member['mb_id']}'";            
    sql_query($sql);

    $tmp_row1 = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id1 = $tmp_row1['max_me_id'] + 1;

    $sql1 = " insert into {$g5['memo_table']} 
    ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values 
    ( 'admin', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$member['mb_nick']} 님 {$member['mb_10']} 전화 번호를 {$new_hp} 전화번호로 성공적으로 변경되었습니다', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql1);
    if( $me_id1 = sql_insert_id() ){
        // 보내는 회원 쪽지 INSERT
        $sql1 = " insert into {$g5['memo_table']} 
        ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values 
        ( 'admin', '{$member['mb_id']}', '".G5_TIME_YMDHIS."',  '{$member['mb_id']} 전화번호 변경요청 합니다 {$member['mb_10']}를  {$new_hp}으로 변경합니다', '0000-00-00 00:00:00', '$me_id1', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql1);		
    }

    $sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read("admin")."' where mb_id = 'admin' ";
    sql_query($sql);

}

include_once('./_tail.php');
?>
