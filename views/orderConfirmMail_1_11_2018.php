<?php
 
$totals = '';
$welcomemsg = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic" rel="stylesheet" type="text/css">   
<style>
    div{
        font-family:lato;
    }
</style>
<div style="    margin: 0px;
    padding: 30px;
    font: 300 lato;
    background-color: #E2E2E2;">
    <div style="    padding: 20px;;background:#fff">
    <table width="100%" border="0" style="padding: 5px; background-color: white;" cellspacing="0" cellpadding="0" align="center">
            <tbody>
                <tr>
                    <td>
                        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr style="background-color: #FFF;">
                                    <td style="width:100%;    padding: 10px;">
                                    <center><img src="http://nitafashions.com/frontend/assets/images/logo/nf_logo_8.png" style="height: 100px;width:183px;"></center>
                                    </td>
                                    
                                </tr>
                                
                               
                               
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table><table style="    width: 100%;" border="0" align="center">
 <tbody><tr>
                                    <td style="text-align:center">
                                    
                                     ORDER NO. : &nbsp; '.$orderDetail[0]['order_no'].'
                                     </td>
                                 </tr>
</tbody></table>
                    
                    <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
                        <tbody>

                            </tr><tr><td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                            </tr><tr><td colspan="3">
 
                                    <span style="
                                          text-align: center;
                                          width: 100%;
                                          font-size: 24px;
                                          float: left;
                                          border-bottom: 1px solid #eaedef;
                                          margin-bottom: 20px;
                                          padding: 20px 0;
                                          background-color: #000;
                                          color: #fff;
                                          font-weight: 300;                                
                                          "> YOUR ORDER HAS BEEN CONFIRMED</span>
                                </td>
                            </tr><tr> </tbody></table>
                            
<!----================================= shipping ==========================================----->
         <div style="width:100%;margin-bottom:13px;margin-top: 10px;font-family: sans-serif;">
            <div style="width:31%;height:200px;float: left;margin-left:0px;font-family: sans-serif;">
                <div style="background: rgb(0, 0, 0);
    padding: 5px 5px;
    color: #fff;" >
                    <span style="font-size:16px"> Shipping Address</span>
                </div>';

$welcomemsg.= '<table style="padding-bottom:10px;margin-left: 2px;font-size:12px;font-family: sans-serif">
                    <tr style="border-bottom: 1px solid black">
                        <td colspan=3>
                          <b>';
$welcomemsg.=$userInfo["first_name"] . " " . $userInfo["middle_name"] . " " . $userInfo["last_name"];
$welcomemsg.= '</b>
                        </td> 
                    </tr>
                    <tr> 
                        <td colspan=3>';
$welcomemsg.=$shipping['address1'];
$welcomemsg.= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3>';
$welcomemsg.=$shipping['address2'];
$welcomemsg.= '</td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>';
$welcomemsg.=$shipping['city'] . ', ' . $shipping['state'];
$welcomemsg.= '</td> 
                    </tr> 
                      <tr> 
                      <td><table style="font-size: 12px;margin: -4px;">
                      <tr>
                      <td>Zip/Postal</td><td>:';
$welcomemsg.=$shipping['zip'];
$welcomemsg.= '</td></tr>
            <tr><td>                        
Country</td><td>:';
$welcomemsg.=$shipping['country'];
$welcomemsg.= '</td></tr></table></td> 
                    </tr>
                    <tr> 
                        <td colspan=3>M.:';
$welcomemsg.= $userInfo['contact_no'];
$welcomemsg.= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3>E.:';
$welcomemsg.= $userInfo['email'];
$welcomemsg.= '</td> 
                    </tr>
                </table>   
            </div>
            
            <!-----=================== Order Detail ============================------->
             <div style="width:35%;height:200px;float: right; margin-left:10px;font-family: sans-serif;">
                <div style="background: rgb(0, 0, 0);
    padding: 5px 5px;
    color: #fff;" >
                    <span style="font-size:16px">Invoice Information</span>
                </div>
                <table style="padding-bottom:10px;margin-left:1px;font-family: sans-serif;font-size:12px"> 
                    <tbody>
                        <tr style="">
                            <td>Invoice No.</td>
                            <td>:</td>
                            <td><span>';
$welcomemsg.=$invoice_data[0]['invoice_no'];
$welcomemsg.= '</span></td>
                        </tr> 
                        <tr>
                            <td>Date/Time</td>
                            <td>:</td>
                            <td><span>';
$welcomemsg.=$invoice_data[0]['op_date'] . "/" . $invoice_data[0]["op_time"];
$welcomemsg.= '</span></td>
                        </tr>
                        
                        <tr>
                            <td>Order No.</td>
                            <td>:</td>
                             <td><span>';
$welcomemsg.=$orderDetail[0]['order_no'];
$welcomemsg.= '</span></td>
                        </tr>
                        <tr>
                            <td>Client Code</td> 
                            <td>:</td>
                           <td><span>';
$welcomemsg.=$userInfo['registration_id'];
$welcomemsg.= '</span></td>
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
$welcomemsg.=$orderDetail[0]['payment_gateway'];
$welcomemsg.= '</span></td>
                        </tr>
                       
                    </tbody>
                </table>                        
            </div>
        </div>
          <!-----=================== Order Description ============================------->
         ';
$welcomemsg.= '<table class="invoiceTable table"  style="width: 100%;margin-top:0;    font-size: 12px;;border-collapse:collapse" >
         
            <tbody >
             <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
             <td colspan=10 style="background:black">
<div style="background: rgb(0, 0, 0);
    padding: 5px 5px;
    color: #fff;">
                    <span style="font-size:16px"> Order Description</span>
                </div>             
