<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_footer_url.'/footer.css">', 0);
?>

<?php if(G5_IS_MOBILE) { ?>
	<div id="actionbtns">
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

<footer id="nt_footer">
	<div class="nt-container">
		<div class="item-text">
			<p>밤의제국 <span>오피커뮤니티 - bamje.com</span></p>
		</div> 
	</div>
</footer>