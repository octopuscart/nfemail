<?php
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
 $product_cart_id = $_REQUEST['cart_product_id'];
 #########

 #########
 //echo $product_cart_id;
?>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
    <!--libs css-->
<link rel="stylesheet" href="<?php echo $get_path['option_value'] . '../custom_fabric/css/style.css' ?>" type="text/css" >
<script type="text/javascript" src="<?php echo $get_path['option_value'] . '../custom_fabric/js/jquery-1.7.2.min.js' ?>"></script> 
<script type="text/javascript" src="<?php echo $get_path['option_value'] . '../custom_fabric/js/customize_new.js' ?>"></script>


<style>
    .cartTitle{
        color: white;
        padding: 0px 5px;
        margin-top: 8px;
        text-align: center;
        width: 100%;
        background: url("../assets/images/ribbon.png");
        margin-left: -14px;
        font-size: 13px;
        background-size: 130px 44px;
        width: 104px;
        height: 44px;
        position: absolute;
    }
    .cartCustomizeStyle{
        float: left;
        margin-left: 13px;
        width: 95px;
        margin-top: 4px;
    }
</style>
<style>
    .summ_desc{
        width:170px;
    }
    .summary_left,.summary_right{
        background-color:#E7F9FA;
        width:46% !important;
        border-color:#4e4ca0; 
    }
    .summ_title{
        color:#4e4ca0;
    }
