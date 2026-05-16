#!/bin/bash
set -e

cd /app

if [ ! -f .env ]; then
  cp .env.example .env
fi

composer install --no-interaction --prefer-dist

if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
  php artisan key:generate --force
fi

if ! grep -q "OCTANE_SERVER" .env 2>/dev/null; then
  composer require laravel/octane:^1.3 --no-interaction --with-all-dependencies
  php artisan octane:install --server=swoole --no-interaction
fi

until php artisan migrate --force 2>/dev/null; do
  echo "Waiting for database..."
  sleep 2
done

if [ "${SEED_ON_START}" = "true" ]; then
  COUNT=$(php artisan tinker --execute="echo \\App\\Models\\Sale::count();" 2>/dev/null | tail -1 || echo "0")
  if [ "${COUNT}" = "0" ]; then
    php artisan db:seed --force
  fi
fi

exec php artisan octane:start \
  --server=swoole \
  --host=0.0.0.0 \
  --port=8000 \
  --workers="${SWOOLE_WORKERS:-auto}" \
  --task-workers="${SWOOLE_TASK_WORKERS:-auto}" \
  --max-requests="${SWOOLE_MAX_REQUESTS:-500}"
