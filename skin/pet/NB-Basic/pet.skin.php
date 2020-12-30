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
    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
        <div class="row_btn mt_54">
            <button type="button" id="btn_cat1" name="cat1" class="btn_pet_first">청소하기</button>
            <button type="button" id="btn_dog1" name="cat2" class="btn_pet_second">청소하기</button>
        </div>
        <div class="row_btn mt_24">
            <button type="button" id="btn_cat2" class="btn_pet_first">쓰담쓰담 하기</button>
            <button type="button" id="btn_dog2" class="btn_pet_second">쓰담쓰담 하기</button>
        </div>
        <div class="row_btn mt_24">
            <button type="button" id="btn_cat3" class="btn_pet_first">사료주기</button>
            <button type="button" id="btn_dog3" class="btn_pet_second">사료주기</button>
        </div>
    </form>
    <div class="pet_bottom">
        <p>* 모든 버튼은 <span class="red">매일 12시(한국시간) 초기화 된다</span></p>
    </div>
    <div class="popup_box">
      <h1>펫기르기</h1>
      <label>30분 단위로 </br> 
        미션을 수행해 주세요 </br></br>남은시간 :<span id="time"></span></label>
      <div class="btns">
        <a href="#" class="btn">확인</a>
      </div>
    </div>
    <div class="popup_box1">
      <h1>펫기르기</h1>
      <label><span id="pet"></span>펫기르기 미션 완료 </br>
      100파운드를 지급합니다</label>
      <div class="btns1">
        <a href="#" class="btn1">확인</a>
      </div>
    </div>
    <script>
        $(document).ready(function(){
            
            var isButtonClicked = 0;
            var lastClickedTime = new Date($.now());
            var count = 0;
            /* setInterval(function(){ $('#demo').html(count) }, 1); */

            $('button').click(function(){

                if (!isButtonClicked)
                {
                    $("#" + this.id).css("background","#4D4D4D");
                    isButtonClicked = 1;
                    lastClickedTime = new Date($.now());
                    count+=1;
                    $('#demo').html("My current count is: " + count);
                }
                else
                {
                    if (getElapsedMinutes(lastClickedTime, new Date($.now())) > 30)
                    {
                        $("#" + this.id).css("background","#4D4D4D");
                        lastClickedTime = new Date($.now());
                        count+=1;
                        $('#demo').html("My current count is: " + count);
                        var id = this.id; 
                        getSuccess(count, id);
                    }
                    else
                    {
                        var time = getElapsedTime(lastClickedTime, new Date($.now()));
                        $('#time').html(time);
                        $('.popup_box').css("display", "block");
                        $('.btn').click(function(){
                            $('.popup_box').css("display", "none");
                        }); 
                    }
                }
            }); 

            function getSuccess(count, id){
                if(count==3 && id.includes('cat')){
                            $('#pet').html('고양이 ');
                            $('.popup_box1').css("display", "block");
                            $('.btn1').click(function(){
                            $('.popup_box1').css("display", "none");
                            });
                        } else if(count==3 && id.includes('dog')){
                            $('#pet').html('강아지 ');
                            $('.popup_box1').css("display", "block");
                            $('.btn1').click(function(){
                            $('.popup_box1').css("display", "none");
                            });
                        } else if(count==6 && id.includes('cat')){
                            $('#pet').html('고양이 ');
                            $('.popup_box1').css("display", "block");
                            $('.btn1').click(function(){
                            $('.popup_box1').css("display", "none");
                            });
                        } else if(count==6 && id.includes('dog')){
                            $('#pet').html('강아지 ');
                            $('.popup_box1').css("display", "block");
                            $('.btn1').click(function(){
                            $('.popup_box1').css("display", "none");
                            });
                        }
            }

            function getElapsedTime(last, current) 
            {
                var res = Math.abs(current - last) / 1000;
            
                var days = Math.floor(res / 86400);      
                var hours = Math.floor(res / 3600) % 24;
                var minutes = Math.floor(res / 60) % 60;
                var seconds = Math.floor(res % 60);

                return minutes + "분 " + seconds + "초";
            }

            function getElapsedMinutes(last, current) 
            {
                var res = Math.abs(current - last) / 1000;
            
                var days = Math.floor(res / 86400);      
                var hours = Math.floor(res / 3600) % 24;
                var minutes = Math.floor(res / 60) % 60;
                var seconds = Math.floor(res % 60);

                return seconds / 60 + minutes + hours * 60 + days * 1440; 
            }
        });
    </script>
    
</div>