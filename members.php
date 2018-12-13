<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php

if (!empty($_POST)) {
require_once 'bdd/db.php';
$errors = array();
$extension = strrchr($_FILES['curriculum_vitae']['name'], '.');

if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email invalide";
}

if(empty($_POST['nom']) AND empty($_POST['prenom']) AND empty($_POST['email']) AND empty($_POST['annee_promo']) AND empty($_POST['curriculum_vitae'])) {
        
    $errors['email'] = "Veuillez remplir tout les champs";
    
}

else {
    $req = $pdo->prepare('SELECT email FROM stagiaires WHERE email = ?');
    $req->execute([$_POST['email']]);
    $user =$req->fetch();
    if($user) {
        $errors['email'] = 'Cet email est déjà utilisé';
    }
}

if(isset($_POST['nom'], $_POST['prenom'], $_FILES['curriculum_vitae']) AND empty($errors)) {
    
    $dossier = 'images/';
    $fichier = basename($_FILES['curriculum_vitae']['name']);
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['annee_promo']) AND move_uploaded_file($_FILES['curriculum_vitae']['tmp_name'], $dossier . $fichier)) {
        $req = $pdo->prepare('INSERT INTO stagiaires SET nom = ?, prenom = ?, email = ?, annee_promo = ?, curriculum_vitae = ?');
        $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['annee_promo'], $dossier . $fichier]);
         
        }
    }
}

?>


<body>

<h1 class="">Ajouter un nouveau stagiaire</h1>

<?php if(!empty($errors)): ?>
<div class="alert-danger">
    <ul>
    <?php foreach($errors as $error): ?>
        <li><?= $error; ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom</label><br>
        <input type="text" name="nom"><br>

        <label for="prenom">Prénom</label><br>
        <input type="text" name="prenom"><br>

        <label for="email">Email</label><br>
        <input type="text" name="email"><br>

        <label for="annee_promo">Année</label><br>
        <input type="date" name="annee_promo" required><br>

        <label for="curriculum_vitae">CV</label><br>
        <input type="file" name="curriculum_vitae" required><br>

        <button type="submit" class="enregistrer">Enregistrer</button>
    </form>

</body>
</html>