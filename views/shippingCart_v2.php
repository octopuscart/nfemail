<?php
include 'header.php';
include '../producthandler/productHandler.php';
$cartprd = new CartHandler();
$orderObj = new UserAddressDetail();

//echo $_SESSION['price'];
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {

    $cartProductsInfo = $cartprd->findCustomizationId($_SESSION['user_id']);

    if (isset($_POST['submit'])) {
        $cartprd->updateCartQuantity();
    }
//#### billing & shipping address ##
    $userInfo = $authobj->userProfile($_SESSION['user_id']);
    $addressData = $authobj->findAddress($_SESSION['user_id']);

    if (isset($_POST['submitData'])) {
        $authobj->ChangeBillShip($_POST['bill_radio'], $_POST['ship_radio']);
    }
    if (isset($_POST['submitPop'])) {
        $test = array();
        foreach ($_POST as $key => $value) {
            $v1 = str_replace(':', ' ', $value);
            $v2 = str_replace(',', ' ', $v1);
            $test[$key] = $v1;
            $test[$key] = $v2;
        }
        $authobj->userBillingShippingAdd($_SESSION['user_id'], $test);
        header("location: ./shippingCart.php?address=' ok '");
    }
    if (isset($_REQUEST['card_submit'])) {
        // print_r($_POST);
        $authobj->cardInfoInsertion($_SESSION['user_id'], $_POST);
        header("location: ./shippingCart.php");
    }
//$user_coupon = $authobj->userCouponDetail($_SESSION['user_id']);
    $wallet_amount1 = $authobj->wallet_amount($_SESSION['user_id']);
    if (isset($_REQUEST['wallet'])) {

        $_SESSION['wallet_amount'] = $_POST['wallet_amount'];
        //print_r($_SESSION);
    }
### user coupon detail
    $user_coupon = $authobj->userCouponDetail($_SESSION['user_id']);
    // print_r($user_coupon);
#### end #############
    if (isset($_POST['deleteCart'])) {
        $cartprd->deleteFromCart($_POST['deleteCart']);
    };
    $cartTags = $cartprd->userTag(1);
### card detail
    $card_detatil = $authobj->card_detail($_SESSION['user_id']);

    $countproduct = $cartprd->cartProductsCount($_SESSION['user_id'], 'and customization_id != ""');

#11-sep-2015
//$_SESSION['cp'] = array();

    if (isset($_POST['coupon'])) {
        //print_r($_POST);
        $_SESSION['cp'] = $authobj->discountManage($_REQUEST['discount_copon'], $_SESSION['user_id'], $_REQUEST['total_price']);
    }
    $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);
#16dec2015
//print_r($_SESSION);
    if (isset($_POST['cancel_coupon_code'])) {
        $_SESSION['cp'] = '';
        header('location: shippingCart.php');
    }
    if (isset($_POST['deleteWallet'])) {
        $_SESSION['wallet_amount'] = '';
        header('location: shippingCart.php');
    }


    $use_wallet = 0;
    if (isset($_SESSION['wallet_amount'])) {
        $use_wallet = $_SESSION['wallet_amount'];
        //print_r($amount[0]['result']);
    } else {
        $use_wallet = 0;
    }
    $shiping_deduct = resultAssociate("SELECT * FROM `nfw_shipping`");
