<?php
include_once('./_common.php');
if (!stripos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])) exit;

// 비회원
if (!$is_member) {
	exit;
}

if( ! $_POST['id'] || ! $_POST['hope_area1'] || ! $_POST['hope_type1']){
	exit;
}

$sql = " update {$g5['giftbox_table']} 
		set 
		request = 'Y',
		hope_area1 = '{$_POST['hope_area1']}',
		hope_area2 = '{$_POST['hope_area2']}',
		hope_area3 = '{$_POST['hope_area3']}',
		hope_type1 = '{$_POST['hope_type1']}',
		hope_type2 = '{$_POST['hope_type2']}',
		hope_type3 = '{$_POST['hope_type3']}'
		where id = '{$_POST['id']}' ";
sql_query($sql);

$sql = "SELECT * FROM {$g5['giftbox_table']} where id='{$_POST['id']}'";
$row = sql_fetch($sql); 

$me_memo = $row['gift_name']." 사용신청\n\n" . 
"아이디 : " . $member['mb_id'] . "\r" . 
"닉네임 : " . $member['mb_nick'] . "\n\n" .

"1.원하는 지역 : " . $row['hope_area1'] . "\n" . 
"1.원하는 유형 : " . $row['hope_type1'] . "\n\n" .

"2.원하는 지역 : " . $row['hope_area2'] . "\n" .
"2.원하는 유형 : " . $row['hope_type2'] . "\n\n" .

"3.원하는 지역 : " . $row['hope_area3'] . "\n" .
"3.원하는 유형 : " . $row['hope_type3'];

// 관리자에게 쪽지 INSERT
$sql = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values ( 'admin', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

sql_query($sql);

// 실시간 쪽지 알림 기능
$sql = " update {$g5['member_table']} set mb_memo_call = 'admin', mb_memo_cnt = '".get_memo_not_read("admin")."' where mb_id = 'admin' ";
sql_query($sql);

echo 'sucess';