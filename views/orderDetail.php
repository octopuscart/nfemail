<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
include 'header.php';
include '../producthandler/productHandler.php';
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {

    $cartprd = new CartHandler();
    $result = $cartprd->cartId($_SESSION['user_id'], $_REQUEST['order_id']);
    //$productId = $authobj->findProductId($_SESSION['user_id'], $_REQUEST['order_id']);
    $orderDatas = $authobj->order_product_detail($_REQUEST['order_id'], $_SESSION['user_id']);
    $orderDetail = $authobj->userWholeOrderDetail($_REQUEST['order_id'], $_SESSION['user_id']);
    //print_r($orderDetail);
    $userInfo = phpjsonstyle($orderDetail[0]['user_info'], 'php');
    $shipping = phpjsonstyle($orderDetail[0]['shipping_id'], 'php');
    $biling = phpjsonstyle($orderDetail[0]['billing_id'], 'php');
    $invoice_data = $authobj->invoiceOrderDetail($_SESSION['user_id'], $_REQUEST['order_id']);
    $status = $authobj->OrderStatusValue($_REQUEST['order_id']);
    //print_r($status);

    if (isset($_REQUEST['cancel_order'])) {
        echo $_REQUEST['cancel_order'];
        $authobj->cancelOrder($_SESSION['user_id'], $_REQUEST['order_id']);
    }
    ?>

    <?php
    $id = $_REQUEST['order_id'];
    $query1 = ' SELECT ost.id as status_tag,ost.title AS order_status, os.remark,  os.id as status_id,
                      os.op_date_time as date
                             FROM nfw_order_status AS os
                             JOIN nfw_order_status_tag AS ost ON os.status = ost.id
                             WHERE os.order_id =' . $id;

    $query2 = 'SELECT ost.id as status_tag,ost.title AS order_status, os.remark,  os.id as status_id,
                        os.op_date_time as date
                            FROM nfw_order_status_tag AS ost
                            JOIN nfw_old_order_status AS os ON os.status = ost.id
                            WHERE os.order_id = ' . $id . '
                  order by status_id desc ';
    $order_status_record1 = resultAssociate($query1);
    $order_status_record2 = resultAssociate($query2);
    $order_status_record = array_merge($order_status_record1, $order_status_record2);
    ?>

    <?php
    $count = 0;
    $currentStatus = $order_status_record[0]['status_tag'];
    ?> 


    <style>
        .close{
            opacity: 1;
        }
        .modal-header{
            padding: 3px 19px;
            background: black;
        }
        .tds{
            padding: 8px;
            line-height: 0.42857143 !important;
            vertical-align: top;
            border-bottom: 1px solid;


        }
        .table_type_2 td:not([colspan]){
            padding: 6px;
        }


    </style>
    <style>
        .addr tr{
            border: none;
        }
        .addr td{
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 0px;
            border: none;
            padding-right: 4px !important;
        }
        .hr{
            height: 0px;
        }
        .tb tr{
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 0px;
            border: none;
        }
        .tb td{
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left:0px;
            border: none;
            padding-right: 4px !important;
        }
    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
            <p style="color: black">Order Detail</p>
            <div style="margin-top: 10px;"></div>
        </div>
    </section>

    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
                    <?php
                    include 'leftMenu.php';
                    ?>
                </aside>
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">


                    <form method="post" action="#">

                        <span data-toggle="" data-placement="left" title="View Pdf"><a href="./viewOrDownloadOrderPdf.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id']; ?>&option=I"  id ="num_to_word" style="padding: 0px 20px 14px 5px;height: 22px;width:0px;background-color: black;
                                                                                       color: white;" class="btn btn-default btn-xm " target="_blank" ><i class="icon-eye"></i></a></span>
                        <span data-toggle="" data-placement="left" title="Download Pdf"> <a href="./viewOrDownloadOrderPdf.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&option=D" id="num_to_word1" style="padding: 0px 20px 14px 5px;height: 22px;width:0px;background-color: black;
                                                                                            color: white;" class="btn btn-default btn-xm " ><i class="icon-download"></i></a></span>
                        <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./sendMail.php?order_id=<?php echo $_REQUEST['order_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&mail_type=1&mail_set=order" id="num_to_word2"  style="padding: 0px 20px 14px 5px;height: 22px;width:0px;background-color: black;
                                                                                         color: white;" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>

                        <?php
                        if ($currentStatus == 1) {
                            ?>
                            <button data-toggle="" name="cancel_order" style="
                                    padding: 0px 15px 7px 8px;
                                    height: 22px;
                                    width: 0px;
                                    background-color: red;
                                    color: white;
                                    " class="btn btn-default btn-xm " data-placement="left" title="Cancel Order"><i class="icon-cancel"></i></button>
                                <?php } ?>
                    </form>
                    <div style="clear:both"></div>
                    <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <strong>Shipping Address</strong><br>

                                <?php echo $shipping['address1'] . ',' ?><br/>
                                <?php echo $shipping['address2'] . ',' ?><br/>
                                <?php echo $shipping['city'] . ', ' . $shipping['state'] . ',' ?><br/>
                                <?php echo $shipping['country'] ?><br/>
                                <?php echo $shipping['zip'] ?><br/>
                                <table class="tb">
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo['contact_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo['fax_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo['email'] ?></td>
                                    </tr>
                                </table>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <!--                            <address>
                                                            <strong>Billing Address</strong><br>
                            <?php echo $biling['address1'] . ',' ?><br/>
                            <?php echo $biling['address2'] . ',' ?><br/>
                            <?php echo $biling['city'] . ', ' . $biling['state'] . ',' ?><br/>
                            <?php echo $biling['country'] ?><br/>
                            <?php echo $biling['zip'] ?><br/>
                            
                                                            <table class="tb">
                                                                <tr>
                                                                    <td>Contact No.</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['contact_no'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fax</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['fax_no'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['email'] ?></td>
                                                                </tr>
                                                            </table>
                            
                            
                                                        </address>-->
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <b>Invoice Information</b><br/>

                            <table class="addr">
                                <tr>
                                    <td>Invoice No.</td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['invoice_no'] ?><br/></td>
                                </tr>
                                <tr>
                                    <td><span>Date/Time</span></td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['op_date'] ?><br/>
                                        <?php echo $invoice_data[0]['op_time'] ?></td>
                                </tr>


                                <tr>
                                    <td>Currency</td>
                                    <td>:</td>
                                    <td>US$</td>
                                </tr>
                                <tr>
                                    <td>Order No.</td>
                                    <td>:</td>
                                    <td><?php echo $orderDetail[0]['order_no'] ?></td>
                                </tr>
                                <tr>
                                    <td>Client Code</td>
                                    <td>:</td>
                                    <td><?php echo $userInfo['registration_id']; ?> </td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>:</td>
                                    <td><?php echo $orderDetail[0]['payment_gateway'] ?></td>
                                </tr>

                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <hr>

                    <div class="col-md-12" style="    padding: 5px 5px;
                         border: 1px solid #000;
                         margin-bottom: 18px;
                         border-radius: 5px;">
                        <p style="    border-bottom: 1px solid #000;">Order Status</p>

                        <style>
                            .orderstatustable th{
                                border: none;
                            }
                            .orderstatustable td{
                                border: none;

                            }
                            .orderstatustable tr{
                                border-bottom: 1px solid #D8D8D8;;
                            }
                        </style>

                        <table class="orderstatustable" style="    width: 100%;">

                            <?php
                            $proccessArray = [];
                            $temp = ($order_status_record);
                            foreach ($temp as $key => $value) {
                                $ht = "<tr '>";
                                $ht.= "<td style='width:170px'>" . $value['date'] . "</td>";
                                $ht.= "<td style='      border-left: 1px solid;padding: 0;width: 1px; padding-top: 12px; '><i class='icon-circle' style='margin-left: -25px;margin-left: -11px;    font-size: 25px;
    margin-top: 11px;'></i></td>";
                                $ht.= '<th>' . $value['order_status'] . ' <br><small style="font-weight:300;font-size:13px">' . $value['remark'] . '</small> </th>';


                                array_push($proccessArray, $ht);
                            }
                            $proccessStatus = implode('', $proccessArray);
                            echo $proccessStatus;
                            echo "</td></tr>";
                            ?>
                        </table>

                    </div>
                    <div style="clear: both"></div>

                    <div class="panel panel-default" style="margin-bottom: -23px;">

                        <div class="panel-heading">
                            <h3 class="panel-title">Order Description</h3>
                        </div>

                        <div class="row" style=" margin-top:0px;">
                            <div class="col-xs-12 table-responsive">
                                <table class="table_type_2 responsive_table w_full t_align_c" style="border-style: solid;border-color: whitesmoke;">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th style="width:0%;text-align: center"><b>S.No.</b></th>
                                            <th style="width:7%;text-align: center"><b>SKU</b></th>
                                            <th style="width:18%;text-align: center"><b>Item Code</b></th>
                                            <th style="width:18%;text-align: center"><b>Item Image</b></th>
                                            <th style="width:17%;text-align: center"><b>Item Name</b></th>
                                            <th style="width:40%;text-align: center"><b>Style Id / Measurement Profile</b></th>
                                            <th style="width:3%;text-align: center"><b>Qty.</b></th> 
                                            <th style="width:6%;text-align: center"><b>Price</b></th>
                                            <th style="width:13%;text-align: center"><b>Extra Price</b></th>
                                            <th style="width:12%;text-align: center"><b>Total Price<b/></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //  $cartprd = new CartHandler();
                                        for ($i = 0; $i < count($orderDatas); $i++) {

                                            $cartInfo = $orderDatas[$i];
                                            //print_r($cartInfo);
                                            ?>      

                                            <tr id="trId" style="font-size:13px">
                                                <td><?php echo $i + 1 ?></td>
                                                <td>
                                                    <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['item_code']; ?></a></p>

                                                </td>
                                                <td><?php echo $cartInfo['item_code']; ?></td>
                                                <td>
                                                    <img src="<?php echo $cartInfo['item_image']; ?>" alt="" style="height: 35px;width: 35px;">
                                                </td>

                                                <td>

                                                    <p><?php echo $cartInfo['tag_title']; ?></p>
                                                </td>
                                                <td style="font-size: 11px;text-align: center">  
                                                    <style>
                                                        .measurement_style{
                                                            padding: 0px!important;
                                                            text-align: left;
                                                        }
                                                    </style>
                                                    <table class="addr measurement_style">
                                                        <tr style="font-size: 11px">
                                                            <td class="measurement_style">Style Id</td>
                                                            <td class="measurement_style">:</td>
                                                            <td class="measurement_style"><?php echo $cartInfo['customization_id']; ?></td>
                                                        </tr>
                                                        <tr style="font-size: 12px">
                                                            <td class="measurement_style">Measurement Profile</td>
                                                            <td class="measurement_style">:</td>
                                                            <td class="measurement_style"><?php echo $cartInfo['measurement_id']; ?></td>
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

                                                        <button name="extra_detail" class="btn btn-default btn-xs btn-xs"  value="<?php echo $cartInfo['id'] ?>" data-toggle="modal" data-target="#myModal_<?php echo $cartInfo['id'] ?>__<?php echo $i; ?> ">
                                                            View Detail
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?php echo $cartInfo['id'] ?>__<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post" action="#">
                                                                        <div class="modal-header" style="color: white">
                                                                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                &times;
                                                                            </button>
                                                                            <p class="modal-title" id="myModalLabel" style="">
                                                                                <span><?php echo ucwords($cartInfo['tag_title']); ?>  SKU: <?php echo $cartInfo['sku']; ?>  Extra Price Detail</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="modal-body">


                                                                            <table class="table table-bordered" id="">

                                                                                <?php
                                                                                $data = $cartInfo['customization_data'];
                                                                                //print_r($data);
                                                                                $data2 = $cartInfo['customization_data_price'];
                                                                                // print_r($data2);
                                                                                $final2 = phpjsonstyle($data, 'php');
                                                                                $price_data = phpjsonstyle($data2, 'php');
                                                                                //print_r($price_data);
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
                                                                                            <td class="tds"><?php echo '$' . $value; ?></td>
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
                                                        $00.00
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
                                        $out_data = $authobj->coupanDetail($orderDetail[0]['coupon_id'], $totals);
//print_r($out_data);
                                        ?>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Sub Total</td>
                                            <td colspan="1" id="sub_total">

                                                <?php
                                                $ttt = number_format($totals, 2, '.', '');
                                                echo '$' . $ttt;
                                                ?>
                                            </td>
                                        </tr>
    <!--                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Tax/Custom</td>
                                            <td colspan="1" id="to2">$00.00</td>
                                        </tr>-->
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Coupon Discount</td>
                                            <td colspan="1" id="discount"><?php
                                                if ($out_data) {
                                                    echo '$' . number_format($out_data, 2, '.', '');
                                                } else {
                                                    ?>$00.00<?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">Shipping Price</td>
                                            <td colspan="1" id="shipping">
                                                <?php echo '$' . $orderDetail[0]['shipping_amount'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="t_align_r fw_light">My Wallet</td>
                                            <td colspan="1" id="wallet"><?php
                                                if ($orderDetail[0]['wallet_amount']) {
                                                    echo '$' . number_format($orderDetail[0]['wallet_amount'], 2, '.', '');
                                                } else {
                                                    echo "$00.00";
                                                }
                                                ?></td>
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
                                            <td colspan="1" class="fw_ex_bold color_pink v_align_m" id="final_amount">
                                                <?php
                                                echo $orderDetail[0]['total_price'];
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div style="clear:both"></div>
                    </div>
                </div>



                <!--banners-->
            </div>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>

<script>
//    $(function () {
//        var sb = $("#sub_total").text().split('$')[1];
//       // console.log(sb);
//        var dc = $("#discount").text().split('$')[1];
//         //console.log(dc);
//        var wl = $("#wallet").text().split('$')[1];
//        //console.log(wl);
//        var res = Number(sb) - Number(dc) - Number(wl);
//        var f1 = Number(res) + Number($("#shipping").text().split('$')[1]);
//        var tot = f1.toFixed(2);
//       // console.log(tot);
//        
//        $("#final_amount").text('$'+tot);
//    });

</script>
<script>
    $(function () {
        var num = '<?php echo $orderDetail[0]['total_price'] ?>'
        var val1 = num.split('$');

        var val = toWords(val1[1]);
        var b = $("#num_to_word").attr('href');
        var c = b + '&number1=' + val;
        //console.log(c);
        $("#num_to_word").attr('href', c)
        ///////////////////////////////
        var b1 = $("#num_to_word1").attr('href');
        var c1 = b1 + '&number1=' + val;
        //console.log(c);
        $("#num_to_word1").attr('href', c1)
        ///////////////////////////////
        var b2 = $("#num_to_word2").attr('href');
        var c2 = b2 + '&number1=' + val;
        //console.log(c);
        $("#num_to_word2").attr('href', c2)



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
                        var str2 = '$';
                        // console.log(key, value);
                        if (str1.indexOf(str2) != -1) {

                            var keyData = key;
                            var keyData = key.split("_").join(" ");
                            var data1 = value.split("(")[0]
                            var data = value.split("(")[1].split(')');
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