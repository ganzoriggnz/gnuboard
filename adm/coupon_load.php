<?php

$sub_menu = "700200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$data = array();

$query = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'N' ORDER BY cos_no DESC";
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

$query1 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity = '0' ORDER BY cos_no DESC";
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
  'description' => $row['cos_alt_quantity'],
  'cos_no' => $row1['cos_no'],
  'cos_nick1' =>$row1['cos_nick']
 );

}

$query2 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity > '0' ORDER BY cos_no DESC";
$result2 = sql_query($query2);

while($row2 = sql_fetch_array($result2))
{
 $data[] = array(
  'id'   => '300',
  'title'   => $row2['cos_nick'].'('.$row2['cos_alt_quantity'].')',
  'start'   => $row2['cos_post_datetime'],
  'end'   => $row2['cos_post_datetime'],
  'allday' => true,
  'textColor' => '#FF0000',
  'description' => $row['cos_alt_quantity'],
  'cos_no' => $row2['cos_no'],
  'cos_nick1' =>$row2['cos_nick']
 );

}

echo json_encode($data);

?>