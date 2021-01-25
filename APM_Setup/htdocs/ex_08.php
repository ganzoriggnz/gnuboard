<!DOCTYPE HTML>
<html>
<meta charset="UTF-8" >
<h1> PHP code </h1>
<body bgcolor= #f9a13a>
<?php
$t=date("H");
if ($t<"10")
 {
  echo "아침이요!";
 } 
 else if ($t<"20")
 {
  echo "낮이요!";
 }
 else 
 {
 echo "밤이요!";
 }
 
?>

</body>
</html>