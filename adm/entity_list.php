<?php
$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$g5['title'] = "후기미작성자";
include_once('./admin.head.php');

?>

<!-- 밑에 add_stylesheet 함수를 사용하지 않는이유은 가끔 홈페이지 개발시 오류로 add_stylesheet 함수가 먹지 않는 현상으로 인해 사용하지 않습니다. -->
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/daygrid/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/timegrid/main.css" rel="stylesheet" />
<link href="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/list/main.css" rel="stylesheet" />
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/ko.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/core/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/interaction/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/daygrid/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/timegrid/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/fullcalendar/packages/list/main.js"></script>
<script src="<?php echo G5_ADMIN_URL;?>/wz.js/bootstrapmodal.min.js"></script>
<link href="<?php echo G5_ADMIN_URL;?>/css/wzappend.css" rel="stylesheet" />

<style>
.closeon {
  float: right;
  padding: 0px 2px 4px 4px;
}

.nav > .active {
    background-color: chartreuse; **//THIS WORKS**
}
.nav > .active a{
  color : aqua
}
.nav-item > a:hover {
    color : aqua!important;
}

.nav li{
  list-style:none;
}

.modal.fade .modal-dialog {
   -webkit-transform: none;
   transform: none;
 }

 /* a:link, a:visited {
     color: #fff;
 } */ 

 .active {
     color: red;
 }
</style>

<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'ko';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        defaultDate: '<?php echo G5_TIME_YMD?>',
        locale: initialLocaleCode,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
       eventRender: function(event, eventElement) {
                /* eventElement.find("td.fc-event-container").append("<span class='sv_wrap'>");  */
            /* info.el.querySelector('.fc-time').innerHTML = ""; */
            //info.el.querySelector('.fc-title').innerHTML = "<i>" + info.event.title + `</li><div id="links" class="${info.event.extendedProps.mb_id}popUp"></div>`;
            // info.el.append(`<div id=${info.el.extendedProps.mb_id}></div>`)
            // var e = info.el.append("<span class='closeon'>&#10005;</span>");
        }, 
        events: {
            url: 'entity_load.php',
            error: function() {
                $('#script-warning').show();
            }
		},
		eventClick: function(info){
			var eventObj = info.event;
			var id = eventObj.id;
			var title  = eventObj.title;
            var end = eventObj.end;
            var mb_id  = eventObj.extendedProps.mb_id;
			var mb_name  = eventObj.extendedProps.mb_name;
            var mb_note  = eventObj.extendedProps.mb_note;
            
            $.ajax({
                url: 'entity_links.php',
                type: 'POST',
                data: {mb_id: mb_id},
                success: function(response){ 
                /* $(`.${mb_id}popUp`).html(response);
                $('#links').html(response); */
                $('#entitylinkModal .modal-body').html(response);
					$('#entitylinkModal').modal(); 
                }               
            }); 		
        },
        loading: function(bool) {
            $('#loading').toggle(bool);
		}		
    });
    calendar.render();
});

$('body').on('click', '.entity-modal', function() {
    $('#entityextendModal').modal('show');  
        $("#datepicker").datepicker({
          dateFormat: 'yy-mm-dd',
          onSelect: function(date, obj){
              $('#to_date').val(date);  
          }
        });  
  
}); 

$(document).ready(function(){
    /* $("ul.nav > li").click(function (e) { 
    $("ul.nav > li").removeClass("active"); 
    $(this).addClass("active"); 
    $(this).css('color', 'red');
    });  */

    $('.nav li a').click(function(e) {
        $('.nav li.active').removeClass('active');
        var $parent = $(this).parent();
        $parent.addClass('active');
        e.preventDefault();
        }); 
});

    

</script>

<?php 
if($w == 'u'){
	$mb_id = $_POST['mb_id'];
	$mb_name = $_POST['mb_name'];
    $mb_start_date = $_POST['fr_date'];
    $mb_end_date = $_POST['mb_4'];
    $mb_note = $_POST['mb_5'];

	$sql = "UPDATE {$g5['member_table']} 
				SET mb_4 = '{$mb_end_date}',
                    mb_5 = '{$mb_note}'
				WHERE mb_id='{$mb_id}'";

	sql_query($sql);
	goto_url($PHP_SELF, false);
}

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>
	<div id="calendar">

        <div class="modal fade" id="entitylinkModal" tabindex="-1" role="dialog" style="position: fixed; top: 10%; left: 0%;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 135px; height: 230px;">
                        <div class="modal-header" style="border-bottom: none; height: 20px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button> 
                        </div>  	
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>	
        </div>
		
    </div>
    
	
<?php
include_once('./admin.tail.php');
?>