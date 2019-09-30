<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
            </span> 
            Summary
        </h3>
    </div>
    <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">
        <div class="row" style="  padding: 0px 10px;">
            <div class="measurment_summery1">
                <?php
                foreach ($cartIdMap as $key => $value) {
                    echo '<table class = "">';
                    echo '<tr><th class="headingthm" colspan="4" data-title="FEB1">' . $value . '</th></tr>';
                    foreach ($styleElement as $key1 => $value1) {

                        if ($key1 == 'Additional Remark') {
                            echo '<tr class="" parent="' . $key . '" removedata="' . $key1 . '">';

                            echo '<td class="headingth" colspan=4 parent="' . $key . '" ">'
                                    .'<span style="    margin-top: 10px;float: left">Your Space - Write Your Additional Wishes  </span><span style="float:right;margin-top: 10px;">Maximum 250 characters allowed.</span>'  
                                    . '<textarea class="form-control your_space_block selected" style="height:50px;    margin-bottom: 6px;    resize: vertical;" parent_style="Additional Remark"  target_product="' . $key . '" child_style="-" maxlength="250"> </textarea>'
                                    . '</td></tr>';
                        } else {
                            echo '<tr class="" parent="' . $key . '" removedata="' . $key1 . '">';
                            echo '<th class="headingth"  >' . $key1 . '</th>';
                            echo '<td class="headingth" parent="' . $key . '" styleselect="' . $key1 . '"></td>';
                            if ($extra_price_check == '1') {
                                echo '<td class="headingth extra_price" parent="' . $key . '"  extra_price="' . $key1 . '"></td>';
                            }
                            echo '<td style="width:10%"><i class="fa fa-edit removethis" parent="' . $key . '" removedata="' . $key1 . '"></i></td></tr>';
                        }
                    }
                    if ($extra_price_check == '1') {
                        echo '<tr><td colspan=2></td><td class=" headingth total_price"></td><td></td></tr>';
                    }
                }
                if ($extra_price_check == '1') {
                    echo '<tr  style="    border-top: 2px solid #000;"><td colspan=2 style="text-align:right">Grand Total (USD)</td><td class="headingth all_total_price"></td><td></td></tr>';
                }

                echo '</table>';
                ?>

            </div>
        </div>
    </div>
</div>