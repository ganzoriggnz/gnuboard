<<<<<<< HEAD
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_comments) 
{
	//답변 채택시 댓글 재정렬
    if($view['wr_2'] == '1') 
    {
        unset($list);

        $sql = " select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 order by case when wr_2 = '1' then 1 else 2 end ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) 
        {
            $list[$i] = $row;
            $tmp_name = get_text($row['wr_name']); // 설정된 자리수 만큼만 이름 출력

            $list[$i]['name'] = "<span class='".($row['mb_id']?'member':'guest')."'>$tmp_name</span>";

            $list[$i]['content'] = $list[$i]['content1']= "비밀글 입니다.";
            
            if (!strstr($row['wr_option'], "secret") || $is_admin || ($write['mb_id']==$member['mb_id'] && $member['mb_id']) || ($row['mb_id']==$member['mb_id'] && $member['mb_id'])) 
            {
                $list[$i]['content1'] = $row['wr_content'];
                $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');
                $list[$i]['content'] = search_font($stx, $list[$i]['content']);
            }

            $list[$i]['trackback'] = url_auto_link($row['wr_trackback']);
            $list[$i]['datetime'] = substr($row['wr_datetime'],2,14);

            // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
            $list[$i]['ip'] = $row['wr_ip'];
            if (!$is_admin)
                $list[$i]['ip'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row['wr_ip']);

            // 답변있는 코멘트는 수정, 삭제 불가
            if ($i > 0 && !$is_admin)
            {
                if ($row['wr_comment_reply'])
                {
                    $tmp_comment_reply = substr($row['wr_comment_reply'], 0, strlen($row['wr_comment_reply']) - 1);
                    	
					if ($tmp_comment_reply == $list[$i-1]['wr_comment_reply'])
                    {
                        $list[$i-1]['is_edit'] = false;
                        $list[$i-1]['is_del'] = false;
                    }
                }
            }
        }
	}
}

$chk_answer = false;
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대

function answer_select(wr_id,c_mb_id,comment_id) {
	if (comment_id) {
		$.ajax({
			url: '<?php echo $board_skin_url?>/ajax.answer_select.php',
			type: 'GET',
			data: {'bo_table': '<?php echo $bo_table?>', 'wr_id': wr_id, 'c_mb_id': c_mb_id, 'comment_id': comment_id},
			dataType: 'html'
		})
		.done(function(result) {
			console.log(result);
		});
	}
}
</script>

