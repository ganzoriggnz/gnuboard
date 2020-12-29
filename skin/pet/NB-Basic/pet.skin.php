<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$pet_skin_url.'/style.css">', 0);
?>
<div id="bo_v">
    <div class="pet_text">
        <div>
            <h1>펫기르기</h1>
        </div>
        <div>
            <p class="pet_p1">강아지 또는 고양이에게 사료 1회, 청소 1회, 스담스담 1회 30분 간격으로 완료시 파운드 100 지급 </p>
        </div>
    </div>
    <div class="pet_img_div">
        <div>
            <img src="<?php echo G5_URL ?>/img/cat.png">
        </div>
        <div class="pet_img2">
            <img src="<?php echo G5_URL ?>/img/dog.png">
        </div>
    </div>
    <div class="row_btn mt_54">
        <button type="button" id="btn_cat1" class="btn_pet_first">청소하기</button>
        <button type="button" id="btn_dog1" class="btn_pet_second">청소하기</button>
    </div>
    <div class="row_btn mt_24">
        <button type="button" id="btn_cat2" class="btn_pet_first">쓰담쓰담 하기</button>
        <button type="button" id="btn_dog2" class="btn_pet_second">쓰담쓰담 하기</button>
    </div>
    <div class="row_btn mt_24">
        <button type="button" id="btn_cat3" class="btn_pet_first">청소하기</button>
        <button type="button" id="btn_dog3" class="btn_pet_second">청소하기</button>
    </div>

    <div class="pet_bottom">
        <p>* 모든 버튼은 <span class="red">매일 12시(한국시간) 초기화 된다</span></p>
    </div>
    <script>
        $(document).ready(function(){
            $('button').click(function(){
                $("#" + this.id).prop('disabled', true).css("background","#4D4D4D");
                $('btn').not(this).prop('disabled', false);

            }); 

        });

        // function to disable and enable buttons, receives an array with button IDs 
// from https://coursesweb.net/javascript 
function disableEnableBtn(ids){ 
 // traverses the array with IDs 
 var nrids = ids.length; 
 for(var i=0; i<nrids; i++){ 
 // registers onclick event to each button 
 if(document.getElementById(ids[i])) { 
 document.getElementById(ids[i]).onclick = function() { 
 this.setAttribute('disabled', 'disabled'); // disables the button by adding the disabled attribute 
 //this.innerHTML = 'Disabled'; // changes the button text 
 var idbtn = this.id; // stores the button ID 
 
 // calls a function after 2 sec. (2000 milliseconds) 
 setTimeout(()=>{ 
 document.getElementById(idbtn).removeAttribute('disabled'); // removes the disabled attribute 
 //document.getElementById(idbtn).innerHTML = 'Click'; // changes tne button text 
 }, 3000000 ); 
 } 
 } 
 } 
} 
 
// array with IDs of buttons 
var btnid = ['btn_cat1', 'btn_cat2', 'btn_cat3', 'btn_dog1', 'btn_dog2', 'btn_dog3']; 
 
disableEnableBtn(btnid); // calls the function
       
    </script>
    
</div>