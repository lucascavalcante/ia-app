# IA App

A movie recommendation API

## Requirements

* PHP >= 7.1
* Docker
* Docker containers (the first one a MySQL container, and the second one a RabbitMQ container)

## Installation

> `git clone https://github.com/lucascavalcante/ia-app.git`

> `cd ia-app/`

> `composer install` (at the final you need to set up database credentials)

If the command above returns any error, run the command below

> `bin/console cache:clear`

> `bin/console doctrine:database:create`

> `bin/console doctrine:schema:update --force`

> `bin/console doctrine:fixtures:load --purge-with-truncate`

> `bin/console server:start`

## Configuration

To access the RabbirMQ server:

* http://127.0.0.1:15762 (default port, you can change on create the container)

Is needed to create a user and password in RabbitMQ server to work fine with the application data:

* User: mquser
* Password: mqpass

Author:
* [Lucas Cavalcante](https://lucascavalcante.dev)