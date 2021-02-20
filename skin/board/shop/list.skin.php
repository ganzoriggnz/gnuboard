<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$imgmaxwidth = 800; 
$imgmaxheight = 550; 

$imgminwidth = 174; 
$imgminheight = 130; 
$ordercnt;


if($_GET['backet'] !='' || $_GET['buy'] !='' ){

    if($_GET['backet'] !='')
        $q=$_GET["backet"];
    if($_GET['buy'] !='')
        $q=$_GET["buy"];
    $wr_1;
    $wr_2;
    $wr_8;
    $wr_9;
    $wr_subject;

    $query5 = "select * from g5_write_shop  where wr_id = '$q'  ";
    $result5 = sql_query($query5);
    while($row  = sql_fetch_array($result5)) {        
        $wr_subject = $row['wr_subject']; 
        $wr_1 = $row['wr_1'];
        $wr_2 = $row['wr_2']; 
        $wr_8 = $row['wr_8']; 
        $wr_9 = $row['wr_9']; 
    }
    
    $query5 = "select wr_3 from g5_write_basket  where mb_id = '$member[mb_id]' and wr_10 = '구매대기' and wr_9 = '$wr_9' ";
    $result5 = sql_query($query5);
    while($row  = sql_fetch_array($result5)) {	
        $cnt2 = $row['wr_3']; 
    }
    $wr_3 = $cnt2 + 1;
    $wr_1 = $wr_3 * $wr_1;
    if($cnt2 == "") {
    $table = "g5_write_basket";
    $bo_table = "basket";
     $wr_num = $q;
        $sql = " insert into $table
                    set wr_num = '$wr_num',
                         wr_reply = '$wr_reply',
                         wr_comment = 0,
                         ca_name = '구매대기',
                         wr_option = '$html,$secret,$mail',
                         wr_subject = '$wr_subject',
                         wr_content = '필요한 내용을 넣으세요',
                         wr_link1 = '$wr_link1',
                         wr_link2 = '$wr_link2',
                         wr_link1_hit = 0,
                         wr_link2_hit = 0,
                         wr_hit = 0,
                         wr_good = 0,
                         wr_nogood = 0,
                         mb_id = '{$member['mb_id']}',
                         wr_password = '$wr_password',
                         wr_name =  '{$member['mb_name']}',
                         wr_email =  '{$member['mb_main']}',
                         wr_homepage = '$wr_homepage',
                         wr_datetime = '".G5_TIME_YMDHIS."',
                         wr_last = '".G5_TIME_YMDHIS."',
                         wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                         wr_1 = '$wr_1',
                         wr_2 = '$wr_2',
                         wr_3 = '$wr_3',
                         wr_4 = '$wr_4',
                         wr_5 = '$wr_5',
                         wr_6 = '$wr_6',
                         wr_7 = '$wr_7',
                         wr_8 = '$q',
                         wr_9 = '$wr_9',
                         wr_10 = '구매대기' ";
           
        sql_query($sql);    
        // $wr_id = mysql_insert_id();    
        // // 부모 아이디에 UPDATE
        // sql_query(" update $table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");    

        // sql_query("update g5_board set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");
    }
    if($cnt2 != "") { sql_query(" update g5_write_basket set wr_3 = '$wr_3', wr_1 = '$wr_1' where wr_9 = '$wr_9' and wr_10 = '구매대기' and mb_id = '{$member['mb_id']}' "); 
                    }
    if($_GET['backet'] !='')
        goto_url(G5_URL."/bbs/board.php?bo_table=shop");
    if($_GET['buy'] !='')
        goto_url(G5_URL."/bbs/board.php?bo_table=basket");
}

$query5 = "select SUM(wr_3) as cnt from g5_write_basket  where mb_id = '$member[mb_id]' and wr_10 = '구매대기' ";
    $result5 = sql_query($query5);
    while($row  = sql_fetch_array($result5)) {	
        $ordercnt= $row['cnt']; 
    }
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<h2 id="container_title"><span class="sound_only"> 목록</span></h2>

<ul id="">
	<div class="alert bg-light border p-2 p-sm-3 mb-3 mx-3 mx-sm-0" style="text-align: center;">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sop" value="and">
        <label for="sfl" class="sound_only">검색대상</label>
		<legend class="sound_only">상세검색</legend>
                    <select name="sfl" id="sfl" class="custom-select col-1" >
                        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>상품명</option>
                        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>소개</option>
                        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>상품+소개</option>
                    </select> 
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label> &nbsp;
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required  class="forml" size="20" maxlength="15">&nbsp;
                        <input type="submit" class="btn btn-primary" value="검색" class="btn_submit">
		</form>
