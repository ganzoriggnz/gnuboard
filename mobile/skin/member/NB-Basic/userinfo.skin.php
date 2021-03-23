<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<style>
.d-flex {
    font-size: 12px;
}

#user_cate_ul li a {
    padding: 2px 5px 2px 5px;
}
</style>
<div id="bo_v">
    <?php
    $userinfo = "actived";
    include 'infotab.php';?>
    <section class="xm">
        <table cellspacing="0" class=" px-3 mr-3" cellpadding="0" width="100%" style="font-size: 12px; padding:5px;"
            id="level-up">
            <thead>
                <tr style="font-size: 12px; ">
                    <th class="cl_tr pr-2"  style="width:100px; text-align: right;" ><label class="col-form-label" for="reg_mb_nick">기본정보</label></th>
                    <th class="cl_tr"><?php 
                            echo get_level($member['mb_id'])."&nbsp;"; echo $member['mb_nick']."(".$member['mb_id'].")"; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr style=" font-size: 12px">
                    <td class="cl_tr  pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">프로필 사진</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <a href="#" target="_blank" class="win_memo" title="사진등록">
                            <div class="photo pull-left"><?php echo "<img src='".na_member_photo($member['mb_id'])."' style='border-radius:50%;'' />" ?></div>
                        </a>
                    </td>
                </tr>
                <?php $now = G5_TIME_YMDHIS;
              $finish_date = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($member['mb_4'])));  ?>
                <?php if( $member['mb_level'] == 27 || ($member['mb_level'] == '26' && $finish_date >= $now))
        { ?>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">출근부</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php
                        $g5['connect_db'];
                        $result = sql_query("select bo_table from {$g5['board_table']} where gr_id='attendance'");
                        while ( $row=sql_fetch_array($result))
                        {
                            $bo_table = $row['bo_table'];                            
                            $res = sql_fetch("select wr_id from ".$g5['write_prefix'].$bo_table." where mb_id='{$member['mb_id']}'");                            
                            if($res){ ?>
                        <?php if(defined('_INDEX_')) {?>
                        <a href="./bbs/write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page="
                            style="color: #BFAF88;">
                            <font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font>
                        </a>
                        <?php break;}
                                else{?>
                        <a href="./write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$res['wr_id']?>&page="
                            style="color: #BFAF88;">
                            <font color="blue"><b><i class="fa fa-pencil-square-o"></i> 업소정보 수정</b></font>
                        </a>
                        <?php break;} ?>
                        <?php }
                            } ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if($member['mb_level'] == 27)
                    { ?>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">쿠폰</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <a href="<?php echo G5_BBS_URL ?>/coupon_create.php">
                            <font color="blue"><b><i class="fa fa-cubes"></i> <span class="hidden-xs">쿠폰</span></b>
                            </font>
                        </a>
                    </td>
                </tr>
                <?php } 
                if( $member['mb_level'] == 26 || $member['mb_level'] == 27)
                    { ?>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;" ><label class="col-form-label" for="reg_mb_nick">지역-업종</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php echo $str_arr[0]." - ".$type; ?> </td>
                </tr>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">제휴기간</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php echo $start_date." ~ ".$end_date.' - [';?><span
                            style="color: blue;"><?php echo $diff_days.'일 남음';?></span>] </td>
                </tr>
               
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  valign="top" style="text-align: right; "><label class="col-form-label" for="reg_mb_nick">연락처</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php if($member['mb_hp']) {echo $member['mb_hp']; }?> &nbsp; <a class="btn" href="<?php echo G5_URL ?>/bbs/member_hp_change.php?mb_id=<?php echo $member['mb_id'] ?>"
                            target="_blank" style="color:#000; font-size:11px; background-color:#efefef; padding:3px; border:1px solid #696969; border-radius:5px; text-decoration:none">
                            <font style="vertical-align: inherit;">전화번호 변경요청 </font>
                        </a> <br /> 

                         <font style='color: red;'>※ 전화번호는 운영자가 확인 후 변경처리됩니다.</font><br />                   
                        프로필과 배너에 출력되니 항상 최신번호로 유지해주세요
                        
                    </td>
                </tr>
                <?php } ?>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">가입일</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php echo $entity_date;?></td>
                </tr>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">최근 로그인</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        <?php echo $today_login;?></td>
                </tr>
                <!-- user 서명     -->
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"><label class="col-form-label" for="reg_mb_nick">서명</label></td>
                    <td class="cl_tr" style="text-align: left;">
                        …</td>
                </tr>
                <tr style=" font-size: 12px">
                    <td class="cl_tr pr-2"  style="text-align: right;"></td>
                    <td class="cl_tr" style="text-align: left;">
                        <a class="btn" href="<?php echo G5_URL ?>/bbs/member_confirm.php?url=register_form.php"
                            style="color:#000;background-color:#efefef; font-size:11px; padding:5px; border:1px solid #696969; border-radius:5px; text-decoration:none">회원정보변경</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>