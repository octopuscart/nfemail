<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

class MailAndMessageHandler {

    public function __construct($user_id, $client_code, $authobj) {
        $this->user_id = $user_id;
        $this->authobj = $authobj;
        $this->client_code = $client_code;
    }

    function orderPdf() {
        ob_end_clean();
        #####################################################
        include("../phpPlugin/mpdf/mpdf.php");
        $mpdf = new mPDF('win-1252', 'A4', '', '', 10, 10, 20, 10, 0, 0);
        $stylesheet = file_get_contents('../assets/font-awesome/4.3/css/font-awesome.min.css');
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
        $mpdf->defaultheaderfontsize = 10; /* in pts */
        $mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
        $mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */
        $mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
        $invoiceData = $this->authobj->invoiceDetail($this->user_id);
        ############################################
        $description.= '<html>
            

      <div>
            <div style="text-align:center;margin-bottom:0px"> 
                <span style="font-family: sans-serif;font-size:30px;">
                    Nita Fashions
                </span>
            </div>
            <div style="margin-top:0px;text-align:center;font-family: sans-serif;font-size:12px">
                <span style="">
                    16 Mody Road, GF, T. S. T, Kowloon, Hong Kong<br>
                    T: + (852) 27219990, 27219991,  F: +852 27234886, E: info@nitafashions.com, W: www.nitafashions.com  
                </span>
            </div>
        </div>   
        <hr></hr>
             <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                Order Invoice Reports 
            </div>
        </div> 
                             <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;font-family: sans-serif;">
              <tbody>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time</b></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.<b/></th>

                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Item Name<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Price<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Extra Price<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Coupon/Discount<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Wallet<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Total Price<b/></th>
</tr>';

        for ($i = 0; $i < count($invoiceData); $i++) {

            $invoice = $invoiceData[$i];
            $totalExtra = $this->authobj->totalExtraPrice($invoice['order_id']);
            $description.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;font-size: 11px">
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $description.= $i + 1;
            $description.='</td>             
                         <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $invoice['op_date'] . '/' . $invoice['op_time'];
            $description.='</td>
                               <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';

            $description.= $invoice['invoice_no'];
            $description.='</td>
           <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $invoice['order_no'];
            $description.='</td>
           ';
            $cart_obj = new CartHandler();
            $catObj = new CategoryHandler();
            $orderDatas = $this->authobj->order_product_detail($invoice['order_id'], $this->user_id);
            // $data = $cart_obj->cartId($this->user_id, $invoice['order_id']);
            $temp1 = array();
            for ($j = 0; $j < count($orderDatas); $j++) {
                $cartInfo = $orderDatas[$i];
                //$cart_id = $data[$j];
                //$cartInfo = $cart_obj->cartProductsInformation($cart_id['id'], $this->user_id);
                $string = $cartInfo['sku'];
                array_push($temp1, $string);
            }
            //$description.= implode(', ', $temp1);
            $description.='
            <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $datas = $this->authobj->countProducts($invoice['order_id']);
            $temp2 = array();
            for ($s = 0; $s < count($datas); $s++) {
                $tag_id = $datas[$s];
                //  print_r($tag_id['tag_id']);
                $res = $catObj->productTag($tag_id['tag_id']);
                $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
                array_push($temp2, $string);
            }
            $description.= implode(',', $temp2);

            $description.='</td>
                     <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';

            $description.= '$' . number_format($totalExtra[0]['total'], 2, '.', '');

            $description.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            if ($totalExtra[0]['extra'] > 0) {
                $description.= '$' . number_format($totalExtra[0]['extra'], 2, '.', '');
            } else {
                $description.= '$00.00';
            }

            $amt = number_format($totalExtra[0]['total'], 2, '.', '') + number_format($totalExtra[0]['extra'], 2, '.', '');
            $out_data = $this->authobj->coupanDetail($invoice['coupon_id'], $amt);
            $description.='</td>
    
           <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            if ($out_data) {
                $description.='$' . number_format($out_data, 2, '.', '');
            } else {
                $description.= '$00.00';
            }
            $description.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            if ($invoice['wallet_amount']) {
                $description.= '$' . number_format($invoice['wallet_amount'], 2, '.', '');
            } else {
                $description.= "$00.00";
            }
            $description.='</td>
                
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $description.= '$' . number_format(explode('$', $invoice['total_amount'])[1], 2, '.', '');
            $description.='</td>
                
         </tr>';
        }

        $description.= '</tbody>
                       </table>
                       
                       </div>
          </html>';
        ############################################
        $mpdf->WriteHTML($description);
        ob_clean();
        $fname = 'allInvoiceReport' . $this->client_code . '.pdf';
        $mpdf->Output($fname, 'F');
        return $fname;
    }

    function mail_sending_information() {
        $authobj = new AuthHandler();
        $mailconf = $authobj->mail_configuration();
        include '../phpPlugin/mailer/class.phpmailer.php';
        $userInfo = $this->authobj->userProfile($this->user_id); 
        $email = array($userInfo[0]['email']); //'imteyaz_bari@yahoo.com ';
        //$email = array('sayedhk123@gmail.com'); //'imteyaz_bari@yahoo.com ';
        //include '../producthandler/mailAndMessageHandler.php';
        $mail = new PHPMailer; // call the class  
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = $mailconf['host'];
        $mail->Port = $mailconf['port'];
        $mail->Username = $mailconf['username']; //Username for SMTP authentication any valid email created in your domain
        $mail->Password = $mailconf['password']; //Password for SMTP authentication
        $mail->AddReplyTo($mailconf['mail_sender'], "Nita Fashions"); //reply-to address
        $mail->SetFrom($mailconf['username'], "Nita Fashions"); //From address of the mail
// put your while loop here like below,

        $mail->AddCC($mailconf['mail_sender']);
        $mail->AddBCC($mailconf['username']);

        $mail->Subject = 'Your All Invoices Detail'; //Subject od your mail
        foreach ($email as $to_add) {
            $mail->AddAddress($to_add, "Nita Fashions");              // name is optional
        }
        ####################################################
        $res = $this->orderPdf();
        $mail->MsgHTML($res); //Put your body of the message you can place html code here
        $path = $res;
        $mail->AddAttachment($path); //Attach a file here if any or comment this line, 
        $mail->Send(); //Send the mails
    }

}

if (isset($_REQUEST['user_id'])) {
    // echo "fsdfdf";
    $authobj = new AuthHandler();
    $obj = new MailAndMessageHandler($_REQUEST['user_id'], $_REQUEST['client_code'], $authobj);
    $obj->mail_sending_information();
    // $url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $_SERVER['HTTP_REFERER']);
}
?>