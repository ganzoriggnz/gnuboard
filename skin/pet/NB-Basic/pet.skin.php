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
            <p class="pet_p1">고양이에게 사료 1회, 청소 1회, 스담스담 1회 30분 간격으로 완료시 파운드 100 지급</p>
        </div>
    </div>
    <div class="pet_img_div">
        <div>
            <img src="<?php echo G5_URL ?>/img/cat.png">
        </div>
    </div>
    <?php $res = "SELECT * FROM {$g5['pet_table']} WHERE mb_id = '{$member['mb_id']}' AND  p_but1_datetime > '{$p_begin_date}' AND '{$p_end_date}' >=  p_but1_datetime AND '{$p_end_date}' >=  p_but2_datetime AND '{$p_end_date}' >=  p_but3_datetime";
    $row = sql_fetch($res); 
    ?>
    <div class="row_btn mt_54">
        <input type="hidden" id="but1" value="<?php if ($row['p_but1_datetime']) echo $row['p_but1_datetime']; ?>">
        <button type="button" id="cat1" name="cat1" <?php if($row['p_but1_datetime'] != '0000-00-00 00:00:00' && $row['p_but1_datetime']){ echo 'class="btn_pet_third" disabled="disabled"';} else { echo 'class="btn_pet_first"';} ?>>청소하기</button>
    </div>      
    <div class="row_btn mt_24">   
        <input type="hidden" id="but2" value="<?php if ($row['p_but2_datetime']) echo $row['p_but2_datetime']; ?>">     
        <button type="button" id="cat2" onclick="clickCat2('<?php echo $row['p_but1_datetime']?>');" <?php echo ($row['p_but2_datetime'] != '0000-00-00 00:00:00' && $row['p_but2_datetime']) ? 'class="btn_pet_third" disabled="disabled"'  : 'class="btn_pet_first"' ?>>쓰담쓰담 하기</button>
    </div>
    <div class="row_btn mt_24">
        <input type="hidden" id="but3" value="<?php if ($row['p_but3_datetime']) echo $row['p_but3_datetime']; ?>">
        <button type="button" id="cat3" onclick="clickCat3('<?php echo $row['p_but2_datetime'];?>');" <?php echo ($row['p_but3_datetime'] != '0000-00-00 00:00:00' && $row['p_but3_datetime']) ? 'class="btn_pet_third" disabled="disabled"'  : 'class="btn_pet_first"' ?>>사료주기</button>
    </div>
    <div id ="result"></div>
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
            $("#cat1").click(function(){
                var id = this.id;
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
                            //$('#result').val(response);
                        }
                    });
                });

            $("#cat2").click(function(){
                var id = this.id;
                $.ajax({
                        type: 'POST',
                        url: 'pet_update.php',
                        data: {
                            'btn_id': 2,
                            'id': id
                        },
                        dataType: 'text',
                        success: function(response) {
                            //$('#result').val(response);
                        }
                    });
                });

            $("#cat3").click(function(){
                var id = this.id;
                $.ajax({
                        type: 'POST',
                        url: 'pet_update.php',
                        data: {
                            'btn_id': 3,
                            'id': id
                        },
                        dataType: 'text',
                        success: function(response) {
                            //$('#result').val(response);
                        }
                    });
                });

        });
    </script>
    
</div>