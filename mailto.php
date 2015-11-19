<?php
if(isset($_POST)){
$melding = $_POST['melding'];
$melding = strip_tags($melding);
$emne = "SG-Kontakt".$_POST['emne'];
$emne = strip_tags($emne);
$fra = $_POST['email'];
$til = 'sgnettcrew@gmail.com';

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$melding = wordwrap($melding, 70, "\r\n");

$headers = 'From: $fra' . "\r\n" .
    'Reply-To: $fra' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($til, $emne, $melding, $headers);
}else{
	die("faen du gjer her då????");
}
?>