<?php

//start session in all pages
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} //PHP >= 5.4.0
//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

$PayPalMode = ''; // sandbox or live
$PayPalApiUsername = 'octopuscartltd_api1.gmail.com'; //PayPal API Username
$PayPalApiPassword = '66ZLFS5QP6WHV58H'; //Paypal API password
$PayPalApiSignature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AtRlYclVHieqMP.mCqq5eNqN-DpU'; //Paypal API Signature
$PayPalCurrencyCode = 'USD'; //Paypal Currency Code


$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';


$PayPalReturnURL = $baselinkmain.'/views/paypal_process.php'; //Point to process.php page
$PayPalCancelURL = $baselinkmain.'/views/paypal_cancel.php'; //Cancel URL if user clicks cancel
?>  
