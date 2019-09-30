<?php

session_start();
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';
$authobj = new AuthHandler();
$prdobj = new CartHandler(); 
if (isset($_REQUEST['notification'])) {
    $ids = $_REQUEST['notification'];
//    $page = $_REQUEST['page_link']; 
//    echo "<html>asdfsaf </html>";
    mysql_query("update nfw_notification_user set status = 1 where id = $ids ");
//    header('location:"' . $page . '"');
}
if (isset($_REQUEST['checkCart'])) {
    $productList = $prdobj->cartProducts(true, $_REQUEST['user_id'], $_REQUEST['checkCart']);
    echo json_encode($productList);
}


if (isset($_REQUEST['product_id'])) {
    $productId = $_GET['product_id'];
    $prdobj->addProductToCart($productId, 1, $_REQUEST['user_id'], $_REQUEST['action'], $_REQUEST['itemType']);
}




if (isset($_REQUEST['productId'])) {
    $productId = $_REQUEST['productId'];
    $prdobj->deleteProductCart($productId, $_REQUEST['tag_id'], $_REQUEST['user_id'], $_REQUEST['table']);
}
if (isset($_REQUEST['product_list'])) {
    $productListArray = [];
    $catobj = new CategoryHandler();
    $productList = $catobj->productList();

    for ($i = 0; $i <= count($productList); $i++) {
        $productId = $productList[$i]['id'];

        $prdObj = new ProductHandler($productId);
        $productItem = $prdObj->productInformation();
        $productTemp = array();
        $productImage = $prdObj->productImage();
        $productTemp['image1'] = $productImage['dualImages'][0]['image'];
        $productTemp['image2'] = $productImage['dualImages'][1]['image'];
        $productTemp['id'] = $productItem['id'];
        $productTemp['price'] = $productItem['price'];
        $productTemp['category'] = $productItem['category_title'];
        $productTemp['short_decription'] = $productItem['short_decription'];
        $productTemp['title'] = $productItem['title'];
        array_push($productListArray, $productTemp);
    }
    echo json_encode($productListArray);
}

if (isset($_REQUEST['product_style'])) {
//echo $_REQUEST['user_id'];
    foreach ($_REQUEST['product_style'] as $key => $value) {
        $id = explode("_", $key);
        mysql_query("INSERT INTO `nfw_pant_customize_profile`(`body_fit`, `number_of_pleat`, `waistband`, `suspender_button_on_inner_waistband`, `cuff`, `zipper_front_fly_zipper`, `front_pocket_style`, `number_of_back_pocket`,`user_id`)  VALUES ('" . $value['Body Fit'] . "' , '" . $value['Number of Pleat'] . "' , '" . $value['Waistband'] . "' , '" . $value['Suspender Buttons on Inner waistband'] . "' , '" . $value['Cuff'] . "' , '" . $value['Zipper - Front Fly Zipper'] . "' , '" . $value['Front Pocket Style'] . "' , '" . $value['Number of Back Pocket'] . "','" . $_REQUEST['user_id'] . "')");
        $new_id = mysql_insert_id();
        mysql_query("INSERT INTO `nfw_pant_customize_profile_cart`( `pant_customize_profile_id`, `product_cart_id`,`user_id`) VALUES ($new_id,$id[1],'" . $_REQUEST['user_id'] . "')");
        $customize_id = mysql_insert_id();
        mysql_query("update nfw_product_cart set customize_table='nfw_pant_customize_profile' , customization_id='$customize_id' where id=$id[1]");
//echo "update nfw_product_cart set customize_table='nfw_pant_customize_profile' , customization_id='$customize_id' where id=$id[1]"; 
    }
}

#25-Aug-2015
if (isset($_REQUEST['bill_ship'])) {
// echo json_encode($_REQUEST);
    $authobj->ChangeBillShip($_REQUEST['bill_id'], $_REQUEST['ship_id']);
}

#31-Aug-2015
if (isset($_REQUEST['addressupdation'])) {
    $address = $authobj->findAddressUsingId($_REQUEST['ids']);
    echo json_encode($address);
}
#18-sep-2015



