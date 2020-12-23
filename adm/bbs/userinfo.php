<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
?>
<div class="nt-container pb-4 pt-0 pt-sm-4">
    <div class="row na-row" style="/* width: 1318px; */display: flex; justify-content: space-between;">
        <div class="col-md-3<?php echo ($is_left_side) ? ' order-md-1' : ''; ?> na-col d-md-block d-none">
            <?php
            // layout/side에서 가져옴
            list($nt_side_url, $nt_side_path) = na_layout_content('side', 'side-basic'); // side-basic 폴더
            @include_once($nt_side_path . '/side.php')
            ?>
        </div>

        <!-- 메인 영역 -->
        <div class="col-md-9<?php echo ($is_left_side) ? ' order-md-2' : ''; ?> na-col" style="flex: 0 0 80%;">
            <nav id="bo_cate" class="sly-tab font-weight-normal mb-2">

            <div class="px-3 px-sm-0">
            <div class="d-flex">
            <div id="bo_cate_list" class="sly-wrap flex-grow-1">
            <ul id="bo_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
            <li class="active">
              <a class="py2 px-3" href=<?php echo G5_BBS_PATH.'/userinfo.php' ?> >
                <span>
                  <i class="fa fa-user">
                  회원정보
                  </i>
                </span>
              </a>
            </li>
            <li>
              <a class="py2 px-3" href='#'>
                <span>
                  <i class="fa fa-clock-o">
                   내 글
                  </i>
                </span>
              </a>
            </li>
            </ul>
            </div>
            <div>
            <a href="javascript:;" class="sly-btn sly-prev ca-prev py-2 px-3">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">이전 분류</span>
            </a>
            </div>
            <div>
            <a href="javascript:;" class="sly-btn sly-next ca-next py-2 px-3">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">다음 분류</span>
            </a>
            </div>
            </div>
            </div>
            <hr/>
            <script>
            $(document).ready(function() {
            $('#bo_cate .sly-wrap').sly({
            horizontal: 1,
            itemNav: 'basic',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            startAt: <?php echo $ca_select ?>,
            speed: 300,
            prevPage: '#bo_cate .ca-prev',
            nextPage: '#bo_cate .ca-next'
            });

            // Sly Tab
            var cate_id = 'bo_cate';
            var cate_size = na_sly_size(cate_id);

            na_sly(cate_id, cate_size);

            $(window).resize(function(e) {
            na_sly(cate_id, cate_size);
            });
            });
            </script>
            </nav>

<!-- hulan nemsen -->

<div style="position: fixed; bottom:0px; right:14px; z-index:9999">
  <a onclick="window.open('/bbs/chat.php','채팅방참여','width=420,height=550,scrollbars=yes,top=10,left=100'); ">
<img src="http://localhost/gnuboard/img/chat.png" title=""></a>

</div>
</div>
</div>
</div>
<?php
include_once(G5_BBS_PATH.'/board_tail.php');

include_once(G5_PATH.'/tail.sub.php');
?>
