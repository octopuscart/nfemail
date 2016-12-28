<?php

/////////////////////////////
////function for crete permutation for color sorting
function get_permutations($inputcolor, $count1) {

    function string_getpermutations($prefix, $characters, &$permutations) {
        if (count($characters) == 1) {


            $permutations[] = $prefix . ',' . array_pop($characters);
        } else {
            for ($i = 0; $i < count($characters); $i++) {
                $tmp = $characters;
                unset($tmp[$i]);
                string_getpermutations($prefix . "," . $characters[$i], array_values($tmp), $permutations);
            }
        }
    }

    $characters = array();
    for ($i = 0; $i < count($inputcolor); $i++)
        $characters[] = $inputcolor[$i];
    $permutations = array();

    string_getpermutations("", $characters, $permutations);

    $temp = array();
    foreach ($permutations as $key => $value) {

        array_push($temp, substr($value, 1));
    }

    $temp1 = array_unique($temp);
    $queryarray = [];
    
    for ($i = $count1; $i > 1; $i--) {
        
        foreach ($temp1 as $key => $value) {
            $acval = explode(',', $value);
            $acval = implode(",", array_slice($acval, 0, $i));
            array_push($queryarray, $acval);
        }
    }
    $queryarray = array_merge($queryarray, $inputcolor);
    $colorpermutations = "'" . implode("','", $queryarray) . "'";
    return $colorpermutations;
}

////
class ProductHandler {

    public function __construct($product_id, $tag_id) {
        $this->productId = $product_id;
        $this->tag_id = $tag_id;
// echo    $this->productId;
    }

    function productInformation() {

        $query = "SELECT (if(ntc.sale_price>0, ntc.sale_price, ntc.price)) as price, ntc.price as rprice, ntc.sale_price as sale_price, nfp . * , nfc.name AS category_title,(select npt.tag_title from nfw_product_tag as npt where npt.id= ntc.tag_id) as tag_name FROM nfw_product AS nfp
            JOIN nfw_category AS nfc ON nfc.id = nfp.product_category
            join nfw_product_tag_connection as ntc on ntc.product_id = nfp.id
            WHERE nfp.id =  '$this->productId' and ntc.tag_id = '$this->tag_id'";

        $productDetail = resultAssociate($query);
//print_r($productDetail);
        return $productDetail[0];
    }

#26-sep-2015 Update function - comment query will use

