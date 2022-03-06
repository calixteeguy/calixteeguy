<?php
$siteOwnersEmail = 'calixteguy@gmail.com';

if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

	if (strlen($name) < 2) {
		$error['name'] = "Renseignez votre nom s'il vous plait.";
	}
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Renseignez une adresse mail valide s'il vous plait.";
	}
	if (strlen($contact_message) < 15) {
		$error['message'] = "Votre message doit disposer d'au moins 15 caractères pour être envoyé.";
	}
	if ($subject == '') { $subject = "Formulaire de contact"; }

	$message .= "Email from: " . $name . "<br />";
	$message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> Ce mail vous a été envoyé depuis votre site ''Au comptoir flamand''";
   $from =  $name . " <" . $email . ">";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail);
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Une erreur est subvenue, merci de réessayer plus tard."; }
		
	}

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	}

}

?>