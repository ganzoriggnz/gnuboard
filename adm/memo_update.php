<?php
$sub_menu = "200910";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$sql_common = " from {$g5['member_table']}";
$sql_where = " where (1) and mb_id not in('{$config['cf_admin']}')";

for ($i=0; $i<count($_POST['mb_level']); $i++) {
    $sql = " select * {$sql_common} {$sql_where} and mb_level = '{$_POST['mb_level'][$i]}' ";
    $result = sql_query($sql);
    for ($j=0; $row=sql_fetch_array($result); $j++) {
        if (!$row['mb_leave_date']) {
            $tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
            $me_id = $tmp_row['max_me_id'] + 1;

            // 쪽지 INSERT
            $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime ) values ( '$me_id', '{$row['mb_id']}', '{$member['mb_id']}', '" . G5_TIME_YMDHIS . "', '{$_POST['me_memo']}', '0000-00-00 00:00:00' ) ";
            sql_query($sql);
        }
    }
}

alert('정상적으로 쪽지를 발송했습니다.');
?>