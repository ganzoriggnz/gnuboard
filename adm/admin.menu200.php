<?php
$menu['menu200'] = array (
    array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
    array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
    array('200150', '회원등급설정', G5_ADMIN_URL.'/member_lev_conf.php', 'mb_lev_conf'),
    array('200300', '회원메일발송', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),
    array('200800', '접속자집계', G5_ADMIN_URL.'/visit_list.php', 'mb_visit', 1),
    array('200810', '접속자검색', G5_ADMIN_URL.'/visit_search.php', 'mb_search', 1),
    array('200820', '접속자로그삭제', G5_ADMIN_URL.'/visit_delete.php', 'mb_delete', 1),
    array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
    array('200400', '파편조각관리', G5_ADMIN_URL.'/fragment_list.php', 'mb_fragment'),   //  chiniih
    array('200500', '레벨별포인트지급', G5_ADMIN_URL.'/point_listlevel.php', 'mb_point2'),
    array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll'),
    array('200910', '전체쪽지보내기', G5_ADMIN_URL.'/memo.php', 'mb_memo'),
    array('200600', '등업파운드설정 ', G5_ADMIN_URL.'/lev_point.php', 'lev_point_setting'),
    array('200610', '럭키포인트설정 ', G5_ADMIN_URL.'/lucky_point.php', 'lucky_point_setting'),
);
?>