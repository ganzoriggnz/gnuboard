<<<<<<< HEAD
<?php
include_once("./_common.php");
$g5['title'] = '게시판 관리자 리스트';
include_once(G5_THEME_PATH . '/head.php');
?>
<style type="text/css">
    #po_rank {
        position: relative;
        margin: 0 auto;
        width: 100%
    }

    #po_rank h2 {
        background: #E6DCC1;
        border: 1px solid #d6d6d6;
        padding: 14px 10px;
        font-size: 12px;
        color: #4c4e4d
    }

    #po_rank .my_rank {
        position: absolute;
        top: 16px;
        right: 10px;
        color: #666666;
        font-size: 11px
    }

    #po_rank .my_rank strong {
        color: #ff6600
    }

    #po_rank .tbl_rank {
        margin: 5px 0 20px
    }

    #po_rank .tbl_rank table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0
    }

    #po_rank .tbl_rank caption {
        padding: 0;
        font-size: 0;
        line-height: 0;
        overflow: hidden
    }

    #po_rank .tbl_rank thead th {
        height: 30px;
        line-height: 30px;
        border-bottom: 2px solid #aaa;
        background: #E6DCC1;
        color: #383838;
        font-size: 11px;
        font-weight: normal;
        text-align: center
    }

    #po_rank .tbl_rank .th_point {
        text-align: right;
        padding-right: 10px
    }

    #po_rank .tbl_rank td {
        border-top: 1px solid #eceff3;
        border-bottom: 1px solid #eceff3;
        line-height: 23px;
        word-break: break-all
    }

    #po_rank .tbl_rank tr:hover {
        background: #f8f8f8
    }

    /* #po_rank .tbl_rank tr:first-child {
        background: #ecf7f8
    } */

    #po_rank .tbl_rank a {}

    #po_rank .td_prank {
        width: 120px;
        text-align: center;
        color: #ffffff
    }

    #po_rank .td_boname {
        text-align: left;
        padding-left: 5px
    }

    #po_rank .td_boadmin {
        width: 120px;
        text-align: center
    }

    #po_rank .td_gradmin {
        width: 120px;
        text-align: center
    }

    #po_rank .td_bolevel {
        width: 120px;
        text-align: center
    }

    #po_rank .td_grlevel {
        width: 120px;
        text-align: center
    }

    /* #po_rank .td_point {width:70px;text-align:right;padding-right:10px;color:#d41d4b;font-family:verdana;font-size:10px;font-weight:bold} */
    #po_rank .rank_num {
        position: relative;
        margin: 4px 0
    }

    #po_rank .rank_num .rank_bg {
        display: inline-block;
        width: 21px;
        line-height: 22px;
        font-size: 11px;
        text-align: center;
        color: #fff;
        text-indent: -1px
    }
</style>

