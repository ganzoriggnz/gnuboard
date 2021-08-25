<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$giftbox_skin_url.'/style.css?ver='.G5_JS_VER.'">', 0);
?>

<div id="bo_v">
    <nav id="user_cate" class="sly-tab font-weight-normal mb-2">
		<div class="px-3 px-sm-0">
			<div class="d-flex">
				<div id="user_cate_list" class="sly-wrap flex-grow-1">
					<ul id="user_cate_ul" class="sly-list d-flex border-left-0 text-nowrap">
                    <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/userinfo.php" >
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/user.svg" class="svg-img" style="height :13px;" >&nbsp
                                회원정보
                             
                                </span>
                            </a>
                        </li>
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/mypost.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/pen.svg" class="svg-img" style="height :13px;" >&nbsp
                                내 글
                                </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/point2.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/book.svg" class="svg-img" style="height :13px;" >&nbsp
                                파편조각 : <b><?php echo number_format($member['mb_point2']);?></b>
                                </span>
                            </a>
                        </li> -->
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/point.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gem.svg" class="svg-img" style="height :13px;" >&nbsp
                                파운드 : <b><?php echo number_format($member['mb_point']);?></b>
                                </span>
                            </a>
                        </li>
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/scrap.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/paperclip.svg" class="svg-img" style="height :14px;" >&nbsp
                                스크랩
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] == 27) { ?>
                        <li >
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_create.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/cubes.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰지원
                               
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/coupon_accept.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/handshake.svg" class="svg-img" style="height :14px;" >&nbsp
                                쿠폰관리
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/level_info.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/medal.svg" class="svg-img" style="height :14px;" >&nbsp
                                레벨정보
                                </span>
                            </a>
                        </li>
                        <?php if ($member['mb_level'] < 24) { ?>
                        <li class="active">
                            <a class="py2 px-3" href= "<?php echo G5_BBS_URL ?>/giftbox.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/gift.svg" class="svg-img" style="height :14px;" >&nbsp
                                선물함
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- if nuhtsul hulan nemsen 후기는 업소레벨에만 있으면 된다 -->
                        <?php if ($member['mb_level'] == 26 || $member['mb_level'] == 27) { ?>
                        <li > 
                            <a class="py2 px-3" href="<?php echo G5_BBS_URL ?>/myreview.php">
                                <span>
                                <img src="<?php echo G5_URL?>/img/solid/reply.svg" class="svg-img" style="height :14px;" >&nbsp
                                후기보기
                                </span>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                    <hr/>
				</div>
			</div>
		</div>
    </nav>
    <div class="giftbox">
        <table class="table">
		<colgroup>
			<col width="33%">
			<col width="33%">
			<col width="33%">
		</colgroup>
            <thead>
                <tr class="text-center">
                    <th>선물명</th>
					<th>받은시간</th>
                    <th>신청</th>
                </tr>
            </thead>
            <tbody>
				<?php while($row = sql_fetch_array($result)){?>
				<tr class="text-center">
					<td class="align-middle"><?=$row['gift_name'];?></td>
					<td class="align-middle"><?=$row['datetime'];?></td>
					<td class="align-middle">
						<?php if($row['request']=='Y'){?>
						<button type="button" class="btn btn-primary request-btn disabled">신청완료</button>
						<?php } else {?>
						<button type="button" class="btn btn-primary request-btn" onclick="request_modal(<?=$row['id'];?>, '<?=$row['gift_name'];?>');">사용신청</button>
						<?php }?>
					</td>
				</tr>
				<?php }?>
				<?php if( ! sql_num_rows($result)){?>
				<tr class="text-center">
					<td class="align-middle" colspan="4">받은 선물이 없습니다.</td>
				</tr>
				<?php }?>
            </tbody>
        </table>
    </div>
</div>

<!-- 사용신청 모달 -->
<div class="modal" id="request-modal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="text-center"><strong><span id="gift-name"></span> 사용 신청</strong></h5>
			</div>
			<div class="modal-body">
				<input type="hidden" id="giftbox_id" name="giftbox_id">
				<table>
					<tr>
						<th>&nbsp;</th>
						<th>원하는 지역</th>
						<th>원하는 업종</th>
					</tr>
					<tr>
						<th>1.</th>
						<td><input type="text" class="form-control" id="hope_area1" name="hope_area1" autocomplete="off" maxlength="20" required></td>
						<td><input type="text" class="form-control" id="hope_type1" name="hope_type1" autocomplete="off" maxlength="20" required></td>
					</tr>
					<tr>
						<th>2.</th>
						<td><input type="text" class="form-control" id="hope_area2" name="hope_area2" autocomplete="off" maxlength="20"></td>
						<td><input type="text" class="form-control" id="hope_type2" name="hope_type2" autocomplete="off" maxlength="20"></td>
					</tr>
					<tr>
						<th>3.</th>
						<td><input type="text" class="form-control" id="hope_area3" name="hope_area3" autocomplete="off" maxlength="20"></td>
						<td><input type="text" class="form-control" id="hope_type3" name="hope_type3" autocomplete="off" maxlength="20"></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer text-right">
				<button type="button" class="btn btn btn-light" data-dismiss="modal"><strong>닫기</strong></button>
				<button type="button" class="btn btn-primary" onclick="request_send();"><strong>신청</strong></button>
			</div>
		</div>
	</div>
</div>

<script>
function request_modal(id, name){
	$('#giftbox_id').val(id);
	$('#gift-name').text(name);
	$('#request-modal').modal('show');
}

function request_send(){
	if( ! $.trim($('#hope_area1').val()) && ! $.trim($('#hope_area2').val()) && ! $.trim($('#hope_area3').val())){
		alert('원하는 지역을 입력해주세요.');
		return false;
	}
	if( ! $.trim($('#hope_type1').val()) && $.trim($('#hope_type2').val()) && $.trim($('#hope_type3').val())){
		alert('원하는 업종을 입력해주세요.');
		return false;
	}
	if(confirm('신청 하시겠습니까?')){
		$.ajax({
			type: 'POST',
			url:'./giftbox_update.php',
			cache:false,
			data:{
				id : $('#giftbox_id').val(),
				hope_area1 : $('#hope_area1').val(),
				hope_area2 : $('#hope_area2').val(),
				hope_area3 : $('#hope_area3').val(),
				hope_type1 : $('#hope_type1').val(),
				hope_type2 : $('#hope_type2').val(),
				hope_type3 : $('#hope_type3').val()
			},
			success:function(result){
				if(result=='sucess'){
					alert('신청되었습니다.');
					location.reload();
				}
			}
		});
	}
}
</script>