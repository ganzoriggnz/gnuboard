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

$total_count;
$page=1;
$list = Array();
$cnt=0;
            $result = sql_query("select a.bo_table, a.bo_subject, b.gr_subject  from {$g5['board_table']} a INNER JOIN {$g5['group_table']} b  on a.gr_id = b.gr_id ");        
            
            while ($row = sql_fetch_array($result)) {
                // echo $row['bo_subject'];
                $bo_table = $row['bo_table'];
                $bo_subject = $row['bo_subject'];
                $gr_subject = $row['gr_subject'];

                if(($member['mb_level']==27 && substr($bo_table, -2)=="at") || ($member['mb_level']==26 && substr($bo_table, -2)=="at")){

                    $sql = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '0'  order by wr_datetime");                    
                    while($resee = sql_fetch_array($sql)){                       
                        $list[$cnt] = $res;
                        $list[$cnt]['wr_id'] = $res['wr_id'];
                        $list[$cnt]['bo_table'] = $bo_table; 
                        $list[$cnt]['bo_subject'] = $bo_subject;
                        $list[$cnt]['gr_subject'] = $row['gr_subject']; 
                        $list[$cnt]['wr_subject'] = $resee['wr_subject'];
                        $list[$cnt]['wr_datetime'] = $resee['wr_datetime'];
                        $cnt++;
                        $parent =$resee['wr_parent'];
                        $sql = sql_query("select * from " .$g5['write_prefix'].$bo_table." where wr_parent ='{$parent}' and wr_is_comment = '1' order by wr_datetime");                 
                        while($res = sql_fetch_array($sql)){                    
                            $list[$cnt] = $res;
                            $list[$cnt]['wr_id'] = $res['wr_id']; 
                            $list[$cnt]['bo_table'] = $bo_table; 
                            $list[$cnt]['bo_subject'] = $bo_subject;
                            $list[$cnt]['gr_subject'] = $row['gr_subject'];
                            $list[$cnt]['wr_subject'] = "댓글 - ".$res['wr_subject'];
                            $cnt++;
                        }                                     
                    }                    
                }else if ($member['mb_level']<26 || $member['mb_level']==30) {
                    $sql = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' order by wr_datetime");
                    while($res = sql_fetch_array($sql)){
                        $list[$cnt] = $res;
                        $list[$cnt]['wr_id'] = $res['wr_id']; 
                        $list[$cnt]['bo_table'] = $bo_table; 
                        $list[$cnt]['bo_subject'] = $bo_subject;
                        $list[$cnt]['wr_subject'] = $res['wr_subject'];
                        $list[$cnt]['gr_subject'] = $gr_subject; 
                        $cnt++;                    
                    }
                }                          

               
            }
$total_count = $cnt;

// datetime sort function 
usort($list, function($a, $b) {return new DateTime($b['wr_datetime']) <=> new DateTime($a['wr_datetime']);});

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
