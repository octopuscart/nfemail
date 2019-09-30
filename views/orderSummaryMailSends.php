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
        $data = $this->authobj->allOrderDetails($this->user_id);
        $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        ############################################
        $description.= '<html>
            

      <div>
            ' . $pdf_template_header . '
             <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                Order Summary Reports 
            </div>
        </div> 
                             <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;font-family: sans-serif;">
                 <tbody>
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                    <th style="width:20px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.</b></th>
                    <th style="width:50px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Description<b/></th>
                    <th style="width:20px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Total Price<b/></th>
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

            $datas = $this->authobj->countProducts($data[$i]['id']);
            $temp = array();
            //print_r($datas);
            for ($s = 0; $s < count($datas); $s++) {
                $tag_id = $datas[$s];
                $catObj = new CategoryHandler();
                $res = $catObj->productTag($tag_id['tag_id']);
                $description.='<span>';
                $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
                array_push($temp, $string);
                $description.='</span>';
            }
            $description.= implode(', ', $temp);
            $description.='</td>
 <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['op_date'] . $data[$i]['op_time'];
            $description.='</td>
<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $d1 = explode('$', $data[$i]['total_price'])[1];
            $description.='$' . number_format($d1, 2, '.', '');
            $description.='</td>

<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $description.= $data[$i]['title'];
            $description.='</td>
</tr>';
        }

        $description.= '</tbody>
                       </table>
                       
                       </div>
          </html>';
        ############################################

        $mpdf->WriteHTML($description);
        $fname = 'pdf/orderSummary' . $this->client_code . '.pdf';
        $mpdf->Output($fname, 'F');
        return $fname;
    }

    function mail_sending_information() { 
$authobj = new AuthHandler();
$mailconf = $authobj->mail_configuration();
        include '../phpPlugin/mailer/class.phpmailer.php';
        $userInfo = $this->authobj->userProfile($this->user_id);
        $email = array($userInfo[0]['email']); //'imteyaz_bari@yahoo.com ';
        # $email = array('sayedhk123@gmail.com'); //'imteyaz_bari@yahoo.com ';
        //include '../producthandler/mailAndMessageHandler.php';
        $mail = new PHPMailer; // call the class  
        $mail->IsSMTP();
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
        $mail->Subject = 'Your Order Summary Detail'; //Subject od your mail
        foreach ($email as $to_add) {
            $mail->AddAddress($to_add, "Nita Fashions");              // name is optional
        }
        ####################################################
        $res = $this->orderPdf();
        //echo $res;
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
    $url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $_SERVER['HTTP_REFERER']);
}
?>