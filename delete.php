<?php
require 'bdd/db.php';
$req = $pdo->prepare("DELETE FROM form_mail WHERE id = ?");
$req->execute([$_GET['id']]);
header('Location: mail_send.php');

?>