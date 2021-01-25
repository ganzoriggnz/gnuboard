
<div id="Action">


<div class="table_ex" >
<table>

<?php
$i = 0;
$query5 = "select * from g5_write_basket  where mb_id = '$member[mb_id]'  and wr_10 = '구매대기'  ";
$result5 = sql_query($query5);
while($row  = sql_fetch_array($result5)) {
	
	$product[$i] = $row['wr_subject']; 
	$amount[$i] = $row['wr_3'];
	$price[$i] = $row['wr_1'];
	$delivery[$i] = $row['wr_2']; 
	$del_status[$i] = $row['wr_8']; 
	$date[$i] = $row['wr_datetime']; 
	$id[$i] = $row['wr_9']; 
	$confirm[$i] = $row['wr_10']; 

	$i++;
}

$total_price = 0;
$del_fee  = 0;
for($i =0; $i < count($product); $i++) { 
if($amount[$i] != 0) { 
	$total_price = $price[$i] + $total_price;
	if($del_status[$i] == 1) $del_fee = $delivery[$i] + $del_fee;
	$check = $confirm[$i];

	?>
<tr>
	<td><?php echo $product[$i]?></td>
	<td><?php echo $amount[$i]?>개</td>
	<td><?php echo number_format($price[$i])?> P</td>
	<td><?php echo substr($date[$i], 0, 9)?></td>
	<td><input type=image  onclick="Process2(<?php echo $id[$i] ?>)"  src="<?php echo $board_skin_url ?>/shop/img/button-arrow-down-icon.png"> <input type=image  onclick="Process21(<?php echo $id[$i] ?>)" src="<?php echo $board_skin_url ?>/shop/img/button-arrow-up-icon.png">  <input type=image class="btn_b01" onclick="Process3(<?php echo $id[$i] ?>)" src="<?php echo $board_skin_url ?>/shop/img/Windows-Close-Program-icon.png"></td>
</tr>
<?php }
	if($total_price != 0)  $del_fee = min($delivery) + $del_fee;
	$total_price = $total_price + $del_fee;
	if($check == "구매대기") $check = "결제하기";
	if($check == "결제확인") $check = 1;
 }
?>
<script language="javascript" type="text/javascript">
//<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=400,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>

<tr style="background:white;border:1px solid #000000;">
	<td>총 결제 파운드</td>
	<td colspan=2 ><?php echo number_format($total_price)?> P(배송료:<?php echo $del_fee?> P)  </td>
	<td  colspan=2>
	<?php if($check == "결제하기") { ?>
	<a href="<?php echo $board_skin_url?>/shop/checkout.php?total_price=<?php echo $total_price?>&check=<?php echo $check?>&myid=<?php echo $member['mb_id']?>" onclick="return popitup('<?php echo $board_skin_url?>/shop/checkout.php?total_price=<?php echo $total_price?>&check=<?php echo $check?>&myid=<?php echo $member['mb_id']?>')"><IMG src="<?php echo $board_skin_url ?>/shop/img/purple-credit-card.png"> <?php echo $check?></a></td>
	<?php } ?>
	<?php if($check == 1) echo "구매 감사드립니다"; ?>	
</tr>
</table>
</div>
</div>