</style>
<div id="style_summ" style="display:block;">

    <div class="collartab_head woocommerce" id="accordian_11" onclick="accordian(this);" style="width:100%"><div class="title cart-collaterals" style="width:100%"><a href="javascript:void(0)" style="width:100%" class="cart_totals "><h2 class="cartTitle">Style Summary</h2></a></div></div>
    <!--------------------------------------------END--------------------------------------------------------->
    <?php
    $query = "select scp.* from nfw_shirt_custom as scp join nfw_product_cart as npc on npc.customization_id  = scp.id where npc.customization_id = $product_cart_id ";
    $shirtSummary = resultAssociate($query);
   //print_r($shirtSummary);echo "<br>";
    if ($shirtSummary) {
        $firstBlock = array_slice($shirtSummary[0], 0, 15);
        //print_r($firstBlock);
        $secondBlock = array_slice($shirtSummary[0], 15, 25);
      //  print_r($secondBlock);
        $summary_id = $shirtSummary[0]['id'];
    }
    $measurmentProfile = resultAssociate("SELECT nm.* FROM `nfw_measurement` as nm 
                   join nfw_product_cart as nc
                   on nm.id = nc.measurement_id
                   where nc.customization_id  = $product_cart_id ");
  // print_r($measurmentProfile);
    ?>  
    <div class="boxlist1">
        <div id="summary_wrapper">
            <div class="summary_left" style="background-color: #fff;
               
                 border-color: #4e4ca0;
                 margin-left: 3px;
                 margin-top: 17px;">
                <div class="summ_closebt"></div>
                <div class="clear"></div>

                <div class="summ_title">Shirt Body Fit</div><div class="float_left">:</div><div class="summ_desc" id=""><?php echo $firstBlock['body_fit']; ?></div><div class="clear"></div>
               
                <div class="summ_title">Collar Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar"><?php echo $firstBlock['collar_styles']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Button Down Collar</div><div class="float_left">:</div><div class="summ_desc" id="sm_button_style"><?php echo $firstBlock['button_down_coller']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Add 2 Buttons on the Collar Band </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_brand"><?php echo $firstBlock['add_2_buttons_on_the_coller_band']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar & Cuff Stiffness </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff_stiffness"><?php echo $firstBlock['coller_and_cuff_stiffness']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar Stays </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_stay"><?php echo $firstBlock['collar_styles']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Sleeve Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_sleeve_style"><?php echo $firstBlock['sleeve_styles']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Cuff Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff"><?php echo $firstBlock['cuff_styles'];?></div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch </div><div class="float_left">:</div><div class="summ_desc" id="sm_watch"><?php echo $firstBlock['watch']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch Wrist</div><div class="float_left">:</div><div class="summ_desc" id="sm_watch_sub"><?php echo $firstBlock['watch_wrist']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Front Styles </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_front"><?php echo $firstBlock['front_styles'];?></div>
                <div class="clear"></div>
                <div class="summ_title">Back Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_back"><?php echo $firstBlock['back_styles'] ?></div>
                <div class="clear"></div>
                 <div class="summ_title">Dart </div><div class="float_left">:</div><div class="summ_desc" id="sm_dart"><?php echo $secondBlock['dart']; ?></div><div class="clear"></div>
                <div class="summ_title">Pocket Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_pocket"><?php echo $secondBlock['pocket_styles'];?></div>
                <div class="clear"></div>
                <div class="summ_title">Bottom Styles </div><div class="float_left">:</div> <div class="summ_desc" id="sm_bottom"><?php echo $secondBlock['bottom_styles'];?></div>
                <div class="clear"></div>

            </div>
            <div class="summary_right" style="background-color: #fff;
            
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 height: 360px;
                 margin-top: 17px; margin: 16px 9px 0px -10px;">

               
                <div class="summ_title">Collar & Cuff Features </div><div class="float_left">:</div><div class="summ_desc" id="sm_cc_style"><?php $secondBlock['coller_and_cuff_features'] ?></div><div class="clear"></div>
                <div class="summ_title">Inner Collar Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc"><?php echo $secondBlock['inner_collar_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Cuff Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc2"><?php echo $secondBlock['inner_cuff_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Front Placket Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_ifpc"><?php echo $secondBlock['inner_front_placket_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Labels </div><div class="float_left">:</div><div class="summ_desc" id="sm_label"><?php echo $secondBlock['labels'] ?></div><div class="clear"></div>
                <div class="summ_title">Buttons </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_button"><?php echo $secondBlock['buttons']; ?></div>
                <div class="clear"></div>
                <div class="summ_title">Monogram Placements </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_placement"><?php echo $secondBlock['monogram_placements1'] ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_style"><?php
                   
                    echo $secondBlock['monogram_styles1'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Colors </div><div class="float_left">:</div><div class="summ_desc" id="sm_monocolor"><?php echo $secondBlock['monogram_initial1'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $secondBlock['monogram_colors1'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $secondBlock['monogram_placements2'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $secondBlock['monogram_styles2'] ?></div><div class="clear"></div>
                 <div class="summ_title">Monogram Colors </div><div class="float_left">:</div><div class="summ_desc" id="sm_monocolor"><?php echo $secondBlock['monogram_initial2'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $secondBlock['monogram_colors2'] ?></div><div class="clear"></div>
                <div class="clear"></div>
            </div>
            <div style="clear: both"></div>
        </div> 
    </div> 
</div>
<div style="clear:both;height:2%">&nbsp;</div>
<div id="measurement_summ" style="display: block;">
    <div class="collartab_head woocommerce" id="accordian_11" onclick="accordian(this);" style="width:100%"><div class="title cart-collaterals" style="width:100%"><a href="javascript:void(0)" style="width:100%" class="cart_totals "><h2 class="cartTitle">Measurement Summary</h2></a></div></div>
    <div class="boxlist1">
        <div id="summary_wrapper">

            <div class="summary_left" style="background-color: #fff;
               
                 border-color: #4e4ca0;
                 margin-left: 3px;height: 290px;
                 margin-top: 17px;">
                <div class="summ_title">Profile Name</div><div class="float_left">:</div><div class="summ_desc profile_name"><?php echo $measurmentProfile[0]['profile_name']; ?></div><div class="clear"></div>
                <div class="summ_title">Gender</div><div class="float_left">:</div><div class="summ_desc profile_gender"><?php echo $measurmentProfile[0]['gender']; ?></div><div class="clear"></div>
                 <div class="summ_title">Age</div><div class="float_left">:</div><div class="summ_desc profile_gender"><?php echo $measurmentProfile[0]['age']; ?></div><div class="clear"></div>
                <div class="summ_title">Height</div><div class="float_left">:</div><div class="summ_desc"><?php echo $measurmentProfile[0]['height']; ?></div><div class="clear"></div>
                <div class="summ_title">Weight</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['weight']; ?></div><div class="clear"></div>
                <div class="summ_title">Neck Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['neck_measurment']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Chest Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_chest_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Shoulder Width Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_shoulder_width_measurement']; ?></div><div class="clear"></div>
<div class="summ_title">
    Right Left Sleeve Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['right_left_sleeve_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Bicep Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['bicep_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Abdomen Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['abdomen_measurement']; ?></div><div class="clear"></div>

                <div class="clear"></div>
            </div>
            <div class="summary_right" style="background-color:  #fff;
              
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 margin-top: 17px;margin: 17px 9px 50px -10px;">
                 <div class="summ_title">Front Shirt/Jacket Length Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['front_shirt_jacket_length_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Trouser Waist</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['trouser_waist']; ?></div><div class="clear"></div>
                <div class="summ_title">Hips OR Seat</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['hips_or_seat']; ?></div><div class="clear"></div>

                <div class="summ_title">Crotch</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['crotch']; ?></div><div class="clear"></div>
                <div class="summ_title">Trousers Inseam</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['trousers_inseam']; ?></div><div class="clear"></div>

                <div class="summ_title">Trousers Outseam</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['trousers_outseam']; ?></div><div class="clear"></div>
                <div class="summ_title">Thigh Measuremen</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['thigh_measuremen']; ?></div><div class="clear"></div>
                  <div class="summ_title">Bottom Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['bottom_measurement']; ?></div><div class="clear"></div>

                <div class="summ_title">Waistcoat Front Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['waistcoat_front_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Waistcoat Back Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['waistcoat_back_measurement']; ?></div><div class="clear"></div>
                 <div class="summ_title">Wrist Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['wrist_measurement']; ?></div><div class="clear"></div>
               

                <div class="clear"></div>
            </div>
        </div>
    </div
</div>
</div>

<?php

function select_table($table_name, $condition) {
    $sql_data = mysql_query("select * from  $table_name $condition");
    //echo "select * from  $table_name $condition";
    $get_data = mysql_fetch_array($sql_data);
    return $get_data;
}
?>