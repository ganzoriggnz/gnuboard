

<?php
$sub_menu = "600200";
include_once('./_common.php');


auth_check($auth[$sub_menu], 'r');
$g5['title'] = "쿠폰지원내역";
include_once('./admin.head.php');



// Naran code////////////////////////////////////////////////////
// $colspan = 15;
// $link = $g5['connect_db'];
// $error=G5_DISPLAY_SQL_ERROR;
// sql_query($sql, $error, $link);
// $result = sql_query("select * from bzy_quick_link", $error, $link);
// if ($result->num_rows > 0) {
//   echo "<table><tr><th>ID</th><th>Title</th><th>Link</th></tr>";
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "<tr style='text-align:center'><td>".$row['id']."</td><td>".$row['title']."</td><td>".$row['link']."</td></tr>";
//   }
//   echo "<tfoot><tr><td><input type='text' /></td><td><input type='text' /></td><td><input type='text' /></td></tr></tfoot></table>";
// } else {
//   echo "0 results";
// }
// ?>

 <?php  
// $header = apache_request_headers(); 
  
// foreach ($header as $headers => $value) { 
//     echo "$headers: $value <br />\n"; 
// } 
// ////////////////////////////////////////////////////////////////////////////////////
?>

<?php
include_once('./admin.tail.php');
?>