 <!-- hulan nemsen 유챗 연동 -->
            
 <?php
            include_once("_common.php");
        if($member['mb_level'] >= 6) { // 레벨 6 이상 입장 가능
            
            if (!function_exists('uchat_array2data')) {
                function uchat_array2data($arr)
                {
                    $arr['time'] = time();
                    ksort($arr);
                    $arr = array_filter($arr);
                    $arr['hash'] = md5(implode($arr['token'], $arr));
                    unset($arr['token']);
                    foreach ($arr as $k => &$v) {
                        $v = $k . ' ' . urlencode($v);
                    }
                    return implode("|", $arr);
                }
            }
            $joinData = array();
            $joinData['room'] = 'Empire';
            $joinData['token'] = 'ddf0afc2391ac3e60ad646822b83441c';

            $joinData['nick'] = $member['mb_nick'];
            $joinData['id'] = $member['mb_id'];
            $joinData['level'] = $member['mb_level'];;
            $joinData['auth'] = $is_admin?"admin":""; // (admin, subadmin, member, guest)중 하나선택, 미선택시 자동(권장)
            $joinData['icons'] = $아이콘주소변수;
            if($is_member) {

                $uicon_file = "/eyoom/core/member/".substr($member['mb_id'],0,2)."/".$member['mb_id'].".gif";
            
                if(file_exists((G5_PATH?G5_PATH:$g4['path']).$uicon_file))
            
                    $joinData['icons'] = $uicon_file;
            
            }
            //$joinData['nickcon'] = $닉콘주소변수;
            //$joinData['other'] = '';
            ?>
            <script async src="//client.uchat.io/uchat.js"></script>
            <u-chat room='<?php echo $joinData['room']; ?>' user_data='<?php echo uchat_array2data($joinData); ?>' style="display:inline-block; width:100%; height:100%;"></u-chat>
       <?php     }
            else echo "채팅방 입장 권한 없습니다 " ; ?>
          <!--   //////////////////////////////////////////////////////////////// -->