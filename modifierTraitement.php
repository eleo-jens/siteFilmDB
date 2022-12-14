<?php

include "./connexion/connexion.php";

$sql = "UPDATE film SET titre = :titre, duree = :duree, description = :description, dateSortie= :dateSortie WHERE film.id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":id", $_POST['id'], PDO::PARAM_INT);
$stmt->bindValue(":titre", $_POST['title']);
$stmt->bindValue(":duree", $_POST['duration'], PDO::PARAM_INT);
$stmt->bindValue(":description", $_POST['description']);
$stmt->bindValue("dateSortie", $_POST['dateSortie']);

$stmt->execute();
// var_dump($stmt->errorInfo());

header('location: ./index.php?p=listeFilms');