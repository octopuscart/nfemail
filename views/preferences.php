<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);

$posturelist = [89, 90, 91, 92, 93];



$posturearray = array();
foreach ($posturelist as $kid => $pid) {
    $query1 = "SELECT title
FROM nfw_custom_element
WHERE id =$pid";
    $postitle = end(resultAssociate($query1));

    $query2 = "SELECT child_label as title, set_image as image FROM `nfw_custom_element_field` 
               where nfw_custom_element_id = $pid";
    $posdata = resultAssociate($query2);
    $posarray = array();
    foreach ($posdata as $key => $value) {
        $posarray[$value['title']] = $value['image'];
    }
    $posturearray[$postitle['title']] = $posarray;
}


if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>
    <?php
} else {


    if (isset($_REQUEST['setDefaultMeasurement'])) {
        $authobj->userDefaultMeasurement($_SESSION['user_id'], $_REQUEST['tag_name'], $_REQUEST['measurement_style']);
    }


    if (isset($_REQUEST['setDefaultStyle'])) {
        $authobj->userDefaultStyle($_SESSION['user_id'], $_POST['tag_name'], $_REQUEST['default_style']);
    }

    if (isset($_REQUEST['delete_style'])) {

        $authobj->deleteStyle($_REQUEST['delete_style']);
    }

    if (isset($_REQUEST['delete_measurement'])) {
        $authobj->deleteMeasurement($_REQUEST['delete_measurement']);
    }
    ?>


    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">My Preferences</p>
            <div style="margin-top: 10px;">  


            </div>

        </div>
    </section>
    <style>
        .close{
            opacity: 1;
        }
        .modal-header{
            padding: 3px 19px;
            background: black;
        }


    </style>
    <style>
        .table td {
            padding-top: 8px;
            padding-bottom: 6px;
        }
    </style>
    <style>
        .table th{
            border:none;
        }
        .table td{
            border:none;
        }
    </style>
    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-2 col-sm-2 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
                    <?php
                    include 'leftMenu.php';
                    ?>
                </aside>
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30"  style="width: 85%;">

                    <div class="panel panel-default" style="">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                        </div>
                        <div class="panel-body">


                            <div style="clear: both"></div>


                            <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;color:#000">
                                <!-- Nav tabs --> 
                                <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="    padding-top: 12px;     border-right: 1px solid #000; ">

                                    <?php
                                    $tag = $authobj->preferenceTag();
                                    for ($t = 0; $t < count($tag); $t++) {
                                        $bas_tag = $tag[$t]['tag_title'];
                                        $bas_tag_id = $tag[$t]['id'];
                                        $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                        $bas_tag_temp = strtolower($bas_tag_temp);
                                        ?>
                                        <li role="presentation" class="<?php echo $t == 0 ? 'active' : ''; ?>  ">
                                            <a class="" href="#<?php echo $bas_tag_temp; ?>" aria-controls="<?php echo $bas_tag_temp; ?>"  role="tab" data-toggle="tab">
                                                <?php echo $bas_tag; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>



                            <div class="col-sm-10" style="    padding-right: 0;">

                                <div class="tab-content">
                                    <?php
                                    $count = 0;

                                    for ($t = 0; $t < count($tag); $t++) {
                                        $bas_tag = $tag[$t]['tag_title'];
                                        $bas_tag_id = $tag[$t]['id'];
                                        $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                        $bas_tag_temp = strtolower($bas_tag_temp);
                                        $userid = $_SESSION['user_id'];
                                        $custom_style = $authobj->findStyleId($bas_tag_id, $userid);
                                        ?>
                                        <div role="tabpanel" class="custom_form_tables tab-pane <?php echo $t == 0 ? 'active' : ''; ?> " id="<?php echo $bas_tag_temp; ?>">

                                            <p style="   
                                               font: 300 37px 'Lato';
                                               color: #000;
                                               padding: 0px 10px;
                                               margin-bottom: 10px;
                                               text-align: center;
                                               border-bottom: 1px solid #D4D4D4;
                                               border-top: 1px solid #D4D4D4;
                                               ">

                                                <?php echo $bas_tag; ?>
                                            </p>
                                            <ul class="main_custom_tab nav nav-tabs" role="tablist" style="border-bottom: 0px solid #000; ">
                                                <li role="presentation" class="active">
                                                    <a href="#style<?php echo $bas_tag_id; ?>" aria-controls="style<?php echo $bas_tag_id; ?>" role="tab" data-toggle="tab">
                                                        Select Preferred Style </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#measurment_style<?php echo $bas_tag_id; ?>" aria-controls="measurment_style<?php echo $bas_tag_id; ?>" role="tab" data-toggle="tab">
                                                        Select Preferred Measurement Style</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content" style="
                                                 border: 1px solid #000;
                                                 padding: 7px 12px 5px 9px;
                                                 margin-bottom: 16px;
                                                 border-top-left-radius: 0px;
                                                 border-top-right-radius: 0px;">

                                                <div role="tabpanel" class="tab-pane fade in fabric_preview active" id="style<?php echo $bas_tag_id; ?>" style="padding-top: 10px">
                                                    <?php
                                                    if ($custom_style) {
                                                        ?>
                                                    <form method="post" class="preference_form" action="#">
                                                            <div class="">
                                                                <table class="table">
                                                                    <tr>
                                                                        <th style="">S.No.</th>
                                                                        <th style="">Set As Default Style Profile</th>
                                                                        <th style="">Updated / Created Date Time</th>
                                                                        <th style=""></th>
                                                                    </tr>
                                                                    <?php
                                                                    $count = 0;
                                                                    // print_r($res);
                                                                    foreach ($custom_style as $key => $value) {
                                                                        $count++;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $count; ?></td>
                                                                            <td>

                                                                                <input type="radio" id="radio_7_<?php echo $value['id'], $bas_tag_id; ?>" name="default_style" class="d_none" <?php if ($value['default'] == '1') { ?> checked <?php } ?>  value="<?php echo $value['id']; ?>" style="height: 31px;">
                                                                                <label for="radio_7_<?php echo $value['id'], $bas_tag_id; ?>" class="d_inline_m m_right_10">
                                                                                    <?php echo $value['style_profile']; ?>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $value['update_datetime']? $value['update_datetime'] :$value['datetime']; ?><br>
                                                                                <?php echo $value['datetime']; ?>

                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="btn btn-default btn-xs" title="Used in Order Number(s)."  value='<?php echo $value['id']; ?>' data-toggle="modal" data-target="#style_order_modal<?php echo $value['id']; ?>">
                                                                                    <i class="icon-expand color_grey_light_2 tr_inherit" style=""></i>
                                                                                </button>


                                                                                <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="style_order_modal<?php echo $value['id']; ?>">
                                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white">&times;</span></button>
                                                                                                <h4 class="modal-title" style="color:white;font-size: 15px"><?php echo $value['style_profile']; ?> Style profile used in following Order Number(s).</h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="panel panel-default">
                                                                                                    <div class="panel-body">
                                                                                                        <?php
                                                                                                        $idsss = $value['style_profile'];
                                                                                                        $queryss = resultAssociate("
                                                                                                                select order_no, nfo.id as id from nfw_product_order as nfo
                                                                                                                join nfw_product_cart as npc on npc.order_id = nfo.id
                                                                                                                where npc.customization_id = '$idsss'
                                                                                                                group by order_no
                                                                                                                ");
                                                                                                        foreach ($queryss as $key11 => $value11) {
                                                                                                            $oids = $value11['id'];
                                                                                                            echo "<a href='orderDetail.php?order_id=$oids' target='_blank'><li>" . $value11['order_no'] . "</a></li>";
                                                                                                        }
                                                                                                        ?>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <span data-toggle="" data-placement="left" title="Edit"><a href="./customFormUpdate.php?style_id=<?php echo $value['id']; ?>&tag_id=<?php echo $value['tag_id']; ?>&style=<?php echo $value['style_profile']; ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-edit"></i></a></span>

                                                                                <button name="" type="button" class="btn btn-default btn-xs "   title="View Summary" onclick='find_style("smodel_<?php echo $value['id'], '","', $value['style_profile'], '","', $value["datetime"] ?>", "style_profile_<?php echo $value['style_profile'] ?>")' id ="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#myModal">
                                                                                    <i class="icon-eye"></i>
                                                                                </button>

                                                                                <span data-toggle="" data-placement="left" title="Save PDF"><a href="./preferencesSummaryDetail.php?customized_id=<?php echo $value['id']; ?>" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>

                                                                                <?php if ($value['default'] === '1') { ?> 
                                                                                    <button class="" style="margin-left: 5px">
                                                                                        <i class="icon-heart color_grey_light_2 tr_inherit" style="color: #f00;"></i>
                                                                                    </button>
                                                                                <?php } ?>


                                                                                <button type="button" class="" style="margin-left: 5px;float: right;" title="Delete this style." name="delete_style" value='<?php echo $value['id']; ?>'>
                                                                                    <i class="icon-trash color_grey_light_2 tr_inherit" style=""></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        <textarea  id="smodel_<?php echo $value['id']; ?>" profile_name="<?php echo $value['profile_name']; ?>" style="display:none"><?php
                                                                            $raw_data = $value['custom_form_data'];
                                                                            echo phpjsonstyle($raw_data, "json");
                                                                            ?></textarea>


                                                                    <?php } ?>
                                                                </table>

                                                            </div>

                                                            <input type="hidden" name="tag_name" value="<?php echo $bas_tag_id; ?>">
                                                            <!-- body -->
                                                            <button type="submit" name="setDefaultStyle" class="btn btn-default btn-sm redButton" disabled style="display:none">
                                                                <i class="icon-check"></i> Submit
                                                            </button>
                                                        <?php } ?> 
                                                    </form>

                                                </div>




                                                <div role="tabpanel" class="tab-pane fade in fabric_preview" id="measurment_style<?php echo $bas_tag_id; ?>" style="padding-top: 10px">
                                                    <form method="post" class="preference_form" action="#"> 
                                                        <?php
                                                        $order_mesurement = $authobj->userMeasurment($bas_tag_id, $_SESSION['user_id']);
                                                        if ($order_mesurement) {
                                                            ?>
                                                            <div class="">


                                                                <table class="table">
                                                                    <tr>
                                                                        <th style="">S.No.</th>
                                                                        <th style="">Set As Default Measurement Profile</th>
                                                                        <th style="">Updated/Created Date Time</th>
                                                                        <th style="">View Detail</th>

                                                                    </tr>
                                                                    <?php
//                                                                    echo "<pre>";
//                                                                    print_r($order_mesurement);
                                                                    for ($i = 0; $i < count($order_mesurement); $i++) {
                                                                        $data = $order_mesurement[$i];
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i + 1; ?></td>
                                                                            <td>
                                                                                <input type="radio" id="radio_2_<?php echo $i, $bas_tag_id; ?>" name="measurement_style" class="d_none" value="<?php echo $data['id']; ?>" <?php if ($data['default'] == '1') { ?> checked <?php } ?> style="height: 31px;">
                                                                                <label for="radio_2_<?php echo $i, $bas_tag_id; ?>" class="d_inline_m m_right_10">
                                                                                    <?php echo $data['measurement_profile']; ?>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $value['update_datetime']? $value['update_datetime'] :$value['datetime'];?><br>
                                                                                <?php echo $data['datetime']; ?>
                                                                            </td>
                                                                            <td>


                                                                                <button type="button" class="btn btn-default btn-xs" title="Used in Order Number(s)."  value='<?php echo $value['id']; ?>' data-toggle="modal" data-target="#mes_order_modal<?php echo $data['id']; ?>">
                                                                                    <i class="icon-expand color_grey_light_2 tr_inherit" style=""></i>
                                                                                </button>


                                                                                <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="mes_order_modal<?php echo $data['id']; ?>">
                                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white">&times;</span></button>
                                                                                                <h4 class="modal-title" style="color:white;font-size: 15px"><?php echo $data['measurement_profile']; ?>  profile used in following Order Number(s).</h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="panel panel-default">
                                                                                                    <div class="panel-body">
                                                                                                        <?php
                                                                                                        $idsss = $data['measurement_profile'];
                                                                                                        $queryss = resultAssociate("
                                                                                                                select order_no, nfo.id as id from nfw_product_order as nfo
                                                                                                                join nfw_product_cart as npc on npc.order_id = nfo.id
                                                                                                                where npc.measurement_id = '$idsss'
                                                                                                                group by order_no
                                                                                                                ");
                                                                                                        foreach ($queryss as $key11 => $value11) {
                                                                                                            $oids = $value11['id'];
                                                                                                            echo "<a href='orderDetail.php?order_id=$oids' target='_blank'><li>" . $value11['order_no'] . "</a></li>";
                                                                                                        }
                                                                                                        ?>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <span data-toggle="" data-placement="left" title="Edit"><a href="./measurementUpdate.php?measurement_id=<?php echo $data['id']; ?>&tag_id=<?php echo $data['tag_id'] ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-edit"></i></a></span>

                                                                                <button name="" type="button" class="btn btn-default btn-xs" onclick='find_measurement("mmodel_<?php echo $data['id'], '","', '1', '","', $data['datetime'] ?>", "<?php echo $data['measurement_profile']; ?>")' id ="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#myModal1">
                                                                                    <i class="icon-eye"></i>
                                                                                </button>
                                                                                <span data-toggle="" data-placement="left" title="Save PDF"><a href="./preferencesMeasurementDetail.php?measurement_id=<?php echo $data['id']; ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>

                                                                                <?php if ($data['default'] == '1') { ?> 

                                                                                    <button class="" style="margin-left: 5px">
                                                                                        <i class="icon-heart color_grey_light_2 tr_inherit" style="color: #f00;"></i>
                                                                                    </button>
                                                                                <?php } ?>

                                                                                <button type="button" class="" style="margin-left: 5px;float: right;" title="Delete this measurement profile." name="delete_measurement" value='<?php echo $data['id']; ?>'>
                                                                                    <i class="icon-trash color_grey_light_2 tr_inherit" style=""></i>
                                                                                </button>
                                                                                <textarea  id="mmodel_<?php echo $data['id']; ?>" style="display:none"><?php
                                                                                    $raw_data = $data['measurement_data'];
                                                                                    echo phpjsonstyle($raw_data, "json");
                                                                                    echo "#####";
                                                                                    $raw_data = $data['posture_data'];
                                                                                    echo phpjsonstyle($raw_data, "json");
                                                                                    echo "#####";
                                                                                    echo $data['user_images'];
                                                                                    ?></textarea>

                                                                            </td>
                                                                        </tr>

                                                                    <?php } ?>
                                                                </table>

                                                            </div>
                                                            <div style="clear: both"></div>

                                                            <!-- body -->
                                                            <input type="hidden" name="tag_name" value="<?php echo $bas_tag_id; ?>">
                                                            <button type="submit" name="setDefaultMeasurement" class="btn btn-default btn-sm redButton" style="display:none">
                                                                <i class="icon-check"></i> Submit
                                                            </button>
                                                        <?php } ?>
                                                    </form>

                                                </div>

                                            </div> 
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>

                            <div style="clear: both"></div>



                            <div class="col-md-12 " style="    margin-top: 20px;
                                 border-top: 1px solid;
                                 padding-top: 20px;">
                                <h2 style="font: 300 37px 'Lato';color: #000;    margin-bottom: 20px;">
                                    Newsletters Preferences
                                </h2>
                                <p> 
                                    <input type="checkbox" id="subscribe_check" name="" class="d_none product_checkBox"  >
                                    <label for="subscribe_check" class="d_inline_m m_right_10" style="margin: 0px 0px 24px 0px;"></label>
                                    Check Box for :  I would  like to subscribe to Nita Fashions newsletter. 
                                    </br><small style="color: rgba(185, 0, 0, 0.77);
                                                margin-left: 42px;">Uncheck Box for: Unsubscribe to Nita Fashions newsletter.</small>
                                </p>

                                <div class="col-md-1"></div>
                                <div class="col-md-10" style="margin: 20px 0px 0px -48px;display:none" id="block_frequncey">

                                    <p style="    border-bottom: 1px solid;
                                       background-color: #000;
                                       color: #fff;
                                       padding: 2px 9px;">
                                        <i class="icon-repeat color_grey_light_2 tr_inherit" style="color: #f00;"></i>

                                        Frequency</p>

                                    <div> <input type="radio" checked="true" id="radio_1" name="frequency" class="d_none" valuecheck="Full Experience"/>
                                        <label for="radio_1" class="d_inline_m m_right_10" style="margin: 10px 0px 0px 0;">Full Experience </label>
                                    </div>

                                    <br/>
                                    <div> <input type="radio"  id="radio_5" name="frequency" class="d_none" valuecheck="Monthly">
                                        <label for="radio_5" class="d_inline_m m_right_10"  style="margin: -11px 0px 0px 0;">Monthly</label>
                                    </div>
                                    <br/>
                                    <div>
                                        <input type="radio"  id="radio_2" name="frequency" class="d_none" valuecheck="Sales/Promotion"/>
                                        <label for="radio_2" class="d_inline_m m_right_10" style="margin: -11px 0px 0px 0;">Sales/Promotion</label>

                                    </div> 
                                    <br/>
                                    <div> <input type="radio"  id="radio_3" name="frequency" class="d_none" valuecheck="New Arrival">
                                        <label for="radio_3" class="d_inline_m m_right_10"  style="margin: -11px 0px 0px 0;">New Arrival </label>
                                    </div>
                                    <br/>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--banners-->
            </div>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop=""
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <form method="post" action="#">
                <div class="modal-header" style="color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Style Detail <span id="profile_id"></span>
                    </p>
                </div>

                <div class="modal-body">

                    <center>
                        <table id="model_style" style="border:1px solid #A0A0A0;line-height: 15px;width:100%">

                        </table>
                    </center>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>

                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog"   data-backdrop=""
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-left: 15%;">
            <form method="post" action="#">
                <div class="modal-header" style="background:#000;color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Measurement Detail <span id="mes_id"></span>
                    </p>
                </div>

                <div class="modal-body">

                    <center>


                        <table id="meaurement_style" style="font-size:14px;border:1px solid #A0A0A0;width:100%">

                        </table>
                    </center>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>
                    <!--                    <button type="submit" class="btn btn-primary" name="updateMesurement">
                                            Submit changes
                                        </button>-->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->



<script>

    function find_tag_id(obj) {
        var ids = obj.id;
        //console.log(ids);
        window.location.replace("preferences.php?tagid=" + ids);
    }
</script>
<script>
    $(function () {

        var newsalert = {
            'Full Experience': {'title': 'Full Experience', 'description': 'I want the full Nita Fashions Experience.'},
            'Sales/Promotion': {'title': 'Sales/Promotion', 'description': 'I would like to only know about products that are on Sales/Promotion.'},
            'New Arrival': {'title': 'New Arrival', 'description': 'I would like to only know about products that are New/Trending.'},
            'Monthly': {'title': 'Monthly Subscription', 'description': 'I would like to receive monthly newsletters subscription from Nita Fashions.'},
        }
//         news letter
        function getStatus(a) {
            $.ajax({
                url: 'ajaxController.php',
                method: "post",
                data: {'news_letters_subscribe': 'card', },
                success: function (data) {
                    if (data) {

                        var jdata = JSON.parse(data);
                        console.log(jdata);
                        if (jdata.length) {
                            var fs = jdata[0].frequency;

                            $("input[valuecheck='" + fs + "']")[0].checked = true;
                            $("#block_frequncey").show(100);
                            $("#subscribe_check")[0].checked = true;
                            if (a) {
                                swal(newsalert[fs]['title'], newsalert[fs]['description'], "success");
                            }
                        }

                    }
                    ;
                }
            });
        }


        function setStatus(a) {
            var subs = $("#subscribe_check")[0].checked;

            var feq = $("input[valuecheck]:checked").attr("valuecheck");
            console.log(feq);
            $.ajax({
                url: 'ajaxController.php',
                method: "post",
                data: {'news_letters_subscribe': 'card', 'frequency': feq, 'subscribe': subs},
                success: function (data) {
                    console.log(data);
                    getStatus(a);
                }
            });

        }

        $("input[name='frequency']").click(function () {
            setStatus(1);
        })


        getStatus();
        $("#subscribe_check").click(function () {
            var obj = this;
            if (this.checked) {
                $("#block_frequncey").show(100);
                swal({title: "Welcome",
                    text: "Confirm to subscribe to Nita Fashions newsletter. ",
//                    type: "warning", 
                    imageUrl: "../assets/nf_logoalert.png",
                    showCancelButton: true,
                    confirmButtonColor: "green",
                    confirmButtonText: "Yes, Do it!",
                    closeOnConfirm: false,
                    //closeOnCancel: false
                }, function (isConfirm) {

                    if (isConfirm) {
                        setStatus();
                        swal("Thank You!", "You have subscribed from Nita Fashions newsletters. You can change your newsletters frequency", "success");
                    }
                    else {
                        obj.checked = false;
                        $("#block_frequncey").hide(100)
                    }
                });
            }
            else {
                $("#block_frequncey").hide(100)
                swal({title: "Are you sure?",
                    text: "You will not be able to receive newsletters form Nita Fashions !",
                    type: "warning", showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Do it!",
                    closeOnConfirm: false,
                    //closeOnCancel: false
                }, function (isConfirm) {

                    if (isConfirm) {
                        $.ajax({
                            url: 'ajaxController.php',
                            method: "post",
                            data: {'news_letters_unsubscribe': 'card'},
                            success: function (data) {
                                console.log(data);
                                swal("Unsubscribed!", "You have unsubscribed from Nita Fashions newsletters.", "success");
                                //getStatus();
                            }
                        });

                    }
                    else {
                        obj.checked = true;
                        $("#block_frequncey").show(100)
                    }
                });
            }
        })

//end of new letter



        $("button[name=delete_measurement]").click(function () {
            var obj = $(this);
            swal({title: "Are you sure?", text: "You will not be able to recover this measurement profile !", type: "warning", showCancelButton: true, confirmButtonColor: "#f00", confirmButtonText: "Yes, delete it !", cancelButtonText: "Cancel", closeOnConfirm: false, closeOnCancel: false}, function (isConfirm) {
                if (isConfirm) {
                    $(obj).attr("type", "submit");
                    swal({title: "Deleted !", text: "", type: "success"}, function () {
                        // setTimeout(function(){ $(obj).parents("form").first().submit();}, 500);
                        $(obj).click();
                    });
                } else {
                    swal("Cancelled", "Your measurement profile is safe :)", "error");
                }
            });
        });
        $("button[name=delete_style]").click(function () {
            var obj = $(this);
            swal({title: "Are you sure?", text: "You will not be able to recover this style !", type: "warning", showCancelButton: true, confirmButtonColor: "#f00", confirmButtonText: "Yes, delete it !", cancelButtonText: "Cancel", closeOnConfirm: false, closeOnCancel: false}, function (isConfirm) {
                if (isConfirm) {
                    $(obj).attr("type", "submit");
                    swal({title: "Deleted !", text: "Your selected style deleted.", type: "success"}, function () {
                        // setTimeout(function(){ $(obj).parents("form").first().submit();}, 500);
                        $(obj).click();
                    });
                } else {
                    swal("Cancelled", "Your style is safe :)", "error");
                }
            });
        });
        $(".d_none").click(function () {
            $(".redButton").removeAttr("disabled");
        });
        //$("#myModal").draggable();





<?php
if (isset($_POST['default_style'])) {
    echo "var style_id = ", $_POST['default_style'], ";";
    ?>
            var tab_id = $("input[type=radio][value=" + style_id + "][name='default_style']").parents(".tab-pane")[1].id;
            $("a[href='#" + tab_id + "']").tab('show')
<?php } ?>



<?php
if (isset($_POST['measurement_style'])) {
    echo "var measurement_id = ", $_POST['measurement_style'], ";";
    ?>
            var tab_id = $("input[type=radio][value=" + measurement_id + "][name='measurement_style']").parents(".tab-pane");
            $(tab_id).each(function () {
                $("a[href='#" + this.id + "']").tab('show')
            })
<?php } ?>



//        var tab_id = $("input[type=radio][value=160][name='measurement_style']").parents(".tab-pane")[0].id


        $("[type=radio]").click(function () {
            $(this).parents("form").first().find("[type='submit']").click();
        })


    });</script>

<script>

    function find_style(model_id, profile) {
        //console.log(profile);
        //console.log('#'+model_id);
        var styleObj = $("#" + model_id).val();
        //console.log(styleObj);
        var model_obj = JSON.parse(styleObj);
        //console.log(model_obj);
        htmls = "";
        for (i in model_obj) {
            htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'> <td style='line-height: 15px;'>" + i + "</td><td style='line-height: 15px;max-width: 230px;overflow-y: scroll;'>" + model_obj[i] + "</td></tr>"
        }
        $("#model_style").html(htmls);
        $("#profile_id").html("- Style Profile " + profile);
        //console.log($("#" + model_id).attr("profile_name"));
        //$("#myModal #profile_id").html($("#" + model_id).attr("profile_name"));

    }

</script>
<script>

    function find_measurement(model_id, measurement_profile) {
        console.log(measurement_profile);
        var measurementObj = $("#" + model_id).val();
        var meslist = measurementObj.split("#####");
        var posarray = <?php echo json_encode($posturearray); ?>;
        htmls = "";
        var measurement = meslist[0];
        var model_obj = JSON.parse(measurement);
        for (i in model_obj) {
            htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;'>" + i + "</td><td style='line-height: 15px;max-width: 230px;overflow-y: scroll;'>" + model_obj[i] + "</td></tr>"
        }
 
        var posture = JSON.parse(meslist[1]);
        htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white' colspan=2>Your Posture</td></tr>"
        for (pk in posture) {
            var pv = posture[pk];
            var image = posarray[pk][pv];
            htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;'>" + pk + "</td><td style='line-height: 15px;'><span style='margin-left: 13px'>" + pv + "</span> <br><img src='" + image + "' style='height: 100px;width:80px'></td></tr>"

        }

        htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white' colspan=2>Your Images</td></tr>"
        var userimges = JSON.parse(meslist[2]);
        var timg = "<div class='row'>";
        for (img in userimges) {
            timg += "<div class='thumbnail col-md-5' style='margin:5px'><img src='<?php echo $imageserver; ?>/medium/" + userimges[img] + "'></div>";
        }
        timg += "</div>"
        htmls += "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;' colspan=2>" + timg + "</td></tr>"
        $("#meaurement_style").html(htmls);
        // $("#mes_id").html(meas_id);
    }

</script>

