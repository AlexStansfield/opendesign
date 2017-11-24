.PHONY: all

php = $(shell which php)
composer = $(shell which composer)

install: init

init: copy-env-files db-migrate
	cd backend && php artisan key:generate
	@echo
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Completed
	@echo

copy-env-files:
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Copy backend .env configurations
	cp backend/.env.example backend/.env
	@echo
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Copy backend phpunit.xml.dist to phpunit.xml
	cp backend/phpunit.xml.dist backend/phpunit.xml
	@echo

db-migrate:
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Migrations
	cd backend && php artisan migrate:fresh --seed

test: unit feature

unit:
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Unit Test
	cd backend && vendor/bin/phpunit --testsuite=Unit

feature:
	@echo "$(shell echo "\033[0;49;32m---\033[m")" Feature Test
	cd backend && vendor/bin/phpunit --testsuite=Feature
