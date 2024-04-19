[ "$UID" -eq 0 ] || exec sudo bash "$0" "$@"
docker exec -it laravel-boilerplate-laravel.test-1 cp .env.example .env
docker compose down -v
cp .env.example .env
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
./vendor/bin/sail up -d
sleep 10
sudo echo "127.0.0.1  boilerplate.test" >> /etc/hosts
docker exec -it laravel-boilerplate-laravel.test-1 php artisan key:generate
docker exec -it laravel-boilerplate-laravel.test-1 php artisan migrate
docker exec -it laravel-boilerplate-laravel.test-1 php artisan orchid:admin admin admin@admin.com password
docker exec -it laravel-boilerplate-laravel.test-1 php artisan db:seed --force
docker exec -it laravel-boilerplate-laravel.test-1 npm install
docker exec -it laravel-boilerplate-laravel.test-1 npm run dev
echo 'http://boilerplate.test'
