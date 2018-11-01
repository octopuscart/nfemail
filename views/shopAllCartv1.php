<?php
include 'header.php';
$cartprd = new CartHandler();
$cartProductsInfo = $cartprd->findCustomizationId($_SESSION['user_id']);
$cartTags = $cartprd->userTag($_SESSION['user_id']);
$countproduct = $cartprd->cartProductsCount($_SESSION['user_id'], '');
?>


<?php
$custom_form_array = array(
    'shirt' => 'shirtcustom',
    'pant'=>'pantcustom',
    'waistcoat'=>'waistcoatcustom'
);
if (isset($_REQUEST['cart_id'])) {
    $custom_form = $_REQUEST['custom_form'];
    $cart_ids = $_REQUEST["cart_id"];
    $cart_ids = implode(',', $cart_ids);
    $custom_form_val = $custom_form_array[$custom_form];
    header("location:custom_form.php?custom_form=" .$custom_form_val . "&product_array=" . $cart_ids);
}
?>

<!--page title-->
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
</style>

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



<!--content-->
<!--<div>

    <div class="cartItems" style="display: none;border: 2px solid #cccccc;">

        <div class="cartCustomizeStyle">



            <label class="cartTitle">AM480</label>

            <p class="cartsku"></p>
            <img src="http://cdn.shrideva.co.in/nfw/smaller/11.jpeg" class="cartImage" style="height:70px;width: 70px">
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
<?php if ($_REQUEST['tagid'] == 1) { ?>
                    <input type="button" value="Customize Now" class="btn btn-primary btn-sm" id="customizationShirt" data-toggle="modal" data-target="#myModal" style="margin-top: 10px;
                           margin-bottom: 8px;font-size: 11px;">
<? } ?>
<?php if ($_REQUEST['tagid'] == 2) { ?> 
                    <input type="button" value="Customize Now" class="btn btn-primary btn-sm" id="customizationPant"  style="margin-top: 10px;
                           margin-bottom: 8px;font-size: 11px;" >
<? } ?>
        <div style="clear:both"></div>
    </div>
</div>-->

