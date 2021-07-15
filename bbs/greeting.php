<?php
include_once('./_common.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');

set_session('ss_memo_delete_token', $token = uniqid(time()));

$g5['title'] = '내 쪽지함';
include_once(G5_PATH.'/head.sub.php');
$list_skin_path = $board_skin_path . 'NB-Basic/list/basic';

$kind = $kind ? clean_xss_tags(strip_tags($kind)) : 'recv';

if ($kind == 'recv')
    $unkind = 'send';
else if ($kind == 'send')
    $unkind = 'recv';
else
    alert(''.$kind .'값을 넘겨주세요.');

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$sql = " select count(*) as cnt from g5_write_greeting";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$total_page  = ceil((int)$total_count / $config['cf_page_rows']);  // 전체 페이지 계산
$from_record = ((int) $page - 1) * $config['cf_page_rows']; // 시작 열을 구함

$list = array();


$sql = "select *, exists(select 1 from {$g5['member_table']} c where c.mb_level='27' and c.mb_id=a.mb_id) lvl_27, 
    exists(select 1 from g5_coupon d where d.co_free_num>'0' and d.co_sale_num>'0' and d.co_begin_datetime='2021-07-01 00:00:00' and d.mb_id=a.mb_id) has_coupon 
    from g5_write_greeting a where a.wr_is_comment = 0 and a.wr_id order by wr_num, wr_reply desc limit $from_record, 55";

$result = sql_query($sql);
$i = 0;
while($row = sql_fetch_array($result)){
    $list[$i] = $row;
    // if (strstr($sfl, 'subject')) {
        $list[$i]['subject'] = search_font('mb_name', $list[$i]['subject']);
    // }
    $i++;
}
include_once($list_skin_path . '/list.skin.php');
include_once(G5_PATH.'/tail.sub.php');
?>
