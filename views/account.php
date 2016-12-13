<?php
session_start();
include_once('header.php');

if (!isset($_SESSION['google_data'])):header("Location:index.php");endif;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login with Google Account by CodexWorld</title>
        <style type="text/css">
            h1
            {
                font-family:Arial, Helvetica, sans-serif;
                color:#999999;
            }
            .wrapper{ width:1000px;margin-left:auto;margin-right:auto;}
            .welcome_txt{
                margin: 20px;
                background-color: #EBEBEB;
                padding: 10px;
                border: #D6D6D6 solid 1px;
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                border-radius:5px;
            }
            .google_box{
                margin: 20px;
                background-color: #FFF0DD;
                padding: 10px;
                border: #F7CFCF solid 1px;
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                border-radius:5px;
            }
            .google_box .image{ text-align:center;}
        </style>
    </head>
    <body>
        <div class="wrapper">
            <h1>Google Profile Details </h1>
            <?php
            if ($_SESSION['google_data']) {

                //echo "else";
                ################
                $pass = $_SESSION['google_data']['id'];
                $sql_fetch_auth = mysql_query("select * from auth_user where email='" . $_SESSION['google_data']['email'] . "'");
                if (mysql_num_rows($sql_fetch_auth) > 0) {
                    mysql_query("update auth_user set status='1' where email='" . $_SESSION['google_data']['email'] . "' and password='" . $pass . "' ");
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
                    $query = "INSERT INTO auth_user (`middle_name`,`first_name`, `last_name`, `email`, `password`,`gender`,`birth_date`,`telephone_no`,`fax_no`,`registration_id`,`user_img`,`contact_no`,`status`,`remark`) VALUES ('','" . $_SESSION['google_data']['given_name'] . "','" . $_SESSION['google_data']['family_name'] . "','" . $_SESSION['google_data']['email'] . "','" . $_SESSION['google_data']['id'] . "','" . $_SESSION['google_data']['gender'] . "','','','','','" . $_SESSION['google_data']['picture'] . "','','','')";
                    //echo $query;
                    mysql_query($query);
                    $id = mysql_insert_id();
                    $registration_id = 1100 + $id;
                    $date_code = date('ym');
                    $client_code = 'CC' . $date_code . $registration_id;
                    $query = "update auth_user set registration_id='$client_code' where id = $id";
                    mysql_query($query);
                    $query = "update auth_user set status='1' where email='" . $_SESSION['google_data']['email'] . "' and password='" . $pass . "' ";
                    mysql_query($query);
                    //echo $query;
                    $sql_fetch_auth = mysql_query("select * from auth_user where email='" . $_SESSION['google_data']['email'] . "'");
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
            ?>
        </div>
    </body>
</html>