<?php
include 'header.php';
include '../producthandler/productHandler.php';
$cartprd = new CartHandler();
$cartProductsInfo = $cartprd->findCustomizationId($_SESSION['user_id']);
$cartTags = $cartprd->userTag($_SESSION['user_id']);
$countproduct = $cartprd->cartProductsCount($_SESSION['user_id'], '');
?>
<!--web fonts-->
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'/>
<!--libs css-->
<script src="../assets/js/jquery-2.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/jackbox/css/jackbox.min.css"/>
<link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.transitions.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="../assets/plugins/rs-plugin/css/settings.css"/>
<!--theme css-->
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/theme-animate.css"/>

<!--head libs-->
<script src="../assets/plugins/jquery.queryloader2.min.js"></script>
<script src="../assets/plugins/modernizr.js"></script>
<link rel="stylesheet" type="text/css" href="CardExpansion/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="CardExpansion/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="CardExpansion/css/demo.css" />
<link rel="stylesheet" type="text/css" href="CardExpansion/css/card.css" />
<link rel="stylesheet" type="text/css" href="CardExpansion/css/pattern.css" />
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/style.css"/>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        var root = document.getElementsByTagName('html')[0];
        root.setAttribute('class', 'ff');
    };
</script>
</head>

<?php
$custom_form_array = array(
    'shirt' => 'shirtcustom',
    'pant' => 'pantcustom',
    'waistcoat' => 'waistcoatcustom'
);
if (isset($_REQUEST['cart_id'])) {
    $custom_form = $_REQUEST['custom_form'];
    $cart_ids = $_REQUEST["cart_id"];
    $cart_ids = implode(',', $cart_ids);
    $custom_form_val = $custom_form_array[$custom_form];
    header("location:custom_form.php?custom_form=" . $custom_form_val . "&product_array=" . $cart_ids);
}
?>


<?php
$cartIds = $cartprd->idCustomizationWithZero($_SESSION['user_id']);
// print_r(count($cartIds));
$tag = $cartprd->tags();
?>

<div class="demo-1" style="    background-image: url('http://pencilscoop.com/public/uploads/images/2013/12/blurred_background_1.jpg');
     background-repeat: no-repeat;
     background-size: cover;">
    <div class="container">

        <div class="content">
            <!-- trianglify pattern container -->
            <div class="pattern pattern--hidden"></div>
            <!-- cards -->
            <div class="wrapper">

                <?php
                // print_r($tag);
                $count = 0;
                for ($t = 0; $t < count($tag); $t++) {
                    $bas_tag = $tag[$t]['tag_title'];
                    $bas_tag_temp = str_replace(" ", "_", $bas_tag);
                    $bas_tag_temp = strtolower($bas_tag_temp);
                    ?>
                    <div class="card">
                        <div class="card__container card__container--closed">
                            <svg class="card__image" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 500" preserveAspectRatio="xMidYMid slice">
                                <defs>
                                    <clipPath id="clipPath<?php echo $t; ?>">
                                        <!-- r = 992 = hyp = Math.sqrt(960*960+250*250) -->
                                        <circle class="clip" cx="960" cy="250" r="992"></circle>
                                    </clipPath>
                                </defs>
                                <image clip-path="url(#clipPath<?php echo $t; ?>)" width="1920" height="500" xlink:href="CardExpansion/img/a.jpg"></image>
                            </svg>
                            <div class="card__content">
                                <i class="card__btn-close fa fa-times"></i>
                                <div class="card__caption">
                                    <h2 class="card__title"> <p style="   
                                                                font: 300 60px 'Lato';
                                                                color: #fff;
                                                                "><?php echo $bas_tag; ?></p>
                                    </h2>
                                    <p class="card__subtitle">Customize New <?php echo $bas_tag; ?></p>
                                </div>
                                <div class="card__copy">

                                    <form>
                                        <table class = "table withoutCustom" style = "background:#fff">
                                            <thead>
                                                <tr class = "bg_light_2 color_dark">
                                                    <th style="width:1%">S.No.</th>
                                                    <th style="width:30%">Product Description</th>
                                                    <th style="width:12%">SKU</th>
                                                    <th style="width:12%">Price</th>
                                                    <th style="width:12%">Quantity</th>
                                                    <th style="width:12%">Total</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($cartIds); $i++) {

                                                    $cartid = $cartIds[$i]['id'];

                                                    $cartInfo = $cartprd->cartProductsInformation($cartid, $_SESSION['user_id']);

                                                    $tg1 = $cartInfo['product_tag'];


                                                    for ($k = 0; $k < count($tg1); $k++) {

                                                        $tg2 = $tg1[$k]['tag_title'];

                                                        if ($bas_tag == $tg2) {
                                                            $count++;
                                                            ?>
                                                            <!-- without customized product list -->


                                                            <tr class="tr_delay">

                                                                <td data-title="">

                                                                    <input type="checkbox" id="checkboxs_<?php echo $count; ?>" name="cart_id[]" class="d_none product_checkBox" value="<?php echo $cartInfo['cart_product_id']; ?>">
                                                                        <label for="checkboxs_<?php echo $count; ?>" class="d_inline_m m_right_10"></label>

                                                                </td>
                                                                <td>

                                                                    <div style="width: 65px;float: left;">
                                                                        <a href="#" class="r_corners d_inline_b wrapper">
                                                                            <img src="<?php echo $cartInfo['image']; ?>" alt="" style="height:45px;width:42px;">
                                                                        </a>
                                                                    </div>

                                                                    <div>                                  
                                                                        <p class="m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $cartInfo['title']; ?></a></p>
                                                                        <p class="fw_light"><?php echo substr($cartInfo['short_description'], 0, 25); ?></p>
                                                                    </div>

                                                                </td>
                                                                <td data-title="SKU" class="fw_light"><?php echo $cartInfo['sku']; ?></td>
                                                                <td data-title="Price"><?php echo $cartInfo['price'] . '.00' ?></td>

                                                                <td data-title="Quantity">
                                                                    <?php echo $cartInfo['quantity']; ?>

                                                                </td>

                                                                <td data-title="Total" class="">
                                                                    <?php echo '$' . $cartInfo['cart_price'] . '.00'; ?>
                                                                </td>


                                                            </tr>
                                                            <?php
                                                            $total_price = $total_price + $cartInfo['cart_price'];
                                                            ?>


                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                        <input type="hidden" name="custom_form" value="<?php echo $bas_tag_temp; ?>">
                                            <button class="btn btn-default btn-lg" type="submit">
                                                <i class="icon-bucket"></i> Customize Now
                                            </button>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>












            </div>
            <!-- /cards -->
        </div><!-- /content -->

    </div>
    <!-- /container -->
    <!-- JS -->
    <script src="CardExpansion/js/vendors/trianglify.min.js"></script>
    <script src="CardExpansion/js/vendors/TweenMax.min.js"></script>
    <script src="CardExpansion/js/vendors/ScrollToPlugin.min.js"></script>
    <script src="CardExpansion/js/vendors/cash.min.js"></script>
    <script src="CardExpansion/js/Card-circle.js"></script>
    <script src="CardExpansion/js/demo.js"></script>
</div>

<?php
include 'footer.php'
?>
