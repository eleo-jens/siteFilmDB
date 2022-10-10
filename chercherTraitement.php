<?php

// 1. Créer une connexion à la BD: on pourrait factoriser le code et mettre cette partie ailleurs
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

// var_dump($_POST);

$title = "%" . $_POST['title'] . "%";
$sql = "SELECT * FROM film WHERE titre LIKE :title";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":title", $title);
$stmt->execute();

// var_dump($stmt->errorInfo());

$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($arrayRes);

if (count($arrayRes) > 0){
        foreach ($arrayRes as $film){
                echo "<br>";
                foreach ($film as $cle => $val) {
                        echo $cle . " : " .$val . "<br>";
                }
        }
}
else {
        echo "<h5>On n'a pas trouvé de films</h5>";
}
