<script src="/audiograms/static/js/jquery.js" type="text/javascript"></script>
<script src="/audiograms/static/js/audioGraphMain.js" type="text/javascript"></script>
<link src="/audiograms/static/js/web2py.js" type="text/javascript"></script>
<link href="/audiograms/static/css/web2py.css" rel="stylesheet" type="text/css" />
<link href="/audiograms/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<body style="background-image:url({{=URL('static', 'images/background/background1.jpg')}});">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {{include "menu.html"}}
    {{include "jqplugin.html"}}
    <style>
        .pickObj{
            position: absolute;
            top: 120px;
            left: 697;
            padding:3px 3px 0px 3px;
            z-index: 999;
        }

    </style>
    <div class="" style="height:768px;width:1360px">
        {{include 'fixedDesign.html'}}
        <div class="btn-group-vertical buttonGroup" style="top: 331;left: -11px;position: absolute;width: 32px;">
            <button type="button" class="pickObj btn btn-default">
                <svg id="cross">
                <polyline fill="none" points="14,2  6,18" style="stroke: rgb(0, 0, 255); stroke-width: 2px;">

                </polyline>
                <polyline fill="none" points="6,2  14,18" style="stroke: rgb(0, 0, 255); stroke-width: 2px;">

                </polyline>
                </svg>
            </button>
            <button type="button" class="pickObj btn btn-default">
                <svg id="rectangle">
                <rect fill="none" x="2" y="2" height="16" width="16"
                      style="stroke: rgb(0, 0, 255); stroke-width: 2px;"></rect>
                </svg>
            </button>
        </div>

        <div class="btn-group-vertical buttonGroup" style="top: 331;left: -161px;position: absolute;width: 32px;">
            <button type="button" class="pickObj btn btn-default">
                <svg id="circle">
                <circle fill="none" cx="10" cy="10" r="8" style="stroke: rgb(255, 0, 0); stroke-width: 2px;">
                </circle>
                </svg>
            </button>
            <button type="button" class="pickObj btn btn-default">
                <svg id="triangle">
                <polyline fill="none" points="0,18  20,18  0,18  10,2  20,18  10,2"
                          style="stroke: rgb(255, 0, 0); stroke-width: 2px;">
                </polyline>
                </svg>
            </button>
        </div>

        <div class="btn-group-vertical buttonGroup" style="top: 433;left: -11px;position: absolute;">
            <button type="button" class="pickObj btn btn-default">
                <svg id="graterThen" style="margin-left: 4px;padding-left: 4px;">
                <polyline fill="none" points="2,2  10,10  10,10  2,18"
                          style="stroke: rgb(0, 0, 255); stroke-width: 2px;">
                </polyline>
                </svg>
            </button>
            <button type="button" class="pickObj btn btn-default">
                <svg id="bracketClose" style="margin-left: 5px;">
                <polyline fill="none" points="6,2  10,2  10,2  10,18  6,18  10,18" style="stroke: rgb(0, 0, 255); stroke-width: 2px;">
                </polyline>
                </svg>
            </button>
        </div>
        <div class="btn-group-vertical buttonGroup" style="top: 391;left: -10px;position: absolute;">

            <button type="button" class="pickObj btn btn-default" style="height: 17px;">
                <svg id="noResponse">
                <text x="2" y="10" style="stroke-width: 1px; 
                      font-weight: bold;font-family: sans-serif; font-size: 13px;">
                NR
                </text>
                </svg>
            </button>
        </div>

        <div class="btn-group-vertical buttonGroup" style="top: 433;left: -161px;position: absolute;">
            <button type="button" class="pickObj btn btn-default">
                <svg id="lessThen" style="margin-left: -9px;">
                <polyline fill="none" points="10,10  18,2  10,10  18,18"
                          style="stroke: rgb(255, 0, 0); stroke-width: 2px;">
                </polyline>
                </svg>
            </button>
            <button type="button" class="pickObj btn btn-default">
                <svg id="bracketOpen">
                <polyline fill="none" points="10,2  14,2  10,2  10,18  10,18  14,18"
                          style="stroke: rgb(255, 0, 0); stroke-width: 2px;">
                </polyline>
                </svg>
            </button>
        </div>


        <div class="col-md-12" style="margin-top: -6px;">
            <div class="col-md-7">
                <div class="col-md-12" style="margin: 10px 0px 11px;">
                    <button onclick="printDiv()"  type="button" 
                            class=" btn btn-primary glyphicon glyphicon-print printDiv"></button>
                    <button id="undo" type="button"
                            class=" btn btn-primary glyphicon glyphicon-backward"></button>
                    <button type="button" id="refresh"
                            class=" btn btn-primary glyphicon glyphicon-refresh"></button>
                    <button onclick="" type="button"
                            class=" btn btn-primary" id="audiogram">
                        AUDIOGRAM
                    </button>

                    <button onclick="" type="button"
                            class=" btn btn-primary" id="tympanogram">
                        TYMPANOGRAM
                    </button>


                </div>
                <div id="printDiv" class="">
                    <svg class="graphCanvasDraw" id="svgGraph"
                         style="height:1040px;width:740px;margin:-5px 0 0 -5px;background: #fff;">

                    <!-- Outline of report -->
                    <text x="35" y="55px" style="/* fill: rgb(0, 36, 182); */font-size: 23px;
                          font-family: fantasy;/* font-weight: bold; */letter-spacing: 0px;text-transform: uppercase; ">

                    </text>

                    <text x="135" y="89px" style="/* fill: rgb(0, 36, 182); */font-size: 19px;
                          font-family: sans-serif;font-weight: bold; ">

                    </text>

                    <text x="320" y="45px" style="/* fill: rgb(0, 36, 182); */font-size: 12px;
                          font-family: sans-serif;font-weight: bold; ">
                    Shop No. 17,GF ,B-Block, Mansarovar Complex ,Near BJP Head Office,
                    </text>


                    <text x="320" y="58px" style="/* fill: rgb(0, 36, 182); */font-size: 12px;
                          font-family: sans-serif;font-weight: bold; ">
                    Habibganj Station Road,Bhopal 462016 | Ph : 0755-4030308
                    </text>


                    <text x="320" y="82px" style="/* fill: rgb(0, 36, 182); */font-size: 12px;
                          font-family: sans-serif;font-weight: bold; ">
                    www.myearclinic.com | Email: support@myearclinic.com
                    </text>

                    <line fill="none" x1="35" y1="65px" x2="720px" y2="65px" style="stroke: rgb(0,0,0); stroke-width: 4px;">

                    </line>

                    <image xlink:href="/audiograms/static/images/logo.jpg"  x="28px" y="5px" height="100" width="190">
                    </image>

                    <line fill="none" x1="0" y1="0px" x2="100%" y2="0px" style="stroke: rgb(0,0,0); stroke-width: 4px;">



                    </line>
                    <line fill="none" x1="0" y1="0" x2="2" y2="100%"
                          style="stroke: rgb(0, 0, 0); stroke-width: 4px;" stroke-dasharray="0"></line>

                    <line fill="none" x1="100%" y1="0px" x2="100%" y2="100%"
                          style="stroke:rgb(0,0,0); stroke-width:4px;">
                    </line>

                    <text x="60px" y="1030" style="stroke-width: 1px; font-family: sans-serif; font-size: 9.28571428571429px;" fill="#000">
                    The audiological findings represent only a diagnostic possibility,
                    correlate clinically. These reports do not hold good for any medico legal purposes.
                    </text>

                    <!----User Information------>

                    <!----Patient Information------>
                    <text x="50" y="200px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;">
                    Patient Name:
                    </text>
                    <text x="180" y="200px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;" class="patient_name" >
                    --
                    </text>
                    <text x="50" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;">
                    Age/Sex:
                    </text>
                    <text x="180" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;" class="age">--</text>
                    <text x="215" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;" >/</text>
                    <text x="225" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;" class="gender">--</text>

                    <!----Doctor Information------>
                    <text x="430" y="200px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;">
                    Ref. Dr:
                    </text>

                    <text x="600" y="220" style="/* fill: rgb(0, 36, 182); */font-size: 11px;
                          font-family: sans-serif;font-weight: bold; ">

                    </text>

                    <text x="510" y="200px" style="fill: rgb(63, 63, 63);font-size: 16px;
                          font-family: sans-serif;font-weight: bold;" class="ref_dr">
                    -----------------
                    </text>

                    <text x="650" y="220px" style="fill: rgb(63, 63, 63);font-size: 16px;
                          font-family: sans-serif;font-weight: bold;" class="specialist">

                    </text>     

                    <text x="430" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;">
                    Date:
                    </text>
                    <text x="510" y="255px" style="fill: rgb(63, 63, 63);font-size: 18px;
                          font-family: sans-serif;font-weight: bold;" class="re_date">
                    ----
                    </text>
                    <!---------->
                    {{include 'audiogramReport.html'}}
                    {{include 'tympanogramReport.html'}}
                    <!---------------------->
                    <text x="82" y="919" style="stroke-width: 1px;text-decoration: underline;
                          font-family: sans-serif; font-size: 13px;font-weight:bold">
                    Audiological Interpretation :
                    </text>
                    <text x="570" y="1000" style="stroke-width: 1px;
                          font-family: sans-serif; font-size: 11px;font-weight:bold">
                    Audiologist
                    </text>
                    <line fill="none" x1="0" y1="100%" x2="100%" y2="100%" style="stroke: rgb(0,0,0); stroke-width:4px;margin-top:5px;">   
                    </svg>
                </div>
            </div>
            <div class="col-md-5" style="margin-top:47px" id="additional">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="well well-sm">
                            <label>
                                <input type="checkbox" id="audocheck"> AUDIOGRAM
                            </label>
                            <label>
                                <input type="checkbox" id="tympcheck"> TYMPANOGRAM
                            </label>
                        </div>
                        <div class="panel panel-primary" style="display:none">
                            <div class="panel-heading" style="padding: 3px 10px 6px 15px;">
                                <h3>
                                    <i><span class="glyphicon glyphicon-list"></span></i>
                                    Additional Remark
                                </h3>
                            </div>
                            <div class="panel-body">
                                <textarea class="col-md-12 form-control" style="height:277px" name="additional_remark"></textarea>
                            </div>
                        </div>
                        <div class="well well-md">
                            <button type="submit" class="btn btn-primary btn btn-lg"
                                    name="submit" onclick="saveAudiogram()">
                                <i><span class="glyphicon glyphicon-plus"></span></i>
                                <b>Save</b>
                            </button>
                            <button class="btn btn-info pull-right  btn btn-lg" type="button">
                                <i><span class="glyphicon glyphicon-remove"></span></i>
                                <b> Cancel </b>
                            </button>
                        </div>
                        <div class="well well-md">
                            <h4 style="font-weight:bold">Note:</h4>
                            <i class="glyphicon glyphicon-arrow-right" style="float: left;"></i>
                            <p class="text-warning" style="font-weight:bold;margin-left: 25px;">
                                Do not use continues double space between two words in  &nbsp;&nbsp;&nbsp; Audiological
                                Interpretation box.
                            </p>
                            <i class="glyphicon glyphicon-arrow-right" style="float: left;"></i>
                            <p class="text-warning" style="font-weight:bold;margin-left: 25px;">
                                For 'UNDO' operation click on this icon button
                                <button class="btn btn-sm btn btn-primary glyphicon glyphicon-backward"></button>
                                which removes the last drawn graph.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
                function printDiv() {
                var printContents = document.getElementById("printDiv").innerHTML;
                        var myWindow = window.open('', '');
                        myWindow.document.write(printContents);
                        myWindow.document.style = "margin:0px"
                        myWindow.document.close();
                        myWindow.focus();
                        myWindow.print();
                        myWindow.close();
                }

    </script>

    <script>
        var globleTemp = '';
                $(function(){

                var pos = $("#svgGraph").position();
                        var topPos = 0;
                        var leftPos = 0;
                        var args = {'graphsize' : {{ = lastData.graphsize}},
                                'dotedWidth' : "{{=lastData.dotedWidth}}",
                                'strock' : {{ = lastData.strock}},
                                'lineStrock' : {{ = lastData.lineStrock}},
                                'lineDeshed' : "{{=lastData.lineDeshed}}",
                                'fontSize':{{ = lastData.fontSize}}
                        }
                audiologySVG(args);
                        $("#footerDate").css("font-size", "9px");
                        $("#footerDate").html("{{=request.now.date()}}")

                        var datas = $($(".lineV")[1]);
                        var temp = {};
                        $(".lineV").each(function(){
                temp[$(this).position().left - 10] = [$(this).position().left + 5, $(this)];
                })
                        $("#svgGraph").mousemove(function(e){
                var x = e.pageX - 15;
                        var y = e.pageY - 29;
                        for (i in temp){
                var c1 = Number(i);
                        var c2 = Number(temp[i][0]);
                        var x1 = $(".lineH").first().position().top;
                        var x2 = $(".lineH").last().position().top;
                        globleTemp = temp[i][1];
                        if (x1 < y && y < x2){
                if (x > c1 && x < c2){
                $("#svgGraph").css("cursor", "pointer");
                        break
                }
                else{
                $("#svgGraph").css("cursor", "auto");
                }
                }
                else{
                $("#svgGraph").css("cursor", "auto");
                }
                }
                })
                });
                function saveAudiogram(){
                $('#loaderSMS').modal();
                }


        function printDiv() {
        $("svg").find("text").each(function(){ if ($(this).text().indexOf("....") > 0){$(this).text("")} });
                $("svg").find("text").each(function(){ if ($(this).text().indexOf(".....") > 1){$(this).text("")} });
                $("svg").find("text").each(function(){ if ($(this).text().indexOf("....") > 1){$(this).text("")} });
                $("svg").find("text").each(function(){ if ($(this).text().indexOf("----") > 1){$(this).text("")} });
                var printContents = document.getElementById("printDiv").innerHTML;
                var myWindow = window.open('', '');
                myWindow.document.write(printContents);
                myWindow.document.close();
                myWindow.document.body.style = "font-weight:bold";
                myWindow.focus();
                myWindow.print();
                myWindow.close();
        }


        $(function(){

        $("#undo").click(function(){
        if (currentObject == 'cross'){
        $(lastEle).last().remove();
                $(lastEle).last().remove();
        }
        else{
        $(lastEle).last().remove();
        }
        $("line").last().remove();
                x1 = $("line").last().attr("x2");
                y1 = $("line").last().attr("y2");
        });
                $(".pickObj").click(function(){
        $(".pickObj").removeClass("active");
                $(this).addClass("active");
        })


        {{ for pt, vl in detail.items():}}
        $(".{{=pt}}").val("{{=vl}}");
                $(".{{=pt}}").html("{{=vl}}");
        {{pass}}


        })



    </script>
    <script>
                $(document).ready(function() {
        $('.filterTable').dataTable();
                $('.datepickerDiff').datepicker({'format':'yyyy-mm-dd'})
                .on('changeDate', function(ev) {
                $('.datepicker').hide();
                        console.log($(this).attr("id"));
                        $(".re_date").html($(this).val());
                });
                $("#tympanogram").click(function(){
        $(".buttonGroup").css("display", "none");
                $(".aud").css("display", "none");
                $(".audReport").css("display", "none");
                $(".tympReport").css("display", "block");
                $(".tympInt").css("display", "block");
                $(".dr_nameTymp").css("display", "block");
                $(".audInt").css("display", "none");
                $(".dr_nameAud").css("display", "none");
                $(".tympt").css("display", "block");
                $(".longBox").css("left", "257px");
        })
                $("#audiogram").click(function(){
        $(".buttonGroup").css("display", "block");
                $(".aud").css("display", "block");
                $(".audReport").css("display", "block");
                $(".tympReport").css("display", "none");
                $(".tympInt").css("display", "none");
                $(".dr_nameTymp").css("display", "none");
                $(".audInt").css("display", "block");
                $(".dr_nameAud").css("display", "block");
                $(".tympt").css("display", "none");
        });
        });
                $("document").load(function(){
        initialize();
        });</script>



    <!-- Modal -->
    <div class="modal fade" id="loaderSMS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Send Report As SMS</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body" id="smsCheck">
                            <div class="form-group">
                                <label for="name">Select list</label>
                                <select class="form-control" id="mobileNo">
                                    {{for m in mobiles:}}
                                    <option value="{{=m}}">{{=m}}</option>
                                    {{pass}}
                                </select>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="" id="audsms">Audiogram Interpretation</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="" id="tympsms">Tympanogram Interpretation</label>
                            </div>

                            <div class='col-md-12 well well-sm'>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="" id="sendsms">Send SMS</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="" id="sendemail">Send Email</label>
                                </div>
                                Send Email on this email address
                                <input type='text' id='email' value = "{{=email}}">
                            </div>
                        </div>

                    </div>     
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" id="saveandsend">Send SMS & Save</button>
                        <button type="button" class="btn btn-default" id="saveOnly">Save Only</button>  
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
                    function saveAudogram(){
                    var audiogram = 'No';
                            var tympanogram = 'No';
                            if ($("#audocheck")[0].checked){
                    audiogram = 'Yes';
                    };
                            if ($("#tympcheck")[0].checked){
                    tympanogram = 'Yes';
                    };
                            $.post("{{=URL('audiographsave')}}",
                            {
                            'audiogram':audiogram,
                                    'tympanogram':tympanogram,
                                    'report_id':{{ = request.args(0)}},
                                    'date_appointment':$(".re_date").val(),
                                    'audiogram_report':document.getElementById("svgGraph").outerHTML,
                                    'current_state':$("select[name='current_state']").val(),
                                    'degrees_of_hearing':$("select[name='degrees_of_hearing']").val(),
                                    'next_date':$("input[name='next_date']").val(),
                                    'next_time':$("input[name='next_time']").val(),
                                    'additional_remark':$("textarea[name='additional_remark']").val(),
                                    'doctoraud':$("input[name='doctorAud']").val(),
                                    'doctortmp':$("select[name='doctorTmp']").val(),
                                    'temp_re':$(".ret").val(),
                                    'temp_re_comp':$(".rsc").val(),
                                    'temp_re_press':$(".rmep").val(),
                                    'temp_le':$(".let").val(),
                                    'temp_le_comp':$(".lsc").val(),
                                    'temp_le_press':$(".lmep").val(),
                            },
                                    function(data) {
                                    $("#smsCheck").html("<h3>Report Submitted.</h3>");
                                            window.location = "{{=URL('default', 'index')}}";
                                    }
                            );
                    }
            $(function(){
            if ($(document).width() < 1050){
            $("#additional").removeClass("col-md-5");
                    $("#additional").addClass("col-md-12");
            };
                    $("#saveOnly").click(function(){
            $("#smsCheck").html("<h3>Saving Only Data...</h3>")
                    saveAudogram();
                    console.log("hello")
            });
                    $("#saveandsend").click(function(){
            var data = {
            'patient_name':$(".patient_name").val(),
                    'audiogram':'',
                    'tympanogram':'',
                    'email':$("#email").val(),
                    'mobile':$("#mobileNo").val(),
            };
                    if ($("#tympsms")[0].checked){
            data['tympanogram'] = $(".tympInt").val();
            };
                    if ($("#audsms")[0].checked){
            data['audiogram'] = $(".audioInt").val();
            };
                    if ($("#sendsms")[0].checked){
            data['sms'] = 'yes';
            };
                    if ($("#sendemail")[0].checked){
            data['semail'] = 'yes';
            };
                    $("#smsCheck").html("<h3>Sending SMS ..</h3>")
                    $.get("{{=URL('sendReport')}}", data, function(result){
                    $("#smsCheck").html(result);
                            saveAudogram();
                    })
            });
                    $("#refresh").click(function(){
            window.location.reload();
            })


            })
        </script>
        <!-- The javascript =============================================
             (Placed at the end of the document so the pages load faster) -->
        <script src="{{=URL('static','js/bootstrap.min.js')}}"></script>
        <script src="{{=URL('static','js/web2py_bootstrap.js')}}"></script>