    function productImage() {

        $conf = resultAssociate("select * from server_conf");
        $conf = end($conf);
        $imageserver = $conf['image_server'];
        $query = "select concat('$imageserver/small/', image) as image 
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

    function productColor() {
        $query = "SELECT nc.* FROM `nfw_product_color` as pc join 
                        nfw_color as nc on pc.nfw_color_id = nc.id
                        join nfw_product as np on pc.nfw_product_id = np.id
                        where np.id = '$this->productId' ";
        $result = resultAssociate($query);
        return $result;
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
        $query = "SELECT ptc.price,ptc.sale_price, pt.tag_title, ptc.tag_id as tag_id FROM `nfw_product_tag_connection` as ptc 
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

    function parentsChild($childid) {
        $query = "select parent from nfw_category where id = $childid";
        $res = resultAssociate($query);


        if ($res) {
            $lastid = end($res);
            $id = $lastid['parent'];
            global $arrayParent;
            array_push($arrayParent, $id);
            parentsChild($id);
        }

        return $arrayParent;
    }

// Function for pagination
    function paginate($query_data) {
        $mainArray = [];
        for ($i = 0; $i < count($query_data); $i++) {
            $mainArray[] = $query_data[$i]['id'];
        }

        return array($mainArray);
    }

//set searching tag
    function pretagcheck($tag_title) {
        $stagquey = "SELECT id FROM  nfw_product_search_tag  where tag_title = '$tag_title'";
        $tagdata = resultAssociate($stagquey);
        if ($tagdata) {
            return end($tagdata)['id'];
        } else {
            $insquery = "INSERT INTO nfw_product_search_tag(tag_title) VALUES ('$tag_title');";
            resultAssociate($insquery);
            return mysql_insert_id();
        }
    }

    function presearchtag($product_id, $tag_id) {
        $stagquey = "SELECT id FROM  nfw_product_search_tag_connection  
                    where product_id = '$product_id' and tag_id = '$tag_id'";
        $stagdata = resultAssociate($stagquey);
        if ($stagdata) {
            
        } else {
            $insquery = "INSERT INTO nfw_product_search_tag_connection(product_id, tag_id) VALUES ('$product_id', '$tag_id');";
            resultAssociate($insquery);
        }
    }

    function setSearchingTag($product_id, $requestdata) {
        $category = $requestdata['category'];
        $catquey = "select name from nfw_category where id = '$category'";
        $categorydata = resultAssociate($catquey);
        if ($categorydata) {
            $ctitle = end($categorydata)['name'];
            $search_tag = $this->pretagcheck($ctitle);

            $this->presearchtag($product_id, $search_tag);
        }
    }

    function productList() {

        $conf = resultAssociate("select * from server_conf");
        $conf = end($conf);
        $imageserver = $conf['image_server'];
        $colorjoin = "   join nfw_product_color as npc on np.id =  npc.nfw_product_id
                        join nfw_color as nc on npc.nfw_color_id = nc.id
                         
                        left join nfw_product_subcategory as sbnptcs on sbnptcs.category_id = np.product_category

                        left join nfw_product_search_tag_connection as nptcs on nptcs.product_id = np.id
                        

                        left join nfw_fabric as nf on nf.id = np.fabric_title
                        join nfw_product_tag_connection as ntc on ntc.product_id = np.id";
        $query = "";

        $imageq = " IFNULL(
            (select concat('$imageserver/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = np.id order by display_priority desc limit 0, 1),
                   '../assets/images/img2.png'
              )    
              as image1, 
                  
                 IFNULL(
                 (select concat('$imageserver/small/', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = np.id order by display_priority desc limit 1, 1),
                  '../assets/images/img2.png'
                       ) as image2
                ";

        $preselectq = "SELECT distinct np.id as id, 
                       ( 
                       SELECT group_concat(snc.id, snc.color_code) FROM nfw_color as snc  
         left join nfw_product_color as snpc on snpc.nfw_color_id = snc.id
         where snpc.nfw_product_id = np.id order by snc.id asc
                       ) as color, npc.id as colorid,
                       np.title as title, np.product_speciality as product_speciality, publishing, ntc.price as price, ntc.sale_price, if(ntc.sale_price, ntc.sale_price, ntc.price) as price_r,  $imageq ";

        $category_id = $_REQUEST['category'];
        $sorting = $_REQUEST['sorting'];
        $fromprice = $_REQUEST['from_price'];
        $aa = explode('$', $fromprice);
        $toprice = $_REQUEST['to_price'];
        $bb = explode('$', $toprice);

        $colorlistf = $_SESSION['colorlist'];

        $color_id = implode(",", $colorlistf);

        $item_type = $_REQUEST['item_type'];
        $colorlist = [];

//searching implementations
        $searchtag = "";
        if (isset($_REQUEST['searchtag'])) {
            $searchtag = $_REQUEST['searchtag'];
        }
//searching

        $fabrictype = $_REQUEST['Fabric_Category'];

//$dataId = $category_id;
        $arrayChild = [];

        $limitquery = " ";
                    
        if (1) {
                  
            if (isset($_REQUEST['category']) & $_REQUEST['category']!='') {
           
                $dataId = $this->parents($category_id);
                $dataId[] = $category_id;
                $query_data = array();
                $categoryString = implode(',', $dataId);

//                sub category checking string
                $subcategorycheck = "SELECT group_concat( nfw_product_subcategory.product_id) FROM nfw_product_subcategory
     join nfw_product_tag_connection on nfw_product_tag_connection.product_id = nfw_product_subcategory.product_id
     where nfw_product_tag_connection.tag_id = '$item_type' and nfw_product_subcategory.category_id in ($categoryString )";


                $category = "where (np.product_category in (" . $categoryString . ") or np.id in ($subcategorycheck))  and ntc.tag_id = $item_type";

                if ($searchtag != "") {
                    $category .= " and nptcs.tag_id  = '$searchtag' ";
                }
            } else {
             
                $category = "where  nptcs.tag_id  = '$searchtag' ";
            }


            if (isset($fromprice)) {
                $price = "and if(ntc.sale_price, ntc.sale_price, ntc.price) between '" . $aa[1] . "' and '" . $bb[1] . "'";
            } else {
                $price = '';
            }
            if (isset($color_id)) {
                if ($color_id != '') {
//echo $color_id;
                    $colorlist = explode(",", $color_id);


//$colorlist = implode(" = npc.nfw_color_id and ", $colorlist) . ' = npc.nfw_color_id ';
// $colorlist = implode(" and ", $temps);
// $color = " and " . $colorlist;
                    $color = " and npc.nfw_color_id in ($color_id) ";
                } else {
                    $color = '';
                }
            } else {
                $color = '';
            }


            if (isset($fabrictype)) {
                if ($fabrictype != 'All Type') {
                    $fabtype = " and nf.title='" . $fabrictype . "'";
                } else {
                    $fabtype = '';
                }
            } else {
                $fabtype = '';
            }

            if (isset($_REQUEST['paginate'])) {
                $pg = $_REQUEST['paginate'];
                $pg1 = $pg[0] - 1;
                $pg2 = $_REQUEST['perpage'];
                $limitquery = " ";
            }




            $prequery = "";
            $pricesort = " sort_type desc";

            if (isset($sorting)) {

                switch ($sorting) {
                    case 'Price-Desc':
                        $sort = " order by ntc.price desc";
                        $pricesort = " price_r desc";
                        $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
                        break;

                    case 'Price-Asc':
                        $sort = " order by ntc.price asc";
                        $pricesort = " price_r asc";
                        $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
                        break;

                    case 'Most Popular':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_most_populat_product`) and np.publishing = 1  ";
                        $prequery = "$preselectq , 'MP' as sort_type FROM  nfw_product as np $colorjoin   $category $price $color $fabtype $sortt ";
                        break;

                    case 'On Sale':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_on_sale`) and np.publishing = 1  ";
                        $prequery = "$preselectq , 'Sale' as sort_type  FROM  nfw_product as np $colorjoin   $category $price $color $fabtype $sortt ";
                        break;

                    case 'New Arrival':
                        $sortt = " and np.id in (SELECT product_id FROM `nfw_new_arrival`) and np.publishing = 1  ";
                        $prequery = "$preselectq , 'New' as sort_type  FROM  nfw_product as np $colorjoin   $category $price $color $fabtype $sortt ";
                        break;

                    case 'Sale/Most Popular':

                        $sortt2 = " and np.id in (SELECT npps.product_id FROM nfw_most_populat_product as npps
                                    join nfw_on_sale as nss on nss.product_id = npps.product_id)  and np.publishing = 1   ";

                        $prequery = "$preselectq, 'MP_SALE' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype $sortt2 ";
                        break;


                    default:
                        $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
                        $sort = '';
                }
            } else {
                $sort = '';
                $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
            }

//echo $sort;        
            $query = $prequery;

//echo "---";
        }
        $colorquery = implode(",", $colorlist);
        $checkcolorsort = "";
        if (count($colorlist)) {
            $checkcolorsort = ", color ";
        }
        $query = " select id, color, title, product_speciality, price, price_r, sale_price, image1, image2, sort_type, publishing from (" . $query . "  )  as dc where publishing = 1
                            group by id order by  $pricesort  $checkcolorsort  $limitquery";


        $result = resultAssociate($query);


        if (count($result)) {

            $fresult = [];
            $fresultindex = [];

            $productliststr = array();
            foreach ($result as $ry => $rv) {
                $productliststr[$rv['id']] = $rv;
            }
            $productkey = array_keys($productliststr);
            $productquery = implode(",", $productkey);

//echo "----------";

            function intersectdata($dataarray) {
                $temp = [];
                $count = count($dataarray);
                for ($i = 0; $i < ($count - 1); $i++) {
                    print_r($dataarray[$i]);
                    print_r($dataarray[$i + 1]);
                    $temp2 = array_intersect($dataarray[$i], $dataarray[$i + 1]);

                    array_push($temp, $temp2);
                }
                return $temp;
            }

            $colorproductmainlist = [];
            $colorcount = count($colorlist);


//echo $colorcount;

            if ($colorcount) {

//                $queryc = "SELECT nfw_product_id, nfw_color_id
//         FROM nfw_product_color where nfw_color_id in (" . $colorquery . ") and nfw_product_id  in (select nfw_product_id from nfw_product_color group by nfw_product_id having count(nfw_product_id) = " . $colorcount . " )
//         group by nfw_product_id 
//         having count(nfw_product_id) = " . $colorcount . " order by FIELD(nfw_color_id, " . $colorquery . ")";
//
//// echo $queryc = "select nfw_product_id from nfw_product_color where nfw_product_id in (" . $productquery . ") and nfw_color_id in (" . $colorquery . ") group by nfw_product_id having count(nfw_product_id) =" . $colorcount . "";
//                $colorproductmainlist = resultAssociate($queryc);
//                $temp4 = [];
//// print_r($colorproductmainlist);
//                foreach ($colorproductmainlist as $key1 => $value1) {
//                    array_push($temp4, $value1['nfw_product_id']);
//                }
//
//
//


                if ($colorcount > 1) {



                    $temp41a = array();
                    $colortemparray = array_values($colorlist);




                    $colorsorting = get_permutations($colortemparray, $colorcount);


                    $queryc1a = "(select nfw_product_id, colorbunch from(
SELECT nfw_product_id, nfw_color_id, 
(select group_concat(nc.nfw_color_id ) colorbrc from nfw_product_color as nc where nc.nfw_product_id = npc.nfw_product_id group by npc.nfw_product_id ) as colorbunch
 FROM nfw_product_color as npc 
where nfw_color_id in ($colorquery) and nfw_product_id in  (" . $productquery . ") 
group by nfw_product_id
) as a
where colorbunch in ($colorsorting) 
order by FIELD(colorbunch, $colorsorting) )";




                    $temps1 = [];
                    $clllist = resultAssociate($queryc1a);
                 //   print_r($clllist);
//$clllist = array_reverse($clllist);
                    foreach ($clllist as $key11 => $value11) {
                        array_push($temps1, $value11['nfw_product_id']);
                    }
// print_r($temps1);
                    $temp41a = array_merge($temps1, $temp41a);

                    $temp41a = ($temp41a);
//print_r($temp41a);

                    $temp41 = $temp41a;
                } else {
                    $queryc1 = "SELECT (select title from nfw_product where id = nfw_product_id) as title, nfw_product_id, nfw_color_id, (select group_concat(nfw_color_id) from nfw_product_color  as nc where nc.nfw_product_id = npc.nfw_product_id group by npc.nfw_product_id) as colorbunch FROM nfw_product_color as npc where nfw_product_id in  (" . $productquery . ") 
    group by nfw_product_id 
    having  nfw_color_id in (" . $colorquery . ") 
order by count(nfw_color_id) asc, colorbunch";
                    $colorproductmainlist1 = resultAssociate($queryc1);
                    $temp41 = [];
                    foreach ($colorproductmainlist1 as $key11 => $value11) {
                        array_push($temp41, $value11['nfw_product_id']);
                    }
                }



//  $queryc1 = "select nfw_product_id from nfw_product_color where nfw_product_id in (" . $productquery . ") and nfw_color_id in (" . $colorquery . ") group by nfw_product_id order by count(nfw_color_id) asc, FIELD(nfw_color_id, ".$colorquery.") desc";



                $temp6 = array_values($temp4);
                $temp7 = array_unique(array_merge($temp41, $productkey));
//print_r($temp6);

                $resultf = [];
                foreach ($temp7 as $key1 => $value1) {
                    foreach ($result as $key2 => $value2) {
                        if ($value2['id'] == $value1) {
// echo $value2['id'], '-';
                            if ($value1 != '') {
                                $resultf[$key1] = $value2;
                            }
                        }
                    }
                }
            } else {
                $resultf = $result;
            }
            if (isset($_REQUEST['paginate'])) {
                $pg = $_REQUEST['paginate'];
                $pg1 = $pg[0] - 1;
                $pg2 = $_REQUEST['perpage'];
                return array_slice($resultf, $pg1, $pg2);
            } else {
                return ($resultf);
            }
        } else {
            return $result;
        }
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
        $res = resultAssociate($query);
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
        }

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
        if ($tag_id > 0) {
            $query = "insert into $table (product_id,user_id,op_date,op_time,quantity, tag_id) values('$product_id','$user_id','$dat','$tm','$quantity', '$tag_id')";
            mysql_query($query);
        } else {
            $tag_query = "SELECT tag_id FROM nfw_product_tag_connection where product_id = '$product_id'";
            $tdata = resultAssociate($tag_query);
            foreach ($tdata as $key => $value) {
                $tag_id_r = $value['tag_id'];
                $query = "insert into $table (product_id,user_id,op_date,op_time,quantity, tag_id) values('$product_id','$user_id','$dat','$tm','$quantity', '$tag_id_r')";
                mysql_query($query);
            }
        }
    }

    function cartProductsCount($user_id, $customize) {
        $query = "SELECT sum(quantity) as quantity FROM  nfw_product_cart where user_id = $user_id $customize and order_id IS NULL";
        return resultAssociate($query);
    }

    function cartProducts($isJson, $user_id, $tableName) {
        $query = "SELECT tt.id, tt.product_id, sum(tt.quantity) as quantity, SUM( IF( tt.extra_price, tt.extra_price, 0 ) )  as extra_price,tt.tag_id FROM 
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
        $query = "SELECT id, product_id, quantity, extra_price,customization_id,tag_id,measurement_id,customization_data,customization_data_price FROM  nfw_product_cart where id = $cartProductId and user_id = $user_id ";

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
        $productInfo['customization_data'] = $listProduct[$i]['customization_data'];
        $productInfo['customization_data_price'] = $listProduct[$i]['customization_data_price'];
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
echo $query;
        mysql_query($query);
    }

