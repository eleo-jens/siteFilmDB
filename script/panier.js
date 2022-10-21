document.querySelectorAll(".ajouter").forEach((elem) => {
    elem.addEventListener('click', (e) => {
        updatePanier(e);
    });
});

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


document.addEventListener('DOMContentLoaded', (e) => {
    updatePanier();
});

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