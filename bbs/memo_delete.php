<?php
include_once('./_common.php');

if (!$is_member)
    alert('회원만 이용하실 수 있습니다.');

$delete_token = get_session('ss_memo_delete_token');
set_session('ss_memo_delete_token', '');

if (!($token && $delete_token == $token))
    alert('토큰 에러로 삭제 불가합니다.');

$me_id = (int)$_REQUEST['me_id'];

$sql = " select * from {$g5['memo_table']} where me_id = '{$me_id}' ";
$row = sql_fetch($sql);

//쪽지 삭제
$sql = " delete from {$g5['memo_table']}
			where me_id = '{$me_id}' ";
sql_query($sql);

//보낸 쪽지 일 경우
if($row['me_type']=='send'){
	$sql = " select * from {$g5['memo_table']} where me_id = '{$row['me_send_id']}' ";
	$recv_row = sql_fetch($sql);

	// 상대 메모가 받기전이면
	if ($recv_row['me_read_datetime']=='0000-00-00 00:00:00'){
		/*
		$sql = " update {$g5['member_table']}
					set mb_memo_call = ''
					where mb_id = '{$row['me_recv_mb_id']}'
					and mb_memo_call = '{$row['me_send_mb_id']}' ";
		sql_query($sql);
		*/
	
		//안읽은 사람 메세지 삭제
		$sql = " delete from {$g5['memo_table']}
					where me_id = '{$row['me_send_id']}' ";
		sql_query($sql);

		$sql = " update `{$g5['member_table']}` set mb_memo_cnt = '".get_memo_not_read($row['me_recv_mb_id'])."' where mb_id = '{$row['me_recv_mb_id']}' ";
		sql_query($sql);
	}

}

run_event('memo_delete', $me_id, $row);	

goto_url('./memo.php?kind='.$kind);
?>
