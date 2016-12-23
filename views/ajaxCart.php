<!--start of file-->
<style>
    .notification_budget{
        color: white;
        margin: -6px -9px;
        background: red;
        border-radius: 50%;
        text-align: center;
        position: relative;
        /* left: 24px; */
        /* width: 24px; */
        font-size: 12px;
        font-weight: 900;
        width: 24px;
        float: right;
        z-index: 99999;
    }
</style>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM `nfw_notification_user` where user_id = $user_id and status = 0 order by id desc";
    $res = resultAssociate($query);
    $len = count($res);
    // print_r($res);
    ?>

    <div class="relative f_right m_right_10 dropdown_2_container shoppingcart">
        <button class="icon_wrap_size_2 color_grey_light circle tr_all">
            <i class="icon-bell-alt color_grey_light_2 tr_inherit"></i>
        </button>
        <span id="total_notification" class="animated notification_budget" >
            <?php echo $len; ?>
        </span>
        <div class="dropdown_2 bg_light shadow_1 tr_all p_top_0">
            <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                padding: 6px 13px;
                margin-bottom: 9px;
                background: #000000;
                width: 380px;
                color: #fff;
                margin-left: -15px;"><i class="icon-bell-alt  tr_inherit"></i> &nbsp; Your Notifications</h5>
            <div class="sc_header bg_light_2 fs_small color_grey">

            </div>
            <?php
            if (count($res)) {
                ?>
                <ul class="added_items_list" style="max-height: 500px;
                    overflow-y: auto;">
                    <?php foreach ($res as $key => $value) {
                        ?> 

                        <li class="clearfix lh_large m_bottom_20 relative" onclick="pageChange('<?php echo $value['id']; ?>', '<?php echo $value['page_link']; ?>')">

                            <div class="f_left item_description lh_ex_small" style="text-align: left;max-width: 100%">
                                <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3 titleData" style="text-align: left"></a>
                                <a href="#" style="text-decoration: none" > 
                                    <p class="fs_small">
                                        <span class="" style="color: black">
                                            <b>
                                                <?php echo $value['title'] ?>
                                            </b>
                                        </span>
                                    </p>
                                    <p style="font-size: 10px"><?php echo $value['message'] ?></p>
                                    <p class="fs_small"><span style="font-size: 10px;color: #ACABAB;"><?php echo $value['date_time'] ?></span></p>
                                </a>
                            </div>


                        </li>

                    <?php } ?>

                </ul>
                <?php
            } else {
                ?>
                <div class=" bg_light_2 t_align_m fs_medium m_bottom_15">
                    <ul class="" style="  max-height: 500px;
                        overflow-y: auto;    text-align: center;
                        padding-right: 10px;">No New Notifications!</ul>
                </div>
                <?php
            }
            ?>

        </div>
    </div>




    <div class=" relative m_right_10 f_right dropdown_2_container shoppingcart" style="">
        <button class="icon_wrap_size_2 color_grey_light circle tr_all">
            <i class="icon-heart color_grey_light_2 tr_inherit"></i>
        </button>
        <span id="wishlist_item_total" class="animated notification_budget" >
            0  
        </span>
        <div class="dropdown_2 bg_light shadow_1 tr_all p_top_0" >
            <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                padding: 6px 13px;
                margin-bottom: 9px;
                background: #000000;
                width: 380px;
                color: #fff;
                margin-left: -15px;"><i class="icon-heart  tr_inherit"></i> &nbsp; Your Wishlist</h5>
            <div class="sc_header bg_light_2 fs_small color_grey">
                Recently added item(s)
            </div>
            <ul class="added_items_list productWishListinfo" style="  max-height: 500px;
                overflow-y: auto;
                padding-right: 10px;">
            </ul>
            <div class="WishList_total_price bg_light_2 t_align_r fs_medium m_bottom_15">
                <ul>
                    <li class="color_dark"><span class="fw_ex_bold">Total:</span> <span class="fw_ex_bold d_inline_b m_left_15 price t_align_l color_pink WishList_totalPRice">$0.00</span></li>
                </ul>
            </div>
            <div class="clearfix border_none p_top_0 sc_footer">
                <a href="wishlist.php" class="btn btn-default btn-xs d_block color_dark f_right r_corners tr_all WishList_footer">View Wishlist</a>

            </div>
        </div>
    </div>
