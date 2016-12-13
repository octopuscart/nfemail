<?php
$customquery = "SELECT nfe.title AS parent, child_label AS child FROM nfw_custom_element as nfe 
  join nfw_custom_element_field as nff on nff.nfw_custom_element_id = nfe.id
where nfe.id in (97, 9, 2,3,6,7,8) and nff.standard=1 ";
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
                        <img src="./custom_form_view/icon/tuxedo_pant/1.jpeg" class="iconimg"> &nbsp; Body Fit</a></li>
                <li role="presentation">
                    <a  href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/2.jpeg" class="iconimg"> &nbsp;  Front</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/3.jpeg" class="iconimg"> &nbsp;  Pocket</a></li>
               
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/icon/tuxedo_pant/4.jpeg" class="iconimg"> &nbsp;  
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
                    echo get_custom_data('97');
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
                </div>

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
    }
    
    $(function(){
        $('[child_style="Western Pocket"]').parent().hide();
        $("[parent_style='Front Pocket Style']").removeClass("selected").addClass("deselect");
        $("[parent_style='Front Pocket Style'][child_style='Seam']").removeClass("deselect").addClass("selected");
        var b1141='1/4" Slanting Pocket (Standard)';
        var b1142 = '1/4" Slanting Pocket';
         $("[child_style='"+b1141+"']").attr("child_style", b1142);
    })
    
    
    function customDefaultSet(prd_id) {
        var temp = productStyleArray[prd_id];
        productStyleArray[prd_id]['Front Pocket Style'] = 'Seam';
   
    }
    function customsetdefalt() {
        for (i in productStyleArray) {
            customDefaultSet(i);
        }
    }

    customsetdefalt();
    
</script>



