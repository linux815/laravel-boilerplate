# Laravel Boilerplate with Orchid, InertiaJS, Jetstream & Sanctum

## Описание

Базовый шаблон на Laravel 12 с преднастроенной админкой на [Laravel Orchid](https://orchid.software/), фронтендом на [InertiaJS](https://inertiajs.com/), аутентификацией через [Jetstream](https://jetstream.laravel.com/) и [Sanctum](https://laravel.com/docs/12.x/sanctum).

Проект настроен для быстрого старта и удобного развития.

---

## Возможности

- Laravel 12
- Админка на Laravel Orchid
- SPA с использованием InertiaJS и Vue 3
- Аутентификация и авторизация через Jetstream и Sanctum
- Базовый пример CRUD для статей с архитектурой Domain-Driven Design (DDD)
- Docker для разработки и деплоя

---

## Авторазворачивание

В проекте есть скрипт `deploy.sh`, который полностью поднимает окружение и настраивает проект:

```bash
./deploy.sh
```

Скрипт делает следующее:

- Копирует `.env.example` в `.env`
- Останавливает и удаляет старые контейнеры Docker
- Устанавливает зависимости через Composer
- Запускает контейнеры с помощью Laravel Sail
- Генерирует ключ приложения
- Выполняет миграции и сиды базы данных
- Создаёт админа для Orchid
- Устанавливает и собирает frontend (npm install и npm run dev)
- Добавляет запись в `/etc/hosts` для локального домена

---

## Данные для входа по умолчанию

- **Логин:** `admin@admin.com`
- **Пароль:** `password`

---

## Требования

- Docker и Docker Compose
- Linux / macOS / Windows с WSL2
- Git

---

## Запуск проекта локально

1. Клонируйте репозиторий:

```bash
git clone <your-repo-url>
cd <your-repo-folder>
```

2. Запустите деплой скрипт:

```bash
./deploy.sh
```

3. Откройте браузер по адресу:

```
http://boilerplate.test
```

---

## Структура проекта

- `app/` — основная папка приложения Laravel
- `bootstrap/app.php` — точка входа и конфигурация приложения
- `Domain/` — бизнес-логика, сервисы, репозитории, DTO и т.д.
- `resources/js/` — фронтенд на Vue 3 + InertiaJS
- `routes/` — маршруты API и веб
- `docker-compose.yml` — конфигурация Docker окружения
- `deploy.sh` — скрипт автозапуска и деплоя

---

## Полезные команды

- `./deploy.sh` — полный деплой проекта (перезапускает контейнеры, устанавливает зависимости, миграции и фронтенд)
- `./vendor/bin/sail artisan migrate` — запуск миграций
- `./vendor/bin/sail artisan orchid:admin` — создание пользователя-админа Orchid
- `./vendor/bin/sail npm run dev` — сборка фронтенда в режиме разработки
- `./vendor/bin/sail npm run build` — сборка фронтенда для продакшена

---

## Контакты и помощь

Если возникли вопросы или предложения — создавайте issue или пишите напрямую.

---

Счастливой разработки! 🚀
