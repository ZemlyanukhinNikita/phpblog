## Блог
Новостной блог на PHP, без использования фреймворка. Имеется возможность авторизации.
Просмотр всех статей на главной странице, топ-10 новостей по просмотрам за последнюю неделю.
Просмотр одной выбранной новости.
Администратор может добавлять и редактировать новость.
Имеется возможность разлогиниться.

### Тестовые пользователи

 - логин: ``admin`` пароль: ``123456``
 - логин: ``mortal`` пароль: ``qwerty``  
### Необходимое ПО
 
  - PHP 7.2
  - Composer
  - MySQL сервер

### Чтобы развернуть проект, нужно:

  - Склонировать репозиторий с помощью команды ``git clone`` либо скачать проект
  - в папке с проектом выполнить команду ``composer install``
  - создать базу данных и настроить подключение к ней
    - перейти в папку ``config``, переименовать файл ``config_example.php`` в ``config.php``
    - в файле ``config.php`` установить свои переменные подключения к бд
    - в корне проекта в файле ``phinx.yml`` в пункте development: также установить свои переменные подкючения к бд
  - в корне папки с проектом выполнить команды:
    - ``php vendor/bin/phinx migrate`` (миграции)
    - ``php vendor/bin/phinx seed:run`` (сиды)
    - ``sudo chmod 777 -R images/`` (для загрузки картинки на сервер)
  - Перейти в папку public/ и выполнить команду ``php -S localhost:8080``
  - Перейти по адресу ``http://localhost:8080``

    
  


