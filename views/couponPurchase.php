<?php
include 'header.php';
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {
    $op_date_time = date('Y-m-d H:i:s');

    $userInfo = $authobj->userProfile($_SESSION['user_id']);





### card detail
    $card_detatil = $authobj->card_detail($_SESSION['user_id']);
    if (isset($_POST['submitData'])) {
        //print_r($_POST);
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime('+1 year'));
        $coupon_code = $_REQUEST['coupon_code'];
        $card_id = $_REQUEST['card_id'];
        $user_id = $_SESSION['user_id'];
        $amount = $_REQUEST['amount'];
        $_POST['user_id'] = $user_id;
        $urlrequest = urlencode(serialize($_POST));
        $urldata = array();
        foreach ($_POST as $key => $value) {
            $url = $key . "=" . $value;
            array_push($urldata, $url);
        }
        $urlpost = implode("&", $urldata);
        echo $card_id;
        if ($card_id == 'paypal') {
            header('location: paypal_process.php?payment_type=gift_order&' . $urlpost);
        } else {
            $payment_method = 'Credit Card';
            print_r($_REQUEST);
            $query = "SELECT card_holder_name,card_number,expiry_month,expiry_year,address,bank_name,cvv FROM `nfw_user_card` where id = $card_id";
            $carddata = resultAssociate($query);
            $payment_data = json_encode(end($carddata));
            mysql_query(" insert into nfw_coupon (coupon_code,value,value_type,start_date,end_date) values('$coupon_code','$amount','Fixed','$start_date','$end_date')");
            $last_id = mysql_insert_id();
            mysql_query("insert into nfw_coupon_purchase (user_id,coupon_id,payment_method, payment_data,amount,op_date_time) value('$user_id','$last_id','$payment_method','$payment_data','$amount','$op_date_time')");
            $coupon_last_id = mysql_insert_id();
            $purchase_email = $userInfo[0]['email'];
            header('location:sendMail.php?mail_type=7&email=' . $purchase_email . '&couponpurchaseid=' . $coupon_last_id);
        }
    }
    $ids = $_SESSION['user_id'];
    $data = resultAssociate("SELECT np.id,nc.coupon_code,nc.end_date,np.amount, np.payment_method, np.payment_data FROM `nfw_coupon_purchase` as np
                                               join nfw_coupon as nc on np.coupon_id = nc.id
                                               where np.id not in(select nfw_purchase_id from nfw_coupon_sendgift) and  np.user_id = $ids");
    // print_r($data);
#For delete address
    if (isset($_POST['deleteCart'])) {
        $deleteids = $_POST['deleteCart'];
        mysql_query("delete from nfw_coupon_purchase where id = $deleteids ");
        header("location:couponPurchase.php");
    }
    if (isset($_POST['submitPop'])) {
        $nfw_purchase_id = $_POST['addID'];
        $email = $_POST['email'];
        $name = $_POST['name'];

        $checkuser = resultAssociate("select id from auth_user where email = '$email'");
        if ($checkuser) {
            $checkuser11 = $checkuser[0]['id'];
            $coupon_id = resultAssociate("SELECT coupon_id FROM `nfw_coupon_purchase` where id = $nfw_purchase_id ");
            $coupon_id1 = $coupon_id[0]['coupon_id'];
            mysql_query("insert into nfw_coupon_sendgift (nfw_purchase_id,user_name,user_email,op_date_time,user_status) values('$nfw_purchase_id','$name','$email','$op_date_time','r') ");
            mysql_query("insert into nfw_coupon_sending_info (user_id,coupon_id,mail,subject,content,op_date_time) values('$checkuser11','$coupon_id1','$email','Coupon Information','','$op_date_time')");
            ///// notification 
            $message = "Congratulations!!! You have received gift<br/>Start Shoping now";
            $baselink = 'http://' . $_SERVER['SERVER_NAME'];
            $baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
            $page_link = $baselinkmain . '/views/storCredit.php';
            $query = "insert into nfw_notification_user (title,message,user_id,status,page_link) values('Gift Received','$message','$checkuser11','0','$page_link')";
            mysql_query($query);
        } else {
            mysql_query("insert into nfw_coupon_sendgift (nfw_purchase_id,user_name,user_email,op_date_time,user_status) values('$nfw_purchase_id','$name','$email','$op_date_time','ur') ");
        }

        header('location:sendMail.php?mail_type=5&email=' . $email . '&couponpurchaseid=' . $nfw_purchase_id . '&receiver_name=' . $name . '&sender_email=' . $userInfo[0]['email']);
        // header("location:couponPurchase.php");
    }
    // insert card detail
    if (isset($_REQUEST['card_submit'])) {
        // print_r($_POST);
        $authobj->cardInfoInsertion($_SESSION['user_id'], $_POST);
        header("location: couponPurchase.php");
    }
    ?>
    <style>
        .profile td{
            border:none;
        }
    </style>
    <style>
        .datatable th{
            border: none;
            border-bottom: 1px solid gainsboro;

        }
        .datatable td{
            border: none;
            border-bottom: 1px solid gainsboro;;
        }
        .updateAddress td{
            border: none;
        }
        .gift_detail td{
            padding: 0px!important;
            border: none !important;
            font-size: 10px;
        }
        .gift_detail{
            margin-bottom: 10px;
        }
        .payment_span{
            box-sizing: border-box;
            width: 100%;
            background: #CECECE;
            /* height: 20px; */
            float: left;
            color: #000000;
            padding: 6px;
            margin-bottom: 11px;
        }

    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Buy Gift Coupon</p>
            <div style="margin-top: 10px;">  </div>
        </div>
    </section>
    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-2 col-sm-2 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >
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

                            <div  align="">
                                <form method="post" action="#">
                                    <div class='col-md-12' style="" align="center">

                                        <table class="profile" align="center" style="color:black">
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Enter Amount &nbsp;&nbsp;  US$</span>
                                                </td>
                                                <td>
                                                    
                                                    <input type="text" name="amount" class="form-control is_number" value=""  style="height: 30px;width:50%;float:left;" required autocomplete="off"> 
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style=""> Valid Till</span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $temp = array_merge(range('A', 'Z'), range(0, 9));

                                                    $temp1 = "";
                                                    for ($i = 0; $i < 8; $i++) {
                                                        $temp1 .= $temp[rand(0, (count($temp) - 1))];
                                                    }
                                                    ?>
                                                    1 Year from date of purchase.
                                                    <input type="hidden" name="coupon_code" class="form-control" value="<?php echo $temp1; ?>"  style="height: 30px;width: 50%;    margin-left: 8px;"  readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span for="name" class="control-label" style="">Payment Method</span>
                                                </td>
                                                <td>
                                                    <span class="payment_span">
                                                        <i class="icon-credit-card"></i>  Credit Card
                                                    </span>
                                                    <?php
                                                    if ($card_detatil) {

                                                        for ($k = 0; $k < count($card_detatil); $k++) {
                                                            $info1 = $card_detatil[$k];
                                                            ?>
                                                            <div class="">
                                                                <input type="radio" checked id="radio_6_<?php echo $k; ?>" name="card_id" class="d_none" value="<?php echo $info1['id'] ?>">
                                                                <label for="radio_6_<?php echo $k; ?>" class="d_inline_m m_right_15 m_bottom_3 fw_light">
                                                                    <?php
                                                                    $dd = substr($info1['card_number'], -4);
                                                                    echo '************' . $dd . ' <b> Exp. month</b>' . ' ' . $info1['expiry_month'] . ' <b> Exp. year</b> ' . '  ' . $info1['expiry_year']
                                                                    ?>

                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <span style="color:red;margin-top: 17px;">CREDIT CARD DETAILS  NOT FOUND!  KINDLY ADD CREDIT CARD DETAILS <i class="icon-right-1"></i></span>
                                                        <button type="button" class="btn btn-default " data-toggle="modal" data-target="#myCardModal" id=""><i class="icon-plus"></i> Add Card Detail</button>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr> 
                                            <!--paypal option-->
<!--                                            <tr>
                                                <td></td>
                                                <td>
                                                    <span class="payment_span"> <i class="icon-paypal"></i>  PayPal</span>
                                                    <input type="radio" checked id="radio_6_paypal" name="card_id" class="d_none" value="paypal">
                                                    <label for="radio_6_paypal" class="d_inline_m m_right_15 m_bottom_3 fw_light"> Pay using PayPal Account</label>
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <td> </td>
                                                <td>
                                                    <button type="submit" name="submitData" class="btn btn-default submit" >
                                                        Pay Now
                                                    </button>

                                                </td>
                                            </tr>
                                        </table>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- ############################# -->


                    <?php
                    for ($i = 0; $i < count($data); $i++) {
                        ?>
                        <div class="col-md-3" style="">
                            <div class="thumbnail" style="height: 346px;    border: 4px solid #DDD;">
                                <img src="../assets/images/gift.jpg" alt="" style=" border-bottom: 0px;">
                                <div class="caption" style="border-top: 0px;">
                                    <h3 style="    color: #fff;
                                        background-color: #000;
                                        /* font-family: lato; */
                                        font-weight: 300;
                                        font-size: 34px;
                                        padding: 9px 0px;
                                        text-align: center;">
                                        <small style="line-height: 43px;
                                               color: #fff;
                                               font-size: 16px;">US$</small>
                                               <?php echo number_format($data[$i]['amount'], 2, '.', '') ?>
                                    </h3>
                                    <h3
                                        style="    font-size: 27px;
                                        text-align: center;
                                        border-bottom: 1px solid #000;
                                        margin-bottom: 10px;
                                        font-weight: 300;"
                                        ><?php echo $data[$i]['coupon_code'] ?></h3>
                                    <center>
                                        <p style="font-size: 11px;    margin-bottom: 10px;">

                                        <table class="gift_detail">
                                            <tr><td>Valid Till</td> <td>: <?php echo $data[$i]['end_date'] ?></td></tr>
                                            <tr><td>Purchased By</td> <td> : <?php
                                                    $dd = $data[$i]['payment_method'];
                                                    echo $dd;
                                                    ?></td></tr>
                                        </table>
                                        </p>
                                        <div style="">
                                            <a href="#" class="btn btn-default gift_id_get"  role="button" data-toggle="modal"  data-target="#givegift" gift_id ="<?php echo $data[$i]['id']; ?>"
                                               <i class="icon-gift"></i> Send Gift
                                            </a>



                                            <!--                                        <form method="post" class="pull-right">
                                            
                                                                                        <button class="btn btn-default" type="submit"  name="deleteCart" value="<?php echo $data[$i]['id']; ?> "  id="deleteid">
                                                                                            <i class="icon-trash"></i>
                                                                                        </button>
                                            
                                                                                    </form>-->


                                        </div>
                                    </center>

                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php
}
include 'footer.php';
?>
<!-- Pop up for address upation -->
<style>
    .close{
        opacity: 1;
        color: white;
    }
    .modal-header{
        padding: 3px 19px;
        background: black;
    }
</style>

<div class="modal fade" id="myCardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-edit"></i> Fill Card Detail
                </p>
            </div>
            <form class="form-horizontal" role="form" method="post" action="#">
                <div class="modal-body" style="margin-right: -36%;">


                    <fieldset>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Name on Card" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control is_number" name="card-number" id="card-number" placeholder="Credit Card Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-3" style="width:135px">
                                        <select class="form-control col-sm-3" name="expiry-month" id="expiry-month">
                                            <option>Month</option>
                                            <option value="01">Jan (01)</option>
                                            <option value="02">Feb (02)</option>
                                            <option value="03">Mar (03)</option>
                                            <option value="04">Apr (04)</option>
                                            <option value="05">May (05)</option>
                                            <option value="06">June (06)</option>
                                            <option value="07">July (07)</option>
                                            <option value="08">Aug (08)</option>
                                            <option value="09">Sep (09)</option>
                                            <option value="10">Oct (10)</option>
                                            <option value="11">Nov (11)</option>
                                            <option value="12">Dec (12)</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3" style="width:135px">
                                        <select class="form-control isNumber" name="expiry-year">
                                            <?php for ($i = 2015; $i < 2040; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Bank Name</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="bank_name" id="address" placeholder="Bank Name"   style="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Address</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address"   style="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">CVV</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control is_number" name="cvv" id="cvv" placeholder="Code"  min="3" max="3" style="width:45%" >
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-default btn-xs" name="card_submit" value="cc" style="">
                        <i class="icon-check"></i> Submit 
                    </button>


                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    table td, table th {

        border: none !important;
    }
</style>
<div class="modal fade" id="givegift">
    <div class="modal-dialog">
        <div class="modal-content" style="width:60%;margin-left: 16%;">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-pencil"></i> Enter detail of gift receiver
                </p>
            </div>
            <form method="post" action="#">
                <div class="modal-body">
                    <table class="" style=" width: 100%;">
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Recipient’s Name</b></span>

                                <input type="text" name="name"  class="form-control"  placeholder="Name" style="" autocomplete="off" required> 
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Recipient’s Email</b></span>

                                <input type="email" name="email"  class="form-control"  placeholder="Email" style="" autocomplete="off" required> 
                            </td>
                        </tr>
                    </table>

                    <input type="hidden" name="addID" value="">

                </div>

                <div class="modal-footer" style="    padding: 15px 35px;">
                    <button type="submit" class="btn btn-default btn-xs pull-left" name="submitPop" value="cfgc" style="">
                        <i class="icon-check"></i> Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function () {
        $(".gift_id_get").click(function () {
            var ids = $(this).attr('gift_id');
            $("input[name='addID']").val(ids);
        });
    });
</script>
<script>
    function myFunction() {
        var txt;
        var r = confirm("Are you sure!");
        if (r == true) {

        }
        else {
            $('#deleteid').attr('name', 'test');
        }
    }
</script>