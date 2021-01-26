<<<<<<< HEAD
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?'.time().'">', 0);
?>

<div class="board_div">

    
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">  
    
        <div class="board_div_ser">

            <ul class="board_div_ul01">
                <select name="sfl" id="sfl" style="display:none;">
                    <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content', true); ?>>제목+내용</option>
                </select>
                <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력하세요." required id="stx" class="sch_input" size="15" maxlength="20">
            </ul>

            <ul class="board_div_ul02">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i> <span class="sound_only">검색</span></button>
            </ul>

            <ul class="cb"></ul>
        
        </div>
        
    </form>
    
    <div class="board_div_btn">
        <div class="board_div_btn2">
            <button onclick="<?php if ($write_href) { echo "location.href='".$write_href."'"; } else { echo "alert('로그인후 이용 가능합니다.')"; }?>" class="write_btn">질문하기</button>
        </div>
    </div>
    
    <div class="cb"></div>
    
</div>

<?php if ($is_category) { ?>
<div class="board_div2">
    <nav id="bo_cate">
        <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
</div>
<?php } ?>

        
<form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">
    

    
    <?php
		for ($i=0; $i<count($list); $i++) {
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], 0, 75, 75, false, true, 'center');
	?>

    <a href="<?php echo $list[$i]['href'] ?>">

        <div class="table_div">
            <ul class="table_div_n">
                <?php if ($list[$i]['is_notice']) { ?>
                <li><i class="fa fa-bell main_color txt18" aria-hidden="true"></i></li>
                <?php } else if ($list[$i]['icon_secret']){ ?> 
                <li><i class='fa fa-lock c000 txt18'></i></li>
                <?php } else { ?> 
                <li class="c999 txt18 txt500"><?php echo $list[$i]['num'] ?></li>
                <?php } ?> 

            </ul>
            <ul class="table_div_l" <?php if (!$thumb['src']) { echo 'style="width: 85%;"'; } ?>>
                <li class="txt18 c000 txt500 elc mb10"><?php echo $list[$i]['subject'] ?> <?php if ($list[$i]['comment_cnt']) { ?><span class="main_color txt18 txt500"><?php echo $list[$i]['wr_comment']; ?></span><?php } ?></li>
                <li class="txt12 c999"><?php echo $list[$i]['name'] ?>　<?php echo $list[$i]['datetime2'] ?>　<?php echo $list[$i]['wr_hit'] ?>　<?php echo $list[$i]['ca_name'] ?></li>
            </ul>
            <?php if ($is_checkbox) { ?>
            <ul class="table_div_r">
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" style="margin-top:25px;">
            </ul>
            <?php } ?>

			<?php
			
			if ($thumb['src']) {
			?>
            <ul class="table_div_r">
                <img src="<?php echo $thumb['src'] ?>" alt="<?php echo $list[$i]['wr_1']?>" class="w-full block rounded">
            </ul>
            <?php } ?>
            <ul class="cb"></ul>
        </div>

    </a>

	<?php } ?>
    
	<?php if (count($list) == 0) { ?>
	<div class="u_list_div">
        <div style="width:100%; text-align:center; padding:100px 0px 100px 0px; font-size:14px; color:#999;">
            등록된 게시물이 없습니다.
        </div>
	</div>
	<?php } ?>
        
        
        
        
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="btm_btn">
        
        <?php if ($list_href || $write_href) { ?>
        <ul class="btm_btn01">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btm_btn_b01">전체보기</a></li><?php } ?>
        </ul>
        <?php } ?>

        
        
        <?php if ($is_checkbox) { ?>
        <ul class="btm_btn02">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
        </ul>
        <?php } ?>

        
        
        
    </div>
    <?php } ?>



    
</form>
    

        
<div style="padding-top:20px; padding-bottom:20px;">

<!-- 페이지 -->
<?php echo $write_pages;  ?>
</div>

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
<script>
$(function(){
	$("#imgList li>img").hover(function(){
		$("#mainImg"+$(this).attr('id')).attr('src', $(this).attr('src'));
	});
});
</script>
<!-- } 게시판 목록 끝 -->



