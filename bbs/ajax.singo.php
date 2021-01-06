<?php
header("Content-Type: application/json");
include_once('./_common.php');

$bo_table = $_REQUEST['bo_table'];
$wr_id    = $_REQUEST['wr_id'];

$bo_table = get_text(clean_xss_tags($bo_table));
$wr_id    = get_text(clean_xss_tags($wr_id));

if (!$bo_table || !$wr_id) {
    $data = array(
              'msg'=>'값 이 넘어오지 않았습니다.'
    );
    
    echo json_encode($data);
    exit();
}

$row  = array();
$row  = sql_fetch(" select * from {$g5['board_table']} where bo_table = '{$bo_table}' ");
$row3 = array();
$row3 = sql_fetch(" select * from $write_table where wr_id = '{$wr_id}' ");

if (!$row['bo_2']) {
    $data = array(
              'msg'=>'신고기능을 사용하지 않는 게시판입니다.'
    );
    
    echo json_encode($data);
    exit();
} else if (!$row['bo_1'] && !$is_member) {
    $data = array(
              'msg'=>'비회원은 신고할 수 없습니다.'
    );
    
    echo json_encode($data);
    exit();
}

if ($row3['mb_id'] == $config['cf_admin']) {
    $data = array(
              'msg'=>'관리자의 글은 신고할 수 없습니다.'
    );
    
    echo json_encode($data);
    exit();
}

if ($row3['mb_id'] == $member['mb_id']) {
    $data = array(
              'msg'=>'자신의 글은 신고할 수 없습니다.'
    );
    
    echo json_encode($data);
    exit();
}

if ($is_member) {
    $mb_id = $member['mb_id'];
    $mb_name = $member['mb_name'];
    $row2_where = "where bo_table = '{$bo_table}' and bo_wr_id = '{$wr_id}' and bo_mb_id = '{$member['mb_id']}'";
} else {
    $mb_id = '비회원';
    $mb_name = '비회원';
    $row2_where = "where bo_table = '{$bo_table}' and bo_wr_id = '{$wr_id}' and bo_ip = '{$_SERVER['REMOTE_ADDR']}'";
}

if (!$row['bo_3']) {
    $row2 = sql_fetch(" select count(*) as cnt from {$g5['singo_table']} {$row2_where} order by bo_id desc limit 1 ");
    
    if ($row2['cnt']) {
        $data = array(
                  'msg'=>'게시물은 한번만 신고할 수 있습니다.'
        );
        
        echo json_encode($data);
        exit();
    }
}

$bo_link = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;
$sql = " insert into {$g5['singo_table']}
         set bo_table = '{$bo_table}',
             bo_wr_id = '{$wr_id}',
             bo_link = '{$bo_link}',
             bo_mb_id = '{$mb_id}',
             bo_mb_name = '{$mb_name}',
             bo_object_id = '{$row3['mb_id']}',
             bo_object_name = '{$row3['wr_name']}',
             bo_ip = '{$_SERVER['REMOTE_ADDR']}',
             bo_singo_date = '".G5_TIME_YMDHIS."'
             ";
sql_query($sql);

$data = array(
          'msg'=>'신고가 정상적으로 접수되었습니다.',
          'data'=>'success',
          'reason'=>'ok',
          'result'=>'socket'
);

echo json_encode($data);
?>
