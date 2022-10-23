document.querySelectorAll(".ajouter").forEach((elem) => {
    // quand on clique sur ajouter une quantite, met à jour le panier 
    elem.addEventListener('click', (e) => {
        updatePanier(e);
    });
});


// vide le panier de la session et visuellement quand on clique sur vide
document.getElementById('vide').addEventListener('click', (e) => {
    console.log(e.target);

    let xhr = new XMLHttpRequest;

    xhr.onreadystatechange = (event) => {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                let panier = document.getElementById('panier');
                panier.innerHTML = "";
                // venir vider la div "panier";
            }
            else console.log(`Error: ${xhr.status}`);
        }
    }
    xhr.open("GET", "./panierVider.php");
    xhr.send(null);
});

// lors du chargement de la page affiche le panier à jour
document.addEventListener('DOMContentLoaded', (e) => {
    updatePanier();
});


// la fonction qui update le panier on lui passe l'evenement dans le cas du click et on crée la quantité, idFIlm etc. pour l'envoyer dans le formulaire
// on envoit ces infos au serveur qui va les intégrer dans la session puis renvoyer une reponse JSON pour l'affichage
// si c'est la cas de l'upload on ne lui envoit pas d'evenement, on appelle le serveur qui va renvoyer les infos de la session et les afficher
function updatePanier(e) {


    let xhr = new XMLHttpRequest();
    let formulaire = new FormData(); // pour remplacer les balises form

    if (e != undefined) {    
        let quantite = e.target.previousSibling.value; // la valeur de l'input qui est à côté du button target // la value est en string 
        let idFilm = e.target.dataset.id;
        let prixFilm = e.target.dataset.prix;
        let titreFilm = e.target.dataset.titre;
        formulaire.append("idFilm", idFilm);
        formulaire.append("titreFilm", titreFilm);
        formulaire.append("prixFilm", prixFilm);
        formulaire.append("quantite", quantite);
    }

    xhr.onreadystatechange = (event) => {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // console.log(xhr.responseText)
                let panier = document.getElementById('panier');
                panier.innerHTML = "";
                let reponse = JSON.parse(xhr.responseText);
                // console.log(reponse);

                // parcourir le panier qui est sous forme d'objet d'objets
                for (const idFilm in reponse) {
                    let p = document.createElement('p');
                    p.innerHTML = "";

                    console.log(reponse[idFilm]);
                    // p.innerHTML += ` ${reponse[idFilm][i]}`;
                    p.innerHTML = `Produit: ${reponse[idFilm].nom} ----`;
                    p.innerHTML += ` Quantité: ${reponse[idFilm].quantite} ----`;
                    p.innerHTML += ` Prix: ${reponse[idFilm].quantite * reponse[idFilm].prixUnitaire} €`;

                    panier.appendChild(p);
                }

                // reponse = Object.entries(reponse);
                // // rafraichir le panier dans la div
                // console.log(reponse);
            }
            else console.log("error: " + xhr.status);
        }
    }
    xhr.open("POST", "./panierAjouter.php");
    xhr.send(formulaire);
}