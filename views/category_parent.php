<?php
include '../dbhandler/dbhandler.php';
// function for find parents
function get_parent($id) {
    $query = mysql_query("select * from nfw_category where id = $id " );
    $test = $id;
    while ($row = mysql_fetch_array($query)) {
        $cat = get_parent($row['parent']);
        $test = $cat . "," . $test;
    }
    return $test;
}
$res = get_parent(3);
$array = explode(',',$res);
print_r($array);
$data  = $array;
print_r($data[1]);

?>