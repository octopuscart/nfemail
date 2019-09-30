<?php
include 'header.php';
include '../producthandler/productHandler.php';
?>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Payment Cancelled </h3>
        <p style="color:black;margin-top: 10px;">Your payment was cancelled.</p>
        <div style="margin-top: 10px;">  </div>
    </div>
</section>

<div class="section_offset counter" style="">
    <div class="container">
        <center>
            <a class="" href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=<?php echo $_REQUEST['token'] ?>">
               Retry Now  <i class="icon-right"> </i> 
            </a>
            <br/>
            Or 
            <br/>
            <a class="" href="./shippingCart.php">
                <i class="icon-left"> </i> Back to order review page.
            </a>
            
        </center>
    </div>
</div>

<?php
include 'footer.php'
?>