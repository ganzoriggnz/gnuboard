<?php

$sub_menu = "700100";
include_once('./_common.php');

$user_entity;
$cnt=0;
$alert_nick;
$altcnt=0;

auth_check($auth[$sub_menu], 'r'); ?>

<<<<<<< HEAD
<style>
    .active {color:red;}

    table, th, td {border: 1px solid black; text-align: center;}
</style>
=======
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
<?php
if( isset($_POST['id'])){ 
    $bo_table = $_POST['id'];
}

    $g5['table_prefix']        = "g5_"; // 테이블명 접두사
<<<<<<< HEAD
    $g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
    $g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블
    $g5['coupon_alert_table'] = $g5['table_prefix'] . "coupon_alert";    // 쿠폰 alert 테이블
=======
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    $g5['write_prefix']        = "g5_write_";
    $g5['bo_table'] = $g5['write_prefix'] . $bo_table;


<<<<<<< HEAD
    if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[coupon_table]",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table = "CREATE TABLE $g5[coupon_table] (   
=======
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table = "CREATE TABLE {$g5['coupon_table']} (   
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
            co_no int(11) NOT NULL AUTO_INCREMENT,         
            mb_id varchar(20) NOT NULL DEFAULT '',
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
            INDEX (mb_id, co_entity)
        )";
    
       sql_query($sql_table, false);
    } 
    
<<<<<<< HEAD
    if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[coupon_sent_table]",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table1 = "CREATE TABLE $g5[coupon_sent_table] (
=======
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_sent_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table1 = "CREATE TABLE {$g5['coupon_sent_table']} (
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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
    
<<<<<<< HEAD
    if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[coupon_alert_table]",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table2 = "CREATE TABLE $g5[coupon_alert_table] (
=======
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_alert_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table2 = "CREATE TABLE {$g5['coupon_alert_table']} (
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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
    
<<<<<<< HEAD
    if (!sql_query("SELECT COUNT(*) as cnt FROM $g5[coupon_msg_table]",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table3 = "CREATE TABLE $g5[coupon_msg_table] (
=======
    if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_msg_table']}",false)) { // 쿠폰 테이블이 없다면 생성
        $sql_table3 = "CREATE TABLE {$g5['coupon_msg_table']} (
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
            msg_no int(11) NOT NULL AUTO_INCREMENT, 
            msg_customer_text text(255) NOT NULL DEFAULT '',  
            msg_entity_text text(255) NOT NULL DEFAULT '',           
            msg_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (msg_no),
            INDEX (msg_created_datetime)
        )";
    
       sql_query($sql_table3, false);
    }   
    
    $co_created_datetime = G5_TIME_YMDHIS;
    $currentmonth = substr($co_created_datetime, 5, 2);
    $co_start = date_create($co_created_datetime);
    $s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');
    
    $date = date('Y-m-01');
    $newdate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($date)));
    $final = date_create($newdate);
    $nextmonth = substr($newdate, 5, 2);
    $co_begin_datetime = $newdate;
    
    if($currentmonth == '01')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '02')
    $s_end_date = date_format($co_start, 'Y-m-28 23:59:59');
    else if($currentmonth == '03')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '04')
    $s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '05')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '06')
    $s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '07')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '08')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '09')
    $s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '10')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    else if($currentmonth == '11')
    $s_end_date = date_format($co_start, 'Y-m-30 23:59:59');
    else if($currentmonth == '12')
    $s_end_date = date_format($co_start, 'Y-m-31 23:59:59');
    
    if($nextmonth == '01')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '02')
    $co_end_datetime = date_format($final, 'Y-m-28 23:59:59');
    else if($nextmonth == '03')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '04')
    $co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
    else if($nextmonth == '05')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '06')
    $co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
    else if($nextmonth == '07')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '08')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '09')
    $co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
    else if($nextmonth == '10')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');
    else if($nextmonth == '11')
    $co_end_datetime = date_format($final, 'Y-m-30 23:59:59');
    else if($nextmonth == '12')
    $co_end_datetime = date_format($final, 'Y-m-31 23:59:59');

