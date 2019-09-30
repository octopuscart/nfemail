<?php

include 'curdHandler.php';

class AddressHandler extends CURDHandler {

    function billing_shipping_addres($postvar) {

        $billingArray = array();
        $billingId = 0;
        $shippingId = 0;
        if (isset($postvar['orderConfirm'])) {
            $fquery = mysql_query("DESCRIBE  nfw_user_billing_information");
            if ($fquery === FALSE) {
                die(mysql_error()); // TODO: better error handling
            }
            while ($row = mysql_fetch_array($fquery)) {
                $billingArray[$row['Field']] = $postvar[$row['Field']];
            }
            unset($billingArray['id']);

            $billingArray['user_id'] = $_SESSION['user_id'];
            $billingId = $this->insertUpdate('nfw_user_billing_information', $billingArray);
            if ($postvar['shipping_add']) {
                $shipping = array();
                $fquery = mysql_query("DESCRIBE  nfw_user_shipping_information");
                while ($row = mysql_fetch_array($fquery)) {
                    $shipping[$row['Field']] = $postvar[$row['Field']];
                }
                unset($shipping['id']);
                $shipping['user_id'] = $_SESSION['user_id'];
                $shippingId = $this->insertUpdate('nfw_user_shipping_information', $shipping);
            } else {
                $shipping['user_id'] = $_SESSION['user_id'];
                $query = "insert into nfw_user_shipping_information (`user_id`, `s_first_name`, `s_last_name`, `s_company_name`, `s_address1`, `s_address2`, `s_city`, `s_zip`, `s_country`, `s_email_id`, `s_mobile_no`)
                         values('" . $shipping['user_id'] . "','" . $billingArray['first_name'] . "','" . $billingArray['last_name'] . "','" . $billingArray['company_name'] . "','" . $billingArray['address1'] . "','" . $billingArray['address2'] . "','" . $billingArray['city'] . "','" . $billingArray['zip'] . "','" . $billingArray['country'] . "','" . $billingArray['email_id'] . "','" . $billingArray['mobile_no'] . "')";
                mysql_query($query);
                $shippingId = mysql_insert_id();
            }
//            $customerId = $this->insertUpdate('customer_information', $fieldValueArray);
        }
        return [$shippingId, $billingId];
    }

    function billing_shipping_information() {
        $user_id = $_SESSION['user_id'];
        $query1 = "select * from nfw_user_billing_information where user_id = $user_id";
        $result = mysql_query($query1);
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $data['billing'][] = $row;
            }
        }
        $query2 = "select * from nfw_user_shipping_information where user_id = $user_id";
        $result = mysql_query($query2);
        if ($result) {
            while ($row1 = mysql_fetch_assoc($result)) {
                $data['shipping'][] = $row1;
            }
        }
        return $data;
    }

    function billing_shipping_last_information() {
        $user_id = $_SESSION['user_id'];
        $query1 = "select id from nfw_user_billing_information where user_id = $user_id order by id desc limit 0,1";
        $result = mysql_query($query1);
        $data = array();
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $data['billing'] = $row;
            }
        }
        $query2 = "select id from nfw_user_shipping_information where user_id = $user_id order by id desc limit 0,1";
        $result = mysql_query($query2);
        if ($result) {
            while ($row1 = mysql_fetch_assoc($result)) {
                $data['shipping'] = $row1;
            }
        }
        return $data;
    }

}

?>