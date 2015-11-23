<?php
$melding = isset($_POST['melding']) ? $_POST['melding'] : '';
$melding = strip_tags($melding);
$emne = isset($_POST['emne']) ? $_POST['emne'] : '';
$emne = strip_tags($emne);
$sender = isset($_POST['sender']) ? $_POST['sender'] : '';
$sender = strip_tags($sender);
$senderemail = isset($_POST['email']) ? $_POST['email'] : '';
$senderemail = strip_tags($senderemail);

date_default_timezone_set('Europe/Berlin');
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "sgnettcrew@gmail.com";
$mail->Password = "sg329sg81SG";
$mail->SetFrom($senderemail);
$mail->Subject = $emne;
$mail->Body = $melding;
$mail->AddAddress("sgnettcrew@gmail.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    die('<meta http-equiv="refresh" content="0; url=index.php?mailsent=true">');
    }
    ?>