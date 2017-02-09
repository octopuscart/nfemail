<?php
include 'header.php';
include './defaultproductimage.php';
$item_type = $_REQUEST['item_type'];
if (isset($_REQUEST['category'])) {
    $defaultProduct = $defaultProductImage;
} else {
    $item_type = $_REQUEST['item_type'];
    header("location:product_list.php?category=0&item_type=" . $item_type);
}

if (isset($_REQUEST['colors'])) {
    $colorsession = $_REQUEST['colors'];



    if (1) {
        $sessioncolor = $_SESSION['colorlist'];
        foreach ($colorsession as $key => $value) {

            if (in_array($value, $sessioncolor)) {
                
            } else {
                array_push($_SESSION['colorlist'], $value);
            }
        }
        foreach ($_SESSION['colorlist'] as $key => $value) {
            if (in_array($value, $colorsession)) {
                
            } else {

                $keyind = array_search($value, $_SESSION['colorlist']);

                unset($_SESSION['colorlist'][$keyind]);
            }
        }
    }
} else {
    $_SESSION['colorlist'] = array();
}

include '../producthandler/productHandler.php';
$catobj = new CategoryHandler();
$pricelist = array();
if (isset($_REQUEST['category'])) {
    ?>
    <!--animate css-->
    <link rel="stylesheet" href="./custom_form_view/static/animate/animate.min.css" />





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
            color: #fff !important; 
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
            margin-right: 4px;
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
            color: #FFFFFF;
            text-shadow: 0px 0px 3px #000;
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
        span.filtercolor {
            height: 20px;
            width: 20px;
            float: left;
            margin-left: 4px;
            border: 1px solid rgba(0, 0, 0, 0.15);
        }
        .removecolor {
            margin-top: 1px;
            margin-left: 3px;
            cursor: pointer;
            color: #FFF;
            text-shadow: 0px 1px 1px #000;
        }
        .waves-effect{
            display: inherit;
        }
    </style>
    <!--start of template-->
    <div ng-controller="ProductListController" id="ProductListControllerId">



        <!--end of template-->

        <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
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
                        <a href="product_list_v1.php?category=0&item_type=<?php echo $_REQUEST['item_type']; ?>" class="" style="margin-right:0px !important;color:white;">
                            <?php echo $res[0]['tag_title']; ?>&nbsp;&nbsp;
                        </a>
                    </li>
                    <?php
                    $parents = $catobj->get_parent($_REQUEST['category']);
                    $parentArray = explode(',', $parents);
                    for ($i = 0; $i < count($parentArray); $i++) {
                        $res = mysql_query("select name from nfw_category where id = $parentArray[$i] ");
                        $row = mysql_fetch_array($res);
                        ?>
                        <li class="m_right_8 f_xs_none" style="margin-right:0px !important" >
                            <a class="color_default d_inline_m m_right_10"   style="margin-right:0px !important;color:white;" href="product_list_v1.php?category=<?php echo $parentArray[$i]; ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" >
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
        <div class="section_offset" style="padding: 13px 0 67px;">
            <div class="container" style="    width: 1200px;">
                <div class="row">

                    <aside class="col-lg-2 col-md-2 col-sm-2 m_bottom_70 m_xs_bottom_30" style="width:20%">

                        <div class="m_bottom_45 m_xs_bottom_30">

                            <div class="m_bottom_40 m_xs_bottom_30">
                                <?php
                                $res = $catobj->productSubCategory($_REQUEST['category'], $_REQUEST['item_type']);

                                if ($res) {
                                    ?> 
                                    <h7 style="color: #000 !important; font-weight: 500">Product Categories</h7>
                                    <ul class="categories_list" style="font-size: 14px;">

                                        <?php
                                        //print_r($res);
                                        if ($_REQUEST['category'] == '0') {

                                            foreach ($res as $key => $value) {
                                                $cat_id = $value['id'];
                                                $tag_id = $_REQUEST['item_type'];
                                                $query = "select * from nfw_category_tag_connection where category_id = '$cat_id' and tag_id='$tag_id'";
                                                $check_category = resultAssociate($query);
                                                if (count($check_category)) {
                                                    ?>
                                                    <li>
                                                        <a href="product_list_v1.php?category=<?php echo $value['id'] ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" class="color_dark tr_all d_block">
                                                            <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                                                                <i class="icon-angle-right"></i>
                                                            </span>
                                                            <?php echo $value['name']; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            foreach ($res as $key => $value) {
                                                ?>
                                                <li>
                                                    <a href="product_list_v1.php?category=<?php echo $value['id'] ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" class="color_dark tr_all d_block">
                                                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                                                            <i class="icon-angle-right"></i>
                                                        </span>
                                                        <?php echo $value['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                <?php } else { ?>
            <!--                                <p style="font-size:12px;color:steelblue;margin-top: 7px">No Category Found</p>-->
                                <?php } ?>
                            </div>

                            <form id="filterform">
                                <!--price-->
                                <div class="m_bottom_12" style="margin-top:-17%">
                                    <p class="m_bottom_15" style="color: #000 !important; font-weight: 500">Price</p>
                                    <div id="price"><div id="price_loader">Loading...</div></div>
                                    <div class="clearfix" style="font-size:12px;color:black;">

                                        <input type="text" value=""  id="from_price" name="from_price"  class="f_left half_column first_limit color_dark fw_light d_done" style="color:black;font-size: 12px;
                                               font-weight: 700;">
                                        <input type="text" value="" id="to_price" name="to_price"  class="f_right half_column t_align_r last_limit color_dark fw_light d_done" style="color:black;font-size: 12px;
                                               font-weight: 700;">
                                    </div>
                                </div>
                                <!--colors-->

                                <div class="m_bottom_20" style="margin-top:-8%">

                                    <input type="hidden" name="color"  value="<?php echo $_REQUEST['color']; ?>">
                                    <input type="hidden" name="category"  value="<?php echo $_REQUEST['category']; ?>">
                                    <input type="hidden" name="item_type"  value="<?php echo $_REQUEST['item_type']; ?>">
                                    <input type="hidden" name="searchtag"  value="<?php echo $_REQUEST['searchtag']; ?>">



                                    <br>
                                    <p class="m_bottom_5" style="color: #000 !important; font-weight: 500">Fabric Type</p>
                                    <div class="custom_select products_filter type_2 f_xs_none m_xs_left_0 f_left m_xs_bottom_10" style="margin:1px 30px 10px 0px;">
                                        <div class="select_title r_corners color_grey fs_medium"><?php echo isset($_REQUEST['Fabric_Category']) ? $_REQUEST['Fabric_Category'] : 'All Type'; ?> </div>
                                        <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                                        <select class="target d_none" name="Fabric_Category">
                                            <?php
                                            echo $query = "SELECT fc.id, fc.title FROM nfw_fabric as fc 
    join nfw_product as np on np.fabric_title = fc.id
    where np.id in ( $productidstr ) group by fc.id";
                                            if ($productidstr) {
                                                $fabric = resultAssociate($query);
                                                echo '<option value="All Type">All Type</option>';
                                                foreach ($fabric as $key => $value) {
                                                    echo '<option value="', $value['title'], '">', $value['title'], "</option>";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <br>


                                </div>
                                <div class="m_bottom_20 clearfix">
                                    <button type="submit" id="filter" class="button_type_5 f_left m_right_5 m_sm_bottom_5 r_corners tr_all color_pink transparent fs_medium" style="display: none">Show</button>
        <!--                                <button type="reset" id="reset_filter_form" form="manufacturers_form" class="btn btn-default btn-xs" onclick=" window.location.href = 'http://192.168.3.47/nf3/frontend/views/product_list_v1.php?category=0&item_type=1'"><i class="icon-arrow">Reset</button>-->
                                </div>
                        </div>
                    </aside>

                    <section class="col-lg-10 col-md-10 col-sm-10 m_bottom_70 m_xs_bottom_30" style="width:80%;    margin-top: -25px;">
                        <!--filter-->
                        <div class="clearfix m_bottom_10">
                            <div class="col-lg-6 col-md-6 col-sm-7 m_bottom_15">
                                <p class="d_inline_m fs_medium m_right_15" style="font-size: 12px;margin: 4px 0px 0px -14px;">

                            </div>

                        </div>
                        <input type="hidden" name="page_no" value="1">
                        <input type="hidden" name="record_per_page" value="3">
                        <!--<hr class="m_bottom_10">-->

                        <div class="row">
                            <div class="custom_select products_filter type_2 f_xs_none m_xs_left_0 f_left m_left_5 m_xs_bottom_10" style="margin: -17px 0px 0px 14px;">
                                <div class="select_title sortby r_corners color_grey fs_medium">Sort By</div>
                                <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                                <select class="target d_none" name="sorting">
                                    <option value="On Sale">On Sale</option>
                                    <option value="Most Popular">Most Popular</option>
                                    <option value="New Arrival">New Arrival</option>
                                    <!--                                    <option value="Price-Asc">Price-Asc</option>
                                                                        <option value="Price-Desc">Price-Desc</option>-->
                                    <option value="Sale/Most Popular">Sale/Most Popular</option>
                                </select>
                            </div>

                            <?php
                            if (count($_SESSION['colorlist'])) {
                                ?>
                                <div class="pull-left" style="margin-top: -13px; margin-left: 30px;">

                                    <span class="pull-left" style="    margin-top: -3px;">Color: </span>
                                    <?php
                                    foreach ($_SESSION['colorlist'] as $key => $value) {
                                        echo "<span class='filtercolor' colorfiltercode='" . $value . "'><i class='fa  removecolor'></i></span>";
                                    }
                                    ?>

                                </div>
                                <?php
                            }
                            ?>

                            <span class="info_text pull-right" style="margin:-15px 20px 0px 0px;color: black;font-size: 12px"></span>
                        </div>


                        </form>
                        <?php
                        //print_r($productList);


                        if (1) {
                            ?>
                            <!--products-->

                            <div class="" ng-if="loader == 0">



                                <div ng-if="productList.length > 0" class="page_container shop_isotope_container1 t_xs_align_c three_columns m_bottom_15" data-isotope-options='{"itemSelector" : ".shop_isotope_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>

                                    <div class="page shop_isotope_item d_xs_inline_b animated appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn" style="width: 25%; float: left;" ng-repeat="product in productList" >
                                        <figure class="fp_item t_align_c d_xs_inline_b ">
                                            <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                                                <!--images container-->
                                                <a href="shop_product.php?product_id={{product.id}}&item_type=<?php echo $item_type; ?>" class='redirecturl'>
                                                    <div class="fp_images relative ">
                                                        <img src="<?php echo "$imageserver/small/" ?>{{product.image}}" alt="" class=" tr_all img1 lazy" data-original="<?php echo "$imageserver/small/" ?>{{product.image}}"  style="height:250px; width:250px;background: url(<?php echo $defaultProduct; ?>)" >
                                                        <img src="<?php echo "$imageserver/small/" ?>{{product.image}}" alt="" class=" tr_all img2 lazy" data-original="<?php echo "$imageserver/small/" ?>{{product.image}}"  style="height:250px; width:250px;background: url(<?php echo $defaultProduct; ?>)" >

                                                    </div>
                                                    <div class="fabric_color" style="">

                                                        <center class="fabric_color_list">
                                                            <button ng-repeat="color in product.color.split(',')" 
                                                                    class=" tr_delay  bg_color_dark  radio m_bottom_5 
                                                                    fabric_color_list_button" 
                                                                    value="4" 
                                                                    style="background:#{{color.split('#')[1]}};
                                                                    margin-left:0px;
                                                                    height:{{10 / (product.color.split(',').length)}}px"></button>
                                                        </center>
                                                    </div>
                                                </a>
                                                <!--labels-->
                                                <div class="labels_container" ng-switch="product.sort_type">
                                                    <a href="#" class="d_block label color_scheme 
                                                       tt_uppercase fs_ex_small circle
                                                       m_bottom_5 vc_child t_align_c product_sort_type1" 
                                                       ng-if="product.sale_price != 0">
                                                        <span class="d_inline_m " >Sale</span>
                                                    </a>
                                                    <a href="#" class="d_block label color_scheme
                                                       tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                       product_sort_type" ng-switch-when="MP">
                                                        <span class="d_inline_m " >MP</span>
                                                    </a>
                                                    <a href="#" class="d_block label color_scheme
                                                       tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                       product_sort_type" ng-switch-when="New">
                                                        <span class="d_inline_m " >NEW</span>
                                                    </a>
                                                    <div ng-switch-when="MP_SALE">
                                                        <a href="#" class="d_block label color_scheme
                                                           tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                           product_sort_type" >
                                                            <span class="d_inline_m " >MP</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <figcaption>
                                                <h6 class="m_bottom_5">
                                                    <a href="#" class="color_dark titles" style="font-size: 14px;" id="">
                                                        {{product.title}}
                                                    </a>
                                                </h6>

                                                <a href="#" class="fs_medium color_grey d_inline_b m_bottom_3"> 
                                                    <i class="product_speciality" data-toggle="tooltip" data-placement="center" title="{{product.product_speciality}}">
                                                        {{product.product_speciality|limitTo:25}} {{product.product_speciality.length>25?'...':''}}
                                                    </i>
                                                </a>
                                                <div class="price_pd im_half_container m_bottom_10">
                                                    <span ng-if="product.sale_price != 0" class="cut_price">US$ {{product.price}}</span>US$ {{product.price_r}}
                                                    <!--                                                <div class="half_column d_sm_block w_sm_full d_xs_inline_m w_xs_half_column t_sm_align_c t_xs_align_r d_inline_m t_align_r tr_all animate_fctr with_ie">
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
                                                                                                        <a href="#" class="d_none reviews fs_medium color_dark m_left_5 tr_all">2 Review(s)</a>
                                                                                                    </div>-->
                                                </div>

                                                <div class="clearfix fp_buttons">
                                                    <div class="half_column w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                                                        <button class="button_wave btn btn-default add_to_cart_button" price="150" item_type="<?php echo $_REQUEST['item_type']; ?>" cartaddid="{{product.id}}" style="font-size: 12px;
                                                                height: 26px;    color: #000;
                                                                padding: 0px 6px;
                                                                width: 118px;">
                                                            <span class="d_inline_m clerarfix">
                                                                <i class="icon-basket f_left m_right_10 fs_large" style="line-height: 18px;"></i>
                                                                <span class="fs_medium" style="line-height:19px">
                                                                    Add to Cart</span></span></button>
                                                    </div>
                                                    <?php
                                                    if (isset($_SESSION['user_id'])) {
                                                        ?>
                                                        <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie">
                                                            <button class="button_wave button_type_6 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_pink r_corners vc_child tr_all color_purple_hover tr_all t_align_c m_right_5 m_md_right_0 add_to_cart_button" wishlistaddid="{{product.id}}" style="font-size: 12px;
                                                                    height: 26px;
                                                                    padding: 0px 6px;
                                                                    width: 40px;"><i class="icon-heart d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Wishlist</span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>




                                    <!--                                <div class="loader_image" style="    padding-top: 15%;    padding-bottom: 14%;">
                                                                        <center>
                                                                            <img src='http://preloaders.net/preloaders/335/Thin%20broken%20ring-128.gif'>
                                                                        </center>
                                                                        <h3 style="    text-align: center;
                                                                            padding-top: 30px;
                                                                            font-weight: 300;">
                                                                            Loading...
                                                                        </h3>
                                                                    </div> -->

                                  

                                </div>
  <div class="page_navigation" ng-if="productList.length >0"  style="margin-right: 37%;"></div>

                                <div ng-if="productList.length == 0" class="loader_container" >

                                    <h1 style="    text-align: center;
                                        margin-top: 9%;
                                        font-weight: 200;
                                        color: #000;">No Product Found.</h1>
                                </div>
                            </div>
                            <div class='loader_image' ng-if="loader == 1" style="    padding-top: 15%;    padding-bottom: 14%;" >
                                <center>
                                    <img src='http://preloaders.net/preloaders/335/Thin%20broken%20ring-128.gif'>
                                </center>
                                <h3 style="    text-align: center;
                                    padding-top: 30px;
                                    font-weight: 300;">
                                    Loading...
                                </h3>
                            </div> 




                            <?php
                            for ($i = 0; $i < count($productList); $i++) {
                                $product_id = $productList[$i]['id'];

                                $catobj->setSearchingTag($product_id, $_REQUEST);
                            }
                            ?>

                        </section>
                    <?php } else {
                        ?>

                        <h1 style="    text-align: center;
                            margin-top: 9%;
                            font-weight: 200;
                            color: #000;">No Product Found.</h1>

                    <?php } ?>

                </div>
                <!--banners-->
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <!------------------------------old footer--------------------------------->
    <script src="../assets/js/jquery.pajinate.js"></script>

    <script>


                            $(function () {



                            });
    </script>






    <script>

        //        angular implematation

        nitaFasions.controller('ProductListController', function ($scope, $http, $filter, $timeout) {
            var requestobj = JSON.parse('<?php echo json_encode($_REQUEST) ?>');
            $scope.loader = 1;
            $scope.getProductData = function () {

                var countdata = $(".info_text").text().split(" ")[1];
                if (countdata) {
                    countdata = countdata.split("-");
                }
                else {
                    countdata = [1, 16];
                }
                requestobj['paginate'] = countdata;
                requestobj['perpage'] = '16';
                requestobj['getproductlistpage_v1'] = 'searching';
                var url = 'ajaxController.php' + "?" + $.param(requestobj);
                $scope.productList = [];
                $http.get(url).then(function (rdata) {
                    $scope.loader = 0;
                    $scope.productList = rdata.data;
                    $timeout(function () {

                        $("img.lazy").lazyload({
    //                            placeholder: "<?php echo $defaultProduct; ?>"
                        });
                        var page_data = $('.section_offset').pajinate({
                            items_per_page: 16,
                            item_container_id: '.page_container',
                            nav_panel_id: '.page_navigation',
                            num_page_links_to_display: 10,
                            nav_label_info: 'Showing {0}-{1} of {2} results',
                            nav_info_id: '.info_text'
                        });
                        $(".page_navigation a").click(function () {
                            $("body").animate({
                                "scrollTop": 100
                            })
                        });

                    }, 500)
                });

            }
            $scope.getProductData();

        })

        /////////////////


    </script>
    <script>
        $(function () {

    <?php
    $minp = 0;
    $maxp = 0;
    $prc = array_values($pricelist);

//print_r($pricelist);
    sort($pricelist);


    if ($prc) {
        $minp = $pricelist[0];
        $maxp = end($pricelist);
    }


    if (isset($_REQUEST['from_price'])) {
        $fromprice = $_REQUEST['from_price'];
    } else {
        $fromprice = "$" . $minp;
    };


    $aa = explode('$', $fromprice);


    if (isset($_REQUEST['to_price'])) {
        $toprice = $_REQUEST['to_price'];
    } else {
        $toprice = "$" . $maxp;
    };
    $bb = explode('$', $toprice);
    ?>
            $("#price_loader").remove();
            $("#price").slider(
                    {
                        min: 0,
                        max: <?php echo $bb[1]; ?>,
                        values: ['<?php echo $aa[1]; ?>', '<?php echo $bb[1]; ?>'],
                        change: function () {
                            var fp = $("#from_price").val();
                            var tp = $("#to_price").val();

                            $("select[name='Fabric_Category']").val("<?php echo isset($_REQUEST['Fabric_Category']) ? $_REQUEST['Fabric_Category'] : 'Fabric Category'; ?>");


                            setTimeout(function () {
                                $("#filterform").submit()
                            }, 500);
                            //$("#filterform").submit();
                        },
                    }
            );
    <?php
    if (1) {
        ?>
                $("#from_price").val("<?php echo '$' . $aa[1]; ?>");
                $("#to_price").val("<?php echo '$' . $bb[1]; ?>");
                $("select[name='sorting']").val("<?php echo isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : "" ?>");
                $(".sortby").text("<?php echo isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : "Sort By" ?>")

        <?php
    }
    ?>

        })
    </script>

    <script>
        $(function () {
            $("select[name='Fabric_Category']").val("<?php echo isset($_REQUEST['Fabric_Category']) ? $_REQUEST['Fabric_Category'] : 'Fabric Category'; ?>");
            $('.rc_first_ hr').attr('id', 'page_' +<?php echo $_REQUEST['page_no'] - 1; ?>);
            $('.rc_last_ hr').attr('id', 'page_' +<?php echo $_REQUEST['page_no'] + 1; ?>);
            $('.paginate').click(function () {
                var ids = this.id;
                var page_id = ids.split('_');
                $('input[name="page_no"]').val(page_id[1]);
                $("#filterform").submit();
            });
            $(".selected_colors").click(function () {
                var colors = [];
                //                $(".selected_colors").each(function () {
                //                    if (this.checked) {
                //                        colors.push(this.value);
                //                    }
                //                })
                //                $("input[name=color]").val(colors.join(","));
                $("#filterform").submit();
            });

        });
    </script>
    <script>



        $(function () {
            $('.select_list li').click(function () {
                setTimeout(function () {
                    $("#filterform").submit();
                }, 600);
            });



        });
    <?php
    $pageNoCrt = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : '1';
    ?>

        $(function () {

            $(".paginations li:contains(<?php echo $pageNoCrt; ?>)").addClass("active");
            $(".filtercolor").mouseenter(function () {
                $(".removecolor").removeClass("fa-times");
                //  console.log(this);
                $(this).find(".removecolor").addClass("fa-times");

            });

            $(".filtercolor").mouseleave(function () {
                $(".removecolor").removeClass("fa-times");


            })

            $(".removecolor").click(function () {
                var colorid = $(this).parent(".filtercolor").first().attr("colorfiltercode");
                console.log(colorid)
                $("input[value='" + colorid + "']").click();
            })


        })

        $(function () {


            $("[colorfiltercode]").each(function () {

                var colorradio = $("input[type='checkbox'][value='" + $(this).attr("colorfiltercode") + "']");

                if (colorradio[0]) {
                    var codec = $(colorradio).attr("colorcode");

                    $(this).css({"background": codec});
                }
            })


    <?php
    if (isset($_REQUEST['colors'])) {
        $colors = $_REQUEST['colors'];
        $colorslist = $colors;
        // print_r( $_REQUEST['colors']);
        foreach ($colorslist as $ind => $colid) {
            if ($colid) {
                echo '$(".selected_colors[value=' . $colid . ']")[0].checked  = true;';
            }
        }
    }
    ?>
        });



    </script>
<?php } else {
    ?>

<?php }
?>