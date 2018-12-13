<?php

	if (!empty($_POST)) {
        $errors = array();

		if (empty($_POST['subject'])) {
			$errors['subject'] = "Vous avez oublié d\'ins&eacute;rer un message<br>";
        }
        if (empty($_POST['email'])) {
			$errors['email'] = "Vous avez oublié d\'ins&eacute;rer un email<br>";
        }
        if (empty($_POST['request'])) {
			$errors['request'] = "Vous avez oublié d\'ins&eacute;rer un sujet<br>";
        }
        
        if(isset($_POST['subject'], $_POST['email'], $_POST['request']) AND empty($errors)) {

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

<?php if(!empty($errors)): ?>

<div>
    <ul>
        <?php foreach($errors as $error): ?>
        <li><?= $error; ?></li>
<?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>