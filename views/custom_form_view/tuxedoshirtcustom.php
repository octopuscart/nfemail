

<?php

$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (14,96,10,101,88,98,18,20,24) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}

$default_select_globle['1st Monogram Placement'] = 'No Monogram';
$default_select_globle['1st Monogram Style'] = '-';
$default_select_globle['1st Monogram Initial'] = '-';
$default_select_globle['1st Monogram Color'] = '-';
$default_select_globle['2nd Monogram Placement'] = 'No Monogram';
$default_select_globle['2nd Monogram Style'] = '-';
$default_select_globle['2nd Monogram Initial'] = '-';
$default_select_globle['2nd Monogram Color'] = '-';
$default_select_globle['Button'] = 'Black Button';
$default_select_globle['Cuff Style'] = 'French Cuff  Rounded';
$default_select_globle['Wrist Watch'] = 'No';

$cuff_style = array(
    '4' => 'French Cuff  Rounded',
    '5' => 'French Cuff Squared',
    '6' => 'French Cuff Cutaway',
    '7' => 'Convertible  Cuff Rounded',
    '8' => 'Convertible Cuff Squared',
    '9' => 'Convertible Cuff Cutaway',
);


$buttonarray = array(
    'black' => 'Black Button',
    'white' => 'White Button',
   # 'mop' => 'MOP',
    'black-stud' => 'Studs With Black Button Strip',
    'white-stud' => 'Studs With White Button Strip',
   # 'shm' => 'Stud Hole with MOP'
);
?>
<div class="row " style=" padding:0px 15px">


    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/1.jpeg" class="iconimg"> &nbsp; Body Fit</a></li>
                <li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/2.jpeg" class="iconimg"> &nbsp; Collar</a></li>
                <li role="presentation">
                    <a href="#sleeve_cuff" aria-controls="sleeve_cuff" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/3.jpeg" class="iconimg"> &nbsp; Cuff Style</a></li>
                <li role="presentation">
                    <a href="#frontback" aria-controls="frontback" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/4.jpeg" class="iconimg"> &nbsp; Front & Back</a></li>

                <li role="presentation">
                    <a href="#bottomstyle" aria-controls="bottomstyle" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/5.jpeg" class="iconimg"> &nbsp; Bottom</a></li>

                <li role="presentation">
                    <a href="#labelbutton" aria-controls="labelbutton" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/6.jpeg" class="iconimg"> &nbsp; Button & Label</a>
                </li>
                <li role="presentation">
                    <a href="#monogram" aria-controls="monogram" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/7.jpeg" class="iconimg"> &nbsp; Monogram</a>
                </li>

                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_shirt/8.jpeg" class="iconimg"> &nbsp; Summary</a>
                </li>
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
                    <div role="tabpanel" class="tab-pane" id="lapel">
                        <?php
//                         start of coller style
                        echo get_custom_data('96');
//                         end of coller
                        ?>

                        <!--start of  Collar & Cuff Stiffness-->

                        <?php
                        echo get_custom_data('14');
                        
                        ?>

                        <!--end of  Collar & Cuff Stiffness-->

                        <!--start of Collar Stays-->
                        <?php
                        echo get_custom_data('101');
                        ?>
                        <!--end of Collar Stays-->


                    </div>
                    <!--end of coller style-->

                    <!--start of Sleeve Styles-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="sleeve_cuff">

                        <!-- 2 front edge -->
                        <div class="panel panel-default">
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

                                    <?php
                                    $count = 0;
                                    foreach ($cuff_style as $key => $value) {
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="thumbnail pleat animated style_selection <?php echo $count == 0 ? 'selected' : 'deselect'; ?>  navigat_error" parent_style="Cuff Style" child_style="<?php echo $value; ?>" ng-click='selectStyle("Cuff Style", "<?php echo $value; ?>")'>
                                                <img src="./custom_form_view/tuxedo_shirt/cuff_shirt/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
                                                <div class="caption ">
                                                    <h3><?php echo $value; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $count++;
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <?php shirt_watch_option(); ?>

                        <div style="clear: both"></div>
                        <!-- 2 front edge -->
                    </div>

                    <!--end of Sleeve Styles-->


                    <!--start of front and back-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="frontback">

                        <?php
                        echo get_custom_data('88');
                        ?>

                        <!--start of back-->
                        <?php
                        echo get_custom_data('98');
                        ?>
                        <!-- end of back-->
                        <?php
                        echo get_custom_data('18');
                        ?>
                    </div>
                    <!--end of front and back-->



                    <!--start of bottom-->
                    <div role="tabpanel" class="tab-pane vertical_tab_parent" id="bottomstyle">
                        <!-- 1  style -->
                        <?php
                        echo get_custom_data('20');
                        ?>
                    </div>
                    <!--end of bottom-->




                    <!--start of label and button-->

                    <div role="tabpanel" class="tab-pane  vertical_tab_parent" id="labelbutton">
                        <div class="panel panel-default">
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
                                        if (strrchr($value, 'MOP')) {
                                            ?>

                                            <div class="col-sm-4 col-sm-4" >
                                                <div class="thumbnail bodyfitimg animated deselect  style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?> ($10 Extra)" extra_price="10">
                                                    <img src="./custom_form_view/tuxedo_shirt/button_shirt/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="height: 100px">
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

                                            <?
                                        } else {
                                            ?>


                                            <div class="col-sm-4 col-sm-4">
                                                <div class="thumbnail bodyfitimg animated <?php echo $count == 0 ? 'selected' : 'deselect'; ?> style_selection navigat_error" parent_style="Button" child_style="<?php echo $value; ?>" extra_price="" ng-click='selectStyle("Button", "<?php echo $value; ?>")'>
                                                    <img src="./custom_form_view/tuxedo_shirt/button_shirt/<?php echo $key; ?>.jpg" alt="..." class="suit_controlZoom" style="height: 100px">
                                                    <div class="caption towline">
                                                        <h3>
                                                            <?php echo $value; ?>
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

                        <?php shirt_manogram();?>

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
        <? include 'custom_navigation.php'; ?>
        <!--end of custom navigation-->

    </div>

</div>



