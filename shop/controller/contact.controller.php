<?php

require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailerAutoload.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/PHPMailer.php";
require "../emailcontent/contactus.content.php";

$sender_ip = $_SERVER["REMOTE_ADDR"];

$customer_name = $_POST["customer_name"];
$customer_number = $_POST["customer_number"];
$customer_email = $_POST["customer_email"];
$customer_message = $_POST["customer_message"];

$mailTemplate = new mailTemplate();
$emailBody= $mailTemplate->emailMessage($customer_name, $customer_number, $customer_email, $customer_message, $sender_ip);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 3;
$mail->Debugoutput = 'html';
$mail->Host = "ssl://smtp.gmail.com";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "cpascual107@gmail.com";
$mail->Password = "123Pascual123";
$mail->setFrom('cpascual107@gmail.com', 'no-reply');
$mail->addAddress('itchaaanp@gmail.com', 'PMC');
$mail->Subject = "Customer Inqury";
$mail->Body = $emailBody;
$mail->isHTML(true);

//send the message, check for errors
if (!$mail->send()) {
    // echo "Opps, something wrong! Please try again!";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Successfully sent!";
}
