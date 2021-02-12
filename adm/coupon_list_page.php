<?php

$sub_menu = "700100";
include_once('./_common.php');

$user_entity;
$cnt=0;
$alert_nick;
$altcnt=0;
$del_nick;
$delcnt=0;

//auth_check($auth[$sub_menu], 'r'); 

if( isset($_POST['id'])){ 
    $bo_table = $_POST['id'];

    $re_table = $g5['write_prefix'].$bo_table;
    $linkcount = strlen($re_table) - 2;
    $str_table =substr($re_table, 0, $linkcount);
    $at_table = $str_table."at";
}

    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table = "CREATE TABLE {$g5['coupon_table']} (   
            co_no int(11) NOT NULL AUTO_INCREMENT,         
            mb_id varchar(20) NOT NULL DEFAULT '',
            bo_table varchar(20) NOT NULL DEFAULT '',
            co_entity varchar(20) NOT NULL DEFAULT '',
            co_sale_num int(11) NOT NULL DEFAULT '0',
            co_free_num int(11) NOT NULL DEFAULT '0',
            co_sent_snum int(11) NOT NULL DEFAULT '0',
            co_sent_fnum int(11) NOT NULL DEFAULT '0',
            co_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            co_updated_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            co_begin_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            co_end_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (co_no), 
            INDEX (mb_id, bo_table, co_entity)
        )";
    
       sql_query($sql_table, false);
    } 
    
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_sent_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table1 = "CREATE TABLE {$g5['coupon_sent_table']} (
            cos_no int(11) NOT NULL AUTO_INCREMENT,
            co_no int(11) NOT NULL,   
            cos_code varchar(4) NOT NULL, 
            cos_entity varchar(20) NOT NULL DEFAULT '',        
            cos_nick varchar(20) NOT NULL DEFAULT '',
            cos_type varchar(1) NOT NULL DEFAULT '',
            cos_accept varchar(1) NOT NULL DEFAULT 'N',
            cos_alt_quantity int(11) NOT NULL DEFAULT '0',
            cos_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            cos_accepted_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            cos_post_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            UNIQUE (cos_code),
            PRIMARY KEY (cos_no),
            INDEX (cos_code, cos_entity, cos_nick),
            FOREIGN KEY (co_no) 
                REFERENCES $g5[coupon_table](co_no) 
                ON DELETE CASCADE
        )";
    
       sql_query($sql_table1, false);
    }  
    
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_alert_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table2 = "CREATE TABLE {$g5['coupon_alert_table']} (
            alt_no int(11) NOT NULL AUTO_INCREMENT, 
            cos_no int(11) NOT NULL DEFAULT '0',
            cos_nick varchar(20) NOT NULL DEFAULT '',
            cos_entity varchar(20) NOT NULL DEFAULT '',             
            cos_alt_quantity int(11) NOT NULL DEFAULT '0',
            alt_reason varchar(20) NOT NULL DEFAULT '',
            alt_created_by varchar(20) NOT NULL DEFAULT '',
            alt_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (alt_no),
            INDEX (cos_nick, cos_entity)
        )";
    
       sql_query($sql_table2, false);
    } 
    
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_msg_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table3 = "CREATE TABLE {$g5['coupon_msg_table']} (
            msg_no int(11) NOT NULL AUTO_INCREMENT, 
            msg_customer_text text(255) NOT NULL DEFAULT '',  
            msg_entity_text text(255) NOT NULL DEFAULT '',           
            msg_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (msg_no),
            INDEX (msg_created_datetime)
        )";
    
       sql_query($sql_table3, false);
    }   
    
    $now = G5_TIME_YMDHIS;
    $currentyear = substr($now, 0, 4);
    $currentmonth = substr($now, 5, 2);
    $co_start = date_create($now);
    $co_insert_date = date_format($co_start, 'Y-m-05 23:59:59');
    $co_send_date = date_format($co_start, 'Y-m-06 00:00:00');
    $co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
    
    if($currentmonth == '01')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '02')
    $co_end_datetime = 
        ($currentyear % 4 ? date_format($co_start, 'Y-m-28 23:59:59') : 
        ($currentyear % 100 ? date_format($co_start, 'Y-m-29 23:59:59') : 
        ($currentyear % 400 ? date_format($co_start, 'Y-m-28 23:59:59') : 
        date_format($co_start, 'Y-m-29 23:59:59'))));
    else if($currentmonth == '03')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '04')
    $co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '05')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '06')
    $co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '07')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '08')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '09')
    $co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '10')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '11')
    $co_end_datetime = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '12')
    $co_end_datetime = date_format($co_start, 'Y-m-31 23:59:59');
    

    $result1 = "SELECT co_begin_datetime FROM {$g5['coupon_table']} WHERE co_begin_datetime='$co_begin_datetime' AND co_end_datetime='$co_end_datetime'";
    $sql = sql_fetch($result1);
    $date = $sql['co_begin_datetime'];
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);

    $result = "SELECT COUNT(a.co_no) as cnt FROM {$g5['coupon_table']} a INNER JOIN $at_table b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}'"; 
    $row=sql_fetch($result);
    $total_count = $row['cnt'];

    $rows = $config['cf_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $list = array();

    $sql = "SELECT * FROM {$g5['coupon_table']} a INNER JOIN $at_table b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}' limit $from_record, $rows ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;

        // 순차적인 번호 (순번)
        $num = $total_count - ($page - 1) * $rows - $i;
    }

    $sql1 = "SELECT a.cos_nick FROM {$g5['coupon_sent_table']} a INNER JOIN $re_table b ON a.cos_entity = b.wr_7 WHERE cos_accept = 'Y'";
    $res1 = sql_query($sql1);
    $nicks = array();
    while($row = sql_fetch_array($res1)){
        $nicks[] = $row['cos_nick'];
    }
    $sep_nicks = '"' . implode('", "', $nicks) . '"';

    $rs = "SELECT wr_name FROM $re_table WHERE wr_comment = 0";

    $sql2 = "Select a.*, b.wr_id, b.wr_7, b.wr_is_comment, b.wr_datetime from {$g5['coupon_sent_table']} a LEFT JOIN $re_table b ON a.cos_nick = b.wr_name WHERE a.cos_accept = 'Y'";
    $res2 = sql_query($sql2);
   
    while($row2 = sql_fetch_array($res2)){
        $sql3 = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}'";
        $res3 = sql_fetch($sql3);
        $sql4 = "SELECT COUNT(alt_no) as alt_cnt FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
        $res4 = sql_fetch($sql4); 
        $sql7 = "SELECT * FROM $re_table WHERE wr_name = '{$row2['cos_nick']}' AND wr_7 = '{$row2['cos_entity']}'";
        $res7 = sql_fetch($sql7);    
        if($row2['cos_entity'] !== $res7['wr_7'] && $res4['alt_cnt'] == '0' && ($now > $row2['cos_post_datetime'])){
            $sql4 = "INSERT INTO {$g5['coupon_alert_table']} 
                            SET cos_no = '{$row2['cos_no']}',
                                cos_nick = '{$row2['cos_nick']}',
                                cos_entity = '{$row2['cos_entity']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$row2['cos_post_datetime']}' ";

                sql_query($sql4);

                $sql5 = "UPDATE {$g5['coupon_sent_table']} 
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
                sql_query($sql5);          
        } 
    } 

    $sql_acc = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='N'";

    $res_acc = sql_query($sql_acc);
    while($row_acc = sql_fetch_array($res_acc)){
        $date = date($row_acc['cos_created_datetime']);
        $finish_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));
        if($now >= $finish_date){
            $sql_ac = "DELETE FROM {$g5['coupon_sent_table']} WHERE cos_nick = '{$row_acc['cos_nick']}' AND cos_no = '{$row_acc['cos_no']}'";
            sql_query($sql_ac);

            if($row_acc['cos_type'] == 'S'){
                $sql1 = " UPDATE {$g5['coupon_table']}
                        SET co_sent_snum = co_sent_snum - 1
                        WHERE co_no = '{$row_acc['co_no']}' "; 
                sql_query($sql1);
            } else if($row_acc['cos_type'] == 'F') {
                $sql1 = " UPDATE {$g5['coupon_table']}
                        SET co_sent_fnum = co_sent_fnum - 1
                        WHERE co_no = '{$row_acc['co_no']}' "; 
                sql_query($sql1);
            }
        }
    }

    $coupon_create_action_url = G5_ADMIN_URL.'/coupon_create_form.php';
    $coupon_sent_action_url = G5_ADMIN_URL.'/coupon_sent_form.php';
    $coupon_alert_action_url = G5_ADMIN_URL.'/coupon_alert_form.php';
    $coupon_delete_action_url = G5_ADMIN_URL.'/coupon_delete_form.php';

    $q = "SELECT bo_subject FROM $g5[board_table] WHERE bo_table = '{$bo_table}'";
    $q1 = sql_fetch($q); ?>
        <div><h3 style="text-align: center; font-size: 14px;"><?php echo "쿠폰지원목록 (".$q1['bo_subject'].")"; ?> </h3></div>
        <div class="tbl_head01 tbl_wrap" style="margin-top: 20px;">
            <table>
                <thead>
                    <tr>
                        <th scope="col">업소명</th>
                        <th scope="col">원가권 쿠폰 개수</th>
                        <th scope="col">무료권 쿠폰 개수</th>
                        <th scope="col">쿠폰 받은사람</th>
                    </tr>
                </thead>
            <tbody>
        <?php     
        $result = "SELECT a.*, c.mb_level FROM {$g5['coupon_table']} a INNER JOIN $at_table b ON a.mb_id = b.mb_id INNER JOIN {$g5['member_table']} c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime='{$co_end_datetime}' AND c.mb_level = '27'"; 
        $result1=sql_query($result);

        while ($row = sql_fetch_array($result1)) {     
        ?>
            <tr>
                <td class="td_left" style="text-align: left; width: 7rem;">
                    <a data-toggle="modal" data-target="#couponCreate<?php echo $cnt;?>" href="#couponCreate<?php echo $cnt;?>" style="color:blue; font-weight: bold;" class="coupon-create" data-link="<?php echo $bo_table;?>">
                        <?php echo "[".$row['co_entity']."]";
                        $user_entity[$cnt]['co_entity']= $row['co_entity'];
                        ?> 
                    </a>
                    <div class="modal fade" id="couponCreate<?php echo $cnt;?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="width: 350px; height: 340px; font-weight: bold;">
                                <?php   
                                    $sql2 = "SELECT a.co_entity, b.mb_id, b.mb_name, b.mb_6 FROM {$g5['coupon_table']} a INNER JOIN {$g5['member_table']} b ON a.mb_id = b.mb_id WHERE a.co_entity = '{$user_entity[$cnt]['co_entity']}'";
                                    $row2 = sql_fetch($sql2);                      
                                    $sql3 = "SELECT * FROM {$g5['coupon_table']} WHERE co_entity = '{$user_entity[$cnt]['co_entity']}' AND co_begin_datetime='$co_begin_datetime' AND co_end_datetime='$co_end_datetime'";
                                    $row3 = sql_fetch($sql3); 
                                    
                                    $diff_s = number_format($row3['co_sale_num'] - $row3['co_sent_snum']);
                                    $diff_f = number_format($row3['co_free_num'] - $row3['co_sent_fnum']); 
                                ?>
                                    <div class="modal-header" style="height: 45px; border-bottom: none;">
                                        <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰주기</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 	
                                    <div class="modal-body" style="text-align: left; font-weight: normal;">
                                        <form id="fcouponcreate<?php echo $cnt;?>" name="fcouponcreate" action="<?php echo $coupon_create_action_url; ?>" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="co_no" id="co_no" value="<?php echo $row3['co_no']; ?>">
                                            <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $row2['mb_id']; ?>">
                                            <input type="hidden" name="mb_6" id="mb_6" value="<?php echo $row2['mb_6']; ?>">
                                            <input type="hidden" name="cos_link" id="cos_link" value="<?php echo $bo_table; ?>">
                                            <div style="margin-left: 10px;"><?php echo $year."년 ".$month."월";?></div>
                                            <div style="margin-left: 10px;margin-top: 5px;"><?php echo "업소명 :";?>
                                                <input type="text" name="cos_entity" id="cos_entity" value="<?php echo $row3['co_entity']; ?>" style="border:none; outline: none; width: 100px; font-size: 12px;">							
                                            </div>
                                            <div class="coupon_info">
                                                <p style="text-align: center;">지원 설정</p>
                                                <div class="p-20">
                                                    <div class="coupon_label">원가권 :</div>
                                                    <input type="number" name="co_sale_num" value="<?php echo $row3['co_sale_num']; ?>" placeholder="" class="coupon_input" style="padding-left: 14px;">
                                                </div>
                                                <div class="p-20">
                                                    <div class="coupon_label">무료권 :</div>
                                                    <input type="number" name="co_free_num" value="<?php echo $row3['co_free_num']; ?>" placeholder="" class="coupon_input" style="padding-left: 14px;">
                                                </div>
                                            </div>
                                            <div class="coupon_current">
                                                <p>현재 잔여갯수</p>
                                                <div class="coupon_div">
                                                    <p class="count"><?php echo $diff_s; ?></p>
                                                </div>
                                                <div class="coupon_div">
                                                    <p class="count"><span><?php echo $diff_f; ?></p>	
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer" style="border-top: none; margin: 0px auto 10px auto;">           
                                        <button type="button" id="<?php echo $cnt; ?>" accesskey="s" style="width: 150px;" class="btn btn_01">저장</button>                              
                                    </div>                                
                            </div>
                        </div>
                    </div>       
                </td>
                
                <td class="td_left">
                    <a data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_sale_num']-$row['co_sent_snum']) == '0' || $co_send_date > $now) { echo 'style="font-weight: bold;"'; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;"';}  ?>>
                        <?php echo "원가권 ".number_format($row['co_sale_num']-$row['co_sent_snum'])."개";?>
                    </a>
                </td> 
                
                <td class="td_left">
                    <a data-type = "F" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_free_num']-$row['co_sent_fnum']) == '0' || $co_send_date > $now){ echo 'style="font-weight: bold;"'; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal" style="color:blue; font-weight: bold;"';} ?>>
                        <?php echo "무료권 ".number_format($row['co_free_num']-$row['co_sent_fnum'])."개";?>
                    </a>
                </td>
                
                <td class="td_left"> 
                    <ul id="userlist">
                    <?php $sql = "SELECT a.*, b.* FROM {$g5['coupon_table']} a RIGHT OUTER JOIN {$g5['coupon_sent_table']} b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$co_begin_datetime}' AND a.co_end_datetime ='{$co_end_datetime}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
                    $sql1 = sql_query($sql);
                    while ($row1 = sql_fetch_array($sql1)){
                        $alert_nick[$altcnt]['alt_nick'] = $row1['cos_nick'];
                        $delete_nick[$delcnt]['del_nick']= $row1['cos_nick'];
                        if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') 
                        { echo '<li><a data-toggle="modal"
                            data-target="#couponDelete'.$delcnt.'"  
                            href="#couponDelete'.$delcnt.'" 
                            class="coupon-delete" 
                            data-type ='.$row1['cos_type']." 
                            data-code = ".$row1['cos_code']." 
                            data-entity = ".$row1['cos_entity']."
                            data-nick = ".$row1['cos_nick']."  
                            data-no = ".$row1['cos_no']." 
                            data-co-no = ".$row1['co_no']." 
                            data-link = ".$bo_table.'>';
                            if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];
                            if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; 
                            echo '</a>'; ?>
                            <div class="modal fade" id="couponDelete<?php echo $delcnt; ?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 350px; height: 250px;">
                                        <form id="fcoupondelete<?php echo $delcnt; ?>" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="modal-header" style="border-bottom: none;">
                                                <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰회수</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div> 	
                                            <div class="modal-body" style="padding: 30px 0px; font-size: 14px;">
                                                <input type="hidden" name = "w" value ="d">
                                                <input type="hidden" name="co_no" id="co_no_d" value="<?php echo $row1['co_no']; ?>">
                                                <input type="hidden" name="cos_no" id="cos_no_d" value="<?php echo $row1['cos_no']; ?>">
                                                <input type="hidden" name="cos_type" id="cos_type_d" value="<?php echo $row1['cos_type']; ?>">
                                                <input type="hidden" name="cos_link" id="cos_link_d" value="<?php echo $bo_table; ?>">                           
                                                <input type="hidden" name="cos_entity" id="cos_entity_d" value="<?php echo $row1['cos_entity']; ?>">
                                                <input type="hidden" name="cos_nick" id="cos_nick_d" value="<?php echo $row1['cos_nick']; ?>">
                                                <input type="hidden" name="cos_code" id="cos_code_d" value="<?php echo $row1['cos_code']; ?>">
                                                <div style="text-align: center; line-height: 2;"><?php echo "[".$row1['cos_entity']."]"." ".$row1['cos_nick']." 회원 </br> 쿠폰을 회수하시겠습니까?" ?></div>					
                                            </div>
                                            <div class="modal-footer" style="border-top: none;">
                                                <div style="margin: 0 auto; text-align: center;">
                                                    <button type="submit" accesskey="s" class="btn btn_01" style="width: 150px;">확인</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                         } else if($row1['cos_accept'] == 'Y' && $row1['cos_alt_quantity'] == '0') { 
                            echo '<li><a href="#" style="color:blue;" data-type ='.$row1['cos_type']." 
                            data-code = ". $row1['cos_code']." data-no = ".$row1['cos_no']." 
                            data-co-no = "; ?><?php echo $row1['co_no']." data-link = ". $bo_table.'>';
                            if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];
                            if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></a></li><?php 
                        }
                              
                            else if($row1['cos_alt_quantity'] > 0) { 
                                echo '<li><a data-toggle="modal" data-target="#couponAlert'.$altcnt.'" href="#couponAlert'.$altcnt.'" 
                                data-class="coupon-alert" style="color:red;" data-link = '.$bo_table.'>';
                                $sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row1['cos_nick']}'"; 
                                $row4 = sql_fetch($sql4);  
                                $res = "SELECT * FROM {$g5['coupon_alert_table']} WHERE alt_created_datetime = '{$row4['maxdate']}' ";
                                $res1 = sql_fetch($res);
                                if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'].'('.$res1['cos_alt_quantity'].')';
                                if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick'].'('.$res1['cos_alt_quantity'].')'; ?></a>

                                <div class="modal fade" id="couponAlert<?php echo $altcnt; ?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 650px; height: 400px;">
                                            <div class="modal-header" style="border-bottom: none;">
                                                <h5 class="modal-title" style="margin-left: 250px; font-weight: bold; font-size: 14px;">경고 횟수 변경 및 기록</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div> 	
                                            <div class="modal-body" style="padding: 5px 0px;">
                                                <?php 
                                                    $sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row1['cos_nick']}'"; 
                                                    $row4 = sql_fetch($sql4);  
                                                    $res = "SELECT * FROM {$g5['coupon_alert_table']} WHERE alt_created_datetime = '{$row4['maxdate']}' ";
                                                    $res1 = sql_fetch($res);
                                                ?> 
                                                <div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
                                                <div style="margin-left: 30px; margin-top: 5px;"><?php echo "현재 경고횟수 : ".$res1['cos_alt_quantity'];?>
                                                <form id="fcouponalert<?php echo $altcnt; ?>" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <input type="hidden" name="cos_nick" id="cos_nick" value="<?php echo $row1['cos_nick'];?>">
                                                    <input type="hidden" name="cos_entity" id="cos_entity" value="<?php echo $row1['cos_entity'];?>">
                                                    <input type="hidden" name="cos_link" id="cos_link" value="<?php echo $bo_table; ?>">
                                                    <div style="margin-left:30px; margin-top: 30px;">
                                                        <p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
                                                        <input type="number" name="cos_alt_quantity" id="cos_alt_quantity" class="form-control" style="background: #EFEFEF; width: 60px; height: 30px; display: inline-block; text-align: center; margin-left: 30px; padding-left:25px; font-size: 12px;" value = "<?php echo $res1['cos_alt_quantity']; ?>"/>		
                                                        <input type="submit" name="change" id="change" value="확인" class="btn btn_03" style="width: 80px; height: 30px;"/>
                                                    </div>
                                                </form>
                                                <div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
                                                <div style="margin: 10px 10px 10px 0px;">
                                                    <table class="alert-table">
                                                        <thead class="alert-thead">
                                                            <tr class="alert-tr">
                                                                <th class="col-xs-3 alert-th">시간</th>
                                                                <th class="col-xs-2 alert-th">업소명</th>
                                                                <th class="col-xs-3 alert-th">경고내용</th>
                                                                <th class="col-xs-2 alert-th">최종적용 아이디</th>
                                                                <th class="col-xs-2 alert-th">누적횟수</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="alert-tbody">
                                                        <?php $sql = "SELECT * FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$res1['cos_nick']}' ORDER BY alt_created_datetime";
                                                        $res = sql_query($sql);
                                                        for($i=0; $row = sql_fetch_array($res); $i++) { ?>
                                                            <tr class="alert-tr">
                                                                <td class="col-xs-3 alert-td"><?php echo $row['alt_created_datetime']; ?></td>
                                                                <td class="col-xs-2 alert-td"><?php echo $row['cos_entity']; ?></td>
                                                                <td class="col-xs-3 alert-td"><?php echo $row['alt_reason']; ?></td>
                                                                <td class="col-xs-2 alert-td"><?php echo $row['alt_created_by']; ?></td>
                                                                <td class="col-xs-2 alert-td"><?php echo $row['cos_alt_quantity']; ?></td>
                                                            </tr>
                                                        <?php
                                                        } ?>
                                                        </tbody>
                                                    </table>
                                                </div>					
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                            </li> 
                            <?php } 					                               
                        $altcnt++;
                        $delcnt++;
                    }
                    ?> 
                    </ul>
                </td>               
            </tr>                        
        <?php $cnt++; } 
        if ($cnt == 0) { 
            echo '<tr><td colspan="4" class="empty_table">자료가 없습니다.</td></tr>';
        } ?>
    </tbody>
    </table>
