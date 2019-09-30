<?php
include 'header.php';
include '../producthandler/productHandler.php';
######## 26-Aug-2015
$product_ids = $authobj->userWishList($_SESSION['user_id']);
############
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

    $cartprd = new CartHandler();
    if (isset($_POST['Copy'])) {
        $cartprd->WishlistCopyToCart($_POST['wishlist_id'], $_SESSION['user_id']);
        header("location:wishlist.php");
    }
    if (isset($_POST['Move'])) {
        $cartprd->WishlistMoveToCart($_POST['wishlist_id'], $_SESSION['user_id']);
        header("location:wishlist.php");
    }
    ?>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
             padding-bottom: 0px;

             box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Wishlist</p>
            <div style="margin-top: 10px;"></div>

        </div>
    </section>
    <style>
        .test th{
            border: none;

        }
        .test td{
            border: none;

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

                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                        </div>
                        <div class="panel-body">
                            <?php if ($product_ids) { ?>
                                <table class="table test">
                                    <thead>
                                        <tr style="font-size:12px">
                                            <th style="width:">S. No.</th>
                                            <th style="width:">Item Code</th>
                                            <th style="width:">Item Image</th>
                                            <th style="width:">Item Tag </th>
                                            <th style="width:">Date/Time</th>
                                            <th style="width:">Net Price</th>
                                            <th style="width:">Availability</th>
                                            <th style="width:">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //print_r($product_ids);
                                        for ($i = 0; $i < count($product_ids); $i++) {
                                            $wishIds = $product_ids[$i]['product_id'];
                                            // print_r($wishIds);
                                            $tag = $authobj->wishlistProductTag($wishIds);
                                            //print_r($tag);
                                            $op_date = $product_ids[$i]['op_date'];
                                            $op_time = $product_ids[$i]['op_time'];
                                            $prdObj = new ProductHandler($product_ids[$i]['product_id'], $product_ids[$i]['tag_id']);
                                            $productInfo = $prdObj->productInformation();
                                            $profileImage = $prdObj->productImage();
                                            ?>
                                            <tr style="font-size:12px">

                                                <td><?php echo $i + 1; ?></td>
                                                <td><?php echo $productInfo['sku']; ?></td>
                                                <td>
                                                    <a href="#" class="r_corners d_inline_b wrapper">
                                                        <img src="<?php echo $profileImage['profileImage'] ?>" alt="" style="height:35px;width:35px;">
                                                    </a>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?php echo $productInfo['tag_name']; ?>
                                                    </span>

                                                </td>
                                                <td><?php echo $op_date . ',' . $op_time; ?></td>
                                                <td><?php echo '$' . $productInfo['price'] . '.00'; ?></td>
                                                <td>In stock</td>
                                                <td>
                                                    <form method="post" action="#">
                                                        <input type="hidden" name="wishlist_id" value="<?php echo $product_ids[$i]['id']; ?>">    
                                                        <button name="Copy" class="btn btn-default btn-xs">Copy To Cart</button>
                                                        <button name="Move" class="btn btn-default btn-xs">Move To Cart</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <center><span style="color:red;font-size:20px">NO ITEM ADDED IN WISHLIST</span></center>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--banners-->
        </div>
    </div>
<?php } ?>
<?php
include 'footer.php';
?>