<?php }
?>





<div class="relative m_right_10 f_right dropdown_2_container shoppingcart " >
    <button class="icon_wrap_size_2 color_grey_light circle tr_all  animated">
        <i class="icon-basket color_grey_light_2 tr_inherit"></i>
    </button>
    <span id="" class="animated notification_budget cart_budget " ng-model="cart_total_quantity">
        {{cart_total_quantity}}
    </span>

    <div class="dropdown_2 bg_light shadow_1 tr_all p_top_0" style="">
        <h5 class="fw_light color_dark m_bottom_23" style="   text-align: left;
            padding: 6px 13px;
            margin-bottom: 9px;
            background: #000000;
            width: 380px;
            color: #fff;
            margin-left: -15px"><i class="icon-basket  tr_inherit"></i> &nbsp; Your Shopping Cart</h5>

        <?php
        if (1) {
            if ($_SESSION['user_id']) {
                $customizedData = $authobj->idCustomizationwithValue($_SESSION['user_id']);
                if ($customizedData) {
                    $data = count($customizedData);
                    ?>
                    <div class="col-md-6" style="padding: 0px">
                        <span class="pull-left" style="color:navy;font-size:10px">Total <?php echo $data; ?> items waiting for checkout</span><br/>
                        <a href="./shippingCart.php" class="pull-left">
                            <span style="font-size: 13px;border-radius:3px;background-color: #F1F1F1; font-weight: 500;padding: 0px 10px;">
                                Proceed to Checkout
                            </span>

                        </a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-6" style="padding: 0px"></div>
                    <?php
                }
                ?> 
                <span class="pull-left" style="color:navy;font-size:10px"></span><br/>


                <div class="col-md-6 pull-right" style="padding: 0px">
                    <div ng-if="cart_data.length">
                        <span ng-if="cart_data.length" class="pull-right" style="color:navy;font-size:10px;margin-top: -24px">Recently added item(s)</span><br/>
                        <a href="./shopAllCart.php" class="pull-right" style="margin-top: -24px" ng-if="cart_data.length">
                            <span style="font-size: 13px;border-radius:3px;background-color: #F1F1F1; font-weight: 500;padding: 0px 10px;">
                                Go for Customization &rarr;
                            </span>

                        </a>
                        <hr style="height: 0px;margin-top: 6px;margin-bottom: 0px;">
                    </div>
                </div>
                <?php
            }
            ?>
            <ul class="added_items_list productCartinfo11" style="max-height: 500px;
                overflow-y: auto;
                padding-right: 10px;
                text-align: center;padding-bottom: 13px;"
                ng-if="cart_data.length"
                > 

                <li class="clearfix lh_large animated flipInX {{cartd.animate}} m_bottom_20 relative" ng-repeat="cartd in cart_data" ng-model="cartd.animate" ng-init="cartd.animate = ''">
                    <a href="shop_product.php?product_id={{cartd.id}}&item_type={{cartd.tag_id}}" class="d_block f_left m_right_10">
                        <img src="{{cartd.image}}" alt="" class="imageData" style="height:66px;width: 66px">
                        <div class="f_left  lh_ex_small" style="text-align: left;">
                            <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3 titleData" style="float: left;width:205px">
                                <span style="float: left">{{cartd.title}}</span>

                                <span class="color_grey" style="float: right"><span class="quantityData">{{cartd.quantity}} x {{cartd.price| currency }}</span></span>
                            </a>
                            <p class="fs_small"><span class="skuData"></span></p>
                            <p class="fs_small">Item: <span class="customData" style="color:black">{{cartd.tag_name}}</span></p>
                            <a href="#" class="fs_small" style="font-size: 11px;">{{cartd.product_speciality|limitTo:30}} {{cartd.product_speciality.length>30?'. . .':''}}</a>
                        </div>
                        <!--<button ng-click="removeCartData(cartd)">X</button>-->
                        <i class="icon-cancel-circled color_grey_light_2 fs_large color_dark_hover tr_al " ng-click="removeCartData(cartd)" ></i>
                        <!--cartRemoveid="{{cartd.id}}/{{cartd.tag_id}}"-->
                    </a>
                </li>

            </ul>

            <ul class="added_items_list productCartinfo" ng-if="cart_data.length == 0" style="max-height: 500px;
                overflow-y: auto;
                width: 100%;
                text-align: center;padding-bottom: 13px;">
                <i class="icon-frown"></i>  YOUR SHOPPING CART IS EMPTY</ul>

            <div class="total_price bg_light_2 t_align_r fs_medium m_bottom_15"   ng-if="cart_data.length">
                <ul>
                    <li class="color_dark" style="font-weight: 400; "> 
                        <span class="">Total:</span> 
                        <span class=" d_inline_b m_left_15 price t_align_l color_pink ">  {{ cart_total_price | currency}}   <small style="    font-size: 11px;
                                                                                                                                    line-height: 21px;">(Quantity:{{cart_total_quantity}})</small></span>
                    </li>
                </ul>
            </div>
            <div class="clearfix border_none p_top_0 sc_footer " ng-if="cart_data.length">
                <a href="<?php if (isset($_SESSION['user_id'])) { ?>shopAllCart.php <?php } else { ?>cartlist.php<?php } ?>" >
                    <span style="font-size: 13px;
                          font-weight: 500;
                          margin-left: -5px;
                          float: right;
                          /* text-decoration: overline; */
                          /* border: 1px solid #000; */
                          padding: 0px 10px;
                          border-radius: 6px;
                          background-color: #F1F1F1;"> Go for Customization &rarr;</span>
                </a>
            </div>

        <?php } else { ?>


            <a href="cartlist.php">
                <span style="        font-size: 13px;
                      font-weight: 500;
                      margin-left: -5px;
                      float: left;
                      /* text-decoration: overline; */
                      /* border: 1px solid #000; */
                      padding: 0px 10px;
                      border-radius: 6px;
                      background-color: #F1F1F1;">Go for Customization &rarr;
                </span></a>

            <div class="sc_header bg_light_2 fs_small color_grey">
                Recently added item(s)
            </div>
            <ul class="added_items_list productCartinfo" style="max-height: 500px;
                overflow-y: auto;
                padding-right: 10px;
                text-align: center;padding-bottom: 13px;"> <i class="icon-frown"></i>  YOUR SHOPPING CART IS EMPTY</ul>
            <div class="clearfix border_none p_top_0 sc_footer ">
                <a href="cartlist.php">
                    <span style="font-size: 13px;
                          font-weight: 500;
                          margin-left: -5px;
                          float: right;
                          /* text-decoration: overline; */
                          /* border: 1px solid #000; */
                          padding: 0px 10px;
                          border-radius: 6px;
                          background-color: #F1F1F1;"> Go for Customization →</span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>





<!--login-->
<div class="relative f_right m_right_10 dropdown_2_container login">
    <?php if (isset($_SESSION['user_id'])) { ?>
        <button class="icon_wrap_size_2 color_grey_light circle tr_all">
            <i class="icon-user color_grey_light_2 tr_inherit"></i>
        </button>
    <?php } ?>
    <?php if (!isset($_SESSION['user_id'])) { ?>
        <button class="icon_wrap_size_2 color_grey_light circle tr_all">
            <i class="icon-lock color_grey_light_2 tr_inherit"></i>
        </button>
    <?php } ?>
    <div class="dropdown_2 bg_light shadow_1 tr_all" style=" padding: 0px 15px 0;width: 300px;">
        <?php
        if (isset($_SESSION['user_id'])) {
            $authInfo = $authobj->userProfile($_SESSION['user_id']);
            ?>
            <div id="popular" class="active" style="display: block;">
                <!--popular-->
                <article class="clearfix m_bottom_12 m_xs_bottom">
                    <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                        padding: 6px 13px;
                        margin-bottom: 9px;
                        background: #000000;
                        width: 300px;
                        color: #fff;
                        margin-left: -15px;">
                        <i class="icon-user color_white_light_2 tr_inherit"></i> 
                        &nbsp; Welcome
                    </h5>

                    <ul class="">
                        <li class="clearfix lh_large m_bottom_20 relative">
                            <!--                                        <a href="#" class="d_block f_left m_right_10"> 
                            <?php if (isset($_SESSION['user_img']) && $_SESSION['user_img'] != '') { ?>
                                                                                                                                                                                                                <img  width="80" height="80" src="<?php echo $_SESSION['user_img']; ?>" alt=""/>
                            <?php } else {
                                ?>
                                                                                                                                                                                                                <img  width="80" height="80" src="../assets/images/no_client.png" alt=""/>
                            <?php }
                            ?>
                                                                    </a>-->
                            <div class="f_right lh_ex_large">
                                <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3" style="text-transform: capitalize;font-size: 20px;">
                                    <?php echo $authInfo[0]['first_name']; ?>
                                </a>
                                <p class="color_dark fs_small"><?php echo $authInfo[0]['email']; ?></p>
                                <a href="#" class="fs_small color_grey">
                                    Last Login <i><?php echo $_SESSION['last_login']; ?></i>
                                </a>
                            </div>
                        </li>
                    </ul>


                    <ul class="dotted_list color_grey_light_2 article_stats">
                        <li class="m_right_15 relative" style="  margin-right: 0px;">
                            <div class="row">
                                <!--<div style="width: 205%">-->
                                <div class="col-lg-6">
                                    <form method="post" action="#">
                                        <button name="logout" type="submit" class="btn btn-default btn-xs pull-left" style="width: 80px;">
                                            <i class="icon-logout"></i> Logout
                                        </button>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <form action="userProfile.php" method="post" action="#">
                                        <button name="profile" type="submit" class="btn btn-default btn-xs pull-right" style="">
                                            <i class="icon-list"></i> View Account
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!--</div>-->
                        </li>
                    </ul>

                </article>
            </div>
        <?php } else {
            ?>
            <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                padding: 6px 13px;
                margin-bottom: 9px;
                background: #000000;
                width: 300px;
                color: #fff;
                margin-left: -15px;"><i class="icon-lock  tr_inherit"></i> &nbsp; User Login</h5>
            <form action="#" class="login_form m_bottom_20" method="post" action="#">
                <ul>
                    <li class="m_bottom_10 relative hr_list social_icons tooltip_container">

                        <!--                        <a href="findex.php" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2 fs_small" >
                                                    <span class="d_block r_corners color_default tooltip fs_small tr_all" style="">Follow</span>
                                                    <i class="icon-facebook fs_small"></i>
                                                </a>
                        
                                                <a href="gplus.php" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2 fs_small" style="margin-left: 50px;
                                                   margin-top: -40px;">
                                                    <span class="d_block r_corners color_default tooltip fs_small tr_all" style="">Google Plus</span>
                        
                                                    <i class="icon-gplus-1 fs_small"></i>
                                                </a>-->


                    </li>   

                    <li class="m_bottom_10 relative">
                        <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                        <input type="text" name="email" placeholder="Email" class="r_corners color_grey w_full fw_light">
                    </li>
                    <li class="m_bottom_10 relative">
                        <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                        <input type="password" name="pass" placeholder="Password" class="r_corners color_grey w_full fw_light">
                    </li>
                    <!--                                                            <li class="m_bottom_23">
                       <input type="checkbox"  checked id="checkbox_1" name="check" class="d_none">
                       <label for="checkbox_1" class="d_inline_m fs_medium fw_light">Remember me</label>
                       </li>-->
                    <li class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                            <input type="submit" name="login" class="btn btn-default btn-xs tr_all color_black transparent r_corners"  value="Login" style="    float: left;">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 t_align_r lh_medium">
                            <a href="forgetdetail.php" class="fs_small" style="color: #000000">Forgot your password?</a><br>
                        </div>
                    </li>
                </ul>
            </form>
            <div class="bg_light_2 im_half_container sc_footer">
                <p class=" t_align_l fw_light color_dark d_inline_m half_column">New Customer ?</p>
                <div class="half_column t_align_r d_inline_m">
                    <a href="../views/registration.php" class="btn btn-xs t_xs_align_c d_inline_b tr_all r_corners color_purple transparent fs_medium">Create an Account</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>








<div style="display:none" id="WishListTemplate">
    <li class="clearfix lh_large m_bottom_20 relative" >
        <a href="#" class="d_block f_left m_right_10"><img src="" alt="" class="WishList_imageData" style="height:66px;width: 66px"></a>
        <div class="f_left WishList_item_description lh_ex_small" style="text-align: left">
            <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3 WishList_titleData">Duis ac turpis</a>
            <p class="color_grey_light fs_small"><span class="WishList_skuData"></span></p>
            <p class="color_grey_light fs_small">Item: <span class="customData" style="color:black"></span></p>

        </div>
        <div class="f_right fs_small lh_medium d_xs_none">
            <span class="color_grey"><span class="WishList_quantityData">1</span> x </span><span class="color_dark">$<span class="WishList_PriceData">79.00</span></span>
        </div>
        <i class="icon-cancel-circled-1 color_grey_light_2 fs_large color_dark_hover tr_al removeWishListData"  WishList_Removeid="ids"></i>
    </li>
</div>



<div role="search" class="m_right_10 relative type_2 f_left type_3 f_xs_none t_xs_align_l m_xs_bottom_15" style="">
    <input type="text" placeholder="Search" class="r_corners fw_light bg_light w_full" style="    border-radius: 48px;    border: 1px solid #000000;    width: 100%;" id="searchproduct" data-provide="typeahead">
    <button class="color_grey_light color_purple_hover tr_all" style="color: #000000">
        <i class="icon-search"></i>
    </button>
</div>


<style>
    #cartImages{

        /*        -webkit-animation-duration: 0.5s;
                -webkit-animation-delay: 0.5s;
        */


    }
</style>


<div style="position: fixed">
    <div class="cartAjax animated"  style="position: relative;display:none">
        <img src="../assets/images/ajaxCart.png" style=" height: 125px;
             z-index: 20000;
             position: relative;" >
        <img src="" id="cartImages" class="animated" style="    width: 69px;
             position: absolute;
             margin-left: -83px;
             z-index: 111;
             display: none;
             margin-top: -150px;">

    </div>
</div>

<script>
    nitaFasions.filter('CartTotal', function () {
        return function (data, key) {
            if (angular.isUndefined(data) && angular.isUndefined(key))
                return 0;
            var sum = 0;
            angular.forEach(data, function (value) {

                if (value) {
                    if (key == 'price') {
                        sum = sum + (parseInt(value[key]) * parseInt(value['quantity']));
                    }
                    else {
                        sum = sum + parseInt(value[key]);
                    }
                }
            });
            return sum;
        }
    });
    nitaFasions.controller('AjaxCart', function ($scope, $http, $filter, $timeout) {
        var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';

<?php
if (isset($_SESSION['user_id'])) {
    $url = 'ajaxController.php?checkCart=nfw_product_cart&user_id=' . $_SESSION['user_id'];
} else {
    $url = 'ajaxController.php?session_id=1';
}
?>
        var url = '<?php echo $url; ?>';
        $scope.cart_data = [];
        //get cart data
        $scope.getCartData = function () {
            $http.get(url).then(function (rdata) {
                $scope.cart_data = rdata.data;
                $scope.cart_total_price = $filter('CartTotal')($scope.cart_data, 'price');
                $scope.cart_total_quantity = $filter('CartTotal')($scope.cart_data, 'quantity');
                $(".cart_budget").addClass("bounceIn");
                $timeout(function () {
                    $(".cart_budget").removeClass("bounceIn");
                }, 1000)
            });

        }
        $scope.getCartData();

        $scope.removeCartData = function (obj) {
            console.log(obj)
            obj.animate = 'flipOutX';
            var product_id = obj.id;
            var tag_id = obj.tag_id;
            $(".cart_budget").addClass("bounceIn");
<?php
if (isset($_SESSION['user_id'])) {
    ?>
                var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';
                $.ajax({
                    url: 'ajaxController.php',
                    data: {'productId': product_id, 'tag_id': tag_id, 'user_id': useriD, 'table': 'nfw_product_cart'},
                    success: function (data) {

                        $scope.cart_data.splice($scope.cart_data.indexOf(obj), 1);
                        $timeout(function () {
                            $(".cart_budget").removeClass("bounceIn");
                            $scope.cart_total_price = $filter('CartTotal')($scope.cart_data, 'price');
                            $scope.cart_total_quantity = $filter('CartTotal')($scope.cart_data, 'quantity');
                        }, 500)

                    }
                });
    <?php
} else {
    ?>
                var ids = product_id + '__' + tag_id;

                $.ajax({
                    url: 'ajaxController.php',
                    data: {'productSessionId': ids},
                    success: function (data) {

                        $scope.cart_data.splice($scope.cart_data.indexOf(obj), 1);
                        $timeout(function () {
                            $(".cart_budget").removeClass("bounceIn");
                            $scope.cart_total_price = $filter('CartTotal')($scope.cart_data, 'price');
                            $scope.cart_total_quantity = $filter('CartTotal')($scope.cart_data, 'quantity');
                        }, 500)
                        // window.location.reload();
                    }

                });
<?php } ?>
        }
    })
    //




    function viewCart() {
        var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';
        $(".productCartinfo").html("");
        $.ajax({
            url: 'ajaxController.php',
            method: "post",
            data: {'checkCart': 'nfw_product_cart', 'user_id': useriD},
            success: function (data) {
                //  console.log(data);
                var data = jQuery.parseJSON(data);
                if (data.length == 0) {
                    $(".productCartinfo").html(" <i class='icon-frown'></i>  YOUR SHOPPING CART IS EMPTY");
                    $('.total_price,.cart_footer').hide();
                }
                else {

                    var count = 0;
                    var quan = 0;
                    for (i in data) {
                        //  console.log()
                        var temp = data[i];
                        var htmls = $("#cartTemplate");
                        $(htmls).find(".imageData").attr("src", temp['image'].replace("small", "smaller"));
                        var len1 = temp['product_speciality'];
                        if (len1) {
                            len1 = len1.length;
                            if (len1 < 20) {
                                $(htmls).find(".skuData").text(temp['product_speciality']);
                            }
                        }
                        else {
                            if (temp['product_speciality']) {
                                var checktext = temp['product_speciality'].slice(0, 20);
                                $(htmls).find(".skuData").text(checktext + '...');
                            }
                        }
                        $(htmls).find(".customData").text(temp['tag_name']);
                        $(htmls).find(".quantityData").text(temp['quantity']);
                        $(htmls).find(".cartPriceData").text(temp['price']);
                        $(htmls).find(".titleData").text(temp['title']).attr("href", "shop_product.php?product_id=" + temp['id'] + "&item_type=" + temp['tag_id']);
                        $(htmls).find(".removeCartData").attr('cartRemoveid', temp['id'] + '/' + temp['tag_id']);
                        $(".productCartinfo").append($(htmls).html());
                        $('.total_price,.cart_footer').show();
                        count += temp['cart_price'];
                        // console.log(count);
                        quan += Number(temp['quantity']);
                        //console.log(quan);
                    }
                    // console.log(quan);
                    $("#cart_item_total").text(quan);
                    var obj = $("#cart_item_total");
                    var x = 'bounceIn';
                    $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        $(this).removeClass(x);
                    });
                    $("#total_cart_quantity").text(quan);
                    $(".totalPRice").text("$" + count.toFixed(2));
                }

            }

        });
    }

    function viewWishList() {
        var useriD = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
        $(".productWishListinfo").html("");
        var wishlistproduct = 0;
        $.ajax({
            url: 'ajaxController.php',
            method: "post",
            data: {'checkCart': 'nfw_product_wishlist', 'user_id': useriD},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                console.log(data)
                if (data.length == 0) {
                    $(".productWishListinfo").html("You have no item in wishlist");
                    $('.WishList_total_price,.WishList_footer').hide();
                }
                else {
                    wishlistproduct = data.length;
                    $("#wishlist_item_total").text(wishlistproduct);
                    var count = 0;
                    for (i in data) {
                        var temp = data[i];
                        var htmls = $("#WishListTemplate");
                        $(htmls).find(".WishList_imageData").attr("src", temp['image'].replace("small", "smaller"));
                        var len1 = temp['product_speciality'].length;
                        if (len1 < 20) {
                            $(htmls).find(".WishList_skuData").text(temp['product_speciality']);
                        }
                        else {
                            var checktext = temp['product_speciality'].slice(0, 20);
                            $(htmls).find(".WishList_skuData").text(checktext + '...');
                        }
                        $(htmls).find(".customData").text(temp['tag_name']);
                        $(htmls).find(".WishList_quantityData").text(temp['quantity']);
                        $(htmls).find(".WishList_PriceData").text(temp['price']);
                        $(htmls).find(".WishList_titleData").text(temp['title']).attr("href", "shop_product.php?product_id=" + temp['id'] + "&item_type=" + temp['tag_id']);
                        $(htmls).find(".removeWishListData").attr('WishList_Removeid', temp['id'] + '/' + temp['tag_id']);
                        $(".productWishListinfo").append($(htmls).html());
                        $('.WishList_total_price,.WishList_footer').show();
                        count += temp['cart_price'];
                    }
                    $(".WishList_totalPRice").text("$" + count.toFixed(2));
                }

            }

        });
    }




    function viewCartSession() {
        // var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';
        $(".productCartinfo").html("");
        $.ajax({
            url: 'ajaxController.php',
            method: "post",
            data: {'session_id': '1'},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                if (data.length == 0) {
                    $(".productCartinfo").html(" <i class='icon-frown'></i>  YOUR SHOPPING CART IS EMPTY");
                    $('.total_price,.cart_footer').hide();
                }
                else {

                    var count = 0;
                    var quan = 0;
                    for (i in data) {
                        //alert('test');
                        var temp = data[i];
                        var htmls = $("#cartTemplate");
                        $(htmls).find(".imageData").attr("src", temp['image']);
                        $(htmls).find(".skuData").text(temp['product_speciality']);
                        $(htmls).find(".customData").text(temp['tag_name']);
                        $(htmls).find(".quantityData").text(temp['quantity']);
                        $(htmls).find(".cartPriceData").text(temp['price']);
                        $(htmls).find(".titleData").text(temp['title']).attr("href", "shop_product.php?product_id=" + temp['id'] + "&item_type=" + temp['tag_id']);
                        $(htmls).find(".removeCartData").attr('cartRemoveid', (temp['id'] + "__" + temp['tag_id'].replace(" ", "")));
                        $(".productCartinfo").append($(htmls).html());
                        $('.total_price,.cart_footer').show();
                        count += temp['cart_price'];
                        quan += Number(temp['quantity']);
                    }
                    $("#cart_item_total").text(quan);
                    $("#total_cart_quantity").text(quan);
                    $(".totalPRice").text("$" + count.toFixed(2));
                }

            }

        });
    }



