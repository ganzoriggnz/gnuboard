<<<<<<< HEAD
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div class="view_div02">
    <div class="view_div_tit">
        <ul>
            <?php if($view['ca_name']) {?>
			<li class="view_div_tit00"><span class="view_div_ca"><?php echo $view['ca_name']; ?></span></li>
			<?php }?>
            <li class="view_div_tit01 relative">
				<?php echo get_text($view['wr_subject']); ?>
				
				<div class="absolute right-0 top-0 mt-2 flex flex-col bg-white items-center justify-center rounded-full border border-red-500 float-right text-white text-sm text-red-500 px-2"><span>지식포인트 <?php echo number_format($view['wr_1']) ?> P</span></div>

			</li>
        </ul>
        <ul class="view_div_t_ul01">
            <li class="view_div_tit02"><?php echo $view['name'] ?></li>
            <li class="view_div_tit03"><?php echo date("Y.m,d H:i", strtotime($view['wr_datetime'])) ?>　조회 <?php echo number_format($view['wr_hit']) ?></li>
        </ul>

        <ul class="view_div_t_ul02 relative">
			
            <li class="absolute right-0 top-0 mt-2 flex flex-col bg-white items-center justify-center rounded-full border border-red-500 float-right text-white text-sm text-red-500 px-2"><span><i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['wr_comment']) ?></span></li>
        </ul>
        <div class="cb"></div>
    </div>

    
    <div class="view_div_info">
        <ul class="view_div_btn_out">
			<?php echo get_view_thumbnail($view['content']); ?>
        </ul>
        
        <br>
        
         <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>

		<ul class="view_f">
		<?php
        if ($view['file']['count']) {
            $cnt = 0;
            for ($i=0; $i<count($view['file']); $i++) {
                if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                    $cnt++;
            }
        }
         ?>


    <?php if($cnt) { ?>
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <?php } ?>
		</ul>

    </div>

</div>

<div class="btm_btn">
            <ul class="btm_btn01_2">
				<li><a href="<?php echo $list_href ?>" class="btm_btn_b01">목록보기</a></li>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btm_btn_b02">글쓰기</a></li><?php } ?>
            </ul>
            
            <?php if ($update_href) { ?>
            <ul class="btm_btn02_2">
                <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btm_btn_b03_1">수정</a></li><?php } ?>
                <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btm_btn_b03_1" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
                <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btm_btn_b03_1" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
                <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btm_btn_b03_1" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>

            </ul>
            <?php } ?>

        </div>



<div class="view_div02">

    
<?php
include_once(G5_BBS_PATH.'/view_comment.php');
?>
<br>
</div>




<!-- 이미지출력
<img src='//$view['file'][0][path].'/'.$view['file'][0]['file']?>' />
-->


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
=======
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div class="view_div02">
    <div class="view_div_tit">
        <ul>
            <?php if($view['ca_name']) {?>
			<li class="view_div_tit00"><span class="view_div_ca"><?php echo $view['ca_name']; ?></span></li>
			<?php }?>
            <li class="view_div_tit01 relative">
				<?php echo get_text($view['wr_subject']); ?>
				
				<div class="absolute right-0 top-0 mt-2 flex flex-col bg-white items-center justify-center rounded-full border border-red-500 float-right text-white text-sm text-red-500 px-2"><span>지식포인트 <?php echo number_format($view['wr_1']) ?> P</span></div>

			</li>
        </ul>
        <ul class="view_div_t_ul01">
            <li class="view_div_tit02"><?php echo $view['name'] ?></li>
            <li class="view_div_tit03"><?php echo date("Y.m,d H:i", strtotime($view['wr_datetime'])) ?>　조회 <?php echo number_format($view['wr_hit']) ?></li>
        </ul>

        <ul class="view_div_t_ul02 relative">
			
            <li class="absolute right-0 top-0 mt-2 flex flex-col bg-white items-center justify-center rounded-full border border-red-500 float-right text-white text-sm text-red-500 px-2"><span><i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['wr_comment']) ?></span></li>
        </ul>
        <div class="cb"></div>
    </div>

    
    <div class="view_div_info">
        <ul class="view_div_btn_out">
			<?php echo get_view_thumbnail($view['content']); ?>
        </ul>
        
        <br>
        
         <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>

		<ul class="view_f">
		<?php
        if ($view['file']['count']) {
            $cnt = 0;
            for ($i=0; $i<count($view['file']); $i++) {
                if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                    $cnt++;
            }
        }
         ?>


    <?php if($cnt) { ?>
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <?php } ?>
		</ul>

    </div>

</div>

<div class="btm_btn">
            <ul class="btm_btn01_2">
				<li><a href="<?php echo $list_href ?>" class="btm_btn_b01">목록보기</a></li>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btm_btn_b02">글쓰기</a></li><?php } ?>
            </ul>
            
            <?php if ($update_href) { ?>
            <ul class="btm_btn02_2">
                <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btm_btn_b03_1">수정</a></li><?php } ?>
                <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btm_btn_b03_1" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
                <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btm_btn_b03_1" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
                <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btm_btn_b03_1" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>

            </ul>
            <?php } ?>

        </div>



<div class="view_div02">

    
<?php
include_once(G5_BBS_PATH.'/view_comment.php');
?>
<br>
</div>




<!-- 이미지출력
<img src='//$view['file'][0][path].'/'.$view['file'][0]['file']?>' />
-->


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
<!-- } 게시글 읽기 끝 -->