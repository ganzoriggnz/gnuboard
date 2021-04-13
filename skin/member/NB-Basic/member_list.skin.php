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
    <nav id="user_cate" style="text-align: center">
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

        <div class="na-table d-none d-md-table d-sm-table w-100 mb-0 text-md-center bg-light">
            <div class="na-table-head border-primary d-md-table-row d-sm-table-row bg-light">
                <div class="d-md-table-cell d-sm-table-cell nw-2 px-md-1 text-md-center">계급</div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pl-2 px-md-1 pr-md-1 text-md-center">아이디</div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center">닉네임</div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center">파운드</div>
                <!-- <div class="d-md-table-cell nw-6 pr-md-1 text-md-center">파편조각</div> -->
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center">회원가입일</div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center">최종접속일</div>

            </div>
        </div>

        <ul class="na-table d-md-table d-sm-table w-100">
            <?php
			$sum_point1 = $sum_point2 = $sum_point3 = 0;

			
			for ($i=0; $row=sql_fetch_array($result); $i++) {
			$name = get_sideview_user($row['mb_id'], $row['mb_nick'], $row['mb_homepage']);
			$row['name'] = $name;
			?>
            <li class="d-md-table-row d-sm-table-row px-3 py-2 p-md-0 text-md-center text-muted border-bottom">
                <div class="d-md-table-cell d-sm-table-cell nw-2 px-md-1 text-md-center"><?php 
				if (get_level($row['mb_id'])) 
					echo get_level($row['mb_id']);
				else 
					echo get_level_name($row['mb_level']); 
				?></div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 px-3 pt-1 pb-1 text-md-left">
                    <?php 
					echo na_name_photo_only($row['mb_id'], $row['name']); ?>
                </div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 px-3 pt-1 pb-1 text-md-left"><?php echo $row['mb_nick']; ?></div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center"><?php echo $row['mb_point']; ?></div>
                <!-- <div class="d-md-table-cell nw-6 pr-md-1 text-md-center"><?php echo $row['mb_point2']; ?></div> -->
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center"><?php echo $row['mb_datetime']; ?></div>
                <div class="d-md-table-cell d-sm-table-cell nw-6 pr-md-1 text-md-center"><?php echo $row['mb_today_login']; ?></div>
            </li>
            <?php
			}
			if ($i == 0)
				echo '<li class="list-group-item border-left-0 border-right-0 f-de font-weight-normal py-5 text-muted text-center">자료가 없습니다.</li>';
			?>
        </ul>
    </section>
</div>