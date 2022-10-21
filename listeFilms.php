<?php
// Change le système mettre une div avec une icone de panier et le nombre total d'article qui change avec AJAX
// Créer une autre page panier qui affiche le détail du panier
// Div du panier
echo '<div id="wrapper">';
echo '<h3>Votre panier</h3>';
echo '<div id="panier">';
if (isset ($_SESSION['panier'])){
       var_dump($_SESSION['panier']);
}
echo '</div>';
echo '<button id="vide">Vider le panier</button>';
echo '</div>';


// 1. Créer une connexion à la BD
include "./connexion/connexion.php";

// 2. Créer une requête SQL
// Requete pour montrer les films likés par n'importe qui
// $sql = "SELECT DISTINCT film.id, titre, description, duree, dateSortie, image, favori.idFilm as idFilmFavori FROM film LEFT JOIN favori ON id.film = favori.idFilm";

$sql = "SELECT film.id AS id, film.titre, film.image, film.prix, favori.idFilm as idFilmFavori 
        FROM film LEFT JOIN favori ON film.id = favori.idFilm
        AND favori.idUser = 
        (SELECT user.id FROM user where login = :login)";

// 3. Lancer la requête (préparation et lancement)
$stmt = $cnx->prepare($sql); //methode de la class PDO
$stmt->bindValue(":login", $_SESSION['loginConnecte']);
$stmt->execute();

// 4. Obtenir les données dans un array 
$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($arrayRes);

// 5. Afficher les données selon nos besoins
// faire une fonction afficherCard();
foreach ($arrayRes as $film) {
       echo '<div class="card" style="width: 13rem;">';
       echo '<a href="./index.php?p=detailFilm&id='. $film['id'] .'"><img class="card-img-top" src="./img/'. $film['image'] .'" alt="' . $film['titre']. '"></a>';
       echo '<div class="card-body">';
       echo '<h5 class="card-title">'. $film['titre'] .'</h5>';
       echo '</div>';
       echo '</div>';
       if (!is_null($film['idFilmFavori'])){
              echo "<p class='coeur' data-id ='" .$film['id']. "'>&#10084;</p>";
       }
       else {
              echo "<p class='coeur' data-id ='" .$film['id']. "'>&#10085;</p>";
       }
       echo '<p>Quantité<input data-id="'. $film['id'] .'" type="number" min="0"><button class="ajouter" data-id="' .$film['id']. '" data-titre="' .$film['titre']. '" data-prix="' .$film['prix']. '">Ajouter</button></p>';
       if ($_SESSION['role'] == "admin"){
              echo "<a href ='./index.php?p=modifierFilm&id=" . $film['id']. "'>Modifier</a><br>";
              echo "<a href ='./effacerFilm.php?id=" . $film['id']. "'>Effacer</a>";
       }
}
echo '<script src="./script/main.js" type="text/javascript"></script>';
echo '<script src="./script/panier.js" type="text/javascript"></script>';