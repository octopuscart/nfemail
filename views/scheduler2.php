<?php
include 'header.php';
$data = resultAssociate("
                  SELECT sa.*,sed.start_date,sed.end_date,sed.id as main_id
                  FROM  `nfw_app_set_appointment` as sa 
                  join nfw_app_start_end_date as sed 
                  on sa.id = sed.nfw_set_appointment_id");





if (isset($_REQUEST['submit'])) {
    $v1 = $_REQUEST['select_time'];
    $v2 = mysql_real_escape_string($_REQUEST['first_name']);
    $v3 = mysql_real_escape_string($_REQUEST['last_name']);
    $v4 = $_REQUEST['email'];
    $v5 = $_REQUEST['telephone'];
    $v6 = $_REQUEST['address'];
    $v7 = date('Y-m-d');
    $v8 = date('H:i:s');
    $v9 = $_REQUEST['no_of_person'];
    $query = "insert into nfw_app_userlist (nfw_time_schedule_id,first_name,last_name,email,telephone,address,op_date,op_time,no_of_person) values('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9') ";
    mysql_query($query);
    $last_id = mysql_insert_id();
    header('location:sendMail.php?mail_type=4&last_id=' . $last_id);
}
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
    sup{
        line-height: 19px;
    }

</style>


<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-calendar"></i>&nbsp;&nbsp;   Make your appointment Schedule&nbsp;&nbsp;


                </a>
            </li>

        </ul>
    </div>
</section>




<?php
$shedulearray = array();
?>



<div class="section_offset" style="    padding: 30px 0 67px;">
    <div class="container clearfix">
        <div class="row page_block">
            <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30" style="margin-bottom: 20px;">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Tour Schedule Coming Soon...</h3>


            </section>

          
            <!--<div id="calendar" class="calendar"></div>-->
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>
<!-- Modal -->
<div class = "modal fade" id = "schedule_modal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">

    <div class = "modal-dialog ">
        <div class = "modal-content">
            <form method="post" action="#">
                <div class = "modal-header" style=" color: #fff;background: #000 ">
                    <button type = "button" style="    background-color: #000;
                            border: 1px solid #000;" class = " btn btn-danger btn-xm pull-right" data-dismiss = "modal" aria-hidden = "true">

                        <i class="fa fa-close"></i>

                    </button>

                    <div class = "modal-title row" id = "myModalLabel">

                        <address style="">
                            <span id="location"></span><br>
                            <span id="address"></span><br>
                        </address>

                        <div style="clear: both"></div>
                    </div>
                </div>



                <div class = "modal-body">


                    <div class="row" style="    border-bottom: 1px solid #E5E5E5;">
                        <div class="col-md-6" >
                            <div class="form-group" style="font-color:black">

                                <label for="select_date">Available Date</label> 
                                <select class="form-control" name="select_date" id="select_date"  style="height:34px;" required /></select>

                            </div>
                        </div>

                        <div class="col-md-6" >
                            <div class="form-group" style="font-color:black">

                                <label for="select_time">Available Time</label> 
                                <select class="form-control" name="select_time" id="select_time" style="height:34px;" required /></select>

                            </div>
                        </div>
                    </div>

                    <div class="row" style="    border-bottom: 1px solid #E5E5E5;">
                        <div class="col-md-4" >
                            <div class="form-group" style="font-color:black">

                                <label for="first_name">First Name</label> 
                                <input type="text" class="time start form-control" name="first_name"  style="height:34px;" required />

                            </div>
                        </div>

                        <div class="col-md-4" >
                            <div class="form-group" style="font-color:black">

                                <label for="first_name">Last Name</label> 
                                <input type="text" class="time start form-control" name="last_name"  style="height:34px;" required/>

                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group" style="font-color:black">
                                <label for="first_name">No. Of Persons</label> 
                                <input  class="time start form-control" type="number"  name="no_of_person"  style="height:34px;" min="1" value="1" />

                            </div>
                        </div>
                    </div>

                    <div class="row" style="    border-bottom: 1px solid #E5E5E5;">
                        <div class="col-md-6" >
                            <div class="form-group" style="font-color:black">

                                <label for="first_name">Email</label> 
                                <input type="text" class="time start form-control" name="email"   style="height:34px;" required />

                            </div>
                        </div>

                        <div class="col-md-6" >
                            <div class="form-group" style="font-color:black">

                                <label for="first_name">Contact No.</label> 
                                <input type="text" class="time start form-control" name="telephone"  style="height:34px;" required />

                            </div>
                        </div>
                    </div>

                    <!--                    <div class="row" style="    border-bottom: 1px solid #E5E5E5;">
                                            <div class="col-md-12" >
                                                <label for="first_name">Address</label> <br>
                                                <textarea name="address" class="form-control"  rows="1" cols="27" style="height: 94px !important;"></textarea>
                                            </div>
                                        </div>-->



                    <div style="clear:both"></div>
                </div>









                <div class = "modal-footer">


                    <button type = "submit" name="submit" class="btn btn-danger" style="background: black" >
                        Book Appointment
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


</script>
<script>
                            var scheduleData = <?php echo json_encode($shedulearray); ?>;

                            var selectdate = {};

                            function setTime(id) {
                                var datearray = selectdate[id];
                                console.log(datearray);
                                var tempt = '';
                                for (d in datearray) {
                                    var temp_id = datearray[d]['id'];
                                    var temp_val = datearray[d]['schedule_start_time'];
                                    tempt += "<option value='" + temp_id + "'>" + temp_val + "</option>";
                                }
                                $("#select_time").html(tempt);
                            }

                            function setAddress(id) {

                                var selectevent = scheduleData[String(id)];
                                var datearray = selectevent['schedule_date'];
                                var alltime = selectevent['timing'];
                                var tempt = '';
                                for (d in datearray) {
                                    var temp_id = datearray[d]['id'];
                                    var temp_val = datearray[d]['schedule_date'];
                                    tempt += "<option value='" + temp_id + "'>" + temp_val + "</option>";
                                }
                                $("#select_date").html(tempt);

                                selectdate = alltime;
                                var ids = Number(datearray[0]['id']);
                                setTime(ids);


                                $("#location").text(selectevent['location']);
                                $("#address").text(selectevent['address']);
                            }


                            $(function () {
                                $("#select_date").change(function () {
                                    setTime($(this).val());
                                })
                            })


</script>