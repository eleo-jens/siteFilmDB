<?php
session_start();

echo "hola";
var_dump($_POST);

$idFilm = $_POST['idFilm'];
$quantite = $_POST['quantite'];

// si le panier n'existe pas déjà dans la session on le crée
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = [];
}

if (!isset($_SESSION['panier'][$idFilm])){
    //le produit n'existe pas on le remplit
    $_SESSION['panier'][$idFilm] = $quantite;
}
else {
    // incrementer la quantite
    $_SESSION['panier'][$idFilm] += $quantite;
}

var_dump($_SESSION);