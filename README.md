# WEB2-FRONT-TP2
Un site web permettant gestion financière de projets réalisé dans le cadre de la formation de développeur web d'HETIC.

## Prérequis
- Docker (https://docs.docker.com/get-docker/)

## Configuration
Fichiers de configuration :
- `./client/src/config.json` : configuration de la base de données
- `./client/package.json`: configuration du projet node
- `./docker-compose.yml`, `./client/Dockerfile`, `./server/Dockerfile` : configuration du projet docker

## Commandes
Voici la commande à exécuter pour installer et exécuter le projet : `docker compose up -d --build`.

Pour arrêter le projet, écrivez `docker compose down`.

## Démonstation
2 comptes utilisateur sont déjà créés :
```json
[
  {
    "username": "first_user",
    "email": "user1@example.com",
    "password": "Bonjour123?"
  },
  {
    "username": "second_user",
    "email": "user2@example.com",
    "password": "Bonjour123?"
  }
]
```
