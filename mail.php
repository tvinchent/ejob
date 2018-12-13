<?php
	if (isset($_POST['envoie'])) {
		if (!isset($_POST['subject']) || $_POST['subject']=='') {
			echo('Vous avez oublié d\'ins&eacute;rer un message<br>');
		}
		else{
			// assignation de la varaiable mail si aucune adresse mail renseignée
			if (!isset($_POST['email']) || $_POST['email']=='') {
				$_POST['email']='';
			}

			$message = 'Vous avez recu un message via votre site internet, le voici:<br>'.$_POST['subject'];

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= 'From: '.$_POST['email']."\r\n".'Reply-To: '.$_POST['email']."\r\n".'X-Mailer: PHP/' . phpversion();
			
			mail('unicornsoftroie@gmail.com', 'Formulaire de contact Exmachina', $message, $headers);

			// confirmation
			echo('Votre message a &eacute;t&eacute; envoy&eacute;<br>');
		}
	}


?>