<?php 
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//include_once('../common.php');
// 기간에 따라 레벨이 변경
   
function check_member_period($st_date, $et_date, $mb_id, $wrpost, $wrcomment, $reviewpost, $bonuspoint){
    
    global $g5, $member;

    $strDate = date("Y-m-d"); //현재요일
    $countpost = 0;
    $countcomment1 = 0;
    $countcomment2 = 0;
    $countreview =0;
    if($strDate > $st_date && $strDate > $et_date) {
      
        // 다른 게시글 , 댓글 수 구하기
        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='community'");
        while ( $row=sql_fetch_array($result))
        {
            $res1 = sql_query("select wr_is_comment from ".$g5['write_prefix'].$row['bo_table']." where mb_id='{$member['mb_id']}'"); 
           while( $res = sql_fetch_array($res1))
           {
                if($res['wr_is_comment'] == 0){
                $countpost ++;
              
            }
         
            else 
            $countcomment1 ++;
            
           }
        }
                // 후기 게시글 수 구하기
        $resultre = sql_query("select bo_table from {$g5['board_table']} where gr_id='review'");
        while ( $row1=sql_fetch_array($resultre))
        {
            $resre = sql_query("select wr_is_comment from " . $g5['write_prefix'] . $row1['bo_table'] . " where mb_id='{$member['mb_id']}'");
            while ($resrev = sql_fetch_array($resre)) {
                if ($resrev['wr_is_comment'] == 0) {
                    $countreview++;
                  }
                  else 
                  $countcomment2 ++;
            }
        }
        $countcomment = $countcomment1 + $countcomment2;
    
           
            if ($countpost >= $wrpost && $countcomment >= $wrcomment && $countreview >= $reviewpost) {
                echo $member['mb_level'];
                $mb_level = $member['mb_level'] + 1;
                $sql = "update {$g5['member_table']} set mb_level = '{$mb_level}' where mb_id = '{$mb_id}'";
                sql_query($sql);
                if ($member['mb_level'] >= 18){
                    insert_point($member['mb_id'],  $bonuspoint,"레벨 등업 축하파운드", '', '' , "레벨 등업 축하파운드");
                }
                alert("축하합니다" .$member['mb_nick']."님 등업원료되었습니다.");
               

            } else {
            
                $mb_level = $member['mb_level'];
                $sql = "update {$g5['member_table']} set mb_level =  '{$mb_level}' where mb_id = '{$mb_id}'";
                sql_query($sql);

                 }
  
     }
}


if($is_member && !$is_admin && $member['mb_level'] < 22){ //회원이고 , 23레벨 이하, 관리자가 아닐경우에만 실행
   
    $st_date = date('Y-m-d', strtotime($member['mb_datetime']));   // 가입한 날짜 시간 배고
   
    if ($member['mb_level'] == 2){
        $et_date = date('Y-m-d', strtotime($st_date. ' + 3 days'));   // 가입한 후 3 일 뒤
        $wrpost = 1;
        $wrcomment = 1;
        $reviewpost = 0;}
    else if ($member['mb_level'] == 3){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  7 days')); 
        $wrpost = 2;
        $wrcomment = 2;
        $reviewpost = 0; }
    else if ($member['mb_level'] == 4){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  15 days')); 
        $wrpost = 10;
        $wrcomment = 30;
        $reviewpost = 1;}
    else if ($member['mb_level'] == 5){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  30 days'));
        $wrpost = 15;
        $wrcomment = 50;
        $reviewpost = 3; }
    else if ($member['mb_level'] == 6){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  50 days')); 
        $wrpost = 20;
        $wrcomment = 100;
        $reviewpost = 5;}
    else if ($member['mb_level'] == 7){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  70 days'));  
        $wrpost = 30;
        $wrcomment = 150;
        $reviewpost = 7;}
    else if ($member['mb_level'] == 8){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  100 days')); 
        $wrpost = 50;
        $wrcomment = 200;
        $reviewpost = 10;}
    else if ($member['mb_level'] == 9){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  150 days')); 
        $wrpost = 70;
        $wrcomment = 250;
        $reviewpost = 15;}
    else if ($member['mb_level'] == 10){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  200 days')); 
        $wrpost = 100;
        $wrcomment = 300;
        $reviewpost = 20;}
    else if ($member['mb_level'] == 11){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  250 days'));  
        $wrpost = 150;
        $wrcomment = 400;
        $reviewpost = 30;}
    else if ($member['mb_level'] == 12){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  300 days')); 
        $wrpost = 200;
        $wrcomment = 500;
        $reviewpost = 40;}
    else if ($member['mb_level'] == 13){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  350 days')); 
        $wrpost = 250;
        $wrcomment = 600;
        $reviewpost = 50;}
    else if ($member['mb_level'] == 14){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  400 days')); 
        $wrpost = 300;
        $wrcomment = 700;
        $reviewpost = 60;}
    else if ($member['mb_level'] == 15){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  450 days'));  
        $wrpost = 350;
        $wrcomment = 800;
        $reviewpost = 70;}
    else if ($member['mb_level'] == 16){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  500 days')); 
        $wrpost = 400;
        $wrcomment = 900;
        $reviewpost = 80;}
    else if ($member['mb_level'] == 17){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  600 days')); 
        $wrpost = 450;
        $wrcomment = 1000;
        $reviewpost = 90;}
    else if ($member['mb_level'] == 18){
    //    user11 deer test hiihiin tuld medeelel buruu oruulsan bgaa test duusaad butsaaj zasah 
        $et_date = date('Y-m-d', strtotime($st_date. ' +  7 days')); 
        $wrpost = 1;
        $wrcomment = 4;
        $reviewpost = 1;
        $bonuspoint = 100000;}
    else if ($member['mb_level'] == 19){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  800 days'));  
        $wrpost = 600;
        $wrcomment = 1500;
        $reviewpost = 120;
        $bonuspoint = 200000;}
    else if ($member['mb_level'] == 20){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  900 days')); 
        $wrpost = 700;
        $wrcomment = 1700;
        $reviewpost = 140;
        $bonuspoint = 300000;}
    else if ($member['mb_level'] == 21){
        $et_date = date('Y-m-d', strtotime($st_date. ' +  1000 days')); 
        $wrpost = 800;
        $wrcomment = 2000;
        $reviewpost = 160;
        $bonuspoint = 500000;}
    

    
    
    check_member_period($st_date, $et_date, $member['mb_id'], $wrpost, $wrcomment, $reviewpost, $bonuspoint);
}

?>