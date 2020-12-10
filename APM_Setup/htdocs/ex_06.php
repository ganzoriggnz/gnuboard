<!DOCTYPE HTML>

<html>
<meta charset = "UTF-8">
<body>

<h1> PHP code </h1>

<?php
$txt1="지식공유 할스!";
$txt2="활스 존 멋 짱!";
echo $txt1 . " " . $txt2;  // . 는 문자열 연결 연상자 입니다. 
echo strlen("abcdefg");     // 총 7 글자 
echo strlen("지식공유 촬스");    // 총 14 글자   //  지 -는 1 글자 된다고 게산한다. 
echo strpos ("abcdefg","cd");   // 순서 위치를 나타낸다. 
?>

</body>

</html>