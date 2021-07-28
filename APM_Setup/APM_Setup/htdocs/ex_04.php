
<!DOCTYPE HTML>
<html>
<body bgcolor = #9015fe>
<h1> PHP code. </h1>

<?php
$x=5; // global scope
$y=10;

function myTest()
{
global $x,$y;
$y=$x+$y;
}

myTest();
echo $y;
?>



</body>

</html>