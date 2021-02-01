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
    <div style="float: left; width: 25%;">
        <ul class="coupon">
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
    <div id="coupon_list" style="float: left; width: 75%;"></div>
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

        function load_coupon_page(param){        
            $.ajax({
            url:"coupon_list_page.php",
            method: "POST",
            data: {id:param },
            success: function(data){
                $('#coupon_list').html(data);
                }
            });  
        } 

        load_coupon_page(param);

    });
</script>

<?php
include_once('./admin.tail.php');
?>