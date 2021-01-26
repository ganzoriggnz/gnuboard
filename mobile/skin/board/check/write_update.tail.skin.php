<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($w == '' && $is_list) {
    // 글 작성 후 목록으로 이동
    goto_url(short_url_clean(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table));
}
