<?php

function jacket_lapel() {
    ?>
    <!-- 1 lepal style --> 
    <?php
#lapel
    $h0 = 'Jacket Lapel Style & Width';
    $h01 = 'Lapel Style & Width';
    echo panel_creator($h01, multi_tab_element($h0, $h01));

#lapel
    ?>

    <!--start of lapel button hole-->
    <?php echo get_custom_data('48'); ?>
    <!--end of lapel button hole-->

    <!--start of handstitching-->
    <?php echo get_custom_data('49'); ?>


    <!--end of handstitching-->



    <?php
}
?>


<?php

function jacket_front_styles() {
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
    ?>    

    <div class="panel panel-default" navigate_to="Front Style">
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
                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Single Breasted (<?php echo $value; ?>)" ng-click='selectStyle("Front Style", "Single Breasted (<?php echo $value; ?>)")'>
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
                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Double Breasted (<?php echo $value; ?>)" ng-click='selectStyle("Front Style", "Double Breasted (<?php echo $value; ?>)")'>
                                    <img src="./custom_form_view/suit/front_style/double_breasted/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
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
    <?php echo get_custom_data('52'); ?>
    <!-- Back vent -->
    <?php echo get_custom_data('53'); ?>
    <?php
}
?>
<!--end of jacket front styles-->

<!--start of jacket sleeve buttons-->
<?php

function jacket_sleeve_buttons() {
    $h0 = 'Jacket Sleeve Buttons';
    $h01 = 'Sleeve Buttons';
    echo panel_creator($h01, multi_tab_element($h0, $h01));
}
?>
<!--end of jack sleeve buttons-->


<?php

