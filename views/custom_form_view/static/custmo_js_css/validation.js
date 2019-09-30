/* 
 all validation for shirt custom form
 */


//error model calling
function errorModal(error_heading, error_msg, model_prefix) {

    var crtCheck = $("input[target_product='" + model_prefix + "']");
    if (crtCheck[0].checked) {
        var titleDiv = $(crtCheck).parents(".col-md-12");
        $(titleDiv).find(".selectedTitle").text("");
        crtCheck[0].checked = false;
        $(".check_icon_all")[0].checked = false;
        $("#error_model" + model_prefix).modal("show");
        $("#error_model" + model_prefix + " " + ".error_heading").text(error_heading);
        $("#error_model" + model_prefix + " " + ".errors_check").html(error_msg);
    }
}


//end of error model calling




/*
 * Validation of shrit orde form
 */


function ShirtCustionFormValidation() {

}



//coller style validation
function checkColler(cartId, collar_style, button_down_collar, collar_stays, addtwobutton) {

    collar_style_value = productStyleArray[cartId][collar_style];
    button_down_collar_value = productStyleArray[cartId][button_down_collar];
    collar_stays_value = productStyleArray[cartId][collar_stays];
    coller_add_button = productStyleArray[cartId][addtwobutton];
    //coller stays validation 
    console.log(collar_style_value);
    switch (collar_stays_value) {

        case '':
            break
        case 'Removable':
        case 'Permanent':
            var collarStyasArray = [
                'Short Point Button Down    (1 1/2" x 2  1/2")',
                'Regular Button Down    (1  5/8" x 3 1/4")',
                'Hidden Button Down    (1 5/8" x 3")',
                'Wing Tip (2")',
                'Mandarin    (1  1/4")',
            ];

            if (collarStyasArray.indexOf(collar_style_value) >= 0) {
                console.log(collar_style_value);
                productStyleArray[cartId][collar_stays] = 'No';
                var errorHeading = "Collar Stays Mismatch !";
                var errorMsg = "Collar Style - <b>" + collar_style_value + "</b> with Collar Stays - <b>" + collar_stays_value + "</b> is INCORRECT COMBINATION !!! <br> Kindly choose correct option <b>No</b> to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
            }
            break;
    }
    //end of coller stays validation



    //button down collar validation
    switch (button_down_collar_value) {
        case '':
            break
        case 'Yes':
        case 'Hidden Button':
            var collarStyasArray = [
                'Short Point Button Down    (1 1/2" x 2  1/2")',
                'Regular Button Down    (1  5/8" x 3 1/4")',
                'Hidden Button Down    (1 5/8" x 3")',
                'Wing Tip (2")',
                'Mandarin    (1  1/4")',
            ];
            if (collarStyasArray.indexOf(collar_style_value) >= 0) {

                productStyleArray[cartId][button_down_collar] = 'No';
                var errorHeading = "Button Down Collar Mismatch !";
                var errorMsg = "Collar Style - <b>" + collar_style_value + "</b> with Button Down Collar - <b>" + button_down_collar_value + "</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option <b>No</b> to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
            }
            break;
    }

    switch (coller_add_button) {
        case '':
            break
        case 'Yes':
            var collarAddButtonArray = [
                'Wing Tip (2")',
                'Mandarin    (1  1/4")',
            ];
            if (collarAddButtonArray.indexOf(collar_style_value) >= 0) {
                productStyleArray[cartId][addtwobutton] = 'No';
                var errorHeading = "Add 2 Buttons On The Collar Band  Mismatch !";
                var errorMsg = "Collar Style - <b>" + collar_style_value + "</b> with Add 2 Buttons On The Collar Band - <b>" + coller_add_button + "</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option <b>No</b> to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
            }
            break;
    }
//end of button down collar validation

}
//end of collar validation



