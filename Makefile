CONTAINER=php

up:
	docker-compose -f docker-compose.yml up --build -d --no-deps --remove-orphans

down:
	docker-compose -f docker-compose.yml down

remove_containers:
	docker rm $$(docker ps -aq)

remove_images:
	docker rmi $$(docker images -aq)

exec:
	docker exec -ti ${CONTAINER} sh
