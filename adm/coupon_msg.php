<?php
error_reporting(E_ALL); 
ini_set('display_errors','On');

$sub_menu = "700300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r'); 

//$g5['table_prefix']        = "g5_"; // 테이블명 접두사
//$g5['coupon_msg_table'] = $g5['table_prefix'] . "coupon_msg";    // coupon msg 테이블
/* $msg_created_datetime = G5_TIME_YMDHIS;
$msg_customer_text = $_POST['msg_customer_text'];
$msg_entity_text = $_POST['msg_entity_text'];

$res = "SELECT * FROM $g5[coupon_msg_table]";
$res1 = sql_query($res);
$row = sql_fetch($res1); 

  check_admin_token(); 

  $sql = "INSERT INTO  '{$g5['coupon_msg_table']}' 
            SET msg_customer_text ='{$msg_customer_text}',
                msg_entity_text ='{$msg_entity_text}',
                msg_created_datetime = '{$msg_created_datetime' ";
  sql_query($sql);
  goto_url($PHP_SELF, false); */

$g5['title'] .= '쿠폰쪽지 전송내용 입력 ';
include_once('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm" style="width:100px; margin-left: 235px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
</div>';
?>

<div><h3 style="text-align: center;font-size: 14px;">Change Coupon Message Text</h3></div>

<form name="fmsg_coupon" method="post" onsubmit="" enctype="multipart/form-data" autocomplete="off">
  <div class="form-group row" style="margin-top: 30px;">
    <label for="customerTextMsg" class="col-sm-2 col-form-label" style="font-size: 14px;">Customer text</label>
    <div class="col-sm-10">
      <input type="text" name="msg_customer_text" class="form-control" value="<?php echo $row['msg_customer_text']; ?>" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="customerTextMsg" class="col-sm-2 col-form-label" style="font-size: 14px;">Entity text</label>
    <div class="col-sm-10">
      <input type="text" name="msg_entity_text" class="form-control" value="<?php echo $row['msg_entity_text']; ?>" placeholder="">
    </div>
  </div>
  <div class="btn_confirm01 btn_confirm" style="width:100px; margin-left: 235px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
  </div>
  <!-- <input type="text" name="msg_customer_text" value="<?php echo $row['msg_customer_text'] ?>" placeholder="">
  <input type="text" name="msg_entity_text"  value="<?php echo $row['msg_entity_text'] ?>" placeholder="">
  <div class="btn_confirm01 btn_confirm" style="width:100px; margin-left: 235px;">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">    
  </div> -->
<!--   <?php echo $frm_submit;?> -->
</form>
<?php
include_once('./admin.tail.php'); 
?>