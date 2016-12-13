<?php
$wordData = explode('%20', $word);
$toword = implode(' ', $wordData);
?>
<html>
    <head>
        <title>Shipping Invoice</title>
        <style type="text/css">
            .invoiceTable,.invoiceTr,.invoiceTd{
                border: 1px solid rgb(157, 153, 150);
                border-collapse: collapse;
            }
            .invoiceTr,.invoiceTd{
                padding: 7px;
            }
        </style>
    </head>
    <body >

        <div>
            <div style="text-align:center;margin-bottom:0px"> 
                <span style="font-family: sans-serif;font-size:30px;">
                    Nita Fashions
                </span>
            </div>
            <div style="margin-top:0px;text-align:center;font-family: sans-serif;font-size:12px">
                <span style="">
                    16 Mody Road, GF, T. S. T, Kowloon, Hong Kong<br>
                    T: + (852) 27219990, 27219991,  F: +852 27234886, E: info@nitafashions.com, W: www.nitafashions.com             
                </span>
            </div>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="width:150px;align:center; margin-left:250px;">
            <div style="text-align: center;margin-bottom: 0px;padding-left: 0px;padding-top: 0px;"> 
                <span style="font-family: sans-serif;font-size:15px;padding:5px;background:rgb(245, 245,245);">
                    <span>INVOICE</span>
                </span>
            </div>
        </div>


        <!----================================= Close==========================================----->

        <div style="width:100%;margin-bottom:13px;margin-top: 10px;">
            <div style="width:30%;height:192px;float: left;border:1px solid rgb(157, 153, 150); margin-left:0px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:200px;padding:5px 5px;" >
                    <span style=""> Shipping Information</span>
                </div>
                <table style="margin-left: 2px;">
                    <tr>
                        <td colspan=3><b><?php echo $user_info[0]['first_name'] . ' ' . $user_info[0]['last_name']; ?></b></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['address1'] ?></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['address2'] ?></td> 
                    </tr> 
                    <tr > 
                        <td style="font-size:12px"><b>City</b></td>
                        <td><abbr title="Fax">: </abbr> </td>
                        <td style=""> <?php echo $shipping_info[0]['city'] ?></td>                      
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>State</b></td>
                        <td>:</td>
                        <td style=""> <?php echo $shipping_info[0]['state'] ?></td>                      
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>Country</b></td>
                        <td>:</td>
                        <td style="font-size:12px"><?php echo $shipping_info[0]['country'] ?></td>                                           
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>Zip Code</b></td>
                        <td>:</td>
                        <td style="font-size:12px"> <?php echo $shipping_info[0]['zip'] ?></td>                                           
                    </tr> 
                    <tr>
                        <td style="font-size:12px"><b>Phone:</b></td>
                        <td>:</td>
                        <td style="font-size:12px"> <?php echo $shipping_info[0]['contact_no'] ?> </td>                                           
                    </tr> 
                </table>   
            </div>
            <!----===================second div=======================------->
            <div style="width:30%;height:192px;float: left;border:1px solid rgb(157, 153, 150); margin-left:30px;">
                <div style="background:rgb(245, 245, 245);width:200px;padding:5px 5px;font-family: sans-serif;" >
                    <span style=""> Billing Information</span>
                </div>
                <table style="margin-left: 2px;">
                    <tr>
                        <td colspan=3><b><?php echo $user_info[0]['first_name'] . ' ' . $user_info[0]['last_name']; ?></b></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['address1'] ?></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['address2'] ?></td> 
                    </tr> 
                    <tr > 
                        <td style="font-size:12px"><b>City</b></td>
                        <td><abbr title="Fax">: </abbr> </td>
                        <td style=""> <?php echo $billing_info[0]['city'] ?></td>                      
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>State</b></td>
                        <td>:</td>
                        <td style=""> <?php echo $billing_info[0]['state'] ?></td>                      
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>Country</b></td>
                        <td>:</td>
                        <td style="font-size:12px"><?php echo $billing_info[0]['country'] ?> </td>                                           
                    </tr>
                    <tr>
                        <td style="font-size:12px"><b>Zip Code</b></td>
                        <td>:</td>
                        <td style="font-size:12px"> <?php echo $billing_info[0]['zip'] ?></td>                                           
                    </tr>  
                    <tr>
                        <td style="font-size:12px"><b>Phone:</b></td>
                        <td>:</td>
                        <td style="font-size:12px"> <?php echo $billing_info[0]['contact_no'] ?> </td>                                           
                    </tr> 
                </table>   
            </div>
            <!-----===================Close============================------->

            <div style="width:30%;height:192px;float: left;border:1px solid rgb(157, 153, 150); margin-left:30px;">
                <div style="background:rgb(245, 245, 245);width:200px;padding:5px 5px;font-family: sans-serif;" >
                    <span style=""> Invoice Information</span>
                </div>
                <table style="margin-left:15px;    padding-bottom: 35px;margin-right: 35px;">
                    <tbody>
                        <tr>
                            <td style="width:108px;font-size:17px;"><b>Invoice No </b></td>
                            <td style="width:115px;"><span><?php echo $invoice_info[0]['invoice_no'] ?></span></td>
                        </tr> 
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Date/Time:</b></td>
                            <td style="width:50%;"> <span > <?php echo $invoice_info[0]['op_time'] ?></span></td>
                        </tr>
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Delivery Date:  </b></td>
                            <td style="width:50%;"><span><?php echo $invoice_info[0]['op_date'] ?></span></td>
                            HKD
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Currency:</b></td>
                            <td style="width:50%;"><span >USD</span></td>
                        </tr>
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Order No.:</b></td>
                            <td style="width:50%;"><span ><?php echo $orderNo[0]['order_no'] ?></span></td>
                        </tr>
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Client Code</b></td> 
                            <td style="width:50%;"><span ><?php echo $user_info[0]['registration_id']; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width:50%;font-size:17px;"><b>Payment Method:</b></td>
                            <td style="width:50%;"><span ></span></td>
                        </tr>
                    </tbody>
                </table>                        
            </div>
        </div>



        <table class="invoiceTable" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);">
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr class="invoiceTr" style="font-weight: bold;" class="fabricInvoiceTr" >
                    <th class="invoiceTd colspan" style="width:5%;">S.No.</th>
                    <th class="invoiceTd colspan" style="width:10%;">Item No.</th>
                    <th class="invoiceTd colspan" style="width:10%;">SKU</th>
                    <th class="invoiceTd colspan" style="width:20%;">Image</th>
                    <th class="invoiceTd colspan" style="width:20%;"> Name</th>
                    <th class="invoiceTd colspan" style="width:17%;">Cost</th>
                    <th class="invoiceTd colspan" style="width:18%;">Qty.</th>
                    <th class="invoiceTd colspan" style="width:18%;">Extra Cost</th>
                    <th class="invoiceTd colspan" style="width:18%;">Total Cost</th>

                </tr>
                <?php
                $total = 0;
                $count = 0;
                foreach ($orderData as $key => $value) {

                    $count = $count + 1;
                    echo '<tr class="invoiceTd" >';
                    echo '<td class="invoiceTd" style="text-align:right">' . $count . ' </td>';
                    echo '<td class="invoiceTd" style="text-align:right">10038</td>';
                    echo '<td class="invoiceTd" style="text-align:left">' . $value['sku'] . '</td>';
                    echo '<td class="invoiceTd " style="text-align:right"><img src="http://nf1.costcokart.com/nfw/small/' . $value['image'] . '" style="width: 65px;height: 45px;text-align:center;"></td>';
                    echo '<td class="invoiceTd " style="text-align:right">' . $value['product'] . '</td>';
                    echo '<td class="invoiceTd " style="text-align:right">' . $value['price'] . '</td>';
                    echo '<td class="invoiceTd " style="text-align:right">' . $value['quantity'] . '</td>';
                    echo '<td class="invoiceTd " style="text-align:right">' . $value['extra_price'] . '</td>';
                    echo '<td class="invoiceTd " style="text-align:right">' . $value['total_price'] . '</td>';
                    echo '</tr>';
                    $total = $total + $value['total_price'] + $value['extra_price'];
                }
                ?>


                <tr class="invoiceTr">
                    <td class="invoiceTd" colspan=7 rowspan=2>
                        <b>Important Notice</b>
                        <pre></pre>
                    </td>
                    <td class="invoiceTd colspan"><b>Sub Total</b></td>
                    <td class="invoiceTd colspan" style="text-align:right;"><span><?php echo $total ?></span> 
                    </td>                      
                </tr> 
                <tr class="invoiceTr">
                    <td class="invoiceTd colspan"><b>Discount</b></td>  
                    <td class="invoiceTd colspan" style="text-align:right;"><span>0</span></td>                      
                </tr>
                <tr class="invoiceTr">
                    <td class="invoiceTd " colspan=7 >
                        <b>Amount in Words</b> : <span>HKD: <?php echo $toword; ?> </span>
                    </td>
                    <td class="invoiceTd colspan" style="width:108px"><b>Grand Total</b></td>
                    <td class="invoiceTd colspan" style="text-align:right;width:114px"><span><?php echo $total; ?> </span></td>                      
                </tr> 
        </table>  
    </div>
</div>

<div style="background:#F5F5F5;width:70%;float:left;margin-top:10px;font-size:12px;">
    <div style="padding:10px;" id="footer">
        <b>Note</b>:<br>
        1. Received the above merchandise in fine condition & correct quantity.<br>
        2. Goods once sold can not be returned.<br>
        3. This is computer generated receipt, bear no CHOP.
    </div>
</div> 
<div style="background:#F5F5F5;width:29%;float:right;margin-top:0px;height:88px;margin-left:10px; font-size:12px;">
    <div style="padding:10px;" id="footer">
        <b>prepared by</b>:<br>
        <span><?php echo $user_info[0]['first_name'] . ' ' . $user_info[0]['last_name']; ?></span>
    </div>
</div>       
</body>
</html>