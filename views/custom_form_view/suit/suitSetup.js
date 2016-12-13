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
$("document").ready(function () {
    $("#containerBox").draggable();

    $('.suite_customize a[data-toggle="tab"]').on('click', function (e) {
        $('.suite_customize a[data-toggle="tab"]').removeClass("activeTab");
        $(e.target).addClass("activeTab"); 
        $(".final_summary").html($("#your_space_text").code());
        var crtTab = $(e.target).attr("aria-controls");
    });

    //    $(window).scroll(function () {
    //         $("#containerBox").css({"top": $(this).scrollTop()-100});
    //    }); 

    $(".nextStyle").click(function () {
        $($(".suite_customize li.active a")).removeClass("activeTab");
        var nextTab = $($(".suite_customize li.active")).next().find("a").addClass("activeTab").tab("show");
        $("body").animate({
            "scrollTop": 100
        }, function () {
            $("#containerBox").animate({
                "top": $("#front").position().top
            });
        })

    });

    $(".previousStyle").click(function () {
        $($(".suite_customize li.active a")).removeClass("activeTab");
        $($(".suite_customize li.active")).prev().find("a").addClass("activeTab").tab("show");
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

    $(".style_selection").click(function () {
        var nodeType = this.type;
        
        var itsTitle = $(this).attr("parent_style");
        var selected_title = itsTitle;
        var selected_value = $(this).attr("child_style");
        selected_value = selected_value; 
        
        if($(this).find("select").length){
            var selected_value = $(this).find("select").val();
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

        var divpos = $(this).offset();

        $("#containerBox").animate({
            "top": divpos.top - 240
        }); 

        if ($(this).hasClass("selected")) {
        }
        else {

            $(this).addClass("selected").removeClass("deselect");
            var x = 'flipInY';
            $(this).removeClass(x).addClass(x).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass(x);
            });

            $(this).parents("div").first().siblings().each(function () {
                $(this).find(".thumbnail").removeClass("selected").addClass("deselect");
            });
        }
    });

    $(".productSelect").click(function () {
        if ($(this).is(':checked')) {
          
        }
        else {
           
        }
    });




    $("[show_area]").click(function () {

        var pleatShow = $(this).attr("show_area");
       
        $("." + pleatShow).show(300); 
       
    });




    function setMeasurment(obj) {
        //        console.log(obj, obj.checked, crtTitle);

        if (crtTitle != "") {
            if (obj.checked) {
                var productCheck = $(obj).attr("target_product");
                productStyleArray[productCheck][crtTitle] = crtSelection;
                for (i in productStyleArray[productCheck]) {
                    var titleDiv = $(obj).parents(".col-md-12").find("dd li .mes_title").filter(function() {
                        return $(this).text() === i;
                    });
                    var title = productStyleArray[productCheck][i];
                    
                    $(titleDiv).siblings().first().text(title);
                    $(obj).parents(".col-md-12").find(".selectedTitle").text(crtSelection);
                }
            }
            else {
                var productCheck = $(obj).attr("target_product");
                productStyleArray[productCheck][crtTitle] = crtSelection;
                for (i in productStyleArray[productCheck]) {
                    var title = productStyleArray[productCheck][i];
                    var titleDiv = $(obj).parents(".col-md-12").find("dd li .mes_title:contains('" + i + "')");
                    $(obj).parents(".col-md-12").find(".selectedTitle").text("");

                //                    $(titleDiv).siblings().first().text("");
                }
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
        $($(".suite_customize li.active a")).removeClass("activeTab");
        $($(".suite_customize .activeTab")).each(function () {
            $(this).removeClass("activeTab");
        });
        //var nextTab = $($(".suite_custom li.active")).next().find("a").addClass("activeTab").tab("show");
        console.log("[parent_style='"+tabitem+"']");
        var divobj = $("[parent_style='"+tabitem+"']").first().parents(".vertical_tab_parent").first();
        var tabid = divobj[0].id;

        var targetTab = $("a[href='#" + tabid + "']");


        //        console.log($(targetTab).removeClass("activeTab").addClass("activeTab").parents("li"));
        var parentPos = $("[parent_style='"+tabitem+"']").first();
        var divpos = $(parentPos).offset();
        $("#containerBox").animate({
            "top": divpos.top -288,
        }, function () {

            var body = $("html, body");
            body.stop().animate({
                scrollTop: $("#containerBox").offset().top - 228
            }, '500', 'swing', function () { });
        });
        $(targetTab).removeClass("activeTab").addClass("activeTab").tab("show");

    });



    $(document).on("click", ".removethis", function () {
        var parentele = $(this).attr("parent");
        var parentremovetag = $(this).attr("removedata");
        productStyleArray[parentele][parentremovetag] = "";
        setSummery();
        var crtCheck = $("[target_product='" + parentele + "']");
        crtCheck[0].checked = false;
        var titleDiv = $(crtCheck).parents(".col-md-12").find("dd li .mes_title:contains('" + parentremovetag + "')");
        $(titleDiv).siblings().first().text("");
        $(crtCheck).parents(".col-md-12").find(".selectedTitle").text("");
        $("#containerBox").show(300);
    });
    
    
    $(document).on("change", ".extra_buttons", function () {
        var imgCode = $(this).val();
        imgCode = imgCode.split(" ")[1];
        $(this).parents(".thumbnail").find("img").attr("src", "../custom_suit/static/suit/suitbuttongsbl/"+imgCode+".JPG");
         
    });
    


})
