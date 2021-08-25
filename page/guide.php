<?php
include_once('../common.php');
$g5['title'] = "사이트안내";
include_once(G5_PATH.'/head.php');

$ranking = array(
	array('level'=>2, 'name'=>'Lv.2 해골', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'업소프로필 열람'),
	array('level'=>3, 'name'=>'Lv.3 노예', 'join'=>0, 'point'=>100, 'review'=>0, 'other'=>1, 'comment'=>3, 'auth'=>'	업소후기글 열람'),
	array('level'=>4, 'name'=>'Lv.4 농노', 'join'=>1, 'point'=>300, 'review'=>0, 'other'=>3, 'comment'=>5, 'auth'=>'	금화게임 참여가능'),
	array('level'=>5, 'name'=>'Lv.5 시민', 'join'=>7, 'point'=>1000, 'review'=>0, 'other'=>5, 'comment'=>10, 'auth'=>'추천 참여가능'),
	array('level'=>6, 'name'=>'Lv.6 기사', 'join'=>15, 'point'=>2000, 'review'=>1, 'other'=>10, 'comment'=>30, 'auth'=>'채팅방이용가능'),
	array('level'=>7, 'name'=>'Lv.7 남반', 'join'=>30, 'point'=>3000, 'review'=>3, 'other'=>15, 'comment'=>50, 'auth'=>'이벤트참여가능'),
	array('level'=>8, 'name'=>'Lv.8 장교', 'join'=>50, 'point'=>5000, 'review'=>5, 'other'=>20, 'comment'=>100, 'auth'=>'글작성시 확률에따라 추가 파운드 지급'),
	array('level'=>9, 'name'=>'Lv.9 향리', 'join'=>70, 'point'=>7000, 'review'=>7, 'other'=>30, 'comment'=>200, 'auth'=>'아이템 착용및 강화 가능, 구매/판매(거래)가능'),
	array('level'=>10, 'name'=>'Lv.10 서리', 'join'=>100, 'point'=>10000, 'review'=>10, 'other'=>50, 'comment'=>300, 'auth'=>'사진등록 가능'),
	array('level'=>11, 'name'=>'Lv.11 성주', 'join'=>150, 'point'=>20000, 'review'=>20, 'other'=>70, 'comment'=>450, 'auth'=>'	내상후기 작성가능'),
	array('level'=>12, 'name'=>'Lv.12 작사', 'join'=>200, 'point'=>30000, 'review'=>30, 'other'=>150, 'comment'=>500, 'auth'=>'회원검색 가능'),
	array('level'=>13, 'name'=>'Lv.13 남작', 'join'=>250, 'point'=>50000, 'review'=>50, 'other'=>200, 'comment'=>600, 'auth'=>'파운드 현금 전환가능 (10만이상)게임에서 취득한 파운드는 직급과금액 상관없이 환전가능'),
	array('level'=>14, 'name'=>'Lv.14 자작', 'join'=>300, 'point'=>70000, 'review'=>70, 'other'=>250, 'comment'=>700, 'auth'=>'닉네임 변경,게시글 제목 색상 변경가능'),
	array('level'=>15, 'name'=>'Lv.15 백작', 'join'=>350, 'point'=>100000, 'review'=>80, 'other'=>300, 'comment'=>800, 'auth'=>'가문을 개설할수있는 권한'),
	array('level'=>16, 'name'=>'Lv.16 후작', 'join'=>400, 'point'=>200000, 'review'=>100, 'other'=>350, 'comment'=>1000, 'auth'=>'딜러비 30% 할인 아바타 지급'),
	array('level'=>17, 'name'=>'Lv.17 공작', 'join'=>450, 'point'=>300000, 'review'=>120, 'other'=>400, 'comment'=>1500, 'auth'=>'딜러비 50% 할인 아바타 지급'),
	array('level'=>18, 'name'=>'Lv.18 대공', 'join'=>500, 'point'=>400000, 'review'=>150, 'other'=>450, 'comment'=>2000, 'auth'=>'추기경 또는 교황에 추대 받을수있음'),
	array('level'=>19, 'name'=>'Lv.19 왕자', 'join'=>600, 'point'=>600000, 'review'=>200, 'other'=>500, 'comment'=>2500, 'auth'=>'제휴업소 무료쿠폰 1장 제공'),
	array('level'=>20, 'name'=>'Lv.20 왕', 'join'=>700, 'point'=>800000, 'review'=>250, 'other'=>600, 'comment'=>3000, 'auth'=>'제휴업소 무료쿠폰 2장 제공'),
	array('level'=>21, 'name'=>'Lv.21 국왕', 'join'=>800, 'point'=>1000000, 'review'=>300, 'other'=>700, 'comment'=>3500, 'auth'=>'진급시 일회성 10만+ 매원무료권 지급'),
	array('level'=>22, 'name'=>'Lv.22 태자', 'join'=>900, 'point'=>1500000, 'review'=>400, 'other'=>800, 'comment'=>4000, 'auth'=>'진급시 일회성 20만+ 매월무료권 지급'),
	array('level'=>23, 'name'=>'Lv.23 황제', 'join'=>1000, 'point'=>2000000, 'review'=>500, 'other'=>1000, 'comment'=>5000, 'auth'=>'진급시 일회성 30만+ 매월무료권 지급'),
	array('level'=>24, 'name'=>'Lv.24 추기경', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'해당 게시판 쿠폰이벤트 진행 및 게시글 관리'),
	array('level'=>25, 'name'=>'Lv.25 교황', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'해당 게시판 쿠폰이벤트 진행 및 게시글 관리'),
	array('level'=>26, 'name'=>'Lv.26 법사', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'제휴가 만료된 업소'),
	array('level'=>27, 'name'=>'Lv.27 법사', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'업소정보 게시판 홍보 권한'),
	array('level'=>30, 'name'=>'밤의제국', 'join'=>0, 'point'=>0, 'review'=>0, 'other'=>0, 'comment'=>0, 'auth'=>'밤의제국(밤제)운영자')
);

