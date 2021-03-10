<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_footer_url.'/footer.css">', 0);
?>

<style>
	#nt_footer {
		height: 6rem;
		background-color: #202020;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		text-align: center;
	}
	#nt_footer .item-text {
		padding: 1rem 0;
		color: #B8B8B8;
		font-size: 10px;
	}
	@media only screen and (max-width: 600px) {
		#nt_footer {
			padding: 0.5rem 1rem;
		}
		#nt_footer .item-text {
			font-size: 8px;
		}
	}
</style>

<script>
	var body = document.body,
    html = document.documentElement

	var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight )

	window.onload = function() {
		if(height > window.innerHeight) {
			document.getElementById("nt_footer").style.position = "absolute";
		}
		else {
			document.getElementById("nt_footer").style.position = "fixed";
			document.getElementById("nt_footer").style.bottom = "0";
		}
	}
</script>

<footer id="nt_footer" class="f-de font-weight-normal">
	<div class="item-text">
		본 사이트에서는 회원들간 자료공유에 따른 중계역할만 하며, 저작권에 대한 책임은 업로드를 한 회원에게 있습니다. 또한 해당 자료에 대한 원본파일은 서버에 보관하지 않습니다. <br>
		각각의 게시물에 대한 내용은 본 사이트에서 보증하지 않으며, 유해하다고 판단될시 관리자에 의해 삭제조치 될 수 있습니다. 사이트 이용에 따라 자료에 대한 판단 책임은 이용자에게 있습니다.
	</div>
</footer>