<?php include 'header.php'; ?>
<?php
$token = $_GET['token'];
$id = $_GET['access'];
$query1 = "select * from auth_user where user_img = '$token' and id = $id";
$data = resultAssociate($query1);
if (count($data)) {
    $query = "update auth_user set status = '1', user_img = '' where user_img = '$token' and id = $id";
    resultAssociate($query);
}
?>
<!--header image-->
<section class="image_bg_8 darkness type_4 relative"> 
    <div class="container" style="    background: rgba(0, 0, 0, 0.44);
         padding: 17px;">
        <div class="" style="text-align: center">
            <?php
            if (count($data)) {
                ?>
                <h2 style="font-weight: 100;color:white">Your Registration Has Been Confirmed</h2>

                <?php
            } else {
                ?>
                <h2 style="font-weight: 100;color:red">Invalid Request</h2>
            <?php } ?>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>