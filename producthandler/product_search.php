<?php

include '../dbhandler/dbhandler.php';
include 'productHandler.php';
include 'authHandler.php';
$search = $_REQUEST['searchText'];
$tag_id = $_REQUEST['tag_id'];
$catobj = new CategoryHandler();


$query = "select id as sid, tag_title as title from nfw_product_search_tag where tag_title  like '$search%'";
$searchdata = resultAssociate($query);

echo json_encode($searchdata);








$prequery = "select concat('http://costcointernational.com/nfw/smaller/',pi.image) as image,
                  p.product_category, p.title as item_code,
               
                concat('$', ptc.price) as tag_price, p.title as title,
                 ptc.tag_id, p.id as product_id,
                
                p.sku,p.product_speciality,
                p.publishing
               from nfw_product as p
          
                left join nfw_searching as nfs on nfs.search_text = p.id
                join nfw_product_images as pi on p.id = pi.nfw_product_id
                join  nfw_product_tag_connection as ptc on ptc.product_id = p.id
                
                join nfw_product_tag as tag on tag.id = ptc.tag_id";

$query = $prequery . " where p.title like '%$search%' or tag.tag_title like '%$search%' and ptc.tag_id = '$tag_id'";

$query .= " group by p.id order by nfs.search_index desc limit 0,5";
?>


