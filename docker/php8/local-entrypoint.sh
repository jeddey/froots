#!/bin/sh

set -eu

composer install --ignore-platform-reqs
composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
