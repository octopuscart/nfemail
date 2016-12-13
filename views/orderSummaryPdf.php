<?php
ini_set("display_errors", "1");
ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

class MailAndMessageHandler {

    public function __construct($product_id, $user_id, $authobj, $number1) {

        $this->productId = $product_id;
        $this->user_id = $user_id;
        $this->authobj = $authobj;
        $this->num_to_word = $number1;
    }

    function orderPdf() {
        ob_end_clean();
        $userInfo = $this->authobj->userProfile($this->user_id);
        // print_r($userInfo[0]);
         $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        include './mainPdfSummary.php';
        $mpdf->WriteHTML($html);
        ob_clean();
        $fname = $orderDetail[0]['order_no'] . '.pdf';
        $mpdf->Output($fname, 'F');
        return $fname;
    }

    ###################

    function mail_sending_information() {
        include '../phpPlugin/mailer/class.phpmailer.php';
        $userInfo = $this->authobj->userProfile($this->user_id);
        $email = array($userInfo[0]['email']); //'imteyaz_bari@yahoo.com ';
        # mail sending common file
        include '../producthandler/mailAndMessageHandler.php';
        $res = $this->orderPdf();
        $data = $mail->MsgHTML($res); //Put your body of the message you can place html code here
        $path = $res;
        $mail->AddAttachment($path); //Attach a file here if any or comment this line, 
        $send = $mail->Send(); //Send the mails
    }

}

if (isset($_REQUEST['order_id'])) {
    $authobj = new AuthHandler();
    $product_cart_id = $_REQUEST['order_id'];
    //$obj = new MailAndMessageHandler($product_cart_id, $_REQUEST['user_id'], $authobj, $_REQUEST['number1']);

    $authobj = new AuthHandler();

    $authobj->orderConfirmMail($product_cart_id, $_REQUEST['user_id']);
    //$obj->mail_sending_information();
    //$url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $_SERVER['HTTP_REFERER']);
}
?>

