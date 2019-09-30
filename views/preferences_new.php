<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>
<?php
} else {

    if (isset($_REQUEST['tagid'])) {
        $order_mesurement = $authobj->userMeasurment($_REQUEST['tagid'], $_SESSION['user_id']);
    }
    if (isset($_REQUEST['updateMesurement'])) {
        echo "in";
        $authobj->updateMeasurement($_POST);
    }
    if (isset($_REQUEST['setDefaultMeasurement'])) {
        $authobj->userDefaultMeasurement($_SESSION['user_id'], $_REQUEST['tagid'], $_REQUEST['measurement_style']);
    }
    $res1 = $authobj->SelectuserMeasurement($_SESSION['user_id'], $_REQUEST['tagid']);




    if (isset($_REQUEST['tagid'])) {
        $order_data = $authobj->findStyleId($_REQUEST['tagid'], $_SESSION['user_id']);
        // print_r($order_data);
    }
    if (isset($_REQUEST['updateData'])) {
        $authobj->updateStyle($_POST);
    }
    if (isset($_REQUEST['setDefaultStyle'])) {
        //print_r($_POST);
        $authobj->userDefaultStyle($_SESSION['user_id'], $_REQUEST['tagid'], $_REQUEST['default_style']);

        // print_r($res);
    }
    $res = $authobj->SelectuserStyle($_SESSION['user_id'], $_REQUEST['tagid']);
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">My Preferences</p>
            <div style="margin-top: 10px;">  


            </div>

        </div>
    </section>
    <style>
        .table th{
            border:none;
        }
        .table td{
            border:none;
        }
    </style>
    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-2 col-sm-2 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
    <?php
    include 'leftMenu.php';
    ?>
                </aside>
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30"  style="width: 85%;">

                    <div class="panel panel-default" style="">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                        </div>
                        <div class="panel-body">

                            <div class="col-md-12 well well-sm">
                                <p> 
                                    <input type="checkbox" id="checkboxs_1" name="" class="d_none product_checkBox" >
                                    <label for="checkboxs_1" class="d_inline_m m_right_10" style="margin: 0px 0px 24px 0px;"></label>
                                    News Letter  ( First dibs on all exclusive deals, new arrivals and trends)
                                </p>

                                <div class="col-md-1"></div>
                                <div class="col-md-10" style="margin: 20px 0px 0px -48px;">

                                    <p>Frequency</p>

                                    <div> <input type="radio" checked="" id="radio_1" name="radio" class="d_none">
                                        <label for="radio_1" class="d_inline_m m_right_10" style="margin: 10px 0px 0px 57px;">Full Experience </label>
                                    </div>
                                    <br/>
                                    <div>
                                        <input type="radio" checked="" id="radio_2" name="radio" class="d_none">
                                        <label for="radio_2" class="d_inline_m m_right_10" style="margin: -11px 0px 0px 57px;">On Promotion</label>

                                    </div> 
                                    <br/>
                                    <div> <input type="radio" checked="" id="radio_3" name="radio" class="d_none">
                                        <label for="radio_3" class="d_inline_m m_right_10"  style="margin: -11px 0px 0px 57px;">On New Arrival </label>
                                    </div>
                                    <br/>
                                    <div> <input type="radio" checked="" id="radio_4" name="radio" class="d_none">
                                        <label for="radio_4" class="d_inline_m m_right_10"  style="margin: -11px 0px 0px 57px;">Weekly</label>
                                    </div>
                                    <br/>
                                    <div> <input type="radio" checked="" id="radio_5" name="radio" class="d_none">
                                        <label for="radio_5" class="d_inline_m m_right_10"  style="margin: -11px 0px 0px 57px;">Monthly</label>
                                    </div>

                                </div>
                            </div>

                            <div style="clear: both"></div>



                            <!-- body -->


                            <div class="col-sm-12 tab-content" style="
                                 border: 1px solid #000;
                                 padding: 7px 12px 5px 9px;
                                 margin-bottom: 16px;
                                 border-radius: 4px;
                                 border-top-left-radius: 0px;
                                 border-top-right-radius: 5px;
                                 margin-top: -11px;
                                 margin-left: 5px;
                                 ">
                                <div role="tabpanel" class="tab-pane active" id="cusmotize_items">
                                    <div class="col-md-12">

                                        <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">




                                        <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;color:#000">
                                            <!-- Nav tabs --> 
                                            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="padding-top: 12px;border-right: 1px solid #000; ">

                                                <?php
                                                $tag = $authobj->preferenceTag();
                                                for ($i = 0; $i < count($tag); $i++) {
                                                    //$tagData = $tag[$i];
                                                    $bas_tag = $tag[$i]['tag_title'];
                                                    $bas_tag_id = $tag[$i]['id'];
                                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                                    ?>
                                                    <li role="presentation" class="<?php echo $i == 0 ? 'active' : ''; ?>  ">
                                                        <a href="#<?php echo $bas_tag_temp; ?>"  aria-controls="<?php echo $bas_tag_temp; ?>" role="tab" data-toggle="tab">
                                                    <?php echo $bas_tag; ?>
                                                        </a>
                                                    </li>
        <?php
    }
    ?>
                                            </ul>
                                        </div>


                                        <div class="col-sm-10" style="padding-right: 0;">
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <?php
                                                $count = 0;
                                                for ($t = 0; $t < count($tag); $t++) {
                                                    $bas_tag = $tag[$t]['tag_title'];
                                                    $bas_tag_id = $tag[$t]['id'];
                                                    $bas_tag_temp1 = str_replace(" ", "_", $bas_tag);
                                                    $bas_tag_temp = strtolower($bas_tag_temp1);
                                                    ?>
                                                    <div role="tabpanel" class="custom_form_tables tab-pane <?php echo $t == 0 ? 'active' : ''; ?> " id="<?php echo $bas_tag_temp; ?>">
                                                    <?php echo $bas_tag; ?>

                                                    </div>
        <?php
    }
    ?>
                                            </div>
                                        </div>
                                        <!-- End -->
                                    </div>
                                </div>
                                <!--                <div role="tabpanel" class="tab-pane " id="customized_items">
                                
                                                     With customized product 
                                
                                <?php
                                $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);
