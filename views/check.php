<?php
include_once 'common.php';

if(isSet($_POST['security_code']))
{
$security_code = trim($_POST['security_code']);

$to_check = md5($security_code);

if($to_check == $_SESSION['security_code'])
{
echo 'The security code is <font color="green">correct</font>.';
}
else
{
echo 'The security code is <font color="red">incorrect</font>.';
}
}
?>