<?php
include 'header.php';
include '../producthandler/productHandler.php';
$catobj = new CategoryHandler();
if (isset($_REQUEST['category'])) {
//    echo "<pre>";
//    print_r($_REQUEST);
    ?>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding: 8px;">
        <div class="container">
            <!--                    <h1 class="color_dark fw_light m_bottom_5 page-title">Shirt</h1>-->
            <h5 style="color: #1FB8C6 !important; font-weight: 200px">Shirt</h5>
            <!--                    <h1 class="color_dark fw_light m_bottom_5">Shirt</h1>-->
            <!--breadcrumbs-->
            <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
                <li class="m_right_8 f_xs_none" style="margin-right:0px !important" ><a href="index.php" class="color_default d_inline_m m_right_10" style="margin-right:0px !important">Home</a></li>
                <?php
                $parents = $catobj->get_parent($_REQUEST['category']);

                $parentArray = explode(',', $parents);
                for ($i = 0; $i < count($parentArray); $i++) {
                    $res = mysql_query("select name from nfw_category where id = $parentArray[$i] ");
                    $row = mysql_fetch_array($res);
                    ?>
                    <li class="m_right_8 f_xs_none"><a href="http://192.168.3.45/nf3/frontend/views/product_list.php?category=<?php echo $parentArray[$i]; ?>" class="color_default d_inline_m m_right_10"><?php echo $row['name']; ?></a><?php
                        if (($i + 1) === count($parentArray)) {
                            
                        } else {
                            ?><i class="icon-angle-right d_inline_m color_default fs_small"></i><?php } ?></li>
                    <?php } ?>

            </ul>
        </div>
    </section>
    <!--content-->
    <div class="section_offset" style="padding-top: 25px;">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30">
                    <div class="m_bottom_45 m_xs_bottom_30">

                        <div class="m_bottom_40 m_xs_bottom_30">
                            <h7 style="color: #1FB8C6 !important; font-weight: 200px">Product Categories</h7>
                            <ul class="categories_list">
                                <?php
                                $res = $catobj->productSubCategory($_REQUEST['category']);
                                // print_r($res);
                                foreach ($res as $key => $value) {
                                    ?>
                                    <li>
                                        <a href="product_list.php?category=<?php echo $value['id'] ?>" class="color_dark tr_all d_block">
                                            <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                                                <i class="icon-angle-right"></i>
                                            </span>
                                            <?php echo $value['name']; ?>
                                        </a>

                                    </li>

                                <?php }
                                ?>


                            </ul>
                        </div>
                        <form id="filterform">

                            <!--price-->
                            <div class="m_bottom_12">
                                <p class="m_bottom_15">Price</p>
                                <div id="price"></div>
                                <div class="clearfix">
                                    <input type="text" value=""  id="from_price" name="from_price" readonly class="f_left half_column first_limit color_dark fw_light">
                                    <input type="text" value="" id="to_price" name="to_price" readonly class="f_right half_column t_align_r last_limit color_dark fw_light">
                                </div>
                            </div>
                            <!--colors-->
                            <div class="m_bottom_20">
                                <input type="hidden" name="category"  value="<?php echo $_REQUEST['category'] ?>">
                                <?php
                                $colorArray = array();
                                $productList = $catobj->productList();
//                            echo "<pre>";
//                            print_r($productList);
                                for ($i = 0; $i < count($productList[2]); $i++) {
                                    //echo $productList[$i]['id'],'<br>';
                                    $prdobj = new ProductHandler($productList[2][$i]);
                                    $productInfo = $prdobj->productInformation();
                                    $colorID = $productInfo['color'];
                                    $colorData = $productInfo['color_code'];
                                    if ($colorData) {
                                        $colorArray[$colorID] = $colorData;
                                    }
                                }
                                ?>

                                <p class="m_bottom_5">Colors</p>
                                <ul class="hr_list">
                                    <?php
                                    foreach ($colorArray as $key => $value) {
                                        ?>
                                        <li class="m_right_10 m_sm_bottom_5">
                                            <input type="radio" value="<?php echo $key; ?>" <?if($_REQUEST['color']==$key){?> checked="checked" <?php }?> name="color" class="color_button tr_delay  circle" style="background:<?php echo $value; ?>;border: 2px solid #DDDDDD;height:32px" >

                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="m_bottom_20 clearfix">
                                <button type="submit" id="filter" class="button_type_5 f_left m_right_5 m_sm_bottom_5 r_corners tr_all color_pink transparent fs_medium">Show</button>

                                <button type="reset" id="reset_filter_form" form="manufacturers_form" class="button_type_5 f_left r_corners tr_all color_dark color_pink_hover fs_medium" onclick=" window.location.href = 'http://192.168.3.45/nf3/frontend/views/product_list.php?category=0'">Reset</button>
                            </div>


                            </aside>
                            <section class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30">
                                <!--filter-->
                                <div class="clearfix m_bottom_10">
                                    <div class="col-lg-6 col-md-6 col-sm-7 m_bottom_15">
                                        <p class="d_inline_m fs_medium m_right_15" style="font-size: 16px;margin: 4px 0px 0px -21px;">Showing 
                                            <?php
                                            echo $productList[3];
                                            ?> from <?php echo count($productList[2]); ?> results</p>
                                    </div>
                                    <ul class="hr_list f_right fs_medium paginations t_align_c f_xs_none">
                                        <li class="active">
                                            <a href="portfolio_classic_1_column.html" data-shop-layout="grid" class="rc_first_hr color_dark">
                                                <i class="icon-layout fs_large"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="rc_last_hr color_dark" data-shop-layout="list">
                                                <i class="icon-menu"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="page_no" value="1">
                                <input type="hidden" name="record_per_page" value="3">
                                <!--							<hr class="m_bottom_10">-->
                                <div class="row">

                                    <div class="custom_select products_filter type_2 f_xs_none m_xs_left_0 f_left m_left_5 m_xs_bottom_10" style="margin: 0px 0px 0px 14px;">
                                        <div class="select_title r_corners color_grey fs_medium">Sort By</div>
                                        <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                                        <select class="target d_none" name="sorting">
                                            <option value="Price-Asc">Price-Asc</option>
                                            <option value="Price-Desc">Price-Desc</option>
                                            <option value="Date">Date</option>
                                        </select>
                                    </div>

                                </div>

                        </form>
                        <!--products-->
                        <div class="shop_isotope_container t_xs_align_c three_columns m_bottom_15" data-isotope-options='{"itemSelector" : ".shop_isotope_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>
                            <!--product-->
                            <?php
                            for ($i = 0; $i < count($productList[0]); $i++) {
                                $prdobj = new ProductHandler($productList[0][$i]);
                                $productInfo = $prdobj->productInformation();

                                $productDualImage = $prdobj->productImage();
                                $productDualImage = $productDualImage['dualImages'];
                                $colorData = $productInfo['color_code'];
                                ?>

                                <div class="shop_isotope_item d_xs_inline_b">

                                    <figure class="fp_item t_align_c d_xs_inline_b">
                                        <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                                            <!--images container-->
                                            <a href="shop_product.php?product_id=<?php echo $productList[0][$i]; ?>"><div class="fp_images relative">
                                                    <img src="<?php echo $productDualImage[0]['image']; ?>" alt="" class="tr_all" style="height:270px; width:270px;">
                                                    <img src="<?php echo $productDualImage[1]['image']; ?>" alt="" class="tr_all" style="height:270px; width:270px;">
                                                </div></a>
                                            <!--labels-->
                                            <div class="labels_container">
                                                <a href="#" class="d_block label color_scheme tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                                            </div>
                                        </div>
                                        <figcaption>
                                            <h6 class="m_bottom_5"><a href="#" class="color_dark" style="font-size: 14px;"><?php echo $productInfo['title']; ?></a></h6>
                                            <a href="#" class="fs_medium color_grey d_inline_b m_bottom_3"><i><?php echo $productInfo['category_title']; ?></i></a>
                                            <div class="im_half_container m_bottom_10">
                                                <p class="color_dark d_sm_block w_sm_full d_xs_inline_m w_xs_half_column fw_ex_bold half_column d_inline_m t_align_c tr_all animate_fctl fp_price with_ie"><?php echo '$' . $productInfo['price']; ?></p>	
                                                <div class="half_column d_sm_block w_sm_full d_xs_inline_m w_xs_half_column t_sm_align_c t_xs_align_r d_inline_m t_align_r tr_all animate_fctr with_ie">
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
                                                </div>
                                            </div>
                                            <div class="product_description d_none m_bottom_20">
                                                <hr class="m_bottom_12">
                                                <p class="color_grey fs_medium m_bottom_15"><?php echo $productInfo['short_description']; ?></p>
                                                <hr>
                                            </div>
                                            <div class="clearfix fp_buttons">
                                                <div class="half_column w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                                                    <button class="button_type_6 d_inline_b color_pink transparent r_corners vc_child tr_all add_to_cart_button" cartaddid="<?php echo $productList[$i]['id']; ?>"><span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"></i><span class="fs_medium">Add to Cart</span></span></button>
                                                </div>
                                                <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie">
                                                    <a href="#" class="button_type_6 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_dark r_corners vc_child tr_all color_blue_hover t_align_c"><i class="icon-docs d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Compare</span></a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>

                                </div>
                            <?php } ?>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-5 t_align_r t_xs_align_c">
                                <ul class="hr_list d_inline_b fs_medium paginations t_align_c">
                                    <?php
                                    if (isset($_REQUEST['page_no'])) {
                                        $page = $_REQUEST['page_no'];
                                    } else {
                                        $page = 1;
                                    }
                                    print_r($productList[2]);
                                    if($productList[1]>=5){   if($page<5){$first=1;}else{$first=$page-2;} $loop_length=4+$first; echo $loop_length."**".$first; }
                                    else{ $loop_length=count($productList[1]); $first=1; echo $loop_length."//".$first; }
                                    for ($i = $first; $i <= $loop_length; $i++) {
                                        ?>
                                        <li class="<?php
                                        if ($page == $i) {
                                            ?> active <?php } ?>">
                                            <a href="#" class="paginate color_dark " id="page_<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        </section>
                    </div>
                    <!--banners-->
            </div>
        </div>

    <?php include 'footer.php'; ?>
        <script>
            $(function () {
                $("document").on("change", ".select_title li", function () {
                    alert("Handler for");
                });

            });
        </script>
        <script>
            $(function () {

    <?php
    if (isset($_REQUEST['from_price'])) {
        $fromprice = $_REQUEST['from_price'];
    } else {
        $fromprice = "$0";
    };
    $aa = explode('$', $fromprice);
    if (isset($_REQUEST['to_price'])) {
        $toprice = $_REQUEST['to_price'];
    } else {
        $toprice = '$100';
    };
    $bb = explode('$', $toprice);
    ?>
                $("#price").slider("option", "values", ['<?php echo $aa[1]; ?>', '<?php echo $bb[1]; ?>']);
    <?php
    if (1) {
        ?>
                    $("#from_price").val("<?php echo '$' . $aa[1]; ?>");
                    $("#to_price").val("<?php echo '$' . $bb[1]; ?>");
                    $("select[name='sorting']").val("<?php echo isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : "" ?>");
                    $(".select_title").text("<?php echo isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : "Sort By" ?>")

        <?php
    }
    ?>

            })
        </script>

        <script>
            $(function () {
                $('.paginate').click(function () {
                    var ids = this.id;
                    var page_id = ids.split('_');
                    $('input[name="page_no"]').val(page_id[1]);
                    $('#filter').click();
                });

            });
        </script>
        <script>
            $(function () {
                $('.select_list li').click(function () {
                    setTimeout(function () {
                        $('#filter').click();
                    }, 600);


                });
            });
        </script>
<?php } else { ?>
        <script>$(function () {
                window.location.href = 'http://192.168.3.45/nf3/frontend/views/product_list.php?category=0';
            });
        </script>
<?php } ?>
    s