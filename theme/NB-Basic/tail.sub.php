<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	//우측 쪽지 알림 메세지
	if($is_member && strpos($_SERVER['PHP_SELF'],'/bbs/memo')===false && strpos($_SERVER['PHP_SELF'],'/adm/')===false ) {
		$sql = " select a.*, b.mb_nick
			from {$g5['memo_table']} a
			left join {$g5['member_table']} b on (a.me_send_mb_id = b.mb_id)
			where a.me_recv_mb_id = '{$member['mb_id']}' and a.me_type = 'recv' and a.me_read_datetime = '0000-00-00 00:00:00'
			order by a.me_send_datetime desc limit 10 ";

		$memo_result = sql_query($sql);
	}
?>

<?php if ($is_admin == 'super') {  ?>
<!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> -->
<?php }  ?>

<?php run_event('tail_sub'); ?>
<script>
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    if(isIE === true){
        var ch = $('.category-list').children();
        $('.category-list').after('<div id="cat-row" class="row"></div>');
        $('#cat-row').addClass('category-list').append(ch);
        $('#cat-row').children('div').addClass('col-sm-1 m-2');
        $('#bo_stx_search').css('background', '#e4c980');
        $('.adminbtn').css('background', '#e4c980');
        $('.gal_btns').css('margin', '20px');
        $('.btn-primary').find('svg').remove();

        $('#bo_btn_top').find('.btn-primary').css('background', '#e4c980');
    }

<?php if($is_member && $member['mb_level'] < 24 && $member['mb_8']!='Y'){?>
	/*서비스 안내 확인하면 100포인트 지급*/
	if( typeof guideToast == 'function' ) {
		guideToast('회원가입 후 사이트안내 게시판 읽고 <span class="text-dark">"확인"</span> 버튼 클릭 시 <span class="text-dark">"100파운드"</span>도 잊지 마세요!');	
	}
<?php }?>

<?php
	if($is_member && strpos($_SERVER['PHP_SELF'],'/bbs/memo')===false && strpos($_SERVER['PHP_SELF'],'/adm/')===false ) {
		
		$memo_count = 0;
		
		for ($i=0; $memo_row=sql_fetch_array($memo_result); $i++) {
?>
	if( typeof memoToast == 'function' ) {
		memoToast('<?php echo $memo_row['me_id'];?>','<span class="text-dark"><?php echo $memo_row['mb_nick'];?></span>님으로 부터 쪽지가 도착했습니다.<br/>"<?php echo cut_str(preg_replace('/\r\n|\r|\n/','',$memo_row['me_memo']),30);?>"');
	}
<?php
		$memo_count++;
		}
	}
?>
</script>
<?php if($memo_count){?>
<audio src="/theme/sound.mp3?ver=<?php echo G5_JS_VER; ?>" autoplay="true"></audio>
<?php }?>
</body>
</html>
<!-- <?php echo na_seo(html_end(), $tset['seo']); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?> -->