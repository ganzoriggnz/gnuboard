<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_footer_url.'/footer.css">', 0);
?>

<?php if(G5_IS_MOBILE) { ?>
	<div id="actionbtns" class="mb-3">
		<?php if($member['mb_id']) { ?>
			<a href="<?php echo G5_BBS_URL.'/logout.php' ?>" class="button_col">로그아웃</a>
			<a href="<?php echo G5_BBS_URL.'/userinfo.php' ?>" class="button_col">마이페이지</a>
			<a href="<?php echo G5_BBS_URL.'/board.php?bo_table=partnership' ?>" class="button_col">제휴문의</a>
			<a class="button_col"></a>
		<?php } else { ?>
			<a href="<?php echo G5_BBS_URL.'/login.php' ?>" class="button_col">로그인</a>
			<a href="<?php echo G5_BBS_URL.'/register.php' ?>" class="button_col">회원가입</a>
			<a href="<?php echo G5_BBS_URL.'/board.php?bo_table=partnership' ?>" class="button_col">제휴문의</a>
			<a class="button_col"></a>
		<?php } ?>			
	</div>	
<?php } ?>
<footer id="nt_footer" class="f-de font-weight-normal">
	<div class="nt-container">
		<!-- <div class="item-text">
			본 사이트에서는 회원들간 자료공유에 따른 중계역할만 하며, 저작권에 대한 책임은 업로드를 한 회원에게 있습니다. 또한 해당 자료에 대한 원본파일은 서버에 보관하지 않습니다. <br>
			각각의 게시물에 대한 내용은 본 사이트에서 보증하지 않으며, 유해하다고 판단될시 관리자에 의해 삭제조치 될 수 있습니다. 사이트 이용에 따라 자료에 대한 판단 책임은 이용자에게 있습니다.
		</div> -->
	</div>
</footer>