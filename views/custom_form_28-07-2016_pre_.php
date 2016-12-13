<?php
include 'header.php';
include '../producthandler/productHandler.php';
include './custom_form_view/custom_form_support.php';
# 
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
#
    $cartprd = new CartHandler();
    $cartTags = $cartprd->userTag(1);
    $productArray = $_REQUEST['product_array'];
    $productArray = explode(",", $productArray);
    $custom_form = $_REQUEST['custom_form'];
    $style_data = $authobj->findStyleId($_REQUEST['tag_id'], $_SESSION['user_id']);
    $pre_measurement = $authobj->userMeasurment($_REQUEST['tag_id'], $_SESSION['user_id']);

    $tag_id = $_REQUEST['tag_id'];
    $query = "SELECT tag_title, custom_form_json, extra_price, measurement_list,posture_list FROM  nfw_product_tag where id = $tag_id";
    $tag_titleArray = resultAssociate($query);
    $tag_titleArray = $tag_titleArray[0];
    $tag_title = $tag_titleArray['tag_title'];
    $tag_form_data = $tag_titleArray['custom_form_json'];
    $extra_price_check = $tag_titleArray['extra_price'];

    $measurement_conf = $tag_titleArray['measurement_list'];
    $measurement_conf = explode(',', $measurement_conf);
    $measurement_list = array();
    foreach ($measurement_conf as $key => $value) {
        array_push($measurement_list, $value);
    }

    $posture_conf = $tag_titleArray['posture_list'];
    $posture_conf = explode(',', $posture_conf);
    $posture_list = array();
    foreach ($posture_conf as $key => $value) {
        array_push($posture_list, $value);
    }
    ?>


    <?php
    $cartIdMap = array();
    for ($i = 0; $i < count($productArray); $i++) {
        $productInfo = $cartprd->cartProductsInformation($productArray[$i], $_SESSION['user_id']);
        $cartIdMap["cart_" . $productArray[$i]] = $productInfo['title'];
    }
    ?>

    <script>
        var cartIdMap = <?php echo json_encode($cartIdMap); ?>;
        var custom_form = "<?php echo $tag_id; ?>";

        var shop_data = <?php echo json_encode($shop_data_array); ?>;
    </script>



    <script>
    <?php
    $styleElement = phpjsonstyle($tag_form_data, 'php');
    ?>

        var header_mapping = {};

        var productStyleArray = {
    <?php
    for ($i = 0; $i < count($productArray); $i++) {
        echo '"cart_' . $productArray[$i] . '"';
        echo ": {";
        foreach ($styleElement as $key => $value) {
            echo "'$key':'',";
        }
        echo "},";
    }
    ?>
        };

        productStyleArrayPrice = {
    <?php
    for ($i = 0; $i < count($productArray); $i++) {
        echo '"cart_' . $productArray[$i] . '"';
        echo ": {";
        foreach ($styleElement as $key => $value) {
            echo "'$key':'',";
        }
        echo "},";
    }
    ?>
        };

    </script>






    <!--font awesome icons--> 
    <link href="./custom_form_view/static/font-awesome/4.3/css/font-awesome.min.css" rel="stylesheet">


    <!--vertical tabs-->
    <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet">


    <!--animate css-->
    <link rel="stylesheet" href="./custom_form_view/static/animate/animate.min.css" />


    <link href="./custom_form_view/static/slider/powerange.css" rel="stylesheet">
    <script src="./custom_form_view/static/slider/powerange.min.js"></script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./custom_form_view/static/jquery/1.11.3/jquery.min.js"></script>


    <!--page editor plugin-->
    <link href="./custom_form_view/static/summernote/summernote.css" rel="stylesheet">
    <script src="./custom_form_view/static/summernote/summernote.js"></script>


    <!--custom form support css and js-->
    <link href="./custom_form_view/static/custmo_js_css/customform.css" rel="stylesheet">


    <style>
        .tabs-left, .tabs-right {
            border-bottom: none;
            padding-top: 28px;
        }

        .classified_li{
            border: 4px solid #000;
            height: 34px;
            border-bottom: 0px;
            border-right: 0;
            margin-top: 24px;
            margin-left: -15px;
            margin-bottom: 10px !important;
        }
        .classified_li h2{
            margin-left: 5px;
            font-weight: 400;
            font: 300 32px/0.9em "Lato","sans-serif";
            color: #000;

        }
        .classified_li a{

            border-radius: 0px!important;
            margin-left: -4px;
            color: #000;
        }

        .classified_li a {

            border-radius: 0px!important;
            margin-left: -4px;

        }

        .classified_li a:hover{


            border-bottom: 0px;
            border-right: 0;
        }

        .classified_li:hover{


            border-bottom: 0px;
            border-right: 0;
        }
        .switch_me{
            padding:0px!important;
        }

        .previous_style_measurement{
            font-weight: 600;
            color: #F00;
            cursor: pointer;
        }
        .previous_style_measurement:hover{
            font-size: 17px;
        }


        .prestyleclass{
            width: 220px;
            float: left;
            overflow: auto;
        }

        input[type="radio"] + label:after, input[type="radio"] + label:before {
            content: "";
            display: block;
            position: absolute;
            background: #F10000;
            top: 0;
            left: 0;
            width: 26px;
            height: 26px;
            border: 2px solid #777474;
        }

        input[type="radio"] + label:after {
            display: none;
            border: none;
            background: #FFFFFF;
            width: 10px;
            height: 10px;
            left: 8px;
            top: 8px;
        }



        .no_item_found{
            background: url(https://www.trainingjournal.com/sites/www.trainingjournal.com/files/styles/original_-_local_copy/entityshare/3292%3Fitok%3Dm3ygksTZ);
            background-size: cover;
        }
        .no_item_found b{
            color: #B90000;
            font-weight: 400!important;
        }

        .pre_profiles  th {
            padding: 3px 14px;
            border: 1px solid #bdc3c7;
            font-weight: 400;
            color: #000;
            font-size: 14px;
        }
        .pre_profiles  td {
            padding: 3px 14px;
            border: 1px solid #bdc3c7;
            font-weight: 400;
            color: #000;
            font-size: 14px;
        }

        .alert {
            padding: 5px 10px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            color: #FFFFFF;
            background-color: #FF0101;
            border-color: #FF012A;
        }


        .or_selector{
            border: 1px solid #000;
            display: block;
            margin:20px 0px;
        }

        .selecte_style_options{
            /* padding: 0px 10px; */
            background-color: #E8E6E6;
            box-shadow: 4px 4px 5px -4px #000;
        }
        .selecte_style_options1{
            /* padding: 0px 10px; */
            background-color: #fff;
            box-shadow: 4px 4px 5px -4px #000;
        }
        .card_text{
            padding: 0px 19px 10px;
            font-size: 14px;
            color: #000;
            font-weight: 400;
        }

        .fa-inverse {
            color: #000;
                margin-top: -1px;
    margin-left: 1px;
        }
    </style>



    <?php
    include 'custom_form_view/custom_elements/custom_element_creator.php';
    ?> 



    <!-- Modal -->




    <?php
    $count = 0;
    foreach ($cartIdMap as $key => $value) {
        $count++;
        ?>

        <div class="modal fade error_model" cartpointer ="<?php echo $key; ?>" id="error_model<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php
                            echo $value;
                            echo " - ";
                            echo$count;
                            ?>
                            <br>
                            <span class="error_heading"></span></h4>
                    </div>
                    <div class="modal-body errors_check" >
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style=" 
             color: #000000;
             background-color: #FFFFFF;
             letter-spacing: .05em;

             padding: 18px;

             ">
        <div class="container" style="font-size: 30px;line-height: 28px;
             font-weight: 300;">
            <a href='shopAllCart.php'>
                <span style="        font-size: 13px;
                      font-weight: 500;
                      margin-left: -83px;
                      float: left;
                      /* text-decoration: overline; */
                      /* border: 1px solid #000; */
                      padding: 0px 10px;
                      border-radius: 6px;
                      background-color: #F1F1F1;">&larr; Back to Customization Cart</span>
            </a>
            <span style="    margin-left: -83px;">
                <span class="circle icon_wrap_size_2 d_inline_m m_right_8" style='    margin-top: -7px;'> 
                    <i class="icon-tools"></i>
                </span>
                <?php
                echo $tag_title;
                ?>
                Designer
            </span>
        </div>
    </section>

    <div class="section_offset counter " style="margin-top: -54px;">
        <div class=" " style="width: 100%;padding: 0px 20px;">
            <!-- Nav tabs -->
            <ul class="main_custom_tab nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                        <span class='countNumber'>1</span>  Selected Fabric</a>
                </li>
                <li role="presentation">
                    <a href="#custom_style_designer" aria-controls="custom_style_designer" role="tab" data-toggle="tab">
                        <span class='countNumber'>2</span>  Customize Style</a>
                </li>

                <li role="presentation">
                    <a href="#measurment" aria-controls="measurment" role="tab" data-toggle="tab">
                        <span class='countNumber'>3</span> Add Measurement</a>
                </li>

                <li role="presentation">
                    <a href="#confirm_order" aria-controls="confirm_order" role="tab" data-toggle="tab">
                        <span class='countNumber'>4</span> Confirm Order</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in fabric_preview active" id="home" style="padding-top: 10px">
                    <div class="col-md-7">

                        <h3
                            style="
                            font-weight: 200;
                            line-height: 100px;
                            margin-bottom: 32px;
                            font-size: 63px;
                            text-align: center;

                            "
                            >Design  Your <br/>

                            <span
                                style="font-size: 115px;
                                font-weight: 200;
                                /* margin-top: -3px; */
                                /* padding-top: 20px; */
                                color: rgb(0, 0, 0);
                                text-shadow: 1px -1px 0 #909090, -1px 2px 1px rgba(66, 66, 66, 0.74), -2px 4px 1px rgba(118, 116, 116, 0.77), -3px 6px 1px rgba(120, 119, 119, 0.64), -4px 8px 1px rgba(128, 128, 128, 0.57), -5px 10px 1px rgba(127, 125, 125, 0.46);"
                                >
                                    <?php
                                    echo $tag_title;
                                    ?>
                            </span> 

                        </h3>

                        <center>
                            <button class="btn btn-danger" id='start_customization' style="background:black;border-color: black" 
                                    >Go for Design &rarr;
                            </button>
                        </center>

                        <div class="row" style="margin-top:30px">
                            <?php
                            for ($i = 0; $i < count($productArray); $i++) {
                                $productInfo = $cartprd->cartProductsInformation($productArray[$i], $_SESSION['user_id']);
                                ?> 

                                <div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img src="<?php echo $productInfo['image']; ?>" alt="" >
                                        <div class="caption">
                                            <h5 style="margin:0;font-size: 15px" data-title='FEBFONRT'><?php echo $productInfo['title']; ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="" style="min-height:450px;height:100%;background: url(custom_form_view/background_new_custom/<?php echo $_REQUEST['tag_id']; ?>.jpg);    background-position-y: -157px;">

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane custmo_form_setup custom_form_style" id="custom_style_designer" style="padding-top:10px">

                    <div class="col-md-12 style_creation animated" style="padding: 0px">


                        <div class="col-md-2" style="    border-right: 1px solid #000;">
                            <p>
                                Selected Fabrics 
                            </p>
                            <div class="row selecte_fabric_block">
                                <?php
                                for ($i = 0; $i < count($productArray); $i++) {
                                    $productInfo = $cartprd->cartProductsInformation($productArray[$i], $_SESSION['user_id']);
                                    ?> 

                                    <div class="col-sm-12 prestylefabricchekced animated" style="

                                         -webkit-animation-duration: 0.5s;
                                         ">
                                        <div class="thumbnail" style="background: url(<?php echo $productInfo['image']; ?>);background-size: cover">
                                            <img src="" alt="" style="height: 50px;width:100%">
                                            <div class="caption">
                                                <input type="checkbox" id="radio_fabric_<?php echo $productInfo['cart_product_id']; ?>" name="" class="d_none pre_style_check" value="cart_<?php echo $productInfo['cart_product_id']; ?>">
                                                <label data-title='SKU' for="radio_fabric_<?php echo $productInfo['cart_product_id']; ?>" class="d_inline_m m_right_10" style="   width: 100%!important;text-align: left;">
                                                    <?php echo $productInfo['title']; ?> 
                                                </label>
                                                <p style="text-align: left" >
                                                    Style Id : </br><span class="pre_style">Not Selected</span>
                                                    <span class="remove_style_id" style="float: right;display:none"  product_select="cart_<?php echo $productInfo['cart_product_id']; ?>">
                                                        <i class="fa fa-times-circle-o" style='    margin: 4px;'></i>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="selecte_style_options">
                                <p
                                    style="font-size: 18px;
                                    /* margin-top: -2px; */
                                    font-weight: 300;
                                    color: #000;
                                    margin-bottom: 6px;
                                    padding: 5px 10px 10px;
                                    background-color: #fff;
                                    border: 1px solid #E8E6E6;"
                                    >
                                    <input type="radio" id="shop_style" class="shop_style d_none" name="ship_radio">
                                    <label for="shop_style" class="d_inline_m m_right_10" style="font-size: 22px;">Shop Stored</label>
                                </p>
                                <p class="card_text">
                                    If you purchased from us before, we have stored your old recent/current STYLE to get best accuracy.
                                </p>
                                <small style="    padding:9px;
                                       float: left;
                                       width: 100%;"></small>
                            </div>
                            <div class="selecte_style_options" style="margin-top:15px">
                                <p
                                    style="font-size: 18px;
                                    /* margin-top: -2px; */
                                    font-weight: 300;
                                    color: #000;
                                    margin-bottom: 6px;
                                    padding: 5px 10px 10px;
                                    background-color: #fff;
                                    border: 1px solid #E8E6E6;"
                                    >
                                    <input type="radio"  class="createstyle_style d_none" name="ship_radio" id="create_new_style">
                                    <label for="create_new_style" class="d_inline_m m_right_10" style="font-size: 22px;">Create New Customize Style?</label>
                                </p>
                                <p class="card_text">
                                    Here you can create new style as per your selection in style section, 
                                    <br/> Help:- How to choose new style. 
                                </p>
                                <small style="    padding:9px;
                                       float: left;
                                       width: 100%;"></small>
                            </div>


                            <div class="selecte_style_options" style="margin-top:15px">
                                <p
                                    style="font-size: 18px;
                                    /* margin-top: -2px; */
                                    font-weight: 300;
                                    color: #000;
                                    margin-bottom: 6px;
                                    padding: 5px 10px 10px;
                                    background-color: #fff;
                                    border: 1px solid #E8E6E6;"
                                    >
                                    Choose From Below Preferred Styles.
                                </p>
                                <p class="card_text">
                                    After choosing preferred style, please select left hand side fabric icons.
                                </p>
                                <?php
                                if (count($style_data)) {
                                    ?>
                                    <div class="accordion" style="margin-top: -6px;padding: 0 10px;padding-bottom: 10px;">
                                        <?php
                                        $count = 0;
                                        foreach ($style_data as $key => $value) {
                                            $style_obj = phpjsonstyle($value['custom_form_data'], 'php');
                                            $price_id = $value['id'];
                                            $price_query = "select custom_form_data_price, total_price from nfw_custom_form_data_price where nfw_custom_form_data_id = '$price_id'";
                                            $price_data = resultAssociate($price_query);
                                            $price_array = $price_data[0]['custom_form_data_price'];
                                            $total_price = $price_data[0]['total_price'];
                                            $price_obj = phpjsonstyle($price_array, 'php');
                                            ?>

                                            <dl class=" custom_measurement accordion_item r_corners wrapper m_bottom_5 tr_all <?php echo $count == 0 ? 'active' : ''; ?>" style="background-color: white;margin-top: 13px;    border: 1px solid #fff;">
                                                <dt class="accordion_link relative tr_all color_scheme" style="padding: 9px 19px 10px 19px;
                                                    cursor: pointer;    height: 44px;">
                                                <div>
                                                    <div>

                                                        <input type="radio" id="radio_2_<?php echo $value['style_profile']; ?>" name="ship_radio" class="d_none style_pre" value="<?php echo $value['style_profile']; ?>">
                                                        <label for="radio_2_<?php echo $value['style_profile']; ?>" class="d_inline_m m_right_10" style="">
                                                            <?php echo $value['style_profile']; ?>

                                                        </label>
                                                        <span style="    float: right;
                                                              margin-top: -5px;
                                                              font-size: 11px;"> 
                                                              <?php echo $value['datetime'] ?>
                                                            <br/>
                                                            <small style="    font-size: 15px;">Total Extra Price : <span style="    width: 30px;
                                                                                                                          float: right;
                                                                                                                          text-align: left;
                                                                                                                          padding-left: 5px;"><?php echo $total_price; ?></span></small>
                                                        </span>
                                                    </div>


                                                </div>

                                                </dt>
                                                <dd class="fw_light color_dark" style="display: block;color:balck;padding: 10px;">
                                                    <div class='col-md-12 ' style="padding: 0px;">
                                                        <table class="table-bordered pre_profiles" style="width: 100%;margin-bottom: 10px">
                                                            <?php
                                                            foreach ($style_obj as $key1 => $value1) {
                                                                $pco = $price_obj[$key1];

                                                                echo "<tr class='pre_style_checked_obj' ><th style='width:50%' orgstyle='" . $key1 . "'>" . $key1 . "</th><td style=width:50%><span class='prestyleclass'>", $value1, "</span></td><th>$pco</th</tr>";
                                                            }
                                                            echo "<tr class='' ><th colspan=2 style='text-align:right'>Total Extra Price</th><th>$total_price</th</tr>";
                                                            ?>
                                                        </table>
                                                    </div>
                                                </dd>
                                            </dl>


                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>

                                    <div >
                                        <h3
                                            style="font-weight: 300;
                                            margin-top: 66px; "
                                            >No Previous Style Found. </h3>

                                    </div>

                                    <?php
                                }
                                ?>


                            </div>


                        </div>

                        <div class="col-md-2" > 

                            <div class="row selected_prestyle" style="">


                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="" style="min-height:450px;background: url(custom_form_view/background_new_custom/<?php echo $_REQUEST['tag_id']; ?>.jpg);      min-height: 450px;
                                 height: 600px;

                                 /* background-position-y: -157px; */
                                 background-size: cover;
                                 background-repeat: no-repeat;
                                 background-position-x: -74px;">

                            </div>
                        </div>

                        <div style="height:40px;clear: both">
                            <nav style="padding: 2px 20px;
                                 /* background: #EEE; */
                                 border-top: 1px solid #000;
                                 z-index: 999;
                                 position: absolute;
                                 width: 100%;">



                                <ul class="pager" style="  margin: 3px 0;">
                                    <li class="previous previousStyle">
                                        <a href="javascript:void(0)" style="background: #000;
                                           color: #fff;">
                                            <span aria-hidden="true">&larr;</span> Previous 
                                        </a>
                                    </li>
                                    <li class="next nextStyle">
                                        <a href="javascript:void(0)" style="background: #000;
                                           color: #fff;">
                                            Next <span aria-hidden="true">&rarr;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                    <div class="modal fade" id="tutorial" tabindex="-1" role="dialog" aria-labelledby="tutorial">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Brief Tutorial</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="bs-example" data-example-id="responsive-embed-16by9-iframe-youtube"> <div class="embed-responsive embed-responsive-16by9"> <iframe id="tutorial_video" class="embed-responsive-item" src=""></iframe> </div> </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
        $(function () {
            $('#tutorial').on('show.bs.modal', function (event) {
                $("#tutorial_video").attr("src", "https://www.youtube.com/embed/3Cbza8uTgyc?autoplay=1&rel=0");
            })
            $('#tutorial').on('hide.bs.modal', function (event) {
                $("#tutorial_video").attr("src", "");
            })
        })
                    </script>


                    <div class="com-md-12 create_new_style animated" style="padding: 0px;display: none;">
                        <p
                            style="margin-bottom: 10px;
                            border-bottom: 2px solid #000;
                            margin-top: -10px;
                            padding-bottom: 10px;
                            padding-top: 10px;"

                            >
                            If you want choose style from your previous styles then <span id="previous_style" class="previous_style_measurement" style="">Click Here </span>
                            <span style="    margin-left: 100px;">
                                <i class="icon-zoom-in"></i>  For zoom double click on image.
                            </span>

                            <button data-toggle="modal" data-target="#tutorial" class="btn btn-danger pull-right" style="margin-top: -5px;background: #E62117;"><i class="fa fa-youtube-play" style="    line-height: 20px;"></i> Show Brief Tutorial</button>
                        </p>
                        <div class="col-sm-9" style="    padding-right: 0px;    width: 72%;">
                            <?php
                            include "./custom_form_view/" . $custom_form . ".php";
                            ?>
                        </div>


                        <div class="col-sm-3" id="containerBox" style=" width: 28%;padding:0px;">
                            <div class="panel panel-default" style="border-color: #000;">
                                <div class="panel-heading" style="    height: 55px;    background-image: linear-gradient(to bottom,#000 0,#000 100%)!important;">
                                    <div id="productImagesTemplate" class="">

                                        <h3 class="panel-title" style="margin-top: -1px;">
                                            <div class="col-md-2" style="padding: 2px;">
                                                <input type="checkbox" id="checkboxs_all" name="" value="1"  class="d_none check_icon check_icon_all" >
                                                <label for="checkboxs_all" class="d_inline_m m_right_10 lableall"></label>
                                                <span class="select_all_label">Select All</span>
                                            </div> 
                                            <div class="col-md-10" style="text-align: center;
                                                 padding: 0px 18px;;
                                                 margin-left: -10px;">
                                                <span id="style_heading"></span>
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 0px;">
                                    <div class='' style="max-height: 400px;margin-top: 10px;overflow-y: auto;padding-left: 3px;border-bottom: 1px solid #000;"> 
                                        <?php
                                        for ($i = 0; $i < count($productArray); $i++) {
                                            $productInfo = $cartprd->cartProductsInformation($productArray[$i], $_SESSION['user_id']);
                                            ?>
                                            <div class="col-md-12" style="padding:0px 5px 0px 10px">
                                                <span class=""  style='
                                                      margin-top: 12px;
                                                      position: absolute;
                                                      margin-left: -9px;
                                                      /* font-size: 25px; */
                                                      font-weight: 300;
                                                      '>
                                                    <input type="checkbox" target_product="cart_<?php echo $productArray[$i]; ?>" id="checkboxs_<?php echo $i; ?>" name="" class="d_none check_icon product_check"   value="1">
                                                    <label for="checkboxs_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                <!--<i class='icon-circle-arrow-down' ></i>-->   
                                                </span>
                                                <div class="accordion toggle" style='  margin-left: 21px;'>

                                                    <dl class="accordion_item r_corners wrapper m_bottom_5 tr_all" style='    padding: padding: 16px 0px 17px;background: url(<?php echo $productInfo['image']; ?>);    background-repeat: no-repeat;background-size: 77px 77px;'>
                                                        <dt class="accordion_link relative color_dark tr_all" style='padding: 0px;'>
                                                        <div class="fabrics" style="padding: 5px;  width: 88px;">
                                                            <label class="cartTitle"><?php // echo $productInfo['title'];                                                                                                                                                         ?></label>
                                                        </div>
                                                        <span class="icon_wrap_size_1 circle d_block show">
                                                            <i class="icon-minus"></i>
                                                        </span>

                                                        <span class="icon_wrap_size_1 circle d_block show">
                                                            <i class="icon-plus"></i>
                                                        </span>


                                                        <small data-title='SKU' style="
                                                               width: 134px;
                                                               height: 58px;
                                                               position: absolute;
                                                               margin-top: -78px;
                                                               font-size: 11px;
                                                               margin-left: 85px;
                                                               color: #000;
                                                               /* text-shadow: 0px 1px 5px #000; */
                                                               /* font-weight: bold; */
                                                               ">
                                                                   <?php echo $productInfo['title']; ?>
                                                        </small>
                                                        <div class="selectedTitle" style="
                                                             width: 208px;
                                                             height: 58px;
                                                             position: absolute;
                                                             margin-top: -62px;
                                                             font-size: 17px;
                                                             margin-left: 85px;
                                                             color: #000;
                                                             /* text-shadow: 0px 1px 5px #000; */
                                                             /*font-weight: bold;*/
                                                             border-top: 1px solid rgba(0, 0, 0, 0.22);
                                                             "></div> 
                                                        <small class="fabric_box_pre_style" style="
                                                               width: 173px;
                                                               height: 58px;
                                                               position: absolute;
                                                               margin-top: -79px;
                                                               font-size: 13px;
                                                               margin-left: 147px;
                                                               color: #000;
                                                               font-weight: 600;
                                                               "></small>
                                                        </dt>
                                                        <dd class="fw_light color_dark" style='padding: 0px 5px 5px 5px;margin-top: 0px;display: block;'>
                                                            <ul class="list-group" style='padding: 5px 2px 0px 0px; margin-bottom: 0px;'>
                                                                <table class="brif_summary">
                                                                    <?php
                                                                    foreach ($styleElement as $key1 => $value1) {
                                                                        ?>
                                                                        <tr>
                                                                            <th>
                                                                                <?php echo $key1; ?>
                                                                            </th>
                                                                            <th parent="cart_<?php echo $productArray[$i]; ?>" styleselect="<?php echo $key1; ?>">

                                                                            </th>
                                                                        </tr>

                                                                    <?php }
                                                                    ?>
                                                                </table>
                                                                <button class="btn btn-default btn-xs removefabric" target_product="cart_<?php echo $productArray[$i]; ?>" style="  margin-top: 5px;">
                                                                    <i class="icon-cancel  tr_all translucent circle t_align_c" style="opacity:1"></i> Remove
                                                                </button>    
                                                            </ul>
                                                        </dd>
                                                    </dl>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12 " style="padding: 5px;">
                                        <a class="btn btn-default btn-xs checkAllStyle" onclick="pullFabricBox()"
                                           href="#summary" aria-controls="summary" role="tab" data-toggle="tab"
                                           style="background: #000;color: #fff;">
                                            <i class="fa fa-list-ol" style="    line-height: 18px;"></i> Check Summary
                                        </a>

                                        <div class="btn-group btn-group-xs pull-right " role="group" aria-label="..." >
                                            <button type="button" class="btn btn-default  previous previousStyle" style="background: #000;
                                                    color: #fff;">
                                                <span aria-hidden="true">&larr;</span> Previous 
                                            </button>
                                            <button type="button" class="btn btn-default next nextStyle" style="background: #000;
                                                    color: #fff;">
                                                Next <span aria-hidden="true">&rarr;</span>
                                            </button>
                                        </div>

                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div role="tabpanel" class="tab-pane pantStyle" id="measurment" style="padding-top: 20px">
                    <div class="col-sm-12 pantSetup" style="    padding-right: 0px; ">
                        <?php include './custom_form_view/measurement.php'; ?>

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane " id="confirm_order" style="padding-top: 20px">

                    <div class="col-md-12" style="    margin-bottom: 20px;">
                        <div class="error_block">
                            <div class='col-md-6'>
                                <div class="panel panel-danger">
                                    <div class="panel-heading cus_error">
                                        <h3 class="panel-title"> Error In Customization</h3>
                                    </div>
                                    <div class="panel-body error_in_style"></div>

                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="panel panel-danger">
                                    <div class="panel-heading mes_error">
                                        <h3 class="panel-title"> Error In Measurement</h3>
                                    </div>
                                    <div class="panel-body error_in_measurement"></div>
                                </div>
                            </div>
                            <div style='clear:both'></div>
                        </div>

                        <div class="col-md-12">
                            <p
                                style="margin-bottom: 10px;
                                border-bottom: 2px solid #000;
                                padding-bottom: 24px;
                                font-size: 22px;
                                line-height: 45px;"
                                >
                                Click here to confirm order &rarr; &nbsp;<button class="btn btn-danger btn btn-lg checkAllStyleMeasurement" style="background: red" onclick="Confirmorder(this);">
                                    <i class="icon-thumbs-up"></i>  &nbsp; Submit Order
                                </button>
                            </p>



                        </div>



                    </div>
                </div>

            </div>
            <div style="clear:both"></div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="zoom_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" ><span id="zoom_title">Test</span> <small id="zoom_subtitle" style="    font-size: 14px;
                                                                                      line-height: 34px;
                                                                                      margin-left: 10px;">(Test d)</small></h4>
                </div>
                <div class="modal-body" style="height: 400px;overflow-y: auto">
                    <center><img src="" id="zoom_image"/></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".style_selection img").dblclick(function () {
                var obj = $(this).parents(".style_selection");
                var parent = $(obj).attr("parent_style");
                $("#zoom_subtitle").text(parent);
                var child = $(obj).attr("child_style");
                $("#zoom_title").text(child);
                var img = this.src;
                var imgs = img.replace("small", "medium");
                console.log(imgs);
                $("#zoom_image").attr("src", imgs);
                $("#zoom_modal").modal("show")
            })
        })
    </script>


    <script src="./custom_form_view/static/custmo_js_css/validation.js"></script>
    <script src="./custom_form_view/static/custmo_js_css/customform.js"></script>
    <script src="./custom_form_view/static/bootstrap-fileinput/bootstrap-filestyle.min.js"></script>

    <script>
        $(function () {
            $("#your_space_text").summernote({
                height: 200, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
                onKeyup: function (e) {
                    $(".final_summary").html($(this).code());
                }
            });
        })


        function Confirmorder() {
            //  $(".checkAllStyleMeasurement").attr("disabled", "true");
            $("[styleselect]").each(function () {
                var ck = $(this).text();
                if (ck) {
                }
                else {
                    var prt = $(this).attr("styleselect");
                    console.log(prt)
                }
            })
            //                                        
            var userid = <?php echo $_SESSION['user_id']; ?>;
            var tag_id = <?php echo $tag_id; ?>;
            var user_images = [];
            $("[name='image_name_list[]']").each(function (i) {
                user_images[i] = this.value
            })
            for (pd in productStyleArray) {
                var temp = productStyleArray[pd]['Additional Remark'];
                var temp1 = temp.replace(/,/gi, "++*++");
                var temp2 = temp1.replace(/'/gi, "|||||");

                productStyleArray[pd]['Additional Remark'] = temp2;

            }
            jQuery.ajax({
                url: 'ajaxController.php',
                method: 'post',
                data: {
                    'customDataInsert': productStyleArray,
                    'user_id': userid,
                    'header_mapping': header_mapping || '',
                    'customDataInsertPrice': productStyleArrayPrice,
                    'custom_form': custom_form,
                    'measurement': measurment_profile_array,
                    'posture': posture_array,
                    'user_images': user_images || '',
                    'tag_id': tag_id,
                    'shop_data': $(".shop_style")[0].checked ? 1 : 0,
                    'shop_data_mes': $(".shop_mes")[0].checked ? 1 : 0,
                },
                success: function (data) {
                    console.log(data);
                    window.location = "shippingCart.php";
                }
            });
        }


    </script>
<?php } ?>

<?php
include 'footer.php'
?>
<script>



    $(window).on('beforeunload', function () {
        return 'Are you sure you want to leave?';
    });





    $(function () {
        var bucket = {};
        var product = [];
        $(".product_checkBox").click(function () {
            $("#productImagesTemplate").html('');
            if ($(this).is(':checked')) {
                var cartId = $(this).val();
                var sku = $(this).parent().parent().find('td:nth-child(4)').text();
                var imgpath = $(this).parent().parent().find('td:nth-child(2) img').attr('src');
                var title = $(this).parent().parent().find('td:nth-child(3) h6').text();
                //bucket  = {testID,sku,imgpath,title};
                bucket[cartId] = {'img_path': imgpath, 'title': title, 'sku': sku};
                // console.log(bucket);
                product.push(cartId);
                // console.log(product);
            }
            ;


            if (!$(this).is(':checked')) {
                var cartId = $(this).val();
                delete bucket[cartId];
                product.pop(cartId);
            }

            var margins = 0;
            for (i in bucket) {
                margins += 30;
                var temp = bucket[i];
                var htmls = $(".cartItems");
                $(htmls).find(".cartCustomizeStyle").css({"z-index": margins, })
                $(htmls).find(".cartImage").attr("src", temp['img_path']);
                $(htmls).find('.cartTitle').text(temp['title']);
                //                $(htmls).find('.cartsku').text(temp['sku']);
                $("#productImagesTemplate").append($(htmls)[0].innerHTML);
            }

            $('input[name=product_id]').val(product);
            if (product == '') {
                $('#customization').hide();
                $("#containerBox").hide(300);
                //$("#productImage").hide();
            } else {
                $("#containerBox").show(300);
                $('#customization').show();
                $("#productImage").show();
            }
        });


        $("#profile_name").val("<?php echo date('Ymdhis'); ?>").keyup();

        $(".innerSelectionTab").each(function () {
            $(this).children().each(function () {
                var tabobj = $(this).find("a[aria-controls]");
                var tabid = $(tabobj).attr("aria-controls");
                var imgobj = $("#" + tabid).find("img").first();
                var imgsrc = $(imgobj).attr("src");
                $(tabobj).find("img").first().attr("src", imgsrc);
            })
        })
        
        
        $(".fa-flag").removeClass("fa-flag").addClass("fa-play")

    });

</script>

