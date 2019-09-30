<?php

$arr1 = ['a','b','c'];
$arr2 = ['1','2','3'];
$arr3 = [];
for($i=0;$i<count($arr1);$i++){
     $arr3[$arr1[$i]]= $arr2[$i];
}
print_r($arr3);
?>
