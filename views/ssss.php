<?php
include 'header.php';
$data = resultAssociate("
                  SELECT sa.*,sed.start_date,sed.end_date,sed.id as main_id
                  FROM  `nfw_app_set_appointment` as sa 
                  join nfw_app_start_end_date as sed 
                  on sa.id = sed.nfw_set_appointment_id");
?>
<link href="../assets/testcalendar/css/animate.min.css" rel="stylesheet" />
<link href="../assets/testcalendar/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />



<link href="../assets/testcalendar/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />

<style>
    .calendar {     
        background:white !important; 
    }
    table tr td:first-child, table tr th:first-child {
        border-left: 1px solid #D3D3D3; 
        border-top: 1px solid #D3D3D3; 
    }

    table td, table th {

        border: none ; 
    }
    table tr td:last-child, table tr th:last-child {
        border-right: 1px solid #D3D3D3; 

    }
    table tr:last-child td {
        border-bottom:  1px solid #D3D3D3; 
        border-top:  1px solid #D3D3D3; 

    }
    .fc-event-title{
        font-weight: 300  ;
        font-size: 24px;
    }

    .fc-event-title small{
        font-weight: 400  ;
        font-size: 12px;
    }
    .fc-event {
        border: 1px solid #fff;
        background-color: #E8E6E6;
        color: #000;
        font-size: .85em;
        cursor: default;
        padding: 0px 10px;
    }
    .fc-header-left{
        padding: 10px !important;
    }
    .fc-header-title h2 {
        margin-top: 0;
        white-space: nowrap;
        font-family: lato;
        font-weight: 300;
    }
    .make_appointment{
        background: red;
        color: white;
        border: 1px solid red;
        margin-bottom: 5px;
    }
    .set_appointment{
        background: red;
        color:white
    }
    #calendar{
        color:black;
    }

    .fc-today {
        background: #FFFFFF;
        color: red;

        font-size: 25px;
    }

    .fc-state-default.fc-corner-right {

        text-transform: capitalize;
    }

</style>


<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="index.php" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-calendar"></i>&nbsp;&nbsp;   Make your appointment Schedule&nbsp;&nbsp;


                </a>
            </li>

        </ul>
    </div>
</section>








