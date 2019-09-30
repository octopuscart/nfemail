<?php
include 'header.php';
include '../producthandler/productHandler.php';
$cartprd = new CartHandler();
if (isset($_POST['Copy'])) {
    $cartprd->WishlistCopyToCart($_POST['wishlist_id'], $_SESSION['user_id']);
}
if (isset($_POST['Move'])) {
    $cartprd->WishlistMoveToCart($_POST['wishlist_id'], $_SESSION['user_id']);
}

#$product_ids = $authobj->userWishList($_SESSION['user_id']);
?>
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
<div>

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
        <div style="clear:both"></div>
    </div>
</div>




<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
         padding-bottom: 0px;

         box-shadow: 0px 3px 7px -1px #DBDADA;
         ">
    <div class="container">

        <p style="margin-top:0px;font-size: 23px;">Your Wishlist</p>
        <div style="margin-top: 10px;">  


        </div>

    </div>
</section>
<div class="section_offset counter" style="margin-top: -25px;">
    <div class="container">
        
        <?php
        $cartIds = $cartprd->WishListCustomizationWithZero($_SESSION['user_id']);
        
        if ($cartIds) {
            ?>
            <div class ="" style = "">
                <table class = "table withoutCustom" style = "">
                    <thead>
                        <tr class = "bg_light_2 color_dark">
                            <th style="width:3%">S.No.</th>
                            <th style="width:5%">Product Description</th>
                            <th style="width:5%">SKU</th>
                            <th style="width:5%">Price</th>
                            <th style="width:5%">Tag</th>
                            <th style="width:5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($cartIds); $i++) {

                            $cartid = $cartIds[$i]['id'];
                            $cartInfo = $cartprd->WishListProductsInformation($cartid, $_SESSION['user_id']);
                            ?>
                            <tr class="tr_delay">

                                <td data-title="">
                                    <?php echo $i + 1; ?>

                                </td>
                                <td data-title="Product Image">
                                    <div style="width: 58px;float: left;">
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
                                <td data-title="Price"><?php echo '$' . $cartInfo['price'] . '.00'; ?></td>
                                <td data-title="Action" class="fw_ex_bold color_dark">
                                    <?php
                                    for ($j = 0; $j <= count($productInfo1); $j++) {
                                        $productInfo1 = $cartInfo['product_tag'][$j]['tag_title'];
                                        echo "<button class='btn btn-primary btn-xs' style='margin:2px'>" . $productInfo1 . "</button>";
                                    }
                                    ?>

                                </td>
                          <form method="post">
                            <td data-title="Quantity" style="width:" >

                                <input type="hidden" name="wishlist_id" value="<?php echo $cartIds[$i]['id']; ?>">    
                                <button name="Copy" class="btn btn-primary btn-xs">Copy In Cart</button>
                                <button name="Move" class="btn btn-danger btn-xs">Move In Cart</button>

                            </td>
                        </form>
                    </tr>
                        <?php
                        $checkNonCustomData++;
                        $total_price = $total_price + $cartInfo['cart_price'];
                    }
                }
                else{
                    echo "<center>Not have no product in your wishlist</center>";
                }
                ?>
                </tbody>
            </table>
        </div>
        
        <hr>
        <!-- End -->
        <!-- With customized product -->

    </div>
</div>


<?php
include 'footer.php'
?>
