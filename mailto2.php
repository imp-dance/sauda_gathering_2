<?php
$melding = isset($_POST['melding']) ? $_POST['melding'] : '';
$melding = strip_tags($melding);
$emne = isset($_POST['emne']) ? "SG-Kontakt angående: ".$_POST['emne'] : '';
$emne = strip_tags($emne);
$sender = isset($_POST['sender']) ? $_POST['sender'] : '';
$sender = strip_tags($sender);
$senderemail = isset($_POST['email']) ? $_POST['email'] : '';
$senderemail = strip_tags($senderemail);

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Europe/Berlin');
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mailer = new PHPMailer(true);
$mailer->IsSMTP();
$mailer->SMTPSecure = 'ssl';
$mailer->Host = 'smtp.gmail.com';
$mailer->Port = 465;
$mailer->SMTPAuth = true;
$mailer->Username = 'sgnettcrew@gmail.com';
$mailer->Password = 'sg329sg81SG';
$mailer->SetFrom('Morten.hauge97@gmail.com', 'Morten Hauge'); 
$mailer->AddAddress('sgnettcrew@gmail.com'); 
$mailer->Subject = 'This is a test';
$mailer->Body = 'Test body';
$mailer->Send();

if (!$mailer->send()) {
    echo "Mailer Error: " . $mailer->ErrorInfo;
} else {
    echo "Message sent!";
}