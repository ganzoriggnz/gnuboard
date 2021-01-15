<?php

$sub_menu = "700100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r'); ?>
<style>
    .active {color:red;}

    table, th, td {border: 1px solid black; text-align: center;}
</style>
<?php
if( isset($_POST['id'])){ 
    $bo_table = $_POST['id'];

    $g5['table_prefix']        = "g5_"; // 테이블명 접두사
    $g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블
    $g5['coupon_sent_table'] = $g5['table_prefix'] . "coupon_sent";    // 쿠폰 sent 테이블
    $g5['coupon_alert_table'] = $g5['table_prefix'] . "coupon_alert";    // 쿠폰 alert 테이블
    $g5['write_prefix']        = "g5_write_";
    $g5['bo_table'] = $g5['write_prefix'] . $bo_table;

    $co_created_datetime = G5_TIME_YMDHIS;
    $currentmonth = substr($co_created_datetime, 5, 2);
    $co_start = date_create($co_created_datetime);
    $s_begin_date = date_format($co_start, 'Y-m-01 00:00:00');

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

    $result1 = "SELECT co_begin_datetime FROM $g5[coupon_table] WHERE co_begin_datetime='$s_begin_date' AND co_end_datetime='$s_end_date'";
    $sql = sql_fetch($result1);
    $date = $sql['co_begin_datetime'];
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);

    $result = "SELECT COUNT(a.co_no) as cnt FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}'"; 
    $row=sql_fetch($result);
    $total_count = $row['cnt'];

    $rows = $config['cf_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $list = array();

    $sql = "SELECT * FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' limit $from_record, $rows ";
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

    $sql1 = "SELECT a.cos_nick FROM $g5[coupon_sent_table] a INNER JOIN $re_table b ON a.cos_entity = b.wr_7 WHERE cos_accept = 'Y'";
    $res1 = sql_query($sql1);
    $nicks = array();
    while($row = sql_fetch_array($res1)){
        $nicks[] = $row['cos_nick'];
    }
    $sep_nicks = '"' . implode('", "', $nicks) . '"';

    $rs = "SELECT wr_name FROM $re_table WHERE wr_comment = 0";

    $sql2 = "Select a.*, b.wr_id, b.wr_7, b.wr_is_comment, b.wr_datetime from $g5[coupon_sent_table] a LEFT JOIN $re_table b ON a.cos_nick = b.wr_name WHERE a.cos_accept = 'Y'";
    $res2 = sql_query($sql2);
    while($row2 = sql_fetch_array($res2)){
        $sql3 = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}'";
        $res3 = sql_fetch($sql3);
        $sql4 = "SELECT COUNT(alt_no) as alt_cnt FROM $g5[coupon_alert_table] WHERE cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
        $res4 = sql_fetch($sql4); 
        $sql7 = "SELECT * FROM $re_table WHERE wr_name = '{$row2['cos_nick']}' AND wr_7 = '{$row2['cos_entity']}'";
        $res7 = sql_fetch($sql7);
        $now = G5_TIME_YMDHIS;
        if($row2['cos_entity'] !== $res7['wr_7'] && $res4['alt_cnt'] == '0' && ($now > $row2['cos_post_datetime'])){
            $sql4 = "INSERT INTO $g5[coupon_alert_table] 
                            SET cos_no = '{$row2['cos_no']}',
                                cos_nick = '{$row2['cos_nick']}',
                                cos_entity = '{$row2['cos_entity']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$row2['cos_post_datetime']}' ";

                sql_query($sql4);

                $sql5 = "UPDATE $g5[coupon_sent_table] 
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
                sql_query($sql5);          
        } 
    /*  if($row2['wr_id'] && !$res4['alt_cnt'] == '0' && ($row2['wr_datetime'] > $res3['cos_post_datetime'])){
                $sql5 = "INSERT INTO $g5[coupon_alert_table] 
                            SET cos_nick = '{$row2['cos_nick']}',
                                cos_entity = '{$row2['cos_entity']}',
                                cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1,
                                alt_reason = '후기미작성7일',
                                alt_created_by = '-',
                                alt_created_datetime = '{$row2['cos_post_datetime']}' ";

                sql_query($sql5);

                $sql6 = "UPDATE $g5[coupon_sent_table] 
                            SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                            WHERE cos_accept='Y' AND cos_nick = '{$row2['cos_nick']}' AND cos_entity = '{$row2['cos_entity']}'";

                sql_query($sql6);                   
        }  */
    } 

    $sql_acc = "SELECT * FROM $g5[coupon_sent_table] WHERE cos_accept='N'";

    $res_acc = sql_query($sql_acc);
    while($row_acc = sql_fetch_array($res_acc)){
        $date = date($row_acc['cos_created_datetime']);
        $finish_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));
        if($now >= $finish_date){
            $sql_ac = "DELETE FROM $g5[coupon_sent_table] WHERE cos_nick = '{$row_acc['cos_nick']}' AND cos_no = '{$row_acc['cos_no']}'";
            sql_query($sql_ac);

            if($row_acc['cos_type'] == 'S'){
                $sql1 = " UPDATE $g5[coupon_table]
                        SET co_sent_snum = co_sent_snum - 1
                        WHERE co_no = '{$row_acc['co_no']}' "; 
                sql_query($sql1);
            } else if($row_acc['cos_type'] == 'F') {
                $sql1 = " UPDATE $g5[coupon_table]
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
        <ul class="na-table d-table w-100 f-de" style="margin-top: 10px;">
        <?php
        $result = "SELECT a.*, c.mb_level FROM $g5[coupon_table] a INNER JOIN $g5[bo_table] b ON a.mb_id = b.mb_id INNER JOIN $g5[member_table] c ON a.mb_id = c.mb_id WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime='{$s_end_date}' AND c.mb_level = '27'"; 
        $result1=sql_query($result);
        for ($i=0; $row = sql_fetch_array($result1); $i++) {
        ?>
            <li class="d-table-row px-3 py-2 p-md-0 text-md-center text-muted">	
                <div class="d-none d-table-cell nw-9 f-sm font-weight-normal py-md-2 px-md-1 border-right">
                    <a data-toggle="modal" href="#couponCreate" class="coupon-modal" style="color:blue; font-weight: bold;" data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>">
                        <?php echo "[".$row['co_entity']."]";?> 
                    </a>       
                </div> 
                <div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1" style = "border-right: 0.5px solid blue;">
                    <a style="color:blue; font-weight: bold;" data-type = "S" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_sale_num']-$row['co_sent_snum']) == 0) { echo ''; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal"';}  ?>>
                        <?php echo "원가권 ".number_format($row['co_sale_num']-$row['co_sent_snum'])."개";?>
                    </a>
                </div> 
                <div class="d-none d-table-cell nw-6 f-sm font-weight-normal py-md-2 px-md-1" style = "border-right: 0.5px solid blue;">
                    <a style="color:blue; font-weight: bold;" data-type = "F" data-entity="<?php echo $row['co_entity'];?>" data-no = "<?php echo $row['co_no'];?>" data-mb-id = "<?php echo $row['mb_id'];?>" data-link="<?php echo $bo_table;?>" <?php if(number_format($row['co_free_num']-$row['co_sent_fnum']) == 0){ echo ''; } else { echo 'data-toggle="modal" href="#couponModal" class="coupon-modal"';} ?>>
                        <?php echo "무료권 ".number_format($row['co_free_num']-$row['co_sent_fnum'])."개";?>
                    </a>
                </div>
                <div class="float-left float-md-none d-table-cell nw-30 nw-md-auto text-left f-sm font-weight-normal pl-2 py-md-2 pr-md-1">
                    <?php echo "쿠폰 받은사람 :"; ?> 
                    <ul id="userlist">
                    <?php $sql = "SELECT a.*, b.* FROM $g5[coupon_table] a RIGHT OUTER JOIN $g5[coupon_sent_table] b ON a.co_no = b.co_no WHERE a.co_begin_datetime='{$s_begin_date}' AND a.co_end_datetime ='{$s_end_date}' AND b.co_no = {$row['co_no']}  ORDER BY b.co_no ASC";
                    $sql1 = sql_query($sql);
                    for($k=0; $row1 = sql_fetch_array($sql1); $k++){
                    ?>
                        <?php if($row1['cos_accept'] == 'N' && $row1['cos_alt_quantity'] == '0') { echo '<li><a data-toggle="modal" href="#couponDelete" class="coupon-delete" data-type ='?><?php echo $row1['cos_type']." data-code = " ?><?php echo $row1['cos_code']." data-no = ";?><?php echo $row1['cos_no']." data-co-no = "; ?><?php echo $row1['co_no']." data-link = ";?><?php echo $bo_table.'>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></a></li><?php } ?>
                        <?php if($row1['cos_accept'] == 'Y' && $row1['cos_alt_quantity'] == '0') { echo '<li><a href="#" style="color:blue;" data-type ='?><?php echo $row1['cos_type']." data-code = " ?><?php echo $row1['cos_code']." data-no = ";?><?php echo $row1['cos_no']." data-co-no = "; ?><?php echo $row1['co_no']." data-link = ";?><?php echo $bo_table.'>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'];?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick']; ?></a></li><?php } ?>
                        <?php if($row1['cos_alt_quantity'] > 0) { echo '<li><a data-toggle="modal" href="#couponAlert" class="coupon-alert" style="color:red;" data-entity ='?><?php echo $row1['cos_entity']." data-nick = " ?><?php echo $row1['cos_nick']." data-link = ";?><?php echo $bo_table.'>'?><?php if($row1['cos_type'] == 'F') echo " (무료권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')';?><?php if($row1['cos_type'] == 'S') echo " (원가권) ".$row1['cos_nick'].'('.$row1['cos_alt_quantity'].')'; ?></a></li> <?php } ?>					 
                    <?php
                    }
                    ?> 
                    </ul>
                </div>
            </li>
        <?php } ?>
        </ul>
        <?php if ($i == 0) { ?>
            <div class="f-de px-3 py-5 text-center text-muted border-bottom">
                자료가 없습니다.
            </div>
        <?php } ?>

        <div class="modal fade" id="couponCreate" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 350px; height: 250px; font-weight: bold;">
                    <form id="fcouponcreate" name="fcouponcreate" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="return fcouponcreate_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body">
                            <input type="hidden" name="co_no" id="co_no" value="">
                            <input type="hidden" name="mb_id" id="mb_id" value="">
                            <input type="hidden" name="cos_type" id="cos_type" value="">
                            <input type="hidden" name="cos_link" id="cos_link" value="">
                            <div style="margin-left: 30px;"><?php echo $year."년 ".$month."월";?></div>
                            <div style="margin-left: 30px;"><?php echo "업소명 :";?>
                                <input type="text" name="cos_entity" id="cos_entity" value="" style="border:none; outline: none; width: 100px; font-size: 12px; font-weight: bold;">							
                            </div>
                            <!-- <div style="margin-left:120px;">받는사람 닉네임</div>		
                            <div style="margin-left:30px; margin-top:10px;">
                                <input type="text" name="cos_nick" id="mb_nick" style="background: #00FFFF; display:inline; width: 160px;"/>		
                                <input type="button" name="check_id" id="check_id" value="닉네임 확인" style="background: #6495ED; display:inline; width: 100px;"/>
                            </div>
                            <div id="result" style="margin-left:30px; margin-top: 10px;" >
                            </div> -->			
                        </div>
                        <div class="modal-footer">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px;">보내기</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 350px; height: 250px; font-weight: bold;">
                    <form id="fcouponsend" name="fcouponsend" action="<?php echo $coupon_sent_action_url; ?>" onsubmit="return fcouponsend_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰주기</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body">
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
                </div>
            </div>
        </div>
        <div class="modal fade" id="couponDelete" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 20%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 350px; height: 200px; font-weight: bold;">
                    <form id="fcoupondelete" name="fcoupondelete" action="<?php echo $coupon_delete_action_url; ?>" onsubmit="return fcoupondelete_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin-left: 140px; font-weight: bold;">쿠폰회수</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 	
                        <div class="modal-body" style="padding: 40px 0px; font-size: 14px;">
                            <input type="hidden" name="co_no" id="co_no" value="">
                            <input type="hidden" name="cos_no" id="cos_no" value="">
                            <input type="hidden" name="cos_type" id="cos_type" value="">
                            <input type="hidden" name="cos_link" id="cos_link" value="">
                            <input type="hidden" name="cos_code" id="cos_code" value="">
                            <div style="margin-left:100px;">쿠폰을 회수하시겠습니까?</div>					
                        </div>
                        <div class="modal-footer">
                            <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                                <button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px; font-size: 14px;">확인</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="couponAlert" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 0%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 650px; height: 400px; font-weight: bold;">
                    <div class="modal-header">
                        <h5 class="modal-title" style="margin-left: 250px; font-weight: bold;">경고 횟수 변경 및 기록</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 	
                    <div class="modal-body" style="padding: 5px 0px; font-size: 14px;">
                        <?php 
                            $sql = "SELECT MAX(alt_created_datetime) as maxdate FROM `g5_coupon_alert`"; 
                            $row = sql_fetch($sql);  
                            $sql1 = "SELECT * FROM `g5_coupon_alert` WHERE alt_created_datetime = '{$row['maxdate']}' ";
                            $row1 = sql_fetch($sql1);
                        ?> 
                        <div style="margin-left: 30px;"><?php echo "사용자 : ".$row1['cos_nick'];?></div>
                        <div style="margin-left: 30px;"><?php echo "현재 경고횟수 : ".$row1['cos_alt_quantity'];?>
                        <form id="fcouponalert" name="fcouponalert" action="<?php echo $coupon_alert_action_url; ?>" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="cos_nick" id="cos_nick" value="">
                            <input type="hidden" name="cos_entity" id="cos_entity" value="">
                            <input type="hidden" name="cos_link" id="cos_link" value="">
                            <div style="margin-left:30px; margin-top: 30px;">
                                <p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
                                <input type="number" name="cos_alt_quantity" id="cos_alt_quantity" style="background: #EFEFEF; width: 40px;" value = "<?php echo $row1['cos_alt_quantity']; ?>"/>		
                                <input type="submit" name="change" id="change" value="확인" style="background: #FFF2CC; width: 80px;"/>
                            </div>
                        </form>
                        <div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
                        <div style="margin: 10px 10px 10px 0px;">
                            <table style="width: 550px;">
                                <thead>
                                    <tr>
                                    <tr style=" background:  #f8f8f8; border: 1px solid #000; font-size: 10px;">
                                        <th style= "width: 25%; border: 1px solid #000; text-align: center;">시간</th>
                                        <th style= "width: 20%; border: 1px solid #000; text-align: center;">업소명</th>
                                        <th style= "width: 20%; border: 1px solid #000; text-align: center;">경고내용</th>
                                        <th style= "width: 20%; border: 1px solid #000; text-align: center;">최종적용 아이디</th>
                                        <th style= "width: 20%; border: 1px solid #000; text-align: center;">누적횟수</th>
                                    </tr>
                                </thead>
                                <tbody style="background: #fff;">
                                <?php $sql = "SELECT * FROM `g5_coupon_alert` WHERE cos_nick = '{$row1['cos_nick']}' ORDER BY alt_created_datetime";
                                $res = sql_query($sql);
                                for($i=0; $row = sql_fetch_array($res); $i++) { ?>
                                    <tr style="border: 1px solid #000;font-size: 8px;">
                                        <td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_created_datetime']; ?></td>
                                        <td style="border: 1px solid #000; text-align: center;"><?php echo $row['cos_entity']; ?></td>
                                        <td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_reason']; ?></td>
                                        <td style="border: 1px solid #000; text-align: center;"><?php echo $row['alt_created_by']; ?></td>
                                        <td style="border: 1px solid #000; text-align: center;"><?php echo $row['cos_alt_quantity']; ?></td>
                                    </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                        </div>					
                    </div>
                    <div class="modal-footer">
                        <div style="margin-left: 140px; margin: 0 auto; text-align: center;">
                            <button type="submit" accesskey="s" class="btn" style="background: #00FF00; width: 150px; font-size: 14px;">확인</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo NA_URL ?>/app/bs4/js/bootstrap.bundle.min.js"></script>
        <script> 

        function fcouponcreate_submit(f) {
                if (!f.co_sale_num) {
                    alert("Please insert quantity of sale coupon!");
                    f.co_sale_num.focus();
                    return false;
                } 

                if (!f.co_free_num) {
                    alert("Please insert quantity of free coupon!");
                    f.co_free_num.focus();
                    return false;
                }

                var agree=confirm("쿠폰 개수를 저장하시겠습니까?");
                if(agree)
                    return true;
                else 
                    return false;                                       
        }

        function fcouponsend_submit(f) {
            if(!f.cos_nick && $('#hasNick').length > 0 && $('#hasNick').val() == ''){ 
                alert("Please insert correct nick name!");
                f.cos_nick.focus();
                return false;
            }         
            return true;                                    
        }  

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

            $('body').on('click', '.coupon-alert', function() {
                var cos_entity = $(this).data('entity');
                var cos_nick = $(this).data('nick');
                var cos_link = $(this).data('link');
                $('.modal-body #cos_entity').val(cos_entity);
                $('.modal-body #cos_nick').val(cos_nick);
                $('.modal-body #cos_link').val(cos_link);
            }); 	
        });
        </script>
<?php
} 
?>