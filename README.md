
Для запуска проекта необходимо:

1. Установить Docker.
2. Клонируем репозиторий из гитхаба
3.  Устанавливаем зависимости: docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
4. Выполняем команду (Возможно не понадобиться): chmod -R 777 storage/ && chmod -R 777 public/ && chmod -R 777 bootstrap/cache && mkdir node_modules && chmod -R 777 node_modules
5. Выполняем команду: ./vendor/bin/sail up -d
6. Для запуска проекта с начальными данными выполняем команду ./vendor/bin/sail artisan install
7. Логин для доступа от автора: author@email.test - 12345678

Библиотеки:

<ol>
    <li><a href="https://github.com/glushkovds/phpclickhouse-laravel">Работа с Clickhouse: </a></li>
</ol>
