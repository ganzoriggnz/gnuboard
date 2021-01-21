<?php
include_once('./_common.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');

set_session('ss_memo_delete_token', $token = uniqid(time()));

$g5['title'] = '내 쪽지함ssss';
include_once(G5_PATH.'/head.sub.php');

$kind = $kind ? clean_xss_tags(strip_tags($kind)) : 'friends';

// if ($kind == 'friends')
//     $unkind = 'online';
// else if ($kind == 'online')
//     $unkind = 'friends';
// else
//     alert(''.$kind .'값을 넘겨주세요.');

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

run_event('memo_list', $kind, $unkind, $page);

$sql = " select count(*) as cnt from {$g5['memo_table']} where me_{$kind}_mb_id = '{$member['mb_id']}' and me_type = '$kind' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$total_page  = ceil($total_count / $config['cf_page_rows']);  // 전체 페이지 계산
$from_record = ((int) $page - 1) * $config['cf_page_rows']; // 시작 열을 구함

if ($kind == 'friends')
{
    $kind_title = '친구관리(나의 친구들)';
}
else
{
    $kind_title = '현재접속자';
}


    if(isset($_POST['chk_fr_no']) and $kind=='friends')
    {        
        $invite = $_POST['chk_fr_no'];
        print_r($invite);
    } else  
    if(isset($_POST['chk_fr_no']) and $kind=='online')
    {
        $invite = $_POST['chk_fr_no'];
        print_r($invite);
    }

    if(isset($_POST['find_id'])){
        $invite = $_POST['find_id'];
        print_r($invite);
    }

$list = array();

if($kind=='friends'){
    $sql = "SELECT 
    (SELECT g5_member.mb_id FROM g5_member WHERE g5_member.mb_id = a.me_mbid) AS mb_id,
    (SELECT g5_member.mb_nick FROM g5_member WHERE g5_member.mb_id = a.me_mbid) AS mb_nick, 
    (SELECT g5_member.mb_name FROM g5_member WHERE g5_member.mb_id = a.me_mbid) AS mb_name, 
    a.me_mbid, 
    a.me_memo, 
    (SELECT count(g5_login.mb_id) as countd FROM g5_login WHERE g5_login.mb_id = a.me_mbid) AS countd

    FROM g5_member_friends a where a.mb_id = '{$member['mb_id']}'";
}

else if($kind=='online') {
    $sql = " select a.mb_id, b.mb_nick, b.mb_name
    from {$g5['login_table']} a left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
    where a.mb_id <> '{$config['cf_admin']}'
    order by a.lo_datetime desc ";
}

$result = sql_query($sql);


for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;

    $mb_id = $row["mb_id"];

    if($kind=='online')
        $list[$i]['countd'] = 1;

    if ($row['mb_nick'])
        $mb_nick = $row['mb_nick'];
    else
        $mb_nick = '정보없음';

    $name = get_sideview($row['mb_id'], $row['mb_nick']);

    if (substr($row['me_read_datetime'],0,1) == 0)
        $read_datetime = '아직 읽지 않음';
    else
        $read_datetime = substr($row['me_read_datetime'],2,14);

    $send_datetime = substr($row['me_send_datetime'],2,14);
 
    $list[$i]['me_mbid'] = $row['mb_id'];
    $list[$i]['mb_id'] = $mb_id;
    $list[$i]['name'] = $name;
    $list[$i]['send_datetime'] = $send_datetime;
    $list[$i]['read_datetime'] = $read_datetime;
    $list[$i]['view_href'] = './memo_friend.php?me_id='.$row['me_id'].'&amp;kind='.$kind.'&amp;page='.$page;

    $list[$i]['del_href'] = './memo_delete.php?me_id='.$row['me_id'].'&amp;token='.$token.'&amp;kind='.$kind;
} 

$total_count=count($list);

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./memo.friends.php?kind=$kind".$qstr."&amp;page=");

include_once($member_skin_path.'/memo.friends.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>