if (isset($_REQUEST['customDataInsert'])) {
    $data = $_REQUEST['customDataInsert'];
    $data_price = $_REQUEST['customDataInsertPrice'];
    $user_ids = $_REQUEST['user_id'];
    $heading_mapping = $_REQUEST['header_mapping'];
    $table_name = $_REQUEST['custom_form'];
    $mes_data = $_REQUEST['measurement'];
    $tag_id = $_REQUEST['tag_id'];
    $posture = $_REQUEST['posture'];
    $user_images = $_REQUEST['user_images'];
    $crt_datetime = date('Y-m-d H:i:s');
    $checkshop_data = $_REQUEST['shop_data'];

    $checkshop_data_mes = $_REQUEST['shop_data_mes'];



    if (isset($mes_data['profile_id'])) {
        $measurement_id = $mes_data['profile_id'];
    } else {
        $measurement_data = json_encode($mes_data);

        $posture_data = json_encode($posture);
        $user_images = json_encode($user_images);
        $premesdataquery = "select id from nfw_measurement_data where measurement_data  = '$measurement_data' and user_id = '$user_ids' and tag_id='$tag_id' and posture_data = '$posture_data'";
        $premesdata = resultAssociate($premesdataquery);


        if ($premesdata) {
            $measurement_id = end($premesdata);
            $measurement_id = $measurement_id['id'];
        } else {
            $measurement_profile = $mes_data['Profile'];
            $tq = "insert into nfw_measurement_data (user_id, tag_id, measurement_profile,measurement_data, posture_data, user_images, datetime) values('$user_ids','$tag_id','$measurement_profile','$measurement_data', '$posture_data', '$user_images', '$crt_datetime')";

            mysql_query($tq);
            $measurement_id = mysql_insert_id();
        }
    }

#################################################################
##########insert custom form data into from table

    foreach ($data as $key => $value) {
        $cart_id = $value['cart_id'];
        $ids = $cart_id;
        $price_array = $data_price[$key];
        $total_price = 0;
        $custom_form_data_price_total = $value['total_price'];
        
        
        $custom_form_data_price = json_encode($value['custom_data_price']);
        $custom_form_data = json_encode($value['custom_data']);
     

        if ($checkshop_data == '1') {
            $custom_profile = "Shop Stored";
            $customformdata = $custom_form_data;
            $customformdataprice = $custom_form_data_price;
            $extraprice = 0;
        } else {
            if (isset($value['style_id']) & $value['style_id']) {
                $last_id_custom = $value['style_id'];
                $predata = "select ncfdp.total_price, ncfdp.nfw_custom_form_data_id from nfw_custom_form_data_price as ncfdp"
                        . " join nfw_custom_form_data as ncfd on ncfd.id = ncfdp.nfw_custom_form_data_id "
                        . " where ncfd.style_profile = '$last_id_custom' ";
                $price_data = resultAssociate($predata);
                $total_price = $price_data[0]['total_price'];
                $last_id_custom = $price_data[0]['nfw_custom_form_data_id'];
            } else {
                $predata = "select id from nfw_custom_form_data where custom_form_data = '$custom_form_data' and user_id = '$user_ids' and tag_id='$tag_id'";
                $pre_custom_data = resultAssociate($predata);
                if ($pre_custom_data) {
                    $last_custom = end($pre_custom_data);
                    $last_id_custom = $last_custom['id'];
                } else {

                    $tq = "insert into nfw_custom_form_data (user_id, tag_id, custom_form_data, datetime) values('$user_ids','$tag_id','$custom_form_data', '$crt_datetime')";
                    mysql_query($tq);
                    $last_id_custom = mysql_insert_id();
                }
                $values_price = array();
               
                $total_price = $custom_form_data_price_total;
                $update_price_query = "update nfw_custom_form_data_price set total_price = '$total_price', custom_form_data_price = '$custom_form_data_price' where nfw_custom_form_data_id = '$last_id_custom'";
                mysql_query($update_price_query);
            }
            $customdataquery = "SELECT cd.style_profile, cdp.custom_form_data_price, cd.custom_form_data, cdp.total_price
        FROM nfw_custom_form_data_price as cdp
        join nfw_custom_form_data as cd on cdp.nfw_custom_form_data_id = cd.id
        where cd.id = $last_id_custom";
            $customarray = resultAssociate($customdataquery);
            $customarray = end($customarray);
            $customformdata = $customarray['custom_form_data'];
            $customformdataprice = $customarray['custom_form_data_price'];
            $custom_profile = $customarray['style_profile'];
            $extraprice = $customarray['total_price'];
        }


        if ($checkshop_data_mes == '1') {

            $measurement_profile = 'Shop Stored';
            $measurement = $measurement_data;
            $posturedata = $posture_data;
            $userimages = $user_images;
        } else {
            $measurementquery = "select * from nfw_measurement_data where id = $measurement_id";
            $measurementdata = resultAssociate($measurementquery);
            $measurementdata = end($measurementdata);
            $measurement_profile = $measurementdata['measurement_profile'];
            $measurement = $measurementdata['measurement_data'];
            $posturedata = $measurementdata['posture_data'];
            $userimages = $measurementdata['user_images'];
        }

         $update_cart = "update nfw_product_cart set customization_id = '$custom_profile', customization_data_price = '$customformdataprice' , 
                       customization_data = '$customformdata' , measurement_id = '$measurement_profile', extra_price = '$extraprice', 
                       measurement_data = '$measurement', posture_data = '$posturedata', user_images = '$userimages' where id = $ids ";

        mysql_query($update_cart);
    }
###### end of insertion of custom form data
}

