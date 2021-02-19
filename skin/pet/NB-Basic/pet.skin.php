<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 펫', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$pet_skin_url.'/style.css">', 0);

?>
<div id="bo_v">
    <div class="pet_text">
        <div>
            <h1>펫기르기</h1>
        </div>
        <div>
            <p class="pet_p1">고양이에게 사료 1회, 청소 1회, 스담스담 1회 30분 간격으로 완료시 파운드 100 지급</p>
        </div>
    </div>
    <div class="pet_img_div">
        <div>
            <img src="<?php echo G5_URL ?>/img/cat.png">
        </div>
    </div>
    <div class="row_btn mt_54 panel1">
        <input type="hidden" id="but1" value="<?php if ($row['p_but1_datetime'] && $row['p_but1_datetime'] != '0000-00-00 00:00:00') echo $row['p_but1_datetime']; ?>">
        <button type="button" id="cat1" name="cat1" <?php if($row['p_but1_datetime'] != '0000-00-00 00:00:00' && $row['p_but1_datetime']){ echo 'class="btn_pet_third" disabled="disabled"';} else { echo 'class="btn_pet_first"';} ?>>청소하기</button>
    </div>      
    <div class="row_btn mt_24 panel2">   
        <input type="hidden" id="but2" value="<?php if ($row['p_but2_datetime'] && $row['p_but2_datetime'] != '0000-00-00 00:00:00') echo $row['p_but2_datetime']; ?>">     
        <button type="button" id="cat2" <?php echo ($row['p_but2_datetime'] != '0000-00-00 00:00:00' && $row['p_but2_datetime']) ? 'class="btn_pet_third" disabled="disabled"'  : 'class="btn_pet_first"' ?>>쓰담쓰담 하기</button>
    </div>
    <div class="row_btn mt_24 panel3">
        <input type="hidden" id="but3" value="<?php if ($row['p_but3_datetime'] && $row['p_but3_datetime'] != '0000-00-00 00:00:00') echo $row['p_but3_datetime']; ?>">
        <button type="button" id="cat3" <?php echo ($row['p_but3_datetime'] != '0000-00-00 00:00:00' && $row['p_but3_datetime']) ? 'class="btn_pet_third" disabled="disabled"'  : 'class="btn_pet_first"' ?>>사료주기</button>
    </div>
    <div class="pet_bottom">
        <p>* 모든 버튼은 <span class="red">매일 12시 초기화 됩니다</span></p>        
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
            var count = 0;
            $(".panel1 button").click(function(){
                var id = this.id;
                var lastClickedTime = new Date("<?php echo date("Y-m-d H:i:s"); ?>");
                count = 1;
                $("#cat1").css("background","#4D4D4D");
                $.ajax({
                        type: 'POST',
                        url: 'pet_update.php',
                        data: {
                            'btn_id': 1,
                            'id': id
                        },
                        dataType: 'text',
                        success: function(response) {
                            $('#but1').val(lastClickedTime);
                            location.reload();
                        }
                });
            });

            $(".panel2 button").click(function(){
                id = this.id;
                var firstTime = $('#but1').val(); 
                if(firstTime == ''){
                    alert("첫번째 버튼을 클릭하세요.");
                } else 
                {
                    if (getElapsedMinutes(firstTime, new Date("<?php echo date("Y-m-d H:i:s"); ?>")) >= 30){
                        lastClickedTime = new Date("<?php echo date("Y-m-d H:i:s"); ?>");
                    $("#cat2").css("background","#4D4D4D");
                    $.ajax({
                        type: 'POST',
                        url: 'pet_update.php',
                        data: {
                            'btn_id': 2,
                            'id': id
                        },
                        dataType: 'text',
                        success: function(response) {
                            $('#but2').val(lastClickedTime);
                            location.reload();
                        }
                    });
 
                    } else {
                        var time = getElapsedTime(firstTime, new Date().getTime());
                            $('#time').html(time);
                            $('.popup_box').css("display", "block");
                            $('.btn').click(function(){
                                $('.popup_box').css("display", "none");
                            }); 
                    }
                }
            });

            $(".panel3 button").click(function(){
                id = this.id;
                var firstTime = $('#but1').val(); 
                var secondTime = $('#but2').val(); 
                if(firstTime == '' && secondTime == ''){
                    alert("첫번째 버튼을 클릭하세요.");
                }
                else if(firstTime != '' && secondTime == ''){
                    alert("먼저 두번쨰 버튼을 클릭하세요.");
 
                } else {
                    if (getElapsedMinutes(secondTime, new Date("<?php echo date("Y-m-d H:i:s"); ?>")) >= 30){
                        lastClickedTime = new Date("<?php echo date("Y-m-d H:i:s"); ?>");
                    $("#cat3").css("background","#4D4D4D");
                    $.ajax({
                        type: 'POST',
                        url: 'pet_update.php',
                        data: {
                            'btn_id': 3,
                            'id': id
                        },
                        dataType: 'text',
                        success: function(response) {
                            $('#but2').val(lastClickedTime);
                        }
                    });
                    getSuccess();
                    } else {
                        var time = getElapsedTime(secondTime, new Date().getTime());
                            $('#time').html(time);
                            $('.popup_box').css("display", "block");
                            $('.btn').click(function(){
                                $('.popup_box').css("display", "none");
                            }); 
                    }
                }
               
            });

            function getElapsedTime(last, current) {  
                var end = new Date(last).getTime() + 30 * 60000;
                var res = Math.abs(end - current) / 1000;
                
                var minutes = Math.floor(res / 60) % 60;
                var seconds = Math.floor(res % 60);

                return minutes + "분 " + seconds + "초";
            }
     
            function getElapsedMinutes(last, current) {   
                var end = new Date(last).getTime();
                var clicked = new Date(current).getTime();
                var res = Math.abs(clicked - end) / 1000;
            
                var days = Math.floor(res / 86400);      
                var hours = Math.floor(res / 3600) % 24;
                var minutes = Math.floor(res / 60) % 60;
                var seconds = Math.floor(res % 60);

                return seconds / 60 + minutes + hours * 60 + days * 1440; 
            }

            function getSuccess(){      
                    $('#pet').html('고양이 ');
                    $('.popup_box1').css("display", "block");
                    $('.btn1').click(function(){
                    $('.popup_box1').css("display", "none");
                    });
            }

        });
    </script>
    
</div>