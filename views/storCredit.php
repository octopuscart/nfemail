<?php
include 'header.php';
include '../producthandler/productHandler.php';
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
    $userid = $_SESSION['user_id'];
    $query = "SELECT  (sum(credit_amt) - sum(debit_amt)) as total  FROM `nfw_wallet` where user_id = $userid ";
    $res = resultAssociate($query);
    //print_r($res);
    $data = $authobj->user_wallet_detail($_SESSION[user_id]);
    $user_coupon = $authobj->userCouponDetail($_SESSION['user_id']);
   // print_r($user_coupon);
    ##############################################
    if (isset($_POST['coupon'])) {
        $cp = $authobj->stor_credit_calc($_REQUEST['discount_copon'], $_SESSION['user_id']);
        //print_r($cp);
    }
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Stored Credit</p>
            <div style="margin-top: 10px;">  </div>
        </div>
    </section>
    <style>
        .test th{
            border:none;
        }
        .test td{
            border:none;
        }
        .pagination>.active>a, 
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span, 
        .pagination>.active>span:focus, 
        .pagination>.active>span:hover {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #000;
            border-color: #000;
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
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <p> You have US  <span style="font-weight: bold;font-size: 24px;color: black;"><?php echo '$' . number_format($res[0]['total'], 2, '.', '') ?></span> available in stored credit</p>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-md-12">    
                                <button typt="button" id="btn" class="btn btn-default " style="margin-top: 10px;">Show Detail</button>
                            </div>
                            <div class="col-md-12">    
                                <table class="table table-striped table-bordered table-hover filterTable" style="display:none">
                                    <thead>

                                        <tr style="font-size: 12px">
                                            <th style=""><b>S.No.</b></th>
                                            <th style=""><b>Date & Time</b></th>
                                            <th style=""><b>Reference No.</b></th>
                                            <th style="width:"><b>Details</b></th>
                                            <th style=""><b>Credit Added</b></th>
                                            <th style="width:"><b>Credit Used</b></th>
                                            <th style="width:"><b>Reminder Status</b></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($data as $key => $value) {
                                            ?> 
                                            <tr  style="font-size: 12px">
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $value['date_time'] ?></td>
                                                <td><?php echo $value['reference_id'] ?></td>
                                                <td><?php echo $value['txn_type'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($value['credit_amt']) {
                                                        echo '$' . number_format($value['credit_amt'], 2, '.', '');
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($value['debit_amt']) {
                                                        echo '$' . number_format($value['debit_amt'], 2, '.', '');
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo substr($value['remark'], 0, 30) . '...' ?></td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr style="height: 0px;width: 97%;margin-left: 14px;">
                            <div class="col-md-12">
                                <span style="color:black">Available Coupon Discount</span>
                                <table class="table table-striped table-bordered table-hover couponTable">
                                    <thead>
                                          <tr  style="font-size: 12px">
                                            <td><b>S.No.</b></td>
                                            <td><b>Coupon Code</b></td>
                                            <td><b>Price Value</b></td>
                                            <td><b>Coupon Valid Till</b></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($user_coupon) {
                                            $c = 1;
                                            foreach ($user_coupon as $key => $value) {
                                                if($value['value_type'] == 'Fixed'){
                                                ?>
                                                 <tr  style="font-size: 12px">
                                                    <td><?php echo $c; ?></td>
                                                    <td><?php echo $value['coupon_code'] ;?></td>
                                                    <td><?php 
                                                     echo '$' . number_format($value['value'], 2, '.', '');
                                                   
                                                            ?></td>
                                                    <td><?php echo $value['end_date']; ?></td>
                                                </tr>
                                            <?php
                                            $c++;
                                            }
                                         }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
<!--                            <div class="col-md-12">
                                <table class="test">

                                    <tr class="bg_light_2">
                                        <td class="v_align_m">
                                            <div class="d_table w_full">
                                                <form method="post">

                                                    <span style="margin-left: -18px;">Move coupon amount to wallet</span><span style="text-align:right">:</span>
                                                    <input type="text" placeholder="Enter discount coupon" class="color_grey r_corners bg_light fw_light coupon m_xs_bottom_15" name="discount_copon" style="height:27px;width: 35%;margin-top: -2px;">
                                                    <button name="coupon" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset" id="discount" value="" type="submit">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
    <?php if ($cp['error']) { ?>
                                                <p style="color:red;margin-left: -53px;"><?php echo $cp['error']; ?></p>

                                                <?php
                                            }
                                            if ($cp['success']) {
                                                ?>
                                                <p style="color:green;margin-left: -53px;"><?php echo $cp['success']; ?></p>  
    <?php } ?>
                                        </td>
                                        <td>

                                        </td>

                                    </tr>
                                </table>
                            </div>-->
                        </div>

                    </div>
                </div>
                <!--banners-->
            </div>
        </div>
    </div>
<? } ?>
<?php
include 'footer.php';
?>
<link rel="stylesheet" type="text/css" media="all" href="../assets/datatables/dataTables.bootstrap.css">
<script src="../assets/datatables/jquery.dataTables.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.js"></script>
<script>
    $(function(){
        <?php 
        if ($cp['error']) { ?>
                
                                swal({title: "Something Went Wrong",
                                         text: "<?php echo $cp['error']?>",
                                         type: "error",
                                         timer: 2000,
                                        },function () {
                                               window.location = 'storCredit.php'
                                           });
       <?php }
        if ($cp['success']) { ?>
                
                                  swal({title: "Success!",
                                        text: "<?php echo $cp['success']?>",
                                        type: "success",
                                        timer: 2000,
                                         }, function () {
                                               window.location = 'storCredit.php'
                                           });
       <?php } ?>
    })
</script>
<script>
        $(document).ready(function () {
            $('.filterTable').dataTable();
          
            // $("#searchPlace").html($($("#DataTables_Table_0_wrapper label")[1]).find("input").addClass("form-control").attr("type", "text").css("height", "34px"));
            $($("#DataTables_Table_0_wrapper label")[1]).remove();
            $("select[name='DataTables_Table_0_length']").remove();
            $("#DataTables_Table_0_length").remove();
            $(".dataTables_info").hide();
            $(".dataTables_paginate").hide();
            ////////////////
             $(".couponTable").dataTable();
             $("select[name='DataTables_Table_1_length']").remove();
             $("#DataTables_Table_1_length").hide();
             $("#DataTables_Table_1_filter").hide();
        });
</script>
<script>
    $(function () {
        $("#btn").click(function () {
            if($(this).hasClass("active")){
                   $(this).removeClass("active").html("Show Detail");
            }
            else{$(this).addClass("active").html("Hide Detail")}
            $(".filterTable").toggle();
            $(".dataTables_info").toggle();
            $(".dataTables_paginate").toggle();
        });
        
    });

</script>
