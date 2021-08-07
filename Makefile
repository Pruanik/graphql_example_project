include .env

up:
	docker-compose up -d
	
build:
	docker-compose rm -vsf
	docker-compose down -v --remove-orphans
	docker-compose build
	docker-compose up -d
	make composer-install

composer-install:
	docker exec -it ${PHP_CONTAINER_NAME} composer install

enter:
	docker exec -it ${PHP_CONTAINER_NAME} /bin/bash