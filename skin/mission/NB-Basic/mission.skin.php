<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$mission_skin_url.'/style.css">', 0);
?>
<div id="bo_v" style="width: 1200px;">   
    <table cellspacing="0" cellpadding="0" width="100%" align="center" style="border:1px solid #d3d3d3; padding:10px; margin-top: 20px;" id="level-up">
		<thead>
			<tr>
				<th class="cl_tr">수행 No</th>
				<th class="cl_tr">수행명</th>
				<th class="cl_tr">수행설명</th>
				<th class="cl_tr">지급(공덕)</th>
				<th class="cl_tr">구분</th>
			</tr>
		</thead>
		<tbody>
				
			<tr>
				<td class="cl_td">1</td>
				<td class="cl_td">출석체크</td>	
				<td class="cl_td_l">출석체크 하기									
				</td>
				<td class="cl_td_r">
				5 
				점				
				</td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="#" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>			
					
			<tr>
				<td class="cl_td">2</td>
				<td class="cl_td">자유게시판</td>	
				<td class="cl_td_l">자유게시판에 글 1회 작성하기(<?php if($cnt == 0) { echo '0'; } else if($cnt > 0) { echo '1';} ?> /1)				
				</td>
				<td class="cl_td_r">
				10 
				점				
				</td>
				<td class="cl_td">
					<div class="<?php if($cnt > 0){ echo "miss_but_3";} else { echo "miss_but_1"; } ?>">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">3</td>
				<td class="cl_td">펫 기르기 게시판</td>	
				<td class="cl_td_l">펫 먹이주기, 청소하기,쓰담쓰담해주기(0/3)				
				</td>
				<td class="cl_td_r">
				50 
                점				
                </td>
				<td class="cl_td">
					<div class="<?php if($cnt > 0){ echo "miss_but_3";} else {echo "miss_but_1"; } ?>">
                        <a href="#" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>															
				</td>
			</tr>		
					
			<tr>
				<td class="cl_td">4</td>
				<td class="cl_td">댓글작성 후기</td>	
				<td class="cl_td_l">자유게시판에 댓글 1회 작성하기(0/1)				
				</td>
				<td class="cl_td_r">
				5 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>													
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">5</td>
				<td class="cl_td">댓글작성 후기</td>	
				<td class="cl_td_l">자유게시판에 댓글 5회 작성하기(0/3)				
				</td>
				<td class="cl_td_r">
				10 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>																
				</td>
			</tr>
			
					
			<tr>
				<td class="cl_td">6</td>
				<td class="cl_td">댓글작성 후기</td>	
				<td class="cl_td_l">자유게시판에 댓글 10회 작성하기(0/10)				
				</td>
				<td class="cl_td_r">
				50 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=free" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>													
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">7</td>
				<td class="cl_td">출근부</td>	
				<td class="cl_td_l">출근부 5회 읽기(0/5)				
				</td>
				<td class="cl_td_r">
				10 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/group.php?gr_id=attendance" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>												
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">8</td>
				<td class="cl_td">출근부</td>	
				<td class="cl_td_l">출근부 10회 읽기(0/10)				
				</td>
				<td class="cl_td_r">
				20 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/group.php?gr_id=attendance" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>												
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">9</td>
				<td class="cl_td">후기</td>	
				<td class="cl_td_l">후기 5회 읽기(0/5)				
				</td>
				<td class="cl_td_r">
				10 
                점				
                </td>
				<td class="cl_td">
					<div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/group.php?gr_id=review" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>					
				</td>
			</tr>
								
			<tr>
				<td class="cl_td">10</td>
				<td class="cl_td">후기</td>	
				<td class="cl_td_l">후기 10회 읽기(0/10)				
				</td>
				<td class="cl_td_r">
				20 
                점				
                </td>
				<td class="cl_td">
                    <div class="miss_but_1">
                        <a href="<?php echo G5_BBS_URL ?>/group.php?gr_id=review" target="_blank">				
                        <i class="fa fa-gift"></i><br>수행<br>진행</a>
                    </div>							
				</td>
			</tr>
					
			<tr style="border-top:1px solid #f3bd49">
				<td class="cl_td">+</td>
				<td class="cl_td">추가공덕</td>				
				<td class="cl_td_l"><font color="#f3bd49"><b>일일 미션 10개 모두 완료시 추가 공덕</b></font></td>	
				<td class="cl_td_r">300점</td>
				<td class="cl_td">
					<div class="miss_but_3">
					<i class="fa fa-gift"></i><br>완료<br>대기
			        </div>
				</td>
			</tr>

		</tbody>
    </table>
    <div style="margin-top:20px; line-height:20px;font-size:14px;font-weight:bold;">
    ※ 일일수행은 <font color="red">매일 12시에 초기화</font> 됩니다. (초기화 안될시 새로고침 눌러주세요) <br>
    &nbsp;&nbsp;&nbsp;공덕이나 엽전 내역은 합산 저장되니 착오 없으시기 바랍니다. <br>
    </div>
</div>