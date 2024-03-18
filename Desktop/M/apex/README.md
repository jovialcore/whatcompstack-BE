A marketing CRUD system with Roles based permission to access routes. 
Users can see listed marketing channels but they cannot create, delete or update except an admin assigns them the "marketer" role

#### Set up:

Clone the project and install packages using composer install 


Run `php artisan migrate` to create database

#### Populate database with users and one admin
There is a seeder for this
run `php artisan db:seed`  . it creates about 10 users and one user with the adminstrator role 


Run `php artisan serve`
