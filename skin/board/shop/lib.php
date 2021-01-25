<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">
 <script>
 function Process(str)
 {
 if (str.length==0)
   {
   document.getElementById("Action").innerHTML="";
   return;
   }
 if (window.XMLHttpRequest)
   { // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   { // code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     document.getElementById("Action").innerHTML=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","<?php echo $board_skin_url?>/order.php?q="+str,true);
 xmlhttp.send();
 }

function Process2(str)
 {
 if (str.length==0)
   {
   document.getElementById("Action").innerHTML="";
   return;
   }
 if (window.XMLHttpRequest)
   { // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   { // code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     document.getElementById("Action").innerHTML=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","<?php echo $board_skin_url?>/updateminus.php?q="+str,true);
 xmlhttp.send();
 }

function Process21(str)
 {
 if (str.length==0)
   {
   document.getElementById("Action").innerHTML="";
   return;
   }
 if (window.XMLHttpRequest)
   { // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   { // code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     document.getElementById("Action").innerHTML=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","<?php echo $board_skin_url?>/updateplus.php?q="+str,true);
 xmlhttp.send();
 }

function Process3(str)
 {
 if (str.length==0)
   {
   document.getElementById("Action").innerHTML="";
   return;
   }
 if (window.XMLHttpRequest)
   { // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   { // code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     document.getElementById("Action").innerHTML=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","<?php echo $board_skin_url?>/delete.php?q="+str,true);
 xmlhttp.send();
 }
</script>