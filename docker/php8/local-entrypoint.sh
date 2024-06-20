#!/bin/sh

set -eu

composer install --no-scripts;
composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
