<?php 
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//include_once('../../common.php');
// 기간에 따라 레벨이 변경

include_once('./_common.php');
$levpoint;
function getlevelPoint($lv){
    $q = "SELECT lev_point FROM `g5_lev_point` 
            WHERE lev_no = {$lv}";
            $row = sql_fetch($q);
            return $row['lev_point'];
}
   
function check_member_period($st_date, $et_date, $et_date2, $mb_id, $wrpost2, $wrcomment2, $reviewpost2, $levpoint, $wrpost, $reviewpost, $wrcomment, $point, $point2){
   
    global $g5, $member;
    $strDate = date("Y-m-d"); //현재요일
    $countpost = 0;
    $countcomment = 0;
    $countreview =0;
        
        // 다른 게시글 , 댓글 수 구하기
        $result = sql_query("select bo_table from {$g5['board_table']} ");
        while ( $row=sql_fetch_array($result))
        {
            $res1 = sql_query("select wr_is_comment from ".$g5['write_prefix'].$row['bo_table']." where mb_id='{$mb_id}'"); 
            
           while( $res = sql_fetch_array($res1))
           {
                if($res['wr_is_comment'] == 0){
                $countpost ++;
            }         
            else 
            $countcomment ++;
           }
        }
                // 후기 게시글 수 구하기
        $resultre = sql_query("select bo_table from {$g5['board_table']} where gr_id='review'");
        while ( $row1=sql_fetch_array($resultre))
        {
            $resre = sql_fetch("select Count(wr_is_comment) as wr_cnt from " . $g5['write_prefix'] . $row1['bo_table'] . " where wr_is_comment = '0' and mb_id='{$mb_id}'");
            $countreview += $resre['wr_cnt'];                
        }

        if ($countpost >= $wrpost2 && $countcomment >= $wrcomment2 && $countreview >= $reviewpost2 && $member['mb_point'] >= $point2 && $strDate >= $et_date2 && $member['mb_level'] < 23)  {
            $mb_level = $member['mb_level'] + 1;
            $sql = "update {$g5['member_table']} set mb_level = '{$mb_level}' where mb_id = '{$mb_id}'";
            sql_query($sql);
            insert_point($member['mb_id'], $levpoint, "등업 축하파운드",'','', "level change");
            alert("축하합니다. ".number_format($member['mb_level']+1)."레벨로 등업이 완료 되었습니다.");            
        } else if(($countpost < $wrpost || $countcomment < $wrcomment || $countreview < $reviewpost || $member['mb_point'] < $point) && $member['mb_level'] > 2) {
            $mb_level = $member['mb_level'] - 1;
            $sql = "update {$g5['member_table']} set mb_level =  '{$mb_level}' where mb_id = '{$mb_id}'";
            sql_query($sql);
            alert("안타깝게도 등급이 ".number_format($member['mb_level']-1)."레벨로 하향 되었습니다.");
        }          
}

