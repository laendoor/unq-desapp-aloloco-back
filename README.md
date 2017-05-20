[![Build Status](https://travis-ci.org/Grupo-E-012017/aloloco.svg?branch=master)](https://travis-ci.org/Grupo-E-012017/aloloco)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/80716585d03d4c6fa1eded88cfa4dec1)](https://www.codacy.com/app/Grupo-E-012017/aLoLoco?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Grupo-E-012017/aloloco&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/80716585d03d4c6fa1eded88cfa4dec1)](https://www.codacy.com/app/Grupo-E-012017/aLoLoco?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Grupo-E-012017/aloloco&amp;utm_campaign=Badge_Coverage)
[![Heroku](https://heroku-badge.herokuapp.com/?app=aloloco-grupo-e&style=flat)](https://aloloco-grupo-e.herokuapp.com/)

# Comprando a Lo Loco :: API Backend

Desarrollo de Aplicaciones :: UNQ

 - [Frontend Repo](https://github.com/Grupo-E-012017/aloloco-front)
 - [App Heroku](https://aloloco-grupo-e-front.herokuapp.com)

## Grupo E :: 2017.01

### Requerimientos

 Tener corriendo una VM con [Homestead](https://laravel.com/docs/5.4/homestead) o un entorno con:

 * Apache / Nginx
 * PHP 7.1
 * Composer
 * SQLite
 * Git

### Instalación

```
$ git clone https://github.com/Grupo-E-012017/aloloco.git
$ cd aloloco
$ touch database/database.sqlite database/phpunit.sqlite
$ composer install
$ cp .env.example .env      # setear las variables de entorno necesarias
```

```
# correr los tests para verificar que todo ande bien
$ vendor/bin/phpunit tests/
```

```
# probar la aplicación
$ php artisan migrate
$ php artisan db:seed
```

### [Enunciado](https://docs.google.com/document/d/12mQ0RNt8awqc2ow6FsQvsXm-AQiGmC-xlM9b2A_OPRA/edit)

### API REST Methods

#### `GET /`: API info

```json
{
  "api": "aLoLoco"
}
```

#### `GET /client`: Retrieve auth user basic data

#### `GET /client/wishlists`: Show client wish lists

```json
{
  "data": [
    {
      "id": 1,
      "name": "Asado del Domingo",
      "client": {
        "id": 1,
        "email": "the.king.in.the.north@seven-kingdoms.org"
      },
      "products": [
        {
          "id": 13,
          "name": "Cerveza",
          "brand": "Quilmes",
          "image": "http://lorempixel.com/400/400/food/?15065",
          "quantity": 10
        },
        "..."
      ],
      "..."
    }
  ]
}
```

#### `GET /stock`: List products in stock

```json
{
  "data": [
    {
      "id": 1,
      "name": "Dicta iusto fuga.",
      "brand": "Dolores soluta dolor.",
      "image": "http://lorempixel.com/300/400/food/?76408"
    },
    "..."
  ]
}
```

#### `POST|PUT /stock`: Store received csv file into stock

### Diagrama UML

![Diagrama UML][uml]

[Ver en Draw.io][uml.io]

### Mockups

![Mockups][mockups]




[uml]: https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/design.png

[uml.io]: https://drive.google.com/file/d/0B5NnQ8dedsGLanVFOTV5SDVJcE0/view?ts=58d55080

[mockups]: https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/mockups.png

