<?php
ob_start();
session_start();
$baselink = 'https://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
include '../dbhandler/dbhandler.php';
include '../producthandler/authHandler.php';
//include '../producthandler/productHandler.php';
$authobj = new AuthHandler();
//$cartprd = new CartHandler();
$conf = resultAssociate("select * from server_conf");
$conf = end($conf);
$imageserver = $conf['image_server'];
?>
<?php
$menuArray = array(
    "Home" => array(
        "About Us" => array(),
        "Schedule" => array(),
        "FAQ's" => array(),
        "Contact Us" => array()
    ),
    "Shop Now" => array(
        "Men's" => array("Shirt", "Tuxedo Shirt", "Suit", "Sports Jacket", "Trouser", "Waisetcoat", "Tuxedo Suit", "Tuxedo Jacket", "Tuxedo Trousers", "Overcoat"),
        "Woman's" => array("Shirt", "Blouse", "Suit", "Jacket"),
    // "Accessories" => array("Tie", "Bow", "Cuffline", "Suspender")
    ),
//    "Men's" => array(
//        "Shirt" => array("Two-Ply Superline", "Wrinkle-Free 100% Cotton", "Executive", "Linen", "Cotton/Poly Blends")
//    ),
//    "Mens Shirt"=>array("Two-Ply Superline","Wrinkle-Free 100% Cotton","Executive","Linen","Cotton/Poly Blends"),
//    "Women's" => array(
//        "Shirt" => array(),
//        "Blouse" => array(),
//        "Suit" => array(),
//        "Jacket" => array()
//    ),
    "Accessories" => array(
        "Tie" => array(),
        "Bow" => array(),
        "Cuffline" => array(),
        "Suspender" => array()
    ),
    "Schedule" => array(
        "Us" => array(),
        "Uk" => array(),
        "Eurpo" => array("France", "Germany", "Spain"),
        "Australia" => array()
    ),
    "FAQ's" => array(),
    "Contact Us" => array()
);

function parent_get($table, $column, $id) {
    ?>
    <ul class="hr_list main_menu type_2 fw_light true">       
        <?php
        $query = mysql_query("select * from $table where $column=$id order by menu_index");
        while ($row = mysql_fetch_array($query)) {
            ?> 
            <li class="container3d relative <?php if ($row['menu_page'] == '') { ?> f_xs_none m_xs_bottom_5 <?php } ?>"  >

                <a href="<?php echo $row['menu_page']; ?> " class="menu-link d_block color_dark relative main-menu-link"> <?php echo $row['name']; ?> </a>

                <?php
                $cat[$row['id']] = child($table, $column, $row['id']);
                ?>
            </li>
            <?php
        }
        ?>
    </ul>           
    <?php
    return $cat;
}

