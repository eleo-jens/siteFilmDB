<?php

include "./connexion/connexion.php";

$id = $_GET['id'];
$sql = "SELECT * FROM film WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$arrayRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($arrayRes);

echo "<form method='POST' action='./modifierTraitement.php'>";
echo "<label for='id'>Id: </label>". $id. "<input type='number' name='id' id='id' value='" .$id. "' hidden><br>";
echo "<label for='title'>Titre: </label><input type='text' name='title' id='title' value='". $arrayRes[0]['titre'] ."'><br>";
echo "<label for='duration'>Durée: </label><input type='number' name='duration' id='duration' value='". $arrayRes[0]['duree'] ."'><br>";
echo "<label for='description'>Description: </label><textarea name='description' id='description' cols='30' row='10'>". $arrayRes[0]['description'] ."</textarea><br>";
echo "<label for='dateSortie'>Date de sortie: </label><input type='date' name='dateSortie' id='dateSortie' value='". $arrayRes[0]['dateSortie']. "'><br>";
echo "<button type='submit'>Modifier le film</button>";
echo "</form>";

