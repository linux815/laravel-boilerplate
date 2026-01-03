#!/bin/bash

# 🚨 Запуск от root (нужно для /etc/hosts)
[ "$UID" -eq 0 ] || exec sudo bash "$0" "$@"

APP_NAME="laravel-boilerplate-laravel.test-1"
HOST_ENTRY="127.0.0.1 boilerplate.test"
MYSQL_SERVICE="laravel-boilerplate-mysql-1"

echo "🧹 Остановка контейнеров..."
docker compose down -v

# 🔧 Исправляем права
echo "🔐 Исправляем права на storage, bootstrap/cache и public..."
sudo chown -R $USER:$USER storage bootstrap/cache public
sudo chmod -R 775 storage bootstrap/cache public

# 📦 .env
if [ ! -f ".env" ]; then
    echo "📦 Создаём .env из .env.example..."
    cp .env.example .env
fi

# 📦 Composer
echo "📦 Установка Composer зависимостей..."
docker run --rm \
  -u "$(id -u "$SUDO_USER"):$(id -g "$SUDO_USER")" \
  -v "$(pwd)":/opt \
  -w /opt \
  laravelsail/php84-composer:latest \
  composer install --ignore-platform-reqs

# 🐳 Контейнеры
echo "🐳 Запуск контейнеров..."
./vendor/bin/sail up -d

# ⏳ Получаем данные из .env
DB_HOST=$(grep -E "^DB_HOST=" .env | cut -d '=' -f2)
DB_PORT=$(grep -E "^DB_PORT=" .env | cut -d '=' -f2)
DB_DATABASE=$(grep -E "^DB_DATABASE=" .env | cut -d '=' -f2)
DB_USERNAME=$(grep -E "^DB_USERNAME=" .env | cut -d '=' -f2)
DB_PASSWORD=$(grep -E "^DB_PASSWORD=" .env | cut -d '=' -f2)

# ⏳ Ждём MySQL
echo "⏳ Ждём MySQL..."
until docker exec -i "$APP_NAME" php -r "try { new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); } catch(Exception \$e) { exit(1); }" >/dev/null 2>&1; do
    echo "⏳ MySQL ещё не готов..."
    sleep 2
done

# 🌐 hosts
echo "🌐 Добавление в /etc/hosts..."
grep -qF "$HOST_ENTRY" /etc/hosts || echo "$HOST_ENTRY" | tee -a /etc/hosts > /dev/null

# 🔑 APP_KEY
echo "🔑 Генерация APP_KEY..."
docker exec -it "$APP_NAME" php artisan key:generate

# ♻️ cache
docker exec -it "$APP_NAME" php artisan optimize:clear

# 📂 migrations
echo "📂 Миграции..."
docker exec -it "$APP_NAME" php artisan migrate --force

# 👤 Orchid admin
echo "👤 Создание Orchid администратора..."
docker exec -it "$APP_NAME" php artisan orchid:admin \
  admin admin@admin.com password

# 🌱 seed
echo "🌱 Сидирование..."
docker exec -it "$APP_NAME" php artisan db:seed --force

# 📦 npm
echo "📦 npm install..."
docker exec -it "$APP_NAME" npm install

echo "⚙️ npm build..."
docker exec -it "$APP_NAME" npm run build

echo "✅ Готово! Открывай: http://boilerplate.test"
