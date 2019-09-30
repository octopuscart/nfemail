
<div class="row col-md-12 " style="    padding-right: 0;">

    <div class="">  
        <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                <li role="presentation" class="active ">
                    <a class="activeTab" href="#body_fit" aria-controls="body_fit" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg"> &nbsp; Body Fit</a></li>
                <li role="presentation">
                    <a  href="#front" aria-controls="front" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg"> &nbsp;  Front</a></li>
                <li role="presentation">
                    <a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg"> &nbsp;  Pocket</a></li>
               
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                        <img src="./custom_form_view/suit/elbow_patch/dk_brown_suede.jpg" class="iconimg"> &nbsp;  
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
</script>



