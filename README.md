# Technical Interview Challenge 2

## Installation

1. Install docker compose https://docs.docker.com/compose/install/#scenario-one-install-docker-desktop
2. Clone the repository
3. Run `docker-compose up`
4. Run `docker-compose exec my-app composer install -o`
5. Run `docker-compose exec my-app php artisan migrate`
6. Run `docker-compose exec my-app php artisan db:seed`
7. Run (only at local environment) `docker-compose exec my-app chmod -R 777 storage`
7. Load in browser http://localhost:8081
