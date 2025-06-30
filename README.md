## Запуск приложения

**Технологии:** PHP 8.3.2, Laravel 12, PostgreSQL

**Команды:**
```bash
# Проверка установки PHP и Composer
php -v
composer -V

# Установка зависимостей
composer install

# Настройка подключения к базе данных в .env
# Настройка подключения к базе данных в .env
# DB_CONNECTION=pgsql
# DB_HOST=localhost
# DB_PORT=5432
# DB_DATABASE=practike5
# DB_USERNAME=postgres
# DB_PASSWORD=postgres

# Миграция базы данных
php artisan migrate

# Запуск локального сервера
php artisan serve

# Может потребоваться создать манифест
npm install && npm run build

```
Роуты
-------------------

      /                        Главная страница -> Переход в авторизацию
      /login                   Авторизация
      /register                Регистрация пользователя
      /travels/create          Добавление своего путешествия
      /travels                 Путешествия других пользователей (по кнопке можно выбрать свои для редактирования)
      /travels/{id}            Просмотр конкретного путешествия
      /travels/{travel}/edit   Редактирование путешествия
