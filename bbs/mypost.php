<?php
include_once('./_common.php');

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = get_text($member['mb_nick']).'님의 스크랩';
include_once(G5_PATH.'/head.sub.php');

/* if($member['mb_id']){
    global $g5;
    $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
    
    $list = array();
    for($i=0; $row=sql_fetch_array($result); $i++)
    {
      $bo_table = $row['bo_table'];

      $result1 = sql_query("select * from ".$g5['write_prefix'].$bo_table. " where mb_id = '{$member['mb_id']}'");
      if($result1){
          for($j=0;$row1 = sql_fetch_array($result1); $j++){
            array[i][j]=$row1;
          }
        
      }
      
    } 
}  */

$sql_common = " from {$g5['autosave_table']} where mb_id = '{$member['mb_id']}' ";
$sql_order = " order by as_id desc ";

$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$list = array();

$sql = " select *
            $sql_common
            $sql_order
            limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 순차적인 번호 (순번)
    $num = $total_count - ($page - 1) * $rows - $i;

    // 게시판 제목
    /* $sql2 = " select bo_subject from {$g5['board_table']} where bo_table = '{$row['bo_table']}' ";
    $row2 = sql_fetch($sql2);
    if (!$row2['bo_subject']) $row2['bo_subject'] = '[게시판 없음]'; */

    // 게시물 제목
    /* $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
    $sql3 = " select wr_subject from $tmp_write_table where wr_id = '{$row['wr_id']}' ";
    $row3 = sql_fetch($sql3, FALSE);
    $subject = get_text(cut_str($row3['wr_subject'], 100));
    if (!$row3['wr_subject'])
        $row3['wr_subject'] = '[글 없음]'; */

    $list[$i]['num'] = $num;
    /* $list[$i]['opener_href'] = get_pretty_url($row['bo_table']);
    $list[$i]['opener_href_wr_id'] = get_pretty_url($row['bo_table'], $row['wr_id']);
    $list[$i]['bo_subject'] = $row2['bo_subject'];
    $list[$i]['subject'] = $subject;
    $list[$i]['del_href'] = './scrap_delete.php?ms_id='.$row['ms_id'].'&amp;page='.$page; */
}

$mypost_skin_path = get_skin_path('member', $config['cf_member_skin']);
$mypost_skin_url  = get_skin_url('member', $config['cf_member_skin']);
$skin_file = $mypost_skin_path.'/mypost.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once('./_tail.php');
?>

