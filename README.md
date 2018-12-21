# Resty - API app template based on Yii 2 framework

## Features

- Preconfigured authentication by access token (middleware trait)
- Custom JSON response format with *status* and *data* fields for easy use in other apps
- Sample data with RBAC users and roles
- HTTP request tests examples
- Docker supports
- Dependency Injection in Controller actions
 
## Installation

Run this command in the terminal

```bash
composer install
```

When all components will be installed, run next command to execute database migrations (SQLite by default, see configs)
```bash
php yii migrate
```

Set up localhost, then open **'http://localhost/test'** in your browser and you will see response message like below:

```text
Resty is working!
```

## Routing

All routing rules contain in *'app/config/routes.php'*
