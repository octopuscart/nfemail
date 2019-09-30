<?php
#ini_set("display_errors", "1");
#error_reporting(E_ALL);
include 'layout/header.php';
include 'mailHandler/mailhandling.php';
$mails = new MailHandling();

if (isset($_POST['submit'])) {
   //$mails->orderConfirmMail($_POST);
   header('location: paypal_process.php?payment_type=user_order');

}
?>
<style>
    .register-req {
        font-size: 14px;
        font-weight: 300;
        padding: 15px 20px;
        margin-top: -61px !important;
    }
    .form-one input{
        background: #F0F0E9;
        border: 0 none;
        margin-bottom: 10px;
        padding: 10px;
        width: 100%;
        font-weight: 300;
    }
    .form-one {

        width: 100% !important;
    }

    .cart_price{

    }
</style>
<section id="advertisement">
    <div class="container">
<!--			<img src="images/shop/advertisement.jpg" alt="" />-->
    </div>
</section>
<?php
//print_r($_SESSION['userdata']);
?>
<section>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->


            <div class="shopper-informations">
                <div class="row">

                    <div class=" clearfix">
                        <div class="bill-to col-sm-12">
                            <p>Ship To</p>
                            <div class="form-one">
                                <form method="post" >

                                    <div class="col-md-6">

                                        <input type="text" name="first_name" placeholder="First Name *" required>
                                        <input type="text" name="middle_name"  placeholder="Middle Name" >
                                        <input type="text" name="last_name" placeholder="Last Name *" required>
                                        <input type="text" name="address1" placeholder="Address 1 *" required>
                                        <input type="text" name="address2" placeholder="Address 2" required>
                                        <input type="text"  name ="city" placeholder="City *" required>
                                        <input type="text" name ="zip" placeholder="Zip / Postal Code *" required>
                                        <input type="text"  name ="country" placeholder="Country *" required>

                                        <button name="submit" type="submit" class="btn btn-primary btn-sm" >Confirm Now</button>

                                    </div>
                                    <div class="col-md-6">

                                        <input type="email" name="email" placeholder="Email*" required>
                                        <input type="text"  name ="mobile" placeholder="Mobile Phone" >

                                        <input type="text"  name ="phone" placeholder="Phone *">

                                        <input type="text"  name ="fax" placeholder="Fax">
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info"  ng-app="NSFF" ng-controller="CheckoutController" >
                <?php if ($_SESSION['alldata']) { ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image" style="width: 15%">Item</td>
                                <td class="description" style="width:20%"></td>
                                <td class="description" style="width:30%">Style</td>
                                <td class="price" style="width:10%">Price</td>
                                <td class="quantity" style="width:10%">Quantity</td>
                                <td class="total" style="width:15%;float">Total</td>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $data = $_SESSION['alldata'];
//print_r($data);
                            $sum = 0;
                            foreach ($data as $key => $value) {
                                if (isset($value['style'])) {
                                    //print_r($key);
                                    ?>
                                    <tr>
                                        <td class="cart_product" style=''>
                                            <a href=""><img src="<?php echo $value['image']; ?>" alt="" height="80px" width="100px"></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""><?php echo $value['title']; ?></a></h4>
                                            <p><?php echo $value['customized']; ?></p>

                                        </td>
                                        <td>
                                            <table style='width: 90%'>
                                                <tr>
                                                    <th class='' style='width: 150px'>Style</th>
                                                    <td>:<?php echo $value['style']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class=''>Measurement</th>
                                                    <td>:<?php echo $value['measurement']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button class='btn btn-default btn-xs' ng-click="customDetail('<?php echo $value['title']; ?>', '<?php echo $value['customized']; ?>', '<?php echo $key; ?>')"  style='width: 100%' data-toggle="modal" data-target=".style-modal" >
                                                            <i class='fa fa-search-plus'></i>    View Style
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td class="cart_price">
                                            <p><?php echo '$' . number_format($value['price'], 2, '.', ''); ?></p>
                                        </td>
                                        <td class="">
                                            <p class="cart_price">

                                                <?php echo $value['quantity']; ?>

                                            </p>
                                        </td>
                                        <td class="cart_price">
                                            <p class="">
                                                <?php
                                                $total = $value['price'] * $value['quantity'];
                                                echo '$' . number_format($total, 2, '.', '');
                                                ?>
                                            </p>
                                        </td>

                                    </tr>
                                    <?php
                                    $sum += $total;
                                }
                            }
                            ?>





                            <tr class='cart_price'>
                                <td class='text-right' colspan="5" >
                                    <p>Sub Total</p>
                                </td>
                                <td ><p>:<?php echo '$' . number_format($sum, 2, '.', ''); ?></p></td>
                            </tr>

                            <tr class="cart_price">
                                <td class='text-right' colspan="5" >
                                    <p> Shipping Cost </p>
                                </td>
                                <td>
                                    <p>: $00.00 </p>
                                </td>										
                            </tr>
                            <tr class="cart_price">
                                <td class='text-right' colspan="5" >
                                    <p style='    font-size: 26px;'> Total </p>
                                </td>
                                <td>
                                    <p style='    font-size: 26px;'>

                                        : <?php echo '$' . number_format($sum, 2, '.', ''); ?>

                                    </p>

                                </td>
                            </tr>
                     </tbody>
                    </table>

                <?php } else { ?> 
                    <center><h4>Data Not Found</h4></center>

                <?php } ?>
                <div class="modal fade style-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{customfor}} <small>{{customforitem}}</small></h4>
                            </div>
                            <div class="modal-body">
                                <div class='col-md-12'>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="background: #4169E1">
                                            <span>Style</span>
                                        </div>
                                        <div class="panel-body">


                                            <div ng-if="selectedCustomStyle === 'Custom Design'">
                                                <table class="summary">
                                                    <tr ng-repeat="(k1, v1) in selecteElement">
                                                        <td style='width: 300px'>{{k1}}</td>
                                                        <td>{{v1.title}} </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div ng-if="(selectedCustomStyle != 'Please Select Style') && (selectedCustomStyle != 'Custom Design')">
                                                <h1 style='font-weight: 300'>

                                                    {{selectedCustomStyle}}  <small>Catalogue</small>

                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="background: #4169E1">
                                            <span>Measurement</span>
                                        </div>
                                        <div class="panel-body">


                                            <div ng-if="selectedMeasurementStyle === 'New Measurement'">

                                                <table class="summary">
                                                    <tr ng-repeat="(k2, v2) in measurementdict">
                                                        <td style='width: 300px'>{{k2}}</td>
                                                        <td>{{v2.incval}} {{v2.frcval}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div ng-if="selectedMeasurementStyle === 'Shop Stored'">
                                                <h1 style='font-weight: 300'>
                                                    Shop Stored

                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style='clear: both'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->



    <?php
    include 'layout/footer.php';
    ?>
 