</div>
        <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 350px; height: 300px;">                  
                        <div class="modal-header" style="height: 45px; border-bottom: none;">
                            <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰주기</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body">
                            <form id="fcouponsend" name="fcouponsend" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="co_no" id="co_no" value="">
                                <input type="hidden" name="mb_id" id="mb_id" value="">
                                <input type="hidden" name="cos_type" id="cos_type" value="">
                                <input type="hidden" name="cos_link" id="cos_link" value="">
                                <div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
                                <div style="margin-left: 30px;"><?php echo "업소명 :";?>
                                    <input type="text" name="cos_entity" id="cos_entity" value="" style="border:none; outline: none; width: 100px; font-size: 12px;">							
                                </div>
                                <div style="margin-top: 20px; margin-left:120px;">받는사람 닉네임</div>		
                                <div style="margin-left:30px; margin-top:10px;">
                                    <input type="text" name="cos_nick" id="mb_nick" class="form-control" style="background: #dcdcdc; display:inline; width: 160px; height: 30px;"/>		
                                    <input type="button" name="check_id" id="check_id" value="닉네임 확인" class="btn btn_02" style="display:inline; width: 100px;"/>
                                </div>
                                <div id="result" style="margin-left:30px; margin-top: 10px;">
                                </div>
                            </form>			
                        </div>
                        <div class="modal-footer" style="border-top: none;">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" id="btn_send" accesskey="s" class="btn btn_01" style="width: 150px;">보내기</button>
                            </div>
                        </div>        
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 350px; height: 220px;">
                    <form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header" style="border-bottom: none;">
                            <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰회수</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body" style="padding: 40px 0px; font-size: 14px;">
                            <input type="hidden" name = "w" value ="d">
                            <input type="hidden" name="co_no" id="co_no" value="">
                            <input type="hidden" name="cos_no" id="cos_no" value="">
                            <input type="hidden" name="cos_type" id="cos_type" value="">
                            <input type="hidden" name="cos_link" id="cos_link" value="">
                            <input type="hidden" name="cos_code" id="cos_code" value="">
                            <div style="margin-left:100px;">쿠폰을 회수하시겠습니까?</div>					
                        </div>
                        <div class="modal-footer" style="border-top: none;">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn btn_01" style="width: 150px;">확인</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="<?php echo NA_URL ?>/app/bs4/js/bootstrap.bundle.min.js"></script>
        <script> 
 
       $('button').click(function(){
            var formId = "#fcouponcreate" + this.id;
            $(formId).submit();                 
        });    

        $('#btn_send').click(function(){
            if($('#hasNick').val() != '정상적인 닉네임입니다.'){ 
                alert("닉네임을 입력하시고 확인후 쿠폰 지원할 수 있습니다!");
                $('#mb_nick').focus();
            }  
            if ($('#hasNick').val() == '정상적인 닉네임입니다.'){
                $('#fcouponsend').submit(); 
            }                  
        });   

        function fcoupondelete_submit(f) {
            return true;                                                                 
        }  

        $(document).ready(function(){
            $('#check_id').click(function(e){
                e.preventDefault();
                var mb_nick = $('#mb_nick').val();
                $.ajax({
                    type: 'POST',
                    url: 'check_id.php',
                    data: {
                        'check_id': 1,
                        'mb_nick': mb_nick,
                    },
                    dataType: 'text',
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
            });

            $('body').on('click', '.coupon-modal', function() {
                var cos_type = $(this).data('type');
                var cos_entity = $(this).data('entity');
                var co_no = $(this).data('no');
                var mb_id = $(this).data('mb-id');
                var cos_link = $(this).data('link');
                $('.modal-body #cos_type').val(cos_type);
                $('.modal-body #cos_entity').val(cos_entity);
                $('.modal-body #co_no').val(co_no);
                $('.modal-body #mb_id').val(mb_id);
                $('.modal-body #cos_link').val(cos_link);
            }); 

            $('body').on('click', '.coupon-delete', function() {
                var co_no = $(this).data('co-no');	
                var cos_no = $(this).data('no');
                var cos_type = $(this).data('type');
                var cos_code = $(this).data('code');
                var cos_link = $(this).data('link');
                $('.modal-body #co_no').val(co_no);
                $('.modal-body #cos_no').val(cos_no);
                $('.modal-body #cos_type').val(cos_type);		
                $('.modal-body #cos_code').val(cos_code);
                $('.modal-body #cos_link').val(cos_link);
            }); 

        });
        </script>