if($is_member && !$is_admin && $member['mb_level'] < 23){ //회원이고 , 23레벨 이하, 관리자가 아닐경우에만 실행
    
    $st_date = date('Y-m-d', strtotime($member['mb_datetime']));   // 가입한 날짜 시간 배고

    if ($member['mb_level'] == 2){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 0 days'));   // 가입한 후 3 일 뒤
        $point = 0;
        $reviewpost = 0;
        $wrpost = 0;
        $wrcomment = 0;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' + 0 days'));
        $point2 = 100;
        $reviewpost2 = 0; 
        $wrpost2 = 1;
        $wrcomment2 = 3;
        $levpoint = getlevelPoint('2');
    }
    if ($member['mb_level'] == 3){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 0 days'));   // 가입한 후 3 일 뒤
        $point = 100;
        $reviewpost = 0;
        $wrpost = 1;
        $wrcomment = 3;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  1 days'));
        $point2 = 300;
        $reviewpost2 = 0; 
        $wrpost2 = 3;
        $wrcomment2 = 5;
        $levpoint = getlevelPoint('3');
    }
    else if ($member['mb_level'] == 4){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  1 days')); 
        $point = 300;
        $reviewpost = 0; 
        $wrpost = 3;
        $wrcomment = 5;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  7 days')); 
        $point2 = 1000;
        $reviewpost2 = 0;
        $wrpost2 = 5;
        $wrcomment2 = 10;
        $levpoint = getlevelPoint('4'); }
    else if ($member['mb_level'] == 5){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  7 days')); 
        $point = 1000;
        $reviewpost = 0;
        $wrpost = 5;
        $wrcomment = 10;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  15 days'));
        $point2 = 2000;
        $reviewpost2 = 1; 
        $wrpost2 = 10;
        $wrcomment2 = 30;
        $levpoint = getlevelPoint('5');}
    else if ($member['mb_level'] == 6){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  15 days'));
        $point = 2000;
        $reviewpost = 1; 
        $wrpost = 10;
        $wrcomment = 30;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  30 days'));
        $point2 = 3000;
        $reviewpost2 = 3;
        $wrpost2 = 15;
        $wrcomment2 = 50;
        $levpoint = getlevelPoint('6'); 
    }
    else if ($member['mb_level'] == 7){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  30 days')); 
        $point = 3000;
        $reviewpost = 3;
        $wrpost = 15;
        $wrcomment = 50;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  50 days'));
        $point2 = 5000;
        $reviewpost2 = 5;
        $wrpost2 = 20;
        $wrcomment2 = 100;
        $levpoint = getlevelPoint('7'); }
    else if ($member['mb_level'] == 8){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  50 days'));  
        $point = 5000;
        $reviewpost = 5;
        $wrpost = 20;
        $wrcomment = 100;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  70 days'));
        $point2 = 7000;
        $reviewpost2 = 7;
        $wrpost2 = 30;
        $wrcomment2 = 200;
        $levpoint = getlevelPoint('8'); }
    else if ($member['mb_level'] == 9){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  70 days')); 
        $point = 7000;
        $reviewpost = 7;
        $wrpost = 30;
        $wrcomment = 200;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  100 days'));
        $point2 = 10000;
        $reviewpost2 = 10;
        $wrpost2 = 50;
        $wrcomment2 = 300;
        $levpoint = getlevelPoint('9'); }
    else if ($member['mb_level'] == 10){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  100 days')); 
        $point = 10000;
        $reviewpost = 10;
        $wrpost = 50;
        $wrcomment = 300;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  150 days'));
        $point2 = 20000;
        $reviewpost2 = 20;
        $wrpost2 = 100;
        $wrcomment2 = 400;
        $levpoint = getlevelPoint('10'); }
    else if ($member['mb_level'] == 11){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  150 days')); 
        $point = 20000;
        $reviewpost = 20;
        $wrpost = 100;
        $wrcomment = 400;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  200 days'));
        $point2 = 30000;
        $reviewpost2 = 30;
        $wrpost2 = 150;
        $wrcomment2 = 500;
        $levpoint = getlevelPoint('11'); }
    else if ($member['mb_level'] == 12){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  200 days'));  
        $point = 30000;
        $reviewpost = 30;
        $wrpost = 150;
        $wrcomment = 500;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  250 days'));
        $point2 = 50000;
        $reviewpost2 = 50;
        $wrpost2 = 200;
        $wrcomment2 = 600;
        $levpoint = getlevelPoint('12'); }
    else if ($member['mb_level'] == 13){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  250 days')); 
        $point = 50000;
        $reviewpost = 50;
        $wrpost = 200;
        $wrcomment = 600;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  300 days'));
        $point2 = 70000;
        $reviewpost2 = 70;
        $wrpost2 = 250;
        $wrcomment2 = 700;
        $levpoint = getlevelPoint('13'); }
    else if ($member['mb_level'] == 14){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  300 days')); 
        $point = 70000;
        $reviewpost = 70;
        $wrpost = 250;
        $wrcomment = 700;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  350 days'));
        $point2 = 100000;
        $reviewpost2 = 80;
        $wrpost2 = 300;
        $wrcomment2 = 800;
        $levpoint = getlevelPoint('14'); }
    else if ($member['mb_level'] == 15){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  350 days')); 
        $point = 100000;
        $reviewpost = 80;
        $wrpost = 300;
        $wrcomment = 800;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  400 days'));
        $point2 = 200000;
        $reviewpost2 = 100;
        $wrpost2 = 350;
        $wrcomment2 = 1000;
        $levpoint = getlevelPoint('15'); }
    else if ($member['mb_level'] == 16){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  400 days'));  
        $point = 200000;
        $reviewpost = 100;
        $wrpost = 350;
        $wrcomment = 1000;
        $point2 = 300000;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  450 days'));
        $point2 = 300000;
        $reviewpost2 = 120;
        $wrpost2 = 400;
        $wrcomment2 = 1500;
        $levpoint = getlevelPoint('16'); }
    else if ($member['mb_level'] == 17){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  450 days')); 
        $point = 300000;
        $reviewpost = 120;
        $wrpost = 400;
        $wrcomment = 1500;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  500 days'));
        $point2 = 400000;
        $reviewpost2 = 150;
        $wrpost2 = 450;
        $wrcomment2 = 2000;
        $levpoint = getlevelPoint('17'); }
    else if ($member['mb_level'] == 18){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  500 days')); 
        $point = 400000;
        $reviewpost = 150;
        $wrpost = 450;
        $wrcomment = 2000;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  600 days'));
        $point2 = 600000;
        $reviewpost2 = 200;
        $wrpost2 = 500;
        $wrcomment2 = 2500;
        $levpoint = getlevelPoint('18'); }
    else if ($member['mb_level'] == 19){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  600 days')); 
        $point = 600000;
        $reviewpost = 200;
        $wrpost = 500;
        $wrcomment = 2500;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' + 700days'));
        $point2 = 800000;
        $reviewpost2 =250;
        $wrpost2 = 600;
        $wrcomment2 =3000;
        $levpoint = getlevelPoint('19'); }
    else if ($member['mb_level'] == 20){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 700days'));  
        $point = 800000;
        $reviewpost =250;
        $wrpost = 600;
        $wrcomment =3000;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' + 800days')); 
        $point2 = 1000000;
        $reviewpost2 =300;
        $wrpost2 = 700;
        $wrcomment2 =3500;
        $levpoint = getlevelPoint('20'); }
    else if ($member['mb_level'] == 21){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 800days'));  
        $point = 1000000;
        $reviewpost =300;
        $wrpost = 700;
        $wrcomment =3500;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  900 days'));
        $point2 = 1500000;
        $reviewpost2 = 400;
        $wrpost2 = 800;
        $wrcomment2 = 4000;
        $levpoint = getlevelPoint('21'); }
    else if ($member['mb_level'] == 22){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  900 days')); 
        $point = 1500000;
        $reviewpost = 400;
        $wrpost = 800;
        $wrcomment = 4000;
        $et_date2 = date('Y-m-d', strtotime($st_date. ' +  1000 days'));
        $point2 = 2000000;
        $reviewpost2 = 500;
        $wrpost2 = 1000;
        $wrcomment2 = 5000;
        $levpoint = getlevelPoint('22'); }
    else if ($member['mb_level'] == 23){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  1000 days')); 
        $point = 2000000;
        $reviewpost = 500;
        $wrpost = 1000;
        $wrcomment = 5000;
        $point2 = 2000000;
        $levpoint = getlevelPoint('23'); }
    
    check_member_period($st_date, $et_date, $et_date2, $member['mb_id'], $wrpost2, $wrcomment2, $reviewpost2, $levpoint, $wrpost, $reviewpost, $wrcomment, $point, $point2);
}

?>