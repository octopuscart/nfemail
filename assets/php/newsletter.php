<?php
	
/* Email Address */	
$to = '';

/* Subject */
$subject = 'Illusion Subscribe Form';

/* Headers */
// $headers = 'From: Illusion' . "\r\n" .
//     'Reply-To: illusion@illusion.com' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

$email = $_POST['subscribe_email'];

if(isset($email) && !empty($email)){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$message = 'Email: '.$email;
		echo mail($to, $subject, $message);
	}else{
		echo 2;
	}
	
}

?>