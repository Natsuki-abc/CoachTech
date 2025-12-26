DC = docker compose

init:
	@$(DC) up -d --build
	@$(DC) exec php composer install
	@$(DC) exec php	cp .env.example .env
	@$(DC) exec php php artisan config:clear
	@$(DC) exec php php artisan cache:clear
	@$(DC) exec php php artisan key:generate
	@$(DC) exec php php artisan migrate
	@$(DC) exec php php artisan db:seed

up:
	@$(DC) up -d

restart:
	@$(DC) restart

down:
	@$(DC) down

destroy:
	@$(DC) down --rmi all --volumes

php:
	@$(DC) exec php bash

db:
	@$(DC) exec mysql bash

db.console:
	@$(DC) exec mysql mysql -u laravel_user -plaravel_pass laravel_db

cache clear:
	@$(DC) exec php php artisan config:clear
	@$(DC) exec php php artisan route:clear
	@$(DC) exec php php artisan view:clear
	@$(DC) exec php php artisan cache:clear
