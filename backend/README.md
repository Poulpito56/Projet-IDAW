Documentation API backend
=========================
---
API aliment
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `id_aliment` | int  | Identifiant de l'aliment |
| `id_regime` | int  | Identifiant du régime alimentaire (1 = omnivore, 2 = pescétarien, 3 = végétarien, 4 = vegan) |
| `nom` | char(63)  | Nom de l'aliment |
| `image_url` | varchar(255)  | URL de l'image de l'aliment |
| `type` | smallint  | Type de l'aliment (type = 0 pour l'eau, type = 1 pour les aliments, type = 2 pour les plats, type = 3 pour les plats en cours de création) |
| `glucide` | decimal(7,3)  | Grammage de glucide pour 100g de l'aliment |
| `energie` | decimal(7,3)  | Grammage de énergie pour 100g de l'aliment |
| `gras` | decimal(7,3)  | Grammage de gras pour 100g de l'aliment |
| `fibre` | decimal(7,3)  | Grammage de fibre pour 100g de l'aliment |
| `proteine` | decimal(7,3)  | Grammage de protéine pour 100g de l'aliment |
| `sel` | decimal(7,3)  | Grammage de sel pour 100g de l'aliment |
| `graisses_saturees` | decimal(7,3)  | Grammage de graisses saturées pour 100g de l'aliment |
| `sucre` | decimal(7,3)  | Grammage de sucre pour 100g de l'aliment |
| `bicarbonnate` | decimal(7,3)  | Grammage de bicarbonnate pour 100g de l'aliment |
| `calcium` | decimal(7,3)  | Grammage de calcium pour 100g de l'aliment |
| `chlorure` | decimal(7,3)  | Grammage de chlorure pour 100g de l'aliment |
| `fluor` | decimal(7,3)  | Grammage de fluor pour 100g de l'aliment |
| `magnesium` | decimal(7,3)  | Grammage de magnésium pour 100g de l'aliment |
| `nitrate` | decimal(7,3)  | Grammage de nitrate pour 100g de l'aliment |
| `potassium` | decimal(7,3)  | Grammage de potassium pour 100g de l'aliment |
| `silice` | decimal(7,3)  | Grammage de silice pour 100g de l'aliment |
| `sodium` | decimal(7,3)  | Grammage de sodium pour 100g de l'aliment |
| `sulfate` | decimal(7,3)  | Grammage de sulfate pour 100g de l'aliment |


| Action       | HTTP | Payload |        URL       |   Description    |
| :----------: | :--: | :-----: |:---------------: |:---------------: |
| Lire         | GET  |  json   |`backend/aliments.php`| Récupère tous les aliments de la base de données |
| Lire         | GET  |  json   |`backend/aliment.php/{id_aliment}`|Récupère l'aliment correspondant à l'id_aliment
| Lire         | GET  |  json   |`backend/aliment.php/{type}`|Récupère les aliments correspondant au type |
| Lire         | GET  |  json   |`backend/aliment.php/{type}{login}`|Récupère les aliments correspondant au type et au login (uniquement pour les plats)
| Ecrire       | POST |  json   |`backend/aliment.php/{id_aliment}{id_regime}{nom}{image_url}{type}{glucide}{energie}{gras}{fibre}{proteine}{sel}{graisses_saturees}{sucre}{bicarbonate}{calcium}{chlorure}{fluor}{magnesium}{nitrate}{potassium}{silice}{sodium}{sulfate}`| Créer un aliment et renvoie son {id} (seuls les paramètres {nom} et {type} sont obligatoires)
| Supprimer    | DELETE |       |`backend/aliment.php/{id_aliment}`| Supprime l'aliment de l'id renseigné
| Modifer      | PUT  |         |`backend/aliment.php/{id_aliment}{id_regime}{nom}{image_url}{type}{glucide}{energie}{gras}{fibre}{proteine}{sel}{graisses_saturees}{sucre}{bicarbonate}{calcium}{chlorure}{fluor}{magnesium}{nitrate}{potassium}{silice}{sodium}{sulfate}`| Modifie l'aliment de l'id renseigner (seul le paramètre {id} est obligatoire et non modifiable)


