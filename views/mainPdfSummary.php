<?php

include("../phpPlugin/mpdf/mpdf.php");
$mpdf = new mPDF('win-1252', 'A4', '', '', 10, 10, 20, 10, 0, 0);
//        $mpdf = new mPDF('c');
$stylesheet = file_get_contents('../assets/font-awesome/4.3/css/font-awesome.min.css');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */
//$mpdf->SetHeader('|' . $current_date . '');
$mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$invoice_data = $this->authobj->invoiceOrderDetail($this->user_id, $this->productId);
//print_r($invoice_data);
// $productAllId = $this->authobj->findProductId($this->user_id, $this->productId);
$orderDatas = $this->authobj->order_product_detail($this->productId, $this->user_id);
$orderDetail = $this->authobj->userWholeOrderDetail($this->productId, $this->user_id);
$userInfo = phpjsonstyle($orderDetail[0]['user_info'], 'php');
$shipping = phpjsonstyle($orderDetail[0]['shipping_id'], 'php');
$biling = phpjsonstyle($orderDetail[0]['billing_id'], 'php');

$html = '

<html>
    <body>
      '. $pdf_template_header.'
        <!---================================== Invoice header=================================----->
   
            <div style="text-align: center;margin-top:0px;"> 
                <span style="font-family: sans-serif;font-size:15px;padding:0px;background:rgb(245, 245,245);">
                    <span>INVOICE </span>
                </span>
            </div>

        <!----================================= shipping ==========================================----->
         <div style="width:100%;margin-bottom:13px;margin-top: 10px;font-family: sans-serif;">
            <div style="width:31%;height:200px;float: left;border:1px solid rgb(157, 153, 150); margin-left:0px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:220px;padding:5px 5px;" >
                    <span style="font-size:16px">Shipping Address</span>
                </div>';

$html.= '<table style="padding-bottom:10px;margin-left: 2px;font-size:11px;font-family: sans-serif">
                    <tr style="border-bottom: 1px solid black">
                        <td colspan=3>
                          <b>';
$html.=$userInfo["first_name"] . " " . $userInfo["middle_name"] . " " . $userInfo["last_name"];
$html.= '</b>
                        </td> 
                    </tr>
                    <tr> 
                        <td colspan=3>';
$html.=$shipping['address1'];
$html.= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3>';
$html.=$shipping['address2'];
$html.= '</td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>';
$html.=$shipping['city'] . ',' . $shipping['state'];
$html.= '</td> 
                    </tr> 
                      <tr> 
                      <td>Zip/Postal' . "&nbsp;" . ':' . "&nbsp;" . '';
$html.=$shipping['zip'];
$html.= '</td> 
                    <tr> 
                        <td>Country' . "&nbsp;&nbsp;&nbsp;&nbsp;" . ':' . "&nbsp;" . '';
$html.=$shipping['country'];
$html.= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3><i class="fa">&#xf095;&nbsp;</i>';
$html.= ( $userInfo['contact_no']=='nul' ?'': $userInfo['contact_no']);
$html.= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3><i class="fa">&#xf0ac;&nbsp;</i>';
$html.= $userInfo['email'];
$html.= '</td> 
                    </tr>
                </table>   
            </div>
            <!----=================== billing =======================------->
              <div style="width:31%;height:200px;float: left;margin-left:10px;font-family: sans-serif;">
               
                  
            </div>
            <!-----=================== Order Detail ============================------->
             <div style="width:35%;height:200px;float: left;border:1px solid rgb(157, 153, 150); margin-left:10px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:250px;padding:5px 5px;" >
                    <span style="font-size:16px"> Invoice Information</span>
                </div>
                <table style="padding-bottom:10px;margin-left:1px;font-family: sans-serif;font-size:12px"> 
                    <tbody>
                        <tr style="">
                            <td>Invoice No.</td>
                            <td>:</td>
                            <td><span>';
$html.=$invoice_data[0]['invoice_no'];
$html.= '</span></td>
                        </tr> 
                        <tr>
                            <td>Date/Time</td>
                            <td>:</td>
                            <td><span>';
$html.=$invoice_data[0]['op_date'] . "/" . $invoice_data[0]["op_time"];
$html.= '</span></td>
                        </tr>
                        
                        <tr>
                            <td>Order No.</td>
                            <td>:</td>
                             <td><span>';
$html.=$orderDetail[0]['order_no'];
$html.= '</span></td>
                        </tr>
                        <tr>
                            <td>Client Code</td> 
                            <td>:</td>
                           <td><span>';
$html.=$userInfo['registration_id'];
$html.= '</span></td>
                        </tr>
                        <tr>
                            <td>Currency</td> 
                            <td>:</td>
                             <td><span>USD</span></td>
                        </tr>
                         <tr>
                            <td>Payment Method</td>  
                            <td>:</td>
                             <td><span>';
$html.=$orderDetail[0]['payment_gateway'];
$html.= '</span></td>
                        </tr>
                       
                    </tbody>
                </table>                        
            </div>
        </div>
          <!-----=================== Order Description ============================------->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;">
                Order Description
            </div>
        </div> ';
