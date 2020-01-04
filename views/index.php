<?php
include 'header.php';
include '../producthandler/productHandler.php';
$catobj = new CategoryHandler();
$_SESSION['carts'] = array();
?>
<!--revolution slider-->
<link rel="stylesheet" href="./custom_form_view/static/animate/animate.min.css" />
<section class="relative w_full m_bottom_15">
    <div class="r_slider">
        <ul>
            <!--
            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web19_21.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>         </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>    </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>
            -->




            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web10.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>         </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>    </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>



            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web13.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web21.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="left" data-y="109" data-speed="700" data-start="1500">
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small'>New</p>
                    <h1 class='fw_ex_light color_light slider_title_3 tt_uppercase m_bottom_10 m_sm_bottom_0' style="color: #1FB8C6 !important;">Arrivals</h1>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'>Meticulous hand tailoring, and quality <br>
                        that is becoming harder and harder to find.</p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web22.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>



            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web12.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/slide_04.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>The biggest</h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>Sale</p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>Nita Fashions carry over 11,000 fabrics</b></p>

                </div>

            </li>




            <li data-transition="fade" data-slotamount="10">
                <img src="../assets/images/web23.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


        </ul>
    </div>
</section>
<!--content-->
<section class="section_offset" style="padding-bottom: 50px;padding-top: 50px;">
    <div class="container frontpagecontainer" style="margin-top: -50px;">
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;margin-bottom: 18px;">Featured Products <?php echo date('Y');?></h3>

        <!--
        
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;margin-bottom: 18px;">Top 10 Sea Island Cotton Shirt Fabrics of 2019</h3>
        -->

        <div class="relative m_bottom_70 m_xs_bottom_30" style="margin-bottom: 50px;">

            <div class="row">

                <div class="owl-carousel t_xs_align_c featured_products" data-nav="fproducts_nav_" data-plugin-options='{"singleItem":false,"itemsCustom":[[992,5],[768,3],[600,2],[10,2]]}'>
                    <?php
                    $productList = $catobj->featuredProductList();
                    //print_r($productList);
                    for ($i = 0; $i < count($productList); $i++) {
                        // print_r($i);
                        $result = $catobj->featurProductTag($productList[$i]['nfw_product_id']);
                        //print_r($result);
                        for ($k = 0; $k < count($result); $k++) {

                            $prdobj = new ProductHandler($result[$k]['product_id'], $result[$k]['tag_id']);
                            $productInfo = $prdobj->productInformation();
                            //print_r($productInfo);
                            $productDaulImage = $prdobj->productImage();
                            $productDualImage = $productDaulImage['dualImages'];
                            ?>
                            <!--product-->
                            <figure class="fp_item t_align_c d_xs_inline_b col-lg-12 col-md-12 col-sm-12 animated" data-appear-animation="bounceIn" style="   ">
                                <a href="shop_product.php?product_id=<?php echo $result[$k]['product_id']; ?>&item_type=<?php echo $result[$k]['tag_id'] ?>">
                                    <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c animated productimagesfrontpage">
                                        <!--images container-->

                                        <div class="fp_images relative">
                                            <img src="<?php echo $productDualImage[0]['image']; ?>" alt="" class="tr_all" style ="width: 250px">
                                            <img src="<?php echo $productDualImage[1]['image']; ?>" alt="" class="tr_all"style ="width: 250px">

                                        </div>
                                        <!--labels-->

                                        <div class="labels_container">
                                            <a href="#" class="d_block label color_scheme hideonmobile tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                                        </div>
                                    </div>
                                </a>
                                <figcaption>
        <!--                                    <input type="text" name="item_type" value="<?php echo $result[$k]['tag_id'] ?>" >-->
                                    <h6 class="m_bottom_5"><a href="shop_product.php?product_id=<?php echo $result[$k]['product_id']; ?>&item_type=<?php echo $result[$k]['tag_id'] ?>" class="color_dark"><?php echo $productInfo['title']; ?></a></h6>
                                    <a href="shop_product.php?product_id=<?php echo $result[$k]['product_id']; ?>" class="fs_medium color_grey d_inline_b m_bottom_3 textoverflow" title="<?php echo $productInfo['product_speciality']; ?>">
                                        <i><?php
                                            $prdsplt = $productInfo['product_speciality'];
                                            $cck = strlen($prdsplt);
                                            if ($cck > 30) {

                                                $prdsplt = substr($prdsplt, 0, 30) . "...";
                                            } else {
                                                $prdsplt = $prdsplt;
                                            }

                                            echo $prdsplt;
                                            ?></i>
                                    </a>
                                    <div class="im_half_container m_bottom_10 hideonmobile">
                                        <p class="color_dark  half_column  t_align_c tr_all animate_fctl fp_price with_ie"><?php echo $result[$k]['tag_title']; ?> - <?php echo '$' . $result[$k]['price']; ?></p>	
                                        <div class="half_column d_inline_m t_align_r tr_all animate_fctr with_ie hideonmobile">
                                            <ul class="rating_list d_inline_m hr_list tr_all">
                                                <li class="relative active lh_ex_small">
                                                    <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                    <i class="icon-star-1 color_yellow tr_all"></i>
                                                </li>
                                                <li class="relative active lh_ex_small">
                                                    <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                    <i class="icon-star-1 color_yellow tr_all"></i>
                                                </li>
                                                <li class="relative active lh_ex_small">
                                                    <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                    <i class="icon-star-1 color_yellow tr_all"></i>
                                                </li>
                                                <li class="relative active lh_ex_small">
                                                    <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                    <i class="icon-star-1 color_yellow tr_all"></i>
                                                </li>
                                                <li class="relative lh_ex_small">
                                                    <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                    <i class="icon-star-1 color_yellow tr_all"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix hideonmobile">
                                        <div class=" w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                                            <button class="btn btn-default add_to_cart_button" price="<?php echo $result[$k]['price'] ?>" item_type="<?php echo $result[$k]['tag_id']; ?>" cartaddid="<?php echo $result[$k]['product_id']; ?>"  
                                                    style="font-size: 12px;
                                                    height: 26px;
                                                    padding: 0px 6px;
                                                    width: 118px;">
                                                <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                            </button>
                                        </div>
                                        <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie ">
                                            <?php if (isset($_SESSION['user_id'])) { ?>
                                                <a href="#" class="button_type_6 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_pink r_corners vc_child tr_all color_purple_hover tr_all t_align_c m_right_5 m_md_right_0 add_to_cart_button "  item_type="<?php echo $result[$k]['tag_id']; ?>"  wishlistaddid="<?php echo $result[$k]['product_id']; ?>"  style="font-size: 12px;
                                                   height: 26px;
                                                   padding: 0px 6px;
                                                   width: 40px;"><i class="icon-heart d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Wishlist</span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>




                                    
                                    <div class="clearfix showonmobile">
                                        <div class="">
                                            <button class="btn btn-default add_to_cart_button" price="<?php echo $result[$k]['price'] ?>" item_type="<?php echo $result[$k]['tag_id']; ?>" cartaddid="<?php echo $result[$k]['product_id']; ?>"  
                                                    style="font-size: 12px;
                                                    height: 26px;
                                                    padding: 0px 6px;
                                                    width: 118px;">
                                                <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                            </button>
                                        </div>
                                        <div class="">
                                          
                                        </div>
                                    </div>


                                </figcaption>
                            </figure>


                            <?php
                        }
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
        <!--banners-->
        <section class="row t_xs_align_c">
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_30" data-appear-animation="fadeInUp">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_1.jpg" alt=""  width="371" height="141"></a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_30" data-appear-animation="fadeInUp" data-appear-animation-delay="200">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_2.jpg" alt=""  width="371" height="141"></a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_0" data-appear-animation="fadeInUp" data-appear-animation-delay="400">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_4.jpg" alt=""  width="371" height="141"></a>
            </div>
        </section>
    </div>
</section>

<section class="section_offset" style="padding:0px;margin-top: -40px;">
    <div class="container">

        <h3 class="color_dark fw_light m_bottom_15 t_align_c" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;">Labels We Carry</h3>
        <!--<p class="m_bottom_35 t_align_c" data-appear-animation="bounceInLeft" data-appear-animation-delay="200" style="margin-bottom: 15px;">Nita Fashions is having Numerous Brands.</p>-->
        <div class="relative" data-appear-animation="bounceInLeft" data-appear-animation-delay="400">
            <div class="t_xs_align_c">
                <div class="owl-carousel clients brands t_align_c" data-plugin-options='{"pagination":true,"transitionStyle" : "backSlide"}' data-nav="c_nav_">
                    <!--item-->
                    <div>
                        <div class="row">

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/ThomasMasonShort-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/1_4-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>   
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/1_5-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/1_6-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/1_Holland-Sherry2-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="../assets/images/images/client_logo_9-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                   


                </div>
            </div>

        </div>
    </div>
</section>



<!--footer-->

<?php
include 'footer.php';
?>