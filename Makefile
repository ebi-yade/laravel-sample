# constants. For Avoid executing docker-compose exec as root.
export UID = $(shell id -u)
export GID = $(shell id -g)

.PHONY: up
up: ## alias docker-compose up -d
	docker-compose up -d

.PHONY: stop
stop: ## alias docker-compose stop
	docker-compose stop

.PHONY: down
down: ## alias docker-compose down
	docker-compose down

.PHONY: install
install: ## Install laravel project from dependencies and initialize environments.
	cp ./src/.env.example ./src/.env
	docker-compose up -d --build
	@make composer-install
	docker-compose exec app php artisan key:generate
	@make migrate
	@echo Install ${APP_NAME} successfully finished!

.PHONY: app-root
app-root: ## Attach an app container as root.
	docker-compose exec app bash

.PHONY: mysql
mysql: ## Attach a mysql container.
	docker-compose exec mysql bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'

.PHONY: redis
redis: ## Attach a redis container.
	docker-compose exec redis redis-cli

.PHONY: composer-install
composer-install: ## Exec composer install
	docker-compose exec app composer install

.PHONY: migrate
migrate: ## Exec migrate.
	docker-compose exec app php artisan migrate --seed

.PHONY: db-fresh
db-fresh: ## Exec fresh db with seeding.
	docker-compose exec app php artisan migrate:fresh --seed

.PHONY: test
test: ## Run tests.
	docker-compose exec app vendor/bin/phpunit
