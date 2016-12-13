<?php
include 'header.php';
include '../producthandler/productHandler.php';
$cartprd = new CartHandler();
$cartProductsInfo = $cartprd->cartProducts('false');
//   print_r($cartProductsInfo);
?>
<!--page title-->
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding: 8px;">
    <div class="container">
        <h4 style="color: #1FB8C6 !important; font-weight: 200px">Shopping Cart</h4>
        <!--breadcrumbs-->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none"><a href="index.html" class="color_default d_inline_m m_right_10">Home</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
            <li class="m_right_8 f_xs_none"><a href="#" class="color_default d_inline_m m_right_10">Shop</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
            <li><a class="color_default d_inline_m">Shopping Cart</a></li>
        </ul>
    </div>
    
    <div style="background-color: rgba(78, 76, 160, 0.701961); height: 30px; margin-top: 15px;"><h6 class="color_light fw_light" style="padding: 4px;">Cart</h6></div>
    
</section>
<!--content-->
<div class="section_offset counter" style="padding: 0px;">
    <div class="container">
        <div class="im_half_container m_bottom_10" style="width:1160px">
            
            <div class="">
                <p class="fw_light" style="float:left">Your shopping cart contains <?php echo count($cartProductsInfo); ?> products</p>
                <p style="float:right">
                <a href="shop_all_cart.php" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset" ><i class="icon-basket d_inline_b m_right_5"></i> Goto Cart Detail</a>
                <a href="product_list.php" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset"><i class="icon-basket d_inline_b m_right_5"></i> Continue Shopping</a>
                </p>
            </div>
            
        </div>
        <div class="r_corners wrapper border_grey m_bottom_50 m_xs_bottom_30" style="width: 1159px; margin-top: 34px;">
            <table class="table_type_2 responsive_table w_full t_align_l" style="width: 1159px;   ">
                <thead>
                    <tr class="bg_light_2 color_dark">
                        <th style="width: 150px;">Product Image</th>
                        <th>Description</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Quantity</th>
