<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (71,72,75,102,76,78,81,82,80, 57,58, 48) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
  $default_select_globle['Lapel Style & Width']='3" Classic (Notch Lapel)';
  $default_select_globle['Front Style']='Single Breasted (2 Buttons)';
  $default_select_globle['Sleeve Buttons']='4 Flat Buttons';
  $default_select_globle['Lining Type'] = 'Fully Lined';
  $default_select_globle['Lining Style'] = 'Matching';
   $default_select_globle['Sleeve Epaulettes'] = 'No';

  $default_select_globle['Contrast Button Thread'] = '-';
  $default_select_globle['Contrast Button Hole On Lapel'] = '-';
  $default_select_globle['Contrast First Sleeve Button Hole'] = '-';
  $single_breasted = array(
    'button2' => '2 Buttons',
    'button3' => '3 Buttons',
    'button4' => '4 Buttons',
);
$double_breasted = array(
    'button62' => '6 Buttons  2 Buttons Fasten',
);
?>



<div class="row " style='padding:0px 15px'>


    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/1.jpeg" class="iconimg"> Body Fit</a></li>
                <li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/2.jpeg" class="iconimg">  Lapel</a></li>
                <li role="presentation">
                    <a href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/3.jpeg" class="iconimg">  Front Style</a></li>
                <li role="presentation">
                    <a href="#sleevebutton" aria-controls="sleevebutton" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/4.jpeg" class="iconimg">  Sleeve Button</a></li>
                <li role="presentation">
                    <a href="#shoulderpadding" aria-controls="shoulderpadding" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/5.jpeg" class="iconimg"> Epaulettes</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/6.jpeg" class="iconimg">  Pocket</a></li>
                <li role="presentation">
                    <a href="#additionalfeature" aria-controls="additionalfeature" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/7.jpeg" class="iconimg">  Additional Feature</a>
                </li>
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/overcoat/8.jpeg" class="iconimg">  
                        Summary</a>
                </li>
            </ul>
        </div>


        <div class="col-sm-9 suit_control" style="">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active vertical_tab_parent" id="body_fit">
                    <!---start body fit-->
                    <?php echo get_custom_data('71'); ?>
                    <!--end body-->
                    <!-- start Category-->
                    <?php echo get_custom_data('72'); ?> 
                    <!--end category-->
                </div>
                <!-- Lapel Style -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="lapel">
                    <!-- 1 lepal style --> 
                    <?php
                    #lapel
                    $h0 = 'Overcoat Lapel Style & Width';
                    $h01 = 'Lapel Style & Width';
                    echo panel_creator($h01, multi_tab_element($h0, $h01));
                    #lapel
                    ?>

                    <!--start of lapel button hole-->
                    <?php echo get_custom_data('75'); ?>

                    <!--end of lapel button hole-->

                </div>
                <!-- Lapel End -->
                <!-- Front & Back -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="front">
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
                                        <a href="#single_breasted" aria-controls="single_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/overcoat/front_style/single_breasted/button2.jpg" class="iconimg ">  Single Breasted 
                                        </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#double_breasted" aria-controls="double_breasted" role="tab" data-toggle="tab"  style="background: #fff;color: #000; ">
                                            <img src="./custom_form_view/overcoat/front_style/double_breasted/button62.jpg" class="iconimg">  Double Breasted 
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
                                                    <img src="./custom_form_view/overcoat/front_style/single_breasted/<?php echo $key; ?>.jpg" alt="..."  class="suit_controlZoom ">
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
                                                    <img src="./custom_form_view/overcoat/front_style/double_breasted/<?php echo $key; ?>.jpg" alt="..." class=" suit_controlZoom ">
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

                    <?php
//                         start of Waist Belt With Buckle
                    echo get_custom_data('102');
//                         end of Waist Belt With Buckle
                    ?>


                </div>
                <!-- F & B End -->
                <!-- Sleeve Button Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="sleevebutton">
                    <?php jacket_sleeve_buttons(); ?> 
                </div>
                <!-- Shoulder Padding  -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="shoulderpadding">
                    <!--Shoulder Epaulettes--->
                    <?php echo get_custom_data('76'); ?>
                    <!---->

                    <!--- start  Sleeve Epaulettes-->
                    <?php echo get_custom_data('77'); ?>
                    <!--end -->

                </div>
                <!-- Shoulder Padding End -->
                <!-- Pocket Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">
                    <!-- 1  style -->
                    <!--- start   Breast Pocket-->
                    <?php echo get_custom_data('80'); ?>
                    <!--end -->
                    <!-- 2 design -->
                    <?php echo get_custom_data('81'); ?>
                    <!-- 3 -->
                    <?php echo get_custom_data('82'); ?>
                </div>
                <!-- Pocket End -->
                <!-- Additional Feature -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="additionalfeature">
                    <!-- 1 front style -->
                    <?php echo get_custom_data('78'); ?>
                    <?php
                    jacket_lining('Lining Style');
                    jacket_contrast_button();
                    ?> 
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

        for (j in temp) {
            if (j.indexOf("Contrast") == 0) {
                productStyleArray[prd_id][j] = '-';
                productStyleArrayPrice[prd_id][j] = '';
            }

        }
        productStyleArray[prd_id]['Front Style'] = 'Single Breasted (2 Buttons)';
        productStyleArray[prd_id]['Sleeve Buttons'] = '4 Flat Buttons';
        productStyleArray[prd_id]['Lining Style'] = 'Matching';


    }
    function customsetdefalt() {
        for (i in productStyleArray) {
            customDefaultSet(i);
        }
    }

    customsetdefalt();
</script>