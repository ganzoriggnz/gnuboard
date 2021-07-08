<?php if($_SERVER['HTTP_HOST'] === "dkswjs-tjdrhd.com"|| $_SERVER['HTTP_HOST'] === "210.114.22.148" || $_SERVER['HTTP_HOST'] === "localhost" || $_SERVER['HTTP_HOST'] === "localhost:8080"){ ?>
<?php

$sub_menu = '100000';
include_once('./_common.php');

@include_once('./safe_check.php');
if(function_exists('social_log_file_delete')){
    social_log_file_delete(86400);      //소셜로그인 디버그 파일 24시간 지난것은 삭제
}

$g5['title'] = '관리자메인';
include_once ('./admin.head.php');

$new_member_rows = 5;
$new_point_rows = 5;
$new_write_rows = 5;

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

// last 245 hours member count
$between = " between curdate() AND date_add(curdate(), interval 1 day)";
$sqld = " select count(*) as cnt, CURDATE() as cur_date FROM {$sql_common} {$sql_search} and mb_datetime {$between};";
$rowd = sql_query($sqld);
var_dump($rowd);
$last24_count = $rowd['cnt'];
$current_date = $rowd['cur_date'];

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$new_member_rows} ";
$result = sql_query($sql);



$colspan = 12;
?>

<section>
    <h2> 신규가입회원 <?php var_dump($rowd); ?> 명(<?php echo $current_date; ?>) </h2>
    <div class="local_desc02 local_desc">
        총회원수 <?php echo number_format($total_count) ?>명 중 차단 <?php echo number_format($intercept_count) ?>명, 탈퇴 : <?php echo number_format($leave_count) ?>명
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>신규가입회원</caption>
        <thead>
        <tr>
            <th scope="col">회원아이디</th>
            <th scope="col">이름</th>
            <th scope="col">닉네임</th>
            <th scope="col">권한</th>
            <th scope="col">포인트</th>
            <th scope="col">수신</th>
            <th scope="col">공개</th>
            <th scope="col">인증</th>
            <th scope="col">차단</th>
            <th scope="col">그룹</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 접근가능한 그룹수
            $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
            $row2 = sql_fetch($sql2);
            $group = "";
            if ($row2['cnt'])
                $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

            if ($is_admin == 'group')
            {
                $s_mod = '';
                $s_del = '';
            }
            else
            {
                $s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">수정</a>';
                $s_del = '<a href="./member_delete.php?'.$qstr.'&amp;w=d&amp;mb_id='.$row['mb_id'].'&amp;url='.$_SERVER['SCRIPT_NAME'].'" onclick="return delete_confirm(this);">삭제</a>';
            }
            $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

            $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date("Ymd", G5_SERVER_TIME);
            $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date("Ymd", G5_SERVER_TIME);

            $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

            $mb_id = $row['mb_id'];
            if ($row['mb_leave_date'])
                $mb_id = $mb_id;
            else if ($row['mb_intercept_date'])
                $mb_id = $mb_id;

        ?>
        <tr>
            <td class="td_mbid"><?php echo $mb_id ?></td>
            <td class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
            <td class="td_mbname sv_use"><div><?php echo $mb_nick ?></div></td>
            <td class="td_num"><?php echo $row['mb_level'] ?></td>
            <td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
            <td class="td_boolean"><?php echo $row['mb_mailling']?'예':'아니오'; ?></td>
            <td class="td_boolean"><?php echo $row['mb_open']?'예':'아니오'; ?></td>
            <td class="td_boolean"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'예':'아니오'; ?></td>
            <td class="td_boolean"><?php echo $row['mb_intercept_date']?'예':'아니오'; ?></td>
            <td class="td_category"><?php echo $group ?></td>
        </tr>
        <?php
            }
        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        </table>
    </div>

    <div class="btn_list03 btn_list">
        <a href="./member_list.php">회원 전체보기</a>
    </div>

</section>

<?php
$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id ";

if ($gr_id)
    $sql_common .= " and b.gr_id = '$gr_id' ";
if ($view) {
    if ($view == 'w')
        $sql_common .= " and a.wr_id = a.wr_parent ";
    else if ($view == 'c')
        $sql_common .= " and a.wr_id <> a.wr_parent ";
}
$sql_order = " order by a.bn_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$colspan = 5;
?>

