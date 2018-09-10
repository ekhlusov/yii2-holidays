#!/bin/sh
docker exec -it $(docker-compose ps | grep _php_ | cut -d" " -f 1) sh