<style>
    .comm_tit {font-size: 18px; font-weight: 700; color: #000;}
	textarea {width:100% !important; border:0px !important; background-color: #f1f1f1 !important; font-size: 14px !important; padding: 10px !important;}
	textarea:focus {border:1px solid #ddd !important; outline: none !important;}
</style>



<div class="view_div01">
    <div class="view_info_is" style="border-bottom:0px;">
        <div class="comm_tit"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#999"></i> <span class="main_color">답변 <?php echo number_format($view['wr_comment']) ?></span></div>
    
    </div>
</div>



<!-- 답변 시작 { -->
<ajaxcomment>
<section id="bo_vc">
    <h2>답변목록</h2>
    <?php
    $cmt_amt = count($list);
    for ($i=0; $i<$cmt_amt; $i++) {
        if($list[$i]['wr_1']) {
            $ilhot = $list[$i]['wr_1'];
            $mention_user = "<span class=\"text-teal-500 font-bold\">@{$ilhot}</span> ";
			
        } else {
            $mention_user = '';
        }

		if($list[$i]['wr_2'] == '1') {
			$chk_answer = true;
		}

        $comment_id = $list[$i]['wr_id'];
        $cmt_depth = strlen($list[$i]['wr_comment_reply']);
        $comment = $mention_user.$list[$i]['content'];
        /*
        if (strstr($list[$i]['wr_option'], "secret")) {
            $str = $str;
        }
        */
        $comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
        $cmt_sv = $cmt_amt - $i + 1; // 답변 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
     ?>

	<div style="margin:0px 10px 0px 10px; border-top:1px solid #eee; <?php if ($cmt_depth) { ?>border-top:none;<?php } ?>">
		<article id="c_<?php echo $comment_id ?>" style="<?php if ($cmt_depth) { ?>padding:20px; border-radius:3px;<?php } ?>" class="<?php echo $list[$i]['wr_2'] == '1' ? 'gradient-border' : ''  ?>">
			<header style="z-index:<?php echo $cmt_sv; ?>">
				<span style="font-size: 14px;"><?php echo $list[$i]['name'] ?></span>　<time style="color:#999" datetime="<?php echo date('Y.m.d\TH:i:s+09:00', strtotime($list[$i]['datetime'])) ?>"><?php echo $list[$i]['datetime'] ?></time>
				<span class="bo_vc_hdinfo">
					<?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
					$query_string = clean_query_string($_SERVER['QUERY_STRING']);

					if($w == 'cu') {
						$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
						$cmt = sql_fetch($sql);
						if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
							$cmt['wr_content'] = '';
						$c_wr_content = $cmt['wr_content'];
					}

					$c_reply_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
					$c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
                    $ilhot_wr_name = $list[$i]['wr_name'];
				 ?>
				<ul class="bo_vc_act">
					<?php if ($list[$i]['is_edit']) { ?><li><a href="<?php echo $c_edit_href;  ?>" onclick="comment_box('<?php echo $comment_id ?>', '<?php echo get_text($ilhot_wr_name)?>', 'cu'); return false;"><i class="fa fa-cog" aria-hidden="true"></i></a></li><?php } ?>
					<?php if ($list[$i]['is_del'])  { ?><li><a href="<?php echo $list[$i]['del_link'];  ?>" onclick="return comment_delete(this);"><i class="fa fa-times" aria-hidden="true"></i></a></li><?php } ?>
				</ul>
				<?php } ?>
				
				</span>
				<?php
				include(G5_SNS_PATH.'/view_comment_list.sns.skin.php');
				?>
			</header>

			<!-- 답변 출력 -->
			<div class="cmt_contents">
				<p style="padding-top:10px;">
					<?php if (strstr($list[$i]['wr_option'], "secret")) { ?><i class="fa fa-lock" aria-hidden="true"></i> <?php } ?>
					<?php echo $comment ?>
				</p>
			</div>
			<span id="edit_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 수정 -->
			<span id="reply_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 답변 -->
			
			<div class="cb"></div>
			
			<?php if($list[$i]['wr_2'] != 1) {?>
				<?php if(!$chk_answer) {?>
					<a href="<?php echo $c_reply_href;  ?>" onclick="answer_select('<?php echo $wr_id ?>', '<?php echo $list[$i]['mb_id']?>', '<?php echo $comment_id ?>'); return false;" class="rounded-full border border-teal-500 float-right text-white text-sm text-teal-500 px-2 py-1"><i class="fa fa-certificate" aria-hidden="true"></i>답변 채택</a>
				<?php }?>
			<?php } else {?>
			<span class="flex flex-col bg-white items-center justify-center rounded-full border border-teal-500 float-right text-white text-sm text-teal-500 w-16 h-16 p-2">
				<svg class="w-8 h-8 fill-current text-teal-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px">
					<g>
						<path d="M11.18,14.356c0-1.451,1.1-2.254,2.894-3.442C16.268,9.458,19,7.649,19,3.354
							c0-0.387-0.317-0.699-0.709-0.699h-3.43C14.377,1.759,12.932,0.8,10,0.8c-2.934,0-4.377,0.959-4.862,1.855H1.707
							C1.316,2.655,1,2.968,1,3.354c0,4.295,2.73,6.104,4.926,7.559c1.794,1.188,2.894,1.991,2.894,3.442v1.311
							c-1.884,0.209-3.269,0.906-3.269,1.736c0,0.994,1.992,1.799,4.449,1.799s4.449-0.805,4.449-1.799c0-0.83-1.385-1.527-3.269-1.736
							C11.18,15.666,11.18,14.356,11.18,14.356z M13.957,9.3c0.566-1.199,1.016-2.826,1.088-5.246h2.51
							C17.315,6.755,15.693,8.118,13.957,9.3z M10,2.026c2.732-0.002,3.799,1.115,3.798,1.529c0,0.418-1.066,1.533-3.798,1.535
							C7.268,5.089,6.201,3.974,6.201,3.556C6.2,3.142,7.268,2.024,10,2.026z M2.445,4.054h2.509C5.027,6.474,5.475,8.101,6.043,9.3
							C4.307,8.118,2.684,6.755,2.445,4.054z"></path>
					</g>
				</svg>
				채택됨
			</span>
			<?php }?>
			<div class="cb"></div>

			<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
			<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

		</article>
	</div>
    <?php } ?>
    <?php if ($i == 0) { //답변 없다면 ?><p id="bo_vc_empty">등록된 답변이 없습니다.</p><?php } ?>

</section>
</ajaxcomment>
<!-- } 답변 끝 -->


<div class="board_div_b">


<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>
<!-- 답변 쓰기 시작 { -->
<aside id="bo_vc_w" class="bo_vc_w">
    <h2>답변쓰기</h2>
    <form name="fviewcomment" id="fviewcomment" action="<?php echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>" id="w">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="is_good" value="">
    <input type="hidden" name="mention_user" value="ilhot" id="mention_user">

    <span class="sound_only">내용</span>
    <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
    <textarea class="wr_content_area" id="wr_content" name="wr_content" maxlength="10000" required class="required" title="내용"  
    <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
    <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
    <script>
    $(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
        var str = $(this).val()
        var mx = parseInt($(this).attr("maxlength"))
        if (str.length > mx) {
            $(this).val(str.substr(0, mx));
            return false;
        }
    });
    </script>
    <div class="bo_vc_w_wr">
        <div class="bo_vc_w_info">
            <?php if ($is_guest) { ?>
            <label for="wr_name" class="sound_only">이름<strong> 필수</strong></label>
            <input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" required class="frm_input required" size="25" placeholder="성함">
            <label for="wr_password" class="sound_only">비밀번호<strong> 필수</strong></label>
            <input type="password" name="wr_password" id="wr_password" required class="frm_input required" size="25"  placeholder="비밀번호">
            <?php
            }
            ?>
            <?php
            if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) {
            ?>
            <span class="sound_only">SNS 동시등록</span>
            <span id="bo_vc_send_sns"></span>
            <?php } ?>
            <?php if ($is_guest) { ?>
                <?php echo $captcha_html; ?>
            <?php } ?>
        </div>
        
        <div class="cb"></div>
        
		<div class="btn_confirm2">
            <input type="submit" id="btn_submit" class="btn_submit" value="답변등록">
		</div>
        <div class="btn_confirm">
           음란, 욕설, 비방 등의 답변은 삼가해주세요.
		</div>
    </div>
    </form>
</aside>

<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;
var mention_user;
function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("답변은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("답변은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("답변을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);
    document.getElementById('mention_user').value = mention_user;
    document.getElementById("btn_submit").disabled = "disabled";

    // ajax comment system
    $.ajax({
        url: f.action,
        type: 'POST',
        data: $(f).serialize(),
        dataType: 'html',
    })
    .done(function(str) {
        var tempDom = $('<output>').append($.parseHTML(str))
        var title = $('title', tempDom).text()
        if (title === '') {
            // 1. commentBox 원위치
            comment_box('', '', 'c')

            // 2. commentBox Form 리셋
            f.reset()
            
            // 3. 코멘트 출력
            $.ajax({
                url: str,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(str2) {
                var tempDom2 = $('<output>').append($.parseHTML(str2))
                $('ajaxcomment').replaceWith($('ajaxcomment', tempDom2))
            })
        }

        <?php if ($is_guest) { ?>
        // 4. 캡차 리로드
        $('#captcha_reload').trigger('click')
        <?php } ?>

        document.getElementById("btn_submit").disabled = ""
    })

    return false;
}



function comment_box(comment_id, wr_name, work)
{
    var el_id,
        form_el = 'fviewcomment',
        respond = document.getElementById(form_el);

    // 답변 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'bo_vc_w';

    if (wr_name) {
        mention_user = wr_name;
    } else {
        mention_user = '';
    }

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).appendChild(respond);
        //입력값 초기화
        document.getElementById('wr_content').value = '';
        
        // 답변 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        if(save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

function comment_delete(that)
{
    if (confirm('이 답변을 삭제하시겠습니까?')) {
        // ajax comment system
        $.ajax({
            url: that.href,
            type: 'GET',
            dataType: 'html',
        })
        .done(function(str) {
            var tempDom = $('<output>').append($.parseHTML(str))
            var title = $('title', tempDom).text()
            if (title === '') {
                // 1. commentBox 원위치
                comment_box('', '', 'c')
                
                // 2. 코멘트 출력
                $.ajax({
                    url: str,
                    type: 'GET',
                    dataType: 'html'
                })
                .done(function(str2) {
                    var tempDom2 = $('<output>').append($.parseHTML(str2))
                    $('ajaxcomment').replaceWith($('ajaxcomment', tempDom2))
                })
            }

            <?php if ($is_guest) { ?>
            // 4. 캡차 리로드
            $('#captcha_reload').trigger('click')
            <?php } ?>
        })
    }

    return false
}

comment_box('', '', 'c'); // 답변 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>

$(function() {
    // sns 등록
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>
$(function() {            
    //답변열기
    $(".cmt_btn").click(function(){
        $(this).toggleClass("cmt_btn_op");
        $("#bo_vc").toggle();
    });
});
</script>
<?php } ?>
<!-- } 답변 쓰기 끝 -->
=======
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_comments) 
{
	//답변 채택시 댓글 재정렬
    if($view['wr_2'] == '1') 
    {
        unset($list);

        $sql = " select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 order by case when wr_2 = '1' then 1 else 2 end ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) 
        {
            $list[$i] = $row;
            $tmp_name = get_text($row['wr_name']); // 설정된 자리수 만큼만 이름 출력

            $list[$i]['name'] = "<span class='".($row['mb_id']?'member':'guest')."'>$tmp_name</span>";

            $list[$i]['content'] = $list[$i]['content1']= "비밀글 입니다.";
            
            if (!strstr($row['wr_option'], "secret") || $is_admin || ($write['mb_id']==$member['mb_id'] && $member['mb_id']) || ($row['mb_id']==$member['mb_id'] && $member['mb_id'])) 
            {
                $list[$i]['content1'] = $row['wr_content'];
                $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');
                $list[$i]['content'] = search_font($stx, $list[$i]['content']);
            }

            $list[$i]['trackback'] = url_auto_link($row['wr_trackback']);
            $list[$i]['datetime'] = substr($row['wr_datetime'],2,14);

            // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
            $list[$i]['ip'] = $row['wr_ip'];
            if (!$is_admin)
                $list[$i]['ip'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row['wr_ip']);

            // 답변있는 코멘트는 수정, 삭제 불가
            if ($i > 0 && !$is_admin)
            {
                if ($row['wr_comment_reply'])
                {
                    $tmp_comment_reply = substr($row['wr_comment_reply'], 0, strlen($row['wr_comment_reply']) - 1);
                    	
					if ($tmp_comment_reply == $list[$i-1]['wr_comment_reply'])
                    {
                        $list[$i-1]['is_edit'] = false;
                        $list[$i-1]['is_del'] = false;
                    }
                }
            }
        }
	}
}

$chk_answer = false;
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대

function answer_select(wr_id,c_mb_id,comment_id) {
	if (comment_id) {
		$.ajax({
			url: '<?php echo $board_skin_url?>/ajax.answer_select.php',
			type: 'GET',
			data: {'bo_table': '<?php echo $bo_table?>', 'wr_id': wr_id, 'c_mb_id': c_mb_id, 'comment_id': comment_id},
			dataType: 'html'
		})
		.done(function(result) {
			console.log(result);
		});
	}
}
</script>

<style>
    .comm_tit {font-size: 18px; font-weight: 700; color: #000;}
	textarea {width:100% !important; border:0px !important; background-color: #f1f1f1 !important; font-size: 14px !important; padding: 10px !important;}
	textarea:focus {border:1px solid #ddd !important; outline: none !important;}
</style>



<div class="view_div01">
    <div class="view_info_is" style="border-bottom:0px;">
        <div class="comm_tit"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#999"></i> <span class="main_color">답변 <?php echo number_format($view['wr_comment']) ?></span></div>
    
    </div>
</div>



<!-- 답변 시작 { -->
<ajaxcomment>
<section id="bo_vc">
    <h2>답변목록</h2>
    <?php
    $cmt_amt = count($list);
    for ($i=0; $i<$cmt_amt; $i++) {
        if($list[$i]['wr_1']) {
            $ilhot = $list[$i]['wr_1'];
            $mention_user = "<span class=\"text-teal-500 font-bold\">@{$ilhot}</span> ";
			
        } else {
            $mention_user = '';
        }

		if($list[$i]['wr_2'] == '1') {
			$chk_answer = true;
		}

        $comment_id = $list[$i]['wr_id'];
        $cmt_depth = strlen($list[$i]['wr_comment_reply']);
        $comment = $mention_user.$list[$i]['content'];
        /*
        if (strstr($list[$i]['wr_option'], "secret")) {
            $str = $str;
        }
        */
        $comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
        $cmt_sv = $cmt_amt - $i + 1; // 답변 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
     ?>

	<div style="margin:0px 10px 0px 10px; border-top:1px solid #eee; <?php if ($cmt_depth) { ?>border-top:none;<?php } ?>">
		<article id="c_<?php echo $comment_id ?>" style="<?php if ($cmt_depth) { ?>padding:20px; border-radius:3px;<?php } ?>" class="<?php echo $list[$i]['wr_2'] == '1' ? 'gradient-border' : ''  ?>">
			<header style="z-index:<?php echo $cmt_sv; ?>">
				<span style="font-size: 14px;"><?php echo $list[$i]['name'] ?></span>　<time style="color:#999" datetime="<?php echo date('Y.m.d\TH:i:s+09:00', strtotime($list[$i]['datetime'])) ?>"><?php echo $list[$i]['datetime'] ?></time>
				<span class="bo_vc_hdinfo">
					<?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
					$query_string = clean_query_string($_SERVER['QUERY_STRING']);

					if($w == 'cu') {
						$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
						$cmt = sql_fetch($sql);
						if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
							$cmt['wr_content'] = '';
						$c_wr_content = $cmt['wr_content'];
					}

					$c_reply_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
					$c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
                    $ilhot_wr_name = $list[$i]['wr_name'];
				 ?>
				<ul class="bo_vc_act">
					<?php if ($list[$i]['is_edit']) { ?><li><a href="<?php echo $c_edit_href;  ?>" onclick="comment_box('<?php echo $comment_id ?>', '<?php echo get_text($ilhot_wr_name)?>', 'cu'); return false;"><i class="fa fa-cog" aria-hidden="true"></i></a></li><?php } ?>
					<?php if ($list[$i]['is_del'])  { ?><li><a href="<?php echo $list[$i]['del_link'];  ?>" onclick="return comment_delete(this);"><i class="fa fa-times" aria-hidden="true"></i></a></li><?php } ?>
				</ul>
				<?php } ?>
				
				</span>
				<?php
				include(G5_SNS_PATH.'/view_comment_list.sns.skin.php');
				?>
			</header>

			<!-- 답변 출력 -->
			<div class="cmt_contents">
				<p style="padding-top:10px;">
					<?php if (strstr($list[$i]['wr_option'], "secret")) { ?><i class="fa fa-lock" aria-hidden="true"></i> <?php } ?>
					<?php echo $comment ?>
				</p>
			</div>
			<span id="edit_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 수정 -->
			<span id="reply_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 답변 -->
			
			<div class="cb"></div>
			
			<?php if($list[$i]['wr_2'] != 1) {?>
				<?php if(!$chk_answer) {?>
					<a href="<?php echo $c_reply_href;  ?>" onclick="answer_select('<?php echo $wr_id ?>', '<?php echo $list[$i]['mb_id']?>', '<?php echo $comment_id ?>'); return false;" class="rounded-full border border-teal-500 float-right text-white text-sm text-teal-500 px-2 py-1"><i class="fa fa-certificate" aria-hidden="true"></i>답변 채택</a>
				<?php }?>
			<?php } else {?>
			<span class="flex flex-col bg-white items-center justify-center rounded-full border border-teal-500 float-right text-white text-sm text-teal-500 w-16 h-16 p-2">
				<svg class="w-8 h-8 fill-current text-teal-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px">
					<g>
						<path d="M11.18,14.356c0-1.451,1.1-2.254,2.894-3.442C16.268,9.458,19,7.649,19,3.354
							c0-0.387-0.317-0.699-0.709-0.699h-3.43C14.377,1.759,12.932,0.8,10,0.8c-2.934,0-4.377,0.959-4.862,1.855H1.707
							C1.316,2.655,1,2.968,1,3.354c0,4.295,2.73,6.104,4.926,7.559c1.794,1.188,2.894,1.991,2.894,3.442v1.311
							c-1.884,0.209-3.269,0.906-3.269,1.736c0,0.994,1.992,1.799,4.449,1.799s4.449-0.805,4.449-1.799c0-0.83-1.385-1.527-3.269-1.736
							C11.18,15.666,11.18,14.356,11.18,14.356z M13.957,9.3c0.566-1.199,1.016-2.826,1.088-5.246h2.51
							C17.315,6.755,15.693,8.118,13.957,9.3z M10,2.026c2.732-0.002,3.799,1.115,3.798,1.529c0,0.418-1.066,1.533-3.798,1.535
							C7.268,5.089,6.201,3.974,6.201,3.556C6.2,3.142,7.268,2.024,10,2.026z M2.445,4.054h2.509C5.027,6.474,5.475,8.101,6.043,9.3
							C4.307,8.118,2.684,6.755,2.445,4.054z"></path>
					</g>
				</svg>
				채택됨
			</span>
			<?php }?>
			<div class="cb"></div>

			<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
			<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

		</article>
	</div>
    <?php } ?>
    <?php if ($i == 0) { //답변 없다면 ?><p id="bo_vc_empty">등록된 답변이 없습니다.</p><?php } ?>

</section>
</ajaxcomment>
<!-- } 답변 끝 -->


<div class="board_div_b">


<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>
<!-- 답변 쓰기 시작 { -->
<aside id="bo_vc_w" class="bo_vc_w">
    <h2>답변쓰기</h2>
    <form name="fviewcomment" id="fviewcomment" action="<?php echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>" id="w">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="is_good" value="">
    <input type="hidden" name="mention_user" value="ilhot" id="mention_user">

    <span class="sound_only">내용</span>
    <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
    <textarea class="wr_content_area" id="wr_content" name="wr_content" maxlength="10000" required class="required" title="내용"  
    <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
    <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
    <script>
    $(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
        var str = $(this).val()
        var mx = parseInt($(this).attr("maxlength"))
        if (str.length > mx) {
            $(this).val(str.substr(0, mx));
            return false;
        }
    });
    </script>
    <div class="bo_vc_w_wr">
        <div class="bo_vc_w_info">
            <?php if ($is_guest) { ?>
            <label for="wr_name" class="sound_only">이름<strong> 필수</strong></label>
            <input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" required class="frm_input required" size="25" placeholder="성함">
            <label for="wr_password" class="sound_only">비밀번호<strong> 필수</strong></label>
            <input type="password" name="wr_password" id="wr_password" required class="frm_input required" size="25"  placeholder="비밀번호">
            <?php
            }
            ?>
            <?php
            if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) {
            ?>
            <span class="sound_only">SNS 동시등록</span>
            <span id="bo_vc_send_sns"></span>
            <?php } ?>
            <?php if ($is_guest) { ?>
                <?php echo $captcha_html; ?>
            <?php } ?>
        </div>
        
        <div class="cb"></div>
        
		<div class="btn_confirm2">
            <input type="submit" id="btn_submit" class="btn_submit" value="답변등록">
		</div>
        <div class="btn_confirm">
           음란, 욕설, 비방 등의 답변은 삼가해주세요.
		</div>
    </div>
    </form>
</aside>

<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;
var mention_user;
function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("답변은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("답변은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("답변을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);
    document.getElementById('mention_user').value = mention_user;
    document.getElementById("btn_submit").disabled = "disabled";

    // ajax comment system
    $.ajax({
        url: f.action,
        type: 'POST',
        data: $(f).serialize(),
        dataType: 'html',
    })
    .done(function(str) {
        var tempDom = $('<output>').append($.parseHTML(str))
        var title = $('title', tempDom).text()
        if (title === '') {
            // 1. commentBox 원위치
            comment_box('', '', 'c')

            // 2. commentBox Form 리셋
            f.reset()
            
            // 3. 코멘트 출력
            $.ajax({
                url: str,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(str2) {
                var tempDom2 = $('<output>').append($.parseHTML(str2))
                $('ajaxcomment').replaceWith($('ajaxcomment', tempDom2))
            })
        }

        <?php if ($is_guest) { ?>
        // 4. 캡차 리로드
        $('#captcha_reload').trigger('click')
        <?php } ?>

        document.getElementById("btn_submit").disabled = ""
    })

    return false;
}



function comment_box(comment_id, wr_name, work)
{
    var el_id,
        form_el = 'fviewcomment',
        respond = document.getElementById(form_el);

    // 답변 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'bo_vc_w';

    if (wr_name) {
        mention_user = wr_name;
    } else {
        mention_user = '';
    }

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).appendChild(respond);
        //입력값 초기화
        document.getElementById('wr_content').value = '';
        
        // 답변 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        if(save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

function comment_delete(that)
{
    if (confirm('이 답변을 삭제하시겠습니까?')) {
        // ajax comment system
        $.ajax({
            url: that.href,
            type: 'GET',
            dataType: 'html',
        })
        .done(function(str) {
            var tempDom = $('<output>').append($.parseHTML(str))
            var title = $('title', tempDom).text()
            if (title === '') {
                // 1. commentBox 원위치
                comment_box('', '', 'c')
                
                // 2. 코멘트 출력
                $.ajax({
                    url: str,
                    type: 'GET',
                    dataType: 'html'
                })
                .done(function(str2) {
                    var tempDom2 = $('<output>').append($.parseHTML(str2))
                    $('ajaxcomment').replaceWith($('ajaxcomment', tempDom2))
                })
            }

            <?php if ($is_guest) { ?>
            // 4. 캡차 리로드
            $('#captcha_reload').trigger('click')
            <?php } ?>
        })
    }

    return false
}

comment_box('', '', 'c'); // 답변 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>

$(function() {
    // sns 등록
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>
$(function() {            
    //답변열기
    $(".cmt_btn").click(function(){
        $(this).toggleClass("cmt_btn_op");
        $("#bo_vc").toggle();
    });
});
</script>
<?php } ?>
<!-- } 답변 쓰기 끝 -->
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
</div>