// print_r($customizedData);
                                if ($customizedData) {
                                    ?>
                                    
                                                            <div class="col-md-12" style="">
                                                                <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Customized product</h4>
                                                                <div class="">
                                                                    <table class="table withCoustom custom_container">
                                                                        <thead>
                                                                            <tr>        
                                    
                                                                                <th style="width: 18%;">Product Description</th>
                                                                                <th style="width: 12%;">SKU</th>
                                                                                <th style="width: 12%;">Tag</th>
                                                                                <th style="width: 12%;">Quantity</th>
                                                                                <th style="width: 12%;">Price</th>
                                                                                <th style="width: 12%;">Extra Price</th>
                                                                                <th style="width: 12%;">Total</th>
                                                                                <th style="width: 9%;"></th>
                                    
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                    <?php
                                    $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);

                                    for ($i = 0; $i < count($customizedData); $i++) {
                                        $cartid = $customizedData[$i]['id'];
                                        $pro = new ProductHandler($cartid);
                                        $title = $pro->productTitle();
                                        // print_r($title[0]['title']);

                                        $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);
                                        ?>
                                                                                    <tr class="">
                                        
                                                                                        <td>
                                                                                            <div style="width:80px;float: left;">
                                                                                                <a href="#" class="r_corners d_inline_b wrapper">
                                                                                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height:72px;width:62px;">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div>
                                        
                                        
                                                                                                <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></p>
                                                                                                <p class="fw_light"><?php echo substr($cartInfo['short_description'], 0, 25); ?></p>
                                        <?php
                                        $customization_id = $cartprd->customizationIdFind($cartid);
                                        $temp = $customization_id[0]['customization_id'];
                                        //echo $temp;
                                        $final_data = $authobj->styleIdWithCustomizationID($temp);
