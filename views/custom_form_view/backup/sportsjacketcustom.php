<script>
<?php
$heading_mapping = array(
    'Body Fit' => 'body_fit',
    'Lapel Style & Design' => 'lapel_style_design',
    'Lapel Button Hole' => 'lapel_button_hole',
    'Handstitching' => 'handstitching',
    'Front Style' => 'front_style',
    'Front Edge' => 'front_edge',
    'Back Vent' => 'back_vent',
    'Sleeve Buttons' => 'sleeve_button',
    'Shoulder Padding' => 'shoulder_padding',
    'Upper Pocket' => 'upper_pocket',
    'Lower Pocket' => 'lower_pocket',
    'Ticket Pocket' => 'ticket_pocket',
    'Lining Styles' => 'lining_styles',
    'Lining Types' => 'lining_types',
    'Button' => 'button',
    'Elbow Patch' => 'elbow_patch',
    'Contrast Button Thread' => 'contrast_button_thread',
    'Contrast Button Hole On Lapel' => 'contrast_button_hole_on_lapel',
    'Contrasting First Sleeve Button Hole' => 'contrasting_first_sleeve_button_hole',
);

$styleElement = [];
foreach ($heading_mapping as $key => $value) {
    array_push($styleElement, $key);
}
?>
    var header_mapping = <?php echo json_encode($heading_mapping); ?>;
    var custom_form = 'nfw_sports_jacket_custom';
    var productStyleArray = {
<?php
for ($i = 0; $i < count($productArray); $i++) {
    echo '"cart_' . $productArray[$i] . '"';
    echo ": {";
    for ($j = 0; $j < count($styleElement); $j++) {
        echo "'$styleElement[$j]':'',";
    }
    echo "},";
}
?>
    };
    var productStyleArrayPrice = {
<?php
for ($i = 0; $i < count($productArray); $i++) {
    echo '"cart_' . $productArray[$i] . '"';
    echo ": {";
    for ($j = 0; $j < count($styleElement); $j++) {
        echo "'$styleElement[$j]':'',";
    }
    echo "},";
}
?>
    };
</script>




<?php
$bodyFit = array(
    'slim' => 'Slim Fit',
    'medium' => 'Medium Fit',
    'loose' => 'Loose Fit'
);
$lapel_style = array(
    'notch' => 'Notch Lapel',
    'shawl' => 'Shawl Lapel',
    'peak' => 'Peak Lapel'
);

$single_breasted = array(
    'button1' => '1 Button',
    'button2' => '2 Buttons',
    'button3' => '3 Buttons',
    'button4' => '4 Buttons',
);
$double_breasted = array(
    'button41' => '4 Buttons  1 Button Fasten',
    'button42' => '4 Buttons  2 Buttons Fasten',
    'button61' => '6 Buttons  1 Button Fasten',
    'button62' => '6 Buttons  2 Buttons Fasten',
);


$front_edge = array(
    'rounded' => 'Rounded ',
    'squared' => 'Squared',
);

$back_vent = array(
    'no' => 'No Vent',
    'center' => 'Center Vent',
    'side' => 'Side Vent'
);

$sleeve_button_3 = array(
    'flat3' => '3 Flat Buttons',
    'kissing3' => '3 Kissing Buttons',
);
$sleeve_button_4 = array(
    'flat4' => '4 Flat Buttons',
    'kissing4' => '4 Kissing Buttons',
);

$shoulder = array(
    'no' => 'No Padding',
    'natural' => 'Natural',
    'standard' => 'Standard'
);
$uppar_pocket = array(
    'patch' => 'Patch Pocket',
    'slanted' => 'Slanted Chest Pocket'
);
$lower_pocket = array(
    'patch_pockets' => 'Patch Pocket',
    'normal' => 'Normal Flap Pockets- Straight',
    'double' => 'Double Welt Pockets- Straight',
    'normalflap' => 'Normal Flap Pockets- Slanted',
    'doublewelt' => 'Double Welt Pockets- Slanted'
);

$patch = array(
    'black_leather' => 'Black Leather',
    'black_suede' => 'Black Suede',
    'dk_brown_leather' => 'Dark Brown Leather',
    'dk_brown_suede' => 'Dark Brown Suede',
);

