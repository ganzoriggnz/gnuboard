<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if ($is_admin == 'super') {  ?>
<!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> -->
<?php }  ?>

<?php run_event('tail_sub'); ?>
<script>
        var isIE = /*@cc_on!@*/false || !!document.documentMode;
    console.log(isIE);
    if(isIE === true){
        console.log("aa");
        var ch = $('.category-list').children();
        $('.category-list').after('<div id="cat-row" class="row"></div>');
        $('#cat-row').addClass('category-list').append(ch);
        $('#cat-row').children('div').addClass('col-sm-1 m-2');
        $('#bo_stx_search').css('background', '#e4c980');
        $('.adminbtn').css('background', '#e4c980');
    }
</script>
</body>
</html>
<!-- <?php echo na_seo(html_end(), $tset['seo']); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?> -->