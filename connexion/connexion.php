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