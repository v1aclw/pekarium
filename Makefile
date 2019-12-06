HOST_NAME=fake-payment.pekarium
IP=$(shell docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' fake-payment.nginx)
HOST=${IP} ${HOST_NAME}

up: set_host build

down:
	docker-compose -f docker/docker-compose.yml down

build:
	docker-compose -f docker/docker-compose.yml up -d --build --force-recreate

set_host:
	sudo -- sh -c -e "sed -i '/${HOST_NAME}/d' /etc/hosts && echo '${HOST}' >> /etc/hosts"; \

provision: up
