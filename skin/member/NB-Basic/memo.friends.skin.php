<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once('./_common.php');

$g5['title'] = '현재접속자';


?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="mb-4">

	<div id="topNav" class="bg-primary text-white">
		<div class="p-3">
			<button type="button" class="close" aria-label="Close" onclick="window.close();">
				<span aria-hidden="true" class="text-white">&times;</span>
			</button>
			<h5><?php echo $g5['title'] ?></h5>
		</div>
	</div>

	<div id="topHeight"></div>

	<nav id="memo_cate" class="sly-tab font-weight-normal mt-3 mb-2">
		<div id="noti_cate_list" class="sly-wrap px-3">
			<ul id="noti_cate_ul" class="clearfix sly-list text-nowrap border-left">
				<li class="float-left<?php echo ($kind == "recv") ? ' active' : '';?>"><a href="./memo.php?kind=recv" class="py-2 px-3">받은쪽지</a></li>
				<li class="float-left<?php echo ($kind == "send") ? ' active' : '';?>"><a href="./memo.php?kind=send" class="py-2 px-3">보낸쪽지</a></li>
                <li class="float-left<?php echo ($kind == "") ? ' active' : '';?>"><a href="./memo_form.php" class="py-2 px-3">쪽지쓰기</a></li>
                
				<li class="float-left<?php echo ($kind == "friends") ? ' active' : '';?>"><a href="./memo_friend.php?kind=friends" class="py-2 px-3">친구관리</a></li>
                <li class="float-left<?php echo ($kind == "online") ? ' active' : '';?>"><a href="./memo_friend.php?kind=online" class="py-2 px-3">현재접속자</a></li>
                
			</ul>
		</div>
		<hr/>
	</nav>

	<div id="memo_info" class="f-de font-weight-normal mb-2 px-3">
		전체 <?php echo $kind_title ?>쪽지 <b> <?php echo $total_count ?></b>통 / <?php echo $page ?>페이지
	</div>

	<div class="w-100 mb-0 bg-primary" style="height:4px;"></div>


<!-- sa fasdf a   list online current  -->
    
	<section id="connect_list" class="mb-4">		
			<div class="na-table d-table w-100 mb-0">
				<div class="<?php echo $head_class ?> d-table-row">
                    <div class="d-table-cell nw-3"></div>
                    <div class="d-table-cell text-left nw-4"><b>아이디</b></div>                  
					<div class="d-table-cell text-left text-sm-center"><b>이 름</b></div>
					<div class="d-table-cell text-left text-sm-center"><b>메 모</b></div>
                    <div class="d-table-cell text-right nw-4 pr-3"><b>접속</b></div>
				</div>
			</div>
