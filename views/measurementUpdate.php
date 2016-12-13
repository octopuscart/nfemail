<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);


######################################################### 
$tag_id = $_REQUEST['tag_id'];
$query = "SELECT measurement_list,posture_list FROM `nfw_product_tag` where id = $tag_id ";
$result = resultAssociate($query);
$final_data = explode(',', $result[0]['measurement_list']);
#############
$measurement_data = $authobj->profile_name($_REQUEST['measurement_id']);
//print_r($measurement_data);
$final2 = phpjsonstyle($measurement_data['measurement_data'], 'php');
$post_data = phpjsonstyle($measurement_data['posture_data'], 'php');
//print_r($post_data);
$ss = explode(' ', $final2['Weight']);
########################################################
$pos_id = $result[0]['posture_list'];
########################################################
?>
<style>
    .addTable tr{
        border:none;
    }
    .addTable td{
        border:none;
    }
</style>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?> (Client Code : <?php echo $userInfo[0]['registration_id'] ?>)</h3>
        <p style="color:black;margin-top: 10px;">Update Measurement</p>
        <div style="margin-top: 10px;">  


        </div>

    </div>
</section>
<div class="col-md-12" style="margin-top: 10px">


    <div class="col-md-8">

        <div class="panel panel-default" style="">
            <div class="panel-heading">
                <h3 class="panel-title"> Update Measurement</h3>
            </div>
            <div class="panel-body">
                <!-- -->
                <div class="col-md-12 col-xs-12" style="margin-top: 10px;padding: 6px;">
                    <table style="" class="table table-bordered">
                        <tr>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Profile Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="profile" class="form-control" id="" placeholder="Profile Name" parent="Profile" value="<?php echo $final2['Profile'] ?>">
                            </div>
                        </div>
                        </tr>
                    </table>

                    <table style="" class="table table-bordered mesTable">

                        <tbody>
                            <tr>
                                <td  style="line-height: 2;">Gender</td>
                                <td>
                                    <div class="col-md-12 col-xs-12" style="padding: 0">
                                        <div class="col-md-6 col-xs-6" style="padding: 0px;">
                                            <select class="form-control chestBodyAllowance " parent="Gender" style="padding: 0px;width: 150px;height: 31px;" name="chest_body" id="chest_body">
                                                <?php echo "<option>" . $final2['Gender'] . "</option>" ?>;
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>

                                    </div>
                                </td>


                            </tr>

                            <tr>
                                <td  style="line-height: 2;">Height</td>
                                <td>
                                    <div class="col-md-12 col-xs-12" style="padding: 0">
                                        <div class="col-md-6 col-xs-6" style="padding: 0px;">
                                            <select class="form-control chestBodyAllowance " parent="Height" style="padding: 0px;width: 150px;height: 31px;" name="chest_body" id="chest_body">

                                                <?php
                                                echo "<option>" . $final2['Height'] . "</option>";
                                                $i = 2;
                                                while ($i <= 8) {
                                                    echo '<option >' . $i . ' Feet  0 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  1 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  2 Inches</option> ';
                                                    echo '<option >' . $i . ' Feet  3 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  4 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  5 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  6 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  7 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  8 Inches</option> ';
                                                    echo '<option >' . $i . ' Feet  9 Inches</option>';
                                                    echo '<option >' . $i . ' Feet  10 Inches</option>';
                                                    echo '<option >' . $i . ' Feet   11 Inches</option>';
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td  style="line-height: 2;">Weight</td>
                                <td>
                                    <select class="form-control waistBodyAllowance" parents ="Weight1" style="padding: 0px;width:60px;height: 31px;float: left" name="waist_body" >
                                        <?php
                                        $i = 20;
                                        echo "<option>" . $ss[0] . "</option>";
                                        while ($i <= 400) {
                                            echo "<option>" . $i . "</option>";
                                            $i++;
                                        }
                                        ?>

                                    </select>
                                    <select class="form-control waistBodyAllowance" parents ="Weight2" style="margin-left: 32%;padding: 0px;width:60px;height: 31px;" name="waist_body">
                                        <?php
                                        echo "<option>" . $ss[1] . "</option>";
                                        echo "<option>" . Lbs . "</option>";
                                        echo "<option>" . Kg . "</option>";
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td  style="line-height: 2;">Age</td>
                                <td>
                                    <div class="col-md-12 col-xs-12" style="padding: 0">
                                        <div class="col-md-6 col-xs-6" style="padding: 0">
                                            <select class="form-control hipsBodyAllowance" parent="Age" style="padding: 0px;width: 81px;height: 31px;" name="hips_body">

                                                <?php
                                                echo "<option>" . $final2['Age'] . "</option>";
                                                $i = 5;
                                                while ($i <= 110) {
                                                    echo "<option>" . $i . "</option>";
                                                    $i++;
                                                }
                                                ?>

                                            </select>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            <?php
                            for ($i = 0; $i < count($final_data); $i++) {
                                $meas_id = $final_data[$i];
                                $query = "SELECT title,measurement_text,min_value,max_value FROM `nfw_measurement` where id = $meas_id ";
                                $result2 = resultAssociate($query);
                                //print_r($result2);
                                for ($k = 0; $k < count($result2); $k++) {
                                    ?>

                                    <tr>
                                        <td  style="line-height: 2;"><?php echo $result2[$k]['title']; ?></td>
                                        <td>
                                            <div class="col-md-12 col-xs-12" style="padding: 0">
                                                <div class="col-md-6 col-xs-6" style="padding: 0px;">
                                                    <select class="form-control chestBodyAllowance " parent="<?php echo $result2[$k]['title']; ?>" style="padding: 0px;width: 81px;height: 31px;" name="chest_body" id="chest_body">

                                                        <?php
                                                        $j = $result2[$k]['min_value'];
                                                        echo "<option>" . $final2[$result2[$k]['title']] . "</option>";
                                                        while ($j <= $result2[$k]['max_value']) {
                                                            echo '<option >' . $j . '   ' . '  "</option>';
                                                            echo '<option >' . $j . '   ' . '  1/8"</option>';
                                                            echo '<option >' . $j . '   ' . '  1/4"</option>';
                                                            echo '<option >' . $j . '   ' . '  3/8"</option> ';
                                                            echo '<option >' . $j . '   ' . '  1/2"</option>';
                                                            echo '<option >' . $j . '   ' . '  5/8"</option>';
                                                            echo '<option >' . $j . '   ' . '  3/4"</option>';
                                                            echo '<option >' . $j . '   ' . '  7/8"</option>';
                                                            $j++;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
                <!-- -->
            </div>
        </div>


    </div>
    <div class="col-md-4">
        <div class="panel panel-default" style="">
            <div class="panel-heading">
                <h3 class="panel-title"> Update Posture</h3>
            </div>
            <div class="panel-body">
                <table style="" class="table table-bordered posTable">

                    <tbody>
                        <?php
                        // print_r($pos_id);
                        $pos_id4 = explode(',', $result[0]['posture_list']);
                        //print_r($pos_id);
                        for ($f = 0; $f < count($pos_id4); $f++) {
                            $p_id = $pos_id4[$f];
                            //print_r($p_id);
                            $query = "SELECT title FROM `nfw_custom_element` where id = $p_id ";
                            $result1 = resultAssociate($query);
                            //print_r($result1);
                            $query1 = "SELECT title FROM `nfw_custom_element_field` where nfw_custom_element_id = $p_id";
                            $result2 = resultAssociate($query1);
                            ?>

                            <tr>
                                <td  style="line-height: 2;"><?php echo $result1[0]['title']; ?></td>
                                <td>
                                    <select class="form-control chestBodyAllowance " parent="<?php echo $result1[0]['title'] ?>" style="padding: 0px;width:180px;height: 31px;" name="chest_body" id="chest_body">
                                        <?php
                                        echo '<option >' . $post_data[$result1[0]['title']] . '</option>';
                                        for ($j = 0; $j < count($result2); $j++) {
                                            echo '<option >' . $result2[$j]['title'] . '</option>';
                                        }
                                        ?>

                                </td>

                            </tr>

                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="..." style='margin-top: 10px;    width: 100%;'>
            <button class="btn btn-default" type="submit" name="updateData" id="updateData" style="    
                    color: #fff;    width: 50%;
                    background-color: red;">
                <i class='fa fa-save' style='line-height: 20px;'></i>  Update Now</button>
            <a  onclick='closeWindow()' class="btn btn-default" style='

                color: #fff;    width: 50%;
                background-color: black;
                '>
                <i class='fa fa-times' style='line-height: 20px;'></i> Cancel</a>

        </div>
        <script>
            function closeWindow() {
                window.close();
            }
        </script>
    </div>





</div>
<div style="clear: both"></div>
<?php
include 'footer.php';
?>
<script>
    $(function () {
        var temp = {};
        var posTemp = {};
        $("#updateData").click(function () {

            $(".mesTable tr td select[parent]").each(function () {
                var keys = $(this).attr('parent');
                var vals = $(this).val();
                temp[keys] = vals;
            });
            var w2 = $("select[parents = 'Weight2']").val();
            var w1 = $("select[parents = 'Weight1']").val();
            temp['Weight'] = w1 + ' ' + w2;
            temp['Profile'] = $("input[name='profile']").val();
            //console.log(temp);
            $(".posTable tr td select[parent]").each(function () {
                var keys1 = $(this).attr('parent');
                var vals1 = $(this).val();
                posTemp[keys1] = vals1;
            });
            // console.log(posTemp);
            $.ajax({
                url: 'ajaxController.php', 
                method: 'post',
                data: {'keys': temp, 'mes_id': '<?php echo $_REQUEST['measurement_id'] ?>', 'postdata': posTemp},
                success: function (data) {
                    console.log(data);
                    window.location.href = './preferences.php';

                }

            });
        });
    });
</script>