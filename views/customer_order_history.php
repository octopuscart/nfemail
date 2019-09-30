<?php include 'header.php'; print_r($_SESSION);?>
<?php $customer_order_detail=$authobj->user_order($_SESSION['user_id']); 
print_r($customer_order_detail); ?>
<?php include 'footer.php'; ?>
