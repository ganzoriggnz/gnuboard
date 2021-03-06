<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$mission_skin_url.'/style.css">', 0);

?>
<div id="bo_v">   
    <table cellspacing="0" cellpadding="0" width="100%" align="center" style="border:1px solid #d3d3d3; padding:10px; margin-top: 20px;" id="level-up">
		<thead>
			<tr>
				<th class="cl_tr">수행 No</th>
				<th class="cl_tl">수행명</th>
				<th class="cl_tl">수행설명</th>
				<th class="cl_tr"></th>
				<th class="cl_tl">구분</th>
			</tr>
		</thead>
		<tbody>
				
			<tr>
				<td class="cl_td">1</td>
				<td class="cl_td_l">출석체크</td>	
				<td class="cl_td_l">출석체크 하기									
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt_at > 0){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_PLUGIN_URL ?>/attendance/attendance.php" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>			
					
			<tr>
				<td class="cl_td">2</td>
				<td class="cl_td_l">자유</br>게시판</td>	
				<td class="cl_td_l">자유게시판에 글 1회 작성하기(<?php if($cnt == 0) { echo '0'; } else if($cnt > 0) { echo '1';} ?> /1)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt > 0){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">3</td>
				<td class="cl_td_l">펫 기르기 </br>게시판</td>	
				<td class="cl_td_l">펫 먹이주기, 청소하기,놀아주기(<?php 
				if($row2['p_no'] && $row2['p_but1_datetime'] != '0000-00-00 00:00:00' && $row2['p_but2_datetime'] == '0000-00-00 00:00:00' && $row2['p_but3_datetime'] == '0000-00-00 00:00:00') { echo '1';} 
				else if($row2['p_no'] && $row2['p_but1_datetime'] != '0000-00-00 00:00:00' && $row2['p_but2_datetime'] != '0000-00-00 00:00:00' && $row2['p_but3_datetime'] == '0000-00-00 00:00:00') { echo '2';} 
				else if($row2['p_no'] && $row2['p_but1_datetime'] != '0000-00-00 00:00:00' && $row2['p_but2_datetime'] != '0000-00-00 00:00:00' && $row2['p_but3_datetime'] != '0000-00-00 00:00:00') { echo '3';} 
				else { echo '0';} ?>/3)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($row2['p_no'] && $row2['p_but1_datetime'] != '0000-00-00 00:00:00' && $row2['p_but2_datetime'] != '0000-00-00 00:00:00' && 
					$row2['p_but3_datetime'] != '0000-00-00 00:00:00'){ echo "miss_but_3";} else {echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/pet.php" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>															
				</td>
			</tr>		
					
			<tr>
				<td class="cl_td">4</td>
				<td class="cl_td_l">댓글작성</td>	
				<td class="cl_td_l">자유게시판에 댓글 1회 작성하기(<?php 
				if($cnt1 == 0) { echo '0';} 
				else if($cnt1 > 0) { echo '1';} ?>/1)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt1 > 0){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>													
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">5</td>
				<td class="cl_td_l">댓글작성</td>	
				<td class="cl_td_l">자유게시판에 댓글 5회 작성하기(<?php 
				if($cnt1 == 0) { echo '0';} 
				else if($cnt1 == 1) { echo '1';}
				else if($cnt1 == 2) { echo '2';}
				else if($cnt1 == 3) { echo '3';} 
				else if($cnt1 == 4 ) { echo '4';}
				else if($cnt1 >= 5) { echo '5';} ?>/5)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt1 >= 5){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank" >				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>
						
			<tr>
				<td class="cl_td">6</td>
				<td class="cl_td_l">댓글작성</td>	
				<td class="cl_td_l">자유게시판에 댓글 10회 작성하기(<?php 
				if($cnt1 == 0) { echo '0';} 
				else if($cnt1 == 1) { echo '1';}
				else if($cnt1 == 2) { echo '2';}
				else if($cnt1 == 3) { echo '3';}
				else if($cnt1 == 4) { echo '4';}
				else if($cnt1 == 5) { echo '5';}
				else if($cnt1 == 6) { echo '6';}
				else if($cnt1 == 7) { echo '7';}
				else if($cnt1 == 8) { echo '8';}
				else if($cnt1 == 9) { echo '9';}
				else if($cnt1 >= 10) { echo '10';} ?>/10)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt1 >= 10){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>													
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">7</td>
				<td class="cl_td_l">출근부</td>	
				<td class="cl_td_l">출근부 5회 읽기(<?php 
				if($cnt_att == 0) { echo '0';} 
				else if($cnt_att == 1) { echo '1';}
				else if($cnt_att == 2) { echo '2';}
				else if($cnt_att == 3) { echo '3';}
				else if($cnt_att == 4) { echo '4';}
				else if($cnt_att >= 5) { echo '5';} ?>/5)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt_att >= 5){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=opigangnam_at" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>												
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">8</td>
				<td class="cl_td_l">출근부</td>	
				<td class="cl_td_l">출근부 10회 읽기(<?php 
				if($cnt_att == 0) { echo '0';} 
				else if($cnt_att == 1) { echo '1';}
				else if($cnt_att == 2) { echo '2';}
				else if($cnt_att == 3) { echo '3';}
				else if($cnt_att == 4) { echo '4';}
				else if($cnt_att == 5) { echo '5';}
				else if($cnt_att == 6) { echo '6';}
				else if($cnt_att == 7) { echo '7';}
				else if($cnt_att == 8) { echo '8';}
				else if($cnt_att == 9) { echo '9';}
				else if($cnt_att >= 10) { echo '10';} ?>/10)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt_att >= 10){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=opigangnam_at" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>												
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">9</td>
				<td class="cl_td_l">후기</td>	
				<td class="cl_td_l">후기 5회 읽기(<?php 
				if($cnt_rev == 0) { echo '0';} 
				else if($cnt_rev == 1) { echo '1';}
				else if($cnt_rev == 2) { echo '2';}
				else if($cnt_rev == 3) { echo '3';}
				else if($cnt_rev == 4) { echo '4';}
				else if($cnt_rev >= 5) { echo '5';} ?>/5)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
					<div class="<?php if($cnt_rev >= 5){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=opigangnam_re" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>					
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">10</td>
				<td class="cl_td_l">후기</td>	
				<td class="cl_td_l">후기 10회 읽기(<?php 
				if($cnt_rev == 0) { echo '0';} 
				else if($cnt_rev == 1) { echo '1';}
				else if($cnt_rev == 2) { echo '2';}
				else if($cnt_rev == 3) { echo '3';}
				else if($cnt_rev == 4) { echo '4';}
				else if($cnt_rev == 5) { echo '5';}
				else if($cnt_rev == 6) { echo '6';}
				else if($cnt_rev == 7) { echo '7';}
				else if($cnt_rev == 8) { echo '8';}
				else if($cnt_rev == 9) { echo '9';}
				else if($cnt_rev >= 10) { echo '10';} ?>/10)				
				</td>
				<td class="cl_td_r"></td>
				<td class="cl_td">
                    <div class="<?php if($cnt_rev >= 10){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=opigangnam_re" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>							
				</td>
			</tr>
					
			<tr style="border-top:1px solid #f3bd49">
				<td class="cl_td">+</td>
				<td class="cl_td">지급파운드</td>				
				<td class="cl_td_l"><font color="#f3bd49"><b>일일 미션 10개 모두 완료시 </br>지급 파운드</b></font></td>	
				<td class="cl_td_r">50P</td>
				<td class="cl_td">
					<input type="hidden" name="mb_id" id="mb_id" value="<?php echo $member['mb_id'];?>">
					<div id="give" <?php if($cnt_rev >= 10 && $cnt_att >= 10 && $cnt1 >= 10 && $cnt_at > 0 && $cnt > 0 &&
					$row2['p_but1_datetime'] && $row2['p_but1_datetime'] != '0000-00-00 00:00:00' && 
					$row2['p_but2_datetime'] != '0000-00-00 00:00:00' && 
					$row2['p_but3_datetime'] != '0000-00-00 00:00:00') 
					{ echo 'class="miss_but_1" onclick = "givePoint()" style="cursor: pointer;"';} else { echo 'class="miss_but_3"'; } ?>>
					<i class="fa fa-gift"></i><br>완료<br>대기
			        </div>
				</td>
			</tr>

		</tbody>
    </table>
    <div style="margin-top:20px; line-height:20px;font-size:14px;font-weight:bold;">
    ※ 일일수행은 <font color="red">매일 12시에 초기화</font> 됩니다. (초기화 안될시 새로고침 눌러주세요) 
	</div>
</div>
<div class="popup_box1" style="display: none;">
	<h1>일일미션</h1>
	<label>축하합니다. <br/>50파운드 획득하였습니다</label>
	<div class="btns1">
		<a href="#" class="btn1">확인</a>
	</div>
</div>
<script>
	function givePoint(){
		var id = $("#mb_id").val();
		$.ajax({
			type: 'POST',
			url: 'mission_update.php',
			data: {
				'id': id
			},
			dataType: 'text',
			success: function(response) {                       
				$('.popup_box1').css("display", "block");
                    $('.btn1').click(function(){
                        $('.popup_box1').css("display", "none");
                    });
					$("#give").prop('disabled', true); 
					$("#give").removeClass("miss_but_1");
					$("#give").addClass("miss_but_3");              
			}  
		});		
	}
</script>