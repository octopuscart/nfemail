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
        $data = $this->authobj->orderShippingDetail($this->user_id);
        $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        //print_r($data);
        ############################################
        $description.= '<html>
            

      ' . $pdf_template_header . '
             <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                Order Tracking Reports 
            </div>
        </div> 
                             <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;font-family: sans-serif;">
                 <tbody>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                  
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.</b></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Shipping Date<b/></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Weight<b/></th>
<!--                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Sender Company<b/></th>-->
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Destination Country<b/></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Tracking No.<b/></th>
                                        <th style="font-size: 11px;text-align:center"><b>Shipping Company<b/></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                                        <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Status<b/></th>

                </tr>';

        for ($i = 0; $i < count($data); $i++) {
            $description.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;font-size: 11px">
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $description.= $i + 1;
            $description.='</td>             
                         <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['order_no'];
            $description.='</td>
                               <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';

            $description.= $data[$i]['invoice_no'];
            $description.='</td>
 <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['shipping_date'];
            $description.='</td>
<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $description.= $data[$i]['total_weight'] . ' ' . $data[$i]['weight_unit'];

            $description.='</td>

<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['destination_country'];
            $description.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $description.= $data[$i]['tracking_no'];
            $description.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['shipping_company'];
            $description.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['op_date_time'];
            $description.='</td>
                     <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $ids = $data[$i]['status'];
            $stat = $this->authobj->statusTag($ids);

            $description.= $stat[0]['title'];

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
        $fname = 'orderTacking' . $this->client_code . '.pdf';
        $mpdf->Output($fname, 'F');
        return $fname;
    }

    function mail_sending_information() {
        include '../phpPlugin/mailer/class.phpmailer.php';
        $userInfo = $this->authobj->userProfile($this->user_id);
        $email = array($userInfo[0]['email']); //'imteyaz_bari@yahoo.com ';
        #$email = array('sayedhk123@gmail.com'); //'imteyaz_bari@yahoo.com ';
        //include '../producthandler/mailAndMessageHandler.php';

        $mail = new PHPMailer; // call the class  
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = "sayedhk123@gmail.com"; //Username for SMTP authentication any valid email created in your domain
        #newpass = libglmetfakmwjyq
        $mail->Password = "libglmetfakmwjyq"; //Password for SMTP authentication
        $mail->AddReplyTo("sayedhk123@gmail.com", "Reply name"); //reply-to address]
        $mail->SetFrom("sayedhk123@gmail.com", "Nita Fashions"); //From address of the mail

        $mail->Subject = 'Your Order Tracking Detail'; //Subject od your mail
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