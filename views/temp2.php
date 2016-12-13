<?php
//include_once('header.php');
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");

######### edit details ##########
$clientId = '4996159243-gcgi66f496v9vneue2i84freehgn5fti.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'KX0Q0zEcoQUvXXz5d6D4lXuq'; //Google CLIENT SECRET
$redirectUrl = 'http://v1.costcointernational.com/frontend/views/temp.php';
//$redirectUrl = 'http://nf.indoretourtravels.com/frontend/views/temp.php';  //return url (url to script)
//$homeUrl = 'http://nf.indoretourtravels.com';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);

?>