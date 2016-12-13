<?php
include 'header.php';
include '../producthandler/productHandler.php';
##############
$userInfo = $authobj->userProfile($_SESSION['user_id']);
#############
$customer_order_detail = $authobj->userWholeOrderDetail($_REQUEST['order_id'], $_SESSION['user_id']);
//print_r($customer_order_detail);
$productId = $authobj->findProductId($_SESSION['user_id'], $_REQUEST['order_id']);
//print_r($productId);
$allCartId = $authobj->allCartId($_SESSION['user_id'], $_REQUEST['order_id']);

$invoice_data = $authobj->invoiceOrderDetail($_SESSION['user_id'], $_REQUEST['order_id']);
if (isset($_REQUEST['cancel_order'])) {
//echo $_REQUEST['cancel_order'];
    $authobj->cancelOrder($_SESSION['user_id'], $_REQUEST['order_id']);
// $authobj->orderConfirmCancellationMail($order_id,$_SESSION['user_id'],"Order Deleted");
// header('location:index.php');
}
?>
<style>
    .addr tr{
        border: none;
    }
    .addr td{
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 0px;
        border: none;
    }
</style>
<style>
    .close{
        opacity: 1;
    }
    .modal-header{
        padding: 8px 9px;
        background: black;
    }
    .tds{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        //border-bottom: 1px solid;


    }
</style>

<style>
    .fw_light{
        font-size: 15px;
        color: #000;
    }

    .selectall input[type="checkbox"] + label:before {
        content: '';
        font-family: "fontello";
        display: block;
        position: absolute;
        background: #F00;
        top: -6px;
        left: -2px;
        width: 22px;
        height: 23px;
        border: 2px solid #cc0000;
    }

    .lableall:after {
        content: '\e914';
        font-family: "fontello";
        position: absolute;
        left: 11px!important;
        top: -14px!important;
        font-size: 33px;
        display: none;
        color: #fff;
    }
    .title_counter_type:before {
        content: counter(counter);
        font-style: italic;
        color: #fff;
        position: absolute;
        left: 0;
        padding: 7px 0;
        height: 79%;
        width: 38px;
        text-align: center;
        top: 0;
    }
    .table_type_2 td:not([colspan]){
        padding: 6px;
    }

</style>
<!--page title-->
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 35px 0px 0px 0px;">
    <div class="container">
        <h4>Thank you for your order!</h4>
        <h5 style="    font-weight: 300;
    font-size: 46px;">Order has been confirmed.</h5>
        <!--breadcrumbs-->
        <small>Here's a summary of your purchase. When we process or ship order, we will send an update with tracking details.</small>
    </div>
