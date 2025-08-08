#!/usr/bin/env sh
set -e

# --- IMPORTANT: Do NOT try to edit .env inside the container ---

# Storage link (ignore if exists)
php artisan storage:link || true

# Run migrations + seeds (idempotent)
php artisan migrate --force
php artisan db:seed --force || true

# Generate Swagger (optional; won't fail if it errors)
php artisan l5-swagger:generate || true

# Serve on the platform port
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
