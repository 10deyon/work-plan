# WORK PLANNING SERVICE

## DESCRIPTION

A REST application from scratch that serves as a work planning service.

**Business requirements:**
1. A worker has shifts
2. A shift is 8 hours long
3. A worker never has two shifts on the same day
4. It is a 24 hour timetable 0-8, 8-16, 16-24
5. Preferably write a couple of units tests.

----------

## Getting started

### Installation

Please check the official lumen installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs/8.x)

```
    open the bash terminal
```

Clone the repository

````
git clone git@github.com:10deyon/work-plan.git
````

Switch to the repo folder

````
cd work-plan
````

Install all the dependencies using composer

````
composer install
````

Copy the example env file and make the required configuration changes in the .env file

````
cp .env.example .env
````

Run the database migrations (**Set the database connection in .env before migrating**)

````
php artisan migrate
````

Start the local development server

````
php -S localhost:8000 -t public
````

You can now access the server at http://localhost:8000


**TL;DR command list**

    git clone git@github.com:10deyon/work-plan.git
    cd work-plan
    composer install
    cp .env.example .env
    
**Make sure you set the correct database connection information before running the migrations in the .env file** [Environment variables](#environment-variables)

    php artisan migrate
    php -S localhost:8000 -t public

## Database seeding

**Populate the database with seed data with relationships which includes all necessary models (list all the models). This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the WorkersTableSeeder and set the property values as per your requirement

````
database/seeds/WorkersTableSeeder.php
````

Run the database seeder and you're done

````
php artisan db:seed --class=WorkersTableSeeder
````

## API Specification

> [Full API Spec](https://github.com/gothinkster/realworld/tree/master/api)
----------

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api/v1

Request headers

| **Required** 	| **Key**              	| **Value**         |
|---------------|-----------------------|------------------	|
| Yes      	    | Content-Type     	    | application/json 	|
| Yes      	    | X-Requested-With 	    | XMLHttpRequest   	|

Refer the [api specification](#api-specification) for more info.
----------

# Cross-Origin Resource Sharing (CORS)
 
This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from `http://localhost:3000` and `http://localhost:4200` to help speed up your frontend testing. The CORS allowed origins can be changed by setting them in the config file. 



# Native Challenge

  ## Built with

  * PHP - Lumen Framework
  * MySql
  * Docker
  
  <br>
  <br>

## Setup Instructions
 - To get the app running, run the following command in the project root folder
        
        $ docker-compose up --build

 - Install Composer Dependencies for the Lumen project
    
        $ docker-compose exec app composer install
  
 - Migrate and seed database with all provided records as in csv files (located in project directory `./database/files`)

        $ docker-compose exec app php artisan migrate:fresh --seed

<br>
<br>

## Resources
  - Visit https://documenter.getpostman.com/view/9029061/UV5deaGg to get Postman Documentation


<br>
<br>

## Run Test
  - Run the following command to run test

        $ docker-compose exec app vendor/bin/phpunit


<br>
<br>

## Bonuses
 - Connect to database on your local machine via some database client (such as Sequel Pro)
  
          - Host:     localhost
          - username: root
          - password: [leave it empty]
          - port:     3308
          - database: native_challenge
