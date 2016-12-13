<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (62,66,67,70,73,68, 69) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
  $default_select_globle['Lapel Style & Width']='No Lapel';
  $default_select_globle['Front Style']='Single Breasted (5 Buttons)';
  $default_select_globle['Back Fabric'] = 'Bemberg 3201';
 
?>

<div class="row " style='padding:0px 15px'>
    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/1.jpeg" class="iconimg"> Body Fit</a></li>
                <li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/2.jpeg" class="iconimg">  Lapel</a></li>
                <li role="presentation">
                    <a href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/3.jpeg" class="iconimg">  Front Style</a></li>

                <li role="presentation">
                    <a href="#backstyle" aria-controls="backstyle" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/4.jpeg" class="iconimg">  Back Style</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/5.jpeg" class="iconimg">  Pocket</a></li>

                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/waistcoat/6.jpeg" class="iconimg">  
                        Summary</a>
                </li>
            </ul>
        </div>


        <div class="col-sm-9 suit_control" style="">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active vertical_tab_parent" id="body_fit">
                    <?php
#start of body fit
                    echo get_custom_data('62');
#end of body fit
                    ?>
                </div>
                <!-- Lapel Style -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="lapel">
                    <!-- 1 lepal style --> 
                    <?php
#lapel
                    $h0 = 'Lapel Style & Width';
                    $h01 = 'Lapel Style & Width';
                    echo panel_creator($h01, multi_tab_element($h0, $h01));
#lapel
                    ?>
                    <!--start of lapel button hole-->
                    <?php
                    echo get_custom_data('66');
                    ?>
                    <!--end of lapel button hole-->

                    <!--start of handstitching-->
                    <?php
                    echo get_custom_data('67');
                    ?>
                    <!--end of handstitching-->

                </div>
                <!-- Lapel End -->
                <!-- Front & Back -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="front">
                    <!-- 1 front style -->
                    <?php waistcoat_front(); ?>
                </div>
                <!-- F & B End -->

                <!-- Sleeve Button Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="backstyle">
                    <?php waistcoat_back(); ?>
                </div>
                <!-- Shoulder Padding End -->

                <!-- Pocket Start -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">
                    <!-- 1  style -->
                    <?php
                    echo get_custom_data('70');
                    ?>
                    <!-- 2 design -->

                    <?php
                    echo get_custom_data('73');
                    ?>

                </div>
                <!-- Pocket End -->

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