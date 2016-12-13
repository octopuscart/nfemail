<?php
include 'header.php';
include '../producthandler/productHandler.php';
?>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="background: black;padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container" style="margin-top:-18px">
        <p style="color:white;margin-top: 10px;font-size:20px">Cart List</p>
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
        <center >Please Login For Purchasing Products</center>
        <div style="clear:both"></div>
        
    <div class="container">
       
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_70 m_xs_bottom_30" style="margin-bottom:0px">
                <div class="panel panel-default" style="width:80%;margin-left: 100px;margin-top: -20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-list"></i><b> Your Cart List</b></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table test" style="color:black">
                            <thead>
                                <tr style="font-size:14px">
                                    <th style=""><b>S. No.</b></th>
                                    <th style="width:"><b>Product Information</b></th>
                                    <th style="width:"><b>SKU</b></th>
                                    <th style="width:"><b>Item Tag</b></th>
                                    <th style="width:"><b>Qty.</b></th>
                                    <th style="width:"><b>Date/Time</b></th>
                                    <th style="width:"><b>Net Price</b></th>
                                    <th style="width:"><b>Availability</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $productListArray = [];
                                $catobj = new CategoryHandler();
                                $productList = $_SESSION['cart'];
                                //print_r($_SESSION['cart']);
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
                                               
                                            </div>

                                        </td>
                                        <td> <?php echo $productInfo['sku']; ?></td>
                                        <td><?php echo $productInfo['tag_name']; ?></td>
                                        <td><?php echo $productInfo['quantity'] ; ?></td>
                                        <td><?php echo $productInfo['date_time'] ?></td>
                                        <td><?php echo '$' . number_format($productInfo['price'],2,'.','') ?></td>
                                        <td>In stock</td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--banners-->
    </div>
</div>

<?php
include 'footer.php';
?>

left join nfw_product_subcategory as sbnptcs on sbnptcs.product_id = np.id

select id, color, title, product_speciality, price, sale_price, image1, image2, sort_type from (SELECT distinct np.id as id, ( SELECT group_concat(snc.id, snc.color_code) FROM nfw_color as snc left join nfw_product_color as snpc on snpc.nfw_color_id = snc.id where snpc.nfw_product_id = np.id ) as color, np.title as title, np.product_speciality as product_speciality, ntc.price as price, ntc.sale_price, if(ntc.sale_price, ntc.sale_price, ntc.price) as price_r, IFNULL( (select concat('http://costcointernational.com/nfw/small/', image) as image from nfw_product_images where nfw_product_id = np.id order by display_priority desc limit 0, 1), '../assets/images/img2.png' ) as image1, IFNULL( (select concat('http://costcointernational.com/nfw/small/', image) as image from nfw_product_images where nfw_product_id = np.id order by display_priority desc limit 1, 1), '../assets/images/img2.png' ) as image2 , '' as sort_type FROM nfw_product as np join nfw_product_color as npc on np.id = npc.nfw_product_id join nfw_color as nc on npc.nfw_color_id = nc.id left join nfw_product_search_tag_connection as nptcs on nptcs.product_id = np.id left join nfw_product_subcategory as sbnptcs on sbnptcs.product_id = np.id left join nfw_fabric as nf on nf.id = np.fabric_title join nfw_product_tag_connection as ntc on ntc.product_id = np.id where (np.product_category in (52) or np.product_category in (select group_concat(category_id) from nfw_product_subcategory)) and ntc.tag_id = 1 ) as dc group by id order by sort_type desc 