//start of sleeve, watch and monogram validation
function checkSleeve(cartId, sleeve_style, watch_option, monogram1_placement, monogram2_placement) {

    sleeve_style_value = productStyleArray[cartId][sleeve_style];
    monogram1_placement_value = productStyleArray[cartId][monogram1_placement];
    monogram2_placement_value = productStyleArray[cartId][monogram2_placement];
    watch_option_value = productStyleArray[cartId][watch_option];

    switch (sleeve_style_value) {

        case 'Short Sleeve Without Cuff':
        case 'Short Sleeve With Cuff':

            //sleeve style and watch validation 
            var watch_option_array = ['Left Wrist', 'Right Wrist'];
            productStyleArray[cartId]['Sleeve Style'] = 'Short Sleeve';
            productStyleArray[cartId]['Wrist Watch'] = '-';
            productStyleArray[cartId]['Watch'] = 'No';
            if (watch_option_array.indexOf(watch_option_value) >= 0) {
                var errorHeading = "Sleeve Style and Watch Option Mismatch !";
                var errorMsg = "Watch Option - <b>" + watch_option_value + "</b> with Cuff Style - <b>" + sleeve_style_value + "</b>  is INCORRECT COMBINATION !!! <br/> Kindly choose correct option to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
            }
            //end of sleeve and watch validation

            //1st monogram placement validation
            var monogram1_placement_array = ['Left Sleeve Placket', 'Left Cuff'];
            if (monogram1_placement_array.indexOf(monogram1_placement_value) >= 0) {
                var errorHeading = "Sleeve Style and 1st Monogram Placement Option Mismatch !";
                var errorMsg = "Monogram Placement - <b>" + monogram1_placement_value + "</b> with Cuff style - <b>" + sleeve_style_value + "</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
                productStyleArray[cartId]['1st Monogram Placement'] = '';
            }
            //end of 1st monogram placement validation

            //2nd monogram placement validation
            var monogram2_placement_array = ['Left Sleeve Placket', 'Left Cuff'];
            if (monogram2_placement_array.indexOf(monogram2_placement_value) >= 0) {
                var errorHeading = "Sleeve Style and 2nd Monogram Placement Option Mismatch !";
                var errorMsg = "Monogram Placement - <b>" + monogram2_placement_value + "</b> with Cuff style - <b>" + sleeve_style_value + "</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
                errorModal(errorHeading, errorMsg, cartId);
                productStyleArray[cartId]['2nd Monogram Placement'] = '';
            }
            //end of 2nd monogram placement validation            

            break;


        default:
            var sortslive = ['Short Sleeve Without Cuff', 'Short Sleeve With Cuff'];
            if (sortslive.indexOf(sleeve_style_value) < 0) {
                productStyleArray[cartId]['Sleeve Style'] = 'Long Sleeve';
            }




    }

    //    1st monogram to other option validation
    switch (monogram1_placement_value) {
        case 'No Monogram':
            productStyleArray[cartId]['1st Monogram Style'] = '-';
            productStyleArray[cartId]['1st Monogram Initial'] = '-';
            productStyleArray[cartId]['1st Monogram Color'] = '-';
            productStyleArray[cartId]['2nd Monogram Placement'] = 'No Monogram';
            productStyleArray[cartId]['2nd Monogram Style'] = '-';
            productStyleArray[cartId]['2nd Monogram Initial'] = '-';
            productStyleArrayPrice[cartId]['2nd Monogram Initial'] = '';
            productStyleArray[cartId]['2nd Monogram Color'] = '-';
            $('a[aria-controls="monogram2"]').parent().addClass("disabledMonogram2")
            break;
        default:
            break;

    }
    //end of validation

    //2nd monogram to other option validation
    switch (monogram2_placement_value) {
        case 'No Monogram':
            productStyleArray[cartId]['2nd Monogram Style'] = '-';
            productStyleArray[cartId]['2nd Monogram Initial'] = '-';
            productStyleArrayPrice[cartId]['2nd Monogram Initial'] = '0';
            productStyleArray[cartId]['2nd Monogram Color'] = '-';
    }
    // end of validation

    //2nd monogram to other option validation
    switch (watch_option_value) {
        case 'Left Wrist':
            productStyleArray[cartId]['Watch'] = 'Yes';
            break;
        case 'Right Wrist':
            productStyleArray[cartId]['Watch'] = 'Yes';
            break;
        case '-':
            productStyleArray[cartId]['Watch'] = 'No';
            break;
    }
// end of validation


}
//end of sleeve, watch and monogram validation



