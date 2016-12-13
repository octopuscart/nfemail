<?php
include 'header.php';
include '../producthandler/productHandler.php';
include '../producthandler/newsLetterHandler.php';
$mail = new NewsLetterHandler();
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);
    </script>

    <?php
} else {
    

if (isset($_POST['DeleteNewsLetter'])) {
    $mail->changeNewsLetterStatus($_POST['DeleteNewsLetter'], 2);
}
$userInfo = $authobj->userProfile($_SESSION['user_id']);
if($_SESSION['user_id']==''){ ?>
    <script>
    setTimeout(function(){ $('.Login').click(); },500 );
</script>

<?php }
else{

$maliInfo = $mail->getNewsLetter($_SESSION['user_id']);

?>
<style>
    .read{
        background-color: ghostwhite; 
        cursor: pointer;
        border:1px solid rgba(175, 170, 170, 0.25);
    }
    .unread{
        background-color: white;
        cursor: pointer;
        border:1px solid rgba(175, 170, 170, 0.25);
    }
    .table>tbody>tr>td,.table>thead>tr>th{
        border:none;
    }
</style>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding-top: 15px;
         padding-bottom: 0px;
       
         box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo[0]['first_name']; ?></h3>
         <p style="color:black;margin-top: 10px;">Newsletter</p>
        <div style="margin-top: 10px;">   </div>

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

            <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo[0]['registration_id'] ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <button class="btn btn-default"><i class="icon-plus"> Total message - </i>
                                <?php
                                $total_msg = $mail->countNewsLetter($_SESSION['user_id'], '0,1');
                                print_r(count($total_msg));
                                ?>
                            </button>
                            <button class="btn btn-default"><i class="icon-mail-1"> Read - </i>
                                <?php
                                $read_msg = $mail->countNewsLetter($_SESSION['user_id'], '1');
                                print_r(count($read_msg));
                                ?> 
                            </button>
                            <button class="btn btn-default"><i class="icon-mail-alt"> Unread - </i>
                                <?php
                                $unread_msg = $mail->countNewsLetter($_SESSION['user_id'], '0');
                                print_r(count($unread_msg));
                                ?> 
                            </button>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                            <table class="table">


                                <?php
                                for ($i = 0; $i < count($maliInfo); $i++) {
                                    if ($maliInfo[$i]['flag'] == 1) {
                                        $class = 'read';
                                    } else {
                                        $class = 'unread';
                                    }
                                    ?>

                                    <tr class="<?php echo $class; ?>" style="">
                                        <td  id="<?php echo $maliInfo[$i]['id']; ?>" onclick="change_status(this)" >
                                            <div class="col-md-6">
                                                <h5 style="color:slateblue;"><?php echo $maliInfo[$i]['title']; ?></h5><br/>
                                                <p><?php echo $maliInfo[$i]['short_description']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="post" action="#">
                                                <button value="<?php echo $maliInfo[$i]['id']; ?>" name="DeleteNewsLetter"> <i class="icon-cancel-circled-1 fs_large"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--banners-->
    </div>
</div>

<?php
}
}
include 'footer.php';
?>
<script>
    function change_status(obj) {
        var id = obj.id;
        window.location = 'showSingleMsg.php?id=' + id;
    }
</script>