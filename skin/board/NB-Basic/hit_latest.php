<?php
if (!defined('_GNUBOARD_')) exit;

function latest_popular($bo_table, $rows=10, $subject_len=40, $term='', $options='')
{
  global $g5, $latest_skin_url;

  switch($term) {
    case '일간': $term_time = date("Y-m-d H:i:s", G5_SERVER_TIME-3600*24); break;
    case '주간': $term_time = date("Y-m-d H:i:s", G5_SERVER_TIME-3600*24*7); break;
    case '월간': $term_time = date("Y-m-d H:i:s", G5_SERVER_TIME-3600*24*30); break;
  }

  $list = array();

  if($bo_table) {	//각 게시판 출력
    $sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
    $board = sql_fetch($sql);
    $bo_subject = get_text($board['bo_subject']);

    $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    $sql_between = " wr_datetime between '$term_time' and '".G5_TIME_YMDHIS."' ";
    $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 and {$sql_between} order by {$options} limit 0, {$rows} ";
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++) {
      $list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);
    }
  }
  else {//전체 게시판 출력
    $sql_between = " a.bn_datetime between '$term_time' and '".G5_TIME_YMDHIS."' ";
    $sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b where a.bo_table = b.bo_table and b.bo_use_search = 1 and a.wr_id = a.wr_parent and {$sql_between} ";
    $sql_order = " order by a.bn_datetime desc ";
    $sql = " select a.*, count(b.bo_subject) as cnt {$sql_common} {$sql_order} limit 0, {$rows} ";
    $row = sql_fetch($sql);

    if($row["cnt"] > 0) {
      $sql = " select a.*, b.bo_subject {$sql_common} {$sql_order} limit 0, {$rows} ";
      $result = sql_query($sql);

      for ($i=0; $row = sql_fetch_array($result); $i++) {
        $tmp_write_table = $g5['write_prefix'].$row['bo_table'];
        $bo_table = $row['bo_table'];
        $wr_id = $row['wr_id'];

        if($i > 0)
          $sql2 .= " union ";
          $sql2 .= "(select '{$bo_table}' as bo_table, wr_id, wr_subject, wr_hit, wr_good from {$tmp_write_table} where wr_id = {$wr_id} and wr_datetime between '{$term_time}' and '".G5_TIME_YMDHIS."') ";
      }
      $sql2 .= " order by ".$options." limit 0, 10";
      $result2 = sql_query($sql2);

      for ($i=0; $row2 = sql_fetch_array($result2); $i++) {
        $list[$i]['href'] = G5_URL.'/'.$row2['bo_table'].'/'.$row2['wr_id'];
        $list[$i]['subject'] = $row2['wr_subject'];
      }
    }
  }

  ?>
  <?php ob_start(); ?>
  <div class="lt2">
    <ul>
      <?php for ($i=0; $i<count($list); $i++) {  ?>
      <li>
      <?php
      echo "<a href=\"".$list[$i]['href']."\">";
      echo "<div class=\"num float-left\">".($i+1)."</div> ";
      echo $list[$i]['subject'];
      ?>
      <!-- //  ner oruulj ireh -->
      <div class="float-right"> ★ 익명</div>
      <?php echo "</a>"; ?>
      
        </li>
        <?php
      if (($i+1)%($rows/2)==0) echo "</ul></div><div class='lt2'><ul>";
      }
      ?>
    </ul>
  </div>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
?>

<style>
  ul.rumitab {
      margin:0;
      padding:0;
      list-style:none;
      height:40px;
      background:#fafafa;
      border:1px solid #e5e5e5;
      border-top:none;
      width:100%;
      font-size:1.0em;
  }
  ul.rumitab li {
      float:left;
      display:inline-block;
      padding:0 10px;
      text-align:center;
      cursor:pointer;
      height:38px;
      left:-1px;
      line-height:38px;
      border:1px solid #ddd;
      border-left:none;
      border-bottom:none;
      overflow:hidden;
      position: relative;
  }
  ul.rumitab li:hover {
      color:red;
  }
  ul.rumitab li.active {
      background:#FFFFFF;
      color:#333333;
      border-top:3px solid #aaa;
      line-height:40px;
      height:40px;
      border-bottom:1px solid #fff;
  }
  ul.rumitab li.active a {
      color:#333333;
      pointer-events:none;
  }
  .rumitab_container {
      display:inline-block;
      padding:10px 14px;
      width:100%;
  }
  .rumitab_content {
      padding:0;
      display:none;
  }
  .rumitab_box {
      width:100%;
      border:1px solid #ddd;
      overflow:hidden;
  }
  .lt2 {
      float:left;
      width:49%;
      overflow:hidden;
  }
  .lt2 ul {
      margin:0 0 0 0;
      padding:0;
      list-style:none;
  }
  .lt2 li {
      padding:5px 0;
      white-space:nowrap;
      font-size:1.0em
  }
  .num {
      background:#f7f7f7;
      color:#555;
      border-radius:3px;
      padding:0;
      width:20px;
      text-align:center;
      margin:0;
      display:inline-block;
  }
</style>

<script src="<?php echo G5_JS_URL; ?>/jquery.rumiTab.js"></script>
<?php
  $intime = date("Y-m-d H:i:s", time() - (int)(60 * 60 * 24));
  $sql = " select count(*) as today_count from {$g5['write_prefix']}{$bo_table} where wr_datetime >= '$intime' and wr_is_comment=0" ;
  $data = sql_fetch($sql);
  $hits = $data['today_count'];
?>
<div id="TAB_A" class="rumitab_box">
    <ul class="rumitab">
      <?php  if("1" <= $hits){ ?>
        <li rel="A_tab1">일간 조회수 베스트 10</li>
        <li rel="A_tab2">일간 추천수 베스트 10</li>
      <?php } ?>
        <li rel="A_tab3">주간 조회수 베스트 10</li>
        <li rel="A_tab4">주간 추천수 베스트 10</li>
        <li rel="A_tab5">월간 조회수 베스트 10</li>
        <li rel="A_tab6">월간 추천수 베스트 10</li>
    </ul>
  <div class="rumitab_container">
    <?php  if("1" <= $hits){ ?>
      <div id="A_tab1" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '일간', 'wr_hit desc'); ?>
      </div>
      
      <div id="A_tab2" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '일간', 'wr_good desc'); ?>
      </div>
      <?php } ?>
      <div id="A_tab3" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '주간', 'wr_hit desc'); ?>
      </div>
      <div id="A_tab4" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '주간', 'wr_good desc'); ?>
      </div>
      <div id="A_tab5" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '월간', 'wr_hit desc'); ?>
      </div>
      <div id="A_tab6" class="rumitab_content">
        <?php echo latest_popular($bo_table, 10, 40, '월간', 'wr_good desc'); ?>
      </div>
  </div>
</div>
<script>
  $(function () {
    $("#TAB_A").rumiTab({
      selectorCl : "ul.rumitab li",
      interValtime : 3000,
      auTo : false,
      starttabNo : 0,
      autoDirection : "random",
      mEvent : "click",
      tabAlign : "left",
      containerH : "auto"
    });
  });
</script>