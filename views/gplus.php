<?php 
include_once("gpluslib.php");

if(isset($_REQUEST['code'])){
	$gClient->authenticate();
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	$userProfile = $google_oauthV2->userinfo->get();
        //print_r($userProfile);
	//DB Insert
	
	$_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
        //header("location: google.php");
        header("location: account.php");
        
	$_SESSION['token'] = $gClient->getAccessToken();
} else {
	$authUrl = $gClient->createAuthUrl();
}

if(isset($authUrl)) {
	header("location:$authUrl");
} 
?>