=======
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?'.time().'">', 0);
?>

<div class="board_div">

    
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">  
    
        <div class="board_div_ser">

            <ul class="board_div_ul01">
                <select name="sfl" id="sfl" style="display:none;">
                    <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content', true); ?>>제목+내용</option>
                </select>
                <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력하세요." required id="stx" class="sch_input" size="15" maxlength="20">
            </ul>

            <ul class="board_div_ul02">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i> <span class="sound_only">검색</span></button>
            </ul>

            <ul class="cb"></ul>
        
        </div>
        
    </form>
    
    <div class="board_div_btn">
        <div class="board_div_btn2">
            <button onclick="<?php if ($write_href) { echo "location.href='".$write_href."'"; } else { echo "alert('로그인후 이용 가능합니다.')"; }?>" class="write_btn">질문하기</button>
        </div>
    </div>
    
    <div class="cb"></div>
    
</div>

<?php if ($is_category) { ?>
<div class="board_div2">
    <nav id="bo_cate">
        <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
</div>
<?php } ?>

        
<form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">
    

    
    <?php
		for ($i=0; $i<count($list); $i++) {
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], 0, 75, 75, false, true, 'center');
	?>

    <a href="<?php echo $list[$i]['href'] ?>">

        <div class="table_div">
            <ul class="table_div_n">
                <?php if ($list[$i]['is_notice']) { ?>
                <li><i class="fa fa-bell main_color txt18" aria-hidden="true"></i></li>
                <?php } else if ($list[$i]['icon_secret']){ ?> 
                <li><i class='fa fa-lock c000 txt18'></i></li>
                <?php } else { ?> 
                <li class="c999 txt18 txt500"><?php echo $list[$i]['num'] ?></li>
                <?php } ?> 

            </ul>
            <ul class="table_div_l" <?php if (!$thumb['src']) { echo 'style="width: 85%;"'; } ?>>
                <li class="txt18 c000 txt500 elc mb10"><?php echo $list[$i]['subject'] ?> <?php if ($list[$i]['comment_cnt']) { ?><span class="main_color txt18 txt500"><?php echo $list[$i]['wr_comment']; ?></span><?php } ?></li>
                <li class="txt12 c999"><?php echo $list[$i]['name'] ?>　<?php echo $list[$i]['datetime2'] ?>　<?php echo $list[$i]['wr_hit'] ?>　<?php echo $list[$i]['ca_name'] ?></li>
            </ul>
            <?php if ($is_checkbox) { ?>
            <ul class="table_div_r">
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" style="margin-top:25px;">
            </ul>
            <?php } ?>

			<?php
			
			if ($thumb['src']) {
			?>
            <ul class="table_div_r">
                <img src="<?php echo $thumb['src'] ?>" alt="<?php echo $list[$i]['wr_1']?>" class="w-full block rounded">
            </ul>
            <?php } ?>
            <ul class="cb"></ul>
        </div>

    </a>

	<?php } ?>
    
	<?php if (count($list) == 0) { ?>
	<div class="u_list_div">
        <div style="width:100%; text-align:center; padding:100px 0px 100px 0px; font-size:14px; color:#999;">
            등록된 게시물이 없습니다.
        </div>
	</div>
	<?php } ?>
        
        
        
        
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="btm_btn">
        
        <?php if ($list_href || $write_href) { ?>
        <ul class="btm_btn01">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btm_btn_b01">전체보기</a></li><?php } ?>
        </ul>
        <?php } ?>

        
        
        <?php if ($is_checkbox) { ?>
        <ul class="btm_btn02">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btm_btn_b03"></li>
        </ul>
        <?php } ?>

        
        
        
    </div>
    <?php } ?>



    
</form>
    

        
<div style="padding-top:20px; padding-bottom:20px;">

<!-- 페이지 -->
<?php echo $write_pages;  ?>
</div>

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
<script>
$(function(){
	$("#imgList li>img").hover(function(){
		$("#mainImg"+$(this).attr('id')).attr('src', $(this).attr('src'));
	});
});
</script>
<!-- } 게시판 목록 끝 -->



>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