</body>
<script>

            function setDataText(classname, setData){
            $("text." + classname).text(setData);
                    var textobj = $("input." + classname).val(setData);
            }

    $(document).ready(function() {
    $(".ret").autocomplete(
    {
    source: [{{ = XML(tempRe)}}],
            select: function(event, ui) {
            setDataText('ret', ui.item.value);
            }
    });
            //        $( ".ret" ).autocomplete({source: [{{=XML(tempRe)}}] });



            $(".rsc").autocomplete(
    {
    source: [{{ = XML(tempReComp)}}],
            select: function(event, ui) {
            setDataText('rsc', ui.item.value);
            }
    });
            //        $( ".rsc" ).autocomplete({source: [{{=XML(tempReComp)}}] });



            $(".rmep").autocomplete(
    {
    source: [{{ = XML(tempRePress)}}],
            select: function(event, ui) {
            setDataText('rmep', ui.item.value);
            }
    });
            //        $( ".rmep" ).autocomplete({source: [{{=XML(tempRePress)}}] });



            $(".let").autocomplete(
    {
    source: [{{ = XML(tempLe)}}],
            select: function(event, ui) {
            setDataText('let', ui.item.value);
            }
    });
            //        $( ".let" ).autocomplete({source: [{{=XML(tempLe)}}] });


            $(".lsc").autocomplete(
    {
    source: [{{ = XML(tempLeComp)}}],
            select: function(event, ui) {
            setDataText('lsc', ui.item.value);
            }
    });
            //        $( ".lsc" ).autocomplete({source: [{{=XML(tempLeComp)}}] });


            $(".lmep").autocomplete(
    {
    source: [{{ = XML(tempLePress)}}],
            select: function(event, ui) {
            setDataText('lmep', ui.item.value);
            }
    });
            //        $( ".lmep" ).autocomplete({source: [{{=XML(tempLePress)}}]});
            //         $(".printDiv").mousemove(function(){  

            //               $(".getText").each(function(){
            //                $(this).val($(this).val()).keyup();
            //             });

            //         });

    });
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  


