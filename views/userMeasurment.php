<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
$shirt=$authobj->userMeasurement($_SESSION['user_id'],'shirt_customize_profile');
$pant=$authobj->userMeasurement($_SESSION['user_id'],'nfw_pant_customize_profile');
//print_r($pant);
    ?> 
<link rel="stylesheet" href="<?php echo $get_path['option_value'] . '../custom_fabric/css/style.css' ?>" type="text/css" >
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
         padding-bottom: 0px;
         background: url('../assets/images/cartbg2.jpg');
         box-shadow: 0px 3px 7px -1px #DBDADA;">
         <div class="container">
                 <h3 style="color: #000 !important; font-weight: 300">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
        <div style="margin-top: 10px;">   </div>
    </div>
</section>

<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30" style="">	

                <?php
                include 'leftMenu.php';
                ?>

            </aside>

            <section class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="box-shadow: 0px 0px 20px -9px;">
                <?php for($i=0;$i<count($shirt);$i++){
    $summary_id = $shirt[$i]['id'];
    $measurmentProfile = resultAssociate("select cmp.* from customer_measurement_profile as cmp join shirt_customize_profile as scp on scp.profile_id = cmp.id where scp.id = '$summary_id'  ");
?>
                <div class="collartab_head woocommerce"  style="width:100%"><div class="title cart-collaterals" style="width:100%"><a href="javascript:void(0)" style="width:100%" class="cart_totals "><h2 class="cartTitle">Style Summary</h2></a></div></div>
    
              <div class="boxlist1">
        <div id="summary_wrapper">
            <div class="summary_left" style="background-color: #E7F9FA;
               
                 border-color: #4e4ca0;
                 margin-left: 3px;
                 margin-top: 17px;"> 
                <div class="summ_closebt"></div>
                <div class="clear"></div>

                <div class="summ_title">Fabric No </div><div class="float_left">:</div><div class="summ_desc" id=""><?php echo $shirt[$i]['fabric_no']; ?></div><div class="clear"></div>
                <div class="summ_title">Shirt Body Fit </div><div class="float_left">:</div><div class="summ_desc" id="sm_fit"><?php
                    $data[0] = select_table('shirt_body_fit', "where shirt_body_fit_id='" . $shirt[$i]['shirt_body_fit'] . "'");
                    echo $data[0]['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Collar Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar"><?php
                    $collar = select_table('collar', "where id='" . $shirt[$i]['collar_styles'] . "'");
                    echo $collar['file_name'];
                    ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Button Down Collar</div><div class="float_left">:</div><div class="summ_desc" id="sm_button_style"><?php echo $shirt[$i]['button_down_collar']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Add 2 Buttons on the Collar Band </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_brand"><?php echo $shirt[$i]['add_2_buttons_on_the_collar_band']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar & Cuff Stiffness </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff_stiffness"><?php echo $shirt[$i]['collar_and_cuff_stiffness']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Collar Stays </div><div class="float_left">:</div><div class="summ_desc" id="sm_collar_stay"><?php echo $shirt[$i]['collar_stays']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Sleeve Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_sleeve_style"><?php echo $shirt[$i]['sleeve_styles']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Cuff Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_cuff"><?php
                    $cuff = select_table('cuff', "where id='" . $shirt[$i]['cuff_styles'] . "'");
                    echo $cuff['file_name'];
                    ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch </div><div class="float_left">:</div><div class="summ_desc" id="sm_watch"><?php echo $shirt[$i]['watch']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Watch Wrist</div><div class="float_left">:</div><div class="summ_desc" id="sm_watch_sub"><?php echo $shirt[$i]['watch_wrist']; ?></div><div class="clear"></div>
                <div class="clear"></div>
                <div class="summ_title">Front Styles </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_front"><?php
                    $front = select_table('front', "where id='" . $shirt[$i]['front_styles'] . "'");
                    echo $front['file_name'];
                    ?>
                </div>
                <div class="clear"></div>

                <div class="summ_title">Back Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_back"><?php
                    $back = select_table('back', "where id='" . $shirt[$i]['back_styles'] . "'");
                    echo $back['file_name']
                    ?></div><div class="clear"></div>

            </div>
            <div class="summary_right" style="background-color: #E7F9FA;
            
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 height: 461px;
                 margin-top: 17px; margin: 16px 9px 0px -10px;">

                <div class="summ_title">Dart </div><div class="float_left">:</div><div class="summ_desc" id="sm_dart"><?php echo $shirt[$i]['dart']; ?></div><div class="clear"></div>
                <div class="summ_title">Pocket Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_pocket"><?php
                    $pocket = select_table('pocket', "where id='" . $shirt[$i]['pocket_styles'] . "'");
                    echo $pocket['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Bottom Styles </div><div class="float_left">:</div> <div class="summ_desc" id="sm_bottom"><?php
                    $bottom = select_table('shirt', "where id='" . $shirt[$i]['bottom_styles'] . "'");
                    echo $bottom['file_name'];
                    ?></div>
                <div class="clear"></div>
                <div class="summ_title">Collar & Cuff Features </div><div class="float_left">:</div><div class="summ_desc" id="sm_cc_style"><?php $shirt[$i]['collar_and_cuff_features'] ?></div><div class="clear"></div>
                <div class="summ_title">Inner Collar Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc"><?php echo $shirt[$i]['inner_collar_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Cuff Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_icc2"><?php echo $shirt[$i]['inner_cuff_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Inner Front Placket Contrasts </div><div class="float_left">:</div><div class="summ_desc" id="sm_ifpc"><?php echo $shirt[$i]['innerfront_placket_contrasts']; ?></div><div class="clear"></div>
                <div class="summ_title">Labels </div><div class="float_left">:</div><div class="summ_desc" id="sm_label"><?php echo $shirt[$i]['labels'] ?></div><div class="clear"></div>
                <div class="summ_title">Buttons </div><div class="float_left">:</div>
                <div class="summ_desc" id="sm_button"><?php
                    $back = select_table('button', "where id='" . $shirt[$i]['buttons'] . "'");
                    echo $back['file_name'];
                    ?></div>
                <div class="clear"></div>
                <div class="summ_title">Monogram Placements </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_placement"><?php echo $shirt[$i]['monogram_placements'] ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Styles </div><div class="float_left">:</div><div class="summ_desc" id="sm_mono_style"><?php
                    $back = select_table('monogram', "where id='" . $shirt[$i]['monogram_styles'] . "'");
                    echo $back['file_name'];
                    ?></div><div class="clear"></div>
                <div class="summ_title">Monogram Colors </div><div class="float_left">:</div><div class="summ_desc" id="sm_monocolor"><?php echo $shirt[$i]['monogram_colors'] ?></div><div class="clear"></div>
                <div class="summ_title">Additional Feature </div><div class="float_left">:</div><div class="summ_desc" id="sm_req"><?php echo $shirt[$i]['additional_feature'] ?></div><div class="clear"></div>
                <div class="clear"></div>
            </div>
            <div style="clear: both"></div>
        </div> 
    
<div style="clear:both;height:2%">&nbsp;</div>
<div id="measurement_summ" style="display: block;">
    <div class="collartab_head woocommerce" id="accordian_11" onclick="accordian(this);" style="width:100%"><div class="title cart-collaterals" style="width:100%"><a href="javascript:void(0)" style="width:100%" class="cart_totals "><h2 class="cartTitle">Measurement Summary</h2></a></div></div>
    <div class="boxlist1">
        <div id="summary_wrapper">

            <div class="summary_left" style="background-color: #E7F9FA;
               
                 border-color: #4e4ca0;
                 margin-left: 3px;height: 270px;
                 margin-top: 17px;">
                <div class="summ_title">Profile Name</div><div class="float_left">:</div><div class="summ_desc profile_name"><?php echo $measurmentProfile[0]['profile_name']; ?></div><div class="clear"></div>
                <div class="summ_title">Gender</div><div class="float_left">:</div><div class="summ_desc profile_gender"><?php echo $measurmentProfile[0]['gender']; ?></div><div class="clear"></div>
                <div class="summ_title">Height</div><div class="float_left">:</div><div class="summ_desc"><?php echo $measurmentProfile[0]['height']; ?></div><div class="clear"></div>
                <div class="summ_title">Weight</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['weight']; ?></div><div class="clear"></div>
                <div class="summ_title">Neck Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['neck_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Chest Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_chest_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Full Shoulder Width Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['full_shoulder_width_measurement']; ?></div><div class="clear"></div>

                <div class="clear"></div>
            </div>
            <div class="summary_right" style="background-color: #E7F9FA;
              
                 border-color: #4e4ca0;
                 margin-left: 15px;
                 margin-top: 17px;margin: 17px 9px 50px -10px;">
                <div class="summ_title">Right Sleeve Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['right_sleeve_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Left Sleeve Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['left_sleeve_measurement']; ?></div><div class="clear"></div>

                <div class="summ_title">Bicep Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['bicep_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Wrist Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['wrist_measurement']; ?></div><div class="clear"></div>

                <div class="summ_title">Waist/Stomach Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['waist_or_stomach_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Hips/Seat Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['hips_or_seat_measurement']; ?></div><div class="clear"></div>
                <div class="summ_title">Front Shirt/Jacket Length Measurement</div><div class="float_left">:</div><div class="summ_desc profile_weight"><?php echo $measurmentProfile[0]['front_shirt_or_jacket_length_measurement']; ?></div><div class="clear"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
                }
function select_table($table_name, $condition) {
    $sql_data = mysql_query("select * from  $table_name $condition");
    //echo "select * from  $table_name $condition";
    $get_data = mysql_fetch_array($sql_data);
    return $get_data;
}
?>
            </section>
        </div>
        <!--banners-->
    </div>
</div>
<script>
    function setSummery() {
        var htmls = "<table class='table'>";
        for (i in productStyleArray) {
            var temp = productStyleArray[i];
            htmls += "<tr><th class='headingthm' colspan=3>" + cartIdMap[i] + "(" + i + ")</th></tr>";
            for (j in temp) {
                var temp2 = temp[j];

                if (temp2 == "") {

                    htmls += "<tr class='errortd'><th class='headingth errortd' parent='"+i+"' removedata='"+j+"' >" + j + "</th><td class='headingth errortd'>" + temp2 + "</td>"
                    htmls += "<td><i class='fa fa-times-circle removethis' parent='"+i+"' removedata='"+j+"'></td></tr>";
                }
                else {
                    htmls += "<tr ><th class='headingth'>" + j + "</th><td class='headingtd'>" + temp2 + "</td>";
                    htmls += "<td><i class='fa fa-times-circle removethis' parent='"+i+"' removedata='"+j+"'></td></tr>";
                }
            }
        }
        htmls += "<tr><th class='headingthm' colspan=3>Your Space</th></tr>";
        htmls += "<tr><th class='final_summary' colspan=3 ></th></tr>";
        htmls += "</table>"
        $(".measurment_summery").html(htmls);
        return htmls;
    }
</script>
<?php
include 'footer.php';
?>
