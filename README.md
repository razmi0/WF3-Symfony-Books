# Projet details

## Pages


- accueil
- liste des livres
- creation d'un livre *
- details d'un livre
- modification d'un livre *
- suppression d'un livre *

- liste des authors
- creation d'un author *
- details d'un author
- modification d'un author *
- suppression d'un author *

- creation d'un compte
- connexion
- deconnexion

- profil utilisateur *
- modification du profil utilisateur 

* Pages sécurisées

## Routes

- /                   HOMEPAGE

- /books              INDEX
    - HEAD
    - GET
- /book                CREATE
    - HEAD
    - GET
    - POST
- /book/{id}           READ
    - HEAD
    - GET
- /book/{id}/edit     UPDATE
    - HEAD
    - GET
    - PUT
    - POST
- /book/{id}/delete   DELETE
    - HEAD
    - GET
    - DELETE

- /authors           INDEX
    - HEAD
    - GET
- /author             CREATE
    - HEAD
    - GET
    - POST
- /author/{id}         READ
    - HEAD
    - GET
- /author/{id}/edit    UPDATE
    - HEAD
    - GET
    - PUT
    - POST
- /author/{id}/delete   DELETE
    - HEAD
    - GET
    - DELETE

- /register        REGISTER
- /login           LOGIN
- /logout          LOGOUT

- /profile         PROFILE
    - HEAD
    - GET
- /profile/edit    UPDATE
    - HEAD
    - GET
    - PUT
    - POST
- /profile/delete  DELETE


## Controllers

- HomepageController::index()

- BookController::index()
- BookController::create()
- BookController::read()
- BookController::update()
- BookController::delete()

- AuthorController::index()
- AuthorController::create()
- AuthorController::read()
- AuthorController::update()
- AuthorController::delete()

- RegisterController::index()**

- SecurityController::login()**
- SecurityController::logout()**

- ProfileController::index()


** : Controller généré par Symfony

## Entités

- Book                  php bin/console make:entity Book
    - id
    - title
    - author
    - description
    - image
    - user

- User                php bin/console make:xxxxxxxxx
    - id
    - email
    - password
    - roles
    - books

- Author             php bin/console make:entity Author
    - id
    - name
    - books