$html.= '<table class="invoiceTable table"  style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;border-collapse:collapse" >
         
            <tbody >
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
         <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px;text-align: left">S.No.</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">SKU</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:13%;text-align: left">Item Code</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:15%;text-align: left">Item Image</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:14%;text-align: left">Item Name</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:23%;text-align: left">Description</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:7%;text-align: left">Qty.</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Price</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:15%;text-align: left">Extra Price</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:18%;text-align: left">Total Price</th>
                </tr>';
//$cartprd = new CartHandler();
$count = 0;
//$total_order = count($productAllId);
for ($i = 0; $i < count($orderDatas); $i++) {
    $cartInfo = $orderDatas[$i];
    //$cartID = $productAllId[$i]['id'];
    //$styleids = $productAllId[$i]['customization_id'];
    // $cartInfo = $cartprd->cartProductsInformation($cartID, $this->user_id);

    $html.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">
                <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $i + 1;
    $html.='</td>             
                         <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $html.= $cartInfo['sku'];
    $html.='</td>
                               <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $html.= $cartInfo['item_code'];
    $html.='</td>
                                        <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $html.= '<img src="' . $cartInfo['item_image'] . '" height="46px" width="46px">';
//    $html.= '<img src="" height="40px" width="40px">';
    $html.='</td>
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    //$res = $cartprd->productCatTagId($cartInfo['cart_product_id']);
    $html.= $cartInfo['tag_title'];
    $html.='</td><td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $html.= '<span>Style Id </span><br/>';
    $html.= '<span style="font-size:12px">';
    $html.= $cartInfo['customization_id'];
    $html.='</span><br/>';

    $html.= '<span>Measurement Profile </span><br/>';
    // $profile = $productAllId[$i]['measurement_id'];
    $html.= '<span style="font-size:12px">';
    $html.= $cartInfo['measurement_id'];
    $html.='</span>';


    $html.='</td>
                          <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $cartInfo['quantity'];
    $html.='</td>
                     <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= '$' . $cartInfo['price'] . '.00';
    $html.='</td>
                      <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    if ($cartInfo['extra_price']) {
        $html.= '$' . number_format($cartInfo['extra_price'], 2, '.', '');
    } else {
        $html.= '$' . '00.00';
    }

    $html.='</td>
                   <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right;">';
    $html.= '$' . $cartInfo['cart_price'] . '.00';
    $html.='</td>
                    
          </tr>';
    $totals = $totals + $cartInfo['cart_price'];
    $count++;
}




switch ($count) {
    case 7:
        $html.= '</table><h5 style="text-align:right">Continue..</h5>';
        $html .= '<pagebreak />';
        break;
    case 6:
        $html.= '</table><h5 style="text-align:right">Continue..</h5>';
        $html .= '<pagebreak />';
        break;
    case 5:
        $html.= '</table><h5 style="text-align:right">Continue..</h5>';
        $html .= '<pagebreak />';
        break;

    default:
        $html.='</table>';
}


$html .='<table class=""  style="font-size:11px;width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;border-collapse:collapse">';
$out_data = $this->authobj->coupanDetail($orderDetail[0]['coupon_id'], $totals);
$html.= '<tr style="">
                    <td style="width:465px;font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;" rowspan=4></td>
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;width:180px"  ><b>Sub Total</b></td>
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;text-align:right;width:101;"><span>';
$html.= '$' . number_format($totals, 2, '.', '');
$html.= '</span> 
                    </td>  <tr/> 
       
              
                  
              
                <tr style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" ><b>Coupon Discount</b></td>  
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                    <span> ';
if ($out_data) {
    $html.= '$' . number_format($out_data, 2, '.', '');
} else {
    $html.='$00.00';
}
$html.='</span> 
                    </td>                  
                </tr>
                <tr style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" ><b>Shipping Price</b></td>  
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                    <span>'; 
$html.=  '$'.$orderDetail[0]['shipping_amount'];
$html.='</span> 
                   </td>                  
                </tr>
                   <tr style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" ><b>My Wallet</b></td>  
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                   <span>';
if ($orderDetail[0]['wallet_amount']) {
   $html.= '$' . number_format($orderDetail[0]['wallet_amount'], 2, '.', '');
} else {
    $html.= "$00.00";
}
$html.='</span> 
                   </td>                  
                </tr>
                <tr style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;">
                    <td class="invoiceTd " style="font-size:11px;">
                        <b>Amount in Words</b> :<br/> <span style="text-align:right;width:300px"> Only';


$gt1 = explode('$', $orderDetail[0]['total_price'])[1];
$html.= priceConvert($gt1);

$html.='</span>
                    </td>
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" ><b>Grand Total</b></td>
                    <td style="font-size:11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;">
                    <span>';


$html .= $orderDetail[0]['total_price'];


$html .='</span>
                    </td>                      
                </tr> 
                

        </table>  
        <div style="background:#F5F5F5;width:100%;float:left;margin-top:10px;font-size:11px;font-family: sans-serif">
    <div style="padding:10px;" id="footer">
        <b>Note</b>:<br>
        1. Received the above merchandise in fine condition & correct quantity.<br>
        2. Goods once sold can not be returned.<br>
        3. This is computer generated receipt, bear no CHOP.
    </div>
</div> 
    </div>
</div>

</body>';
?>