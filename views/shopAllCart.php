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
                font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  Shopping Cart</h5>
            <!--breadcrumbs-->
            <small style="font-size: 15px">Your shopping cart contains <span id="total_cart_quantitys">0 products</span> </small>

        </div>


    </section>



    <div class=" counter" style="">
        <div class="container" style="margin-bottom: 20px">

            <div class=" tab-content" style="">
                <div class="" id="cusmotize_items">
                    <div class="col-md-12">

                        <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">

                        <div class="col-sm-2">
                            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">
                                <?php
                                $count = 0;
                                $tag = $cartprd->tags();
                                $count = 0;
                                $totalq = 0;
                                $temp = 0;
                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id'], $bas_tag_id);
                                    if (count($cartIds)) {
                                        ?>

                                        <li role="presentation" class="<?php echo $temp == 0 ? 'active' : ''; ?> ">
                                            <a class="" href="#<?php echo $bas_tag_id; ?>" aria-controls="<?php echo $bas_tag_id; ?>" role="tab" data-toggle="tab">
                                                <?php echo $bas_tag; ?>
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
                        <div class="col-sm-10" style="    padding-right: 0;">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                $tag = $cartprd->tags();
                                $count = 0;
                                $totalq = 0;
                                $temp = 0;
                                for ($t = 0; $t < count($tag); $t++) {
                                    $bas_tag = $tag[$t]['tag_title'];
                                    $bas_tag_id = $tag[$t]['id'];
                                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                                    $bas_tag_temp = strtolower($bas_tag_temp);
                                    $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id'], $bas_tag_id);
                                    if (count($cartIds)) {
                                        ?>

                                        <div role="tabpanel" class="custom_form_tables tab-pane <?php echo $temp == 0 ? 'active' : ''; ?> " id="<?php echo $bas_tag_id; ?>">

                                            <div class="custom_container"
                                                 style="
                                                 
                                                 color: #000;
                                                 border: 1px solid;
                                                 background-repeat: no-repeat;
                                                 background-size: 935px;
                                                 margin-bottom: 10px;
                                                 padding-bottom: 10px;
                                                 "
                                                 >
                                                <p style="   
                                                  font: 400 60px 'Lato';
                                                   color: #FFF;
                                                   font-size: 30px;
                                                   font-weight: 300;
                                                   background-color: #000;
                                                   padding: 5px;
                                                   ">

                                                    <?php echo $bas_tag; ?>
                                                    <a href="product_list.php?category=0&item_type=<?php echo $bas_tag_id; ?>">
                                                        <span style="
                                                              font-size: 17px;
                                                              font-weight: 500;
                                                              margin-top: 8px;
                                                              float: right;
                                                              /* text-decoration: overline; */
                                                              /* border: 1px solid #000; */
                                                              padding: 1px 10px;
                                                              color: #FFF;
                                                              border-bottom: 1px solid #F00;
                                                              text-align: right;
                                                              background-color: #000000;
                                                              ">&nbsp;Add More <?php echo $bas_tag; ?> To Cart <i class="icon-right-1"></i></span>
                                                    </a>
                                                </p>
                                                <form method="post" action="#">
                                                    <table class = "table withoutCustom" style = "background:#fff">
                                                        <thead>
                                                            <tr class = "bg_light_2 color_dark">
                                                                <th style="width: 5%;
                                                                    padding: 0px 10px;">
                                                                    <span 
                                                                        style="
                                                                        font-size: 11px;
                                                                        font-weight: 700;
                                                                      
                                                                        float: left;
                                                                        margin-bottom: 5px;
                                                                        ">
                                                                        Select All
                                                                    </span>
                                                                    <br/>
                                                                    <span class="selectall" style="float: left;
                                                                          width: 6px;">
                                                                        <input type="checkbox" id="checkboxs_all_<?php echo $bas_tag_id; ?>"   class="d_none check_icon check_icon_all" >
                                                                        <label for="checkboxs_all_<?php echo $bas_tag_id; ?>"  class="d_inline_m m_right_10 lableall"></label>

                                                                    </span>

                                                                </th>


                                                                <th style="width:30%">Product Information</th>
                                                                <th style="width:12%">SKU</th>
                                                                <th style="width:12%">Price</th>
                                                                <th style="width:12%">Qty.</th>
                                                                <th style="width:12%">Total</th>
                                                                <th style="width:5%"></th

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $temp++;
                                                            for ($i = 0; $i < count($cartIds); $i++) {

                                                                $cartid = $cartIds[$i]['id'];
                                                                $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id'], $bas_tag_id);
                                                                // print_r($cartInfo);
                                                                $tg1 = $cartInfo['product_tag'];
                                                                $count++;
                                                                ?>
                                                                <!-- without customized product list -->
                                                                <tr class="tr_delay">
                                                                    <td data-title="line-height: 10px;">
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
                                                                        <?php
                                                                        echo $cartInfo['quantity'];
                                                                        $totalq += $cartInfo['quantity'];
                                                                        ?>

                                                                    </td>

                                                                    <td data-title="Total" class="">
                                                                        <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                                                    </td>

                                                                    <td data-title="Action" class="fw_ex_bold color_dark"  style="width:20px">
                                                                        <button class="color_grey_light_2 color_dark_hover tr_all" name="deleteCart" value="<?php echo $cartInfo['cart_product_id']; ?> ">
                                                                            <i class="icon-cancel-circled-1 fs_large"></i>
                                                                        </button>

                                                                    </td>                                                                

                                                                </tr>
                                                                <?php
                                                                $total_price = $total_price + $cartInfo['cart_price'];
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" name="tag_id" value="<?php echo $bas_tag_id; ?>" >
                                                    <input type="hidden" name="custom_form" value="<?php echo $bas_tag_temp; ?>">
                                                    <button class="btn btn-danger btn-lg" type="submit" style="background:#000;    margin-left: 10px;">
                                                        <i class="icon-tools"></i> Customize Now
                                                    </button>


                                                </form>

                                            </div>
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