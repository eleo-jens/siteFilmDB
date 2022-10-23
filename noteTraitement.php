<?php
include "./connexion/connexion.php";

session_start();

$value = $_POST['value'];
$idFilm = $_POST['id'];
echo $idFilm;
echo $_SESSION['loginConnecte'];

var_dump($_SESSION['note']);

// si n'existe pas encore la crée
if (!isset($_SESSION['note'])) {
    $_SESSION['note'][] = $idFilm;
    echo ('note nexiste pas dans la session');
    var_dump($_SESSION['note']);
    // $_SESSION['note'][$idFilm] = "";
}

if (!isset($_SESSION['note'][$idFilm])) {
    $_SESSION['note'][$idFilm] = $value;
    var_dump($_SESSION['note'][$idFilm]);
    // insert into le tableau note
    $sql = "INSERT INTO note (id, value, idFilm, idUser) 
            VALUES (null, :value, :idFilm, 
            (SELECT user.id FROM user WHERE login = :login))";

    $stmt = $cnx->prepare($sql);
    $stmt->bindValue(":value", $value);
    $stmt->bindValue(":idFilm", $idFilm);
    $stmt->bindValue(":login", $_SESSION['loginConnecte']);
    $stmt->execute();
}

// si existe déjà, remplacer la valeur de value
else {
    $_SESSION['note'][$idFilm] = $value;
    echo $_SESSION['note'][$idFilm];
    echo $value;
    echo $idFilm;
    echo $_SESSION['loginConnecte'];

    // mettre à jour la valeur dans le tableau
    $sql = "UPDATE note SET value = :value
            WHERE idFilm = :idFilm
            AND idUser = (SELECT user.id FROM user WHERE login = :login)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindValue(":value", $value);
    $stmt->bindValue(":idFilm", $idFilm);
    $stmt->bindValue(":login", $_SESSION['loginConnecte']);
    $stmt->execute();

    var_dump($stmt->errorInfo());
}

// select la moyenne des notes pour le film
$sql = "SELECT ROUND(AVG(value)) as moyenne
        FROM note
        GROUP BY idFilm
        HAVING idFilm = :idFilm ";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":idFilm", $idFilm);
$stmt->execute();

var_dump($stmt->errorInfo());
$moyenne = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($moyenne);
die();

//renvoyer en json les infos de la session pour qu'on puisse charger l'info et envoyer la note moyenne du film dès l'ouverture de la page
// echo json_encode($moyenne['moyenne']);