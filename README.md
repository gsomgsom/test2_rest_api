# Тестовое задание - каталог товаров с REST API
Использован шаблон YII2 Basic по минимуму в рамках тестового задания.
По условию тестового задания разработано [REST API](https://app.swaggerhub.com/apis-docs/ZHELNEEN/Reezonly-test-API/1.0.0).
Спецификация и сгенерированная документация по API лежит в папке `/api/`

Авторизация к API реализована по алгоритму HTTP Basic access authentication.
Просматривать товары можно без авторизации.

Протестировано на виртуальной машине с Apache 2 + PHP 7.4 + MariaDB 10.4

## Установка
Скачиваем проект в папку:
`git clone https://github.com/gsomgsom/test2_rest_api.git .`

В папке выполняем:
`composer i`

В конфигурации веб сервера указываем путь к папке `/web/` внутри проекта и файлу `index.php`

Создаём базу данных:
`reezonly_api`

Настраиваем доступ к БД в файлах:
`/config/db.php`

Запускаем миграцию из корневой папки:
`php yii migrate`

Установка завершена.

## Настройка тестов
Создаём базу данных:
`reezonly_api_test`

Настраиваем доступ к БД в файлах:
`/config/test-db.php`

Запускаем миграцию из корневой папки:
`php tests/bin/yii migrate`

Установить модуль REST:
`composer req --dev codeception/module-rest`

Для сборки:
`php vendor/bin/codecept build`

Установка завершена.

## Запуск тестов
Реализованы базовые тесты REST API и Unit-тесты к модели Item

Для запуска:
`php vendor/bin/codecept run`

## Дополнительно
В папке `/view-app/` расположены исходники фронт-части проекта на Vue.JS с инструкциями для пересборки.
Для работы проекта этого делать не обязательно. Всё уже собрано.

# Текст тестового задания
Разработать простое веб-приложение "Каталог товаров" через REST API, с использованием фреймворка Yii2. Приложение должно позволять просматривать список товаров, добавлять новые товары и редактировать существующие.
Для каждого товара должны быть доступны следующие данные:

- Название товара
- Описание товара
- Цена товара

Дополнительные требования:

1. Приложение должно быть разделено на отдельные модули (каталог товаров, административная панель и т.д.).
2. Каталог товаров должен отображать список всех товаров с возможностью сортировки и поиска по названию.
3. При добавлении и редактировании товара должна быть валидация данных (название обязательно, цена - числовое значение больше нуля).
4. Административная панель должна быть доступна только авторизованным пользователям.
5. В приложении должны быть методы, позволяющие в дальнейшем написать юнит тесты для проверки основных функций (например, добавление и редактирование товара). Сами тесты писать не нужно.
6. Код должен быть хорошо организован, читаем и соблюдать принципы SOLID.
7. Необходимо использовать git для контроля версий.