//print_r($final_data);
                                        ?>
                                                                                                <span data-toggle="" data-placement="left" title="View Summary"><a href="#" style="padding: 0px;height: 22px;width: 28px;margin-left:1px" class="btn btn-default btn-xm" data-toggle="modal" data-target="#myModal_<?php echo $temp ?>_<?php echo $i ?>"><i class="icon-eye"></i></a></span>
                                                                                                <span data-toggle="" data-placement="left" title="Send Mail"> <a href="../producthandler/mailAndMessageHandler.php?cart_product_id=<?php echo $temp; ?>&table_name=<?php echo $cartInfo['customize_table'] ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                                                                                                <span data-toggle="" data-placement="left" title="Save PDF"><a href="./pant_customize_profile_summary_pdf.php?cart_product_id=<?php echo $temp; ?>&table_name=<?php echo $cartInfo['customize_table'] ?>&client_code=<?php echo $userInfo[0]['registration_id'] ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>
                                        
                                                                                                 Modal 
                                                                                                <div class="modal fade" id="myModal_<?php echo $temp ?>_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                                    <div class="modal-dialog">
                                                                                                        <div class="modal-content">
                                                                                                            <form method="post">
                                                                                                                <div class="modal-header" style="background:#337ab7;color: white">
                                                                                                                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                                                        &times;
                                                                                                                    </button>
                                                                                                                    <p class="modal-title" id="myModalLabel">
                                                                                                                        <i class="icon-edit"></i> Style Detail
                                                                                                                    </p>
                                                                                                                </div>
                                        
                                                                                                                <div class="modal-body">
                                        
                                                                                                                    <table class="table" id="table3">
                                        <?php
                                        $data = $final_data[0]['custom_form_data'];
                                        $final1 = phpjsonstyle($data, 'php');

                                        foreach ($final1 as $key => $value) {
                                            ?>
                                                                                                                            <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px">
                                                                                                                                <td ><?php echo $key ?></td>
                                                                                                                                <td ><?php echo $value ?></td>
                                                                                                                            </tr> 
                                                                                                                            
                                                                                                                            
            <?php }
            ?>
                                                                                                                    </table>
                                        
                                        
                                                                                                                </div>
                                        
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-default" 
                                                                                                                            data-dismiss="modal">Close
                                                                                                                    </button>
                                        
                                                                                                                </div>
                                                                                                            </form>
                                        
                                                                                                        </div> /.modal-content 
                                                                                                    </div> /.modal-dialog 
                                                                                                </div> /.modal 
                                                                                                 End 
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><?php echo $cartInfo['sku']; ?></td>
                                                                                        <td>
                                        <?php $res = $cartprd->productCatTagId($cartInfo['cart_product_id']); ?>
                                                                                                <p>Shirt</p>
            <?php ?>
                                                                                           
                                                                                        </td>
                                                                                        <td>
            <?php echo $cartInfo['quantity']; ?>
                                        
                                                                                        </td>
                                                                                        <td><?php echo '$' . $cartInfo['price'] . '.00'; ?></td>
                                        
                                        
                                                                                        <td><?php echo '$' . $cartInfo['extra_price'] . '.00'; ?><br/>
                                                                                            <button name="extra_detail" class="btn btn-primary btn-xs" onclick="extraPriceDetail(this)" value="<?php echo $cartInfo['customization_id'] ?>" 
                                                                                                    id="<?php echo $cartInfo['customize_table']; ?>" data-toggle="modal" data-target="#myModal">View detail</button>
                                                                                        </td>
                                        
                                                                                        <td>
            <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                                                                        </td>
                                                                                <form method="post">
                                                                                    <td data-title="Action" class="fw_ex_bold color_dark"  style="width:20px">
                                                                                        <button class="color_grey_light_2 color_dark_hover tr_all" name="deleteCart" value="<?php echo $cartInfo['cart_product_id']; ?>">
                                                                                            <i class="icon-cancel-circled-1 fs_large"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </form>
                                                                                </tr>
                                        
                                        <?php
                                        $total_price1 = $total_price1 + $cartInfo['cart_price'];
                                        $quntit = $quntit + $cartInfo['quantity'];
                                    }
                                    ?> 
                                                                        <input type="hidden" id="no_of_product" value="<?php echo $quntit ?>">
                                                                        <tr class="bg_light_2">
                                                                            <td colspan="6" class="v_align_m">
                                                                                <div class="d_table w_full">
                                                                                    <div class="col-lg-9 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                    
                                                                                    </div>
                                                                                    <div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_pink t_xs_align_c">
                                                                                        Grand Total:		
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="2" class="fw_ex_bold color_pink v_align_m"><?php echo '$' . $total_price1 . '.00'; ?></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                    
                                    
                                                                <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Your order</h4>
                                                                <div class="r_corners wrapper border_grey wrap_xs d_inline_b d_mxs_block m_bottom_15">
                                                                    <table class="t_align_l table_type_3">
                                                                        <tbody>
                                                                            <tr class="tr_delay">
                                                                                <td class="fw_light t_align_r">Total products:</td>
                                                                                <td id="nproduct">0</td>
                                                                            </tr>
                                                                            <tr class="bg_light_2">
                                                                                <td class="fw_light t_align_r"><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total price:</p></td>
                                                                                <td><p class="fw_ex_bold color_pink m_top_10 m_bottom_10" id="tPrice">$299.99</p></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="m_bottom_23">
                                    
                                                                    <input type="checkbox" id="checkbox_7" name="" class="d_none">
                                                                    <label for="checkbox_7" class="">I agree to the Terms of Service </label>
                                                                    <p class="d_inline_m fw_light">(<a href="#" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>
                                                                </div>
                                    <?php if ($customizedData) {
                                        ?>
                                        
                                                                        <a href="shippingCart.php" class="d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset">
                                                                            <i class="icon-check d_inline_b m_right_5"></i> Checkout Now
                                                                        </a>
                                        
                                        
                                    <?php }
                                    ?>
                                    
    <?php } else { ?>   
                                                                <div class="col-md-12"
                                                                     style="
                                                                     background: url(http://www.vg-industrial.com/images/Gallery/larges/suit_001.jpg);
                                                                     background-repeat: no-repeat;
                                                                     background-size: 100% ;
                                                                     padding: 0px;
                                                                     background-position-y: -312px;
                                                                     "
                                                                     >
                                    
                                                                    <div class="" style="
                                                                         background-color: rgba(0, 0, 0, 0.66);
                                                                         padding: 10px;
                                                                         height: 250px;
                                                                         ">
                                                                        <h2 style="
                                                                            color: #FFF;
                                                                            font-weight: 200;
                                                                            font-size: 50px;
                                                                            margin-top: 79px;
                                                                            text-align: center;
                                                                            ">
                                    
                                    
                                                                            <i class="icon-basket icon-2x"></i>
                                    
                                    
                                                                            No customized items are available for order.
                                                                        </h2>
                                                                    </div>
                                    
                                    
                                                                </div>
                                    
    <?php } ?>
                                                    </div>
                                                </div>-->

                            </div>




                            <!--                        
                                                    <div class="col-md-12 well well-sm">
                            <?php
                            $tag = $authobj->preferenceTag();
                            for ($i = 0; $i < count($tag); $i++) {
                                $tagData = $tag[$i];
                                //print_r($tagData);
                                echo "<button style='margin-left:4px;' name='tagId' class='btn btn-danger btn-sm' onclick='find_tag_id(this)' id='" . $tagData['id'] . "'>" . $tagData['tag_title'] . "</button>";
                            }
                            ?>  
                                                    </div>
                                                    
                                                    <div style="clear: both"></div>
                                                    
                                    <ul class="main_custom_tab nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#style" aria-controls="home" role="tab" data-toggle="tab">
                                                Select Style </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#measurment_style" aria-controls="measurment" role="tab" data-toggle="tab">
                                                 Select Measurement Style</a>
                                        </li>
                            
                                    </ul>
                                                    
                                     <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in fabric_preview active" id="style" style="padding-top: 10px">
                                                    
    <?php if ($order_data) { ?>
                                                          <form method="post">
                                                            <div class="col-md-12 well well-sm">
                                                              
                                
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th style="">S.No.</th>
                                                                            <th style="">Set As Default</th>
                                                                            <th style="">Previous Style</th>
                                                                            <th style="">View Detail</th>
                                
                                                                        </tr>
                                <?php
                                for ($i = 0; $i < count($order_data); $i++) {
                                    $data = $order_data[$i];
                                    ?>
                                                                                <tr>
                                                                                    <td><?php echo $i + 1; ?></td>
                                                                                    <td>
                                                                                        <input type="radio" id="radio_7_<?php echo $i; ?>" name="default_style" class="d_none" <?php if ($data['id'] == $res[0]['style_id']) { ?> checked <?php } ?>  value="<?php echo $data['id']; ?>" style="height: 31px;">
                                                                                        <label for="radio_7_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                                                    </td>
                                                                                    <td><?php echo $data['style']; ?></td>
                                                                                    <td>
                                                                                        <button name="" type="button" class="btn btn-primary btn-sm " onclick='find_style(this)' id ="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#myModal">View detail</button>
                                                                                    </td>
                                                                                </tr>
                                    
        <?php } ?>
                                                                    </table>
                                
                                                            </div>
                                
                                                             body 
                                                            <button type="submit" name="setDefaultStyle" class="btn btn-primary btn-sm redButton" disabled>
                                                                <i class="icon-check"></i> Submit
                                                            </button>
    <?php } ?>
                                                    </form>
                                        </div>
                                            
                                         <div role="tabpanel" class="tab-pane fade in fabric_preview" id="measurment_style" style="padding-top: 10px">
    <?php if ($order_mesurement) { ?>
                                                            <div class="col-md-12 well well-sm">
                                                                <form method="post">
                                
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th style="">S.No.</th>
                                                                            <th style="">Set As Default</th>
                                                                            <th style="">Previous Measurement</th>
                                                                            <th style="">View Detail</th>
                                
                                                                        </tr>
                                <?php
                                for ($i = 0; $i < count($order_mesurement); $i++) {
                                    $data = $order_mesurement[$i];
                                    ?>
                                                                                <tr>
                                                                                    <td><?php echo $i + 1; ?></td>
                                                                                    <td>
                                                                                        <input type="radio" id="radio_2_<?php echo $i; ?>" name="measurement_style" class="d_none" value="<?php echo $data['id']; ?>" <?php if ($data['id'] == $res1[0]['measurement_id']) { ?> checked <?php } ?> style="height: 31px;">
                                                                                        <label for="radio_2_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                                                    </td>
                                                                                    <td><?php echo $data['profile_name']; ?></td>
                                                                                    <td>
                                                                                        <button name="" type="button" class="btn btn-primary btn-sm " onclick='find_measurement(this)' id ="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#myModal1">View detail</button>
                                                                                    
                                                                                    </td>
                                                                                </tr>
                                    
        <?php } ?>
                                                                    </table>
                                
                                                            </div>
                                
                                                             body 
                                                            <button type="submit" name="setDefaultMeasurement" class="btn btn-primary btn-sm redButton">
                                                                <i class="icon-check"></i> Submit
                                                            </button>
    <?php } ?>
                                                    </form>
                                                
                                         </div>
                                         
                                     </div>  Tab end   -->


                        </div>
                    </div>
                </div>
                <!--banners-->
            </div>
        </div>
    </div>
<?php
}
include 'footer.php';
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:106%">
            <form method="post">
                <div class="modal-header" style="background:#337ab7;color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Style Detail
                    </p>
                </div>

                <div class="modal-body">

                    <table id="table1">

                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary" name="updateData">
                        Submit changes
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header" style="background:#337ab7;color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Measurement Detail
                    </p>
                </div>

                <div class="modal-body">

                    <table id="table2">

                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary" name="updateMesurement">
                        Submit changes
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->