<form name="form1" method="post">
		<ul class="na-table d-table w-100">
				<?php
				for ($i=0; $i < count($list); $i++) {
					//$location = conv_content($list[$i]['lo_location'], 0);
					$location = $list[$i]['lo_location'];
					// 최고관리자에게만 허용
					// 이 조건문은 가능한 변경하지 마십시오.
					if ($list[$i]['lo_url'] && $is_admin == 'super') 
						$display_location = "<a href=\"".$list[$i]['lo_url']."\">".$location."</a>";
					else
						$display_location = $location;
				?>
					<li class="d-table-row border-bottom">
                        <div class="d-table-cell text-center nw-3 py-2 py-md-2 f-sm">
                            <span class="sr-only">check</span>
                            <input type="checkbox" class="radio" id="<?php echo $list[$i]['mb_id'] ?>" name="chk_fr_no[<?php echo $list[$i][$i]; ?>]" value="<?php echo $list[$i]['mb_id'] ?>">
						</div>
						<div class="d-table-cell py-2 py-md-2 pr-3">
							<div class="float-sm-left nw-5 nw-auto f-sm">
                                <?php echo $list[$i]['me_mbid'] ?>		
							</div>
							<div class="na-title">
								<div class="na-item">
									<div class="na-subject">
                                    <?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
									</div>
								</div>
							</div>
                        </div>
                        <div class="d-table-cell text-left text-sm-center">
                            <?php  
                                 echo   $list[$i]['me_memo'];
                            ?>	
						</div>
                        <div class="d-table-cell text-center nw-4 py-md-2 f-sm pr-3">
                            <span class="sr-only">접속</span>
                            <?php if ($list[$i]['countd']==1){  
                                 echo '<img src="'.G5_URL.'/img/friend_on.gif" style="border-radius: none;" title="">';                        
                                } else {
                                 echo '<img src="'.G5_URL.'/img/friend_off.gif" style="border-radius: none;" title="">';
                                }
                            ?>
                        </div>
					</li>
				<?php } ?>
        </ul>
        <div class="na-table d-table w-100 mb-0">
				<div class="d-table-row">
                    <div class="d-table-cell nw-4 pl-4 text-left">
                        <?php
                        if ($member['mb_level'] > 16){ // level 17 oos deesh hun haih bolomjtoi
                            if ($kind == 'friends')
                            {
                                echo '<button type="submit" action="" id="btn_submit" class="btn"><b>친구삭제</b></button>';                                
                            }
                            else
                            {
                                echo '<button type="submit" action="" id="btn_submit" class="btn"><b>친구등록</b></button>';
                            }
                        }
                        ?>
                    </div>
				</div>
            </div>
            </form>            
        </br>
        <form name="form1" method="post">
        <table class="tbl_type" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="d-table-cell text-left text-sm-center" >새로운 친구 등록하기</th>
                </tr>
             </thead>
    <tbody>
        <tr class="text-center">
        <td>
        <input type="hidden"  name="fr_type" value="">
        <p class="col-form-label px-2" style="width: 100px; display: inline;">아이디 :</p>
        <input name="find_id" type="text" class="form-control" placeholder="아이디 또는 닉네임 입력하세요" value="<?php if(isset($_POST['find_id']))echo $_POST['find_id'];  ?>"
        style="width: 190px; display: inline;" size="10" required="required" itemname="친구아이디" > 
        <input type="submit" class="btn btn-primary" value="찾기">
        <p class="col-form-label px-2" style="width: 100px; display: inline;">메모 :</p>
        <input name="fr_memo" type="text" class="form-control"  style="width: 150px; display: inline;" itemname="메모" size="24"> 
        <input type="submit" class="btn btn-primary" value="친구등록">
        </td>
    </tr>
</tbody>
</table>
    </section>   
                <?php
                    if ($member['mb_level'] > 16){ // level 17 oos deesh hun haih bolomjtoi

                    if (isset($_POST['find_id']) and count($listfind)>0 ) {
                        
                        echo '                    
                        <div class="na-table d-table w-100 mb-0">
                            <div class="<?php echo $head_class ?> d-table-row">
                                <div class="d-table-cell nw-3"></div>
                                <div class="d-table-cell text-left nw-4"><b>아이디</b></div>                  
                                <div class="d-table-cell text-left text-sm-center"><b>이 름</b></div>
                            </div>
                        </div>
                        <ul class="na-table d-table w-100">
                        ';
                        for ($i=0; $i < count($listfind); $i++) {
                        ?>

                            <li class="d-table-row border-bottom">
                                <div class="d-table-cell text-center nw-3 py-2 py-md-2 f-sm">
                                    <span class="sr-only">check</span>
                                    <input type="checkbox" class="radio" onclick="onlyOne(this)"  name="finds_friend[<?php echo $listfind[$i][$i]?>]" value="<?php echo $listfind[$i]['mb_id'] ?>">
                                </div>
                                <div class="d-table-cell py-2 py-md-2 pr-3">
                                    <div class="float-sm-left nw-5 nw-auto f-sm">
                                        <?php echo $listfind[$i]['mb_id'] ?>	
                                    </div>
                                    <div class="na-title">
                                        <div class="na-item">
                                            <div class="na-subject">
                                                <?php echo na_name_photo($listfind[$i]['mb_id'], $listfind[$i]['name']) ?>
                                            </div>
                                        </div>
                                    </div>     
                                </div>    
                                <div class="d-table-cell py-2 py-md-2 pr-3">                                  
                                    <div class="na-title">
                                        <div class="na-item">
                                            <div class="na-subject">
                                            <?php echo  $listfind[$i]['mb_nick']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                            </li>
                        <?php                             
                        }
                    echo "</ul>";
                    } else if (isset($_POST['find_id']))  {
                       echo '아이디를 찾을 수 없습니다';
                    }
                } else if (isset($_POST['find_id']))  {
                    echo '레벨 17 이상 친구 등록 가능합니다';
                 }
                ?>        
        </form>
    <div class="font-weight-normal px-3 mt-4">
		<ul class="pagination justify-content-center en mb-0">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./memo.php?kind=$kind".$qstr."&amp;page=") ?>
		</ul>
    </div>  
</div>
<script>
function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('chk_fr_no')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

$(window).on('load', function () {
	na_nav('topNav', 'topHeight', 'fixed-top');
});
</script>