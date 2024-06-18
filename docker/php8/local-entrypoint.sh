#!/bin/sh

set -eu

composer install
composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
