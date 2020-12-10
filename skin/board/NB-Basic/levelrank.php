<?php
include_once("./_common.php");
$g5['title'] = '회원 포인트 랭킹';
include_once(G5_THEME_PATH.'/head.php');
?>
<style type="text/css">
#po_rank {position:relative;margin:0 auto;width:100%}
#po_rank h2 {background:#f7f7f7;border:1px solid #d6d6d6;padding:14px 10px;font-size:12px;color:#4c4e4d}
#po_rank .my_rank {position:absolute;top:16px;right:10px;color:#666666;font-size:11px}
#po_rank .my_rank strong {color:#ff6600}
#po_rank .tbl_rank {margin:5px 0 20px}
#po_rank .tbl_rank table {width:101%;border-collapse:collapse;border-spacing:0}
#po_rank .tbl_rank caption {padding:0;font-size:0;line-height:0;overflow:hidden}
#po_rank .tbl_rank thead th {height:30px;line-height:30px;border-bottom:1px solid #129d82;background:#f4f4f4;color:#383838;font-size:11px;font-weight:normal;text-align:center}
#po_rank .tbl_rank .th_plevel {text-align:right;padding-right:10px}
#po_rank .tbl_rank td {border-top:1px solid #eceff3;border-bottom:1px solid #eceff3;line-height:23px;word-break:break-all}
#po_rank .tbl_rank tr:hover{background:#f8f8f8}
#po_rank .tbl_rank tr:first-child{background:#ecf7f8}
#po_rank .tbl_rank a {}
#po_rank .td_prank {width:30px;text-align:center;color:#ffffff}
#po_rank .td_pname {text-align:left;padding-left:5px}
#po_rank .td_joindate {width:120px;text-align:center;color:#b1b1b1}
#po_rank .td_plevel {width:70px;text-align:right;padding-right:10px;}
/* #po_rank .td_point {width:70px;text-align:right;padding-right:10px;color:#d41d4b;font-family:verdana;font-size:10px;font-weight:bold} */
#po_rank .rank_num {position:relative;margin:4px 0}
#po_rank .rank_num .rank_bg{display:inline-block;width:21px;line-height:22px;font-size:11px;text-align:center;color:#fff;text-indent:-1px}
</style>

<div id="po_rank">
<h2>회원 계급 랭킹 TOP-100</h2>
<div class="my_rank">
<?php
$sql_common = "and mb_level < 23 and mb_id != '{$config['cf_admin']}' ";   // end hasah level nemsen 
if ($member['mb_level'] < 23 && $member['mb_id']) {
    $sql = " select count(mb_id) as cnt from {$g5['member_table']} where mb_level > '{$member['mb_level']}' {$sql_common} order by mb_level desc ";
    $row = sql_fetch($sql);
    echo "{$member['mb_nick']} 님의 계급은 <strong>".number_format($member['mb_level'])."계급</strong>, 순위는 <strong>".number_format($row['cnt'] + 1)."등</strong> 입니다";
}
?>
</div>
<div class="tbl_rank">
<table>
<caption>계급 랭킹</caption>
<thead>
<tr>
    <th>순위</th>
    <th>닉네임</th>
    <th>가입일</th>
    <th class = "th_plevel">계급</th>
    <!-- <th class="th_point">포인트</th>    hulan tailbar bolgoson-->
</tr>
</thead>
<tbody>
<?php
$level_rows = 100; //출력 수
$sql = " select * from {$g5['member_table']} where mb_level> '{$row['mb_level']}' {$sql_common} order by mb_level desc, mb_today_login desc limit {$level_rows} ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
$rank = number_format($i + 1);
//$name = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);
$name = $row['mb_nick'];
$level = $row['mb_level'];
$joindate = date("y.m.d", strtotime($row['mb_datetime']));
// $point = number_format($row['mb_level']);

if ($rank == 1) {
$bg = '#da0000';
} else if ($rank == 2) {
$bg = '#fdb800';
} else if ($rank <= 5) {
$bg = '#657bc8';
} else {
$bg = '#b3b8c0';
}
?>
<tr>
    <td class="td_prank"><div class="rank_num"><span class="rank_bg" style="background:<?php echo $bg ?>"><?php echo $rank; ?></span></div></td>
    <td class="td_pname"><?php echo $name; ?></td>
    <td class="td_joindate"><?php echo $joindate; ?></td>
    <td class="td_plevel"><?php 
    if($level == 2){
        echo "노예";
        } else if($level == 3){
        echo "농노";
        } else if($level == 4){
        echo "시민";
        } else if($level == 5){
        echo "기사";
        } else if($level == 6){
        echo "남반";
        } else if($level == 7){
        echo "장교";
        } else if($level == 8){
        echo "향리";
        } else if($level == 9){
        echo "서리";
        } else if($level == 10){
        echo "성주";
        } else if($level == 11){
        echo "작사";
        } else if($level == 12){
        echo "남작";
        } else if($level == 13){
        echo "자작";
        } else if($level == 14){
        echo "백작";
        } else if($level == 15){
        echo "후작";
        } else if($level == 16){
        echo "공작";
        } else if($level == 17){
        echo "대공";
        } else if($level == 18){
        echo "왕자";
        } else if($level == 19){
        echo "왕";
        } else if($level == 20){
        echo "국왕";
        } else if($level == 21){
        echo "태자";
        } else if($level == 22){
        echo "황제";
        } else if($level == 24){
        echo "추기경";
        } else if($level == 25){
        echo "교황";
        }else if($level == 26){
        echo "마법사";
        }
    ?></td>
    <!-- <td class="td_point"><?php echo $point; ?></td> -->
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>