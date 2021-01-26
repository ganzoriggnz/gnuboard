<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($w == '' && $is_list) {
    // 한번만 출석체크
    if ($member['mb_id']) {
        $bo_1 = $board['bo_1'] ? explode('|', $board['bo_1']) : array(); // 자동 출석체크 문구

        unset($tmp);
        if ($is_admin != 'super') {
            $tmp = sql_fetch("select count(wr_id) as cnt from {$write_table} where wr_is_comment = 0 and wr_reply = '' and mb_id = '{$member['mb_id']}' and left(wr_datetime,10) = '".G5_TIME_YMD."'");
            if (intval($tmp['cnt']) > 0) {
                goto_url(short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table));
            }
        }
    }
}