if (isset($_REQUEST['all_measurement'])) {

    $user_ids = $_REQUEST['user_id'];
}
#19-sep-2015
if (isset($_REQUEST['style_id'])) {
    $result = $authobj->styleDetail($_REQUEST['style_id'], $_REQUEST['tag_id'], $_REQUEST['user_id']);
    echo json_encode($result);
}
#24-sep-2015
#update 15-oct-2015
if (isset($_REQUEST['extraPrice'])) {
    $result = $authobj->extraPriceDetail($_REQUEST['extraPrice']);
//echo $result;
    echo json_encode($result);
}
if (isset($_REQUEST['measurement_id'])) {
    $result = $authobj->userMeasurmentDetail($_REQUEST['measurement_id'], $_REQUEST['tag_id'], $_REQUEST['user_id']);
    echo json_encode($result);
}
#05-oct-2015
if (isset($_REQUEST['productsIDS'])) {
    if (($_SESSION['cart'])) {
        
    } else {
        $_SESSION['cart'] = array();
    }
    $check = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($_REQUEST['productsIDS'] == $value[0]) {
            if ($_REQUEST['itemType'] == $value[1]) {
                $_SESSION['cart'][$key][3] = $_SESSION['cart'][$key][3] + 1;
                $check = 1;
            }
        } else {
            
        }
    }
    if ($check == 1) {
        
    } else {
        if ($_REQUEST['itemType']) {
            $_SESSION['product'] = array($_REQUEST['productsIDS'], $_REQUEST['itemType'], $_REQUEST['item_price'], $_REQUEST['quantity'], date('Y-d-m H:i:s'));
//print_r($_SESSION['product']);
            array_push($_SESSION['cart'], $_SESSION['product']);
        } else {
            $product_id = $_REQUEST['productsIDS'];
            $tag_query = "SELECT tag_id FROM nfw_product_tag_connection where product_id = '$product_id'";
            $tdata = resultAssociate($tag_query);
            foreach ($tdata as $key => $value) {
                $tag_id_r = $value['tag_id'];
                $_SESSION['product'] = array($_REQUEST['productsIDS'], $tag_id_r, $_REQUEST['item_price'], $_REQUEST['quantity'], date('Y-d-m H:i:s'));
//print_r($_SESSION['product']);
                array_push($_SESSION['cart'], $_SESSION['product']);
            }
        }
    }
