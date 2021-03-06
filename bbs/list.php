<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);

//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;
$sql;
if ($sca || $stx || $stx === '0') {     //검색이면
    $is_search_bbs = true;      //검색구분변수 true 지정

    $sql_search = get_sql_search($sca, $sfl, $stx, $sop, $board['gr_id']);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql = " select count(distinct `wr_parent`) as `cnt` from {$write_table} ";

    if ($gr_id) {
        $sql .= " a left join g5_member b on a.mb_id = b.mb_id ";
    }

    $sql .= " where {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = "select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {

    $sql_search = "";
    $total_count = $board['bo_count_write'];
    // var_dump($board);die;
}
// var_dump($sql);die;


if (G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) {
    $page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$event_count = 0;
$best_count = 0;
$notice_array = array();
$event_array = array();
$best_array = array();
$coupon_array = array();

// 공지 처리
if (!$is_search_bbs) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $arr_event = explode(',', trim($board['bo_3']));
    $arr_best = explode(',', trim($board['bo_4']));
    $arr_coupon = explode(',', trim($board['bo_8_subj']));
    $from_notice_idx = ($page - 1) * $page_rows;
    $from_event_idx = ($page - 1) * $page_rows;
    $from_best_idx = ($page - 1) * $page_rows;
    $from_coupon_idx = ($page - 1) * $page_rows;
    if ($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    if ($from_event_idx < 0)
        $from_event_idx = 0;
    $board_event_count = count($arr_event);

    if ($from_best_idx < 0)
        $from_best_idx = 0;
    $board_best_count = count($arr_best);

    if ($from_coupon_idx < 0)
        $from_coupon_idx = 0;
    $board_coupon_count = count($arr_coupon);

    for ($k = 0; $k < $board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if ($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if ($notice_count >= $list_page_rows)
            break;
    }
    for ($k = 0; $k < $board_event_count; $k++) {
        if (trim($arr_event[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_event[$k]}' ");

        if (!$row['wr_id']) continue;

        $event_array[] = $row['wr_id'];

        if ($k < $from_event_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_eventcheck'] = true;
        $i++;
        $event_count++;
        if ($event_count >= $list_page_rows)
            break;
    }
    for ($k = 0; $k < $board_best_count; $k++) {
        if (trim($arr_event[$k]) == '') continue;
        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_best[$k]}' ");
        if (!$row['wr_id']) continue;
        $best_array[] = $row['wr_id'];
        if ($k < $from_best_idx) continue;
        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_best'] = true;
        $i++;
        $best_count++;
        if ($best_count >= $list_page_rows)
            break;
    }
    /* for ($k = 0; $k < $board_coupon_count; $k++) {
        if (trim($arr_event[$k]) == '') continue;
        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_coupon[$k]}' ");
        if (!$row['wr_id']) continue;
        $coupon_array[] = $row['wr_id'];
        if ($k < $from_coupon_idx) continue;
        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_coupon'] = true;
        $i++;
        $coupon_count++;
        if ($coupon_count >= $list_page_rows)
            break;
    } */
}

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if (!empty($notice_array)) {
    $from_record -= count($notice_array);

    if ($from_record < 0)
        $from_record = 0;

    if ($notice_count > 0)
        $page_rows -= $notice_count;

    if ($page_rows < 0)
        $page_rows = $list_page_rows;
}
if (!empty($event_array)) {
    $from_record -= count($event_array);

    if ($from_record < 0)
        $from_record = 0;

    if ($event_count > 0)
        $page_rows -= $event_count;

    if ($page_rows < 0)
        $page_rows = $list_page_rows;
}
if (!empty($best_array)) {
    $from_record -= count($best_array);

    if ($from_record < 0)
        $from_record = 0;

    if ($best_count > 0)
        $page_rows -= $best_count;

    if ($page_rows < 0)
        $page_rows = $list_page_rows;
}
if (!empty($coupon_array)) {
    $from_record -= count($coupon_array);

    if ($from_record < 0)
        $from_record = 0;

    if ($coupon_count > 0)
        $page_rows -= $coupon_count;

    if ($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table=' . $bo_table . '&amp;sop=' . $sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    $board_sort_fields = get_board_sort_fields($board, 1);
    if (!$sod && array_key_exists($sst, $board_sort_fields)) {
        $sst = $board_sort_fields[$sst];
    } else {
        // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
        // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
        // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
        $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    }
}

if (!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

$nameddd = "";

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

if ($_GET['nameid']) {
    $nameddd = " and wr_7 = '" . get_member($_GET['nameid'])['mb_name'] . "'";
    // alert($nameddd);
}

if ($is_search_bbs) {
    $sql = " select distinct wr_parent from {$write_table} ";

    if ($gr_id) {
        $sql .= " a left join g5_member b on a.mb_id = b.mb_id ";
    }

    $sql .= " where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    //$sql = " select *, exists(select 1 from {$g5['member_table']} c where c.mb_level='27' and c.mb_id=a.mb_id) lvl_27, exists(select 1 from g5_coupon d where d.co_free_num>'0' and d.co_sale_num>'0' and d.co_begin_datetime='$co_begin_datetime' and d.mb_id=a.mb_id) has_coupon from {$write_table} a where a.wr_is_comment = 0  " . $nameddd;
	$sql = " select *, exists(select 1 from {$g5['member_table']} c where c.mb_level='27' and c.mb_id=a.mb_id) lvl_27, exists(select 1 from g5_coupon d where (d.co_free_num>'0' or d.co_sale_num>'0') and d.co_begin_datetime='$co_begin_datetime' and d.mb_id=a.mb_id) has_coupon from {$write_table} a where a.wr_is_comment = 0  " . $nameddd;
    $mddd_id = "";
    if (!empty($notice_array))
        $mddd_id .= implode(', ', $notice_array);
    if (!empty($event_array))
        $mddd_id .= ", " . implode(', ', $event_array);
    if (!empty($best_array))
        $mddd_id .= ", " . implode(', ', $best_array);
    if (!empty($coupon_array))
        $mddd_id .= ", " . implode(', ', $coupon_array);

    if (!$mddd_id)
        $sql .= " and a.wr_id ";

    if ($mddd_id)
        $sql .= " and a.wr_id not in (" . $mddd_id . ")";
    $sql .= " {$sql_order} limit {$from_record}, {$page_rows} ";
}
// var_dump($sql);die;
// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if ($page_rows > 0) {

    $result = sql_query($sql);
    // var_dump($result);die;
    $k = 0;
    // var_dump($result);die;


    while ($row = sql_fetch_array($result)) {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($is_search_bbs) {
            $query = " select *,  exists(select 1 from {$g5['member_table']} c where c.mb_level='27' and c.mb_id=a.mb_id) lvl_27,  exists(select 1 from g5_coupon d where (d.co_free_num>'0' or d.co_sale_num>'0') and d.co_begin_datetime='$co_begin_datetime' and d.mb_id=a.mb_id) has_coupon from {$write_table} a ";

            if ($gr_id == 'attendance' && $stx == 'mb_name') {
                $query .= " a left join g5_member b on a.mb_id = b.mb_id ";
            }

            $query .= " where wr_id = '{$row['wr_parent']}' ";

            if ($gr_id == 'attendance' && $stx == 'mb_name') {
                $query .= " and b.mb_name = '{$stx}' ";
            }
            // var_dump($query);die;
            $row = sql_fetch($query);
        }

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list[$i]['is_eventcheck'] = false;
        $list[$i]['is_best'] = false;

        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count - $event_count - $best_count - $coupon_count;
        $list[$i]['num'] = $list_num - $k;

        $k++;
        $i++;
    }

}
// var_dump($k);
// var_dump($list);die;

g5_latest_cache_data($board['bo_table'], $list);

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, get_pretty_url($bo_table, '', $qstr . '&amp;page='));

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($is_search_bbs) {
    $list_href = get_pretty_url($bo_table);

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = get_pretty_url($bo_table, 0, $qstr1 . '&amp;spt=' . $prev_spt . '&amp;page=1');
        $write_pages = page_insertbefore($write_pages, '<a href="' . $prev_part_href . '" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = get_pretty_url($bo_table, 0, $qstr1 . '&amp;spt=' . $next_spt . '&amp;page=1');
        $write_pages = page_insertafter($write_pages, '<a href="' . $next_part_href . '" class="pg_page pg_end">다음검색</a>');
    }
}

$write_href = '';
if (($bo_table != 'suggestions' && $member['mb_level'] >= $board['bo_write_level']) || ($bo_table == 'suggestions' && $member['mb_level'] > 1)) {
    $write_href = short_url_clean(G5_BBS_URL . '/write.php?bo_table=' . $bo_table);
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = G5_BBS_URL . '/rss.php?bo_table=' . $bo_table;
}

// // 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = get_pretty_url($bo_table);

    $category_option .= '<li><a href="' . $category_href . '"';
    if ($sca == '') {
        $category_option .= ' id="bo_cate_on"';
        $category_option .= '>전체</a></li>';
    } else
        $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음

    for ($i = 0; $i < count($categories); $i++) {

        $category = trim($categories[$i]);
        if ($category == '') continue;
        $category_option .= '<li><a href="' . (get_pretty_url($bo_table, '', 'sca=' . urlencode($category))) . '"';
        $category_msg = '';
        if ($category == $sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
            $category_option .= '>' . $category_msg . $category . '</a></li>';
        } else
            $category_option .= '>' . $category_msg . $category . '</a></li>';
    }
}

include_once($board_skin_path . '/list.skin.php');
