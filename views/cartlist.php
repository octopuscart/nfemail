<?php
include 'header.php';
include '../producthandler/productHandler.php';
$productListArray = [];
$catobj = new CategoryHandler();
$productList = $_SESSION['cart'];
?>

<style>
    .test th{
        border: none;

    }
    .test td{
        border: none;

    }
</style>

<?php if ($productList) { ?>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
        <div class="container">

            <h5 style="    font-weight: 300;    margin-bottom: 10px;
                font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  Shopping Cart</h5>
            <!--breadcrumbs-->
            <small style="font-size: 15px">Your shopping cart contains <span id="total_cart_quantity"></span>&nbsp;products</small><br/>

        </div>


    </section>
    <div class="section_offset counter">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_70 m_xs_bottom_30 " style="margin-bottom:0px">
                    <div class="panel panel-default" style="margin-top: -45px;">

                        <div class="panel-body">
                            <table class="table test hideonmobile" style="color:black">
                                <thead>
                                    <tr style="font-size:14px">
                                        <th style=""><b>S. No.</b></th>
                                        <th style="width:"><b>Product Information</b></th>
                                        <th style="width:"><b>SKU</b></th>
    <!--                                    <th style="width:"><b>Item Tag</b></th>-->
                                        <th style="width:"><b>Qty.</b></th>
                                        <th style="width:"><b>Date/Time</b></th>
                                        <th style="width:"><b>Net Price</b></th>
                                        <th style="width:"><b>Availability</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // print_r($productList);
                                    for ($i = 0; $i < count($productList); $i++) {
                                        $productId = $productList[$i][0];
                                        $productTagId = $productList[$i][1];
                                        $prdObj = new ProductHandler($productId, $productTagId);
                                        $productInfo = $prdObj->productInformation();
                                        $profileImage = $prdObj->productImage();
                                        $productInfo['image'] = $profileImage['profileImage'] ? $profileImage['profileImage'] : '../assets/images/img1.png';
                                        $productInfo['quantity'] = $productList[$i][3];
                                        $productInfo['date_time'] = $productList[$i][4];

                                        $productInfo['cart_product_id'] = $listProduct[$i]['id'];

                                        $productInfo['cart_price'] = ($productInfo['price'] * $productInfo['quantity'] ) + $listProduct[$i]['extra_price'];
                                        ?>
                                        <tr style="font-size:12px">
                                            <td><?php echo $i + 1; ?></td>
                                            <td>

                                                <div class="col-md-4" style="">
                                                    <a href="#" class="r_corners d_inline_b wrapper">
                                                        <img src="<?php echo $profileImage['profileImage']; ?>" alt="" style="height:45px;width:42px;">
                                                    </a>
                                                </div>

                                                <div class="col-md-8" style="padding: 0px">

                                                    <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $productInfo['title']; ?></a></p>
                                                    <p class="fw_light"><?php echo $productInfo['product_speciality']; ?></p>
                                                    <p><?php echo $productInfo['tag_name']; ?></p>
                                                </div>


                                            </td>
                                            <td> <?php echo $productInfo['sku']; ?></td>
        <!--                                        <td><?php echo $productInfo['tag_name']; ?></td>-->
                                            <td><?php echo $productInfo['quantity']; ?></td>
                                            <td><?php echo $productInfo['date_time'] ?></td>
                                            <td><?php echo '$' . number_format($productInfo['cart_price'], 2, '.', '') ?></td>
                                            <td>In stock</td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <span style="font-size:20px;">To Customize, Please Login.</span><br/>
                            <span style="font-size:20px;;float: left;margin-top: 10px;width: 100%;">New to Nita Fashions? Click to Create an Account &#x2192; </span><br/><a href="./registration.php" style="margin-top:30px;background: red;" class="btn btn-danger">Register Now</a>

                        </div>
                    </div>
                </div>

            </div>
            <!--banners-->
        </div>
    </div>
<?php } else { ?>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
        <div class="container">

            <h5 style="    font-weight: 300;    margin-bottom: 10px;font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  Shopping Cart</h5>
            <!--breadcrumbs-->
            <small style="font-size: 15px">Your shopping cart contains <span id="total_cart_quantity">0 products</span> </small>

        </div>


    </section>
    <div class=" counter" style="">
        <div class="container">

            <div class=" tab-content" style="">
                <div class="" id="cusmotize_items">
                    <div class="col-md-12">

                        <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">


                        <div class="col-sm-12" style="    padding-right: 0;">
                            <!-- Tab panes -->
                            <div class="">
                                <h2 style="font-weight: 300;text-align: center;    margin-bottom: 20px;border-bottom: 2px solid red;
                                    padding-bottom: 10px;">
                                    <i class="icon-frown"></i>  YOUR SHOPPING BAG IS EMPTY
                                </h2>
                                <center>
                                    <div style="margin-bottom: 20px">
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=1" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Shirt To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=7" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Tuxedo Shirt To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=8" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Tuxedo Pant To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=10" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Tuxedo Suit To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=14" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Tuxedo Jacket To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=11" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Suit To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=13" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add 3 Piece Suit To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=2" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Pant To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=5" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Jacket To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=3" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Waistcoat To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=12" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Sports Jacket To Cart</span>
                                        </a>
                                        <a class="btn btn-default btn-xs" href="product_list.php?category=0&item_type=15" style="margin: 5px;   ">
                                            <span style="



                                                  ">&nbsp;Add Overcoat To Cart</span>
                                        </a>
                                </center></div>                            </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
include 'footer.php';
?>
