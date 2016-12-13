<?php
include 'header.php';
include '../producthandler/shippingHandler.php';
$addobj = new AddressHandler();
$data = $addobj->billing_shipping_information();
?>
<div class="section_offset counter" style="padding: 0px;">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_45 m_xs_bottom_30" style="margin-top: 40px;">
            <h5 class="color_dark fw_light m_bottom_23" style="font-weight: bold;">Billing Information</h5>
            <div class="r_corners wrapper border_grey">
                <table class="w_full responsive_table t_align_l three_columns">
                    <thead>
                        <tr class="bg_light_2 color_dark">
                            <th style="width: 15%;">First Name</th>
                            <th style="width: 15%;">Last Name</th>
                            <th style="width: 15%;">Mobile no</th>
                            <th style="width: 15%;">City</th>
                            <th style="width: 15%;">Email</th>
                            <th style="width: 25%;">Billing Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data['billing']) {
                            foreach ($data['billing'] as $key => $value) {

                                echo '<tr class="fw_light tr_delay">';
                                echo '<td>' . $value['first_name'] . '</td>';
                                echo '<td>' . $value['last_name'] . '</td>';
                                echo '<td>' . $value['mobile_no'] . '</td>';
                                echo '<td>' . $value['city'] . '</td>';
                                echo '<td>' . $value['email_id'] . '</td>';
                                echo '<td>' . $value['address1'] . $value['address2'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_45  m_xs_bottom_30">
            <h5 class="color_dark fw_light m_bottom_23"  style="font-weight: bold;">Shipping Information</h5>
            <div class="r_corners wrapper border_grey">
                <table class="w_full responsive_table t_align_l three_columns" style="width: 100%;">
                    <thead>
                        <tr class="bg_light_2 color_dark">
                            <th style="width: 15%;">First Name</th>
                            <th style="width: 15%;">Last Name</th>
                            <th style="width: 15%;">Mobile no</th>
                            <th style="width: 15%;">City</th>
                            <th style="width: 15%;">Email</th>
                            <th style="width: 25%;">Billing Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data['shipping']) {
                            foreach ($data['shipping'] as $key => $value) {

                                echo '<tr class="fw_light tr_delay">';
                                echo '<td>' . $value['s_first_name'] . '</td>';
                                echo '<td>' . $value['s_last_name'] . '</td>';
                                echo '<td>' . $value['s_mobile_no'] . '</td>';
                                echo '<td>' . $value['s_city'] . '</td>';
                                echo '<td>' . $value['s_email_id'] . '</td>';
                                echo '<td>' . $value['s_address1'] . $value['s_address2'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div></div>
<?php
include 'footer.php';
?>
