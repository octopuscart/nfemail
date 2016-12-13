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


                <table class="" ng-repeat="product in productStyleArrayNg">
                    <tbody>
                        <tr>
                            <th class="headingthm ng-binding" colspan="4" data-title="FEB1" style="padding: 5px!important;">
                                <span style="float: left;">{{product.title}}</span> 
                                <span style="text-align: right;float:right">
                                    {{product.style_id}}
                                </span>
                            </th>
                        </tr>
                        <tr class="" ng-repeat="(k1, v1) in product.custom_data" >

                            <th class="headingth" ng-if="k1 != 'Additional Remark'">{{k1}}</th>

                            <td class="headingth " ng-if="k1 != 'Additional Remark'" >{{v1}}</td>
                            <td class="headingth headingth extra_price" ng-if="k1 != 'Additional Remark'">{{product.custom_data_price[k1]}}  </td>
                            <td style="width:10%" ng-if="k1 != 'Additional Remark'">
                                <span ng-if="product.style_id == ''">
                                    <button removedata='{{k1}}'  class="fa fa-edit navigate_data"  ng-click="removeElement(product, k1)"></button>
                                </span>
                                <span ng-if="product.style_id != ''">
                                    <button  >-</button>
                                </span>
                            </td>

                            <td class="headingth textareacount" colspan="5" ng-if="k1 == 'Additional Remark'">
                                <span style="margin-top: 10px;float: left">
                                    Your Space - Write Your Additional Wishes 
                                </span>
                                <span class="" style="float:right;margin-top: 10px;">
                                    Maximum 512 characters allowed.</span>
                                <textarea class="charachter_count form-control your_space_block selected" ng-model="product.custom_data[k1]" style="height:50px;    margin-bottom: 6px;    resize: vertical;width: 100%"  maxlength="512"> </textarea>
                                <span class="remians_ch" style="float:right;margin-top:-5px;"></span>
                            </td>


                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">Total</td>
                            <td class=" headingth total_price">  {{product.total_price}}    </td>
                            <td>
                            </td>
                        </tr>

                        <tr ng-if="productStyleArrayNg.length == $index + 1">
                            <td colspan="2" style="text-align: right">Grand Total</td>
                            <td class=" headingth total_price" >
                                {{grand_total}}
                            </td>
                            <td></td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        $(".charachter_count").keyup(function () {
            var total = 512;
            var vals = $(this).val().length;
            if (total > vals) {
                var remains = 512 - vals;
                //console.log(remains);
                $($(this).parents("td")[0]).find("span[class='remians_ch']").text(" " + remains + ' ' + "Characters remain");
                // $(".remians_ch").text("Maximum" + '' + remains + '' + "characters allowed");
            }
            else {
                $($(this).parents("td")[0]).find("span[class='remians_ch']").text("You have reached the limit");
            }

        });
    });
</script>