coverage:
	vendor/bin/phpunit --coverage-text

cs:
	vendor/bin/php-cs-fixer fix --diff --verbose

db-validate:
	vendor/bin/doctrine orm:validate-schema

migration:
	vendor/bin/doctrine orm:clear-cache:metadata
	vendor/bin/doctrine-migrations migrations:diff

migrate:
	vendor/bin/doctrine-migrations migrations:migrate --no-interaction --write-sql

commit: cs coverage
	git add . && git commit