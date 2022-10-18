<?php

// 1. Créer une connexion à la BD
include "./connexion/db.php";

try {
        $cnx = new PDO(DBDRIVER . ':host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME . ';charset=' . DBCHARSET, DBUSER, DBPASS);
} catch (Exception $e) {
        // jamais en production car ça montre des infos
        // sensibles
        echo $e->getMessage();

        // il faut arreter le script quand on a attrapé une exception
        die();
}
// 2. Créer une requête SQL
$sql = "SELECT * FROM film";

// 3. Lancer la requête (préparation et lancement)
$stmt = $cnx->prepare($sql); //methode de la class PDO
$stmt->execute();

// 4. Obtenir les données dans un array 
$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump ($arrayRes);

// 5. Afficher los données selon nos besoins
// faire une fonction afficherCard();
foreach ($arrayRes as $film) {
       echo '<div class="card" style="width: 13rem;">';
       echo '<a href="./detailFilm.php?id='. $film['id'] .'"><img class="card-img-top" src="./img/'. $film['image'] .'" alt="' . $film['titre']. '"></a>';
       echo '<div class="card-body">';
       echo '<h5 class="card-title">'. $film['titre'] .'</h5>';
       echo '</div>';
       echo '</div>';
       echo "<a href ='./index.php?p=modifierFilm&id=" . $film['id']. "'>Modifier</a><br>";
       echo "<a href ='./effacerFilm.php?id=" . $film['id']. "'>Effacer</a><br>";
}