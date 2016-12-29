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

    if (isset($_REQUEST['updatePass'])) {

        $returnresult = $authobj->changePassword($_SESSION['user_id'], $_REQUEST['old_pwd'], $_REQUEST['pwd'], $_REQUEST['pwd1']);
    }

    if (isset($_REQUEST['updateData'])) {
        $authobj->updateUserDetail($_REQUEST['middle_name'], $_REQUEST['first_name'], $_REQUEST['last_name'], $_REQUEST['email'], $_REQUEST['gender'], $_REQUEST['contact_no'], $_SESSION['user_id'], $_REQUEST['fax_no'], $_REQUEST['telephone_no'], $_REQUEST['birth_date']);
        header('location:userProfile.php');
    }
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300; text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Personal Information</p>
            <div style="margin-top: 10px;"></div>
        </div>
    </section>

    <style>
        .profile td{
            border:none;
        }
    </style>
    <style>
        .close{
            opacity: 1;
            color: white;
        }
        .modal-header{
            padding: 3px 19px;
            background: black;
        }
        .tds{
            padding: 8px;
            line-height: 0.42857143 !important;
            vertical-align: top;
            border-bottom: 1px solid;


        }
    </style>
    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	

    <?php
    include 'leftMenu.php';
    ?>

                </aside>

                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
    <?php if ($returnresult) { ?>
                        <p> <?php echo $returnresult; ?> </p>
    <?php } ?>
                    <div class="panel panel-default" style="">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?></h3>

                        </div>
                        <div class="panel-body">
                            <div  align="">
                                <form method="post" action="#">
                                    <div class="col-md-2"></div>
                                    <div class='col-md-8' style="" align="center">

                                        <table class="profile" align="left" style="color:black">
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">First Name</span>
                                                </td>
                                                <td>
                                                    <input type="text" name="first_name" class="form-control" value="<?php echo $userInfo[0]['first_name']; ?>"  style="height: 30px;" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Middle Name</span>
                                                </td>
                                                <td>
                                                    <input type="text" name="middle_name" class="form-control" value="<?php echo $userInfo[0]['middle_name']; ?>"  style="height: 30px;"  disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Birth Date</span>
                                                </td>
                                                <td>
                                                    <input type="date" name="birth_date" class="form-control" value="<?php echo $userInfo[0]['birth_date']; ?>"  style="height: 30px;"  disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Last Name/Surname</span>
                                                </td>
                                                <td>
                                                    <input type="text" name="last_name" class="form-control" value="<?php echo $userInfo[0]['last_name']; ?>"  style="height: 30px;"   disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Gender</span>
                                                </td>
                                                <td>
                                                    <select name="gender" class="form-control"  style="height: 30px;"  disabled>
                                                        <option value="Male" <?php if ($userInfo[0]['gender'] == 'male') { ?> Selected =' selected' <?php } ?> >Male</option>
                                                        <option value="Female" <?php if ($userInfo[0]['gender'] == 'female') { ?> Selected =' selected' <?php } ?> >Female</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Mobile No.</span>
                                                </td>
                                                <td>
                                                    <input type="text" name="contact_no" class="form-control" value="<?php echo $userInfo[0]['contact_no']; ?>"  style="height: 30px;"   disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Telephone No.</span>
                                                </td>
                                                <td>
                                                    <input type="text" name="telephone_no" class="form-control" value="<?php echo $userInfo[0]['telephone_no']; ?>" style="height: 30px;"   disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Email</span>
                                                </td>
                                                <td>
                                                   <?php echo $userInfo[0]['email']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Fax</span> 
                                                </td>
                                                <td>

                                                    <input type="text" name="fax_no" class="form-control" value="<?php echo $userInfo[0]['fax_no']; ?>" style="height: 30px;"   disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#myModal1" style="">Change password</a>

                                                </td>
                                            </tr>

                                        </table>
                                        <table  class="profile" align="left" style="color:black">
                                            <tr>
                                                <td> </td>
                                                <td>

                                                    <button type="button" name="" class="btn btn-default  edit" style="">
                                                        <i class="icon-edit"></i> Edit 
                                                    </button>


                                                    <button type="submit" name="updateData" class="btn btn-default  submit" style="display: none">
                                                        <i class="icon-edit"></i> Update
                                                    </button>

                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-md-2"></div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--banners-->
    </div>
    </div>

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 80%;margin: 0px 0px 0px 88px;">
                <div class="modal-header"  style="color: white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">

                        <h5 style="display: none" id="error-msg">Do not match password</h5>
                        <i class="icon-edit"></i> Change Password
                    </h4>
                </div>
                <form method="post" action="#">
                    <div class="modal-body">



                        <table class="profile" align="center" style="color:black">
                            <tr>
                                <td>
                                    <span for="name" class="control-label"><b>Enter Old Password</b></span>
                                </td>
                                <td>
                                    <input type="password" name="old_pwd" class="form-control"  style="height:28px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span for="name" class="control-label"><b>Enter New Password</b></span>
                                </td>
                                <td>
                                    <input type="password" name="pwd" class="pass form-control"  style="height:28px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span for="name" class="control-label"><b> Confirm New Password</b></span>
                                </td>
                                <td>
                                    <input type="password" name="pwd1" class="con_pass form-control"  style="height:28px;">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" name="updatePass" class="btn btn-default btn-xs confirmpass" style="">
                                        <i class="icon-check"></i> Submit changes
                                    </button>

                                </td>
                            </tr>
                        </table>
                    </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php } ?>

<?php
include 'footer.php';
?>
<script>
    $(function () {
        $(".edit").click(function () {

            $("input[name='first_name']").removeAttr("disabled");
            $("input[name='middle_name']").removeAttr("disabled");
            $("input[name='last_name']").removeAttr("disabled");
            $("select[name='gender']").removeAttr("disabled");
            $("input[name='contact_no']").removeAttr("disabled");
            $("input[name='email']").removeAttr("disabled");
            $("input[name='fax_no']").removeAttr("disabled");
            $("input[name='telephone_no']").removeAttr("disabled");
            $("input[name='birth_date']").removeAttr("disabled");
            $(".submit").show();
            $(".edit").hide();

        });

    });
</script>
<script>
    $(function () {
        $('.confirmpass').click(function () {
            var pass = $('.pass').val();
            var re_pass = $('.con_pass').val();
            if (pass === re_pass) {
                return true;
            }
            else {
                $('.pass , .con_pass').css('background', 'red');
                $("#error-msg").show();
                return false;
            }
        });

    });
</script>

<script>
    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
    }
    ;</script>
