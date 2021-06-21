<?php
$sub_menu = "700100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = "쿠폰지원목록";
include_once('./admin.head.php');

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['coupon_table']} (   
        co_no int(11) NOT NULL AUTO_INCREMENT,
        wr_id int(11) NOT NULL DEFAULT '0',         
        mb_id varchar(20) NOT NULL DEFAULT '',
        bo_table varchar(20) NOT NULL DEFAULT '',
        co_entity varchar(20) NOT NULL DEFAULT '',
        co_sale_num int(11) NOT NULL DEFAULT '0',
        co_free_num int(11) NOT NULL DEFAULT '0',
        co_sent_snum int(11) NOT NULL DEFAULT '0',
        co_sent_fnum int(11) NOT NULL DEFAULT '0',
        co_created_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_updated_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_begin_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        co_end_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (co_no), 
        INDEX (mb_id, wr_id, bo_table, co_entity)
    )";

   sql_query($sql_table, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table = "CREATE TABLE {$g5['coupon_table']} (   
        co_no int(11) NOT NULL AUTO_INCREMENT, 
        wr_id int(11) NOT NULL DEFAULT '0',        
        mb_id varchar(20) NOT NULL DEFAULT '',
        bo_table varchar(20) NOT NULL DEFAULT '',
        co_entity varchar(20) NOT NULL DEFAULT '',
        co_sale_num int(11) NOT NULL DEFAULT '0',
        co_free_num int(11) NOT NULL DEFAULT '0',
        co_sent_snum int(11) NOT NULL DEFAULT '0',
        co_sent_fnum int(11) NOT NULL DEFAULT '0',
        co_created_datetime datetime DEFAULT NULL,
        co_updated_datetime datetime DEFAULT NULL,
        co_begin_datetime datetime DEFAULT NULL,
        co_end_datetime datetime DEFAULT NULL,
        PRIMARY KEY (co_no), 
        INDEX (mb_id, wr_id, bo_table, co_entity)
    )";

   sql_query($sql_table, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_sent_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table1 = "CREATE TABLE {$g5['coupon_sent_table']} (
        cos_no int(11) NOT NULL AUTO_INCREMENT,
        co_no int(11) NOT NULL,   
        cos_code varchar(4) NOT NULL,
        mb_id  varchar(20) NOT NULL DEFAULT '', 
        cos_entity varchar(20) NOT NULL DEFAULT '',
        cos_id  varchar(20) NOT NULL DEFAULT '',
        cos_nick varchar(20) NOT NULL DEFAULT '',
        cos_type varchar(1) NOT NULL DEFAULT '',
        cos_accept varchar(1) NOT NULL DEFAULT 'N',
        cos_alt_quantity int(11) NOT NULL DEFAULT '0',
        cos_created_datetime datetime DEFAULT NULL,
        cos_accepted_datetime datetime DEFAULT NULL,
        cos_post_datetime datetime DEFAULT NULL,
        UNIQUE (cos_code),
        PRIMARY KEY (cos_no),
        INDEX (co_no, mb_id, cos_code, cos_entity, cos_nick)
    )";

   sql_query($sql_table1, false);
} 

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_alert_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table2 = "CREATE TABLE {$g5['coupon_alert_table']} (
        alt_no int(11) NOT NULL AUTO_INCREMENT, 
        cos_no int(11) NOT NULL DEFAULT '0',
        cos_id varchar(20) NOT NULL DEFAULT '',
        cos_nick varchar(20) NOT NULL DEFAULT '',
        mb_id varchar(20) NOT NULL DEFAULT '',
        cos_entity varchar(20) NOT NULL DEFAULT '',             
        cos_alt_quantity int(11) NOT NULL DEFAULT '0',
        alt_reason varchar(20) NOT NULL DEFAULT '',
        alt_created_by varchar(20) NOT NULL DEFAULT '',
        alt_created_datetime datetime DEFAULT NULL,
        PRIMARY KEY (alt_no),
        INDEX (mb_id, cos_nick, cos_entity)
    )";

   sql_query($sql_table2, false);
}

if (!sql_query("SELECT COUNT(*) as cnt FROM {$g5['coupon_msg_table']}",false)) { // 쿠폰 테이블이 없다면 생성
    $sql_table3 = "CREATE TABLE {$g5['coupon_msg_table']} (
        msg_no int(11) NOT NULL AUTO_INCREMENT, 
        msg_customer_text text(255) NOT NULL DEFAULT '',  
        msg_entity_text text(255) NOT NULL DEFAULT '', 
        msg_customer_title text(255) NOT NULL DEFAULT '',  
        msg_entity_title text(255) NOT NULL DEFAULT '',           
        msg_created_datetime datetime DEFAULT NULL,
        PRIMARY KEY (msg_no),
        INDEX (msg_created_datetime)
    )";

   sql_query($sql_table3, false);
}

?>
<style>
    .active {color: red;}

    a:active  { background-color: yellow;  }
</style>
<div style="height: 800px;">
    <div style="float: left; width: 18%;">
        <div>
            <button class="btn btn_02" id="coupon" onclick="load_coupon_page('<?php echo $bo_table ?>')">쿠폰제휴업소</button>
            <button class="btn btn_03 all" id="all" onclick="load_coupon_page1('<?php echo $bo_table ?>')" style="margin-left: 5px;">전체제휴업소</button>
        </div>
        <ul class="coupon" style="margin-top: 20px;">
            <?php 
                $q = "SELECT bo_table, bo_subject FROM ".$g5['board_table']." WHERE gr_id = 'review' ORDER BY bo_order ASC ";
                $q_result = sql_query($q);
                while($row = sql_fetch_array($q_result)) { ?>
                    <li style="padding: 5px 0px;"><a id = "<?php echo $row['bo_table']; ?>" href="<?php echo G5_ADMIN_URL.'/coupon_list.php?bo_table='.$row['bo_table'];?>"><img src="<?php echo G5_URL ?>/img/solid/commenting-o.svg" style="height: 14px; margin-right: 3.5px;"><?php echo $row['bo_subject']; ?></a></li>
            <?php
                } 
            ?>
        </ul>
    </div>
    <div id="coupon_list" style="float: left; width: 82%;"></div>
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
        if( $('#all').attr('class') == "btn btn_03 all")
        load_coupon_page1(param);
        else if( $('#coupon').attr('class') == "btn btn_03 coupon")
        load_coupon_page(param);
        
 });

    function load_coupon_page(param){ 
        $.ajax({
        url:"coupon_list_page.php",
        method: "POST",
        data: {id:param },
        success: function(data){
            $('#coupon_list').html(data);    
            $('#all').removeClass("btn_03 all");
            $('#all').addClass("btn_02"); 
            $('#coupon').removeClass("btn_02");
            $('#coupon').addClass("btn_03 coupon");

                }
            });
    } 

    function load_coupon_page1(param){ 
        $.ajax({ 
        url:"coupon_list_page_all.php",
        method: "POST",
        data: {id:param },
        success: function(data){
            $('#coupon_list').html(data);    
            $('#coupon').removeClass("btn_03 coupon");
            $('#coupon').addClass("btn_02");
            $('#all').removeClass('btn_02');
            $('#all').addClass('btn_03 all'); 
            }
        });       
    } 
</script>

<?php
include_once('./admin.tail.php');
?>