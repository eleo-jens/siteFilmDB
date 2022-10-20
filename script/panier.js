document.querySelectorAll(".ajouter").forEach ((elem) => {
   elem.addEventListener('click', (e) => {
        let quantite = e.target.previousSibling.value; // la valeur de l'input qui est à côté du button target // la value est en string 

        let idFilm = e.target.dataset.id;

        let xhr = new XMLHttpRequest();
        let formulaire = new FormData(); // pour remplacer les balises form
        formulaire.append("idFilm", idFilm);
        formulaire.append("quantite",quantite);

        xhr.onreadystatechange = (event) => {
            if (xhr.readyState == 4){
                if (xhr.status == 200){
                    console.log(xhr.responseText);

                }
                else console.log ("error: " + xhr.status);
            }
        }
        xhr.open ("POST", "./panierAjouter.php");
        xhr.send (formulaire);
   }) 
});