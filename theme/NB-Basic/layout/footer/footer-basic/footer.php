<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_footer_url.'/footer.css">', 0);
?>

	<!-- <nav class="nt-links">
		<div class="nt-container py-2 px-3 px-sm-4 px-xl-0">
			<h3 class="sr-only">하단 네비</h3>
			<ul class="float-md-left d-none d-md-block">
				<li><a href="<?php echo get_pretty_url('content', 'company'); ?>">사이트 소개</a></li> 
				<li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a></li> 
				<li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'noemail'); ?>">이메일 무단수집거부</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'disclaimer'); ?>">책임의 한계와 법적고지</a></li>
			</ul>
			<ul class="float-md-right text-center text-md-left">
				<li><a href="<?php echo get_pretty_url('content', 'guide'); ?>">이용안내</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/qalist.php">문의하기</a></li>
				<li><a href="<?php echo get_device_change_url(); ?>"><?php echo (G5_IS_MOBILE) ? 'PC' : '모바일';?>버전</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</nav>  -->
<footer id="nt_footer" class="f-de font-weight-normal">
	<div class="nt-container">
		<div class="item-circle">19</div>
		<div class="item-text">
			본 사이트에서는 회원들간 자료공유에 따른 중계역할만 하며, 저작권에 대한 책임은 업로드를 한 회원에게 있습니다. 또한 해당 자료에 대한 원본파일은 서버에 보관하지 않습니다. <br>
			각각의 게시물에 대한 내용은 본 사이트에서 보증하지 않으며, 유해하다고 판단될시 관리자에 의해 삭제조치 될 수 있습니다. 사이트 이용에 따라 자료에 대한 판단 책임은 이용자에게 있습니다.
		</div>
	</div>
</footer>
