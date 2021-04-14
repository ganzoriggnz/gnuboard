<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//----------------------------------------------------------
// SMS 문자전송 시작
//----------------------------------------------------------
$text_ntags = strip_tags($wr_content);
$not_regex = str_replace("&nbsp;", " ", $text_ntags)
/* $text_cnt = strlen($not_regex);
    if($text_cnt > 50) {
        $sms1 = substr_replace($not_regex, "...", 50);
    }
    else {
        $sms1 = $not_regex;
    }  */
$sms_contents = '['.$ca_name.']게시판에 '.$wr_name.'님이 글을 등록하셨습니다. '.$not_regex;  // 문자 내용

// 핸드폰번호에서 숫자만 취한다
$receive_number = preg_replace("/[^0-9]/", "", $sms5['cf_phone']);  // 수신자번호
$send_number = preg_replace("/[^0-9]/", "", $sms5['cf_phone']); // 발신자번호

if ($bo_table == "partnership" && $w == "" && $receive_number)
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
?>