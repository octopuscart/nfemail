<?php
session_start();
include_once('header.php');
require_once __DIR__ . '/fsrc/Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '550439068443920',
    'app_secret' => 'ef5b243d011f06a9210f7c0ca2bd70a4',
    'default_graph_version' => 'v2.5',
        ]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional

try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    // redirect the user back to the same page if it has "code" GET variable
    if (isset($_GET['code'])) {
        header('Location: ./');
    }
    // getting basic info about user
    try {

        $requestPicture = $fb->get('/me/picture?redirect=false&height=300'); //getting user picture
        $requestProfile = $fb->get('/me'); // getting basic info
        $picture = $requestPicture->getGraphUser();
        //$profile = $requestProfile->getGraphUser();
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $profile = $profile_request->getGraphNode()->asArray();
        $_SESSION['profile'] = $profile;
        $_SESSION['img1'] = $picture['url'];
        //  print_r($_SESSION);
        if ($_SESSION) {

            //echo "if";
            ################
            $pass = $_SESSION['profile']['id'];
            $sql_fetch_auth = mysql_query("select * from auth_user where email='" . $_SESSION['profile']['email'] . "'");
            //print_r($sql_fetch_auth);
            if (mysql_num_rows($sql_fetch_auth) > 0) {
                mysql_query("update auth_user set status='1' where email='" . $_SESSION['profile']['email'] . "' and password='" . $pass . "' ");
                while ($get_fetch_auth = mysql_fetch_array($sql_fetch_auth)) {

                    $_SESSION['user_id'] = $get_fetch_auth['id'];
                    $_SESSION['user_name'] = $get_fetch_auth['first_name'];
                    $_SESSION['user_img'] = $get_fetch_auth['user_img'];
                    $sql_login = mysql_query("select * from auth_event where user_id='" . $_SESSION['user_id'] . "' and description='login' ORDER BY id DESC limit 0,1");
                    $get_login = mysql_fetch_array($sql_login);
                    $_SESSION['last_login'] = $get_login['time_stamp'];
                    $_SESSION['id'] = session_id();
                    mysql_query("INSERT INTO `auth_event` (`time_stamp`, `client_ip`, `user_id`, `origin`, `description`) VALUES ('" . date('Y-m-d H:i:s') . "','" . $_SERVER['SERVER_ADDR'] . "','" . $get_fetch_auth['id'] . "','','Login')");
                    $dat = date('Y-m-d ');
                    $tm = date('H:i:s');
                    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                        $query = "insert into nfw_product_cart (product_id,user_id,op_date,op_time,quantity, tag_id) values('" . $_SESSION['cart'][$i][0] . "','" . $_SESSION['user_id'] . "','$dat','$tm','" . $_SESSION['cart'][$i][3] . "', '" . $_SESSION['cart'][$i][1] . "')";
                        mysql_query($query);
                    }
                    unset($_SESSION['cart']);
                }
                header('location:index.php');
            } else {
                //print_r( $_SESSION['img1']);
                $query = "INSERT INTO auth_user (`middle_name`,`first_name`, `last_name`, `email`, `password`,`gender`,`birth_date`,`telephone_no`,`fax_no`,`registration_id`,`user_img`,`contact_no`,`status`,`remark`) VALUES ('','" . $_SESSION['profile']['first_name'] . "','" . $_SESSION['profile']['last_name'] . "','" . $_SESSION['profile']['email'] . "','" . $_SESSION['profile']['id'] . "',' ','','','','','" . $_SESSION['img1'] . "','','','')";
                //echo $query;
                mysql_query($query);
                $id = mysql_insert_id();
                $registration_id = 1100 + $id;
                $date_code = date('ym');
                $client_code = 'CC' . $date_code . $registration_id;
                $query = "update auth_user set registration_id='$client_code' where id = $id";
                mysql_query($query);
                $query = "update auth_user set status='1' where email='" . $_SESSION['profile']['email'] . "' and password='" . $pass . "' ";
                mysql_query($query);
                //echo $query;
                $sql_fetch_auth = mysql_query("select * from auth_user where email='" . $_SESSION['profile']['email'] . "'");
                while ($get_fetch_auth = mysql_fetch_array($sql_fetch_auth)) {

                    $_SESSION['user_id'] = $get_fetch_auth['id'];
                    $_SESSION['user_name'] = $get_fetch_auth['first_name'];
                    $_SESSION['user_img'] = $get_fetch_auth['user_img'];
                    $query = "select * from auth_event where user_id='" . $_SESSION['user_id'] . "' and description='login' ORDER BY id DESC limit 0,1";
                    mysql_query($query);
                    $sql_login = mysql_query();
                    $get_login = mysql_fetch_array($sql_login);
                    $_SESSION['last_login'] = $get_login['time_stamp'];
                    $_SESSION['id'] = session_id();
                    $query = "INSERT INTO auth_event (`time_stamp`, `client_ip`, `user_id`, `origin`, `description`) VALUES ('" . date('Y-m-d H:i:s') . "','" . $_SERVER['SERVER_ADDR'] . "','" . $get_fetch_auth['id'] . "','','Login')";
                    mysql_query($query);
                    $dat = date('Y-m-d ');
                    $tm = date('H:i:s');
                    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                        $query = "insert into nfw_product_cart (product_id,user_id,op_date,op_time,quantity, tag_id) values('" . $_SESSION['cart'][$i][0] . "','" . $_SESSION['user_id'] . "','$dat','$tm','" . $_SESSION['cart'][$i][3] . "', '" . $_SESSION['cart'][$i][1] . "')";
                        mysql_query($query);
                    }
                    unset($_SESSION['cart']);
                }
                header('location:index.php');
            }
        }
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        header("Location: ./");
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

} else {
    // replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
    $loginUrl = $helper->getLoginUrl('http://v1.costcointernational.com/frontend/views/findex.php', $permissions);
    header("location:$loginUrl");
}
