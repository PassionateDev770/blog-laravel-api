Prerequisites
Docker

## Installation du projet

- Copier le fichier .env `cp .env.example .env`
- ./vendor/bin/sail up                            ##Pour démarer le docker
- ./vendor/bin/sail exec -it laravel.test bash    ##Pour accéder à l'application laravel
- composer install
- php artisan migrate
- php artisan db:seed
- La base de donnée est accessible via l'url :http://localhost:9001/
    