</script>
<script>

    $(document).ready(function () {
        //

<?php
if (isset($_SESSION['user_id'])) {
    echo "viewCart();";

    echo "viewWishList();";
} else {
    echo "viewCartSession();";
}
?>




        $(document).on("click", ".add_to_cart_button", function () {

<?php if (isset($_SESSION['user_id'])) { ?>
                var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR'] ?>';
                var add_type = $(this).text().split('to');
                var ids = '';
                var itemType = '';
                add_type = add_type[1].trim();
                if (add_type === "Wishlist") {
                    ids = $(this).attr('wishlistaddid');
                    itemType = $(this).attr('item_type');
                    if (itemType) {
                        itemType = itemType;
                    }
                    else {
                        itemType = '<?php echo $_REQUEST['item_type']; ?>';
                    }
                }
                if (add_type == "Cart") {
                    ids = $(this).attr('cartaddid');
                    itemType = $(this).attr('item_type');
                    if (itemType) {
                        itemType = itemType;
                    }
                    else {
                        itemType = '<?php echo $_REQUEST['item_type']; ?>';
                    }
                }

                $.ajax({
                    method: 'get',
                    url: 'ajaxController.php',
                    data: {'product_id': ids, 'user_id': useriD, 'action': add_type, 'itemType': itemType},
                    success: function (data) {
                        angular.element(document.getElementById("AjaxCart")).scope().getCartData();
                        viewCart();
                        viewWishList();
                    }
                });
<?php } else { ?>
                var ids = $(this).attr('cartaddid');
                var itemType = $(this).attr('item_type');
                var itemPrice = $(this).attr('price');
                $.ajax({
                    method: 'get',
                    url: 'ajaxController.php',
                    data: {'productsIDS': ids, 'item_price': itemPrice, 'itemType': itemType, 'quantity': '1'},
                    success: function (data) {
                        angular.element(document.getElementById("AjaxCart")).scope().getCartData();
                        viewCartSession();
                    }
                });
                //           window.location = '../views/registration.php';
<?php } ?>

        });
    });</script>

