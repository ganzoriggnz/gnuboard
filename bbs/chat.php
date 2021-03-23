 <!-- hulan nemsen 유챗 연동 -->
            
 <?php
 // 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
echo '<head>
<meta charset="utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>광고 커뮤니티</title>
<link rel="stylesheet" href="http://bamje1.com/nariya/app/bs4/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://bamje1.com/js/font-awesome/css/font-awesome.min.css" type="text/css">
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "http://bamje1.com";
var g5_bbs_url   = "http://bamje1.com/bbs";
var g5_is_member = "1";
var g5_is_admin  = "super";
var g5_is_mobile = "";
var g5_bo_table  = "";
var g5_sca       = "";
var g5_editor    = "";
var g5_plugin_url = "http://bamje1.com/plugin";
var g5_cookie_domain = "";
</script>
<style>*{ box-sizing: border-box }.closeButton {
    position: absolute;
    bottom: 10px;
    right: 25px;
}</style>
<script src="http://bamje1.com/nariya/js/jquery-3.5.1.min.js"></script>
<script src="http://bamje1.com/nariya/js/common.js?ver=191202"></script>
<script src="http://bamje1.com/js/wrest.js?ver=191202"></script>
<script src="http://bamje1.com/js/placeholders.min.js"></script>
<script src="http://bamje1.com/nariya/app/bs4/js/bootstrap.bundle.min.js"></script>
<script src="http://bamje1.com/nariya/js/nariya.js?ver=191202"></script>
<script src="http://bamje1.com/theme/NB-Basic/js/theme.js"></script>

</head><body>';

 function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
            include_once("_common.php");
        if($member['mb_level'] >= 5) { // 레벨 6 이상 입장 가능
            
            if (!function_exists('uchat_array2data')) {
                function uchat_array2data($arr)
                {
                    $arr['time'] = time();
                    ksort($arr);
                    $arr = array_filter($arr);
                    $arr['hash'] = md5(implode($arr['token'], $arr));
                    unset($arr['token']);
                    foreach ($arr as $k => &$v) {
                        $v = $k . ' ' . urlencode($v);
                    }
                    return implode("|", $arr);
                }
            }
            $joinData = array();
            $joinData['room'] = 'Empire';
            $joinData['token'] = 'ddf0afc2391ac3e60ad646822b83441c';

            $joinData['nick'] = $member['mb_nick'];
            $joinData['id'] = $member['mb_id'];
            $joinData['level'] = $member['mb_level'];;
            $joinData['auth'] = $is_admin?"admin":""; // (admin, subadmin, member, guest)중 하나선택, 미선택시 자동(권장)
            $joinData['icons'] = $아이콘주소변수;
            if($is_member) {
                $uicon_file = "/eyoom/core/member/".substr($member['mb_id'],0,2)."/".$member['mb_id'].".gif";
                if(file_exists((G5_PATH?G5_PATH:$g4['path']).$uicon_file))
                    $joinData['icons'] = $uicon_file;
            }
            //$joinData['nickcon'] = $닉콘주소변수;
            //$joinData['other'] = '';
            ?>
            <script async src="//client.uchat.io/uchat.js"></script>
            <u-chat room='<?php echo $joinData['room']; ?>' user_data='<?php echo uchat_array2data($joinData); ?>' style="display:inline-block; width:100<?php echo isMobile() ?'vw;' :'%;' ?> height:100<?php echo isMobile() ?'vh;' :'%;' ?>"></u-chat>
      
      
       <?php }
            else echo '<div id="noPer" style="
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: center;
            display: flex;
        ">
            <h2>채팅방 입장 권한 없습니다 </h2>
        </div>' ; 
?>
          <!--   //////////////////////////////////////////////////////////////// -->

          <script>

function closeButtonz() {
    try{
  var span = document.createElement("SPAN");
  var button = document.createElement("BUTTON");
  var textnode = document.createTextNode("닫기");
  button.appendChild(textnode);
  button.onclick = function() { self.close(); };
  button.style.padding = "0px 10px";
  span.appendChild(button);
  span.style.position = "absolute";
  span.style.right = "20px";
  span.style.bottom = "10px";
  
  document.getElementById("noPer").appendChild(span);
 
  }
  catch(e){
    alert(e);
  }
}

function closeButton() {
    try{
  var span = document.createElement("SPAN");
  var button = document.createElement("BUTTON");
  var textnode = document.createTextNode("닫기");
  button.appendChild(textnode);
  button.onclick = function() { self.close(); };
  button.style.padding = "0px 10px";
  span.appendChild(button);
  span.style.position = "absolute";
  span.style.right = "20px";
  span.style.bottom = "10px";
  
  window.frames[0].document.getElementsByClassName("content nano-content")[0].appendChild(span);
  }
  catch(e){
    alert(e);
  }
}
<?php  if(isMobile()){
    if($member['mb_level'] >= 5){
        echo 'window.addEventListener("load", function() {
            setTimeout(function(){
               closeButton();      
            }, 2500)
        })';
    }else{
        echo 'window.addEventListener("load", function() {
            setTimeout(function(){
                closeButtonz();      
            }, 2500)
        })';
    }
    }?>
</script>

</body>
          
</html>
