<?php
$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if(isset($_POST['mb_id'])){
   $mb_id = $_POST['mb_id'];
}

$sql = "SELECT * FROM `g5_member` WHERE mb_id = '{$mb_id}'";
$row = sql_fetch($sql);

$start_date = substr($row['mb_4'], 0, 10);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>
<style>
    .ui-datepicker {display: block;}
</style>

<script>
    $(function(){
        //$("#to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
        $("#to_date").datepicker();
        $("#to_date").datepicker("setDate", new Date);
        $("#datepicker").datepicker('show');
    });
</script>

<?php
               
$response =                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button><div><span style="width:100px; margin-left: 30px;">업소명</span><span style="width:150px; margin-left: 20px;">['.$row['mb_name'].'] '.$row['mb_2'].'</span></div>
                            <div>
                                <span style="width:100px; margin-left: 30px;">
                                    제휴기간
                                </span>
                                <span style="width:150px; margin-left: 20px;">
                                    <input type="text" name="fr_date" value="'.$start_date.'" style="border: none;">
                                    <input type="text" name="mb_4" value="'.$to_date.'" id="to_date" style="border: none;">
                                </span>
                            </div>
                            <p style="text-align: center;">* 제휴종료일 변경</p>               
                            <textarea rows="4" cols="50" name="mb_5 value""></textarea>';
echo $response;

?>