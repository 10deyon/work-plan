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


**TL;DR command list**

    git clone git@github.com:10deyon/work-plan.git
    cd work-plan
    composer install
    cp .env.example .env
    
**Make sure you set the correct database connection information before running the migrations in the .env file** [Environment variables](#environment-variables)

    php artisan migrate
    php -S localhost:8000 -t public

## Database seeding

**Populate the database with seed data with relationships which includes all necessary models (list all the models). This can help you to quickly start testing the api.**

Open the seeders folder and set the property values as per your requirement, default values are already set on the seeders

````
database/seeds/WorkersTableSeeder.php
database/seeds/ShiftsTableSeeder.php

````

Run the database seeder and you're done

````
  php artisan db:seed
````

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

```
  php -S localhost:8000 -t public
```


The root url of the api is

```
  http://localhost:8000/api/v1
```


## Resources

  - Visit https://www.getpostman.com/collections/91cb16e5992b0cf2131d to get Postman Documentation


<br>

## Run Test
  - Run the following command to run test

```
  vendor/bin/phpunit
```
