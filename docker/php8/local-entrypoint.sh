#!/bin/sh

set -eu

composer install --no-dev
composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
