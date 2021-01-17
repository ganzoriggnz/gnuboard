<?php

$sub_menu = "700300";
include_once('./_common.php');

$msg_created_datetime = G5_TIME_YMDHIS;
$msg_customer_text = $_POST['msg_customer_text'];
$msg_entity_text = $_POST['msg_entity_text'];

    $sql = " INSERT INTO `g5_coupon_msg` 
            SET msg_customer_text = '{$msg_customer_text}',
                msg_entity_text = '{$msg_entity_text}',
                msg_created_datetime = '{$msg_created_datetime'";
  sql_query($sql);
  echo $sql;

  //goto_url(G5_ADMIN_URL.'/coupon_msg.php');

?>