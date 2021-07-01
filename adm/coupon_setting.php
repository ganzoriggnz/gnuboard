<?php
$sub_menu = "700500";
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');
$g5['title'] = "쿠폰지원 업소 설정";
include_once('./admin.head.php');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_setting_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['coupon_setting_table']} (   
        bo_no int(11) NOT NULL AUTO_INCREMENT, 
        bo_table varchar(255) NOT NULL DEFAULT '',
        bo_free int(11) NOT NULL DEFAULT '0',        
        bo_sale int(11) NOT NULL DEFAULT '0',
        bo_total int(20) NOT NULL DEFAULT '0',
        bo_created_datetime datetime DEFAULT NULL,
        bo_updated_datetime datetime DEFAULT NULL,
        PRIMARY KEY (bo_no)
    )";
   sql_query($sql_table, false);
}

$sql_cnt = "SELECT COUNT(*) as cnt FROM {$g5['coupon_setting_table']}";
$row =sql_fetch($sql_cnt);
if($row['cnt'] =='0'){
$sql_ins = "INSERT INTO {$g5['coupon_setting_table']} (`bo_no`,`bo_table`,`bo_free`,`bo_sale`,`bo_total`,`bo_created_datetime`,`bo_updated_datetime`) 
VALUES 
    (1,'opigangnam_at',0,0,0,NULL,NULL),
    (2,'opibigangnam_at',0,0,0,NULL,NULL),
    (3,'opigyeonggi_at',0,0,0,NULL,NULL),
    (4,'opiinchon_at',0,0,0,NULL,NULL),
    (5,'opidaejeon_at',0,0,0,NULL,NULL),
    (6,'opigyeongsang_at',0,0,0,NULL,NULL),
    (7,'opidaegu_at',0,0,0,NULL,NULL),
    (8,'opijeju_at',0,0,0,NULL,NULL),
    (9,'hyugetelseoul_at',0,0,0,NULL,NULL),
    (10,'hyugetelkyonggi_at',0,0,0,NULL,NULL),
    (11,'hyugetelinchon_at',0,0,0,NULL,NULL),
    (12,'hyugeteldaejeon_at',0,0,0,NULL,NULL),
    (13,'hyugeteljeju_at',0,0,0,NULL,NULL),
    (14,'gonmaseoul_at',0,0,0,NULL,NULL),
    (15,'gonmakyonggi_at',0,0,0,NULL,NULL),
    (16,'gonmainchonbuchon_at',0,0,0,NULL,NULL),
    (17,'gunmatechon_at',0,0,0,NULL,NULL),
    (18,'gonmajeju_at',0,0,0,NULL,NULL),
    (19,'suljibseoul_at',0,0,0,NULL,NULL),
    (20,'suljibchiban_at',0,0,0,NULL,NULL),
    (21,'anmaseoul_at',0,0,0,NULL,NULL),
    (22,'anmachiban_at',0,0,0,NULL,NULL),
    (23,'chuljanall_at',0,0,0,NULL,NULL),
    (24,'kissall_at',0,0,0,NULL,NULL),
    (25,'lipcafeall_at',0,0,0,NULL,NULL),
    (26,'show_at',0,0,0,NULL,NULL),
    (27,'other_at',0,0,0,NULL,NULL)";
sql_query($sql_ins);
}

$now = G5_TIME_YMDHIS;
$currentyear = substr($now, 0, 4);
$currentmonth = substr($now, 5, 2);
$co_start = date_create($now);
$co_begin_datetime = date_format($co_start, 'Y-m-01 00:00:00');
$co_end_datetime = get_end_datetime($co_start,$currentyear,$currentmonth);

if($w == 'u'){
    if($row['bo_created_datetime']=='')
    $bo_created = G5_TIME_YMDHIS;
    else $bo_created = $row['bo_created_datetime'];
    $bo_updated = G5_TIME_YMDHIS;

    $sql = "UPDATE {$g5['coupon_setting_table']}
              SET bo_free = '{$_POST['bo_free']}',
                  bo_sale = '{$_POST['bo_sale']}',
                  bo_total = '{$_POST['bo_total']}',
                  bo_created_datetime = '{$bo_created}',
                  bo_updated_datetime = '{$bo_updated}'
              WHERE bo_table = '{$_POST['bo_table']}'";                
    sql_query($sql);
    /* $result = "SELECT * FROM {$g5['coupon_table']} WHERE bo_table = '{$_POST['bo_table']}' AND co_begin_datetime='$co_begin_datetime' ";
    while($row = sql_fetch_array($result)){
        if(($row['co_sale_num'] >= $_POST['bo_sale']) || ($_POST['bo_sale'] >= $row['co_sale_num'] && $_POST['bo_sale'] >= $row['co_sent_snum'])){
            $sql1 = "UPDATE {$g5['coupon_table']}
                SET co_sale_num = '{$_POST['bo_sale']}',
                    co_updated_datetime = '{$bo_updated}'
                WHERE bo_table = '{$_POST['bo_table']}' AND co_begin_datetime='$co_begin_datetime'";                
            sql_query($sql1);
        } 
        if(($row['co_free_num'] >= $_POST['bo_free']) || ($_POST['bo_free'] >= $row['co_free_num'] && $_POST['bo_free'] >= $row['co_sent_fnum'])){
            $sql2 = "UPDATE {$g5['coupon_table']}
                SET co_free_num = '{$_POST['bo_free']}',
                    co_updated_datetime = '{$bo_updated}'
                WHERE bo_table = '{$_POST['bo_table']}' AND co_begin_datetime='$co_begin_datetime'";                
                sql_query($sql2);           
        }
    } */
    //goto_url($PHP_SELF, false); 
    goto_url(G5_ADMIN_URL.'/coupon_setting.php?bo_table='.$_POST['bo_table']); 
  
  }
?>

<div style="height: 800px;">
    <div style="float: left; width: 20%;">
        <ul class="coupon">
            <?php 
                $q = "SELECT bo_table, bo_subject FROM ".$g5['board_table']." WHERE gr_id = 'review' ORDER BY bo_order ASC ";
                $q_result = sql_query($q);
                while($row = sql_fetch_array($q_result)) { ?>
                    <li style="padding: 5px 0px;"><a id = "<?php echo $row['bo_table']; ?>" href="<?php echo G5_ADMIN_URL.'/coupon_setting.php?bo_table='.$row['bo_table'];?>"><img src="<?php echo G5_URL ?>/img/solid/commenting-o.svg" style="height: 14px; margin-right: 3.5px;"><?php echo $row['bo_subject']; ?></a></li>
            <?php
                } 
            ?>
        </ul>
    </div>
    <div id="coupon_setting" style="float: left; width: 80%;"></div>
</div>
<script>
  $(document).ready(function(){
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null) {
            return null;
            }
            return decodeURI(results[1]) || 0;
        }
        var param = $.urlParam('bo_table');
        $('#'+param).css("color", "#435ffe");
        $('#'+param).css("font-weight", "bold");
        load_coupon_setting(param);       
 });

    function load_coupon_setting(param){ 
        $.ajax({
        url:"coupon_list_setting.php",
        method: "POST",
        data: {id:param },
        success: function(data){
            $('#coupon_setting').html(data);    
            }
        });
    } 
</script>

<?php
include_once('./admin.tail.php');
?>