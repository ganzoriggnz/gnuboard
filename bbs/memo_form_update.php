<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_guest)
    alert('회원만 이용하실 수 있습니다.');

if (!chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

$recv_list = explode(',', trim($_POST['me_recv_mb_id'], " "));
$str_nick_list = '';
$msg = '';
$error_list  = array();
$member_list = array('id'=>array(), 'nick'=>array());

run_event('memo_form_update_before', $recv_list);

foreach ($recv_list as $key => $value) {
    $need = str_replace(' ', '', $value);
    $querry = "select mb_id, mb_nick, mb_open, mb_leave_date, mb_intercept_date from ".$g5['member_table']." where mb_id = '".$need."'";
    $row = sql_fetch($querry);
    if ($row) {
                if ($is_admin || ((!$row['mb_leave_date'] && !$row['mb_intercept_date']))) {
                    $member_list['id'][]   = $row['mb_id'];
                    $member_list['nick'][] = $row['mb_nick'];
                } else {
                    $error_list[]   = $value;
                }
            }
    // if ((!$row['mb_id'] || !$row['mb_open'] || $row['mb_leave_date'] || $row['mb_intercept_date']) && !$is_admin) {
    //             $error_list[]   = $value;
    //         } else {
    //             $member_list['id'][]   = $row['mb_id'];
    //             $member_list['nick'][] = $row['mb_nick'];
    //         }
}


$error_msg = implode(",", $error_list);

if ($error_msg && !$is_admin)
    alert("회원아이디 '{$error_msg}' 은(는) 존재(또는 정보공개)하지 않는 회원아이디 이거나 탈퇴, 접근차단된 회원아이디 입니다.\\n쪽지를 발송하지 않았습니다.");

if (! count($member_list['id'])){
    alert('해당 회원이 존재하지 않습니다.');
}

if (!$is_admin && $member['mb_level'] < 23) {
    if (count($member_list['id'])) {
        $point = (int)$config['cf_memo_send_point'] * count($member_list['id']);
        if ($point) {
            if ($member['mb_point'] - $point < 0) {
                alert('보유하신 파운드('.number_format($member['mb_point']).'점)가 모자라서 쪽지를 보낼 수 없습니다.');
            }
        }
    }
}


for ($i=0; $i<count($member_list['id']); $i++) {

    

    $tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
    $me_id = $tmp_row['max_me_id'] + 1;

    $recv_mb_id   = $member_list['id'][$i];
    $recv_mb_nick = get_text($member_list['nick'][$i]);

    // 받는 회원 쪽지 INSERT
    $sql = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values ( '$recv_mb_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$_POST['me_memo']}', '0000-00-00 00:00:00' , 'recv', '{$_SERVER['REMOTE_ADDR']}' ) ";

    sql_query($sql);

    if( $me_id = sql_insert_id() ){

        // 보내는 회원 쪽지 INSERT
        $sql = " insert into {$g5['memo_table']} ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_send_id, me_type , me_send_ip ) values ( '$recv_mb_id', '{$member['mb_id']}', '".G5_TIME_YMDHIS."', '{$_POST['me_memo']}', '0000-00-00 00:00:00', '$me_id', 'send', '{$_SERVER['REMOTE_ADDR']}' ) ";
        sql_query($sql);
		
		$member_list['me_id'][$i] = $me_id;
    }

    // 실시간 쪽지 알림 기능
    $sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read($recv_mb_id)."' where mb_id = '$recv_mb_id' ";
    sql_query($sql);

    if (!$is_admin && $member['mb_level'] < 23) {
      
        insert_point($member['mb_id'], (int)$config['cf_memo_send_point'] * (-1), $recv_mb_nick.'('.$recv_mb_id.')님께 쪽지 발송', '@memo', $recv_mb_id, $me_id);
       
    }
}

if ($member_list) {


    $redirect_url = G5_HTTP_BBS_URL."/memo.php?kind=send";
    $str_nick_list = implode(',', $member_list['nick']);

    // ////////////sms 발송///////////////////////////////////
    //----------------------------------------------------------
// SMS 문자전송 시작
$medd = get_member($me_send_mb_id);
//----------------------------------------------------------
$sms_contents = $member['mb_nick']." 님께서 쪽지를 발송되었습니다.";  // 문자 내용

// 핸드폰번호에서 숫자만 취한다
$receive_number = preg_replace("/[^0-9]/", "", $sms5['cf_phone']);  // 수신자번호
$send_number = preg_replace("/[^0-9]/", "", $sms5['cf_phone']); // 발신자번호

if ($me_recv_mb_id == "admin" && $receive_number)
{
	if ($config['cf_sms_use'] == 'icode')
	{
		if($config['cf_sms_type'] == 'LMS') {
            include_once(G5_LIB_PATH.'/icode.lms.lib.php');

            $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

            // SMS 모듈 클래스 생성
            if($port_setting !== false) {
                $SMS = new LMS;
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);

                $strDest     = array();
                $strDest[]   = $receive_number;
                $strCallBack = $send_number;
                $strCaller   = iconv_euckr(trim($config['cf_title']));
                $strSubject  = '';
                $strURL      = '';
                $strData     = iconv_euckr($sms_contents);
                $strDate     = '';
                $nCount      = count($strDest);

                $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                $SMS->Send();
                $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
            }
        } else {
            include_once(G5_LIB_PATH.'/icode.sms.lib.php');

            $SMS = new SMS; // SMS 연결
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
            $SMS->Add($receive_number, $send_number, $config['cf_icode_id'], iconv_euckr(stripslashes($sms_contents)), "");
            $SMS->Send();
            $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
        }
	}
}
//----------------------------------------------------------
// SMS 문자전송 끝
//----------------------------------------------------------
    ////////////////////////////////////////////////////////////

    run_event('memo_form_update_after', $member_list, $str_nick_list, $redirect_url, $_POST['me_memo']);

    alert($str_nick_list." 님께 쪽지를 전달하였습니다.", $redirect_url, false);
} else {

    $redirect_url = G5_HTTP_BBS_URL."/memo_form.php";
    
    run_event('memo_form_update_failed', $member_list, $redirect_url, $_POST['me_memo']);

    alert("회원아이디 오류 같습니다.", $redirect_url, false);
}
?>