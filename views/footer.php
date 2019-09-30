<button type="button" style="display: none" class="btn btn-primary btn-lg Login" data-toggle="modal" data-target="#myLogin">
</button>
<style>
    .modal table tr{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        /*border-bottom: 1px solid;*/
    }
</style>




<?php
include 'typeahead.php';
if ($_SESSION['user_id'] == '') {
    ?>

    <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLogin">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 10%">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="../views/index.php" class="btn close"><span aria-hidden="true">&times;</span></a>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-lock  tr_inherit"></i> &nbsp; User Login</h4>
                </div>
                <div class="modal-body">
                    <form action="#" class="login_form" method="post">
                        <ul>
                            <li class="m_bottom_10 relative">
                                <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                                <input type="text" name="email" placeholder="Email" class="r_corners color_grey w_full fw_light">
                            </li>
                            <li class="m_bottom_10 relative">
                                <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                                <input type="password" name="pass" placeholder="Password" class="r_corners color_grey w_full fw_light">
                            </li>
                            <!--                                                            <li class="m_bottom_23">
                                                                                            <input type="checkbox"  checked id="checkbox_1" name="check" class="d_none">
                                                                                            <label for="checkbox_1" class="d_inline_m fs_medium fw_light">Remember me</label>
                                                                                        </li>-->
                            <li class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                    <input type="submit" name="login" class="btn btn-default btn-xs tr_all color_black transparent  r_corners"  value="Login">
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 t_align_r lh_medium">
                                    <a href="forgetdetail.php" class="fs_small btn btn-xs t_xs_align_c d_inline_b tr_all r_corners" style="color: #000000">Forgot your password?</a>
                                </div>
                            </li>
                        </ul>
                    </form>
                    <hr style="margin:1% 0;height: 0.001% !important; ">
                    <div class="bg_light_2 im_half_container sc_footer ">

                        <p class=" t_align_l fw_light color_dark d_inline_m half_column">New Customer ?</p>

                        <div class="half_column t_align_r d_inline_m">
                            <a href="../views/registration.php" class="btn btn-xs t_xs_align_c d_inline_b tr_all r_corners color_purple transparent fs_medium">Create an Account</a>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="../views/index.php" class="btn btn-default" data-dismiss="modal">Close</a>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<hr class="divider_type_2" style="margin-bottom:0px;margin-top:0px; ">
<footer role="contentinfo" class="bg_light_3" style="    padding: 0px;">
    <!--top part-->
<!--    <section class="footer_top_part">
        <div class="container relative" style="">
            <div class="row">
                contact

                <div class="col-lg-3 col-md-3 col-sm-3">

                   
                    <h5 class="color_dark fw_light m_bottom_20"  style="color: #000 !important;font-weight: 500; font-size: 17px;">Chief Tailor</h5>
                    <div class="textwidget">
                        <p class="fw_light m_bottom_25">
                             <img width="80" height="80" src="../assets/images/client.jpg" class="attachment-post-thumbnail wp-post-image" alt="" style="float: left;
    margin: 6px 15px 10px 0px;
    border-radius: 50%;"> 
                            <strong>Mr. Peter Daswani</strong>, recently partnered with his son Anil Daswani giving the business the perfect balance of classic and modern, taking it to its peak.
                        </p>
                    </div>


                </div>


                <div class="col-lg-3 col-md-3 col-sm-3">
                    <h5 class="color_dark fw_light m_bottom_20"  style="color: #000 !important;font-weight: 500; font-size: 17px;">Who We Are</h5>
                    <div class="textwidget">
                        <p class="fw_light m_bottom_25">
                            Most respected names in men's clothing, meticulous hand tailoring, and quality that is becoming harder and harder to find.
                            Our Master Tailor, Peter Daswani, has over 30 years of experience in custom tailoring. <br>
                            World's finest fabrics are careful selected to live up to name of Fashions.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                    <h5 class="color_dark fw_light m_bottom_20"  style="color: #000 !important;font-weight: 500; font-size: 17px;">Our Fabrics</h5>
                    <div class="textwidget">
                        <p class="fw_light m_bottom_25">
                            The world's finest fabrics are careful selected to live up to name of Nita Fashions. 
                            We carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</p></div>
                </div>
                subscribe
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <h5 class="color_dark fw_light m_bottom_20" style="color: #000 !important;font-weight: 500; font-size: 17px;">Newsletter</h5>
                    <p class="fw_light m_bottom_25">Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                    <form class="subscribe_send_form">
                        <ul>
                            <li class="m_bottom_5">
                                <input type="email" name="subscribe_email" placeholder="Your email address" style="height: 30px!important" class="r_corners bg_light w_full fw_light">
                            </li>
                            <li>
                                <button class="btn btn-default btn-xs transparent r_corners tr_all">Subscribe</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <hr class="m_bottom_45 divider_type_3 m_xs_bottom_30" style="margin-top: 0px;">
        <div class="container" style="margin-top:">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 m_xs_bottom_30 t_xs_align_l t_align_l">
                    <h5 class="color_dark fw_light m_bottom_25 widget-title" style="color: #000 !important;font-weight: 500; font-size: 17px;">Shortly About Us</h5>	
                    <div class="textwidget"><p class="fw_light m_bottom_25">Since 1953, our label has been one of the most respected names in men's clothing, identified with superior fabrics. 
                            Nita Fashions carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</p>
                    </div>
                </div>


                <div class="col-lg-4 col-md-5 col-sm-6 m_xs_bottom_30 t_xs_align_l t_align_l">
                    <h5 class="color_dark fw_light m_bottom_20" style="color: #000 !important;font-weight: 500; font-size: 17px;">Contact Us</h5>
                    <ul class="vr_list_type_5 color_dark m_bottom_12 fw_light w_break">
                        <li class="m_bottom_8">
                            <div class="icon_wrap_size_1 circle color_pink f_left">
                                <i class="icon-phone-1 fs_medium"></i>
                            </div>
                            + (852) 2721-9990
                        </li>
                        <li class="m_bottom_8">
                            <div class="icon_wrap_size_1 circle color_pink f_left">
                                <i class="icon-mail-alt fs_small"></i>
                            </div>
                            <a href="mailto:#" class="color_dark color_pink_hover tr_all">info@nitafashions.com</a>
                        </li>
                                                <li class="m_bottom_8">
                                                    <div class="icon_wrap_size_1 circle color_pink f_left">
                                                        <i class="icon-skype fs_medium"></i>
                                                    </div>
                                                    skype.name
                                                </li>
                        <li class="color_default fs_medium">
                            <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                <i class="icon-location"></i>
                            </div>
                            16 Mody Road, G/F, T.S.T, Kowloon, Hong Kong
                        </li>
                    </ul>
                    <a href="https://www.google.com/maps/embed/v1/place?q=NITA%20FASHIONS%2C%20Hong%20Kong&key=AIzaSyBikAlnYV2R-TJ8rVQrPTkIk6JE0mJu8zE" target="_blank" class="button_type_2 color_dark r_corners tr_all color_pink_hover d_inline_m fs_medium t_md_align_c w_break">Open in Google Maps</a>

                </div>
                social buttons
                <div class="col-lg-4 col-md-5 col-sm-5 m_bottom_30 m_xs_bottom_20">
                    <h5 class="color_dark fw_light m_bottom_20" style="color: #000 !important;font-weight: 500; font-size: 17px;">Stay Connected</h5>
                    <ul class="hr_list social_icons">
                        tooltip_container class is required
                        <li class="m_right_15 m_bottom_15 tooltip_container">
                            tooltip
                            <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow</span>
                            <a href="https://www.facebook.com" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2">
                                <i class="icon-facebook fs_small"></i>
                            </a>
                        </li>
                        <li class="m_right_15 m_bottom_15 tooltip_container">
                            tooltip
                            <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
                            <a href="https://twitter.com/?lang=en" class="d_block twitter icon_wrap_size_2 circle color_grey_light_2">
                                <i class="icon-twitter fs_small"></i>
                            </a>
                        </li>
                        <li class="m_right_15 m_bottom_15 tooltip_container">
                            tooltip
                            <span class="d_block r_corners color_default tooltip fs_small tr_all">Google Plus</span>
                            <a href="https://plus.google.com/" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2">
                                <i class="icon-gplus-1 fs_small"></i>
                            </a>
                        </li>


                        <li class="m_right_15 m_bottom_15 tooltip_container">
                            tooltip
                            <span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
                            <a href="https://www.youtube.com/?gl=IN" class="d_block youtube icon_wrap_size_2 circle color_grey_light_2">
                                <i class="icon-youtube-play fs_small"></i>
                            </a>
                        </li>

                        <li class="m_right_15 m_bottom_15 tooltip_container">
                            tooltip
                            <span class="d_block r_corners color_default tooltip fs_small tr_all">Instagram</span>
                            <a href="https://instagram.com/" class="d_block instagram icon_wrap_size_2 circle color_grey_light_2">
                                <i class="icon-instagramm fs_small"></i>
                            </a>
                        </li>

                    </ul>

                </div>


            </div>
        </div>
    </section>-->
    <!--bottom part-->
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 8px 1px 8px 1px;">
        <div class="" style="    margin-left: 73px;">

            <a href="pages_faq.php" class="menu-link  color_dark relative main-menu-link">FAQ's</a>  |                             
            <a href="pages_t&amp;c.php" class="menu-link  color_dark relative main-menu-link">Terms of Service</a>  |                          
            <a href="pages_policy.php" class="menu-link  color_dark relative main-menu-link">Privacy Policy</a>     
            <a href="https://www.youtube.com/channel/UC5inme9JgQVjEBJJj_7VfHA"  target="_blank" class="menu-link facebook active icon_wrap_size_1  circle " style="  
               width: 26px;
               height: 26px;float: right;    font-size: 18px;
               color: #fff;    background: red;
    border-color: red;
                   line-height: 27px;    margin: 0px 5px;
               ">
                <i class="icon-youtube-play fs_small"></i>
            </a>
            <a href="https://www.instagram.com/Nita.fashions"  target="_blank" class="menu-link facebook active icon_wrap_size_1  circle " style="  
               width: 26px;
               height: 26px;float: right;    font-size: 18px;
               color: #fff;    background: #ce1785;
    border-color: #ff6f2b;
                   line-height: 27px;    margin: 0px 5px;
               ">
                <i class="icon-instagram fs_small"></i>
            </a>
            <a href="https://twitter.com/nitafashions" target="_blank" class="menu-link twitter icon_wrap_size_1 circle " style="
               width: 26px;
               height: 26px;float: right;    font-size: 18px;
               color: #fff;    background: #40bff5;
               border-color:#40bff5;
               line-height: 29px;        margin: 0px 4px 0px 5px;
               ">
                <i class="icon-twitter fs_small"></i>
            </a>
            <a href="https://www.facebook.com/Nita-Fashions-224017321015214/"  target="_blank" class="menu-link facebook active icon_wrap_size_1  circle " style="  
               width: 26px;
               height: 26px;float: right;    font-size: 18px;
               color: #fff;    background: #39599f;
               border-color: #39599f;
               line-height: 29px;    margin: 0px 5px;
               ">
                <i class="icon-facebook fs_small"></i>
            </a>
            
        </div>
    </section>
    <section class="footer_bottom_part t_align_c color_grey bg_light_4 fw_light" style="padding: 5px;">
        <p>Copyright © <?php echo date('Y');?> NitaFashions.com, All rights reserved.</p>
    </section>
</footer>
</div>
<!--back to top button-->
<button id="back_to_top" class="circle icon_wrap_size_2 color_blue_hover color_grey_light_4 tr_all d_md_none">
    <i class="icon-angle-up fs_large"></i>
</button>
<!--Theme Initializer-->





<!--Libs-->
<!------------------------------old footer--------------------------------->
<script src="../assets/plugins/bootstrap.min.js"></script>
<script src="../assets/plugins/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="../assets/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="../assets/plugins/jquery.appear.js"></script>
<script src="../assets/plugins/afterresize.min.js"></script>
<script src="../assets/plugins/jquery.easing.1.3.js"></script>
<script src="../assets/plugins/jquery.easytabs.min.js"></script>
<script src="../assets/plugins/jackbox/js/jackbox-packed.min.js"></script>
<script src="../assets/plugins/twitter/jquery.tweet.min.js"></script>
<script src="../assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="../assets/plugins/flickr.js"></script>
<!--<script src="../assets/plugins/isotope.pkgd.min.js"></script>-->
<script src="../assets/plugins/jquery.elevateZoom-3.0.8.min.js"></script>
<script src="../assets/plugins/flexslider/jquery.flexslider-min.js"></script>
<script src="../assets/js/jquery-ui-1.10.4.min.js"></script>
<script src="../assets/js/theme.plugins.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/toword.js"></script>
<script src="../assets/js/jquery.lazyload.min.js"></script>
<!-- <script src="../assets/sweetalert2-master/dist/sweetalert2.min.js"></script> -->
<!------------End--------------------------------------------------->


<!--  -->
<script>
    function isNumber(obj) {
        var inValue = $(obj).val();
        if (Number(inValue) > 0) {
        }
        else {
            if (inValue == '') {
            }
            else {

                $(obj).val('');
            }
        }
    }
    $(document).on("keyup", ".is_number", function () {
        isNumber(this);
    });</script>
<script>

    $(function () {





        arrangeSku();
//        window.onbeforeunload = function(){
//  return 'Are you sure you want to leave?';
//};

        $(".modal").draggable({
            backdrop: false
        });
    })
</script>

</body>

<!-- Chatwoo -->
<!--<script type="text/javascript">
            function chatwoo_a() {
            var s = document.createElement("script"); 
                    s.type = "text/javascript";
                    s.src = "https://chatwoo.com/c1.jsp?host=" + window.location.host + "&hostname=https://chatwoo.com/";
                    document.getElementsByTagName("head")[0].appendChild(s);
            }
    function chatwoo_d(r) {
    var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = r.d;
            document.getElementsByTagName("head")[0].appendChild(s);
    }
    chatwoo_a();</script>-->
<!-- End of Chatwoo-->

<script id="result-template" type="text/x-handlebars-template">


    <div class="col-sm-12">

    <div class="col-sm-12">  
    <span class="search_title col-sm-12" style="padding: 0px;margin-top: -5px;">{{title}}</span>
    <small style="font-size: 10px;margin-top: -9px;float: left;">{{sub_title}}</small>

    </div> 

    </div>

</script>

<script>



    $(document).ready(function () {


        var search = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('item_code'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                // url: "http://192.168.3.47/nf3/frontend/producthandler/product_search.php?tag_id=<?php echo $tag_id ?>&searchText=%QUERY%",
                url: "<?php echo $baselinkmain; ?>/producthandler/product_search.php?tag_id=<?php echo $tag_id ?>&searchText=%QUERY%",
                wildcard: '%QUERY%'
            }
        });





        /////////////////// Search Customer type ahead ////////////////////////////////////
        $('#searchproduct').typeahead(
                {highlight: true},
        {
            name: 'search',
            displayKey: 'item_code',
            limit: 8,
            source: search.ttAdapter(),
            templates: {
                header: '<span class="typeaheadgroup"><i class="icon-search"></i> Searched Result</span>',
                suggestion: Handlebars.compile($("#result-template").html()),
            },
        }

        ).bind('typeahead:selected', function (obj, select_data) {
            var checkd = select_data.sid;
//            $("input[name=searchtag]").val(checkd);
            window.location = "./product_searching.php?searchtag=" + checkd;

        });




    });


</script> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88337196-1', 'auto');
  ga('send', 'pageview');

</script>
<script>

//    Waves.attach('.button_wave', ['waves-button', 'waves-float']);
//    Waves.attach('.waves-image1');
//    Waves.init();
//    
    
  
    
</script>
</html>