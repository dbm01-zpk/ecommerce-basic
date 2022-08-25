run: run/local

run/local:
	@echo "🦖 -> RUN-LOCAL:"
	docker-compose up

run/bg:
	@echo "🦖 -> RUN:"
	docker-compose up -d

run/fix:
	@echo "🦖 -> FIX RUN:"
	docker-compose run app php artisan passport:install

build:
	@echo "🦖 -> BUILD:"

	# Create env files
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@if [ ! -f code/.env ]; then cp code/.env.example code/.env; fi

	docker-compose build
	docker-compose run app composer install
	docker-compose run app php artisan migrate
	docker-compose run app php artisan passport:install
	docker-compose run app php artisan key:generate
	docker-compose run app php artisan db:seed
	@cd code; npm install; npm run build
	
test: test/all

test/all:
	@echo "🦖 -> test"
	docker-compose run app php artisan test

test/feature:
	@echo "🦖 -> test:feature"
	docker-compose run app php artisan test --testsuite=Feature

test/unit:
	@echo "🦖 -> test:unit"
	docker-compose run app php artisan test --testsuite=Unit

