.PHONY: start stop

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))

TTY_PARAM := $(shell tty > /dev/null && echo "" || echo "-T")
WINPTY := $(shell command -v winpty && echo "winpty " ||  echo "")
COMPOSE_NETWORK := $(shell docker network ls | grep default | grep volkker | awk '{print $$2}' | tail -n 1)

start: stop
	docker-compose up -d

stop:
	docker-compose down

rebuild: stop
	docker-compose up -d --build

bash:
	$(WINPTY)docker exec -it httpd-php72_httpd_1 bash

status:
	docker-compose ps