<script>

    function animateImage() {
        $("#cartImages").animate({'margin-top': '-10'});
    }

    $(function () {

        $(document).on("click", ".add_to_cart_button", function () {


            var cartPos = $(".shoppingcart").offset();
<?php if (!isset($_REQUEST['product_id'])) { ?>

                var getImag = $(this).parents("figure");
<?php } ?>

<?php if (isset($_REQUEST['product_id'])) { ?>

                var getImag = $("img.r_corners").parents("a").first();
<?php } ?>

            var carPos = $(this).offset();
            carPos.left = carPos.left + 28;
            var lastPos = window.screen.availWidth;
            //$(".cartAjax").css("position", "relative");

            //var scrollPos = $("body").scrollTop();


            var obj = getImag;
            var x = 'zoomOutDown';
            $(".cartAjax").show();
            $(".cartAjax").offset(carPos);
            $("#cartImages").show();
            $("#cartImages").attr("src", $(getImag).find("img").first().attr("src"));
            var obj1 = $("#cartImages");
            var x1 = 'zoomInDown';
            $(obj1).removeClass(x1).addClass(x1).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                // $(obj1).removeClass(x1);
                $("#cartImages").effect("bounce", "slow");
                $(".cartAjax").animate({'left': lastPos}, 300, function () {
                    $("#cartImages").attr("src", "");
                    $(".cartAjax").hide(200);
                    $("#cartImages").css({"display": "none"});
                });
            });
        });
    })

