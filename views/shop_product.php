<?php
include 'header.php';
//include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';

$id = $_REQUEST['product_id'];
$tag_id = $_REQUEST['item_type'];
if ($tag_id == '') {
    $query = "SELECT * FROM nfw_product_tag_connection where product_id = '$id' order by tag_id";
    $tagdata = resultAssociate($query);
    if (count($tagdata)) {
        $tag_id = $tagdata[0]['tag_id'];
        $tag_idg = $tag_id;
        header("location:shop_product.php?product_id=$id&item_type=" . $tag_idg);
    }
}


$prdobj = new ProductHandler($id, $tag_id);
$productInfo = $prdobj->productInformation();
//print_r($productInfo);
$colors = $prdobj->productColor();
//print_r($colors);
$catobj = new CategoryHandler();

$productDualImage = $prdobj->productImage();
$productDualImage = $productDualImage['allImages'];
$relatedProduct = $prdobj->relatedProductId();
$productList = $relatedProduct;
?>
<style>
    .testTable td{
        border: none;

    }
    .hr_clss {
        height: 0px !important;

    }
    .section_offset {
        padding: 37px 0 67px;
    }
    .m_bottom_70 {
        margin-bottom: 14px;
    }
    .flex-direction-nav{
        margin-top: 16px !important;
    }
    .color_button {
        border: 1px solid #bec3c7;
        width: 26px;
        height: 26px;
        padding: 1px;
    }
    span.cut_price {
        text-decoration: line-through;
        color: #A5A1A1;
        padding-right: 10px;
    }
</style>
<style>
    .page_navigation{float: right;}
    .page_navigation a {
        height: 10px;
        padding: 6px;
        margin: 1px;
        border: 1px solid #CFCFCF;
    }
    .active_page{
        background: #000000;
        color: #fff; 
    }
    .fabric_color_list{
        width: 22px;
        margin-top: -33px;
        z-index: 9999999999;
        /* margin-left: 3px; */
        position: absolute;
        margin-top: -12px;
        padding: 0px;
        border: 1px solid #B3B3B3;
    }
    .fabric_color_list_button{
        margin-top: 0px !important;;
        float: left;
        margin-left: 4px;
        height: 10px;
        width: 20px;
        margin-bottom: 0px;
    }
    .color_button {
        border: 1px solid #000;
    }

    .color_button_check {
        border: 1px solid #000;
        height: 26px;
        margin-bottom: 4px;
        float: left;
        width: 35px!important;
        padding-left: 0px;
    }
    input[type="checkbox"] + label:before {
        content: '';
        font-family: "fontello";
        display: block;
        position: absolute;
        background: rgba(0, 0, 0, 0);
        top: 0;
        left: 5px;
        width: 22px;
        height: 23px;
        border: 0px solid #cc0000;
        -webkit-border-radius: 0%; 
        -moz-border-radius: 0%;
        border-radius:0%; 
    }
    input[type="checkbox"] + label:after {
        content: '\e914';
        font-family: "fontello";
        position: absolute;
        left: 6px;
        top: -1px;
        display: none;
        color: #797474;
    }

    .color_list input[type="checkbox"] + label {
        width: auto !important;
        position: relative;
        padding-left: 18px;
        cursor: pointer;
        /* padding-bottom: 10px; */
    }

    span.sale_price {
        margin-left: 15px;
    }
    span.cut_price {
        text-decoration: line-through;
        color:#A5A1A1;
    }


