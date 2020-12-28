<?php
	include_once('./_common.php');
	include_once(G5_PLUGIN_PATH.'/follow_member/follow_member.lib.php');

	if(!$is_member){
		alert("로그인 후 친구를 삭제할 수 있습니다.");
	}


	if( isset($_GET['following']) && $_GET['following'] ){
		$following = $_GET['following'];

		$que = "select a.f_idx, b.mb_name from ". FRIEND . " a
		left join {$g5['member_table']} b on a.following = b.mb_id
		where a.following = '{$following}' and followers = '{$member['mb_id']}' ";

		$f = sql_fetch( $que );
	}

	if( $f['f_idx'] ){
    $arrset['followersyn'] = "N";
    $arrwhere['f_idx'] = $f['f_idx'];
		$follow_member->update_friend_table($arrset, $arrwhere){
		$mb_name = $f['mb_name'];
	}else{
	   alert( "거절할 친구가 없습니다.");
	}


	alert($mb_name."님");
?>
