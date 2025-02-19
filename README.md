# Territory 2.0 Test
### Installation
docker-compose up -d
docker exec -it territory_test bash
./init.sh
### Run:
    docker exec -it territory_test bash
    php artisan farm:life --locale=en|ru
    OR
    php artisan farm:life
### Testing
    docker exec -it territory_test bash
    ./testing/run.sh
