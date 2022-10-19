document.getElementById("title").addEventListener("keyup", (event) => {
    let val = event.target.value;
    if (val == ""){
        document.getElementById("resultat").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();

    let formulaire = new FormData(document.getElementById("formHTML"));

    xhr.onreadystatechange = (event) => {
        if (xhr.readyState == 4){
            if (xhr.status == 200 || xhr.status == 304){
                let reponse = JSON.parse(xhr.responseText);

                if (reponse.error.lenght > 0){
                    // gerer l'erreur (windows.location.href="...");
                    // rediriger
                    // debugger dans console.log
                    // afficher un message dans le DOM par exemple avoir une div error invisible qui s'affiche quand il y a une erreur et qd pas d'erreur se cache
                    return; 
                }

                else {
                    let arrayFilms = reponse.data;
                    afficheResultat(arrayFilms);
                }
            }                     
            else {
                console.log("error"); // fonction pour voir si connecté à internet ou pas 
            }
        }
    }                                                                                                                                                                                                              

    xhr.open("POST", "./rechercheTraitement.php");
    xhr.send(formulaire);
});

const afficheResultat = function(arrayFilms) {
    if (arrayFilms.length == 0){
        document.getElementById("resultat").innerHTML = "Aucun film ne correspond à votre recherche";
        return;
    }
    document.getElementById("resultat").innerHTML = "";
    let p = document.createElement("p");
    p.innerHTML = `Nombre de résultat${arrayFilms.length > 1 ? 's: ' : ': '} ${arrayFilms.length}`;

    let ul = document.createElement("ul");
    arrayFilms.forEach((elem) => {
        let li = document.createElement("li");
        li.innerHTML = elem.titre + ", " + elem.dateSortie + ", " + elem.duree + ", " + elem.description;
        li.dataset.filmId = elem.id; // on en a pas besoin mais on voit que ca existe ! 
        
        //clickable
        li.addEventListener("click", (e) => {
            window.location.href = "./index.php?p=detailFilm&id=" + elem.id;
        });
        ul.appendChild(li);
    });
    document.getElementById("resultat").appendChild(p);
    document.getElementById("resultat").appendChild(ul);
};