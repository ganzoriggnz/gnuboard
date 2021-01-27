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
$msg_customer_title = $_POST['msg_customer_title'];
$msg_entity_title = $_POST['msg_entity_title'];

if($w == 'i'){

  $sql = "INSERT INTO {$g5['coupon_msg_table']}
            SET msg_customer_text = '{$msg_customer_text}',
                msg_entity_text = '{$msg_entity_text}',
                msg_customer_title = '{$msg_customer_title}',
                msg_entity_title = '{$msg_entity_title}',
                msg_created_datetime = '{$msg_created_datetime}'";
  sql_query($sql);
  goto_url($PHP_SELF, false); 

}
  
$g5['title'] = '쿠폰쪽지 전송내용 입력';
include_once('./admin.head.php');

?>

<form name="fmsg_coupon" method="post" onsubmit="" enctype="multipart/form-data" autocomplete="off">
  <input type="hidden" name="w" value="i">
  <section id="anc_cf_qa_config">

      <div class="tbl_frm01 tbl_wrap">
          <table>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
          <tbody>
            <tr>
                <th scope="row"><label for="msg_customer_title">이용자쪽 쪽지 제목<strong class="sound_only"></strong></label></th>
                <td>
                    <input type="text" name="msg_customer_title" id="msg_customer_title" value="<?php echo $row['msg_customer_title']; ?>" required class="required frm_input" size="200">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="msg_customer_text">이용자쪽 쿠폰도착 쪽지 내용<strong class="sound_only"></strong></label></th>
                <td>
                    <input type="text" name="msg_customer_text" id="msg_customer_text" value="<?php echo $row['msg_customer_text']; ?>" required class="required frm_input" size="200">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="msg_entity_title">업소실장쪽 쪽지 제목<strong class="sound_only"></strong></label></th>
                <td>
                    <input type="text" name="msg_entity_title" id="msg_entity_title" value="<?php echo $row['msg_entity_title']; ?>" required class="required frm_input" size="200">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="msg_entity_text">업소실장쪽 자동 쪽지 내용<strong class="sound_only"></strong></label></th>
                <td>
                    <input type="text" name="msg_entity_text" id="msg_entity_text" value="<?php echo $row['msg_entity_text']; ?>" required class="required frm_input" size="200">
                </td>
            </tr>
          </tbody>
        </table>
      </div>
  </section>
  <div class="btn_fixed_top">
      <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
  </div>
</form>
<?php
include_once('./admin.tail.php'); 
?>
