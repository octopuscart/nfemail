<?php
include 'header.php';

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

    $data = $authobj->orderShippingDetail($_SESSION['user_id']);
    //print_r($data);
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;
             padding-bottom: 0px;

             box-shadow: 0px 3px 7px -1px #DBDADA;
             ">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Order Tracking</p>
            <div style="margin-top: 10px;">  


            </div>

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
                <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30" style=" margin-left: -40px;width: 18%;">	
                    <?php
                    include 'leftMenu.php';
                    ?>
                </aside>
              
                <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                    <div class="panel panel-default" style="width: 106%;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?></h3>
                        </div>
                        <div class="panel-body">
                             <?php if($data){?> 
                            <span data-toggle="" data-placement="left" title="View Pdf"><a href="./orderTrackingPaymentPdf.php?option=orderTracking&user_id=<?php echo $_SESSION['user_id'] ?>&tab=I&client_code=<?php echo $userInfo[0]['registration_id']?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px" target="_blank" class="btn btn-default btn-xm " ><i class="icon-eye" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Download Pdf"><a href="./orderTrackingPaymentPdf.php?option=orderTracking&user_id=<?php echo $_SESSION['user_id'] ?>&tab=D&client_code=<?php echo $userInfo[0]['registration_id']?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px"  class="btn btn-default btn-xm " ><i class="icon-download" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./orderTrackingMailSend.php?user_id=<?php echo $_SESSION['user_id'] ?>&client_code=<?php echo $userInfo[0]['registration_id']?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>

                        <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">
                            <table class="table table-striped table-bordered table-hover filterTable" >
                                <thead>
                                    <tr>
                                        <th style="font-size: 11px;text-align:left"><b>S.No.</b></th>
                                        <th style="font-size: 11px;text-align:left"><b>Order No.</b></th>
                                        <th style="font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Shipping Date<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Weight<b/></th>
<!--                                        <th style="font-size: 11px;text-align:left"><b>Sender Company<b/></th>-->
                                        <th style="font-size: 11px;text-align:left"><b>Destination Country<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Tracking No.<b/></th>
                                        <th style="font-size: 11px;text-align:center"><b>Shipping Company<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Status<b/></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        for ($i = 0; $i < count($data); $i++) {
                             
                                            if ($data) {
                                                ?>

                                                <td style="font-size: 12px;text-align: "><?php echo $i + 1 ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['order_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['invoice_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['shipping_date'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['total_weight'].' '.$data[$i]['weight_unit'] ?></td>
<!--                                            <td style="font-size: 12px;text-align: "><?php echo $data[$i]['sender_company'] ?></td>-->
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['destination_country'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['tracking_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['shipping_company'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['op_date_time'] ?></td>
                                                <td style="font-size: 12px;text-align: ">
                                                    <?php
                                                    $ids = $data[$i]['status'];
                                                    $stat = $authobj->statusTag($ids);
                                                    echo $stat[0]['title'];
                                                    ?>

                                                </td>

                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                </tbody>


                            </table>
                             <?php }else{  ?>
                        <center><span style="color: red;font-size: 20px;font-weight: 500;">NO ORDER FOUND FOR TRACKING</span></center>
                                 
                                 <?php }?>
                        
                        
                        </div>
                    </div>

                </div>
              
            </div>
            <!--banners-->
        </div>
    </div>
 
<?php
}
include 'footer.php';
?>

<link rel="stylesheet" type="text/css" media="all" href="../assets/datatables/dataTables.bootstrap.css">
<script src="../assets/datatables/jquery.dataTables.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('.filterTable').dataTable();
            // $("#searchPlace").html($($("#DataTables_Table_0_wrapper label")[1]).find("input").addClass("form-control").attr("type", "text").css("height", "34px"));
            $($("#DataTables_Table_0_wrapper label")[1]).remove();
            $("select[name='DataTables_Table_0_length']").remove();
            $("#DataTables_Table_0_length").remove();
        });
</script>
