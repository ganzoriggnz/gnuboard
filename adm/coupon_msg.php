<?php
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "700300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r'); 

$res = "SELECT * FROM {$g5['coupon_msg_table']} ORDER BY msg_no DESC LIMIT 1";
$row = sql_fetch($res); 

$msg_created_datetime = G5_TIME_YMDHIS;
$msg_customer_text = $_POST['msg_customer_text'];
$msg_entity_text = $_POST['msg_entity_text'];

if($w == 'u'){

  $sql = "INSERT INTO {$g5['coupon_msg_table']}
            SET msg_customer_text = '{$msg_customer_text}',
                msg_entity_text = '{$msg_entity_text}',
                msg_created_datetime = '{$msg_created_datetime}'";
  sql_query($sql);
  goto_url($PHP_SELF, false); 

}
  
$g5['title'] = '쿠폰쪽지 전송내용 입력';
include_once('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:150px; margin-left: 232px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';
?>

<form name="fmsg_coupon" method="post" onsubmit="" enctype="multipart/form-data" autocomplete="off">
  <input type="hidden" name="w" value="u">
  <div class="form-group row" style="margin-top: 30px;">
    <label for="customerTextMsg" class="col-sm-2 col-form-label" style="font-size: 14px;">이용자쪽 쿠폰도착 쪽지 내용입력</label>
    <div class="col-sm-10">
      <input type="text" name="msg_customer_text" class="form-control" value="<?php echo $row['msg_customer_text']; ?>" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="customerTextMsg" class="col-sm-2 col-form-label" style="font-size: 14px;">업소실장쪽 자동 쪽지 내용입력</label>
    <div class="col-sm-10">
      <input type="text" name="msg_entity_text" class="form-control" value="<?php echo $row['msg_entity_text']; ?>" placeholder="">
    </div>
  </div>
<?php echo $frm_submit;?>
</form>
<?php
include_once('./admin.tail.php'); 
?>
