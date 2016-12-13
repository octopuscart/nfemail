<?php
include '../dbhandler/dbhandler.php';
function get_parent($id) {
    $query = mysql_query("select * from nfw_category where id=$id");
    $test = $id;
    while ($row = mysql_fetch_array($query)) {
        $cat = get_parent($row['parent']);
        $test = $cat . "," . $test;
    }
    return $test;
}
$parent = get_parent('2');
echo "<pre>";
print_r($parent);
?>