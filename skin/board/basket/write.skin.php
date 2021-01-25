<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<?php
// 포인트 가져 오기
$query5 = "select mb_point from g5_member where mb_id = '$homepage' ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	$mypoint = $row['mb_point']; 
}
?>
<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">

<section id="bo_w">
    <h2 id="container_title">현황</h2>

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

    <input type="hidden" name="wr_subject" value="<?php echo $subject ?>">
    <input type="hidden" name="mypoint" value="<?php echo $mypoint ?>">

    <input type="hidden" name="wr_content" value="<?php echo $content ?>">
    <input type="hidden" name="wr_link1" value="<?php echo $write['wr_link1'] ?>">
    <input type="hidden" name="wr_link2" value="<?php echo $write['wr_link2'] ?>">
    <input type="hidden" name="ca_name" value="<?php echo $write['ca_name'] ?>">
    <input type="hidden" name="wr_1" value="<?php echo $wr_1 ?>">
    <input type="hidden" name="wr_2" value="<?php echo $wr_2 ?>">
    <input type="hidden" name="wr_3" value="<?php echo $wr_3 ?>">
    <input type="hidden" name="wr_4" value="<?php echo $wr_4 ?>">
    <input type="hidden" name="wr_5" value="<?php echo $wr_5 ?>">
    <input type="hidden" name="wr_6" value="<?php echo $wr_6 ?>">
    <input type="hidden" name="wr_7" value="<?php echo $wr_7 ?>">
    <input type="hidden" name="wr_8" value="<?php echo $wr_8 ?>">
    <input type="hidden" name="wr_9" value="<?php echo $wr_9 ?>">
    <input type="hidden" name="wr_10" value="<?php echo $wr_10 ?>">
	<input type="hidden" name="wr_11" value="<?php echo $homepage ?>">

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
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" checked>'." \n".'<label for="secret">비밀글</label>';
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

    <div class="tbl_frm01 tbl_wrp">
        <table>
        <tbody>
 
   


        <tr>
            <th scope="row"><label for="wr_subject">구매내역<strong class="sound_only">필수</strong></label></th>
            <td>
             <?php echo $subject ?>
            </td>
        </tr>
       <tr>
            <th scope="row"><label for="wr_name">신청인<strong class="sound_only">필수</strong></label></th>
            <td>
             <?php echo $name ?>
            </td>
        </tr>
 


        <tr>
            <th scope="row"><label for="wr_3">상태<strong class="sound_only">필수</strong></label></th>
            <td>

			<?php  if($wr_10 == "구매대기") $b = "checked"; ?>
			<?php  if($wr_10 == "구매완료") $d = "checked"; ?>
			<?php  if($wr_10 == "결제확인") $d = "checked"; ?>

                     <input type="radio" name="wr_10" value="구매대기" id="wr_10" <?php echo $b; ?>  class="frm_input required"> 구매대기    <input type="radio" name="wr_10" value="결제확인" id="wr_10" <?php echo $d; ?>  class="frm_input required"> 결제확인      <input type="radio" name="wr_10" value="구매완료" id="wr_10" <?php echo $d; ?>  class="frm_input required"> 구매완료   
            </td>
        </tr>
		
   <input type="hidden" name="wr_content" value="코멘트를 넣으세요"> 


        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
	     <input type="submit" value="확인" id="btn_submit" accesskey="s" class="btn_submit"> 
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록</a>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
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
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

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

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->