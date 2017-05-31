<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

class MailAndMessageHandler {

    public function __construct($user_id, $authobj, $option, $tab, $client_code) {

        //$this->productId = $product_id;
        $this->user_id = $user_id;
        $this->authobj = $authobj;
        $this->tab = $tab;
        $this->option = $option;
        $this->client_code = $client_code;
    }

    function orderPdf() {
        ob_end_clean();
        $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        include './allInvoicesPdf.php';
        // end
        $mpdf->setFooter('Page {PAGENO} of {nb}');
        $mpdf->WriteHTML($html, 2);
        ob_clean();
        $fname = 'AllInvoices' . $this->client_code . '.pdf';


        if ($this->tab == 'I') {
            $mpdf->Output($fname, 'I');
            // echo $html;
        }
        if ($this->tab == 'D') {
            $mpdf->Output($fname, 'D');
        }
        return $fname;
    }

###################
}

if (isset($_REQUEST['user_id'])) {
    $authobj = new AuthHandler();
    // $product_cart_id = $_REQUEST['order_id'];
    $obj = new MailAndMessageHandler($_REQUEST['user_id'], $authobj, $_REQUEST['option'], $_REQUEST['tab'], $_REQUEST['client_code']);
    $obj->orderPdf();
    $url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $url);
}
?>

