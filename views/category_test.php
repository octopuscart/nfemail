<?php 
include '../dbhandler/dbhandler.php';
function parent_get($table,$column,$id){
    echo "<ul>";
    $query=mysql_query("select * from $table where $column=$id");
    while ($row = mysql_fetch_array($query)) {
    echo "<li>"; 
         echo $row['id'];
        $cat[$row['id']]=child ($table,$column,$row['id']);
       
    echo "</li>";    
    }
    echo "<ul>";
    return $cat;
}
function child ($table,$column,$id){
    $data = array();
    echo "<ul>";
    $query=mysql_query("select * from $table where $column=$id");
    
    while ($row = mysql_fetch_array($query)) {
    echo "<li>"; 
    echo $row['id'];
         $cat[$row['id']]=child($table,$column,$row['id']) ;
         $data = $row['id'];
         
    echo "</li>";    
    }
    echo "</ul>";
    return $data;
}
$cat=parent_get('nfw_category','parent','0');


?>

           
           
           
