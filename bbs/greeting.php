<?php
include_once('./_common.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');

set_session('ss_memo_delete_token', $token = uniqid(time()));

$g5['title'] = '내 쪽지함';
include_once(G5_PATH.'/head.sub.php');

$kind = $kind ? clean_xss_tags(strip_tags($kind)) : 'recv';

if ($kind == 'recv')
    $unkind = 'send';
else if ($kind == 'send')
    $unkind = 'recv';
else
    alert(''.$kind .'값을 넘겨주세요.');

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$sql = " select count(*) as cnt from {$g5['memo_table']} where me_{$kind}_mb_id = '{$member['mb_id']}' and me_type = '$kind' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];


$total_page  = ceil($total_count / $config['cf_page_rows']);  // 전체 페이지 계산
$from_record = ((int) $page - 1) * $config['cf_page_rows']; // 시작 열을 구함

if ($kind == 'recv')
{
    $kind_title = '받은';
    $recv_img = 'on';
    $send_img = 'off';
}
else
{
    $kind_title = '보낸';
    $recv_img = 'off';
    $send_img = 'on';
}

$list = array();

$sql = " select a.*, b.mb_id, b.mb_nick, b.mb_email, b.mb_homepage
            from {$g5['memo_table']} a
            left join {$g5['member_table']} b on (a.me_{$unkind}_mb_id = b.mb_id)
            where a.me_{$kind}_mb_id = '{$member['mb_id']}' and a.me_type = '$kind'
            order by a.me_id desc limit $from_record, {$config['cf_page_rows']} ";

$result = sql_query($sql);


include_once($member_skin_path.'/greeting.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>