</section>
<!--content-->
<div class="section_offset counter" style="margin-top: -51px;">
    <div class="container">
        <div class="row">
            <!--            <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30"></aside>-->
            <section class="col-lg-12 col-md-12 col-sm-12 m_bottom_70 m_xs_bottom_30">
                <form method="post" style="margin-left:30px">

                    <span data-toggle="" data-placement="left" title="View Pdf"><a href="./viewOrDownloadOrderPdf.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&option=I"  id ="num_to_word" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" target="_blank" class="btn btn-default btn-xm " ><i class="icon-eye" ></i></a></span>
                    <span data-toggle="" data-placement="left" title="Download Pdf"> <a href="./viewOrDownloadOrderPdf.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&option=D" id="num_to_word1" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm " ><i class="icon-download"></i></a></span>
                    <span data-toggle="" data-placement="left" title="Send Mail"><a href="sendMail.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>" id="num_to_word2"  style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                    <button data-toggle="" name="cancel_order" data-placement="left" title="Cancel Order"><a href=""  style="padding: 0px 4px 4px 4px;;height: 22px;width: 26px;" class="btn btn-default" ><i class="icon-cancel"></i></a></button>
                </form> 
                <div style="clear:both"></div>

                <div class="col-md-12" style="margin-top:6px">
                    <div class="col-md-4">
                        <div class="panel panel-default" style="height: ">
                            <div class="panel-heading">
                                <h3 class="panel-title">Order Information</h3>
                            </div>
                            <div class="panel-body">
                                <table class="addr">
                                    <tr>
                                        <td>Invoice No.</td>
                                        <td>:</td>
                                        <td style=""><?php echo $invoice_data[0]['invoice_no'] ?></td>
                                    </tr>

                                    <tr>
                                        <td><span>Date,Time</span></td>
                                        <td>:</td>
                                        <td><?php echo $customer_order_detail[0]['op_date'] . "," . $customer_order_detail[0]['op_time'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Currency</td>
                                        <td>:</td>
                                        <td>USD</td>
                                    </tr>
                                    <tr>
                                        <td>Order No.</td>
                                        <td>:</td>
                                        <td><?php echo $customer_order_detail[0]['order_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Client Code</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['registration_id']; ?> </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default" style="height:">
                            <div class="panel-heading">
                                <h3 class="panel-title">Shipping Addresses</h3>
                            </div>
                            <div class="panel-body">

                                <address>
                                    <strong style="text-transform: capitalize;">
                                        <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                    </strong><br>
                                    <?php echo $customer_order_detail[0]['add11']; ?><br>
                                    <?php echo $customer_order_detail[0]['add22']; ?><br>
                                    <?php echo $customer_order_detail[0]['add33']; ?><br>
                                    <?php echo $customer_order_detail[0]['add44']; ?><br>


                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default" style="height: ">
                            <div class="panel-heading">
                                <h3 class="panel-title">Billing Addresses</h3>
                            </div>
                            <div class="panel-body">

                                <address>
                                    <strong style="text-transform: capitalize;">
                                        <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                    </strong><br>
                                    <?php echo $customer_order_detail[0]['add1']; ?><br>
                                    <?php echo $customer_order_detail[0]['add2']; ?><br>
                                    <?php echo $customer_order_detail[0]['add3']; ?><br>
                                    <?php echo $customer_order_detail[0]['add4']; ?><br>


                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="clear: both"></div>
                <!-- end -->
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="panel panel-default" style="margin-bottom: -1px;">

                            <div class="panel-heading">
                                <h3 class="panel-title">Order Description</h3>
                            </div>
                        </div>        
                        <div class="row" >
                            <div class="col-xs-12 table-responsive">
                                <table class="table_type_2 responsive_table w_full t_align_c" style="    border-style: solid;border-color: whitesmoke;">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th style="width:0px;text-align: center"><b>S.No.</b></th>
                                            <th style="width:0px;text-align: center"><b>SKU</b></th>
                                            <th style="width:0px;text-align: center"><b>Item Code</b></th>
                                            <th style="width:0px;text-align: center"><b>Item Image</b></th>
                                            <th style="width:0px;text-align: center"><b>Item Name</b></th>
                                            <th style="width:0px;text-align: center"><b>Style Id/Measurement Profile</b></th>
                                            <th style="width:0px;text-align: center"><b>Qty.</b></th> 
                                            <th style="width:0px;text-align: center"><b>Price</b></th>
                                            <th style="width:0px;text-align: center"><b>Extra Price</b></th>
                                            <th style="width:0px;text-align: center"><b>Total Price<b/></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cartprd = new CartHandler();
                                        for ($i = 0; $i < count($productId); $i++) {
                                            //echo "ffdgdg";
                                            //print_r($productId[$i]);
                                            $cartID = $productId[$i]['id'];
                                            $styleids = $productId[$i]['style_profile'];
                                            //print_r($styleids);
                                            $cartInfo = $cartprd->cartProductsInformation($cartID, $_SESSION['user_id']);

                                            //  print_r($cartInfo);
                                            ?>      

                                            <tr id="trId" style="font-size:13px">
                                                <td><?php echo $i + 1 ?></td>
                                                <td>
                                                    <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['sku']; ?></a></p>

                                                </td>
                                                <td><?php echo $cartInfo['sku']; ?></td>
                                                <td>
                                                    <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height: 50px;width: 50px;">
                                                </td>

                                                <td>
                                                    <?php $res = $cartprd->productCatTagId($cartInfo['cart_product_id']); ?>
                                                    <p><?php echo $res[0]['tag_title']; ?></p>
                                                </td>
                                                <?php $profile = $authobj->profile_name($cartInfo['measurement_id']); ?>
                                                <td style="font-size: 11px;text-align: center">  
                                                    <table class="addr">
                                                        <tr style="font-size: 11px">
                                                            <td>Style Id</td>
                                                            <td>:</td>
                                                            <td><?php echo $styleids; ?></td>
                                                        </tr>
                                                        <tr style="font-size: 12px">
                                                            <td>Measurement Profile</td>
                                                            <td>:</td>
                                                            <td><?php echo $profile['measurement_profile'] ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="qu">
                                                    <?php echo $cartInfo['quantity']; ?>
                                                </td>
                                                <td class="p">

                                                    <?php
                                                    $tot = $cartInfo['price'];
                                                    echo '$' . $tot . '.00';
                                                    ?>
                                                </td>
                                                <td class="qu">
                                                    <?php
                                                    if ($cartInfo['extra_price'] > 0) {
                                                        echo '$' . $cartInfo['extra_price'] . ".00";
                                                        ?>

                                                        <br/>

                                                        <button name="extra_detail" class="btn btn-default btn-xs btn-xs"  value="<?php echo $cartInfo['customization_id'] ?>" data-toggle="modal" data-target="#myModal_<?php echo $cartInfo['customization_id'] ?>__<?php echo $i; ?> ">
                                                            View Detail
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?php echo $cartInfo['customization_id'] ?>__<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post">
                                                                        <div class="modal-header" style="color: white">
                                                                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                &times;
                                                                            </button>
                                                                            <p class="modal-title" id="myModalLabel" style="text-align:left">
                                                                                <span><?php echo ucwords($res[0]['tag_title']); ?>  SKU: <?php echo $cartInfo['sku']; ?>  Extra Price Detail</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                             <table class="table table-bordered" id="">

                                                                                <?php
                                                                                $final_data = $authobj->styleIdWithCustomizationID($cartInfo['customization_id']);
                                                                                $data = $final_data[0]['custom_form_data'];
                                                                                $data2 = $final_data[0]['custom_form_data_price'];
                                                                                $final2 = phpjsonstyle($data, 'php');
                                                                                $price_data = phpjsonstyle($data2, 'php');
                                                                                $temp = array();
                                                                                foreach ($price_data as $k => $v) {
                                                                                    if (is_numeric($v)) {
                                                                                        if ($v > 0) {
                                                                                            $temp[$k] = $v;
                                                                                        }
                                                                                    }
                                                                                }
                                                                                foreach ($temp as $key => $value) {
                                                                                    if (array_key_exists($key, $final2)) {
                                                                                        ?>

                                                                                        <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px">
                                                                                            <td class="tds"><?php echo $key; ?></td>
                                                                                            <td class="tds"><?php echo $final2[$key]; ?></td>
                                                                                            <td class="tds"><?php echo '$'.$value; ?></td>
                                                                                        </tr> 
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </table>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" 
                                                                                    data-dismiss="modal">Close
                                                                            </button>

                                                                        </div>
                                                                    </form>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        <!-- End -->

                                                    <?php } else { ?>
                                                        $0.00
                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <?php
                                                    $tot2 = $cartInfo['cart_price'];
                                                    echo '$' . $tot2 . ".00"
                                                    ?>
                                                </td>

                                            </tr>

                                            <?php
                                            $totals = $totals + $cartInfo['cart_price'];
                                            //echo $totals;
                                        }
                                        $out_data = $authobj->coupanDetail($customer_order_detail[0]['coupon_id'], $totals);
//print_r($out_data);
                                        ?>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Sub Total</td>
                                            <td colspan="1" id="to1"><?php echo '$' . number_format($totals, 2, '.', ''); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Tax / Custom</td>
                                            <td colspan="1" id="to2">$00.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Discount / Coupon No.</td>
                                            <td colspan="1" id="to3"><?php
                                                if ($out_data) {
                                                    echo '$' . number_format($out_data, 2, '.', '');  ;
                                                } else {
                                                    ?>$00.00<?php } ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Shipping Price</td>
                                            <td colspan="1" id="to4">$00.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">My Wallet</td>
                                            <td colspan="1" id="to4">$00.00</td>
                                        </tr>
                                        <tr class="bg_light_2">
                                            <td colspan="9" class="v_align_m">
                                                <div class="d_table w_full">
                                                    <div class="col-lg-9 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                                        <p class="fw_light d_inline_m m_right_5 d_xs_block"></p>
                                                        <form class="d_inline_m">

                                                        </form>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_pink t_xs_align_c">
                                                        Grand Total	
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="1" class="fw_ex_bold color_pink v_align_m" id="totalt4">
                                                <?php
                                                if ($out_data) {
                                                    $t = ($totals - $out_data);
                                                    echo '$'.number_format($t, 2, '.', '');
                                                } else {
                                                    echo  '$'.number_format($totals, 2, '.', '');
                                                    } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                </div>
            </section>
        </div>
        <!--banners-->
        <div class="col-md-12" style="margin: 0px 0px 0px 22px;">
            <section class="row t_xs_align_c">
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_1.jpg" alt=""></a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_2.jpg" alt=""></a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_0">
                    <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="../assets/images/banner_3.jpg" alt=""></a>
                </div>
            </section>
        </div>

    </div>
</div>

<?php
include 'footer.php';
?>


<script>
    $(function () {
        $("#trId").each(function () {
            var price = $(".p").text();
            var pp = price.slice('$')
            var extra = $(".ep").text();
            var qun = $(".qu").text();

        });
    });
</script>
<script>
    $(function () {
        var res = Number($('#to1').text().split('$')[1]) + Number($('#to2').text().split('$')[1]) - Number($('#to3').text().split('$')[1]) + Number($('#to4').text().split('$')[1]);

        $("#totalt").text('$' + res + '.00');

    });

</script>
<script>
    $(function () {
        var num = '<?php echo $customer_order_detail[0]['total_price'] ?>'
        var val1 = num.split('$');
        var val = toWords(val1[1]);

        var b = $("#num_to_word").attr('href');
        var c = b + '&number1=' + val;
        //console.log(c);
        $("#num_to_word").attr('href', c)
        ///////////////////////////////
        var b2 = $("#num_to_word1").attr('href');
        var c2 = b2 + '&number1=' + val;
        //console.log(c);
        $("#num_to_word1").attr('href', c2)
        ///////////////////////////////
        var b1 = $("#num_to_word2").attr('href');
        var c1 = b1 + '&number1=' + val;
        //console.log(c);
        $("#num_to_word2").attr('href', c1)


    })
</script>
<script>
    function extraPriceDetail(obj) {
        var tableName = obj.id;
        var extraPrice = obj.value;
        var breakTable = tableName;
        breakTable = breakTable.split("_")[1]
        $("#tablename").html(breakTable);
        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'extraPrice': extraPrice, 'tableName': tableName},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                var htmls = '';
                $.each(data, function (key, value) {
                    $.each(value, function (key, value) {
                        var str1 = value;
                        //console.log(str1);
                        var str2 = '$';
                        // console.log(key, value);
                        if (str1.indexOf(str2) != -1) {

                            var keyData = key;
                            var keyData = key.split("_").join(" ");
                            var data1 = value.split("(")[0]
                            var data = value.split("(")[1].split(')');
                            //console.log(data);
                            //  console.log(data[1].split(')'));
                            htmls += '<tr>';
                            htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                            htmls += '<td>' + data1 + '</td>';
                            htmls += '<td>' + data[0] + '</td>';
                            htmls += '</tr>';
                        }
                    });
                });
                $('.customizeData').html(htmls);
            }

        });
    }

</script>