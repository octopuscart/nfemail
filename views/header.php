<?php
ob_start();
session_start();
$baselink = 'http://' . $_SERVER['SERVER_NAME'];
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
<!doctype html>
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->

    <title>Nita Fashions</title>
    <!--meta info-->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=1307, initial-scale=1, maximum-scale=1">
    <meta name="author" content=""/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
    <!--web fonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'/>
    <!--libs css-->
    <script src="../assets/js/jquery-2.1.0.min.js"></script>
    <!--icoinc icon-->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/jackbox/css/jackbox.min.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="../assets/plugins/owl-carousel/owl.transitions.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/plugins/rs-plugin/css/settings.css"/>
    <!--theme css-->
    <link rel="stylesheet" type="text/css" media="all" href="../assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="../assets/css/animate.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="../assets/css/theme-animate.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="../assets/css/style.css"/>
    <!--head libs-->
    <script src="../assets/js/angular.min.js"></script>
    <script src="https://code.angularjs.org/1.4.8/angular-sanitize.min.js"></script>
    <script src="../assets/plugins/jquery.queryloader2.min.js"></script>
    <script src="../assets/plugins/modernizr.js"></script>
    <!--vertical tabs-->
    <link href="./custom_form_view/static/verticaltab/bootstrap.vertical-tabs.css" rel="stylesheet"/>
    <!--custom form support css and js-->
    <link href="./custom_form_view/static/custmo_js_css/customform.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert2-master/dist/sweetalert2.css"/>

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

<body ng-app="NitaFashions">
    <script>
        var nitaFasions = angular.module('NitaFashions', ['ngSanitize']);
        nitaFasions.config(['$httpProvider', function ($httpProvider) {
                //Reset headers to avoid OPTIONS request (aka preflight)
                $httpProvider.defaults.timeout = 5000;

            }])
    </script>

    <!--side menu-->
    <!--layout-->
    <div class="wide_layout bg_light">
        <!--header markup-->
        <header role="banner" class="relative type_2" style="background-color: #fff;">
            <span class="gradient_line"></span>
            <section class="header_top_part p_top_0 p_bottom_0" style="margin-bottom: -15px;">
                <div class="container" style="padding-left: 0px; padding-right: 0px;">
                    <div class="row">
                        <!--contact info-->
                        <!--                        <div class="col-lg-5 col-md-4 col-sm-5 t_xs_align_c">-->
                        <ul class="hr_list fs_small color_grey_light contact_info_list" style="float: right;color:#000">
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

                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 25px;" id="loginCartWish">

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
<?php if ($_REQUEST['mailsend'] == '2') { ?>

                    swal({title: "Welcome!",
                        text: "You are Registred at Nita Fashions !",
                        type: "success",
                        timer: 2000,
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