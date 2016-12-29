<?php
include 'header.php';
include '../producthandler/productHandler.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmainbackend = strpos($baselink, '192.168') ? $baselink . '/nf3/gitnitaFashionsAdmin' : $baselink . '/nitaFashionsAdmin';
$baseurlbackend = $baselinkmainbackend . '/';
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {

    $order_data = $authobj->allOrderDetails($_SESSION['user_id']);
    // print_r($order_data);
    ?>

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Order Summary</p>
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
                            <span data-toggle="" data-placement="left" title="View Pdf"><a href="./orderSummaryViewPdf.php?user_id=<?php echo $_SESSION['user_id'] ?>&tab=I&client_code=<?php echo $userInfo[0]['registration_id'] ?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px" target="_blank" class="btn btn-default btn-xm " ><i class="icon-eye" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Download Pdf"><a href="./orderSummaryViewPdf.php?user_id=<?php echo $_SESSION['user_id'] ?>&tab=D&client_code=<?php echo $userInfo[0]['registration_id'] ?>"   style="padding: 0px 20px 14px 5px;height: 22px;width:0px"  class="btn btn-default btn-xm " ><i class="icon-download" ></i></a></span>
                            <span data-toggle="" data-placement="left" title="Send Mail"> <a href="./orderSummaryMailSends.php?user_id=<?php echo $_SESSION['user_id'] ?>&client_code=<?php echo $userInfo[0]['registration_id'] ?>" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm" ><i class="icon-mail"></i></a></span>

                            <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">
                            <table class="table table-striped table-bordered table-hover filterTable" >
                                <thead>
                                    <tr style="font-size: 12px">
                                        <th><b>S. No.</b></th>
                                        <th><b>Order No.</b></th>
                                        <th><b>Description</b></th>
                                        <th><b>Date/Time</b></th>
                                        <th><b>Total Price</b></th>
                                        <th><b>Order Status</b></th>
                                        <th style="    width: 90px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($order_data); $i++) {
                                        $orderData = $order_data[$i];
                                        //  print_r($orderData);
                                        ?>

                                        <tr style="font-size: 12px">
                                            <td> 
                                                <?php echo $i + 1 ?>
                                            </td>
                                            <td><?php echo $orderData['order_no'] ?></td>

                                            <td>
                                                <?php
                                                $datas = $authobj->countProducts($orderData['id']);
                                           
                                                $temp = array();
                                                for ($s = 0; $s < count($datas); $s++) {
                                                    $tag_id = $datas[$s];
                                                    // print_r($tag_id);
                                                    $catObj = new CategoryHandler();
                                                    $res = $catObj->productTag($tag_id['tag_id']);
                                                    //  print_r($res);
                                                    ?>
                                                    <span>
                                                        <?php
                                                        $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
                                                        array_push($temp, $string);
                                                        ?>
                                                    </span>

                                                    <?php
                                                }
                                                echo implode(', ', $temp);
                                                ?>

                                            </td>

                                            <td>
                                                <?php echo $orderData['op_date'] ?>/<?php echo $orderData['op_time'] ?> 
                                            </td>

                                            <td><?php echo '$' . number_format(explode('$', $orderData['total_price'])[1], 2, '.', '') ?>
                                            </td>
                                            <td>
                                                <?php echo $orderData['title'] ?>
                                            </td>

                                            <td> 
                                                <a href="orderDetail.php?order_id=<?php echo $orderData['id'] ?>" class="btn btn-default btn-xs"> Invoice</a>
                                                <a href="<?php echo $baseurlbackend; ?>index.php/UserRecordManagement/worker_order_receipt_pdf/<?php echo $orderData['id'] ?>/<?php echo $userInfo[0]['id']; ?>/all" class="btn btn-default btn-xs" target="_blank"> Style</a>
                                            </td>  

                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            <!--banners-->
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
    $(document).ready(function () {
        $('.filterTable').dataTable();
        // $("#searchPlace").html($($("#DataTables_Table_0_wrapper label")[1]).find("input").addClass("form-control").attr("type", "text").css("height", "34px"));
        $($("#DataTables_Table_0_wrapper label")[1]).remove();
        $("select[name='DataTables_Table_0_length']").remove();
        $("#DataTables_Table_0_length").remove();
    });
</script>

