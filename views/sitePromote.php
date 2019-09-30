<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {
    if (isset($_POST['submitData'])) {
        //print_r($_POST);
        $email = $_POST['email'];
        $query = "SELECT * FROM `auth_user` where email= '$email' ";
        $res = resultAssociate($query);
        if ($res) {
           
            ?>

            <script>
                swal({title: "Already Registered",
                    text: "User alredy konws about Nita Fashions. Please enter another email",
                    type: "error",
                   // timer: 2000,
                }, function () {
                   // window.location = './sitePromote.php'
                });
            </script>

            <?php
        } else {
            $op_date_time = date('Y-m-d H:i:s');
            $user_id = $_SESSION['user_id'];

            $query = "insert into nfw_site_reference (sender_id,receiver_email,receiver_id,op_date_time, status) values('$user_id','$email','0','$op_date_time', '0')";
            mysql_query($query);
            $ref_id = mysql_insert_id();
            header('location:sendMail.php?mail_type=6&email=' . $email . '&user_id=' . $user_id . '&ref_id=' . $ref_id);
           
            ?>
           
        <?php
        }
    }
    ?>
    <style>
        .tables td{
            border: none;
            padding-top: initial;
        }
        .tables tr{
            border: none;
        }
    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
            <p style="color: black">Refer and Earn</p>
            <div style="margin-top: 10px;"></div>
        </div>
    </section>

    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
                    <?php
                    include 'leftMenu.php';
                    ?>
                </aside>
                
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?></h3>
                        </div>
                        <div class="panel-body">
                            <h3 style="margin-left: 17px;font-weight: 300;font-size: 29px;line-height: 38px;"> If you referring to new clients, we will provide up to 5 to 10 % discount coupon on next purchase</h3><br>
                            <form method="post">   
                                <table class=  "tables">  
                                    <tr>
                                        <td>
                                            <span for="email" class="">Enter their Email Address in below reference Box </span>  
                                        </td>
                                    </tr>
                                    <tr>  
                                        <td>
                                            <input type="email" required required name="email" class="form-control"  value=""  style="height: 10%;width:135%" placeholder="Reference Email Address">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="submitData" class="btn btn-default btn-xs submit" >
                                                Submit
                                            </button>

                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
include 'footer.php'
?>


