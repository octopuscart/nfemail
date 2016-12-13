<?php

#update 10dec2015
ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

class MailAndMessageHandler {

    public function __construct($order_id, $user_id, $authobj, $option, $number1) {

        $this->productId = $order_id;
        $this->user_id = $user_id;
        $this->authobj = $authobj;
        $this->num_to_word = $number1;
        $this->option = $option;
    }

    function orderPdf() {
        ob_end_clean();
        // pdf code 
        //$userInfo = $this->authobj->userProfile($this->user_id);
        // print_r($userInfo);
        $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        include './mainPdfSummary.php';

        $mpdf->WriteHTML($html, 2);

        $fname = $orderDetail[0]['order_no'] . '.pdf';
        if ($this->option == 'I') {
            $mpdf->Output($fname, 'I');
            // echo $html;
        }
        if ($this->option == 'D') {
            $mpdf->Output($fname, 'D');
        }
        return $fname;
    }

###################
}

if (isset($_REQUEST['order_id'])) {
    $authobj = new AuthHandler();
    $order_id = $_REQUEST['order_id'];
    $obj = new MailAndMessageHandler($order_id, $_REQUEST['user_id'], $authobj, $_REQUEST['option'], $_REQUEST['number1']);
    $obj->orderPdf();
    $url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $url);
}
?>
 
