#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
	exec php-fpm

else
	echo "Rol no identificado: \"$role\""
	exit 1
fi