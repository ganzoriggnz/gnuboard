<?php
include_once('./_common.php');

$shingo = (int)$boset['na_shingo'];

if (IS_NA_BBS && $shingo) {
	;
} else {
	die('이 게시판은 신고 기능을 사용하지 않습니다.');
}

if (!$is_member) {
	die('회원만 가능합니다.');
}

if (!$write['wr_id']) {
	die('존재하지 않는 게시물입니다.');
}

// 원글 아이디
$wr_parent = (int)$c_id;

// 옵션 분해
list($html, $secret, $mail) = explode(",", $write['wr_option']);

// 옵션 설정
if($wr_parent) { // 댓글
	$lock = 'secret';
	$unlock = '';
} else {
	$lock = $html.',secret,'.$mail;
	$unlock = $html.',,'.$mail;
}

// 관리자는 바로 잠금/해제를 함
if($is_admin) {
	
	// 잠금처리된 글이면 해제함
	if($write['as_type'] == "-1") {

		// 신고 내역 삭제
		sql_query(" delete from {$g5['na_shingo']} where bo_table = '$bo_table' and wr_id = '$wr_id' ");

		// 잠금 해제
		sql_query(" update $write_table set wr_option = '$unlock', as_type = '0' where wr_id = '$wr_id' ", false);

		// hulan nemsen blind tsutslah ued point nemeh
		$sql = " select wr_id, mb_id, wr_is_comment, wr_content from $write_table where wr_parent = '{$write['wr_id']}' order by wr_id ";
		$result = sql_query($sql);
		while ($row = sql_fetch_array($result))
		{
			// 원글이라면
			if (!$row['wr_is_comment'])
			{
									
		insert_point($row['mb_id'],  $board['bo_write_point'], "{$board['bo_subject']} $wr_id 글 블라인드", $bo_table, $wr_id, "블라인드");}}

		die('블라인드 해제를 하였습니다.');

	} else {
		
		// 신고 내역
		$row = sql_fetch(" select id, mb_id from {$g5['na_shingo']} where bo_table = '$bo_table' and wr_id = '$wr_id' ", false);
		if($row['id']) {
			// 신고자
			$mbs = array();
			$tmp = explode(",", trim($row['mb_id']));
			for($i=0; $i < count($tmp); $i++) {
				if(!trim($tmp[$i]))
					continue;

				$mbs[] = $tmp[$i];
				
			}

			if(count($mbs) > 0) {
				array_push($mbs, $member['mb_id']);
				$mb_ids = implode(",", $mbs);
			} else {
				$mb_ids = $member['mb_id'];
			}

			// 내역 잠금 처리
			sql_query(" update {$g5['na_shingo']} set flag = '1', mb_id = '$mb_ids' where id = '{$row['id']}' ", false);

		} else {
			// 신규 등록
		    sql_query(" insert into {$g5['na_shingo']} 
				set bo_table = '$bo_table',
					wr_id = '$wr_id',
					wr_parent = '$wr_parent',
					mb_id = '{$member['mb_id']}',
					flag = '1',
					regdate = '".G5_TIME_YMDHIS."' ", false);

		}

		// 게시물 잠금 처리
		sql_query(" update $write_table set wr_option = '$lock', as_type = '-1' where wr_id = '$wr_id' ", false);
		// hulan nemsen blind bolbol point hasah
		$sql = " select wr_id, mb_id, wr_is_comment, wr_content from $write_table where wr_parent = '{$write['wr_id']}' order by wr_id ";
		$result = sql_query($sql);
		while ($row = sql_fetch_array($result))
		{
			// 원글이라면
			if (!$row['wr_is_comment'])
			{
				// 원글 포인트 삭제
				if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '쓰기'))
					
		insert_point($row['mb_id'],  $board['bo_write_point'] * -1, "{$board['bo_subject']} $wr_id 글 블라인드", $bo_table, $wr_id, "블라인드");}}

		die('블라인드 처리를 하였습니다.');
		
	}

} else {

	// 일반회원
	if($write['as_type'] == "-1") {
		die('이미 블라인드 처리된 게시물입니다.');
	}

	if($write['mb_id']) {
		if(is_admin($write['mb_id'])) {
			die('관리자 글은 블라인드할 수 없습니다.');
		}

		if($nariya['cf_admin'] && in_array($write['mb_id'], explode(",", $nariya['cf_admin']))) {
			die('관리자 글은 블라인드할 수 없습니다.');
		}

		if($nariya['cf_group'] && in_array($write['mb_id'], explode(",", $nariya['cf_group']))) {
			die('관리자 글은 블라인드할 수 없습니다.');
		}

		if($boset['bo_admin'] && in_array($write['mb_id'], explode(",", $boset['bo_admin']))) {
			die('관리자 글은 블라인드할 수 없습니다.');
		}

		if($write['mb_id'] == $member['mb_id']) {
			die('자신의 게시물은 블라인드할 수 없습니다.');
		}
	}

	// 신고 내역
	$row = sql_fetch(" select id, mb_id from {$g5['na_shingo']} where bo_table = '$bo_table' and wr_id = '$wr_id' ");

	if($row['id']) {
		// 신고자
		$mbs = array();
		$tmp = explode(",", trim($row['mb_id']));
		for($i=0; $i < count($tmp); $i++) {
			if(!trim($tmp[$i]))
				continue;

			$mbs[] = $tmp[$i];
		}

		$is_lock = false;
		if(count($mbs) > 0) {
			if(in_array($member['mb_id'], $mbs)) {
				die('이미 블라인드하셨습니다.');
			}
			array_push($mbs, $member['mb_id']);
			$mb_ids = implode(",", $mbs);
		} else {
			$mb_ids = $member['mb_id'];
		}

		// 잠금 체크
		if(count(explode(",", $mb_ids)) >= $shingo) {
			// 내역 잠금 처리
			sql_query(" update {$g5['na_shingo']} set flag = '1', mb_id = '$mb_ids' where id = '{$row['id']}' ");

			// 게시물 잠금 처리
			sql_query(" update $write_table set wr_option = '$lock', as_type = '-1' where wr_id = '$wr_id' ");
		} else {
			// 신고 처리
			sql_query(" update {$g5['na_shingo']} set flag = '0', mb_id = '$mb_ids' where id = '{$row['id']}' ");
		}

	} else {
		// 신규 등록
	    sql_query(" insert into {$g5['na_shingo']} 
			set bo_table = '$bo_table',
				wr_id = '$wr_id',
				wr_parent = '$wr_parent',
				mb_id = '{$member['mb_id']}',
				flag = '0',
				regdate = '".G5_TIME_YMDHIS."' ", false);
	}

	die('블라인드 처리되었습니다.');
}

?>