<?php 
session_start();

if (isset($_SESSION['loginConnecte'])){
// echo $_SESSION['loginConnecte'];
    echo "<a class='nav-link' href='./logout.php'>Se deconnecter</a>";
}
else {
    header ("location: ./login.php");
}
?>
<header>
    <nav class="nav">
        <a class="nav-link" href="./index.php?p=accueil">Accueil</a>
        <a class="nav-link" href="./index.php?p=listeFilms">Liste de films</a>
        <a class="nav-link" href="./index.php?p=insertForm">Insérer un film</a>
        <a class="nav-link" href="./index.php?p=chercherFilm">Chercher un film</a>
     </nav>
</header>