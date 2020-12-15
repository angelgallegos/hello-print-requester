# Services

This is the repository that contains the Kafka consumers services

## Requirements
 - [Docker](https://docs.docker.com/get-docker/)
 - [Docker compose](https://docs.docker.com/compose/install/)
 - [Composer](https://getcomposer.org/)

## Before

The dependencies of the project need to be satisfied, for that
if you have composer installed globally run:

```
$ composer install 
```
 
If not follow the steps in the [docs](https://getcomposer.org/download/) and then run

```
$ php composer.phar install 
```

on the root of the project

### Configuring the project

Copy the contents of the .env.example file
```
$ cp src/.env.example src/.env
```

Adjust the values as needed
 
### Starting the requester

Since the project is Dockerized all you need to do is run

```
$ docker-compose up
``` 

from the root of the project.
