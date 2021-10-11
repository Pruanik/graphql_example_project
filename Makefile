include .env

up:
	docker-compose up -d

up-without-databases:
	docker-compose up -d nginx
	
build:
	docker-compose rm -vsf
	docker-compose down -v --remove-orphans
	docker-compose build
	docker-compose up -d
	make composer-install

stop:
	docker-compose stop

composer-install:
	docker exec -it ${PHP_CONTAINER_NAME} composer install

enter:
	docker exec -it ${PHP_CONTAINER_NAME} /bin/bash

init:
	docker exec -it ${PHP_CONTAINER_NAME} symfony console doctrine:migrations:migrate
	docker exec -it ${PHP_CONTAINER_NAME} php bin/console doctrine:fixtures:load
	docker exec -it ${PHP_CONTAINER_NAME} php bin/console doctrine:mongodb:fixtures:load

cache-clean:
	docker exec -it ${PHP_CONTAINER_NAME} php bin/console cache:clear