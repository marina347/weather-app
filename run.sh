#!/bin/bash
docker run -v $PWD:/app --env-file .env --env-file .env.local php:7.4.15-cli-alpine3.13 php /app/src/weather.php "$@"
