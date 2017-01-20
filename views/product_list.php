<?php
 $item_type = $_REQUEST['item_type'];
if (isset($_REQUEST['category'])) {
    $defaultProduct = "data:image/png;base64,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";
} else {
    $item_type = $_REQUEST['item_type'];
    header("location:product_list.php?category=0&item_type=" . $item_type); 
}
include 'header.php';

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
                        <a href="product_list.php?category=0&item_type=<?php echo $_REQUEST['item_type']; ?>" class="" style="margin-right:0px !important;color:white;">
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
                                                        <a href="product_list.php?category=<?php echo $value['id'] ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" class="color_dark tr_all d_block">
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
                                                    <a href="product_list.php?category=<?php echo $value['id'] ?>&item_type=<?php echo $_REQUEST['item_type']; ?>" class="color_dark tr_all d_block">
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
                                    <?php
                                    $tag_id = $_REQUEST['item_type'];
                                    $colorArray = array();
                                    $productList = $catobj->productList();
                                    $productidstr = "";

                                    $productIDS = array();
                                    for ($i = 0; $i < count($productList); $i++) {
                                        if ($productList[$i]['id']) {
                                            array_push($productIDS, $productList[$i]['id']);

                                            $productidstr .= $productList[$i]['id'] . ", ";
                                            array_push($pricelist, $productList[$i]['price_r']);
                                        }
                                    }
                                    $productidstr = implode(",", $productIDS);
                                    $color_list4 = implode(",", $productIDS);
                                    $wherequery = "";
                                    if ($productidstr) {
                                        $wherequery = "where npc.nfw_product_id in ($productidstr)";
                                    }
                                    if (1) {
                                        $query = "
                                        SELECT nc.id,nc.color_code, nc.title FROM nfw_color as nc
                                          join nfw_product_color as npc on npc.nfw_color_id = nc.id
                                          $wherequery
                                         group by nc.id order by nc.display_index asc
                                            ";
                                        //  echo $query;
                                        $colorArray = resultAssociate($query);
                                    } else {
                                        $colorArray = array();
                                    }
                                    // print_r($result);
                                    ?>
                                    <?php
                                    if (count($colorArray)) {
                                        ?>
                                        <p class="m_bottom_5" style="color: #000 !important; font-weight: 500">Colors</p>
                                        <ul class="hr_list color_list">
                                            <?php
                                            foreach ($colorArray as $key => $value) {
                                                ?>
                                                <li class=" m_sm_bottom_5"  data-toggle="tooltip" data-placement="left" title="<?php echo $value['title']; ?>">

                                                    <input type="checkbox" id="shop_style<?php echo $value['id']; ?>"" class="shop_style d_none selected_colors" colorname="<?php echo $value['title']; ?>" colorcode="<?php echo $value['color_code']; ?>" name="colors[]" value="<?php echo $value['id']; ?>">
                                                    <label 
                                                        for="shop_style<?php echo $value['id']; ?>"" class="d_inline_m m_right_2 color_button color_button_check tr_delay  bg_color_dark " style="font-size: 22px;background:<?php echo $value['color_code']; ?>;"></label>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<button class="color_button tr_delay  bg_color_dark circle radio m_bottom_5" value="<?php echo $value['id']; ?>" style="background:<?php echo $value['color_code']; ?>;margin-top:auto"></button>-->


                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>

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
        <!--                                <button type="reset" id="reset_filter_form" form="manufacturers_form" class="btn btn-default btn-xs" onclick=" window.location.href = 'http://192.168.3.47/nf3/frontend/views/product_list.php?category=0&item_type=1'"><i class="icon-arrow">Reset</button>-->
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


                        if (count($productList)) {
                            ?>
                            <!--products-->

                            <div class="page_container" style='display: none'>
                                <?php
                                for ($i = 0; $i < count($productList); $i++) {
                                    echo " <div class='page'></div>";
                                }
                                ?>

                            </div>

                            <div ng-if="productList.length > 0" class="shop_isotope_container1 t_xs_align_c three_columns m_bottom_15" data-isotope-options='{"itemSelector" : ".shop_isotope_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>

                                <div class="shop_isotope_item d_xs_inline_b animated appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn" style="width: 25%; float: left;" ng-repeat="product in productList" >
                                    <figure class="fp_item t_align_c d_xs_inline_b ">
                                        <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                                            <!--images container-->
                                            <a href="shop_product.php?product_id={{product.id}}&item_type=<?php echo $item_type;?>" class='redirecturl'>
                                                 <div class="fp_images relative ">
                                                    <img src="{{product.image1}}" alt="" class=" tr_all img1 lazy" data-original="{{product.image1}}" style="height:250px; width:250px;background: url(<?php echo $defaultProduct; ?>)" >
                                                    <img src="{{product.image2}}"  alt="" class=" tr_all img2 lazy" data-original="{{product.image2}}" style="height:250px; width:250px;display: none;background: url(<?php echo $defaultProduct; ?>);" >
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


                            <div ng-if="productList.length==0" class="loader_container" >
                                <div class='loader_image' style="    padding-top: 15%;    padding-bottom: 14%;" >
                                    <center>
                                        <img src='http://preloaders.net/preloaders/335/Thin%20broken%20ring-128.gif'>
                                    </center>
                                    <h3 style="    text-align: center;
                                        padding-top: 30px;
                                        font-weight: 300;">
                                        Loading...
                                    </h3>
                                </div> 
                            </div>


                            <div class="page_navigation" style="margin-right: 37%;"></div>
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
                                                                var page_data = $('.section_offset').pajinate({
                                                                    items_per_page: 16,
                                                                    item_container_id: '.page_container',
                                                                    nav_panel_id: '.page_navigation',
                                                                    num_page_links_to_display: 5,
                                                                    nav_label_info: 'Showing {0}-{1} of {2} results',
                                                                    nav_info_id: '.info_text'
                                                                });


                                                            });
    </script>






    <script>

        //        angular implematation

        nitaFasions.controller('ProductListController', function ($scope, $http, $filter, $timeout) {
            var requestobj = JSON.parse('<?php echo json_encode($_REQUEST) ?>');

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
                requestobj['getproductlistpage'] = 'searching';
                var url = 'ajaxController.php' + "?" + $.param(requestobj);
                $scope.productList = [];
                $http.get(url).then(function (rdata) {
                    $scope.productList = rdata.data;
                    $timeout(function () {
                        $("img.lazy").lazyload({
                          
//                            placeholder: "<?php echo $defaultProduct; ?>"
                        });

                    }, 500)
                });

            }
            $scope.getProductData();

        })

        /////////////////

        $(function () {



            $(".page_navigation a").click(function () {
                angular.element(document.getElementById("ProductListControllerId")).scope().getProductData();

                $(".shop_isotope_item").each(function (i) {
                    var obj = this;
                });
                $("body").animate({
                    "scrollTop": 100
                }, function () {
                })
            });
            $("document").on("change", ".select_title li", function () {
                alert("Handler for");
            });
        });
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
