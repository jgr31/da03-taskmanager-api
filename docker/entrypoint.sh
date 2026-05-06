#!/bin/sh
set -e

if [ ! -f .env ]; then
  cp .env.example .env
fi

if [ ! -d vendor ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

php artisan key:generate --force >/dev/null 2>&1 || true

# Espera bàsica perquè MySQL/MariaDB pugui arrencar abans de migrar
if [ -n "$DB_HOST" ]; then
  echo "Esperant base de dades a $DB_HOST:$DB_PORT..."
  for i in $(seq 1 30); do
    php -r "new PDO('mysql:host='.getenv('DB_HOST').';port='.getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" >/dev/null 2>&1 && break
    sleep 2
  done
fi

php artisan migrate --force || true

exec "$@"
