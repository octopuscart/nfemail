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


    if (isset($_POST['submitPop'])) {
       //print_r($_POST);
        $test = array();
        foreach ($_POST as $key => $value) {
            $v1 = str_replace(':', ' ', $value);
            $v2 = str_replace(',', ' ', $v1);
            $test[$key] = $v1;
            $test[$key] = $v2;
        }
        //print_r($test);
        $authobj->userBillingShippingAdd($_SESSION['user_id'], $test);
        header("location: ./userAddress.php");
    }
// for change
    if (isset($_POST['submitData'])) {
        //print_r($_POST);
        $authobj->ChangeBillShip($_POST['bill_radio'], $_POST['ship_radio']);
    }
//updateAddress
## Get all addresses
    $data = $authobj->findAddress($_SESSION['user_id']);

    if (isset($_POST['updateAddress'])) {
         $test = array();
        foreach ($_POST as $key => $value) {
            $v1 = str_replace(':', ' ', $value);
            $v2 = str_replace(',', ' ', $v1);
            $test[$key] = $v1;
            $test[$key] = $v2;
        }
        $authobj->updateAddress($test);
        header('location:userAddress.php');
    }
#For delete address
    if (isset($_POST['deleteCart'])) {
        $authobj->deleteAddress($_POST['deleteCart']);
        header('location:userAddress.php');
    };
    ?>


    <style>
        .datatable th{
            border: none;
        }
        .datatable td{
            border: none;
        }
        .addr td{
            border: none;
        }
        .updateAddress td{
            border: none;
        }
        input[type="checkbox"] + label:before {
            content: '';
            font-family: "fontello";
            display: block;
            position: absolute;
            background: #F00;
            top: -8px;
            left: 0px;
            width: 22px;
            height: 23px;
            border: 2px solid #cc0000;
        }

    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Address Information</p>
            <div style="margin-top: 10px;"> </div>
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
                <div class="col-lg-9 col-md-10 col-sm-10 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12" style="margin: 0px 0px 10px -10px;">
                                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" style="margin: 0px 0px 0px 10px;">
                                    <i class="icon-plus" style="font: message-box;">&nbsp;New Address</i>
                                </button>
                            </div>
                            <div style="clear: both"></div>

                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon-edit"></i> Shipping Addresses</h3>
                                    </div>
                                    <div class="panel-body">

                                        <?php $shipdata = $authobj->getDefaultAddress('default_shipping_address', $_SESSION['user_id']); ?>
                                        <address>
                                            <strong style="text-transform: capitalize;">
                                                <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                            </strong><br>
                                            <?php echo $shipdata[0]['add1']; ?><br>
                                            <?php echo $shipdata[0]['add2']; ?><br>
                                            <?php echo $shipdata[0]['add3']; ?><br>
                                            Zip/Postal Code :  <?php echo $shipdata[0]['add5']; ?><br> 
                                            Country<span style="margin-left: 60px;">:</span><span style="margin-left: 5px;"><?php echo $shipdata[0]['add4']; ?></span><br>

                                        </address>

                                    </div>
                                </div>

                            </div>
