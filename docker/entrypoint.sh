#!/usr/bin/env sh
set -e

# Ensure SQLite file exists
mkdir -p storage/database
[ -f storage/database/database.sqlite ] || touch storage/database/database.sqlite

# App key (idempotent)
php artisan key:generate --force

# Storage link (ignore if exists)
php artisan storage:link || true

# Migrate + seed (idempotent)
php artisan migrate --force
php artisan db:seed --force || true

# Generate Swagger (optional, won’t fail deploy if it errors)
php artisan l5-swagger:generate || true

# Serve on the platform port
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
