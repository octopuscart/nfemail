<?php 
	
	// your email
	$user_email = "";

	$mail = array(
		"name" => htmlspecialchars($_POST['cf_name']),
		"email" => htmlspecialchars($_POST['cf_email']),
		"subject" => htmlspecialchars($_POST['cf_subject']),
		"message" => htmlspecialchars($_POST['cf_message']),
		"anti_spam" => (int) htmlspecialchars($_POST['cf_anti_spam']),
		"captcha" => $_POST['g-recaptcha-response']
	);
        print_r($email);
	
	function validate($arr,$c){
		if($c === "true"){
			return !empty($arr['name']) && strlen($arr['message']) > 20 && filter_var($arr['email'],FILTER_VALIDATE_EMAIL) && $arr['captcha'] != '';
		}else{
			return !empty($arr['name']) && strlen($arr['message']) > 20 && filter_var($arr['email'],FILTER_VALIDATE_EMAIL);
		}

	}

	if(validate($mail,$mail['captcha'])){

		echo mail($user_email, $mail['subject'], 
			"Name : {$mail['name']}\n" 
			."E-mail : {$mail['email']}\n"
			."Message : {$mail['message']}" 
		);

	}


?>