<?php

// 1. Créer une connexion à la BD
include "./connexion/connexion.php";

// 2. Créer une requête SQL
// Requete pour montrer les films likés par n'importe qui
// $sql = "SELECT DISTINCT film.id, titre, description, duree, dateSortie, image, favori.idFilm as idFilmFavori FROM film LEFT JOIN favori ON id.film = favori.idFilm";

$sql = "SELECT film.id, titre, description, duree, dateSortie, image, favori.idFilm as idFilmFavori 
        FROM film LEFT JOIN favori ON film.id = favori.idFilm
        INNER JOIN user ON user.id ";

// 3. Lancer la requête (préparation et lancement)
$stmt = $cnx->prepare($sql); //methode de la class PDO
$stmt->execute();

// 4. Obtenir les données dans un array 
$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($arrayRes);

// 5. Afficher les données selon nos besoins
// faire une fonction afficherCard();
foreach ($arrayRes as $film) {
       echo '<div class="card" style="width: 13rem;">';
       echo '<a href="./index.php?p=detailFilm&id='. $film['id'] .'"><img class="card-img-top" src="./img/'. $film['image'] .'" alt="' . $film['titre']. '"></a>';
       echo '<div class="card-body">';
       echo '<h5 class="card-title">'. $film['titre'] .'</h5>';
       echo '</div>';
       echo '</div>';
       echo "<p class='coeur' data-id ='" .$film['id']. "'>&#10084;</p>";
       echo '<p>Quantité<input data-id="'. $film['id'] .'" type="number"><button class="ajouter" data-id="' .$film['id']. '">Ajouter</button></p>';
       if (!is_null($film['idFilmFavori'])){
       }
       else {
              echo "<p class='coeur' data-id ='" .$film['id']. "'>&#10085;</p>";
       }
       if ($_SESSION['role'] == "admin"){
              echo "<a href ='./index.php?p=modifierFilm&id=" . $film['id']. "'>Modifier</a><br>";
              echo "<a href ='./effacerFilm.php?id=" . $film['id']. "'>Effacer</a>";
       }
}
echo '<script src="./script/main.js" type="text/javascript"></script>';
echo '<script src="./script/panier.js" type="text/javascript"></script>';