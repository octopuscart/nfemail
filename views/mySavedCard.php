<?php
include 'header.php';
$userInfo = $authobj->userProfile($_SESSION['user_id']);
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {

    if (isset($_REQUEST['card_submit'])) {
        // print_r($_POST);
        $test = array();
        foreach ($_POST as $key => $value) {
            $v1 = str_replace(':', ' ', $value);
            $v2 = str_replace(',', ' ', $v1);
            $test[$key] = $v1;
            $test[$key] = $v2;
        }
        $authobj->cardInfoInsertion($_SESSION['user_id'], $test);
        header('location:mySavedCard.php');
    }

#For delete address
    if (isset($_POST['deleteCart'])) {
        // print_r($_POST);
        $authobj->delete_card($_SESSION['user_id'], $_POST['deleteCart']);
        // header('location:mySavedCard.php');
    };
    #for update card
    if (isset($_POST['updateCard'])) {
        // print_r($_POST);
        $test = array();
        foreach ($_POST as $key => $value) {
            $v1 = str_replace(':', ' ', $value);
            $v2 = str_replace(',', ' ', $v1);
            $test[$key] = $v1;
            $test[$key] = $v2;
        }
        $authobj->updateCard($_SESSION['user_id'], $test);
    }

    $data = $authobj->card_detail($_SESSION['user_id']);
    ?>
    <style>
        .datatable th{
            border: none;
            border-bottom: 1px solid gainsboro;

        }/*
        */        .datatable td{


            border: none;
            border-bottom: 1px solid gainsboro;;
        }
        .updateAddress td{
            border: none;
        }

    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
            <p style="color:black;margin-top: 10px;">Card Information</p>
            <div style="margin-top: 10px;"> </div>
        </div>
    </section>

    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-2 col-sm-2 m_bottom_50 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	
                    <?php
                    include 'leftMenu.php';
                    ?>
                </aside>
                <div class="col-lg-9 col-md-10 col-sm-10 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                        </div>
                        <div class="panel-body">
                            <!-- ############################# -->


                            <div class="col-md-6" style="    padding-top: 53px;">                               
                                <div class="card-wrapper"></div>
                            </div>


                            <form action="#" class="form-horizontal" role="form" method="post" id="create_form">
                                <fieldset>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Name on Card" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                                        <div class="col-sm-6" style="">
                                            <input type="text" class="form-control " name="card-number" id="card-number" placeholder="Credit Card Number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                                        <div class="col-sm-9">
                                            <div class="row" style="    padding: 0px 5px;">
                                                <div class="" style="width:100px">
                                                    <select class="form-control col-sm-3" name="expiry-month" id="expiry-month">
                                                        <option>Month</option>
                                                        <option value="01">Jan (01)</option>
                                                        <option value="02">Feb (02)</option>
                                                        <option value="03">Mar (03)</option>
                                                        <option value="04">Apr (04)</option>
                                                        <option value="05">May (05)</option>
                                                        <option value="06">June (06)</option>
                                                        <option value="07">July (07)</option>
                                                        <option value="08">Aug (08)</option>
                                                        <option value="09">Sep (09)</option>
                                                        <option value="10">Oct (10)</option>
                                                        <option value="11">Nov (11)</option>
                                                        <option value="12">Dec (12)</option>
                                                    </select>
                                                </div>

                                                <div class="" style="width: 100px;float: left;margin-left: 20px;">

                                                    <select class="form-control isNumber" name="expiry-year">
                                                        <?php for ($i = date('Y'); $i < date('Y') + 34; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" id="exp_year">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cvv">Card Type</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" name="bank_name" id="card_type" readonly="" placeholder="Card Type"  value=" "  style="" >
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="cvv">Address</label>
                                                                            <div class="col-xs-4">
                                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value=" "   style="" >
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cvv">CVV</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control is_number" name="cvv" id="cvv" placeholder="Code"   style="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-default " name="card_submit">
                                                <i class="icon-check"></i> Save
                                            </button> 
                                        </div>
                                    </div>
                                </fieldset>

                            </form>


                        </div>
                    </div>
                    <!-- ############################# -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Card List</h3>
                        </div>
                        <div class="panel-body">
                            <?php if ($data) { ?>
                            <form method="post" action="#" onsubmit="return confirm('Are you sure you want to delete this card?');">


                                    <table class="datatable" align:center>
                                        <tr style="font-size:14px">
                                            <th><b>S.No.</b></th>
                                            <th><b>Name on Card</b></th>

                                            <th><b>Card Number</b></th>
                                            <th><b>Expiration Date</b></th>
                                            <th><b>Card Type</b></th>
                                            <!--<th><b>Address</b></th>-->
                                            <th><b>CVV</b></th>
                                            <th></th>

                                        </tr>
                                        <?
                                        for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                        <tr style="font-size:12px">
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $data[$i]['card_holder_name'] ?></td>

                                            <td>
                                                <?php
                                                $dd = substr($data[$i]['card_number'], -4);
                                                echo '************' . $dd;
                                                ?>
                                            </td>
                                            <td><?php echo $data[$i]['expiry_month'] ?>/<?php echo $data[$i]['expiry_year'] ?></td>
                                            <td><?php echo $data[$i]['bank_name'] ?></td>
                                            <!--<td><?php echo $data[$i]['address'] ?></td>-->
                                            <td>***</td>
                                            <td>
                                                <span class="data-toggle" data-placement="top" title="Edit Address">
                                                    <a href=""  data-toggle="modal" data-target="#addressEdit" id="<?php echo $data[$i]['id']; ?>"  onclick="edit_card(this)">
                                                        <i class="icon-edit"></i>
                                                    </a>
                                                </span>&nbsp;
                                                <span class="data-toggle" data-placement="top" title="Delete">
                                                    <button type="submit"  name="deleteCart" value="<?php echo $data[$i]['id']; ?> " style="float:right" id="deleteid" >
                                                        <i class="icon-cancel-circled-1 fs_large"></i>
                                                    </button>
                                                </span>


                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>  

                            </form>
                        <?php } 
                        else{ ?>
                        <p style="font-size: 18px;text-align: center;color:red">NO CARD FOUND</p>
                    <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
}
include 'footer.php';
?>
<!-- Pop up for address upation -->
<style>
    .close{
        opacity: 1;
        color: white;
    }
    .modal-header{
        padding: 3px 19px;
        background: black;
    }
</style>
<div class="modal fade" id="addressEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 446px; margin: 0px 0px 0px 108px;">
            <div class="modal-header" style="color: white">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <p class="modal-title" id="myModalLabel">
                    <i class="icon-check"></i> Update Card Details
                </p>
            </div>
            <form method="post" action="#">
                <div class="modal-body">
                    <table class="updateAddress">
                        <tr>
                            <td>
                                <span for="name" class=""><b>Card Holder's Name</b></span>
                            </td>
                            <td>
                                <input type="text" name="card_holder_name" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span for="name" class=""><b>Card Number</b></span>
                            </td>
                            <td>
                                <input type="text" name="card_number" class="form-control is_number"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span for="name" class=""><b>Expiry Month</b></span>

                            </td>
                            <td>
                                <select class="form-control col-sm-2" name="expiry_month" id="expiry-month" style="height: 10%;">
                                    <option>Month</option>
                                    <option value="01">Jan (01)</option>
                                    <option value="02">Feb (02)</option>
                                    <option value="03">Mar (03)</option>
                                    <option value="04">Apr (04)</option>
                                    <option value="05">May (05)</option>
                                    <option value="06">June (06)</option>
                                    <option value="07">July (07)</option>
                                    <option value="08">Aug (08)</option>
                                    <option value="09">Sep (09)</option>
                                    <option value="10">Oct (10)</option>
                                    <option value="11">Nov (11)</option>
                                    <option value="12">Dec (12)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span for="name"><b>Expiry Year</b></span>
                            </td>
                            <td>
                                <select class="form-control is_number" name="expiry_year" style="height: 10%;">
                            <?php for ($i = 2015; $i < 2040; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span for="name"><b>Card Type</b></span>
                            </td>
                            <td>
                                <input type="text" name="bank_name" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>
<!--                        <tr>
                            <td>
                                <span for="name"><b>Address</b></span>
                            </td>
                            <td>
                                <input type="text" name="address" class="form-control"  value=""  style="height: 10%;">
                            </td>
                        </tr>-->
                        <tr>
                            <td>
                                <span for="name"><b>CVV</b></span>
                            </td>
                            <td>
                                <input type="text" name="cvv" class="form-control is_number"  value=""  style="height: 10%;">
                            </td>
                        </tr>
                        <input type="hidden" name="addID" value="">
                    </table>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-default btn-xs" name="updateCard" value="cfgc" style="margin: 10px 0px 0px 145px;">
                        <i class="icon-check"></i> Update
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

    function myFunction() {
        var txt;
        var r = confirm("Are you sure!");
        if (r == true) {

        }
        else {
            $('#deleteid').attr('name', 'test');

        }

    }
</script>
<script>
    function edit_card(obj) {
        var card_id = obj.id;
        $.ajax({
            url: 'ajaxController.php',
            method: 'post',
            data: {'cardupdation': 1, 'ids': card_id, 'user_id': '<?php echo $_SESSION['user_id'] ?>'},
            success: function (data) {
                var data1 = jQuery.parseJSON(data);
                console.log(data1);
                $("input[name='card_holder_name']").val(data1[0]['card_holder_name']);
                $("input[name='card_number']").val(data1[0]['card_number']);
                $("select[name='expiry_month']").val(data1[0]['expiry_month']);
                $("select[name='expiry_year']").val(data1[0]['expiry_year']);
                $("input[name='bank_name']").val(data1[0]['bank_name']);
                $("input[name='address']").val(data1[0]['address']);
                $("input[name='cvv']").val(data1[0]['cvv']);
                $("input[name='addID']").val(data1[0]['id']);
            }
        });
    }



</script>
<script src="../assets/cardcheck/card.js"></script>
<script>
    var cardss = new Card({
        form: '#create_form',
        formSelectors: {
            numberInput: 'input#card-number', // optional — default input[name="number"]
            expiryInput: 'input#exp_year', // optional — default input[name="expiry"]
            cvcInput: 'input#cvv', // optional — default input[name="cvc"]
            nameInput: 'input#card-holder-name' // optional - defaults input[name="name"]
        },
        container: '.card-wrapper'
    });

    var CardType = {'amex': 'American Express',
        'dankort': 'Dankort',
        'dinersclub': 'Diners Club',
        'discover': 'Discover',
        'jcb': 'JCB',
        'laser': 'Laser',
        'maestro': 'Maestro',
        'mastercard': 'Master Card',
        'unionpay': 'Union Pay',
        'visa': 'VISA',
        'visaelectron': 'VISA Electron',
        'elo': 'Elo'}


    function expcheck(){
        var yr =  $("select[name='expiry-year']").val();
        var mn = $("select[name='expiry-month']").val();
        console.log("----")
        $("#exp_year").val(mn+" / "+yr); 
        $("#exp_year").keyup()
    } 


    $("select[name='expiry-year']").click(function(){
        expcheck();
    })
     $("select[name='expiry-month']").click(function(){
        expcheck();
    })
    
    $("#card-number").keyup(function () {
        console.log(cardss);
        $("#card_type").val(CardType[cardss.cardType]);
    });
</script>