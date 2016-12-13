<?php
include 'header.php';
include '../producthandler/productHandler.php';
$id = $_REQUEST['product_id'];
$productArray = explode(',', $id);
$product_cart_id = $productArray[0];

$query = "select product_id from nfw_product_cart where id = '$product_cart_id' ";
$productid = resultAssociate($query);
$product_id = $productid[0]['product_id'];
$prdobj = new ProductHandler($product_id);
$productInfo = $prdobj->productInformation();

$shirtSummary = resultAssociate("select scp.* from shirt_customize_profile as scp join nfw_product_cart as npc on npc.customization_id  = scp.id where npc.id = $product_cart_id ");
//print_r($shirtSummary);echo "<br>";
if ($shirtSummary) {
    $firstBlock = array_slice($shirtSummary[0], 0, 14);
    $secondBlock = array_slice($shirtSummary[0], 14, 25);
//print_r($secondBlock);
    $summary_id = $shirtSummary[0]['id'];
}
$measurmentProfile = resultAssociate("select cmp.* from customer_measurement_profile as cmp join shirt_customize_profile as scp on scp.profile_id = cmp.id where scp.id = '$summary_id'  ");
//print_r($measurmentProfile);
?>
<link rel="stylesheet" href="<?php echo $get_path['option_value'] . '../custom_fabric/css/style.css' ?>" type="text/css" >
<script type="text/javascript" src="<?php echo $get_path['option_value'] . '../custom_fabric/js/jquery-1.7.2.min.js' ?>"></script> 
<script type="text/javascript" src="<?php echo $get_path['option_value'] . '../custom_fabric/js/customize_new.js' ?>"></script>
<style>
    .summ_desc{
        width:170px;
    }
    .summary_left,.summary_right{
        background-color:#E7F9FA;
        width:49% !important;
        border-color:#4e4ca0; 
    }
    .summ_title{
        color:#4e4ca0;
    }
</style>
<script>
    $(function() {

    });
</script>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding-top: 15px; padding-bottom: 0px;">
    <div class="container">
        <h4 style="color: #1FB8C6 !important; font-weight: 300;margin-bottom: 15px;" >Shirt Customization Summary</h4>
        <!--        <h1 class="color_dark fw_light m_bottom_5">All Shopping Cart</h1>-->
        <!--breadcrumbs-->


    </div>
</section>
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



<a href="#" style="margin: 19px;" class="button_type_7 m_mxs_bottom_5 d_inline_b m_right_2 tt_uppercase color_blue r_corners vc_child tr_all" data-toggle="modal" data-target="#myModal" ><span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"></i><span class="fs_medium">Customize Now</span></span></a>

<?php
$subqry = implode(',', $productArray);
$mquery = "select product_id from nfw_product_cart where id in ($subqry)";
$productid = resultAssociate($mquery);
//print_r($productid);
for ($i = 0; $i < count($productid); $i++) {
    $nproduct_id = $productid[$i]['product_id'];
    $prdobjn = new ProductHandler($nproduct_id);
    $productInfon = $prdobjn->productInformation();
    $productImage = $prdobjn->productImage();
    //print_r($productid);
    ?>



    <!--    <div class="col-md-2  well well-sm">
            <label><?php print_r($productInfon['title']); ?></label>
            <img src=" <?php print_r($productImage['profileImage']); ?>" style="height: 70px;width: 70px">
        </div>-->


    <div class="cartItems" style="display: block">

        <div class="cartCustomizeStyle">



            <label class="cartTitle"><?php print_r($productInfon['title']); ?></label>

            <p class="cartsku"></p>
            <img src="<?php print_r($productImage['profileImage']); ?>" class="cartImage" style="height:70px;width: 70px">
        </div>

    </div>


<?php } ?>

