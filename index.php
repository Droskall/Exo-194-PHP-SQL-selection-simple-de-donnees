<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo_194</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */

try {
    $server = 'localhost';
    $db = 'exo_194';
    $user = 'root';
    $pass = '';

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user,$pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $bdd->prepare("SELECT * FROM user");

    if ($stmt->execute()){
        foreach ($stmt->fetchAll() as $user){
            echo "<div class='classe-css-utilisateur'>" .$user['nom']. " " .$user['prenom']. " " .$user['rue']. " "
                .$user['numero']. " " .$user['code_postal']. " " .$user['ville']. " " .$user['pays']. " " .$user['mail'] . "</div>";
        }
    }

    echo "<br>";

    echo "Ordre Croisant";

    $stmt = $bdd->prepare("SELECT * FROM user ORDER BY id DESC ");

    if ($stmt->execute()){
        foreach ($stmt->fetchAll() as $user){
            echo  "<div class='classe-css-utilisateur'>" .$user['nom']. " " .$user['prenom']. " " .$user['rue']. " "
                .$user['numero']. " " .$user['code_postal']. " " .$user['ville']. " " .$user['pays']. " " .$user['mail'] ."</div>";
        }
    }

    echo "<br>";

    echo "Nom Prenom";

    $stmt = $bdd->prepare("SELECT nom, prenom FROM user");

    if ($stmt->execute()){
        foreach ($stmt->fetchAll() as $user){
            echo "<div class='classe-css-utilisateur'>" .$user['nom']. " " .$user['prenom']. "</div>";
        }
    }
    else{
        echo "Erreur";
    }
}
catch (PDOException $exception){
    echo $exception->getMessage();
}

?>

</body>
</html>