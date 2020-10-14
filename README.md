# RESTy - API app template based on Yii 2 framework

## Features

- Preconfigured authentication by access token (middleware trait)
- Custom JSON response format with `status` and `data` fields for easy use in other apps
- Sample data with RBAC users and roles
- Docker supports
- Based on [Yii 2 project](https://github.com/manchenkoff/yii2-project)

## Installation

To install project environment follow the instructions below

##### Composer install

```
composer create-project manchenkoff/RESTy new-app-name
```

##### Environment installation

- Install project dependencies by `composer install`
- Change `.env` settings for a database and necessary sections
- Start your server - `make up` (run `make` command to see details)
- Use app init command `make app-init` for apply migrations and seeders and `make app-reset` to reset
- Check project available on [http://localhost/](http://localhost/)

## Directory index

- `app` - main application directory
    - `commands` - console controllers
    - `controllers` - HTTP controllers classes
    - `core` - application components and classes
    - `database` - migrations and seeders
    - `messages` - i18n translations
    - `models` - application models classes
    - `routes` - HTTP routes file
- `config` - configuration files
    - `deploy` - Deployer tasks and configurations
- `tests` - codeception API and Unit tests