
<!DOCTYPE HTML>
<html>
<body bgcolor = #9015fe>
<h1> PHP code. </h1>

<?php
$x=3; // global scope

function myTest()
{
$x=10;
echo $x; // local scope
}

myTest();
echo $x;
?>



</body>

</html>