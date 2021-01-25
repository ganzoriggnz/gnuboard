<?php

$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$data = array();

$now = G5_TIME_YMDHIS;

$query = "SELECT * FROM {$g5['member_table']} WHERE mb_4 !='0000-00-00 00:00:00' AND mb_4 >= '{$now}' AND mb_level IN (26, 27) AND (mb_5 = '') ORDER BY mb_no DESC";
$result = sql_query($query);

while($row = sql_fetch_array($result))
{
 $data[] = array(
  'id'   => '100',
  'title'   => '['.$row['mb_name'].'] '.$row['mb_2'],
  'start'   => $row['mb_4'],
  'end'   => $row['mb_4'],
  'allday' => true,
  'textColor' => '#0000FF',
  'mb_id' => $row['mb_id'],
  'mb_name' => $row['mb_name'],
  'mb_note' => $row['mb_5']   
 );
}

$query1 = "SELECT * FROM {$g5['member_table']} WHERE mb_4 !='0000-00-00 00:00:00' AND mb_4 < '{$now}' AND mb_level IN (26, 27) ORDER BY mb_no DESC";
$result1 = sql_query($query1);

while($row1 = sql_fetch_array($result1))
{
 $data[] = array(
  'id'   => '200',
  'title'   => '['.$row1['mb_name'].'] '.$row1['mb_2'],
  'start'   => $row1['mb_4'],
  'end'   => $row1['mb_4'],
  'allday' => true,
  'textColor' => '#FF0000',
  'mb_id' => $row1['mb_id'],
  'mb_name' => $row1['mb_name'],
  'mb_note' => $row1['mb_5']
 );
}

$query2 = "SELECT * FROM {$g5['member_table']} WHERE mb_4 !='0000-00-00 00:00:00' AND mb_4 > '{$now}' AND mb_level IN (26, 27) AND (mb_5 != '') ORDER BY mb_no DESC";
$result2 = sql_query($query2);

while($row2 = sql_fetch_array($result2))
{
 $data[] = array(
  'id'   => '300',
  'title'   => '['.$row2['mb_name'].'] '.$row2['mb_2'],
  'start'   => $row2['mb_4'],
  'end'   => $row2['mb_4'],
  'allday' => true,
  'textColor' => '#fca503',
  'mb_id' => $row2['mb_id'],
  'mb_name' => $row2['mb_name'],
  'mb_note' => $row2['mb_5']
 );
}

echo json_encode($data);

?>