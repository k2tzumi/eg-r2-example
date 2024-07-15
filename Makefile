OAS_OBJ := storage/api-docs/api-docs.json
$(OAS_OBJ): $(OAS_SRCS) $(COMPOSER_AUTOLOAD_OBJ)
	php -d memory_limit=-1 artisan l5-swagger:generate

storage/api-docs/redoc-static.html: $(OAS_OBJ)
	npx --yes @stoplight/spectral-cli lint storage/api-docs/api-docs.json
	npx --yes @redocly/cli build-docs storage/api-docs/api-docs.json -o storage/api-docs/redoc-static.html

redoc: storage/api-docs/redoc-static.html ## Generate Redoc
