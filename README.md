BlablaMovie
===========

La société BlablaMovie souhaite donner la parole aux internautes en leur permettant de choisir le film qu'ils préfèrent. Chaque utilisateur peut choisir jusqu'à 3 films. Au bout d'une semaine, le film gagnant est révélé.


Objectif
--------

Les films qui peuvent être choisis sont ceux retournés par l'API ouverte omdbapi (http://omdbapi.com/).

L'objectif est de créer une API avec Symfony capable de réaliser les actions suivantes :

- créer un utilisateur (pseudo, email unique, date de naissance, date de création en base de données)
- enregistrer le choix d'un film d'un utilisateur
- supprimer le choix d'un film d'un utilisateur
- lister les choix de film d'un utilisateur
- lister les utilisateurs ayant choisi un film
- retourner le meilleur film selon l'ensemble des utilisateurs

Chacun de ces webservices renverra une réponse au format json. Les informations du film à retourner sont son titre et son affiche.
On ne traitera pas l'authentification des utilisateurs ni la sécurisation des accès aux webservices de l'api. Il n'est pas nécessaire d'utiliser d'autres bundles que ceux fournis par symfony.
Merci de mettre à disposition le code sur un git ouvert (github, gitlab...), ainsi qu'une spécification succincte de l'api permettant au développeur front chargé de créer le site web d'intégrer correctement votre API.
Une attention particulière sera porté à la lisibilité du code, aux bonnes pratiques de développement d'une API REST et aux performances des requêtes SQL.


Installation
------------

### Prérequis

PHP >=7.4
composer
symfony
phpunit
