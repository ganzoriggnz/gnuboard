<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');
include_once('./_head.sub.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
@include_once(G5_THEME_PATH.'/common.php');



?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if ($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
	<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php }
na_script('fileinput');
?>

<div id="find_info" class="f-de">
    <div id="topNav" class="bg-primary text-white">
        <div class="p-3">
            <button type="button" class="close" aria-label="Close" onclick="window.close();">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            <h5><?php echo $g5['title']?></h5>
        </div>
    </div>
    <br />
    <form name="fmember" id="fmember" method="post" action="<?php echo G5_BBS_URL ?>/my_photo_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']?>" id="mb_id">
    
    <div class="text-center"><?php echo "<img src='".na_member_photo($member['mb_id'])."' style='border-radius:50%;'' />" ?></div>
    <div class="form-group text-center">
						<label class="px-2 text-center" for="reg_mb_img">회원이미지</label>
						<div class="px-2">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="reg_mb_img">이미지</label>
								</div>
								<div class="custom-file">
									<input type="file" name="mb_img" class="custom-file-input" id="reg_mb_img">
									<label class="custom-file-label" for="reg_mb_img" data-browse="선택"></label>
								</div>
							</div>
                            <?php if (file_exists($mb_img_path)) {  ?>
								<div class="custom-control custom-checkbox py-2">
									<input type="checkbox" name="del_mb_img" value="1" id="del_mb_img" class="custom-control-input">
									<label class="custom-control-label" for="del_mb_img"><span>회원이미지 삭제</span></label>
								</div>
							<?php }  ?>
							<p class="form-control-plaintext f-de text-muted pb-0">
								이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?>픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.
								gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_img_size'] / 1024) ?>kb 이하만 등록됩니다.
							</p>
						</div>
                     
					</div>        
        <div class=" tbl_wrap">
            <table style="width:100%;margin:0 auto; font-size:13px;">
                <tr>
                    <td class="p-2 text-right text-bold">신청자: </td>
                    <td><?php echo $member['mb_nick']?>( <?php echo $member['mb_id']?> )</td>
                </tr>
            </table>
            <div style="text-align:center">
                <input type="submit" id="change" value="정보수정" class="btn btn-primary en">
                <button type="cancel" class="btn btn-primary en" onclick="self.close()">창닫기</button>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo NA_URL ?>/js/jquery-3.5.1.min.js"></script>

<script>
	$(function() {
		$("#reg_zip_find").css("display", "inline-block");

		<?php if ($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
			// 아이핀인증
			$("#win_ipin_cert").click(function(e) {
				if (!cert_confirm())
					return false;

				var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
				certify_win_open('kcb-ipin', url, e);
				return;
			});

		<?php } ?>
		<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
			// 휴대폰인증
			$("#win_hp_cert").click(function(e) {
				if (!cert_confirm())
					return false;

				<?php
				switch ($config['cf_cert_hp']) {
					case 'kcb':
						$cert_url = G5_OKNAME_URL . '/hpcert1.php';
						$cert_type = 'kcb-hp';
						break;
					case 'kcp':
						$cert_url = G5_KCPCERT_URL . '/kcpcert_form.php';
						$cert_type = 'kcp-hp';
						break;
					case 'lg':
						$cert_url = G5_LGXPAY_URL . '/AuthOnlyReq.php';
						$cert_type = 'lg-hp';
						break;
					default:
						echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
						echo 'return false;';
						break;
				}
				?>

				certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>", e);
				return;
			});
		<?php } ?>
	});

	// submit 최종 폼체크
	function fregisterform_submit(f) {
		if (typeof f.mb_img != "undefined") {
			if (f.mb_img.value) {
				if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
					alert("회원이미지가 이미지 파일이 아닙니다.");
					f.mb_img.focus();
					return false;
				}
			}
		}
		document.getElementById("btn_submit").disabled = "disabled";

		return true;
	}

	var hangul = new RegExp("[\u1100-\u11FF|\u3130-\u318F|\uA960-\uA97F|\uAC00-\uD7AF|\uD7B0-\uD7FF]");

</script>