<section>
    <h2>최근게시물</h2>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>최근게시물</caption>
        <thead>
        <tr>
            <th scope="col">그룹</th>
            <th scope="col">게시판</th>
            <th scope="col">제목</th>
            <th scope="col">이름</th>
            <th scope="col">일시</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit {$new_write_rows} ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];

            if ($row['wr_id'] == $row['wr_parent']) // 원글
            {
                $comment = "";
                $comment_link = "";
                $row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '{$row['wr_id']}' ");

                $name = get_sideview($row2['mb_id'], get_text(cut_str($row2['wr_name'], $config['cf_cut_name'])), $row2['wr_email'], $row2['wr_homepage']);
                // 당일인 경우 시간으로 표시함
                $datetime = substr($row2['wr_datetime'],0,10);
                $datetime2 = $row2['wr_datetime'];
                if ($datetime == G5_TIME_YMD)
                    $datetime2 = substr($datetime2,11,5);
                else
                    $datetime2 = substr($datetime2,5,5);

            }
            else // 코멘트
            {
                $comment = '댓글. ';
                $comment_link = '#c_'.$row['wr_id'];
                $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
                $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");

                $name = get_sideview($row3['mb_id'], get_text(cut_str($row3['wr_name'], $config['cf_cut_name'])), $row3['wr_email'], $row3['wr_homepage']);
                // 당일인 경우 시간으로 표시함
                $datetime = substr($row3['wr_datetime'],0,10);
                $datetime2 = $row3['wr_datetime'];
                if ($datetime == G5_TIME_YMD)
                    $datetime2 = substr($datetime2,11,5);
                else
                    $datetime2 = substr($datetime2,5,5);
            }
        ?>

        <tr>
            <td class="td_category"><a href="<?php echo G5_BBS_URL ?>/new.php?gr_id=<?php echo $row['gr_id'] ?>"><?php echo cut_str($row['gr_subject'],10) ?></a></td>
            <td class="td_category"><a href="<?php echo get_pretty_url($row['bo_table']) ?>"><?php echo cut_str($row['bo_subject'],20) ?></a></td>
            <td><a href="<?php echo get_pretty_url($row['bo_table'], $row2['wr_id']); ?><?php echo $comment_link ?>"><?php echo $comment ?><?php echo conv_subject($row2['wr_subject'], 100) ?></a></td>
            <td class="td_mbname"><div><?php echo $name ?></div></td>
            <td class="td_datetime"><?php echo $datetime ?></td>
        </tr>

        <?php
        }
        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        </table>
    </div>

    <div class="btn_list03 btn_list">
        <a href="<?php echo G5_BBS_URL ?>/new.php">최근게시물 더보기</a>
    </div>
</section>

<?php
$sql_common = " from {$g5['point_table']} ";
$sql_search = " where (1) ";
$sql_order = " order by po_id desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$new_point_rows} ";
$result = sql_query($sql);

$colspan = 7;
?>

<section>
    <h2>최근 포인트 발생내역</h2>
    <div class="local_desc02 local_desc">
        전체 <?php echo number_format($total_count) ?> 건 중 <?php echo $new_point_rows ?>건 목록
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>최근 포인트 발생내역</caption>
        <thead>
        <tr>
            <th scope="col">회원아이디</th>
            <th scope="col">이름</th>
            <th scope="col">닉네임</th>
            <th scope="col">일시</th>
            <th scope="col">포인트 내용</th>
            <th scope="col">포인트</th>
            <th scope="col">포인트합</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $row2['mb_id'] = '';
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            if ($row2['mb_id'] != $row['mb_id'])
            {
                $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
                $row2 = sql_fetch($sql2);
            }

            $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

            $link1 = $link2 = "";
            if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table'])
            {
                $link1 = '<a href="'.get_pretty_url($row['po_rel_table'], $row['po_rel_id']).'" target="_blank">';
                $link2 = '</a>';
            }
        ?>

        <tr>
            <td class="td_mbid"><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo $row['mb_id'] ?></a></td>
            <td class="td_mbname"><?php echo get_text($row2['mb_name']); ?></td>
            <td class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
            <td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
            <td><?php echo $link1.$row['po_content'].$link2 ?></td>
            <td class="td_numbig"><?php echo number_format($row['po_point']) ?></td>
            <td class="td_numbig"><?php echo number_format($row['po_mb_point']) ?></td>
        </tr>

        <?php
        }

        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        </table>
    </div>

    <div class="btn_list03 btn_list">
        <a href="./point_list.php">포인트내역 전체보기</a>
    </div>
