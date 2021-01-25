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

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
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
}

.flex-sm-column {
    -ms-flex-direction: column !important;
    flex-direction: column !important;
  }

.nav-link {
  display: block;
  padding: 0.5rem 1rem;
}

    .ui-datepicker {display: block;}
</style>

<script>
    $(document).ready(function(){
        $("#datepicker").datepicker({
          dateFormat: 'yy-mm-dd',
          onSelect: function(date, obj){
              $('#to_date').val(date);  
          }
        });        
    });
</script>

<div class="modal fade" id="entityextendModal" tabindex="-1" role="dialog" style="position: fixed; top: 30%; left: 50%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 350px; height: 600px;">
      <form id="fentityextend" name="fentityextend" action="" onsubmit="" method="post" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="w" value="u">
          <input type="hidden" name="mb_id" value="<?php echo $row['mb_id']; ?>">
        <div class="modal-header" style="border-bottom: none; height: 10px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> 
        </div> 
        <div class="modal-body" style="padding: 40px 0px;">
          <div>
            <span style="width:100px; margin-left: 30px;">업소명</span>
            <span style="margin-left: 30px;"><?php echo '['.$row['mb_name'].'] '.$row['mb_2']; ?></span>
          </div>
          <div style="margin-top: 5px;">
              <span style="width:100px; margin-left: 30px;">
                  제휴기간
              </span>
              <span style="margin-left: 20px;">
                  <input type="text" name="fr_date" value="<?php echo $start_date;?>" style="border: none; width: 80px;">~
                  <input type="text" name="mb_4" value="<?php echo $end_date; ?>" id="to_date" style="border: none; width: 80px; margin-left: 10px;">
              </span>
          </div>
          <p style="text-align: center; margin-top: 20px;">* 제휴종료일 변경</p> 
          <div id="datepicker" style="margin-top: 10px; margin-left: 60px;"></div>              
          <textarea type="text" rows="4" cols="50" name="mb_5" style="background: #FFFF00; margin-top: 10px;"><?php echo $mb_note; ?></textarea>             
        </div>
        <div class="modal-footer" style="border-top: none;">
          <div style="margin: 0 auto 20px auto;">
            <button type="submit" accesskey="s" class="btn btn_01" style="width: 150px;">확인</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>	

<?php
$str = "<ul class=\"nav flex-sm-column\">\n";

if($is_admin == "super" && $mb_id) {
    $str .= "<li class=\"nav-item\"><a href=\"".G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id."\" target=\"_blank\" class=\"nav-link\">회원정보변경</a></li>\n";
    $str .= "<li class=\"nav-item\"><a data-toggle=\"modal\" data-target=\"entityextendModal\" href=\"entityextendModal\" class=\"nav-link entity-modal\">제휴연장</a></li>\n"; 
    $str .= "<li class=\"nav-item\"><a href=\"".G5_ADMIN_URL."/coupon_list.php\" target=\"_blank\" class=\"nav-link\">쿠폰관리</a></li>\n"; 
    $str .= "<li class=\"nav-item\"><a href=\"".G5_BBS_URL."/memo_form.php?me_recv_mb_id=".$mb_id."\" target=\"_blank\" class=\"nav-link\">쪽지보내기</a></li>\n";
}
$str .= "</ul>\n";

echo $str;

?>