function jacket_lining($paretPrefix, $prefix) {

    $ids_lining = str_replace(" ", "_", $paretPrefix);

    $febricbanbemberg = ['3201', '3209', '3219', '3232', '3241', '3250', '3259', '3269', '3277', '3287', '3298', '3307', '3317', '3385',
        '3202', '3210', '3221', '3234', '3242', '3251', '3260', '3271', '3279', '3289', '3300', '3308', '3318', '3386',
        '3203', '3211', '3222', '3235', '3244', '3252', '3261', '3272', '3280', '3291', '3302', '3309', '3320', '3388',
        '3204', '3212', '3223', '3236', '3245', '3253', '3264', '3273', '3281', '3294', '3303', '3311', '3380', '3389',
        '3205', '3213', '3224', '3237', '3246', '3254', '3266', '3274', '3282', '3295', '3304', '3313', '3382',
        '3206', '3215', '3226', '3238', '3248', '3256', '3267', '3275', '3284', '3296', '3305', '3314', '3383',
        '3208', '3217', '3229', '3239', '3249', '3257', '3268', '3276', '3286', '3297', '3306', '3316', '3384'];

    $febricfancy = array(
        'K1' => 'K1', 'K2' => 'K2', 'K3' => 'K3', 'K4' => 'K4', 'K5' => 'K5', 'K6' => 'K6', 'K7' => 'K7', 'K8' => 'K8', 'K9' => 'K9', 'K10' => 'K10',
        'K11' => 'K11', 'K12' => 'K12', 'K13' => 'K13', 'K14' => 'K14', 'K15' => 'K15', 'K16' => 'K16', 'K17' => 'K17',
        'K18' => 'K18', 'K19' => 'K19', 'K20' => 'K20', 'K21' => 'K21', 'K22' => 'K22', 'K23' => 'K23', 'K24' => 'K24', 'K25' => 'K25',
        'K26' => 'K26', 'K27' => 'K27', 'K28' => 'K28', 'K29' => 'K29', 'K30' => 'K30', 'K31' => 'K31', 'K32' => 'K32', 'K33' => 'K33',
        'K34' => 'K34', 'K35' => 'K35', 'K36' => 'K36', 'K37' => 'K37', 'K38' => 'K38', 'K39' => 'K39', 'K40' => 'K40', 'K41' => 'K41',
        'K42' => 'K42', 'K43' => 'K43', 'K44' => 'K44', 'K45' => 'K45', 'K46' => 'K46',
        //'K47' => 'K47',
        'K48' => 'K48',
        'K49' => 'K49',
        //'K51' => 'K51',
        'K52' => 'K52',
        //'K53' => 'K53',
        'K54' => 'K54',
        'K55' => 'K55',
        'K56' => 'K56',
        'K57' => 'K57',
        'K58' => 'K58',
        'K59' => 'K59',
        'K60' => 'K60',
        'K61' => 'K61',
        'K62' => 'K62',
        //'K63' => 'K63',
        'K64' => 'K64',
        'K65' => 'K65',
        'K66' => 'K66',
        'K67' => 'K67',
        'K68' => 'K68',
        'K69' => 'K69',
        'K70' => 'K70',
        'K71' => 'K71',
        'K72' => 'K72',
        'K73' => 'K73',
        'K74' => 'K74',
        'K75' => 'K75',
        'K76' => 'K76',
        'K77' => 'K77',
        'K78' => 'K78',
        'K79' => 'K79',
        'K80' => 'K80',
        'K81' => 'K81',
        'K82' => 'K82',
        'K83' => 'K83',
        'K84' => 'K84',
        'K85' => 'K85',
        'K86' => 'K86',
        'K87' => 'K87',
        'K88' => 'K88',
        'K89' => 'K89',
        'K90' => 'K90',
        'K91' => 'K91',
        'K92' => 'K92',
        'K93' => 'K93',
        'K94' => 'K94',
        'K95' => 'K95',
        'K96' => 'K96',
        'K97' => 'K97',
        'K98' => 'K98',
        'K99' => 'K99',
        'K100' => 'K100'
            )
    ?>
    <div class="panel panel-default" navigate_to='<?php echo $prefix; ?><?php echo $paretPrefix; ?>'>
        <div class="panel-heading">
            <h3 class="panel-title"><span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                </span> 
                <?php echo $paretPrefix; ?>
            </h3>
        </div>
        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
            <div class="lapel_style_tab">
                <ul class="innerSelectionTab nav nav-tabs" role="tablist" style="    border-bottom: 0px solid #ddd;">
                    <li role="presentation" class=" active">
                        <a href="#matching<?php echo $ids_lining; ?>" aria-controls="matching<?php echo $ids_lining; ?>" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                            <img src="./custom_form_view/suit/front_style/single_breasted/button1.jpg" class="iconimg">  Matching 
                        </a>
                    </li>
                    <!--                <li role="presentation" class="">
                                        <a href="#contrast" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Contrast 
                                        </a>
                                    </li>-->
                    <li role="presentation" class="">
                        <a href="#fancy<?php echo $ids_lining; ?>" aria-controls="fancy<?php echo $ids_lining; ?>" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Fancy 
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#bemberg<?php echo $ids_lining; ?>" aria-controls="bemberg<?php echo $ids_lining; ?>" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                            <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Contrast Bemberg
                        </a>
                    </li>


                    <?php
                    if ($paretPrefix == 'Back Fabric') {
                        ?>
                        <li role="presentation" class="">
                            <a href="#sameasfront<?php echo $ids_lining; ?>" aria-controls="sameasfront<?php echo $ids_lining; ?>" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                                <img src="./custom_form_view/suit/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg"> 
                                <span style="    margin-top: -10px;
                                      float: right;
                                      margin-left: 10px;
                                      "> Same Fabric As<br/> Vest Front

                                </span> 
                            </a>
                        </li>
                        <?php
                    }
                    ?>

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

                <div role="tabpanel" class="tab-pane active" id="matching<?php echo $ids_lining; ?>">
                    <div class="  " role="alert" style="margin-top: 10px;">

                        <div class="col-sm-3 col-sm-3 pleat_selection">
                            <div class="thumbnail pleat animated style_selection navigat_error" parent_style="<?php echo $prefix; ?><?php echo $paretPrefix; ?>" child_style="Matching" extra_price="" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Matching")'>
                                <img src="./custom_form_view/suit/fabric/matching.jpg" alt="..." class=" suit_controlZoom " style="height: 90px;">
                                <div class="caption towline" style="  ">
                                    <h3>Matching</h3>
                                </div>
                            </div>
                        </div>

                        <div style="clear: both"></div>
                    </div>
                </div>

                <!--            <div role="tabpanel" class="tab-pane " id="contrast">
                                <div class="  " role="alert" style="margin-top: 10px;">
                
                                    <div class="col-sm-3 col-sm-3 pleat_selection">
                                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Lining Style" child_style="Contrast" extra_price="">
                                            <img src="./custom_form_view/suit/fabric/contrast.jpg" alt="..." class=" suit_controlZoom " style="height: 90px;">
                                            <div class="caption towline" style="  ">
                                                <h3>Contrast</h3>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div style="clear: both"></div>
                                </div>
                            </div>-->


                <div role="tabpanel" class="tab-pane " id="fancy<?php echo $ids_lining; ?>">
                    <div class="  " role="alert" style="margin-top: 10px;">
                        <div id="owl-demo_<?php echo $ids_lining; ?>2" class="owl-carousel owl-theme">
                            <?php
                            $pleatCount = 0;
                            foreach ($febricfancy as $key => $value) {
                                $pleatCount++;
                                ?>
                                <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                    <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="<?php echo $prefix; ?><?php echo $paretPrefix; ?>" child_style="Fancy <?php echo $value; ?> ($30 Extra)" extra_price="30" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Fancy <?php echo $value; ?> ($30 Extra)", 30)'>
                                        <img src="./custom_form_view/suit/fabric/fancy/<?php echo $key; ?>.jpg" alt="..." style="height: 90px;width: 121px;">
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
                                <a class="btn btn-default btn-xs prev prev<?php echo $ids_lining; ?>2">&larr;</a>
                                <a class="btn btn-default btn-xs prev remove2 style_selection reset_fabric_selection" parent_style="<?php echo $paretPrefix; ?>" child_style="-" extra_price="" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Matching")'>
                                    <i class="icon-reply-all"></i> Remove
                                </a>
                                <a class="btn btn-default btn-xs next next<?php echo $ids_lining; ?>2">&rarr;</a>
                            </div>
                        </center>
                    </div>
                    <script>
                        $(document).ready(function () {

                            var owl = $("#owl-demo_<?php echo $ids_lining; ?>2");
                            owl.owlCarousel({
                                pagination: false,
                                items: 4, //10 items above 1000px browser width
                                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                itemsTablet: [600, 2], //2 items between 600 and 0
                                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                            });
                            // Custom Navigation Events
                            $(".next<?php echo $ids_lining; ?>2").click(function () {
                                owl.trigger('owl.next');
                            })
                            $(".prev<?php echo $ids_lining; ?>2").click(function () {
                                owl.trigger('owl.prev');
                            })


                        });
                    </script>
                </div>

                <div role="tabpanel" class="tab-pane " id="bemberg<?php echo $ids_lining; ?>">
                    <div class="  " role="alert" style="margin-top: 10px;">
                        <div id="owl-demo_<?php echo $ids_lining; ?>3" class="owl-carousel owl-theme">
                            <?php
                            $pleatCount = 0;
                            foreach ($febricbanbemberg as $key => $value) {
                                $pleatCount++;
                                ?>
                                <div class="col-sm-3 col-sm-3 pleat_selection item" style="width:100%">
                                    <div style="margin-bottom: 4px;" class="thumbnail pleat animated style_selection navigat_error" parent_style="<?php echo $prefix; ?><?php echo $paretPrefix; ?>" child_style="Bemberg <?php echo $value; ?> " extra_price="" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Bemberg <?php echo $value; ?>")'>
                                        <img src="./custom_form_view/suit/fabric/Bemberg/<?php echo $value; ?>.jpg" alt="..." style="height: 90px;width: 121px;">
                                        <div class="caption towline" style="  margin-top: -4px;">
                                            <h3>
                                                <?php
                                                echo $value;
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
                                <a class="btn btn-default btn-xs prev prev<?php echo $ids_lining; ?>3">&larr;</a>
                                <a class="btn btn-default btn-xs prev remove3 style_selection reset_fabric_selection" parent_style="<?php echo $prefix; ?><?php echo $paretPrefix; ?>" child_style="-" extra_price="" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Matching")'>
                                    <i class="icon-reply-all"></i> Remove
                                </a>
                                <a class="btn btn-default btn-xs next next<?php echo $ids_lining; ?>3">&rarr;</a>
                            </div>
                        </center>
                    </div>
                    <script>
                        $(document).ready(function () {

                            var owl = $("#owl-demo_<?php echo $ids_lining; ?>3");
                            owl.owlCarousel({
                                pagination: false,
                                items: 4, //10 items above 1000px browser width
                                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                                itemsTablet: [600, 2], //2 items between 600 and 0
                                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
                            });
                            // Custom Navigation Events
                            $(".next<?php echo $ids_lining; ?>3").click(function () {
                                owl.trigger('owl.next');
                            })
                            $(".prev<?php echo $ids_lining; ?>3").click(function () {
                                owl.trigger('owl.prev');
                            })


                        });
                    </script>
                </div>

                <?php
                if ($paretPrefix == 'Back Fabric') {
                    ?>
                    <div role="tabpanel" class="tab-pane " id="sameasfront<?php echo $ids_lining; ?>">
                        <div class="  " role="alert" style="margin-top: 10px;">

                            <div class="col-sm-3 col-sm-3 pleat_selection">
                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="<?php echo $prefix; ?><?php echo $paretPrefix; ?>" child_style="Same Fabric As Vest Front ($65 Extra)" extra_price="65" ng-click='selectStyle("<?php echo $prefix; ?><?php echo $paretPrefix; ?>", "Same Fabric As Vest Front ($65 Extra)", 65)'>
                                    <img src="./custom_form_view/suit/fabric/samefront.jpg" alt="..." class=" suit_controlZoom " style="height: 90px;">
                                    <div class="caption towline" style="height: 60px;  ">
                                        <h3>Same Fabric As Vest Front
                                            <br/>
                                            ($65 Extra)
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div style="clear: both"></div>
                        </div>
                    </div>
                    <?php
                }
                ?>


            </div>



        </div>
    </div>
    <?php
}
?>


<?php

function jacket_contrast_button() {
    $contrast_button = array(
        'Contrast Button Thread',
        'Contrast Button Hole On Lapel',
        'Contrast First Sleeve Button Hole',
    );
    ?>

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
                        <span class="buttonDiv_span pull-left" style="width: 300px;" navigate_to='<?php echo $value; ?>'><?php echo $value; ?> &nbsp;</span>
                        <div class="style_selection navigat_error" parent_style="<?php echo $value; ?>">
                            <select class="pull-right "   style="background-color: #FFFFFF;color: #000;padding: 5px 10px;border: 2px solid #F00;" ng-click='selectStyle("<?php echo $value; ?>", contrasthole<?php echo $key; ?>)' ng-model="contrasthole<?php echo $key; ?>" ng-init="contrasthole<?php echo $key; ?> = '-'">
                                <option value='-'>Select An Option</option>  
                                <option>Matching Base Color for Lining</option>
                                <option>Black</option>
                                <option>Navy</option> 
                                <option>Charcoal</option>
                                <option>Silver</option>
                                <option>Red</option>
                                <option>Soft Pink</option>
                                <option>Cream</option>
                                <option>Beige</option>
                                <option>Grey</option>
                                <option>Brown</option>
                                <option>Purple</option>                       
                            </select>
                        </div>
                        <div style="clear: both"></div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
}
?>


<?php

function jacket_additionalfeature() {
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
    ?>
    <?php
    echo get_custom_data('78');
    jacket_lining('Lining Style');
    ?>

    <!-- buttons -->
    <div class="panel panel-default" navigate_to='Button'>
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
                    <div class="thumbnail animated style_selection selected navigat_error" parent_style="Button" child_style="Standard" extra_price="" ng-click='selectStyle("Button", "Standard")'>

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
                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?> ($30 Extra)" extra_price="30" ng-click='selectStyle("Button", "<?php echo $value; ?> ($30 Extra)", 30)'>

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
                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo str_replace("<br>", "", $key); ?>" extra_price="30" >

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
                                <?php
                                ?>
                                <select name=""   class="extra_buttons" ng-click='selectStyle("Button", buttonExtra<?php echo $key; ?>, 30)' ng-model="buttonExtra<?php echo $key; ?>" ng-init="buttonExtra<?php echo $key; ?> = '<?php echo $key . " " . $value[0] . " ($30 Extra)"; ?>'">
                                    <?php
                                    foreach ($value as $k => $v) {

                                        echo "<option value='" . $key . " " . $v . " ($30 Extra)' " . ($k == 0 ? 'selected' : '') . ">" . $v . "</option>";
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


    <?php
    echo get_custom_data('79');
    jacket_contrast_button();
}
?>



<?php

function waistcoat_front($prefix) {
    $prefixr = '';
    if ($prefix) {
        $prefixr = $prefix;
    }
    $ws_single_breasted = array(
        'button4' => '4 Button',
        'button5' => '5 Buttons',
        'button6' => '6 Buttons',
    );
    $ws_double_breasted = array(
        'button42' => '4 Buttons  2 Buttons Fasten',
        'button63' => '6 Buttons  3 Buttons Fasten',
    );
    ?>
    <!-- 1 front style -->
    <div class="panel panel-default" navigate_to='Front Style'>
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
                        <a href="#Waistcoat_single_breasted" aria-controls="Waistcoat_single_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                            <img src="./custom_form_view/waistcoat/front_style/single_breasted/button1.jpg" class="iconimg ">  Single Breasted 
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#Waistcoat_double_breasted" aria-controls="Waistcoat_double_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                            <img src="./custom_form_view/waistcoat/front_style/double_breasted/4_buttons_1_fasten.jpg" class="iconimg">  Double Breasted 
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
                <div role="tabpanel" class="tab-pane active" id="Waistcoat_single_breasted">
                    <div class="  " role="alert" style="margin-top: 10px;">
                        <?php
                        $pleatCount = 0;
                        foreach ($ws_single_breasted as $key => $value) {
                            $pleatCount++;
                            ?>
                            <div class="col-sm-4 col-sm-4 pleat_selection">
                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Single Breasted (<?php echo $value; ?>)" ng-click='selectStyle("<?php echo $prefixr; ?>Front Style", "Single Breasted (<?php echo $value; ?>)")' >
                                    <img src="./custom_form_view/waistcoat/front_style/single_breasted/<?php echo $key; ?>.jpg" alt="..."  class="suit_controlZoom ">
                                    <div class="caption " style="  margin-top: -4px;">
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
                <div role="tabpanel" class="tab-pane" id="Waistcoat_double_breasted">
                    <div class="  " role="alert" style="margin-top: 10px;">
                        <?php
                        $pleatCount = 0;
                        foreach ($ws_double_breasted as $key => $value) {
                            $pleatCount++;
                            ?>
                            <div class="col-sm-4 col-sm-4 pleat_selection">
                                <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Front Style" child_style="Double Breasted (<?php echo $value; ?>)" ng-click='selectStyle("<?php echo $prefixr; ?>Front Style", "Double Breasted (<?php echo $value; ?>)")'>
                                    <img src="./custom_form_view/waistcoat/front_style/single_breasted/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
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
    <!-- 2 front edge -->
    <?php
    echo get_custom_data('68', $prefix);
    ?>
    <?php
}
?>   


<?php

function waistcoat_back($prefix) {
    jacket_lining('Back Fabric', $prefix);
    echo get_custom_data('69', $prefix);
}
?>


<?php

function shirt_watch_option() {
    $watch_option = array(
        'nowatch' => 'No',
        'leftwatch' => 'Right Wrist',
        'rightwatch' => 'Left Wrist'
    );
    ?>
    <div class="panel panel-default" navigate_to="Wrist Watch">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                </span> 
                Wrist Watch
            </h3>
        </div>
        <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
            <div class="row">

                <?php foreach ($watch_option as $key => $value) { ?>

                    <div class="col-sm-4">
                        <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Wrist Watch" child_style="<?php echo $value; ?>" ng-click='selectStyle("Wrist Watch", "<?php echo $value; ?>", "", {"Watch": "<?php echo $value == 'No' ? 'No' : 'Yes'; ?>"})'>
                            <img src="./custom_form_view/shirt/watch/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                            <div class="caption towline">
                                <h3><?php echo $value; ?></h3>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <div class="col-md-12 note_option" style="margin: -15px 0 9px 0;    margin: -15px 0 9px 0;">
                    Note:  If you wear a <b>Big Watch</b>, please tick the <b>Right Wrist</b> or <b>Left Wrist</b> box, so we can make the <b>Cuff Size</b> a little bigger accordingly.
                </div>

            </div>
        </div>
    </div>
    <?php
}
?>



<?php

function shirt_manogram() {
    $monogram = array(
        '1' => '1',
        '3' => '3',
        '8' => '8',
        '10' => '10',
        '13' => '13',
        '14' => '14',
        '15' => '15',
        '16' => '16',
        '17' => '17',
        '18' => '18',
        '19' => '19',
        '20' => '20',
        '21' => '21',
        '22' => '22',
        '23' => '23',
        '24' => '24',
        '27' => '27',
        '28' => '28',
        '30' => '30',
        '31' => '31',
        '34' => '34',
        '36' => '36'
    );
 

    $monogram_placement = array(
        'left_cuff' => 'Left Cuff',
        'left_chest_pocket' => 'Left Chest Pocket',
        'left_sleeve_plocket' => 'Left Sleeve Placket',
        'left_abdomen' => 'Left Abdomen',
        'inside_coller_band' => 'Inside Collar Band',
        'shirt_tail' => 'Shirt Tail',
        'no_monogram' => 'No Monogram',
    );
    if ($_REQUEST['custom_form'] == 'tuxedoshirtcustom') {
        $monogram_placement = array(
            'left_cuff' => 'Left Cuff',
            'left_sleeve_plocket' => 'Left Sleeve Placket',
            'left_abdomen' => 'Left Abdomen',
            'inside_coller_band' => 'Inside Collar Band',
            'shirt_tail' => 'Shirt Tail',
            'no_monogram' => 'No Monogram',
        );
    }
    ?>
    <div class="lapel_style_tab">
        <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #000;">
            <li role="presentation" class=" active">
                <a href="#monogram1" aria-controls="monogram1" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                    <img src="./custom_form_view/shirt/monogram_shirt/1.jpg" class="iconimg "> 1st Monogram
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#monogram2" aria-controls="monogram2" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                    <img src="./custom_form_view/shirt/monogram_shirt/10.jpg" class="iconimg">  2nd Monogram
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content" style="
         border: 1px solid #000;
         /* margin-top: 0px; */
         padding: 10px 16px 0px 16px;
         margin-bottom: 15px;
         /* border-radius: 4px; */
         ">

        <div role="tabpanel" class="tab-pane active " id="monogram1">
            <!--first monogram-->


            <div class="alert alert-success" role="alert" style="    padding: 10px 16px;
                 line-height: 15px;">
                <i class="fa fa-smile-o"></i> Complimentary Service 
            </div>

            <div class="panel panel-default" navigate_to="1st Monogram Placement">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Placement
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <div class="row">
                        <?php foreach ($monogram_placement as $key => $value) { ?>

                            <div class="col-sm-3 col-sm-3">
                                <div class="thumbnail bodyfitimg animated  style_selection navigat_error" parent_style="1st Monogram Placement" child_style="<?php echo $value; ?>" ng-click='selectStyle("1st Monogram Placement", "<?php echo $value; ?>")'>
                                    <img src="./custom_form_view/shirt/monogram_placement/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="width:100%;height: 100px;">
                                    <div class="caption ">
                                        <h3><?php echo $value; ?></h3>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="panel panel-default" navigate_to="1st Monogram Style">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Style
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <div class="row">

                        <?php foreach ($monogram as $key => $value) { ?>

                            <div class="col-sm-2 col-sm-2" style="width:20%">
                                <div class="thumbnail bodyfitimg animated  style_selection navigat_error" parent_style="1st Monogram Style" child_style="<?php echo $value; ?>" ng-click='selectStyle("1st Monogram Style", "<?php echo $value; ?>")'>
                                    <img src="./custom_form_view/shirt/monogram_shirt/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="width:100%;height: 100px;">
                                    <div class="caption">
                                        <h3><?php echo $value; ?></h3>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="panel panel-default" navigate_to="1st Monogram Initial">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Initial
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px;">

                    <div class="col-md-3">
                        <input type='text' id="monogram_1st" ng-model="monogram_init_1" ng-keyup='selectStyle("1st Monogram Initial", monogram_init_1)'
                               ng-click='selectStyle("1st Monogram Initial", monogram_init_1)'
                               parent_style="1st Monogram Initial" child_style=""
                               class="form-control style_selection" style="
                               font-size: 21px;
                               font-family: sans-serif;
                               font-style: normal;
                               width: 108px;
                               ">
                    </div>
                    <div class="col-md-9"
                         style="font-size: 12px;
                         line-height: 14px;
                         padding: 0px"
                         >

                        A graphic symbol consisting of 2 or more letters combined (usually your initials)
                        printed on stationery or embroidered on clothing.
                    </div>


                </div>
            </div>

            <div class="panel panel-default" navigate_to="1st Monogram Color">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Color
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <?php
                    $monogram_color = array(
                        'Contrast_Thread' => 'Contrast Thread',
                        'Matching_Thread' => 'Matching Thread',
                    );
                    ?>

                    <?php foreach ($monogram_color as $key => $value) { ?>
                        <div class="col-sm-3">
                            <div class="thumbnail pleat animated style_selection" parent_style="1st Monogram Color" child_style='<?php echo $value; ?>' ng-click='selectStyle("1st Monogram Color", "<?php echo $value; ?>")'>
                                <img class="thumbnail_small" src="./custom_form_view/shirt/monogram_color/<?php echo $key; ?>.jpg" alt="..." >
                                <div class="caption">
                                    <h3 style="">

                                        <?php
                                        $brarray = explode("    ", $value);
                                        echo $brarray[0];
                                        echo "<br>";
                                        echo $brarray[1];
                                        ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--end of 1st monogram-->


        <div role="tabpanel" class="tab-pane  " id="monogram2">

            <!--start of 2nd monogram-->


            <div class="panel panel-default" navigate_to="2nd Monogram Placement">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Placement
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <div class="row">
                        <?php foreach ($monogram_placement as $key => $value) { ?>

                            <div class="col-sm-3 col-sm-3">
                                <div class="thumbnail bodyfitimg animated  style_selection navigat_error" parent_style="2nd Monogram Placement" child_style="<?php echo $value; ?>" ng-click='selectStyle("2nd Monogram Placement", "<?php echo $value; ?>")'>
                                    <img src="./custom_form_view/shirt/monogram_placement/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="width:100%;height: 100px;">
                                    <div class="caption ">
                                        <h3><?php echo $value; ?></h3>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>



            <div class="panel panel-default" navigate_to="2nd Monogram Style">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Style
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <div class="row">

                        <?php foreach ($monogram as $key => $value) { ?>

                            <div class="col-sm-2 col-sm-2" style="width:20%">
                                <div class="thumbnail bodyfitimg animated  style_selection navigat_error" parent_style="2nd Monogram Style" child_style="<?php echo $value; ?>" ng-click='selectStyle("2nd Monogram Style", "<?php echo $value; ?>")'>
                                    <img src="./custom_form_view/shirt/monogram_shirt/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="width:100%;height: 100px;">
                                    <div class="caption">
                                        <h3><?php echo $value; ?></h3>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="panel panel-default" navigate_to="2nd Monogram Initial">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Initial
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px;">

                    <div class="col-md-3">
                        <input type='text' class="form-control style_selection monogram_text" ng-model="monogram_init_2" ng-keyup='selectStyle("2nd Monogram Initial", monogram_init_2 + " ($10 Extra)", 10)'
                               ng-click='selectStyle("2nd Monogram Initial", monogram_init_2, 10)'
                               id="monogram_2nd" extra_price="10"
                               parent_style="2nd Monogram Initial" child_style=""
                               style="
                               font-size: 21px;
                               font-family: sans-serif;
                               font-style: normal;
                               width: 108px;
                               ">
                    </div>
                    <div class="col-md-9"
                         style="font-size: 12px;
                         line-height: 14px;
                         padding: 0px"
                         >
                        <b>$10 Extra</b><br>
                        A graphic symbol consisting of 2 or more letters combined (usually your initials)
                        printed on stationery or embroidered on clothing.
                    </div>


                </div>
            </div>


            <!--start of monogram color-->
            <div class="panel panel-default" navigate_to="2nd Monogram Color">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                        </span> 
                        Monogram Color
                    </h3>
                </div>
                <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
                    <?php
                    $monogram_color = array(
                        'Contrast_Thread' => 'Contrast Thread',
                        'Matching_Thread' => 'Matching Thread',
                    );
                    ?>

                    <?php foreach ($monogram_color as $key => $value) { ?>
                        <div class="col-sm-3">
                            <div class="thumbnail pleat animated style_selection" parent_style="2nd Monogram Color" child_style='<?php echo $value; ?>' ng-click='selectStyle("2nd Monogram Color", "<?php echo $value; ?>")'>
                                <img class="thumbnail_small" src="./custom_form_view/shirt/monogram_color/<?php echo $key; ?>.jpg" alt="..." >
                                <div class="caption">
                                    <h3 style="">

                                        <?php
                                        $brarray = explode("    ", $value);
                                        echo $brarray[0];
                                        echo "<br>";
                                        echo $brarray[1];
                                        ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--end of monogram color-->


        </div>
        <!--end of 2nd monogram-->
    </div>
    <?php
}
?>


<?php

function tuxedo_shirt_buttons() {
    $tuxedo_jacket_button = array(
        'satin' => 'Satin Covered',
        'grosgrain' => 'Grosgrain Covered',
    );
    ?>


    <!-- buttons -->
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
                    <div class="thumbnail animated style_selection navigat_error " parent_style="Button" child_style="Standard " extra_price="" ng-click='selectStyle("Button", "Standard")'>

                        <div class="col-md-4 button_img" style="">
                            <img src="./custom_form_view/tuxedo_jacket/buttons/standard.jpeg" alt="..."  class=" suit_controlZoom ">
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

                <?php foreach ($tuxedo_jacket_button as $key => $value) { ?>
                    <div class="col-sm-4 ">
                        <div class="thumbnail animated style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?>" extra_price="" ng-click='selectStyle("Button", "<?php echo $value; ?>")'>

                            <div class="col-md-4 button_img" style="">
                                <img src="./custom_form_view/tuxedo_jacket/buttons/<?php echo $key; ?>.jpeg" alt="..." class=" suit_controlZoom ">
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



    <?php
}
?>
<script>
    setTimeout(function () {
        Waves.attach('div.style_selection');
        Waves.attach('div.wave-block');
        Waves.attach('dl.wave-block');
        
        Waves.init();
        $(".waves-effect").css({'display': 'inherit'})
    }, 2000)

</script>