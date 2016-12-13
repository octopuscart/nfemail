<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (85,86,84,59,52,56,53,43) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);

foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
  $default_select_globle['Lapel Style & Width']='3" Classic (Notch Lapel)';
  $default_select_globle['Front Style']='Single Breasted (2 Buttons)';
  $default_select_globle['Sleeve Buttons']='4 Flat Buttons';
  $default_select_globle['Lining Style'] = 'Matching';
  $default_select_globle['Button'] = 'Satin Covered';
  $default_select_globle['Lining Type'] = 'Fully Lined';
  $default_select_globle['Marriage Date Option'] = '-';
  
  
  $customquery1 = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (9, 2,3,6,7,8) and nff.standard=1 ";
$custom_default_list1 = resultAssociate($customquery1);
foreach ($custom_default_list1 as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
$default_select_globle['Number of Pleat']='No Pleat';

?> 

<div class="row " style='padding:0px 15px'>


    <div class="">  
        <div class="col-sm-3 suite_customize" style="  padding: 0px 0px 0px 5px;">
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

                </li><li role="presentation">
                    <a  href="#lapel" aria-controls="lapel" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/1.jpg" class="iconimg">  Lapel</a></li>
                <li role="presentation">
                    <a href="#jfront" aria-controls="jfront" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/2.jpg" class="iconimg">  Front & Back</a></li>
                <li role="presentation">
                    <a href="#sleevebutton" aria-controls="sleevebutton" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/3.jpg" class="iconimg">  Sleeve Button</a></li>
                <li role="presentation">
                    <a href="#shoulderpadding" aria-controls="shoulderpadding" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/4.jpg" class="iconimg">  Shoulder Padding</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/5.jpg" class="iconimg">  Pocket</a></li>
                <li role="presentation">
                    <a href="#additionalfeature" aria-controls="additionalfeature" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_jacket/6.jpg" class="iconimg">  Additional Feature</a>
                </li>

                <li class="classified_li">
                    <a class="switch_me"></a>
                    <h2>Pant Style</h2>

                </li>
                <li role="presentation">
                    <a  href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/2.jpeg" class="iconimg"> &nbsp;  Front</a></li>
                <li role="presentation">
                    <a href="#ppocket" aria-controls="ppocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/3.jpeg" class="iconimg"> &nbsp;  Pocket</a></li>


                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/4.jpeg" class="iconimg">  
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

                       <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                                </span> 
                                Are you Getting Married Now? <small style="font-size: 13px;
                                                                    font-weight: bold;
                                                                    color: #f00;
                                                                    text-shadow: 0px 0px 0px #fff;
                                                                    border-bottom: 1px solid #fff;
                                                                    text-align: right;
                                                                    float: right;
                                                                    margin-right: 9px;
                                                                    padding: 1px 0px;">You can skip this step if do not want.</small>
                            </h3>
                        </div>
                        <div class="panel-body" style="  padding: 15px;">

                            <div class="col-md-4">
                                <input type='text' class="form-control style_selection monogram_text" 
                                       id="monogram_2nd" extra_price=""
                                       parent_style="Marriage Date Option" ng-model="marriage_date" ng-init="marriage_date='-'" 
                                       child_style="" ng-keyup='selectStyle("Marriage Date Option", marriage_date)'
                                        ng-click='selectStyle("Marriage Date Option", marriage_date)'
                                       style="
                                       font-size: 21px;
                                       font-family: sans-serif;
                                       font-style: normal;

                                       ">
                            </div>
                            <div class="col-md-8"
                                 style="font-size: 12px;
                                 line-height: 12px;
                                 padding: 0px"
                                 >
                                <b style="    color: #000;">Enter Your Marriage Date (Your Own Format)</b><br>
                                Would you like to have a <b>Monogram</b> of your <b>Wedding Date</b> inscribed on your Tuxedo Jacket 
                            </div>


                        </div>
                    </div>

                </div>




                <div role="tabpanel" class="tab-pane" id="front">
                    <?php
                    #start of no of pleat
                    $h0 = 'Number of Pleat';
                    echo panel_creator($h0, multi_tab_element($h0));
                    #end of no of pleat
                    #----
                    #start of Ribbon on Side Seam
                    echo get_custom_data('9');
                    #end of Ribbon on Side Seam
                    #--------------
                    #start of waitsband
                    echo get_custom_data('2');
                    #end of waistband
                    #--------------
                    #start of Suspender Buttons on Inner waistband
                    echo get_custom_data('3');
                    #end of Suspender Buttons on Inner waistband
                    #----------------
                    #start of front fly zipper
                    echo get_custom_data('6');
                    #end of front fly zipper
                    ?>
                </div>


                <div role="tabpanel" class="tab-pane" id="ppocket">
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


                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="lapel">
                    <!-- 1 lepal style --> 
                    <?php
                    #lapel
                    $h0 = 'Jacket Lapel Style & Width';
                    $h01 = 'Lapel Style & Width';
                    echo panel_creator($h01, multi_tab_element($h0, $h01));
                    #lapel
                    ?>

                    <div class="navigate">
                        <?php echo get_custom_data('85'); ?>
                    </div>



                </div>
                <!-- Lapel End -->
                <!-- Front & Back -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="jfront">
                    
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
                    <?php echo get_custom_data('86'); ?>

                    <!-- 2 design -->
                    <?php echo get_custom_data('84'); ?>

                    <!-- 3 -->
                    <?php echo get_custom_data('59'); ?>
                </div>
                <!-- Pocket End -->
                <!-- Additional Feature -->
                <div role="tabpanel" class="tab-pane vertical_tab_parent" id="additionalfeature">
                    <!-- 1 front style -->
                    <p style="    margin: -8px 0px 11px;">
                        <b>Fully Lined</b> is standard <b>Lining Type</b>

                    </p>
                    <?php jacket_lining(); ?>


                     <!-- buttons -->
                    <?php tuxedo_shirt_buttons();?>



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
        productStyleArray[prd_id]['Lining Style'] = 'Matching';
        productStyleArray[prd_id]['Lining Type'] = 'Fully Lined';
        productStyleArray[prd_id]['Button'] = 'Satin Covered';
        productStyleArray[prd_id]['Marriage Date Option'] = '-';
        productStyleArray[prd_id]['Front Pocket Style'] = 'Seam';

    }
    function customsetdefalt() {
        for (i in productStyleArray) {
            customDefaultSet(i);
        }
    }
    
   

    customsetdefalt();
    
    
   
    $(function(){
        $('[child_style="Western Pocket"]').parent().hide();
        $("[parent_style='Front Pocket Style']").removeClass("selected").addClass("deselect");
        $("[parent_style='Front Pocket Style'][child_style='Seam']").removeClass("deselect").addClass("selected");
        var b1141='1/4" Slanting Pocket (Standard)';
        var b1142 = '1/4" Slanting Pocket';
         $("[child_style='"+b1141+"']").attr("child_style", b1142);
    })
    
    
   
    
</script>