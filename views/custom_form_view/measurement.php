<?php
$measurmentIndexArray = array();



$measurmentArray = array();
?>

<script>
    temp_measurement = {};
    var posture_array = {};
<?php
foreach ($postureArray as $key => $value) {
    echo '"' . $key . '":"",';
}

$profile_measurement = array(
    "Profile" => "profile_name",
    "Gender" => "gender",
    "Height" => "height",
    "Weight" => "weight",
    "Age" => "age",
        )
?>
</script>





<style>
    .your_image{
        width: 100%;
        margin-bottom: -11px;
    }

    .delete_image span{
        background-color: #F00;
        color: #fff;
        cursor: pointer;
        margin-top: -15px!important;
        position: absolute;
        line-height: 16px;
        font-size: 18px;
        margin-left: 184px;
        padding-left: 1px;

    }
    .userimageclass{
        width: 100px;
        height: 100px;
        margin: 5px;
    }
    .info-table{
        width: 100%;
    }
    .info-table td{
        padding-bottom:0px!important;
        padding-top:0px!important;
        font-size: 12px;
    }
    .info-table b{
        font-size: 15px;
    }

    .info-table .size_lable{
        background-color: #FFF;
        padding: 10px !important;
    }

    .info-table th{
        padding-bottom:0px!important;
        padding-top:0px!important;
    }
</style>

<script>
    var measurment_profile_array = {
        "Profile": '',
        "Gender": 'Male',
        "Height": '',
        "Weight": '',
        "Age": '',
<?php
$measurement_map = array();
$measurement_conf_array = array();
foreach ($measurement_list as $key => $value) {
    $query = "select * from nfw_measurement where id = '$value'";
    $measurement_data = resultAssociate($query);
    array_push($measurement_conf_array, $measurement_data);
    echo '"' . $measurement_data[0]['title'] . '"' . ":" . "'',";
    $measurement_map["mes" . $value] = $measurement_data[0]['title'];
}
?>
    };

    var measurement_map = <?php echo json_encode($measurement_map); ?>

</script>

<style>
    .col-25{
        width:20%!important;
    }
</style>


<div class="row col-md-12 measurement_form_setup custmo_form_setup" style="    padding-right: 0;">

    <div class="col-md-12 measurement_selection_block animated" style="padding: 0px">
        <div class="col-md-6">

            <div class="selecte_style_options wave-block" style="margin-top:15px">
                <p
                    style="font-size: 18px;
                    /* margin-top: -2px; */
                    font-weight: 300;
                    color: #000;
                    margin-bottom: 6px;
                    padding: 5px 10px 10px;
                    background-color: #fff;
                    border: 1px solid #E8E6E6;"
                    >
                    <input type="radio" id="shop_mes" class="shop_mes d_none" name="mes_radio">
                    <label for="shop_mes" class="d_inline_m m_right_10" style="font-size: 22px;">
                        Most Recent Offline Purchase
                    </label>
                </p>
                <p class="card_text">
                    If you have purchased from us before, we have stored your most recent measurement on record.
                </p>
                <small style="    padding:9px;
                       float: left;
                       width: 100%;"></small>
            </div>

            <div class="selecte_style_options wave-block" style="margin-top:15px">
                <p
                    style="font-size: 18px;
                    /* margin-top: -2px; */
                    font-weight: 300;
                    color: #000;
                    margin-bottom: 6px;
                    padding: 5px 10px 10px;
                    background-color: #fff;
                    border: 1px solid #E8E6E6;"
                    >
                    <input type="radio" id="new_measurement_profile" name="mes_radio" class="d_none new_measurement_profile" value="" >
                    <label for="new_measurement_profile" class="d_inline_m m_right_10" style="font-size: 22px;">

                        Create New Measurement Profile? </label> 
                </p>
                <p class="card_text">
                    Here you can create a new measurement for a current purchase.
                </p>
                <small style="    padding:9px;
                       float: left;
                       width: 100%;"></small>
            </div>



