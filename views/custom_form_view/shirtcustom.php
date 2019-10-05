<?php

$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (10,11,13,14,15,16,17,18,19,20,21,24) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child']; 
}
$default_select_globle['Inner Collar Insert'] = '-';
$default_select_globle['Inner Cuff Insert'] = '-';
$default_select_globle['Inner Front Placket Insert'] = '-';
$default_select_globle['1st Monogram Placement'] = 'No Monogram';
$default_select_globle['1st Monogram Style'] = '-';
$default_select_globle['1st Monogram Initial'] = '-';
$default_select_globle['1st Monogram Color'] = '-';
$default_select_globle['2nd Monogram Placement'] = 'No Monogram';
$default_select_globle['2nd Monogram Style'] = '-';
$default_select_globle['2nd Monogram Initial'] = '-';
$default_select_globle['2nd Monogram Color'] = '-';
$default_select_globle['Button'] = 'Standard';
$default_select_globle['Sleeve Style'] = 'Long Sleeve';
$default_select_globle['Cuff Style'] = 'Single Cuff Rounded';
$default_select_globle['Watch'] = 'No';
$default_select_globle['Wrist Watch'] = 'No';

//  $default_select_globle['Lapel Style & Width']='3" Classic (Notch Lapel)';
//  $default_select_globle['Front Style']='Single Breasted (2 Buttons)';
//  $default_select_globle['Sleeve Buttons']='4 Flat Buttons';
//  $default_select_globle['Lining Type'] = 'Fully Lined';
//  $default_select_globle['Lining Style'] = 'Matching';
//  $default_select_globle['Button'] = 'Standard';
//  $default_select_globle['Elbow Patch'] = 'No';
//  $default_select_globle['Contrast Button Thread'] = '-';
//  $default_select_globle['Contrast Button Hole On Lapel'] = '-';
//  $default_select_globle['Contrast First Sleeve Button Hole'] = '-';
?>

<?php
$cuff_style = array(
    '1' => 'Single Cuff Rounded',
    '2' => 'Single Cuff Squared',
    '3' => 'Single Cuff Cutaway',
    '4' => 'French Cuff  Rounded',
    '5' => 'French Cuff Squared',
    '6' => 'French Cuff Cutaway',
    '7' => 'Convertible  Cuff Rounded',
    '8' => 'Convertible Cuff Square',
    '9' => 'Convertible Cuff Cutaway',
    '10' => '2 Buttons Rounded',
    '11' => '2 Buttons Squared',
    '12' => '2 Buttons Cutaway',
    '13' => 'Milanese Cuff',
);



$printed = array(
    '1.jpg' => 'P 44 ',
    '2.jpg' => 'P 45 ',
    '3.jpg' => 'P 49 ',
    '4.jpg' => 'P 50 ',
    '5.jpg' => 'P 51 ',
    '6.jpg' => 'P 58 ',
    '7.jpg' => 'P 61 ',
    '8.jpg' => 'P 63 ',
    '9.jpg' => 'P 65 ',
    '19.jpg' => 'P 67 ',
    '20.jpg' => 'P 78 ',
    '21.jpg' => 'P 96 ',
    '22.jpg' => 'P 98 ',
    '23.jpg' => 'P 99 ',
    '24.jpg' => 'P 100 ',
    '25.jpg' => 'P 102 ',
    '26.jpg' => 'P 104 ',
    '27.jpg' => 'P 105 ',
    '28.jpg' => 'P 106 ',
    '29.jpg' => 'P 107 ',
    '30.jpg' => 'P 109 ',
    '31.jpg' => 'P 110 ',
    '32.jpg' => 'P 112 ',
    '33.jpg' => 'P 113 ',
    '34.jpg' => 'P 115 ',
    '35.jpg' => 'P 135 ',
    '10.jpg' => 'P 126 ',
    '11.jpg' => 'P 127 ',
    '12.jpg' => 'P 128 ',
    '13.jpg' => 'P 129 ',
    '14.jpg' => 'P 130 ',
    '15.jpg' => 'P 131 ',
    '16.jpg' => 'P 144 ',
    '17.jpg' => 'P 145 ',
    '18.jpg' => 'P 148 ',
);
$solid = array(
    '8.jpg' => 'B 153 ',
    '9.jpg' => 'B 155 ',
    '10.jpg' => 'B 159 ',
    '11.jpg' => 'B 162 ',
    '12.jpg' => 'B 165 ',
    '13.jpg' => 'B 166 ',
    '14.jpg' => 'B 167 ',
    '15.jpg' => 'B 171 ',
    '16.jpg' => 'B 174 ',
    '17.jpg' => 'B 176 ',
    '18.jpg' => 'B 177 ',
    '1.jpg' => 'D 692 ',
    '2.jpg' => 'D 694 ',
    '3.jpg' => 'D 698 ',
    '4.jpg' => 'D 700 ',
    '5.jpg' => 'D 701 ',
    '6.jpg' => 'D 703 ',
    '7.jpg' => 'D 704 ',
);

