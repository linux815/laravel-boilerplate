#!/bin/bash

# Обеспечить запуск от root
[ "$UID" -eq 0 ] || exec sudo bash "$0" "$@"

APP_NAME="laravel-boilerplate-laravel.test-1"
HOST_ENTRY="127.0.0.1 boilerplate.test"

echo "📦 Копирование .env файла..."
docker exec -it "$APP_NAME" cp .env.example .env || cp .env.example .env

echo "🧹 Остановка и очистка контейнеров..."
docker compose down -v

echo "📦 Установка Composer зависимостей..."
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd)":/opt \
  -w /opt \
  laravelsail/php84-composer:latest \
  composer install --ignore-platform-reqs

echo "🐳 Запуск контейнеров..."
./vendor/bin/sail up -d
sleep 10

echo "🌐 Добавление в /etc/hosts..."
grep -qF "$HOST_ENTRY" /etc/hosts || echo "$HOST_ENTRY" >> /etc/hosts

echo "🔑 Генерация APP_KEY..."
docker exec -it "$APP_NAME" php artisan key:generate

echo "📂 Миграции базы данных..."
docker exec -it "$APP_NAME" php artisan migrate

echo "👤 Создание Orchid администратора..."
docker exec -it "$APP_NAME" php artisan orchid:admin admin admin@admin.com password

echo "🌱 Сидирование базы..."
docker exec -it "$APP_NAME" php artisan db:seed --force

echo "📦 Установка npm зависимостей..."
docker exec -it "$APP_NAME" npm install

echo "⚙️ Сборка фронтенда..."
docker exec -it "$APP_NAME" npm run dev

echo "✅ Готово! Открывай: http://boilerplate.test"
