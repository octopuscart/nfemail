<?php
include "dbhandler.php";
function parents($parentId){
    $query = "select id from nfw_category where parent = $parentId";
    $res = resultAssociate($query);
    for ($i = 0; $i < count($res); $i++) {
        $id = $res[$i]['id'];
        global $arrayChild;
        array_push($arrayChild, $id);
        parents($res[$i]['id']);
    }
}
$arrayChild = [];
parents(0);
$arrayChild = [];
foreach($arrayChild as $i){
  echo $i;
}
?>
