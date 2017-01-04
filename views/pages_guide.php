<?php
include 'header.php';
?>
<?php
$faq = array(
    "How to create <b>Account</b>?"
    =>
    " ",
    "How to customize <b>Shirt</b>?"
    =>
    "Click on the  <a target='_blank' href='https://youtu.be/-klcHiGz0O0'>
     <b>video link</b>
      </a> of shirt customization
     <a target='_blank' href='https://youtu.be/-klcHiGz0O0'>
     <b>Video Tutorial</b>.
      </a>
     ",
    "How to customize <b>Pant</b>?"
    =>
    " ",
    "How to customize <b>Suit</b>?"
    =>
    " ",
    "How to customize <b>Waistcoat</b>?"
    =>
    " ",
);
?>
<!--page title-->
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="ion-android-navigate"></i>&nbsp;&nbsp;Guide&nbsp;&nbsp;
                </a>
            </li>

        </ul>
    </div>
</section>

<style>



    .page_block{
        /*background-image: url(http://englishcut.launchsite.netdna-cdn.com/wp-content/uploads/2010/06/about.jpg);*/
        background-repeat: no-repeat;
        background-size: cover;
        /*        color: #fff;
                background-color: #000;*/

    }
    .page_block h3{
        font-size: 24px;
        font-weight: 500;
    }

</style>
<!--content-->
<div class="section_offset" style="padding: 30px 0 67px;">
    <div class="container clearfix">
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Guide For Nita Fasions</h3>
                <p class="m_bottom_35 heading_2 t_align_c">This page provides guide to basic navigation about Nita Fashions.</p>		

            </section>
            <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_40 m_xs_bottom_30" style='  padding:0 125px;'>
<?php
foreach ($faq as $key => $value) {
    ?>
                    <div class="accordion toggle">
                        <dl class="accordion_item r_corners wrapper m_bottom_5 tr_all">
                            <dt class="accordion_link relative tr_all color_dark"><?php echo $key; ?>
                            <span class="icon_wrap_size_1 circle d_block hide">
                                <i class="icon-minus"></i>
                            </span>
                            <span class="icon_wrap_size_1 circle d_block show" style="opacity: 1;background-color: #f00;color: #fff;">
                                <i class="icon-plus"></i>
                            </span>
                            </dt>
                            <dd class="fw_light color_dark" style="display: none;">
    <?php echo $value; ?>
                            </dd>
                        </dl>

                    </div>
    <?php
}
?>
            </div>

        </div>
    </div>
</div>

<script>

    $(function () {
        $(".d_block.show").click(function () {
            var isactive = $(this).parents(".accordion_item").hasClass("active");

            if (isactive != true) {
                $(this).find("i").removeClass("icon-plus").addClass("icon-minus");
            }
            else {
                $(this).find("i").removeClass("icon-minus").addClass("icon-plus");
            }
        })
    })
</script>



<!--back to top button-->


<?php
include 'footer.php';
?>	