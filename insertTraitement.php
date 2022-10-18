<?php

//debug
// var_dump ($_POST);
// var_dump ($_FILES);

// gestion de l'image
$uploads = "./img";
$idUnique = uniqid().date("Y-m-d-H-i-s");
$nomFichier = $idUnique.basename($_FILES['image']['name']);

if(!move_uploaded_file($_FILES['image']['tmp_name'], $uploads. "/" .$nomFichier)){
        throw new Exception("Problème d'upload");
}

// 1. Créer une connexion à la BD
include "./connexion/db.php";

try {
        $cnx = new PDO(DBDRIVER . ':host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME . ';charset=' . DBCHARSET, DBUSER, DBPASS);
} 
catch (Exception $e) {
        // jamais en production car ça montre des infos
        // sensibles
        echo $e->getMessage();

        // il faut arreter le script quand on a attrapé une exception
        die();
}

var_dump ($_POST);

$sql = "INSERT INTO film (id, titre, duree, description, dateSortie, image) VALUES (NULL, :titre, :duree, :description, :dateSortie, :image)"; //placeholder pour éviter de devoir concaténer

// on fait ca pour éviter l'injection de SQL séparée par des ;
// exemple: 'rocky');DROP TABLE film
// $_POST['title'], $_POST['duration'], $_POST['description'], $_POST['dateSortie'], '')";

// $stmt->bindParam (":titre, $_POST(['title']"); pour envoyer les valeurs une par une

// il faut pour etre propre: controler la session d'utilisation et au niveau du serveur car tout ce qui est html et javascript est hackable

$stmt = $cnx->prepare($sql); //prépare la syntaxe de la requête telle quelle au serveur

//bindParam envoi les valeurs par référence donc il est possible même de la changer
//donc c'est mieux d'utiliser bondValue qui passe par valeurs et pas par référence ! 
//$titre = $_POST['titre']; //Terminator
//$stmt->bindParam (":titre", $titre); ! n'accepte en 2e parametres qu'une variable on ne peut pas passer juste une valeurs de type "Maya" par exemple, il faut que ca soit relié à une variable
//$titre="Toto";
//$stmt->execute(); // recoit Toto !

// si on a bcp de values on peut faire une boucle pour insérer
$stmt->bindValue (":titre", $_POST['title']); 
$stmt->bindValue (":duree", $_POST['duration'], PDO::PARAM_INT); // ajout d'un parametre pour intégrer le type
$stmt->bindValue (":description", $_POST['description']);
$stmt->bindValue (":dateSortie", $_POST['dateSortie']);
$stmt->bindValue (":image", $nomFichier);

$stmt->execute();
// var_dump($stmt->errorInfo()); //array pour afficher les erreurs

// redirige vers la liste de films après une insertion
header("location: ./index.php?p=listeFilms")

?>