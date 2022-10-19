<?php

include "./connexion/connexion.php";

// var_dump($_POST);

// Obtenur les données du formulaire
$nom = $_POST['nom'];
$login = $_POST['login'];
$login = filter_input (INPUT_POST, 'login', FILTER_VALIDATE_EMAIL);
// if(!$login){
//     //header()...
//     die();
// }

$password = $_POST['password'];
$repassword = $_POST['repassword'];

// Vérifier si l'user existe déjà ou non

$sql = "SELECT * FROM user WHERE login LIKE :login";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(":login", $_POST['login']);
$stmt->execute();
// var_dump($stmt->errorInfo());
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($res);

if($res){
    echo "Erreur. L'utilisateur " . $login. " existe déjà.";
}
else {
    // Lancer l'insertion de l'utilisateur dans le tableau User
    $sql = "INSERT INTO user (id, nom, login, password) VALUES (null, :nom, :login, :password)";
    
    $stmt = $cnx->prepare($sql);
    $stmt->bindValue (":nom", $nom);
    $stmt->bindValue (":login", $login);
    
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);
    // apprentissage: pour voir à quoi ressemble le hash
    // var_dump($password);
    // die();
    $stmt->bindValue (":password", $password); 
    $stmt->execute();
    // var_dump($stmt->errorInfo());
}

// Si tout est OK, on va vers l'acceuil après avoir stocké le login dans la session
session_start();
$_SESSION['loginConnecte'] = $login;
header ('location: ./index.php?p=accueil');
