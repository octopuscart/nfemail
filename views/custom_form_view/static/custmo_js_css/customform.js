function setAnimation(obj, x) {
//    $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
//        $(this).removeClass(x);
//    });
}











//function for set summery information accroding to selected styles and fabric selection 
function setSummery() {

//    for (i in productStyleArray) {
//        var temp = productStyleArray[i];
//        for (j in temp) {
//            var temp2 = temp[j];
//
//            var pricetemp = productStyleArrayPrice[i][j];
//            $("[parent='" + i + "'][styleselect='" + j + "']").text(temp2);
////            if (pricetemp) {
//            $("[parent='" + i + "'][extra_price='" + j + "']").text(pricetemp);
////            }
//            if (temp2 != "") {
//
//                $(".measurment_summery1 [parent='" + i + "'][styleselect='" + j + "']").parent().removeClass("errortd");
//                $(".brif_summary [parent='" + i + "'][styleselect='" + j + "']").parent().removeClass("errortd");
//            } else {
//                $(".measurment_summery1 [parent='" + i + "'][styleselect='" + j + "']").parents("tr").first().addClass("errortd");
//                $(".brif_summary [parent='" + i + "'][styleselect='" + j + "']").parents("tr").first().addClass("errortd");
//
//            }
//
//        }
//    }//end of outer loop
//
//    $(".measurment_summery1 table").each(function () {
//        var total = 0;
//        $(this).find("[extra_price]").each(function () {
//            total += Number($(this).text());
//        })
//        $(this).find(".total_price").text(total);
//    })
//
//    var gtotal = 0;
//    $(".measurment_summery1 table .total_price").each(function () {
//        gtotal += Number($(this).text());
//
//    })
//    $(".all_total_price").text(gtotal);
}
//end of set summery function 



function CustomForm() {
    this.Init = function (setpos) {

//
//        $(".fabrics").animate({
//            'display': 'block'
//        }, 100, function () {
//            var obj = this;
//            var x = 'bounceInRight';
//            $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
//                $(this).removeClass(x);
//            });
//        });


        $(".thumbnail").animate({
            'display': 'block'
        }, 100, function () {
            var obj = this;
            var x = 'ZoomIn';
            $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass(x);

            });
        })
    }
}


var bodyObj = new CustomForm();
bodyObj.Init(1);


var crtSelection = "";
var crtTitle = "";
var crtPrice = "";

$("document").ready(function () {

    $("#containerBox").draggable({axis: "y"});


    $('.custom_form_style  a[data-toggle="tab"]').on('click', function (e) {
        $(".final_summary").html($("#your_space_text").code());
        var crtTab = $(e.target).attr("aria-controls");
    });



    $(".nextStyle").click(function () {
        var nextTab = $($(".custom_form_style .vertialTab li.active")).next().find("a")
        if (nextTab.hasClass("switch_me")) {
            $(nextTab).parents("li").next().find("a").tab("show")
        }
        else {

            $(nextTab).tab("show");
        }

        var crttab = $($(".custom_form_style .vertialTab li.active")).find("a").attr("aria-controls");
        if (crttab == 'summary') {
            $("[aria-controls='measurment']").tab("show");
        }

        $("body").animate({
            "scrollTop": 100
        }, function () {
            $("#containerBox").animate({
                "top": $("#body_fit").position().top
            });
        })
    });


    $(".previousStyle").click(function () {
        var nextTab = $($(".custom_form_style .vertialTab li.active")).prev().find("a")

        if (nextTab.hasClass("switch_me")) {
            $(nextTab).parents("li").prev().find("a").tab("show")
        }
        else {

            $(nextTab).tab("show");
        }
        $("body").animate({
            "scrollTop": 100
        }, function () {
            $("#containerBox").animate({
                "top": $("#body_fit").position().top
            });
        })
    });




    $(".btn-group button").click(function () {
        $(this).removeClass("active").addClass("active");
        $(this).siblings().removeClass("active");
    })



    $(".custom_form_style .style_selection").bind("click keyup", function () {



        var itsTitle = $(this).attr("parent_style");
        var selected_title = itsTitle;

        var selected_value = $(this).attr("child_style");
        var selected_price = $(this).attr("extra_price");



        if ($(this).find("select").length) {
            var selected_value = $(this).find("select").val();
            selected_value = selected_value;
        }

        if ($(this).hasClass("form-control")) {
            selected_value = $(this).val();
            console.log(selected_value);
            selected_value = selected_value;
        }






        crtSelection = selected_value;
        crtTitle = selected_title;
        crtPrice = selected_price;


        var divpos = $(this).offset();

        $("#containerBox").animate({
            "top": divpos.top - 338
        }, function () {
            var body = $("html, body");
            body.stop().animate({
                'scrollTop': $("#containerBox").offset().top - 180
            }, 500, 'swing');
        });

        if ($(this).hasClass("selected")) {
        }
        else {

            $(this).addClass("selected").removeClass("deselect");


            $(this).parents("div").first().siblings().each(function () {

                $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
            });

            $(this).addClass("selected").removeClass("deselect");

            var obj = this;
            var x = 'flipInY';
            $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass(x);

            });


            $(this).parents(".owl-item").first().siblings().each(function () {

                $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
            });
        }
    });




















    $(document).on("click", ".navigate_data", function () {

        var tabitem = $(this).attr("removedata");


        console.log(("[navigate_to='" + tabitem + "']"));
        if (tabitem.indexOf('Monogram') == 4) {
            var divobj = $("[navigate_to='" + tabitem + "']").parents("[role=tabpanel]");
            var tabid = divobj[1].id;
        }
        else {
            var divobj = $("[navigate_to='" + tabitem + "']").parents("[role=tabpanel]").first();
            var tabid = divobj[0].id;
        }

        
        var targetTab = $("a[href='#" + tabid + "']");
        var parentPos = $("[navigate_to='" + tabitem + "']").last();

//        var divpos = $(parentPos).position();
//        $("#containerBox").animate({
//            "top": (divpos.top) 
//        }, function () {
//            var body = $("html, body");
//            body.stop().animate({
//                'scrollTop': $("#containerBox").positon().top 
//            }, 500, 'swing');
//        });
        $(targetTab).tab("show");
        $("[parent_style='" + tabitem + "']").first().click();

    });




})



