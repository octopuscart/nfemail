 <?php
include 'header.php';
include '../producthandler/productHandler.php';
$productId = $authobj->authProductId($_SESSION['user_id']);
//echo $productId;
//print_r($productId);

$userInfo = $authobj->userProfile($_SESSION['user_id']);
?>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
         padding-bottom: 0px;
         background: url('../assets/images/cartbg2.jpg');
         box-shadow: 0px 3px 7px -1px #DBDADA;
         ">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>

        <div style="margin-top: 10px;"> </div>

    </div>
</section>

<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30" >	

                <?php
                include 'leftMenu.php';
                ?>

            </aside>

            <section class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="box-shadow: 0px 0px 20px -9px;">
            <div style="background: rgba(123, 104, 238, 0.35);height: 30px;width: 877px;margin: 0px 0px 0px -15px;" > 
                    <h5 style="color: #000;margin: 0px 0px 10px 10px;">
                    Recent Order</h5>
               </div>
                
                <div style="margin-top: 30px;">
                    <p style="color:#55c0db">Recent Order</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Title</th>
                                <th>Sku</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr></tr>
                          <?php  $data = $authobj->singleOrderDetail($_SESSION['user_id']);

                           ?>
                           
                            <tr>
                                 <td><?php echo $data[0]['ord'];?></td>
                                 <td><?php echo $data[0]['title'];?></td>
                                 <td><?php echo $data[0]['sku'];?></td>
                                 <td><?php echo $data[0]['op_date'];?></td>
                                 <td><?php echo $data[0]['op_time'];?></td>
                                 <td><?php echo $data[0]['total_price'];?></td>
                                 <td><?php echo $data[0]['total_quantity'];?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <hr>
                <div style="margin-top: 10px;"> 
                     <p style="color:#55c0db">Order Product Detail</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Extra Price</th>
                                <th>Qty</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cartprd = new CartHandler();
                            for ($i = 0; $i < count($productId); $i++) {
                                $cartID = $productId[$i]['id'];
                                $cartInfo = $cartprd->cartProductsInformation($cartID, $_SESSION['user_id']);
                                ?>      

                                <tr>
                                    <td data-title="SKU" class="fw_light">
                                        <?php echo $cartInfo['sku']; ?>
                                    </td>
                                    <td data-title="Product Name">
                                        <h6 class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></h6>
                                        <p class="fw_light"><?php echo substr($cartInfo['short_description'], 0, 25); ?></p>
                                    </td>
                                    <td data-title="Image" class="color_dark">
                                        <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height: 50px;width: 50px;">
                                    </td>
                                    <td data-title="Price" class="color_dark">
                                        <?php echo '$' . $cartInfo['price']; ?>
                                    </td>
                                    <td data-title="Extra Price" class="color_dark">
                                        <?php echo '$' . $cartInfo['extra_price']; ?>
                                    </td>
                                    <td data-title="Qty" class="fw_light">
                                        <?php echo $cartInfo['quantity']; ?>
                                    </td>
                                     <td data-title="total" class="fw_light">
                                        <?php echo '$' . $cartInfo['cart_price']; ?>
                                    </td>


                                </tr>

                            <?php }
                            ?>

                        </tbody>
                    </table>

                </div>


            </section>
        </div>
        <!--banners-->
    </div>
</div>

<?php
include 'footer.php';
?>
