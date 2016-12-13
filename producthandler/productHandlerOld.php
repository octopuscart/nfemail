<?php

class ProductHandler {

    public function __construct($product_id, $tag_id) {
        $this->productId = $product_id;
        $this->tag_id = $tag_id;
        // echo    $this->productId;
    }

    function productInformation() {

        $query = "SELECT ntc.price as price, nfp . * , nfc.name AS category_title,nc.color_code,(select npt.tag_title from nfw_product_tag as npt where npt.id= ntc.tag_id) as tag_name FROM nfw_product AS nfp
            JOIN nfw_category AS nfc ON nfc.id = nfp.product_category
            left join nfw_color as nc on nfp.color = nc.id
            join nfw_product_tag_connection as ntc on ntc.product_id = nfp.id
            WHERE nfp.id =  '$this->productId' and ntc.tag_id = '$this->tag_id'";

        $productDetail = resultAssociate($query);
        //print_r($productDetail);
        return $productDetail[0];
    }

    #26-sep-2015 Update function - comment query will use

    function productImage() {
        $query = "select concat('http://costcointernational.com/nfw/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = '$this->productId' order by display_priority desc";
//        $query = "select image as image 
//                  from nfw_product_images 
//                  where nfw_product_id = '$this->productId' order by display_priority desc";
        $allImages = resultAssociate($query);
        $profileImage = $allImages[0]['image'];
        $profileDuleImage = array_slice($allImages, 0, 2);
        return array(
            'allImages' => $allImages,
            'profileImage' => $profileImage,
            'dualImages' => $profileDuleImage
        );
    }

    function relatedProductId() {
        $related_product_query = " select nfw_related_product_id as nfw_product_id from nfw_product_related where nfw_product_id = $this->productId ";
        $related_product_list = resultAssociate($related_product_query);
        return $related_product_list;
    }

    function productTag($productID) {
        $query = "SELECT ng.tag_title FROM `nfw_product_tag_connection` as nptc join nfw_product_tag as ng on nptc.tag_id = ng.id
                    where nptc.product_id = $productID ";
        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function productTitle() {

        $query = "SELECT nfw_product.title FROM `nfw_product_cart` join nfw_product on nfw_product_cart.product_id = nfw_product.id
                            where nfw_product_cart.id = '$this->productId' ";
        $result = resultAssociate($query);
        return $result;
    }

}

############# Class For Category ###############################################

class CategoryHandler {

    function featuredProductList() {
        $query = "SELECT nfw_product_id FROM nfw_product_featured ";
        //echo $query;
        return resultAssociate($query);
    }

    #24-sep-2015
    #for find product tag of feature products

    function featurProductTag($product_id) {
        $query = "SELECT pt.tag_title,ptc.price,ptc.tag_id,ptc.product_id FROM `nfw_product_tag_connection` as ptc 
                 join nfw_product_tag as pt on ptc.tag_id = pt.id
                 join nfw_product_featured as pf on ptc.product_id = pf.nfw_product_id
                 where ptc.product_id = $product_id limit 0,1";

        return resultAssociate($query);
    }

    #28-sep-2015
    #for find related products with tag

    function relatedProductTag($product_id) {

        $query = "SELECT pt.tag_title,ptc.price,ptc.tag_id,ptc.product_id FROM `nfw_product_tag_connection` as ptc 
                 join nfw_product_tag as pt on ptc.tag_id = pt.id
                 join nfw_product_related as pf on ptc.product_id = pf.nfw_related_product_id
                 where ptc.product_id = $product_id limit 0,1";

        return resultAssociate($query);
    }

    #for short detail of tagging

    function productTagDetail($product_id) {
        $query = "SELECT ptc.price,pt.tag_title, ptc.tag_id as tag_id FROM `nfw_product_tag_connection` as ptc 
                        join nfw_product_tag as pt on ptc.tag_id = pt.id
                        where ptc.product_id = $product_id ";
        return resultAssociate($query);
    }

    #short detail of product

