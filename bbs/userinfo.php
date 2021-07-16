<?php
include_once('./_common.php');

//dbconfig파일에 $g5['content_table'] 배열변수가 있는지 체크
if( !isset($g5['member_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->내용 관리를 먼저 확인해 주세요.');
}

// 내용

// if (G5_IS_MOBILE) {
//     include_once(G5_MOBILE_PATH.'/userinfo.php');
//     return;
// } 
$g5['title'] = '회원정보';
include_once('./_head.php');
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

/* $g5['title'] = get_text($member['mb_nick']).'님의 스크랩'; */
include_once(G5_PATH.'/head.sub.php');

if($member['mb_id']){
    global $g5;
    $sql = " select * from {$g5['member_table']} where mb_id = '{$member['mb_id']}'";
    $row = sql_fetch($sql); 

    $now = G5_TIME_YMDHIS;
    if($row['mb_4'] > '0000:00:00 00:00:00')
    $end_time = strtotime($row['mb_4']);
    $now_time = strtotime($now);
    if($end_time >= $now_time){
        $d1=new DateTime($row['mb_4']);
        $d2=new DateTime($now);
        $diff=$d2->diff($d1);

        if($diff->d == 0){
            if($diff->h != 0 || $diff->i != 0){
                $diff->d = 1;
            }else{
                $diff_days = '0';
            }
        }
        $diff_days = $diff->days;
    }
    else if($end_time < $now_time){
        $diff_days = '0';
    }

    $start_date = substr($row['mb_3'], 0, 10);
    $end_date = substr($row['mb_4'], 0, 10);

    $type = $row['mb_2'];
    $string = $row['mb_name'];
    $str_arr = explode ("-", $string);
    $today_login = $row['mb_today_login'];
    $entity_date =$row['mb_datetime'];

    $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");

    $total_count;
    $page=1;
    $list = Array();
    $cnt_post=0;
    $cnt_review=0;
    $cnt_other=0;
    $cnt_revcomment=0;
    $cnt_otcomment=0;
    $cnt_comment=0;

        $result1 = sql_query("select bo_table, bo_subject from {$g5['board_table']} WHERE gr_id = 'review'");        
        
        while ($row = sql_fetch_array($result1)) {
            $bo_table = $row['bo_table'];

                $sql1 = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '0'");                    
                while($resee = sql_fetch_array($sql1)){                       
                    $cnt_review++;
                }
                $sql_rev = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '1'");                 
                while($res = sql_fetch_array($sql_rev)){                    
                    $cnt_revcomment++;
                }                                                                            
        }

        $result2 = sql_query("select bo_table, bo_subject from {$g5['board_table']} WHERE gr_id != 'review'");        
        
        while ($row = sql_fetch_array($result2)) {
            $bo_table = $row['bo_table'];

                $sql2 = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '0'");                    
                while($resee = sql_fetch_array($sql2)){                       
                    $cnt_other++;
                }
                $sql_ot = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '1'");                 
                while($res = sql_fetch_array($sql_ot)){                    
                    $cnt_otcomment++;
                }                                     
        }

$cnt_comment = $cnt_revcomment+$cnt_otcomment;
    
}

$userinfo_skin_path = get_skin_path('member', $config['cf_member_skin']);
$userinfo_skin_url  = get_skin_url('member', $config['cf_member_skin']);
$skin_file = $userinfo_skin_path.'/userinfo.skin.php';

    include($skin_file);
    
    include_once('./_tail.php');
?>