2,327,772,771,770,769,768,767,766,765,764,763,762,761,760,759,758,757,756,755,754,753,752,751,750,749,748,747,746,745,744,743,742,741,740,739,738,737,736,735,734,733,732,731,730,729,728,727,726,725,724,723,722,721,720,719,718,717,716,715,714,713,712,711,710,709,708,707,706,705,704,703,702,701,700,699,698,697,696,695,694,693,692,691,690,689,688,687,686,685,684,683,682,681,680,679,678,677,676,675,674,673,672,671,670,669,668,667,666,665,664,663,662,661,660,659,658,657,656,655,654,653,652,651,650,649,648,647,646,645,644,643,642,641,640,639,638,637,636,635,634,633,632,631,630,629,628,627,626,625,624,623,622,621,620,619,618,617,616,615,614,613,612,611,610,609,608,607,606,605,604,603,602,601,600,599,598,597,596,595,594,593,592,591,590,589,588,587,586,585,584,583,582,581,580,578,577,576,575,574,573,572,571,570,569,568,567,566,565,564,563,562,561,560,559,558,557,556,555,554,553,552,551,550,549,548,547,546,545,544,543,542,541,540,539,538,537,536,535,534,533,532,531,530,529,528,527,526,525,524,523,522,521,520,518,517,516,515,514,513,512,511,510,509,508,507,506,505,504,503,502,501,500,499,498,497,496,495,494,493,492,491,490,489,488,487,486,485,484,483,482,481,480,479,478,477,476,475,474,473,472,471,470,469,468,467,466,465,464,463,462,461,460,459,458,457,456,455,454,453,452,451,450,449,448,447,446,445,444,443,442,441,440,439,438,437,436,435,434,433,432,431,430,429,428,427,426,425,424,423,422,421,420,419,418,417,416,415,414,413,412,411,410,409,408,407,406,405,404,403,402,401,400,399,398,397,396,395,394,393,392,391,390,389,388,387,386,385,384,383,382,381,380,379,378,377,376,375,374,373,372,371,370,369,368,367,366,365,364,363,362,361,360,359,358,357,356,355,354,352,351,350,349,348,346,345,344,343,342,341,340,339,338,337,336,335,334,333,332,331,330,329,328,326,325,324,323,322,321,320,319,318,317,316,315,314,313,312,311,310,309,308,307,306,305,304,303,302,301,300,299,298,297,296,295,294,293,292,291,290,289,288,287,286,285,284,283,282,281,280,279,278,277,276,275,274,273,272,271,270,269,268,267,266,265,264,263,262,261,260,259,258,257,256,255,254,253,252,251,250,249,248,247,246,245,244,243,242,241,240,239,238,237,236,235,234,233,232,231,230,229,228,227,226,225,224,223,222,221,220,219,218,217,216,215,214,213,212,211,210,209,208,207,206,205,204,203,202,201,200,199,198,197,196,195,194,193,192,191,190,189,188,187,186,185,184,183,182,181,180,179,178,177,176,175,174,173,172,171,170,169,168,167,166,165,164,163,162,161,160,159,158,157,156,155,154,153,152,151,150,149,148,147,146,145,144,143,142,141,140,139,138,137,136,135,134,133,132,131,130,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,95,94,93,92,91,90,89,88,87,86,85,84,83,82,81,80,79,78,77,76,75,74,73,72,71,70,69,68,67,66,65,64,63,62,61,60,59,58,57,56,55,54,53,52,51,50,49,48,47,46,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31,30,29,28,27,26,25,24,23,22,21,20,19,18,17,16,15,14,13,12,11,10,9,8,7,6,5,4,3