<<<<<<< HEAD
    $result1 = "SELECT co_begin_datetime FROM $g5[coupon_table] WHERE co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
=======
    $result1 = "SELECT co_begin_datetime FROM {$g5['coupon_table']} WHERE co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    $sql = sql_fetch($result1);
    $date = $sql['co_begin_datetime'];
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);

<<<<<<< HEAD
    $result = "SELECT COUNT(a.co_no) as cnt FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}'"; 
=======
    $result = "SELECT COUNT(a.co_no) as cnt FROM {$g5['coupon_table']} a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}'"; 
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    $row=sql_fetch($result);
    $total_count = $row['cnt'];

    $rows = $config['cf_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $list = array();

<<<<<<< HEAD
    $sql = "SELECT * FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' limit $from_record, $rows ";
=======
    $sql = "SELECT * FROM {$g5['coupon_table']} a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' limit $from_record, $rows ";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;

        // 순차적인 번호 (순번)
        $num = $total_count - ($page - 1) * $rows - $i;
    }

    $at_table = $g5['write_table'].$bo_table;
    $linkcount = strlen($bo_table) - 2;
    $str_table =substr($bo_table, 0, $linkcount);
    $re_table = "g5_write_".$str_table."re";

<<<<<<< HEAD
    $sql1 = "SELECT a.cos_nick FROM $g5[coupon_sent_table] a INNER JOIN $re_table b ON a.cos_entity = b.wr_7 WHERE cos_accept = 'Y'";
=======
    $sql1 = "SELECT a.cos_nick FROM {$g5['coupon_sent_table']} a INNER JOIN $re_table b ON a.cos_entity = b.wr_7 WHERE cos_accept = 'Y'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
    $res1 = sql_query($sql1);
    $nicks = array();
    while($row = sql_fetch_array($res1)){
        $nicks[] = $row['cos_nick'];
    }
    $sep_nicks = '"' . implode('", "', $nicks) . '"';

    $rs = "SELECT wr_name FROM $re_table WHERE wr_comment = 0";

<<<<<<< HEAD
    $sql2 = "Select a.*, b.wr_id, b.wr_7, b.wr_is_comment, b.wr_datetime from $g5[coupon_sent_table] a LEFT JOIN $re_table b ON a.cos_nick = b.wr_name WHERE a.cos_accept = 'Y'";
    $res2 = sql_query($sql2);
    while($row2 = sql_fetch_array($res2)){
        $sql3 = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}'";
        $res3 = sql_fetch($sql3);
        $sql4 = "SELECT COUNT(alt_no) as alt_cnt FROM $g5[coupon_alert_table] WHERE cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
=======
    $sql2 = "Select a.*, b.wr_id, b.wr_7, b.wr_is_comment, b.wr_datetime from {$g5['coupon_sent_table']} a LEFT JOIN $re_table b ON a.cos_nick = b.wr_name WHERE a.cos_accept = 'Y'";
    $res2 = sql_query($sql2);
    while($row2 = sql_fetch_array($res2)){
        $sql3 = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}'";
        $res3 = sql_fetch($sql3);
        $sql4 = "SELECT COUNT(alt_no) as alt_cnt FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
        $res4 = sql_fetch($sql4); 
        $sql7 = "SELECT * FROM $re_table WHERE wr_name = '{$row2['cos_nick']}' AND wr_7 = '{$row2['cos_entity']}'";
        $res7 = sql_fetch($sql7);
        $now = G5_TIME_YMDHIS;
        if($row2['cos_entity'] !== $res7['wr_7'] && $res4['alt_cnt'] == '0' && ($now > $row2['cos_post_datetime'])){
<<<<<<< HEAD
            $sql4 = "INSERT INTO $g5[coupon_alert_table] 
=======
            $sql4 = "INSERT INTO {$g5['coupon_alert_table']} 
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                            SET cos_no = '{$row2['cos_no']}',
                                cos_nick = '{$row2['cos_nick']}',
                                cos_entity = '{$row2['cos_entity']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$row2['cos_post_datetime']}' ";

                sql_query($sql4);

<<<<<<< HEAD
                $sql5 = "UPDATE $g5[coupon_sent_table] 
=======
                $sql5 = "UPDATE {$g5['coupon_sent_table']} 
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
                sql_query($sql5);          
        } 
    } 

