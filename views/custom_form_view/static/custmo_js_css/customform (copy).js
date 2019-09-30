/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function setAnimation(obj, x) {
    $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass(x);
        console.log(x);
    });
}


function setSummery() {
    var htmls = "<table class='table'><tr><th colspan=2></th><th colspan=2 class='heading_price' style='text-align:left'>Extra Price</th></tr>";
    var gran_total = 0;
    for (i in productStyleArray) {
        var temp = productStyleArray[i];
        htmls += "<tr><th class='headingthm' colspan=4>" + cartIdMap[i] + "</th></tr>";
        var total = 0;
        for (j in temp) {
            var temp2 = temp[j];

            if (temp2 == "") {
                
                htmls += "<tr class='errortd'><th class='headingth errortd' parent='" + i + "' removedata='" + j + "' >" + j + "</th><td class='headingth errortd'>" + temp2 + "</td>"
                htmls += "<td class='heading_price'></td>";
                htmls += "<td><i class='fa fa-edit removethis' parent='" + i + "' removedata='" + j + "'></td></tr>";
            }
            else {
                var extra_price = productStyleArrayPrice[i][j];
                
                if(extra_price){
                    total += Number(extra_price);
                    extra_price = "$"+extra_price;
                }
                else{
                    extra_price = "";
                }
                htmls += "<tr ><th class='headingth'>" + j + "</th><td class='headingtd'>" + temp2 + "</td>";
                htmls += "<td class='heading_price'>"+extra_price+"</td>";
                htmls += "<td><i class='fa fa-edit removethis' parent='" + i + "' removedata='" + j + "'></td></tr>";
            }
            
            var crtCheck = $("[target_product='" + i + "']");
             
            var titleDiv = $(crtCheck).parents(".col-md-12").find("dd li .mes_title:contains('" + j + "')");
            $(titleDiv).siblings().first().text(temp2);
          
            
        }
        gran_total += total;
        htmls += "<tr><th class='total_price' colspan=3>$" + total + "</th><th></th></tr>";
        
    }
    htmls += "<tr class='grand_total'><th class='' colspan=2>Total Extra Price</th><th class=''>$" + gran_total + "</th><th></th></tr>";
    htmls += "<tr><th class='headingthm' colspan=4>Your Space</th></tr>";
    htmls += "<tr><th class='final_summary' colspan=4 ></th></tr>";
    htmls += "</table>";
    $(".measurment_summery").html(htmls);
    return htmls;
}


function checkConfirmButton(obj) {
    var checkFlag = [];
    for (i in productStyleArray) {
        var temp = productStyleArray[i];
        for (j in temp) {
            var temp2 = temp[j];
            if (temp2 == "") {
                checkFlag.push(temp2);
            }
        }
    }

    var htmls = setSummery();

    if (checkFlag.length) {
        $('#error_model').modal('show');
        $(".errors_check").html(htmls);
    }
    else {
        $(obj).removeClass("btn-warning").addClass("btn-success").text("Continue");

    }

}




function PantCustomForm() {
    this.Init = function (setpos) {
        setSummery();
        $(".fabrics").each(function (index) {
            var defaultVal = 1 + index;
            defaultVal = defaultVal * setpos;
            $(this).animate({
                'display': 'block'
            }, 100 * index, function () {

                //setAnimation(this, 'bounceInLeft');
                var obj = this;
                var x = 'bounceInRight';
                $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass(x);
                    console.log(x);
                });
            })
        })


        $(".thumbnail").each(function (index) {

            var defaultVal = 1 + index;
            defaultVal = defaultVal * setpos;
            $(this).animate({
                'display': 'block'
            }, 100 * index, function () {

                //setAnimation(this, 'bounceInLeft');
                var obj = this;
                var x = 'flipInX';
                $(obj).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass(x);
                    console.log(x);
                });
            })
        });


    }



}


var bodyObj = new PantCustomForm();
bodyObj.Init(1);

var crtSelection = "";
var crtTitle = "";
var crtPrice = "";