$allbutton = array(
    'bll' => 'Black Lipshell',
    'bul' => 'Blue Lipshell',
    'bwl' => 'Brown Liphell',
    'eml' => 'Emerald Liphell',
    'rs' => 'River Shell',
    'mp' => 'MOP',
    'blcn' => 'Blue Corozo Nut',
    'ccn' => 'Cream Corozo Nut',
    'horn' => 'Horn',
    'lbh' => 'Light Brown Horn',
);
$febric = array(
    '1' => 'Fabric Code',
    '2' => 'Fabric Code',
    '3' => 'Fabric Code',
    '4' => 'Fabric Code',
    '5' => 'Fabric Code',
    '6' => 'Fabric Code',
);

$extra_button = array( 
    'Gold' => array(
        '1009-8',
        '1010-8',
        '1020-8',
        '1024-8',
        '1026-8',
    ),
    'Silver' => array(
        '1106-6',
        '1113-6',
        '1116-6',
        '1118-6',
        '1207-6',
        '1211-6',
        '1213-6',
        '1222-6',
        '1224-6',
    ),
    'Brass' => array(
        '1312-6',
        '1316-6',
        '1330-6',
        '1335-6',
        '1337-6',
    ),
    'Leather' => array(
        '1501-8',
        '1502-8',
        '1601-3',
        '1602-3',
    ),
);

$contrast_button = array(
    'Contrast Button Thread',
    'Contrast Button Hole On Lapel',
    'Contrasting First Sleeve Button Hole',
);
?>



