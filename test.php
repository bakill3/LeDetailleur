<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require 'phpmailer/vendor/autoload.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Mailer = "smtp";

$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
$mail->SMTPAuth = true;
//to view proper logging details for success and error messages
$mail->SMTPDebug = 1;
$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
$mail->Username = 'lifepageshop123@gmail.com';   //email
$mail->Password = 'slpgvdadjxgvnmup' ;   //16 character obtained from app password created
$mail->Port = 465;                    //SMTP port
$mail->SMTPSecure = "ssl";

//sender information
$mail->setFrom('lifepageshop123@gmail.com', 'Le Detaiuller');

//receiver email address and name
$mail->addAddress('deostulti2@gmail.com', 'Gabriel Brandão'); 

// Add cc or bcc   
// $mail->addCC('email@mail.com');  
// $mail->addBCC('user@mail.com');  


$mail->isHTML(true);

$mail->Subject = 'PHPMailer SMTP test';
$mail->Body    = "<h4> PHPMailer the awesome Package </h4>
<b>PHPMailer is working fine for sending mail</b>
<p> This is a tutorial to guide you on PHPMailer integration</p>";

// Send mail   
if (!$mail->send()) {
	echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
} else {
	echo 'Message has been sent.';
}

$mail->smtpClose();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rizalcss@2.0.9/css/cdn.rizal.css" integrity="sha256-0vFAs0ft9ykF6DOLV4g0iRVz5hJ+V7HvY5fZapVeUD0=" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script defer src="https://kit.fontawesome.com/1e8d61f212.js"></script>
</head>
<body>
	
</body>
</html>