<script>

    function find_tag_id(obj) {
        var ids = obj.id;
        //console.log(ids);
        window.location.replace("preferences.php?tagid=" + ids);
    }
</script>
<script>
    $(function () {
        $(".d_none").click(function () {
            $(".redButton").removeAttr("disabled");
        });
        //$("#myModal").draggable();

    });


</script>

<script>

    function find_style(obj) {
        var ids = obj.id;
        var tag = '<?php echo $_REQUEST['tagid'] ?>';
        var user_id = '<?php echo $_SESSION['user_id'] ?>';
//      console.log(finalData);
        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'style_id': ids, 'tag_id': tag, 'user_id': user_id},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                console.log(data);
                var htmls = '';
                $.each(data, function (key, value) {
                    $.each(value, function (key, value) {
                        // console.log(key);
                        var keyData = key;
                        var keyData = key.split("_").join(" ");
                        console.log(keyData);
                        htmls += '<tr>';
                        htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                        htmls += "<td><input type='text' name='" + key + "' value='" + value + "' style='height: 31px;width:130%'></td>";
                        htmls += '</tr>';
                    });
                });

                $("#table1").html(htmls);
                $($('#table1 tr')[0]).hide();
                $($('#table1 tr')[1]).hide();
                $($('#table1 tr')[2]).hide();

            }


        });
    }
    ;
