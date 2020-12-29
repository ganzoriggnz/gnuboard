<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$pet_skin_url.'/style.css">', 0);
?>
<div id="bo_v">
    <div style="text-align: center;">
        <div>
            <h1 style="font-size:40px; color:#272727;margin-bottom:36px;">펫기르기</h1>
        </div>
        <div>
            <p style="font-size:14px; line-height;">강아지 또는 고양이에게 사료 1회, 청소 1회, 스담스담 1회 30분 간격으로 완료시 파운드 100 지급 </p>
        </div>
    </div>
    <div style="display: flex; justify-content: center; margin-top: 40px;">
        <div>
            <img src="<?php echo G5_URL ?>/img/cat.png">
        </div>
        <div style="margin-left:129px;">
            <img src="<?php echo G5_URL ?>/img/dog.png">
        </div>
    </div>
    <div style="display: flex; justify-content: center; margin-top:54px;">
        <button type="button" id="btn_cat1" style="width:221px; height:33.5px;background:#D5BD79; color:#fff; font-size:14px;">청소하기</button>
        <button type="button" id="btn_dog1" style="width:221px; height:33.5px;background:#D5BD79;margin-left:172.9px; color:#fff; font-size:14px;">청소하기</button>
    </div>
    <div style="display: flex; justify-content: center; margin-top:24.5px;font-size:14px;">
        <button type="button" id="btn_cat2" style="width:221px; height:33.5px;background:#D5BD79; color:#fff; font-size:14px;">청소하기</button>
        <button type="button" id="btn_dog2" style="width:221px; height:33.5px;background:#D5BD79;margin-left:172.9px; color:#fff;">청소하기</button>
    </div>
    <div style="display: flex; justify-content: center; margin-top:24.5px;">
        <button type="button" id="btn_cat3" style="width:221px; height:33.5px;background:#D5BD79; color:#fff; font-size:14px; font-size:14px;">청소하기</button>
        <button type="button" id="btn_dog3" style="width:221px; height:33.5px;background:#D5BD79;margin-left:172.9px; color:#fff; font-size:14px;">청소하기</button>
    </div>

    <div style="margin-top: 30px; text-align:right;">
        <p>* 모든 버튼은 <font color:"red">매일 12시(한국시간) 초기화 된다</font></p>
    </div>
    
</div>