function child($table, $column, $id) {
    // echo "select * from $table where $column=$id order by menu_index";
    ?>

    <?php
    $query = mysql_query("select * from $table where $column=$id order by menu_index");
    $cat = array();
    if (mysql_num_rows($query)) {
        ?>
        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
            <?php
            while ($row = mysql_fetch_array($query)) {
                ?>
                <li class="container3d relative <?php if ($row['menu_page'] == '') { ?> f_xs_none m_xs_bottom_5 <?php } ?>">
                    <?php
                    ?>
                    <a href="<?php echo $row['menu_page']; ?> " class="menu-link d_block color_dark relative main-menu-link"> <?php echo $row['name']; ?> <?php echo $row['name'] == 'Tuxedo' ? '<i class="icon-angle-right"></i>' : ''; ?></a>
                    <?php
                    $tt = child($table, $column, $row['id']);


                    $cat[$row['id']] = $tt;
                    ?> 
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>

    <?php
    return $cat;
}
?>
<!doctype html>
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
    <html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" slick-uniqueid="3"><head>
            <title>Nita Fashions Estd 1953|Bespoke Tailor & Clothiers| Top 10 Tailors in Hong Kong | Custom Made Modern  Suits, Shirts, Wedding Tuxedos, Dress  Etc. </title>
            <!--meta info-->
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <!--<meta name="author" content="Nita Fashions"/>-->

                <meta name="keywords" content="
                      Premier Tailor in Hong Kong, Premier Top 10 Tailor in Hong Kong, Best Tailor in Hong Kong, Best Top 10 tailor in Hong Kong, Best Clothier in Hong Kong, Top 10 Tailors in Hong Kong, Top 5 Tailors in Hong Kong,
                      Top 3 Tailors in Hong Kong, Number one Tailor in Hong Kong, Number 1 Tailor in Hong Kong, No.  one Tailor in Hong Kong, No. 1 Tailor in Hong Kong, Best Tailoring Service in Hong Kong,  Affortable Tailor in Hong Kong, Good Tailor in Hong Kong, Low Cost Tailor in Hong Kong, Most efficient tailor in Hong Kong,
                      Famous suit designer, Famous suit designer in Asia, Famous suit designer in Hong Kong,  Top 50 Tailors in Asia, Top 100 Tailors in world,  Top 100 Tailors on globe, Global Tailor in Hong Kong,  Shirts, Tailored Shirts, Bespoke Shirts, Shirt Designer, Design Shirt, Make Shirts,  Create a Shirt, Create Shirts, Suit, Tailored Suits, Bespoke Suits, Suit designer,  Design Suit, Make Suit,  Create a Suit, Create Suit,  Jacket,
                      Tailored Jacket, Bespoke Jacket, Jacket Designer, Design Jacket, Make Jacket,  Create a Jacket, Create Jacket, Pant, Tailored Pant, Bespoke Pant, Pant designer, Design Pant, Make Pant,  Create a Pant, Create Pant,  Sports Jacket, Tailored Sports Jacket, Bespoke Sports Jacket, Sports Jacket designer, Design Jacket, Make Jacket,  Create a Jacket, Create Jacket, Tux, Tuxedo, Tuxedo Shirt, Tuxedo Suit, Tuxedo Pant, Tuxedo Jacket, Design Tuxedo, Make Tuxedo,  Create a Tuxedo, Create Tuxedo,  Bespoke Tuxedo,
                      Bespoke Tuxedo Shirt, Design Tuxedo Shirt, Make Tuxedo Shirt, Create a Tuxedo Shirt, Create Tuxedo Shirt, Bespoke Tuxedo Suit, Design Tuxedo Suit, Make Tuxedo Suit,  Create a Tuxedo Suit, Create Tuxedo Suit, Bespoke Tuxedo Pant, Design Tuxedo Pant, Make Tuxedo Pant,  Create a Tuxedo Pant, Create Tuxedo Pant, Bespoke Tuxedo Jacket, Design Tuxedo Jacket, Make Tuxedo Jacket, Create a Tuxedo Jacket, Create Tuxedo Jacket, Tailored Tuxedo,Tailored Tuxedo Shirt, Tailored Tuxedo Suit,
                      Tailored Tuxedo Pant, Tailored Tuxedo Jacket, Bespoke Tuxedo, Bespoke Tuxedo Shirt, Bespoke Tuxedo Suit, Bespoke Tuxedo Pant, Bespoke Tuxedo Jacket, Wedding Suits, Wedding Tuxedos, Wedding Tux,
                      overcoat, bespoke overcoat,  tailored overcoat, car coat, bespoke car coat, tailored car coat, topcoat, bespoke topcoat, tailored  topcoat,  sports jacket, bespoke jacket, tailored topcoat, tailored waistcoat,
                      bespoke waistcoat, bespoke suits, custom clothes, custom tailor, tailoring, bespoke suit, tailored suit,
                      custom made shirts, custom made suits, tailor, Formal wear, Menswear, Womenswear,  suits, tie, shirt,
                      affordable, custom suits, custom dress shirts, made to measure suits, hong kong tailors, hong kong fashions, hong kong fashion, custom tailoring, ladies tailoring, mens tailoring, best tailors, costumes,
                      chemises, costumes sur measure, des vêtements sur mesure, boutique de vêtement,                  
                      tailleurs de Hong Kong, la confection sur mesure, couture dames, hommes couture, meilleurs tailleurs,                        
                      Meilleur tailleur en hong kong, Tailleur populaire à Hong Kong,  Anzüge, Hemden,                                    maßgeschneiderte Anzüge, eigene Kleidung, Hong Kong Schneider, Beste hong kong schneider                
                      Beliebte hong kong Schneider, Beliebtesten hong kong Schneider, Renommierten hong kong Schneider  
                      Maßschneiderei, Damen Schneiderei, Frauen-Schneiderei in Hong Kong, Beste Frauen-Schneiderei in Hong Kong, Beliebteste Frauen-Schneiderei in Hongkong, Schneiderei Herren, am besten Schneider,                                
                      Besten Schneider in Hong Kong, trajes, camisas, trajes a medida,ropa a medida, sastres hong kong,                                
                      sastrería a medida, damas de costura, sastrería para hombre, los mejores sastres, Mejor sastre en hong kong, La mayoría de los sábanas popula en hong Kong, 西裝,襯衫, 定制西裝, 定制衣服,         
                      香港的裁縫, 定做,  女裝的剪裁, 男裝裁縫,  最好的裁縫,"> 
                    <meta name="description" content="Nita Fashions is the leading Bespoke Tailor in Hong Kong for both Men and Women’s Clothing.  Chief Tailor, Mr. Peter Daswani and Mr. Anil Daswani travel extensively to service their clients worldwide. ">
                        <link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
                        <!--web fonts-->
                        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'/>
                        <!--libs css-->
                        <script src="../assets/js/jquery-2.1.0.min.js"></script>
                        <!--icoinc icon-->
                        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all">

                            <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/jackbox/css/jackbox.min.css"/>
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.carousel.css"/>
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.transitions.css"/>
                            <link rel="stylesheet" type="text/css" media="screen" href="../assets/plugins/rs-plugin/css/settings.css"/>
                            <!--theme css-->
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/css/bootstrap.css"/>
                            <!--<link rel="stylesheet" type="text/css" media="all" href="../assets/css/bootstrap.min.css"/>-->
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/css/animate.css"/>
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/css/theme-animate.css"/>
                            <link rel="stylesheet" type="text/css" media="all" href="../assets/css/style.css"/>
                            <!--head libs-->
                            <script src="../assets/js/angular.min.js"></script>


                            <script src="../assets/js/angular-sanitize.min.js"></script>

                            <script src="../assets/plugins/jquery.queryloader2.min.js"></script>
                            <script src="../assets/plugins/modernizr.js"></script>
                            <!--vertical tabs-->
                            <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet"/>
                            <!--custom form support css and js-->
                            <link href="./custom_form_view/static/custmo_js_css/customform.css" rel="stylesheet"/>
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
                                <link rel="stylesheet" type="text/css" href="../assets/sweetalert2-master/dist/sweetalert2.css"/>
                                <link href="../assets/css/customstyle.css" rel="stylesheet"/>
                                <script>
                                    function arrangeSku() {
                                    var temp = 0;
                                    $("[data-title='SKU']").each(function (ind) {
                                    var textsku = $(this).text();
                                    var sameSku = $("[data-title='SKU']")[ind + 1];
                                    var ptemp = $(sameSku).text();
                                    if ($("[data-title='SKU']:contains(" + textsku + ")").length > 1) {
                                    temp += 1;
                                    $(this).text(textsku + " - " + (temp));
                                    }
                                    if (ptemp != textsku) {
                                    temp = 0;
                                    }
                                    });
                                    }

                                </script> 
                                <?php
                                if (isset($_POST['registration'])) {
                                    if (empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['captcha']) != 0) {
                                        $errors .= "\n The captcha code does not match!";
                                        if (empty($errors)) {
                                            
                                        } else {
                                            ?>
                                            <script>
                                                $(function () {
                                                $('#captcha_hide').show();
                                                });
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                            $reg = $authobj->user_registration($_POST, 'auth_user');
                                        }
                                    }
                                }
                                if (isset($_POST['login'])) {
                                    $result = $authobj->frontend_login($_POST, 'auth_user');
                                }
                                if (isset($_POST['logout'])) {
                                    $massage = $authobj->frontend_logout($_SESSION['user_id']);
                                }
                                if (isset($_POST['forget'])) {
                                    $authobj->forget_login_detail($_POST['email'], 'auth_user');
                                }
                                if (isset($_POST['change'])) {
                                    $authobj->frontend_change_password($_POST['pass'], $_POST['token'], 'auth_user');
                                }
                                ?>
                                </head>
                                <style>
                                    .popupBox{
                                        margin: 7px 125px auto;
                                        padding:10px 10px 10px 10px;
                                        position:fixed;background-color: rgb(226, 226, 226);
                                        opacity: 1;
                                        border: 4px solid rgb(168, 177, 152);
                                        -webkit-border-radius: 10px;
                                        -moz-border-radius: 10px;
                                        border-radius: 10px;
                                        -moz-box-shadow: inset 0 0 5px 5px #888;
                                        -webkit-box-shadow: inset 0 0 5px 5px#888;
                                        box-shadow: inset 0 0 5px 5px #888;
                                    }
                                </style>


                                <style type="text/css">
                                    #loading {
                                        position: fixed;
                                        z-index: 50000;
                                        height: 500px;

                                        color: #353231;
                                        text-indent: -9999px;
                                        top: 0px;

                                    }
                                    .v2 #loading { display: none; }


                                    #loader {

                                        /*background:transparent url("") no-repeat center 25%;*/
                                        height:100%;
                                        display: block;
                                        /*opacity: 0.3;*/
                                        /*background: #000;*/
                                    }


                                </style>

                                <script>

                                    (function ($) {

                                    $("html").removeClass("v2");
                                    $("body").ready(function () {
                                    })

                                            $("#header").ready(function () {
                                    $("#progress-bar").stop().animate({top: "25%", opacity: 0.8}, 1000)
                                    });
                                    $("#footer").ready(function () {
                                    $("#progress-bar").stop().animate({top: "75%", opacity: 0.5}, 1000)
                                    });
                                    $(window).load(function () {

                                    $("#progress-bar").stop().animate({top: "100%", opacity: 0}, 500, function () {
                                    $("#loading").fadeOut("fast", function () {
                                    $(this).remove();
                                    $("#price_loader").remove();
                                    Waves.attach('.button_wave', ['waves-button', 'waves-float']);
                                    Waves.attach('.waves-image1');
                                    Waves.init();
                                    });
                                    });
                                    });
                                    })(jQuery);
                                    $(function () {

                                    })
                                </script>

                                <style>
                                    main .shell { padding: 25px 0 90px 43px; width: 917px;}
                                    #progress-bar{   
                                        width:100%;
                                        height:100%; 
                                        opacity: 1;
                                        background:#000;  
                                        float: right;
                                        //opacity: 0.2;
                                        position: fixed;
                                    }
                                </style>


                                <div id='loading' class="" style="width:100%;height: 100% ">
                                    <div id='progress-bar'>

                                    </div> 
                                    <div id='loader'>
                                        <div class='loaderstyle'>

                                        </div>
                                    </div>

                                </div>            
                                <?php
                                $urlcheck = $_SERVER['REQUEST_URI'];
                                $stylewidth = "min-width:  1307px;";
                                ;
                                if (strpos($urlcheck, 'product_list.php')) {
                                    $stylewidth = "min-width:  1307px;";
                                } else {
                                    
                                }
                                ?>
                                <body ng-app="NitaFashions"  style="">
                                    <script>
                                                var nitaFasions = angular.module('NitaFashions', ['ngSanitize']);
                                        nitaFasions.config(['$httpProvider', function ($httpProvider) {
                                        //Reset headers to avoid OPTIONS request (aka preflight)
                                        $httpProvider.defaults.timeout = 5000;
                                        }])
                                    </script>
                                    <button id="open_side_menu" class="icon_wrap_size_2 circle color_light bg_gradiant">
                                        <i class="icon-menu"></i>
                                    </button>
                                    <div id="side_menu" class='bg_gradiant'>
                                        <header class="m_bottom_30 d_table w_full" >
                                            <!--logo-->
                                            <div class="d_table_cell half_column v_align_m" style="background: white">
                                                <a href="/">
                                                    <img src="../assets/images/logo/nf_logo_8.png" alt="">
                                                </a>
                                            </div>
                                            <!--close sidemenu button-->
                                            <div class="d_table_cell half_column v_align_m t_align_r">
                                                <button class="icon_wrap_size_2 circle color_light _2 d_inline_m" id="close_side_menu">
                                                    <i class="icon-cancel"></i>
                                                </button>
                                            </div>
                                        </header>
                                        <hr class="divider_type_2 m_bottom_20">

                                            <!--main menu-->
                                            <nav>
                                                <ul class="side_main_menu fw_light">

                                                    <li class="has_sub_menu  m_bottom_10">
                                                        <a href="#" class="d_block relative fs_large color_black color_blue_hover">Home</a>
                                                        <!--sub menu(second level)-->
                                                        <ul class="d_none m_top_10">       
                                                            <li class="m_bottom_10"><a href="pages_about.php" class="d_block relative color_black color_blue_hover">About Us</a></li>
                                                            <li class="m_bottom_10"><a href="pages_faq.php" class="d_block relative color_black color_blue_hover">FAQ's</a></li>
                                                            <li class="m_bottom_10"><a href="pages_t&c.php" class="d_block relative color_black color_blue_hover">Terms of Service</a></li>
                                                            <li class="m_bottom_10"><a href="pages_policy.php" class="d_block relative color_black color_blue_hover">Privacy Policy</a></li>
                                                            <li class="m_bottom_10"><a href="scheduler2.php" class="d_block relative color_black color_blue_hover">Schedule</a></li>
                                                            <li class="m_bottom_10"><a href="pages_contact.php" class="d_block relative color_black color_blue_hover">Contact Us</a></li>
                                                        </ul> 
                                                    </li>                           
                                                    <li class="has_sub_menu  m_bottom_10">
                                                        <a href="#" class="d_block relative fs_large color_black color_blue_hover">Customize Now</a>
                                                        <!--sub menu(second level)-->
                                                        <ul class="d_none m_top_10">       
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=1 " class="d_block relative color_black color_blue_hover"> Shirt </a>
                                                            </li>

                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=11 " class="d_block relative color_black color_blue_hover"> Suit </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=13 " class="d_block relative color_black color_blue_hover"> 3 Piece Suit </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=2 " class="d_block relative color_black color_blue_hover"> Pant </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=5 " class="d_block relative color_black color_blue_hover"> Jacket </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=3 " class="d_block relative color_black color_blue_hover"> Waistcoat </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=12 " class="d_block relative color_black color_blue_hover"> Sports Jacket </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=15 " class="d_block relative color_black color_blue_hover"> Overcoat </a>
                                                            </li>
                                                        </ul> 
                                                    </li> 

                                                    <li class="m_bottom_10 has_sub_menu">
                                                        <a href="# " class="d_block relative color_black color_blue_hover"> Tuxedo </a>
                                                        <ul class="d_none m_top_10">
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=7 " class="d_block relative color_black color_blue_hover"> Shirt </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=8 " class="d_block relative color_black color_blue_hover"> Pant </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=14 " class="d_block relative color_black color_blue_hover"> Jacket </a>
                                                            </li>
                                                            <li class="m_bottom_10">
                                                                <a href="product_list.php?item_type=10 " class="d_block relative color_black color_blue_hover"> Suit </a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li class="m_bottom_10"><a href="pages_about.php" class="d_block relative color_black color_blue_hover">About Us</a></li>
                                                    <li class="m_bottom_10"><a href="scheduler2.php" class="d_block relative color_black color_blue_hover">Schedule</a></li>
                                                    <li class="m_bottom_10"><a href="pages_contact.php" class="d_block relative color_black color_blue_hover">Contact Us</a></li>
                                                    <li class="m_bottom_10"><a href="pages_offers.php" class="d_block relative color_black color_blue_hover">Offers</a></li>
                                                    <li class="m_bottom_10"><a href="pages_guide.php" class="d_block relative color_black color_blue_hover">Guide </a></li>







                                                </ul>
                                            </nav>
                                    </div>
                                    <!--side menu-->
                                    <!--layout-->
                                    <div class="wide_layout bg_light" style="width: 100%;">
                                        <!--header markup-->
                                        <header role="banner" class="relative type_2 appheaderpart" style="background-color: #fff;">
                                            <span class="gradient_line"></span>
                                            <section class="header_top_part p_top_0 p_bottom_0 headertopemail">
                                                <div class="container" >
                                                    <div class="">
                                                        <!--contact info-->
                                                        <!--                        <div class="col-lg-5 col-md-4 col-sm-5 t_xs_align_c">-->
                                                        <ul class="hr_list fs_small color_grey_light contact_info_list" >
                                                            <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                                                <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-phone-1"></i></span> + (852) 2721-9990
                                                            </li>
                                                            <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                                                <a href="mailto:sales@nitafashions.com" class="color_grey_light d_inline_b color_black_hover" style="color:#000"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-mail-alt"></i></span>sales@nitafashions.com</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </section>
                                            <!--            <hr>-->
                                            <!--header bottom part-->
                                            <section class="header_bottom_part type_2 bg_light" style="padding: 0px">
                                                <div class="container">
                                                    <div class="d_table w_full d_xs_block">
                                                        <!--logo-->
                                                        <div class="col-lg-3 col-md-3 col-sm-3 d_table_cell d_xs_block f_none v_align_m logo t_xs_align_c">
                                                            <a href="#" class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                                                                <img src="../assets/images/logo/nf_logo_8.png" style="margin-top: -11px; height: 80px; " alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 t_align_r d_table_cell d_xs_block f_none">

                                                            <div class="col-lg-12 col-md-12 col-sm-12"  id="loginCartWish">

                                                                <div id="AjaxCart" ng-controller="AjaxCart" class="f_right clearfix f_xs_none d_xs_inline_b t_xs_align_l m_xs_bottom_15" style="margin-right: -4%;">

                                                                    <?php include 'ajaxCart.php' ?> 
                                                                    <!--searchform button-->




                                                                </div>



                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!--            <hr class="d_xs_none" style="margin-top: 7px;">-->



                                            <!--side menu-->




                                            <hr style = "margin-bottom: 0px;margin-top: 5px;">
                                                <section class="sticky_part bg_light" style="">
                                                    <div class="container">
                                                        <!--main navigation-->
                                                        <button id="menu_button" class="r_corners tr_all color_blue db_centered m_bottom_20 d_none d_xs_block">
                                                            <i class="icon-menu"></i>
                                                        </button>
                                                        <!--main navigation-->
                                                        <?php include 'menu.php' ?>
                                                        <!--end of main menu-->
                                                    </div>
                                                </section>
                                                <script>
                                                    $(function () {
                                                    $(".searchButtonMnl").click(function () {
                                                    $(this).parents("div").first().animate({"margin-left": "285px"});
                                                    if ($("form").hasClass("horizontal_animate_finished")) {
                                                    $(this).parents("div").first().animate({"margin-left": "31px"});
                                                    }
                                                    ;
                                                    })
                                                    })
                                                </script>
                                        </header>
                                        <script>

                                                    $(function () {
<?php if ($result == 'TRUE') { ?>

                                                        swal({
                                                        title: "Welcome!",
                                                                text: "Continue Shopping at Nita Fashions !",
                                                                type: "success",
                                                                timer: 2000,
                                                        }, function () {
                                                        window.location = 'index.php'
                                                        });
<?php } if ($result == 'FALSE') { ?>

                                                        swal({title: "Wrong Authentication",
                                                                text: "Incorrect Username or Password!",
                                                                type: "error",
                                                                timer: 2000,
                                                        });
<?php } ?>

                                                    });
                                        </script>
                                        <script>
                                            $(function () {
<?php if ($_REQUEST['mailsendr'] == '2') { ?>

                                                swal({title: "Mail Sent!",
                                                        text: "Verification Mail Sent, Check Your Inbox",
                                                        type: "success",
                                                        timer: 3000,
                                                }, function () {
                                                window.location = 'index.php'
                                                });
<?php } if ($reg == 'FALSE') { ?>

                                                swal({title: "Wrong",
                                                        text: "You are already exists",
                                                        type: "error",
                                                        timer: 2000,
                                                });
<?php } ?>

                                            });
                                        </script>
                                        <script>
                                            $(function () {
<?php if (isset($_REQUEST['mailsend'])) { ?>


                                                swal({title: "Mail Sent!",
                                                        text: "Check Email In Your Inbox",
                                                        type: "success",
                                                        timer: 2000,
                                                }, function () {

    <?php
    $mailtypemain = $_REQUEST['mailsend'];
    switch ($mailtypemain) {
        case '3':
            echo "window.location=window.location.pathname";
            break;
    }
    ?>

                                                //                        window.location.reload()
                                                });
<?php } ?>
<?php if (isset($_POST['change'])) { ?>


                                                swal({title: "Password Changed",
                                                        text: "Login Now",
                                                        type: "success",
                                                        timer: 2000,
                                                }, function () {
                                                window.location = 'index.php'
                                                });
<?php } ?>
                                            });
                                        </script>
                                        <script src="../assets/sweetalert2-master/dist/sweetalert2.min.js"></script>
                                        <?php
                                        ?>


                                        <!--wave js-->
                                        <script src="../assets/wavejs/waves.min.js"></script>
                                        <link href="../assets/wavejs/waves.min.css" rel="stylesheet"/>

                                        <!--end of wave js-->