</div></ul>
<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_shop ?>
        </ul>
    </nav>
    <?php } ?>
    <div class="bo_fx">
            

        <div id="bo_list_total">
        <strong> 파운드 :  <?php echo number_format($member['mb_point']) ?></strong> 
            &nbsp;&nbsp;&nbsp; 
            <img src="<?php echo $board_skin_url?>/img/star.png" height=21> 추천 상품 <img src="<?php echo $board_skin_url?>/img/good.png" height=21> 특가 상품 
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btnd">RSS</a></li><?php } ?>
            <li><a href="./board.php?bo_table=basket" class="btnd"><img src="<?php echo $board_skin_url ?>/img/shopping-basket1.png" height=15px><?php if(!G5_IS_MOBILE) echo " 구매현황";  if($ordercnt) echo " (".$ordercnt.")"; ?> </a></li>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btnd">관리자</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $write_href ?>" class="btnd">상품 올리기</a></li><?php } ?>
            &nbsp;&nbsp;&nbsp;
        </ul>
        <?php } ?>
    </div>
    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>

    <ul id="gall_ul">
        <?php for ($i=0; $i<count($list); $i++) {
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            // if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
            
			if($list[$i]['wr_10'] == "Open") { 
         ?>
        <li class="gall_li" style="width:<?php if(G5_IS_MOBILE) echo "170"; else echo "190" ?>px">
            <?php if ($is_checkbox) { ?>
            <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            <?php } ?>
			<!-- <?php
                    // echo $list[$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
                    if ($is_category && $list[$i]['ca_name']) {
                     ?>
                    <?php if ($list[$i]['is_notice']) echo "<img src=".$board_skin_url."/img/star.png height=21>"; ?><?php if ($list[$i]['wr_good'] >= 100000) 
                    echo "<img src=".$board_skin_url."/img/good.png height=21>"; ?> <a href="<?php echo $list[$i]['ca_name_href'] ?>" ><?php echo $list[$i]['ca_name'] ?></a>
             <?php } ?> -->
            <span class="sound_only">
                <?php
                if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                 ?>
            </span>
            <ul class="gall_con">
                <li class="gall_href">
                    <?php
                    if ($list[$i]['is_notice']) { // 공지사항  
                             $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $imgmaxwidth, $imgmaxheight );
                        if($thumb['src']) {
                            $img_content = '<a  rel="single"  class="pirobox"  href="'.$thumb['src'].'" title="'.$list[$i]['subject'].'"  
                            style="margin:0 10px 0 0; border-radus: 5px;"><img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="150px" height=""> </a>';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
                        }
                        echo $img_content;
                     } else {
                      $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $imgmaxwidth, $imgmaxheight );
                        if($thumb['src']) {
                            $img_content = '<a  rel="single"  class="pirobox"  href="'.$thumb['src'].'" title="'.$list[$i]['subject'].'" 
                             style="margin:0 10px 0 0;  border-radus: 5px;"><img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="150px" height=""> </a>';
                        } else {
                            $img_content = '<span style="width:150px;height:103px">No image</span>';
                        }
                        echo $img_content;
                    }
                     ?>
                </li>
                <li class="gall_text_href" style="width:<?php echo $board['bo_gallery_width'] ?>px; color:red; ">
                    <?php if($is_admin) { 
                        ?><a href="<?php echo G5_URL ?>/bbs/write.php?w=u&bo_table=shop&wr_id=<?php echo $list[$i]['wr_id']?>&page=">
                        <?php } ?>

                        <?php echo $list[$i]['subject'] ?>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                         </a>
                    <?php
                    if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                     ?>
                </li>
 <style type="text/css">
            .but
            {
            background: url('<?php echo $board_skin_url ?>/img/basket.jpg') no-repeat;
            cursor:Per;border: none;
            }
        </style>
        <li ><p style="height: 36px"><?php echo substr($list[$i]['wr_content'],0,50)   ?></p></li>
             <li><p><b><?php echo number_format($list[$i]['wr_1']) ?> </b>P</p><p>배송: <?php echo number_format($list[$i]['wr_2']) ?> <strong></strong>P</p></li>				
            <li>
            <a class="btnd <?php if ($list[$i]['wr_4'] >=$list[$i]['wr_3'] || $list[$i]['wr_3']==0) echo "disabled";?>" href="./board.php?bo_table=shop&backet=<?php echo $list[$i]['wr_id'] ?>" style="height:28px;width:80px" ><img src="<?php echo $board_skin_url ?>/img/shopping-cart.png" height=15px> <?php if($list[$i]['wr_4']) echo $list[$i]['wr_4']; else echo "0"; ?> / <?php echo $list[$i]['wr_3'] ?></a>
            <a class="btnd <?php if ($list[$i]['wr_4'] >=$list[$i]['wr_3'] || $list[$i]['wr_3']==0) echo "disabled";?>" href="./board.php?bo_table=shop&buy=<?php echo $list[$i]['wr_id'] ?>" style="height:28px;width:80px"  ><img src="<?php echo $board_skin_url ?>/img/shopping-basket1.png" height=15px> BUY</a>
            </li>
            </ul>
        </li>
        <?php } ?>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" class="btn" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" class="btn" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" class="btn" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
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
<?php echo $write_pages; ?>

<?php if ($is_checkbox) { ?>
<script>
function Process(id){
    var el = document.getElementById('*too');
    text = (id);
}

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

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