//    if(in_array($_REQUEST['productsIDS'],$_SESSION['cart']['product'][0])){
//        echo "in";
//    }
//    else{
//    $_SESSION['product'] = array($_REQUEST['productsIDS'], $_REQUEST['itemType'], $_REQUEST['item_price'], $_REQUEST['quantity']);
//        echo 'out';
//    }
}
if (isset($_REQUEST['session_id'])) {

    $productListArray = [];
    $catobj = new CategoryHandler();
    $productList = $_SESSION['cart'];
//print_r($_SESSION['cart']);
    for ($i = 0; $i < count($productList); $i++) {
        $productId = $productList[$i][0];
        $productTagId = $productList[$i][1];
        $prdObj = new ProductHandler($productId, $productTagId);
        $productInfo = $prdObj->productInformation();
        $profileImage = $prdObj->productImage();
        $productInfo['image'] = $profileImage['profileImage'] ? $profileImage['profileImage'] : '../assets/images/img1.png';
        $productInfo['quantity'] = $productList[$i][3];
        $productInfo['tag_id'] = $productTagId;
        $productInfo['cart_product_id'] = $listProduct[$i]['id'];

        $productInfo['cart_price'] = ($productInfo['price'] * $productInfo['quantity'] ) + $listProduct[$i]['extra_price'];

        array_push($productListArray, $productInfo);
    }

    echo json_encode($productListArray);


//print_r($_SESSION['cart']);
}
if (isset($_REQUEST['productSessionId'])) {
//  session_destroy();
    $removeableId = $_REQUEST['productSessionId'];
    $removeableId = explode("__", $removeableId);
    $productrid = $removeableId[0];
    $tagrid = $removeableId[1];
    $data = $_SESSION['cart'];
    $remove_data = array();
    foreach ($data as $key => $value) {
        $product_id = $value[0];
        $tag_id = $value[1];
        if (($product_id == $productrid) && ($tag_id == $tagrid)) {
            array_push($remove_data, $key);
        }
    }
    foreach ($remove_data as $key => $value) {
        unset($_SESSION['cart'][$value]);
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}
#5-Nov-2015
if (isset($_REQUEST['cardupdation'])) {
    $address = $authobj->select_card_info($_REQUEST['ids'], $_REQUEST['user_id']);
    echo json_encode($address);
}
#26-nov-2014
if (isset($_REQUEST['updatedData'])) {

    $custom_data = $_REQUEST['updatedData'];

    $id = $_REQUEST['style_id'];
//print_r($custom_data);
    $test = array();
    $total = 0;
    foreach ($custom_data as $key => $value) {

        $pos = strpos($value, 'Extra');
        if ($pos == TRUE) {
            $data = explode('$', $value);
            $data = $data[1];
            $data1 = explode('Extra', $data);
            $data1 = $data1[0];
            $total += $data1;
            $test[$key] = $data1;
        } else {
            $test[$key] = "";
        }
    }
    $custom_form_data = json_encode($custom_data);
    $custom_form_data_price = json_encode($test);
    // print_r($custom_form_data_price);
    $crtdatetime = date('Y-m-d H:i:s');
    $query = "update nfw_custom_form_data set custom_form_data = '$custom_form_data', update_datetime = '$crtdatetime' where id = $id  ";
    mysql_query($query);
    $query = "update nfw_custom_form_data_price set custom_form_data_price = '$custom_form_data_price', total_price = '$total'  where nfw_custom_form_data_id = $id ";
    mysql_query($query);
}
#28-nov-2015
if (isset($_REQUEST['keys'])) {
    $dict = $_REQUEST['keys'];
    $meas_data = json_encode($dict);
    $postar_data = json_encode($_REQUEST['postdata']);
    $mes_id = $_REQUEST['mes_id']; 
    $crtdatetime = date('Y-m-d H:i:s');
    $query = "update nfw_measurement_data set measurement_data = '$meas_data',posture_data ='$postar_data' , update_datetime = '$crtdatetime' where id = $mes_id ";
    //echo $query;    
    mysql_query($query);
}

if (isset($_REQUEST['getproductlistpage'])) {
//    error_reporting(E_ALL & ~E_NOTICE );
//     ini_set('display_errors', 1);
    $catobj = new CategoryHandler();
    $productList = $catobj->productList();
    echo json_encode($productList);
}


if (isset($_REQUEST['getproductlistpage_v2'])) {
//    error_reporting(E_ALL & ~E_NOTICE );
//     ini_set('display_errors', 1);
    $catobj = new CategoryHandler();
    $productList = $catobj->productListV3();
    echo json_encode($productList);
}

if (isset($_REQUEST['getproductlistpage_v1'])) {
//   error_reporting(E_ALL); ini_set('display_errors', 1); 
    $catobj = new CategoryHandler();
    $productList = $catobj->productListV2();
    $productFinal = array();
   echo $productjson =  json_encode($productList); 
}
//    echo json_encode($productList);
//    $categoryList = array();
//
//    foreach ($productList as $key => $value) {
//        //print_r($value['category_id']);
//        if (isset($categoryList[$value['category_id']])) {
//            
//        } else {
//            $categoryList[$value['category_id']] = $value['category_id'];
//        }
//    }
//// 
//
//    foreach ($categoryList as $key => $value) {
//        //echo '<br/>', $value, '----';
//      //  $categorylist = array(); 
//        
////       echo $parents = get_parent($value);
//       
//      //  echo "<br/>===";
//        //print_r($parents);
//    }
//}

if (isset($_REQUEST['search_text'])) {
    echo $search_text = $_REQUEST['search_text'];
    $index = 1;
    $search_query = "select search_index from nfw_searching where search_text = '$search_text'";
    $search_data = resultAssociate($search_query);

    if (count($search_data)) {
        $index = end($search_data);
        $index = $index['search_index'] + 1;
        echo $query = "update nfw_searching set search_index = $index where search_text = '$search_text'";
        resultAssociate($query);
    } else {
        $query = "insert into nfw_searching(search_text, search_index) value('$search_text', $index)";
        resultAssociate($query);
    }
}



if (isset($_REQUEST['news_letters_subscribe'])) {
    $userid = $_SESSION['user_id'];
    $feq = $_REQUEST['frequency'];
    $subscribe = json_decode($_REQUEST['subscribe']);


    $queryf = "select frequency from nfw_news_letters_frequency where user_id = " . $userid;
    $data = resultAssociate($queryf);
    if (count($data)) {
        $uquery = "update nfw_news_letters_frequency set frequency = '$feq' where user_id=" . $userid;
        $dquery = "delete from nfw_news_letters_unsubscribe where user_id=$userid";
        resultAssociate($dquery);
    } else {

        $ddquery = "select * from nfw_news_letters_unsubscribe where user_id=$userid";
        $dddata = resultAssociate($ddquery);
        if (count($dddata)) {
            
        } else {
            
        }
    }
    if ($feq) {
        $dquery = "delete from nfw_news_letters_unsubscribe where user_id=$userid";
        resultAssociate($dquery);
        $uquery = "insert into nfw_news_letters_frequency(user_id, frequency) values($userid, '$feq')";
        resultAssociate($uquery);
    }
    echo json_encode($data);



//         $uquery = "delete from nfw_news_letters_frequency where user_id=" . $userid;
//         resultAssociate($uquery);
//         echo json_encode([]);
}


if (isset($_REQUEST['news_letters_unsubscribe'])) {
    $userid = $_SESSION['user_id'];



    $uquery = "delete from nfw_news_letters_frequency where user_id=" . $userid;
    resultAssociate($uquery);

    $uquery = "select * from auth_user where id = " . $userid;
    $userdata = end(resultAssociate($uquery));

    $emailau = $userdata['email'];
    $dquery = "insert into nfw_news_letters_unsubscribe(user_id, email_id) values($userid, '$emailau')";
    resultAssociate($dquery);

    echo json_encode([]);
}
?>