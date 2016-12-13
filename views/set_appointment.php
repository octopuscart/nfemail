<?php
include 'header.php';

$ids = $_REQUEST['app_id'];
//echo $ids;
$data = resultAssociate("SELECT nfw_app_start_end_date_id,schedule_date FROM `nfw_app_time_schedule` where id = $ids");
//print_r($data);
$app_id = $data[0]['nfw_app_start_end_date_id'];
//print_r($app_id);
$app_date = $data[0]['schedule_date'];
$app_data = resultAssociate("SELECT * FROM `nfw_app_time_schedule` where  nfw_app_start_end_date_id = $app_id and schedule_date = '$app_date' ");
//print_r($app_data);
$addresses = resultAssociate(" SELECT asa.place_id,asa.location,asa.address,asa.contact_no FROM `nfw_app_set_appointment`  as asa
                                  join nfw_app_start_end_date as ase on asa.id = ase.nfw_set_appointment_id
                                 where ase.id  = $app_id ");
//print_r($addresses);
if (isset($_REQUEST['submitPOP'])) {
    $v1 = $_REQUEST['main_id'];
    $v2 = $_REQUEST['first_name'];
    $v3 = $_REQUEST['last_name'];
    $v4 = $_REQUEST['email'];
    $v5 = $_REQUEST['telephone'];
    $v6 = $_REQUEST['address'];
    $v7 = date('Y-m-d');
    $v8 = date('H:i:s');
    $v9 = $_REQUEST['middle_name'];
    $query = "insert into nfw_app_userlist (nfw_time_schedule_id,first_name,last_name,email,telephone,address,op_date,op_time,middle_name) values('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9') ";
    mysql_query($query);
    $last_id = mysql_insert_id();
    header('location:sendMail.php?mail_type=4&last_id=' . $last_id);
}
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>

<style>
    table td,
    table th{
        padding:9px 18px 10px;
        border:0px solid #bdc3c7; 
    }
    .model_table_tr{

        line-height: 17px !important;
    }
    .strong{
        font-size: 30px;
        font-weight: 400 !important;
    }
    .modal-header{
        padding: 3px 19px;
        background: black;
    }
    .close{
        opacity: 1;
        color: white;
    }
    .modal-title{
        opacity: 1;
        color: white;
    }
</style>
<input type="hidden" id="place-id" value="<?php echo $addresses[0]['place_id'] ?>">
<section class="page_title_2 bg_light_2 t_align_c relative wrapper">
    <div class="col-md-12" style="margin-bottom: -28px;margin: -28px 0px -30px -13px;">
        <div id="map" style="height:500px;width:1395px"></div>
    </div>
    <div class="" style="width:25%;position: absolute;right: 10px;">
        <div class = "panel panel-default">
            <div class = "panel-heading">

                <address style="text-align: left;border-bottom: 1px solid gainsboro">
                    <strong class="strong"><?php echo $addresses[0]['location'] ?></strong><br>
                    <span><?php echo $addresses[0]['address'] ?></span><br>
                    <b><span><?php echo $addresses[0]['contact_no'] ?></span></b>
                </address>
            </div>

            <div class = "panel-body">
                <table class="table ">
                    <thead>
                        <tr>

                            <th>Start Time</th>
                            <th>End Time</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for ($i = 0; $i < count($app_data); $i++) { ?>
                            <tr>

                                <td><?php echo $app_data[$i]['schedule_start_time']; ?></td>
                                <td><?php echo $app_data[$i]['schedule_end_time']; ?></td>
                                <td>
                                    <button class="btn btn-defult btn-xs model_btn" data-toggle="modal" data-target="#myModal" ids="<?php echo $app_data[$i]['id']; ?>" style="background:black;color:white">Book Appointment</button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>



            </div>
        </div>

    </div>
</section>
<?php
include 'footer.php'
?>
<script>
    // Initialize the map.
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: {lat: 40.72, lng: -73.96}
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        // geocodePlaceId(geocoder, map, infowindow);
        var placeId = $("#place-id").val();
        geocoder.geocode({'placeId': placeId}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    map.setZoom(17);
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
    initMap();
</script>
<script>
    $(function () {
        $(".model_btn").click(function () {
            var ids = $(this).attr('ids');
            // console.log(ids);
            $("input[name='main_id']").val(ids);
        });
    });
</script>
<div class = "modal fade bd-example-modal-sm" id ="myModal" >

    <div class = "modal-dialog modal-sm">
        <form method="post">
            <div class = "modal-content">

                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                        &times;
                    </button>

                    <p class = "modal-title" id = "myModalLabel">
                        Fill Your Contact Information
                    </p>
                </div>

                <div class = "modal-body">
                    <input type="hidden"  value="" name="main_id">
                    <div class="col-md-12" >
                        <div class="form-group" style="font-color:black">

                            <label for="first_name">First Name</label> 
                            <input type="text" class="time start form-control" name="first_name"  style="height:34px;" required />

                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="form-group" style="font-color:black">

                            <label for="first_name">Middle Name</label> 
                            <input type="text" class="time start form-control" name="middle_name"  style="height:34px;" required/>

                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="form-group" style="font-color:black">

                            <label for="first_name">Last Name</label> 
                            <input type="text" class="time start form-control" name="last_name"  style="height:34px;" required/>

                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="form-group" style="font-color:black">

                            <label for="first_name">Email</label> 
                            <input type="text" class="time start form-control" name="email"   style="height:34px;" required />

                        </div>
                    </div>

                    <div class="col-md-12" >
                        <div class="form-group" style="font-color:black">

                            <label for="first_name">Contact No.</label> 
                            <input type="text" class="time start form-control" name="telephone"  style="height:34px;" required
                                   ./>

                        </div>
                    </div>

                    <div class="col-md-12" >
                        <label for="first_name">Address</label> <br>
                        <textarea name="address"  rows="1" cols="27" style="height: 94px !important;"></textarea>
                    </div>



                    <div style="clear:both"></div>
                </div>


                <div class = "modal-footer">
                    <button type = "submit" name="submitPOP" class = "btn btn-default btn-xs pull-left" style="background: black;color:white">
                        Submit 
                    </button>

                </div>

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->

</div>