<div class="row " style='padding:0px 15px'>


    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/body_fit/slim.jpg" class="iconimg"> Body Fit</a></li>
                <li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/lapel/lapel.jpg" class="iconimg">  Lapel</a></li>
                <li role="presentation">
                    <a href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/front_edge/rounded.jpg" class="iconimg">  Front & Back</a></li>
                <li role="presentation">
                    <a href="#sleevebutton" aria-controls="sleevebutton" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/sleeve_button/flat4.jpg" class="iconimg">  Sleeve Button</a></li>
                <li role="presentation">
                    <a href="#shoulderpadding" aria-controls="shoulderpadding" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/shoulder_padding/no.jpg" class="iconimg">  Shoulder Padding</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/pocket/uppar/no.jpg" class="iconimg">  Pocket</a></li>
                <li role="presentation">
                    <a href="#additionalfeature" aria-controls="additionalfeature" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg">  Additional Feature</a>
                </li>
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="http://onlineresearchclub.org/wp-content/uploads/2014/04/details-icon.png" class="iconimg">  
                        Summary</a>
                </li>
            </ul>
        </div>


        <div class="col-sm-9 suit_control" style="">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active vertical_tab_parent" id="body_fit">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Body Fit
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">

                                <?php foreach ($bodyFit as $key => $value) { ?>

                                    <div class="col-sm-4 col-sm-4">
                                        <div class="thumbnail bodyfitimg animated  style_selection navigat_error" parent_style="Body Fit" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/body_fit/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom">
                                            <div class="caption">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lapel Style -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="lapel">
                    <!-- 1 lepal style --> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Lapel Style & Design
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="lapel_style_tab">
                                <ul class="innerSelectionTab nav nav-tabs" role="tablist" >
                                    <?php
                                    $lpcount = 0;
                                    foreach ($lapel_style as $key => $value) {
                                        $lpcount++;
                                        ?>


                                        <li role="presentation" class=" <?php echo $lpcount == 1 ? 'active' : '' ?>">
                                            <a class="" href="#lapel_design_<?php echo $lpcount; ?>" aria-controls="lapel_design_<?php echo $lpcount; ?>" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                                <div class="thumbnail  animated " parent_style="Lapel Style" child_style="<?php echo $value; ?>">
                                                    <img class=" suit_controlZoom " src="./custom_form_view/suit/lapel/<?php echo $key; ?>.jpg" alt="..." style="width:140px">
                                                    <div class="caption towline">
                                                        <h3><?php echo $value; ?></h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>


                                        <!--                                    <div class="col-sm-3">
                                                                               
                                                                            </div>-->
                                    <?php } ?>
                                </ul>
                                <div class="tab-content" style="
                                     border: 1px solid #000;
                                     padding: 8px;
                                     height: 48px;
                                     margin-bottom: 15px;
                                     border-radius: 4px;
                                     border-top-left-radius: 0px;
                                     border-top-right-radius: 0px;
                                     ">
                                    <div role="tabpanel" class="tab-pane active" id="lapel_design_1">
                                        <div class="  " role="alert">
                                            <span class="">Lapel Design &nbsp;</span>
                                            <div class="btn-group btn-group" role="group" aria-label="...">
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='2  1/2" Trendy (Notch Lapel)'>2  1/2" Trendy</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='2  3/4" Modern (Notch Lapel)'>2  3/4" Modern</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error"  parent_style="Lapel Style & Design" child_style='3" Classic (Notch Lapel)'>3" Classic</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error"  parent_style="Lapel Style & Design" child_style='3   1/4" Traditional (Notch Lapel)'>3   1/4" Traditional</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="lapel_design_2">
                                        <center>
                                            <div class=" " role="alert" >

                                                <span class="">Lapel Design &nbsp;</span>
                                                <div class="btn-group btn-group" role="group" aria-label="...">
                                                    <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='To a Point [Modern] (Shawl Lapel)'>To a Point (Modern)</button>
                                                    <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='Classic (Shawl Lapel)'>Classic</button>

                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="lapel_design_3">
                                        <div class="" role="alert"  style="    float: right;">
                                            <span class="">Lapel Design &nbsp;</span>
                                            <div class="btn-group btn-group" role="group" aria-label="...">
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='2  3/4" Trendy (Peak Lapel)' >2  3/4" Trendy</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Style & Design" child_style='3" Modern (Peak Lapel)'>3" Modern</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error"  parent_style="Lapel Style & Design" child_style='3 1/4" Classic (Peak Lapel)'>3 1/4" Classic</button>
                                                <button type="button" class="btn btn-default sboiw style_selection navigat_error"  parent_style="Lapel Style & Design" child_style='3 1/2"Bold (Peak Lapel)'>3 1/2"Bold</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <style>
                                        span.buttonDiv_span1 {
                                            width: 174px!important;
                                            float: left;
                                        }
                                    </style>
                                    <div class="alert alert-default sub_heading " role="alert" >
                                        <span class="buttonDiv_span1">Lapel Button Hole &nbsp;</span>
                                        <div class="btn-group btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default active sboiw style_selection navigat_error" parent_style="Lapel Button Hole" child_style="Yes">Yes</button>
                                            <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lapel Button Hole" child_style="No"> No</button>
                                        </div>
                                    </div>

                                    <div class="alert alert-default sub_heading" role="alert">
                                        <span class="buttonDiv_span1">Handstitching &nbsp;</span>
                                        <div class="btn-group btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default active sboiw style_selection navigat_error" parent_style="Handstitching" child_style="Yes">Yes</button>
                                            <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Handstitching" child_style="No">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--                     Lapel button hole 
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><span class="fa-stack fa-lg">
                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                                    </span> 
                                                    Lapel Button Hole
                                                </h3>
                                            </div>
                                            <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
                                                <div class="alert alert-default sub_heading" role="alert">
                                                    Lapel Button Hole &nbsp;
                                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default pleat_area active style_selection navigat_error" parent_style=" Lapel Button Hole" child_style="No Pleat"> Lapel Button Hole</button>
                                                        <button type="button" class="btn btn-default pleat_area"  show_area="pleat_2_area"> No Lapel Button Hole</button>
                    
                                                    </div>
                                                </div>
                    
                                            </div>
                                        </div>
                    
                                         4 Handstitching 
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><span class="fa-stack fa-lg">
                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                                    </span> 
                                                    Handstitching
                                                </h3>
                                            </div>
                                            <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
                                                <div class="alert alert-default sub_heading" role="alert">
                                                    Handstitching &nbsp;
                                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default pleat_area active style_selection navigat_error" parent_style="Notch Lapel" child_style="No Pleat">Yes</button>
                                                        <button type="button" class="btn btn-default pleat_area"  show_area="pleat_2_area">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                </div>
                <!-- Lapel End -->
                <!-- Front & Back -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="front">
                    <!-- 1 front style -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Front Style
                            </h3>
                        </div>
                        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">


                            <div class="">
                                <ul class="innerSelectionTab nav nav-tabs" role="tablist" style="    border-bottom: 0px solid #000;">
                                    <li role="presentation" class=" active">
                                        <a href="#single_breasted" aria-controls="single_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/single_breasted/button1.jpg" class="iconimg ">  Single Breasted 
                                        </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#double_breasted" aria-controls="double_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Double Breasted 
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" style="
                                 /*background-color: rgba(232, 232, 232, 0.48);*/
                                 border: 1px solid #000;
                                 /* margin-top: 0px; */
                                 padding: 3px;
                                 margin-bottom: 15px;
                                 border-radius: 4px;
                                 border-top-left-radius: 0px;
                                 border-top-right-radius: 0px;
                                 ">
                                <div role="tabpanel" class="tab-pane active" id="single_breasted">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <?php
                                        $pleatCount = 0;
                                        foreach ($single_breasted as $key => $value) {
                                            $pleatCount++;
                                            ?>
                                            <div class="col-sm-3 col-sm-3 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Single Breasted (<?php echo $value; ?>)" >
                                                    <img src="./custom_form_view/suit/front_style/single_breasted/<?php echo $key; ?>.jpg" alt="..."  class="suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3><?php
                                                            $brarray = explode("  ", $value);
                                                            echo $brarray[0];
                                                            echo "<br>";
                                                            echo $brarray[1];
                                                            ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="double_breasted">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <?php
                                        $pleatCount = 0;
                                        foreach ($double_breasted as $key => $value) {
                                            $pleatCount++;
                                            ?>
                                            <div class="col-sm-3 col-sm-3 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Double Breasted (<?php echo $value; ?>)" >
                                                    <img src="./custom_form_view/suit/front_style/single_breasted/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3><?php
                                                            $brarray = explode("  ", $value);
                                                            echo $brarray[0];
                                                            echo "<br>";
                                                            echo $brarray[1];
                                                            ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2 front edge -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Front Edge
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">

                                <?php foreach ($front_edge as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Edge" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/front_edge/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            <div class="caption">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Back Vent
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">

                                <?php foreach ($back_vent as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Back Vent" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/back_vent/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            <div class="caption">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- F & B End -->
                <!-- Sleeve Button Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="sleevebutton">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Sleeve Buttons
                            </h3>
                        </div>
                        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">

                            <div class="lapel_style_tab">

                                <ul class="innerSelectionTab nav nav-tabs" role="tablist" style="    border-bottom: 0px solid #ddd;">

                                    <li role="presentation" class="active">
                                        <a href="#button4" aria-controls="button4" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/sleeve_button/kissing4.jpg" class="iconimg">  4 Buttons
                                        </a>
                                    </li>
                                    <li role="presentation" class=" ">
                                        <a href="#button3" aria-controls="button3" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/sleeve_button/kissing3.jpg" class="iconimg">  3 Buttons
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content" style="
                                 /*background-color: rgba(232, 232, 232, 0.48);*/
                                 border: 1px solid #000;
                                 /* margin-top: 0px; */
                                 padding: 3px;
                                 margin-bottom: 15px;
                                 border-radius: 4px;
                                 border-top-left-radius: 0px;
                                 border-top-right-radius: 0px;
                                 ">
                                <div role="tabpanel" class="tab-pane " id="button3">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <?php
                                        $pleatCount = 0;
                                        foreach ($sleeve_button_3 as $key => $value) {
                                            $pleatCount++;
                                            ?>
                                            <div class="col-sm-3 col-sm-3 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Sleeve Buttons" child_style="<?php echo $value; ?>" >
                                                    <img src="./custom_form_view/suit/sleeve_button/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3><?php echo $value; ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="button4">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <?php
                                        $pleatCount = 0;
                                        foreach ($sleeve_button_4 as $key => $value) {
                                            $pleatCount++;
                                            ?>
                                            <div class="col-sm-3 col-sm-3 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Sleeve Buttons" child_style="<?php echo $value; ?>" >
                                                    <img src="./custom_form_view/suit/sleeve_button/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3><?php echo $value; ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <!-- Shoulder Padding  -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="shoulderpadding">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Shoulder Padding
                            </h3>
                        </div>
                        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
                            <div class="row">
                                <?php
                                $pleatCount = 0;
//print_r($shoulder);
                                foreach ($shoulder as $key => $value) {
                                    //  $pleatCount++;
                                    ?>
                                    <div class="col-sm-4 col-sm-4 pleat_selection" style="">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Shoulder Padding" child_style="<?php echo $value; ?>" >
                                            <img src="./custom_form_view/suit/shoulder_padding/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            <div class="caption" style="  margin-top: -4px;">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Shoulder Padding End -->
                <!-- Pocket Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">
                    <!-- 1  style -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Breast Pocket
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">
                                <?php foreach ($uppar_pocket as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Upper Pocket" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/pocket/uppar/<?php echo $key; ?>.jpg" alt="..."  class=" suit_controlZoom ">
                                            <div class="caption towline">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- 2 design -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Lower Pocket
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">
                                <?php foreach ($lower_pocket as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Lower Pocket" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/pocket/lower/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            <div class="caption towline">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Ticket Pocket
                            </h3>
                        </div>
                        <div class="panel-body" style="">
                            <div class="alert alert-default sub_heading" role="alert" >
                                <span class=""></span>
                                <div class="btn-group btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Ticket Pocket" child_style='Yes'>Yes</button>
                                    <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Ticket Pocket" child_style='No'>No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pocket End -->
                <!-- Additional Feature -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="additionalfeature">
                    <!-- 1 front style -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Lining 
                            </h3>
                        </div>
                        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">


                            <div class="row">
                                <div class="alert alert-default sub_heading" role="alert" style="">
                                    <span class="buttonDiv_span">Lining Styles &nbsp;</span>
                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lining Styles" child_style="Half Lined">Half Lined</button>
                                        <button type="button" class="btn btn-default sboiw style_selection navigat_error" parent_style="Lining Styles" child_style="Fully Lined">Fully Lined</button>
                                    </div>
                                </div>
                            </div>

                            <div class="lapel_style_tab">
                                <span>Lining Types</span>
                                <ul class="innerSelectionTab nav nav-tabs" role="tablist" style="    border-bottom: 0px solid #ddd;">
                                    <li role="presentation" class=" active">
                                        <a href="#matching" aria-controls="matching" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/single_breasted/button1.jpg" class="iconimg">  Matching 
                                        </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#contrast" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Contrast 
                                        </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#fancy" aria-controls="fancy" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Fancy 
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" style="
                                 /*background-color: rgba(232, 232, 232, 0.48);*/
                                 border: 1px solid #000;
                                 /* margin-top: 0px; */
                                 padding: 3px;
                                 margin-bottom: 15px;
                                 border-radius: 4px;
                                 border-top-left-radius: 0px;
                                 border-top-right-radius: 0px;
                                 ">

                                <div role="tabpanel" class="tab-pane active" id="matching">
                                    <div class="  " role="alert" style="margin-top: 10px;">

                                        <div class="col-sm-3 col-sm-3 pleat_selection">
                                            <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Lining Types" child_style="Matching" extra_price="">
                                                <img src="./custom_form_view/suit/fabric/matching.jpg" alt="..." class=" suit_controlZoom " style="height: 90px;width: 121px;">
                                                <div class="caption towline" style="  margin-top: -4px;">
                                                    <h3>Matching</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="clear: both"></div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane " id="contrast">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <div id="owl-demo_1" class="owl-carousel owl-theme">
                                            <?php
                                            $pleatCount = 0;
                                            foreach ($febric as $key => $value) {
                                                $pleatCount++;
                                                ?>
                                                <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                    <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Lining Types" child_style="Contrast (<?php echo $value; ?>)" extra_price="">
                                                        <img src="./custom_form_view/suit/fabric/<?php echo $key; ?>.jpg" alt="..."  style="height: 90px;width: 121px;">
                                                        <div class="caption towline" style="  margin-top: -4px;">
                                                            <h3><?php echo $value; ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div style="clear: both"></div>
                                        </div>
                                        <center>
                                            <div class="customNavigation" style="margin-bottom: 10px;">
                                                <a class="btn btn-default btn-xs prev prev1">&larr;</a>
                                                <a class="btn btn-default btn-xs prev remove2 style_selection reset_fabric_selection" parent_style="Lining Types" child_style="-" extra_price="">
                                                    <i class="icon-reply-all"></i> Remove
                                                </a>
                                                <a class="btn btn-default btn-xs next next1">&rarr;</a>
                                            </div>
                                        </center>
                                    </div>
                                    <script>
                                        $(document).ready(function () {

                                            var owl = $("#owl-demo_1");
                                            owl.owlCarousel({
                                                pagination: false,
                                                items: 4, //10 items above 1000px browser width
                                                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                itemsTablet: [600, 2], //2 items between 600 and 0
                                                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                            });
                                            // Custom Navigation Events
                                            $(".next1").click(function () {
                                                owl.trigger('owl.next');
                                            })
                                            $(".prev1").click(function () {
                                                owl.trigger('owl.prev');
                                            })


                                        });</script>
                                </div>


                                <div role="tabpanel" class="tab-pane " id="fancy">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <div id="owl-demo_2" class="owl-carousel owl-theme">
                                            <?php
                                            $pleatCount = 0;
                                            foreach ($febric as $key => $value) {
                                                $pleatCount++;
                                                ?>
                                                <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                    <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Lining Types" child_style="Fancy <?php echo $value; ?> ($30 Extra)" extra_price="30">
                                                        <img src="./custom_form_view/suit/fabric/<?php echo $key; ?>.jpg" alt="..." style="height: 90px;width: 121px;">
                                                        <div class="caption towline" style="  margin-top: -4px;">
                                                            <h3>
                                                                <?php
                                                                echo $value;
                                                                echo "<br>";
                                                                echo "($30 Extra)";
                                                                ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div style="clear: both"></div>
                                        </div>
                                        <center>
                                            <div class="customNavigation" style="margin-bottom: 10px;">
                                                <a class="btn btn-default btn-xs prev prev2">&larr;</a>
                                                <a class="btn btn-default btn-xs prev remove2 style_selection reset_fabric_selection" parent_style="Lining Types" child_style="-" extra_price="">
                                                    <i class="icon-reply-all"></i> Remove
                                                </a>
                                                <a class="btn btn-default btn-xs next next2">&rarr;</a>
                                            </div>
                                        </center>
                                    </div>
                                    <script>
                                        $(document).ready(function () {

                                            var owl = $("#owl-demo_2");
                                            owl.owlCarousel({
                                                pagination: false,
                                                items: 4, //10 items above 1000px browser width
                                                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                itemsTablet: [600, 2], //2 items between 600 and 0
                                                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                            });
                                            // Custom Navigation Events
                                            $(".next2").click(function () {
                                                owl.trigger('owl.next');
                                            })
                                            $(".prev2").click(function () {
                                                owl.trigger('owl.prev');
                                            })


                                        });
                                    </script>
                                </div>


                            </div>


                            <style>
                                #owl-demo .item{

                                }
                                .customNavigation{

                                }
                                //use styles below to disable ugly selection
                                .customNavigation a{
                                    -webkit-user-select: none;
                                    -khtml-user-select: none;
                                    -moz-user-select: none;
                                    -ms-user-select: none;
                                    user-select: none;
                                    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                                }
                            </style>
                        </div>
                    </div>

                    <!-- 2 front edge -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Button
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">
                                <div class="col-sm-4" style="    margin-bottom: -10px;">
                                    <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="Standard "  extra_price="">

                                        <div class="col-md-4 button_img" style="">
                                            <img src="./custom_form_view/suit/all-button/b9.jpg" alt="..."  class=" suit_controlZoom ">
                                        </div>
                                        <div class="col-md-8 button_lable" style="">
                                            <div class="  ">
                                                <div class="">
                                                    <span>Standard</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                                <div style="clear: none"></div>

                                <?php foreach ($allbutton as $key => $value) { ?>
                                    <div class="col-sm-4 ">
                                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?> ($30 Extra)" extra_price="30">

                                            <div class="col-md-4 button_img" style="">
                                                <img src="./custom_form_view/suit/suitbutton/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            </div>
                                            <div class="col-md-8 button_lable" style="">
                                                <div class="  ">
                                                    <div class="">
                                                        <span><?php echo $value; ?></span>
                                                        <br/>
                                                        ($30 Extra)
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both"></div>
                                        </div>
                                    </div>

                                <?php } ?>

                                <div style="clear: both"></div>
                                <?php
                                foreach ($extra_button as $key => $value) {
                                    ?>
                                    <div class="col-sm-4 " style="    margin-bottom: -10px;">
                                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo str_replace("<br>", "", $key); ?>" extra_price="30">

                                            <div class="col-md-4 button_img" style="">
                                                <img src="./custom_form_view/suit/suitbuttongsbl/<?php echo $value[0] ?>.JPG" alt="..." class=" suit_controlZoom ">
                                            </div>
                                            <div class="col-md-8 button_lable" style="">
                                                <div class="  ">
                                                    <div class="">
                                                        <span>
                                                            <?php echo $key; ?> 
                                                        </span>
                                                    </div>
                                                </div>
                                                <select name=""   class="extra_buttons">
                                                    <?php
                                                    foreach ($value as $k => $v) {

                                                        echo "<option value='" . $key . " " . $v . " ($30 Extra)'>" . $v . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                                ($30 Extra)
                                            </div>
                                            <div style="clear: both"></div>
                                        </div>
                                    </div>


                                <?php } ?>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Elbow Patch
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">

                            <div class="row">

                                <?php foreach ($patch as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Elbow Patch" child_style="<?php echo $value; ?>">
                                            <img src="./custom_form_view/suit/elbow_patch/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            <div class="caption">
                                                <h3><?php echo $value; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Contrast Button Hole
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row">
                                <?php foreach ($contrast_button as $key => $value) { ?>
                                    <div class="alert alert-default sub_heading" role="alert" >
                                        <span class="buttonDiv_span pull-left" style="width: 300px;"><? echo $value; ?> &nbsp;</span>
                                        <div class="style_selection navigat_error" parent_style="<? echo $value; ?>">
                                            <select class="pull-right "   style="
                                                    background-color: #FFFFFF;
                                                    color: #000;
                                                    padding: 5px 10px;
                                                    border: 2px solid #F00;
                                                    ">
                                                <option>Select An Option</option>  
                                                <option>Matching Base Color for Lining</option>
                                                <option>Black</option>
                                                <option>Navy</option>
                                                <option>Charcoal</option>
                                                <option>Silver</option>
                                                <option>Red</option>
                                                <option>Soft Pink</option>

                                            </select>
                                        </div>
                                        <div style="clear: both"></div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                
                </div>
                <!-- Additional Feature End --> 

                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="summary">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Summary
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                            <div class="row" style="  padding: 0px 10px;">
                                <div class="measurment_summery"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- END ALL -->
            </div>
        </div>
        <!--custom navigation-->
        <? include 'custom_navigation.php'; ?>
        <!--end of custom navigation-->

    </div>

</div>

<script>


    function customDefaultSet(prd_id) {
        var temp = productStyleArray[prd_id];
       
        for (j in temp) {
            if (j.indexOf("Contrast") == 0) {
                productStyleArray[prd_id][j] = '-';
                productStyleArrayPrice[prd_id][j] = '';
            }

        }
        productStyleArray[prd_id]['Front Style'] = 'Single Breasted (2 Buttons)';
        productStyleArray[prd_id]['Sleeve Buttons'] = '4 Flat Buttons';
        productStyleArray[prd_id]['Lining Types'] = 'Matching';


    }
    function customsetdefalt() {
        for (i in productStyleArray) {
            customDefaultSet(i);
        }
    }

    customsetdefalt();
</script>