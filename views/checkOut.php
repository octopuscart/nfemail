<?php
include 'header.php';
include '../producthandler/shippingHandler.php';
$addobj = new AddressHandler();

?>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper">
    <div class="container">
        <h4 style="color: #1FB8C6 !important; font-weight: 200px">CheckOut</h4>
        <!--breadcrumbs-->
        <ul class="hr_list d_inline_m breadcrumbs">
            <li class="m_right_8 f_xs_none"><a href="index.html" class="color_default d_inline_m m_right_10">ABC Design</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
           
            <li><a class="color_default d_inline_m">checkout</a></li>
        </ul>
    </div>
    
    <div style="background-color: rgba(78, 76, 160, 0.701961); height: 30px; margin-top: 15px;"><h6 class="color_light fw_light" style="padding: 4px;">Checkout</h6></div>
    
</section>

<div class="section_offset counter" style="padding: 0px;">
<div class="container">
 <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Billing Deatil</h4>

        <h5 class="color_dark m_bottom_23 fw_light">Billing Address</h5>
        <form class="m_bottom_12" method="post">
            <ul>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_5" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">First Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_5" name="first_name" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_6" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Last Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="last_name" id="input_6" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_7" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0 " style="font-weight: 400;">Company</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="company_name" id="input_7" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_8" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Address</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="address1" id="input_8" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_9" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Address (Line 2)</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="address2" id="input_9" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_10" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Town/City</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="city" id="input_10" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_11" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Zip / Postal code</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" name="zip" id="input_11" class="r_corners fw_light color_grey w_full fe_width_1">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Country</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <div class="custom_select w_xs_full fe_width_2 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Please select</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none" name="country">
                                <option value="USA">USA</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="textarea_1" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Additional information</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <textarea id="textarea_1" class="r_corners height_5 fw_light color_grey w_full d_block"></textarea>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_11" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Email Id</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="email" name="email_id" id="i_11"  class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_12" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Mobile phone</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10 m_xs_bottom_15">
                        <input type="text" name="mobile_no" id="i_12" class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 m_bottom_10">
                        <label class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400; font-size: 22px;">Ship to a different address?</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-4 m_bottom_10">
                        <input type="checkbox" id="checkbox_5" name="shipping_add" class="d_none" value="1">
                        <label for="checkbox_5" class="d_inline_m m_right_10 m_top_8 m_xs_top_0">&nbsp;</label>
                    </div>
                </li>
            </ul>
       
        
        <div id="secend_address" style="display: none">
               <h5 class="color_dark m_bottom_23 fw_light">Delivery Address</h5>
 
            <ul>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_5" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">First Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_5"  name="s_first_name" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_6" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Last Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_6" name="s_last_name" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_7" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Company</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_7" name="s_company_name" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_8" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Address</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_8" name="s_address1" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_9" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Address (Line 2)</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_9" name="s_address2" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_10" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Town/City</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_10" name="s_city" class="r_corners fw_light color_grey w_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="input_11" class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Zip / Postal code</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="text" id="input_11" name="s_zip" class="r_corners fw_light color_grey w_full fe_width_1">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label class="required d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Country</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <div class="custom_select w_xs_full fe_width_2 m_right_10">
                            <div class="select_title r_corners fw_light color_grey">Please select</div>
                            <ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>
                            <select class="d_none" name="s_country">
                                <option value="USA">USA</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="textarea_1" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Additional information</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <textarea id="textarea_1" class="r_corners height_5 fw_light color_grey w_full d_block"></textarea>
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_11" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Email Id</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10">
                        <input type="email" id="i_11" name="s_email_id" class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
                <li class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_10">
                        <label for="i_12" class="d_inline_b fw_light w_full m_top_8 m_xs_top_0" style="font-weight: 400;">Mobile phone</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_10 m_xs_bottom_15">
                        <input type="text" id="i_12" name="s_mobile_no" class="r_corners fw_light color_grey fe_width_2 w_xs_full">
                    </div>
                </li>
            
            </ul>
      
            
        </div>
        


<button type="submit" name="submit" class="button_type_5 tr_all color_blue transparent fs_medium r_corners m_bottom_50 m_xs_bottom_30">Save</button>
</form>
        
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
         <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_40 m_xs_bottom_30">
           <h4 class="title_counter_type r_corners wrapper m_bottom_23 bg_light_2 counter_inc color_dark">Your Order</h4>
           <div class="r_corners wrapper border_grey wrap_xs d_inline_b d_mxs_block m_bottom_15" style=" width: 208%;">
               <table class="t_align_l table_type_3" style="width: 100%;text-align: center;">
                   <thead>
                       <tr>
                           <th style="width: 50%;text-align: center;">Product</th>
                           <th style="text-align: center;">Total</th>
                       </tr>
                   </thead>
                <tbody>
                    <tr class="tr_delay">
                        <td>Total products:</td>
                        <td>$299.99</td>
                    </tr>
                    <tr class="tr_delay">
                        <td>Total shipping:</td>
                        <td>$2.00</td>
                    </tr>
                    <tr class="tr_delay">
                        <td>Total (tax excl.):</td>
                        <td>$290.00</td>
                    </tr>
                    <tr class="tr_delay">
                        <td>Total tax:</td>
                        <td>$9.99</td>
                    </tr>
                    <tr class="bg_light_2">
                        <td><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">Total:</p></td>
                        <td><p class="fw_ex_bold color_pink m_top_10 m_bottom_10">$299.99</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
           <!-------    --->
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
      
        
</div>

<script>

$('#checkbox_5').click( function(){
    if(this.checked){
            $('#secend_address').show();
        }
        else{
            $('#secend_address').hide();
        }
//    $('#secend_address').show();
});
</script>
<?php
$addobj->billing_shipping_addres($_POST);
include 'footer.php';
?>