$("document").ready(function () {
    $("#containerBox").draggable();

    $('.custmo_form_setup  a[data-toggle="tab"]').on('click', function (e) {
//        $('.custmo_form_setup  a[data-toggle="tab"]').removeClass("activeTab");
//        $(e.target).addClass("activeTab");
        $(".final_summary").html($("#your_space_text").code());
        var crtTab = $(e.target).attr("aria-controls");
    });

    //    $(window).scroll(function () {
    //         $("#containerBox").css({"top": $(this).scrollTop()-100});
    //    });

    $(".nextStyle").click(function () {
        $($(".custmo_form_setup  li.active a")).removeClass("activeTab");
        var nextTab = $($(".custmo_form_setup  li.active")).next().find("a").addClass("activeTab").tab("show");
        $("body").animate({
            "scrollTop": 100
        }, function () {
            $("#containerBox").animate({
                "top": $("#body_fit").position().top
            });
        })

    });

    $(".previousStyle").click(function () {
        $($(".custmo_form_setup li.active a")).removeClass("activeTab");
        $($(".custmo_form_setup li.active")).prev().find("a").addClass("activeTab").tab("show");
        $("body").animate({
            "scrollTop": 100
        }, function () {
            $("#containerBox").animate({
                "top": $("#front").position().top
            });
        })
    });

    $(".sboiw").click(function () {
        $(this).removeClass("active").addClass("active");
        $(this).siblings().removeClass("active");
    })

    $(".style_selection").bind("click keyup", function () {
        var itsTitle = $(this).attr("parent_style");
        var selected_title = itsTitle;
        var selected_value = $(this).attr("child_style");
        var selected_price = $(this).attr("extra_price");
        
        if($(this).find("select").length){
            var selected_value = $(this).find("select").val();
            selected_value = selected_value; 
        }
        
        if($(this).hasClass("form-control")){
            var selected_value = $(this).val();
            selected_value = selected_value; 
        }   
        
        $("#style_heading").text(selected_title);
        $(".check_icon").each(function (index) {
            if (selected_title != crtTitle) {
                var checkData = $(this).parents(".col-md-12").find(".selectedTitle").text("");
                var productCheck = $(this).attr("target_product");
                var titleDiv = $(this).parents(".col-md-12").find("dd li .mes_title:contains('" + selected_title + "')");
                var selectedPreValue = $(titleDiv).siblings().first().text();
                var checkData = $(this).parents(".col-md-12").find(".selectedTitle").text(selectedPreValue);

            }
            this.checked = false;

        });



        crtSelection = selected_value;
        crtTitle = selected_title;
        crtPrice = selected_price;


        var divpos = $(this).offset();

        $("#containerBox").animate({
            "top": divpos.top - 228
        });

        if ($(this).hasClass("selected")) {
        }
        else {

            $(this).addClass("selected").removeClass("deselect");
            var x = 'flipInY';
            $(this).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass(x);
                console.log(x);
            });

            $(this).parents("div").first().siblings().each(function () {
                console.log($(this));
                $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
            });
            
            $(this).parents(".owl-item").first().siblings().each(function () {
                console.log($(this));
                $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
            });
        }
    });

    $(".productSelect").click(function () {
        if ($(this).is(':checked')) {
            console.log($(this).parents(".upperDiv").siblings().first().text(crtSelection));
        }
        else {
            console.log($(this).parents(".upperDiv").siblings().first().text(''));
        }
    });


    $(".pleat_area").click(function () {
        $(this).removeClass("active").addClass("active");
        $(this).siblings().removeClass("active");
        var pleatShow = $(this).attr("show_area");
        $(".pleat_selection").hide(300);
        $("." + pleatShow).show(300);
        console.log(pleatShow);
    });


    function setMeasurment(obj) {
        if (crtTitle != "") {
            if (obj.checked) {
                var productCheck = $(obj).attr("target_product");
                productStyleArray[productCheck][crtTitle] = crtSelection;
                productStyleArrayPrice[productCheck][crtTitle] = crtPrice;
                $(obj).parents(".col-md-12").find(".selectedTitle").text(crtSelection);
            //                for (i in productStyleArray[productCheck]) {
            //                    var title = productStyleArray[productCheck][i];
            //                    var titleDiv = $(obj).parents(".col-md-12").find("dd li .mes_title:contains('" + i + "')");
            //                    $(titleDiv).siblings().first().text(title);
            //                  
            //                }
            }
            else {
                var productCheck = $(obj).attr("target_product");
                productStyleArray[productCheck][crtTitle] = crtSelection;
                productStyleArrayPrice[productCheck][crtTitle] = crtPrice;
                $(obj).parents(".col-md-12").find(".selectedTitle").text("");
            //                for (i in productStyleArray[productCheck]) {
            //                    var title = productStyleArray[productCheck][i];
            //                    var titleDiv = $(obj).parents(".col-md-12").find("dd li .mes_title:contains('" + i + "')");
            //                   
            //                }
            }
        }
        else {
            obj.checked = false;
            $(".check_icon_all")[0].checked = false;
            alert("Please Select Style!")
        }
        setSummery()
    }





    $(".product_check").click(function () {
        setMeasurment(this);
        if ($(this).is(':checked')) {
        }
        else {
            $(".check_icon_all")[0].checked = false;
        }
    });

    $(".check_icon_all").click(function () {
        if ($(this).is(':checked')) {
            $(".check_icon").each(function (index) {
                if (index) {
                    this.checked = true;
                    setMeasurment(this);
                }
            })
        }
        else {
            $(".check_icon").each(function (index) {
                if (index) {
                    this.checked = false;
                    setMeasurment(this);
                }
            })
        }

    });


    $(".checkAllStyle").click(function () {
        if ($(this).hasClass("btn-success")) {
            $(".check_icon").each(function (index) {
                if (index) {
                    this.checked = false;

                }
            })
        }
    });

    $(".removefabric").click(function () {
        var productCheck = $(this).attr("target_product");
        $(this).parents(".col-md-12").remove();
        delete productStyleArray[productCheck]
    });

    $(document).on("click", ".errortd", function () {
        var parentdiv = $(this).attr("parent");
        var tabitem = $(this).text();
        $($(".custmo_form_setup li.active a")).removeClass("activeTab");
        $($(".custmo_form_setup .activeTab")).each(function () {
            $(this).removeClass("activeTab");
        });
        var divobj = $("div.panel-heading:contains('" + tabitem + "'), div.sub_heading:contains('" + tabitem + "')").parents("[role=tabpanel]").first();
        var tabid = divobj[0].id;
        var targetTab = $("a[href='#" + tabid + "']");
        var parentPos = $("div.panel-heading:contains('" + tabitem + "'), div.sub_heading:contains('" + tabitem + "')").parents(".panel");
        var divpos = $(parentPos).offset();
        $("#containerBox").animate({
            "top": (divpos.top) - 220
        }, function () {
            var body = $("html, body");
            body.stop().animate({
                'scrollTop': $("#containerBox").offset().top - 228
            }, 500, 'swing');
        });
        $(targetTab).removeClass("activeTab").addClass("activeTab").tab("show");

    });



    $(document).on("click", ".removethis", function () {
        var parentele = $(this).attr("parent");
        var parentremovetag = $(this).attr("removedata");
        productStyleArray[parentele][parentremovetag] = "";
        setSummery();
        var crtCheck = $("[target_product='" + parentele + "']");   
        var selectedHeading = $(".style_heading").text();
        console.log(parentremovetag);
        if (selectedHeading == parentremovetag){
            crtCheck[0].checked = false;
            $(crtCheck).parents(".col-md-12").find(".selectedTitle").text("");
        }
        $("#containerBox").show(300);
    });
})



$(document).on("change", ".extra_buttons", function () {
    var imgCode = $(this).val();
    imgCode = imgCode.split(" ")[1];
    $(this).parents(".thumbnail").find("img").attr("src", "./custom_form_view/suit/suitbuttongsbl/"+imgCode+".JPG");
         
});
    
    
    