</td>
              </tr>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px;text-align: left">S.No.</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">SKU</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Item Code</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Item Image</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Item Name</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:20%;text-align: left">Description</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:7%;text-align: left">Qty.</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Price</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:10%;text-align: left">Extra Price</th>
                    <th style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:20%;text-align: left">Total Price</th>
                </tr>';



$count = 0;
$total_order = count($productAllId);
for ($i = 0; $i < $total_order; $i++) {

    $cartID = $productAllId[$i]['id'];
    $styleids = $productAllId[$i]['customization_id'];
    $cartInfo = $cartprd->cartProductsInformation($cartID, $userInfo['id']);

    $welcomemsg.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">
                <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $welcomemsg.= $i + 1;
    $welcomemsg.='</td>             
                         <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $welcomemsg.= $cartInfo['sku'];
    $welcomemsg.='</td>
                               <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $welcomemsg.= $cartInfo['sku'];
    $welcomemsg.='</td>
                                        <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $welcomemsg.= '<img src="' . $cartInfo['image'] . '" height="46px" width="46px">';
//    $welcomemsg.= '<img src="" height="40px" width="40px">';
    $welcomemsg.='</td>
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $res = $cartprd->productCatTagId($cartInfo['cart_product_id']);
    $welcomemsg.= $res[0]['tag_title'];
    $welcomemsg.='</td><td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
    $welcomemsg.= '<span>Style Id: </span><br/>';
    $welcomemsg.= '<span style="font-size:12px">';
    $welcomemsg.=$styleids;
    $welcomemsg.='</span><br/>';

    $welcomemsg.= '<span>Measurement Profile: </span><br/>';
    //$profile = $authobj->profile_name($cartInfo['measurement_id']);
    $welcomemsg.= '<span style="font-size:12px">';
    $welcomemsg.= $productAllId[$i]['measurement_id'];
    $welcomemsg.='</span>';


    $welcomemsg.='</td>
                          <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $welcomemsg.= $cartInfo['quantity'];
    $welcomemsg.='</td>
                     <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">$';
    $welcomemsg.= number_format($cartInfo['price'], 2, '.', '');
    $welcomemsg.='</td>
                      <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    if ($cartInfo['extra_price']) {
        $welcomemsg.= '$' . number_format($cartInfo['extra_price'], 2, '.', '');
    } else {
        $welcomemsg.= '$00.00';
    }

    $welcomemsg.='</td>
                   <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right;">$';
    $welcomemsg.= number_format($cartInfo['cart_price'], 2, '.', '');
    $welcomemsg.='</td>
                    
          </tr>';
    $totals = $totals + $cartInfo['cart_price'];
    $count++;
}

if ($orderDetail[0]['coupon_id']) {
    $out_data = $authobj->coupanDetail($orderDetail[0]['coupon_id'], $totals);
} else {
    $out_data = 0;
}
$welcomemsg.= '<tr style="">
                    <td style="width:499px;px;border-collapse: collapse;padding:7px;"  colspan=7 rowspan=8>
                   ' . mail_template("Order", "footer") . '
</td>
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;width:133px"  colspan=2><b>Sub Total</b></td>
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;text-align:right;    width: 75.5;"><span>$';
$welcomemsg.= number_format($totals, 2, '.', '');
$welcomemsg.= '</span> 
                    </td>  <tr/> 
                </tr> 
                   
                 
                    
              
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>Coupon Discount</b></td>  
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                    <span>$';
if ($out_data) {
    $welcomemsg.=number_format($out_data, 2, '.', '');
} else {
    $welcomemsg.='00.00';
}
$welcomemsg.='</span> 
                    </td>                  
                </tr>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>Shipping Price</b></td>  
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                   <span>';
$welcomemsg.= '$' . $orderDetail[0]['shipping_amount'];
$welcomemsg.='</span> 
                   </td>                  
                </tr>
                   <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>My Wallet</b></td>  
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                   <span>';
if ($orderDetail[0]['wallet_amount']) {
    $welcomemsg.= '$' . number_format($orderDetail[0]['wallet_amount'], 2, '.', '');
} else {
    $welcomemsg.= "$00.00";
}
$welcomemsg.='</span> 
                   </td>                  
                </tr>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;">
                    
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" colspan=2><b>Grand Total</b></td>
                    <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;">
                    <span>';

$gt1 = $orderDetail[0]['total_price'];
$welcomemsg.= $gt1;
$welcomemsg .='</span>
                    </td>                      
                </tr> 
                

        </table>
        </div>
     </div> ';


include '../phpPlugin/mailer/class.phpmailer.php';

$email = array($userInfo['email']); //'imteyaz_bari@yahoo.com ';

$mail = new PHPMailer; // call the class  
$mail->IsSMTP();
$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = $mailconf['host'];
$mail->Port = $mailconf['port']; 
$mail->Username = $mailconf['username']; //Username for SMTP authentication any valid email created in your domain
$mail->Password = $mailconf['password']; //Password for SMTP authentication
$mail->AddReplyTo($mailconf['mail_sender'], "Nita Fashions"); //reply-to address
$mail->SetFrom($mailconf['username'], "Nita Fashions"); //From address of the mail
// put your while loop here like below,
$mail->Subject = 'Order Confirmed' . '  ' . $orderDetail[0]['order_no']; //Subject od your mail
$mail->AddCC($mailconf['mail_sender']);
$mail->AddBCC($mailconf['username']); 
foreach ($email as $to_add) {
    $mail->AddAddress($to_add, "");              // name is optional
}
//echo $welcomemsg;

 
$mail->MsgHTML($welcomemsg); //Put your body of the message you can place html code here
$send = $mail->Send(); //Send the mails

//header('location:' . $_SERVER['HTTP_REFERER'] . '&mailsend=1');
?>