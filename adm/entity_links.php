<?php

$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if(isset($_POST['mb_id'])){
    $mb_id = $_POST['mb_id'];
 }

global $config;
global $g5;
global $bo_table, $sca, $is_admin, $member;

$sql = "SELECT  mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_3, mb_4, mb_5 FROM {$g5['member_table']} WHERE mb_id = '{$mb_id}'";
$row = sql_fetch($sql);

$name = $row['mb_name'];
$nb_nick = $row['mb_nick'];
$mb_email = $row['mb_email'];
$mb_homepage = $row['mb_homepage'];

$email = get_string_encrypt($email);
$homepage = set_http(clean_xss_tags($homepage));

$name     = get_text($name, 0, true);
$email    = get_text($email);
$homepage = get_text($homepage);

$tmp_name = "";
$en_mb_id = $mb_id;

$start_date = substr($row['mb_3'], 0, 10);
$end_date = substr($row['mb_4'], 0, 10);
$mb_note = $row['mb_5'];

?>

<style>
.nav {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
  padding-top: 20px;
}

.flex-sm-column {
    -ms-flex-direction: column !important;
    flex-direction: column !important;
  }

.nav-link {
  display: block;
  padding: 0.5rem 1rem;
  width: 150px;
  margin: 10px 30px 5px 35px;
  text-align: center;
}

.active {
     color: red;
 }

.ui-datepicker {
	width: 27em;
  height: 23em;
	padding: .2em .2em 0;
	display: block;
}
.ui-datepicker .ui-datepicker-header {
	position: relative;
	padding: .4em 0;
}
.ui-datepicker .ui-datepicker-prev,
.ui-datepicker .ui-datepicker-next {
	position: absolute;
	top: 2px;
	width: 1.8em;
	height: 1.8em;
}
.ui-datepicker .ui-datepicker-prev-hover,
.ui-datepicker .ui-datepicker-next-hover {
	top: 1px;
}
.ui-datepicker .ui-datepicker-prev {
	left: 2px;
}
.ui-datepicker .ui-datepicker-next {
	right: 2px;
}
.ui-datepicker .ui-datepicker-prev-hover {
	left: 1px;
}
.ui-datepicker .ui-datepicker-next-hover {
	right: 1px;
}
.ui-datepicker .ui-datepicker-prev span,
.ui-datepicker .ui-datepicker-next span {
	display: block;
	position: absolute;
	left: 50%;
	margin-left: -8px;
	top: 50%;
	margin-top: -8px;
}
.ui-datepicker .ui-datepicker-title {
	margin: 0 2.3em;
	line-height: 1.8em;
	text-align: center;
}
.ui-datepicker .ui-datepicker-title select {
	font-size: 1em;
	margin: 1px 0;
}
.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year {
	width: 45%;
}
.ui-datepicker table {
	width: 29em;
	font-size: .9em;
	border-collapse: collapse;
	margin: 0 0 .4em;
}
.ui-datepicker th {
	padding: 1.2em .6em;
	text-align: center;
	font-weight: bold;
	border: 0;
}
.ui-datepicker td {
	border: 0;
	padding: 1px;
}
.ui-datepicker td span,
.ui-datepicker td a {
	display: block;
	padding: .4em;
	text-align: right;
	text-decoration: none;
}
.ui-datepicker .ui-datepicker-buttonpane {
	background-image: none;
	margin: .7em 0 0 0;
	padding: 0 .2em;
	border-left: 0;
	border-right: 0;
	border-bottom: 0;
}
.ui-datepicker .ui-datepicker-buttonpane button {
	float: right;
	margin: .5em .2em .4em;
	cursor: pointer;
	padding: .2em .6em .3em .6em;
	width: auto;
	overflow: visible;
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
	float: left;
}
</style>

<div class="modal fade" id="entityextendModal" tabindex="-1" role="dialog" style="position: fixed; top: 20%; left: 15%;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 420px; height: 650px;">
      <form id="fentityextend" name="fentityextend" action="" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="w" value="u">
          <input type="hidden" name="mb_id" value="<?php echo $row['mb_id']; ?>">
        <div class="modal-header" style="border-bottom: none; height: 40px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> 
        </div> 
        <div class="modal-body" style="padding: 20px 0px 0px 0px;">
          <div style="padding: 30px auto 10px auto;">
            <span style="width:100px; margin-left: 60px;">?????????</span>
            <span style="margin-left: 30px;"><?php echo '['.$row['mb_name'].'] '.$row['mb_2']; ?></span>
          </div>
          <div style="padding: 10px auto 10px auto; margin-top: 10px;">
              <span style="width:100px; margin-left: 60px;">
                  ????????????
              </span>
              <span style="margin-left: 20px;">
                  <input type="text" name="fr_date" value="<?php echo $start_date;?>" style="border: none; width: 80px;">~
                  <input type="text" name="mb_4" value="<?php echo $end_date; ?>" id="to_date" style="border: none; width: 80px; margin-left: 10px;">
              </span>
          </div>
          <p style="text-align: center; margin-top: 20px;">* ??????????????? ??????</p> 
          <div id="datepicker" style="margin-top: 20px; margin-left: 30px;"></div>              
          <textarea type="text" rows="5" name="mb_5" style="background: #fcf8e3;; margin-top: 25px; margin-left:30px; width: 360px;"><?php echo $mb_note; ?></textarea>             
        </div>
        <div class="modal-footer" style="border-top: none; padding-top: none;">
          <div style="margin: 5px auto 0px auto;">
            <button type="submit" accesskey="s" class="btn btn_01" style="width: 100px;">??????</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>	

<?php
$str = "<ul class=\"nav flex-sm-column\">\n";

if($is_admin == "super" && $mb_id) {
    $str .= "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link btn btn_02\" style=\"margin-bottom: 50px;\">".$name."</a></li>\n";
    $str .= "<li class=\"nav-item\"><a href=\"".G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id."\" onclick=\"win_profile(this.href); return false;\" class=\"nav-link btn btn_02\">??????????????????</a></li>\n";
    $str .= "<li class=\"nav-item\"><a data-toggle=\"modal\" data-target=\"entityextendModal\" href=\"entityextendModal\" class=\"nav-link entity-modal btn btn-block btn_02\">????????????</a></li>\n"; 
    $str .= "<li class=\"nav-item\"><a href=\"".G5_ADMIN_URL."/coupon_list.php\" onclick=\"win_profile(this.href); return false;\" class=\"nav-link btn btn_02\">????????????</a></li>\n"; 
    $str .= "<li class=\"nav-item\"><a href=\"".G5_BBS_URL."/memo_form.php?me_recv_mb_id=".$mb_id."\" onclick=\"win_profile(this.href); return false;\" class=\"nav-link btn btn_02\">???????????????</a></li>\n";
}
$str .= "</ul>\n";

echo $str;

?>