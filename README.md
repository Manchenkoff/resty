# Resty - API app template based on Yii 2 framework
 
## Installation

Run this command in the terminal

```text
composer install
```

Set up localhost, then open **'http://localhost/site'** in your browser and you will see response message like below:

```text
Resty is working!
```

## Default controllers

- Site
- Posts
- User

## Authorization

- /posts/limit - basic auth
- /users/* (except /index) - basic auth

## Routing

All routing rules contain in *'app/config/routes.php'*