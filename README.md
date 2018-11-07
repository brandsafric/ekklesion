Ekklesion
=========

Church management made simple, fast and free.

## Features
- Last generation PHP 7.2 required
- Modular
- Installable
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
4. Serve with php built-in web server `php -S 0.0.0.0:8000 -t public`
5. Complete installation steps.

## Modules

### Core Module
- Filesystem
- Mailing
- Internationalization middleware
- Sessions
- Persistence
- Logging
- Module

### People Module
- Accounts
- People
- Notes

### Install
- Provides installation capabilities