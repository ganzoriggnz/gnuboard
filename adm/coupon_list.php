<?php
$sub_menu = "700100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = "쿠폰지원목록";
include_once('./admin.head.php');

?>
<style>
    .active {
        color: red;
    }

    a:active  {     background-color: yellow;  }
</style>
<div style="height: 740px;">
    <div style="float: left; width: 18%;">
        <div>
            <input type="hidden" name="tuluw" id="tuluw" value="list">
            <button class="btn btn_02" id="coupon" onclick="load_coupon_page('<?php echo $bo_table ?>')">쿠폰제휴업소</button>
            <button class="btn btn_02" id="all" onclick="load_coupon_page1('<?php echo $bo_table ?>')" style="margin-left: 5px;">전체제휴업소</button>
        </div>
        <ul class="coupon" style="margin-top: 20px;">
            <?php 
                $q = "SELECT bo_table, bo_subject FROM ".$g5['board_table']." WHERE gr_id = 'review' ORDER BY bo_subject ASC ";
                $q_result = sql_query($q);
                while($row = sql_fetch_array($q_result)) { ?>
                    <li style="padding: 5px 0px;"><a id = "<?php echo $row['bo_table']; ?>" href="<?php echo G5_ADMIN_URL.'/coupon_list.php?bo_table='.$row['bo_table'];?>"><img src="<?php echo G5_URL ?>/img/solid/calendar.svg" style="height: 14px; margin-right: 3.5px;"><?php echo $row['bo_subject']; ?></a></li>
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
        load_coupon_page(param);
        
 });

    function load_coupon_page(param){ 
        if( $('#tuluw').val() == "list"){     
        $.ajax({
        url:"coupon_list_page.php",
        method: "POST",
        data: {id:param },
        success: function(data){
            $('#coupon_list').html(data);    
            $('#tuluw').val('all');
            $('#all').removeClass("btn_03");
            $('#all').addClass("btn_02"); 
            $('#coupon').removeClass("btn_02");
            $('#coupon').addClass("btn_03");

                }
            });
        }  
    } 

    function load_coupon_page1(param){ 
        if( $('#tuluw').val() == "all"){
        $.ajax({ 
        url:"coupon_list_page_all.php",
        method: "POST",
        data: {id:param },
        success: function(data){
            $('#coupon_list').html(data);    
            $('#tuluw').val('list');
            $('#coupon').removeClass("btn_03");
            $('#coupon').addClass("btn_02");
            $('#all').removeClass('btn_02');
            $('#all').addClass('btn_03'); 
            }
        });
        }          
    } 
</script>

<?php
include_once('./admin.tail.php');
?>