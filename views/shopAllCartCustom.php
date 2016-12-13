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
    if (isset($_GET['custom_product'])) {
        $getData = $_GET['custom_product'];
        if ($getData) {
            $getDataArray = explode(",", $getData);

            foreach ($getDataArray as $key => $value) {
                $query = "update nfw_product_cart set customize_table = 1 where id = $value";
                resultAssociate($query);
            }
        }
    }

    if (isset($_POST['removeCustomCart'])) {
        $ccid = $_POST['removeCustomCart'];
        $query = "update nfw_product_cart set customize_table = '' where id = $ccid";
        resultAssociate($query);
        
//header("location:shopAllCartCustom.php");
    }


    $customdataquery = "select id from nfw_product_cart where customize_table = 1 and user_id = " . $_SESSION['user_id'];
    $getDataArray = resultAssociate($customdataquery);
    $temp = array();
    foreach ($getDataArray as $key => $value) {
        array_push($temp, $value['id']);
    }

    $getDataArray = $temp;

    if (isset($_POST['Copy'])) {
        $cartprd->CartCopyToWishlist($_POST['Cart_id'], $_SESSION['user_id']);
    }

    if (isset($_POST['deleteCart'])) {
        //echo $_POST['deleteCart'];
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
    if (isset($_POST['do_customization'])) {
        $custom_form = $_POST['custom_form'];
        $cart_ids = $_POST["cart_id"];
        $tag_id = $_POST["tag_id"];
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
            width: 20px;
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
        .gift_detail td{
            padding: 0px!important;
            border: none !important;
            font-size: 12px;
        }
        .gift_detail{
            margin-bottom: 10px;
        }
        .payment_span{
            box-sizing: border-box;
            width: 100%;
            background: #CECECE;
            /* height: 20px; */
            float: left;
            color: #000000;
            padding: 6px;
            margin-bottom: 11px;
        }



    </style>

    <!--custom form support css and js-->
    <!--<link href="./custom_form_view/static/custmo_js_css/customform.css" rel="stylesheet">-->


    <style>
        .fw_light{

            color: #000;
        }

        .selectall input[type="checkbox"] + label:before {
            content: "";
            font-family: "fontello";
            display: block;
            position: relative;
            background: #F00 none repeat scroll 0% 0%;
            top: -6px;
            left: -38px;
            width: 22px;
            height: 23px;
            border: 2px solid #C00;
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


    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
        <div class="container">

            <h5 style="    font-weight: 300;    margin-bottom: 10px;
                font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  Customization Cart</h5>
            <!--breadcrumbs-->
    <!--            <small style="font-size: 15px"><span id="total_cart_quantitys">0</span> are ready to customize</small><br/>-->

            <a href="shopAllCart.php">
                <span style="
                      font-size: 13px;
                      font-weight: 500;
                      /* margin-left: 10px; */
                      margin-top: 14px;
                      /* text-decoration: overline; */
                      /* border: 1px solid #000; */
                      padding: 6px 6px;
                      border-radius: 6px;
                      background-color: #E0E0E0;
                      /* float: left; */
                      "><i class="icon-left-1"></i>&nbsp; Back To Cart Items </span>
            </a>

        </div>


    </section>



    <div class=" counter" style="">
        <div class="container" style="margin-bottom: 20px;    width: 100%;">

            <div class=" tab-content" style="">
                <div class="" id="cusmotize_items">
                    <div class="col-md-12">

                        <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">

                        <div class="col-sm-2">
                            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                                <?php
                                $count = 0;
                                $tag = $cartprd->tags();
                                $tag_sort = array();

                                $custom_order = ['Overcoat', 'Tuxedo Suit', 'Tuxedo Jacket', 'Tuxedo Pant', 'Tuxedo Shirt',
                                    '3 Piece Suit', 'Suit', 'Sports Jacket', 'Jacket', 'Pant', 'Waistcoat', 'Shirt'];
                                foreach ($custom_order as $key1 => $value1) {
                                    foreach ($tag as $key => $value) {
                                        //echo $value1, $value['tag_title'];
                                        if ($value1 == $value['tag_title']) {

                                            array_push($tag_sort, $value);
                                        }
                                    }
                                }
                                $tag = $tag_sort;


                                $count = 0;
                                $totalq = 0;
                                $temp = 0;

                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id'], $bas_tag_id, "=");
                                    $customArray = array();
                                    foreach ($cartIds as $key => $value) {
                                        foreach ($getDataArray as $key1 => $value1) {
                                            if ($value['id'] == $value1) {
                                                array_push($customArray, $value);
                                            }
                                        }
                                    }
                                    if (count($customArray)) {
                                        ?>
                                        <li role="presentation" class="<?php echo $temp == 0 ? 'active' : ''; ?> ">
                                            <a class="" href="#<?php echo $bas_tag_id; ?>" aria-controls="<?php echo $bas_tag_id; ?>" role="tab" data-toggle="tab">
                                                <?php echo $bas_tag; ?>
                                                <span class='badge'><?php echo count($customArray); ?></span>
                                            </a>
                                        </li>
                                        <?php
                                        $temp++;
                                        $count++;
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                        <div class="col-sm-10" style="    padding: 0;">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                $tag = $cartprd->tags();

                                $tag_sort = array();

                                $custom_order = ['Overcoat', 'Tuxedo Suit', 'Tuxedo Jacket', 'Tuxedo Pant', 'Tuxedo Shirt',
                                    '3 Piece Suit', 'Suit', 'Sports Jacket', 'Jacket', 'Pant', 'Waistcoat', 'Shirt'];
                                foreach ($custom_order as $key1 => $value1) {
                                    foreach ($tag as $key => $value) {
                                        //echo $value1, $value['tag_title'];
                                        if ($value1 == $value['tag_title']) {

                                            array_push($tag_sort, $value);
                                        }
                                    }
                                }
                                $tag = $tag_sort;

                                $count = 0;
                                $totalq = 0;
                                $temp = 0;
                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    $customArray = array();
                                    $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id'], $bas_tag_id, "=");
                                    foreach ($cartIds as $key => $value) {
                                        foreach ($getDataArray as $key1 => $value1) {
                                            if ($value['id'] == $value1) {
                                                array_push($customArray, $value);
                                            }
                                        }
                                    }
                                    if (count($customArray)) {
                                        ?>

                                        <div role="tabpanel" class="custom_form_tables tab-pane <?php echo $temp == 0 ? 'active' : ''; ?> " id="<?php echo $bas_tag_id; ?>">

                                            <form method="post" action="#">
                                                <div class="custom_container "
                                                     style="
                                                     color: #000;
                                                     background-repeat: no-repeat;
                                                     background-size: 935px;
                                                     margin-bottom: 10px;
                                                     padding-bottom: 10px;
                                                     " >

                                                    <p style="   
                                                       font: 300 60px 'Lato';
                                                       color: #000;
                                                       font-size: 26px;
                                                       font-weight: 300;
                                                       padding: 5px;
                                                       margin-bottom: 22px;
                                                       ">
                                                        <span style=" "> Design Your <?php echo $bas_tag; ?></span>

                                                        <input type="hidden" name="tag_id" value="<?php echo $bas_tag_id; ?>" >
                                                        <input type="hidden" name="custom_form" value="<?php echo $bas_tag_temp; ?>">
                                                        <button class="btn btn-danger " name='do_customization' type="submit" style="
                                                                background: #000;
                                                                font-size: 18px;
                                                                margin-right: 60px;
                                                                float: right;
                                                                ">
                                                            Customize Now &nbsp;<i class="icon-right-1"></i>
                                                        </button>

                                                    </p>

                                                    <div class="col-md-9 row" style="padding: 0px">
                                                        <?php
                                                        $temp++;
                                                        for ($i = 0; $i < count($customArray); $i++) {

                                                            $cartid = $customArray[$i]['id'];
                                                            $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id'], $bas_tag_id);
                                                            // print_r($cartInfo);
                                                            $tg1 = $cartInfo['product_tag'];
                                                            $count++;
                                                            ?>

                                                            <div class=" col-md-3">
                                                                <div class="thumbnail">
                                                                    <div class="image_class" style="background: url(<?php echo $cartInfo['image']; ?>);height: 132px;">
                                                                    </div>
                                                                    <div class="caption" style="    border: 1px solid #DDD;
                                                                         border-top: 0px;">
                                                                        <h3 style="font-weight: 300;font-size: 24px;padding: 9px 0px;">
                                                                            <?php echo $cartInfo['title']; ?> 
                                                                            <form method="post" action="#" style='float: right' onsubmit="confirm('Are you sure want to remove this product from customization cart?')">
                                                                                <button type='submit' class='pull-right' name='removeCustomCart' value='<?php echo $cartInfo['cart_product_id']; ?>'> 
                                                                                    <i class="icon-cancel" style='color: red;'></i>
                                                                                </button>
                                                                            </form>
                                                                        </h3>
                                                                        <input type="hidden"  name="cart_id[]"  value="<?php echo $cartInfo['cart_product_id']; ?>">
                                                                        <p style="font-size: 11px;    margin-bottom: 10px;">
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
                                                                        <table class="gift_detail">
                                                                            <tr><td>Quantity</td> <td>: <?php echo $cartInfo['quantity']; ?></td></tr>
                                                                            <tr><td>Total</td> <td> : <b> <?php
                                                                                        echo '$' . $cartInfo['cart_price'] . '.00';
                                                                                        $totalq += $cartInfo['cart_price'];
                                                                                        ?></b></td></tr>
                                                                        </table>
                                                                        </p>


                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <!-- without customized product list -->

                                                            <?php
                                                            $total_price = $total_price + $cartInfo['cart_price'];
                                                        }
                                                        ?>




                                                        <div class="col-md-12">
                                                            <button class="btn btn-danger " type="submit" name='do_customization' style="
                                                                    background: #000;
                                                                    font-size: 18px;float: left;
                                                                    background: #000;
                                                                    font-size: 18px;
                                                                    float: left;
                                                                    padding: 6px 20px;

                                                                    ">
                                                                Customize Now &nbsp;<i class="icon-right-1"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3" style="    padding: 0;">
                                                        <div class="" 
                                                             style="min-height: 450px;
                                                             height: 100%;
                                                             background: url(custom_form_view/background_new_custom/<?php echo $bas_tag_id; ?>.jpg); 
                                                             background-position-y: 11px;
                                                             background-size: 100%;
                                                             background-repeat: no-repeat;">

                                                        </div>
                                                    </div>
                                                    <div style="clear: both"></div>

                                                </div>
                                                <div style="clear: both"></div>


                                            </form>


                                        </div>
                                        <?php
                                    }
                                }

                                if ($totalq > 0) {
                                    
                                } else {
                                    ?>
                                    <h2 style="margin-left: -15%;;font-weight: 300;text-align: center;    margin-bottom: 20px;border-bottom: 2px solid red;
                                        padding-bottom: 10px;">
                                        <i class="icon-frown"></i>  YOUR SHOPPING CART IS EMPTY
                                    </h2>
                                    <center>
                                        <div style="margin-bottom: 20px;margin-left: -13%;">
                                            <?php
                                            $tag = $cartprd->tags();
                                            $count = 0;
                                            $totalq = 0;
                                            for ($t = 0; $t < count($tag); $t++) {
                                                $bas_tag = $tag[$t]['tag_title'];
                                                $bas_tag_id = $tag[$t]['id'];
                                                ?>
                                                <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=<?php echo $bas_tag_id; ?>" style="margin: 5px;   ">
                                                    <span style="



                                                          ">&nbsp;Add <?php echo $bas_tag; ?> To Cart</span>
                                                </a>
                                                <?php
                                            }
                                            echo "</center></div>";
                                        }
                                        ?>
                                    </div>
                            </div>
                            <!-- End -->
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
    <!---------------- ------------------------------------------------------------------------>




    <script>


        function getCartData() {
            //changes for new page customcart page
            $("[name='cart_id[]']").each(function () {
                if (this.checked) {
                    var trobj = $(this).parents("tr");
                    console.log($(trobj).children()[1]);
                    console.log($(trobj).children()[3]);
                }
                ;
            })
            //end of custom cart page
        }

        $(function () {
            $("[name='cart_id[]']").click(function () {
                getCartData();
            })
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

            $("#total_cart_quantitys").text("<?php echo $totalq > 1 ? $totalq . " products" : $totalq . " product"; ?>");




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


<?php
if (isset($_REQUEST['backlink'])) {
    ?>
                $("a[href='#customized_items']").tab("show");
<?php } ?>


        });
    </script>