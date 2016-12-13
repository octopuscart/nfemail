
<?php
$no_of_pleat1 = array(
    '1_pleat_standard' => 'Standard',
    '1_pleat_reverse' => 'English (Reverse Pleat)',
);
$no_of_pleat2 = array(
    '2_pleat_standard' => 'Standard',
    '2_pleat_reverse' => 'English (Reverse Pleats)',
);
?>


<div class="navigate">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                </span> 
                Number of Pleat
            </h3>
        </div>
        <div class="panel-body" style="padding: 15px 15px 0px 15px; ">
            <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="">
                <li role="presentation" class=" active" >
                    <a href="#matching" aria-controls="matching" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                        <img src="./custom_form_view/pant/pleats/no_pleat.jpg" class="iconimg">  No Pleat 
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#contrast" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                        <img src="./custom_form_view/pant/pleats/1_pleat_standard.jpg" class="iconimg">  1 Pleat 
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#fancy" aria-controls="fancy" role="tab" data-toggle="tab" style="background: #fff;color: #000; ">
                        <img src="./custom_form_view/pant/pleats/2_pleat_standard.jpg" class="iconimg">  2 Pleats 
                    </a>
                </li>
            </ul>


            <div class="tab-content" style="
                 border: 1px solid #000;
                 padding: 3px;
                 margin-bottom: 15px;">

                <div role="tabpanel" class="tab-pane active" id="matching">
                    <div class="  " role="alert" style="margin-top: 10px;">

                        <div class="col-sm-4 col-sm-4 pleat_selection">
                            <div class="thumbnail pleat animated style_selection navigat_error" parent_style="Number of Pleat" child_style="No Pleat" >
                                <img src="./custom_form_view/pant/pleats/no_pleat.jpg" alt="..." class=" suit_controlZoom " >
                                <div class="caption " style="  margin-top: -4px;">
                                    <h3>No Pleat </h3>
                                </div>
                            </div>
                        </div>

                        <div style="clear: both"></div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane " id="contrast">
                    <div class="  " role="alert" style="margin-top: 10px;">


                        <?php
                        $pleatCount = 0;
                        foreach ($no_of_pleat1 as $key => $value) {
                            $pleatCount++;
                            ?>
                            <div class="col-sm-4 col-sm-4  <?php echo $pleatCount < 3 ? 1 : 2; ?>_area" >
                                <div class="thumbnail pleat animated style_selection" parent_style="Number of Pleat" child_style="1 Pleat <?php echo $value; ?>" >
                                    <img class="pant_controlZoom" src="./custom_form_view/pant/pleats/<?php echo $key; ?>.jpg" alt="..." >
                                    <div class="caption" style="  margin-top: -4px;">
                                        <h3><?php echo $value; ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <div style="clear: both"></div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane " id="fancy"> 
                    <div class="  " role="alert" style="margin-top: 10px;">

                        <?php
                        $pleatCount = 0;
                        foreach ($no_of_pleat2 as $key => $value) {
                            $pleatCount++;
                            ?>
                            <div class="col-sm-4 col-sm-4  <?php echo $pleatCount < 3 ? 1 : 2; ?>_area" >
                                <div class="thumbnail pleat animated style_selection" parent_style="Number of Pleat" child_style="2 Pleats <?php echo $value; ?>" >
                                    <img class="pant_controlZoom" src="./custom_form_view/pant/pleats/<?php echo $key; ?>.jpg" alt="..." >
                                    <div class="caption" style="  margin-top: -4px;">
                                        <h3><?php echo $value; ?></h3>
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
</div>