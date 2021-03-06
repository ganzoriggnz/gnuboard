<?php 
include_once('./_common.php');

if (!$is_member)
alert('회원만 조회하실 수 있습니다.', G5_BBS_URL."/login.php?url=".urlencode("{$_SERVER['REQUEST_URI']}"));

$g5['title'] = '쿠폰지원 목록';
include_once(G5_PATH.'/head.sub.php');

$bo_table = $_REQUEST['bo_table'];

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_send_date = date_format($co_start, 'Y-m-06 00:00:00');
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

$result1 = "SELECT co_begin_datetime FROM {$g5['coupon_table']} WHERE co_begin_datetime='$co_begin_datetime' AND co_end_datetime='$co_end_datetime'";
$sql = sql_fetch($result1);
$date = $sql['co_begin_datetime'];
$year = substr($date, 0, 4);
$month = substr($date, 5, 2);

$re_table = $g5['write_prefix'].$bo_table;
$linkcount = strlen($re_table) - 2;
$str_table =substr($re_table, 0, $linkcount);
$at_table = $str_table."at";

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

$sql2 = "Select * from {$g5['coupon_sent_table']} WHERE cos_accept = 'Y' ORDER BY cos_post_datetime";
$res2 = sql_query($sql2);

while($row2 = sql_fetch_array($res2)){
    $sql3 = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept='Y' AND cos_id = '{$row2['cos_id']}' AND cos_entity = '{$row2['cos_entity']}'";
    $res3 = sql_fetch($sql3);
    $sql8 = "SELECT cos_alt_quantity FROM {$g5['coupon_alert_table']} WHERE cos_id = '{$row2['cos_id']}' ORDER BY alt_no DESC LIMIT 1";
    $res8 = sql_fetch($sql8); 
    $sql4 = "SELECT COUNT(alt_no) as alt_cnt FROM {$g5['coupon_alert_table']} WHERE cos_id = '{$row2['cos_id']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
    $res4 = sql_fetch($sql4); 
    $sql7 = "SELECT * FROM $re_table WHERE mb_id = '{$row2['cus_id']}' AND wr_7 = '{$row2['cos_entity']}' AND wr_is_comment = '0'";
    $res7 = sql_fetch($sql7);    
    if($row2['cos_entity'] !== $res7['wr_7'] && $res4['alt_cnt'] == '0' && ($now > $row2['cos_post_datetime'])){
        $sql4 = "INSERT INTO {$g5['coupon_alert_table']} 
                        SET cos_no = '{$row2['cos_no']}',
                            cos_id = '{$row2['cos_id']}',
                            cos_nick = '{$row2['cos_nick']}',
                            mb_id = '{$row2['mb_id']}',
                            cos_entity = '{$row2['cos_entity']}',
                            cos_alt_quantity = '{$res8['cos_alt_quantity']}' + 1,
                            alt_reason = '후기미작성7일',
                            alt_created_by = '-',
                            alt_created_datetime = '{$row2['cos_post_datetime']}' ";
            sql_query($sql4);

            $sql5 = "UPDATE {$g5['coupon_sent_table']} 
                        SET cos_alt_quantity = '{$res3['cos_alt_quantity']}' + 1
                        WHERE cos_accept='Y' AND cos_id = '{$row2['cos_id']}' AND cos_entity = '{$row2['cos_entity']}' AND cos_no = '{$row2['cos_no']}'";
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

$coupon_list_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_list_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_list_skin_path.'/coupon_list.skin.php';

$coupon_sent_action_url = G5_BBS_URL.'/coupon_sent_form.php';
$coupon_delete_action_url = G5_BBS_URL.'/coupon_delete_form.php';
$coupon_alert_action_url = G5_BBS_URL.'/coupon_alert_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once(G5_PATH.'/tail.sub.php');
?>