<?php
include_once('./_common.php');
if (!stripos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])) exit;

// 비회원
if (!$is_member) {
	exit;
}

$row = sql_fetch(" select * from {$g5['giftbox_config_table']} limit 1");

//선물함 쿠폰지급 (일반회원만 지급한다)
if($member['mb_level'] < 24){
	$number  = array();

	$sale_percent = $row['sale_percent']; //원가권 당첨 확률
	$free_percent = $row['free_percent']; //무료권 당첨 확률

	for($i=1; $i<=100; $i++){
		array_push($number,$i);
	}

	$sale_number = $number[array_rand($number)];

	//원가권 당첨
	$sale = coupon_valid('sale', $row['sale_limit']);
	if($sale_number <= $sale_percent && $sale){

		$sql = " INSERT INTO {$g5['giftbox_table']}
					SET 
					mb_id = '".$member['mb_id']."',
					gift_name = '원가권 쿠폰',
					co_type = 'S',
					datetime = '".date('Y-m-d H:i:s')."' ";
		sql_query($sql);

		echo 'sale';
		exit;
	}

	$free_number = $number[array_rand($number)];

	//무료권 당첨
	$free = coupon_valid('free', $row['free_limit']);
	if($free_number <= $free_percent && $free){

		$sql = " INSERT INTO {$g5['giftbox_table']}
					SET 
					mb_id = '".$member['mb_id']."',
					gift_name = '무료권 쿠폰',
					co_type = 'F',
					datetime = '".date('Y-m-d H:i:s')."' ";
		sql_query($sql);

		echo 'free';
		exit;
	}
}

for($i=1; $i<=5; $i++){
	$point = point_random($row['point_min_'.$i], $row['point_max_'.$i], $row['point_percent_'.$i]);
	if($point){
		insert_point($member['mb_id'], $point, "출석체크 선물상자", "", $member['mb_nick'], G5_TIME_YMD);
		echo $point;
		exit;
	}
}

if($row['sorry_point']){
	insert_point($member['mb_id'], $row['sorry_point'], "출석체크 선물상자", "", $member['mb_nick'], G5_TIME_YMD);
	echo $row['sorry_point'];
	exit;
}

//꽝 다음기회에
echo 'sorry';
exit;

//해당월에 사용 가능한 잔여 쿠폰이 있는지 체크한다.
function coupon_valid($coupon, $limit){
	global $g5;
	$now = G5_TIME_YMDHIS;
	$currentyear = substr($now, 0, 4);
	$currentmonth = substr($now, 5, 2);
	$co_start = date_create($now);
	$begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
	$end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

	if($coupon=="sale"){
		$sql = "select * from {$g5['giftbox_table']} where co_type = 'S' and datetime >= '{$begin_datetime}' and datetime <= '{$end_datetime}'"; 
	} 

	if($coupon=="free"){
		$sql = "select * from {$g5['giftbox_table']} where co_type = 'F' and datetime >= '{$begin_datetime}' and datetime <= '{$end_datetime}'"; 		
	}

	$result = sql_query($sql);
	$count = sql_num_rows($result);

	return ($count < $limit) ? true : false;
}

//랜덤 포인트를 확률에 맞추어 추첨한다.
function point_random($min, $max, $percent){

	$point = array();

	for($i=$min; $i<=$max; $i++){
		array_push($point,$i);
	}

	$point = $point[array_rand($point)];

	$number  = array();

	for($i=1; $i<=100; $i++){
		array_push($number,$i);
	}

	$random_number = $number[array_rand($number)];

	return ($random_number <= $percent) ? $point : 0;
}