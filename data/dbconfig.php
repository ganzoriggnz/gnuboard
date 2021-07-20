<?php
if (!defined('_GNUBOARD_')) exit;
define('G5_MYSQL_HOST', 'localhost');
define('G5_MYSQL_USER', 'root');
define('G5_MYSQL_PASSWORD', '');
define('G5_MYSQL_DB', 'nariya');
define('G5_MYSQL_SET_MODE', true);

define('G5_TABLE_PREFIX', 'g5_');

$g5['write_prefix'] = G5_TABLE_PREFIX.'write_'; // 게시판 테이블명 접두사

$g5['auth_table'] = G5_TABLE_PREFIX.'auth'; // 관리권한 설정 테이블
$g5['config_table'] = G5_TABLE_PREFIX.'config'; // 기본환경 설정 테이블
$g5['group_table'] = G5_TABLE_PREFIX.'group'; // 게시판 그룹 테이블
$g5['group_member_table'] = G5_TABLE_PREFIX.'group_member'; // 게시판 그룹+회원 테이블
$g5['board_table'] = G5_TABLE_PREFIX.'board'; // 게시판 설정 테이블
$g5['board_file_table'] = G5_TABLE_PREFIX.'board_file'; // 게시판 첨부파일 테이블
$g5['board_good_table'] = G5_TABLE_PREFIX.'board_good'; // 게시물 추천,비추천 테이블
$g5['board_new_table'] = G5_TABLE_PREFIX.'board_new'; // 게시판 새글 테이블
$g5['login_table'] = G5_TABLE_PREFIX.'login'; // 로그인 테이블 (접속자수)
$g5['mail_table'] = G5_TABLE_PREFIX.'mail'; // 회원메일 테이블
$g5['member_table'] = G5_TABLE_PREFIX.'member'; // 회원 테이블
$g5['memo_table'] = G5_TABLE_PREFIX.'memo'; // 메모 테이블
$g5['poll_table'] = G5_TABLE_PREFIX.'poll'; // 투표 테이블
$g5['poll_etc_table'] = G5_TABLE_PREFIX.'poll_etc'; // 투표 기타의견 테이블
$g5['point_table'] = G5_TABLE_PREFIX.'point'; // 포인트 테이블
$g5['popular_table'] = G5_TABLE_PREFIX.'popular'; // 인기검색어 테이블
$g5['scrap_table'] = G5_TABLE_PREFIX.'scrap'; // 게시글 스크랩 테이블
$g5['visit_table'] = G5_TABLE_PREFIX.'visit'; // 방문자 테이블
$g5['visit_sum_table'] = G5_TABLE_PREFIX.'visit_sum'; // 방문자 합계 테이블
$g5['uniqid_table'] = G5_TABLE_PREFIX.'uniqid'; // 유니크한 값을 만드는 테이블
$g5['autosave_table'] = G5_TABLE_PREFIX.'autosave'; // 게시글 작성시 일정시간마다 글을 임시 저장하는 테이블
$g5['cert_history_table'] = G5_TABLE_PREFIX.'cert_history'; // 인증내역 테이블
$g5['qa_config_table'] = G5_TABLE_PREFIX.'qa_config'; // 1:1문의 설정테이블
$g5['qa_content_table'] = G5_TABLE_PREFIX.'qa_content'; // 1:1문의 테이블
$g5['content_table'] = G5_TABLE_PREFIX.'content'; // 내용(컨텐츠)정보 테이블
$g5['faq_table'] = G5_TABLE_PREFIX.'faq'; // 자주하시는 질문 테이블
$g5['faq_master_table'] = G5_TABLE_PREFIX.'faq_master'; // 자주하시는 질문 마스터 테이블
$g5['new_win_table'] = G5_TABLE_PREFIX.'new_win'; // 새창 테이블
$g5['menu_table'] = G5_TABLE_PREFIX.'menu'; // 메뉴관리 테이블
$g5['social_profile_table'] = G5_TABLE_PREFIX.'member_social_profiles'; // 소셜 로그인 테이블


$g5['coupon_table'] = G5_TABLE_PREFIX.'coupon'; // 쿠폰 테이블
$g5['coupon_sent_table'] = G5_TABLE_PREFIX.'coupon_sent'; // 쿠폰 send 테이블
$g5['coupon_alert_table'] = G5_TABLE_PREFIX.'coupon_alert'; // 쿠폰 alert 테이블
$g5['coupon_msg_table'] = G5_TABLE_PREFIX.'coupon_msg'; // 쿠폰 message 테이블
$g5['board_singo_table'] = G5_TABLE_PREFIX.'board_singo'; // 게시판 신고 테이블
$g5['na_shingo_table'] = G5_TABLE_PREFIX.'na_shingo'; // 게시판 신고 테이블

$g5['point2_table'] = G5_TABLE_PREFIX.'point2'; // 포인트 테이블
$g5['fragment_table'] = G5_TABLE_PREFIX.'fragment_admin_limit'; // 포인트 테이블
$g5['member_friends_table'] = G5_TABLE_PREFIX.'member_friends'; // 친구관리(나의 친구들)
$g5['pet_table'] = G5_TABLE_PREFIX.'pet'; // 펫 테이블
$g5['mission_table'] = G5_TABLE_PREFIX.'mission'; // 일일미션 테이블
$g5['read_table'] = G5_TABLE_PREFIX.'read'; // read 테이블
$g5['lev_point_table'] = G5_TABLE_PREFIX.'lev_point'; // level point 테이블
$g5['attendance_table'] = G5_TABLE_PREFIX.'attendance'; // attendance 테이블


?>