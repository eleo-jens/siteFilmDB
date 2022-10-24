$(function () {
  let value;
  let id;

  $(".rating").barrating({
    theme: "fontawesome-stars",
    theme: "bars-movie",
    onSelect: function (text, value, event) {

      if (typeof event !== "undefined") {

        console.log(event.target.parentElement.previousSibling.dataset.id);
        console.log(event.target.dataset.ratingValue);

        id = event.target.parentElement.previousSibling.dataset.id;
        value = event.target.dataset.ratingValue;
        let xhr = new XMLHttpRequest();
        let formulaire = new FormData();
        formulaire.append('value', value);
        formulaire.append('id', id);
        xhr.onreadystatechange = (event) => {
            if (xhr.readyState == 4){
                if (xhr.status == 200){
                    let reponse = parseInt(JSON.parse(xhr.responseText));

                    let card = document.querySelector('.card-body');
                    let div = document.createElement('div');
                    let p = document.createElement('p');
                    let classAttribute = document.createAttribute('class');
                    let idAttribute = document.createAttribute('id')
                    classAttribute.value = "card-text";
                    p.setAttributeNode(classAttribute);
                    idAttribute.value = "moyenne";
                    div.setAttributeNode(idAttribute);
                    p.innerHTML = `La note des utilisateurs: ${reponse}`;
                    div.appendChild(p);
                    card.appendChild(div);
                }
                else console.log(`error: ${xhr.status}`);
            }
        };
        xhr.open("POST", "./noteTraitement.php");
        xhr.send(formulaire);
      }
    },

  });

  $("select").barrating("set", value);
});
