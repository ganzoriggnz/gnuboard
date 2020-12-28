<?php
	include_once('./_common.php');
	include_once(G5_PLUGIN_PATH.'/follow_member/follow_member.lib.php');

	if(!$is_member){
		alert("로그인 후 친구를 삭제할 수 있습니다.");
	}

	if( $_GET['friendid'] ){
		$friendid = $_GET['friendid'];

		$follow_member->delete_friend($friendid);
		$mb = get_member($friendid, "mb_name");
		$mb_name = $mb['mb_name'];

	}else{
		alert( "삭제할 친구가 없습니다.");
	}

	alert($mb_name."님을 친구목록에서 삭제했습니다.");
?>
