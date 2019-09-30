<?php

$r = '2016-08-27 05:08:04';

$datar = explode(' ', $r);
print_r($datar);
echo $datar[0];
$dater1 = $datar[0];
$dateobj = date_create($r);
$rdate = date_format($dateobj, "d F Y--g:ia");
echo str_replace('--', ' at ', $rdate);
?>