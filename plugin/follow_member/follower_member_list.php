<?php
include_once("./_common.php");
include_once(G5_PLUGIN_PATH.'/follow_member/follow_member.lib.php');
$res = $follow_member->get_friend_both_list(0,10000);
echo $follow_member->get_css();
?>

<table class="friend_table">
<colgroup>
	<col width=100>
	<col width="">
	<col width=100>
</colgroup>
<?php
$i = 0;
foreach($res as $key => $row){
	$i++;

	$link = "";

	if( $row['friendphoto'] ) $img = "<img class='img' src='".$row['friendphoto']."'>";
	else $img = "<span class='img'></span>";
?>
	<tr>
		<td><a href="<?php echo $link?>" class="linkgo"><?php echo $img?></a></td>
		<td><a href="<?php echo $link?>" class="linkgo"><?php echo $row['friendname']?></a></td>
		<td class="tt" style="width:55%; text-align:right; ">
    	<a href="<?php echo G5_FOLLOW_MEMBER_URL?>/delfollowers.php?friendid=<?php echo $row['friendid']?>" class="delfriend">Delete</a>
       <?php if( $row['acceptyn'] == "N" ){?><a href="<?php echo G5_FOLLOW_MEMBER_URL?>/acceptfollowers.php?following=<?php echo $row['friendid']?>" class="delfriend1">Follow</a><?php }?>
		</td>
	</tr>
<?php }?>

<?php if( $i == 0 ){?>
	<tr>
		<td colspan="3"></td>
	</tr>
<?php }?>
</table>

<script>
$(document).ready(function(){
	$(".delfriend").click(function(){
		if( confirm("목록에서 친구를 삭제하시겠습니까?") ){
			document.location.href = $(this).attr("href");

			return false;
		}
	});

	$(".linkgo").click(function(){
		top.document.location.href = $(this).attr("href");
		return false;
	});

});
</script>
