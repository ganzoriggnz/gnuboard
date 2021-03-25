<?php 
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//include_once('../../common.php');
// 기간에 따라 레벨이 변경

$levpoint;
function getlevelPoint($lv){
    $q = "SELECT lev_point FROM `g5_lev_point` 
            WHERE lev_no = {$lv}";
            $row = sql_fetch($q);
            return $row['lev_point'];
}
   
function check_member_period($st_date, $et_date, $mb_id, $wrpost, $wrcomment, $reviewpost, $levpoint, $wrpost1, $reviewpost1, $wrcomment1, $point, $point2){
   
    global $g5, $member;
    $strDate = date("Y-m-d"); //현재요일
    $countpost = 0;
    $countcomment = 0;
    $countreview =0;
    if($strDate > $st_date && $strDate > $et_date) {
        
        // 다른 게시글 , 댓글 수 구하기
        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='community'");
        while ( $row=sql_fetch_array($result))
        {
            $res1 = sql_query("select wr_is_comment from ".$g5['write_prefix'].$row['bo_table']." where mb_id='$mb_id'"); 
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
            $resre = sql_fetch("select Count(wr_is_comment) as wr_cnt from " . $g5['write_prefix'] . $row1['bo_table'] . " where wr_is_comment = '0' and mb_id='$mb_id'");
            $countreview += $resre['wr_cnt'];                
        }      

        if ($countpost >= $wrpost && $countcomment >= $wrcomment && $countreview >= $reviewpost && $member['mb_point'] >= $point2)  {
            if($member['mb_level'] < 22)
            $mb_level = $member['mb_level'] + 1;
            else $mb_level = $member['mb_level'];
            $sql = "update {$g5['member_table']} set mb_level = '{$mb_level}' where mb_id = '{$mb_id}'";
            sql_query($sql);
            insert_point($member['mb_id'], $levpoint, "등업 축하파운드",'','', "level change");
            alert("축하합니다" .$member['mb_nick']."님 등업원료되었습니다.");            
        } else if($countpost <= $wrpost1 && $countcomment <= $wrcomment1 && $countreview <= $reviewpost1 && $member['mb_point'] < $point) {
            $mb_level = $member['mb_level'] - 1;
            $sql = "update {$g5['member_table']} set mb_level =  '{$mb_level}' where mb_id = '{$mb_id}'";
            sql_query($sql);
        }          
     }
}

