<?php
$sub_menu = "700100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = "쿠폰지원목록";
include_once('./admin.head.php');

?>

<div style="height: 800px;">
    <div style="float: left; width: 25%;">
        <ul class="coupon">
            <?php 
                $q = "SELECT bo_table, bo_subject FROM ".$g5['board_table']." WHERE gr_id = 'attendance' ORDER BY bo_subject ASC ";
                $q_result = sql_query($q);
                while($row = sql_fetch_array($q_result)) { ?>
                    <li id = "<?php echo $row['bo_table']; ?>" style="padding: 5px 0px;"><a><img src="<?php echo G5_URL ?>/img/baseline-event-24px.png" style="margin-right: 3.5px;"><?php echo $row['bo_subject']; ?></a></li>
            <?php
                } 
            ?>
        </ul>
    </div>
    <div id="coupon_list" style="float: left; width: 75%;"></div>
</div>
<script>
    $(document).ready(function(){
        function load_coupon_page(id){
            $.ajax({
            url:"coupon_list_page.php",
            method: "POST",
            data: {id:id},
            success: function(data){
                $('#coupon_list').html(data);
                }
            });  
        }
      
      load_coupon_page('gunmaTechon_at');

      $('.coupon li').click(function(){
          $(this).parent().addClass('on').siblings().removeClass('on');
          var bo_table = $(this).attr('id');
          load_coupon_page(bo_table);
      });

    });
</script>

<?php
include_once('./admin.tail.php');
?>