


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
);
$double_breasted = array(
    'button42' => '4 Buttons  2 Buttons Fasten',
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
    'no_pocket' => 'No Pocket',
    'slanted' => 'Slanted Breast Pocket'
);


$lapel_facing = array(
    'satin' => 'Satin',
    'grosgrain' => 'Grosgrain',
);


$lower_pocket = array(
    'normal' => 'Straight Flap Pockets',
    'double' => 'Straight Pipe Pockets ',
);

$patch = array(
    'black_leather' => 'Black Leather',
    'black_suede' => 'Black Suede',
    'dk_brown_leather' => 'Dark Brown Leather',
    'dk_brown_suede' => 'Dark Brown Suede',
);

$allbutton = array(
    'bll' => 'Satin Covered',
    'bul' => 'Grosgrain Covered',
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

                    <?php
//                         start of body fit 
                    echo get_custom_data('43');
//                         end of body fit
                    ?>
                </div>
                <!-- Lapel Style -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="lapel">
                    <!-- 1 lepal style --> 
                    <?php
                    #lapel
                    $h0 = 'Jacket Lapel Style & Design';
                    $h01 = 'Lapel Style & Design';
                    echo panel_creator($h01, multi_tab_element($h0, $h01));
                    #lapel
                    ?>

                    <div class="navigate">
                        <?php echo get_custom_data('85'); ?>
                    </div>


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
                    <?php echo get_custom_data('52'); ?>
                    <!-- Back vent -->
                    <?php echo get_custom_data('53'); ?>


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
                    <?php echo get_custom_data('56'); ?>
                </div>
                <!-- Shoulder Padding End -->
                <!-- Pocket Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">
                    <!-- 1  style -->
                    <?php echo get_custom_data('83'); ?>

                    <!-- 2 design -->
                    <?php echo get_custom_data('84'); ?>

                    <!-- 3 -->
                    <!--start of ticket pocket-->

                    <?php echo get_custom_data('59'); ?>
                    <!--end of ticket pocket-->
                    <!--end of ticket pocket-->
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
                                Lining Types
                            </h3>
                        </div>
                        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">

                            <p style="    margin: -8px 0px 11px;">
                                <b>Fully Lined</b> is standard <b>Lining Styles</b>

                            </p>

                            <div class="lapel_style_tab">

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

                                    <li role="presentation" class="">
                                        <a href="#bemberg" aria-controls="bemberg" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Bemberg
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

                                <div role="tabpanel" class="tab-pane " id="bemberg">
                                    <div class="  " role="alert" style="margin-top: 10px;">
                                        <div id="owl-demo_3" class="owl-carousel owl-theme">
                                            <?php
                                            $pleatCount = 0;
                                            foreach ($febric as $key => $value) {
                                                $pleatCount++;
                                                ?>
                                                <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                    <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Lining Types" child_style="Bemberg <?php echo $value; ?> ($30 Extra)" extra_price="30">
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
                                                <a class="btn btn-default btn-xs prev prev3">&larr;</a>
                                                <a class="btn btn-default btn-xs prev remove3 style_selection reset_fabric_selection" parent_style="Lining Types" child_style="-" extra_price="">
                                                    <i class="icon-reply-all"></i> Remove
                                                </a>
                                                <a class="btn btn-default btn-xs next next3">&rarr;</a>
                                            </div>
                                        </center>
                                    </div>
                                    <script>
                                        $(document).ready(function () {

                                            var owl = $("#owl-demo_3");
                                            owl.owlCarousel({
                                                pagination: false,
                                                items: 4, //10 items above 1000px browser width
                                                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                itemsTablet: [600, 2], //2 items between 600 and 0
                                                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                            });
                                            // Custom Navigation Events
                                            $(".next3").click(function () {
                                                owl.trigger('owl.next');
                                            })
                                            $(".prev3").click(function () {
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
                                    <div class="thumbnail animated style_selection navigat_error selected" parent_style="Button" child_style="Standard " extra_price="">

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
                                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?>" extra_price="">

                                            <div class="col-md-4 button_img" style="">
                                                <img src="./custom_form_view/suit/suitbutton/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                            </div>
                                            <div class="col-md-8 button_lable" style="">
                                                <div class="  ">
                                                    <div class="">
                                                        <span><?php echo $value; ?></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both"></div>
                                        </div>
                                    </div>

                                <?php } ?>

                                <div style="clear: both"></div>

                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Additional Feature End --> 

                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="summary">
                     <?php
                    include 'custom_form_view/customformsummary.php';
                    ?> 
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