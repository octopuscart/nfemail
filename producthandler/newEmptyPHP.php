<?php

class ProductHandler {

    public function __construct($product_id) {
        $this->productId = $product_id;
    }

    function productInformation() {
        $query = "SELECT nfp . * , nfc.name AS category_title,nc.color_code FROM nfw_product AS nfp
            JOIN nfw_category AS nfc ON nfc.id = nfp.product_category left join nfw_color as nc on nfp.color = nc.id
            WHERE nfp.id =  '$this->productId'";

        $productDetail = resultAssociate($query);
        return $productDetail[0];
    }

    function productImage() {
        $related_product_id = " select nfw_related_product_id from nfw_product_related where nfw_product_id = $this->productId ";
        $productDetail = resultAssociate($related_product_id);
        //print_r($productDetail);
        for ($i = 0; $i < count($productDetail); $i++) {
            $productrelatedId = $productDetail[$i]['nfw_related_product_id'];
            $query = "select concat('http://nf1.costcokart.com/nfw/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = $productrelatedId order by display_priority desc";
            //echo $query;
            $allImages = resultAssociate($query);
            print_r($allImages);
            $profileImage = $allImages[0]['image'];
            $profileDuleImage = array_slice($allImages, 0, 2);
           }

        return array(
            'allImages' => $allImages,
            'profileImage' => $profileImage,
            'dualImages' => $profileDuleImage
        );
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

}

class CategoryHandler {

    function featuredProductList() {
        $query = "SELECT nfw_product_id FROM nfw_product_featured ";
        //echo $query;
        return resultAssociate($query);
    }

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
        if (isset($_REQUEST['page_no'])) {
            $pageno = $_REQUEST['page_no'];
        } else {
            $pageno = 1;
        };
        if (isset($_REQUEST['$recor_per_page'])) {
            $recor_per_page = $_REQUEST['$recor_per_page'];
        } else {
            $recor_per_page = 3;
        };

        $from_data = (($pageno - 1) * $recor_per_page) + 1;
        $sliceArray[] = array_slice($mainArray, $from_data - 1, $recor_per_page);
        $sliceArray = $sliceArray[0];
        $num = count($mainArray);
        $page_pagination = $num / $recor_per_page;



        $l1 = 0;
        if ($pageno > 2) {
            $l1 = $pageno - 2;
        }
        if ($pageno > $page_pagination) {
            $l2 = $page_pagination;
            $l1 = $pageno - 4;
        } else {

            $l2 = $pageno + 3;
        }

        $pageArray = [];
        for ($i = $l1; $i < $l2; $i++) {
            if ($l2)
                $pageArray[] = $i;
        }



        if (is_float($page_pagination)) {
            $page_pagination = intval($page_pagination) + 1;
            //echo $page_pagination,"dsf";
        }
        $productRange = $from_data . '-' . (count($sliceArray) + $from_data - 1);
        return array($sliceArray, $pageArray, $mainArray, $productRange);
    }

    function productList() {
        $category_id = $_REQUEST['category'];
        $sorting = $_REQUEST['sorting'];
        $fromprice = $_REQUEST['from_price'];
        $aa = explode('$', $fromprice);
        $toprice = $_REQUEST['to_price'];
        $bb = explode('$', $toprice);
        $color_id = $_REQUEST['color'];
        //$dataId = $category_id;
        $arrayChild = [];
        $dataId = $this->parents($category_id);
        $dataId[] = $category_id;
        $query_data = array();
        $categoryString = implode(',', $dataId);
        if (count($dataId)) {
            $category = "where np.product_category in (" . $categoryString . ")";
            if (isset($fromprice)) {
                $price = "and np.price between '" . $aa[1] . "' and '" . $bb[1] . "'";
            } else {
                $price = '';
            }
            if (isset($color_id)) {
                $color = "and np.color='" . $color_id . "'";
            } else {
                $color = '';
            }
            if (isset($sorting)) {
                if ($sorting == 'Price-Desc') {
                    $sort = " order by np.price desc";
                }
                if ($sorting == 'Price-Asc') {
                    $sort = " order by np.price asc";
                }
            } else {
                $sort = '';
            }
            $query = "SELECT id FROM  nfw_product as np $category $price $color $sort";
            foreach (resultAssociate($query) as $id) {
                array_push($query_data, $id);
            };
        }
        $result = $this->paginate($query_data);
        return ($result);
    }