<!--                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon-edit"></i> Billing Addresses</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php $billdata = $authobj->getDefaultAddress('default_billing_address', $_SESSION['user_id']); ?>
                                        <address>
                                            <strong style="text-transform: capitalize;">
                                                <?php echo $userInfo[0]['first_name'] . ' ' . $userInfo[0]['middle_name'] . ' ' . $userInfo[0]['last_name'] ?>
                                            </strong><br>
                                            <?php echo $billdata[0]['add1']; ?><br>
                                            <?php echo $billdata[0]['add2']; ?><br>
                                            <?php echo $billdata[0]['add3']; ?><br> 
                                            Zip/Postal Code :  <?php echo $billdata[0]['add5']; ?><br> 
                                            Country<span style="margin-left: 60px;">:</span><span style="margin-left: 5px;"><?php echo $billdata[0]['add4']; ?></span><br>

                                        </address>
                                    </div>
                                </div>

                            </div>-->

                            <div style="clear: both"></div>
                            <div class="col-md-12">
                                <form method="post" action="#">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">If you want to set other address for shipping, please select an address</h3>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table datatable">
                                                <tr style="font-size:14px">
                                                    <th>Addresses</th>
                                                    <th>Shipping Address</th>
                                                    <!--<th>Billing Address</th>-->
                                                    <th></th>
                                                    <th></th>

                                                </tr>
                                                <?php
                                                for ($i = 0; $i < count($data); $i++) {
                                                    $info = $data[$i];
                                                    ?>

                                                    <tr style="font-size:12px">
                                                        <td><?php echo $info['addr']; ?></td>

                                                        <td style='    padding: 0px 35px;
    line-height: 7px;'>
                                                            <input type="radio" id="radio_2_<?php echo $i; ?>" name="ship_radio" class="d_none" <?php if ($info['id'] == $shipdata[0]['id']) { ?> checked <?php } ?>  value="<?php echo $info['id']; ?>">
                                                            <label for="radio_2_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                        </td>
<!--                                                        <td style='    padding: 0px 35px;
    line-height: 7px;'>
                                                            <input type="radio" id="radio_1_<?php echo $i; ?>" name="bill_radio" <?php if ($info['id'] == $billdata[0]['id']) { ?> checked <?php } ?> class="d_none" value="<?php echo $info['id']; ?>">
                                                            <label for="radio_1_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                        </td>-->
                                                        <td>
                                                            <span class="data-toggle" data-placement="top" title="Edit Address">
                                                                <a href=""  data-toggle="modal" data-target="#addressEdit" id="<?php echo $info['id']; ?>"  onclick="address(this)">
                                                                    <i class="icon-edit"></i>
                                                                </a>
                                                            </span> 
                                                        </td>

                                                    <form action="#" method="post" id="target" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                                        <td  style="width:20px">
                                                            <span class="data-toggle" data-placement="top" title="Delete">
                                                                <button type="submit"  name="deleteCart" value="<?php echo $info['id']; ?> " style="margin-top:-2px;float: right" id="deleteid" >
                                                                    <i class="icon-cancel-circled-1 fs_large"></i>
                                                                </button>
                                                            </span> 
                                                        </td>
                                                    </form> 
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>

                                    </div>
                                    <button name="submitData" class="btn btn-default " value="sdf" style="margin: 0px 0px 20px 1px;font: message-box;" id="redButton" disabled>
                                        <i class="icon-check"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--banners-->
    </div>
<?php } ?>
<?php
include 'footer.php';
?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="width: 79%;margin: 0px 0px 0px 61px;">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-edit"></i> Fill Address Detail
                </p>
            </div>
            <form method ="post" action="#">
                <div class="modal-body">

                    <table class="addr">
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Address (Line 1)</b></span>
                            </td>
                            <td>
                                <input type="text" required name="address1" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Address (Line 2)</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="address2" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name" class=""><b>Town/City</b></span>

                            </td>
                            <td>
                                <input type="text" required required name="city" class="form-control" value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>State</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="state" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>


                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>Zip/Postal</b></span>
                            </td>
                            <td>
                                <input type="text" required  name="zip" class="form-control is_number"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span for="name"><b>Country</b></span>
                            </td>
                            <td>
                                <input type="text" required required name="country" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" id="checkboxs_2" name="ship" class="d_none product_checkBox" value="1">
                                <label for="checkboxs_2" class="d_inline_m m_right_10" style="margin:">Use as shipping address</label>
                            </td>
                        </tr>
<!--                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" id="checkboxs_1" name="bill" class="d_none product_checkBox" value="1">
                                <label for="checkboxs_1" class="d_inline_m m_right_10" style="margin: 8px 0px 0px 0px;">Use as billing address</label>
                            </td>
                        </tr>-->


                    </table>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-default btn-xs" name="submitPop" value="cc" style="margin: ">
                        <i class="icon-check"></i> Submit 
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Pop up for address upation -->

<div class="modal fade" id="addressEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 416px; margin: 0px 0px 0px 108px;">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-check"></i> Update Address
                </p>
            </div>
            <form method="post" action="#">
                <div class="modal-body">
                    <table class="updateAddress">
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Address (Line 1)</b></span>
                            </td>
                            <td>
                                <input type="text" required name="address1" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Address (Line 2)</b></span>
                            </td>
                            <td>
                                <input type="text" required name="address2" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Town/City</b></span>

                            </td>
                            <td>
                                <input type="text" required name="city" class="form-control" value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>State</b></span>
                            </td>
                            <td>
                                <input type="text" required name="state" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Zip/Postal</b></span>
                            </td>
                            <td>
                                <input type="text" required name="zip" class="form-control is_number"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height: 25px;">
                                <span><b>Country</b></span>
                            </td>
                            <td>
                                <input type="text" required name="country" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                    </table>



                    <input type="hidden" name="addID" value="">
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-default btn-xs" name="updateAddress" value="cfgc" style="margin: 10px 0px 0px 145px;">
                        <i class="icon-check"></i> Update
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>


    function myFunction() {
        var txt;
        var r = confirm("Do you really want to delete!");
        if (r == true) {

        }
        else {
            $('#deleteid').attr('name', 'test');

        }

    }
</script>

<script>
    $(function () {
        $(".d_none").click(function () {
            $("#redButton").removeAttr("disabled");
        });
    });
</script>

<script>

    function  address(obj) {
        var addId = obj.id

        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'addressupdation': 1, 'ids': addId},
            success: function (data) {
                // console.log(data,'dfaghs');
                var data1 = jQuery.parseJSON(data);
                $("input[name='address1']").val(data1[0]['address1']);
                $("input[name='address2']").val(data1[0]['address2']);
                $("input[name='city']").val(data1[0]['city']);
                $("input[name='state']").val(data1[0]['state']);
                $("input[name='country']").val(data1[0]['country']);
                $("input[name='zip']").val(data1[0]['zip']);
                $("input[name='addID']").val(data1[0]['id']);
                //console.log(data1[0]['address1']);

            }

        });
    }
</script>