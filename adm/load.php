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
  'title'   => '(원가권) '.$row['cos_nick'],
  'start'   => $row['cos_created_datetime'],
  'end'   => $row['cos_created_datetime'],
  'allday' => true,
  'textColor' => '#000'
 );

}

$query1 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity = '0' ORDER BY cos_no DESC";
$result1 = sql_query($query1);

while($row1 = sql_fetch_array($result1))
{
 $data[] = array(
  'id'   => '200',
  'title'   => '(원가권) '.$row1['cos_nick'],
  'start'   => $row1['cos_accepted_datetime'],
  'end'   => $row1['cos_accepted_datetime'],
  'allday' => true,
  'textColor' => '#0000FF'
 );

}

$query2 = "SELECT * FROM `g5_coupon_sent` WHERE cos_accept = 'Y' and cos_alt_quantity > '0' ORDER BY cos_no DESC";
$result2 = sql_query($query2);

while($row2 = sql_fetch_array($result2))
{
 $data[] = array(
  'id'   => '300',
  'title'   => '(원가권) '.$row2['cos_nick'].'('.$row2['cos_alt_quantity'].')',
  'start'   => $row2['cos_post_datetime'],
  'end'   => $row2['cos_post_datetime'],
  'allday' => true,
  'textColor' => '#FF0000'
 );

}

echo json_encode($data);

?>