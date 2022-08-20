#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
	exec php-fpm

# elif [ "$role" = "taskmaster" ]; then
# 	echo "TaskMaster"
#     php /var/www/artisan queue:work --verbose --tries=3

# elif [ "$role" = "clockwork" ]; then
#     while [ true ]
#     do
#       php /var/www/artisan schedule:run --verbose --no-interaction &
#       sleep 60
#     done


else
	echo "Rol no identificado: \"$role\""
	exit 1

fi