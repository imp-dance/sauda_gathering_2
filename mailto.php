<?php
if(isset($_POST)){
$melding = isset($_POST['melding']) ? $_POST['melding'] : '';
$melding = strip_tags($melding);
$emne = isset($_POST['emne']) ? "SG-Kontakt angående: ".$_POST['emne'] : '';
$emne = strip_tags($emne);
$fra = isset($_POST['email']) ? $_POST['email'] : '';
$til = 'sgnettcrew@gmail.com';

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$melding = wordwrap($melding, 70, "\r\n");

$headers = 'From:' .$fra."\r\n" .
    'Reply-To:' .$fra. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($til, $emne, $melding, $headers);
}

if(mail($til, $emne, $melding, $headers)) {
	die('<meta http-equiv="refresh" content="0; url=index.php?mailsent=true">');
}

else {
	die("Faen du gjer her då????");
}
?>