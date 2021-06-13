<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="' . $nt_side_url . '/side.css">', 10);
?>

<?php if (!$is_index) { // 페이지에서는 메뉴 출력 
?>
    <?php
    $mes = array();
    for ($i = 0; $i < $menu_cnt; $i++) {
        // 주메뉴 이하 사이트이고 서브메뉴가 있으면...
        if ($menu[$i]['on']) {
            $mes = $menu[$i];
            break;
        }
    }

    // 선택메뉴가 있다면...
    if (!empty($mes)) {
    ?>
        <div id="nt_side_menu" class="mb-4 font-weight-normal" style="display: none;">
            <div class="p-4 text-center text-white bg-primary py-sm-5 en">
                <h4>
                    <i class="fa <?php echo $mes['icon'] ?>" aria-hidden="true"></i>
                    <?php echo $mes['text']; ?>
                </h4>
            </div>
            <?php if (isset($mes['s'])) { ?>
                <ul class="border me-ul border-top-0">
                    <?php for ($i = 0; $i < count($mes['s']); $i++) {
                        $me = $mes['s'][$i];
                    ?>
                        <li class="me-li">
                            <?php if (isset($me['s'])) { //Is Sub Menu 
                            ?>
                                <i class="fa fa-caret-down tree-toggle me-i"></i>
                            <?php } ?>
                            <a class="me-a" href="<?php echo $me['href']; ?>" target="<?php echo $me['target']; ?>">
                                <i class="fa <?php echo $me['icon'] ?> fa-fw" aria-hidden="true"></i>
                                <?php echo $me['text']; ?>
                            </a>

                            <?php if (isset($me['s'])) { //Is Sub Menu 
                            ?>
                                <ul class="me-ul1 tree <?php echo ($me['on']) ? 'on' : 'off'; ?>">
                                    <?php for ($j = 0; $j < count($me['s']); $j++) {
                                        $me1 = $me['s'][$j];
                                    ?>
                                        <?php if ($me1['line']) { //구분라인 
                                        ?>
                                            <li class="me-line1"><a class="me-a1"><?php echo $me1['line']; ?></a></li>
                                        <?php } ?>

                                        <li class="me-li1<?php echo ($me1['on']) ? ' active' : ''; ?>">
                                            <a class="me-a1" href="<?php echo $me1['href']; ?>" target="<?php echo $me1['target']; ?>">
                                                <i class="fa <?php echo $me1['icon'] ?> fa-fw" aria-hidden="true"></i>
                                                <?php echo $me1['text']; ?>
                                            </a>
                                        </li>
                                    <?php } //for 
                                    ?>
                                </ul>
                            <?php } //is_sub 
                            ?>
                        </li>
                    <?php } //for 
                    ?>
                </ul>
            <?php } //is_sub 
            ?>
        </div>
        <script>
            $(document).ready(function() {
                $(document).on('click', '#nt_side_menu .tree-toggle', function() {
                    $(this).parent().children('ul.tree').toggle(200);
                });
            });
        </script>
    <?php } ?>
<?php } ?>

<!-- hulan nemsen  -->
<!-- <div class="side_cate">
    <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=gallery">
        <img src="<?php echo G5_URL ?>/img/side_top_img.png" style="display: block; margin: auto;"></a>
</div> -->

<?php
$sql_date = "SELECT mb_4 FROM {$g5['member_table']} WHERE mb_id = '{$member['mb_id']}' AND mb_level IN ('26', '27')";
$res_date = sql_fetch($sql_date);
$now = G5_TIME_YMDHIS;
if ($res_date['mb_4'] != '') {
    $end_time = strtotime($res_date['mb_4']);
    $now_time = strtotime($now);
    if ($end_time >= $now_time) {
        $diff = $end_time - $now_time;
        $diff_days = ceil($diff / 86400);
    } else if ($end_time < $now_time) {
        $diff_days = '0';
        $sql_d = " UPDATE {$g5['member_table']} 
                        SET mb_level = '26'
                        WHERE mb_id = '{$mb['mb_id']}' AND mb_level='27'";
        sql_query($sql_d);
    }
}

?>

<!-- //////////////////////////////////////////////////// -->

