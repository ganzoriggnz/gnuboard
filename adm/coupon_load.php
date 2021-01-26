<?php

$sub_menu = "700200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$data = array();

<<<<<<< HEAD
$query = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'N' ORDER BY cos_no DESC";
=======
$query = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept = 'N' ORDER BY cos_no DESC";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
$result = sql_query($query);

while($row = sql_fetch_array($result))
{
 $data[] = array(
  'id'   => '100',
  'title'   => $row['cos_nick'],
  'start'   => $row['cos_created_datetime'],
  'end'   => $row['cos_created_datetime'],
  'allday' => true,
  'textColor' => '#000',
  'description' => $row['cos_alt_quantity'],
  'cos_no' => $row['cos_no'],
  'cos_nick1' =>$row['cos_nick']
   
 );

}

<<<<<<< HEAD
$query1 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity = '0' ORDER BY cos_no DESC";
=======
$query1 = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept = 'Y' and cos_alt_quantity = '0' ORDER BY cos_no DESC";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
$result1 = sql_query($query1);

while($row1 = sql_fetch_array($result1))
{
 $data[] = array(
  'id'   => '200',
  'title'   => $row1['cos_nick'],
  'start'   => $row1['cos_accepted_datetime'],
  'end'   => $row1['cos_accepted_datetime'],
  'allday' => true,
  'textColor' => '#0000FF',
<<<<<<< HEAD
  'description' => $row['cos_alt_quantity'],
=======
  'description' => $row1['cos_alt_quantity'],
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
  'cos_no' => $row1['cos_no'],
  'cos_nick1' =>$row1['cos_nick']
 );

}

<<<<<<< HEAD
$query2 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity > '0' ORDER BY cos_no DESC";
=======
$query2 = "SELECT * FROM {$g5['coupon_sent_table']} WHERE cos_accept = 'Y' and cos_alt_quantity > '0' ORDER BY cos_no DESC";
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
$result2 = sql_query($query2);

while($row2 = sql_fetch_array($result2))
{
<<<<<<< HEAD
 $data[] = array(
  'id'   => '300',
  'title'   => $row2['cos_nick'].'('.$row2['cos_alt_quantity'].')',
=======
    $sql4 = "SELECT MAX(alt_created_datetime) as maxdate FROM `g5_coupon_alert` WHERE cos_nick = '{$row2['cos_nick']}'"; 
    $row4 = sql_fetch($sql4);  
    $res = "SELECT * FROM `g5_coupon_alert` WHERE alt_created_datetime = '{$row4['maxdate']}' ";
    $res1 = sql_fetch($res);

 $data[] = array(
  'id'   => '300',
  'title'   => $row2['cos_nick'].'('.$res1['cos_alt_quantity'].')',
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
  'start'   => $row2['cos_post_datetime'],
  'end'   => $row2['cos_post_datetime'],
  'allday' => true,
  'textColor' => '#FF0000',
<<<<<<< HEAD
  'description' => $row['cos_alt_quantity'],
=======
  'description' => $row2['cos_alt_quantity'],
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
  'cos_no' => $row2['cos_no'],
  'cos_nick1' =>$row2['cos_nick']
 );

}

echo json_encode($data);

?>