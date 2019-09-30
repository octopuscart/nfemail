<?php 
 $welcomemsg = '
<p style="text-align: center;"><img src="http://nf1.costcokart.com/NF_V4/nf3/frontend/assets/images/logo/nf_logo_8.png" style="width: 141.0625px; height: 77.0437173344948px;"><span style="line-height: 1.2;"><br></span></p> <p style="text-align: center; "><span style="font-size: 24px;font-weight: bold;">YOUR ORDER HAS BEEN CANCELLED </span></p>
<p style="text-align: left;"><span style="font-size: 14px;">Hello &nbsp;' . ucwords($userInfo[0]['first_name'].' '.$userInfo[0]['last_name']) . ',</span></p>
<p style="line-height: 1;"><span style="font-size: 14px;">Here are the details of your cancelled order.</span></p>
<p><span style="font-size: 14px; line-height: 1.2;font-weight: bold;">Order Information &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>
<p style="line-height: 1;">
<span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12px; line-height: normal">Order No.:&nbsp;' . $data[0]['order_no'] .'<span></p>
<p style="line-height: 1;">
<span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12px; line-height: normal">Items Ordered:&nbsp;' . $data[0]['total_quantity'] . '</span></p>
<p style="line-height: 1;">
<span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12px; line-height: normal">Total Price: &nbsp;' .$data[0]['total_price'] .'</span></p>';

 include '../phpPlugin/mailer/class.phpmailer.php'; 
    
    $email = array($userInfo[0]['email']); //'imteyaz_bari@yahoo.com ';

    $mail = new PHPMailer; // call the class  
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = "sayedhk123@gmail.com"; //Username for SMTP authentication any valid email created in your domain
    $mail->Password = "libglmetfakmwjyq"; //Password for SMTP authentication
    $mail->AddReplyTo("sayedhk123@gmail.com", "Reply name"); //reply-to address
    $mail->SetFrom("sayedhk123@gmail.com", "Nita Fashions Orders"); //From address of the mail
    // put your while loop here like below,
    $mail->Subject = 'Order'.'  '.$data[0]['order_no'].' '.'Cancellation'; //Subject od your mail
    foreach ($email as $to_add) {
        $mail->AddAddress($to_add, "test send");              // name is optional
    }

    $mail->MsgHTML($welcomemsg); //Put your body of the message you can place html code here
    $send = $mail->Send(); //Send the mails
   // header('location:' . $_SERVER['HTTP_REFERER']);


?>