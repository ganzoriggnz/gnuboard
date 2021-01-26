<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = "▶  전화번호 변경요청";
$mb_id=  $_POST['mb_id'];
$phone_skin_path = get_skin_path('member', $config['cf_member_skin']);
$point_skin_url  = get_skin_url('member', $config['cf_member_skin']);

$skin_file = $phone_skin_path.'/phone_change_request.skin.php';

if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}
$new_hp="";

if($_POST['new_hp']!='')
{
    $new_hp = $_POST['new_hp'];
    // alert("new phone : ".$member['mb_id']."".$new_hp);
    $sql= "update g5_member set mb_10 = '{$new_hp}' where mb_id ='{$member['mb_id']}'";            
    sql_query($sql);
    echo "<script>window.close();</script>";
}

include_once('./_tail.php');
?>
