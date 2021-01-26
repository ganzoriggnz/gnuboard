<<<<<<< HEAD
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?'.time().'">', 0);
?>

<style>
	textarea {width:100% !important; border:0px !important; background-color: #f1f1f1 !important; font-size: 14px !important; padding: 10px !important;}
	textarea:focus {border:1px solid #ddd !important; outline: none !important;}
</style>


<section id="bo_w">

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">

    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>
        
        
        
         <div class="write_box">


            <?php if ($is_category) { ?>

            <select class="write_input" id="ca_name" name="ca_name" required>
                <option value="">분류를 선택하세요</option>
                <?php echo $category_option ?>
            </select>

            <?php } ?> 

			<?php if ($is_name) { ?>
            <input type="text" class="write_input required" name="wr_name" id="wr_name" value="<?php echo $name ?>" placeholder="작성자"><br>
			<?php } ?>
            <?php if ($is_password) { ?>
            <input type="password" class="write_input <?php echo $password_required ?>" name="wr_password" id="wr_password" <?php echo $password_required ?> placeholder="비밀번호"><br>
            <?php } ?>
            <?php if ($is_email) { ?>
            <input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="write_input" placeholder="이메일"><br>
            <?php } ?>
			<input type="text" class="write_input required" name="wr_subject" required value="<?php echo $subject ?>" placeholder="제목">
        </div>
        
		<div class="my-2 bg-white p-4 pt-0">
			<div class="write_box_div2 pl-0 text-red-500">
				답변 체택 포인트를 선택 하세요.
			</div>
			<?php 
			$kin_prices = Array(
				Array('10 파운드', 10),
				Array('30 파운드', 30),
				Array('50 파운드', 50),
				Array('100 파운드', 100),
			
			);
			foreach($kin_prices as $kinp) {
			?>
			<label class="inline-flex items-center">
				<input type="radio" class="form-radio" name="wr_1" value="<?php echo $kinp[1] ?>">
				<span class="ml-1 font-bold"><?php echo $kinp[0] ?></span>
			</label>
			<?php }?>
		</div>
        

        <div class="write_box_div2 text-teal-500">
            질문을 입력하세요.
        </div>
        <div class="write_box2">
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
            
        <?php if ($option) { ?>
        <div class="option_d">
            <?php echo $option ?>
        </div>
        <?php } ?>
            
        </div>
        
        

		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
		<div class="write_box_div4">
            파일첨부 <?php echo $i+1 ?>
        </div>
        
        <div class="write_box4">
            
            <div class="write_box4_c">
            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?>" class="write_input_file_100">
            <?php if($w == 'u' && $file[$i]['file']) { ?>
                <div class="write_box_div3">
                    <input type="checkbox" id="bf_file_del<?php echo $i+1 ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> 
                    <label for="bf_file_del<?php echo $i+1 ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 삭제</label>
                </div>
            <?php } ?>
                
            </div>

        </div>
		<?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <div class="write_box2" style="padding-top:10px;">
            <?php echo $captcha_html ?>
        </div>
        <?php } ?>
        
        
        <div class="btm_btn">
            <ul class="btm_btn01">
                <li><a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btm_btn_b01">취소</a></li>
                <li><input type="submit" class="btm_btn_b04" accesskey="s" value="등록완료"></li>

            </ul>
        </div>
        

    </form>

    <script>

    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {

        <?php echo $editor_js; ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
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

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }
        /*
        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }
        */

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>





=======
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?'.time().'">', 0);
?>

<style>
	textarea {width:100% !important; border:0px !important; background-color: #f1f1f1 !important; font-size: 14px !important; padding: 10px !important;}
	textarea:focus {border:1px solid #ddd !important; outline: none !important;}
</style>


<section id="bo_w">

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">

    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>
        
        
        
         <div class="write_box">


            <?php if ($is_category) { ?>

            <select class="write_input" id="ca_name" name="ca_name" required>
                <option value="">분류를 선택하세요</option>
                <?php echo $category_option ?>
            </select>

            <?php } ?> 

			<?php if ($is_name) { ?>
            <input type="text" class="write_input required" name="wr_name" id="wr_name" value="<?php echo $name ?>" placeholder="작성자"><br>
			<?php } ?>
            <?php if ($is_password) { ?>
            <input type="password" class="write_input <?php echo $password_required ?>" name="wr_password" id="wr_password" <?php echo $password_required ?> placeholder="비밀번호"><br>
            <?php } ?>
            <?php if ($is_email) { ?>
            <input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="write_input" placeholder="이메일"><br>
            <?php } ?>
			<input type="text" class="write_input required" name="wr_subject" required value="<?php echo $subject ?>" placeholder="제목">
        </div>
        
		<div class="my-2 bg-white p-4 pt-0">
			<div class="write_box_div2 pl-0 text-red-500">
				답변 체택 포인트를 선택 하세요.
			</div>
			<?php 
			$kin_prices = Array(
				Array('10 파운드', 10),
				Array('30 파운드', 30),
				Array('50 파운드', 50),
				Array('100 파운드', 100),
			
			);
			foreach($kin_prices as $kinp) {
			?>
			<label class="inline-flex items-center">
				<input type="radio" class="form-radio" name="wr_1" value="<?php echo $kinp[1] ?>">
				<span class="ml-1 font-bold"><?php echo $kinp[0] ?></span>
			</label>
			<?php }?>
		</div>
        

        <div class="write_box_div2 text-teal-500">
            질문을 입력하세요.
        </div>
        <div class="write_box2">
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
            
        <?php if ($option) { ?>
        <div class="option_d">
            <?php echo $option ?>
        </div>
        <?php } ?>
            
        </div>
        
        

		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
		<div class="write_box_div4">
            파일첨부 <?php echo $i+1 ?>
        </div>
        
        <div class="write_box4">
            
            <div class="write_box4_c">
            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?>" class="write_input_file_100">
            <?php if($w == 'u' && $file[$i]['file']) { ?>
                <div class="write_box_div3">
                    <input type="checkbox" id="bf_file_del<?php echo $i+1 ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> 
                    <label for="bf_file_del<?php echo $i+1 ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 삭제</label>
                </div>
            <?php } ?>
                
            </div>

        </div>
		<?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <div class="write_box2" style="padding-top:10px;">
            <?php echo $captcha_html ?>
        </div>
        <?php } ?>
        
        
        <div class="btm_btn">
            <ul class="btm_btn01">
                <li><a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btm_btn_b01">취소</a></li>
                <li><input type="submit" class="btm_btn_b04" accesskey="s" value="등록완료"></li>

            </ul>
        </div>
        

    </form>

    <script>

    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {

        <?php echo $editor_js; ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
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

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }
        /*
        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }
        */

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>





>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
