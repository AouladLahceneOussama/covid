#!/bin/bash

COMMAND_PATH="/var/www/covid/app/Commands/Command.php"
MONGO_HOST="mongo"
MONGO_PORT="27017"

# Function to check network connectivity using curl
check_connectivity() {
    if curl -f http://${MONGO_HOST}:${MONGO_PORT} >/dev/null 2>&1; then
        echo "MongoDB is reachable."
        return 0  # Success
    else
        echo "MongoDB is not reachable."
        return 1  # Failure
    fi
}

# Wait for MongoDB to become available
while ! check_connectivity; do
    echo "Waiting for MongoDB to start..."
    sleep 1
done

echo "Running create database command"
php $COMMAND_PATH db:create

echo "Running load data command"
php $COMMAND_PATH db:load

# Start your web server or desired application process
echo "Starting PHP-FPM"
php-fpm