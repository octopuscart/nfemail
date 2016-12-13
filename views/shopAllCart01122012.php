<?php
include 'header.php';
include '../producthandler/productHandler.php';
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {
    $userInfo = $authobj->userProfile($_SESSION['user_id']);

    $cartprd = new CartHandler();
    $cartProductsInfo = $cartprd->findCustomizationId($_SESSION['user_id']);
    $cartTags = $cartprd->userTag($_SESSION['user_id']);
    $countproduct = $cartprd->cartProductsCount($_SESSION['user_id'], '');

    if (isset($_POST['Copy'])) {
        $cartprd->CartCopyToWishlist($_POST['Cart_id'], $_SESSION['user_id']);
    }

    if (isset($_POST['deleteCart'])) {
        $cartprd->deleteFromCart($_POST['deleteCart']);
    };

    $custom_form_array = array(
        'shirt' => 'shirtcustom',
        'pant' => 'pantcustom',
        'waistcoat' => 'waistcoatcustom',
        'jacket' => 'jacketcustom',
        'tuxedo_shirt' => 'tuxedoshirtcustom',
        'tuxedo_pant' => 'tuxedopantcustom',
        'tuxedo_suit' => 'tuxedosuitcustom',
        'suit' => 'suitcustom',
        '3_piece_suit' => '3piececustom',
        'tuxedo_jacket' => 'tuxedojacketcustom',
        'overcoat' => 'overcoatcustom',
        'sports_jacket' => 'jacketcustom',
    );
    if (isset($_REQUEST['cart_id'])) {
        $custom_form = $_REQUEST['custom_form'];
        $cart_ids = $_REQUEST["cart_id"];
        $tag_id = $_REQUEST["tag_id"];
        $cart_ids = implode(',', $cart_ids);
        $custom_form_val = $custom_form_array[$custom_form];
        header("location:custom_form.php?custom_form=" . $custom_form_val . "&product_array=" . $cart_ids . "&tag_id=" . $tag_id);
    }
    ?>

    <!--page title-->
    <style>
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
            //border-bottom: 1px solid;


        }
    </style>
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
        .withoutCustom th{
            border: none;

        }
        .withoutCustom td{
            border: none;

        }
        .withCoustom th{
            border: none;
        }
        .withCoustom td{
            border: none;
        }


        .bg_color_purple, .paginations .active a, .paginations li a:hover, .step:hover .step_counter, .title_counter_type:before, .bg_color_purple_hover:hover, .animation_fill.color_purple:before, .p_table.bg_color_purple_hover.active, [class*="button_type_"].transparent.color_purple:hover, [class*="button_type_"].color_purple:not(.transparent) {
            background: #000000;
        }

        .no_item_found h2{
            font-size: 31px;
            font-weight: 300;
            padding: 8%;
            position: static;
        }

        .no_item_found{
            background: url(https://www.trainingjournal.com/sites/www.trainingjournal.com/files/styles/original_-_local_copy/entityshare/3292%3Fitok%3Dm3ygksTZ);
            background-size: cover;
        }
        .no_item_found b{
            color: #B90000;
            font-weight: 400!important;
        }

        .badge {
            display: inline-block;
            min-width: 6px;
            padding: 5px 5px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            color: #FFF;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            background-color: #FD0000;
            border-radius: 15px;
            /* border: 2px solid #484848; */
            float: right;
        }



    </style>

    <!--custom form support css and js-->
    <link href="./custom_form_view/static/custmo_js_css/customform.css" rel="stylesheet">


    <style>
        .fw_light{
            font-size: 15px;
            color: #000;
        }

        .selectall input[type="checkbox"] + label:before {
            content: '';
            font-family: "fontello";
            display: block;
            position: absolute;
            background: #F00;
            top: -6px;
            left: -2px;
            width: 22px;
            height: 23px;
            border: 2px solid #cc0000;
        }

        .lableall:after {
            content: '\e914';
            font-family: "fontello";
            position: absolute;
            left: 11px!important;
            top: -14px!important;
            font-size: 33px;
            display: none;
            color: #fff;
        }
        .title_counter_type:before {
            content: counter(counter);
            font-style: italic;
            color: #fff;
            position: absolute;
            left: 0;
            padding: 7px 0;
            height: 79%;
            width: 38px;
            text-align: center;
            top: 0;
        }

    </style>
    <!-- style for model(view summary) -->


    <!---   Css for image animation  --->
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
             padding-bottom: 0px;
             /* background: url('../assets/images/cartbg2.jpg'); */
             box-shadow: 0px 3px 7px -1px #DBDADA;
             ">
        <div class="container">
            <h5 style="color: #000 !important; font-weight: 300">Select Item</h5>
            <ul class="hr_list d_inline_m breadcrumbs">
                <li class="m_right_8 f_xs_none"><a href="index.html" class="color_default d_inline_m m_right_10">Home</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
                <li class="m_right_8 f_xs_none"><a href="#" class="color_default d_inline_m m_right_10">Shop</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
                <li><a class="color_default d_inline_m">Shopping Cart</a></li>
            </ul>
        </div>
    </section>




    <div class="section_offset counter" style="margin-top: -25px;">
        <div class="container">
            <div class="col-sm-12" style="  padding: 0px 0px 10px 5px;">
                <ul class="nav nav-tabs" role="tablist" style="     font-size: 20px;
                    font-weight: 300; ">
                    <li role="presentation" class="active ">
                        <a class="activeTab" href="#cusmotize_items" aria-controls="cusmotize_items" role="tab" data-toggle="tab">
                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8"> 
                                <i class="icon-tools"></i>
                            </span>
                            Customize Your Cart Items Now</a>
                    </li>
                    <li role="presentation" class=" ">
                        <a class="activeTab" href="#customized_items" aria-controls="customized_items" role="tab" data-toggle="tab">
                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8"> 
                                <i class="icon-eye-1"></i>
                            </span>
                            View Your Customized Items</a>
                    </li>
                </ul>
            </div>
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

                        <?php
                        $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id']);
                        $tag = $cartprd->tags();
                        ?>


                        <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;color:#000">
                            <!-- Nav tabs --> 
                            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="    padding-top: 12px;     border-right: 1px solid #000; ">

                                <?php
                                // print_r($tag);
                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    ?>
                                    <li role="presentation" class="<?php echo $t == 0 ? 'active' : ''; ?>  ">
                                        <a class="" href="#<?php echo $bas_tag_temp; ?>" aria-controls="<?php echo $bas_tag_temp; ?>"  role="tab" data-toggle="tab">
                                            <?php echo $bas_tag; ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>


                        <div class="col-sm-10" style="    padding-right: 0;">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
// print_r($tag);
                                $count = 0;
                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    ?>
                                    <div role="tabpanel" class="custom_form_tables tab-pane <?php echo $t == 0 ? 'active' : ''; ?> " id="<?php echo $bas_tag_temp; ?>">

                                        <div class="custom_container"
                                             style="
                                             font: 400 60px 'Lato';
                                             color: #000;
                                             border: 1px solid;
                                             background-repeat: no-repeat;
                                             background-size: 935px;
                                             padding: 11px;
                                             "
                                             >
                                            <p style="   
                                               font: 200 60px 'Lato';
                                               color: #FFF;

                                               background-color: #000;
                                               padding: 0px 10px;
                                               ">

                                                <?php echo $bas_tag; ?>
                                            </p>
                                            <form>
                                                <table class = "table withoutCustom" style = "background:#fff">
                                                    <thead>
                                                        <tr class = "bg_light_2 color_dark">
                                                            <th style="width:1%">
                                                                <span 
                                                                    style="
                                                                    font-size: 11px;
                                                                    font-weight: 700;
                                                                    margin-top: -8px;
                                                                    float: left;
                                                                    margin-bottom: 5px;
                                                                    ">
                                                                    Select All
                                                                </span>
                                                                <span class="selectall">
                                                                    <input type="checkbox" id="checkboxs_all_<?php echo $bas_tag_id; ?>"   class="d_none check_icon check_icon_all" >
                                                                    <label for="checkboxs_all_<?php echo $bas_tag_id; ?>"  class="d_inline_m m_right_10 lableall"></label>

                                                                </span>

                                                            </th>


                                                            <th style="width:30%">Product Information</th>
                                                            <th style="width:12%">SKU</th>
                                                            <th style="width:12%">Price</th>
                                                            <th style="width:12%">Qty.</th>
                                                            <th style="width:12%">Total</th>
                                                            <!--<th style="width:12%">Action</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        for ($i = 0; $i < count($cartIds); $i++) {

                                                            $cartid = $cartIds[$i]['id'];
                                                            $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);
                                                            // print_r($cartInfo);
                                                            $tg1 = $cartInfo['product_tag'];
                                                            if ($tg1) {

                                                                $tg2 = $tg1;

                                                                if ($bas_tag_id == $tg2) {
                                                                    $count++;
                                                                    ?>
                                                                    <!-- without customized product list -->


                                                                    <tr class="tr_delay">

                                                                        <td data-title="">



                                                                            <input type="checkbox" id="checkboxs_<?php echo $count; ?>" name="cart_id[]" class="d_none product_checkBox" value="<?php echo $cartInfo['cart_product_id']; ?>">
                                                                            <label for="checkboxs_<?php echo $count; ?>" class="d_inline_m m_right_10 product_checkBox"></label>

                                                                        </td>

                                                                        <td>

                                                                            <div style="width: 65px;float: left;">
                                                                                <a href="#" class="r_corners d_inline_b wrapper">
                                                                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height:45px;width:42px;">
                                                                                </a>
                                                                            </div>

                                                                            <div>                                  
                                                                                <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></p>
                                                                                <p class="" style="margin-top: -8px;font-size: 13px">
                                                                                    <?php echo $cartInfo['product_speciality']; ?>
                                                                                </p>
                                                                            </div>

                                                                        </td>
                                                                        <td data-title="SKU" class=""><?php echo $cartInfo['sku']; ?></td>
                                                                        <td data-title="Price" class=""><?php echo '$' . $cartInfo['price'] . '.00' ?></td>

                                                                        <td data-title="Quantity" class="">
                                                                            <?php echo $cartInfo['quantity']; ?>

                                                                        </td>

                                                                        <td data-title="Total" class="">
                                                                            <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                                                        </td>
                    <!--                                                                    <td data-title="Action" class="fw_light">
                                                                            <form name="form<?php echo $cartInfo['product_id']; ?>" method="post">
                                                                            <input type="hidden" name="Cart_id" value="<?php echo $cartInfo['product_id']; ?>"/>    
                                                                            <button name="Move" class="btn btn-danger btn-xs">Move In WishList</button>
                                                                                    </form>
                                                                        </td>-->

                                                                    </tr>
                                                                    <?php
                                                                    $total_price = $total_price + $cartInfo['cart_price'];
                                                                    ?>


                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                                <input type="hidden" name="tag_id" value="<?php echo $bas_tag_id; ?>" >
                                                <input type="hidden" name="custom_form" value="<?php echo $bas_tag_temp; ?>">
                                                <button class="btn btn-danger btn-sm" type="submit" style="background:#000">
                                                    <i class="icon-tools"></i> Customize Now
                                                </button>


                                            </form>
                                            <div class="no_item_found" style="display:none">
                                                <h2 class="" >
                                                    No item added in cart for <b><?php echo $bas_tag; ?></b> customization.
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="customized_items">

                    <!-- With customized product -->

                    <?php
                    $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);
// print_r($customizedData);
                    if ($customizedData) {
                        ?>

                        <div class="col-md-12" style="">
                            <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Customized Products</h4>
                            <div class="">
                                <table class="table withCoustom custom_container">
                                    <thead>
                                        <tr>        

                                            <th style="width: 30%;">Product Information</th>
                                            <th style="width: 12%;">SKU</th>
                                            <th style="width: 12%;">Tag</th>
                                            <th style="width: 12%;">Qty.</th>
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
                                            $res = $cartprd->productCatTagId($cartInfo['cart_product_id']);
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
                                                        <p class="fw_light"><?php echo $cartInfo['product_speciality']; ?></p>
                                                        <?php
                                                        $customization_id = $cartprd->customizationIdFind($cartid);
                                                        $temp = $customization_id[0]['customization_id'];
                                                        //echo $temp;
                                                        $final_data = $authobj->styleIdWithCustomizationID($temp);
                                                        ?>
                                                        <span data-toggle="" data-placement="left" title="View Summary"><a href="#" style="padding: 0px;height: 22px;width: 28px;margin-left:1px" class="btn btn-default btn-xm" data-toggle="modal" data-target="#myModal_<?php echo $temp ?>_<?php echo $i ?>"><i class="icon-eye"></i></a></span>

                                                        <span data-toggle="" data-placement="left" title="Save PDF"><a href="./customize_profile_summary_pdf.php?customized_id=<?php echo $temp; ?>&measurement_id=<?php echo $cartInfo['measurement_id'] ?>&client_code=<?php echo $userInfo[0]['registration_id'] ?>&tag_name=<?php echo $res[0]['tag_title']; ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>
                                                        <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./customizationMailSends.php?customized_id=<?php echo $temp; ?>&measurement_id=<?php echo $cartInfo['measurement_id'] ?>&tag_name=<?php echo $res[0]['tag_title']; ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?php echo $temp ?>_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post">
                                                                        <div class="modal-header" style="color: white">
                                                                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                &times;
                                                                            </button>
                                                                            <p class="modal-title" id="myModalLabel">
                                                                                <?php echo $res[0]['tag_title']; ?> Style Id - <?php echo $final_data[0]['style_profile']; ?>
                                                                            </p>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <table class="table" id="table3" style="border:1px solid #B8B8B8">
                                                                                <?php
                                                                                $data = $final_data[0]['custom_form_data'];
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
                                                <td data-title="SKU"  ><?php echo $cartInfo['sku']; ?></td>
                                                <td>
                                                    <p><?php echo $res[0]['tag_title']; ?></p>
                                                </td>
                                                <td>
                                                    <?php echo $cartInfo['quantity']; ?>

                                                </td>
                                                <td><?php echo '$' . $cartInfo['price'] . '.00'; ?></td>


                                                <td>
                                                    <?php
                                                    if ($cartInfo['extra_price'] > 0) {
                                                        echo '$' . number_format($cartInfo['extra_price'],2,'.','');
                                                        ?><br/>

                                                        <button name="extra_detail" class="btn btn-default btn-xs btn-xs"  value="<?php echo $cartInfo['customization_id'] ?>" data-toggle="modal" data-target="#myModal1_<?php echo $cartInfo['customization_id'] ?>__<?php echo $i; ?> ">
                                                            View Detail
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal1_<?php echo $cartInfo['customization_id'] ?>__<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post">
                                                                        <div class="modal-header" style="color: white">
                                                                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                &times;
                                                                            </button>
                                                                            <p class="modal-title" id="myModalLabel">
                                                                                <?php echo $res[0]['tag_title']; ?> Style Id - <?php echo $final_data[0]['style_profile']; ?>
                                                                            </p>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <table class="table  table-bordered" id="">
                                                                                <?php
                                                                                $data = $final_data[0]['custom_form_data'];
                                                                                $data2 = $final_data[0]['custom_form_data_price'];
                                                                                $final2 = phpjsonstyle($data, 'php');
                                                                                $price_data = phpjsonstyle($data2, 'php');
                                                                                $temp = array();
                                                                                foreach ($price_data as $k => $v) {
                                                                                    if (is_numeric($v)) {
                                                                                        if ($v > 0) {
                                                                                            $temp[$k] = $v;
                                                                                        }
                                                                                    }
                                                                                }
                                                                                foreach ($temp as $key => $value) {
                                                                                    if (array_key_exists($key, $final2)) {
                                                                                        ?>

                                                                                        <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px">
                                                                                            <td class="tds"><?php echo $key; ?></td>
                                                                                            <td class="tds"><?php echo $final2[$key]; ?></td>
                                                                                            <td class="tds"><?php echo '$' . $value; ?></td>
                                                                                        </tr> 
                                                                                        <?php
                                                                                    }
                                                                                }
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

                                                    <?php } else { ?>
                                                        $00.00
                                                    <?php } ?>
                                                </td>

                                                <td>
                                                    <?php echo '$' . number_format($cartInfo['cart_price'],2,'.',''); ?>
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
                                        <td colspan="2" class="fw_ex_bold color_pink v_align_m">
                                            <?php echo '$' .number_format($total_price1,2,'.','')  ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                            <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Your Order</h4>
                            <div class="r_corners wrapper border_grey wrap_xs d_inline_b d_mxs_block m_bottom_15">
                                <table class="t_align_l table_type_3">
                                    <tbody>
                                        <tr class="tr_delay">
                                            <td class="fw_light t_align_r">Total Products:</td>
                                            <td id="nproduct">0</td>
                                        </tr>
                                        <tr class="bg_light_2">
                                            <td class="fw_light t_align_r"><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total Price:</p></td>
                                            <td><p class="fw_ex_bold color_pink m_top_10 m_bottom_10" id="tPrice">
                                                 <?php echo '$' .number_format($total_price1,2,'.','')  ?>
                                                </p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="m_bottom_23">

                                <input type="checkbox" id="checkbox_71" name="" class="d_none">
                                <label for="checkbox_71" class="">I agree to the terms of service </label>
                                <p class="d_inline_m fw_light">(<a href="termAndCondition.php" target="_blank" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>
                            </div>
                            <?php if ($customizedData) {
                                ?>

                                <a href="shippingCart.php" class="d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset " id="btn1" style="display:none">
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
                </div>

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
        <div class="modal-content">
            <div class="modal-header" style="color: white">
                <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-dollar"></i> Extra Price Detail
                </p>
            </div>
            <div class="modal-body">
                <div class="col-md-12" id="customizeData">
                    <table  class="table table-striped table-bordered customizeData"></table>
                </div> 
                <div style="clear: both"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" 
                        data-dismiss="modal">Close
                </button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
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
    $(".check_icon_all").click(function () {
        var flag = this.checked;
        $(this).parents("table").find("input[type=checkbox]").each(function () {
            this.checked = flag;
        });
    });
    $(".product_checkBox").click(function () {
        if (this.checked) {
        }
        else {
            $(this).parents("table").find(".check_icon_all")[0].checked = false;
        }
    })

</script>
<script>
    function extraPriceDetail(obj) {
        //  var tableName = obj.id;
        var extraPrice = obj.value;
        console.log(extraPrice);
        // var breakTable = tableName;
        //  breakTable = breakTable.split("_")[1]
        // $("#tablename").html(breakTable);
        $.ajax({
            url: 'ajaxController.php',
            method: 'get',
            data: {'extraPrice': extraPrice},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                var temp = data[0]['custom_form_data'];
                var htmls = '';
                $.each(temp, function (key, value) {
                    console.log(key);
                    console.log(value);
//                    $.each(value, function (key, value) {
//                        var str1 = value;
//                        var str2 = '$';
//                        // console.log(key, value);
//                        if (str1.indexOf(str2) != -1) {
//
//
//                            var keyData = key;
//                            var keyData = key.split("_").join(" ");
//                            var data1 = value.split("(")[0]
//                            var data = value.split("(")[1].split(')');
//                            htmls += '<tr>';
//                            htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
//                            htmls += '<td>' + data1 + '</td>';
//                            htmls += '<td>' + data[0] + '</td>';
//                            htmls += '</tr>';
//                        }
//                    });
                });
                // $('.customizeData').html(htmls);
            }

        });
    }

</script>

<script>
    $(function () {
        var bucket = {};
        var product = [];
    });
</script>
<script>
    $(function () {
        $("button[name='tagId'][value=<?php echo $_REQUEST['tagid'] ?>]").removeClass("color_pink button_type_1").addClass("color_purple button_type_3");
        $("button[name='tagId']").click(function () {
            var tgid = $(this).val();
            console.log(tgid);
            if (tgid) {
                window.location.replace("shopAllCart.php?tagid=" + tgid);
            }
            else {
                window.location.replace("shopAllCart.php");
            }
        });
    });</script>
<script>
    $(function () {
       // $("#tPrice").text('<?php echo '$' . $total_price1 . '.00'; ?>');
        var res = $("#no_of_product").val();
        $("#nproduct").text(res);
        $(".no_item_found").each(function () {
            var ptable = $(this).parents("div").first().find("tbody tr");
            if (ptable.length) {
                //  console.log("sfsdfdsf");
            }
            else {
                var parent = $(this).parents("div").first();
                $(parent).find("form").remove();
                $(parent).find(".no_item_found").show();
                // console.log($(this).html());
            }

        })
        $(".custom_form_tables").each(function () {
            var trLength = ($(this).find("tr").length);
            if (trLength) {
                var custom_id = this.id;
                var tag_target = $("[aria-controls=" + custom_id + "]");
                $(tag_target).html($(tag_target).html() + "<span class='badge'>" + (trLength - 1) + "</span> ")
            }
        })

<?php
if (isset($_REQUEST['backlink'])) {
    ?>
            $("a[href='#customized_items']").tab("show");
<?php } ?>


    });
</script>

