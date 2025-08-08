#!/usr/bin/env sh
set -e

# --- IMPORTANT: Do NOT try to edit .env inside the container ---
# APP_KEY must be provided via env variable in Railway.

if [ -z "$APP_KEY" ]; then
  echo "ERROR: APP_KEY is not set. Generate locally: php artisan key:generate --show"
  exit 1
fi

# Storage link (ignore if exists)
php artisan storage:link || true

# Run migrations + seeds (idempotent)
php artisan migrate --force
php artisan db:seed --force || true

# Generate Swagger (optional; won't fail if it errors)
php artisan l5-swagger:generate || true

# Serve on the platform port
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
