<?php
session_start();

include "./connexion/connexion.php";

$idFilm = $_POST['id'];
$login = $_SESSION['loginConnecte'];

$sql = "SELECT * FROM user WHERE login = :login";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(':login', $login);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id = $result[0]['id'];

$sql = "SELECT * FROM favori 
         INNER JOIN user
         ON user.id = favori.idUser
         WHERE favori.idFilm = :idFilm
         AND user.login = :login";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":idFilm", $idFilm);
$stmt->bindValue(":login", $login);
$stmt->execute();

$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($resultat) > 0){
    // on supprime le lien
    $sql = "DELETE FROM favori
    WHERE idFilm = :idFilm
    AND idUser = :idUser";

    $stmt = $cnx->prepare($sql);
    $stmt->bindValue("idFilm", $idFilm);
    $stmt->bindValue("idUser", $id);
    $stmt->execute();

    $reponse = ["statut" => "off"];

    echo json_encode($reponse);
}

else {
    // on rajoute dans les favoris
    $sql = "INSERT INTO favori
    (id, idFilm, idUser)
    VALUES
    (null, :idFilm, :idUser)";

    $stmt = $cnx->prepare($sql);
    $stmt->bindValue("idFilm", $idFilm);
    $stmt->bindValue("idUser", $id);
    $stmt->execute();

    $reponse = ["statut" => "on"];

    echo json_encode($reponse);
}
?>



