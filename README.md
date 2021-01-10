## Lumen Microservice Architecture
Laravel Lumen is a stunningly fast PHP micro-framework based on Laravel. It uses only the limited but important features from Laravel making this framework much faster and light-weight.

This project is a basic layout of how we can build microservices architecture. It contains 2 microservices (Owner & Car) and API gateway to connect these services between application and internal services.

<p align="center">
  <img src="https://miro.medium.com/max/3014/1*4wlrVzmhOioc3PFbuic2tg.png" width="600" title="hover text">
</p>

## API Documentation
  [Documentation](https://documenter.getpostman.com/view/4658799/TVzPoKa6)

## Dependencies
  - php : ^7.3|^8.0
  - dusterio/lumen-passport : ^0.3.2,
  - guzzlehttp/guzzle : ^7.2,
  - laravel/lumen-framework: ^8.0,
  - pusher/pusher-php-server: ~4.0

## Few important concepts covered in this project are:

 - Sqlite Database, database migration, factory and seeder
 - OAuth 2.0 authentication to Gateway using Passport 
 - Guzzle PHP HTTP client send HTTP requests to integrate with web services.
 - Internal mircroservices security
 - Event broadcasting using Pusher (Implemented only for Owner's create read update operations)
 - Testing using PhpUnit (Testing done only for owners json response)

## Main Folder Structure
  
  ### 1. CarGateway:
   Build on Lumen 8.0. The main point for external applications to connect to services, makes secure connection to interanl services.
  
  ### 2. OwnersApi:
  Build on Lumen 8.0. Uses own sqlite database for simplicity. Includes CRUD operations for Owners. Accept only the encrypted request.
  
  ### 3. CarsApi:
  Build on Lumen 8.0. Uses own sqlite database for simplicity. Includes CRUD operations for Cars. Accept only the encrypted request.
      
## Installation
Each lumen service and gateway must be running separately in different ports. The url for each service should be included in respective .env files.

Please check the official lumen installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs/8.x)

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    Visit YOUR_URL/key to generate a key

Generate a new Passsport authentication secret keys in CarGateway

    php artisan passport:install

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server in different port

    php -S localhost:8000 -t public


## Authentication
 
This applications uses Passport from Laravel to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme. The Passport authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about JWT. 

As the Passport is not completely supported or requires lot of changes in Lumen framework, this oproject uses Pasport package built by Dusterio.

It can be installed using following package;
      
      $ composer require dusterio/lumen-passport
 
- https://github.com/dusterio/lumen-passport

