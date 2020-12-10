<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<body bgcolor = #feed8e>

<h1> PHP CODE </h1>

<?php

$food=array("치킨","피자","삼겹살","소갈비","꼬리곰","스테이크","공짜 술");
$arrlength=count($food);

for ($x=0; $x<$arrlength; $x++)
 {
 echo $food[$x];
 echo"<br>";
 }

?>

</body>
</html>