# KPhiri: Laravel Naming Convention Enforcer

KPhiri is a Laravel package that enforces naming conventions for your Laravel application's models, controllers, and routes. It automatically ensures that:

- Models are singular (e.g., User, Post)
- Controllers are plural and follow the SomeModelController convention (e.g., UsersController, PostsController)
- Resource routes are properly named, matching the plural form of controllers.

# Features

Automatically checks and enforces singular model names.
Ensures plural controller names (e.g., UsersController for the User model).
Automatically registers resource routes with correct naming conventions.

- Zero manual configuration is required. Once installed, the package handles everything automatically.

# Requirements

PHP 7.4 or 8.0+
Laravel 8.x, 9.x, or 10.x 

# Installation
1. Add the Package to Your Project
Run the following command to install the package using Composer:

- composer require vendor/k-phiri
- Auto-Discovery
No need to manually register the service provider. The package uses Laravel's auto-discovery feature, so the service provider will be automatically registered when you install the package.

# Running the Naming Convention Enforcer

- php artisan naming:enforce

# License
- This package is open-sourced software licensed under the MIT license.
