<?php
$sub_menu = "700200";
include_once('./_common.php');

if(isset($_POST['cos_nick1'])){
   $cos_nick = $_POST['cos_nick1'];
}

$sql1 = "SELECT MAX(alt_created_datetime) as maxdate FROM `g5_coupon_alert` WHERE cos_nick = '{$cos_nick}'"; 
$row1 = sql_fetch($sql1);  
$sql2 = "SELECT * FROM `g5_coupon_alert` WHERE alt_created_datetime = '{$row1['maxdate']}' ";
$row2 = sql_fetch($sql2);
                        
    $response .= '<div style="margin-left: 30px;">사용자 : ' .$row2['cos_nick'].'</div>
					<div style="margin-left: 30px;">현재 경고횟수 : '.$row2['cos_alt_quantity'].
					'<form id="fcouponalert" name="fcouponalert" action="'.G5_ADMIN_URL.'/coupon_list_calendar.php" onsubmit="return fcouponalert_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="w" id="w" value="u">
						<input type="hidden" name="cos_nick" id="cos_nick" value="'.$row2['cos_nick'].'">
						<input type="hidden" name="cos_entity" id="cos_entity" value="'.$row2['cos_entity'].'">
						<div style="margin-left:30px; margin-top: 30px;">
							<p style="text-decoration: underline; display: inline;">경고횟수 변경</p>
							<input type="number" name="cos_alt_quantity" id="cos_alt_quantity" style="background: #EFEFEF; width: 40px;" value = "'.$row2['cos_alt_quantity'].'"/>		
							<input type="submit" name="change" id="change" value="확인" style="background: #FFF2CC; width: 80px;"/>
						</div>
					</form>
					<div style="margin-left:30px; margin-top:20px;">경고 히스토리</div>
					<div style="margin: 10px 10px 10px 0px;">
						<table style="width: 550px;">
							<thead>
								<tr>
								<tr style=" background:  #f8f8f8; border: 1px solid #000; font-size: 10px;">
									<th style= "width: 25%; border: 1px solid #000; text-align: center;">시간</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">업소명</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">경고내용</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">최종적용 아이디</th>
									<th style= "width: 20%; border: 1px solid #000; text-align: center;">누적횟수</th>
								</tr>
							</thead>
							<tbody id ="tb_body" style="background: #fff;">';
							$sql = "SELECT * FROM `g5_coupon_alert` WHERE cos_nick = '{$cos_nick}' ORDER BY alt_created_datetime";
                            $result = sql_query($sql);
                            for($i=0; $row = sql_fetch_array($result); $i++) { 
                                $response .= '<tr style="border: 1px solid #000;font-size: 8px;">
                                                <td style="border: 1px solid #000; text-align: center;">'.$row['alt_created_datetime'].'</td>
                                                <td style="border: 1px solid #000; text-align: center;">'. $row['cos_entity'].'</td>
                                                <td style="border: 1px solid #000; text-align: center;">'. $row['alt_reason'].'</td>
                                                <td style="border: 1px solid #000; text-align: center;">'. $row['alt_created_by'].'</td>
                                                <td style="border: 1px solid #000; text-align: center;">'. $row['cos_alt_quantity'].'</td>
                                            </tr>';
                                                        
                            }  
	$response .= '</tbody>
						</table>
                    </div>';		
                    			
echo $response;
?>
