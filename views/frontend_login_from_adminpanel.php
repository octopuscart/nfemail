<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';
$authobj = new AuthHandler();
if(isset($_REQUEST['userId'])){
    $authobj->frontend_login_from_adminpanel($_REQUEST['email'],$_REQUEST['password'],$_REQUEST['table_name'],$_REQUEST['userId']);
    ob_start();
    $url ="userProfile.php";
    echo "Redirecting...";
    echo '<script>window.location = "'.$url.'";</script>';
}
?>