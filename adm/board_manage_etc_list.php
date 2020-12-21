<?php
$sub_menu = "300850";
include_once('./_common.php');
include_once(G5_LIB_PATH."/board_manage_etc_list.class.php");

auth_check($auth[$sub_menu], 'r');

//인스턴스 생성
$board_manage_etc_list = new board_manage_etc_list;

//게시판 목록
$board_list = $board_manage_etc_list->getBoadList();
//print_r2($board_list);

//bo_table 설정
if(!$bo_table) $bo_table=$board_list[0]['bo_table'];
$board_manage_etc_list->set_bo_table($bo_table);

//페이지 설정
$page_rows=20;
if(!$page) $page = 1;

//리스트 만들기
$board_manage_etc_list->page		= $page;
$board_manage_etc_list->page_rows	= $page_rows;
$board_manage_etc_list->orderby	= trim(" wr_num, wr_reply ");//정렬

unset($opt);
if($s_wr_id) $opt['s_wr_id'] = $s_wr_id;
if($sl_wr_subject) $opt['sl_wr_subject'] = $sl_wr_subject;
$opt['simple_wr_content']=1;//태그 없애도 짧게 잘라서 리턴함
$list = $board_manage_etc_list->lists($opt);
//print_r2($list);

//페이지
$total_count = $list['total_count'];
$total_page=$list['total_page'];

$g5['title'] = "날짜조회수관리";
include_once('./admin.head.php');
?>
<div class="tbl_head01 tbl_wrap">
    <form name="fsearch" id="fsearch" action="<?php echo $PHP_SELF ?>" method="GET">
        <table>
            <tr>
                <td align="left">
                    <span>Total <?php echo number_format($total_count) ?>건</span>
                    <?php echo $total_page ?> 페이지
                </td>

                <td align="center" width="80">게시판선택</td>
                <td align="center" width="120">
                    <select name="bo_table">
                        <option value="">게시판 선택</option>
                        <?php
                        if(count($board_list)) {
                            foreach($board_list as $k => $v) {
                        ?>
                        <option value="<?php echo $v['bo_table'] ?>" <?php if($bo_table==$v['bo_table']){ ?>selected<?php } ?>>
                            <?php echo $v['bo_subject']?> (<?php echo $v['bo_table']?>)
                        </option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                </td>
                <td align="center" width="80">고유번호</td>
                <td align="center" width="60"><input type="text" name="s_wr_id" size="10" class="frm_input" value="<?php echo $s_wr_id?>" /></td>
                <td align="center" width="60">제목</td>
                <td align="center" width="60"><input type="text" name="sl_wr_subject" size="10" class="frm_input" value="<?php echo $sl_wr_subject?>" /></td>
                <td align="center" width="60"><input type="submit" name="submit" value="검색" class="btn_default" style="height:34px;line-height:0px;" /></td>
            </tr>
        </table>
    </form>
</div>


<div class="tbl_head01 tbl_wrap">
    <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" width="80">고유번호</th>
            <th scope="col" width="">제목</th>
            <th scope="col" width="180">등록일</th>
            <th scope="col" width="180">최종수정일</th>
            <th scope="col" width="120">조회수</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($list['list']) {
            foreach($list['list'] as $k => $v) {
                $no = $list['total_count'] - ($page - 1) * $page_rows - $k;
                $bg = 'bg'.($k%2);
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td align="center">
                        <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $v['wr_id']?>" target="_blank" style="color:blue;">
                            <?php echo $v['wr_id']?>
                        </a>
                    </td>
                    <td>
                        <?php
                        if($v['wr_reply']){
                            for($i=0;$i<strlen($v['wr_reply']);$i++) {
                                echo "<span class='gray'>[r]</span>";
                            }
                        }
                        ?>
                        <?php
                        if($v['wr_is_comment']){
                            for($i=0;$i<strlen($v['wr_comment_reply'])+1;$i++) echo "<span class='gray'>[c]</span>";
                            echo ' '.$v['wr_content'];
                        } else {
                            echo ' '.$v['wr_subject'];
                        }
                        ?>
                    </td>
                    <td align="center">
                        <input type="text" id="wr_datetime_<?php echo $v['wr_id']?>" value="<?php echo $v['wr_datetime']?>" />
                        <input type="button" onclick="update('<?php echo $bo_table?>', '<?php echo $v['wr_id']?>', 'wr_datetime')" value="수정" />
                    </td>
                    <td align="center">
                        <?php if($v['wr_is_comment']) {?>
                            <?php echo '-';?>
                        <?php } else {?>
                            <input type="text" id="wr_last_<?php echo $v['wr_id']?>" value="<?php echo $v['wr_last']?>" />
                            <input type="button" onclick="update('<?php echo $bo_table?>', '<?php echo $v['wr_id']?>', 'wr_last')" value="수정" />
                        <?php }?>
                    </td>
                    <td align="center">
                        <?php if($v['wr_is_comment']) {?>
                            <?php echo '-';?>
                        <?php } else {?>
                            <input type="text" id="wr_hit_<?php echo $v['wr_id']?>" value="<?php echo $v['wr_hit']?>" style="width:30px;" />
                            <input type="button" onclick="update('<?php echo $bo_table?>', '<?php echo $v['wr_id']?>', 'wr_hit')" value="수정" />
                        <?php }?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php
$page_parameter="bo_table={$bo_table}&s_wr_id={$s_wr_id}&sl_wr_subject={$sl_wr_subject}";
echo get_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$page_parameter);
?>



<style>
    .tbl_wrap input[type=text] {
        width:110px;
        border:1px solid #AAA;
        padding:2px;
        text-align: center;
    }
    .tbl_wrap select {
        padding:5px;
    }
    .tbl_wrap tr:hover td {
        background-color: yellow;
    }
    .btn_default {border:1px solid #ccc; background:#fafafa;padding:10px;}
    .gray {font-size:10px;color:gray;}
</style>
<script>
    function update(bo_table, wr_id, what) {
        var val=$('#'+what+'_'+wr_id).val();
        if(!val) {
            alert('값이 없습니다.');
            return;
        }

        if(!confirm('['+val+']로 수정하시겠습니까?')) {
            return false;
        }

        $.post('./board_manage_etc_list_ajax.php',{'bo_table':bo_table,'wr_id': wr_id,'what':what,'val':val}, function(data) {
            if(data=='200') {
                location.reload();
            } else {
                alert('Error:'+data);
            }
        }).fail(function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        });
    }
</script>

<?php
include_once('./admin.tail.php');
?>
