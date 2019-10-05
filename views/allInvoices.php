<?php
include 'header.php';
include '../producthandler/productHandler.php';

$userInfo = $authobj->userProfile($_SESSION['user_id']);

if ($_SESSION['user_id'] == '') {
    ?>

    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {
    $order_data = $authobj->allOrderDetails($_SESSION['user_id']);
    $cart_obj = new CartHandler();
    $catObj = new CategoryHandler();
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">All Invoices</p>
            <div style="margin-top: 10px;"></div>
        </div>
    </section>
    <style>
        .test th{
            border:none;
        }
        .test td{
            border:none;
        }
        .element.style {
        }
        .pagination>.active>a, 
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span, 
        .pagination>.active>span:focus, 
        .pagination>.active>span:hover {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #000;
            border-color: #000;
        }  
    </style>
    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                         <aside class="col-lg-3 col-md-3 col-sm-12 m_bottom_50 m_xs_bottom_30 " style=" " >	

                    <?php
                    include 'leftMenu.php';
                    ?>

                </aside>

                <div class="col-lg-9 col-md-9 col-sm-12 m_bottom_70 m_xs_bottom_30 mobilenopadding" style="">
                    <div class="panel panel-default" style="width: 106%;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?></h3>
                        </div>
                        <div class="panel-body">
                            <span data-toggle="" data-placement="left" title="View Pdf"><a href="./allInvoiceMainPdf.php?option=orderTracking&user_id=<?php echo $_SESSION['user_id'] ?>&tab=I&client_code=<?php echo $userInfo[0]['registration_id'] ?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px" target="_blank" class="btn btn-default btn-xm " ><i class="icon-eye" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Download Pdf"><a href="./allInvoiceMainPdf.php?option=orderTracking&user_id=<?php echo $_SESSION['user_id'] ?>&tab=D&client_code=<?php echo $userInfo[0]['registration_id'] ?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px"  class="btn btn-default btn-xm " ><i class="icon-download" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./allInvoicesMailSend.php?user_id=<?php echo $_SESSION['user_id'] ?>&client_code=<?php echo $userInfo[0]['registration_id'] ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>
                            <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">
                            <!-- -->
                            <table class="table table-striped table-bordered table-hover filterTable" >
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;width:6%"><b>S. No.</b></th>
                                        <th style="font-size: 12px;width:10%"><b>Date/Time</b></th>
                                        <th style="font-size: 12px;width:8%"><b>Invoice No.<b/></th>
                                        <th style="font-size: 12px;width:8%"><b>Order No.<b/></th>
                                        <th style="font-size: 12px;width:200px"><b>Item Code<b/></th>
                                        <th style="font-size: 12px;width:13%"><b>Item Name<b/></th>
                                        <th style="font-size: 12px;width:9%"><b>Price<b/></th>
                                        <th style="font-size: 12px;width:10%"><b>Extra Price<b/></th>
                                        <th style="font-size: 12px;width:10%"><b>Coupon/<br/>Discount<b/></th>
                                        <th style="font-size: 12px;width:10%"><b>Wallet<b/></th>
                                        <th style="font-size: 12px;width:18%"><b>Total Price<b/></th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <?php
                                $invoiceData = $authobj->invoiceDetail($_SESSION['user_id']);
                                for ($i = 0; $i < count($invoiceData); $i++) {
                                    $invoice = $invoiceData[$i];
                                    $shipdataId = $authobj->getDefaultAddress('default_shipping_address', $_SESSION['user_id']);
                                    //print_r($shipdataId);
                                    $billdataId = $authobj->getDefaultAddress('default_billing_address', $_SESSION['user_id']);
                                    // print_r($billdataId);
                                    $totalExtra = $authobj->totalExtraPrice($invoice['order_id']);
                                    //print_r($totalExtra[0]);
                                    ?> 

                                    <tr style="font-size: 12px">
                                        <td><?php echo $i + 1 ?></td>

                                        <td>
                                            <?php echo $invoice['op_date'] ?><br/><?php echo $invoice['op_time'] ?>
                                        </td>
                                        <td><?php echo $invoice['invoice_no'] ?></td>
                                        <td><?php echo $invoice['order_no'] ?></td>
                                        <td>
                                            <p style="white-space: normal">
                                                <?php
                                                $temp2 = array();

                                                // $data = $cart_obj->cartId($_SESSION['user_id'], $invoice['order_id']);
                                                $orderDatas = $authobj->order_product_detail($invoice['order_id'], $_SESSION['user_id']);
                                                //print_r($orderDatas);
                                                for ($j = 0; $j < count($orderDatas); $j++) {
                                                    $all_data = $orderDatas[$j];
                                                    // print_r($all_data['sku'])
                                                    // $cartInfo = $cart_obj->cartProductsInformation($cart_id['id'], $_SESSION['user_id']);
                                                    ?>
                                                    <span>
                                                        <?php
                                                        array_push($temp2, $all_data['sku']);
                                                        ?>

                                                    </span>
                                                    <?php
                                                }
                                                echo implode(', ', $temp2)
                                                ?>
                                            </p>
                                        </td>
                                        <td style="">
                                            <p style="white-space: normal">
                                                <?php
                                                $datas = $authobj->countProducts($invoice['order_id']);
                                                //print_r($datas);
                                                $temp = array();
                                                for ($s = 0; $s < count($datas); $s++) {
                                                    $tag_id = $datas[$s];
                                                    $res = $catObj->productTag($tag_id['tag_id']);
                                                    ?>

                                                    <?php
                                                    $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
                                                    array_push($temp, $string);
                                                    ?>

                                                    <?php
                                                }
                                                echo implode(', ', $temp);
                                                ?>
                                            </p>
                                        </td>
                                        <td>

                                            <?php echo '$' . number_format($totalExtra[0]['total'], 2, '.', ''); ?>

                                        </td>

                                        <td> <?php
                                            if ($totalExtra[0]['extra'] > 0) {
                                                echo '$' . number_format($totalExtra[0]['extra'], 2, '.', '');
                                            } else {
                                                echo '$00.00';
                                            }
                                            ?>
                                        </td>
                                        <td>

                                            <?php
                                            //  echo $invoice['total_amount'];
                                            //   echo $totalExtra[0]['extra'];
                                            $amt = number_format($totalExtra[0]['total'], 2, '.', '') + number_format($totalExtra[0]['extra'], 2, '.', '');
                                            //echo $amt;
                                            $out_data = $authobj->coupanDetail($invoice['coupon_id'], $amt);
                                            //echo $out_data;
                                            if ($out_data) {
                                                echo '$' . number_format($out_data, 2, '.', '');
                                            } else {
                                                ?>
                                                $00.00<?php }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($invoice['wallet_amount']) {
                                                echo '$' . number_format($invoice['wallet_amount'], 2, '.', '');
                                            } else {
                                                echo "$00.00";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '$' . number_format(explode('$', $invoice['total_amount'])[1], 2, '.', '');
                                            ?>
                                        </td>
                                        <td>
                                            <!--  <a href="http://192.168.3.45/nf3/nitaFashionAdmin/index.php/ProductHandler/generate_product_pdf/1/28/28/29/three hundred forty five">test</a>-->
                                            <a href="./viewOrDownloadOrderPdf.php?order_id=<?php echo $invoice['order_id']; ?>&user_id=<?php echo $_SESSION['user_id'] ?>&option=I"  class="btn btn-default btn-xs invoice-company" target="_blank" >View</a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                </tbody>
                            </table>
                            <!-- -->
                        </div>
                    </div>

                </div>
            </div>
            <!--banners-->
        </div>
    </div>
<?php } ?>
<?php
include 'footer.php';
?>
<link rel="stylesheet" type="text/css" media="all" href="../assets/datatables/dataTables.bootstrap.css">
<script src="../assets/datatables/jquery.dataTables.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('.filterTable').dataTable();
            // $("#searchPlace").html($($("#DataTables_Table_0_wrapper label")[1]).find("input").addClass("form-control").attr("type", "text").css("height", "34px"));
            $($("#DataTables_Table_0_wrapper label")[1]).remove();
            $("select[name='DataTables_Table_0_length']").remove();
            $("#DataTables_Table_0_length").remove();
        });
</script>

<script>
    $(function () {

        $('.invoice-company').each(function (index) {

            var num = $($(".invoice-company")[index]).parents("td").siblings().last().text().trim();
            // console.log(num);
            var val1 = num.split('$');
            // console.log(val1);
            // var val2 = val1[1].split('.');
            var val = toWords(val1[1]);
            //console.log(val);
            var b = $(this).attr('href');
            var c = b + '&number1=' + val;
            $(this).attr('href', c)
        })

    });
</script>