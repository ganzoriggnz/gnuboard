<?php
	include_once('./_common.php');
	include_once(G5_PLUGIN_PATH.'/follow_member/follow_member.lib.php');

	if( !$_GET['rec_id'] ){
		alert("잘 못된 접근방식입니다.");
	}

	$mb = get_member($_GET['rec_id'], "mb_id, mb_name");
	$rec_id = $mb['mb_id'];
	$mb_name = $mb['mb_name'];

	if( !$mb['mb_id'] ){
		alert("등록할 친구가 없습니다.");
	}

	if(!$is_member){
		alert("로그인 후 친구를 추가할 수 있습니다.");
	}

	$que = "select count(1) as cnt from ". FRIEND . " where (followers = '{$rec_id}' and following = '{$member['mb_id']}' ) or (followers = '{$member['mb_id']}' and following = '{$rec_id}' )";
	$f = sql_fetch( $que );

	if( $f['cnt'] ){
		alert( "이미 추가한 친구입니다.");
	}else{
    $arrset['followers'] = $rec_id;
    $arrset['following'] = $member['mb_id'];
    $arrset['followingdate'] = date("Y-m-d H:i:s");
    $follow_member->insert_friend_table($arrset);
	}


	alert($mb_name."님을 친구로 추가 했습니다.", G5_BBS_URL."/board.php?bo_table=".$_GET['bo_table']."&page=".$_GET['page']);
?>
