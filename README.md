# RESTy - API app template based on Yii 2 framework

## Features

- Preconfigured authentication by access token (middleware trait)
- Custom JSON response format with *status* and *data* fields for easy use in other apps
- Sample data with RBAC users and roles
- Docker supports
- Based on [Yii 2 project](https://github.com/manchenkoff/yii2-project)

## Installation
To install project environment follow the instructions below

##### Docker
Deploy with *docker.yml* by command `docker-compose up -f docker.yml` or you can create `Run configuration` with your IDE (ex. PhpStorm)

##### MAMP/LAMP etc
Set up Apache document root to the base application directory

##### Environment installation
- Install project dependencies by `composer install`
- Change `.env` settings for database and necessary sections
- Start your server (Apache, Nginx, MySQL, Docker etc)
- Use app init command `php yii app/init` (reset - `php yii app/reset`) for apply migrations and seeders
- Check project available on `http://localhost/`

## Directory index

- `app`: main application directory
    - `commands`: console controllers
    - `controllers`: HTTP controllers classes
    - `core`: application components and classes
    - `database`: migrations and seeders
    - `messages`: i18n translations
    - `models`: application models classes
    - `routes`: HTTP routes file
- `config`: configuration files
    - `deploy`: Deployer tasks and configurations
    - `test`: Codeception config files
- `tests`: codeception API and Unit tests