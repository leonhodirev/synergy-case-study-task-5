## Анализ работы

### 1. Необходимо создать web-сайт, используя любой стек технологий Web-разработки

**Команды:**
```bash
# Проверка установки PHP, Composer, Npm
php -v
composer -V
npm -v

# Установка Laravel (если не установлен глобально)
composer global require laravel/installer

# Создание нового проекта
laravel new case-study-task-5

# Переход в директорию проекта
cd case-study-task-5

# Настройка подключения к базе данных в .env
# DB_CONNECTION=pgsql
# DB_HOST=localhost
# DB_PORT=5432
# DB_DATABASE=practike5
# DB_USERNAME=postgres
# DB_PASSWORD=postgres

# Добавление русского языка
composer require laravel-lang/lang --dev
php artisan lang:update

# Изменение локали в .env
# APP_LOCALE=ru

# Миграция базы данных
php artisan migrate

# Запуск локального сервера
php artisan serve
```

---

### 2. Создать пользователя системы

```bash
# Создадим пользователя на странице /register
```

---

### 3. Создать для пользователя функцию записи своего путешествия

```bash
# Создадим миграции и модели
php artisan make:model Travel -m
php artisan make:model Image -m
php artisan migrate

# Создадим Livewire-компонент
php artisan make:livewire travels.create
# Обновим представление resources/views/livewire/travels/create.blade.php

# Добавим роут
```

---

### 4. Создать функцию просмотра путешествий других пользователей

```bash
# Создадим Livewire-компонент
php artisan make:livewire travels.index
php artisan make:livewire travels.show
# Обновим представление resources/views/livewire/travels/create.blade.php
# Обновим представление resources/views/livewire/travels/show.blade.php

# Добавим роут
```

---

### 5. Добавить 3 из перечисленных функций о путешествии: Местоположение (с привязной к геопозиции), Изображение мест, Стоимость путешествия.

Основные Функции были добавлены в 3 пункте.
Дополнительно подключил карту, при клике по месту заполняются координаты.
Подключил карту Leaflet: добавил css и js плагина, добавил script обработки

---

### 6. Дополнительно: на странице всех путешествий выведем свои путешествия

Добавим кнопку переключения в представление resources/views/livewire/travels/index.blade.php
Добавим переключение в Livewire/Travels/TravelsIndex.php

---

### 7. Дополнительно: сделаем страницу редактирования своих путешествий

```bash
# Создадим Livewire-компонент
php artisan make:livewire travels.edit
# Обновим представление resources/views/livewire/travels/edit.blade.php

# Добавим роут
# Добавим ссылки на редактирование
```