<div class="section_offset" style="    padding: 30px 0 67px;">
    <div class="container clearfix">
        <div class="row page_block">
            <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30" style="margin-bottom: 20px;">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Tour Schedule</h3>


            </section>

            <table class="table table-borderd">
                <tr style="    background-color: #000;
                    color: #fff;">
                    <th style="width: 150px">Country</th>
                    <th style="width: 150px">City</th>
                    <th style="">Hotel Name</th>
                    <th style="width: 300px">From Date - To Date</th>
                    <th style="width: 200px"></th>

                </tr>
                <?php
                foreach ($data as $key => $value) {
                    ?>
                    <tr>
                        <td>

                            <?php echo $value['country']; ?>
                        </td>
                        <td>
                            <?php echo $value['city']; ?><br/>  <?php echo $value['state']; ?>
                        </td>

                        <td>
                            <b>
                                <i class="fa fa-building-o"></i>
                                <span style="line-height: 14px;"> <?php echo $value['location']; ?></span>
                            </b>
                            <br/>
                            <small>
                                <?php echo $value['address']; ?>
                            </small>
                        </td>
                        <td>
                            <i class="fa fa-calendar"></i>
                            <b><?php
                                $date = date_create($value['start_date']);
                                echo date_format($date, "d F");
                                ?></b> <small>-</small> <b><?php
                                $date = date_create($value['end_date']);
                                echo date_format($date, "d F-Y");
                                ?></b>
                                <br/>
                                <br/>
                                <button class="btn btn-danger" style="background: black">
                                    Book Now
                                </button>
                        </td>
                        <td>

                            <iframe  frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'  height="100px" width="300px"  src="http://maps.google.com/?q=<?php echo $value['location']; ?>+<?php echo $value['address']; ?>&output=embed">
                            </iframe>  

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <!--<div id="calendar" class="calendar"></div>-->
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<!-- Modal -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">

    <div class = "modal-dialog">
        <div class = "modal-content">
            <form method="post">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                        &times;
                    </button>

                    <p class = "modal-title" id = "myModalLabel">
                        <i class="fa fa-edit"></i> Set Appointment
                    </p>
                </div>

                <div class = "modal-body">
                    <input type="hidden" name="app_id">
                    <div class="col-md-4" style="border-right:1px solid #D3D3D3;">
                        <address>
                            <b><span id="start_date"></span>-<span id="end_date"></span></b><br>
                            <strong id="title"></strong><br>
                            <span id="location"></span><br>
                            <span id="address1"></span><br>
                            <span id="address2"></span><br>
                            <span id="city"></span><span id="state"></span><br>
                            <b><span id="start_time"></span>-<span id="end_time"></span></b>
                        </address>


                    </div>
                    <div class="col-md-8">
                        <div class = "form-group">
                            <label for = "name">Select Time</label>
                            <select name="time_option" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>

                <div class = "modal-footer">


                    <button type = "submit" name="submit" class = "btn btn-default btn-xs">
                        Submit changes
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<!-- ================== BEGIN BASE JS ================== -->

<script src="../assets/testcalendar/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<!--<script src="../assets/testcalendar/plugins/bootstrap/js/bootstrap.min.js"></script>-->


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="../assets/testcalendar/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="../assets/testcalendar/plugins/fullcalendar/moment/moment.min.js"></script>

<!-- ================== END PAGE LEVEL JS ================== -->

<script>
            var handleCalendarDemo = function () {
            "use strict";
                    var buttonSetting = {left: 'today prev,next ', center: 'title', right: ''};
                    var date = new Date();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    var calendar = $('#calendar').fullCalendar({
            header: buttonSetting,
                    selectable: false,
                    selectHelper: false,
                    droppable: false,
                    drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                            // we need to copy it, so that multiple events don't have a reference to the same object
                            var copiedEventObject = $.extend({}, originalEventObject);
                            // assign it the date that was reported
                            copiedEventObject.start = date;
                            copiedEventObject.allDay = allDay;
                            // render the event on the calendar
                            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                    }

                    },
                    select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                            if (title) {
                    calendar.fullCalendar('renderEvent',
                    {
                    title: title,
                            start: start,
                            end: end,
                    },
                            true // make the event "stick"
                            );
                    }
                    calendar.fullCalendar('unselect');
                    },
                    eventRender: function (event, element, calEvent) {
                    var mediaObject = (event.media) ? event.media : '';
                            var description = (event.description) ? event.description : '';
                            element.find(".fc-event-title").after($("<span class=\"fc-event-icons\"></span>").html(mediaObject));
                            element.find(".fc-event-title").append('<small>' + description + '</small>');
                    },
                    editable: false,
                    events: [
<?php
for ($i = 0; $i < count($data); $i++) {
    $res = $data[$i];
    ?>

                        {
                        title: '<?php echo $res['location']; ?>',
                                start: '<?php echo $res['start_date']; ?>',
                                end: '<?php echo $res['end_date']; ?>',
                                description: '<?php echo '<br/>' . $res['address'] . '<br/>' . $res['contact_no'] ?>',
                        },
    <?php
    $date_ids = $res['main_id'];
    $temp = resultAssociate("SELECT id,schedule_date FROM `nfw_app_time_schedule` where nfw_app_start_end_date_id = $date_ids group by schedule_date");
    for ($j = 0; $j < count($temp); $j++) {
        $tp = $temp[$j];
        ?>
                            {

                            start: '<?php echo $tp['schedule_date']; ?>',
                                    url: './set_appointment.php?app_id=<?php echo $tp["id"] ?>',
                                    description: '<button class="btn btn-defult btn-xs" style="background: black;font-weight:bold;color:white;    margin-left: 10px;margin-bottom: 3px;margin-top: 3px;">Book Appointment</button>',
                            },
    <?php } ?>




<?php } ?>
                    ]

            });
                    /* initialize the external events
                     -----------------------------------------------------------------*/
                    $('#external-events .external-event').each(function () {
            var eventObject = {
            title: $.trim($(this).attr('data-title')),
                    className: $(this).attr('data-bg'),
                    media: $(this).attr('data-media'),
                    description: $(this).attr('data-desc')
            };
                    $(this).data('eventObject', eventObject);
                    $(this).draggable({
            zIndex: 999,
                    revert: true,
                    revertDuration: 0
            });
            });
            };
            var Calendar = function () {
            "use strict";
                    return {
                    //main function
                    init: function () {
                    handleCalendarDemo();
                    }
                    };
            }();
            //    $('#calendar').fullCalendar('removeEventSource', 'scheduler2.php');
</script>
<script>
            $(document).ready(function () {

    Calendar.init();
            $(".set_appointment").parents(".fc-event").css("background", "white");
    });
</script>