    function shortProductDetail($product_id) {
        $query = "SELECT title,sku,short_description FROM `nfw_product` where id = $product_id ";
        return resultAssociate($query);
    }

    #29-sep-2015
    #product color

    function productColor($product_id) {
        $query = "SELECT title FROM `nfw_color` where id = $product_id ";
        return resultAssociate($query);
    }

    function productCategory($product_id) {
        $query = "SELECT product_category FROM `nfw_product` where id = $product_id ";
        return resultAssociate($query);
    }

    #for find tag name

    function productTag($id) {
        $query = "SELECT tag_title FROM `nfw_product_tag` where id = $id ";
        return resultAssociate($query);
    }

    ####################################

    function parents($parentId) {
        $query = "select id from nfw_category where parent = $parentId";
        $res = resultAssociate($query);
        for ($i = 0; $i < count($res); $i++) {
            $id = $res[$i]['id'];
            global $arrayChild;
            array_push($arrayChild, $id);
            parents($res[$i]['id']);
        }
        return $arrayChild;
    }

    // Function for pagination
    function paginate($query_data) {
        $mainArray = [];
        for ($i = 0; $i < count($query_data); $i++) {
            $mainArray[] = $query_data[$i]['id'];
        }
//        if (isset($_REQUEST['page_no'])) {
//            $pageno = $_REQUEST['page_no'];
//        } else {
//            $pageno = 1;
//        };
//        if (isset($_REQUEST['$recor_per_page'])) {
//            $recor_per_page = $_REQUEST['$recor_per_page'];
//        } else {
//            $recor_per_page = 12;
//        };
//
//        $from_data = (($pageno - 1) * $recor_per_page) + 1;
//        $sliceArray[] = array_slice($mainArray, $from_data - 1, $recor_per_page);
//        $sliceArray = $sliceArray[0];
//        $num = count($mainArray);
//        $page_pagination = $num / $recor_per_page;
//       
//        
//        if (is_float($page_pagination)) {
//            $page_pagination = intval($page_pagination) + 1;
//            //print_r($page_pagination);
//        }
//        //echo $page_pagination;
//        $l1 = 0;
//        if ($pageno > 2) {
//            if ($page_pagination > 3) {
//                $l1 = $pageno - 2;
//            }
//        }
//        if ($page_pagination > 3) {
//            if ($pageno == $page_pagination) {
//                $l1 = $pageno - 3;
//            }
//        }
//        if ($pageno > $page_pagination) {
//            $l2 = $page_pagination;
//            $l1 = $pageno - 4;
//        } else {
//            if ($l1 < 1 && $page_pagination > 2) {
//                $l2 = 3;
//            } else {
//                $l2 = $page_pagination;
//            }
//        }
//
//        $pageArray = [];
//        /// echo $l1.">>".$l2;
//        for ($i = $l1; $i <= $l2; $i++) {
//            //echo $i;
//            //if ($l2)
//            $pageArray[] = $i;
//        }
////print_r($pageArray);
//        $productRange = $from_data . '-' . (count($sliceArray) + $from_data - 1);
        //return array($sliceArray, $pageArray, $mainArray, $productRange,$page_pagination);
        // print_r($mainArray);
        return array($mainArray);
    }

