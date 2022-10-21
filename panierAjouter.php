<?php
session_start();

$res = [];

if (!empty($_POST)) {
    $idFilm = $_POST['idFilm'];
    $prix = $_POST['prixFilm'];
    $titre = $_POST['titreFilm'];
    $quantite = (int) $_POST['quantite'];
    if ($quantite < 0) {
        $quantite = - ($quantite);
    }

    // si le panier n'existe pas déjà dans la session on le crée
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    if (!isset($_SESSION['panier'][$idFilm])) {
        //le produit n'existe pas on le remplit
        $_SESSION['panier'][$idFilm] = [
            'nom' => $titre,
            'quantite' => $quantite,
            'prixUnitaire' => $prix
        ];
    } else {
        // incrementer la quantite
        $_SESSION['panier'][$idFilm]['quantite'] += $quantite;
    }
}
$res = $_SESSION['panier'];
echo json_encode($res);
