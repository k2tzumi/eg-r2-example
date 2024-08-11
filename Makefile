SRCDIR := app

OAS_OBJ := storage/api-docs/api-docs.json
REDOC_OBJ := storage/api-docs/redoc-static.html

COMPOSER_DIR := vendor
COMPOSER_CACHE_SRCS := ./$(COMPOSER_DIR)/composer/installed.json
COMPOSER_AUTOLOAD_OBJ := ./$(COMPOSER_DIR)/composer/autoload_classmap.php

DIFF_PHP_SRCS := $(shell find app config database public resources routes tests -name "*.php" -type f)

GIT_HEAD := ./.git/HEAD

MIGRATION_STATUS := storage/makefile/.migration.status
FIXER_DIFF_STATUS := storage/makefile/.fixer-diff.status

STAN_STATUS := .phpstan/resultCache.php
CS_FIXER_CACHE := .php-cs-fixer.cache
OAS_ROUTE := routes/oas.php
ENV_FILE := .env

ROUTES_SRCS := $(wildcard $(SRCDIR)/Htttp/Controllers/*.php)
MIGRATION_SRCS := $(wildcard database/migrations/*.php)
OAS_SRCS := $(ROUTES_SRCS) \
  $(wildcard $(SRCDIR)/Http/*/*.php)

$(OAS_OBJ): $(OAS_SRCS) $(COMPOSER_AUTOLOAD_OBJ)
	php -d memory_limit=-1 artisan l5-swagger:generate

$(COMPOSER_CACHE_SRCS):
	composer install

$(COMPOSER_AUTOLOAD_OBJ): $(GIT_HEAD)
	composer dump-autoload
	touch $@

.DEFAULT_GOAL := help
.PHONY: help \
   generate-route composer-install migrate redoc \
   phpstan rector rector-all fixer fixer-all lint lint-all

help:
	@grep -E '^[a-zA-Z_/%-]+:.*?## .*$$' Makefile | \
	  sort | \
	  awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

$(STAN_STATUS): $(COMPOSER_CACHE_SRCS) $(COMPOSER_AUTOLOAD_OBJ) $(DIFF_PHP_SRCS)
	php -d memory_limit=-1 ./$(COMPOSER_DIR)/bin/phpstan analyse -c phpstan.neon

$(CS_FIXER_CACHE): $(COMPOSER_CACHE_SRCS) $(COMPOSER_AUTOLOAD_OBJ)
	$(COMPOSER_DIR)/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php

$(FIXER_DIFF_STATUS): $(COMPOSER_CACHE_SRCS) $(COMPOSER_AUTOLOAD_OBJ)
	git diff --name-only --diff-filter=d origin/main '*.php' | \
	 xargs -r $(COMPOSER_DIR)/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
	echo $(FIXER_DIFF_STATUS) > $@

$(OAS_ROUTE): $(ROUTES_SRCS)
	php -d memory_limit=-1 artisan eg-r2:generate-route
	$(COMPOSER_DIR)/bin/php-cs-fixer fix routes/oas.php

$(REDOC_OBJ): $(OAS_OBJ)
	npx --yes @stoplight/spectral-cli lint $(OAS_OBJ)
	npx --yes @redocly/cli build-docs $(OAS_OBJ) -o $@

composer-install: ## Run composer install(and dump-autoload)
	composer install

lint-all: $(CS_FIXER_CACHE) $(STAN_STATUS) ## RUN Linter with current project

lint: $(RECTOR_DIFF_STATUS) $(FIXER_DIFF_STATUS) $(STAN_STATUS) ## RUN Linter diff of Development branch

fixer-all: $(CS_FIXER_CACHE) ## RUN CS-Fixer with current project

fixer: $(FIXER_DIFF_STATUS) ## RUN CS-Fixer with diff of Development branch

phpstan: $(STAN_STATUS) ## RUN PHPStan with current project

generate-route: $(OAS_ROUTE) ## Generate route

migrate: ## Run migrate
	php -d memory_limit=-1 artisan mysql:createdb
	php -d memory_limit=-1 artisan migrate --seed
	php -d memory_limit=-1 artisan migrate:status > $(MIGRATION_STATUS)

redoc: $(REDOC_OBJ) ## Generate Redoc
