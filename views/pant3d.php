<?php
include 'header2.php';
include '../producthandler/productHandler.php';
include './custom_form_view/custom_form_support.php';
$data = $authobj->custom_form_detail($_REQUEST['style_id']);
$userInfo = $authobj->userProfile($_SESSION['user_id']);
$tag_id = $_REQUEST['tag_id'];
$final1 = $data[0]['custom_form_data'];
//print_r($final1);
#$custom_form = 'pantcustom';
$custom_form_array = array(
    '1' => 'shirtcustom',
    '2' => 'pantcustom',
    '3' => 'waistcoatcustom',
    '5' => 'jacketcustom',
    '7' => 'tuxedoshirtcustom',
    '8' => 'tuxedopantcustom',
    '10' => 'tuxedosuitcustom',
    '11' => 'suitcustom',
    '12' => 'jacketcustom',
    '13' => '3piececustom',
    '14' => 'tuxedojacketcustom',
    '15' => 'overcoatcustom',
);
$custom_form = $custom_form_array[$tag_id];
$userInfo = $authobj->userProfile($_SESSION['user_id']);

$styleElement = phpjsonstyle($final1, 'php');
$cartIdMap = array('cart_11' => '');

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
    ?>
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
        .threedimage{
            position: absolute;
        }
        .deactive{
            display: none;
        }
    </style>



    <?php
    include 'custom_form_view/custom_elements/custom_element_creator.php';
    ?> 
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?> (Client Code : <?php echo $userInfo[0]['registration_id'] ?>)</h3>
            <p style="color:black;margin-top: 10px;font-size: 20px;">Update Style Profile- <?php echo $_REQUEST['style'] ?></p>
            <div style="margin-top: 10px;">  


            </div>

        </div>
    </section>
    <div role="tabpanel" class="tab-pane custmo_form_setup custom_form_style" id="custom_style_designer" style="padding-top:10px">

        <div class="com-md-12 create_new_style animated" style="padding: 0px;display: block;height: 450px;background: #fff">
            <p
                style="margin-bottom: 10px;
                border-bottom: 2px solid #000;
                padding-bottom: 5px;"
                >
                <span id="previous_style" class="previous_style_measurement" style=""></span>
            </p>

            <div class="col-sm-9" style="padding-right: 0px;width: 72%;padding-bottom: 10px">
                <?php
                include "./custom_form_view/" . $custom_form . ".php";
                ?>
            </div>
            <div class="col-md-3"  style="">

                <!-- body fit -->
<!--                <img src="3dpant/body.png" class="threedimage">-->
                <img src="3dpant/bodys.png" class="threedimage deactive" parent_style="Body Fit" child_style="Slim Fit">
                <img src="3dpant/bodym.png" class="threedimage deactive" parent_style="Body Fit" child_style="Medium Fit">
                <img src="3dpant/bodyl.png" class="threedimage deactive" parent_style="Body Fit" child_style="Loose Fit">
                <!-- no of pleat -->

                <img src="3dpant/0p.png" class="threedimage deactive" parent_style="Number of Pleat" child_style="No Pleat">
                <img src="3dpant/1p.png" class="threedimage deactive" parent_style="Number of Pleat" child_style="1 Pleat Standard">
                <img src="3dpant/1p.png" class="threedimage deactive" parent_style="Number of Pleat" child_style="1 Pleat English (Reverse Pleat)">
                <img src="3dpant/2pr.png" class="threedimage deactive" parent_style="Number of Pleat" child_style="2 Pleat English (Reverse Pleat)">
                <img src="3dpant/2ps.png" class="threedimage deactive" parent_style="Number of Pleat" child_style="2 Pleats Standard">
                <!-- front pocket style -->
                <img src="3dpant/slanted.png" class="threedimage deactive" parent_style="Front Pocket Style" child_style='1/4" Slanting Pocket (Standard)'>
                <img src="3dpant/piped.png" class="threedimage deactive" parent_style="Front Pocket Style" child_style="Piped">
                <img src="3dpant/seam.png" class="threedimage deactive" parent_style="Front Pocket Style" child_style="Seam">
                <img src="3dpant/western.png" class="threedimage deactive" parent_style="Front Pocket Style" child_style="Western Pocket">
                <!-- cuff style -->
                <img src="3dpant/nocuff.png" class="threedimage deactive" parent_style="Cuff" child_style="No Cuff">
                <img src="3dpant/cuff12.png" class="threedimage deactive" parent_style="Cuff" child_style='Cuff (1   1/2")'>
                <img src="3dpant/cuff34.png" class="threedimage deactive" parent_style="Cuff" child_style='Cuff (1   3/4")'>
                <!-- belt loop style -->
               <img src="3dpant/nobeltloop.png" class="threedimage deactive" parent_style="Waistband" child_style="No Belt Loop">
               <img src="3dpant/beltloop.png" class="threedimage deactive" parent_style="Waistband" child_style="Belt Loop">
               <img src="3dpant/abbutton.png" class="threedimage deactive" parent_style="Waistband" child_style="Adjustable with Button">
               <img src="3dpant/asbutton.png" class="threedimage deactive" parent_style="Waistband" child_style="Adjustable with Side Fasteners & Tab">

            </div>
            <!--             <button class="btn btn-default btn-sm" id="update_json" style="font-weight: 900;">Update Now</button>-->


        </div>
    </div>

    <div style="clear:both"></div>

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
            $(".measurment_summery1 table tr").find("td:last").remove()
        })


        function Confirmorder() {

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
            var header_mapping = {};
            jQuery.ajax({
                url: 'ajaxController.php',
                method: 'post',
                data: {
                    'customDataInsert': productStyleArray,
                    'user_id': userid,
                    'header_mapping': header_mapping,
                    'customDataInsertPrice': productStyleArrayPrice,
                    'custom_form': custom_form,
                    'measurement': measurment_profile_array,
                    'posture': posture_array,
                    'user_images': user_images,
                    'tag_id': tag_id,
                },
                success: function (data) {

                    window.location = "shopAllCart.php?backlink=1";
                }
            });
        }


    </script>
