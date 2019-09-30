<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

ob_end_clean();
 
class MailAndMessageHandler {

    function mail_sending_information($product_cart_id, $tag_name) {
        $conf = resultAssociate("select * from server_conf");
        $conf = end($conf);
        $imageserver = $conf['image_server'];

        $query = "SELECT pc.customization_id,pc.customization_data,pc.measurement_id,pc.measurement_data,pc.posture_data,pc.user_images,au.registration_id,au.email,au.first_name
                  FROM `nfw_product_cart` as pc join auth_user as au on pc.user_id = au.id
                  where pc.id = $product_cart_id";

        $final_data = resultAssociate($query);
        $file_name = $final_data[0]['customization_id'];
        $data = $final_data[0]['customization_data'];
        $shirtSummary = phpjsonstyle($data, 'php');

        $mes1 = $final_data[0]['measurement_data'];
        $measurmentProfile = phpjsonstyle($mes1, 'php');

        $clientcode = $final_data[0]['registration_id'];
        $clientemail = $final_data[0]['email'];

        $pos1 = $final_data[0]['posture_data'];
        $posture = phpjsonstyle($pos1, 'php');

        $image_data = $final_data[0]['user_images'];
        $image_data = trim($image_data, "[");
        $image_data = trim($image_data, "]");
        $image_data = explode(",", $image_data);



        include '../phpPlugin/mailer/class.phpmailer.php';
        $email = array($clientemail); //'imteyaz_bari@yahoo.com ';
        #mail sending common file
        include '../producthandler/mailAndMessageHandler.php';
        #############################
        $description .= '<html>
            <div style="width:100%;margin-top: 1%;">
            <div style="width: 100%;border:1px;text-align: center;background:black;margin-bottom: 10px;font-size: 20px;color: white;"> Style Profile Id : ' . $file_name . '</div>
                        <div style="width:100%;text-align: center;background:black;margin-bottom: 10px;font-size: 20px;color: white;">' . $tag_name . ' Style Summary</div>
                           <div style="width:97%;min-height: 200px;background-color:white;border-color:black;border: 1px solid;padding: 8px;font-size: 14px;font-weight: 500;">
                             <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;">';

        foreach ($shirtSummary as $key => $value) {
            $description .= '<tr><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;width:49%">' . $key . '</td><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $value . '</td></tr>';
        }

        $description .= '</table>
                           </div>
                        </div>
                       </div>
             <div style="text-align: center;width:100%;background:black;margin-top:1%;font-size: 20px;color: white;">' . $tag_name . ' Measurement Summary</div>    

           <div style="margin-top:10px;width: 99%;min-height: 200px;background-color:white;border-color:black;border: 1px solid;padding: 8px;font-size: 14px;font-weight: 500;">
                 <table style="border: 1px solid #e4e4e4; border-collapse: collapse;width:100%">';

        foreach ($measurmentProfile as $key => $value) {
            $description .= '<tr><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;width:49%">' . ucwords(str_replace("_", " ", $key)) . '</td><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $value . '</td></tr>';
        }
 
        $description .= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white;text-align:center;' colspan=2>Your Posture</td></tr>";
        foreach ($posture as $key => $value) {
            $key1 = $key;
            $query = "SELECT set_image as image FROM nfw_custom_element_field as ncef
               join nfw_custom_element as nce on nce.id = ncef.nfw_custom_element_id 
               where nce.title = '$key' and ncef.child_label = '$value'";
            $imgobj = end(resultAssociate($query));
            $img = $imgobj['image'];


            $description.= '<tr style="border: 1px solid #e4e4e4; border-collapse: collapse;"><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $key1 . '</td><td style="width:45%; border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;"><span style="margin-left: 13px">' . $value . "</span><br><img src='" . $img . "' style='height: 100px;width:80px'></td></tr>";
        }

        $description .= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white;text-align:center;' colspan=2>Your Images</td></tr>";
        $timg = '';

        //echo $imageserver;
        foreach ($image_data as $key1 => $value1) {
            $timg .= "<img style='height:300px;width:300px;float:left;margin:10px' src='" . $imageserver . "/medium/" . trim($value1, '"') . "' >";
        }
        $description.= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;' colspan=2>" . $timg . "</td></tr>";
        $description .= '</table>
                           </div>

                         </html>';
        //echo $description;
        $mail->Subject = 'Your Style Detail'; //Subject od your mail
        $data = $mail->MsgHTML($description); //Put your body of the message you can place html code here
//        $url = 'file:///home/atharva/Downloads/Order.pdf';
//        $mail->AddAttachment($url); //Attach a file here if any or comment this line, 
//        $mail->AddAttachment('http://192.168.3.47/nf3/nitaFashionAdmin/index.php/ProductHandler/generate_product_pdf/12/2/2/3/three%20hundred%20sixty%20five');
        $send = $mail->Send(); //Send the mails
    }

}

function new_registration($username) {
    $regmail = '
         <p style="text-align: center;"><img src="http://nf1.costcokart.com/NF_V4/nf3/frontend/assets/images/logo/nf_logo_8.png" style="width: 141.0625px; height: 77.0437173344948px;"><span style="line-height: 1.2;"><br></span></p>
<p style="text-align: center;"><span style="line-height: 1.2; font-size: 24px;">Hello &nbsp;$username</span><br></p>
<p style="text-align: center;"><span style="line-height: 25.2000007629395px; font-size: 24px;">&nbsp; Welcome to Nita Fashions</span></p>
<p style="text-align: center;"><span style="line-height: 25.2000007629395px; font-size: 24px;">Thanks to Joining us</span></p>
<p style="text-align: center;"><a href="http://nf1.costcokart.com/NF_V4/nf3/frontend/views/index.php" target="_blank" style="line-height: 1.2; font-size: 14px; padding: 10px; color: rgb(247, 247, 247); background-color: rgb(0, 0, 0);">Start Shopping Now</a><br></p>
<div style="text-align: center;"><br></div>
<div style="text-align: center;"><span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 24px; text-align: start; background-color: rgb(255, 255, 255);">&nbsp;' . "The world's" . ' fabrics are careful selected to live up to name of Nita Fashions. We carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</span></div>
<div style="text-align: center;"><span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 24px; text-align: left; background-color: rgb(255, 255, 255);">Since 1953, our label has been one of the most respected names in ' . "men's" . ' clothing, identified with superior fabrics. Nita Fashions carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.</span><span style="font-family: Lato, sans-serif; font-size: 16px; line-height: 24px; text-align: start; background-color: rgb(255, 255, 255);"><br></span></div>
<p></p>';
}

if (isset($_REQUEST['cart_id'])) {
    ob_end_clean();
    $product_cart_id = $_REQUEST['cart_id'];
    $obj = new MailAndMessageHandler();
    $obj->mail_sending_information($product_cart_id, $_REQUEST['tag_name']);
    header('location:' . $_SERVER['HTTP_REFERER']);
}
?>