if($is_member){
	$join_day = floor((time() - strtotime($member['mb_datetime']))/86400);
	$cnt_review=0;
	$cnt_other=0;
	$cnt_revcomment=0;
	$cnt_otcomment=0;
	$cnt_comment=0;

	$result1 = sql_query("select bo_table, bo_subject from {$g5['board_table']} WHERE gr_id = 'review'");        
        
	while ($row = sql_fetch_array($result1)) {
		$bo_table = $row['bo_table'];

			$sql1 = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '0'");                    
			while($resee = sql_fetch_array($sql1)){                       
				$cnt_review++;
			}
			$sql_rev = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '1'");                 
			while($res = sql_fetch_array($sql_rev)){                    
				$cnt_revcomment++;
			}                                                                            
	}

	$result2 = sql_query("select bo_table, bo_subject from {$g5['board_table']} WHERE gr_id != 'review'");        
	
	while ($row = sql_fetch_array($result2)) {
		$bo_table = $row['bo_table'];

			$sql2 = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '0'");                    
			while($resee = sql_fetch_array($sql2)){                       
				$cnt_other++;
			}
			$sql_ot = sql_query("select * from " .$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}' and wr_is_comment = '1'");                 
			while($res = sql_fetch_array($sql_ot)){                    
				$cnt_otcomment++;
			}                                     
	}
	$cnt_comment = $cnt_revcomment+$cnt_otcomment;
}

function wonUnit($number){
	$text = '';
	if($number >= 1000 && $number < 10000){
		$text = $number / 1000;
		return $text.'천';
	} else if($number >= 10000){
		$text = $number / 10000;
		return $text.'만';
	} else {
		return $number;
	}
}