</script>
<script>

    function find_measurement(obj) {
        var ids = obj.id;
        var tag = '<?php echo $_REQUEST['tagid'] ?>';
        var user_id = '<?php echo $_SESSION['user_id'] ?>';
//      console.log(finalData);
        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'measurement_id': ids, 'tag_id': tag, 'user_id': user_id},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                console.log(data);
                var htmls = '';
                $.each(data, function (key, value) {
                    $.each(value, function (key, value) {
                        // console.log(key);
                        var keyData = key;
                        var keyData = key.split("_").join(" ");
                        console.log(keyData);
                        htmls += '<tr>';
                        htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                        htmls += "<td><input type='text' name='" + key + "' value='" + value + "' style='height: 31px;width:130%'></td>";
                        htmls += '</tr>';
                    });
                });

                $("#table2").html(htmls);
                $($('#table2 tr')[0]).hide();
//                $($('#table2 tr')[1]).hide();
//                $($('#table2 tr')[2]).hide();

            }


        });
    }
    ;
</script>

<!--<script>
    $(function(){
        var default_style = '<?php // echo $res[0]['style_id'] ?>';
var style_id = '<?php // echo $data['id'] ?>';
        console.log(default_style,style_id);
        if(Number(default_style) == Number(style_id)){
           $('input:radio[name=default_style]').checked = true;
        }
    })
</script>-->
