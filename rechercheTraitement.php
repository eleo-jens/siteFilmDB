<?php

// include "./connexion/connexion.php"

// $title = $_POST['title'];
// var_dump($title);

// un array asssociatif pour renvoyer au client avec le résultat et les possibles erreurs
// tous les deux sous la forme d'un array
$arr = ['data' => [],
        'error' => []]; // erreurs va être une liste de string

include "./connexion/db.php";

try {
        $cnx = new PDO(DBDRIVER . ':host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME . ';charset=' . DBCHARSET, DBUSER, DBPASS);
} catch (Exception $e) {
        $arr['error'][] = "Erreur de connexion";
        die();
}

$title = "%" . $_POST['title'] . "%";
$sql = "SELECT * FROM film WHERE titre LIKE :title";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":title", $title);
$stmt->execute();

$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($arrayRes);
$arr['data'] = $arrayRes;

echo json_encode($arr);
