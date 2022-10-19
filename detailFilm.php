<?php

include "./connexion/connexion.php";

$id = $_GET['id'];

$sql = "SELECT * FROM film
        WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

foreach ($res as $cle => $val) {
    echo $cle . " : " .$val . "<br>";
}
?>