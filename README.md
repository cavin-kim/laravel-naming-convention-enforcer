# KPhiri: Laravel Naming Convention Enforcer

KPhiri is a Laravel package that enforces naming conventions for your Laravel application's models, controllers, and routes. It ensures your application structure follows these best practices:

- **Models are singular** (e.g., `User`, `Post`)
- **Controllers are plural** and follow the `SomeModelController` convention (e.g., `UsersController`, `PostsController`)
- **Resource routes** are automatically named according to the plural form of controllers.

With zero manual configuration required, KPhiri helps you maintain a clean and organized project structure effortlessly!

## Features

- Automatically checks and enforces **singular model names**.
- Ensures **plural controller names** (e.g., `UsersController` for the `User` model).
- Automatically registers **resource routes** with correct naming conventions.

## Requirements

- **PHP 7.4** or **8.0+**
- **Laravel 8.x**, **9.x**, or **10.x**

## Installation

To install the package, follow these steps:

1. Add the package to your project using Composer. Run the following command:

   ```bash
   composer require vendor/k-phiri

## Usage

Once the package is installed, you can enforce naming conventions by running the following Artisan command:

```bash
php artisan naming:enforce
```

This command will check your application's structure and enforce the naming conventions.

## License

This package is licensed under the MIT License. See the LICENSE file for more details.
