up: # Init containers
	include .env
	echo ${APP_EXPOSE_PORT}
	@echo "🦖 -> UP Containers"
	docker-compose up -d
	@echo "🦖 -> Visit system on -> http://localhost:8000"

stop: # Stop all containers
	@echo "🦖 -> STOP Containers"
	docker-compose stop

build: # Init files and build all dependencies
	@echo "🦖 -> Env files & Build:"
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@if [ ! -f code/.env ]; then cp code/.env.example code/.env; fi
	@docker-compose build
	@cd code; npm install; npm run build

conf-init: # Create keys and seed database.
	@echo "🦖 -> CONFIG:"
	docker-compose run app composer install
	docker-compose run app php artisan migrate
	docker-compose run app php artisan passport:install
	docker-compose run app php artisan key:generate
	docker-compose run app php artisan db:seed

test: test/all # Run all test

test/all:
	@echo "🩺 -> test"
	docker-compose run app php artisan test

test/feature: # Run feature test 
	@echo "🩺 -> test:feature"
	docker-compose run app php artisan test --testsuite=Feature

test/unit: # Run unit test
	@echo "🩺 -> test:unit"
	docker-compose run app php artisan test --testsuite=Unit

fix: # Fix passport key after run test
	docker-compose run app php artisan passport:install

all: build conf-init up # Run all task for up service

