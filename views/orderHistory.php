<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
$allCartId = $authobj->allauthCartId($_SESSION['user_id']);
?>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
         padding-bottom: 0px;
         background: url('../assets/images/cartbg2.jpg');
         box-shadow: 0px 3px 7px -1px #DBDADA; ">
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
                        Order History</h5>
                </div>
                <div  style="margin-top: 30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Order No</th>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Extra Price</th>
                                <th>Qty</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                            for ($i = 0; $i < count($allCartId); $i++) {
                                $cartInfo = $allCartId[$i];
                                $stat = $authobj->orderStatus($cartInfo['id']);
                                ?>      

                                <tr class="tr_delay">
                                    <td><?php echo $i + 1 ?></td>
                                    <td data-title="id" class="fw_light">
                                        <?php echo $cartInfo['id']; ?>
                                    </td>
                                    <td data-title="id" class="fw_light">
                                        <?php echo $cartInfo['title']; ?>
                                    </td>
                                    <td data-title="id" class="fw_light">
                                        <?php echo $cartInfo['sku']; ?>
                                    </td>
                                    <td data-title="op_date" class="fw_light">
                                        <?php echo $cartInfo['op_date']; ?>
                                    </td>
                                    <td data-title="op_time">
                                        <?php echo $cartInfo['op_time']; ?>

                                    </td>

                                    <td data-title="Price" class="color_dark">
                                        <?php echo '$' . $cartInfo['price']; ?>
                                    </td>

                                    <td data-title="Price" class="color_dark">

                                        <?php
                                        if ($cartInfo['extra_price']) {
                                            echo '$' . $cartInfo['extra_price'];
                                        } else {
                                            echo 0;
                                        }
                                        ?>

                                    </td>
                                    <td data-title="quantity" class="color_dark">
                                        <?php echo $cartInfo['total_quantity']; ?>
                                    </td>
                                    <td data-title="Price" class="color_dark">
                                        <?php echo $cartInfo['total_price']; ?>
                                    </td>
                                    <td data-title="status" class="color_dark">
                                        <?php echo $stat[0]['title']; ?>
                                    </td>

                                </tr>
                                
                            <?php 
                               $tot = explode('$', $cartInfo['total_price']);
                               $total = $total +  $tot[1];
                                        }
                            
                           
                            ?>
                                <tr class="bg_light_2">
                                    <td colspan="9" class="v_align_m">
                                        <div class="d_table w_full">
                                            <div class="col-lg-9 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">

                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_pink t_xs_align_c">
                                                Total:		
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" class="fw_ex_bold color_pink v_align_m">
                                        <?php echo '$'.$total;?>
                                    </td>
                                </tr>

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
