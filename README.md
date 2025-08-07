# Activities Admin API

A Laravel 10+ API for managing Activities, Participants, and Activity Types with role-based access control and Swagger documentation.

## 🚀 Setup Instructions

### 1. Configure environment variables
`cp .env.example .env`

`.env` is preconfigured for Docker:
<pre>
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
</pre>

### 2. Build and start containers
`docker compose up -d --build`

Starts these services:
- `app` - Laravel PHP 8.3 FPM
- `db` - MySQL 8.0
- `artisan` - Laravel commands helper

### 3. Install dependencies
`docker compose exec app composer install`

### 4. Generate app key
`docker compose exec app php artisan key:generate`

### 5. Setup database
`docker compose exec app php artisan migrate --seed`

Creates test data including admin user:
- Email: admin@example.com
- Password: password
- Role: Admin

### 6. Link storage
`docker compose exec app php artisan storage:link`

Creates the `/public/storage` symlink so uploaded files are accessible.

### 7. Generate Swagger docs
`docker compose exec app php artisan l5-swagger:generate`

### 8. Access the application
**API Base URL**: http://localhost:8000  
**Swagger UI**: http://localhost:8000/api/documentation
