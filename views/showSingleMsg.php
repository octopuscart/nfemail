<?php include 'header.php'; 
include '../producthandler/newsLetterHandler.php';
$mail=new NewsLetterHandler();
$shownewsletter=$mail->changeNewsLetterStatus($_REQUEST['id'],'1');
?>
<?php //print_r($shownewsletter[0]); ?>
<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30" style=" margin-left: -40px;width:18%" >	

                <?php
                include 'leftMenu.php';
                ?>

            </aside>

            <div class="col-lg-9 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30" style="width: 85%;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class=""></i> <?php echo $shownewsletter[0]['title']; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                             <p> <?php echo $shownewsletter[0]['short_description']; ?></p>
                            <hr>
                             <tr class="attt">
                                 <td> <?php echo $shownewsletter[0]['message']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <!--banners-->
    </div>
</div>
<?php include 'footer.php'; ?>