</script>
<script>
    $(function () {
        $(document).on("click", ".removeCartData", function () {
            var ids = $(this).attr("cartRemoveid");
            // var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';
            $.ajax({
                url: 'ajaxController.php',
                data: {'productSessionId': ids},
                success: function (data) {

                    viewCartSession();
                    // window.location.reload();
                }

            });
        });
<?php if (isset($_SESSION['user_id'])) { ?>
            $(document).on("click", ".removeCartData", function () {
                var ids = $(this).attr("cartRemoveid");
                var arr = ids.split('/');
                var product_id = arr[0];
                var tag_id = arr[1];
                var useriD = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_SERVER['REMOTE_ADDR']; ?>';
                $.ajax({
                    url: 'ajaxController.php',
                    data: {'productId': product_id, 'tag_id': tag_id, 'user_id': useriD, 'table': 'nfw_product_cart'},
                    success: function (data) {
                        window.location.reload();
                    }

                });
            });
            $(document).on("click", ".removeWishListData", function () {
                var ids = $(this).attr("WishList_Removeid");
                var arr = ids.split('/');
                var product_id = arr[0];
                var tag_id = arr[1];
                var useriD = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
                $.ajax({
                    url: 'ajaxController.php',
                    data: {'productId': product_id, 'tag_id': tag_id, 'user_id': useriD, 'table': 'nfw_product_wishlist'},
                    success: function (data) {
                        window.location.reload();
                    }
                });
            });
<?php } ?>
    });

    function pageChange(id, link) {

        $.ajax({
            url: 'ajaxController.php',
            data: {'notification': id},
            success: function (data) {
                window.location = link;
            }
        });
    }


</script>  
<!--end of file-->