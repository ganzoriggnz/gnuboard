<!DOCTYPE HTML>

<html>
<h1> PHP CODE. </h1>

<?php

function myTest()
{
static $x=0;
echo $x;
$x++; 
}

myTest();
myTest();
myTest();
myTest();
myTest();

?>

</body>
</html>