<div id="style_summ" style="display:block;">

    <div class="collartab_head woocommerce" id="accordian_11" onclick="accordian(this);" style="width:100%"><div class="title cart-collaterals" style="width:100%"><a href="javascript:void(0)" style="width:100%" class="cart_totals "><h2 class="cartTitle">Style Summary</h2></a></div></div>
    <!--------------------------------------------END--------------------------------------------------------->
    <?php
    ?>  
    <div class="boxlist1">
        <div id="summary_wrapper">
            <div class="summary_left" style="background-color: #E7F9FA;
                 width: 50% !important;
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 margin-top: 17px;">
                <div class="summ_closebt"></div>
                <div class="clear"></div>
               <div class="summ_title">Fabric No </div><div class="float_left">:</div><div class="summ_desc" id=""><?php echo $firstBlock['fabric_no']; ?></div><div class="clear"></div>
                <div class="summ_title">Shirt Body Fit </div><div class="float_left">:</div><div class="summ_desc" id="sm_fit"><?php
                    $shirt = select_table('shirt_body_fit', "where shirt_body_fit_id='" . $firstBlock['shirt_body_fit'] . "'");
                    echo $shirt['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Collar Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar"><?php
                    $collar = select_table('collar', "where id='" . $firstBlock['collar_styles'] . "'");
                    echo $collar['file_name'];
                    ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Button Down Collar</div><div class="float_left">:</div><div class="summ_desc" id="sm_button_style"><?php echo $firstBlock['button_down_collar']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Add 2 Buttons on the Collar Band </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_brand"><?php echo $firstBlock['add_2_buttons_on_the_collar_band']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar & Cuff Stiffness </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff_stiffness"><?php echo $firstBlock['collar_and_cuff_stiffness']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar Stays </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_stay"><?php echo $firstBlock['collar_stays']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Sleeve Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_sleeve_style"><?php echo $firstBlock['sleeve_styles']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Cuff Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff"><?php
                    $cuff = select_table('cuff', "where id='" . $firstBlock['cuff_styles'] . "'");
                    echo $cuff['file_name'];
                    ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch </div><div class="float_left">:</div><div class="summ_desc" id="sm_watch"><?php echo $firstBlock['watch']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch Wrist</div><div class="float_left">:</div><div class="summ_desc" id="sm_watch_sub"><?php echo $firstBlock['watch_wrist']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Front Styles </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_front"><?php
                    $front = select_table('front', "where id='" . $firstBlock['front_styles'] . "'");
                    echo $front['file_name'];
                    ?>
                </div>
                <div class="clear"></div>

                <div class="summ_title">Back Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_back"><?php
                    $back = select_table('back', "where id='" . $firstBlock['back_styles'] . "'");
                    echo $back['file_name']
                    ?></div><div class="clear"></div>

            </div>
            <div class="summary_right" style="background-color: #E7F9FA;
                 width: 46% !important;
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 margin-top: 17px;">

                <div class="summ_title">Dart </div><div class="float_left">:</div><div class="summ_desc" id="sm_dart"><?php echo $secondBlock['dart']; ?></div><div class="clear"></div>
                <div class="summ_title">Pocket Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_pocket"><?php
                    $pocket = select_table('pocket', "where id='" . $secondBlock['pocket_styles'] . "'");
                    echo $pocket['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Bottom Styles </div><div class="float_left">:</div> <div class="summ_desc" id="sm_bottom"><?php
                    $bottom = select_table('shirt', "where id='" . $secondBlock['bottom_styles'] . "'");
                    echo $bottom['file_name'];
                    ?></div>
                <div class="clear"></div>
                <div class="summ_title">Collar & Cuff Features </div><div class="float_left">:</div><div class="summ_desc" id="sm_cc_style"><?php $secondBlock['collar_and_cuff_features'] ?></div><div class="clear"></div>
                <div class="summ_title">Inner Collar Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc"><?php echo $secondBlock['inner_collar_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Cuff Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc2"><?php echo $secondBlock['inner_cuff_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Front Placket Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_ifpc"><?php echo $secondBlock['innerfront_placket_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Labels </div><div class="float_left">:</div><div class="summ_desc" id="sm_label"><?php echo $secondBlock['labels'] ?></div><div class="clear"></div>
                <div class="summ_title">Buttons </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_button"><?php
                    $back = select_table('button', "where id='" . $secondBlock['buttons'] . "'");
                    echo $back['file_name'];
                    ?></div>
                <div class="clear"></div>
                <div class="summ_title">Monogram Placements </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_placement"><?php echo $secondBlock['monogram_placements'] ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_style"><?php
                    $back = select_table('monogram', "where id='" . $secondBlock['monogram_styles'] . "'");
                    echo $back['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Colors </div><div class="float_left">:</div><div class="summ_desc" id="sm_monocolor"><?php echo $secondBlock['monogram_colors'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $secondBlock['additional_feature'] ?></div><div class="clear"></div>
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

            <div class="summary_left" style="background-color: #E7F9FA;
                 width: 50% !important;
                 border-color: #4e4ca0;
                 margin-left: 15px;height: 278px;
                 margin-top: 17px;">
                <div class="summ_title">Profile Name</div><div class="float_left">:</div><div class="summ_desc profile_name"><?php echo $measurmentProfile[0]['profile_name']; ?></div><div class="clear"></div>
                <div class="summ_title">Gender</div><div class="float_left">:</div><div class="summ_desc profile_gender"><?php echo $measurmentProfile[0]['gender']; ?></div><div class="clear"></div>
                <div class="summ_title">Height</div><div class="float_left">:</div><div class="summ_desc"><?php echo $measurmentProfile[0]['height']; ?></div><div class="clear"></div>
                <div class="summ_title">Weight</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['weight']; ?></div><div class="clear"></div>
                <div class="summ_title">Neck Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['neck_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Chest Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_chest_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Shoulder Width Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_shoulder_width_measurement']; ?></div><div class="clear"></div>

                <div class="clear"></div>
            </div>
            <div class="summary_right" style="background-color: #E7F9FA;
                 width: 46% !important;
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 margin-top: 17px;">
                <div class="summ_title">Right Sleeve Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['right_sleeve_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Left Sleeve Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['left_sleeve_measurement']; ?></div><div class="clear"></div>

                <div class="summ_title">Bicep Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['bicep_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Wrist Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['wrist_measurement']; ?></div><div class="clear"></div>

                <div class="summ_title">Waist/Stomach Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['waist_or_stomach_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Hips/Seat Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['hips_or_seat_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Front Shirt/Jacket Length Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['front_shirt_or_jacket_length_measurement']; ?></div><div class="clear"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div
</div>
</div>
<div class="clear"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">

        <div class="modal-content" style="width:112%;">
            <div class="modal-header" style="height: 48px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <iframe class="loginScreen" src="../custom_fabric/index.php?fabric=<?php echo $productInfo['sku']; ?>&amp;id=<?php echo $productInfo['id']; ?>&amp;pro_img=   &lt;img width=&quot;300&quot; height=&quot;300&quot; src=&quot;http://localhost/nfv2.0/wp-content/uploads/2013/06/2-300x300.jpg&quot; class=&quot;backg_img wp-post-image&quot; alt=&quot;2&quot; id=&quot;img_zoom&quot; data-zoom-image=&quot;http://localhost/nfv2.0/wp-content/uploads/2013/06/2.jpg&quot; title=&quot;2&quot;&gt;&amp;pro_price=$<?php echo $productInfo['price']; ?>&amp;pro_dis=Wide Yellow� &amp; White Stripes
                        &amp;user_id=1&amp;user= &amp;cloth_id=<?php echo $productInfo['id']; ?>&amp;fabric_id=1&amp;fabric_no=<?php echo $productInfo['sku']; ?>&amp;fabric_price=$<?php echo $productInfo['price']; ?>&amp;post_id=<?php echo $productInfo['id']; ?>&amp;product_array=<?php echo $id ?>" width="100%" height="540" scrolling="yes"></iframe>

            </div>
            <script>
    localStorage.checkCheckout = 0;
    $(function() {
        var mInterval = setInterval(function() {
            console.log(localStorage.checkCheckout);
            if (localStorage.checkCheckout == 1) {
                localStorage.checkCheckout = 0;
                window.location = window.location.toLocaleString();

            }
            ;
        }, 1000);
    })
            </script>  

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php

function select_table($table_name, $condition) {
    $sql_data = mysql_query("select * from  $table_name $condition");
    //echo "select * from  $table_name $condition";
    $get_data = mysql_fetch_array($sql_data);
    return $get_data;
}
?>
<?php
include 'footer.php';
?>

