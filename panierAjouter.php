<?php
session_start();

// si le panier n'existe pas déjà dans la session on le crée
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// si on recoit le formulaire du client js, cad si on update le panier via un click "Ajouter"
if (!empty($_POST)) {

    $idFilm = $_POST['idFilm'];
    $prix = $_POST['prixFilm'];
    $titre = $_POST['titreFilm'];
    $quantite = (int) $_POST['quantite'];
    if ($quantite < 0) {
        $quantite = - ($quantite);
    }

    if (!isset($_SESSION['panier'][$idFilm])) {
        //le produit n'existe pas on le remplit
        $_SESSION['panier'][$idFilm] = [
            'nom' => $titre,
            'quantite' => $quantite,
            'prixUnitaire' => $prix
        ];
    } else {
        // incrementer la quantité
        $_SESSION['panier'][$idFilm]['quantite'] += $quantite;
    }
}
//renvoyer le panier de la session (rafraichissement de la page ou ajout d'un produit)
echo json_encode($_SESSION['panier']);