<?php include 'header.php'; ?>
<?php
$token = $_GET['token'];
$id = $_GET['access'];
$query1 = "select * from auth_user where user_img = '$token' and id = $id";
$data = resultAssociate($query1);
if (count($data)) {
    $query = "update auth_user set status = '1', user_img = '' where user_img = '$token' and id = $id";
    resultAssociate($query);
    $remail = end($data)['email'];
    
}

?>
<!--header image-->
<section class="image_bg_8 darkness type_4 relative" style="    background-position: 0px 90px;  ;height: 500px;"> 
    <div class="container" style="    background: rgba(0, 0, 0, 0.44);    margin-top: 30px;
         padding: 17px;">
        <div class="" style="text-align: center">
            <?php
            if (count($data)) {
                ?>
                <h2 style="font-weight: 100;color:white;    margin-bottom: 10px;">Your Registration Has Been Confirmed</h2>
                <div class="col-md-4"></div>
                <form action="#" class="login_form col-md-4" method="post">
                    <p>Login Now</p>
                    <ul>
                        <li class="m_bottom_10 relative">
                            <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                            <input type="text" name="email" placeholder="Email" class="r_corners color_grey w_full fw_light" value="<?php echo $remail;?>" readonly="">
                        </li>
                        <li class="m_bottom_10 relative">
                            <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                            <input type="password" name="pass" placeholder="Password" class="r_corners color_grey w_full fw_light">
                        </li>

                        <li class="">
                            <div class="">
                                <input type="submit" name="login" class="btn btn-default  tr_all color_black transparent  r_corners"  value="Login">
                            </div>


                        </li>
                    </ul>
                </form>
                <div class="col-md-4"></div>

                <?php
            } else {
                ?>
                <h2 style="font-weight: 100;color:red">Invalid Request</h2>
            <?php } ?>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>