<?php
include_once("./_common.php");
include_once(G5_PLUGIN_PATH.'/follow_member/follow_member.lib.php');

//친구요청이 들어온 목록출력
$res = $follow_member->get_friend_list("", $member['mb_id'], 0, 10, 'N', 0);
echo $follow_member->get_css();
?>

<table class="friend_table">
<colgroup>
	<col width=130>
	<col width="">
	<col width=200>
</colgroup>
<?php
$i = 0;
foreach($res as $key => $row){
	$i++;

	$link = G5_BBS_URL."/board.php?bo_table=mypage&sfl=mb_id&stx=".$row['followers'];
?>
	<tr>
		<td><a href="<?php echo $link?>" class="linkgo"><img src="<?php echo $row['followers_photo']?>"></a></td>
		<td><a href="<?php echo $link?>" class="linkgo"><?php echo $row['followers_name']?></a></td>
		<td>
			<?php if( $row['followersyn'] == "N" ){?><a href="<?php echo G5_URL?>/proccess/acceptfollowers.php?following=<?php echo $row['following']?>" class="">수락</a><?php }else{?>
			<a href="<?php echo G5_URL?>/proccess/rejectionfollowers.php?following=<?php echo $row['following']?>" class="">거절</a><?php }?>
			<a href="<?php echo G5_URL?>/proccess/delfollowers.php?following=<?php echo $row['following']?>" class="delfriend">친구삭제</a>
		</td>
	</tr>
<?php }?>

<?php if( $i == 0 ){?>
	<tr>
		<td colspan="3">친구가 없습니다.</td>
	</tr>
<?php }?>
</table>

<script>
$(document).ready(function(){
	$(".delfriend").click(function(){
		if( confirm("친구목록에서 삭제하시겠습니까?") ){
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
