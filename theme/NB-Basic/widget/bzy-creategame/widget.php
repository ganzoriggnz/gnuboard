<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once('./_common.php');
global $config, $member, $is_member, $urlencode, $is_admin;
$resultz = [];
if(isset($_GET['playgame'])) {
    $link = $g5['connect_db'];
    $error=G5_DISPLAY_SQL_ERROR;
    $qry = sql_query(" insert into `g5_game_history` set point='{$member['mb_point']}', games= '0', startpoint= '{$member['mb_point']}'");
    $result = sql_query("SELECT ID AS LastID FROM `g5_game_history` WHERE ID = @@Identity;");
    $resultz = $result->fetch_assoc();

} else {
    $test = '';
}


?>

<div class="nt-container py-4 px-3 px-sm-4 px-xl-0" style="display: flex;justify-content: flex-end;">
	<button onclick="myFunction()"> play game </button>

</div>

<script>
function myFunction() {
  var data = {point: `<?php echo $member['mb_point']; ?>`, game_id: `<?php echo $resultz['LastID']; ?>`, games:0};
  console.log(data);
}
</script>