<div id="po_rank">
    <h2>게시판 담당자 리스트</h2>

    <div class="tbl_rank">
        <table>
            <caption>게시판 담당자</caption>
            <thead>
                <tr>
                    <!-- <th></th> -->
                    <th>게시판명</th>
                    <th>게시판 담당자 레벨</th>
                    <th>게시판 담당자</th>
                    <th> 그룹 담당자 레벨</th>
                    <th>게시판 그룹 담당자</th>

                    <!-- <th class="th_point"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $rank_rows = 100; //출력 수

                $result = sql_query(" select b.gr_subject, b.gr_admin, a.bo_subject, a.bo_admin, c.mb_level as m1_level, d.mb_level as m2_level from {$g5['board_table']} a Inner Join {$g5['group_table']} b  on a.gr_id = b.gr_id Left Join {$g5['member_table']} c on a.bo_admin = c.mb_id Left Join {$g5['member_table']} d on b.gr_admin = d.mb_id", false);

                // $sql = " select * from {$g5['member_table']} where mb_id = b.gr_admin ";
                // $result1 = sql_query($sql);


                for ($i = 0; $row = sql_fetch_array($result, $result1); $i++) {
                    // $rank = number_format($i + 1);
                    //$name = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);
                    $name = $row['bo_subject'];
                    $gradmin = $row['gr_admin'];
                    $boadmin = $row['bo_admin'];
                    $bolevel = $row['m1_level'];
                    $grlevel = $row['m2_level'];

                ?>

                    <tr>
                        <!-- <td class="td_prank"><div class="rank_num"><span class="rank_bg" style="background:<?php echo $bg ?>"><?php echo $rank; ?></span></div></td> -->
                        <td class="td_boname"><?php echo $name; ?></td>
                        <td class="td_bolevel"><?php echo  grade($bolevel);  ?></td>
                        <td class="td_boadmin"><?php echo $boadmin; ?></td>
                        <td class="td_grlevel"><?php echo  grade($grlevel); ?></td>
                        <td class="td_gradmin"><?php echo  $gradmin; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once(G5_THEME_PATH . '/tail.php');
?>
<?php function grade($level)
{
    if ($level == 2) {
        echo "노예";
    } else if ($level == 3) {
        echo "농노";
    } else if ($level == 4) {
        echo "시민";
    } else if ($level == 5) {
        echo "기사";
    } else if ($level == 6) {
        echo "남반";
    } else if ($level == 7) {
        echo "장교";
    } else if ($level == 8) {
        echo "향리";
    } else if ($level == 9) {
        echo "서리";
    } else if ($level == 10) {
        echo "성주";
    } else if ($level == 11) {
        echo "작사";
    } else if ($level == 12) {
        echo "남작";
    } else if ($level == 13) {
        echo "자작";
    } else if ($level == 14) {
        echo "백작";
    } else if ($level == 15) {
        echo "후작";
    } else if ($level == 16) {
        echo "공작";
    } else if ($level == 17) {
        echo "대공";
    } else if ($level == 18) {
        echo "왕자";
    } else if ($level == 19) {
        echo "왕";
    } else if ($level == 20) {
        echo "국왕";
    } else if ($level == 21) {
        echo "태자";
    } else if ($level == 22) {
        echo "황제";
    } else if ($level == 24) {
        echo "추기경";
    } else if ($level == 25) {
        echo "교황";
    } else if ($level == 26) {
        echo "법사";
    }
=======
<?php
include_once("./_common.php");
$g5['title'] = '게시판 관리자 리스트';
include_once(G5_THEME_PATH . '/head.php');
?>
<style type="text/css">
    #po_rank {
        position: relative;
        margin: 0 auto;
        width: 100%
    }

    #po_rank h2 {
        background: #E6DCC1;
        border: 1px solid #d6d6d6;
        padding: 14px 10px;
        font-size: 12px;
        color: #4c4e4d
    }

    #po_rank .my_rank {
        position: absolute;
        top: 16px;
        right: 10px;
        color: #666666;
        font-size: 11px
    }

    #po_rank .my_rank strong {
        color: #ff6600
    }

    #po_rank .tbl_rank {
        margin: 5px 0 20px
    }

    #po_rank .tbl_rank table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0
    }

    #po_rank .tbl_rank caption {
        padding: 0;
        font-size: 0;
        line-height: 0;
        overflow: hidden
    }

    #po_rank .tbl_rank thead th {
        height: 30px;
        line-height: 30px;
        border-bottom: 2px solid #aaa;
        background: #E6DCC1;
        color: #383838;
        font-size: 11px;
        font-weight: normal;
        text-align: center
    }

    #po_rank .tbl_rank .th_point {
        text-align: right;
        padding-right: 10px
    }

    #po_rank .tbl_rank td {
        border-top: 1px solid #eceff3;
        border-bottom: 1px solid #eceff3;
        line-height: 23px;
        word-break: break-all
    }

    #po_rank .tbl_rank tr:hover {
        background: #f8f8f8
    }

    /* #po_rank .tbl_rank tr:first-child {
        background: #ecf7f8
    } */

    #po_rank .tbl_rank a {}

    #po_rank .td_prank {
        width: 120px;
        text-align: center;
        color: #ffffff
    }

    #po_rank .td_boname {
        text-align: left;
        padding-left: 5px
    }

    #po_rank .td_boadmin {
        width: 120px;
        text-align: center
    }

    #po_rank .td_gradmin {
        width: 120px;
        text-align: center
    }

    #po_rank .td_bolevel {
        width: 120px;
        text-align: center
    }

    #po_rank .td_grlevel {
        width: 120px;
        text-align: center
    }

    /* #po_rank .td_point {width:70px;text-align:right;padding-right:10px;color:#d41d4b;font-family:verdana;font-size:10px;font-weight:bold} */
    #po_rank .rank_num {
        position: relative;
        margin: 4px 0
    }

    #po_rank .rank_num .rank_bg {
        display: inline-block;
        width: 21px;
        line-height: 22px;
        font-size: 11px;
        text-align: center;
        color: #fff;
        text-indent: -1px
    }