if($is_member && !$is_admin && $member['mb_level'] < 22){ //회원이고 , 23레벨 이하, 관리자가 아닐경우에만 실행
    
    $st_date = date('Y-m-d', strtotime($member['mb_datetime']));   // 가입한 날짜 시간 배고

   
    if ($member['mb_level'] == 2){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 0 days'));   // 가입한 후 3 일 뒤
        $point = 0;
        $reviewpost = 0;
        $wrpost = 0;
        $wrcomment = 0;
        $levpoint = getlevelPoint('2');
    }
    else if ($member['mb_level'] == 3){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  3 days')); 
        $point = 300;
        $reviewpost = 0; 
        $wrpost = 1;
        $wrcomment = 5;
        $point2 = 1000;
        $reviewpost1 = 0;
        $wrpost1 = 0;
        $wrcomment1 = 0;
        $levpoint = getlevelPoint('3'); }
    else if ($member['mb_level'] == 4){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  7 days')); 
        $point = 1000;
        $reviewpost = 0;
        $wrpost = 5;
        $wrcomment = 10;
        $point2 = 3000;
        $reviewpost1 = 0; 
        $wrpost1 = 1;
        $wrcomment1 = 5;
        $levpoint = getlevelPoint('4');}
else if ($member['mb_level'] == 5){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  15 days'));
        $point = 3000;
        $reviewpost = 1; 
        $wrpost = 10;
        $wrcomment = 30;
        $point2 = 5000;
        $reviewpost1 = 0;
        $wrpost1 = 5;
        $wrcomment1 = 10;
       $levpoint = getlevelPoint('5'); 
    }
    else if ($member['mb_level'] == 6){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  30 days')); 
        $point = 5000;
        $reviewpost = 3;
        $wrpost = 15;
        $wrcomment = 50;
        $point2 = 7000;
        $reviewpost1 = 1; 
        $wrpost1 = 10;
        $wrcomment1 = 30;
        $levpoint = getlevelPoint('6'); }
    else if ($member['mb_level'] == 7){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  50 days'));  
        $point = 7000;
        $reviewpost = 5;
        $wrpost = 20;
        $wrcomment = 100;
        $point2 = 10000;
        $reviewpost1 = 3;
        $wrpost1 = 15;
        $wrcomment1 = 50;
        $levpoint = getlevelPoint('7'); }
    else if ($member['mb_level'] == 8){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  70 days')); 
        $point = 10000;
        $reviewpost = 7;
        $wrpost = 30;
        $wrcomment = 200;
        $point2 = 15000;
        $reviewpost1 = 5;
        $wrpost1 = 20;
        $wrcomment1 = 100;
        $levpoint = getlevelPoint('8'); }
    else if ($member['mb_level'] == 9){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  100 days')); 
        $point = 15000;
        $reviewpost = 10;
        $wrpost = 50;
        $wrcomment = 300;
        $point2 = 20000;
        $reviewpost1 = 7;
        $wrpost1 = 30;
        $wrcomment1 = 200;
        $levpoint = getlevelPoint('9'); }
    else if ($member['mb_level'] == 10){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  150 days')); 
        $point = 20000;
        $reviewpost = 20;
        $wrpost = 100;
        $wrcomment = 400;
        $point2 = 30000;
        $reviewpost1 = 10;
        $wrpost1 = 50;
        $wrcomment1 = 300;
        $levpoint = getlevelPoint('10'); }
    else if ($member['mb_level'] == 11){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  200 days'));  
        $point = 30000;
        $reviewpost = 30;
        $wrpost = 150;
        $wrcomment = 500;
        $point2 = 50000;
        $reviewpost1 = 20;
        $wrpost1 = 100;
        $wrcomment1 = 400;
        $levpoint = getlevelPoint('11'); }
    else if ($member['mb_level'] == 12){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  250 days')); 
        $point = 50000;
        $reviewpost = 50;
        $wrpost = 200;
        $wrcomment = 600;
        $point2 = 70000;
        $reviewpost1 = 30;
        $wrpost1 = 150;
        $wrcomment1 = 500;
        $levpoint = getlevelPoint('12'); }
    else if ($member['mb_level'] == 13){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  300 days')); 
        $point = 70000;
        $reviewpost = 70;
        $wrpost = 250;
        $wrcomment = 700;
        $point2 = 100000;
        $reviewpost1 = 50;
        $wrpost1 = 200;
        $wrcomment1 = 600;
        $levpoint = getlevelPoint('13'); }
    else if ($member['mb_level'] == 14){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  350 days')); 
        $point = 100000;
        $reviewpost = 80;
        $wrpost = 300;
        $wrcomment = 800;
        $point2 = 200000;
        $reviewpost1 = 70;
        $wrpost1 = 250;
        $wrcomment1 = 700;
        $levpoint = getlevelPoint('14'); }
    else if ($member['mb_level'] == 15){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  400 days'));  
        $point = 200000;
        $reviewpost = 100;
        $wrpost = 350;
        $wrcomment = 1000;
        $point2 = 300000;
        $reviewpost1 = 80;
        $wrpost1 = 300;
        $wrcomment1 = 800;
        $levpoint = getlevelPoint('15'); }
    else if ($member['mb_level'] == 16){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  450 days')); 
        $point = 300000;
        $reviewpost = 120;
        $wrpost = 400;
        $wrcomment = 1500;
        $point2 = 500000;
        $reviewpost1 = 100;
        $wrpost1 = 350;
        $wrcomment1 = 1000;
        $levpoint1 = getlevelPoint('16'); }
    else if ($member['mb_level'] == 17){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  500 days')); 
        $point = 500000;
        $reviewpost = 150;
        $wrpost = 450;
        $wrcomment = 2000;
        $point2 = 700000;
        $reviewpost1 = 120;
        $wrpost1 = 400;
        $wrcomment1 = 1500;
        $levpoint = getlevelPoint('17'); }
    else if ($member['mb_level'] == 18){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  600 days')); 
        $point = 700000;
        $reviewpost = 200;
        $wrpost = 500;
        $wrcomment = 2500;
        $point2 = 1000000;
        $reviewpost1 = 150;
        $wrpost1 = 450;
        $wrcomment1 = 2000;
        $levpoint = getlevelPoint('18'); }
    else if ($member['mb_level'] == 19){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 700days'));  
        $point = 1000000;
        $reviewpost =250;
        $wrpost = 600;
        $wrcomment =3000;
        $point2 = 1500000;
        $reviewpost1 = 200;
        $wrpost1 = 500;
        $wrcomment1 = 2500;
        $levpoint = getlevelPoint('19'); }
    else if ($member['mb_level'] == 20){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 700days'));  
        $point = 1500000;
        $reviewpost =300;
        $wrpost = 700;
        $wrcomment =3500;
        $point2 = 2000000;
        $reviewpost1 =250;
        $wrpost1 = 600;
        $wrcomment1 =3000;
        $levpoint = getlevelPoint('20'); }
    else if ($member['mb_level'] == 21){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  900 days')); 
        $point = 2000000;
        $reviewpost = 400;
        $wrpost = 800;
        $wrcomment = 4000;
        $point2 = 3000000;
        $reviewpost1 =300;
        $wrpost1 = 700;
        $wrcomment1 =3500;
        $levpoint = getlevelPoint('21'); }
    else if ($member['mb_level'] == 22){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  1000 days')); 
        $point = 3000000;
        $reviewpost = 500;
        $wrpost = 1000;
        $wrcomment = 5000;
        $point2 = 3000000;
        $reviewpost1 = 400;
        $wrpost1 = 800;
        $wrcomment1 = 4000;
        $levpoint = getlevelPoint('22'); }
    
    check_member_period($st_date, $et_date, $member['mb_id'], $wrpost, $wrcomment, $reviewpost, $levpoint, $wrpost1, $reviewpost1, $wrcomment1, $point, $point2);
}

?>