DC=docker-compose
args = `arg="$(filter-out $@,$(MAKECMDGOALS))" && echo $${arg:-${1}}`

.DEFAULT_GOAL := help
.PHONY: help

help:  ##Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

composer: ## Make composer install
	$(DC) run composer $(call args,install)

init-theme:
	$(DC) exec --user=www-data php ls

db-import: ## Import database
	$(DC) exec --user=www-data php wp db import $(filter-out $@,$(MAKECMDGOALS)) --allow-root
	$(DC) exec --user=www-data php wp search-replace '$(source-url)' 'http://$(PROJECT_NAME).docker' --precise --all-tables --allow-root

db-export: ## Export database. Usage : make db-export target-url=https://bedrock.amphi.beer
	$(DC) exec --user=www-data php wp search-replace 'http://$(PROJECT_NAME).docker' '$(target-url)' --precise --all-tables --allow-root
	$(DC) exec --user=www-data php wp db export --allow-root
	$(DC) exec --user=www-data php wp search-replace '$(target-url)' 'http://$(PROJECT_NAME).docker' --precise --all-tables --allow-root

wp: ##Start WP Cli command
	$(DC) exec --user=www-data php wp $(call args,--info) --allow-root

build:
	$(DC) up -d --build

up: ##Start Docker
	$(DC) up -d
	$(DC) exec --user=root php /bin/bash /docker/setup-xdebug.sh

do: ##Stop Docker
	$(DC) down

ex: ##Connect to WP
	$(DC) exec --user=www-data php /bin/bash

exa: ##Connect to PHP Admin
	$(DC) exec --user=root php /bin/bash

logs: ##Logs
	$(DC) logs -f

ccv: ##Restart varnish
	$(DC) restart varnish

yarn: ##Yarn - install dependencies
	$(DC) exec php yarn --cwd web/app/themes/bedrock