</style>

<div id="po_rank">
    <h2>게시판 담당자 리스트</h2>

    <div class="tbl_rank">
        <table>
            <caption>게시판 담당자</caption>
            <thead>
                <tr>
                    <!-- <th></th> -->
                    <th>게시판명</th>
                    <th>게시판 담당자 레벨</th>
                    <th>게시판 담당자</th>
                    <th> 그룹 담당자 레벨</th>
                    <th>게시판 그룹 담당자</th>

                    <!-- <th class="th_point"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $rank_rows = 100; //출력 수

                $result = sql_query(" select b.gr_subject, b.gr_admin, a.bo_subject, a.bo_admin, c.mb_level as m1_level, d.mb_level as m2_level from {$g5['board_table']} a Inner Join {$g5['group_table']} b  on a.gr_id = b.gr_id Left Join {$g5['member_table']} c on a.bo_admin = c.mb_id Left Join {$g5['member_table']} d on b.gr_admin = d.mb_id", false);

                // $sql = " select * from {$g5['member_table']} where mb_id = b.gr_admin ";
                // $result1 = sql_query($sql);


                for ($i = 0; $row = sql_fetch_array($result, $result1); $i++) {
                    // $rank = number_format($i + 1);
                    //$name = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);
                    $name = $row['bo_subject'];
                    $gradmin = $row['gr_admin'];
                    $boadmin = $row['bo_admin'];
                    $bolevel = $row['m1_level'];
                    $grlevel = $row['m2_level'];

                ?>

                    <tr>
                        <!-- <td class="td_prank"><div class="rank_num"><span class="rank_bg" style="background:<?php echo $bg ?>"><?php echo $rank; ?></span></div></td> -->
                        <td class="td_boname"><?php echo $name; ?></td>
                        <td class="td_bolevel"><?php echo  grade($bolevel);  ?></td>
                        <td class="td_boadmin"><?php echo $boadmin; ?></td>
                        <td class="td_grlevel"><?php echo  grade($grlevel); ?></td>
                        <td class="td_gradmin"><?php echo  $gradmin; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once(G5_THEME_PATH . '/tail.php');
?>
<?php function grade($level)
{
    if ($level == 2) {
        echo "노예";
    } else if ($level == 3) {
        echo "농노";
    } else if ($level == 4) {
        echo "시민";
    } else if ($level == 5) {
        echo "기사";
    } else if ($level == 6) {
        echo "남반";
    } else if ($level == 7) {
        echo "장교";
    } else if ($level == 8) {
        echo "향리";
    } else if ($level == 9) {
        echo "서리";
    } else if ($level == 10) {
        echo "성주";
    } else if ($level == 11) {
        echo "작사";
    } else if ($level == 12) {
        echo "남작";
    } else if ($level == 13) {
        echo "자작";
    } else if ($level == 14) {
        echo "백작";
    } else if ($level == 15) {
        echo "후작";
    } else if ($level == 16) {
        echo "공작";
    } else if ($level == 17) {
        echo "대공";
    } else if ($level == 18) {
        echo "왕자";
    } else if ($level == 19) {
        echo "왕";
    } else if ($level == 20) {
        echo "국왕";
    } else if ($level == 21) {
        echo "태자";
    } else if ($level == 22) {
        echo "황제";
    } else if ($level == 24) {
        echo "추기경";
    } else if ($level == 25) {
        echo "교황";
    } else if ($level == 26) {
        echo "법사";
    }
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
} ?>