<<<<<<< HEAD
    $sql_acc = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_accept='N'";
=======
    $sql_acc = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='N'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b

    $res_acc = sql_query($sql_acc);
    while($row_acc = sql_fetch_array($res_acc)){
        $date = date($row_acc['cos_created_datetime']);
        $finish_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));
        if($now >= $finish_date){
<<<<<<< HEAD
            $sql_ac = "DELETE FROM $g5[coupon_sent_table] WHERE cos_nick = '{$row_acc['cos_nick']}' AND cos_no = '{$row_acc['cos_no']}'";
            sql_query($sql_ac);

            if($row_acc['cos_type'] == 'S'){
                $sql1 = " UPDATE $g5[coupon_table]
=======
            $sql_ac = "DELETE FROM {$g5['coupon_sent_table']} WHERE cos_nick = '{$row_acc['cos_nick']}' AND cos_no = '{$row_acc['cos_no']}'";
            sql_query($sql_ac);

            if($row_acc['cos_type'] == 'S'){
                $sql1 = " UPDATE {$g5['coupon_table']}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                        SET co_sent_snum = co_sent_snum - 1
                        WHERE co_no = '{$row_acc['co_no']}' "; 
                sql_query($sql1);
            } else if($row_acc['cos_type'] == 'F') {
<<<<<<< HEAD
                $sql1 = " UPDATE $g5[coupon_table]
=======
                $sql1 = " UPDATE {$g5['coupon_table']}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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

    ?>
    <?php $q = "SELECT bo_subject FROM $g5[board_table] WHERE bo_table = '{$bo_table}'";
    $q1 = sql_fetch($q); ?>
        <div><h3 style="text-align: center;"><?php echo "쿠폰지원목록 (".$q1['bo_subject'].")"; ?> </h3></div>
        <ul class="na-table d-table w-100 f-de" style="margin-top: 30px;">
        <?php     
<<<<<<< HEAD
        $result = "SELECT a.*, c.mb_level FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id INNER JOIN $g5[member_table] c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' AND c.mb_level = '27'"; 
        $result1=sql_query($result);
        while ($row = sql_fetch_array($result1)) {     
        ?>
            <li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted">	
=======
        $result = "SELECT a.*, c.mb_level FROM {$g5['coupon_table']} a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id INNER JOIN {$g5['member_table']} c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' AND c.mb_level = '27'"; 
        $result1=sql_query($result);
        while ($row = sql_fetch_array($result1)) {     
        ?>
            <li class="d-table-row px-3 py-2 p-md-0 text-center text-muted">	
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                <div class="d-none d-table-cell nw-9 f-sm font-weight-normal py-md-2 px-md-1 border-right">
                    <a data-toggle="modal" data-target="#couponCreate<?php echo $cnt;?>" href="#couponCreate<?php echo $cnt;?>" style="color:blue; font-weight: bold;" class="coupon-create" data-link="<?php echo $bo_table;?>">
                        <?php echo "[".$row['co_entity']."]";
                        $user_entity[$cnt]['co_entity']= $row['co_entity'];
                        ?> 
                    </a>
                </div>
                
                <div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1 text-center" style = "border-right: 0.5px solid blue;">
                    <a style="color:blue; font-weight: bold;" data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_sale_num']-$row['co_sent_snum']) == 0) { echo ''; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal"';}  ?>>
                        <?php echo "원가권 ".number_format($row['co_sale_num']-$row['co_sent_snum'])."개";?>
                    </a>
                </div> 
                <div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1 text-center" style = "border-right: 0.5px solid blue;">
                    <a style="color:blue; font-weight: bold;" data-type = "F" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_free_num']-$row['co_sent_fnum']) == 0){ echo ''; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal"';} ?>>
                        <?php echo "무료권 ".number_format($row['co_free_num']-$row['co_sent_fnum'])."개";?>
                    </a>
                </div>
                
               <div class="float-left float-md-none d-table-cell nw-30 nw-md-auto f-sm font-weight-normal pl-2 py-md-2 pr-md-1 text-left">
                    <?php echo "쿠폰 받은사람 :"; ?> 
                    <ul id="userlist">
<<<<<<< HEAD
                    <?php $sql = "SELECT a.*, b.* FROM $g5[coupon_table] a RIGHT OUTER JOIN $g5[coupon_sent_table] b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime ='{$s_end_date}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
                    $sql1 = sql_query($sql);
                    while ($row1 = sql_fetch_array($sql1)){
                    ?>
                        <?php $alert_nick[$altcnt]['alt_nick'] = $row1['cos_nick']; ?>

                        <?php if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') 
=======
                    <?php $sql = "SELECT a.*, b.* FROM {$g5['coupon_table']} a RIGHT OUTER JOIN {$g5['coupon_sent_table']} b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime ='{$s_end_date}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
                    $sql1 = sql_query($sql);
                    while ($row1 = sql_fetch_array($sql1)){
                        $alert_nick[$altcnt]['alt_nick'] = $row1['cos_nick'];
                        if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') 
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                        { echo '<li><a data-toggle="modal"
                            data-target="#couponDelete"  
                            href="#couponDelete" 
                            class="coupon-delete" 
                            data-type ='.$row1['cos_type']." 
                            data-code = ".$row1['cos_code']." 
                            data-no = ".$row1['cos_no']." 
                            data-co-no = ".$row1['co_no']." 
                            data-link = ".$bo_table.'>';
                            if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];
                            if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; 
                            echo '</a></li>';
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
<<<<<<< HEAD
                                if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')';
                                if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')'; ?></a>

                                <div class="modal fade" id="couponAlert<?php echo $altcnt; ?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 650px; height: 400px; font-weight: bold;">
                                            <div class="modal-header">
=======
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
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                                                <h5 class="modal-title" style="margin-left: 250px; font-weight: bold; font-size: 14px;">경고 횟수 변경 및 기록</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div> 	
<<<<<<< HEAD
                                            <div class="modal-body" style="padding: 5px 0px; font-size: 14px;">
                                                <?php 
                                                    $sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM `g5_coupon_alert` WHERE cos_nick = '{$row1['cos_nick']}'"; 
                                                    $row4 = sql_fetch($sql4);  
                                                    $res = "SELECT * FROM `g5_coupon_alert` WHERE alt_created_datetime = '{$row4['maxdate']}' ";
                                                    $res1 = sql_fetch($res);
                                                ?> 
                                                <div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
                                                <div style="margin-left: 30px;"><?php echo "현재 경고횟수 : ".$res1['cos_alt_quantity'];?>
                                                <form id="fcouponalert<?php echo $altcnt; ?>" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <input type="hidden" name="cos_nick" id="cos_nick" value="<?php echo $row1['cos_nick'];?>">
                                                    <input type="hidden" name="cos_entity" id="cos_entity" value="<?php echo $row1['cos_entity'];?>">
                                                    <input type="hidden" name="cos_link" id="cos_link" value="">
                                                    <div style="margin-left:30px; margin-top: 30px;">
                                                        <p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
                                                        <input type="number" name="cos_alt_quantity" id="cos_alt_quantity" style="background: #EFEFEF; width: 40px; text-align: center;" value = "<?php echo $res1['cos_alt_quantity']; ?>"/>		
                                                        <input type="submit" name="change" id="change" value="확인" style="background: #FFF2CC; width: 80px;"/>
=======
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
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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
<<<<<<< HEAD
                                                        <?php $sql = "SELECT * FROM `g5_coupon_alert` WHERE cos_nick = '{$res1['cos_nick']}' ORDER BY alt_created_datetime";
=======
                                                        <?php $sql = "SELECT * FROM {$g5['coupon_alert_table']} WHERE cos_nick = '{$res1['cos_nick']}' ORDER BY alt_created_datetime";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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
<<<<<<< HEAD
                            </li> <?php } ?>					 
                    
                                
                    <?php
                    $altcnt++;
=======
                            </li> 
                            <?php } 					                               
                        $altcnt++;
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                    }
                    ?> 
                    </ul>
                </div>
                <div class="modal fade" id="couponCreate<?php echo $cnt;?>" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
                    <div class="modal-dialog" role="document">
<<<<<<< HEAD
                        <div class="modal-content" style="width: 400px; height: 350px; font-weight: bold;">
                            <?php   
                                $sql2 = "SELECT a.co_entity, b.mb_id, b.mb_name FROM $g5[coupon_table] a INNER JOIN $g5[member_table] b ON a.mb_id = b.mb_id WHERE a.co_entity = '{$user_entity[$cnt]['co_entity']}'";
                                $row2 = sql_fetch($sql2);                      
                                $sql3 = "SELECT * FROM $g5[coupon_table] WHERE co_entity = '{$user_entity[$cnt]['co_entity']}' AND co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
=======
                        <div class="modal-content" style="width: 350px; height: 320px; font-weight: bold;">
                            <?php   
                                $sql2 = "SELECT a.co_entity, b.mb_id, b.mb_name FROM {$g5['coupon_table']} a INNER JOIN {$g5['member_table']} b ON a.mb_id = b.mb_id WHERE a.co_entity = '{$user_entity[$cnt]['co_entity']}'";
                                $row2 = sql_fetch($sql2);                      
                                $sql3 = "SELECT * FROM {$g5['coupon_table']} WHERE co_entity = '{$user_entity[$cnt]['co_entity']}' AND co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                                $row3 = sql_fetch($sql3); 
                                
                                $diff_s = number_format($row3['co_sale_num'] - $row3['co_sent_snum']);
                                $diff_f = number_format($row3['co_free_num'] - $row3['co_sent_fnum']); 
                            ?>
<<<<<<< HEAD
                            <form id="fcouponcreate<?php echo $cnt;?>" name="fcouponcreate" action="<?php echo $coupon_create_action_url; ?>" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
=======
                                <div class="modal-header" style="height: 45px; border-bottom: none;">
                                    <h3 class="modal-title" style="margin-left: 160px; font-weight: bold; font-size: 14px;">쿠폰주기</h3>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 	
<<<<<<< HEAD
                                <div class="modal-body">
                                    <input type="hidden" name="co_no" id="co_no" value="<?php echo $row3['co_no']; ?>">
                                    <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $row2['mb_id']; ?>">
                                    <input type="hidden" name="cos_link" id="cos_link" value="">
                                    <div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
                                    <div style="margin-left: 30px;"><?php echo "업소명 :";?>
                                        <input type="text" name="cos_entity" id="cos_entity" value="<?php echo $row3['co_entity']; ?>" style="border:none; outline: none; width: 100px; font-size: 12px; font-weight: bold;">							
                                    </div>
                                    <div class="coupon_info">
                                        <h6>지원 설정</h6>
                                        <div class="p-20">
                                            <div class="coupon_label">원가권 :</div>
                                            <input type="number" name="co_sale_num" value="<?php echo $row3['co_sale_num']; ?>" placeholder="" class="coupon_input" >
                                        </div>
                                        <div class="p-20">
                                            <div class="coupon_label">무료권 :</div>
                                            <input type="number" name="co_free_num" value="<?php echo $row3['co_free_num']; ?>" placeholder="" class="coupon_input">
                                        </div>
                                    </div>
                                    <div class="coupon_current">
                                        <h6>현재 잔여갯수</h6>
                                        <div class="coupon_div">
                                            <p class="count"><?php echo $diff_s; ?></p>
                                        </div>
                                        <div class="coupon_div">
                                            <p class="count"><span><?php echo $diff_f; ?></p>	
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div style="margin-left: 30px; margin: 120px auto; text-align: center;">
                                        <button type="button" id="<?php echo $cnt; ?>" accesskey="s" class="btn" style="background: #00FF00; width: 50px;">저장</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
=======
                                <div class="modal-body" style="text-align: left; font-weight: normal;">
                                    <form id="fcouponcreate<?php echo $cnt;?>" name="fcouponcreate" action="<?php echo $coupon_create_action_url; ?>" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" name="co_no" id="co_no" value="<?php echo $row3['co_no']; ?>">
                                        <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $row2['mb_id']; ?>">
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
           
                                        <button type="button" id="<?php echo $cnt; ?>" accesskey="s" class="btn btn_01" style="width: 150px;">저장</button>
                              
                                </div>
                            
                        </div>
                    </div>
                </div>       
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
            </li>                        
        <?php $cnt++; } ?>
        </ul>
        <?php if ($cnt == 0) { ?>
            <div class="f-de px-3 py-5 text-center text-muted border-bottom">
                자료가 없습니다.
            </div>
        <?php } ?>
    
        <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
<<<<<<< HEAD
                <div class="modal-content" style="width: 350px; height: 250px; font-weight: bold;">
                    <form id="fcouponsend" name="fcouponsend" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="return fcouponsend_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
=======
                <div class="modal-content" style="width: 350px; height: 300px;">                  
                        <div class="modal-header" style="height: 45px; border-bottom: none;">
                            <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰주기</h3>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body">
<<<<<<< HEAD
                            <input type="hidden" name="co_no" id="co_no" value="">
                            <input type="hidden" name="mb_id" id="mb_id" value="">
                            <input type="hidden" name="cos_type" id="cos_type" value="">
                            <input type="hidden" name="cos_link" id="cos_link" value="">
                            <div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
                            <div style="margin-left: 30px;"><?php echo "업소명 :";?>
                                <input type="text" name="cos_entity" id="cos_entity" value="" style="border:none; outline: none; width: 100px; font-size: 12px; font-weight: bold;">							
                            </div>
                            <div style="margin-left:120px;">받는사람 닉네임</div>		
                            <div style="margin-left:30px; margin-top:10px;">
                                <input type="text" name="cos_nick" id="mb_nick" style="background: #00FFFF; display:inline; width: 160px;"/>		
                                <input type="button" name="check_id" id="check_id" value="닉네임 확인" style="background: #6495ED; display:inline; width: 100px;"/>
                            </div>
                            <div id="result" style="margin-left:30px; margin-top: 10px;" >
                            </div>			
                        </div>
                        <div class="modal-footer">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px;">보내기</button>
                            </div>
                        </div>
                    </form>
=======
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
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
<<<<<<< HEAD
                <div class="modal-content" style="width: 350px; height: 220px; font-weight: bold;">
                    <form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰회수</h5>
=======
                <div class="modal-content" style="width: 350px; height: 220px;">
                    <form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header" style="border-bottom: none;">
                            <h3 class="modal-title" style="margin-left: 140px; font-weight: bold; font-size: 14px;">쿠폰회수</h3>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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
<<<<<<< HEAD
                        <div class="modal-footer">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px; font-size: 14px;">확인</button>
=======
                        <div class="modal-footer" style="border-top: none;">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn btn_01" style="width: 150px;">확인</button>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
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

<<<<<<< HEAD
        function fcouponsend_submit(f) {
            if(!f.cos_nick && $('#hasNick').length > 0 && $('#hasNick').val() == ''){ 
                alert("Please insert correct nick name!");
                f.cos_nick.focus();
                return false;
            }         
            return true;                                    
        }  
=======
        $('#btn_send').click(function(){
            if($('#mb_nick').length > 0 && $('#mb_nick').val() == ''){ 
                alert("닉네임을 입력하시고 확인후 쿠폰 지원할 수 있습니다!");
                $('#mb_nick').focus();
                return false;
            }  
            if($('#hasNick').length = 0 && $('#hasNick').val() == ''){ 
                alert("Please insert correct nick name!");
                $('#mb_nick').focus();
            } 
            if ($('#hasNick').length > 0 && $('#hasNick').val() != ''){
                $('#fcouponsend').submit(); 
            }                  
        });   
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b

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

<<<<<<< HEAD
            $('body').on('click', '.coupon-create', function() {
                var cos_link = $(this).data('link');
                $('.modal-body #cos_link').val(cos_link);
            });

            $('body').on('click', '.coupon-alert', function() {
                var cos_link = $(this).data('link');
                $('.modal-body #cos_link').val(cos_link);
            }); 
=======
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
        });
        </script>