// function for delete data by id
    function deleteFromCart($ids) {
        $query = "delete from nfw_product_cart where id = $ids and order_id not in (select id from nfw_product_order)";
        mysql_query($query);
    }

// function for insert data into order table
#9-dec-2015 Update whole procedure
#update 14-dec-2015
#update 16-dec-2015
    function insertInOrderTable($quan, $arry, $user_id, $bill_id, $ship_id, $coupon_id, $card_id, $skus, $imagess, $prices, $tag_titles, $wallet, $ship_amt, $subtotal) {
// echo 'dffgdxgdfg';
        if ($ship_amt) {
            $ship_amt = explode('$', $ship_amt)[1];
        } else {
            $ship_amt = 0;
        }

############billing###################
        $query = "SELECT address1,address2,city,state,country,zip FROM `nfw_billing_shipping_address` where id = $bill_id ";
        $result = resultAssociate($query);

        $billdata = json_encode(end($result));
//echo 1;
###########shipping################
        $query = "SELECT address1,address2,city,state,country,zip FROM `nfw_billing_shipping_address` where id = $ship_id ";
        $shipresult = resultAssociate($query);
        $shipdata = json_encode(end($shipresult));
//echo 2;
########## userinfo ###########
        $query = "SELECT id,first_name,middle_name,last_name,email,telephone_no,fax_no,contact_no,registration_id FROM  `auth_user` where id = $user_id";
// echo  $query;
        $userinfo = resultAssociate($query);
        $userdata = json_encode(end($userinfo));
// echo 3;
########### cardinfo ##########

        if ($card_id == 'paypal') {
            
        } elseif ($card_id == 'post_pay') {
            $carddata1 = "Manual payment";
            $cardTitle = 'Manual payment';
        } else {
            $query = "SELECT card_holder_name,card_number,expiry_month,expiry_year,address,bank_name,cvv FROM `nfw_user_card` where id = $card_id";
            $carddata = resultAssociate($query);
            $carddata1 = json_encode(end($carddata));
            $cardTitle = 'Credit Card';
        }
// echo 4;
#################################
        $dat = date('Y-m-d ');
        $tm = date('H:i:s');
        $date_code = date('ym');
        $dte1 = date('Y-m-d H:i:s');
//echo 5;
        if ($coupon_id) {
            $copon_p = resultAssociate("SELECT value FROM `nfw_coupon` where id = $coupon_id");
            $copon_price = $copon_p[0]['value'];
        } else {
            $copon_price = 0;
        }

//        $sum1 = 0;
//        for ($i = 0; $i < count($prices); $i++) {
//            $sum1 += $prices[$i];
//        }
####### total price calculation ######
// $total_price = ($subtotal + $ship_amt) - $wallet ;

        $total_sum = ($subtotal + $ship_amt) - ($copon_price + $wallet);
        if ($card_id == 'paypal') {
            $total_sum = $subtotal;
        }
        
        
        
        $total_sum = '$' . number_format($total_sum, 2, '.', '');
//echo "INSERT INTO `nfw_product_order` (`user_id`,`user_info`, `op_date`, `op_time`, `total_price`,`shipping_amount`,`total_quantity`,`billing_id`,`shipping_id`,`coupon_id` ,`wallet_amount`,`payment_gateway`,`payment_gateway_return`) VALUES ('$user_id','$userdata','$dat','$tm','$total_sum','$ship_amt','$quan','$billdata','$shipdata','$coupon_id','$wallet','Coupon','$carddata1')";
        mysql_query("INSERT INTO `nfw_product_order` (`user_id`,`user_info`, `op_date`, `op_time`, `total_price`,`shipping_amount`,`total_quantity`,`billing_id`,`shipping_id`,`coupon_id` ,`wallet_amount`,`payment_gateway`,`payment_gateway_return`) VALUES ('$user_id','$userdata','$dat','$tm','$total_sum','$ship_amt','$quan','$billdata','$shipdata','$coupon_id','$wallet','$cardTitle','$carddata1')");

        $last_id = mysql_insert_id();
        $gen_num =  1100 + $last_id;
   
        
        $order_code = 'ON' . $date_code . '' . $gen_num;
        if ($wallet > 0) {
            mysql_query("INSERT INTO `nfw_wallet` (`user_id`,`reference_id`, `credit_amt`, `debit_amt`, `txn_type`, `date_time`,`remark`) VALUES ('$user_id','$order_code','','$wallet','Purchase','$dte1','')");
        }
//echo '6';
        mysql_query("INSERT INTO `nfw_order_payment` (`user_id`, `order_id`, `card_id`, `transaction_no`, `transaction_amount`,`status`) VALUES ('$user_id','$last_id','$card_id','0','$total_sum','Pending')");
//echo '7';
        mysql_query("update nfw_product_order set order_no = '$order_code' where id = $last_id");
## insertion into invoice table
        mysql_query("insert into nfw_order_invoice (order_id,invoice_no,op_date,op_time,user_id,total_amount) values('$last_id','','$dat','$tm','$user_id','$total_sum') ");
        $last_id_invoice = mysql_insert_id();
      
        $invoice_no = 'IN' . $date_code . '' . $gen_num;
        mysql_query("update nfw_order_invoice set invoice_no = '$invoice_no' where id = $last_id_invoice ");
#####
        mysql_query("insert into nfw_order_status (order_id,status,remark,op_date_time) values('$last_id','1','Confirmed on $dte1','$dte1') ");
#####
        for ($i = 0; $i < count($arry); $i++) {
            $query = "update nfw_product_cart set order_id = '$last_id',sku='$skus[$i]',item_code = '$skus[$i]',item_image='$imagess[$i]',price='$prices[$i]',tag_title='$tag_titles[$i]'  where id = $arry[$i] ";
            mysql_query($query);
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
    function idCustomizationWithZero($user_id, $tag_id = '', $custom_cart_condition = "!=") {
        $tag_query = "";
        if ($tag_id) {
            $tag_query = " tag_id = $tag_id and";
        }
        $query = "select * from nfw_product_cart where customize_table $custom_cart_condition 1 and customization_id = 0 and $tag_query user_id = $user_id and order_id IS NULL order by product_id";
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
        $query = " SELECT id,op_date,op_time,product_id FROM `nfw_product_cart` where user_id = $user_id and customization_id != '' and (order_id IS NULL or order_id ='') order by product_id";
//$query = "SELECT id,op_date,op_time,product_id FROM `nfw_product_cart` where user_id = $user_id  and (order_id IS NULL or order_id ='') order by product_id";
        $result = resultAssociate($query);
// print_r($result);
        return $result;
    }

// old function with customization id 
    function findCustomizationId($user_id) {
        $query = "SELECT distinct(customization_id) FROM `nfw_product_cart` where user_id = $user_id and order_id IS NULL and customization_id = '' order by customization_id asc";
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

