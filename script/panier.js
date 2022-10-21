document.querySelectorAll(".ajouter").forEach((elem) => {
    elem.addEventListener('click', (e) => {
        let quantite = e.target.previousSibling.value; // la valeur de l'input qui est à côté du button target // la value est en string 

        let idFilm = e.target.dataset.id;
        let prixFilm = e.target.dataset.prix;
        let titreFilm = e.target.dataset.titre;

        let xhr = new XMLHttpRequest();
        let formulaire = new FormData(); // pour remplacer les balises form
        formulaire.append("idFilm", idFilm);
        formulaire.append("titreFilm", titreFilm);
        formulaire.append("prixFilm", prixFilm);
        formulaire.append("quantite", quantite);

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
                        
                        for (const i in reponse[idFilm]) {
                            // console.log(`${i}: ${reponse[key][i]}`);
                            p.innerHTML += ` ${reponse[idFilm][i]}`;
                        }
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
    })
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