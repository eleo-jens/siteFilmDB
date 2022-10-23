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
                    console.log("reponse " + xhr.responseText);
                    // let reponse = JSON.parse(xhr.responseText);
                    // console.log("reponse" + reponse);
                    // let p = document.createElement('p');
                    // p.innerHTML = xhr.responseText;


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