<ul class="mb-3 sub-ul">

    <?php
    if ($member['mb_level'] == '26' || $member['mb_level'] == '27') {
    ?>
        <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <div>
                <p>제휴마감 <span style="color: #3333ff;">D-<?php echo $diff_days ?>일</span></p>
                <a style="width: 100px;" class="cat_1_bg <?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "activesubs" ?>" href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=partnership" target="_self">
                    연장신청
                </a>
            </div>
        </li>
        <?php
    }
    $k = 0;
    $listd;
    $listd[$k]['name'] = substr($menu[0]['s'][0]['text'], 0, strrpos($menu[0]['s'][0]['text'], "-"));

    for ($ii = 0; $ii < 23; $ii++) {
        if ($listd[$k]['name'] != substr($menu[0]['s'][$ii]['text'], 0, strrpos($menu[0]['s'][$ii]['text'], "-"))) {
        ?>
            <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
                <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="flag5-on"><?php echo $listd[$k]['name']; ?> 업체정보
            </li>
            <?php
            for ($i = 0; $i < 22; $i++) {

                $me = $menu[0]['s'][$i];
                if (substr($me['text'], 0, strrpos($me['text'], "-")) == $listd[$k]['name']) {
            ?>
                    <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
                        <?php if (isset($me['s'])) { //Is Sub Menu 
                        ?>
                        <?php } ?>
                        <div style="<?php if (strstr($me['href'], $member['mb_6'])) echo "font-weight: bold; color: red; "; ?>">
                            <p><?php echo $me['text']; ?></p>
                            <a class="<?php if (strstr($me['bo_table'], $bo_table)) echo "activesubs" ?> cat_2_bg" title="<?php echo $me['text'] . ' 정보 | 밤의제국 bamje.com'; ?>" style="<?php if (strstr($me['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $me['href']; ?>" target="_self">정보
                            </a>
                            <a class="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "activesubs" ?> cat_1_bg" title="<?php echo $me['text']; ?> 후기" style="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $menu[1]['s'][$i]['href']; ?>" target="_self">
                                후기
                            </a>
                        </div>
                    </li>
                <?php }
            } //for 
            if (!$menu_cnt) { ?>
                <li class="me-li">
                    <a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
                </li>
    <?php
            }
            $k++;
            $listd[$k]['name'] = substr($menu[0]['s'][$ii]['text'], 0, strrpos($menu[0]['s'][$ii]['text'], "-"));
        }
    } ?>
     <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
        <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="flag5-on" />출장 업체정보
    </li>
    <?php
    for ($i = 22; $i < 23; $i++) {
        $me = $menu[0]['s'][$i];
    ?>
        <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php if (isset($me['s'])) { //Is Sub Menu 
            ?>
            <?php } ?>
            <div style="<?php if (strstr($me['href'], $member['mb_6'])) echo "font-weight: bold; color: red; "; ?>">
                <p><?php echo $me['text']; ?></p>
                <a class=" <?php if (strstr($me['bo_table'], $bo_table)) echo "activesubs" ?> cat_2_bg " title="<?php echo $me['text'] . ' 정보 | 밤의제국 bamje.com'; ?>" style="<?php if (strstr($me['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $me['href']; ?>" target="_self">정보
                </a>
                <a class="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "activesubs" ?> cat_1_bg " title="<?php echo $me['text']; ?> 후기" style="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $menu[1]['s'][$i]['href']; ?>" target="_self">
                    후기
                </a>
            </div>
        </li>
    <?php } //for  
    ?>

    <!------------ 업체정보-start------------------------------ -->
    <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
        <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="flag5-on" />키스방/립카페/핸플 업체정보
    </li>
    <?php
    for ($i = 23; $i < 26; $i++) {
        $me = $menu[0]['s'][$i];
    ?>
        <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php if (isset($me['s'])) { //Is Sub Menu 
            ?>
            <?php } ?>
            <div style="<?php if (strstr($me['href'], $member['mb_6'])) echo "font-weight: bold; color: red; "; ?>">
                <p><?php echo $me['text']; ?></p>
                <a class="  <?php if (strstr($me['bo_table'], $bo_table)) echo "activesubs" ?> cat_2_bg" title="<?php echo $me['text'] . ' 정보 | 밤의제국 bamje.com'; ?>" style="<?php if (strstr($me['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $me['href']; ?>" target="_self">정보
                </a>
                <a class=" <?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "activesubs" ?> cat_1_bg " title="<?php echo $me['text']; ?> 후기" style="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $menu[1]['s'][$i]['href']; ?>" target="_self">
                    후기
                </a>
            </div>
        </li>
    <?php } //for  
    ?>

    <!------------ 기타 업체정보-start------------------------------ -->
    <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
        <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="flag5-on" />기타 업체정보
    </li>
    <?php
    for ($i = 26; $i < 27; $i++) {
        $me = $menu[0]['s'][$i];
    ?>
        <li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
            <?php if (isset($me['s'])) { //Is Sub Menu 
            ?>
            <?php } ?>
            <div style="<?php if (strstr($me['href'], $member['mb_6'])) echo "font-weight: bold; color: red; "; ?>">
                <p><?php echo $me['text']; ?></p>
                <a class=" <?php if (strstr($me['bo_table'], $bo_table)) echo "activesubs" ?> cat_2_bg " title="<?php echo $me['text'] . ' 정보 | 밤의제국 bamje.com'; ?>" style="<?php if (strstr($me['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $me['href']; ?>" target="_self">정보
                </a>
                <a class="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "activesubs" ?> cat_1_bg " title="<?php echo $me['text']; ?> 후기" style="<?php if (strstr($menu[1]['s'][$i]['href'], $bo_table)) echo "background-color: #ffd345" ?>;" href="<?php echo $menu[1]['s'][$i]['href']; ?>" target="_self">
                    후기
                </a>
            </div>
        </li>
    <?php } //for  
    ?>
    <!------------ 업체정보 end------------------------------- -->
    <style>
        .me-li div a img {
            padding-right: 15px;
        }
    </style>
    <?php
    for ($k = 2; $k < count($menu); $k++) {
        if ($menu[$k]['text'] != "고객센터" && $menu[$k]['text'] != "명예의전당" && $menu[$k]['text']) {
    ?>
            <li class="me-li" style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
                <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="<?php echo $menu[$k]['text'] ?>" /> <?php echo $menu[$k]['text'] ?>
            </li>
            <?php for ($i = 0; $i < count($menu[$k]['s']); $i++) {
                $me = $menu[$k]['s'][$i];
            ?>
                <?php if ($i % 2 == 0) { ?>
                    <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
                    <?php } ?>
                    <?php if (isset($me['s'])) { //Is Sub Menu 
                    ?>
                    <?php } ?>
                    <div class="px-0 m-0 col-6">
                        <a class="border-0" style="font-size: 14px; <?php echo ($me['active']) ? 'color: red; border-color: red' : '' ?>" href="<?php echo $me['href']; ?>" target="_self"><img src="<?php echo G5_URL ?>/img/solid/<?php echo substr($me['icon'], 3, strlen($me['icon'])) ?>.svg" style="height :14px;" alt="<?php echo substr($me['icon'], 3, strlen($me['icon'])), "1" ?>" /><?php echo $me['text']; ?>
                        </a>
                    </div>
                    <?php if ($i % 2 == 1) { ?>
                    </li>
    <?php }
                }
            }
        } ?>
    <!-- <?php $me_text = "실장님 정보공유";
            if ($me_text == "실장님 정보공유") {
                if ($member['mb_level'] == 26 || $member['mb_level'] == 27 || $is_admin) { ?>
    <li class="me-li"
        style="border-bottom: 2px solid #aaa; font-size: 16px; color: #252525; padding-top: 14px; padding-bottom: 12px; height: 54px;">
        <img src="<?php echo G5_URL ?>/img/img-flag5-on.png" alt="flag5-on"/>밤의제국
    </li>
    <li class="row mx-0 me-li<?php echo ($me['on']) ? ' active' : ''; ?>"> 
        <div class="px-0 m-0 col-6">
            <a class="border-0"
                style="font-size: 14px; <?php echo ($me['active']) ? 'color: red; border-color: red' : '' ?>"
                href="<?php if ($member['mb_level'] == 27 || $is_admin) echo G5_BBS_URL . '/board.php?bo_table=work_board' ?>" target="_self" <?php if ($member['mb_level'] == 26)  echo 'onclick=levelalert();' ?>><img
                    src="<?php echo G5_URL ?>/img/solid/headphones.svg"
                    style="height :14px;" alt="headphones"/><?php echo $me_text; ?>
            </a>
            <?php if ($member['mb_level'] == 26) { ?>
            <script>
                function levelalert() {
                    alert("비제휴업소는 입장 불가능합니다.");
                }
            </script>
            <?php } ?>
        </div>
    </li>
    <?php }
            } ?> -->

</ul>
<script>
    $('a.cat_2_bg').click(function() {
        $(this).removeClass('cat_2_bg').addClass('cat_2_bg_a');
    });

    $('a.cat_1_bg').click(function() {
        $(this).removeClass('cat_1_bg').addClass('cat_1_bg_a');
    });
</script>