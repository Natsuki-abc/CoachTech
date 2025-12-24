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

down:
	@$(DC) down

destroy:
	@$(DC) down --rmi all --volumes

php:
	@$(DC) exec php bash

db:
	@$(DC) exec mysql bash

db.console:
	@$(DC) exec mysql laravel_db -U laravel_user -p laravel_pass

cache clear:
	@$(DC) exec backend php artisan config:clear
	@$(DC) exec backend php artisan route:clear
	@$(DC) exec backend php artisan view:clear
	@$(DC) exec backend php artisan cache:clear
