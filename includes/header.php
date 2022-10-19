<?php 
session_start();
?>
<header>
    <nav class="navbar">
        <a href="./index.php?p=accueil" ><img id="logo" src="./img/logo.png" alt="logo"></a>
        <a class="link" href="./index.php?p=accueil">Accueil</a>
        <a class="link" href="./index.php?p=listeFilms">Liste de films</a>
        <a class="link" href="./index.php?p=insertForm">Insérer un film</a>
        <a class="link" href="./index.php?p=chercherFilm">Chercher un film</a>
        <?php
        if (isset($_SESSION['loginConnecte'])){
        // echo $_SESSION['loginConnecte'];
            echo "<a class='link' href='./logout.php'>Se deconnecter</a>";
        }
        else {
            header ("location: ./login.php");
        }
        ?>
     </nav>
</header>