$buttonarray = array(
    'standard' => 'Standard',
    'matching' => 'Matching',
    '1' => 'Thick Mop',
    '2' => 'Thin Mop',
    '3' => 'Black Lipshell'
);




$shirt_main_menu = array(
    'body_fit' => 'Body Fit ',
    'coller' => 'Collar',
    'sleeve_cuff' => 'Sleeve & Cuff Style',
    'frontback' => 'Front & Back',
    'pocketstyle' => 'Pocket',
    'bottomstyle' => 'Bottom',
    'collarcuff' => 'Collar & Cuff Feature',
    'labelbutton' => 'Button & Label',
    'monogram' => 'Monogram',
    'summary' => 'Summary',
);
?>







<div class="row " style=" padding:0px 15px">


    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <?php
                $count = 0;
                foreach ($shirt_main_menu as $key => $value) {
                    ?>

                    <li role="presentation" class="<?php echo $count == 0 ? 'active' : ''; ?> ">
                        <a class="" href="#<?php echo $key; ?>" aria-controls="<?php echo $key; ?>" role="tab" data-toggle="tab">
                            <img src="./custom_form_view/shirt/menu/<?php echo $key; ?>.jpg" class="iconimg"> &nbsp; <?php echo $value; ?></a>
                    </li>

                    <?php
                    $count++;
                }
                ?>

            </ul>
        </div>


        <div class="col-sm-9 suit_control" style="">
            <!-- Tab panes -->
            <div class="row" style="padding:0 15px">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active vertical_tab_parent" id="body_fit">
                        <?php
                        #start of body fit
                        echo get_custom_data('10');
                        #end of body fit
                        ?>
                    </div>
                    <!-- end of body fit -->


                    <!--start of coller style-->
                    <div role="tabpanel" class="tab-pane" id="coller">
                        <div class="">
                            <?php
//                         start of coller style
                            echo get_custom_data('11');
//                         end of coller
                            ?>
                            <div class="">

                                <?php