$(document).on("change", ".extra_buttons", function () {
    var imgCode = $(this).val();
    imgCode = imgCode.split(" ")[1];
    $(this).parents(".thumbnail").find("img").attr("src", "./custom_form_view/suit/suitbuttongsbl/" + imgCode + ".JPG");

});


//remove facric selection coller or others
$(document).on("click", ".reset_fabric_selection", function () {
    $(this).parents(".tab-pane").first().find(".thumbnail").each(function () {
        $(this).removeClass("deselect");
    })
});
//end of fabric selection 



//    if new style selected then it will show create style popup
$(function () {
    $("#create_new_style").click(function () {

        $(".style_creation").hide("blind", 500);
        $(".create_new_style").show("blind", 500);
        $("a[aria-controls='body_fit']").tab("show");


    });


    $("#previous_style").click(function () {
        $(".style_creation").show("blind", 500);
        $(".create_new_style").hide("blind", 500);
        $("#create_new_style")[0].checked = false;
    });


    $("#new_measurement_profile").bind("click", function () {

        $(".create_new_measurement").show("blind", 500);
        $(".measurement_selection_block").hide("blind", 500);

    });

    $("#previous_measurement").bind("click", function () {
        $(".create_new_measurement").hide("blind", 500);
        $("#new_measurement_profile")[0].checked = false;
        $(".measurement_selection_block").show("blind", 500);
    });









    $(".shop_style").click(function () {

        $("[aria-controls='measurment']").tab("show");


    });





});


//end of new style



//$(".measurement_form_setup .style_selection").bind("click keyup", function () {
//    var itsTitle = $(this).attr("parent_style");
//    var selected_title = itsTitle;
//
//    var selected_value = $(this).attr("child_style");
//
//
//    var divpos = $(this).offset();
//
//
//
//    if ($(this).hasClass("selected")) {
//    }
//    else {
//        $(this).addClass("selected").removeClass("deselect");
//        var x = 'flipInY';
//        $(this).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
//            $(this).removeClass(x);
//        });
//
//        $(this).parents("div").first().siblings().each(function () {
//            $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
//        });
//
//
//    }
//});


$(".nextMes").click(function () {
    var nextTab = $($(".measurement_form_setup .vertialTab li.active")).next().find("a")
    if (nextTab.hasClass("switch_me")) {
        $(nextTab).parents("li").next().find("a").tab("show")
    }

    var crttab = $($(".measurement_form_setup .vertialTab li.active")).find("a").attr("aria-controls");
    console.log(crttab);
    if (crttab == 'profile_summary') {
        $("[aria-controls='confirm_order']").tab("show");
    }

    else {

        $(nextTab).tab("show");
    }
    $("body").animate({
        "scrollTop": 100
    }, function () {
        $("#containerBox").animate({
            "top": $("#body_fit").position().top
        });
    })
});


