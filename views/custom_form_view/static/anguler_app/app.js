function validator(divTitle, option) {
    console.log(divTitle, option);
    if (option == 'hide') {
        $("[navigate_to='" + divTitle + "']").hide();
    }
    else {
        $("[navigate_to='" + divTitle + "']").show();
    }
}



nitaFasions.filter('sumOfValue', function () {
    return function (data) {
        if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;
        var sum = 0;
        angular.forEach(data, function (value) {
            if (value) {
                sum = sum + parseInt(value);
            }
        });
        return sum;
    }
});


nitaFasions.filter('sumOfTotal', function () {
    return function (producttotal) {
        var sum = 0;
        angular.forEach(producttotal, function (value) {
            sum = sum + parseInt(value['total_price']);
        });
        return sum;
    }
});


nitaFasions.filter('validation', function () {
    return function (product) {

        angular.forEach(product, function (key) {

            console.log(key, '--');

        });

    }
});


nitaFasions.filter('htmlBinder', function () {
    return function (title) {

        return title.replace("<br>", "")

    }
});




nitaFasions.controller('CustomController', function ($scope, $http, $filter, $timeout) {

    $scope.grand_total = 0;


    $scope.selected_child_ng = 'Body Fit';
    $scope.selected_parent_ng = '';
    $scope.productStyleArrayNg = productStyleArray;
    $scope.defaultSelection = default_select_globle;
    $scope.blankEntry = blankSelection;
    //shop stored data
    $scope.shopStored = angular.copy(default_select_globle);
    for (i in $scope.shopStored) {
        $scope.shopStored[i] = '*****'
    }
    //end of shop stored



    var collarValidation = {
        'Wing Tip (2")': {
            'div_option': {'Add 2 Buttons On The Collar Band': 'hide', 'Collar Stays': 'hide'},
            'validate': {'Add 2 Buttons On The Collar Band': 'No', 'Collar Stays': 'No'}
        },
        'Mandarin    (1  1/4")': {
            'div_option': {'Add 2 Buttons On The Collar Band': 'hide', 'Collar Stays': 'hide'},
            'validate': {'Add 2 Buttons On The Collar Band': 'No', 'Collar Stays': 'No'}
        },
        'Short Point Button Down    (1 1/2" x 2  1/2")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
        'Regular Button Down    (1  5/8" x 3 1/4")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
        'Hidden Button Down  (1 5/8" x 3")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
    };




    $scope.preferredStyle = preferdStyleArray;
    $scope.preferred_style = '';
    $scope.selectAllCheck = false;
    for (i in $scope.productStyleArrayNg) {
        var obj = $scope.productStyleArrayNg[i];
        obj['custom_data'] = angular.copy($scope.defaultSelection);
    }




    $scope.setShopStored = function () {
        for (i in $scope.productStyleArrayNg) {
            var obj = $scope.productStyleArrayNg[i];
            obj['custom_data'] = angular.copy($scope.shopStored);
        }
    }


    $scope.selectFabricForPreferred = function (product) {
        if (product.style_select) {
            product.style_id = $scope.preferred_style.style_profile;
            product.custom_data = angular.copy($scope.preferred_style.custom_data);
            product.custom_data_price = angular.copy($scope.preferred_style.custom_data_price);
            product.total_price = $filter('sumOfValue')(product.custom_data_price);
            $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
        }
        else {
            product.style_id = '';
            product.custom_data = angular.copy($scope.defaultSelection);
            product.custom_data_price = angular.copy($scope.blankEntry);
            product.total_price = 0;
        }

    }


    $scope.selectPreferredStyle = function (obj) {
        $scope.preferred_style = obj;
    }

    $scope.selectStyle = function (parent, child, price, validation_dict, unwanted) {
        console.log(parent);
        $scope.selected_parent_ng = parent;
        $scope.selected_child_ng = child;
        $scope.selected_validation = validation_dict;
        $scope.unwanted = unwanted;

        $(".check_icon_all").attr("disabled", false).removeClass("disablecheckbox");
        $(".check_icon").attr("disabled", false).removeClass("disablecheckbox");

        switch ($scope.selected_parent_ng) {
            
            
            //changes on 06-05-2018
            case 'Body Fit':
                $(".check_icon_all").attr("disabled", "true").addClass("disablecheckbox");
                $(".check_icon").attr("disabled", "true").addClass("disablecheckbox");
                for (i in $scope.productStyleArrayNg) {
                    var obj = $scope.productStyleArrayNg[i];
                    obj['custom_data'][$scope.selected_parent_ng] = child;
                }
                break
                
            
            case 'Wrist Watch':
                $(".check_icon_all").attr("disabled", "true").addClass("disablecheckbox");
                $(".check_icon").attr("disabled", "true").addClass("disablecheckbox");
                for (i in $scope.productStyleArrayNg) {
                    var obj = $scope.productStyleArrayNg[i];
                    obj['custom_data'][$scope.selected_parent_ng] = child;
                }
                break
            
            
            case 'Label':
                $(".check_icon_all").attr("disabled", "true").addClass("disablecheckbox");
                $(".check_icon").attr("disabled", "true").addClass("disablecheckbox");
                for (i in $scope.productStyleArrayNg) {
                    var obj = $scope.productStyleArrayNg[i];
                    obj['custom_data'][$scope.selected_parent_ng] = child;
                }
                break
                
            //end of changes 06-05-2018    


            case 'Collar Style':
                $scope.unwanted = {'Add 2 Buttons On The Collar Band': 'show', 'Collar Stays': 'show'};


                if (collarValidation[$scope.selected_child_ng]) {
                    var obj = collarValidation[$scope.selected_child_ng];
                    $scope.unwanted = obj['div_option'];
                    $scope.selected_validation = obj['validate'];
                }
                break;

            case 'Front Style':
                $scope.unwanted = {};

                if ($scope.selected_child_ng.indexOf('Double') == 0) {
                    $scope.selected_validation = {'Front Edge': 'Squared'};
                }
                break;

            case 'Lapel Style & Width':
                $scope.unwanted = {};
                if ($scope.selected_child_ng == 'No Lapel') {
                    $scope.selected_validation = {'Lapel Button Hole': 'No', 'Handstitching': 'No'};
                }
                if ($scope.selected_child_ng.indexOf("Shawl") != -1) {
                    $scope.selected_validation = {'Lapel Button Hole': 'No', 'Handstitching': 'No'};
                }
                break

            case 'Waistcoat Lapel Style & Width':
                $scope.unwanted = {};
                if ($scope.selected_child_ng == 'No Lapel') {
                    $scope.selected_validation = {'Waistcoat Lapel Button Hole': 'No', ' Waistcoat Handstitching': 'No'};
                }
                break

            case '1st Monogram Placement':
                if ($scope.selected_child_ng == 'No Monogram') {
                    $scope.unwanted = {
                        '1st Monogram Style': 'hide',
                        '1st Monogram Initial': 'hide',
                        '1st Monogram Color': 'hide',
                        '2nd Monogram Style': 'hide',
                        '2nd Monogram Initial': 'hide',
                        '2nd Monogram Color': 'hide', };
                    $scope.selected_validation = {
                        '1st Monogram Style': '-',
                        '1st Monogram Initial': '-',
                        '1st Monogram Color': '-',
                        '2nd Monogram Placement': 'No Monogram',
                        '2nd Monogram Style': '-',
                        '2nd Monogram Initial': '-',
                        '2nd Monogram Color': '-', };
                }
                else {
                    $scope.unwanted = {
                        '1st Monogram Style': 'show',
                        '1st Monogram Initial': 'show',
                        '1st Monogram Color': 'show',
                        '2nd Monogram Style': 'show',
                        '2nd Monogram Initial': 'show',
                        '2nd Monogram Color': 'show', };
                }
                break;

            case '2nd Monogram Placement':
                if ($scope.selected_child_ng == 'No Monogram') {
                    $scope.unwanted = {
                        '2nd Monogram Style': 'hide',
                        '2nd Monogram Initial': 'hide',
                        '2nd Monogram Color': 'hide', };
                    $scope.selected_validation = {
                        '2nd Monogram Style': '-',
                        '2nd Monogram Initial': '-',
                        '2nd Monogram Color': '-', };
                }
                else {
                    $scope.unwanted = {
                        '1st Monogram Style': 'show',
                        '1st Monogram Initial': 'show',
                        '1st Monogram Color': 'show',
                        '2nd Monogram Style': 'show',
                        '2nd Monogram Initial': 'show',
                        '2nd Monogram Color': 'show', };
                }
                break;

        }

        if ($scope.unwanted) {
            angular.forEach($scope.unwanted, function (v, k) {
                validator(k, v);
            })
        }
        $scope.selected_child_price = price;
        $scope.selectAllCheck = false;
        for (i in $scope.productStyleArrayNg) {
            var obj = $scope.productStyleArrayNg[i];
            obj['selected'] = false;
        }
    }

    $scope.selectStyle('Body Fit', $scope.defaultSelection['Body Fit'])

    //Collary Stays Validation array
    var collar_stays = {
        'select': ['Short Point Button Down    (1 1/2" x 2  1/2")', 'Regular Button Down    (1  5/8" x 3 1/4")', 'Hidden Button Down  (1 5/8" x 3")', 'Wing Tip (2")', 'Mandarin    (1  1/4")'],
        'validate': ['Permanent', 'Removable']
    };
    //End of Collary Stays Array

    // Add 2 Buttons On The Collar Band Validation
    var add_two_button = {
        'select': ['Wing Tip (2")', 'Mandarin    (1  1/4")'],
        'validate': ['Yes']
    };
    // End of Add 2 Buttons On The Collar Band

    //Sort Sleeve Validation
    var sort_sleeve_watch = {
        'select': ['Short Sleeve With Cuff', 'Short Sleeve Without Cuff'],
        'validate': ['Right Wrist', 'Left Wrist']
    };
    // End of Sort Sleeve Validation

    //Sort Sleeve to monogram
    var cuff_style_monogram = {
        'validate': ['Short Sleeve With Cuff', 'Short Sleeve Without Cuff'],
        'select': ['Left Sleeve Placket', 'Left Cuff']
    }
    //End of sort slive to monogram

    $scope.selectFabric = function (product) {
        console.log($scope.selected_parent_ng, $scope.selected_child_ng);
        product.animate = '';
        switch ($scope.selected_parent_ng) {
            case 'Collar Stays':
                if (collar_stays['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (collar_stays['select'].indexOf(product['custom_data']['Collar Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;


            case 'Body Fit':
                console.log("Body Fit Case Selected")
                break;



            case 'Add 2 Buttons On The Collar Band':
                if (add_two_button['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (add_two_button['select'].indexOf(product['custom_data']['Collar Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case 'Cuff Style':
                if (cuff_style_monogram['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (cuff_style_monogram['select'].indexOf(product['custom_data']['1st Monogram Placement']) >= 0) {
                        var unwanted = {
                            '1st Monogram Style': 'hide',
                            '1st Monogram Initial': 'hide',
                            '1st Monogram Color': 'hide',
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '1st Monogram Placement': 'No Monogram',
                            '1st Monogram Style': '-',
                            '1st Monogram Initial': '-',
                            '1st Monogram Color': '-',
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                    if (cuff_style_monogram['select'].indexOf(product['custom_data']['2nd Monogram Placement']) >= 0) {
                        var unwanted = {
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                }
                break;


            case 'Pocket Style':
                if ($scope.selected_child_ng == 'No Pocket') {
                    if (product['custom_data']['1st Monogram Placement'] == 'Left Chest Pocket') {
                        $scope.unwanted = {
                            '1st Monogram Style': 'hide',
                            '1st Monogram Initial': 'hide',
                            '1st Monogram Color': 'hide',
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };

                        $scope.selected_validation = {
                            '1st Monogram Placement': 'No Monogram',
                            '1st Monogram Style': '-',
                            '1st Monogram Initial': '-',
                            '1st Monogram Color': '-',
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };

                    }
                    if (product['custom_data']['2nd Monogram Placement'] == 'Left Chest Pocket') {
                        var unwanted = {
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                }
                break;

            case 'Wrist Watch':
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '1st Monogram Style':

                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '1st Monogram Initial':

                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;
            case '1st Monogram Color':
                product.animate = '';
                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;

            case '1st Monogram Placement':

                switch ($scope.selected_child_ng) {
                    case 'Left Chest Pocket':
                        if (product['custom_data']['Pocket Style'] == 'No Pocket') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;

                    case ('Left Cuff'):
                        product.animate = '';
                        if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;

                    case ('Left Sleeve Placket'):
                        product.animate = '';
                        if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;
                }
                break;

            case '2nd Monogram Style':

                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '2nd Monogram Initial':

                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;
            case '2nd Monogram Color':
                product.animate = '';
                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;

            case '2nd Monogram Placement':
                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                else {
                    if (product['custom_data']['1st Monogram Placement'] == $scope.selected_child_ng) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                    else {
                        switch ($scope.selected_child_ng) {
                            case 'Left Chest Pocket':
                                if (product['custom_data']['Pocket Style'] == 'No Pocket') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;

                            case ('Left Cuff'):
                                product.animate = '';
                                if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;

                            case ('Left Sleeve Placket'):
                                product.animate = '';
                                if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;
                        }
                    }
                }
                break;


            default:
                product.animate = '';
                break

        }




        if ($scope.selected_validation) {
            console.log($scope.selected_validation);
            angular.forEach($scope.selected_validation, function (v, k) {
                product['custom_data'][k] = product['selected'] ? v : $scope.defaultSelection[k];
            })
            //product['custom_data'][$scope.selected_parent_ng_ref] = product['selected'] ? $scope.selected_child_ng_ref : $scope.defaultSelection[$scope.selected_parent_ng_ref];
        }



        product['custom_data'][$scope.selected_parent_ng] = product['selected'] ? angular.copy($scope.selected_child_ng) : $scope.defaultSelection[$scope.selected_parent_ng];
        product['custom_data_price'][$scope.selected_parent_ng] = product['selected'] ? angular.copy($scope.selected_child_price) : '';


        if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
            var monogramValidate = {
                '1st Monogram Style': '-',
                '1st Monogram Initial': '-',
                '1st Monogram Color': '-',
                '2nd Monogram Placement': 'No Monogram',
                '2nd Monogram Style': '-',
                '2nd Monogram Initial': '-',
                '2nd Monogram Color': '-',
            };
            for (mv in monogramValidate) {
                product['custom_data'][mv] = monogramValidate[mv];
            }

        }

        if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
            var monogramValidate = {
                '2nd Monogram Style': '-',
                '2nd Monogram Initial': '-',
                '2nd Monogram Color': '-',
            };
            for (mv in monogramValidate) {
                product['custom_data'][mv] = monogramValidate[mv];
            }
            product['custom_data_price']['2nd Monogram Initial'] = '';

        }

//suit validation
        if ($scope.selected_parent_ng == 'Front Edge') {
            if ($scope.selected_child_ng == 'Rounded') {
                if (product['custom_data']['Front Style'].indexOf('Double') == 0) {
                    product['custom_data']['Front Edge'] = 'Squared';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }
//        end of suit validation


//waistcoat validation
        if ($scope.selected_parent_ng == 'Lapel Button Hole') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Lapel Button Hole'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (product['custom_data']['Lapel Style & Width'].indexOf('Shawl') != -1) {
                    product['custom_data']['Lapel Button Hole'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'WaistcoatLapel Button Hole') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Waistcoat Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Waistcoat Lapel Button Hole'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }



        if ($scope.selected_parent_ng == 'Handstitching') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Handstitching'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (product['custom_data']['Lapel Style & Width'].indexOf('Shawl') != -1) {
                    product['custom_data']['Handstitching'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }



        if ($scope.selected_parent_ng == 'Waistcoat Handstitching') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Waistcoat Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Waistcoat Handstitching'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }
//waistcoat validation


        //jacket shawl lapel validation with double breated
        if ($scope.selected_parent_ng == 'Front Style') {
            if ($scope.selected_child_ng.indexOf('Double') != -1) {
                if (product['custom_data']['Lapel Style & Width'].indexOf('Shawl') != -1) {
                    product['custom_data']['Front Style'] = $scope.defaultSelection['Front Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'Lapel Style & Width') {
            if ($scope.selected_child_ng.indexOf('Shawl') != -1) {
                if (product['custom_data']['Front Style'].indexOf('Double') != -1) {
                    product['custom_data']['Front Style'] = $scope.defaultSelection['Front Style'];
//                    product.selected = false;
//                    product.animate = 'shake';
                }
            }
        }
        //jacket shawl lapel validation with double breated


//        wintip and sleeve validation
        if ($scope.selected_parent_ng == 'Cuff Style') {
            if ($scope.selected_child_ng.indexOf('Short Sleeve') != -1) {
                if (product['custom_data']['Collar Style'] == 'Wing Tip (2")') {
                    product['custom_data']['Cuff Style'] = $scope.defaultSelection['Cuff Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'Collar Style') {
            if ($scope.selected_child_ng == 'Wing Tip (2")') {

                if (product['custom_data']['Cuff Style'].indexOf('Short Sleeve') != -1) {
                    product['custom_data']['Cuff Style'] = $scope.defaultSelection['Cuff Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

//        wintip and sleeve validation


        product.total_price = $filter('sumOfValue')(product.custom_data_price);
        $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
        $timeout(function () {
            product.animate = ""
        }, 500);
    }


    $scope.selectAllProduct = function () {
        for (i in $scope.productStyleArrayNg) {
            var obj = $scope.productStyleArrayNg[i];
            if (obj.style_id == '') {
                obj['selected'] = $scope.selectAllCheck;
                $scope.selectFabric(obj);
            }
        }
    }

    $scope.removeElement = function (product, element) {
        product['custom_data'][element] = $scope.defaultSelection[element];
        product['custom_data_price'][element] = '';
        product.total_price = $filter('sumOfValue')(product.custom_data_price);
        $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
    }
})


//------------------------------------------------------------------




//------------------------------------------------------------------------

nitaFasions.controller('CustomControllerUpdate', function ($scope, $http, $filter, $timeout) {
    var tempprice = angular.copy(temp);
    for (i in temp) {
        tempprice[i] = "";
        if (temp[i].indexOf("Extra") > -1) {
            var obj = temp[i];
            var t = obj.split("$")[1];
            var t1 = t.split(" Extra")[0];
            var t2 = t1.trim();
            tempprice[i] = t2;
        }
    }

    $scope.productStyleArrayNg = [{'custom_data': temp, 'selected': true, 'animate': '', 'custom_data_price': tempprice}];
    $scope.defaultSelection = default_select_globle;
    $scope.productStyleArrayNg[0].total_price = $filter('sumOfValue')($scope.productStyleArrayNg[0].custom_data_price);
    $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);


    var collarValidation = {
        'Wing Tip (2")': {
            'div_option': {'Add 2 Buttons On The Collar Band': 'hide', 'Collar Stays': 'hide'},
            'validate': {'Add 2 Buttons On The Collar Band': 'No', 'Collar Stays': 'No'}
        },
        'Mandarin    (1  1/4")': {
            'div_option': {'Add 2 Buttons On The Collar Band': 'hide', 'Collar Stays': 'hide'},
            'validate': {'Add 2 Buttons On The Collar Band': 'No', 'Collar Stays': 'No'}
        },
        'Short Point Button Down    (1 1/2" x 2  1/2")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
        'Regular Button Down    (1  5/8" x 3 1/4")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
        'Hidden Button Down  (1 5/8" x 3")': {
            'div_option': {'Collar Stays': 'hide', 'Add 2 Buttons On The Collar Band': 'show'},
            'validate': {'Collar Stays': 'No'}
        },
    };









    $scope.setShopStored = function () {
        for (i in $scope.productStyleArrayNg) {
            var obj = $scope.productStyleArrayNg[i];
            obj['custom_data'] = angular.copy($scope.shopStored);
        }
    }


    $scope.selectFabricForPreferred = function (product) {
        if (product.style_select) {
            product.style_id = $scope.preferred_style.style_profile;
            product.custom_data = angular.copy($scope.preferred_style.custom_data);
            product.custom_data_price = angular.copy($scope.preferred_style.custom_data_price);
            product.total_price = $filter('sumOfValue')(product.custom_data_price);
            $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
        }
        else {
            product.style_id = '';
            product.custom_data = angular.copy($scope.defaultSelection);
            product.custom_data_price = angular.copy($scope.blankEntry);
            product.total_price = 0;
        }

    }


    $scope.selectPreferredStyle = function (obj) {
        $scope.preferred_style = obj;
    }

    $scope.selectStyle = function (parent, child, price, validation_dict, unwanted) {

        $scope.selected_parent_ng = parent;
        $scope.selected_child_ng = child;
        $scope.selected_validation = validation_dict;
        $scope.unwanted = unwanted;
        switch ($scope.selected_parent_ng) {
            case 'Collar Style':
                $scope.unwanted = {'Add 2 Buttons On The Collar Band': 'show', 'Collar Stays': 'show'};


                if (collarValidation[$scope.selected_child_ng]) {
                    var obj = collarValidation[$scope.selected_child_ng];
                    $scope.unwanted = obj['div_option'];
                    $scope.selected_validation = obj['validate'];
                }
                break;

            case 'Front Style':
                $scope.unwanted = {};

                if ($scope.selected_child_ng.indexOf('Double') == 0) {
                    $scope.selected_validation = {'Front Edge': 'Squared'};
                }
                break;

            case 'Lapel Style & Width':
                $scope.unwanted = {};
                if ($scope.selected_child_ng == 'No Lapel') {
                    $scope.selected_validation = {'Lapel Button Hole': 'No', 'Handstitching': 'No'};
                }
                if ($scope.selected_child_ng.indexOf("Shawl") != -1) {
                    $scope.selected_validation = {'Lapel Button Hole': 'No', 'Handstitching': 'No'};
                }
                break

            case 'Waistcoat Lapel Style & Width':
                $scope.unwanted = {};
                if ($scope.selected_child_ng == 'No Lapel') {
                    $scope.selected_validation = {'Waistcoat Lapel Button Hole': 'No', ' Waistcoat Handstitching': 'No'};
                }
                break


            case '1st Monogram Placement':
                if ($scope.selected_child_ng == 'No Monogram') {
                    $scope.unwanted = {
                        '1st Monogram Style': 'hide',
                        '1st Monogram Initial': 'hide',
                        '1st Monogram Color': 'hide',
                        '2nd Monogram Style': 'hide',
                        '2nd Monogram Initial': 'hide',
                        '2nd Monogram Color': 'hide', };
                    $scope.selected_validation = {
                        '1st Monogram Style': '-',
                        '1st Monogram Initial': '-',
                        '1st Monogram Color': '-',
                        '2nd Monogram Placement': 'No Monogram',
                        '2nd Monogram Style': '-',
                        '2nd Monogram Initial': '-',
                        '2nd Monogram Color': '-', };
                }
                else {
                    $scope.unwanted = {
                        '1st Monogram Style': 'show',
                        '1st Monogram Initial': 'show',
                        '1st Monogram Color': 'show',
                        '2nd Monogram Style': 'show',
                        '2nd Monogram Initial': 'show',
                        '2nd Monogram Color': 'show', };
                }
                break;

            case '2nd Monogram Placement':
                if ($scope.selected_child_ng == 'No Monogram') {
                    $scope.unwanted = {
                        '2nd Monogram Style': 'hide',
                        '2nd Monogram Initial': 'hide',
                        '2nd Monogram Color': 'hide', };
                    $scope.selected_validation = {
                        '2nd Monogram Style': '-',
                        '2nd Monogram Initial': '-',
                        '2nd Monogram Color': '-', };
                }
                else {
                    $scope.unwanted = {
                        '1st Monogram Style': 'show',
                        '1st Monogram Initial': 'show',
                        '1st Monogram Color': 'show',
                        '2nd Monogram Style': 'show',
                        '2nd Monogram Initial': 'show',
                        '2nd Monogram Color': 'show', };
                }
                break;

        }

        if ($scope.unwanted) {
            angular.forEach($scope.unwanted, function (v, k) {
                validator(k, v);
            })
        }
        $scope.selected_child_price = price;
        $scope.selectAllCheck = false;
//        for (i in $scope.productStyleArrayNg) {
//            var obj = $scope.productStyleArrayNg[i];
//            obj['selected'] = false;
//        }
        $scope.selectFabric($scope.productStyleArrayNg[0]);
    }

    //$scope.selectStyle('Body Fit', $scope.defaultSelection['Body Fit'])

    //Collary Stays Validation array
    var collar_stays = {
        'select': ['Short Point Button Down    (1 1/2" x 2  1/2")', 'Regular Button Down    (1  5/8" x 3 1/4")', 'Hidden Button Down  (1 5/8" x 3")', 'Wing Tip (2")', 'Mandarin    (1  1/4")'],
        'validate': ['Permanent', 'Removable']
    };
    //End of Collary Stays Array

    // Add 2 Buttons On The Collar Band Validation
    var add_two_button = {
        'select': ['Wing Tip (2")', 'Mandarin    (1  1/4")'],
        'validate': ['Yes']
    };
    // End of Add 2 Buttons On The Collar Band

    //Sort Sleeve Validation
    var sort_sleeve_watch = {
        'select': ['Short Sleeve With Cuff', 'Short Sleeve Without Cuff'],
        'validate': ['Right Wrist', 'Left Wrist']
    };
    // End of Sort Sleeve Validation

    //Sort Sleeve to monogram
    var cuff_style_monogram = {
        'validate': ['Short Sleeve With Cuff', 'Short Sleeve Without Cuff'],
        'select': ['Left Sleeve Placket', 'Left Cuff']
    }
    //End of sort slive to monogram

    $scope.selectFabric = function (product) {
        console.log($scope.selected_parent_ng, $scope.selected_child_ng);
        product.animate = '';
        switch ($scope.selected_parent_ng) {
            case 'Collar Stays':
                if (collar_stays['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (collar_stays['select'].indexOf(product['custom_data']['Collar Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case 'Add 2 Buttons On The Collar Band':
                if (add_two_button['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (add_two_button['select'].indexOf(product['custom_data']['Collar Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case 'Cuff Style':
                if (cuff_style_monogram['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (cuff_style_monogram['select'].indexOf(product['custom_data']['1st Monogram Placement']) >= 0) {
                        var unwanted = {
                            '1st Monogram Style': 'hide',
                            '1st Monogram Initial': 'hide',
                            '1st Monogram Color': 'hide',
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '1st Monogram Placement': 'No Monogram',
                            '1st Monogram Style': '-',
                            '1st Monogram Initial': '-',
                            '1st Monogram Color': '-',
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                    if (cuff_style_monogram['select'].indexOf(product['custom_data']['2nd Monogram Placement']) >= 0) {
                        var unwanted = {
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                }
                break;


            case 'Pocket Style':
                if ($scope.selected_child_ng == 'No Pocket') {
                    if (product['custom_data']['1st Monogram Placement'] == 'Left Chest Pocket') {
                        $scope.unwanted = {
                            '1st Monogram Style': 'hide',
                            '1st Monogram Initial': 'hide',
                            '1st Monogram Color': 'hide',
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };

                        $scope.selected_validation = {
                            '1st Monogram Placement': 'No Monogram',
                            '1st Monogram Style': '-',
                            '1st Monogram Initial': '-',
                            '1st Monogram Color': '-',
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };

                    }
                    if (product['custom_data']['2nd Monogram Placement'] == 'Left Chest Pocket') {
                        var unwanted = {
                            '2nd Monogram Style': 'hide',
                            '2nd Monogram Initial': 'hide',
                            '2nd Monogram Color': 'hide', };
                        for (u in unwanted) {
                            $scope.unwanted[u] = unwanted[u];
                        }
                        var selected_validation = {
                            '2nd Monogram Placement': 'No Monogram',
                            '2nd Monogram Style': '-',
                            '2nd Monogram Initial': '-',
                            '2nd Monogram Color': '-', };
                        for (sv in selected_validation) {
                            $scope.selected_validation[sv] = selected_validation[sv];
                        }
                    }
                }
                break;

            case 'Wrist Watch':
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '1st Monogram Style':

                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '1st Monogram Initial':

                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;
            case '1st Monogram Color':
                product.animate = '';
                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;

            case '1st Monogram Placement':

                switch ($scope.selected_child_ng) {
                    case 'Left Chest Pocket':
                        if (product['custom_data']['Pocket Style'] == 'No Pocket') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;

                    case ('Left Cuff'):
                        product.animate = '';
                        if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;

                    case ('Left Sleeve Placket'):
                        product.animate = '';
                        if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                            product.selected = false;
                            product.animate = 'shake';
                        }
                        break;
                }
                break;

            case '2nd Monogram Style':

                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                if (sort_sleeve_watch['validate'].indexOf($scope.selected_child_ng) >= 0) {
                    if (sort_sleeve_watch['select'].indexOf(product['custom_data']['Cuff Style']) >= 0) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                }
                break;

            case '2nd Monogram Initial':

                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;
            case '2nd Monogram Color':
                product.animate = '';
                if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                break;

            case '2nd Monogram Placement':
                if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
                    product.selected = false;
                    product.animate = 'shake';
                }
                else {
                    if (product['custom_data']['1st Monogram Placement'] == $scope.selected_child_ng) {
                        product.selected = false;
                        product.animate = 'shake';
                    }
                    else {
                        switch ($scope.selected_child_ng) {
                            case 'Left Chest Pocket':
                                if (product['custom_data']['Pocket Style'] == 'No Pocket') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;

                            case ('Left Cuff'):
                                product.animate = '';
                                if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;

                            case ('Left Sleeve Placket'):
                                product.animate = '';
                                if (product['custom_data']['Sleeve Style'] == 'Short Sleeve') {
                                    product.selected = false;
                                    product.animate = 'shake';
                                }
                                break;
                        }
                    }
                }
                break;


            default:
                product.animate = '';
                break

        }




        if ($scope.selected_validation) {
            console.log($scope.selected_validation);
            angular.forEach($scope.selected_validation, function (v, k) {
                product['custom_data'][k] = product['selected'] ? v : $scope.defaultSelection[k];
            })
            //product['custom_data'][$scope.selected_parent_ng_ref] = product['selected'] ? $scope.selected_child_ng_ref : $scope.defaultSelection[$scope.selected_parent_ng_ref];
        }



        product['custom_data'][$scope.selected_parent_ng] = product['selected'] ? angular.copy($scope.selected_child_ng) : $scope.defaultSelection[$scope.selected_parent_ng];
        product['custom_data_price'][$scope.selected_parent_ng] = product['selected'] ? angular.copy($scope.selected_child_price) : '';


        if (product['custom_data']['1st Monogram Placement'] == 'No Monogram') {
            var monogramValidate = {
                '1st Monogram Style': '-',
                '1st Monogram Initial': '-',
                '1st Monogram Color': '-',
                '2nd Monogram Placement': 'No Monogram',
                '2nd Monogram Style': '-',
                '2nd Monogram Initial': '-',
                '2nd Monogram Color': '-',
            };
            for (mv in monogramValidate) {
                product['custom_data'][mv] = monogramValidate[mv];
            }

        }

        if (product['custom_data']['2nd Monogram Placement'] == 'No Monogram') {
            var monogramValidate = {
                '2nd Monogram Style': '-',
                '2nd Monogram Initial': '-',
                '2nd Monogram Color': '-',
            };
            for (mv in monogramValidate) {
                product['custom_data'][mv] = monogramValidate[mv];
            }
            product['custom_data_price']['2nd Monogram Initial'] = '';

        }



        //suit validation
        if ($scope.selected_parent_ng == 'Front Edge') {
            if ($scope.selected_child_ng == 'Rounded') {
                if (product['custom_data']['Front Style'].indexOf('Double') == 0) {
                    product['custom_data']['Front Edge'] = 'Squared';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }
//        end of suit validation


//waistcoat validation
        if ($scope.selected_parent_ng == 'Lapel Button Hole') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Lapel Button Hole'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'WaistcoatLapel Button Hole') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Waistcoat Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Waistcoat Lapel Button Hole'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }



        if ($scope.selected_parent_ng == 'Handstitching') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Handstitching'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'Waistcoat Handstitching') {
            if ($scope.selected_child_ng == 'Yes') {
                if (product['custom_data']['Waistcoat Lapel Style & Width'] == 'No Lapel') {
                    product['custom_data']['Waistcoat Handstitching'] = 'No';
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }
//waistcoat validation




        //jacket shawl lapel validation with double breated
        if ($scope.selected_parent_ng == 'Front Style') {
            if ($scope.selected_child_ng.indexOf('Double') != -1) {
                if (product['custom_data']['Lapel Style & Width'].indexOf('Shawl') != -1) {
                    product['custom_data']['Front Style'] = $scope.defaultSelection['Front Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'Lapel Style & Width') {
            if ($scope.selected_child_ng.indexOf('Shawl') != -1) {
                if (product['custom_data']['Front Style'].indexOf('Double') != -1) {
                    product['custom_data']['Front Style'] = $scope.defaultSelection['Front Style'];
//                    product.selected = false;
//                    product.animate = 'shake';
                }
            }
        }
        //jacket shawl lapel validation with double breated


        //wintip and sleeve validation
        if ($scope.selected_parent_ng == 'Cuff Style') {
            if ($scope.selected_child_ng.indexOf('Short Sleeve') != -1) {
                if (product['custom_data']['Collar Style'] == 'Wing Tip (2")') {
                    product['custom_data']['Cuff Style'] = $scope.defaultSelection['Cuff Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

        if ($scope.selected_parent_ng == 'Collar Style') {
            if ($scope.selected_child_ng == 'Wing Tip (2")') {

                if (product['custom_data']['Cuff Style'].indexOf('Short Sleeve') != -1) {
                    product['custom_data']['Cuff Style'] = $scope.defaultSelection['Cuff Style'];
                    product.selected = false;
                    product.animate = 'shake';
                }
            }
        }

//        wintip and sleeve validation

        product.total_price = $filter('sumOfValue')(product.custom_data_price);
        $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
        $timeout(function () {
            product.animate = ""
        }, 500);




    }


    $scope.selectAllProduct = function () {
        for (i in $scope.productStyleArrayNg) {
            var obj = $scope.productStyleArrayNg[i];
            if (obj.style_id == '') {
                obj['selected'] = $scope.selectAllCheck;
                $scope.selectFabric(obj);
            }
        }
    }

    $scope.removeElement = function (product, element) {
        product['custom_data'][element] = $scope.defaultSelection[element];
        product['custom_data_price'][element] = '';
        product.total_price = $filter('sumOfValue')(product.custom_data_price);
        $scope.grand_total = $filter('sumOfTotal')($scope.productStyleArrayNg);
    }



})
