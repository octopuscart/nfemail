<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (43, 56,57,58,59, 48, 49, 52, 53) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
$default_select_globle['Lapel Style & Width'] = '3" Classic (Notch Lapel)';
$default_select_globle['Front Style'] = 'Single Breasted (2 Buttons)';
$default_select_globle['Sleeve Buttons'] = '4 Flat Buttons';
$default_select_globle['Lining Type'] = 'Fully Lined';
$default_select_globle['Lining Style'] = 'Matching';
$default_select_globle['Button'] = 'Standard';
$default_select_globle['Elbow Patch'] = 'No';
$default_select_globle['Contrast Button Thread'] = '-';
$default_select_globle['Contrast Button Hole On Lapel'] = '-';
$default_select_globle['Contrast First Sleeve Button Hole'] = '-';

$customquery1 = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (1, 2,3,5,6,7,8) and nff.standard=1 ";
$custom_default_list1 = resultAssociate($customquery1);
foreach ($custom_default_list1 as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
$default_select_globle['Number of Pleat']='No Pleat';	

$customquery2 = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (66,67,70,73,68, 69) and nff.standard=1 ";
$custom_default_list2 = resultAssociate($customquery2);
foreach ($custom_default_list2 as $key => $value) {
    $default_select_globle['Waistcoat '.$value['parent']] = $value['child'];
}
  $default_select_globle['Waistcoat Lapel Style & Width']='No Lapel';
  $default_select_globle['Waistcoat Front Style']='Single Breasted (5 Buttons)';
  $default_select_globle['Waistcoat Back Fabric'] = 'Bemberg 3201';

?>
<div class="row col-md-12 " style="    padding-right: 0;">
    <div >

        <!--start of jacket custom form-->
        <div role="tabpanel" class="tab-pane">  
            <div class="">  
                <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 20px 5px;">
                    <!-- Nav tabs --> 
                    <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                        <li role="presentation" class="active classified_li" style="margin-top: -10px;">
                            <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab" style="padding-top: 0px;">
                                Body Fit
                            </a>
                        </li>


                        <li class="classified_li">
                            <a class="switch_me"></a>
                            <h2>Jacket Style</h2>

                        </li>
                        <li role="presentation" class=" ">
                            <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/2.jpeg" class="iconimg">  Lapel</a>
                        </li>
                        <li role="presentation">
                            <a href="#front" aria-controls="front" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/3.jpeg" class="iconimg">  Front & Back</a>
                        </li>
                        <li role="presentation">
                            <a href="#sleevebutton" aria-controls="sleevebutton" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/4.jpeg" class="iconimg">  Sleeve Button</a>
                        </li>
                        <li role="presentation">
                            <a href="#shoulderpadding" aria-controls="shoulderpadding" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/5.jpeg" class="iconimg">  Shoulder Padding</a>
                        </li>
                        <li role="presentation">
                            <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/6.jpeg" class="iconimg">  Pocket</a>
                        </li>
                        <li role="presentation">
                            <a href="#additionalfeature" aria-controls="additionalfeature" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/jacket/7.jpeg" class="iconimg">  Additional Feature</a>
                        </li>


                        <li class="classified_li">
                            <a class="switch_me"></a>
                            <h2>Waistcoat Style</h2>

                        </li>

                        <li role="presentation" class=" ">
                            <a  href="#Waistcoat_lapel" aria-controls="Waistcoat_lapel" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/waistcoat/2.jpeg" class="iconimg">  Lapel</a>
                        </li>
                        <li role="presentation">
                            <a href="#Waistcoat_front" aria-controls="Waistcoat_front" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/waistcoat/3.jpeg" class="iconimg">  Front Style</a>
                        </li>
                        <li role="presentation">
                            <a href="#Waistcoat_backstyle" aria-controls="Waistcoat_backstyle" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/waistcoat/4.jpeg" class="iconimg">  Back Style</a>
                        </li>
                        <li role="presentation">
                            <a href="#Waistcoat_pocket" aria-controls="Waistcoat_pocket" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/waistcoat/5.jpeg" class="iconimg">  Pocket</a>
                        </li>



                        <li class="classified_li">
                            <a class="switch_me"></a>
                            <h2>Pant Style</h2>

                        </li>

                        <li role="presentation" class="">
                            <a  href="#pant_front" aria-controls="pant_front" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/pant/2.jpeg" class="iconimg">  Front</a>
                        </li>
                        <li role="presentation">
                            <a href="#pant_pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                                <img src="./custom_form_view/icon/pant/3.jpeg" class="iconimg">  Pocket</a>
                        </li>


                        <li role="presentation" class="classified_li">
                            <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab" style="padding-top: 0px;">

                                Summary</a>
                        </li>
                    </ul>
                </div>


                <div class="col-sm-9 suit_control" style="">
                    <!-- Tab panes -->
                    <div class="tab-content">


                        <!--start of body fit-->
                        <div role="tabpanel" class="tab-pane active" id="body_fit">

                            <?php
//                         start of body fit 
                            echo get_custom_data('43');
//                         end of body fit
                            ?>
                        </div>
                        <!--end of body fit-->
                        <div style="clear: both"></div>


                        <!--start of summary-->
                        <div role="tabpanel" class="tab-pane" id="summary">
                            <?php
                            include 'custom_form_view/customformsummary.php';
                            ?> 
                        </div>
                        <!--end of summary-->



                        <div role="tabpanel" class="tab-pane " id="pant_front">
                            <?php
                            #start of no of pleat
                            $h0 = 'Number of Pleat';
                            echo panel_creator($h0, multi_tab_element($h0));
                            #end of no of pleat
                            #----
                            #start of waitsband
                            echo get_custom_data('2');
                            #end of waistband
                            #--------------
                            #start of Suspender Buttons on Inner waistband
                            echo get_custom_data('3');
                            #end of Suspender Buttons on Inner waistband
                            #----------------
                            #start of cuff
                            echo get_custom_data('5');
                            #end of cuff 
                            #-------------
                            #start of front fly zipper
                            echo get_custom_data('6');
                            #end of front fly zipper
                            ?>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="pant_pocket">
                            <?php
                            #start of front pocket 
                            echo get_custom_data('7');
                            #end of front pocket
                            #---------------------
                            #start of back pocket
                            echo get_custom_data('8');
                            #end of back pocket
                            ?>
                        </div>

                        <!-- Lapel Style -->
                        <div role="tabpanel" class="tab-pane vertical_tab_parent " id="lapel">
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
                        <!-- Shoulder Padding End -->
                        <!-- Pocket Start -->
                        <div role="tabpanel" class="tab-pane vertical_tab_parent" id="pocket">

                            <!-- 1  style -->
                            <?php echo get_custom_data('57'); ?>
                            <!-- 2 design -->
                            <?php echo get_custom_data('58'); ?>
                            <!-- 3 -->
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
                        <!--start of waitcoat-->
                        <!-- Lapel Style -->

                        <div role="tabpanel" class="tab-pane vertical_tab_parent" id="Waistcoat_lapel">
                            <!-- 1 lepal style --> 
                            <?php
                            #lapel
                            $h0 = 'Lapel Style & Width';
                            $h01 = 'Lapel Style & Width';
                            echo panel_creator($h01, multi_tab_element($h0, $h01, 'Waistcoat '));
                            #lapel
                            ?>
                          
                            <!--start of lapel button hole-->
                            <?php
                            echo get_custom_data('66', 'Waistcoat ');
                            ?>
                            <!--end of lapel button hole-->

                            <!--start of handstitching-->
                            <?php
                            echo get_custom_data('67', 'Waistcoat ');
                            ?>
                            <!--end of handstitching-->
                            

                        </div>
                        <!-- Lapel End -->
                        <!-- Front & Back -->
                        <div role="tabpanel" class="tab-pane vertical_tab_parent" id="Waistcoat_front">
                            <!-- 1 front style -->
                            <?php waistcoat_front('Waistcoat '); ?>

                        </div>
                        <!-- F & B End -->


                        <!-- Sleeve Button Start -->
                        <div role="tabpanel" class="tab-pane vertical_tab_parent" id="Waistcoat_backstyle">
                            <?php waistcoat_back('Waistcoat '); ?>
                        </div>
                        <!-- Shoulder Padding End -->

                        <!-- Pocket Start -->
                        <div role="tabpanel" class="tab-pane vertical_tab_parent" id="Waistcoat_pocket">
                            <!-- 1  style -->
                            <?php
                            echo get_custom_data('70', 'Waistcoat ');
                            ?>
                            <!-- 2 design -->

                            <?php
                            echo get_custom_data('73', 'Waistcoat ');
                            ?>
                        </div>
                        <!-- Pocket End -->
                        <!--end of waistcoart-->
                        <!-- END ALL -->

                    </div>
                </div>


            </div>
        </div>
        <!--end of jacket custom-->
    </div>


    <!--custom navigation-->
    <? include 'custom_navigation.php'; ?>
    <!--end of custom navigation-->

</div>