</section>

<?php
include_once ('./admin.tail.php');
?>
<?php } else {?>
<html>
<head>
<meta charset="UTF-8">
<style>

@import url('https://fonts.googleapis.com/css?family=Nunito+Sans');
:root {
  --blue: #0e0620;
  --white: #fff;
  --green: #2ccf6d;
}
html,
body {
  height: 100%;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  font-family:"Nunito Sans";
  color: var(--blue);
  font-size: 1em;
}
button {
  font-family:"Nunito Sans";
}
ul {
  list-style-type: none;
  padding-inline-start: 35px;
}
svg {
  width: 100%;
  visibility: hidden;
}
h1 {
  font-size: 7.5em;
  margin: 15px 0px;
  font-weight:bold;
}
h2 {
  font-weight:bold;
}
@media screen and (max-width:768px) {
  body {
    display:block;
  }
  .container {
    margin-top:70px;
    margin-bottom:70px;
  }
} 
</style>
  <title>404 Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
</head>
<body>
<main>

  <div class="container">
    <div class="row">
      <div class="col-md-5 align-self-center">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 0 800 600">
          <g>
            <defs>
              <clipPath id="GlassClip">
                <path
                  d="M380.857,346.164c-1.247,4.651-4.668,8.421-9.196,10.06c-9.332,3.377-26.2,7.817-42.301,3.5
                s-28.485-16.599-34.877-24.192c-3.101-3.684-4.177-8.66-2.93-13.311l7.453-27.798c0.756-2.82,3.181-4.868,6.088-5.13
                c6.755-0.61,20.546-0.608,41.785,5.087s33.181,12.591,38.725,16.498c2.387,1.682,3.461,4.668,2.705,7.488L380.857,346.164z" />
              </clipPath>
              <clipPath id="cordClip">
                <rect width="800" height="600" />
              </clipPath>
            </defs>

            <g id="planet">
              <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-miterlimit="10" cx="572.859" cy="108.803"
                r="90.788" />

              <circle id="craterBig" fill="none" stroke="#0E0620" stroke-width="3" stroke-miterlimit="10" cx="548.891"
                cy="62.319" r="13.074" />

              <circle id="craterSmall" fill="none" stroke="#0E0620" stroke-width="3" stroke-miterlimit="10" cx="591.743"
                cy="158.918" r="7.989" />
              <path id="ring" fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round"
                stroke-miterlimit="10" d="
			M476.562,101.461c-30.404,2.164-49.691,4.221-49.691,8.007c0,6.853,63.166,12.408,141.085,12.408s141.085-5.555,141.085-12.408
			c0-3.378-15.347-4.988-40.243-7.225" />

              <path id="ringShadow" opacity="0.5" fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round"
                stroke-miterlimit="10" d="
			M483.985,127.43c23.462,1.531,52.515,2.436,83.972,2.436c36.069,0,68.978-1.19,93.922-3.149" />
            </g>
            <g id="stars">
              <g id="starsBig">
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="518.07" y1="245.375" x2="518.07" y2="266.581" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="508.129" y1="255.978" x2="528.01" y2="255.978" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="154.55" y1="231.391" x2="154.55" y2="252.598" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="144.609" y1="241.995" x2="164.49" y2="241.995" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="320.135" y1="132.746" x2="320.135" y2="153.952" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="310.194" y1="143.349" x2="330.075" y2="143.349" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="200.67" y1="483.11" x2="200.67" y2="504.316" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="210.611" y1="493.713" x2="190.73" y2="493.713" />
                </g>
              </g>
              <g id="starsSmall">
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="432.173" y1="380.52" x2="432.173" y2="391.83" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="426.871" y1="386.175" x2="437.474" y2="386.175" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="489.555" y1="299.765" x2="489.555" y2="308.124" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="485.636" y1="303.945" x2="493.473" y2="303.945" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="231.468" y1="291.009" x2="231.468" y2="299.369" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="227.55" y1="295.189" x2="235.387" y2="295.189" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="244.032" y1="547.539" x2="244.032" y2="555.898" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="247.95" y1="551.719" x2="240.113" y2="551.719" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="186.359" y1="406.967" x2="186.359" y2="415.326" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="190.277" y1="411.146" x2="182.44" y2="411.146" />
                </g>
                <g>

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="480.296" y1="406.967" x2="480.296" y2="415.326" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                    x1="484.215" y1="411.146" x2="476.378" y2="411.146" />
                </g>
              </g>
              <g id="circlesBig">

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="588.977" cy="255.978" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="450.066" cy="320.259" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="168.303" cy="353.753" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="429.522" cy="201.185" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="200.67" cy="176.313" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="133.343" cy="477.014" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="283.521" cy="568.033" r="7.952" />

                <circle fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10"
                  cx="413.618" cy="482.387" r="7.952" />
              </g>
              <g id="circlesSmall">
                <circle fill="#0E0620" cx="549.879" cy="296.402" r="2.651" />
                <circle fill="#0E0620" cx="253.29" cy="229.24" r="2.651" />
                <circle fill="#0E0620" cx="434.824" cy="263.931" r="2.651" />
                <circle fill="#0E0620" cx="183.708" cy="544.176" r="2.651" />
                <circle fill="#0E0620" cx="382.515" cy="530.923" r="2.651" />
                <circle fill="#0E0620" cx="130.693" cy="305.608" r="2.651" />
                <circle fill="#0E0620" cx="480.296" cy="477.014" r="2.651" />
              </g>
            </g>
            <g id="spaceman" clip-path="url(cordClip)">
              <path id="cord" fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" stroke-miterlimit="10"
                d="
			M273.813,410.969c0,0-54.527,39.501-115.34,38.218c-2.28-0.048-4.926-0.241-7.841-0.548
			c-68.038-7.178-134.288-43.963-167.33-103.87c-0.908-1.646-1.793-3.3-2.654-4.964c-18.395-35.511-37.259-83.385-32.075-118.817" />

              <path id="backpack" fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" stroke-miterlimit="10" d="
			M338.164,454.689l-64.726-17.353c-11.086-2.972-17.664-14.369-14.692-25.455l15.694-58.537
			c3.889-14.504,18.799-23.11,33.303-19.221l52.349,14.035c14.504,3.889,23.11,18.799,19.221,33.303l-15.694,58.537
			C360.647,451.083,349.251,457.661,338.164,454.689z" />
              <g id="antenna">
                <line fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" x1="323.396" y1="236.625" x2="295.285" y2="353.753" />
                <circle fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" cx="323.666" cy="235.617" r="6.375" />
              </g>
              <g id="armR">

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M360.633,363.039c1.352,1.061,4.91,5.056,5.824,6.634l27.874,47.634c3.855,6.649,1.59,15.164-5.059,19.02l0,0
				c-6.649,3.855-15.164,1.59-19.02-5.059l-5.603-9.663" />

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M388.762,434.677c5.234-3.039,7.731-8.966,6.678-14.594c2.344,1.343,4.383,3.289,5.837,5.793
				c4.411,7.596,1.829,17.33-5.767,21.741c-7.596,4.411-17.33,1.829-21.741-5.767c-1.754-3.021-2.817-5.818-2.484-9.046
				C375.625,437.355,383.087,437.973,388.762,434.677z" />
              </g>
              <g id="armL">

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M301.301,347.66c-1.702,0.242-5.91,1.627-7.492,2.536l-47.965,27.301c-6.664,3.829-8.963,12.335-5.134,18.999h0
				c3.829,6.664,12.335,8.963,18.999,5.134l9.685-5.564" />

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M241.978,395.324c-3.012-5.25-2.209-11.631,1.518-15.977c-2.701-0.009-5.44,0.656-7.952,2.096
				c-7.619,4.371-10.253,14.09-5.883,21.71c4.371,7.619,14.09,10.253,21.709,5.883c3.03-1.738,5.35-3.628,6.676-6.59
				C252.013,404.214,245.243,401.017,241.978,395.324z" />
              </g>
              <g id="body">

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M353.351,365.387c-7.948,1.263-16.249,0.929-24.48-1.278c-8.232-2.207-15.586-6.07-21.836-11.14
				c-17.004,4.207-31.269,17.289-36.128,35.411l-1.374,5.123c-7.112,26.525,8.617,53.791,35.13,60.899l0,0
				c26.513,7.108,53.771-8.632,60.883-35.158l1.374-5.123C371.778,395.999,365.971,377.536,353.351,365.387z" />
                <path fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M269.678,394.912L269.678,394.912c26.3,20.643,59.654,29.585,93.106,25.724l2.419-0.114" />
              </g>
              <g id="legs">
                <g id="legR">

                  <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-miterlimit="10" d="
					M312.957,456.734l-14.315,53.395c-1.896,7.07,2.299,14.338,9.37,16.234l0,0c7.07,1.896,14.338-2.299,16.234-9.37l17.838-66.534
					C333.451,455.886,323.526,457.387,312.957,456.734z" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-miterlimit="10" x1="304.883" y1="486.849" x2="330.487" y2="493.713" />
                </g>
                <g id="legL">

                  <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-miterlimit="10" d="
					M296.315,452.273L282,505.667c-1.896,7.07-9.164,11.265-16.234,9.37l0,0c-7.07-1.896-11.265-9.164-9.37-16.234l17.838-66.534
					C278.993,441.286,286.836,447.55,296.315,452.273z" />

                  <line fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-miterlimit="10" x1="262.638" y1="475.522" x2="288.241" y2="482.387" />
                </g>
              </g>
              <g id="head">

                <ellipse transform="matrix(0.259 -0.9659 0.9659 0.259 -51.5445 563.2371)" fill="#FFFFFF"
                  stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" cx="341.295" cy="315.211" rx="61.961" ry="60.305" />
                <path id="headStripe" fill="none" stroke="#0E0620" stroke-width="3" stroke-linecap="round"
                  stroke-linejoin="round" stroke-miterlimit="10" d="
				M330.868,261.338c-7.929,1.72-15.381,5.246-21.799,10.246" />

                <path fill="#FFFFFF" stroke="#0E0620" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  stroke-miterlimit="10" d="
				M380.857,346.164c-1.247,4.651-4.668,8.421-9.196,10.06c-9.332,3.377-26.2,7.817-42.301,3.5s-28.485-16.599-34.877-24.192
				c-3.101-3.684-4.177-8.66-2.93-13.311l7.453-27.798c0.756-2.82,3.181-4.868,6.088-5.13c6.755-0.61,20.546-0.608,41.785,5.087
				s33.181,12.591,38.725,16.498c2.387,1.682,3.461,4.668,2.705,7.488L380.857,346.164z" />
                <g clip-path="url(#GlassClip)">
                  <polygon id="glassShine" fill="none" stroke="#0E0620" stroke-width="3" stroke-miterlimit="10" points="
					278.436,375.599 383.003,264.076 364.393,251.618 264.807,364.928 				" />
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <div class="col-md-7 align-self-center">
        <h1>404</h1>
        <h2>페이지를 찾을 수 없습니다.</h2>
        <p>UH OH! You're lost
          BzY*FuZy
        </p>
      </div>
    </div>
  </div>
</main>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js'></script>
<script id="rendered-js" >
gsap.set("svg", { visibility: "visible" });
gsap.to("#headStripe", {
  y: 0.5,
  rotation: 1,
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut",
  duration: 1 });

gsap.to("#spaceman", {
  y: 0.5,
  rotation: 1,
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut",
  duration: 1 });

gsap.to("#craterSmall", {
  x: -3,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut" });

gsap.to("#craterBig", {
  x: 3,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut" });

gsap.to("#planet", {
  rotation: -2,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut",
  transformOrigin: "50% 50%" });


gsap.to("#starsBig g", {
  rotation: "random(-30,30)",
  transformOrigin: "50% 50%",
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut" });

gsap.fromTo(
"#starsSmall g",
{ scale: 0, transformOrigin: "50% 50%" },
{ scale: 1, transformOrigin: "50% 50%", yoyo: true, repeat: -1, stagger: 0.1 });

gsap.to("#circlesSmall circle", {
  y: -4,
  yoyo: true,
  duration: 1,
  ease: "sine.inOut",
  repeat: -1 });

gsap.to("#circlesBig circle", {
  y: -2,
  yoyo: true,
  duration: 1,
  ease: "sine.inOut",
  repeat: -1 });


gsap.set("#glassShine", { x: -68 });

gsap.to("#glassShine", {
  x: 80,
  duration: 2,
  rotation: -30,
  ease: "expo.inOut",
  transformOrigin: "50% 50%",
  repeat: -1,
  repeatDelay: 8,
  delay: 2 });
    </script>
</body>
</html>
<?php }?>