function compareNumber($member_level, $level, $member_num, $num, $format=false){
	$html = '';
	if($num && $level < 24 && $member_level+1==$level){
		if($member_num < $num){
			if($format) $html = '<span class="text-danger">'.$member_num.'/'.wonUnit($num).'</span>';
			else $html = '<span class="text-danger">'.$member_num.'/'.$num.'</span>';
		} else {
			if($format) $html = number_format($member_num).'/'.wonUnit($num);
			else $html = $member_num.'/'.$num;
		}
	} else {
		if($format) $html = ($num) ? wonUnit($num) : '-';
		else $html = ($num) ? $num : '-';
	}
	return $html;
}
?>
<style>
.guide-wrap{
	padding:10px;
}
.guide-wrap thead th{
	background-color:#e6dcc1;
	border-bottom-width: 1px;
	border-color:#b1b1b1;
}
.guide-wrap thead th, .guide-wrap tbody th, .guide-wrap tbody td{
	text-align: center;
	vertical-align: middle;
}
.guide-wrap tbody tr.active{
	background-color: #f1ebd9;
}
.guide-wrap tbody tr.next{
	background-color: #fdecee;
}
.guide-wrap p{
	line-height:1.8;
}
.guide-wrap .btn-primary{
	background-color: #cfb56ed0 !important;
	border-color: #e4c980 !important;
}