//start of other monogram options    
function checkMonogramOther(monogramSelection, targetProduct)
{
    var monogramPre = monogramSelection.split(" ")[0];


    if (monogramSelection == monogramPre + ' Monogram Style') {
        console.log(productStyleArray[targetProduct][monogramPre + ' Monogram Placement'], "--------------");
        if (productStyleArray[targetProduct][monogramPre + ' Monogram Placement'] == 'No Monogram') {
            var errorHeading = monogramPre + " Monogram Placement and Monogram Style Mismatch !";
            var errorMsg = "<b>Monogram style </b> with <b>No Monogram</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
            errorModal(errorHeading, errorMsg, targetProduct);
            productStyleArray[targetProduct][monogramPre + ' Monogram Style'] = '-';

        }
    }

    if (monogramSelection == monogramPre + ' Monogram Initial') {
        if (productStyleArray[targetProduct][monogramPre + ' Monogram Placement'] == 'No Monogram') {
            var errorHeading = monogramPre + " Monogram Placement and Monogram Initial Mismatch !";
            var errorMsg = "<b>Monogram Initial </b> with <b>No Monogram</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
            errorModal(errorHeading, errorMsg, targetProduct);
            productStyleArray[targetProduct][monogramPre + ' Monogram Initial'] = '-';
        }
    }

    if (monogramSelection == monogramPre + ' Monogram Color') {
        if (productStyleArray[targetProduct][monogramPre + ' Monogram Placement'] == 'No Monogram') {
            var errorHeading = monogramPre + " Monogram Placement and Monogram Color Mismatch !";
            var errorMsg = "<b>Monogram Color </b>  </b> with <b>No Monogram</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
            errorModal(errorHeading, errorMsg, targetProduct);
            productStyleArray[targetProduct][monogramPre + ' Monogram Color'] = '-';
        }
    }

}
//end of other monogram options



//validation for monogram placement matching
function checkMonogramPlacementValidation(fabricid) {

    var placement1 = productStyleArray[fabricid]['1st Monogram Placement'];
    var placement2 = productStyleArray[fabricid]['2nd Monogram Placement'];
    if (placement1 == 'No Monogram') {
        productStyleArray[fabricid]['1st Monogram Style'] = '-';
        productStyleArray[fabricid]['1st Monogram Initial'] = '-';
        productStyleArray[fabricid]['1st Monogram Color'] = '-';
        productStyleArray[fabricid]['2nd Monogram Placement'] = 'No Monogram';
        productStyleArray[fabricid]['2nd Monogram Style'] = '-';
        productStyleArray[fabricid]['2nd Monogram Initial'] = '-';
        productStyleArrayPrice[fabricid]['2nd Monogram Initial'] = '';
        productStyleArray[fabricid]['2nd Monogram Color'] = '-';
        $('a[aria-controls="monogram2"]').parent().addClass("disabledMonogram2")
    }
    if (placement2 != '') {
        if (placement1 == placement2) {
            if (placement1 == 'No Monogram') {

                productStyleArray[fabricid]['1st Monogram Style'] = '-';
                productStyleArray[fabricid]['1st Monogram Initial'] = '-';
                productStyleArray[fabricid]['1st Monogram Color'] = '-';
                productStyleArray[fabricid]['2nd Monogram Placement'] = 'No Monogram';
                productStyleArray[fabricid]['2nd Monogram Style'] = '-';
                productStyleArray[fabricid]['2nd Monogram Initial'] = '-';
                productStyleArrayPrice[fabricid]['2nd Monogram Initial'] = '';
                productStyleArray[fabricid]['2nd Monogram Color'] = '-';
                $('a[aria-controls="monogram2"]').parent().addClass("disabledMonogram2")
            }
            else if (placement2 == 'No Monogram') {
            }
            else {
                var errorHeading = "1st And 2nd Monogram Placement values are same!";
                var errorMsg = "You can't select same position for both monograms please choose diffrent positon for both monogram";
                errorModal(errorHeading, errorMsg, fabricid);
                //            productStyleArray[fabricid]['2nd Monogram Placement']=''
            }
        }
    }
}
//end validation for monogram placement matching    

