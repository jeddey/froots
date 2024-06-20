#!/bin/sh

set -eu

composer install --prefer-dist --no-dev --no-scripts --no-progress;
composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
