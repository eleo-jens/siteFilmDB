FAVORI
------------------

Au niveau de la DB, créer le tableau intermédiaire de jointure Favoris:
  id, idUser, idFilm


Marquer un film comme favori
-------------------------------------
Une icône coeur pour chaque film (rempli/pas rempli)

Fonctionalité:
- Event click pour le heart: lier le film avec l'utilisateur
- Serveur: 
  recoit un appel Ajax avec l'id du film
  Prendre le login de l'utilisateur issu de la session
  Fair une requête pour obtenir l'id de l'utilisateur
  Lancer une rquête pour remplir favori: INSERT INTO favori (id, idUser, idFilm) VALUES (null, :idUser, :idFilm)
- Changement visuel: coeur se remplit

Enlever des favoris
--------------------------------------
Fonctionnalité: 
- Event click coeur: enlever la liason entre le film et l'user
- Changement visuel: le coeur se vide
- Serveur:
recoit un appel Ajax avec l'id du film
  Prendre le login de l'utilisateur issu de la session
  Fair une requête pour obtenir l'id de l'utilisateur
  Lancer une rquête pour remplir favori: DELETE FROM favori WHERE idFilm = : idFilm AND idUser = :idUser

Lister les favoris
----------------------------------------
- Créer un lien "Mes favoris"
- Serveur: Lancer la requête
    SELECT * FROM film 
    INNER JOIN favori 
    ON film.id = favori.idFilm
    INNER JOIN user
    ON film.user = favori.idUser
    WHERE user.id = :idUser