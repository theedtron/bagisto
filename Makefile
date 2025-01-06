up-dev:
	docker-compose -f local-compose.yml up -d
	docker-compose -f local-compose.yml exec bagisto-local-app composer install
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan migrate
up-prod:
	docker-compose up -d
	docker-compose exec bagisto-app composer install
	docker-compose exec bagisto-app php artisan migrate
build-dev:
	docker-compose -f local-compose.yml build
build:
	docker-compose build
init-dev:
	docker-compose -f local-compose.yml up -d --build
	docker-compose -f local-compose.yml exec bagisto-local-app composer install
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan key:generate
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan migrate
	docker-compose -f local-compose.yml exec bagisto-local-app chmod -R 775 storage bootstrap/cache
init-prod:
	docker-compose up -d --build
	docker-compose exec bagisto-app composer install
	docker-compose exec bagisto-app php artisan key:generate
	docker-compose exec bagisto-app php artisan migrate
	docker-compose exec bagisto-app chmod -R 775 storage bootstrap/cache
remake-dev:
    # @make destroy
	@make init-dev
remake:
    # @make destroy
	@make init-prod
stop-dev:
	docker-compose -f local-compose.yml stop
stop:
	docker-compose stop
down-dev:
	docker-compose -f local-compose.yml down
down:
	docker-compose down
restart-dev:
	@make down-dev
	@make up-dev
restart:
	@make down
	@make up
destroy-dev:
	docker-compose -f local-compose.yml down --rmi all --volumes --remove-orphans
destroy:
	docker-compose down --rmi all --volumes --remove-orphans
destroy-volumes-dev:
	docker-compose -f local-compose.yml down --volumes --remove-orphans
destroy-volumes:
	docker-compose down --volumes --remove-orphans
logs-dev:
	docker-compose -f local-compose.yml logs
logs:
	docker-compose logs
migrate-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan migrate
migrate:
	docker-compose exec bagisto-app php artisan migrate
route-cache-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan route:cache
route-cache:
	docker-compose exec bagisto-app php artisan route:cache
config-clear-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan config:clear
config-clear:
	docker-compose exec bagisto-app php artisan config:clear
cache-clear-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan cache:clear
cache-clear:
	docker-compose exec bagisto-app php artisan cache:clear
dump-autoload-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app composer dump-autoload
dump-autoload:
	docker-compose exec bagisto-app composer dump-autoload
event-clear-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app php artisan event:clear
event-clear:
	docker-compose exec bagisto-app php artisan event:clear
start-app-services-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app service cron start
	docker-compose -f local-compose.yml exec bagisto-local-app service redis-server start
	docker-compose -f local-compose.yml exec bagisto-local-app service supervisor start
start-app-services:
	docker-compose exec bagisto-app service cron start
	docker-compose exec bagisto-app service redis-server start
	docker-compose exec bagisto-app service supervisor start
restart-app-services-dev:
	docker-compose -f local-compose.yml exec bagisto-local-app service cron restart
	docker-compose -f local-compose.yml exec bagisto-local-app service redis-server restart
	docker-compose -f local-compose.yml exec bagisto-local-app service supervisor restart
restart-app-services:
	docker-compose exec bagisto-app service cron restart
	docker-compose exec bagisto-app service redis-server restart
	docker-compose exec bagisto-app service supervisor restart
