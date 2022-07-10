#!/bin/bash

#usage: ./installer.sh

composer install --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader --prefer-dist

echo migration table and routine:
php artisan migraion

echo
echo Populate db from https://swapi.dev/api/people/
php artisan RetrievePeoples

echo Done.

echo use 'sudo php -S localhost:9090 -t ./public/' to run server, and test api:
echo 'http://localhost:9090/api/people/?page=1&howMany=10' for paginated list of  people
echo 'http://localhost:9090/api/people/{peopleId}' for people details


