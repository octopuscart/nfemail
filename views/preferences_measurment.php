<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
if (isset($_REQUEST['tagid'])) {
    $order_data = $authobj->userMeasurment($_REQUEST['tagid'], $_SESSION['user_id']);
}
if (isset($_REQUEST['updateData'])) {
    $authobj->updateMeasurement($_POST);
}
if (isset($_REQUEST['setDefaultMeasurement'])) {
   $authobj->userDefaultMeasurement($_SESSION['user_id'],$_REQUEST['tagid'],$_REQUEST['measurement_style']);
   }
    $res = $authobj->SelectuserMeasurement($_SESSION['user_id'],$_REQUEST['tagid']);
    //print_r($res);
?>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
         padding-bottom: 0px;

         box-shadow: 0px 3px 7px -1px #DBDADA;
         ">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
        <p style="color:black;margin-top: 10px;">My Preferences</p>
        <div style="margin-top: 10px;">  


        </div>

    </div>
</section>
<style>
    .table th{
        border:none;
    }
    .table td{
        border:none;
    }
</style>
<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-2 col-sm-2 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
                <?php
                include 'leftMenu.php';
                ?>
            </aside>
            <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30"  style="width: 85%;">

                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                    </div>
                    <div class="panel-body">
                        <!-- body -->
                        <div class="col-md-12 well well-sm">
                            <?php
                            $tag = $authobj->preferenceTag();
                            for ($i = 0; $i < count($tag); $i++) {
                                $tagData = $tag[$i];
                                echo "<button style='margin-left:4px;' name='tagId' class='btn btn-danger btn-sm' onclick='find_tag_id(this)' id='" . $tagData['id'] . "'>" . $tagData['tag_title'] . "</button>";
                            }
                            ?>  
                        </div>
                        <div style="clear: both"></div>
                        <?php if ($order_data) { ?>
                            <div class="col-md-12 well well-sm">
                                <form method="post">

                                    <table class="table">
                                        <tr>
                                            <th style="">S.No.</th>
                                            <th style="">Set As Default</th>
                                            <th style="">Previous Measurement</th>
                                            <th style="">View Detail</th>

                                        </tr>
                                        <?php
                                        for ($i = 0; $i < count($order_data); $i++) {
                                            $data = $order_data[$i];
                                            ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td>
                                                    <input type="radio" id="radio_2_<?php echo $i; ?>" name="measurement_style" class="d_none" value="<?php echo $data['id']; ?>" <?php if ($data['id']==$res[0]['measurement_id']) { ?> checked <?php } ?> style="height: 31px;">
                                                    <label for="radio_2_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                                                </td>
                                                <td><?php echo $data['profile_name']; ?></td>
                                                <td>
                                                    <button name="" type="button" class="btn btn-primary btn-sm " onclick='find_style(this)' id ="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#myModal">View detail</button>
                                                
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </table>

                            </div>

                            <!-- body -->
                            <button type="submit" name="setDefaultMeasurement" class="btn btn-primary btn-sm redButton">
                                <i class="icon-check"></i> Submit
                            </button>
                        <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <!--banners-->
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header" style="background:#337ab7;color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Measurement Detail
                    </p>
                </div>

                <div class="modal-body">

                    <table id="table1">

                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary" name="updateData">
                        Submit changes
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header" style="background:#337ab7;color: white">
                    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Measurement Detail
                    </p>
                </div>

                <div class="modal-body">

                    <table id="table1">

                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" 
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary" name="updateData">
                        Submit changes
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    function find_tag_id(obj) {
        var ids = obj.id;
        //console.log(ids);
        window.location.replace("preferences_measurment.php?tagid=" + ids);
    }
</script>
<script>
    $(function () {
        $(".d_none").click(function () {
            $("#redButton").removeAttr("disabled");
        });
        //$("#myModal").draggable();

    });


</script>

<script>

    function find_style(obj) {
        var ids = obj.id;
        var tag = '<?php echo $_REQUEST['tagid'] ?>';
        var user_id = '<?php echo $_SESSION['user_id'] ?>';
        //console.log(tag);
        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'measurement_id': ids, 'tag_id': tag, 'user_id': user_id},
            success: function (data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
                var htmls = ''
                $.each(data, function (key, value) {
                   $.each(value, function (key, value) {
                        // console.log(key);
                        var keyData = key;
                        var keyData = key.split("_").join(" ");
                        //  console.log(keyData);
                        if(value!=''){
                        htmls += '<tr>';
                        htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                        htmls += "<td><input type='text' name='" + key + "' value='" + value + "' style='height: 31px;'></td>";
                        htmls += '</tr>';
                        }
                    });
                });

                $("#table1").html(htmls);
                $($('#table1 tr')[0]).hide();
//                $($('#table1 tr')[1]).hide();
//                $($('#table1 tr')[2]).hide();

            }


        });
    }




    ;
</script>

