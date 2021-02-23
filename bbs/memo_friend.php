<?php
include_once('./_common.php');

$level_limit=8; // level limit oruulah heseg
$friends_limit=9999; // friends limit

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');

set_session('ss_memo_delete_token', $token = uniqid(time()));

$g5['title'] = '내 쪽지함';
include_once(G5_PATH.'/head.sub.php');

$kind = $kind ? clean_xss_tags(strip_tags($kind)) : 'friends';

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

//----------------------------------------------------------------------
// select checked of members  array 
    if(isset($_POST['chk_fr_no']) and $kind=='friends' and $member['mb_level'] >= $level_limit)
    {        
        $invite = $_POST['chk_fr_no'];
        for ($i=0; $i < count($invite); $i++){
            $sql= "delete from g5_member_friends where mb_id = '{$member['mb_id']}' and me_mbid ='$invite[$i]'";            
            sql_query($sql);
        }
    } else  
    if(isset($_POST['chk_fr_no']) and $kind=='online' and $member['mb_level'] >= $level_limit)
    {
        $sqlsss= "select count(*) as cnt from g5_member_friends where mb_id = '{$member['mb_id']}'";
            $toodddd = sql_fetch($sqlsss);
            if( $toodddd['cnt'] <= $friends_limit){          // nz boloh deed limit 10 
                $invite = $_POST['chk_fr_no'];
                $me_memo = $_POST['fr_memo'];
                for ($i=0; $i < count($invite); $i++){
                    if( $toodddd['cnt'] <= $friends_limit)   // nz boloh deed limit 10 
                    {   $sqlsss= "select count(*) as cnt from g5_member_friends where mb_id = '{$member['mb_id']}' and me_mbid = '{$invite[$i]}'";
                        $too = sql_fetch($sqlsss);
                        if( $too['cnt'] == 0 and $member['mb_id']!=$invite[$i]) {
                            $sql= "insert into g5_member_friends (mb_id, me_mbid, me_memo) values ('{$member['mb_id']}','{$invite[$i]}','{$me_memo}')";
                            sql_query($sql);
                            $kind = "friends";                
                        }
                    }
                }
            } else { alert("10개 이상 친구 등록할 수 없습니다.");}
    }

    if(isset($_POST['finds_friend']) and $member['mb_level'] >= $level_limit)
    {
        $sqlsss= "select count(*) as cnt from g5_member_friends where mb_id = '{$member['mb_id']}'";
            $toodddd = sql_fetch($sqlsss);
            if( $toodddd['cnt'] <= $friends_limit) // nz boloh deed limit 10 
            {
                $invite = $_POST['finds_friend'];
                $me_memo = $_POST['fr_memo'];
                for ($i=0; $i < count($invite); $i++){
                    if( $toodddd['cnt'] <= $friends_limit)    // nz boloh deed limit 10 
                    {
                        $sqlsss= "select count(*) as cnt from g5_member_friends where mb_id = '{$member['mb_id']}' and me_mbid = '{$invite[$i]}'";
                        $too = sql_fetch($sqlsss);
                        if( $too['cnt'] == 0 and $member['mb_id']!=$invite[$i]) {
                            $sql= "insert into g5_member_friends (mb_id, me_mbid, me_memo) values ('{$member['mb_id']}','{$invite[$i]}','{$me_memo}')";
                            sql_query($sql);
                            $kind = "friends";
                        }
                    }
                }
            } else { alert("10개 이상 친구 등록할 수 없습니다.");}
  }
$listfind = array();
// ------------ find member id -----------------------------------
    if(isset($_POST['find_id'])){
        $invite = $_POST['find_id'];
        // print_r($invite);
        $sql = "select * from g5_member where g5_member.mb_id like '%$invite%' or g5_member.mb_nick like '%$invite%'";
        // echo $sql;
        $result = sql_query($sql);
        for ($i=0; $rows=sql_fetch_array($result); $i++)
        {
            $listfind[$i] = $rows;
            $name = get_sideview($rows['mb_id'], $rows['mb_nick'], $rows['mb_homepage']);
            $list[$i]['name'] = $name;
        }

    }
//----------------------------------------------------------------------
$list = array();

if($kind=='friends'){
    $sql = "SELECT a.me_id,
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
    where a.mb_id <> '{$config['cf_admin']}' and a.mb_id <> ''
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