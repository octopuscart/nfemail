<?php
include '../dbhandler/dbhandler.php';
include '../producthandler/productHandler.php';
$catobj = new CategoryHandler();

$allProducts = resultAssociate("select id, title from nfw_product");
foreach ($allProducts as $key => $value) {
    $tag_id = $catobj->pretagcheck($value['title']);
    $product_id = $value['id'];
    $catobj->presearchtag($product_id, $tag_id);
    echo $tag_id, "<br/>";
}
?>