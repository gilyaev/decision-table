#!/bin/sh
set -e

# Run composer install
composer install

# Execute the CMD from the Dockerfile
exec "$@"
