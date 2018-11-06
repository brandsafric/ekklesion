coverage:
	vendor/bin/phpunit --coverage-text

cs:
	vendor/bin/php-cs-fixer fix --diff --verbose

translations:
	find . -iname '*.php' | xargs xgettext -L PHP -o messages.po

db-validate:
	vendor/bin/doctrine orm:validate-schema

commit: translations cs coverage
	git add . && git commit