<!--            <div class="selecte_style_options" style="margin-top:15px">
                <p
                    style="font-size: 18px;
                    /* margin-top: -2px; */
                    font-weight: 300;
                    color: #000;
                    margin-bottom: 6px;
                    padding: 5px 10px 10px;
                    background-color: #fff;
                    border: 1px solid #E8E6E6;"
                    >

                    Select Standard Size

                </p>
                <div class="card_text">
                    <table class="info-table"> 
                        <tbody>
                            <tr style=""> 
                                <td><br></td>

                                <?php
                                $sizearray = ['S', 'M', 'L', 'XL', 'XXL'];
                                foreach ($sizearray as $key => $value) {
                                    ?>

                                    <td class="size_lable">
                                        <input type="radio" id="measurement_profile_<?php echo $value; ?>" name="mes_radio" class="d_none standard_measurement" value="<?php echo $value; ?>" >
                                        <label for="measurement_profile_<?php echo $value; ?>" class="d_inline_m m_right_10" style="">
                                            <b><?php echo $value; ?></b>
                                        </label> 
                                    </td> 
                                <?php }
                                ?>

                            </tr>
                            <tr> <th>Chest</th> <td>35"-37"</td> <td>38"-40"</td> <td>41"-43"</td> <td>45"-47"</td> <td>49"-51"</td> </tr> <tr> <th>Waist</th> <td>28"-30"</td> <td>31"-33"</td> <td>34"-36"</td> <td>38"-40"</td> <td>42"-44"</td> </tr> <tr> <th>Hips</th> <td>35"-37"</td> <td>38"-40"</td> <td>41"-43"</td> <td>44"-46"</td> <td>47"-49"</td> </tr> <tr> <th>Thigh</th> <td>21"</td> <td>22"</td> <td>23"</td> <td>24"</td> <td>25"</td> </tr> <tr> <th>Neck</th> <td>14 1/2"</td> <td>15 1/2"</td> <td>16 1/2"</td> <td>17 1/2"</td> <td>18 1/2"</td> </tr> <tr> <th>Sleeve</th> <td>33"</td> <td>34"</td> <td>35"</td> <td>36"</td> <td>37"</td> </tr> <tr> <th>Inseam</th> <td>31 1/2"</td> <td>32"</td> <td>32 1/2"</td> <td>33"</td> <td>33 1/2"</td> </tr> </tbody></table>
                </div>
                <small style="    padding:9px;
                       float: left;
                       width: 100%;"></small>
            </div>-->


            <div class="selecte_style_options " style="margin-top:15px">
                <p
                    style="font-size: 18px;
                    /* margin-top: -2px; */
                    font-weight: 300;
                    color: #000;
                    margin-bottom: 6px;
                    padding: 5px 10px 10px;
                    background-color: #fff;
                    border: 1px solid #E8E6E6;
                  font-size: 22px;
                    ">
                    Select size from Previous Measurement
                </p>
                <p class="card_text">
                    Select measurement from previous online purchase, it will apply on all chosen fabric.
                </p>
                <?php
                if (count($pre_measurement)) {
                    ?>
                    <div class="accordion" style="margin-top: -6px;padding: 0 10px;padding-bottom: 10px;">

                        <?php
                        $count = 0;
                        foreach ($pre_measurement as $key => $value) {
                            ?>
                            <dl class="wave-block custom_measurement accordion_item r_corners wrapper m_bottom_5 tr_all <?php echo $count == 0 ? 'active' : ''; ?>" style="background-color: white;margin-top: 13px;    border: 1px solid #fff;">
                                <dt class="accordion_link relative tr_all color_scheme" style="padding: 9px 19px 10px 19px;
                                    cursor: pointer;    height: 44px;
                                    ">
                                <div>
                                    <div>
                                        <input type="radio" id="radio_mes_<?php echo $value['id']; ?>" name="mes_radio" class="d_none hide_measurement" value="<?php echo $value['id']; ?>">
                                        <label for="radio_mes_<?php echo $value['id']; ?>" class="d_inline_m m_right_10" style="">
                                            <?php echo $value['measurement_profile'] ?>
                                        </label>
                                        <span style="float:right"> 
                                            <?php echo $value['datetime'] ?>
                                        </span>
                                    </div>


                                </div>

                                </dt>
                                <dd class="fw_light color_dark" style="display: block;color:balck;padding:10px">

                                    <div class='col-md-12' style="padding: 0px;">
                                        <table class='table-bordered pre_profiles' style="width: 100%;margin-bottom: 10px">
                                            <tr style='display:none'>
                                                <td mesp='profile_id'><?php echo $value['id'] ?></td>
                                            </tr>
                                            <?php
                                            $profile_measurement_data = phpjsonstyle($value['measurement_data'], 'php');

                                            foreach ($profile_measurement_data as $key1 => $value1) {

                                                echo "<tr><th>", $key1, "</th><td mesp='", $key1, "'>", $value1, "</td></tr>";
                                            }
                                            ?>

                                            <tr style="background:#000;">
                                                <td colspan="2" style="color:#fff">Posture</td>
                                            </tr>

                                            <?php
                                            $posture_data = phpjsonstyle($value['posture_data'], 'php');

                                            foreach ($posture_data as $key1 => $value1) {

                                                echo "<tr><th>", $key1, "</th><td >", $value1, "</td></tr>";
                                            }
                                            ?>
                                            <tr style="background:#000;">
                                                <td colspan="2" style="color:#fff">User Images</td>
                                            </tr>
                                            <?php
                                            echo "<tr><th colspan=2>";
                                            $image_data = $value['user_images'];
                                            $image_data = trim($image_data, "[");
                                            $image_data = trim($image_data, "]");
                                            $image_data = explode(",", $image_data);

                                            foreach ($image_data as $key1 => $value1) {

                                                echo "<img class='userimageclass' src='", $imageserver, '/small/', trim($value1, '"'), "' >";
                                            }
                                            echo "</td></tr>";
                                            ?>




                                        </table>
                                    </div>
                                </dd>
                            </dl>
                            <?php
                            $count++;
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>

                    <div >
                        <h3
                            style="font-weight: 300;
                            margin-top: 66px; "
                            >No Previous Measurement Profile Found. </h3>

                    </div>

                    <?php
                }
                ?>


            </div>




        </div>



        <div class="col-md-6">

            <div class="" style="min-height:450px;height:100%;background: url(custom_form_view/background_new_custom/mes2.jpg); background-size: cover;
                 background-repeat: no-repeat;">

            </div>
        </div>
        <div style="height:40px;clear: both">
            <nav style="padding: 2px 20px;
                 /* background: #EEE; */
                 border-top: 1px solid #000;
                 z-index: 999;
                 position: absolute;
                 width: 100%;">



                <ul class="pager" style="  margin: 3px 0;">
                    <li class="previous previousStyle">
                        <a href="javascript:void(0)" style="background: #000;
                           color: #fff;">
                            <span aria-hidden="true">&larr;</span> Previous 
                        </a>
                    </li>
                    <li class="next nextStyle">
                        <a href="javascript:void(0)" style="background: #000;
                           color: #fff;">
                            Next <span aria-hidden="true">&rarr;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

    <!--start of new Measurement-->
    <div class="col-ms-12 create_new_measurement animated" style="padding: 0px;display: none;">


        <p
            style="margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;"
            >
            If you want choose measurement from your previous measurements then <span id="previous_measurement" class="previous_style_measurement" style="">Click Here </span>
        </p>

        <div class="col-sm-3" style="">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active">
                    <a class="" href="#create_profile" aria-controls="create_profile" role="tab" data-toggle="tab" aria-expanded="true">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg">
                        &nbsp;Create Profile
                    </a>
                </li>
                <?php
                $count = 0;
                foreach ($measurement_conf_array as $key => $value) {
                    $val = $value[0];
                    echo '<li role="presentation" class="">';
                    echo '<a class="" href="#mes' . $val['id'] . '" aria-controls="mes' . $val['id'] . '" role="tab" data-toggle="tab">';
                    echo '<img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg"> &nbsp;';
                    echo $val['title'];

                    echo '</a></li>';
                    $count += 1;
                }
                ?>

                <li role="presentation" class="">
                    <a class="" href="#profile_summary" aria-controls="profile_summary" role="tab" data-toggle="tab" aria-expanded="true">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg">
                        &nbsp;Summary
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9" style="   padding-right: 0;">
            <div class="tab-content">

                <!--start of profile tab-->
                <div role="tabpanel" class="tab-pane active" id="create_profile">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Create Profile                                
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row" style="  padding: 15px 10px;">
                                <div class="">
                                    <div class="col-md-12" style="margin-bottom: 20px;margin-bottom: 20px;
                                         border-bottom: 1px solid;
                                         padding-bottom: 11px;">
                                        <h2
                                            style="
                                            font-size: 37px;
                                            float: left;
                                            margin-right: 14px;
                                            color: #B00;
                                            ">Write Profile Name</h2>
                                        <input type="text" id="profile_name" class="form-control" style="width: 73%;    font-size: 25px;"> 
                                    </div>
                                    <div class="col-md-12">

                                        <div class="col-md-0">
<!--                                            <div class="btn-group" data-toggle="buttons" style="width:100%">
                                                <label class="btn btn-danger active gender_selection" targetval="Male" style="
                                                       background-size: 471px;
                                                       background-position:-45px;
                                                       text-align: left;
                                                       color: #000;
                                                       ">
                                                    <input type="radio" name="gender" id="option2" autocomplete="off"> Male
                                                </label>
                                                <label class="btn btn-danger gender_selection" targetval="Female"  style="

                                                       background-size: 471px;
                                                       background-position: -242px;
                                                       text-align: right;
                                                       color: #000;

                                                       ">
                                                    <input type="radio" name="gender" id="option3" autocomplete="off"> Female
                                                </label>
                                            </div>-->
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="col-md-12" style="height: 33px;padding: 0;">
                                                        <span class="slider_label slider_text">Gender</span> 
                                                        <span class="slider_text">:</span>
                                                        <span class="slider_val1  slider_text gender_selected">Male</span>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </li>

                                                <li class="list-group-item">
                                                    <span class="slider_label slider_text">Height</span>
                                                    <span class="slider_text">:</span>
                                                    <span id="height_feet"  class="slider_val1  slider_text"">5</span>
                                                    <br>
                                                    <b>
                                                        <div class="col-md-12 number_slider_div" >
                                                            <input id="height_feet_slider" targetdiv="height_feet" class="" type="text" value="0" minval="36" maxval="96" startval="60"/>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </b>
                                                </li>

                                                <li class="list-group-item">
                                                    <span class="slider_label slider_text">Weight</span> 
                                                    <span class="slider_text">:</span>
                                                    <span class="slider_val1  slider_text"">
                                                        <span id="weight_val">5</span>
                                                        <select id="weight_unit" style="background: #FFF;">

                                                            <option>Lbs</option>
                                                            <option>Kg</option>
                                                        </select>
                                                    </span>
                                                    <br>
                                                    <b >
                                                        <div class="col-md-12 number_slider_div meas_div_parent" id="Weight">
                                                            <input id="" targetdiv="weight_val" class="number_slider" type="text" value="0" minval="20" maxval="400" startval="70"/>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </b>
                                                </li>

                                                <li class="list-group-item">
                                                    <span class="slider_label slider_text">Age</span>
                                                    <span class="slider_text">:</span>
                                                    <span id="age_val"  class="slider_val1  slider_text"">5</span>
                                                    <br>
                                                    <b>
                                                        <div class="col-md-12 number_slider_div meas_div_parent" id="Age">
                                                            <input id="" targetdiv="age_val" class="number_slider" type="text" value="0" minval="5" maxval="110" startval="30"/>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </b>

                                                </li>

                                            </ul>




                                        </div>

                                    </div>

                                    <div class="col-md-12 posture_arrays" style="    padding: 0px 30px;">
                                        <?php
                                        foreach ($posture_list as $key => $value) {
                                            echo get_custom_data($value);
                                        }
                                        ?>
                                    </div>


                                </div>
                            </div>
                            <ul class="pager" style="  margin: 3px 0;">

                                <li class="next nextMes">
                                    <a href="javascript:void(0)" style="background: #000;
                                       color: #fff;">
                                        Next <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end of profile tab-->

                <?php
                foreach ($measurement_conf_array as $key => $value) {
                    $val = $value[0];
                    
                    ?>
                    <div role="tabpanel" class="tab-pane" id="mes<?php echo $val['id'] ?>">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span> 
                                    <?php echo $val['title']; ?>
                                </h3>
                            </div>
                            <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                                <div class="row" >
                                    <div class='col-md-12'>
                                        <style>
                                            .panel-default {
                                                /*border-color: #000;*/
                                            }
                                        </style>
                                        <div class='panel panel-default'>
                                            <div class='panel-body'>
                                                <span class=" slider_text"><?php echo $val['title']; ?> Measurement Value</span>
                                                <span class="slider_text">:</span>
                                                <span id="mes_<?php echo $val['id'] ?>"  class="slider_val  slider_text"">5</span>
                                                <br>
                                                <b>
                                                    <div class="col-md-12 number_slider_div" >
                                                        <input id="" targetdiv="mes_<?php echo $val['id'] ?>" class="number_slider_fraction" type="text" value="0" minval="<?php echo $val['min_value'] ?>" maxval="<?php echo $val['max_value'] ?>" startval="30"/>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </b>
                                            </div>
                                            <div class="padding-bottom">
                                                <div style="height:46px;clear: both">
                                                    <nav style="
                                                         padding: 2px 20px;
                                                         /* background: #EEE; */
                                                         border-top: 1px solid #000;
                                                         z-index: 999;
                                                         position: absolute;
                                                         width: 96.6%;
                                                         ">



                                                        <ul class="pager" style="  margin: 3px 0;">
                                                            <li class="previous previousMes">
                                                                <a href="javascript:void(0)" style="background: #000;
                                                                   color: #fff;">
                                                                    <span aria-hidden="true">&larr;</span> Previous 
                                                                </a>
                                                            </li>
                                                            <li class="next nextMes">
                                                                <a href="javascript:void(0)" style="background: #000;
                                                                   color: #fff;">
                                                                    Next <span aria-hidden="true">&rarr;</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class='col-md-6 ' >
                                        <div class='panel panel-default' style="
                                             background-image: url(custom_form_view/measurement_img/<?php echo $key ?>.jpg);
                                             height: 304px;
                                             background-size: 119% 176%;
                                             padding: 0px;
                                             background-repeat: no-repeat;
                                             background-position: -43px -117px;
                                             ">
                                            <div class='panel-body'>

                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-6 '>
                                        <div class='panel panel-default' style=" height: 304px;">
                                            <div class='panel-body' style="padding: 0px">
                                                <div class="embed-responsive " style="padding-bottom: 63.2%;">
                                                    <!--<iframe class="embed-responsive-item" src="//www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen=""></iframe>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12' style="background: #fff;padding-bottom: 15px;">
                                        <?php
                                        $measurment_text = explode("__", $val['measurement_text']);
                                        
                                        for ($i = 0; $i < count($measurment_text); $i++) {
                                            $point = $measurment_text[$i];
                                            echo '<span class="fa-stack fa-xs" style="font-size: 10px;color: #000;">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-arrow-right fa-stack-1x fa-inverse" style="color:#fff"></i>
                                    </span> ';
                                            echo "<span class='measurment_point'>" . $point . "</span></br>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div role="tabpanel" class="tab-pane " id="profile_summary">

                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span> 
                                    Measurement Summary                                
                                </h3>
                            </div>
                            <div class="panel-body" style="">

                                <table class="col-md-6">
                                    <tr style="    background-color: #000;
                                        color: #fff;">
                                        <td colspan="2">
                                            Your Selected Measurement
                                        </td>
                                    </tr>
                                    <tr class="mes_th">
                                        <th>Profile</th>
                                        <th mes_parent="Profile"></th>
                                    </tr>
                                    <tr class="mes_th">
                                        <th>Height</th>
                                        <th mes_parent="Height"></th>
                                    </tr>
                                    <tr class="mes_th">
                                        <th>Weight</th>
                                        <th mes_parent="Weight"></th>
                                    </tr>
                                    <tr class="mes_th">
                                        <th>Age</th>
                                        <th mes_parent="Age"></th>
                                    </tr>
                                    <?php
                                    foreach ($measurement_map as $key => $value) {
                                        ?>

                                        <tr class="mes_th">
                                            <th>
                                                <?php echo $value; ?>

                                            </th>
                                            <th mes_parent="<?php echo $value; ?>"></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>

                                <table class="col-md-5 pull-right posture_measurement">

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span> 
                                    Please insert images of your front profile & back, so we can get a better idea about your build for best fitting.       
                                    <button tyle="button" onclick="addNew()" class="pull-right btn btn-warning btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="imageclass" style="display:block"></div>
                                <div class="" style="margin-top: 15px;">
                                    <div >

                                        <div >
                                            <div class="row">
                                                <div class="col-sm-3 fileUploadDiv animated template_image" style="display:none">
                                                    <div class="thumbnail">
                                                        <div class="delete_image" style="display: none;">
                                                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                                                        </div>
                                                        <img class="vfileTag" src="" alt="Choose a file from your device and upload it." style="height: 200px;">
                                                        <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>
                                                        <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">
                                                            <div style="width:100%;height: 7px">
                                                                <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                                                            </div>
                                                            <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                                                            <input type='hidden' name='image_name' value='<?php
                                                            echo implode("", $productArray);
                                                            echo $_SESSION['user_id'];
                                                            ?>'>
                                                            <input type="hidden" name="file_name">
                                                            <button type="submit" value="Upload" class="submit form-control btn btn-primary vuploadButton" value="upload" style="  margin-top: 12px;">
                                                                <i class="fa fa-upload vuploadIcon"></i> 
                                                                <span class="vuploadText">Upload</span>
                                                            </button>

                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="row vfileContainer" style="padding: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <!--                                <div class="row vfileContainer" style="padding: 10px;">
                                                                    starting of file updaders
                                                                    <div class="col-sm-3 fileUploadDiv animated">
                                
                                                                        <div class="thumbnail">
                                                                            <div class="delete_image" style="display: none;">
                                                                                <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                                                                            </div>
                                                                            <img class="vfileTag" src="" alt="Choose a file from your device and upload it." style="height: 200px;">
                                                                            <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>
                                                                            <div class="">
                                                                                <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">
                                
                                                                                    <div style="width:100%;height: 7px">
                                                                                        <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                                                                                    </div>
                                                                                    <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                                                                                    <input type='hidden' name='image_name' value='<?php
                                echo $_SESSION['user_id'];
                                echo date('YmdHis');
                                ?>'>
                                
                                                                                    <button type="submit" value="Upload" class="submit form-control btn btn-primary vuploadButton" value="upload" style="  margin-top: 12px;">
                                                                                        <i class="fa fa-upload vuploadIcon"></i> 
                                                                                        <span class="vuploadText">Upload</span>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    end of file uploader div
                                                                </div>-->
                            </div>
                        </div>
                        <div class="padding-bottom">
                            <div style="height:46px;clear: both">
                                <nav style="
                                     padding: 2px 20px;
                                     /* background: #EEE; */
                                     border-top: 1px solid #000;
                                     z-index: 999;
                                     position: absolute;
                                     width: 96.6%;
                                     ">



                                    <ul class="pager" style="  margin: 3px 0;">
                                        <li class="previous previousMes">
                                            <a href="javascript:void(0)" style="background: #000;
                                               color: #fff;">
                                                <span aria-hidden="true">&larr;</span> Previous 
                                            </a>
                                        </li>
                                        <li class="next nextMes">
                                            <a href="javascript:void(0)" style="background: #000;
                                               color: #fff;">
                                                Next <span aria-hidden="true">&rarr;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end of new measurement-->
</div>

<script>

    function setPosture() {
        var htmls = "";
        htmls += '<tr><td colspan="2" style="    background-color: #000;color: #fff;">Your Posture</td></tr>';
        for (i in posture_array) {
            var pt = i;

            var cl = posture_array[i];
            htmls += "<tr class='mes_th'><th>" + i + "</th><th>" + cl + "</th>";
        }
        $(".posture_measurement").html(htmls);
    }
    function setMeasurment() {
        var count = 0;
        for (i in measurment_profile_array) {
            count += 1;
            var mes_k = i;
            var mes_v = measurment_profile_array[i];
            var mes_vk = mes_v.split("  ");
            var mesi = mes_vk[0];
            var mesm = mes_vk[1];
            if (count > 1) {
                if (mes_vk.length > 1) {
                    $("th[mes_parent='" + mes_k + "']").html(mesi + "&nbsp;<small>" + mesm + "</small>");
                }
                else {
                    if (mes_k == 'weight') {
                        var mesw = $("#weight_unit").val();
                        $("th[mes_parent='" + mes_k + "']").html(mesi + " " + mesw);
                    }
                    else {
                        $("th[mes_parent='" + mes_k + "']").html(mesi);
                    }
                }
            }
            else {
                $("th[mes_parent='" + mes_k + "']").html(mesi);
            }
        }

    }


    function getFractionVal(num) {
        var returnVal = {
            '0': '"',
            '1': '1/8"',
            '2': '1/4"',
            '3': '3/8"',
            '4': '1/2"',
            '5': '5/8"',
            '6': '3/4"',
            '7': '7/8"',
        }
        return returnVal[num]
    }

    setTimeout(function () {
        temp_measurement = measurment_profile_array;
    }, 1000);
    $(document).ready(function () {
        $(".shop_mes").click(function () {
            if (this.checked) {
                for (j in measurment_profile_array) {
                    measurment_profile_array[j] = "*****";
                }
                for (i in posture_array) {
                    posture_array[i] = "*****";
                }
            }
        });


        $(".standard_measurement").click(function () {
            if (this.checked) {
                var profile = $(this).val();
                for (j in measurment_profile_array) {
                    measurment_profile_array[j] = "*****";
                }
                for (i in posture_array) {
                    posture_array[i] = "*****";
                }
                measurment_profile_array['Profile'] = profile;
            }
        })



        $(".hide_measurement[name='mes_radio']").click(function () {
            $("#create_new_measurement").hide();
        })

        $("#new_measurement_profile").click(function () {
            $("#create_new_measurement").show();
        });


        //        $(".posture_image").filestyle({input: false, buttonText: " Choose Image File", badge: false});
        $(".number_slider").each(function () {
            var ele = this;
            var maxVal = $(this).attr("maxval");
            var minVal = $(this).attr("minval");
            var startVal = $(this).attr("startval");
            var init = new Powerange(ele, {callback: function () {
                    setVal()
                }, min: Number(minVal), max: Number(maxVal), start: 100, hideRange: true});
            function setVal() {
                var tempval = ele.value == 'NaN' && startVal || ele.value;
                $("#" + $(ele).attr("targetdiv")).html(tempval);
                var parentDiv = $(ele).parents(".meas_div_parent")[0].id;
                var mes_val = $("#" + $(ele).attr("targetdiv")).text();
                if (parentDiv == 'Weight') {

                    var mesw = $("#weight_unit").val();
                    measurment_profile_array[parentDiv] = mes_val + " " + mesw;
                }
                else {
                    measurment_profile_array[parentDiv] = mes_val;
                }
                setMeasurment();
            }
        });
        $("#height_feet_slider").each(function () {
            var ele = this;
            var maxVal = Number($(this).attr("maxval"));
            var minVal = Number($(this).attr("minval"));
            var startVal = $(this).attr("startval");
            var init = new Powerange(ele, {callback: setVal, min: minVal, max: maxVal, start: startVal, hideRange: true});
            function setVal() {
                var tempval = ele.value == 'NaN' && startVal || ele.value;
                var inchVal = Number(tempval);
                var inchValT = (inchVal / 12);
                inchValT = inchValT.toFixed(2);
                var fitVal = String(inchValT).split(".");
                $("#" + $(ele).attr("targetdiv")).html(fitVal[0] + " Feet " + String(Number(fitVal[1]) / 8).split(".")[0] + ' Inches');
                var mes_val = $("#" + $(ele).attr("targetdiv")).text();
                measurment_profile_array['Height'] = mes_val;
                setMeasurment();
            }
        });
        $(".number_slider_fraction").each(function () {
            var ele = this;

            var maxVal = (((Number($(this).attr("maxval")) + 1) * 12) - 1);
            var minVal = Number($(this).attr("minval")) * 12;
            var startVal = Number($(this).attr("minval")) * 12;
            var init = new Powerange(ele, {callback: setVal, min: minVal, max: maxVal, start: Number(startVal), hideRange: true});
            function setVal() {
                var tempval = ele.value == 'NaN' && startVal || ele.value;
                var inchVal = Number(tempval);
                var inchValT = (inchVal / 12);
                inchValT = inchValT.toFixed(2);
                var fitVal = String(inchValT).split(".");
                var fitv = Number(fitVal[0]);
                var inchv = String(Number(fitVal[1]) / 12.5).split(".")[0];
                inchv = getFractionVal(String(Number(inchv)));
                $("#" + $(ele).attr("targetdiv")).html(fitv + "  <small class='inchval'>" + inchv + '</small>');
                var parentDiv = $(ele).parents(".tab-pane")[0].id;
                var mes_val = $("#" + $(ele).attr("targetdiv")).text();
                console.log(measurement_map[parentDiv], mes_val);
                measurment_profile_array[measurement_map[parentDiv]] = mes_val;
                setMeasurment();
            }
        });
        $(".gender_selection").click(function () {
            $(".gender_selected").text($(this).attr("targetval"));
            measurment_profile_array['Gender'] = $(this).attr("targetval");
        });
        $("#profile_name").keyup(function () {
            measurment_profile_array['Profile'] = $(this).val();
            setMeasurment();
        });

        $(".hide_measurement").click(function () {

            $(".new_measurement").hide();
            var premes = $(this).parents(".custom_measurement").first();
            $(premes).find("tr").each(function (ind) {
                var mesp = $(premes).find("[mesp]")[ind];
                var mesk = $(mesp).attr("mesp");
                var mesv = $(mesp).text();
                if (mesk) {
                    measurment_profile_array[mesk] = mesv;
                }

            })
            //setMeasurment();


        })

        $("#new_measurement").click(function () {
            if (this.checked) {
                $(".new_measurement").show();
            }

        })

        $(".posture_arrays [parent_style]").click(function () {
            
            var prt = $(this).attr("parent_style");
            var cld = $(this).attr("child_style");
             $(".posture_arrays [parent_style='"+prt+"']").removeClass("selected").addClass("deselect");
             $(this).removeClass("deselect").addClass("selected");
            posture_array[prt] = cld;
            setPosture();
        })

        $(".posture_arrays .selected").each(function () {
            var prt = $(this).attr("parent_style");
            var cld = $(this).attr("child_style");
            posture_array[prt] = cld;
            setPosture();
        });


        $(".add_new_image").click(function () {
            var newDiv = $(".fileUploadDiv").last().clone();
            $(newDiv).find(".delete_image").show()
            $(newDiv).find("input[name=image_name]").val(Number($(".fileUploadDiv").last().find("input[name=image_name]").val()) + 1)
            $(".vfileContainer").append(newDiv);
        })



    });



    $(document).on("click", ".delete_image", function () {


        var obj = $(this).parents(".fileUploadDiv").first()[0];
        var x = 'hinge';
        $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass(x);
            console.log(this);
            $(obj).remove();
        });


    })


    function imageList() {
        $(".imageclass").html("");
        $(".vfileContainer input[name='file_name']").each(function () {
            var imagename = this.value;
            var htmls = "<input name='image_name_list[]' value='" + imagename + "'>";
            $(".imageclass").append(htmls);
        })
    }
    imageList();


    function addNew() {
        var newDiv = $(".template_image").first().clone().show().removeClass(".template_image");
        $(newDiv).find(".delete_image").show()
        $(newDiv).find("input[name=image_name]").val(Number($(".fileUploadDiv").last().find("input[name=image_name]").val()) + 1);
        $(".vfileContainer").append(newDiv);
    }

 
    var imageUploadCdn = "<?php echo $baselinkserver;?>/imageUploadFunction.php";
    var imagePrePath = "<?php echo $imageserver;?>/nfw/small/"


    function FileUploader() {
        this.init = function (parent) {
            this.parent = parent;
            this.vuploadFile = $(parent).find(".vuploadFile");
            this.vfileTag = $(parent).find(".vfileTag");
            this.votherFile = $(parent).find(".votherFile");
            this.vfile = $(parent).find(".vfile");
            this.vuploadFile = $(parent).find(".vuploadFile");
            this.vuploadButton = $(parent).find(".vuploadButton");
            this.vuploadText = $(parent).find(".vuploadText");
            this.vuploadIcon = $(parent).find(".vuploadIcon");
            this.vprogress_bar = $(parent).find(".vprogress-bar");
            this.filename = $(parent).find("input[name='file_name']");
            this.vdisplayprogress = $(parent).find(".vdisplayprogress");
            this.chooseButton = $(parent).find(".group-span-filestyle");
        }
        this.uploaded = function () {
        };
        this.uploading = function () {
        };
        this.uploader = function (obj) {



            $(this.vdisplayprogress).show(100);
            // $(this.vfile).hide();
            $(this.vuploadButton).attr("disabled", "true");
            $(this.vuploadText).text("Uploading")
            $(this.vuploadIcon).removeClass("fa-upload").addClass("fa-spinner fa-pulse");
            var thisobj = this;
            var formData = new FormData(obj);

            var request = $.ajax({xhr: function () {
                    $(thisobj).trigger('uploading', thisobj.uploading);
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            $(thisobj.vprogress_bar).stop().animate({width: "" + percentComplete + "%"}, 100);
                        } else {
                            console.log("lengthComputable evaluated to false;")
                        }
                    }, false);
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                        }
                        else {

                        }
                    }, false);
                    return xhr;
                },
                url: imageUploadCdn, // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (rdata)   // A function to be called if request succeeds
                {
                    console.log(rdata);
                    var imageName = jQuery.parseJSON(rdata);
                    var originalImage = imagePrePath + imageName;
                    console.log(imageName);
                    $(thisobj.filename).val(imageName);

                    $("#imagedata").val($("#imagedata").val() + "," + imageName);
                    $(thisobj.vdisplayprogress).hide();
                    $(thisobj).parents("form").first().find("input[name='image_name']").val(imageName);
                    $(thisobj.vuploadButton).attr("disabled", false);
                    $(thisobj.vuploadText).text("Change File");
                    $(thisobj.vuploadIcon).removeClass("fa-spinner fa-pulse").addClass("fa-check-circle");
                    $(thisobj.vprogress_bar).stop().animate({width: "0%"}, 100);
                    $(thisobj.vuploadButton).removeClass("btn-primary").addClass("btn-success");
                    $(thisobj.vuploadButton).attr("disabled", false);
                    $(thisobj).trigger('uploaded', thisobj.uploaded);                     //$(thisobj.chooseButton).hide();
                    imageList()
                },
            });
        }

    }

    function check_extension(obj) {
        filename = obj.value;
        parent = $(".fileUploadDiv").last();
        //var newClone = $(parent).clone().hide();
        //$(".vfileContainer").append(newClone);
        var hash = {
            '.jpg': 1,
            '.jpeg': 1,
            '.png': 1, '.gif': 1, };
        var re = /\..+$/;
        var vfileTag = $(parent).find(".vfileTag");
        var votherFile = $(parent).find(".votherFile");
        var ext = filename.match(re);
        if (hash[ext[0]]) {
            $(vfileTag).show();
            $(votherFile).hide();
        } else {
            $(vfileTag).hide();
            $(votherFile).show();
        }
    }


    $(document).ready(function (e) {



        $(document).on('submit', ".vuploadFile", (function (e) {
            var fileObj = new FileUploader();
            e.preventDefault();
            var parent = $(this).parents(".fileUploadDiv").last();
            fileObj.init(parent);
            fileObj.uploader(this);
            $(fileObj).on('uploaded', function () {
                $(".fileUploadDiv").last().show();
            });
            $(fileObj).on('uploading', function () {

            });
        }));


        $(document).on('change', "input[type=file]", function () {
            check_extension(this);
            var fileObj = new FileUploader();
            var parent = $(this).parents(".fileUploadDiv").last();
            fileObj.init(parent);
            $(fileObj.vuploadButton).attr("disabled", false);
            function imageIsLoaded(e) {
                $(fileObj.vfileTag).attr('src', e.target.result);
            }
            if (this.files) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[this.files.length - 1]);
            }
        })


        $(".vfileContainer .delete_image").each(function (i) {

            $(this).show();

        })

        $(document).on("click", ".delete_image", function () {


            var obj = $(this).parents(".fileUploadDiv").first()[0];
            $(obj).hide(100, function () {
                $(obj).remove();
                imageList();
            })

        })

        $(".vfileContainer").sortable({stop: function (event, ui) {
                console.log("hello");
                imageList();
            }});



    });
</script>



</script>



