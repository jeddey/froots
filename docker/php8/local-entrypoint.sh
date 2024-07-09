#!/bin/sh

set -eu

composer migrate
composer fixtures
exec docker-php-entrypoint php-fpm
