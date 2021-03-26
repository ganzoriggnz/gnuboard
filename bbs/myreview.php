<?php
include_once('./_common.php');

$g5['title'] = '후기보기';
include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

/* $g5['title'] = get_text($member['mb_nick']).'님의 스크랩'; */
include_once(G5_PATH.'/head.sub.php');

//  if($member['mb_id']){
//     global $g5;
//     $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
    
//     $list = array();
//     for($i=0; $row=sql_fetch_array($result); $i++)
//     {
//       $bo_table = $row['bo_table'];

//       $result1 = sql_query("select * from ".$g5['write_prefix'].$bo_table. " where mb_id = '{$member['mb_id']}'");
//       if($result1){
//           for($j=0;$row1 = sql_fetch_array($result1); $j++){
//             array[i][j]=$row1;
//           }
        
//       }
      
//     } 
// }  


$myreview_skin_path = get_skin_path('member', $config['cf_member_skin']);
$myreview_skin_url  = get_skin_url('member', $config['cf_member_skin']);
$skin_file = $myreview_skin_path.'/myreview.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once('./_tail.php');
?>