//                         start of button down collar style
//                                echo get_custom_data('12');
//                         end of coller
                                ?>


                                <!--start of Add 2 Buttons On The Collar Band-->
                                <?php
                                echo get_custom_data('13');
                                ?>
                                <!--end of Add 2 Buttons On The Collar Band-->


                                <!--start of  Collar & Cuff Stiffness-->
                                <?php
                                echo get_custom_data('14');
                                ?>
                                <!--end of  Collar & Cuff Stiffness-->


                                <!--start of Collar Stays-->
                                <?php
                                echo get_custom_data('15');
                                ?>
                                <!--end of Collar Stays-->

                            </div>

                        </div>
                    </div>
                    <!--end of coller style-->

                    <!--start of Sleeve Styles-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="sleeve_cuff">
                        <!-- 1 front style -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span> 
                                    Sleeve Style
                                </h3>
                            </div>
                            <div class="panel-body" style="padding: 15px 15px 0px 15px; ">


                                <div class="lapel_style_tab">
                                    <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #000;">

                                        <li role="presentation" class="active" >
                                            <a href="#double_breasted" aria-controls="double_breasted" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                                <img src="./custom_form_view/shirt/cuff_shirt/1.jpg" class="iconimg">  Long Sleeve
                                            </a>
                                        </li>
                                        <li role="presentation" class=" " >
                                            <a href="#single_breasted" aria-controls="single_breasted" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                                <img src="./custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg" class="iconimg ">  Short Sleeve
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="tab-content" style="
                                     border: 1px solid #000;
                                     padding: 3px;
                                     margin-bottom: 15px;">
                                    <div role="tabpanel" class="tab-pane " id="single_breasted">
                                        <div class="" role="alert" style="margin-top: 10px;">

                                            <div class="col-sm-4 col-sm-4 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Cuff Style" child_style="Short Sleeve Without Cuff" ng-click='selectStyle("Cuff Style", "Short Sleeve Without Cuff", "", {"Sleeve Style":"Short Sleeve", "Watch":"No", "Wrist Watch":"No", }, {"Wrist Watch":"hide"})'>
                                                    <img src="./custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg" alt="..."  class="suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3>
                                                            Short Sleeve Without Cuff
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-sm-4 pleat_selection">
                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Cuff Style" child_style="Short Sleeve With Cuff" ng-click='selectStyle("Cuff Style", "Short Sleeve With Cuff", "", {"Sleeve Style":"Short Sleeve", "Watch":"No", "Wrist Watch":"No"}, {"Wrist Watch":"hide"})'>
                                                    <img src="./custom_form_view/shirt/cuff_shirt/withcuff_sort.jpg" alt="..."  class="suit_controlZoom ">
                                                    <div class="caption towline" style="  margin-top: -4px;">
                                                        <h3>
                                                            Short Sleeve With Cuff
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both"></div>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane active" id="double_breasted">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <!-- -->
                                            <!-- 2 front edge -->
                                            <div class="panel panel-default" navigate_to='Cuff Style'>
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><span class="fa-stack fa-lg">
                                                            <i class="fa fa-circle fa-stack-2x"></i>
                                                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                                        </span> 
                                                        Cuff Style
                                                    </h3>
                                                </div>
                                                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                                                    <div class="row">

                                                        <?php foreach ($cuff_style as $key => $value) { ?>
                                                            <div class="col-sm-3">
                                                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Cuff Style" child_style="<?php echo $value; ?>" ng-click='selectStyle("Cuff Style", "<?php echo $value; ?>", "", {"Sleeve Style": "Long Sleeve"}, {"Wrist Watch":"show"})'> 
                                                                    <img src="./custom_form_view/shirt/cuff_shirt/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                                                    <div class="caption towline">
                                                                        <h3><?php echo $value; ?></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>

                                            <?php shirt_watch_option(); ?>

                                            <div style="clear: both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 2 front edge -->
                    </div>

                    <!--end of Sleeve Styles-->


                    <!--start of front and back-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="frontback">
                        <!--start of front-->
                        <?php
                        echo get_custom_data('16');
                        ?>
                        <!--start of back-->
                        <?php
                        echo get_custom_data('17');
                        ?>
                        <!-- end of back-->
                        <?php
                        echo get_custom_data('18');
                        ?>
                    </div>
                    <!--end of front and back-->


                    <!--start of pocket style-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocketstyle">
                        <?php echo get_custom_data('19'); ?>
                    </div>
                    <!--end of pocket style-->

                    <!--start of bottom-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="bottomstyle">
                        <!-- 1  style -->
                        <?php
                        echo get_custom_data('20');
                        ?>
                    </div>
                    <!--end of bottom-->

                    <!--start of Collars &  Cuffs Additional Features-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="collarcuff">




                        <!--start of Collar & Cuff Style-->
                        <?php
                        echo get_custom_data('21');
                        ?>
                        <!--end of Collar & Cuff Style-->


                        <!-- 1 front style -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span>    
                                    Collar & Cuff Insert
                                </h3>
                            </div>
                            <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
                                <div class="lapel_style_tab">
                                    <span navigate_to='Inner Collar Insert'>Inner Collar Insert</span>
                                    <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">

                                        <li role="presentation" class="active">
                                            <a href="#printed" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                                <img src="./custom_form_view/shirt/fabric/printed_collar/1.jpg" class="iconimg">  Printed 
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#solid" aria-controls="fancy" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                                <img src="./custom_form_view/shirt/fabric/solid_collar/8.jpg" class="iconimg">  Solid
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
                                     ">

                                    <div role="tabpanel" class="tab-pane  active" id="printed">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_1" class="owl-carousel owl-theme">
                                                <?php
                                                $pleatCount = 0;
                                                foreach ($printed as $key => $value) {
                                                    $pleatCount++;
                                                    ?>
                                                    <div class="col-sm-3 col-sm-3" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Collar Insert" child_style="Printed <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Collar Insert", "Printed <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/printed_collar/<?php echo $key; ?>" alt="..."  style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev prev1">&larr;</a>
                                                    <a class="btn btn-default btn-xs prev remove1 style_selection reset_fabric_selection" parent_style="Inner Collar Insert" child_style="-" extra_price="0" ng-click='selectStyle("Inner Collar Insert", "-")'>
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



                                            });
                                        </script>
                                    </div>


                                    <div role="tabpanel" class="tab-pane " id="solid">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_2" class="owl-carousel owl-theme">



                                                <?php
                                                $pleatCount = 0;
                                                foreach ($solid as $key => $value) {
                                                    $pleatCount++;
                                                    ?>


                                                    <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Collar Insert" child_style="Solid <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Collar Insert", "Solid <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/solid_collar/<?php echo $key; ?>" alt="..." style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev remove2 style_selection selected reset_fabric_selection" parent_style="Inner Collar Insert" child_style="-" extra_price="0" ng-click='selectStyle("Inner Collar Insert", "-")'>
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
                                <!-- Second -->
                                <div class="lapel_style_tab">
                                    <span navigate_to='Inner Cuff Insert'>Inner Cuff Insert</span>
                                    <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">

                                        <li role="presentation" class="active">
                                            <a href="#printed1" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                                <img src="./custom_form_view/shirt/fabric/printed_collar/1.jpg" class="iconimg">  Printed 
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#solid1" aria-controls="fancy" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                                <img src="./custom_form_view/shirt/fabric/solid_collar/8.jpg" class="iconimg">  Solid
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
                                     ">

                                    <div role="tabpanel" class="tab-pane  active" id="printed1">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_11" class="owl-carousel owl-theme">
                                                <?php
                                                $pleatCount = 0;
                                                foreach ($printed as $key => $value) {
                                                    $pleatCount++;
                                                    ?>
                                                    <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Cuff Insert" child_style="Printed <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Cuff Insert", "Printed <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/printed_collar/<?php echo $key; ?>" alt="..."  style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev prev11">&larr;</a>
                                                    <a class="btn btn-default btn-xs prev remove11 style_selection reset_fabric_selection" parent_style="Inner Cuff Insert" child_style="-" extra_price="0" ng-click='selectStyle("Inner Cuff Insert", "-")'>
                                                        <i class="icon-reply-all"></i> Remove
                                                    </a>
                                                    <a class="btn btn-default btn-xs next next11">&rarr;</a>
                                                </div>
                                            </center>
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var owl = $("#owl-demo_11");

                                                owl.owlCarousel({
                                                    pagination: false,
                                                    items: 4, //10 items above 1000px browser width
                                                    itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                    itemsTablet: [600, 2], //2 items between 600 and 0
                                                    itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                                });

                                                // Custom Navigation Events
                                                $(".next11").click(function () {
                                                    owl.trigger('owl.next');
                                                })
                                                $(".prev11").click(function () {
                                                    owl.trigger('owl.prev');
                                                })


                                            });
                                        </script>
                                    </div>


                                    <div role="tabpanel" class="tab-pane " id="solid1">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_22" class="owl-carousel owl-theme">
                                                <?php
                                                $pleatCount = 0;
                                                foreach ($solid as $key => $value) {
                                                    $pleatCount++;
                                                    ?>
                                                    <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Cuff Insert" child_style="Solid <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Cuff Insert", "Solid <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/solid_collar/<?php echo $key; ?>" alt="..." style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev prev22">&larr;</a>
                                                    <a class="btn btn-default btn-xs prev remove11 style_selection reset_fabric_selection" parent_style="Inner Cuff Insert" child_style="-" extra_price="0" ng-click='selectStyle("Inner Cuff Insert", "-")'>
                                                        <i class="icon-reply-all"></i> Remove
                                                    </a>
                                                    <a class="btn btn-default btn-xs next next22">&rarr;</a>
                                                </div>
                                            </center>
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var owl = $("#owl-demo_22");

                                                owl.owlCarousel({
                                                    pagination: false,
                                                    items: 4, //10 items above 1000px browser width
                                                    itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                    itemsTablet: [600, 2], //2 items between 600 and 0
                                                    itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                                });

                                                // Custom Navigation Events
                                                $(".next22").click(function () {
                                                    owl.trigger('owl.next');
                                                })
                                                $(".prev22").click(function () {
                                                    owl.trigger('owl.prev');
                                                })


                                            });
                                        </script>
                                    </div>
                                </div>
                                <!-- end -->
                                <div class="lapel_style_tab">
                                    <span navigate_to='Inner Front Placket Insert'>Inner Front Placket Insert</span>
                                    <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">

                                        <li role="presentation" class="active">
                                            <a href="#printed2" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                                <img src="./custom_form_view/shirt/fabric/printed_collar/1.jpg" class="iconimg">  Printed 
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#solid2" aria-controls="fancy" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                                <img src="./custom_form_view/shirt/fabric/solid_collar/8.jpg" class="iconimg">  Solid
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
                                     ">

                                    <div role="tabpanel" class="tab-pane active " id="printed2">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_13" class="owl-carousel owl-theme">
                                                <?php
                                                $pleatCount = 0;
                                                foreach ($printed as $key => $value) {
                                                    $pleatCount++;
                                                    ?>
                                                    <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Front Placket Insert" child_style="Printed <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Front Placket Insert", "Printed <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/printed_collar/<?php echo $key; ?>" alt="..."  style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev prev13">&larr;</a>
                                                    <a class="btn btn-default btn-xs prev remove11 style_selection reset_fabric_selection" parent_style="Inner Front Placket Insert" child_style="-" extra_price="" ng-click='selectStyle("Inner Front Placket Insert", "-")'>
                                                        <i class="icon-reply-all"></i> Remove
                                                    </a>
                                                    <a class="btn btn-default btn-xs next next13">&rarr;</a>
                                                </div>
                                            </center>
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var owl = $("#owl-demo_13");

                                                owl.owlCarousel({
                                                    pagination: false,
                                                    items: 4, //10 items above 1000px browser width
                                                    itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                    itemsTablet: [600, 2], //2 items between 600 and 0
                                                    itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                                });

                                                // Custom Navigation Events
                                                $(".next13").click(function () {
                                                    owl.trigger('owl.next');
                                                })
                                                $(".prev13").click(function () {
                                                    owl.trigger('owl.prev');
                                                })


                                            });
                                        </script>
                                    </div>


                                    <div role="tabpanel" class="tab-pane " id="solid2">
                                        <div class="  " role="alert" style="margin-top: 10px;">
                                            <div id="owl-demo_23" class="owl-carousel owl-theme">
                                                <?php
                                                $pleatCount = 0;
                                                foreach ($solid as $key => $value) {
                                                    $pleatCount++;
                                                    ?>
                                                    <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                                        <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="Inner Front Placket Insert" child_style="Solid <?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Inner Front Placket Insert", "Solid <?php echo $value; ?> ($10 Extra)", 10)'>
                                                            <img src="./custom_form_view/shirt/fabric/solid_collar/<?php echo $key; ?>" alt="..." style="height: 90px;width: 121px;">
                                                            <div class="caption towline" style="  margin-top: -4px;">
                                                                <h3>
                                                                    <?php
                                                                    echo $value;
                                                                    echo "<br>";
                                                                    echo "($10 Extra)";
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
                                                    <a class="btn btn-default btn-xs prev prev23">&larr;</a>
                                                    <a class="btn btn-default btn-xs prev remove11 style_selection reset_fabric_selection" parent_style="Inner Front Placket Insert" child_style="-" extra_price="" ng-click='selectStyle("Inner Front Placket Insert", "-")'>
                                                        <i class="icon-reply-all"></i> Remove
                                                    </a>
                                                    <a class="btn btn-default btn-xs next next23">&rarr;</a>
                                                </div>
                                            </center>
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var owl = $("#owl-demo_23");

                                                owl.owlCarousel({
                                                    pagination: false,
                                                    items: 4, //10 items above 1000px browser width
                                                    itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                                    itemsTablet: [600, 2], //2 items between 600 and 0
                                                    itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                                                });

                                                // Custom Navigation Events
                                                $(".next23").click(function () {
                                                    owl.trigger('owl.next');
                                                })
                                                $(".prev23").click(function () {
                                                    owl.trigger('owl.prev');
                                                })


                                            });
                                        </script>
                                    </div>
                                </div>
                                <!-- Third  -->

                                <!-- end -->


                                <style>

                                </style>
                            </div>
                        </div>

                    </div>
                    <!--end of Collars &  Cuffs Additional Features-->


                    <!--start of label and button-->

                    <div role="tabpanel" class="tab-pane  vertical_tab_parent" id="labelbutton">

                        <div class="panel panel-default" navigate_to='Button'>
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                    </span> 
                                    Button
                                </h3>
                            </div>
                            <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                                <div class="row">

                                    <?php
                                    $count = 0;
                                    
                                    foreach ($buttonarray as $key => $value) {
                                        if ($count < 2) {
                                            ?>

                                            <div class="col-sm-4 col-sm-6" style="">
                                                <div class="thumbnail bodyfitimg animated <?php echo $count == 0 ? 'selected' : 'deselect'; ?> style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?>" extra_price="" ng-click='selectStyle("Button", "<?php echo $value;?>")'>
                                                    <img src="./custom_form_view/shirt/button_shirt/<?php echo $key; ?>.png" alt="..." class="suit_controlZoom" style="height: 100px">
                                                    <div class="caption towline">
                                                        <h3>
                                                            <?php echo $value; ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            } else {
                                            ?>


                                            <div class="col-sm-4 col-sm-6" style="">
                                                <div class="thumbnail bodyfitimg animated  style_selection deselect navigat_error" parent_style="Button" child_style="<?php echo $value; ?> ($10 Extra)" extra_price="10" ng-click='selectStyle("Button", "<?php echo $value;?> ($10 Extra)", 10)'>
                                                    <img src="./custom_form_view/shirt/button_shirt/<?php echo $key; ?>.png" alt="..." class="suit_controlZoom" style="height: 100px">
                                                    <div class="caption towline">
                                                        <h3>
                                                            <?php
                                                            echo $value;
                                                            echo "<br>";
                                                            echo "($10 Extra)";
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <!--start of label-->
                        <?php
                        echo get_custom_data('24');
                        ?>
                        <!--end of label-->

                    </div>
                    <!--end of label and button--> 


                    <!--start of monograms -->
                    <div role="tabpanel" class="tab-pane  vertical_tab_parent" id="monogram">

                        <?php shirt_manogram(); ?>

                    </div>
                    <!--end of monograms -->



                    <!-- end -->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="summary">
                        <?php
                        include 'custom_form_view/customformsummary.php';
                        ?> 
                    </div>
                </div>

                <!-- END ALL -->
            </div>
        </div>

        <!--custom navigation-->
        <?php include 'custom_navigation.php'; ?>
        <!--end of custom navigation-->

    </div>

</div>