//start of 2nd monogram placement validation 
function pocketMonogramValidation(cartId, pocketStyle) {
    pocket_style_value = productStyleArray[cartId][pocketStyle];
    //1st monogram placement validation
    var placement1 = productStyleArray[cartId]['1st Monogram Placement'];
    var placement2 = productStyleArray[cartId]['2nd Monogram Placement'];

    if (pocket_style_value == 'No Pocket' && placement1 == 'Left Chest Pocket') {
        var errorHeading = "Pocket Style and 1st Monogram Placement Option Mismatch !";
        var errorMsg = "Monogram Placement - <b>Left Chest Pocket</b>  with <b>No Pocket</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
        errorModal(errorHeading, errorMsg, cartId);
        productStyleArray[cartId]['1st Monogram Placement'] = '';
    }
    //end of 1st monogram placement validation

    //2nd monogram placement validation
    if (pocketStyle == 'No Pocket' && placement2 == 'Left Chest Pocket') {
        var errorHeading = "Pocket Style and 2nd Monogram Placement Option Mismatch !";
        var errorMsg = "Monogram Placement - <b>Left Chest Pocket</b>  with <b>No Pocket</b> is INCORRECT COMBINATION !!!<br> Kindly choose correct option to proceed further, Thanks </b>";
        errorModal(errorHeading, errorMsg, cartId);
        productStyleArray[cartId]['2nd Monogram Placement'] = '';
    }
//end of 2nd monogram placement validation  
}



//start of 1st monogram and 2nd monogram selection validation
function noMonogramValidation(cartId) {
    var placement1 = productStyleArray[cartId]['1st Monogram Placement'];
    var placement2 = productStyleArray[cartId]['2nd Monogram Placement'];

    switch (placement1) {
        case 'No Monogram':
            if (placement2 == 'No Monogram') {
            }
            else if (placement2 == '') {
            }
            else {
                productStyleArray[cartId]['2nd Monogram Placement'] = 'No Monogram';
                productStyleArray[cartId]['2nd Monogram Style'] = '-';
                productStyleArray[cartId]['2nd Monogram Initial'] = '-';
                productStyleArrayPrice[cartId]['2nd Monogram Initial'] = '';
                productStyleArray[cartId]['2nd Monogram Color'] = '-';
                var errorHeading = "2nd Monogram Placement Option Mismatch !";
                var errorMsg = "You can't select <b>2nd Monogram Options</b> becuase you do not want 1st Monogram";
                errorModal(errorHeading, errorMsg, cartId);
            }

    }
}
//end of 1st monogram and 2nd monogram selection validation



//validation for front fly to stud buttons
function frontFlyStudButtons(cartId) {
    var front_styles = productStyleArray[cartId]['Front Style'];
    var button_value = productStyleArray[cartId]['Buttons'];

    switch (front_styles) {
        case 'Fly Front':
            if (button_value.indexOf('Stud') >= 0) {
                var button_value = button_value.split("(")[0];
                productStyleArray[cartId]['Buttons'] = '';
                var errorHeading = "Front Style and Button Option Mismatch !";
                var errorMsg = "You can't select <b>" + button_value + "</b> style for <b>Fly Front</b> style.";
                errorModal(errorHeading, errorMsg, cartId);
            }
    }
}
//end of validation



//validation for shirt order form
function checkShritValidation() {
    for (fabric in productStyleArray) {
        var selectedStyles = productStyleArray[fabric];

        if (custom_form == '1') {
            checkColler(fabric, 'Collar Style', 'Button Down Collar', 'Collar Stays', 'Add 2 Buttons On The Collar Band');
            checkSleeve(fabric, 'Cuff Style', 'Wrist Watch', '1st Monogram Placement', '2nd Monogram Placement');
            pocketMonogramValidation(fabric, 'Pocket Style');
        }

        if (custom_form == '7') {
            checkColler(fabric, 'Collar Style', 'Button Down Collar', 'Collar Stays', 'Add 2 Buttons On The Collar Band');
            checkSleeve(fabric, 'Cuff Style', 'Wrist Watch', '1st Monogram Placement', '2nd Monogram Placement');
            pocketMonogramValidation(fabric, 'Pocket Style');
        }
    }
}
//end of validation of shirt order form