<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

@include_once(G5_THEME_PATH.'/common.php');

$result;

if ($w == '') {}
else if ($w == 'u')
{
    if($member['mb_level'] < 8 ){
            alert("회원검색은 향리 레벨 부터 가능합니다.");
            goto_url($PHP_SELF, false);
        }
    else {
        if($_POST['types']=='id')
        $result = sql_query("select * from {$g5['member_table']} where mb_id like '%{$_POST['searchd']}%'");        
        
        if($_POST['types']=='nick')
        $result = sql_query("select * from {$g5['member_table']} where mb_nick like '%{$_POST['searchd']}%'");        
    }
}
?>
<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal">
        <div id="bo_search" class="collapse show">
            <div class="alert bg-light border">
                <form id="fwrite" name="fwrite" method="post" class="m-auto">
                    <input type="hidden" name="w" value="u">
                    <div class="form-row mx-n1">
                        <div class="px-1">
                            <input type="radio" id="id" name="types" value="id" checked="checked" ?>
                            <label for="id" class="pt-2">아이디</label>
                            &nbsp;&nbsp;
                        </div>
                        <div class="px-1">
                            <input type="radio" id="nick" name="types" value="nick"
                                <?php if($_POST['types']=='nick') echo 'checked="checked"' ?>>
                            <label for="nick" class="pt-2">닉네임</label>
                            &nbsp;&nbsp;
                        </div>
                        <div class="col-12 col-sm-6 pt-2 pt-sm-0 px-1">
                            <div class="input-group">
                                <input type="text" id="searchd" name="searchd"
                                    value="<?php if($_POST['searchd']) echo $_POST['searchd']; ?>" required=""
                                    class="form-control" placeholder="검색어를 입력해 주세요.">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" title="검색하기">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <span class="sr-only">검색하기</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <section id="bo_list" class="mb-4">
        <div class="w-100 mb-0 bg-primary" style="height:4px;"></div>
        <!-- 목록 헤드 -->
        <div class="d-block d-md-none w-100 mb-10 bg-<?php echo $head_color ?>" style="height:4px;"></div>
        <table cellspacing="0" class="w-100 px-3 mr-3" cellpadding="0" width="100%"
            style="border:1px solid #d3d3d3;font-size: 12px; padding:5px;" id="level-up">
            <thead class="bg-light">
                <tr style="border:1px solid #d3d3d3;font-size: 12px; text-align: center; ">
                    <th class="cl_tr">아이디</th>
                    <th class="cl_tl">닉네임</th>
                    <th class="cl_tr">파운드</th>
                    <th class="cl_tr">회원가입일</th>
                    <th class="cl_tr">최종접속일</th>
                </tr>
            </thead>
            <tbody>
                <?php
				// $sum_point1 = $sum_point2 = $sum_point3 = 0;
		for ($i=0; $row=sql_fetch_array($result); $i++) {
		?>
                <tr style="border:1px solid #d3d3d3; font-size: 10px">
                    <td class="cl_td">
                        <?php echo na_name_photo($row['mb_id'], get_sideview($row['mb_id'], $row['mb_name'], $row['mb_email'])  ); ?>
                    </td>
                    <td class="cl_td" style="text-align: left;"><?php echo $row['mb_nick']; ?></td>
                    <td class="cl_td_r" style="text-align: left;"><?php echo $row['mb_point']; ?></td>
                    <td class="cl_td_r" style="text-align: left;"><?php echo $row['mb_datetime']; ?></td>
                    <td class="cl_td_r" style="text-align: left;"><?php echo $row['mb_today_login']; ?></td>
                </tr>
                <?php }
		if ($i == 0)
			echo '<li class="list-group-item border-left-0 border-right-0 f-de font-weight-normal py-5 text-muted text-center">자료가 없습니다.</li>';
		?>
            </tbody>
        </table>
    </section>
</div>