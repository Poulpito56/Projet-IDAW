Documentation API backend
=========================
---
API aliment
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `id_aliment` | int  | Identifiant de l'aliment |


| Action       | HTTP | Payload |        URL       |   Description    |
| :----------: | :--: | :-----: |:---------------: |:---------------: |
| Lire         | GET  |  json   |`backend/aliments.php`| Récupère tous les aliments de la base de données |
| Lire         | GET  |  json   |`backend/aliment.php/{id_aliment}`|Récupère l'aliment correspondant à l'id_aliment
| Lire         | GET  |  json   |`backend/aliment.php/{type}`|Récupère les aliments correspondant au type (type = 0 pour l'eau, type = 1 pour les aliments, type = 2 pour les plats, type = 3 pour les plats en cours de création)
| Lire         | GET  |  json   |`backend/aliment.php/{type}{login}`|Récupère les aliments correspondant au type et au login (uniquement pour les plats)
| Ecrire       | POST |  json   |`backend/aliment.php/{id_aliment}{id_regime}{nom}{image_url}{type}{glucide}{energie}{gras}{fibre}{proteine}{sel}{graisses_saturees}{sucre}{bicarbonate}{calcium}{chlorure}{fluor}{magnesium}{nitrate}{potassium}{silice}{sodium}{sulfate}`| Créer un aliment et renvoie son {id} (seuls les paramètres {nom} et {type} sont obligatoires)
| Supprimer    | DELETE |       |`backend/aliment.php/{id_aliment}`| Supprime l'aliment de l'id renseigné
| Modifer      | PUT  |         |`backend/aliment.php/{id_aliment}{id_regime}{nom}{image_url}{type}{glucide}{energie}{gras}{fibre}{proteine}{sel}{graisses_saturees}{sucre}{bicarbonate}{calcium}{chlorure}{fluor}{magnesium}{nitrate}{potassium}{silice}{sodium}{sulfate}`| Modifie l'aliment de l'id renseigner (seul le paramètre {id} est obligatoire et non modifiable)


API consommer
----------

| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/consommer.php/{login}{date_consommation}`| Récupère tous les id_aliment, les quantités, les dates de consommation des aliments consommés associé au login et postérieur à la date de consommation |
| Ecrire       | POST |         |`backend/consommer.php/{login}{id_aliment}{date_consommation}{quantite}`| Créer une consommation (les paramètres {login} et {id_aliment} sont obligatoires) |
| Supprimer    | DELETE |       |`backend/consommer.php/{id_consommation}`| Supprime la consommation de l'id renseigné
| Modifier     | PUT   |        |`backend/consommer.php/{id_consommation}{date_consommation}{quantite}`| Modifie la date de consommation ou la quantite de la consommation de l'id renseigné


API contenir
----------

| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/contenir.php/{id_aliment}{ali_id_aliment}`| Récupère le poids de l'aliment contenu dans un plat |

///////////////////

| Lire         | GET  |  json   |`backend/contenir.php/{id_aliment}`| Récupère toutes les données des aliments contenus dans un plat |
| Ecrire       | POST |         |`backend/contenir.php/{id_aliment}{ali_id_aliment}{poids}`| Créer une contenance d'un aliment dans un plat (tous les paramètres sont obligatoires) |
| Supprimer    | DELETE |       |`backend/contenir.php/{id_aliment}{ali_id_aliment}`| Supprime la contenance de l'aliment dans la plat dont les id sont renseignés|
| Modifier     | PUT   |        |`backend/contenir.php/{id_aliment}{ali_id_aliment}{poids}`| Modifie le poids de l'aliment contenu dans le plat renseigné |


API user_connexion
----------

| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | POST |  json   |`backend/user_connexion.php/{login}{password}`| Retourne si l'assocation login et password existe en tant qu'utilisateur dans la base de données |


API user
----------

| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/user.php/{login}`| Retoure le regime, le sexe, le mail, l'age, et l'activité physique de la personne associée au login|
| Ecrire       | POST |         |`backend/user.php/{login}{password}{id_regime}{mail}{sexe}{age}{sport}`| Créer un utilisateur qui n'est pas admin avec les informations renseignées |
| Modifier     | PUT  |         |`backend/user.php/{login}{id_regime}{mail}{sexe}{age}{sport}`| Modifie le regime, le sexe, le mail, l'age, ou l'activité physique de la personne associée au login |