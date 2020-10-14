.DEFAULT_GOAL := help
.PHONY: help up down reload start stop app-init app-reset yii

DOCKER_COMPOSE_CMD := docker-compose -f docker.yml
PHP_CMD := $(DOCKER_COMPOSE_CMD) exec "php"
YII_CMD := $(PHP_CMD) php yii

help: ## Show this message
	@echo "Application management"
	@echo
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

up: ## Run containers
	@$(DOCKER_COMPOSE_CMD) up -d

down: ## Stop and remove containers
	@$(DOCKER_COMPOSE_CMD) down

reload: ## Reload running container
	@$(DOCKER_COMPOSE_CMD) up -d

start: ## Start docker-compose
	@$(DOCKER_COMPOSE_CMD) start

stop: ## Stop docker-compose
	@$(DOCKER_COMPOSE_CMD) stop

app-init: ## Run application initialization
	@$(YII_CMD) app/init

app-reset: ## Reset application data
	@$(YII_CMD) app/reset

app-login: ## Login into application console
	@echo "Running PHP session..."
	@echo
	@$(PHP_CMD) sh

test: ## Run application tests
	@$(PHP_CMD) ./vendor/bin/codecept build
	@$(PHP_CMD) ./vendor/bin/codecept run