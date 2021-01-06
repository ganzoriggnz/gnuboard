<?php
include_once('./_common.php');

// 상수 선언
$g5['table_prefix']        = "g5_"; // 테이블명 접두사
$g5['coupon_table'] = $g5['table_prefix'] . "coupon";    // 쿠폰 테이블

if (!sql_query("select count(*) as cnt from $g5[coupon_table]",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "create table $g5[coupon_table] (            
        co_no int(11) NOT NULL auto_increment,
        mb_id varchar(50) NOT NULL default '',
        co_entity varchar(20) NOT NULL default '',
        co_sale int(11) NOT NULL default '0',
        co_free int(11) NOT NULL default '0',
        co_created_date datetime NOT NULL default '0000-00-00 00:00:00',
        co_updated_date datetime NOT NULL default '0000-00-00 00:00:00',
        PRIMARY KEY  (co_no),
        KEY co_no (mb_id)
    )";
   sql_query($sql_table, false);
} 

$sql = "select * from $g5[coupon_table] where mb_id = '{$member['mb_id']}'";
$row = sql_fetch($sql);
if($row['co_no']){ 
    $sdate = $row['co_created_date'];
    $fdate = date_create_from_format('Y-m-d H:i:s', $sdate);
   $fdate= date_format($fdate, 'Y-m-04 H:i:s');   
} 

$now = date('Y-m-d H:i:s', time());

//dbconfig파일에 $g5['content_table'] 배열변수가 있는지 체크
if( !isset($g5['member_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->내용 관리를 먼저 확인해 주세요.');
}

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

// 내용

/* if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/userinfo.php');
    return;
} */

include_once('./_head.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$coupon_create_skin_path = get_skin_path('coupon', 'NB-Basic');
$coupon_create_skin_url  = get_skin_url('coupon', 'NB-Basic');
$skin_file = $coupon_create_skin_path.'/coupon_create.skin.php';

$coupon_action_url = G5_BBS_URL.'/coupon_create_form.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

    include_once('./_tail.php');
?>