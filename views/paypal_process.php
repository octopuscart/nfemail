<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();
include '../dbhandler/dbhandler.php';
include '../producthandler/authHandler.php';
$authobj = new AuthHandler();
$conf = resultAssociate("select * from server_conf");
$conf = end($conf);
$imageserver = $conf['image_server'];
include '../producthandler/productHandler.php';
include_once("config.php");
include_once("paypal.class.php");
$paypalmode = ($PayPalMode == 'sandbox') ? '.sandbox' : '';
$cartprd = new CartHandler();
$orderObj = new UserAddressDetail();
$padata = '';
if (isset($_REQUEST['payment_type'])) {
    $payment_type = $_REQUEST['payment_type'];
    $padata = '';
    $itemamt = 0;  //cart ammount
    $totalamt = 0; //including all type of payment (cart amt + shipping + others)
    $shipamt = 0;  //shipping amount
    switch ($payment_type) {
        case 'user_order':
            $shipamt = trim($_REQUEST['shipping_amount']);
            $shipamt = explode('$', $shipamt)[1];
            $shipamt = $shipamt * 1;
            $qun = $_REQUEST['totalQuantity'];

            $arr = $_REQUEST['allCartId'];
            $card_id = $_REQUEST['card_id'];
            $coupon_id = $_REQUEST['coupon_id'];
            $cartIdss = explode(",", $arr);
            $user_id = $_REQUEST['user_id'];
            $billId = $_REQUEST['billing_id'];
            $shipId = $_REQUEST['shipping_id'];
            $wallet = $_REQUEST['wallet_amount'];
            $sku = $_REQUEST['sku'];
            $skus = explode(",", $sku);
            $images = $_REQUEST['images'];
            $imagess = explode(",", $images);
            $price = $_REQUEST['price'];
            $prices = explode(",", $price);
            $tag_titles = $_REQUEST['tag_titles'];
            $tag_titles = explode(",", $tag_titles);
            $_SESSION['order_data'] = $_REQUEST;
//print_r( $_SESSION['order_data']);
            $totalamt = 0;
//$itemamt = $itemamt;
            $cart_total = 0;
            $lastkey = 0;

            if (isset($_REQUEST['coupon_id'])) {
                $discount = resultAssociate("select value from nfw_coupon where id  = '$coupon_id'");
                $discount_val = '0';
                if ($discount) {
                    $discount_val = end($discount);
                    $discount_val = $discount_val['value'];
                }
            }

            foreach ($cartIdss as $key => $value) {
                $cartdata = resultAssociate("
                SELECT pc.extra_price, p.product_speciality, pc.quantity FROM nfw_product_cart as pc 
                join nfw_product as p on pc.product_id = p.id
                where pc.id = $value ");
                $cartobj = end($cartdata);
                $ItemName = $tag_titles[$key];
                $ItemNumber = $skus[$key];
                $ItemDesc = $cartobj['product_speciality'];
                $ItemPrice = ($prices[$key] + $cartobj['extra_price']);

                $ItemQty = $cartobj['quantity'];
                $cart_total += ($ItemPrice * $ItemQty);
                $padata .= '&L_PAYMENTREQUEST_0_NAME' . $key . '=' . urlencode($ItemName) .
                        '&L_PAYMENTREQUEST_0_NUMBER' . $key . '=' . urlencode($ItemNumber) .
                        '&L_PAYMENTREQUEST_0_DESC' . $key . '=' . urlencode($ItemDesc) .
                        '&L_PAYMENTREQUEST_0_AMT' . $key . '=' . urlencode($ItemPrice) .
                        '&L_PAYMENTREQUEST_0_QTY' . $key . '=' . urlencode($ItemQty);
                $lastkey = $key;
            }

            $lastkey += 1;
            $lastkey1 = $lastkey + 1;
            $itemamt = $cart_total;
            $padata .= '&L_PAYMENTREQUEST_0_NAME' . $lastkey . '= Coupon Discount' .
                    '&L_PAYMENTREQUEST_0_AMT' . $lastkey . '=-' . urlencode($discount_val) .
                    '&L_PAYMENTREQUEST_0_QTY' . $lastkey . '=' . urlencode('1') .
                    '&L_PAYMENTREQUEST_0_NAME' . $lastkey1 . '= My Wallet' .
                    '&L_PAYMENTREQUEST_0_AMT' . $lastkey1 . '=-' . urlencode($wallet) .
                    '&L_PAYMENTREQUEST_0_QTY' . $lastkey1 . '=' . urlencode('1');
//            echo $discount_val,'<br>';
//            echo $wallet,'<br>';
//            echo $itemamt,'<br>';echo $shipamt,'<br>';
//            echo ($discount_val+$wallet),'<br>';

            $itemamt = $itemamt - ($discount_val + $wallet);
            $itemamt = number_format($itemamt, 2, '.', '');
//set 1 to hide buyer's shipping address, in-case products that does not require shipping
            $totalamt = $itemamt + $shipamt;

            $totalamt = number_format($totalamt, 2, '.', '');
            break;

        case 'gift_order':
            $lastkey = 0;
            $ItemNumber = $_REQUEST['coupon_code'];
            $ItemDesc = 'Nita Fashions Gift Coupon';
            $itemPrice = $_REQUEST['amount'];
            $padata .= '&L_PAYMENTREQUEST_0_NAME' . $lastkey . '= Gift Coupon' .
                    '&L_PAYMENTREQUEST_0_NUMBER' . $lastkey . '=' . urlencode($ItemNumber) .
                    '&L_PAYMENTREQUEST_0_DESC' . $lastkey . '=' . urlencode($ItemDesc) .
                    '&L_PAYMENTREQUEST_0_AMT' . $lastkey . '=' . urlencode($itemPrice) .
                    '&L_PAYMENTREQUEST_0_QTY' . $lastkey . '=' . urlencode('1');
            $itemamt = $itemPrice;
            $totalamt = $itemamt;

            $_SESSION['order_data'] = $_REQUEST;
            break;

//set 1 to hide buyer's shipping address, in-case products that does not require shipping
    }

    $setexpresscheckout = '&METHOD=SetExpressCheckout' .
            '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") .
            '&RETURNURL=' . urlencode($PayPalReturnURL) .
            '&CANCELURL=' . urlencode($PayPalCancelURL);

    $padata.= '&NOSHIPPING=0' . '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($itemamt) .
            '&PAYMENTREQUEST_0_TAXAMT=' . urlencode('0') .
            '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($shipamt) .
            '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode('0') .
            '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode('0') .
            '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode('0') .
            '&PAYMENTREQUEST_0_AMT=' . urlencode($totalamt) .
            '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode('USD') .
            '&LOCALECODE=GB' . //PayPal pages to match the language on your website.
            '&LOGOIMG=http://costcointernational.com/logo.png' . //site logo
            '&CARTBORDERCOLOR=000000' . //border color of cart
            '&ALLOWNOTE=1';
//We need to execute the "SetExpressCheckOut" method to obtain paypal token
    $data = urldecode($padata);
    $_SESSION['padata'] = $padata;
    $padata = $_SESSION['padata'];
    $paypal = new MyPayPal();
    $httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $setexpresscheckout . $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
//Respond according to message we receive from Paypal
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
//Redirect user to PayPal store with Token received.
        $paypalurl = 'https://www' . $paypalmode . '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $httpParsedResponseAr["TOKEN"] . '';
        header('Location: ' . $paypalurl);
    } else {
//Show error message
        print_r($httpParsedResponseAr);
        echo '<div style="color:red"><b>Error : </b>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
        echo '<pre>';
        echo '</pre>';
    }
}




