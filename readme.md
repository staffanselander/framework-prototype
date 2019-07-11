### Prerequisites

- Docker
- PHP > 7.1 (without docker / for now)
- Composer  (without docker / for now)


## Installation

### Framework `framework/`
1. Goto framework - `cd framework`
2. Install composer packages - `composer install`

### Demo App `demo-app/`
1. Goto Demo App - `cd demo-app/`
2. Install composer packages - `composer install`
3. Copy env file, don't change the db values - `cp _env.example.php _env.php`


## Run server
1. Goto Demo App - `cd demo-app/`
2. Run server via Make(Docker) - `make server`


## Tests

### Framework
1. Goto framework - `cd framework/`
2. Run PhpUnit - `vendor/bin/phpunit`