    function productList() {

        $colorjoin = " left join nfw_color as nc on np.color = nc.id  join nfw_product_tag_connection as ntc on ntc.product_id = np.id";
        $query = "";

        $imageq = " IFNULL(
            (select concat('http://costcointernational.com/nfw/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = np.id order by display_priority desc limit 0, 1),
                   '../assets/images/img2.png'
              )    
              as image1, 
                  
                 IFNULL(
                 (select concat('http://costcointernational.com/nfw/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = np.id order by display_priority desc limit 1, 1),
                  '../assets/images/img2.png'
                       ) as image2
                ";

        $preselectq = "SELECT np.id, nc.color_code, np.color, np.title, np.product_speciality, ntc.price, $imageq ";

        $category_id = $_REQUEST['category'];
        $sorting = $_REQUEST['sorting'];
        $fromprice = $_REQUEST['from_price'];
        $aa = explode('$', $fromprice);
        $toprice = $_REQUEST['to_price'];
        $bb = explode('$', $toprice);
        $color_id = $_REQUEST['color'];
        $item_type = $_REQUEST['item_type'];
        //$dataId = $category_id;
        $arrayChild = [];
        $dataId = $this->parents($category_id);
        $dataId[] = $category_id;
        $query_data = array();
        $categoryString = implode(',', $dataId);
        $limitquery = " ";
        if (count($dataId)) {
            $category = "where np.product_category in (" . $categoryString . ") and ntc.tag_id = $item_type";

            if (isset($fromprice)) {
                $price = "and ntc.price between '" . $aa[1] . "' and '" . $bb[1] . "'";
            } else {
                $price = '';
            }
            if (isset($color_id)) {
                $color = "and np.color='" . $color_id . "'";
            } else {
                $color = '';
            }

            if (isset($_REQUEST['paginate'])) {
                $pg = $_REQUEST['paginate'];
                $pg1 = $pg[0] - 1;
                $pg2 = $pg[1];
                $limitquery = " limit $pg1, 12";
            }




            $prequery = "";
            if (isset($sorting)) {

                switch ($sorting) {
                    case 'Price-Desc':
                        $sort = " order by ntc.price desc";
                        break;
                    case 'Price-Asc':
                        $sort = " order by ntc.price asc";
                        break;
                    case 'Most Popular':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_most_populat_product`) union ";
                        $prequery = "$preselectq FROM  nfw_product as np $colorjoin   $category $price $color $sortt";
                        break;
                    case 'On Sale':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_on_sale`) union ";
                        $prequery = "$preselectq FROM  nfw_product as np $colorjoin   $category $price $color $sortt";

                        break;
                    case 'New Arrival':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_new_arrival`) union ";
                        $prequery = "$preselectq FROM  nfw_product as np $colorjoin   $category $price $color $sortt";

                        break;
                    case 'Sale/Most Popular':
                        $sortt1 = " and np.id in (SELECT product_id FROM `nfw_on_sale`) union ";
                        $sortt2 = " and np.id in (SELECT product_id FROM `nfw_most_populat_product`) union ";
                        $prequery = "$preselectq FROM  nfw_product as np $colorjoin   $category $price $color $sortt1";
                        $prequery .= "$preselectq FROM  nfw_product as np $colorjoin  $category $price $color $sortt2";


                        break;


                    default:
                        $sort = '';
                }
            } else {
                $sort = '';
            }


            $query = $prequery . "$preselectq FROM  nfw_product as np $colorjoin  $category $price $color $sort $limitquery";
        }
        //print_r($query_data);
        $result = resultAssociate($query);
        return ($result);
    }

    function get_parent($id) {

        function get_parentReq($id) {
            $query = mysql_query("select * from nfw_category where id= $id ");
            $test = $id;
            while ($row = mysql_fetch_array($query)) {
                $cat = get_parentReq($row['parent']);
                $test = $cat . "," . $test;
            }
            return $test;
        }

        $test = get_parentReq($id);

        return $test;
    }

    #update function 23-sep-2015

    function productSubCategory($id, $item_type) {

        $query = "SELECT id,name FROM `nfw_category` where parent = $id  order by index_menu ";
//          //  echo $query;
        $res = resultAssociate($query);
//        if ($item_type == 1) {
//            $query = "SELECT id,name FROM `nfw_category` where parent = '0' and id <= 33";
//            //  echo $query;
//            $res = resultAssociate($query);
//        }
//        if ($item_type == 2 || $item_type == 5 || $item_type == 7 || $item_type == 12) {
//            $query = "SELECT id,name FROM `nfw_category` where parent = $id and id >= 68";
//            $res = resultAssociate($query);
//        }

        return $res;
    }

    #23-sep-2015
    #for get parent

    function get_parent1($id) {

        $query = mysql_query("select  * from nfw_category where id = $id ");
        $test = $id;
        while ($row = mysql_fetch_array($query)) {
            $cat = $this->get_parent1($row['parent']);
            $test = $cat . "," . $test;
        }
        return $test;
    }

    function productCategoryName($cat, $item_type) {
        $query = "select np.product_category FROM `nfw_product` as np join 
                       nfw_product_tag_connection as npc on np.id = npc.product_id
                       where npc.tag_id = $item_type group by np.product_category";
        //echo $query;
        $res1 = resultAssociate($query);
        //print_r($res1);
        for ($i = 0; $i < count($res1); $i++) {

            $id = $res1[$i]['product_category'];
            //print $id;
            $res = $this->get_parent1($id);

            $array = explode(',', $res);
            $cat_ids = $array[1];
            //print_r($cat_ids);
            $query = "SELECT name, id FROM `nfw_category` where id = $cat_ids and parent = $cat group by id ";
            $tempData[] = resultAssociate($query);
            //print_r($tempData);
        }
        // print_r($tempData);
//         for ($i = 0; $i < count($tempData); $i++) {
//                                $temp = $tempData[$i];
//                                $name[];
//                                if($temp[0]['name'] in $name){
//                                  };
//                                $ids = $temp[0]['id'];
//                                
//                                
//            }

        return $tempData;
    }

}

############# Class For Cart ###############################################

class CartHandler {

    function addProductToCart($product_id, $quantity, $user_id, $tableName, $tag_id) {
        $dat = date('Y-m-d ');
        $tm = date('H:i:s');
        if ($tableName === "Wishlist") {
            $table = 'nfw_product_wishlist';
        }
        if ($tableName === "Cart") {
            $table = 'nfw_product_cart';
        }
        $query = "insert into $table (product_id,user_id,op_date,op_time,quantity, tag_id) values('$product_id','$user_id','$dat','$tm','$quantity', '$tag_id')";
        mysql_query($query);
    }

    function cartProductsCount($user_id, $customize) {
        $query = "SELECT sum(quantity) as quantity FROM  nfw_product_cart where user_id = $user_id $customize and order_id IS NULL";
        return resultAssociate($query);
    }

    function cartProducts($isJson, $user_id, $tableName) {
        $query = "SELECT tt.id, tt.product_id, sum(tt.quantity) as quantity, sum(tt.extra_price) as extra_price,tt.tag_id FROM 
                 $tableName as tt join  nfw_product_tag as pt on pt.id = tt.tag_id
                where user_id = '$user_id' and customization_id = 0 and order_id IS NULL group by product_id, tt.tag_id ";
        $listProduct = resultAssociate($query);
        $cartProductList = array();

        for ($i = 0; $i < count($listProduct); $i++) {
            $prdObj = new ProductHandler($listProduct[$i]['product_id'], $listProduct[$i]['tag_id']);
            $productInfo = $prdObj->productInformation();
            $profileImage = $prdObj->productImage();
            $productInfo['image'] = $profileImage['profileImage'] ? $profileImage['profileImage'] : '../assets/images/img1.png';
            $productInfo['quantity'] = $listProduct[$i]['quantity'];
            $productInfo['cart_product_id'] = $listProduct[$i]['id'];
            $productInfo['tag_id'] = $listProduct[$i]['tag_id'];
            $productInfo['cart_price'] = ($productInfo['price'] * $productInfo['quantity'] ) + $listProduct[$i]['extra_price'];


            $cartProductList[$i] = $productInfo;
        }
        return $cartProductList;
        //return count($listProduct);
    }

    function cartProductsInformation($cartProductId, $user_id) {
        //print_r($cartProductId);
        //echo $user_id;
        $query = "SELECT id, product_id, quantity, extra_price,customization_id,tag_id,measurement_id FROM  nfw_product_cart where id = $cartProductId and user_id = $user_id ";
        $listProduct = resultAssociate($query);
        $cartProductList = array();
        $i = 0;
        $prdObj = new ProductHandler($listProduct[$i]['product_id'], $listProduct[$i]['tag_id']);
        $productInfo = $prdObj->productInformation();

        $profileImage = $prdObj->productImage();
        $producttag = $prdObj->productTag($listProduct[$i]['product_id']);
        $productInfo['image'] = $profileImage['profileImage'];
        $productInfo['quantity'] = $listProduct[$i]['quantity'];
        $productInfo['cart_product_id'] = $listProduct[$i]['id'];
        $productInfo['cart_price'] = ($productInfo['price'] + $listProduct[$i]['extra_price']) * $productInfo['quantity'];
        //echo $productInfo['cart_price'];
        $productInfo['extra_price'] = $listProduct[$i]['extra_price'];
        $productInfo['product_tag'] = $listProduct[$i]['tag_id'];
        $productInfo['product_id'] = $listProduct[$i]['product_id'];
        $productInfo['customization_id'] = $listProduct[$i]['customization_id'];
        $productInfo['measurement_id'] = $listProduct[$i]['measurement_id'];
        return $productInfo;
    }

    /// wish list 
    function WishListProductsInformation($cartProductId, $user_id) {
        $query = "SELECT id, product_id, quantity, extra_price ,customize_table, tag_id FROM  nfw_product_wishlist where id = $cartProductId and user_id = $user_id ";
        $listProduct = resultAssociate($query);
        $cartProductList = array();
        $i = 0;
        $prdObj = new ProductHandler($listProduct[$i]['product_id'], $listProduct[$i]['tag_id']);
        $productInfo = $prdObj->productInformation();
        $profileImage = $prdObj->productImage();
        $producttag = $prdObj->productTag($listProduct[$i]['product_id']);
        $productInfo['image'] = $profileImage['profileImage'];
        $productInfo['quantity'] = $listProduct[$i]['quantity'];
        $productInfo['cart_product_id'] = $listProduct[$i]['id'];
        $productInfo['cart_price'] = ($productInfo['price'] + $listProduct[$i]['extra_price']) * $productInfo['quantity'];
        //echo $productInfo['cart_price'];
        $productInfo['extra_price'] = $listProduct[$i]['extra_price'];
        $productInfo['product_tag'] = $producttag;
        $productInfo['product_id'] = $listProduct[$i]['product_id'];
        $productInfo['customize_table'] = $listProduct[$i]['customize_table'];
        return $productInfo;
    }

    // delete by product_id
    #update query 3-dec-2015
    function deleteProductCart($product_id, $tag_id, $user_id, $table_Name) {
        $query = "delete from $table_Name where product_id = $product_id and tag_id = $tag_id and user_id= $user_id ";
        //echo $query;
        mysql_query($query);
    }

    // function for delete data by id
    function deleteFromCart($ids) {
        $query = "delete from nfw_product_cart where id = $ids ";
        mysql_query($query);
    }

    // function for insert data into order table
    function insertInOrderTable($quan, $price, $arry, $user_id, $bill_id, $ship_id, $coupon_id, $card_id) {
        $dat = date('Y-m-d ');
        $tm = date('H:i:s');
        $date_code = date('ym');
        $dte1 = date('Y-m-d H:i:s');
        mysql_query("INSERT INTO `nfw_product_order` (`user_id`, `op_date`, `op_time`, `total_price`, `total_quantity`,`billing_id`,`shipping_id`,`coupon_id` ,`card_id`) VALUES ('$user_id','$dat','$tm','$price','$quan','$bill_id','$ship_id','$coupon_id','$card_id')");
        $last_id = mysql_insert_id();
        $order_id = 1100 + $last_id;
        $order_code = 'ON' . $date_code . '' . $order_id;
        mysql_query("INSERT INTO `nfw_order_payment` (`user_id`, `order_id`, `card_id`, `transaction_no`, `transaction_amount`,`status`) VALUES ('$user_id','$last_id','$card_id','0','$price','Awaited')");
        mysql_query("update nfw_product_order set order_no = '$order_code' where id = $last_id");
        ## insertion into invoice table
        //echo "insert into nfw_order_invoice ('order_id','invoice_no','op_date','op_time','user_id','total_amount') values($last_id','','$dat','$tm','$user_id','$price')";
        mysql_query("insert into nfw_order_invoice (order_id,invoice_no,op_date,op_time,user_id,total_amount) values('$last_id','','$dat','$tm','$user_id','$price') ");
        $last_id_invoice = mysql_insert_id();
        $invoice_code = 1100 + $last_id_invoice;
        $invoice_no = 'IN' . $date_code . '' . $invoice_code;
        mysql_query("update nfw_order_invoice set invoice_no = '$invoice_no' where id = $last_id_invoice ");
        #####
        mysql_query("insert into nfw_order_status (order_id,status,remark,op_date_time) values('$last_id','1','Confirmed at $dte1','$dte1') ");
        #####
        for ($i = 0; $i < count($arry); $i++) {
            mysql_query("update nfw_product_cart set order_id = $last_id where id = $arry[$i] ");
        }
        return $last_id;
    }

    function userTag($userId) {
        $query = "SELECT ng.id,ng.tag_title FROM `nfw_product_tag_connection` as nptc join nfw_product_tag as ng on nptc.tag_id = ng.id
                    join nfw_product_cart as npc on nptc.product_id = npc.product_id where npc.user_id = $userId group by nptc.tag_id";
        $result = mysql_query($query);

        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function productTagId($product_id, $tag_id) {

        if (empty($tag_id)) {
            return array();
        } else {
            $query = "SELECT product_id FROM `nfw_product_tag_connection` where product_id = $product_id and tag_id = $tag_id group by product_id";

            $result = resultAssociate($query);

            return $result;
        }
    }

    // new function for without customization(imp)
    function idCustomizationWithZero($user_id, $tag_id = '') {
        $tag_query = "";
        if ($tag_id) {
            $tag_query = " tag_id = $tag_id and";
        }
        $query = "select * from nfw_product_cart where customization_id = 0 and $tag_query user_id = $user_id and order_id IS NULL order by product_id";
        $result = resultAssociate($query);
        return $result;
    }

    // for wishlist
    function WishListCustomizationWithZero($user_id) {
        $query = "select * from nfw_product_wishlist where customization_id = 0 and user_id = $user_id and order_id IS NULL order by product_id";
        $result = resultAssociate($query);
        return $result;
    }

    // find custom_id from nfw_product_cart from table id(imp)
    function customizationIdFind($ids) {
        $query = "select customization_id from nfw_product_cart where id = $ids ";
        $result = resultAssociate($query);
        return $result;
    }

    //function find customized product(imp)
    function idCustomizationwithValue($user_id) {
        $query = " SELECT id,op_date,op_time,product_id FROM `nfw_product_cart` where user_id = $user_id and customization_id > 0 and (order_id IS NULL or order_id ='') order by product_id";
        $result = resultAssociate($query);
        // print_r($result);
        return $result;
    }

    // old function with customization id 
    function findCustomizationId($user_id) {
        $query = "SELECT distinct(customization_id) FROM `nfw_product_cart` where user_id = $user_id and order_id IS NULL order by customization_id asc";
        $result = resultAssociate($query);
        return $result;
    }

    function findCartID($customize_id, $user_id) {
        $query = "SELECT * FROM `nfw_product_cart` where customization_id =$customize_id and user_id = $user_id and order_id IS NULL";
        return resultAssociate($query);
    }

    function findIDCart($customize_id, $user_id) {
        $query = "SELECT * FROM `nfw_product_cart` where user_id = $user_id and order_id IS NULL and customization_id IS NULL";
        return resultAssociate($query);
    }

    function updateCartQuantity() {
        $quan = $_REQUEST['quantity1'];
        $cart_product_id = $_REQUEST['cart_product_id'];
        mysql_query(" update nfw_product_cart set quantity = $quan where id = $cart_product_id ");
    }

    ##25-Aug-2015
    # find cart id using user_id,order_id

    function cartId($user_id, $order_id) {
        $query = "SELECT id FROM `nfw_product_cart` where user_id = $user_id and order_id = $order_id ";
        return resultAssociate($query);
    }

    #25 Augest
    #get wish list

    function findWishList($user_id) {
        $query = "SELECT * FROM `nfw_product_wishlist` where user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

    ##28-Aug-2015
    ## 29-Sep-2015 update query add two field measurement_id , tag_id
    # copy wishlist to cart function

    function WishlistCopyToCart($id, $user_id) {
        mysql_query("INSERT INTO nfw_product_cart (`product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id`) SELECT `product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id` FROM nfw_product_wishlist where id='$id' and user_id=$user_id");
    }

    ##25-Aug-2015
    ## 29-Sep-2015 update query add two field measurement_id , tag_id
    # move wishlist to cart function

    function WishlistMoveToCart($id, $user_id) {
        mysql_query("INSERT INTO nfw_product_cart (`product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id`) SELECT `product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id` FROM nfw_product_wishlist where id='$id' and user_id=$user_id");
        mysql_query("delete from nfw_product_wishlist where id='$id' and user_id=$user_id");
        //echo "delete nfw_product_wishlist where id='$id' and user_id=$user_id";
    }

    ##30-Sep-2015
    # copy  cart to wishlist  function

    function CartCopyToWishlist($id, $user_id) {
        mysql_query("INSERT INTO nfw_product_wishlist (`product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id`) SELECT `product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id` FROM nfw_product_cart where id='$id' and user_id=$user_id");
    }

    ##30-Sep-2015
    # move cart to wishlist function

    function CartMoveToWishlist($id, $user_id) {

        mysql_query("INSERT INTO nfw_product_wishlist  (`product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id`) SELECT `product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id` FROM nfw_product_cart where product_id='$id' and user_id=$user_id");
        echo "<br>INSERT INTO nfw_product_wishlist  (`product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id`) SELECT `product_id`, `user_id`, `op_date`, `op_time`, `quantity`, `extra_price`, `customization_id`, `customize_table`,`measurement_id`, `order_id`, `tag_id` FROM nfw_product_cart where product_id='$id' and user_id=$user_id";
        echo "<br>delete from nfw_product_cart where product_id='$id' and user_id=$user_id";
        die();
        mysql_query("delete from nfw_product_cart where id='$id' and user_id=$user_id");
        //echo "delete nfw_product_wishlist where id='$id' and user_id=$user_id";
    }

    #17-sep-2015
    #for all product tag

    function tags() {
        $query = "SELECT id, tag_title FROM `nfw_product_tag` order by tag_index ";
        $result = resultAssociate($query);
        return $result;
    }

    #12-Oct-2015
    #function for find product tag name from crt table

    function productCatTagId($cart_id) {
        $query = "SELECT pt.tag_title FROM `nfw_product_tag` as pt
                      join nfw_product_cart as ptc on pt.id = ptc.tag_id where ptc.id = $cart_id ";
        $result = resultAssociate($query);
        return $result;
    }

}

########### Class For USer Billing and shipping aadress ##################

class UserAddressDetail {

    function orderStatus($remark) {
        //echo $remark;
        $res = mysql_query('SELECT id FROM `nfw_product_order` order by id desc limit 0,1');
        $data = mysql_fetch_array($res);
        $order_id = $data['id'];
        $dateT = date('Y-m-d H:i:s');
        mysql_query("insert into nfw_order_status (order_id,status,remark,op_date_time) values('$order_id','1','$remark','$dateT') ");
    }

    function useraddress($user_id, $tableName) {
        if ($tableName == 'nfw_user_billing_information') {
            $field = "id,concat(address1,' ',address2,' ',city,' ',zip) as add1";
        } else {
            $field = "id,concat(s_address1,' ',s_address2,' ',s_city,' ',s_zip) as add1";
        }
        $query = "SELECT $field  FROM $tableName where user_id = $user_id";
        $result = resultAssociate($query);
        return $result;
    }

}
?>

