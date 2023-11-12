Documentation API backend
=========================
---
API aliment
----------


| Action       | HTTP | Payload |        URL       |        Description       |
| :----------: | :--: | :-----: |:---------------: |:---------------: |
| Lire         | GET  |  json   |`backend/aliments`| Récupère tous les aliments de la base de données |
| Lire         | GET  |  json   |`backend/aliment/{id_aliment}`|Récupère l'aliment correspondant à l'id_aliment
| Lire         | GET  |  json   |`backend/aliment/{type}`|Récupère les aliments correspondant au type (type = 0 pour l'eau, type = 1 pour les aliments, type = 2 pour les plats, type = 3 pour les plats en cours de création)
| Lire         | GET  |  json   |`backend/aliment/{type}{login}`|Récupère les aliments correspondant au type et au login (uniquement pour les plats)
| Ecrire       | POST |         |`backend/aliment/{id_aliment}{id_regime}{nom}{image_url}{type}{glucide}{energie}{gras}{}`|

