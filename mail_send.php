<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php 

require_once 'bdd/db.php';

$req = $pdo->query('SELECT * FROM form_mail LIMIT 30');
echo "Résultat : " . $req->rowCount() . "<br>";

?>

<table border="1">
    <tr>
        <th>Mail</th>
        <th>Sujet</th>
        <th>Message</th>
        <th>Supprimer</th>
    </tr>


<?php 

while ($mail = $req->fetch()) {
        echo "<tr>";
        echo "<td>" . "$mail->mail_envoyeur" . "</td>";  
        echo "<td>" . "$mail->mail_sujet" . "</td>";
        echo "<td>" . "$mail->mail_message" . "</td>";
        echo "<td>" . "<a href='delete.php?id=$mail->id'>" . "<i class='far fa-trash-alt'>" . "</i>" . "</a>" . "</td>";
        echo "</tr>";
}

?>

</body>
</html>