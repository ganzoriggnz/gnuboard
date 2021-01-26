<?
/*******************************************************************************
*
* 1:1 게시판 기능을 위해서 추가된 부분
*
*******************************************************************************/

if ( !$is_admin) {
  
    // 공지가져오기
    $noticeNumS = str_replace("\n",",",$board[bo_notice]);
    $bb_query2 = "select * from `{$write_table}` where 1 and find_in_set(wr_id,'{$noticeNumS}') and wr_is_comment != 1 order by  wr_num, wr_reply;";
    $result2 = sql_query($bb_query2);
    $bb_notice_count = mysql_num_rows($result2);
    $list2A = array();
    while ($row = sql_fetch_array($result2))
    {
    	$row = get_list($row, $board, G5_PATH.'/skin/board/'.$board[bo_skin], $board[bo_subject_len]);
    	array_push($list2A, $row);
    }

    // 검색항목 설정하기
    if ($sca || $stx) 
    {
        $sql_search = get_sql_search($sca, $sfl, $stx, $sop);
    } else {
        $sql_search = "1 ";
    }

    // 해당 사용자가 쓴 글의 번호 + 비밀글이 아닌글의 번호 + 해당사용자에게 지정된 글번호(wr_5)
    if ($is_member)
       $bb_query1 = "select * from `{$write_table}` where $sql_search and (( mb_id = '{$member[mb_id]}' ) or wr_option not like '%secret%' ) and not find_in_set(wr_id,'{$noticeNumS}') and wr_is_comment != 1 ";
    else
        $bb_query1 = "select * from `{$write_table}` where $sql_search and (mb_id = '{$member[mb_id]}' and not find_in_set(wr_id,'{$noticeNumS}') and wr_is_comment != 1  ";




    $result1 = sql_query($bb_query1);
    $bb_total_count = mysql_num_rows($result1);

    $list1S = "";
    while ($row = sql_fetch_array($result1))
    {
    	$list1S = $row[wr_num].",".$list1S;
    }

    $bb_total_page  = ceil($bb_total_count / $board[bo_page_rows]);  // 전체 페이지 계산
    if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
    $bb_from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함
    $bb_url = "./board.php?bo_table={$board[bo_table]}&page=";
    $bb_write_pages = get_paging( $board[bo_page_rows], $page, $bb_total_page, $bb_url, $add="");

    // 공지글, 해당사용자가 쓴 글과 관련된 게시물 가져오기
if ( !$is_admin) {
    $bb_query3 = "select * from `{$write_table}` 
                           where $sql_search and find_in_set(wr_num,'{$list1S}') and ( mb_id = '{$member[mb_id]}' ) and wr_is_comment != 1 
                                 order by wr_num, wr_reply limit $bb_from_record, $board[bo_page_rows];";
}
else
	{
	    $bb_query3 = "select * from `{$write_table}` 
                           where $sql_search and find_in_set(wr_num,'{$list1S}')  and wr_is_comment != 1 
                                 order by wr_num, wr_reply limit $bb_from_record, $board[bo_page_rows];";
	}
    $result3 = sql_query($bb_query3);
    $i=$bb_total_count - $bb_from_record;
    $j=$bb_notice_count;
    while ($row = sql_fetch_array($result3))
    {
    	$row = get_list($row, $board, $g5[path].'/skin/board/'.$board[bo_skin], $board[bo_subject_len]);
    	array_push($list2A, $row);
    	$list2A[$j][num]=$i;
      $i--;
      $j++;
    }

    $total_count = $bb_total_count;
	  $list = $list2A;
    $write_pages = $bb_write_pages;
  
}
/*******************************************************************************
*
* 1:1 게시판 기능을 위해서 추가된 부분 - 여기까지 
*
*******************************************************************************/
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
?>

<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
             <li><a href="./board.php?bo_table=shop" class="btn_admin">구매하기</a></li>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
       <tr>
            <th scope="col">번호</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">상품</th>

            <th scope="col">수량</th>
            <th scope="col">구매액</th>
			<th scope="col">배송료</th>
			<th scope="col">배송형태</th>
            <th scope="col">신청인</th>
            <th scope="col">신청일</th>
            <th scope="col">상태</th>

        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_subject">
                <?php
                echo $list[$i]['icon_reply'];
       ?>
				<a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['subject'] ?>
                    <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
             </a>

                <?php
                // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];

                 ?>
            </td>

            <td class="td_numb"><?php echo $list[$i]['wr_3'] ?>  </td>

            <td class="td_numbig"><?php echo number_format($list[$i]['wr_1']) ?>원</td>
            <td class="td_num"><?php echo number_format($list[$i]['wr_2']) ?>원  </td>
          <td class="td_num"><?php if($wr_8 == 1) echo "개별배송료"; else echo "묶음배송"; ?>  </td>
            <td class="td_name"><?php echo $list[$i]['wr_name'] ?></td>
            <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
            <td class="td_name"><?php echo $list[$i]['wr_10'] ?></td>
        </tr> <?php } ?>      
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>

        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>

        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>상품</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>신청인</option>

    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx"  class="frm_input required" size="15" maxlength="15">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }
    if(document.pressed == "상태변경") {
        select_stat("status");
        return;
    }
    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
// 상태변경
function select_stat(sw) {
    var f = document.fboardlist;

    if (sw == "status")
        str = "상태";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./stat.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
