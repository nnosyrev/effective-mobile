### Установка

1. Скопировать конфиг файл и настроить необходимые переменные окружения:

```bash
cp .env.example .env
```

2. Установить зависимости:

```bash
composer install
```

3. Применить миграции

```bash
php artisan migrate
```

4. Доступ к приложению:

В браузере открыть [http://localhost/api/documentation](http://localhost/api/documentation).