</style>
<div class="guide-wrap">
	<h1 class="text-center mt-5 mb-5">BAMJE 밤의제국 커뮤니티 사이트 이용안내</h1>
	<div class="caution">
		<h4 class="mb-3">1. 사이트 이용시 주의사항</h4>
		<p class="mb-2">밤의제국 커뮤니티 사이트 이용시 기본적으로 아래 5가지 사항은 반드시 지켜주세요.</p>
		<p>① 상대방을 모욕하는 비방성글이나 욕설 금지</p>
		<p>② 무분별한 광고글 및 불법자료 관련글 금지</p>
		<p>③ 타사이트 다른 사람의 후기글펌 및 가라후기 금지</p>
		<p>④ 개인정보유출 또는 사기등의 금전거래를 목적으로 하는 글 금</p>
		<div class="mt-3">
			<p class="text-danger">저희 사이트는 타사이트와 다르게 파운드(포인트)를 1:1 비율로 현금 환전을 해드리고 있는 관계로</p>
			<p class="text-danger">파운드 획득을 위한 1인이 다수의 아이디 생성,도배 및 어뷰징 등의 행위자는 통보없이 "파운드 몰수" 또는 "회원정지" 또는 "사이트 접근차단" 등의 조치를 받을 수 있습니다.</p>
		</div>
	</div>

	<div class="ranking mt-5">
		<h4 class="mb-3">2. 회원등급 제도 안내</h4>
		<p>BAMJE 커뮤니티 사이트는 회원등급에 따라 이용하실 수 있는 서비스에 차이가 발생할 수 있습니다.</p>

		<?php if($is_member){?>
		<div class="table-responsive">
			<table class="table table-bordered mt-3 mb-5" style="min-width: 600px;">
				<thead>
					<tr>
						<th>현재레벨</th>
						<th>가입일</th>
						<th>보유 포인트</th>
						<th>후기 작성개수</th>
						<th>게시글 작성개수</th>
						<th>댓글 작성개수</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo get_level($member['mb_id']).' '.get_level_name($member['mb_level']).' Lv.'.$member['mb_level']; ?></td>
						<td><?=$join_day;?>일</td>
						<td><?=number_format($member['mb_point']);?>P</td>
						<td><?=$cnt_review;?>개</td>
						<td><?=$cnt_other;?>개</td>
						<td><?=$cnt_comment;?>개</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php }?>

		<div class="table-responsive">
			<table class="table table-bordered mt-3" style="min-width: 800px;">
				<colgroup>
					<col style="width: 8%;">
					<col style="width: 14%;">
					<col span="5" style="width: 10%;">
					<col>
					<?php if($is_member){?>
					<col style="width: 10%;">
					<?php }?>
				</colgroup>
				<thead>
					<tr>
						<th>아이콘</th>
						<th>직급</th>
						<th>가입일</th>
						<th>파운드</th>
						<th>후기</th>
						<th>게시글</th>
						<th>코멘트</th>
						<th>권한</th>
						<?php if($is_member){?>
						<th>레벨업</th>
						<?php }?>
					</tr>
				</thead>	
				<tbody>
					<?php foreach($ranking as $key=>$val){?>
					<tr class="
						<?php echo ($member['mb_level']==$val['level']) ? 'active' : '';?><?php echo ($is_member && $val['level'] < 24 && $member['mb_level']+1==$val['level']) ? 'next' : '';?>">
						<td><img src="/img/<?=$val['level'];?>.png"></td>
						<td><?php echo ($val['name']) ? $val['name'] : '-';?></td>
						<td><?php echo compareNumber($member['mb_level'], $val['level'], $join_day, $val['join']);?></td>
						<td><?php echo compareNumber($member['mb_level'], $val['level'], $member['mb_point'], $val['point'], true);?></td>
						<td><?php echo compareNumber($member['mb_level'], $val['level'], $cnt_review, $val['review'], true);?></td>
						<td><?php echo compareNumber($member['mb_level'], $val['level'], $cnt_other, $val['other'], true);?></td>
						<td><?php echo compareNumber($member['mb_level'], $val['level'], $cnt_comment, $val['comment'], true);?></td>
						<td class="text-left"><?php echo $val['auth'];?></td>
						<?php if($is_member){?>
						<th>
							<?php echo ($member['mb_level']==$val['level']) ? '현재레벨' : '';?>
							<?php echo ($val['level'] < 24 && $member['mb_level']+1==$val['level']) ? '<span class="text-danger">등업조건미달</span>' : '';?>
						</th>
						<?php }?>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="point mt-5">
		<h4 class="mb-3">3.파운드(포인트) 제도 안내</h4>
		<p>- 밤제 커뮤니티 사이트는 사이트 활성화와 다양한 혜택을 서비스하기 위해 파운드(포인트) 제도를 운영하고 있습니다.</p>
		<p>- 사이트 내 컨텐츠 이용시 현금처럼 사용할 수 있는 파운드는 현금대비 1:1로 운영됩니다. 파운드정책은 수시로 변경될 수 있으며, 이를 별도로 통보하지 않습니다. </p>
		<p>- 파운드획득을 위한 1인이 다수의 아이디 생성, 도배 및 어뷰징 등의 행위자는 통보없이 "파운드 몰수" 또는 "회원정지" 또는 "사이트 접근차단" 등의 조치를 받을 수 있습니다.</p>
		<p>- 회원가입시(1회) 100파운드지급 트위터팔로우 500파운드지급, 각 쪽지발송시(매회) -10파운드 차감</p>
		<div class="table-responsive">
			<table class="table table-bordered mt-3" style="min-width:550px;">
				<col span="5" style="width: 20%;">
				<thead>
					<tr>
						<th class="align-middle" rowspan="2">그룹명</th>
						<th class="align-middle" rowspan="2">게시판명</th>
						<th colspan="3">파운드</th>
					</tr>
					<tr>
						<th>쓰기</th>
						<th>댓글</th>
						<th>다운</th>				
					</tr>
				</thead>
				<tbody>
					<tr>
						<th rowspan="11">커뮤니티</th>
						<td>출석체크</td>
						<td>10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>공지사항</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>가입인사</td>
						<td>300</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>자유게시판</td>
						<td>10</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>이벤트</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>왕궁 게시판</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>미수다</td>
						<td>30</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건의사항</td>
						<td>50</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>아이템 샾</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>가문게시판</td>
						<td>30</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>구인구직</td>
						<td>-100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<th rowspan="26">출근부</th>
						<td>오피-강남영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-비강남영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-경기영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-인천/부천영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-강원/충청/대전영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-경상영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-대구영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-전라/제주영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>안마-서울영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>안마-지방영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-서울영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-경기영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-인천/부천영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-강원/충청/대전영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-경상/전라/제주영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>술집-서울영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>술집-지방영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-서울영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-경기영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-인천/부천영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-강원/충청/대전</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-경상/전라/제주</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>키스방-전국영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>립카페-전국영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>핸플/패티쉬영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>선불폰/프로필 여행사/기타</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<th rowspan="26">후기</th>
						<td>오피-강남영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-비강남영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-경기영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-인천/부천영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-강원/충청/대전영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-경상영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-대구영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>오피-전라/제주영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>안마-서울영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>안마-지방영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-서울영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-경기영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-인천/부천영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-강원/충청/대전영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>건마-경상/전라/제주영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>술집-서울영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>술집-지방영토</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-서울영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-경기영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-인천/부천영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-강원/충청/대전</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>휴게텔-경상/전라/제주</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>키스방-전국영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>립카페-전국영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>핸플/패티쉬영토</td>
						<td>100</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<td>선불폰/프로필 여행사/기타</td>
						<td>-</td>
						<td>2</td>
						<td>-</td>
					</tr>
					<tr>
						<th rowspan="4">자료실</th>
						<td>영화</td>
						<td>10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>TV영상</td>
						<td>10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>웹툰/야설</td>
						<td>10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>유튜브 영상</td>
						<td>10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<th rowspan="4">고객센터</th>
						<td>쪽지</td>
						<td>-10</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>펫 기르기</td>
						<td>50</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>일일미션</td>
						<td>50</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td>트위터 인증</td>
						<td>500</td>
						<td>-</td>
						<td>-</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="limit mt-5" style="margin-bottom:80px;">
		<h4 class="mb-3">4.각 게시판 일일 글작성 제한</h4>
		<table class="table table-bordered mt-3">
			<col span="4" style="width: 25%;">
			<thead>
				<tr>
					<th>그룹명</th>
					<th>게시판명</th>
					<th>쓰기(원글)</th>
					<th>쓰기(댓글)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>출근부</th>
					<td>업소정보</td>
					<td>-</td>
					<td>5</td>
				</tr>
				<tr>
					<th>후기</th>
					<td>업소후기</td>
					<td>1</td>
					<td>10</td>
				</tr>
				<tr>
					<th rowspan="8">커뮤니티</th>
					<td>공지사항</td>
					<td>-</td>
					<td>5</td>
				</tr>
				<tr>
					<td>가입인사</td>
					<td>1</td>
					<td>5</td>
				</tr>
				<tr>
					<td>자유게시판</td>
					<td>3</td>
					<td>15</td>
				</tr>
				<tr>
					<td>미수다</td>
					<td>1</td>
					<td>5</td>
				</tr>
				<tr>
					<td>이벤트</td>
					<td>1</td>
					<td>3</td>
				</tr>
				<tr>
					<td>가문게시판</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<tr>
					<td>왕궁게시판</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<tr>
					<td>건의사항</td>
					<td>1</td>
					<td>1</td>
				</tr>
				<tr>
					<th rowspan="4">자료실</th>
					<td>영화</td>
					<td>1</td>
					<td>-</td>
				</tr>
				<tr>
					<td>TV영상</td>
					<td>1</td>
					<td>-</td>
				</tr>
				<tr>
					<td>웹툰/야설</td>
					<td>1</td>
					<td>-</td>
				</tr>
				<tr>
					<td>유튜브</td>
					<td>1</td>
					<td>-</td>
				</tr>
				<tr>
					<th>퀵메뉴</th>
					<td>제휴문의</td>
					<td>2</td>
					<td>2</td>
				</tr>
				<tr>
					<th>고객센터</th>
					<td>구인구직 게시판</td>
					<td>1</td>
					<td>1</td>
				</tr>
			</tbody>
		</table>
		<?php if($is_member && $member['mb_level'] < 24 && $member['mb_8']!='Y'){?>
		<div class="mt-5 text-right">
			<a class="btn btn-primary btn-lg" href="/page/guide_point.php"><strong>확인</strong></a>
		</div>
		<?php }?>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>