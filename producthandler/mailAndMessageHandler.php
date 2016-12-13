<?php
$authobj = new AuthHandler();
$mailconf = $authobj->mail_configuration();
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
$mail->AddCC($mailconf['mail_sender']);
$mail->AddBCC($mailconf['username']);           
// put your while loop here like below,
//$mail->Host = 'smtp.mail.yahoo.com';
//$mail->Port = 465;
//$mail->Username = "tailor123hk@yahoo.com"; //Username for SMTP authentication any valid email created in your domain
//#newpass = libglmetfakmwjyq
//$mail->Password = "yahoo@123"; //Password for SMTP authentication
//$mail->AddReplyTo("tailor123hk@yahoo.com", "Reply name"); //reply-to address]
//$mail->SetFrom("tailor123hk@yahoo.com", "TNT MAIL"); //From address of the mail
$mail->Subject = 'Your Style Detail'; //Subject od your mail
foreach ($email as $to_add) {
    $mail->AddAddress($to_add);              // name is optional
}
?>