<div class="section_offset counter" style="margin-top: -25px;">
    <div class="container">



        <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">

        <?php
        $cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id']);
        // print_r(count($cartIds));
        $tag = $cartprd->tags();
        ?>


        <div class="col-sm-2" style="  padding: 0px 0px 0px 5px;">
            <!-- Nav tabs --> 
            <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">

                <?php
                // print_r($tag);
                for ($t = 0; $t < count($tag); $t++) {
                    $bas_tag = $tag[$t]['tag_title'];
                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                    $bas_tag_temp = strtolower($bas_tag_temp);
                    ?>
                    <li role="presentation" class=" ">
                        <a class="" href="#<?php echo $bas_tag_temp; ?>" aria-controls="<?php echo $bas_tag_temp; ?>" role="tab" data-toggle="tab">
                            <span class="countNumber" ></span> &nbsp; <?php echo $bas_tag; ?></a></li>

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
                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                    $bas_tag_temp = strtolower($bas_tag_temp);
                    ?>
                    <div role="tabpanel" class="tab-pane " id="<?php echo $bas_tag_temp; ?>">
                        <form>
                            <div class="custom_container"
                                 style="
                                 font: 300 60px 'Lato';
                                 color: #FFF;
                                 background-color: #000;
                                 background-image: url('http://www.alegriphotos.com/images/Blurred-city-lights488.jpg');
                                 background-repeat: no-repeat;
                                 background-size: 935px;
                                 padding: 11px;
                                 "
                                 >
                                <p style="   
                                   font: 300 60px 'Lato';
                                   color: #fff;
                                   "><?php echo $bas_tag; ?></p>
                                <table class = "table withoutCustom" style = "background:#fff">
                                    <thead>
                                        <tr class = "bg_light_2 color_dark">
                                            <th style="width:1%">S.No.</th>
                                            <th style="width:30%">Product Description</th>
                                            <th style="width:12%">SKU</th>
                                            <th style="width:12%">Price</th>
                                            <th style="width:12%">Quantity</th>
                                            <th style="width:12%">Total</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($cartIds); $i++) {

                                            $cartid = $cartIds[$i]['id'];

                                            $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);

                                            $tg1 = $cartInfo['product_tag'];


                                            for ($k = 0; $k < count($tg1); $k++) {

                                                $tg2 = $tg1[$k]['tag_title'];

                                                if ($bas_tag == $tg2) {
                                                    $count++;
                                                    ?>
                                                    <!-- without customized product list -->


                                                    <tr class="tr_delay">

                                                        <td data-title="">

                                                            <input type="checkbox" id="checkboxs_<?php echo $count; ?>" name="cart_id[]" class="d_none product_checkBox" value="<?php echo $cartInfo['cart_product_id']; ?>">
                                                            <label for="checkboxs_<?php echo $count; ?>" class="d_inline_m m_right_10"></label>

                                                        </td>
                                                        <td>

                                                            <div style="width: 65px;float: left;">
                                                                <a href="#" class="r_corners d_inline_b wrapper">
                                                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height:45px;width:42px;">
                                                                </a>
                                                            </div>

                                                            <div>                                  
                                                                <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></p>
                                                                <p class="fw_light"><?php echo substr($cartInfo['short_description'], 0, 25); ?></p>
                                                            </div>

                                                        </td>
                                                        <td data-title="SKU" class="fw_light"><?php echo $cartInfo['sku']; ?></td>
                                                        <td data-title="Price"><?php echo $cartInfo['price'] . '.00' ?></td>

                                                        <td data-title="Quantity">
                                                            <?php echo $cartInfo['quantity']; ?>

                                                        </td>

                                                        <td data-title="Total" class="">
                                                            <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                                        </td>


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
                                <input type="hidden" name="custom_form" value="<?php echo $bas_tag_temp; ?>">
                                <button class="btn btn-default btn-lg" type="submit">
                                    <i class="icon-bucket"></i> Customize Now
                                </button>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!-- End -->
    <!-- With customized product -->
    <div class="col-md-12">
        <?php
        $customizedData = $cartprd->idCustomizationwithValue($_SESSION['user_id']);
        if ($customizedData) {
            ?>
            <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Customized product</h4>
            <div class="">
                <table class="table withCoustom">
                    <thead>
                        <tr>        
                            <th style="width: 7%;">S.No.</th>
                            <th style="width: 18%;">Product Description</th>
                            <th style="width: 12%;">SKU</th>
                            <th style="width: 12%;">Tag</th>
                            <th style="width: 12%;">Quantity</th>
                            <th style="width: 12%;">Price</th>
                            <th style="width: 12%;">Extra Price</th>
                            <th style="width: 12%;">Total</th>

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
                            echo '<input type="hidden" id="no_of_product" value="' . count($customizedData) . '">';
                            $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);
                            ?>
                            <tr class="">
                                <td> <?php echo $i + 1 ?></td>
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
                                        $temp = $customization_id[0]['customization_id']
                                        ?>
                                        <span data-toggle="" data-placement="left" title="View Summary"><a href="#" style="padding: 0px;height: 22px;width: 28px;margin-left:1px" class="btn btn-default btn-xm" data-toggle="modal" data-target="#myModal<?php echo $temp; ?>"><i class="icon-eye"></i></a></span>
                                        <span data-toggle="" data-placement="left" title="Send Mail"> <a href="../producthandler/mailAndMessageHandler.php?cart_product_id=<?php echo $temp; ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                                        <?php if ($cartInfo['customize_table'] == 'shirt_customize_profile') { ?> 
                                            <span data-toggle="" data-placement="left" title="Save PDF"><a href="./shirt_customize_profile_summary_pdf.php?cart_product_id=<?php echo $temp; ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>
                                        <?php } ?>
                                        <?php if ($cartInfo['customize_table'] == 'nfw_pant_customize_profile') { ?>
                                            <span data-toggle="" data-placement="left" title="Save PDF"><a href="./pant_customize_profile_summary_pdf.php?cart_product_id=<?php echo $temp; ?>" target="blank" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-download"></i></a></span>
                                        <?php } ?>
                                        <!-- Summary -->
                                        <div class="modal fade" id="myModal<?php echo $temp; ?>" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="false">
                                            <?php if ($cartInfo['customize_table'] == 'shirt_customize_profile') { ?>
                                                <div class="modal-dialog modal-lg">
                                                <?php }
                                                ?>
                                                <?php if ($cartInfo['customize_table'] == 'nfw_pant_customize_profile') { ?>
                                                    <div class="modal-dialog">
                                                    <?php } ?>

                                                    <div class="modal-content" style="width:112%;  border: 2px solid #cccccc;
                                                         border-radius: 0px;">
                                                        <button style="   margin-top: 9px;
                                                                margin-right: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="jackbox-button jackbox-button-margin jackbox-close"></span></button>

                                                        <div class="modal-header" style="height: 40px;background:#1FB8C6;">


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->

                                                            <h4 class="modal-title"  style="color:white;margin: -9px 0px 0px 0px;"><span><?php echo $title[0]['title']; ?></span> Style ID # <?php echo $temp; ?></h4>  
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php if ($cartInfo['customize_table'] == 'shirt_customize_profile') { ?>
                                                                <iframe class="loginScreen" src="shirt_customize_profile_summary.php?cart_product_id=<?php echo $temp; ?>" width="100%" height="540" scrolling="yes"></iframe> 
                                                            <?php }
                                                            ?>
                                                            <?php if ($cartInfo['customize_table'] == 'nfw_pant_customize_profile') { ?>
                                                                <iframe class="loginScreen" src="pant_customize_profile_summary.php?cart_product_id=<?php echo $temp; ?>" width="100%" height="300" scrolling="yes"></iframe> 
                                                            <?php } ?>

                                                        </div>
                                                        <script>
                                                            localStorage.checkCheckout = 0;
                                                            $(function () {
                                                                var mInterval = setInterval(function () {
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
                                        </div>
                                        <!-- End -->
                                    </div>
                                </td>
                                <td><?php echo $cartInfo['sku']; ?></td>
                                <td>
                                    <?php if ($cartInfo['customize_table'] == 'shirt_customize_profile') { ?>
                                        <p>Shirt</p>
                                    <?php }
                                    ?>
                                    <?php if ($cartInfo['customize_table'] == 'nfw_pant_customize_profile') { ?>

                                        <p>Pant</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo $cartInfo['quantity']; ?>

                                </td>
                                <td><?php echo '$' . $cartInfo['price'] . '.00'; ?></td>


                                <td><?php echo '$' . $cartInfo['extra_price'] . '.00'; ?></td>

                                <td>
                                    <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                </td>


                            </tr>

                            <?php
                            $total_price1 = $total_price1 + $cartInfo['cart_price'];
                        }
                        ?> 
                        <tr class="bg_light_2">
                            <td colspan="7" class="v_align_m">
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

        <?php } ?>                 
        <!-- End -->

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
            <label for="checkbox_7" class="d_inline_m fw_light">I agree to the Terms of Service </label>
            <p class="d_inline_m fw_light">(<a href="#" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>
        </div>
        <?php if ($customizedData) {
            ?>

            <a href="shippingCart.php" class="d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset"><i class="icon-check d_inline_b m_right_5"></i> Checkout Now</a>


            <!--            <a href="shippingCart.php" class="button_type_3 tr_all color_pink r_corners tt_uppercase d_inline_b fs_medium mini_side_offset">
                            <i class="icon-check fs_medium d_inline_b m_right_10"></i>
                            Checkout Now
                        </a>-->
        <?php }
        ?>
    </div>
</div>
</div>

<?php
include 'footer.php'
?>


<!-- Shirt Customization pop up -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">

        <div class="modal-content" style="width:112%;border: 2px solid #cccccc;
             border-radius: 0px;">
            <button style="   margin-top: 9px;
                    margin-right: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="jackbox-button jackbox-button-margin jackbox-close"></span></button>

            <div class="modal-header" style="height: 40px;background:#1FB8C6;">



                <?php
                $row = mysql_query("SELECT id+2 FROM `shirt_customize_profile` order by id desc limit 0, 1 ");
                $resultData = mysql_fetch_array($row);
                ?>
                <h4 class="modal-title" style="color:white;margin: -9px 0px 0px 0px;" >Style ID # <?php print_r($resultData['id+2']); ?></h4>  
            </div>
            <div class="modal-body">
                <iframe class="loginScreen" src="../custom_fabric/index.php?fabric=<?php echo $productInfo['sku']; ?>&amp;id=<?php echo $productInfo['id']; ?>&amp;pro_img=   &lt;img width=&quot;300&quot; height=&quot;300&quot; src=&quot;http://localhost/nfv2.0/wp-content/uploads/2013/06/2-300x300.jpg&quot; class=&quot;backg_img wp-post-image&quot; alt=&quot;2&quot; id=&quot;img_zoom&quot; data-zoom-image=&quot;http://localhost/nfv2.0/wp-content/uploads/2013/06/2.jpg&quot; title=&quot;2&quot;&gt;&amp;pro_price=$<?php echo $productInfo['price']; ?>&amp;pro_dis=Wide Yellow� &amp; White Stripes
                        &amp;user_id=1&amp;user= &amp;cloth_id=<?php echo $productInfo['id']; ?>&amp;fabric_id=1&amp;fabric_no=<?php echo $productInfo['sku']; ?>&amp;fabric_price=$<?php echo $productInfo['price']; ?>&amp;post_id=<?php echo $productInfo['id']; ?>&amp;product_array=<?php echo $id ?>" width="100%" height="540" scrolling="yes"></iframe>

            </div>
            <script>
                localStorage.checkCheckout = 0;
                $(function () {
                    var mInterval = setInterval(function () {
                        //console.log(localStorage.checkCheckout);
                        if (localStorage.checkCheckout == 1) {
                            localStorage.checkCheckout = 0;
                            // console.log('tesdfgdf');
                            window.location = window.location.toLocaleString();

                        }
                        ;
                    }, 1000);
                })
            </script>  

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Shirt -->
<script>
    $(function () {
        var bucket = {};
        var product = [];
        $(".product_checkBox").click(function () {
            $("#productImagesTemplate").html('');
            if ($(this).is(':checked')) {
                var cartId = $(this).val();
                var sku = $(this).parent().parent().find('td:nth-child(4)').text();
                var imgpath = $(this).parent().parent().find('td:nth-child(2) img').attr('src');
                var title = $(this).parent().parent().find('td:nth-child(2) a').text();
                console.log(title);
                //bucket  = {testID,sku,imgpath,title};
                bucket[cartId] = {'img_path': imgpath, 'title': title, 'sku': sku};
                console.log(bucket);
                product.push(cartId);
                //console.log(product);
            }
            ;
            if (!$(this).is(':checked')) {
                var cartId = $(this).val();
                delete bucket[cartId];

                product.pop(cartId);
                // console.log(product);

            }
            // console.log(bucket);
            var margins = 0;
            for (i in bucket) {
                margins += 30;
                var temp = bucket[i];
                console.log(temp);
                var htmls = $(".cartItems");
                $(htmls).find(".cartCustomizeStyle").css({"z-index": margins})
                $(htmls).find(".cartImage").attr("src", temp['img_path']);
                $(htmls).find('.cartTitle').text(temp['title']);
                //                $(htmls).find('.cartsku').text(temp['sku']);
                $("#productImagesTemplate").append($(htmls)[0].innerHTML);
            }

            $('input[name=product_id]').val(product);

            // For shirt customization pop up
            var shirtURL = "../custom_fabric/index.php?product_array=";
            $("#customizationShirt").click(function () {
                //console.log(iframsURL + product);
                $(".loginScreen").attr("src", shirtURL + product);

            });

            // For pant customization page link
            var pantURL = "pantcustom.php?product_array=";
            $("#customizationPant").click(function () {
                // console.log(iframsURL + product);
                window.location = pantURL + product;
            });


            if (product == '') {
                $('#customization').hide();
                $("#containerBox").hide(300);
                //$("#productImage").hide();
            } else {
                $("#containerBox").show(300);
                $('#customization').show();
                $("#productImage").show();
            }
        });
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
    });
</script>
<script>
    $(function () {
        $("#tPrice").text('<?php echo '$' . $total_price1 . '.00'; ?>');
        var res = $("#no_of_product").val();

        $("#nproduct").text(res);


    });
</script>