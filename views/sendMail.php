<?php

//ob_start();
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';
error_reporting(-1);
ini_set('display_errors', 1);
if (isset($_REQUEST['mail_type'])) {
    $mailtype = $_REQUEST['mail_type'];
} else {
    $mailtype = '1';
}

$authobj = new AuthHandler();
$mailconf = $authobj->mail_configuration();

$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
$baseurl = $baselinkmain . '/';
switch ($mailtype) {
    case '1':


        $orderId = $_REQUEST['order_id'];
        $userId = $_REQUEST['user_id'];

        $cartprd = new CartHandler();
        $orderDetail = $authobj->userWholeOrderDetail($orderId, $userId);
        $userInfo = phpjsonstyle($orderDetail[0]['user_info'], 'php');
        $shipping = phpjsonstyle($orderDetail[0]['shipping_id'], 'php');
        $orderDatas = $authobj->order_product_detail($orderId, $userId);
        $invoice_data = $authobj->invoiceOrderDetail($userId, $orderId);

        $email = array($userInfo['email']);

//left header
        $left_header = 'ORDER NO. : &nbsp; ' . $orderDetail[0]['order_no'];
        break;
    case '2':
        $left_header = 'Thanks for Joining us';

        $subject = 'Welcome to Nita Fashions';
        break;
    case '3':
        $left_header = 'Reset Your Nita Fashions Login Password';
        $email = array($_REQUEST['email']);
        $subject = 'Reset Your Nita Fashions Login Password';
        break;
    case '4':
        $ids = $_REQUEST['last_id'];
        $data = resultAssociate("select sa.*,ts.schedule_date,ts.schedule_start_time,ts.schedule_end_time,au.email,concat(au.first_name,' ',au.last_name) as name from nfw_app_userlist  as au
join nfw_app_time_schedule as ts on au.nfw_time_schedule_id = ts.id
join nfw_app_start_end_date as ase on ts.nfw_app_start_end_date_id = ase.id
join nfw_app_set_appointment as sa on  ase.nfw_set_appointment_id = sa.id
where au.id=  $ids");
        $email = array($data[0]['email']);
        $name = $data[0]['name'];
        $dates = $data[0]['schedule_date'];
        $time1 = $data[0]['schedule_start_time'];
        $time2 = $data[0]['schedule_end_time'];
        $location = $data[0]['location'];
        $city = $data[0]['city'];
        $country = $data[0]['country'];
        $address = $data[0]['address'];
        $contact_no = $data[0]['contact_no'];

        $opdater = date_create($dates);
        $opdateapp = date_format($opdater, "l, d F Y");

        $left_header = "Appointment Date & Time:  $opdateapp <small>(" . ($time1) . ")</small> ";
        $subject = "Nita Fashions Appointment :  $dates (" . ($time1) . ")";
        break;
    case '5':
        $purchase_id = $_REQUEST['couponpurchaseid'];
        $data = resultAssociate(" SELECT np.amount,c.coupon_code,c.start_date,c.end_date,concat(au.first_name,' ',au.last_name) as name,au.gender FROM `nfw_coupon_purchase` as np join
                                  nfw_coupon as c on np.coupon_id = c.id
                                  join auth_user as au on np.user_id = au.id where np.id = $purchase_id");

        $email = array($_REQUEST['email'], $_REQUEST['sender_email']);
        $name = $data[0]['name'];
        $receiver_name = $_REQUEST['receiver_name'];
        $d1 = $data[0]['start_date'];
        $d2 = $data[0]['end_date'];
        $amount = $data[0]['amount'];
        $coupon_code = $data[0]['coupon_code'];
        $left_header = 'Gift Coupon : US$' . $amount;
        $subject = 'Gift Coupon ';
        break;

    case '7':
        $purchase_id = $_REQUEST['couponpurchaseid'];
        $data = resultAssociate(" SELECT np.amount,c.coupon_code,c.start_date,c.end_date,concat(au.first_name,' ',au.last_name) as name,au.gender FROM `nfw_coupon_purchase` as np join
                                  nfw_coupon as c on np.coupon_id = c.id
                                  join auth_user as au on np.user_id = au.id where np.id = $purchase_id");
        $email = array($_REQUEST['email']);
        $name = $data[0]['name'];
        $d1 = $data[0]['start_date'];
        $d2 = $data[0]['end_date'];
        $amount = $data[0]['amount'];
        $coupon_code = $data[0]['coupon_code'];
        $left_header = 'Gift Coupon : US$' . $amount;
        $subject = 'Thanks For Purchasing Gift Coupon From Nita Fahions';
        break;


    case '6':
        $ref_id = $_REQUEST['ref_id'];
        $user_id = $_REQUEST['user_id'];

        $page_link = $baselinkmain . '/views/registration.php?sender_id=' . $user_id . '&ref_id=' . $ref_id;
        $data = resultAssociate(" SELECT concat(au.first_name,' ',au.last_name) as name FROM  auth_user  as au
                                    join nfw_site_reference as cp on au.id = cp.sender_id  where cp.sender_id = $user_id");
        $email = array($_REQUEST['email']);
        $name = $data[0]['name'];
        $left_header = 'Invitations';
        $subject = 'Nita Fashions Invitation';
        break;
}
?>


<?php

$totals = '';
//start of header
$welcomemsg = $template_header . '
        <table width="100%" border="0" style="padding: 5px; background-color: white;" cellspacing="0" cellpadding="0" align="center">
            <tbody>
                <tr>
                    <td>
                        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
                            <tbody>
                                <tr style="background-color: #FFF;">
                                    <td style="width:100%;    padding: 10px;">
                                    <center><img src="https://www.nitafashions.com/assets/theme/images/logo/nf_logo_8.png" style="height: 100px;width:183px;"></center>
                                    </td>
                                    
                                </tr>
                                
                               
                               
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        

<table style="    width: 100%;" border="0" align="center" >
 <tr>
                                    <td style="text-align:center">
                                    
                                     ' . $left_header . '
                                     </td>
                                 </tr>
</table>
';
//end of header


switch ($mailtype) {
    case '1':

//==================================================================
// Start of order type message //
//==================================================================

        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              font-weight: 300; text-transform: capitalize;                               
                              "> ';
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
        $crt = $order_status_record[0];
        $statustype = $crt['status_tag'];
        $title = '';
        $titlemsg = '';
        $subject = '';
        $extramessage = '';
        $order_no = $orderDetail[0]['order_no'];
        switch ($statustype) {
            case '1':
                $title = "YOUR ORDER HAS BEEN CONFIRMED";
                $titlemsg = $title;
                $subject = "Order No. $order_no Confirmed";
                $subjectmsg = "";
                break;

            case '6':
                $title = "YOUR ORDER HAS BEEN CANCELLED";
                $titlemsg = $title;
                $subject = "Order No. $order_no has been cancelled";
                $subjectmsg = "";
                $extramessage = "<p style='font-size:12.8000001907349px'>
                    

Dear " . $userInfo["first_name"] . " " . $userInfo["last_name"] . ",<br/>

<p>We would like to confirm that your <b>Order ($order_no)</b> has been cancelled. 

<p>We look forward to you visiting us on our online store in the near future.</p>

                        </p>";
                break;

            case '2':
                $title = "YOUR ORDER HAS BEEN PROCESSED";
                $titlemsg = $title;
                $subject = "Order No. $order_no successfully processed";
                $paymentdetail = $authobj->payment_history($userId, $orderId);
                $subjectmsg = $subject . "." . "We have confirmed your payment";

                break;
            case '3':
                $subject = "Order No. $order_no has been shipped";
                $shipobj = resultAssociate("select * from nfw_order_shipping where order_id = $orderId");
                $shipobj = end($shipobj);
                $trkid = $shipobj['tracking_no'];
                $trklink = $shipobj['tracking_link'];
                $trkcomp = $shipobj['shipping_company'];
                $trktelno = $shipobj['shipping_tel_no'];
                $subjectmsg = $subject . "." . "You can track from $trkcomp, Tracking No.:$trkid";
                $title = "YOUR ORDER HAS BEEN SHIPPED";
                $titlemsg = $title;
                $title .= "<hr><small style='font-size:11px;font-weight: bold;'>
            <center>
                <table style='    color: #000;
    background: #FFF;
    text-align: right;
    border-radius: 48px; 
    
    padding: 5px 17px;'>
                    <tr>
                      <td style='width:50%'>Tracking No. : </td>
                      <td style='text-align:left;width:50%'>$trkid</td>
                    </tr>
                    <tr>
                      <td>Tracking Link : </td>
                      <td style='text-align:left;'><a href='$trklink'>$trklink</a></td>
                    </tr>
                    <tr>
                      <td>Shipping Company : </td>
                      <td style='text-align:left;'>$trkcomp</td>
                    </tr>
                    <tr>
                      <td>Shipping Tel No. : </td>
                      <td style='text-align:left;'>$trktelno</td>
                    </tr>
                </table></center>
                </small>";

                break;
            case '7':
                $subject = "Order No. $order_no has been picked at store";
                $shipobj = resultAssociate("select * from nfw_order_shipping where order_id = $orderId");
                $shipobj = end($shipobj);
                $trkid = $shipobj['tracking_no'];
                $trklink = $shipobj['tracking_link'];
                $trkcomp = $shipobj['shipping_company'];
                $trktelno = $shipobj['shipping_tel_no'];
                $subjectmsg = $subject;
                $title = "YOUR ORDER HAS BEEN PICKED AT STORE";
                $titlemsg = $title;
                $title .= "";

                break;
            case '4':
                $title = "YOUR ORDER HAS BEEN DELIVERED";
                $titlemsg = $title;
                $subject = "Order No. $order_no has been successfully delivered";
                $subjectmsg = $subject . "." . "We have sent you delivery mail.";


                break;
            case '5':
                $reasonobj = explode(',', $crt['remark'], 2);

                $title = "YOUR ORDER IS ON HOLD";

                $subject = "Order No. $order_no on hold";
                $titlemsg = $subject;
                $subjectmsg = $reasonobj[0];
                $title .= "<hr><small style='font-size:11px;font-weight: bold;'>" . $reasonobj[0] . "</small>";


                break;
            default:
                echo "";
        }

        $notification = array(
            'title' => $titlemsg,
            'message' => $subjectmsg,
            'user_id' => $userId = $_REQUEST['user_id'],
            'status' => '0',
            'page_link' => $baseurl . "/views/orderDetail.php?order_id=" . $_REQUEST['order_id'],
        );
        if ($subjectmsg != "") {
            $inserkey = implode(", ", array_keys($notification));
            $insetval = "'" . implode("', '", array_values($notification)) . "'";
            $query = "INSERT INTO nfw_notification_user ($inserkey) VALUES ($insetval);";
            resultAssociate($query);
        }



        $welcomemsg .= $title . '

</span>
</td>
</tr>
</tbody>
</table>



' . $extramessage . '


<div class = "" style = "    padding: 5px 5px;
     border: 1px solid #000;
     margin-bottom: 18px;
     border-radius: 5px;">
    <center>
        <h3 style="    padding: 2px;
            margin: -2px;
            background-color: #ECECEC;
            margin-bottom: 10px;
            color: #000;
            /* border: 1px solid #000; */
            font-weight: 300;">Order Status</h3>

      
       

        <table class="orderstatustable" style="   ">
          ';

        $count = 0;
        $currentStatus = $order_status_record[0]['status_tag'];
        ?>   
        <?php

        $proccessArray = [];
        $temp = ($order_status_record);
        $count = count($temp);
        $count1 = 0;
        foreach ($temp as $key => $value) {
            $ht = "<tr '>";
            $ht .= "<td style='width:48%; padding: 10px;
                text-align: right;
                padding-right: 31px;
                border-bottom: 1px solid #000;'>" . $value['date'] . "</td>";
            $ht .= "<td style='  
                text-align: right;
         
                border-bottom: 1px solid #000;    border-left: 0px solid;padding: 0;width: 4%; '>
                <i class='icon-circle' style='font-size: 19px;
  
    height: 31px;
    width: 31px;
    background-color: #000;
    float: left;
    border-radius: 50%;
    color: #fff;
    line-height: 28px;
    text-align: center;'>" . $count . "</i></td>";

            $count--;
            $ht .= '<th style="width:48%;border-bottom: 1px solid #000;
                text-align: left;padding-left: 20px;">' . $value['order_status'] . ' <br><small style="font-weight:300;font-size:13px">' . ($statustype != '7' ? $value['remark'] : '') . '</small> </th>';


            array_push($proccessArray, $ht);
        }
        $proccessStatus = implode('', $proccessArray);
        $welcomemsg .= $proccessStatus;
        $welcomemsg .= '</td></tr>
            
        </table>
    </center>
</div><!----================================= shipping ==========================================----->
<div style="width:100%;margin-bottom:13px;margin-top: 10px;font-family: sans-serif;">
    <div style="width:31%;height:200px;float: left;margin-left:0px;font-family: sans-serif;">
        <div style="background: rgb(0, 0, 0);
             padding: 5px 5px;
             color: #fff;" >
            <span style="font-size:16px"> Shipping Address</span>
        </div>';

        $welcomemsg .= '<table style="padding-bottom:10px;margin-left: 2px;font-size:12px;font-family: sans-serif">
            <tr style="border-bottom: 1px solid black">
                <td colspan=3>
                    <b>';
        $welcomemsg .= $userInfo["first_name"] . " " . $userInfo["middle_name"] . " " . $userInfo["last_name"];
        $welcomemsg .= '</b>
                </td> 
            </tr>
            <tr> 
                <td colspan=3>';
        $welcomemsg .= $shipping['address1'];
        $welcomemsg .= '</td> 
                    </tr>
                    <tr> 
                        <td colspan=3>';
        $welcomemsg .= $shipping['address2'];
        $welcomemsg .= '</td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>';
        $welcomemsg .= $shipping['city'] . ', ' . $shipping['state'];
        $welcomemsg .= '</td> 
                    </tr> 
                      <tr> 
                      <td>
                      <table style="font-size: 12px;margin: -4px;">
                      <tr>
                      <td>Zip/Postal</td><td>:';
        $welcomemsg .= $shipping['zip'];
        $welcomemsg .= '</td></tr>
            <tr><td>                        
Country</td><td>:';
        $welcomemsg .= $shipping['country'];
        $welcomemsg .= '</td></tr></table></td> 
                    </tr>
            <tr> 
                <td colspan=3>M.:';
        $welcomemsg .= $userInfo['contact_no'];
        $welcomemsg .= '</td> 
            </tr>
            <tr> 
                <td colspan=3>E.:';
        $welcomemsg .= $userInfo['email'];
        $welcomemsg .= '</td> 
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
        $welcomemsg .= $invoice_data[0]['invoice_no'];
        $welcomemsg .= '</span></td>
                </tr> 
                <tr>
                    <td>Date/Time</td>
                    <td>:</td>
                    <td><span>';
        $welcomemsg .= $invoice_data[0]['op_date'] . "/" . $invoice_data[0]["op_time"];
        $welcomemsg .= '</span></td>
                </tr>

                <tr>
                    <td>Order No.</td>
                    <td>:</td>
                    <td><span>';
        $welcomemsg .= $orderDetail[0]['order_no'];
        $welcomemsg .= '</span></td>
                </tr>
                <tr>
                    <td>Client Code</td> 
                    <td>:</td>
                    <td><span>';
        $welcomemsg .= $userInfo['registration_id'];
        $welcomemsg .= '</span></td>
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
        $welcomemsg .= $orderDetail[0]['payment_gateway'];
        $welcomemsg .= '</span></td>
                </tr>

            </tbody>
        </table>                        
    </div>
</div>
<!-----=================== Order Description ============================------->
';
        $welcomemsg .= '<table class="invoiceTable table"  style="width: 100%;margin-top:0;    font-size: 12px;;border-collapse:collapse" >

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
        //$total_order = count($orderDatas);
        for ($i = 0; $i < count($orderDatas); $i++) {

            //$cartID = $productAllId[$i]['id'];
            //$styleids = $productAllId[$i]['customization_id'];
            $cartInfo = $orderDatas[$i];

            $welcomemsg .= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $welcomemsg .= $i + 1;
            $welcomemsg .= '</td>             
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
            $welcomemsg .= $cartInfo['sku'];
            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
            $welcomemsg .= $cartInfo['item_code'];
            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
            $welcomemsg .= '<img src="' . $cartInfo['item_image'] . '" height="46px" width="46px">';
            //    $welcomemsg.= '<img src="" height="40px" width="40px">';
            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
            //$res = $cartprd->productCatTagId($cartInfo['cart_product_id']);
            $welcomemsg .= $cartInfo['tag_title'];
            $welcomemsg .= '</td><td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;">';
            $welcomemsg .= '<span>Style Id: </span><br/>';
            $welcomemsg .= '<span style="font-size:12px">';
            $welcomemsg .= $cartInfo['customization_data'];
            ;
            $welcomemsg .= '</span><br/>';

            $welcomemsg .= '<span>Measurement Profile: </span><br/>';
            //$profile = $authobj->profile_name($cartInfo['measurement_id']);
            $welcomemsg .= '<span style="font-size:12px">';
            $welcomemsg .= $cartInfo['measurement_data'];
            $welcomemsg .= '</span>';


            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $welcomemsg .= $cartInfo['quantity'];
            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">$';
            $welcomemsg .= number_format(($cartInfo['price'] - $cartInfo['extra_price']), 2, '.', '');
            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            if ($cartInfo['extra_price']) {
                $welcomemsg .= '$' . number_format($cartInfo['extra_price'], 2, '.', '');
            } else {
                $welcomemsg .= '$00.00';
            }

            $welcomemsg .= '</td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right;">$';
            $welcomemsg .= number_format($cartInfo['total_price'], 2, '.', '');
            $welcomemsg .= '</td>

        </tr>';
            $count++;
        }


        $out_data = $authobj->coupanDetail($orderDetail[0]['coupon_id'], $totals);

        $welcomemsg .= '<tr style="">
            <td style="width:499px;px;border-collapse: collapse;padding:7px;"  colspan=7 rowspan=9>
            <p style="white-space: pre-line;font-size:10px;">' . ($orderDetail[0]['payment_gateway'] == 'Credit Card' ? $orderDetail[0]['card'] : '') . '</p>
                  ' . mail_template("Order", "footer") . '
            </td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;width:133px"  colspan=2><b>Sub Total</b></td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding:7px;text-align:right;    width: 75.5;"><span>';
        $welcomemsg .=  '$' . number_format((str_replace(",", "", str_replace("$", "", $orderDetail[0]['total_price']))) - $orderDetail[0]['shipping_amount'], 2, '.', '');
        $welcomemsg .= '</span> 
            </td>  <tr/> 
        </tr> 



        <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>Coupon Discount</b></td>  
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                <span>$';
        if ($out_data) {
            $welcomemsg .= number_format($out_data, 2, '.', '');
        } else {
            $welcomemsg .= '00.00';
        }
        $welcomemsg .= '</span> 
            </td>                  
        </tr>
        <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>Shipping Price</b></td>  
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                <span>$';
        if ($orderDetail[0]['shipping_amount']) {
            $welcomemsg .= $orderDetail[0]['shipping_amount'];
        } else {
            $welcomemsg .= '00.00';
        }

        $welcomemsg .= '</span> 
            </td>                  
        </tr>
        <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px">
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;width:2px" colspan=2><b>My Wallet</b></td>  
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;width:2px">
                              <span>';
        if ($orderDetail[0]['wallet_amount']) {
            $welcomemsg .= '$' . number_format($orderDetail[0]['wallet_amount'], 2, '.', '');
        } else {
            $welcomemsg .= "$00.00";
        }
        $welcomemsg .= '</span> 
            </td>                  
        </tr>
        <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;">

            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" colspan=2><b>Grand Total</b></td>
            <td style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;text-align:right;">
                <span>';

        $welcomemsg .= ($orderDetail[0]['total_price']);

        $welcomemsg .= '</span>
            </td>                      
        </tr> 

</table>';
//==================================================================
// End of order type message //
//==================================================================

        break;
    case '2':

        $userid = $_REQUEST['user_id'];
        $userdetails = $authobj->userProfile($userid);
      
        $username = $userdetails['first_name'] . " " . $userdetails['middle_name'] . " " . $userdetails['last_name'];
        $country_name = $userdetails['country'];
        $token = $userdetails['user_img'];
        $email2 = $userdetails['email'];
        $email = array($email2);
        $confirmlink = 'https://www.nitafashions.com/index.php/Account/activation?token=' . $token.'&user_id='.$userid;
        
        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> Welcome to Nita Fashions';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>
<p style=" "><span style="line-height: 1.2;    font-size: 12.8000001907349px;">Dear ' . ucwords($username) . ',</span><br></p>

<div style=""><span style="font-family: Lato, sans-serif; font-size: 12.8000001907349px; line-height: 24px; text-align: start; background-color: rgb(255, 255, 255);">Thank you for registering your online Nita Fashions account from ' . $country_name . '. You are now able to customise your wardrobe at the convenience of your own home, with a few simple steps.
<br/>Your username is <strong>' . $email2 . '</strong>
    <br/> 
    <div style="     padding: 15px 15px 20px;    margin: 10px 0px 15px;
    background: #ececec;">
       <span style="    font-size: 15px;">Please click the button below to confirm that this email address will be associated with your Nita Fashions user account:</span> <br/>
        <div style="    margin-top: 10px;">
           <a style="font-size: 18px;
                     margin: 15px 0px;
                     padding: 5px;
                     background: #000;
                     text-decoration: none;
                     background: red;
                     color: white;
                     border-radius: 15px;" href="' . $confirmlink . '" target="_blank">
                         Confirm Email Address
            </a>
        </div>
       </span>
     </div>
     </div>

<hr/>
<div style=""><span style="font-family: Lato, sans-serif; font-size: 12.8000001907349px; line-height: 24px; text-align: left; background-color: rgb(255, 255, 255);">
Nita Fashions is one of the most respected Bespoke Tailors in Hong Kong. Their quality, workmanship and service are of the highest standards. The chief tailor and proprietor, Mr. Peter Daswani has over 30 years of cutting and tailoring experience; he and his team work around the clock to craft your clothing. <br/>
We thank you for selecting Nita Fashions to be your first choice in tailored clothing.
</span></div>


<br>
               ' . mail_template("General", "footer") . '

';

        break;

    case '3':
        $userpass = $_REQUEST['passwordkey'];
        $id = $_REQUEST['id'];
        $userpass = $userpass . "_____AAAAAAAA" . $id;
        $email = array($_REQUEST['email']);
        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> Reset Your Login Password Now';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>



<p><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Hi there,</span><br></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">We have received a request to reset your Nita Fashions Login Password <b>(Username: ' . $_REQUEST['email'] . ')</b>.  
If you made this request, please follow the instructions below.  Rest assured your customer account is safe.</p>

  <div style="     padding: 15px 15px 20px;    margin: 10px 0px 15px;
    background: #ececec;">
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 15px; line-height: normal;">Click on the link below to reset your Login Password.</p>
<p>    
<a style="font-size: 18px;
                     margin: 15px 0px;
                     padding: 5px;
                     background: #000;
                     text-decoration: none;
                     background: red;
                     color: white;
                     border-radius: 15px;" href="' . $baseurl . '/views/forgetpass.php?admin=' . $userpass . '" >Reset Now</a></p></div>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Note: If you did not request to have your login password reset, please ignore this email.<br>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">If you have any queries, please feel free to email us at <b>sales@nitafashions.com</b>, and we will be happy to assist you.<br>
' . mail_template("General", "footer") . '
                </p>
';

        break;
    case '4':

        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> Your Appointment';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>



<p><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Dear ' . strtoupper($name) . ',</span><br></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">We have booked your appointment to see our Chief Tailor, Mr. Peter Daswani in <b>' . $city . '</b> on <b>' . $opdateapp . ', ' . strtoupper($time1) . '</b> at the
 
                <span><b>' . trim($location) . '.</b></span><br>
              
                </p>
                
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">On the day of your appointment, please call Mr. Peter Daswani on his contact no. (<b>' . '' . trim($country) . ':  ' . $contact_no . '</b>) and he will give you his suite number.</p>
 
' . mail_template("General", "footer") . '
                </p>
';

        break;
    case '5':

        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> CONGRATULATIONS';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>
<p><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Congratulation <b>' . ucwords($receiver_name) . '</b> !!!,</span><br></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">You have been gifted a Gift Coupon by <b>' . ucwords($name) . '</b>. This Coupon entitles you <b>' . ucwords($receiver_name) . '</b> to purchase <b>US$' . $amount . '</b> Bespoke Clothing from Nita Fashions.<br/>
    <p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"> Your Exclusive Gift Coupon Code is - <b>' . $coupon_code . '</b></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Gift (Coupon) Expiry Date - <b>' . $d2 . '</b>
<br>
' . mail_template("General", "footer") . '
                </p>
';

        break;


    case '7':

        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> THANK YOU FOR PURCHASING GIFT COUPON';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>

<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"> <b>' . ucwords($name) . '</b> you have been purchased Gift Coupon worth <b>US$' . $amount . '</b> from Nita Fashions.<br/>
    <p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"> Your Exclusive Gift Coupon Code is - <b>' . $coupon_code . '</b></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Gift (Coupon) Expiry Date - <b>' . $d2 . '</b> 
<br>
' . mail_template("General", "footer") . '
                </p>
';

        break;


    case '6':

        $welcomemsg .= '
        
        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
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
                              "> CONGRATULATIONS';
        $welcomemsg .= '</span>
</td>
</tr>
</tbody>
</table>
<p><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Hi Dear,</span><br></p>
<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"><b>' . $name . '</b> send you a web link as a reference  
    <a href="' . $page_link . '" style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"><b>www.nitafashions.com</b></a>
    for online buying of Customized Suits/Shirts etc with Best Price, </p>Click here 
<a href="' . $page_link . '" style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"><b>Nita Fashions</b></a>

<p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;"></p>

' . mail_template("General", "footer") . '';
        break;
    default:
        "";
}



$welcomemsg .= $template_footer;


include '../phpPlugin/mailer/class.phpmailer.php';
echo $welcomemsg;


$mail = new PHPMailer; // call the class   
$mail->IsSMTP();
$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "server.costcokart.com";
$mail->Port = 587;
$mail->Username = "do-not-reply-nita-fashions-ssl-email-465@costcokart.com"; //Username for SMTP authentication any valid email created in your domain
$mail->Password = "stljEdTPmYno"; //Password for SMTP authentication
$mail->AddReplyTo("sales@nitafashions.com", "Nita Fashions"); //reply-to address
$mail->SetFrom("donotreply@nitafashions.com", "Nita Fashions"); //From address of the mail
// put your while loop here like below,
$mail->Subject = $subject; //Subject od your mail
//$mail->AddCC($mailconf['mail_sender']);
$mail->AddBCC("do-not-reply-nita-fashions-ssl-email-465@costcokart.com");
$mail->AddBCC("sales@nitafashions.com", "Nita Fashions"); //reply-to address
foreach ($email as $to_add) {
//    $mail->AddAddress("imteyaz_bari@yahoo.com", "");
    $mail->AddAddress($to_add, "");              // name is optional
}
//echo $welcomemsg;

if (isset($_REQUEST['sender_email'])) {
    $mail->AddAddress($_REQUEST['sender_email'], "");
}


$mail->MsgHTML($welcomemsg); //Put your body of the message you can place html code here
$send = $mail->Send(); //Send the mails
?>