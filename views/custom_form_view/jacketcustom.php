<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (43, 56,57,58,59, 48, 49, 52, 53) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
  $default_select_globle['Lapel Style & Width']='3" Classic (Notch Lapel)';
  $default_select_globle['Front Style']='Single Breasted (2 Buttons)';
  $default_select_globle['Sleeve Buttons']='4 Flat Buttons';
  $default_select_globle['Lining Type'] = 'Fully Lined';
  $default_select_globle['Lining Style'] = 'Matching';
  $default_select_globle['Button'] = 'Standard';
  $default_select_globle['Elbow Patch'] = 'No';
  $default_select_globle['Contrast Button Thread'] = '-';
  $default_select_globle['Contrast Button Hole On Lapel'] = '-';
  $default_select_globle['Contrast First Sleeve Button Hole'] = '-';
?> 

<div class="row " style='padding:0px 15px'>
    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/1.jpeg" class="iconimg"> Body Fit</a></li>
                <li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/2.jpeg" class="iconimg">  Lapel</a></li>
                <li role="presentation">
                    <a href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/3.jpeg" class="iconimg">  Front & Back</a></li>
                <li role="presentation">
                    <a href="#sleevebutton" aria-controls="sleevebutton" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/4.jpeg" class="iconimg">  Sleeve Buttons</a></li>
                <li role="presentation">
                    <a href="#shoulderpadding" aria-controls="shoulderpadding" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/5.jpeg" class="iconimg">  Shoulder Padding</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/6.jpeg" class="iconimg">  Pocket</a></li>
                <li role="presentation">
                    <a href="#additionalfeature" aria-controls="additionalfeature" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/7.jpeg" class="iconimg">  Additional Feature</a>
                </li>
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/jacket/8.jpeg" class="iconimg">  
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
                    <?php jacket_lapel(); ?>
                </div>
                <!-- Lapel End -->
                <!-- Front & Back -->

                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="front">
                    <!-- 1 front style -->
                    <?php jacket_front_styles(); ?>

                </div>
                <!-- F & B End -->
                <!-- Sleeve Button Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="sleevebutton">
                    <?php jacket_sleeve_buttons(); ?> 
                </div>
                <!-- Shoulder Padding  -->

                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="shoulderpadding">
                    <?php echo get_custom_data('56'); ?>
                </div>


                <!-- Pocket Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">
                    <!-- 1  style -->
                    <?php echo get_custom_data('57'); ?>
                    <!-- 2 design -->
                    <?php echo get_custom_data('58'); ?>
                    <!--start of ticket pocket-->
                    <?php echo get_custom_data('59'); ?>
                    <!--end of ticket pocket-->
                </div>
                <!-- Pocket End -->


                <!-- Additional Feature -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="additionalfeature">

                    <!-- linig types and styles -->
                    <?php jacket_additionalfeature(); ?>

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