API consommer
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `id_consommation` | int  | Identifiant de la consommation |
| `login` | char(63)  | Login de l'utilisateur ayant manger l'aliment |
| `id_aliment` | int  | Identifiant de l'aliment consommé' |
| `quantite` | decimal(15,2)  | Quantité consommée |
| `date_consommation` | date  | Date de la consommation |


| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/consommer.php/{login}{date_consommation}`| Récupère tous les id_aliment, les quantités, les dates de consommation des aliments consommés associé au login et postérieur à la date de consommation |
| Ecrire       | POST |         |`backend/consommer.php/{login}{id_aliment}{date_consommation}{quantite}`| Créer une consommation (les paramètres {login} et {id_aliment} sont obligatoires) |
| Supprimer    | DELETE |       |`backend/consommer.php/{id_consommation}`| Supprime la consommation de l'id renseigné
| Modifier     | PUT   |        |`backend/consommer.php/{id_consommation}{date_consommation}{quantite}`| Modifie la date de consommation ou la quantite de la consommation de l'id renseigné


API contenir
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `id_aliment` | int  | Identifiant du plat qui contient les aliments |
| `ali_id_aliment` | int  | Identifiant d'un aliment contenu dans le plat |
| `poids` | smallint  | Poids de l'aliment contenu dans le plat |


| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/contenir.php/{id_aliment}{ali_id_aliment}`| Récupère le poids de l'aliment contenu dans un plat |
| Lire         | GET  |  json   |`backend/contenir.php/{id_aliment}`| Récupère toutes les données des aliments contenus dans un plat |
| Ecrire       | POST |         |`backend/contenir.php/{id_aliment}{ali_id_aliment}{poids}`| Créer une contenance d'un aliment dans un plat (tous les paramètres sont obligatoires) |
| Supprimer    | DELETE |       |`backend/contenir.php/{id_aliment}{ali_id_aliment}`| Supprime la contenance de l'aliment dans la plat dont les id sont renseignés|
| Modifier     | PUT   |        |`backend/contenir.php/{id_aliment}{ali_id_aliment}{poids}`| Modifie le poids de l'aliment contenu dans le plat renseigné |


API user_connexion
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `login` | char(63)  | Identifiant de l'utilisateur |
| `password` | char(63)  | Mot de passe de l'utilisateur |


| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | POST |  json   |`backend/user_connexion.php/{login}{password}`| Retourne si l'assocation login et password existe en tant qu'utilisateur dans la base de données |


API user
----------

###Paramètres
| Nom       | Type |   Description    |
| :-------: | :--: |:---------------: |
| `login` | char(63)  | Identifiant de l'utilisateur |
| `id_regime` | int  | Identifiant du régime alimentaire de l'utilisateur (1 = omnivore, 2 = pescétarien, 3 = végétarien, 4 = vegan) |
| `password` | char(63)  | Mot de passe de l'utilisateur |
| `sexe` | smallint  | Identifiant du sexe de l'utilisateur (0 = non précisé, 1 = homme, 2 = femme) |
| `admin` | bool  | Précise si l'utilisateur est administrateur ou non (true = oui, false = non)|
| `mail` | char(63)  | Mail de l'utilisateur |
| `age` | smallint  | Age de l'utilisateur |
| `sport` | smallint  | Activité sportive de l'utilisateur sur 10 |



| Action       | HTTP | Payload |        URL       |   Description     |
| :----------: | :--: | :-----: |:---------------: |:----------------: |
| Lire         | GET  |  json   |`backend/user.php/{login}`| Retoure le regime, le sexe, le mail, l'age, et l'activité physique de la personne associée au login|
| Ecrire       | POST |         |`backend/user.php/{login}{password}{id_regime}{mail}{sexe}{age}{sport}`| Créer un utilisateur qui n'est pas admin avec les informations renseignées |
| Modifier     | PUT  |         |`backend/user.php/{login}{id_regime}{mail}{sexe}{age}{sport}`| Modifie le regime, le sexe, le mail, l'age, ou l'activité physique de la personne associée au login |