<?php } ?>


<script>
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


        $("#profile_name").val("<?php echo $tag_title; ?> <?php echo date('Ymdhis'); ?>").keyup();



            });

</script>

<div style="clear: both"></div>


<?php
include 'footer2.php';
?>




<script>
    temp = JSON.parse(<?php echo json_encode(phpjsonstyle($final1, 'json')); ?>);
    // console.log(temp);
    // console.log("fffffffffff");


    $(function () {
        for (i in temp) {
            $("[parent_style='" + i + "']").each(function () {
                $(this).removeClass("selected").addClass("deselect")
            });
            var tt = temp[i].trim();
            //console.log(tt);
            $("[parent_style='" + i + "'][child_style='" + tt + "']").removeClass("deselect").addClass("selected");

        }
        $(".style_selection").click(function () {
            var keys = $(this).attr('parent_style');
            var vals = $(this).attr('child_style');

            temp[keys] = vals;
            summary();
            //console.log(temp);

        });
        $("#monogram_2nd").keyup(function () {
            var keys = $(this).attr('parent_style');
            var vals1 = $(this).attr("extra_price");
            var vals2 = $(this).val();
            var vals = vals2 + ' ' + '($' + vals1 + ' ' + 'Extra)';
            temp[keys] = vals;
        })
        $("#monogram_1st").keyup(function () {
            var keys = $(this).attr('parent_style');
            var vals = $(this).val();
            temp[keys] = vals;
        })
//        $("input.style_selection").keyup(function () {
//            //console.log("dsfdf");
//            var keys = $(this).attr('parent_style');
//            var vals = $(this).val();
//            //console.log(vals);
//            // console.log(keys);
//
//            temp[keys] = vals;
//            //console.log(temp);
//            summary();
//        })
        $(".custom_form_style .style_selection").bind("click keyup", function () {

            var itsTitle = $(this).attr("parent_style");
            var selected_title = itsTitle;
            var selected_value = $(this).attr("child_style");

            var selected_price = $(this).attr("extra_price");
            /// console.log(selected_price);


            if ($(this).find("select").length) {
                var selected_value = $(this).find("select").val();
                selected_value = selected_value;
                // console.log(selected_value);
                temp[selected_title] = selected_value;
                summary();
            }
        });

        $("#update_json").click(function () {
            //console.log('hello');
            // temp['id'] = '<?php echo $_REQUEST['style_id']; ?>'
            $.ajax({
                url: 'ajaxController.php',
                method: 'post',
                data: {'updatedData': temp, 'style_id': '<?php echo $_REQUEST['style_id']; ?>'},
                success: function (data) {
                    console.log(data);
                    window.location.href = './preferences.php';
                }

            });

        })



    })

    function summary() {
        for (i in temp) {
            var k = temp[i];
            $("[styleselect='" + i + "']").text(temp[i]);
            if (i == 'Body Fit') {
                $('img[parent_style = "Body Fit"]').hide();
                $('img[parent_style = "Body Fit"][child_style = "' + k + '"]').show().css('opacity',1);
            }
            if (i == 'Number of Pleat') {
                $('img[parent_style = "Number of Pleat"]').hide();
                $('img[parent_style = "Number of Pleat"][child_style = "' + k + '"]').show().css('opacity',1);
            }
            if (i == 'Front Pocket Style') {
                $('img[parent_style = "Front Pocket Style"]').hide();
                $("img[parent_style = 'Front Pocket Style'][child_style = '" + k + "']").show().css('opacity',1);
            }
            if (i == 'Cuff') {
                $('img[parent_style = "Cuff"]').hide();
                $("img[parent_style = 'Cuff'][child_style = '" + k + "']").show().css('opacity',1);
                console.log($("img[parent_style = 'Cuff'][child_style = '" + k + "']"));
            }
             if (i == 'Waistband') {
                $('img[parent_style = "Waistband"]').hide();
                $('img[parent_style = "Waistband"][child_style = "' + k + '"]').show().css('opacity',1);
            }
            

        }
    }
    summary();


</script>




