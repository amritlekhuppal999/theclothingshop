# TheClothingShop

A ecommerce site/portal built on LARAVEL.

## See the live site here: [TheClothingShop](http://157.173.220.30/)

## Table of Contents
- [System Requirement](##Requirements)
- [Installation](##installation)
- Project Structure
- Demo Credentials
- [Features](##features)
- [License](##license)

## Requirements
- PHP >= 8.2
- Composer
- Laravel >= 10.x
- MySQL/PostgreSQL/SQLite
- Node.js & NPM/Yarn (if using Laravel Mix/Vite for frontend)
- Apache (If you wish to run on apache instead of its own server)


## Installation

1. Clone the repo
   Using SSH
   ```bash
   git clone git@github.com:amritlekhuppal999/theclothingshop.git
   ```
   OR Using HTTPS
   ```
   git clone https://github.com/amritlekhuppal999/theclothingshop.git
   ```

2. Navigate to project
   ```bash
   cd project-name
   ```

3. Install Dependencies
   ```bash
   composer install
   npm install && npm run dev 
   ```
   
4. copy `.env` file
   ```bash
   cp .env.example .env
   ```
   - Update the database and other required environmental variables in .env

5. Generate application key
   ```
   php artisan key:generate
   ```

6. Run migrations
   ```
   php artisan migrate
   ```
   This will create the required tables using the migration files.

7. Start Development Server
   ```
   php artisan serve
   ```
   Visit `localhost:8000` or `http://127.0.0.1:8000` on your browser


## Project Structure
```
app/        # Core application code
routes/     # API & web routes
database/   # Migrations and seeders
resources/  # Blade templates, JS, CSS
public/     # Public assets
```

## Demo Credentials
- Admin → admin@example.com / password
- User → user@example.com / password
>[!info] will update this soon.

## Features