//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if (isset($_GET["token"]) && isset($_GET["PayerID"])) {
//we will be using these two variables to execute the "DoExpressCheckoutPayment"
//Note: we haven't received any payment yet.
    $token = $_GET["token"];
    $payer_id = $_GET["PayerID"];
    $padata = $_SESSION['padata'];

    $doexpresscheckout = '&TOKEN=' . urlencode($token) .
            '&PAYERID=' . urlencode($payer_id) .
            '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE");
//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
    $paypal = new MyPayPal();
    $httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $doexpresscheckout . $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
//Check if everything went ok..
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

        echo '<h2>Success</h2>';
        echo 'Your Transaction ID : ' . urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);

        /*
          //Sometimes Payment are kept pending even when transaction is complete.
          //hence we need to notify user about it and ask him manually approve the transiction
         */

        if ('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {
            echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';
        } elseif ('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {
            echo '<div style="color:red">Transaction Complete, but payment is still pending! ' .
            'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';
        }

// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
        $padata = '&TOKEN=' . urlencode($token);
        $paypal = new MyPayPal();
        $httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $payment_type = $_SESSION['order_data']['payment_type'];
            $padata = '';
       // print_r($_SESSION['order_data']);
            if ($payment_type == 'user_order') {
                $qun = $_SESSION['order_data']['totalQuantity'];
//$pri = $_SESSION['order_data']['totalPrice'];
                $arr = $_SESSION['order_data']['allCartId'];
                $card_id = $_SESSION['order_data']['card_id'];
                $coupon_id = $_SESSION['order_data']['coupon_id'];
                $cartIdss = explode(",", $arr);
                $user_id = $_SESSION['order_data']['user_id'];
                $billId = $_SESSION['order_data']['billing_id'];
                $shipId = $_SESSION['order_data']['shipping_id'];
                $wallet = $_SESSION['order_data']['wallet_amount'];
                $ship_amt = $_SESSION['order_data']['shipping_amount'];
                $sku = $_SESSION['order_data']['sku'];
                $skus = explode(",", $sku);
                $images = $_SESSION['order_data']['images'];
                $imagess = explode(",", $images);
                $price = $_SESSION['order_data']['price'];
                $prices = explode(",", $price);
                $tag_titles = $_SESSION['order_data']['tag_titles'];
                $tag_titles = explode(",", $tag_titles);
//echo 'tttttttttttttt';
                $price = urldecode($httpParsedResponseAr['AMT']);
               //echo "===================";

                $order_id = $cartprd->insertInOrderTable($qun, $cartIdss, $user_id, $billId, $shipId, $coupon_id, $card_id, $skus, $imagess, $prices, $tag_titles, $wallet, $ship_amt,$price);
// echo $order_id;

                unset($_SESSION['cp']);
                unset($_SESSION['wallet_amount']);
                $payment_gateway = 'PayPal';
                $payment_gateway_return = json_encode($httpParsedResponseAr);
                $update_query = "update nfw_product_order
                                 set payment_gateway = '$payment_gateway' , 
                                     payment_gateway_return = '$payment_gateway_return'
                                     where id = $order_id    
                                 ";
                resultAssociate($update_query);
                $authobj->orderConfirmMail($order_id, $_SESSION['user_id']);
                header('location: orderDetail.php?order_id=' . $order_id);
            }
            if ($payment_type == 'gift_order') {      
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime('+1 year'));
                $coupon_code = $_SESSION['order_data']['coupon_code'];
                $card_id = $_SESSION['order_data']['card_id'];
                $user_id = $_SESSION['order_data']['user_id'];
                $amount = $_SESSION['order_data']['amount'];
                $payment_method = '';
                $payment_data = '';
              
                if ($card_id = 'paypal') {
                    $payment_method = 'PayPal';
                    $payment_data = json_encode($httpParsedResponseAr);
                } else {
                    $payment_method = 'Credit Card';
                    $query = "SELECT card_holder_name,card_number,expiry_month,expiry_year,address,bank_name,cvv FROM `nfw_user_card` where id = $card_id";
                    $carddata = resultAssociate($query);
                    $payment_data = json_encode(end($carddata));
                }
                mysql_query(" insert into nfw_coupon (coupon_code,value,value_type,start_date,end_date) values('$coupon_code','$amount','Fixed','$start_date','$end_date')");
                $last_id = mysql_insert_id();
                $op_date_time = date('Y-m-d H:i:s');
                mysql_query("insert into nfw_coupon_purchase (user_id,coupon_id,payment_method, payment_data,amount,op_date_time) value('$user_id','$last_id','$payment_method','$payment_data','$amount','$op_date_time')");
                $coupon_last_id = mysql_insert_id();

                $data = resultAssociate("select * from auth_user where id = " . $user_id);
                $purchase_email = end($data)['email'];
                header('location:sendMail.php?mail_type=7&email=' . $purchase_email . '&couponpurchaseid=' . $coupon_last_id);