<!--                                    <th>Tax</th>-->
<!--                                    <th>Discount</th>-->
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($cartProductsInfo); $i++) {
                        $cartInfo = $cartProductsInfo[$i];
                        ?>
                        <tr class="tr_delay">
                            <td data-title="Product Image">
                                <a href="#" class="r_corners d_inline_b wrapper">
                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height: 90px;width: 100px;">
                                </a>
                            </td>
                            <td data-title="Description">
                                <h6 class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></h6>
                                <p class="fw_light"><?php echo $cartInfo['short_description']; ?></p>
                            </td>
                            <td data-title="SKU" class="fw_light"><?php echo $cartInfo['sku']; ?></td>
                            <td data-title="Price"><?php echo '$' . $cartInfo['price']; ?></td>
                            <td data-title="Quantity">
                                <?php echo $cartInfo['quantity']; ?>
                                <!--                                        <div class="wrapper fs_medium r_corners d_inline_b quantity clearfix">
                                                                         <input type="text" readonly value="" class="f_left color_grey bg_light">
                                                                        </div>-->
                            </td>
    <!--                                    <td data-title="Tax" class="fw_light">
                                $0.00
                            </td>-->
    <!--                                    <td data-title="Discount" class="fw_light">
                                $0.00
                            </td>-->
                            <td data-title="Total" class="fw_ex_bold color_dark">
                                <?php echo '$' . $cartInfo['cart_price']; ?>
                            </td>
                          
                        </tr>
                        <?php $total_price = $total_price + $cartInfo['cart_price'];
                    }
                    ?>

                    <tr class="bg_light_2">
                        <td colspan="5" class="v_align_m">
                            <div class="d_table w_full">
                                <div class="col-lg-9 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                    <p class="fw_light d_inline_m m_right_5 d_xs_block">Coupon Code:</p>
                                    <form class="d_inline_m">
                                        <input type="text" placeholder="Enter yout coupon code here" class="color_grey r_corners bg_light fw_light coupon m_xs_bottom_15">
                                        <button class="tr_all m_xs_bottom_10 r_corners color_purple transparent tt_uppercase button_type_5 fs_medium">Submit</button>
                                    </form>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_pink t_xs_align_c">
                                    Total:		
                                </div>
                            </div>
                        </td>
                        <td colspan="3" class="fw_ex_bold color_pink v_align_m"><?php echo '$' . $total_price; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Account</h4>
        <h5 class="color_dark fw_light m_bottom_23">Already Registered?</h5>
        <form class="m_bottom_45 m_xs_bottom_30">
            <ul>
                <li class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_8">
                        <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                        <input type="text" placeholder="Username" class="r_corners color_grey w_full fw_light">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_8">
                        <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                        <input type="password" placeholder="Password" class="r_corners color_grey w_full fw_light">
                    </div>
                </li>
                <li class="m_bottom_23">
                    <input type="checkbox" checked id="checkbox_2" name="" class="d_none">
                    <label for="checkbox_2" class="d_inline_m fs_medium fw_light">Remember me</label>
                </li>
                <li class="clearfix">
                    <button class="button_type_5 f_left m_right_20 tr_all color_blue transparent fs_medium r_corners">Login</button>
                    <div class="lh_medium">
                        <a href="#" class="color_scheme color_purple_hover d_inline_b m_bottom_3 fs_small">Forgot your password?</a><br>
                        <a href="#" class="color_scheme color_purple_hover fs_small">Forgot your username?</a>
                    </div>
                </li>
            </ul>
        </form>
        <div class="clearfix m_bottom_20">
            <h5 class="color_dark f_left fw_light">New Customer</h5>
            <p class="fw_light fs_medium f_right required_l">Required field</p>
        </div>
        <form class="m_bottom_40 m_bottom_30">
            <ul>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_1" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">E-mail</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="email" id="input_1" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_2" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Password</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="password" id="input_2" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_15">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Title</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_15 m_top_5 m_xs_top_0">
                        <input type="radio" checked id="radio_1" name="radio" class="d_none">
                        <label for="radio_1" class="d_inline_m m_right_15 m_bottom_3 fw_light">Mr.</label>
                        <input type="radio" id="radio_2" name="radio" class="d_none">
                        <label for="radio_2" class="d_inline_m m_right_15 m_bottom_3 fw_light">Ms.</label>
                        <input type="radio" id="radio_3" name="radio" class="d_none">
                        <label for="radio_3" class="d_inline_m m_right_15 m_bottom_3 fw_light">Miss</label>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_3" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">First Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_3" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_4" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Last Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_4" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Date of Birth</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10 clearfix">
                        <div class="custom_select f_xs_none w_xs_full m_xs_bottom_10 f_left fe_width_1 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Date</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">5</option>
                                <option value="...">...</option>
                            </select>
                        </div>
                        <div class="custom_select f_xs_none w_xs_full m_xs_bottom_10 f_left fe_width_1 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Month</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="Jully">Jully</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="custom_select f_xs_none w_xs_full m_xs_bottom_15 f_left fe_width_1 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Year</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none">
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 m_bottom_15">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Sign up for our newsletter</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-4 m_bottom_15">
                        <input type="checkbox" id="checkbox_3" name="" class="d_none">
                        <label for="checkbox_3" class="d_inline_m m_right_10 m_bottom_3 m_top_8 m_xs_top_0">&nbsp;</label>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 m_bottom_10 m_xs_bottom_0">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Receive special offers from our partners</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-4 m_bottom_10 m_xs_bottom_0">
                        <input type="checkbox" id="checkbox_4" name="" class="d_none">
                        <label for="checkbox_4" class="d_inline_m m_right_10 m_top_8 m_xs_top_0">&nbsp;</label>
                    </div>
                </li>
            </ul>
        </form>
        <h5 class="color_dark m_bottom_23 fw_light">Delivery Address</h5>
        <form class="m_bottom_12">
            <ul>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_5" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">First Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_5" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_6" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Last Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_6" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_7" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Company</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_7" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_8" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Address</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_8" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_9" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Address (Line 2)</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_9" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_10" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">City</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_10" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_11" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Zip / Postal code</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_11" class="r_corners fw_light color_grey w_full fe_width_1">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0">Country</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <div class="custom_select w_xs_full fe_width_2 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Please select</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none">
                                <option value="USA">USA</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="textarea_1" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Additional information</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <textarea id="textarea_1" class="r_corners height_5 fw_light color_grey w_full d_block"></textarea>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_11" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Home phone</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="i_11" class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_12" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Mobile phone</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10 m_xs_bottom_15">
                        <input type="text" id="i_12" class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 m_bottom_10">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0">Please use another address for invoice</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-4 m_bottom_10">
                        <input type="checkbox" id="checkbox_5" name="" class="d_none">
                        <label for="checkbox_5" class="d_inline_m m_right_10 m_top_8 m_xs_top_0">&nbsp;</label>
                    </div>
                </li>
            </ul>
        </form>
        <div class="bg_light_2 r_corners privacy m_bottom_20">
            <h5 class="color_dark m_bottom_23 fw_light">Customer Data Privacy</h5>
            <input type="checkbox" id="checkbox_6" name="" class="d_none">
            <label for="checkbox_6" class="d_inline_m fw_light">The personal data you provide is used to answer queries, process orders or allow access to specific information. You have the right to modify and delete all the personal information found in the "My Account" page. </label>
        </div>
        <button class="button_type_5 tr_all color_blue transparent fs_medium r_corners m_bottom_50 m_xs_bottom_30">Save</button>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_40 m_xs_bottom_30">
                <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Delivery Methods</h4>
                <h5 class="fw_light color_dark m_bottom_23">Choose Your Delivery Method</h5>
                <ul>
                    <li class="m_bottom_15">
                        <input type="radio" checked id="radio_4" name="method_1" class="d_none">
                        <label for="radio_4" class="d_inline_m m_right_15 m_bottom_3 fw_light">Delivery method 1 <span class="color_grey">(delivery next day) - $5.00 (tax incl.) </span></label>
                    </li>
                    <li>
                        <input type="radio" id="radio_5" name="method_1" class="d_none">
                        <label for="radio_5" class="d_inline_m m_right_15 m_bottom_3 fw_light">Delivery method 2 <span class="color_grey">(delivery in 2 days) - $2.00 (tax incl.) </span></label>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_40 m_xs_bottom_30">
                <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Payment Methods</h4>
                <h5 class="fw_light color_dark m_bottom_23">Choose Your Payment Method</h5>
                <ul>
                    <li class="m_bottom_15">
                        <input type="radio" checked id="radio_6" name="method_2" class="d_none">
                        <label for="radio_6" class="d_inline_m m_right_15 m_bottom_3 fw_light">Payment method 1</label>
                    </li>
                    <li>
                        <input type="radio" id="radio_7" name="method_2" class="d_none">
                        <label for="radio_7" class="d_inline_m m_right_15 m_bottom_3 fw_light">Payment method 2</label>
                    </li>
                </ul>
            </div>
        </div>
        <p class="fw_light m_bottom_3">Notes and special requests</p>
        <textarea class="r_corners height_5 fw_light color_grey w_full d_block m_bottom_10"></textarea>
        <div class="r_corners wrapper border_grey wrap_xs d_inline_b d_mxs_block m_bottom_15">
            <table class="t_align_l table_type_3">
                <tbody>
                    <tr class="tr_delay">
                        <td class="fw_light t_align_r">Total products:</td>
                        <td>$299.99</td>
                    </tr>
                    <tr class="tr_delay">
                        <td class="fw_light t_align_r">Total shipping:</td>
                        <td>$2.00</td>
                    </tr>
                    <tr class="tr_delay">
                        <td class="fw_light t_align_r">Total (tax excl.):</td>
                        <td>$290.00</td>
                    </tr>
                    <tr class="tr_delay">
                        <td class="fw_light t_align_r">Total tax:</td>
                        <td>$9.99</td>
                    </tr>
                    <tr class="bg_light_2">
                        <td class="fw_light t_align_r"><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total:</p></td>
                        <td><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">$299.99</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="m_bottom_23">
            <input type="checkbox" id="checkbox_7" name="" class="d_none">
            <label for="checkbox_7" class="d_inline_m fw_light">I agree to the Terms of Service </label>
            <p class="d_inline_m fw_light">(<a href="#" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>
        </div>
        <a href="#" class="button_type_3 tr_all color_pink r_corners tt_uppercase d_inline_b fs_medium mini_side_offset">
            <i class="icon-check fs_large d_inline_b m_right_10"></i>
            Checkout Now
        </a>
    </div>
</div>



<?php
include 'footer.php'
?>