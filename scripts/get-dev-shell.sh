#!/bin/sh
docker exec -it $(docker-compose ps | grep _php-dev_ | cut -d" " -f 1) sh