$(".previousMes").click(function () {
    var nextTab = $($(".measurement_form_setup .vertialTab li.active")).prev().find("a")
    if (nextTab.hasClass("switch_me")) {
        $(nextTab).parents("li").prev().find("a").tab("show")
    }
    else {

        $(nextTab).tab("show");
    }
    $("body").animate({
        "scrollTop": 100
    }, function () {
        $("#containerBox").animate({
            "top": $("#body_fit").position().top
        });
    })
});


header_mapping_rev = {};
for (i in header_mapping) {
    header_mapping_rev[header_mapping[i]] = i;
}

$(function () {
    $("#start_customization").click(function () {
        $("a[aria-controls='custom_style_designer']").tab("show");
    });
    $("[orgstyle]").each(function () {
        $(this).text(header_mapping_rev[$(this).attr('orgstyle')]);
    })
})

function pullFabricBox() {
    $("body").animate({
        "scrollTop": 100
    }, function () {
        $("#containerBox").animate({
            "top": $("#summary").position().top
        });
    });
    $("a[aria-controls='summary']").tab("show");

}






function checkAllValid() {
    var mesurement_valid = [];
    var style_valid = {};
    var check_valid = [];
    $(".error_in_style").html("");
    $(".error_in_measurement").html("");
    for (i in  measurment_profile_array) {
        var mt = measurment_profile_array[i];
        if (mt == "") {
            mesurement_valid.push(i);
            check_valid.push(i);
        }
    }



    if (check_valid.length) {
        $(".checkAllStyleMeasurement").attr("disabled", true);
    }
    else {
        $(".checkAllStyleMeasurement").attr("disabled", false);
    }
    if (mesurement_valid.length) {
        $(".error_in_measurement").show();
        for (i in mesurement_valid) {
            var mss = mesurement_valid[i];
            htmls = '<div class="alert alert-danger" role="alert">' + mss + "</div>";
            $(".error_in_measurement").append(htmls);
        }
        $(".mes_error").show();
    }
    else {
        $(".mes_error").hide();
        $(".cus_error").hide();
        $(".error_in_style").show().html("<p class='alert alert-success'><i class='fa fa-thumbs-up' style='    line-height: 24px;'></i> Customization is OK.</p>");
        $(".error_in_measurement").show().html("<p class='alert alert-success'><i class='fa fa-thumbs-up' style='    line-height: 24px;'></i> Measurement is OK.</p>");
    }


//    for (i in style_valid) {
//        for (j in style_valid[i]) {
//            var mss = style_valid[i][j];
//            htmls = '<div class="alert alert-danger" role="alert">' + i + "&rarr;" + mss + "</div>";
//            $(".error_in_style").append(htmls);
//        }
//    }

//    if ($(".error_in_style").html()) {
//        $(".cus_error").show();
//    }
//    else {
//        $(".cus_error").hide();
//        $(".error_in_style").show().html("<p class='alert alert-success'><i class='fa fa-thumbs-up'></i> Customization is OK.</p>");
//    }


}



$(function () {

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
        var target_tag = e.target;
        var checktab = $(target_tag).attr("aria-controls");
        console.log(checktab);
        if (checktab) {
            if (checktab == "summary") {
                setSummery();
                $("#containerBox").hide();
            }
            else {
                $("#containerBox").show();
            }
            if (checktab == "confirm_order") {
                checkAllValid()
            }
        }
    });




//    $(".style_selection img").mouseenter(function () {
//        var simg = $(this).attr("src");
//        var mimg = simg.replace("small", "medium");
//        console.log(mimg);
//        // data-zoom-image
//        $(this).attr("data-zoom-image", mimg);
//        $(this).elevateZoom({gallery: 'gallery_01', cursor: 'pointer', zoomWindowPosition: 10});
//    })



//    $(".your_space_block").first().keyup(function () {
//        $objval = $(this).val();
//        $(".your_space_block").each(function () {
//            $(this).val($objval);
//            var itsTitle = $(this).attr("parent_style");
//            var selected_value = $(this).val();
//            var productCheck = $(this).attr("target_product");
//            productStyleArray[productCheck][itsTitle] = selected_value;
//        })
//    })

    $(".shop_mes").click(function () {
        $("a[aria-controls='confirm_order']").tab("show");
    })


})