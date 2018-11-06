Ekklesion
=========

Church management made simple, fast and free.

## Features
- Last generation PHP 7.2 required
- Modular
- People management module
- Household management module (In progress)
- Groups management module (In progress)
- Events management module (In progress)
- Finances management module (In progress)
- Powered by Slim 3.0
- PSR compliant
- Best object oriented practices for better maintainability

## Development
Please read the [contributions guide](/CONTRIBUTING.md) before you submit any 
contributions.

To set up a dev environment you need:

- MySQL 5.7
- PHP 7.2
- Git
- CMake

1. `git clone git@github.com:mnavarrocarter/ekklesion.git ekklesion`
2. `composer install && yarn install`
3. `yarn run dev`
4. `cp .env.dist .env`
5. Populate your environment variables with your values
6. `sudo mysql -e "CREATE DATABASE ekklesion;"`
7. Run the migrations with `make migrations`