<?php
include_once('./_common.php');
if (!$is_admin)
    alert_close('회원만 조회하실 수 있습니다.');

if ($_GET['mb_id']){
    $mb= get_member($_GET['mb_id']);
    $mb_id=  $mb['mb_id'];
    $oldphone = $mb['mb_hp'];
    $newphone = $mb['mb_10'];
    $sql= "update g5_member set mb_10 = '', mb_hp = '$newphone' where mb_id ='$mb_id'";            
    sql_query($sql);
    
    $tmp_row1 = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id1 = $tmp_row1['max_me_id'] + 1;

    $sql1 = " insert into {$g5['memo_table']} 
    ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values 
    ( '$mb_id', 'admin', '".G5_TIME_YMDHIS."', '요청주신 번호로 변경처리 해드렸습니다.', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";
    // $sql1 = " insert into {$g5['memo_table']} 
    // ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values 
    // ( '$mb_id', 'admin', '".G5_TIME_YMDHIS."', '{$mb['mb_nick']} ({$mb['mb_id']}) $oldphone 실장 전화번호를 $newphone 변경처리되었습니다. 전화번호 변경 요청을 성공적으로 처리되었습니다.', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql1);
    if( $me_id1 = sql_insert_id() ){
        // 보내는 회원 쪽지 INSERT
        $sql1 = " insert into {$g5['memo_table']} 
        ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values 
        ( '$mb_id', 'admin', '".G5_TIME_YMDHIS."',  '$mb_id 전화번호 변경요청 합니다 {$mb['mb_10']}를  $new_hp 으로 변경합니다 -- 번호를  성공적으로 변경되었습니다', '0000-00-00 00:00:00', '$me_id1', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql1);
    }

    $sql = " update {$g5['member_table']} set mb_memo_call = 'admin', mb_memo_cnt = '".get_memo_not_read($mb_id)."' where mb_id = '$mb_id' ";
    sql_query($sql);

    alert('전화 번호를  성공적으로 변경되었습니다.', G5_BBS_URL.'/memo.php?kind=recv');
}
else
alert('전화 번호 변경할 때 오류가 발생하였습니다.운영자과 문의하세요.', G5_BBS_URL.'/memo.php?kind=recv');
// goto_url(G5_BBS_URL'/memo.php?kind=recv');
