<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (1, 2,3,5,6,7,8) and nff.standard=1 ";
$custom_default_list = resultAssociate($customquery);
foreach ($custom_default_list as $key => $value) {
    $default_select_globle[$value['parent']] = $value['child'];
}
$default_select_globle['Number of Pleat']='No Pleat';	
?>
<div class="row col-md-12 " style="    padding-right: 0;">

    <div class="">  
        <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/pant/1.jpeg" class="iconimg"> &nbsp; Body Fit</a></li>
                <li role="presentation">
                    <a  href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/pant/2.jpeg" class="iconimg"> &nbsp;  Front</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/pant/3.jpeg" class="iconimg"> &nbsp;  Pocket</a></li>

                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/pant/4.jpeg" class="iconimg"> &nbsp;  
                        Summary</a>
                </li>
            </ul>
        </div>


        <div class="col-sm-10" style="    padding-right: 0;">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="body_fit">

                    <?php
                    #start of body fit
                    echo get_custom_data('1');
                    #end of body fit
                    ?>

                </div>

                <div role="tabpanel" class="tab-pane" id="front">
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


                <div role="tabpanel" class="tab-pane" id="pocket">
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






                <div role="tabpanel" class="tab-pane" id="summary">
                    <?php
                    include 'custom_form_view/customformsummary.php';
                    ?> 
                    
                     <div style="clear: both"></div>
                </div>
              
            </div>
        </div>
        <!--custom navigation -->
        <? include 'custom_navigation.php'; ?>
        <!--end of custom navigation-->

    </div>

</div>