#update14-dec-2015

    if (isset($_POST['shipping_id'])) {
        print_r($_POST);
        $_POST['billing_id'] = '0';
        $_POST['shipping_amount'] = $_SESSION['shipping_amount'];
        $ship_amt = $_POST['shipping_amount'];
        $_POST['totalQuantity'] = $_SESSION['totalQuantity'];
        $qun = $_POST['totalQuantity'];
        //$pri = $_POST['totalPrice'];
        $_POST['allCartId'] = $_SESSION['allCartId'];

        $arr = $_POST['allCartId'];
        $_POST['subtotal'] = $_SESSION['subtotal'];

        $subtotal = $_POST['subtotal'];
        $card_id = $_POST['card_id'];
        $_POST['coupon_id'] = $_SESSION['coupon_id'];
        $coupon_id = $_POST['coupon_id'];
        $cartIdss = explode(",", $arr);
        $user_id = $_SESSION['user_id'];
        $_POST['user_id'] = $user_id;
        $billId = $_POST['billing_id'];

        $shipId = $_POST['shipping_id'];
        $_POST['wallet_amount'] = $use_wallet;
        $wallet = $_POST['wallet_amount'];
        $_POST['sku'] = $_SESSION['sku'];
        $sku = $_POST['sku'];
        $skus = explode(",", $sku);
        $_POST['images'] = $_SESSION['images'];
        $images = $_POST['images'];
        $imagess = explode(",", $images);
        $_POST['price'] = $_SESSION['price'];
        $price = $_POST['price'];
        $prices = explode(",", $price);
        $_POST['tag_titles'] = $_SESSION['tag_titles'];
        $tag_titles = $_POST['tag_titles'];
        $tag_titles = explode(",", $tag_titles);
        $urlrequest = urlencode(serialize($_POST));
        $urldata = array();
        foreach ($_POST as $key => $value) {
            $url = $key . "=" . trim($value);
            array_push($urldata, $url);
        }
        $urlpost = implode("&", $urldata);

        if ($card_id == 'paypal') {
            header('location: paypal_process.php?payment_type=user_order&' . $urlpost);
        } else {
          // print_r($_POST);
            $order_id = $cartprd->insertInOrderTable($qun, $cartIdss, $user_id, $billId, $shipId, $coupon_id, $card_id, $skus, $imagess, $prices, $tag_titles, $wallet, $ship_amt,$subtotal);
            $authobj->orderConfirmMail($order_id, $_SESSION['user_id']);
            unset($_SESSION['cp']);
            unset($_SESSION['wallet_amount']);
            header('location: orderDetail.php?order_id=' . $order_id);
        }
    }
    ?>
    <style>

    </style>
    <style>
        .spna{
            width: 128px;
            float: left;
        }
        .close{
            opacity: 1;
        }
        .modal-header{
            padding: 3px 19px;
            background: black;
        }
        .tds{
            padding: 8px;
            line-height: 0.42857143 !important;
            vertical-align: top;
            // border-bottom: 1px solid;
        }
        .bg_color_purple, .paginations .active a, .paginations li a:hover, .step:hover .step_counter, .title_counter_type:before, .bg_color_purple_hover:hover, .animation_fill.color_purple:before, .p_table.bg_color_purple_hover.active, [class*="button_type_"].transparent.color_purple:hover, [class*="button_type_"].color_purple:not(.transparent) {
            background: black;
        }

        .tabs_nav a, .border_grey, .accordion_item, .ui-slider {
            border: none;
        }

        #billingShipping input[type="checkbox"] + label::after {

            font-family: "fontello";
            position: absolute;
            left: 7px;
            top: 7px !important;
            display: none;
            color: #FFF;
        }

    </style>
    <style>
        table td,
        table th{
            padding:9px 18px 10px;
            border:0px solid #bdc3c7; 
        }
    </style>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
        <div class="container">

            <h5 style="    font-weight: 300;    margin-bottom: 10px;
                font-size: 46px;">
                <span class="icon-stack">

                    <i class="icon-basket icon-light"></i>
                </span> Checkout Now</h5>

            <small style="font-size: 15px"> </small>

        </div>


    </section>
    <center>  <h5 id="error" style="display:none;color:red"></h5></center>
    <!--content-->
    <div> 

        <div class="cartItems" style="display: none;border: 2px solid #cccccc;">

            <div class="cartCustomizeStyle">
                <label class="cartTitle">AM480</label>

                <p class="cartsku"></p>
                <img src="" class="cartImage" style="height:70px;width: 70px">
            </div>

        </div>
        <input type="hidden" name="product_id">
        <div class="col-md-1" id="containerBox" style="width: 133px;
             position: fixed;
             background: #FFF;
             z-index: 200000000;
             box-shadow: 0px 0px 28px -1px #000;
             top: 13%;
             max-height: 400px;
             overflow-y: auto;

             display: none;">
            <div id="productImagesTemplate" class="">

            </div>
            <input type="button" value="Customiz Now" class="btn btn-primary btn-sm" id="customization" data-toggle="modal" data-target="#myModal" style="display: none;margin-top: 10px;
                   margin-bottom: 8px;font-size: 11px;">
            <div style="clear:both"></div>
        </div>

    </div>

    <div class="container">
        <div class="im_half_container m_bottom_10">
            <div class="half_column d_inline_m w_xs_full m_xs_bottom_10">

            </div>
            <div class="half_column d_inline_m w_xs_full t_xs_align_l t_align_r m_xs_bottom_5">

            </div>
        </div>
        <!-- Tab -->


        <div role="tabpanel" id="myTabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" style="font-size: 20px">

                <li role="presentation" class="active">
                    <a href="#orderReview" aria-controls="orderReview" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-search"></i></span>Order Review
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#billingShipping" aria-controls="billingShipping" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-map"></i></span>Shipping Address
                    </a>
                </li>
                <li role="presentation">
                    <a href="#paymentMode" aria-controls="paymentMode" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-dollar"></i></span>Payment Method
                    </a>
                </li>
                <li role="presentation">
                    <a href="#confirmOrder" aria-controls="confirmOrder" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-thumbs-up-1"></i></span>Confirm Order
                    </a>
                </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- content -->

                <!-- ##### 1 ######## --> 
                <div role="tabpanel" class="tab-pane active" id="orderReview" style="margin-top:0px">
                    <?php
                    //print_r($customizedData);
                    if ($customizedData) {
                        ?>
                        <div>
                            <table class="table">

                                <tr>
                                    <th style="width: 25%;"><span style="margin: 0px 0px 0px 13px;">Product Information</span></th>
                                    <th style="width: 7%;">SKU</th>
                                    <th style="width: 7%;">Tag</th>
                                    <th style="width: 12%;">Qty.</th>
                                    <th style="width: 9%;">Price</th>
                                    <th style="width: 12%;">Extra Price</th>
                                    <th style="width: 9%;">Total</th>
                                    <th style="width: 9%;"></th>

                                </tr>


                                <?php
                                //  $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);

                                for ($i = 0; $i < count($customizedData); $i++) {

                                    $cartid = $customizedData[$i]['id'];
                                    $pro = new ProductHandler($cartid);
                                    $title = $pro->productTitle();
                                    $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);
                                    $res = $cartprd->productCatTagId($cartInfo['cart_product_id']);
                                    $cartIdArray[] = $cartInfo['cart_product_id'];
                                    // $_SESSION['allCartId'] =  implode(",", $cartIdArray);
                                    //print_r($_SESSION['allCartId']);
                                    $img_arry[] = $cartInfo['image'];
                                    $item_sku[] = $cartInfo['sku'];
                                    $item_price[] = ($cartInfo['price']);
                                    $item_title[] = $res[0]['tag_title'];
                                    ?>
                                    <tr class="">

                                        <td>
                                            <div class="col-md-4" style="">
                                                <a href="#" class="r_corners d_inline_b wrapper">
                                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height:74px;width:74px;">
                                                </a>
                                            </div>
                                            <div class="col-md-8" style="padding: 0px">
                                                <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></p>
                                                <?php
                                                $lens = strlen($cartInfo['product_speciality']);
                                                if ($lens > 20) {
                                                    ?>
                                                    <p class="" style="margin-top: -8px;font-size: 13px" data-toggle="tooltip" data-placement="left" title="<?php echo $cartInfo['product_speciality']; ?>">
                                                        <?php echo substr($cartInfo['product_speciality'], 0, 20) . ' ...'; ?>
                                                    </p>
                                                <?php } else { ?>
                                                    <p class="" style="margin-top: -8px;font-size: 13px" data-toggle="tooltip" data-placement="left" title="<?php echo $cartInfo['product_speciality']; ?>">
                                                        <?php echo $cartInfo['product_speciality']; ?>
                                                    </p>
                                                <?php } ?>
                                                <?php
                                                //$customization_id = $cartprd->customizationIdFind($cartid);
                                                //$temp = $customization_id[0]['customization_id'];
                                                //$final_data = $authobj->styleIdWithCustomizationID($temp);
                                                ?>
                                                <span data-toggle="" data-placement="left" title="View Summary"><a href="#" style="padding: 0px;height: 22px;width: 28px;margin-left:1px" class="btn btn-default btn-xm" data-toggle="modal" data-target="#myModal_<?php echo $cartInfo['cart_product_id'] ?>_<?php echo $i ?>"><i class="icon-eye"></i></a></span>

                                                <span data-toggle="" data-placement="left" title="Save PDF"><a href="./customize_profile_summary_pdf.php?cart_id=<?php echo $cartInfo['cart_product_id']; ?>&tag_name=<?php echo $res[0]['tag_title']; ?>"  style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>
                                                <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./customizationMailSends.php?cart_id=<?php echo $cartInfo['cart_product_id']; ?>&tag_name=<?php echo $res[0]['tag_title']; ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                                                <!-- Summary -->
                                                <div class="modal fade" id="myModal_<?php echo $cartInfo['cart_product_id'] ?>_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <div class="modal-header" style="color: white">
                                                                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                        &times;
                                                                    </button>
                                                                    <p class="modal-title" id="myModalLabel">
                                                                        <?php echo $res[0]['tag_title'] . '  ' . 'Style Id -' . $cartInfo['customization_id'] ?>
                                                                    </p>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <table class="table" id="table3" style="border:1px solid #B8B8B8">
                                                                        <?php
                                                                        $data = $cartInfo['customization_data'];
                                                                        $final1 = phpjsonstyle($data, 'php');
                                                                        foreach ($final1 as $key => $value) {
                                                                            ?>

                                                                            <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px;border-bottom: 1px solid #B8B8B8;">
                                                                                <td class="tds"><?php echo $key ?></td>
                                                                                <td class="tds" style="line-height: 13px !important;max-width: 230px;overflow-y: scroll;"><?php echo $value ?></td>
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
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!-- End -->
                                            </div>
                                        </td>
                                        <td data-title="SKU" class="fw_light"><?php echo $cartInfo['sku']; ?></td>
                                        <td>

                                            <p><?php echo $res[0]['tag_title']; ?></p>
                                        </td>
                                    <form method="post">
                                        <td data-title="Quantity" style="width: 90px">
                                            <div class="wrapper fs_medium r_corners d_inline_b quantity clearfix" style="border-bottom-left-radius: 0px;
                                                 border-bottom-right-radius: 0px;">
                                                <button  type="button" class="f_left bg_light_3" data-count="minus">
                                                    <i class="icon-minus "></i>
                                                </button>
                                                <input type="text" name="quantity1" value="<?php echo $cartInfo['quantity']; ?>" class="f_left color_grey bg_light">
                                                <button type="button" class="f_left bg_light_3" data-count="plus">
                                                    <i class="icon-plus"></i>
                                                </button>
                                            </div>
                                            <br/>

                                            <input type="hidden"   value="<?php echo $cartInfo['cart_product_id']; ?>" name="cart_product_id">

                                            <input type="submit" style="    width: 100px;
                                                   border-top-left-radius: 0px;
                                                   border-top-right-radius: 0px;" name="submit" class="btn btn-default btn-xs" value="Edit">

                                        </td>

                                        <td data-title="Price" ><?php echo '$' . number_format($cartInfo['price'], 2, '.', '') ?></td>
                                        <td data-title="Extra Price">
                                            <?php
                                            if ($cartInfo['extra_price'] > 0) {
                                                echo '$' . $cartInfo['extra_price'] . '.00';
                                            } else {
                                                echo '$00.00';
                                            }
                                            ?>

                                        </td>
                                        <td data-title="Total" class="fw_ex_bold color_dark" style=''>
                                            <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                        </td>

                                        <td data-title="Action" class="fw_ex_bold color_dark"  style="width:20px">
                                            <button class="color_grey_light_2 color_dark_hover tr_all" name="deleteCart" value="<?php echo $cartInfo['cart_product_id']; ?> ">
                                                <i class="icon-cancel-circled-1 fs_medium"></i>
                                            </button>

                                        </td>
                                    </form>
                                    </tr>

                                    <?php
                                    $total_price1 = $total_price1 + $cartInfo['cart_price'];
                                    $quntit = $quntit + $cartInfo['quantity'];
                                }
                                ?> 

                                <input type="hidden" id="no_of_product" value="<?php echo $quntit; ?>">

                                <tr class="bg_light_2">
                                    <td colspan="5" rowspan="6">
                                        <div class="test1" style="padding: 34px;">
                                            <!-- ################# -->
                                            <div class="d_table w_full" style="margin-bottom: 5px;">
                                                <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                                    <?php
                                                    if ($user_coupon[0]['coupon_code']) {
                                                        if ($_SESSION['cp']) {
                                                            
                                                        } else {
                                                            ?>  

                                                            <span class="test fw_light d_inline_m m_right_5 d_xs_block" >Use Coupon for shopping : &nbsp;&nbsp;</span><span id="copy_coupon"   class="fw_light d_inline_m m_right_5 d_xs_block" style="margin-top: 2px;"><b><?php echo $user_coupon[0]['coupon_code'] ?></b></span>&nbsp;&nbsp;<button id="coupon_copy" class="btn btn-default btn-sm" style="margin-top: 5px;"><i class="fa fa-hand-o-up"></i> Use Now</button>

                                                            <?php
                                                        }
                                                    } else {
                                                        
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <!-- ################# -->

                                            <div class="d_table w_full" style="">
                                                <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
            <!--                                            <p class="fw_light d_inline_m m_right_5 d_xs_block"></p>-->
                                                    <form method="post">
                                                        <input type="hidden" name="total_price" value="<?php echo $ttt ?>">
                                                        <span>Coupon Code</span><span style="text-align:right">:</span>
                                                        <input type="text" placeholder="Enter your coupon code here" class="color_grey r_corners bg_light fw_light coupon m_xs_bottom_15" name="discount_copon" style="width:40%;height:27px;color: black" autocomplete="off">
                                                        <button name="coupon" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset" id="discount" value="" type="submit">
                                                            Submit
                                                        </button>
                                                        <?php
                                                        if (isset($_POST['coupon'])) {
                                                            //echo "dssf";
                                                            $cp = $_SESSION['cp'];

                                                            if ($cp) {
                                                                //  print_r($cp);
                                                                ?>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <p style="font-size:12px;color:red;">**Used/Invalid Coupon Code</p>
                                                                <?php
                                                            }
                                                        }
                                                        if ($_SESSION['cp']) {
                                                            $cp = $_SESSION['cp'];
                                                            ?>
                                                            <p id="deletCP">Applied Coupon: <input type="text" name="valid_copon" value="<?php echo $cp['coupon_code']; ?>" style="height:24px;border: none">
                                                                <button class="color_grey_light_2 color_dark_hover tr_all" data-toggle="" data-placement="left" title="Delete coupon" name="cancel_coupon_code" id="deletecopondata" class="btn btn-primary" value="fd">
                                                                    <i class="icon-cancel-circled-1 fs_medium"></i>
                                                                </button>
                                                            </p> 
                                                            <?php
                                                        }
                                                        ?>


                                                    </form>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 7px;height: 0px;margin-bottom: 8px;">
                                            <!-- ################# -->
                                            <div class="d_table w_full">
                                                <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                                    <form method="post">
                                                        <span>Available Wallet Amount</span><span style="text-align:right">: <?php
                                                            $wt = $wallet_amount1[0]['result'];
                                                            if ($wt) {
                                                                $wt = $wt - $use_wallet;
                                                                echo '$' . number_format($wt, 2, '.', '');
                                                            } else {
                                                                echo "$00.00";
                                                            }
                                                            ?>
                                                        </span>


                                                        <input type="text" class="r_corners bg_light fw_light coupon m_xs_bottom_15 is_number" placeholder="Enter amount" name="wallet_amount" style="height:27px;width:20%;" value="" onkeyup="checkNet(this)" autocomplete="off">
                                                        <button name="wallet" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset" id="" value="gfg" type="submit">
                                                            Submit
                                                        </button>

                                                    </form>


                                                </div>
                                            </div>

                                            <!-- ################# -->


                                        </div>

                                    </td>

                                    <td><span class="spna">Sub Total</span>:</td>
                                    <td>
                                        <p style="" id="sub_total">
                                            <?php
                                            $ttt = number_format($total_price1, 2, '.', '');
                                            echo '$' . $ttt;
                                            ?>
                                        </p>
                                    </td>
                                </tr>
<!--                                <tr class="bg_light_2">

                                    <td><span class="spna">Tax/Custom</span>:</td>
                                    <td><p style="">$00.00</p></td>
                                </tr>-->
                                <tr class="bg_light_2">

                                    <td><span class="spna">Coupon Discount</span>:</td>
                                    <td> <?php
                                        //   print_r($_SESSION['cp']);
                                        if ($_SESSION['cp']) {
                                            $cp = $_SESSION['cp'];

                                            if ($cp) {
                                                ?>
                                                <p id="discount_coupon" style=""><?php echo '$' . number_format($cp['value_code'], 2, '.', ''); ?></p>  
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <p id="discount_coupon" style="">$00.00</p>  

                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="bg_light_2">

                                    <td><span class="spna">Shipping Price</span>:</td>
                                    <td> <p style="" id="shipping_amount">
                                            <?php
                                            if ($total_price1 >= $shiping_deduct[0]['min_amount']) {
                                                $_SESSION['shipping_amount'] = '$00.00';
                                            } else {

                                                $ship_t = '$' . number_format($shiping_deduct[0]['shipping_amount'], 2, '.', 0);
                                                $_SESSION['shipping_amount'] = $ship_t;
                                            }
                                            echo $_SESSION['shipping_amount'];
                                            ?>   

                                        </p></td>
                                </tr>
                                <tr class="bg_light_2">

                                    <td><span class="spna">My Wallet</span>:</td>
                                    <td>
                                        <p style="" id="wallet_amount1">
                                            <?php
                                            if ($use_wallet) {
                                                echo '$' . number_format($use_wallet, 2, '.', '');
                                            } else {
                                                echo '$00.00';
                                            }
                                            ?>

                                        </p>
                                        <form method="post">
                                            <?php if ($use_wallet) { ?>
                                                <button class="color_grey_light_2 color_dark_hover tr_all" name="deleteWallet" value=" " style="margin: -23px 0px 0px 119px;float: left;">
                                                    <i class="icon-cancel-circled-1 fs_medium"></i>
                                                </button>
                                            <?php } ?> 
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg_light_2">

                                    <td><span class="spna" style="color:black;font-size: 16px"><b>Grand Total</b></span>:</td>
                                    <td><span style="" id="tPrice" style="color:black;font-size: 16px"><b></b></span></td>
                                </tr>

                            </table>
                        </div>
                        <?php
                    } else {
                        echo "<a href='index.php'>Continue Shopping</a>";
                    }
                    ?>
                </div>
                <!-- ##### 2 ######## --> 
                <div role="tabpanel" class="tab-pane" id="billingShipping">
                    <?php
                    $shipdata = $authobj->getDefaultAddress('default_shipping_address', $_SESSION['user_id']);
                    $billdata = $authobj->getDefaultAddress('default_billing_address', $_SESSION['user_id']);

                    if (!empty($shipdata) || !empty($billdata)) {
                        ?>
                        <!-- billing shipping tab -->
                        <div class="col-md-12" style='margin-top: 9px;'>
                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Shipping Addresses</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($shipdata) { ?>
                                            <address>

                                                <strong style="text-transform: capitalize;">
                                                    <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                                </strong><br>
                                                <?php echo $shipdata[0]['add1']; ?><br>
                                                <?php echo $shipdata[0]['add2']; ?><br>
                                                <?php echo $shipdata[0]['add3']; ?><br>
                                                <?php echo $shipdata[0]['add4']; ?><br>

                                            </address>
                                        <?php } else { ?>
                                            <span style="color:red">
                                                SHIPPING  ADDRESS NOT FOUND! PLEASE ADD YOUR  SHIPPING  ADDRESS
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

<!--                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Billing Addresses</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($billdata) { ?>  
                                            <address>
                                                <strong style="text-transform: capitalize;">
                                                    <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                                </strong><br>
                                                <?php echo $billdata[0]['add1']; ?><br>
                                                <?php echo $billdata[0]['add2']; ?><br>
                                                <?php echo $billdata[0]['add3']; ?><br> 
                                                <?php echo $billdata[0]['add4']; ?><br>

                                                    <abbr title="Phone">Contact No.:</abbr> (+523)   <?php echo $billdata[0]['contact_no']; ?> 
                                            </address>
                                        <?php } else { ?>
                                            <span style="color:red">
                                                BILLING  ADDRESS NOT FOUND! PLEASE ADD YOUR  BILLING  ADDRESS
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>-->
                        </div>
                    <?php } ?>
                    <div style="clear:both"></div>
                    <?php if ($addressData) { ?> 
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Choose Address For Shipping 
                                            <button class="btn btn-default btn-xs pull-right" style="margin-top:-4px" data-toggle="modal" data-target="#myModal" id="newAddress"> <i class="icon-plus"></i> Add New Address</button>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-condensed">

                                            <thead>
                                                <tr>
                                                    <th>All Addresses</th>
                                                    <th>Choose Shipping Address</th>
                                                    <!--<th>Billing Address</th>-->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($addressData); $i++) {
                                                    $info = $addressData[$i];
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $info['addr']; ?></td>
                                                        <td style="    line-height: 0px;">
                                                            <input type="radio" id="radio_2_<?php echo $i; ?>" name="ship_radio" class="d_none test" <?php if ($info['id'] == $shipdata[0]['id']) { ?> checked <?php } ?>  value="<?php echo $info['id']; ?>">
                                                            <label for="radio_2_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                        </td>
<!--                                                        <td style="    line-height: 0px;">
                                                            <input type="radio" id="radio_1_<?php echo $i; ?>" name="bill_radio" class="d_none test" <?php if ($info['id'] == $billdata[0]['id']) { ?> checked <?php } ?> value="<?php echo $info['id']; ?>">
                                                            <label for="radio_1_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                        </td>-->


                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <button id="submitData" class="btn btn-default btn-xs" value="" style="display: none;margin: 0px 0px 20px 9px;" disabled>
                                            <i class="icon-check"></i>
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- billing shipping tab -->
                    <?php } else { ?>

                        <p style="text-align: center;color:red;margin-top: 24px;font-size:18px;font-weight:400">SHIPPING ADDRESS NOT FOUND! PLEASE ADD YOUR  SHIPPING ADDRESS</p>
                        <center>
                            <div style="padding:20px">
                                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" id="newAddress"> <i class="icon-plus"></i> Add New Address</button>
                            </div>
                        </center>



                        <!-- Address -->

                    <?php }
                    ?> 




                    <form class="" method="post">
                </div>

                <!-- ##### 3 ######## --> 

                <div role="tabpanel" class="tab-pane" id="paymentMode">
                    <div class="" style="margin-top: 10px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_40 m_xs_bottom_30">
                            <p class="" style="font-size: 28px;font-weight: 300;
                               background-color: #000;
                               padding: 10px;
                               color: #fff;
                               margin-bottom: 20px;
                               "><i class="icon-truck"></i> Shipping Method</p>

                            <ul>
                                <li class="m_bottom_15" style="padding: 0px 25px;    padding: 0px 25px;
                                    font-size: 20px;
                                    color: #000;
                                    font-weight: 300;">
                                    <b>Free Shipping</b> - if your shopping is at least US$<b><?php echo $shiping_deduct[0]['min_amount'];?></b>, <br/>else US$<b><?php echo $shiping_deduct[0]['shipping_amount'];?></b> will be charged. 
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_40 m_xs_bottom_30">
                            <p class="" style="   font-size: 28px;
                               font-weight: 300;
                               background-color: #000;
                               padding: 10px;
                               color: #fff;
                               margin-bottom: 20px;
                               "><i class="icon-dollar"></i> Payment Methods</p>

<!--                            <h5 class="fw_light color_dark m_bottom_23"><i class="icon-money"></i> Post Pay</h5>
                            <ul> 
                                <li class="m_bottom_15">
                                    <input type="radio" checked="" id="radio_131" name="card_id" class="d_none" value="post_pay">
                                    <label for="radio_131" class="d_inline_m m_right_15 m_bottom_3 fw_light">
                                        Post Pay To Nita Fashions Admin                                    
                                    </label>
                                </li>
                            </ul>
                            <hr style="height: 0px;margin-top: 0px;">-->
                            <?php if ($card_detatil) { ?>
                                <h5 class="fw_light color_dark m_bottom_23">Choose Your Card </h5>
                                <ul>
                                    <?php
                                    for ($k = 0; $k < count($card_detatil); $k++) {
                                        $info1 = $card_detatil[$k];
                                        ?>
                                        <li class="m_bottom_15">
                                            <input type="radio" checked id="radio_6_<?php echo $k; ?>" name="card_id" class="d_none" value="<?php echo $info1['id'] ?>">
                                            <label for="radio_6_<?php echo $k; ?>" class="d_inline_m m_right_15 m_bottom_3 fw_light">
                                                <?php
                                                $dd = substr($info1['card_number'], -4);

                                                echo '************' . $dd . ' <b>Exp. month</b>' . ' ' . $info1['expiry_month'] . ' <b>Exp. year</b> ' . '  ' . $info1['expiry_year']
                                                ?>
                                            </label>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <span style="color:red;margin-top: 17px;">CREDIT CARD DETAILS  NOT FOUND!  KINDLY ADD CREDIT CARD DETAILS <i class="icon-right-1"></i></span>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myCardModal" id=""><i class="icon-plus"></i> Add Card Detail</button>
                                <?php }
                                ?>
                            </ul>
                            <hr style="height: 0px;margin-top: 0px;">
                            <h5 class="fw_light color_dark m_bottom_23"><i class="icon-paypal"></i>  PayPal </h5>
                            <ul>
                                <li class="m_bottom_15">
                                    <input type="radio" checked="" id="radio_12" name="card_id" class="d_none" value="paypal">
                                    <label for="radio_12" class="d_inline_m m_right_15 m_bottom_3 fw_light">
                                        Pay Using PayPal                                          
                                    </label>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- ##### 4 ######## --> 
                <div role="tabpanel" class="tab-pane" id="confirmOrder">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <p class="" style="   font-size: 28px;
                           font-weight: 300;
                           background-color: #000;
                           padding: 10px;
                           color: #fff;
                           margin-bottom: 20px;
                           "><i class="icon-check"></i> Your Order</p>



                        <?php
                        $_SESSION['allCartId'] = implode(",", $cartIdArray);
                        $_SESSION['totalQuantity'] = $countproduct[0]['quantity'];
                        $_SESSION['coupon_id'] = $cp['coupon_id'];
                        $_SESSION['sku'] = implode(",", $item_sku);
                        $_SESSION['images'] = implode(",", $img_arry);
                        $_SESSION['price'] = implode(",", $item_price);
                        $_SESSION['tag_titles'] = implode(",", $item_title);
                        $_SESSION['subtotal'] = $total_price1;
                        ?>
                        <?php
                        $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);
                        if ($customizedData) {
                            if ($shipdata) {
                                if ($card_detatil) {
                                    ?>
                                    <div class="r_corners wrapper border_grey wrap_xs d_inline_b d_mxs_block m_bottom_15">
                                        <table class="table_type_3 table table-bordered" >
                                            <tbody>
                                                <tr class="bg_light_2">
                                                    <td class="fw_light t_align_r"><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total Products</p></td>
                                                    <td><p class="fw_ex_bold  m_top_10 m_bottom_10" id="nproduct">$00.00</p></td>
                                                </tr>

                                                <tr class="bg_light_2">
                                                    <td class="fw_light t_align_r"><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total Price</p></td>
                                                    <td><p class="fw_ex_bold  m_top_10 m_bottom_10" id="final_price">$00.00</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="m_bottom_23 check">
                                        <input type="checkbox" id="checkbox_71" name="" class="d_none">
                                        <label for="checkbox_71" class="d_inline_m fw_light">I agree to the terms of service </label>
                                        <p class="d_inline_m fw_light">(<a href="termAndCondition.php" target="_blank" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>

                                        <input type="hidden" name='billing_id' value="<?php echo $billdata[0]['id']; ?>" >
                                        <input type="hidden" name='shipping_id' value="<?php echo $shipdata[0]['id']; ?>" >
                                        <br>
                                        <br>

                                        <button type="submit" name="orderConfirm" id="btn1" class="d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset" value="dfjdg" style="margin: 0px 0px 10px;
                                                height: 27px;
                                                width: 147px;
                                                display: none;
                                                border-radius: 15px;" >


                                        </button>


                                    <?php } else { ?>
                                        <div style="text-align:center;margin-bottom: 40px;">
                                            <p style="text-align: center;color:red;margin-top: 24px;font-size:18px;font-weight:400">CREDIT CARD DETAILS  NOT FOUND!  KINDLY ADD CREDIT CARD DETAILS </p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div style="text-align:center;margin-bottom: 40px;">
                                        <p style="text-align: center;color:red;margin-top: 24px;font-size:18px;font-weight:400">PLEASE ACTIVATE SHIPPING ADDRESS</p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            </form>
                        </div>
                    </div>
                    <!-- ######## tab content end ############### -->
                </div>

                <div style="clear: both">
                    <nav style="    border-top: 1px solid #000;
                         padding: 5px 0px;">
                        <ul class="pager" style="  margin: 3px 0;">
                            <li class="previous previousStyle" style="display: none">
                                <a href="javascript:void(0)" style="background: #000;
                                   color: #fff;">
                                    <span aria-hidden="true">&larr;</span> Previous 
                                </a>
                            </li>
                            <li class="next nextStyle">
                                <a href="javascript:void(0)" style="background: #000;
                                   color: #fff;">
                                    Next <span aria-hidden="true">&rarr;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
}
include 'footer.php'
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="width: 79%;margin: 0px 0px 0px 61px;">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-edit"></i> Fill Address Detail
                </p>
            </div>
            <form method ="post">
                <div class="modal-body">

                    <table class="addr">
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Address (Line 1)</b></span>
                            </td>
                            <td>
                                <input type="text" required name="address1" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Address (Line 2)</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="address2" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Town/City</b></span>

                            </td>
                            <td>
                                <input type="text" required required name="city" class="form-control" value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>State</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="state" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>


                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>Zip/Postal</b></span>
                            </td>
                            <td>
                                <input type="text" required  name="zip" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>Country</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="country" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" id="checkboxs_2" name="ship" class="d_none product_checkBox" value="1">
                                <label for="checkboxs_2" class="d_inline_m m_right_10" style="line-height: 18px;">Use as shipping address</label>
                            </td>
                        </tr>
<!--                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" id="checkboxs_1" name="bill" class="d_none product_checkBox" value="1">
                                <label for="checkboxs_1" class="d_inline_m m_right_10" style="line-height: 18px;">Use as billing address</label>
                            </td>
                        </tr>-->


                    </table>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-xs" name="submitPop" value="cc" style="margin: ">
                        <i class="icon-check"></i> Submit 
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myCardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-edit"></i> Fill Card Detail
                </p>
            </div>
            <form class="form-horizontal" role="form" method="post">
                <div class="modal-body" style="margin-right: -36%;">


                    <fieldset>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Name on Card" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control is_number" name="card-number" id="card-number" placeholder="Credit Card Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-3" style="width:135px">
                                        <select class="form-control col-sm-3" name="expiry-month" id="expiry-month">
                                            <option>Month</option>
                                            <option value="01">Jan (01)</option>
                                            <option value="02">Feb (02)</option>
                                            <option value="03">Mar (03)</option>
                                            <option value="04">Apr (04)</option>
                                            <option value="05">May (05)</option>
                                            <option value="06">June (06)</option>
                                            <option value="07">July (07)</option>
                                            <option value="08">Aug (08)</option>
                                            <option value="09">Sep (09)</option>
                                            <option value="10">Oct (10)</option>
                                            <option value="11">Nov (11)</option>
                                            <option value="12">Dec (12)</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3" style="width:135px">
                                        <select class="form-control isNumber" name="expiry-year">
                                            <?php for ($i = 2015; $i < 2040; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Bank Name</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="bank_name" id="address" placeholder="Bank Name"   style="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Address</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address"   style="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">CVV</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control is_number" name="cvv" id="cvv" placeholder="Code"  min="3" max="3" style="width:45%" >
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-default btn-xs" name="card_submit" value="cc" style="">
                        <i class="icon-check"></i> Submit 
                    </button>


                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(function () {
        $("input[name='ship_radio']:radio").click(function () {
            $("#submitData").click();
        });
        $("input[name='bill_radio']:radio").click(function () {
            $("#submitData").click();
        });
    })
</script>
<script>
    $(function () {
        $("#coupon_copy").click(function () {
            var test = $("#copy_coupon").text();
            $("input[name='discount_copon']").val(test);
            //$("#copy_coupon").hide();
            // $("#coupon_copy").hide();
            // $(this).hide();

        });
    });
</script>
<script>

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = e.target
        var targetdiv = $(target).attr("aria-controls");
        if (targetdiv == 'orderReview') {
            $(".previousStyle").hide();
        }
        else {
            $(".previousStyle").show();
        }

        if (targetdiv == 'confirmOrder') {
            $(".nextStyle").hide();
        }
        else {
            $(".nextStyle").show();
        }

    })


    $(function () {
        $("#checkbox_71").click(function () {
            if (this.checked) {
                $("#btn1").show();
            }
            else {
                $("#btn1").hide();
            }
        });
    });
</script>

<script>
    $(function () {
        var sb = $("#sub_total").text().split('$')[1];
        //console.log(sb);
        var dc = $("#discount_coupon").text().split('$')[1];
        // console.log(dc);
        var wl = $("#wallet_amount1").text().split('$')[1];
        var tt = Number(dc) + Number(wl);
        if (tt > sb) {
            $("#error").show();
            $("#error").text("Coupon not applicable becouse coupon amount greater than shopping amount");
            $(".check").hide();
        } else {
            var res = Number(sb) - Number(tt);
            var tot = res.toFixed(2);
        }

        if (tot >= 0) {
            var sp = $("#shipping_amount").text().split('$')[1];
            var total = Number(tot) + Number(sp);
            $("#tPrice").text('$' + total.toFixed(2));
            $("#final_price").text('$' + total.toFixed(2));
        }
        else {
            $("#tPrice").text('$00.00');
            $("#final_price").text('$00.00');
        }


        var ship = $("#shipping_amount").text();
        ship = ship.trim();
        $("input[name='shipping_amount']").val(ship);
        var sp = $("#shipping_amount").text().split('$')[1];
        var total = Number(tot) + Number(sp);
        total = total.toFixed(2);

        $("input[name='totalPrice']").val('$' + total.trim());
        // $("input[name='totalPriceforwallet']").val(tot);
    });
</script>
<script>
    function checkNet(obj) {
        var x = $(obj).val();

        //console.log(x,"gfgh")
        var wt = '<?php echo $wt; ?>';
        var total = $("input[name='totalPrice']").val().split('$')[1];
        // console.log(total);
        // console.log(wt);
        if (Number(x) <= wt && Number(x) <= total) {

        }
        else {
            alert("Amount should be less then grand total and wallet amount");
            $(obj).val("");
            // $(obj).parents('tr').find(".netPriceDollar").val('00');
            checkNet(this)
        }
    }
</script>
<script>

    $('#checkbox_5').click(function () {
        if (this.checked) {
            $('#secend_address').show();
        }
        else {
            $('#secend_address').hide();
        }

    });</script>
<script>

    $(document).ready(function () {
        $("#myTabs > li").click(function () {
            if ($(this).hasClass("disabled"))
                return false;
        });
    });




    $(function () {

        $("button[name='orderConfirm']").click(function () {
            $(this).hide();
            swal({title: "Order Confirmed",
                text: "Redirecting...",
                type: "success",
            });
        })


        $("#anotherAddress").click(function () {
            $("#allAddress").toggle();

        });
        $("#newAddress").click(function () {
            $("#addNewaddress").toggle();

        });
    });</script>
<script>
    $(function () {
        $("#submitData").click(function () {
            var bill = "";
            $("input:radio[name='bill_radio']").each(function () {
                if (this.checked) {
                    bill = this.value;
                    // console.log(bill);
                }
            });
            var ship = "";
            $("input:radio[name='ship_radio']").each(function () {
                if (this.checked) {
                    ship = this.value;
                    // console.log(ship);
                }
            });
            //console.log(bill,ship);
            $.ajax({
                // console.log(bill,ship);
                url: 'ajaxController.php',
                method: 'post',
                data: {'bill_ship': 1, 'bill_id': bill, 'ship_id': ship},
                success: function (data) {

                    window.location = "shippingCart.php?address='ok'";
                }

            });
        });
    });</script>

<script>
    $(function () {
        $("#nproduct").text($("#no_of_product").val());
    });
</script> 
<script>

    function activepaypal(vl) {

        if (vl == 'paypal') {
            $("#btn1").html("");
            $("#btn1").css("background", "url(https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif)")
        }
        else {
            $("#btn1").css("background", "auto");
            $("#btn1").html('<i class="icon-check"></i> Confirm Order')
        }
    }

    $(function () {
        $("#addNew").click(function () {
            $("#addNewaddress").toggle();
        });

        $("input[name='card_id']").click(function () {
            var card = $(this).val();
            activepaypal(card);
        });
        var card = $("input[name='card_id']:checked").val();
        activepaypal(card);
    });
</script>
<script>
    $(function () {

        $(".nextStyle").click(function () {
            var nextTab = $($(".nav-tabs li.active")).next().find("a")
            $(nextTab).tab("show");
        });
        $(".previousStyle").click(function () {
            var nextTab = $($(".nav-tabs li.active")).prev().find("a")
            $(nextTab).tab("show");
        });
<?php
if (isset($_REQUEST['address'])) {
    ?>
            $("a[href='#billingShipping']").tab("show");
<?php } ?>


    });
</script>