    function get_parent($id) {

        function get_parentReq($id) {
            $query = mysql_query("select * from nfw_category where id= $id ");
            // echo $query;
            $test = $id;
            while ($row = mysql_fetch_array($query)) {
                $cat = get_parentReq($row['parent']);
                //print_r($cat);
                $test = $cat . "," . $test;
            }
            return $test;
        }

        $test = get_parentReq($id);

        return $test;
    }

    function productSubCategory($id) {
        $query = "SELECT id,name FROM `nfw_category` where parent = '$id'";
        return resultAssociate($query);
    }

    function productColor($id) {
        $query = "SELECT id,name FROM `nfw_category` where parent = '$id'";
        $row = mysql_query($query);
        while ($row1 = mysql_fetch_array($row)) {
            
        }
    }

    function filterData() {
        $cat = $_REQUEST['category'];
        $fprice = $_REQUEST['fprice'];
        $tprice = $_REQUEST['tprice'];
        $color = $_REQUEST['color'];

        $query = " SELECT np.id,np.title,np.sku,np.price,nc.name FROM `nfw_product` as np
                       join nfw_category as nc on np.product_category = nc.id
                       join nfw_product_images as npi on np.id = npi.nfw_product_id
                       join nfw_color as ncc on np.color = ncc.id
                       where np.product_category = $cat and np.price between $fprice and $tprice and np.color = $color ";
    }

}

class CartHandler {

    function addProductToCart($product_id, $quantity) {

        $query = "insert into nfw_product_cart(product_id,user_id,op_date,op_time,quantity) values('$product_id',1,'2015-07-28','11:35 am','$quantity')";
        mysql_query($query);
    }

    function cartProducts($isJson) {
        $query = "SELECT id, product_id, sum(quantity) as quantity, sum(extra_price) as extra_price FROM  nfw_product_cart group by product_id";
        $listProduct = resultAssociate($query);
        $cartProductList = array();

        for ($i = 0; $i < count($listProduct); $i++) {
            $prdObj = new ProductHandler($listProduct[$i]['product_id']);

            $productInfo = $prdObj->productInformation();
            $profileImage = $prdObj->productImage();
            $productInfo['image'] = $profileImage['profileImage'];
            $productInfo['quantity'] = $listProduct[$i]['quantity'];
            $productInfo['cart_product_id'] = $listProduct[$i]['id'];

            $productInfo['cart_price'] = ($productInfo['price'] * $productInfo['quantity'] ) + $listProduct[$i]['extra_price'];


            $cartProductList[$i] = $productInfo;
        }
        return $cartProductList;
    }

    function cartProductsInformation($cartProductId) {
        $query = "SELECT id, product_id, quantity, extra_price FROM   nfw_product_cart where id = $cartProductId";
        $listProduct = resultAssociate($query);
        $cartProductList = array();
        $i = 0;
        $prdObj = new ProductHandler($listProduct[$i]['product_id']);
        $productInfo = $prdObj->productInformation();
        $profileImage = $prdObj->productImage();
        $producttag = $prdObj->productTag($listProduct[$i]['product_id']);
        $productInfo['image'] = $profileImage['profileImage'];
        $productInfo['quantity'] = $listProduct[$i]['quantity'];
        $productInfo['cart_product_id'] = $listProduct[$i]['id'];
        $productInfo['cart_price'] = ($productInfo['price'] + $listProduct[$i]['extra_price']) * $productInfo['quantity'];
        $productInfo['extra_price'] = $listProduct[$i]['extra_price'];
        $productInfo['product_tag'] = $producttag;
        $productInfo['product_id'] = $listProduct[$i]['product_id'];
        return $productInfo;
    }

    function deleteProductCart($product_id) {


        echo $query = "delete from nfw_product_cart where product_id = $product_id ";

        mysql_query($query);
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

    function findCustomizationId() {
        $query = "SELECT distinct(customization_id) FROM `nfw_product_cart` order by customization_id asc";
        $result = resultAssociate($query);
        return $result;
    }

    function findCartID($customize_id) {
        $query = "SELECT * FROM `nfw_product_cart` where customization_id = $customize_id";
        return resultAssociate($query);
    }

}

?>
