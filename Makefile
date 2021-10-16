install:
	docker-compose up -d --build --remove-orphans
stop:
	docker-compose down
status:
	docker-compose ps
php-bash:
	docker-compose exec app /bin/bash