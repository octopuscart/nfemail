<?php
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
$product_cart_id = $_REQUEST['cart_product_id'];

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
        margin-left: 38px;
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
        width:80% !important;
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
    $query = "select scp.* from nfw_pant_custom as scp join nfw_product_cart as npc on npc.customization_id  = scp.id where npc.customization_id = $product_cart_id ";
    $shirtSummary = resultAssociate($query);
    if ($shirtSummary) {
        $firstBlock = $shirtSummary[0];
        //print_r($firstBlock);
    }

    ?>  
    <div class="boxlist1">
        <div id="summary_wrapper">
            <div class="summary_left" style="background-color: #E7F9FA;
               
                 border-color: #4e4ca0;
                 margin-left: 59px;
                 margin-top: 17px;">
                <div class="summ_closebt"></div>
                <div class="clear"></div>


                <div class="summ_title">Body Fit </div><div class="float_left">:</div><div class="summ_desc" id="sm_fit"><?php echo $firstBlock['body_fit'];?></div><div class="clear"></div>
                <div class="summ_title">No Of Pleat</div><div class="float_left">:</div><div class="summ_desc" id="sm_collar"><?php echo $firstBlock['number_of_pleat']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Waistband</div><div class="float_left">:</div><div class="summ_desc" id="sm_button_style"><?php echo $firstBlock['waistband']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Suspender Button On Inner Waistband</div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_brand"><?php echo $firstBlock['suspender_button_on_inner_waistband']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Cuff</div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff_stiffness"><?php echo $firstBlock['cuff']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Zipper Front Fly Zipper</div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_stay"><?php echo $firstBlock['zipper_front_fly_zipper']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Front Pocket Style</div><div class="float_left">:</div><div class="summ_desc" id="sm_sleeve_style"><?php echo $firstBlock['front_pocket_style']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Number Of Back Pocket</div><div class="float_left">:</div><div class="summ_desc" id="sm_watch"><?php echo $firstBlock['number_of_back_pocket']; ?></div><div class="clear"></div>
                <div class="clear"></div>
               
              

             

            </div>
     
            <div style="clear: both"></div>
        </div> 
    </div> 
</div>
<div style="clear:both;height:2%">&nbsp;</div>


<?php

function select_table($table_name, $condition) {
    $sql_data = mysql_query("select * from  $table_name $condition");
    //echo "select * from  $table_name $condition";
    $get_data = mysql_fetch_array($sql_data);
    return $get_data;
}
?>