#!/bin/bash
docker run -it -v $PWD:/app --env-file .env --env-file .env.local php:7.4.15-cli-alpine3.13 /app/vendor/bin/phpunit --configuration /app/phpunit_unit.xml