//header('location: couponPurchase.php');
            }



// echo '<br /><b>Stuff to store in database :</b><br /><pre>';
            /*
              #### SAVE BUYER INFORMATION IN DATABASE ###
              //see (http://www.sanwebe.com/2013/03/basic-php-mysqli-usage) for mysqli usage

              $buyerName = $httpParsedResponseAr["FIRSTNAME"].' '.$httpParsedResponseAr["LASTNAME"];
              $buyerEmail = $httpParsedResponseAr["EMAIL"];

              //Open a new connection to the MySQL server
              $mysqli = new mysqli('host','username','password','database_name');

              //Output any connection error
              if ($mysqli->connect_error) {
              die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
              }

              $insert_row = $mysqli->query("INSERT INTO BuyerTable
              (BuyerName,BuyerEmail,TransactionID,ItemName,ItemNumber, ItemAmount,ItemQTY)
              VALUES ('$buyerName','$buyerEmail','$transactionID','$ItemName',$ItemNumber, $ItemTotalPrice,$ItemQTY)");

              if($insert_row){
              print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
              }else{
              die('Error : ('. $mysqli->errno .') '. $mysqli->error);
              }

             */

            echo '<pre>';
            print_r($httpParsedResponseAr);
            echo '</pre>';
        } else {
            echo '<div style="color:red"><b>GetTransactionDetails failed:</b>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
            echo '<pre>';
            print_r($httpParsedResponseAr);
            echo '</pre>';
        }
    } else {
        echo '<div style="color:red"><b>Error : </b>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
        echo '<pre>';
        print_r($httpParsedResponseAr);
        echo '</pre>';
    }
}
?>


