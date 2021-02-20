<?php
include_once('./_common.php');
if (!$is_admin)
    alert_close('회원만 조회하실 수 있습니다.');

if ($_GET['mb_id']){
    $mb_id=  $_GET['mb_id'];
    $oldphone = $member['mb_hp'];
    $newphone = $member['mb_10'];
    $sql= "update g5_member set mb_10 = '', mb_hp = '$newphone' where mb_id ='$mb_id'";            
    sql_query($sql);
    
    $tmp_row1 = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id1 = $tmp_row1['max_me_id'] + 1;

    $sql1 = " insert into {$g5['memo_table']} 
    ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values 
    ( '$mb_id', 'admin', '".G5_TIME_YMDHIS."', '$mb_id hereglegchiin  $oldphone utsiig $newphone iim bolgoj uurchluw ', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql1);
    if( $me_id1 = sql_insert_id() ){
        // 보내는 회원 쪽지 INSERT
        $sql1 = " insert into {$g5['memo_table']} 
        ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values 
        ( '$mb_id', 'admin', '".G5_TIME_YMDHIS."',  '$mb_id 전화번호 변경요청 합니다 {$member['mb_10']}를  $new_hp 으로 변경합니다  huselt amjilttai uurchlugdluu', '0000-00-00 00:00:00', '$me_id1', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql1);
    }

    $sql = " update {$g5['member_table']} set mb_memo_call = 'admin', mb_memo_cnt = '".get_memo_not_read($mb_id)."' where mb_id = '$mb_id' ";
    sql_query($sql);

    alert('Success changed phone number', G5_BBS_URL'/memo.php?kind=recv');
}
else
goto_url(G5_BBS_URL'/memo.php?kind=recv');
?>
