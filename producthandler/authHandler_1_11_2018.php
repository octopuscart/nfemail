<?php

function phpjsonstyle($data, $data_type) {

    $data = trim(trim($data, "{"), "}");
    $t = explode(",", $data);

    $temp = array();
    foreach ($t as $key => $value) {
        $t1 = explode(':', $value);
        $temp3 = $t1[1];
        $temp3 = substr($temp3, 0, -1);
        $temp3 = ltrim($temp3, '"');
        $temp31 = str_replace("++*++", ",", $temp3);
        $temp32 = str_replace("|||||", "'", $temp31);
        $temp[trim($t1[0], '"')] = $temp32;
    }

    if ($data_type == 'php') {
        return $temp;
    }
    if ($data_type == 'json') {
        return json_encode($temp);
    }
}

class AuthHandler {

    function frontend_login($login, $table) {

        $pass = md5($login['pass']);
        $query = "select * from $table where email='" . $login['email'] . "' and password='" . $pass . "'  and status != 'Inactive' ";
        $sql_fetch_auth = mysql_query($query);

        if (mysql_num_rows($sql_fetch_auth) > 0) {
            mysql_query("update $table set status='1' where email='" . $login['email'] . "' and password='" . $pass . "'");

            while ($get_fetch_auth = mysql_fetch_array($sql_fetch_auth)) {

                $_SESSION['user_id'] = $get_fetch_auth['id'];
                $_SESSION['user_name'] = $get_fetch_auth['first_name'];
                $_SESSION['user_img'] = $get_fetch_auth['user_img'];
                $sql_login = mysql_query("select * from auth_event where user_id='" . $_SESSION['user_id'] . "' and description='login' ORDER BY id DESC limit 0,1");
                $get_login = mysql_fetch_array($sql_login);
                $_SESSION['last_login'] = $get_login['time_stamp'];
                $_SESSION['id'] = session_id();
                $this->user_status($get_fetch_auth['id'], 'login');
                $dat = date('Y-m-d ');
                $tm = date('H:i:s');
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    $query = "insert into nfw_product_cart (product_id,user_id,op_date,op_time,quantity, tag_id) values('" . $_SESSION['cart'][$i][0] . "','" . $_SESSION['user_id'] . "','$dat','$tm','" . $_SESSION['cart'][$i][3] . "', '" . $_SESSION['cart'][$i][1] . "')";
                    mysql_query($query);
                }
                unset($_SESSION['cart']);

                //mysql_query("update nfw_product_cart set user_id='" . $_SESSION['user_id'] . "' where user_id='" . $_SERVER['REMOTE_ADDR'] . "'");
                //header("location:index.php");
            }
            $msg = 'TRUE';
        } else {
            $msg = "FALSE";
        }
        return $msg;
    }

    #11-dec-2015 create 

    function frontend_login_from_adminpanel($email, $password, $table, $user_id) {

        $pass = md5($password);
        $sql_fetch_auth = mysql_query("select * from $table where email='" . $email . "' and password='" . $password . "' and status != 'Inactive'");

        if (mysql_num_rows($sql_fetch_auth) > 0) {
            mysql_query("update $table set status='1' where email='" . $email . "' and password='" . $password . "' ");

            while ($get_fetch_auth = mysql_fetch_array($sql_fetch_auth)) {

                $_SESSION['user_id'] = $get_fetch_auth['id'];
                $_SESSION['user_name'] = $get_fetch_auth['first_name'];
                $_SESSION['user_img'] = $get_fetch_auth['user_img'];
                $sql_login = mysql_query("select * from auth_event where user_id='" . $user_id . "' and description='login' ORDER BY id DESC limit 0,1");
                $get_login = mysql_fetch_array($sql_login);
                $_SESSION['last_login'] = $get_login['time_stamp'];
                $_SESSION['id'] = session_id();
                $this->user_status($get_fetch_auth['id'], 'login');
                $dat = date('Y-m-d ');
                $tm = date('H:i:s');
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    $query = "insert into nfw_product_cart (product_id,user_id,op_date,op_time,quantity, tag_id) values('" . $_SESSION['cart'][$i][0] . "','" . $user_id . "','$dat','$tm','" . $_SESSION['cart'][$i][3] . "', '" . $_SESSION['cart'][$i][1] . "')";
                    mysql_query($query);
                }
                unset($_SESSION['cart']);

                //mysql_query("update nfw_product_cart set user_id='" . $_SESSION['user_id'] . "' where user_id='" . $_SERVER['REMOTE_ADDR'] . "'");
                //header("location:index.php");
            }
            $msg = 'TRUE';
        } else {
            $msg = "FALSE";
        }
        return $msg;
    }

    function mail_configuration() {
        $conf = resultAssociate("select * from configuration_mail");
        $conf = end($conf);
        return $conf;
    }

    function server_configuration() {
        $conf = resultAssociate("select * from server_conf");
        $conf = end($conf);
        return $conf;
    }

    function frontend_logout($id) {
        $this->user_status($id, 'logout');
        //mysql_query("update auth_user set status='0' where id=" . $_SESSION['user_id']);
        session_destroy();
        header("location:index.php");
    }

    function user_registration($data, $table) {

        $email = $this->user_checking($data['email'], $table);
        $ref_id = $_REQUEST['ref_id'];
        $sender_id = $_REQUEST['sender_id'];
        $op_date_time = date('Y-m-d H:i:s');
        $temp = array_merge(range('A', 'Z'), range(0, 9));

        $temp1 = "";
        for ($i = 0; $i < 8; $i++) {
            $temp1 .= $temp[rand(0, (count($temp) - 1))];
        }
        $token = md5($temp1);

        $baselink = 'http://' . $_SERVER['SERVER_NAME'];
        $baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';

        if ($email == 'No user') {
            $pass = md5($data['pass']);
            $birth = $data['birth_year'] . '-' . $data['birth_month'] . '-' . $data['birth_date'];

            $middlename = mysql_real_escape_string($data['middle_name']);
            $fname = mysql_real_escape_string($data['first_name']);
            $lname = mysql_real_escape_string($data['last_name']);
            $country = mysql_real_escape_string($data['country']);
            
            $profession_value = mysql_real_escape_string($data['profession_value']);
            $profession_id = mysql_real_escape_string($data['profession_id']);

            mysql_query("INSERT INTO $table(middle_name,first_name, last_name, email, password,gender,birth_date, status, user_img, joining_date, profession_value, profession_id, country) VALUES ('" . $middlename . "','" . $fname . "','" . $lname . "','" . $data['email'] . "','$pass','" . $data['gender'] . "','" . $birth . "', 'Inactive', '" . $token . "', '" . $op_date_time . "', '".$profession_value."', '".$profession_id."', '".$country."')");
            $id = mysql_insert_id();

            $registration_id = 1100 + $id;
            $date_code = date('ym');
            $client_code = 'CC' . $date_code . $registration_id;
            mysql_query("update $table set registration_id='$client_code' where id=$id");
            //  $this->frontend_login($data, $table);
            $username = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];

            $uquery = "insert into nfw_news_letters_frequency(user_id, frequency) values($id, 'Full Experience')";
            resultAssociate($uquery);
            $email = $data['email'];

            /////////// For update coupon refernce id
            if ($sender_id) {
                mysql_query("update nfw_site_reference set receiver_id = $id where id = $ref_id and sender_id = $sender_id");
            }
            /////////// For check ur customer for coupon///////
            $email1 = $data['email'];
            $coupon = resultAssociate("SELECT np.coupon_id FROM `nfw_coupon_purchase` as np
                                              join nfw_coupon_sendgift as ng
                                              on np.id = ng.nfw_purchase_id where ng.user_email = '$email1' and ng.user_status = 'ur'");
            if ($coupon) {
                ///// notification 
                $message = "Congratulations!!! You have received gift<br/>Start Shoping now";

                $page_link = $baselinkmain . '/views/storCredit.php';
                $query = "insert into nfw_notification_user (title,message,user_id,status,page_link) values('Gift Received','$message','$id','0','$page_link')";
                mysql_query($query);
                $coupon_id1 = $coupon[0]['coupon_id'];
                //echo $coupon_id1;
                mysql_query("update nfw_coupon_sendgift set user_status = 'r' where user_email = '$email1'");
                mysql_query("insert into nfw_coupon_sending_info (user_id,coupon_id,mail,subject,content,op_date_time) values('$id','$coupon_id1','$email1','Coupon Information','','$op_date_time')");
            }
            ///////////////////////////
            $mailurl = $baselinkmain . "/views/sendMail.php";
            $a = $mailurl . "?mail_type=2&user=" . $username . "&email=" . $email . "&token=" . $token . "&country=" . $country . "&access=" . $id;
            header("location:$a");
            $msg = 'TRUE';
        } else {
            $msg = "FALSE";
        }
        return $msg;
    }

    # 26-sep-2015 create function for send mail

    function welcomeMail($email, $username) {
        
    }

    function user_checking($email, $table) {
        $sql_fetch_email = mysql_query("select * from $table where email='" . $email . "'");
        $num = mysql_num_rows($sql_fetch_email);
        if ($num > 0) {
            $return = 'Yes user';
        } else {
            $return = 'No user';
        }
        return $return;
    }

    function frontend_change_password($new_password, $token, $table) {
        $idpass = explode('_____AAAAAAAA', $token);
        $id = $idpass[1];
        $pass = $idpass[0];
        $new_pass = md5($new_password);
        $sql_fetch_auth = mysql_query("select * from $table where id='" . $id . "' and password = '$pass'");
        while ($row = mysql_fetch_array($sql_fetch_auth)) {
            mysql_query("update $table set password='$new_pass' where id='" . $row['id'] . "' ");
        }
    }

    function forget_login_detail($email, $table) {
        $sql_fetch_detail = mysql_query("select * from $table where email='" . $email . "'");
        $get_fetch_auth = mysql_fetch_array($sql_fetch_detail);
        $password = $get_fetch_auth['password'];
        $id = $get_fetch_auth['id'];
        $serverconf = $this->server_configuration();



        $baselink = 'http://' . $_SERVER['SERVER_NAME'];
        $baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
        $mailurl = $baselinkmain . "/views/sendMail.php";

        $a = $mailurl . "?mail_type=3&passwordkey=" . $password . "&email=" . $email . "&id=" . $id;
        header("location:$a");
    }

    function user_status($id, $status) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }



        mysql_query("INSERT INTO `auth_event`(`time_stamp`, `client_ip`, `user_id`, `origin`, `description`) VALUES ('" . date('Y-m-d H:i:s') . "','" . $ip . "','$id','','$status')");
    }

    ## For Update user detail

    function updateUserDetail($middlename, $fname, $lname, $email, $gender, $contact, $user_id, $fax_no, $telephone_no, $birthdate, $profession_id, $profession_value) {
        $pas = md5($pass);
        $middlename = mysql_real_escape_string($middlename);
        $fname = mysql_real_escape_string($fname);
        $lname = mysql_real_escape_string($lname);
        mysql_query("update auth_user set middle_name = '$middlename', first_name = '$fname', last_name = '$lname',gender = '$gender',contact_no = '$contact',fax_no = '$fax_no', telephone_no = '$telephone_no', birth_date='$birthdate', profession_id = '$profession_id', profession_value = '$profession_value' where id = $user_id");
        $this->userProfile($user_id);
    }

    # find cart id from user id
    #update 19-oct-2015
    #update 9-dec-2015

    function findProductId($user_id, $order_id) {
        $data = resultAssociate("SELECT npc.id,npc.customization_id,npc.measurement_id FROM `nfw_product_cart` as npc 
                                 where npc.order_id = $order_id and npc.user_id = $user_id ");
        return $data;
    }

    ### for Order history##

    function allCartId($user_id, $order_id) {
        $result = resultAssociate("SELECT * FROM `nfw_product_order`  where user_id = $user_id and id = $order_id ");
        return $result;
    }

    ## for find order status ##

    function orderStatus($order_id) {
        $result = resultAssociate("SELECT tag.title FROM `nfw_order_status` as nos join nfw_order_status_tag as tag on nos.status = tag.id where nos.order_id = $order_id ");
        return $result;
    }

    ## For user profile ###

    function userProfile($user_id) {
        if ($user_id == '') {
            return 'login';
        } else {
            $query = "SELECT * FROM `auth_user` where id = $user_id ";
            return resultAssociate($query);
        }
    }

    ###### For user customizetion measurement ######

    function userMeasurement($user_id, $table_name) {
        $query = "SELECT * FROM $table_name   where id = $style_id and user_id = $user_id";
        return resultAssociate($query);
    }

    function authProductId($user_id) {
        //echo "SELECT npc.id FROM `nfw_product_order` as npo join nfw_product_cart as npc on npo.id = npc.order_id where npo.user_id = $user_id order by npo.id desc limit 0,1";
        $data = resultAssociate("SELECT npc.id FROM `nfw_product_order` as npo join nfw_product_cart as npc on npo.id = npc.order_id 
                                 where npo.user_id = $user_id order by npo.id desc limit 0,1");

        return $data;
    }

    function allauthCartId() {
        $result = resultAssociate("SELECT npo.id as id,np.title,np.sku,npo.op_date,npo.op_time,np.price,npc.extra_price,npo.total_quantity,npo.total_price FROM `nfw_product_order` 
                                        as npo join nfw_product_cart as npc on npo.id = npc.order_id
                                        join nfw_product as np on npc.product_id = np.id");
        return $result;
    }

    function singleOrderDetail($user_id) {

        $lastId = $this->authuserAddress($user_id);
        $lastOrderId = $lastId[0]['order_ids'];
        $result = resultAssociate("SELECT npo.id as ord,np.title,np.sku,npo.op_date,npo.op_time,npo.total_price,npo.total_quantity 
                                         FROM `nfw_product_cart` as npc 
                                         join nfw_product as np on npc.product_id = np.id
                                         join nfw_product_order as npo on npc.order_id = npo.id
                                          where npo.id = $lastOrderId ");
        return $result;
    }

    ## For insert address(POP UP Action)

    function userBillingShippingAdd($user_id, $data) {
        $add1 = $data['address1'];
        $add2 = $data['address2'];
        $city = $data['city'];
        $state = $data['state'];
        $country = $data['country'];
        $zip = $data['zip'];
        $contact = $data['contact_no'];

        if (isset($data['bill']) && isset($data['ship'])) {
            mysql_query("update nfw_billing_shipping_address set default_billing_address = 'no',default_shipping_address ='no' where user_id = $user_id");
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,contact_no,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('$add1','$add2','$city','$state','$country','$zip','$contact','$user_id','no','no','yes','yes') ");
        }

        if (isset($data['bill']) && !isset($data['ship'])) {
            mysql_query("update nfw_billing_shipping_address set default_billing_address = 'no'  where user_id = $user_id");
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,contact_no,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('$add1','$add2','$city','$state','$country','$zip','$contact','$user_id','no','no','no','yes') ");
        }

        if (isset($data['ship']) && !isset($data['bill'])) {
            mysql_query("update nfw_billing_shipping_address set default_shipping_address = 'no'  where user_id = $user_id");
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,contact_no,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('$add1','$add2','$city','$state','$country','$zip','$contact','$user_id','no','no','yes','no') ");
        }

        if (!isset($data['ship']) && !isset($data['bill'])) {
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,contact_no,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('$add1','$add2','$city','$state','$country','$zip','$contact','$user_id','no','no','no','no') ");
        }
    }

    ## For get all Addresses

    function findAddress($user_id) {
        $query = " SELECT concat(address1,' ',address2,' ', city, ' ', state, ' ', zip, ' ',country) as addr ,id
                             FROM `nfw_billing_shipping_address`  where  user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

    ##24-Aug-2015
    #Insert bill & ship data into nfw_billing_shipping_address table
    #not need 9-dec

    function bill_ship_insert($data, $user_id) {
        $bill_id = '';
        $ship_id = '';
        if ($data['shipping_add']) {
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('" . $data['address1'] . "','" . $data['address2'] . "','" . $data['city'] . "','" . $data['state'] . "','" . $data['country'] . "','" . $data['zip'] . "','$user_id','no','yes','no','yes') ");
            $bill_id = mysql_insert_id();
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('" . $data['s_address1'] . "','" . $data['s_address2'] . "','" . $data['s_city'] . "','" . $data['s_state'] . "','" . $data['s_country'] . "','" . $data['s_zip'] . "','$user_id','yes','no','yes','no') ");
            $ship_id = mysql_insert_id();
        } else {
            mysql_query("insert into nfw_billing_shipping_address (address1,address2,city,state,country,zip,user_id,shipping_address,billing_address,default_shipping_address,default_billing_address) values('" . $data['s_address1'] . "','" . $data['s_address2'] . "','" . $data['s_city'] . "','" . $data['s_state'] . "','" . $data['s_country'] . "','" . $data['s_zip'] . "','$user_id','yes','yes','yes','yes') ");
            $ship_id = mysql_insert_id();
            $bill_id = $ship_id;
        }

        return [$bill_id, $ship_id];
    }

    ### End ####

    function ChangeBillShip($bill_id, $ship_id) {
        // echo "sdfsf";
        // echo $bill_id,$ship_id, "sdfsdfsdfsdf";
        if ($ship_id != '') {
            $ship = "default_shipping_address = 'no'";
        }
        if ($bill_id != '') {
            $bill = "default_billing_address = 'no' ";
        }
        if ($bill_id != '' && $ship_id != '') {
            $coma = ',';
        }
        mysql_query("update nfw_billing_shipping_address set $bill $coma $ship");
        mysql_query("update nfw_billing_shipping_address set default_shipping_address = 'yes'  where id = $ship_id");
        mysql_query("update nfw_billing_shipping_address set default_billing_address = 'yes'  where id = $bill_id");
        //return 'yes';
    }

    function getDefaultAddress($colomn, $user_id) {
        $query = "SELECT concat(address1,' ') as add1,concat(address2,' ') as add2,concat(city,',  ', state ,'') as add3,zip as add5,country as add4,
                               id  FROM `nfw_billing_shipping_address` where $colomn = 'yes' and user_id = '$user_id'  ";
        $result = resultAssociate($query);
        return $result;
    }

    #25-Aug-2015
    # For order tacking

    function allOrderDetails($user_id) {
        $query = " SELECT npo.id,npo.op_date,npo.op_time,npo.order_no,
                   npo.total_price,tag.title FROM `nfw_product_order` as npo 
                   join nfw_order_status as nos on npo.id = nos.order_id
                   join nfw_order_status_tag as tag on nos.status = tag.id
                   where npo.user_id =  $user_id  order by op_date desc,npo.order_no desc";
        $result = resultAssociate($query);
        return $result;
    }

    #26-Aug-2015
    # For change password

    function changePassword($user_id, $old_password, $newpassword, $confirmpassword) {
        $oldP = $this->userProfile($user_id);
        $oldP2 = md5($old_password);
//        if ($oldP[0]['password'] == $oldP2) {
        if (1) {
            if (md5($newpassword) == md5($confirmpassword)) {
                $new_pass = md5($confirmpassword);
                mysql_query("update auth_user set password = '$new_pass' where id = $user_id ");
                $msg = "Password change successfully";
            } else {
                $msg = "Password do not match";
            }
        } else {
            $msg = "You have entered wrong password";
        }
        return $msg;
    }

    # For user wishlist

    function userWishList($user_id) {
        $query = "SELECT * FROM `nfw_product_wishlist` where user_id = $user_id  group by product_id";
        $result = resultAssociate($query);
        return $result;
    }

    #27 Aug-2015
    #9-dec-2015 update

    function userWholeOrderDetail($order_id, $user_id) {
        $query = " SELECT npo.id,npo.op_date,npo.op_time,npo.order_no,npo.total_price,npo.total_quantity,npo.coupon_id,
                           npo.billing_id,npo.shipping_id,npo.user_info,npo.wallet_amount,npo.shipping_amount,npo.payment_gateway
                           FROM `nfw_product_order` as npo
                           where npo.id = $order_id and npo.user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

    #28 Aug-2015
    # fetch address using id

    function findAddressUsingId($addId) {
        //echo  "select address1,address2,city,state,country,zip from nfw_billing_shipping_address where id =  $addId ";
        $query = " select address1,address2,city,state,country,zip,id from nfw_billing_shipping_address where id =  $addId ";
        $result = resultAssociate($query);
        return $result;
    }

    #31-Aug-2015
    # for count tags shirt or pant

    function countProducts($order_id) {
        //   echo $order_id;
        // echo  "SELECT customize_table,count(id) as total FROM `nfw_product_cart` where order_id = $order_id group by customize_table";
        $query = "SELECT tag_id,sum(quantity) as total FROM `nfw_product_cart` where order_id = $order_id group by tag_id";
        $result = resultAssociate($query);
        return $result;
    }

    function updateAddress($data) {
        // print_r($data);
        $query = "update nfw_billing_shipping_address set address1 = '" . $data['address1'] . "',address2 = '" . $data['address2'] . "',city = '" . $data['city'] . "',state = '" . $data['state'] . "',country = '" . $data['country'] . "',zip = '" . $data['zip'] . "' where id = '" . $data['addID'] . "' ";
        mysql_query($query);
    }

    #1-sep-2015
    # for find tags for user wishlist

    function wishlistProductTag($product_id) {
        $query = "SELECT nfw_product_tag.tag_title,nfw_product_tag.id  FROM `nfw_product_tag_connection` join nfw_product_tag on
                    nfw_product_tag_connection.tag_id = nfw_product_tag.id
                    where nfw_product_tag_connection.product_id = $product_id ";
        $result = resultAssociate($query);
        return $result;
    }

    #For preference tags

    function preferenceTag() {
        $query = " SELECT id,tag_title FROM `nfw_product_tag` order by tag_index asc ";
        $result = resultAssociate($query);
        return $result;
    }

    #Find style id using tag
    #Update function 19-sep-2015
    #update function 21-sep-2015
    #update 5-oct-2015
    #update 6-oct-2015

    function findStyleId($tag, $user_id) {
        $query = "SELECT  * FROM nfw_custom_form_data as nfc  where user_id = '$user_id' and tag_id = '$tag' and is_active !='False' order by nfc.default desc ,datetime desc";
        $result = resultAssociate($query);
        return $result;
    }

    # using userid find invoice detail

    function invoiceDetail($user_id) {
        //$query = "SELECT * FROM `nfw_order_invoice`  where id = $style_id and user_id = $user_id";
        $query = "SELECT nv.*,no.order_no,no.coupon_id,no.wallet_amount FROM `nfw_order_invoice` as nv join nfw_product_order as no 
                    on nv.order_id = no.id where nv.user_id = $user_id order by nv.op_date desc,nv.invoice_no desc";
        $result = resultAssociate($query);
        return $result;
    }

    # using order+id and invoice find invoice detail

    function invoiceOrderDetail($user_id, $order_id) {
        $query = "SELECT * FROM `nfw_order_invoice` where user_id = $user_id  and order_id = $order_id ";
        // echo $query;
        $result = resultAssociate($query);
        return $result;
    }

    #2-Sep-2015
    #Function for delete address

    function deleteAddress($addressId) {
        $query = "delete from nfw_billing_shipping_address where id = $addressId ";
        mysql_query($query);
    }

    #Find orderId using user 

    function orderId($user_id) {
        $query = "SELECT id FROM `nfw_product_order` where user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

    #Find order shipping detail using order id
    #Update 5-oct-2015

    function orderShippingDetail($user_id) {
        // echo "SELECT * FROM `nfw_order_shipping` where order_id = $order_id ";
        $query = "SELECT nos.* FROM `nfw_order_shipping` as nos join nfw_product_order as no
                      on nos.order_id = no.id where no.user_id = $user_id order by no.op_date desc, nos.order_no desc";
        $result = resultAssociate($query);
        return $result;
    }

    #for find status name using id

    function statusTag($ids) {
        //echo $ids;
        $query = "SELECT title FROM `nfw_order_status_tag` where id = $ids ";
        $result = resultAssociate($query);
        return $result;
    }

    #timeline

    function OrderStatusValue($order_id) {
        $query = "SELECT status FROM `nfw_order_status` where order_id = $order_id ";
        $result = resultAssociate($query);

        for ($i = 0; $i < count($result); $i++) {
            $arr1 = $result[$i];
        }
        return $arr1;
    }

    #5-sep-2015
    #find total price or total exta price
    #update function again 24-sep-2015

    function totalExtraPrice($order_id) {
        $query = "SELECT sum(nc.quantity*ntc.price) as total,sum(nc.quantity*extra_price) as extra  FROM `nfw_product_cart` as nc
                  join nfw_product_tag_connection as ntc on ntc.tag_id = nc.tag_id and ntc.product_id = nc.product_id
                  where nc.order_id = $order_id ";
        $result = resultAssociate($query);
        return $result;
    }

    #11-sep-2015
    #For manage discount
    #update 26-nov-2015

    function discountManage($copon, $user_id, $total_price) {
        //$query = "SELECT value,value_type,coupon_code,id FROM `nfw_coupon` WHERE CURDATE() between start_date and end_date and coupon_code = '$copon' ";
        $query = "SELECT value,value_type,coupon_code,id FROM `nfw_coupon` 
                  WHERE id not in(select coupon_id from nfw_product_order) 
                  and coupon_code not in(SELECT reference_id FROM `nfw_wallet`)
                  and CURDATE() between start_date and end_date and coupon_code = '$copon' ";
        $result = resultAssociate($query);
        //print_r($result);
        $dte1 = date('Y-m-d H:i:s');
        if ($result) {

            $val1 = $result[0]['value'];
            $val_type = $result[0]['value_type'];
            //echo $total_price;
            $temp = array();

            if ($val_type == '%') {
                $data = ($total_price * $val1) / 100;
            }
            if ($val_type == 'Fixed') {
                $data = $val1;
            }

            $temp['coupon_id'] = $result[0]['id'];
            $temp['coupon_code'] = $result[0]['coupon_code'];
            $temp['value_code'] = $data;
        } else {
            $temp = array();
        }

        return $temp;
    }

    #18-dec-2015
    #function for store credit

    function stor_credit_calc($copon, $user_id) {

        $query = "SELECT value,value_type,coupon_code,id FROM `nfw_coupon` 
                  WHERE id not in(select coupon_id from nfw_product_order) 
                  and coupon_code not in(SELECT reference_id FROM `nfw_wallet`)
                  and CURDATE() between start_date and end_date and coupon_code = '$copon' ";
        $result = resultAssociate($query);
        $dte1 = date('Y-m-d H:i:s');
        $temp = array();
        if ($result) {

            $val1 = $result[0]['value'];
            $val_type = $result[0]['value_type'];

            if ($val_type == 'Fixed') {
                $data = $val1;
                $query = "insert into `nfw_wallet` (`reference_id`,`user_id`,`credit_amt`,`debit_amt`,`txn_type`,`date_time`,`remark`) values('$copon','$user_id','$data','','Coupon','$dte1','Coupon') ";
                mysql_query($query);
            }

            $temp['success'] = "Successfully add amount to wallet";
        } else {
            $temp['error'] = "Invalid/Used discount coupon";
        }
        return $temp;
    }

    #2-dec-2015
    #for show coupon on page

    function userCouponDetail($user_id) {
        $query = "SELECT c.coupon_code,c.value,c.value_type,c.end_date FROM `nfw_coupon_sending_info` as cs join nfw_coupon as c
                      on cs.coupon_id = c.id
                      where cs.user_id = $user_id and CURDATE() between c.start_date and c.end_date and cs.coupon_id not in(SELECT coupon_id FROM `nfw_product_order`) 
                      and c.coupon_code not in(SELECT reference_id FROM `nfw_wallet`)
                      order by cs.coupon_id desc ";
        //echo $query;
        $result = resultAssociate($query);
        return $result;
    }

    #19-sep-2015
    #for style detail
    #update function 21-sep-2015
    #update function 22-sep-2015
    #update 5-oct-2015
    #update 6-oct-2015

    function styleDetail($style_id, $tag_id, $user_id) {

        $tablearray = array(
            1 => 'nfw_shirt_custom',
            2 => 'nfw_pant_custom',
            3 => 'nfw_waist_coat_custom',
            5 => 'nfw_jacket_custom',
            7 => 'nfw_tuxedo_shirt_custom',
            8 => 'nfw_tuxedo_pant_custom',
            10 => 'nfw_tuxedo_suit_custom',
            11 => 'nfw_suit_custom',
            14 => 'nfw_tuxedo_jacket_custom',
            15 => 'nfw_over_coat_custom',
        );
        if (array_key_exists($tag_id, $tablearray)) {
            $query = "SELECT * FROM $tablearray[$tag_id] where id = $style_id and user_id = $user_id";
            $result = resultAssociate($query);
        }

        return $result;
    }

    function updateStyle($data) {
        $ids = $data['id'];
        foreach ($data as $key => $value) {
            $query = "update nfw_shirt_custom set $key = '$value' where id = $ids ";
            mysql_query($query);
        }
    }

    #24-sep-2015
    #update 5-oct
    #update 6-oct-2015
    #update 13-oct-2015

    function extraPriceDetail($id) {
        $query = "SELECT custom_form_data FROM `nfw_custom_form_data` where id = $id";
        $result = resultAssociate($query);
        //print_r($result);
        //$data = $this->phpjsonstyle($result[0]['custom_form_data'],'json');
        //print_r($result);
        return $result;
    }

    #29-sep-2015
    #14-12-2015 

    function userMeasurment($tag, $user_id) {
        $query = "SELECT nm. *  FROM nfw_measurement_data AS nm  WHERE nm.user_id = '$user_id' AND nm.tag_id = '$tag' and nm.is_active != 'False' GROUP BY nm.id order by nm.default desc, datetime desc";
        $result = resultAssociate($query);
        return $result;
    }

    function userMeasurmentDetail($measurement_id, $tag, $user_id) {
        $query = "SELECT nm.* FROM  `nfw_product_cart` AS npc JOIN nfw_measurement AS nm ON nm.id = npc.measurement_id WHERE npc.user_id = '$user_id' AND npc.tag_id = '$tag' And nm.id='$measurement_id'  limit 1";
        $result = resultAssociate($query);

        return $result;
    }

    function updateMeasurement($data) {
        $ids = $data['id'];
        foreach ($data as $key => $value) {
            $query = "update nfw_measurement set $key = '$value' where id = $ids ";
            mysql_query($query);
        }
    }

    #30-sep-2015
    #Create function for enter default style

    function userDefaultStyle($user_id, $tag_id, $style_id) {
        $all_update = "update nfw_custom_form_data as ncfd set ncfd.default=0 where user_id = $user_id and tag_id=$tag_id";
        mysql_query($all_update);
        mysql_query("update nfw_custom_form_data as ncfd set ncfd.default=1 where id=$style_id");
    }

    function deleteStyle($style_id) {
        $all_update = "update nfw_custom_form_data as ncfd set ncfd.is_active='False' where id=$style_id";
        mysql_query($all_update);
    }

    function deleteMeasurement($measurement_id) {
        $all_update = "update nfw_measurement_data as ncfd set ncfd.is_active='False' where id=$measurement_id";
        mysql_query($all_update);
    }

    #30-sep-2015
    #Create function for enter default style

    function SelectuserStyle($user_id, $tag_id) {
        $query = "select style_id from nfw_user_default_style where user_id = $user_id and tag_id='$tag_id' order by id desc limit 0,1";
        $result = resultAssociate($query);
        return $result;
    }

    #30-sep-2015
    #Create function for enter default style

    function userDefaultMeasurement($user_id, $tag_id, $measurement_id) {
        $all_update = "update nfw_measurement_data as ncfd set ncfd.default=0 where user_id = $user_id and tag_id=$tag_id";
        mysql_query($all_update);
        mysql_query("update nfw_measurement_data as ncfd set ncfd.default=1 where id=$measurement_id");
    }

    function SelectuserMeasurement($user_id, $tag_id) {
        $query = "select measurement_id from nfw_user_default_measurement where user_id = $user_id and tag_id=$tag_id order by id desc limit 0,1";
        $result = resultAssociate($query);
        return $result;
    }

    #function for find coupan detail

    function coupanDetail($cup_id, $total_price) {
        //echo $cup_id;
        //echo $total_price;
        $query = "SELECT value,value_type FROM `nfw_coupon` where id = $cup_id ";
        $result = resultAssociate($query);
        $val1 = $result[0]['value'];
        $val_type = $result[0]['value_type'];
        //echo $total_price;
        if ($val_type == '%') {
            //echo "tt";
            $data = ($total_price * $val1) / 100;
            // echo $data;
        }
        if ($val_type == 'Fixed') {
            $data = $val1;
        }
        //echo $data;
        return $data;
    }

    #function for find styleId using customization Id
    #Update function 12-oct-2015
    #update 24-nov-2015

    function styleIdWithCustomizationID($customization_id) {
        $query = "select cfd.custom_form_data,cfd.style_profile,cfdp.custom_form_data_price from nfw_custom_form_data as cfd join nfw_custom_form_data_price as cfdp 
                                on cfd.id = cfdp.nfw_custom_form_data_id
                                where cfd.id = $customization_id ";

        $result = resultAssociate($query);
        return $result;
    }

    # function for find profile name using  measurement_id

    function profile_name($measurement_id) {
        $query = "SELECT measurement_profile,measurement_data,posture_data FROM `nfw_measurement_data` where id = $measurement_id";
        $result = resultAssociate($query);
        return $result[0];
    }

    #Order confirmation/cancelation mail
    #17-nov-2015
    #update 9-dec-2015

    function orderConfirmMail($orderId, $userId) {

        $orderDetail = $this->userWholeOrderDetail($orderId, $userId);
        //print_r($orderDetail);
        $userInfo = phpjsonstyle($orderDetail[0]['user_info'], 'php');
        // print_r($userInfo);
        $shipping = phpjsonstyle($orderDetail[0]['shipping_id'], 'php');
        $productAllId = $this->findProductId($userId, $orderId);
        //print_r($productAllId);
        $invoice_data = $this->invoiceOrderDetail($userId, $orderId);
        include './productHandler.php';
        $cartprd = new CartHandler();
        $authobj = $this;
        $mailconf = $this->mail_configuration();
        include '../views/orderConfirmMail.php';
    }

    function senderMail($orderId, $userId, $mailtype) {

        $orderDetail = $this->userWholeOrderDetail($orderId, $userId);
        $userInfo = $this->userProfile($userId);
        $productAllId = $this->findProductId($userId, $orderId);
        $invoice_data = $this->invoiceOrderDetail($userId, $orderId);
        include './productHandler.php';
        $cartprd = new CartHandler();
        $authobj = $this;
        include '../views/sendMail.php';
    }

    #18-nov-2015
    #order cancellation mail

    function orderCancellationMail($order_id, $user_id) {
        $data = $this->userWholeOrderDetail($order_id, $user_id);
        $userInfo = $this->userProfile($user_id);
        include '../views/orderCancellationMail.php';
    }

    #16-Oct-2015
    #for cancel order

    function cancelOrder($user_id, $order_id) {
        //echo "fdgfh";
        //$this->orderCancellationMail($order_id, $user_id);
        $old_status = resultAssociate("select * from nfw_order_status where order_id = $order_id");

        $old_status = end($old_status);

        //unset($old_status['id']);

        $status = $old_status['status'];

        $remark = $old_status['remark'];

        $opdate = $old_status['op_date_time'];

        $insquery = "insert into nfw_old_order_status(order_id,	status,	remark,	op_date_time) values('$order_id', '$status', '$remark', '$opdate')";
        mysql_query($insquery);

        $query = mysql_query("update nfw_order_status set remark =  'Order has been cancelled by client', status = '6'
                  where order_id = $order_id");
        //$query = mysql_query("update nfw_product_cart set order_id = NULL,customization_id = 0, measurement_id =0 where order_id = $order_id and user_id = $user_id");

        header("location:sendMail.php?order_id=$order_id&user_id=$user_id&mail_type=1&mail_set=order");
    }

    #30-oct-2015

    function cardInfoInsertion($user_id, $data) {
        $f1 = $data['card-holder-name'];
        $f2 = $data['card-number'];
        $f3 = $data['expiry-month'];
        $f4 = $data['expiry-year'];
        $f7 = $data['bank_name'];
        $f5 = $data['address'];
        $f6 = $data['cvv'];
        $query = "insert into nfw_user_card (user_id,card_holder_name,card_number,expiry_month,expiry_year,address,cvv,default_active,bank_name) values('$user_id','$f1','$f2','$f3','$f4','$f5','$f6','0','$f7') ";
        mysql_query($query);
    }

    #fetch card detail

    function card_detail($user_id) {
        $query = "SELECT * FROM nfw_user_card where user_id = $user_id ";
        $result = resultAssociate($query);
        return $result;
    }

    #delete

    function delete_card($user_id, $data) {
        // print_r($data);
        $query = "delete from nfw_user_card where id = $data and user_id =  $user_id";
        mysql_query($query);
        //mysql_query("update nfw_user_card  set default_active = '1' where id = $card and user_id = $user_id ");
    }

    function payment_history($user_id, $po_id = 0) {

        if ($po_id) {
            $po_query = " and po.id = $po_id";
        } else {
            $po_query = '';
        }


        $query = "SELECT np.transaction_no,np.status,po.order_no,ni.invoice_no,ni.op_date,ni.op_time,ni.total_amount,nc.card_number,nc.bank_name, po.payment_gateway FROM `nfw_order_invoice` as ni
                      join nfw_order_payment as np on ni.order_id = np.order_id
                      join nfw_product_order as po on ni.order_id = po.id
                      left join nfw_user_card as nc on np.card_id = nc.id
                      where ni.user_id = " . $user_id . $po_query . " order by ni.invoice_no desc,ni.op_date desc";

        $result = resultAssociate($query);
        return $result;
    }

    #5-Nov-2015
    #for update card

    function select_card_info($catdId, $userId) {
        $query = "SELECT * FROM nfw_user_card where user_id = $userId and id = $catdId";
        $result = resultAssociate($query);
        return $result;
    }

    function updateCard($user_id, $data) {
        $card_holder_name = $data['card_holder_name'];
        $car_no = $data['card_number'];
        $expiry_month = $data["expiry_month"];
        $expiry_year = $data["expiry_year"];
        $address = $data["address"];
        $bank_name = $data["bank_name"];
        $cvv = $data["cvv"];
        $ids = $data['addID'];
        $query = "update nfw_user_card set card_holder_name='$card_holder_name',card_number='$car_no',expiry_month='$expiry_month',expiry_year ='$expiry_year',address='$address',cvv='$cvv',bank_name='$bank_name'  where id= $ids and user_id = $user_id ";
        mysql_query($query);
    }

    #26-nov-2015
    #function for find customformdata by style id

    function custom_form_detail($style_id) {
        $query = "select * from nfw_custom_form_data where id = $style_id";
        $result = resultAssociate($query);
        return $result;
    }

    #2-Dec-2015
    //function find customized product(imp)

    function idCustomizationwithValue($user_id) {
        $query = " SELECT id,op_date,op_time,product_id FROM `nfw_product_cart` where user_id = $user_id and customization_id != '' and (ISNULL(order_id) or order_id ='') order by product_id";
        $result = resultAssociate($query);
        // print_r($result);
        return $result;
    }

    #14dec2015
    #function for order product detail

    function order_product_detail($order_id, $user_id) {
        //$query = "SELECT id,sku,simquantity,item_code,item_image,extra_price, ((price*quantity)+extra_price) as cart_price ,price,tag_title,customization_id,customization_data,measurement_id,
        //                   measurement_data,customization_data_price FROM `nfw_product_cart`  where order_id = $order_id and user_id = $user_id";
        //echo $query;

        $query = "SELECT id,sku, item_code,item_image,
                  sum(quantity) as quantity,
                  sum(extra_price) as extra_price, 
                  sum((price*quantity)+extra_price) as cart_price ,
                  price,
                  tag_title, customization_id,customization_data,measurement_id, measurement_data,customization_data_price FROM `nfw_product_cart` 
                   where order_id = $order_id and user_id = $user_id
                  group by product_id, customization_id, measurement_id";

        $result = resultAssociate($query);
        // print_r($result);
        return $result;
    }

    #16-dec-2015

    function wallet_amount($user_id) {
        $query = "SELECT (sum(credit_amt)- sum(debit_amt)) as result  FROM `nfw_wallet` where user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

    function wallet_price_calc($wallet_amnt, $price) {
        $wm = explode('$', $wallet_amnt)[1];
        $tp = $price;
        $res = $tp - $wm;
        return $res;
    }

    #17dec2015

    function user_wallet_detail($user_id) {
        $query = "SELECT * FROM `nfw_wallet` where user_id = $user_id order by id desc ";
        $result = resultAssociate($query);
        return $result;
    }

}

function convert_number($number) {
    if (($number < 0) || ($number > 999999999)) {
        throw new Exception("Number is out of range");
    }

    $Gn = floor($number / 1000000);  /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */

    $res = "";

    if ($Gn) {
        $res .= convert_number($Gn) . " Million";
    }

    if ($kn) {
        $res .= (empty($res) ? "" : " ") .
                convert_number($kn) . " Thousand";
    }

    if ($Hn) {
        $res .= (empty($res) ? "" : " ") .
                convert_number($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");

    if ($Dn || $n) {
        if (!empty($res)) {
            $res .= " & ";
        }

        if ($Dn < 2) {
            $res .= $ones[$Dn * 10 + $n];
        } else {
            $res .= $tens[$Dn];

            if ($n) {
                $res .= " " . $ones[$n];
            }
        }
    }

    if (empty($res)) {
        $res = "zero";
    }

    return $res;
}

function priceConvert($price) {
//    $price = '12345634.23';
    $pricearray = explode('.', $price);
    $toword = ' USD ';
    $t1 = $pricearray[0];

    $usd = convert_number($t1);
    $toword .= $usd;
    if (count($pricearray) > 1) {
        $t2 = $pricearray[1];
        if ($t2 * 1) {
            $cnt = convert_number($t2);
            $toword .=' & Cents ' . $cnt;
        }
    }
    return $toword;
}

# 20-oct-2015
# function for sweet alert

function sweet_alert($val, $condition, $title, $text, $type) {
    //print_r($val, $condition, $title, $text, $type);
    ?>
    <script>
        $(function () {
    <?php if ($val == $condition) { ?>
                swal({title: "<?php echo $title; ?>", text: "<?php echo $text; ?>", type: "<?php echo $type; ?>"});
    <?php } ?>
        });
    </script>
<?php } ?>