</style>
<?php
$largeImage = $productDualImage[0]['image'];
$largeImage = str_replace("small", "large", $largeImage);
?>
<!--page title-->
<!--page title-->
<link rel="stylesheet" href="./custom_form_view/static/animate/animate.min.css" />
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style=" padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <?php
            $id = $_REQUEST['item_type'];
            $query = "select tag_title from nfw_product_tag where id = $id";
            $res = resultAssociate($query);
            ?>
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important" >
                <a href="index.php" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-home-1"></i>&nbsp;&nbsp;Home&nbsp;&nbsp;<i class="icon-angle-right d_inline_m color_white fs_small"></i>&nbsp;&nbsp;&nbsp;
                </a>
            </li>
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important" >
                <a href="product_list.php?category=0&item_type=<?php echo $_REQUEST['item_type']; ?>" class="" style="margin-right:0px !important;color:white;">
                    <?php echo $res[0]['tag_title']; ?>&nbsp;&nbsp;
                </a>
            </li>
            <?php
            $cat_id = $catobj->productCategory($_REQUEST['product_id']);
            $parents = $catobj->get_parent($cat_id[0]['product_category']);
            $parentArray = explode(',', $parents);
            for ($i = 0; $i < count($parentArray); $i++) {
                $res = mysql_query("select name from nfw_category where id = $parentArray[$i] ");
                $row = mysql_fetch_array($res);
                ?>
                <li class="m_right_8 f_xs_none" style="margin-right:0px !important" >
                    <a class="color_default d_inline_m m_right_10"   style="margin-right:0px !important;color:white;" href="product_list.php?category=<?php echo $parentArray[$i]; ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" >
                        <?php echo $row['name']; ?>
                        <?php
                        if (($i + 1) === count($parentArray)) {
                            
                        } else {
                            ?>
                            &nbsp;&nbsp;<i class="icon-angle-right d_inline_m color_white fs_small"></i>&nbsp;&nbsp;
                        <?php } ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>
</section>
<!--content-->
<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <section class="col-lg-10 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30">
                <div class="clearfix m_bottom_45 m_xs_bottom_30">
                    <div class="f_left product_view f_sm_none m_sm_bottom_30">
                        <div class="clearfix">
                            <div class="thumbnails_carousel t_align_c f_left m_right_20">
                                <ul id="thumbnails">
                                    <li>
                                        <?php
                                        for ($i = 0; $i < count($productDualImage); $i++) {
                                            $img = $productDualImage[$i];
                                            $img = $img['image'];
                                            $largeImg = str_replace("small", "large", $img);

                                            $img = str_replace("small", "smaller", $img);
                                            ?>
                                            <a href="#" data-zoom-image="<?php echo $largeImg; ?>" data-image="<?php echo $largeImg; ?>" class="active d_block wrapper r_corners tr_all translucent m_bottom_10"><img src="<?php echo $img; ?>" alt="" class="r_corners" style="    height: 100px;width: 80px;"></a>

                                        <?php } ?>
                                    </li>
                                </ul>
                                <!---->
                                <div class="helper-list"></div>
                            </div>
                            <div class="wrapper r_corners container_zoom_image relative">
                                <img id="img_zoom" src="<?php echo $largeImage; ?>" data-zoom-image="<?php echo $largeImage; ?>" alt="">
                                <div class="labels_container">
<!--                                    <a href="#" class="d_block label color_pink color_pink_hover tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">Sale</span></a>-->
                                </div>
                            </div>
                            <!--                            <a href="#" class="open_product f_right button_type_6 d_block r_corners tr_all t_align_c">
                                                            <i class="icon-resize-full"></i>
                                                        </a>-->
                        </div>
                        <!--share buttons-->

                    </div>
                    <div class="f_right product_info f_sm_none w_sm_full">
                        <div class="clearfix m_bottom_15">
                            <a class="reviews fs_medium f_left color_dark tr_all lh_ex_small" href="#">
                                <h4 style="color:black"><?php echo $productInfo['title']; ?></h4>
                            </a>
                        </div>

                        <hr class="hr_clss">
                        <p class="color_grey fs_medium m_bottom_15">
                            <?php echo $productInfo['short_description']; ?>
                        </p>
                        <hr class="hr_clss">
                        <table class="fw_light table_type_9 m_bottom_15">
                            <tr>
                                <td>Category</td>

                                <td><?php echo $productInfo['category_title']; ?></td>
                            </tr>
                            <tr>

                                <td>
                                    SKU
                                </td>

                                <td class="color_dark">
                                    <?php echo $productInfo['sku']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Feature</td>

                                <td><?php echo $productInfo['product_speciality']; ?></td>
                            </tr>
                            <tr class="color_dark" style="font-weight: initial;font-weight: initial;
                                padding-top: 15px;
                                height: 0px;
                                line-height: 72px;
                                /* font-size: 25px; */
                                font-size: 1.375em;">
                                <td>
                                    Price
                                </td>

                                <td>
                                    <?php $tag_name = $catobj->productTag($_REQUEST['item_type']);
                                    ?>
                                    <span class="color_dark">
                                        <?php
                                        if ($productInfo['sale_price']) {
                                            echo '<span class="cut_price">$' . $productInfo['rprice'] . "</span>$" . $productInfo['sale_price'];
                                        } else {
                                            echo '$' . $productInfo['price'];
                                        }
                                        ?> 

                                        <small style="font-weight: 300;margin-left: 10px;font-size:15px"><b>(For <?php echo $tag_name[0]['tag_title']; ?>)</b></small>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <hr class="hr_clss">
                        <table class="fw_light table_type_9 m_bottom_20">

                            <tr>
                                <td class="v_align_m">
                                    Color
                                </td>
                                <td class="color_dark">
                                    <ul class="hr_list m_top_10 m_bottom_12">
                                        <?php
                                        //print_r($colors);
                                        for ($i = 0; $i < count($colors); $i++) {
                                            $value = $colors[$i];
                                            ?>  
                                            <li class="m_right_10 m_sm_bottom_5">
                                                <button class="color_button tr_delay  bg_color_dark circle radio m_bottom_5" value="<?php echo $value['id']; ?>" style="background:<?php echo $value['color_code']; ?>;margin-top:auto"></button>
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </td>
                            </tr>

                        </table>
                        <hr class="hr_clss">
                        <a href="#" class="button_type_6 m_mxs_bottom_5 d_inline_b m_right_2 tt_uppercase color_pink r_corners vc_child tr_all add_to_cart_button" cartaddid="<?php echo $productInfo['id']; ?>"  item_type="<?php echo $_REQUEST['item_type']; ?>">
                            <span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"> </i>
                                <span class="fs_medium">Add to Cart</span>

                            </span>
                        </a>
                        <a href="#" class="button_type_6 m_mxs_bottom_5 d_inline_b m_right_2 tooltip_container m_right_2 color_pink relative v_align_b d_inline_b f_md_none d_md_inline_b d_block  r_corners vc_child tr_all color_purple_hover tr_all t_align_c add_to_cart_button" wishlistaddid="<?php echo $productInfo['id']; ?>"  item_type="<?php echo $_REQUEST['item_type']; ?>">
                            <i class="icon-heart d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Wishlist</span>
                        </a>

                    </div>
                </div>


            </section>
            <?php
            if ($productList[0]['nfw_product_id']) {
                $result = $catobj->relatedProductTag($productList[0]['nfw_product_id']);
                if ($result) {
                    ?>
                    <aside class="col-lg-2 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30">
                        <!--bestsellers-->


                        <!--related products-->
                        <div class="m_bottom_50 m_xs_bottom_30">
                            <!--title & nav-->
                            <div class="clearfix m_bottom_25 m_xs_bottom_20">
                                <h5 class="fw_light f_left f_sm_none f_xs_left color_dark m_sm_bottom_5 m_xs_bottom_0">Related Products</h5><br>

                            </div>
                            <div class="owl-carousel t_xs_align_c" data-plugin-options='{"transitionStyle":"backSlide","autoPlay" : true}' data-nav="specials_">
                                <?php
                                for ($i = 0; $i < count($productList); $i++) {
                                    $product_id = $productList[$i]['nfw_product_id'];
                                    //print_r($product_id);
                                    $result = $catobj->relatedProductTag($productList[$i]['nfw_product_id']);
                                    //print_r($result);
                                    for ($k = 0; $k < count($result); $k++) {

                                        $prdobj = new ProductHandler($result[$k]['product_id'], $result[$k]['tag_id']);
                                        $productInfo3 = $prdobj->productInformation();
                                        //print_r($productInfo);
                                        $productDaulImage = $prdobj->productImage();
                                        $productDualImage = $productDaulImage['dualImages'];
                                        ?>
                                        <!--product-->
                                        <figure class="fp_item t_align_c d_xs_inline_b">
                                            <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23">
                                                <!--images container-->
                                                <div class="fp_images relative" style="height:200px">
                                                    <a href="shop_product.php?product_id=<?php echo $result[$k]['product_id']; ?>&item_type=<?php echo $result[$k]['tag_id']; ?>">
                                                        <img src="<?php echo $productDualImage[0]['image']; ?>" alt="" class="tr_all" style ="height:270px; width: 270px">
                                                        <img src="<?php echo $productDualImage[1]['image']; ?>" alt="" class="tr_all"style ="height:270px; width: 270px">
                                                    </a>
                                                </div>
                                                <!--labels-->

                                            </div>
                                            <figcaption>
                                                <h6 class=""><a href="shop_product.php?product_id=<?php echo $result[$k]['product_id']; ?>&item_type=<?php echo $result[$k]['tag_id']; ?>" class="color_dark"><?php echo $productInfo3['title']; ?> </a></h6>
                                                <i><?php echo $productInfo3['product_speciality']; ?></i>                       
                                                <div class="">
                                                    <p>
                                                    <div class="price_pd im_half_container m_bottom_10 ng-binding">
                                                        <!-- ngIf: product.sale_price != 0 -->
                                                        <?php
                                                        if( $result[$k]['sale_price'] != 0 ){
                                                        ?>
                                                        <span  class="cut_price ">
                                                            <?php echo 'US$ ' . $result[$k]['m_price']; ?> 
                                                        </span>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php echo 'US$ ' . $result[$k]['price']; ?> 
                                                    </div>


                                                    </p>		

                                                </div>
                                                <div class="t_align_c">
                                                    <button class="btn btn-default add_to_cart_button" price="<?php echo $result[$k]['price'] ?>" item_type="<?php echo $result[$k]['tag_id']; ?>" cartaddid="<?php echo $result[$k]['product_id']; ?>"  
                                                            style="font-size: 12px;
                                                            height: 26px;
                                                            padding: 0px 6px;
                                                            width: 118px;">
                                                        <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                                    </button>

                                                </div>
                                            </figcaption>
                                        </figure>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>


                    </aside>
                    <hr class="hr_clss">
                    <?php
                }
            }
            ?>


            <div class="col-md-12">
                <div class="tabs m_bottom_40 m_xs_bottom_30">
                    <!--tabs nav-->
                    <ul class="tabs_nav hr_list d_inline_b d_xs_block m_bottom_23 m_xs_bottom_20">
                        <li class="f_xs_none"><a href="#tab-1" class="color_dark d_block n_sc_hover tr_all_medium">Description</a></li>

                    </ul>
                    <!--tabs content-->
                    <div id="tab-1">
                        <p>
                            <?php echo $productInfo['description']; ?>
                        </p>

                    </div>
                </div>
                <!--title & nav-->
                <hr class="hr_clss">
                <section class="section_offset" style="padding: 0px;">
                    <div class="container">
                        <p class="fw_light color_dark m_bottom_35 t_align_l" data-appear-animation="bounceInLeft" style="font-weight:normal;color: black;font-size: 18px;margin-left: -14px;">Product Can Customize With</p>
                        <div class="relative m_bottom_70 m_xs_bottom_30">
                            <div class="row">
                                <div class="owl-carousel t_xs_align_c featured_products" data-nav="fproducts_nav_" data-plugin-options='{"singleItem":false,"itemsCustom":[[992,4],[768,3],[600,2],[10,1]]}'>
                                    <!--product-->
                                    <?php
                                    $data = $catobj->productTagDetail($_REQUEST['product_id']);
                                    for ($i = 0; $i < count($data); $i++) {
                                        $res = $data[$i];
                                        ?>
                                        <figure class="fp_item t_align_c d_xs_inline_b col-lg-12 col-md-12 col-sm-12" data-appear-animation="bounceIn">

                                            <a href="shop_product.php?product_id=<?php echo $_REQUEST['product_id']; ?>&item_type=<?php echo $res['tag_id']; ?>" class="r_corners category_link w_xs_auto d_xs_inline_b f_xs_none m_xs_bottom_15 d_block f_left wrapper m_right_10 t_align_c" style='    border: 1px solid #000;'>
                                                <img src="custom_form_view/background_new_custom/<?php echo $res['tag_id']; ?>.jpg" alt="" style ="height:270px; width: 270px">
                                                <p class="category_title bg_light_2 tr_all color_dark">

                                                    <?php echo $res['tag_title']; ?><br/>

                                                    <?php
                                                    if ($res['sale_price']) {
                                                        echo '<span class="cut_price">$' . $res['price'] . "</span>$" . $res['sale_price'];
                                                    } else {
                                                        echo '$' . $res['price'];
                                                    }
                                                    ?> 

                                                </p>
                                            </a>

                                        </figure>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--carousel nav-->
                            <button class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_prev d_md_none" data-appear-animation="fadeIn">
                                <i class="icon-left-open-big"></i>
                            </button>
                            <button class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_next d_md_none" data-appear-animation="fadeIn">
                                <i class="icon-right-open-big"></i>
                            </button>
                        </div>
                    </div>
                </section>
                <!--title & nav-->

            </div>




        </div>

    </div>
</div>

<!--footer-->
<?php
include 'footer.php';
?>