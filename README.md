<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Running This Project

To get started with this project, follow these steps:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Fahadhassan1/glassdoor-tech-task.git
    cd glassdoor-tech-task
    ```

2. **Install dependencies:**
    ```bash
    composer install
    ```

3. **Set up environment variables:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure your `.env` file:**
    Update your `.env` file with your database and other configurations.

5. **Run database migrations:**
    ```bash
    php artisan migrate
    ```

6. **Seed the database:**
    ```bash
    php artisan db:seed --class=ProductsTableSeeder
    ```


7. **Start the development server:**
    ```bash
    php artisan serve
    ```

## Calling API

- **Get all products with filter:**
  ```bash
  GET /api/products

  http://127.0.0.1:8001/api/products?category=electronics&sort=asc&search=phone&page=1
  ```

## Running Tests

To run the tests, follow these steps:

1. **Set up the testing environment:**
    ```bash
    php artisan key:generate --env=testing
    ```

2. **Run database migrations for testing:**
    ```bash
    php artisan migrate --env=testing
    ```

3. **Run the tests:**
    ```bash
    php artisan test
    ```