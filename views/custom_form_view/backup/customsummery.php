<div class="col-sm-3" id="containerBox" style="  max-width: 338px;  padding-bottom: 17px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div id="productImagesTemplate" class="">
                <input type="checkbox" id="checkboxs_all" name="" value="1" style="display: none">
                <h3 class="panel-title">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                    </span> 
                    <span id="style_heading" style="font-size: 15px;"></span>
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <div class='row' style="max-height: 400px;  max-width: 338px;margin-top: 10px;overflow-y: auto;"> 
                <?php
                for ($i = 0; $i < count($productArray); $i++) {
                    $productInfo = $cartprd->cartProductsInformation($productArray[$i], $_SESSION['user_id']);
                    ?>
                    <div class="col-md-12" style="padding:0px 10px">
                        <span class=""  style='  margin-top: 17px;
                              position: absolute;
                              margin-left: -10px;
                              /*font-size: 25px;*/
                              font-weight: 300;'>
                            <input type="checkbox" target_product="cart_<?php echo $productArray[$i]; ?>" id="checkboxs_<?php echo $i; ?>" name="" class="d_none check_icon product_check"   value="1">
                            <label for="checkboxs_<?php echo $i; ?>" class="d_inline_m m_right_10"></label>
                        <!--<i class='icon-circle-arrow-down' ></i>-->   
                        </span>
                        <div class="accordion toggle" style='  margin-left: 21px;'>

                            <dl class="accordion_item r_corners wrapper m_bottom_5 tr_all" style='padding:0px;padding-bottom: 5px; '>
                                <dt class="accordion_link relative color_dark tr_all" style='padding-bottom: 0px;'>

                                <span class="icon_wrap_size_1 circle d_block show">
                                    <i class="icon-minus"></i>
                                </span>

                                <span class="icon_wrap_size_1 circle d_block show">
                                    <i class="icon-plus"></i>
                                </span>

                                <div class="fabrics" style="padding: 5px; background: url(<?php echo $productInfo['image']; ?>); width: 88px;">
                                    <label class="cartTitle"><?php echo $productInfo['title']; ?></label>
                                </div>

                                <div class="selectedTitle" style="
                                     width: 117px;
                                     height: 50px;
                                     position: absolute;
                                     margin-top: -45px;
                                     font-size: 12px;
                                     margin-left: 99px;
                                     font-weight: 400;
                                     "></div> 
                                </dt>
                                <dd class="fw_light color_dark" style='  padding: 0px 5px;'>
                                    <ul class="list-group" style='padding: 5px 2px 0px 0px; margin-bottom: 0px;'>
                                        <?php
                                        for ($j = 0; $j < count($styleElement); $j++) {
                                            ?>
                                            <li class="list-group-item" style='padding: 0px;  font-size: 13px;'>
                                                <div class='col-sm-6 mes_title' style='  padding: 0px 5px;font-weight: 600;color: #49ABD9;'><?php echo $styleElement[$j]; ?></div>
                                                <div class='col-sm-6 mes_value' style='  padding: 0px 5px;font-weight: 600;color:#FF5E00;    '></div>
                                                <div style='clear:both'></div>
                                            </li>

                                        <?php }
                                        ?>
                                        <button class="btn btn-danger btn-xs removefabric" target_product="cart_<?php echo $productArray[$i]; ?>" style="  margin-top: 5px;">
                                            <i class="icon-cancel  tr_all translucent circle t_align_c" style="opacity:1"></i> Remove
                                        </button>    
                                    </ul>
                                </dd>
                            </dl>

                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-12 row" style="padding-top: 10px;">
                <button class="btn btn-warning btn btn-sm checkAllStyle" onclick="checkConfirmButton(this);" >
                    Check Summery
                </button>

                <div class="btn-group btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default previous previousStyle">
                       <span aria-hidden="true">&larr;</span> Previous 
                    </button>
                    <button type="button" class="btn btn-default next nextStyle">
                         Next <span aria-hidden="true">&rarr;</span>
                    </button>
                </div>


            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>