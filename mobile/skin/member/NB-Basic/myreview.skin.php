<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<style>
.d-flex {
    font-size: 12px;
}

#user_cate_ul li a {
    padding: 2px 5px 2px 5px;
}
</style>
<nav id="user_cate" class="sly-tab font-weight-normal mb-2">
    <?php
    $myreview = "actived";
    include 'infotab.php';?>
</nav>
<!-- 후기 목록 시작 { -->

<section id="bo_list" class="mb-4">
    <?php
    $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
    while ($row = sql_fetch_array($result)) {
        $bo_table = $row['bo_table'];
           
        $res = sql_fetch("select wr_id from " . $g5['write_prefix'] . $bo_table . " where mb_id='{$member['mb_id']}'");
        if ($res) {
            $scount = strlen($bo_table) - 2;
            $bo_table =  substr($bo_table, 0, $scount);?>
    <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table."re"?>">
        <font color="black"><b>후기게시판 바로가기</b></font>
    </a>
    <?php } } ?>
    <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>
    <!-- 목록 헤드 -->

    <table cellspacing="0" class="w-100 px-3 mr-3" cellpadding="0" width="100%"
        style="border:1px solid #d3d3d3;font-size: 12px; padding:5px;" id="level-up">
        <thead class="bg-light">
            <tr style="border:1px solid #d3d3d3;font-size: 12px; text-align: center; ">
                <th class="cl_tr">번호</th>
                <th class="cl_tl">제목</th>
                <th class="cl_tr">작성자</th>
                <th class="cl_tr">일시</th>
            </tr>
        </thead>
        <tbody>
            <?php 
        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='review' ");
        $k++;
        while ($row = sql_fetch_array($result)) {
            $bo_table = $row['bo_table'];
                $res = sql_query("select * from " . $g5['write_prefix'] . $bo_table . " where wr_7 ='{$member['mb_name']}' order by wr_datetime DESC");
                while ($res1 = sql_fetch_array( $res)) {?>
            <tr style="border:1px solid #d3d3d3;font-size: 10px; text-align: center; ">
                <th class="cl_tr"><?php echo $res1['wr_id']?></th>
                <th class="cl_tl" style="text-align: left;">
                    <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table?><?php echo "&wr_id=",$res1['wr_id']?>"
                        style="color: #6c757d;">
                        <?php echo $res1['wr_subject']; ?>
                    </a>
                </th>
                <th class="cl_tr" style="color: #6c757d; text-align: left;">
                    <?php echo get_level($res1['mb_id']), $res1['wr_name'] ?></th>
                <th class="cl_tr" style="color: #6c757d;"> <?php echo $res1['wr_datetime']; ?></th>
            </tr>
            <?php $k++; }
        } ?>
            </body>
    </table>
    <?php if ($i == 0) { ?>
    <div class="f-de font-weight-normal px-3 py-5 text-muted text-center border-bottom">자료가 없습니다.</div>
    <?php } ?>
    <div class="font-weight-normal px-3 mt-4">
        <ul class="pagination justify-content-center en mb-0">
            <?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page="); ?>
        </ul>
    </div>
</section>