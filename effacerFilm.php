<?php

include "./connexion/connexion.php";

// il faut effacer par l'id
$id = $_GET['id']; // param dans l'url
$sql = "DELETE FROM film WHERE :id = id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":id",$id,PDO::PARAM_INT); //la requete ne sera pas lancée si ce n'est pas un int
$stmt->execute();

// var_dump ($stmt->errorInfo());

// une fois qu'on sait que la page fonctionne
header ('location: ./index.php?p=listeFilms');