<?php
include 'header.php';
include '../producthandler/productHandler.php';
$productListArray = [];
$catobj = new CategoryHandler();
$productList = $_SESSION['cart'];
if (isset($_POST['block_email'])) {
    $email = $_POST['block_email'];
    $unsubscribereason = $_POST['unsubscribereason'];
    $query = "select nlu.email_id from nfw_news_letters_unsubscribe as nlu where nlu.email_id = '$email' ";
    $predataa1 = resultAssociate($query);
    if ($predataa1) {
        $title = "Already Un-subscribed";
        $text = "You have already un-subscribed from Nita Fashions Mailer.";
    } else {

        $query = "select au.id as id from auth_user as au 
             where au.email = '$email' ";
        $predataa = resultAssociate($query);
        if ($predataa) {
            $userid = end($predataa);
            $userid = $userid['id'];
            $unsubquery = "INSERT INTO nfw_news_letters_unsubscribe(email_id, reason, user_id) VALUES ('$email', '$unsubscribereason', '$userid');";
            resultAssociate($unsubquery);

            $unsubquery = "delete from  nfw_news_letters_frequency where user_id = '$userid';";

            resultAssociate($unsubquery);
            $title = "Successfully Un-subscribed";
            $text = "You have been successfully Un-subscribed from Nita Fashions Mailer.";
        } else {
            $title = "Email not found";
            $text = "Email not found in Nita Fashions Mailer.";
        }
    }
    ?>
    <script>

        swal({title: "<?php echo $title; ?>",
            text: "<?php echo $text; ?>",
            type: "success",
            timer: 2000,
        }, function () {
            window.location = 'index.php'
        });
    </script>
    <?php
}
?>

<style>
    .test th{
        border: none;

    }
    .test td{
        border: none;

    }
    select#selectUnsubscribeReason {
        color: #000;
        background-color: #E8E6E6;
        padding: 10px 2px 13px 15px;
    }
</style>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
    <div class="container" style="border-bottom: 2px solid red;">
        <h5 style="    font-weight: 300;margin: 30px 0px;font-size: 46px;">
            <i class="icon-mail-alt  tr_inherit"></i>  Unsubscribe from our mailing list
        </h5>
        <!--breadcrumbs-->
    </div>


</section>
<div class=" counter" style="">
    <div class="container">

        <div class=" tab-content" style="">
            <div class="" id="cusmotize_items">
                <div class="col-md-12">

                    <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">


                    <div class="col-sm-12" style="    padding-right: 0;">
                        <!-- Tab panes -->
                        <div class="">


                            <center>
                                <form id="subscribeform" method=post name="subscribeform" action="?p=unsubscribe_2" 
                                      style="line-height:26px;padding:15px;text-align:center;margin-bottom: 35px;">
                                    <div class="mailSubscribe">
                                        <strong>
                                            <input name="block_email" value="<?php echo $_REQUEST['block_email'] ?>" readonly="" style="    border: 0px solid #e1e4e6;">
                                        </strong><br />
                                        is subscribed to our mailing list. </div>
                                    <h2 style="    font-weight: 300;
                                        text-align: center;
                                        margin: 23px 0px 10px 0px;
                                        padding-bottom: 10px;
                                        color: #000;
                                        font-size: 25px;">
                                        To help us improve our services, we would be grateful if you could tell us why
                                    </h2>

                                    <div class="unsubscribeContent">
                                        <div class="selectReason" style="min-width:250px;">
                                            <select class="inputType" id="selectUnsubscribeReason" name="unsubscribereason" required="">
                                                <option value="">Please select reason</option>
                                                <option value="Your emails are not relevant to me">Your emails are not relevant to me</option>
                                                <option value="Your emails are too frequent">Your emails are too frequent</option>
                                                <option value="I don't remember signing up for this">I don't remember signing up for this</option>
                                                <option value="I no longer want to receive these emails">I no longer want to receive these emails</option>
                                                <option value="The emails are spam and should be reported">The emails are spam and should be reported</option>
                                            </select>
                                            <input class="primaryBtn btn btn-default" type=submit name="unsubscribe" value="Unsubscribe" style="background: red;color: #fff;    padding: 10px 12px 13px 15px;font-size: 15px;">  
                                        </div>
                                    </div>    

                                    <div style="text-align:center">                 

                                    </div>   
                                    </div>        
                                </form> 
                            </center>
                        </div>       
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
