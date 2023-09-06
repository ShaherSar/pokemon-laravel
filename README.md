copy .env.example and name it .env

edit db config settings in .env file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pokemon
DB_USERNAME=root
DB_PASSWORD=

run this command to generate key for encryption's needed : 

# php artisan key:generate

-------------------------------------------------------------
for local setup ...

run this command to run database migrations.

# php artisan migrate

run this command to seed data from the excel which is in AnimalsSeederClass

# php artisan db:seed

command to run the localhost server for development stage.

# php artisan serve

-------------------------------------------------------------
for docker setup

run command :

# docker-compose up --build
-------------------------------------------------------------

routes list :

GET|HEAD        api/Animals ................................... Animals.index › AnimalController@index  
POST            api/Animals ................................... Animals.store › AnimalController@store  
GET|HEAD        api/Animals/{Animal} .......................... Animals.show › AnimalController@show  
PUT|PATCH       api/Animals/{Animal} .......................... Animals.update › AnimalController@update  
DELETE          api/Animals/{Animal} .......................... Animals.destroy › AnimalController@destroy