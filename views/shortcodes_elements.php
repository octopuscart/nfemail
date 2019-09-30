<?php
include 'header.php';
$user = resultAssociate("select * from auth_user where id='" . $_SESSION['user_id'] . "'");
?>


<h5 class="color_dark fw_light m_bottom_10" style="text-align: center;margin:1% 0%;color: #1FB8C6 !important;font-weight: 500; font-size: 17px;"><?php echo $user[0]['user_name']; ?> Profile View</h5>
<form id="form_1" class="fw_light">
    <div class="row" style="padding: 0px 10%;">
        <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_10 m_xs_bottom_0">
            <!--        <form id="form_1" class="fw_light">-->
            <ul>
                <li class="m_bottom_15 m_xs_bottom_15">
                    <label for="input_1" class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $user[0]['first_name']; ?>" id="input_1" class="r_corners d_inline_m w_sm_full">
                </li>
                <li class="m_bottom_15 m_xs_bottom_15">
                    <label for="input_1" class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Email:</label>
                    <input type="text" name="email" value="<?php echo $user[0]['email']; ?>" id="input_1" class="r_corners d_inline_m w_sm_full">
                </li>
            </ul>
            <!--</form>-->
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_10 m_xs_bottom_30">
            <!--<form id="form_1" class="fw_light">-->
            <ul >
                <li class="m_bottom_15 m_xs_bottom_15">
                    <label for="input_1" class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $user[0]['last_name']; ?>" id="input_1" class="r_corners d_inline_m w_sm_full">
                </li>
            </ul>
            <!--</form>-->
        </div>
        <div style="clear:both"></div>
        <center><button name="edit" class="button_type_3 d_inline_b color_purple r_corners tr_all fw_light">Edit Profile</button></center>
    </div>
</form>
<?php include 'footer.php'; ?>