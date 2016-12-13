<?php

ob_start();
include '../dbhandler/dbhandler.php';
include 'productHandler.php';
include 'authHandler.php';

class MailAndMessageHandler {

    function mail_sending_information($product_cart_id, $measurement_id, $tag_name) {

        $query = "select * from nfw_custom_form_data where id = $product_cart_id ";
        $final_data = resultAssociate($query);
        $data = $final_data[0]['custom_form_data'];
        $shirtSummary = phpjsonstyle($data, 'php');
        $measurmentProfile1 = resultAssociate("SELECT measurement_data FROM `nfw_measurement_data` where id = $measurement_id ");
        $data1 = $measurmentProfile1[0]['measurement_data'];

        $measurmentProfile = phpjsonstyle($data1, 'php');

        include '../phpPlugin/mailer/class.phpmailer.php';
        $email = array('sayedhk123@gmail.com'); //'imteyaz_bari@yahoo.com ';
        $mail = new PHPMailer; // call the class  
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        #newpass = libglmetfakmwjyq
        $mail->Username = "sayedhk123@gmail.com"; //Username for SMTP authentication any valid email created in your domain
        $mail->Password = "libglmetfakmwjyq"; //Password for SMTP authentication
        $mail->AddReplyTo("sayedhk123@gmail.com", "Reply name"); //reply-to address]
        $mail->SetFrom("sayedhk123@gmail.com", "Asif18 SMTP Mailer"); //From address of the mail
        // put your while loop here like below,
        $mail->Subject = 'Your Style Detail'; //Subject od your mail
        foreach ($email as $to_add) {
            $mail->AddAddress($to_add, "Asif18");              // name is optional
        }
        //To address who will receive this email
        $description .= '<html>
            <div style="width:100%;margin-top: 1%;">
            <div style="width: 100%;border:1px;text-align: center;background:black;margin-bottom: 10px;font-size: 20px;color: white;"> Style Profile Id : ' . $final_data[0]['style_profile'] . '</div>
                        <div style="width:100%;text-align: center;background:black;margin-bottom: 10px;font-size: 20px;color: white;">' . $tag_name . ' Style Summary</div>
                           <div style="width: 97%;min-height: 200px;background-color:white;border-color:black;border: 1px solid;padding: 8px;font-size: 14px;font-weight: 500;">
                             <table style="width:80%;margin:0% 20%">';

        foreach ($shirtSummary as $key => $value) {
            $description .= '<tr ><td style="width:47%;">' . $key . '</td><td style="width:47%;">' . $value . '</td></tr>';
        }

        $description .= '</table>
                           </div>
                        </div>
                       </div>
             <div style="width:100%;text-align: center;background:black;margin-top:1%;font-size: 20px;color: white;">' . $tag_name . ' Measurement Summary</div>    

           <div style="margin-top:10px;width: 97%;min-height: 200px;background-color:white;border-color:black;border: 1px solid;padding: 8px;font-size: 14px;font-weight: 500;">
                 <table style="width:80%;margin:0 20%">';

        foreach ($measurmentProfile as $key => $value) {
            $description .= '<tr><td style="width:47%;">' . ucwords(str_replace("_", " ", $key)) . '</td><td style="width:47%">' . $value . '</td></tr>';
        }

        $description .= '</table>
                           </div>

                         </html>';
        $data = $mail->MsgHTML($description); //Put your body of the message you can place html code here
//        $url = 'file:///home/atharva/Downloads/Order.pdf';
//        $mail->AddAttachment($url); //Attach a file here if any or comment this line, 
//        $mail->AddAttachment('http://192.168.3.47/nf3/nitaFashionAdmin/index.php/ProductHandler/generate_product_pdf/12/2/2/3/three%20hundred%20sixty%20five');
        $send = $mail->Send(); //Send the mails
    }

   

}

function new_registration($username){
    $regmail = '
         <p style="text-align: center;"><img src="http://nf1.costcokart.com/NF_V4/nf3/frontend/assets/images/logo/nf_logo_8.png" style="width: 141.0625px; height: 77.0437173344948px;"><span style="line-height: 1.2;"><br></span></p>
<p style="text-align: center;"><span style="line-height: 1.2; font-size: 24px;">Hello &nbsp;$username</span><br></p>
<p style="text-align: center;"><span style="line-height: 25.2000007629395px; font-size: 24px;">&nbsp; Welcome to Nita Fashions</span></p>
<p style="text-align: center;"><span style="line-height: 25.2000007629395px; font-size: 24px;">Thanks to Join us</span></p>
<p style="text-align: center;"><a href="http://nf1.costcokart.com/NF_V4/nf3/frontend/views/index.php" target="_blank" style="line-height: 1.2; font-size: 14px; padding: 10px; color: rgb(247, 247, 247); background-color: rgb(0, 0, 0);">Start Shopping Now</a><br></p>
<div style="text-align: center;"><br></div>
<div style="text-align: center;"><span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 24px; text-align: start; background-color: rgb(255, 255, 255);">&nbsp;'."The world's".' fabrics are careful selected to live up to name of Nita Fashions. We carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</span></div>
<div style="text-align: center;"><span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 24px; text-align: left; background-color: rgb(255, 255, 255);">Since 1953, our label has been one of the most respected names in '."men's".' clothing, identified with superior fabrics. Nita Fashions carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</span><span style="font-family: Lato, sans-serif; font-size: 16px; line-height: 24px; text-align: start; background-color: rgb(255, 255, 255);"><br></span></div>
<p></p>
            
            ';
}



if (isset($_REQUEST['customized_id'], $_REQUEST['measurement_id'])) {
    ob_end_clean();
    $product_cart_id = $_REQUEST['customized_id'];
    $obj = new MailAndMessageHandler();
    $obj->mail_sending_information($product_cart_id, $_REQUEST['measurement_id'], $_REQUEST['tag_name']);
    // $path =   split('/', $_SERVER['REQUEST_URI'])[4];
    //header('location:../views/'.$path);
    header('location:' . $_SERVER['HTTP_REFERER']);
}
?>