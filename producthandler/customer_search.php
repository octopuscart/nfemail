<?php

include '../dbhandler/dbhandler.php';
include 'productHandler.php';
include 'authHandler.php';
$search = $_REQUEST['searchText'];
$query = "select *, concat(first_name, ' ', middle_name, ' ', last_name, ' (', registration_id,')') as client_code from auth_user where first_name like '%$search%' or last_name like '%$search%'"
        . " or middle_name like '%$search%' or registration_id like '%$search%' or contact_no like '%$search%'";
$data = resultAssociate($query);
echo json_encode($data);
?>


