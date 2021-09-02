<?php
include_once('../common.php');

if($is_member && $member['mb_level'] < 24 && $member['mb_8']!='Y'){ //사이트안내 포인트를 받았는지 확인
	
	insert_point($member['mb_id'], 100, "사이트안내 확인", "@guide", $member['mb_nick'], "사이트안내");
	
	$sql = " update {$g5['member_table']} set mb_8 = 'Y' where mb_id = '{$member['mb_id']}' ";
	sql_query($sql);

	alert('100파운드가 지급되었습니다.', '/page/guide.php');
}