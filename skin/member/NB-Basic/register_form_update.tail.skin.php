<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//----------------------------------------------------------
// 닉네임 변경시 게시글 일괄 적용하기
//----------------------------------------------------------
$sql = " select mb_nick from " . $g5['member_table'] . " where mb_id = '" . $_POST['mb_id'] . "' ";
$row = sql_fetch($sql);

//닉네임 변경시 전체 게시판 에 변경하는 닉네임 적용 
$sql = " select bo_table from " . $g5['board_table'] . " order by gr_id, bo_table ";
$result = sql_query($sql);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
	sql_query("update " . 'G5_TABLE_PREFIX' . "write_" . $row['bo_table'] . " set wr_name='" . $_POST['mb_nick'] . "', wr_email='" . $_POST['mb_email'] . "', wr_homepage='" . $_POST['mb_homepage'] . "' where mb_id = '" . $_POST['mb_id'] . "' ");
}
///////////////////////////ene hurtel nemsen///////////////////
//쇼핑몰
if(IS_YC) {
	//----------------------------------------------------------
	// SMS 문자전송 시작
	//----------------------------------------------------------

	$sms_contents = $default['de_sms_cont1'];
	$sms_contents = str_replace("{이름}", $mb_name, $sms_contents);
	$sms_contents = str_replace("{회원아이디}", $mb_id, $sms_contents);
	$sms_contents = str_replace("{회사명}", $default['de_admin_company_name'], $sms_contents);

	// 핸드폰번호에서 숫자만 취한다
	$receive_number = preg_replace("/[^0-9]/", "", $mb_hp);  // 수신자번호 (회원님의 핸드폰번호)
	$send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']); // 발신자번호

	if ($w == "" && $default['de_sms_use1'] && $receive_number)
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
					$strCaller   = iconv_euckr(trim($default['de_admin_company_name']));
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
}
?>
